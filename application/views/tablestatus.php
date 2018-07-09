<?php
	$conn = mysqli_connect("localhost","root", "", "menufi");
	$start_date = date('Y-m-d');
	$end_date = date('Y-m-d',strtotime(date('Y-m-d').'+1 day'));
	//echo $start_date;
	$s1 = "SELECT * 
FROM opening_amount WHERE added_date BETWEEN '$start_date' AND '$end_date'
ORDER BY opening_amount_id DESC
LIMIT 1";
//echo $s1;
$res = $conn->query($s1);
$amt = 0;
if(mysqli_num_rows($res)>0){
	$row = $res -> fetch_assoc();
	$amt = $row['opening_amount'];
}



    $s = "SELECT * FROM menu";
    $r = $conn -> query($s);
    $categories = array();
    while($rf = $r -> fetch_assoc()){
        array_push($categories, $rf['Category']);
    }
    $categories = array_unique($categories);
	//echo $latest;
	$ye = 0;


    if(isset($mobno) && isset($tableno)){
        //echo $address;
         //echo $mobno;
        
            $ye = 1;
        
        //$_SESSION['isredirect']=1;
        //header("Location: create_orderH?mobno=$mobno&address=$address&table=-1&CreateOrder=Create+Order");
	}
	$card = 0;
	$online = 0;
	$cash = 0;
	// Pending Cash Order
	$q = $this->db->query("SELECT order_status.Order_id as Order_id,sales.net_total as net_total from order_status ,sales where day(order_status.TIMESTAMP)= day(curdate()) and (order_status.status=3 or order_status.status=1) and sales.Order_id = order_status.Order_id")->result_array();
	$pendingOrders = $q;
	
	$sql3 = "SELECT * FROM payment_details WHERE payment_type ='Card' AND added_date BETWEEN '$start_date' AND '$end_date'";
	$res = $conn -> query($sql3);
	if(mysqli_num_rows($res)>0){
		while($rowcard = $res -> fetch_assoc()){
			$card +=  $rowcard['total_amount'];
		}
	}
	
	
	$sql5 = "SELECT * FROM payment_details WHERE payment_type ='Cash' AND added_date BETWEEN '$start_date' AND '$end_date'";
	$rescash = $conn -> query($sql5);
	if(mysqli_num_rows($rescash)>0){
		while($rowcash = $rescash -> fetch_assoc()){
			$cash +=  $rowcash['total_amount'];
		}
	}
	
	
	$sql4 = "SELECT * FROM payment_details WHERE payment_type ='Online' AND added_date BETWEEN '$start_date' AND '$end_date'";
	$re4 = $conn -> query($sql4);


	
	if(isset($re4)){
		while($rowonline = $re4 -> fetch_assoc()){
			$online +=  $rowonline['total_amount'];
		}
	}

	?>
	

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--<meta http-equiv="refresh" content="5; URL=<?php //echo base_url(); ?>index.php/Admin/dashboard">-->
    <title>Menu Fi</title>

        <!-- Bootstrap Core CSS -->
        <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../../assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../../assets/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../../assets/vendor/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel="shortcut icon" href="../../images/logo/index.png" />

    <style>

    
    </style>
    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" ><p style="color:white;"><img src="../../images/logo/logo-main.png" alt="" srcset=""> Menufi</p></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right" >
                

                 <li class="dropdown" >
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" >
                        <i class="fa fa-bell fa-fw"></i><i class="fa fa-caret-down"></i>

                    </a>
                    <ul class="dropdown-menu dropdown-user" id="order-notify">
                       
                         <li><h5 style="padding-left: 3px; background-color: white">You have <?php echo $countNotifications;   ?> notifications</h5></li>
                         <hr style="padding: 0px; margin: 0px; color: #fff">
                         
                    <?php   foreach($todaysOrders as $order):   ?>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i>
                         <i style="padding-left: 2px;font-size: 2;margin-left: 2px">New Order:<?php echo $order['Order_id'];  ?></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i>
                        <i style="padding-left: 2px;font-size: 2;margin-left: 2px">Table Assistance: <?php echo $order['Table_id'];  ?></i></a>
                        </li>
                    <?php   endforeach; ?>
                    <?php   foreach($preparedList as $prepared):   ?>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i>
                         <i style="padding-left: 2px;font-size: 2;margin-left: 2px">Order Preparation Timeout :<?php echo $prepared['Order_id']; ?> </i></a>
                        </li>
                        
                    <?php   endforeach; ?>

                    <?php   foreach($servedOrders as $order):   ?>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i>
                         <i style="padding-left: 2px;font-size: 2;margin-left: 2px">Order Ready To Serve:<?php echo $order['Order_id']; ?> </i></a>
                        </li>
                        
                    <?php   endforeach; ?>
                   
                    </ul>
                </li>
                    <!-- /.dropdown-user -->


                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                         <li><a href="<?php echo base_url(); ?>index.php/Admin/changePwd"><i class="fa fa-sign-out fa-fw"></i> Change Password</a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>index.php/Admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->	

            <?php include 'nav_links.php'; ?>
            <!-- /.navbar-static-side -->
        
        </nav>

                    
        <div id="page-wrapper">
        
            <div class="row">
                <div class="col-md-12" style="padding-top:20px;">
                <div  style="margin-bottom:30px" class="row">
                <div class="col-md-2 ">
		 			<input id="opening_amount" type="text" name="opening_amount" class="form-control" value="" placeholder="Enter opening amount">
		 		</div>
		 		<div class="col-md-2">
		 			<input id="addOpeningAmt" type="button" name="addOpeningAmt" class="btn btn-success" value="ADD" onclick="addOpeningAmt()">
		 		</div>
		 		<div class="col-md-4 col-sm-offset-2">
		 			<p style="color:white;font-size:16px;">Total Opening Amount : <?php echo $amt; ?> </p>
					 
		 		</div>
                 
                </div>
                    <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-cutlery fa-5x" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $amt ?></div>
                                                <div>Total Cash Amount </div>
                                            </div>
                                        </div>
                                    </div>
                        
                            <div class="panel-footer">
                                <a href="<?php echo base_url(); ?>index.php/Admin/sales_report"><span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x" aria-hidden="true"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php
                                        
                                        echo "Rs ".$card;
                                        ?></div>
                                    <div>Total Card Sales (Today)</div>
                                </div>
                            </div>
                        </div>
                        
                            <div class="panel-footer">
                                <a href="<?php echo base_url(); ?>index.php/Admin/sales_report"><span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-times fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $online;?></div>
                                    <div>Total Online Sales</div>
                                </div>
                            </div>
                        </div>
                        
                            <div class="panel-footer">
                                <a href="<?php echo base_url();?>index.php/Admin/out_of_stock"><span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-thumbs-up fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php
                                    echo $online + $cash + $card; ?></div>
                                    <div>Total Gross Sales</div>
                                </div>
                            </div>
                        </div>
                        
                            <div class="panel-footer">
                                <a href="<?php echo base_url(); ?>index.php/Admin/viewDetailFeedback"><span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                <div class="clearfix"></div>
                            </div>
                        
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12" style="margin-top:-50px;">
                    
                <h1 class="page-header">Table Status</h1>
            <!-- live Order was here -->
            <div class="">
                <?php if(isset($query)){
                        ?>
                    <table style="left:20px;">
                        <tr>
                            <!-- table no: 1 -->
                            <td style="padding: 3px 3px 3px 3px" >
                                <?php $com=NULL;$sts1=0; foreach($query as $val){ 
                                                    if($val['status']==4){
                                                        continue;
                                                    }
                                                    else{
                                                        if($val['tid'] == 1){
                                                            if($val['status']== 1 || $val['status']== 2){
                                                                $com ="-danger"; 
                                                            }elseif($val['status']== 3){
                                                                $com ="-success";
                                                                $sts1 = 3;
                                                            }else{
                                                                $com ="-info";
                                                            } 
                                                        }
                                                    } 
                                                }
                                ?>
                                <?php foreach($query as $val){ 
                                                if($val['tid'] == 1 && ($val['status'] != 4)){ 
                                                    $oid1 = $val['oid']; 
                                                     
                                                } 
                                            }?>
                                <a href="<?php if(isset($oid1)){ echo base_url('index.php/Admin/searchD?oid='.$oid1.'');}else if(isset($sts1)){ if($sts1==0){ echo base_url('index.php/Admin/DineIn?tid=1'); }else if($sts1==3){echo base_url('index.php/Admin/cashOrder');} }?>">  
                                <button type="button" style="height: 125px;width: 125px;" class="btn btn<?php if($com == NULL){echo '-info';}else{echo $com;}?>">
                                
                                <div style="margin: 5px 22px 5px 22px;">
                                    <h3>1 <?php if(isset($sts1)){ if($sts1 == 0){ } }?></h3><hr>
                                    <h4><?php if(isset($oid1)){ echo $oid1.' '; }?>
                                    </h4>
                                </div>
                                </button>
                                </a>
                            </td>
                            <!-- table 1 end -->
                            <!-- table no: 2 -->
                            <td style="padding: 3px 3px 3px 3px" >
                                <?php $com=NULL;$sts2=0;foreach($query as $val){ 
                                                    if($val['status']==4){
                                                        continue;
                                                    }
                                                    else{
                                                        if($val['tid'] == 2){
                                                            if($val['status']== 1 || $val['status']== 2){
                                                                $com ="-danger"; 
                                                            }elseif($val['status']== 3){
                                                                $com ="-success";
                                                                $sts2 = 3;
                                                            }else{
                                                                $com ="-info";
                                                            } 
                                                        }
                                                    } 
                                                }
                                ?><?php foreach($query as $val){ 
                                                if($val['tid'] == 2 && ($val['status'] != 4)){ 
                                                    $oid2 = $val['oid']; 
                                                } 
                                            }?>
                                <a href="<?php if(isset($oid2)){ echo base_url('index.php/Admin/searchD?oid='.$oid2.'');}else if(isset($sts2)){ if($sts2==0){ echo base_url('index.php/Admin/DineIn?tid=2'); }else if($sts2==3){echo base_url('index.php/Admin/cashOrder');} }?>">  
                                <button type="button" style="height: 125px;width: 125px;" class="btn btn<?php if($com == NULL){echo '-info';}else{echo $com;}?>">
                                
                                <div style="margin: 5px 22px 5px 22px;">
                                    <h3>2</h3><hr>
                                    <h4><?php if(isset($oid2)){ echo $oid2.' '; }?>
                                    </h4>
                                </div>
                                </button>
                                </a>
                            </td>
                            <!-- table 2 end -->
                            <!-- table no: 3 -->
                            <td style="padding: 3px 3px 3px 3px" >
                                <?php $com=NULL;$sts3=0;foreach($query as $val){ 
                                                    if($val['status']==4){
                                                        continue;
                                                    }
                                                    else{
                                                        if($val['tid'] == 3){
                                                            if($val['status']== 1 || $val['status']== 2){
                                                                $com ="-danger"; 
                                                            }elseif($val['status']== 3){
                                                                $com ="-success";
                                                                $sts3 = 3;
                                                            }else{
                                                                $com ="-info";
                                                            } 
                                                        }
                                                    } 
                                                }
                                ?><?php foreach($query as $val){ 
                                                if($val['tid'] == 3 && ($val['status'] != 4)){ 
                                                    $oid3 = $val['oid']; 
                                                } 
                                            }?>
                                <a href="<?php if(isset($oid3)){ echo base_url('index.php/Admin/searchD?oid='.$oid3.'');}else if(isset($sts3)){ if($sts3==0){ echo base_url('index.php/Admin/DineIn?tid=3'); }else if($sts3==3){echo base_url('index.php/Admin/cashOrder');} }?>">  
                                <button type="button" style="height: 125px;width: 125px;" class="btn btn<?php if($com == NULL){echo '-info';}else{echo $com;}?>">
                                
                                <div style="margin: 5px 22px 5px 22px;">
                                    <h3>3</h3><hr>
                                    <h4><?php if(isset($oid3)){ echo $oid3.' '; }?>
                                    </h4>
                                </div>
                                </button>
                                </a>
                            </td>
                            <!-- table 3 end -->
                            <!-- table no: 4 -->
                            <td style="padding: 3px 3px 3px 3px" >
                                <?php $com=NULL;$sts4=0;foreach($query as $val){ 
                                                    if($val['status']==4){
                                                        continue;
                                                    }
                                                    else{
                                                        if($val['tid'] == 4){
                                                            if($val['status']== 1 || $val['status']== 2){
                                                                $com ="-danger"; 
                                                            }elseif($val['status']== 3){
                                                                $com ="-success";
                                                                $sts4 = 3;
                                                            }else{
                                                                $com ="-info";
                                                            } 
                                                        }
                                                    } 
                                                }
                                ?><?php foreach($query as $val){ 
                                                if($val['tid'] == 4 && ($val['status'] != 4)){ 
                                                    $oid4 = $val['oid']; 
                                                } 
                                            }?>
                                <a href="<?php if(isset($oid4)){ echo base_url('index.php/Admin/searchD?oid='.$oid4.'');}else if(isset($sts4)){ if($sts4==0){ echo base_url('index.php/Admin/DineIn?tid=4'); }else if($sts4==3){echo base_url('index.php/Admin/cashOrder');} }?>">  
                                <button type="button" style="height: 125px;width: 125px;" class="btn btn<?php if($com == NULL){echo '-info';}else{echo $com;}?>">
                                
                                <div style="margin: 5px 22px 5px 22px;">
                                    <h3>4</h3><hr>
                                    <h4><?php if(isset($oid4)){ echo $oid4.' '; }?>
                                    </h4>
                                </div>
                                </button>
                                </a>
                            </td>
                            <!-- table 4 end -->
                            <!-- table no: 5 -->
                            <td style="padding: 3px 3px 3px 3px" >
                                <?php $com=NULL;$sts5=0;foreach($query as $val){ 
                                                    if($val['status']==4){
                                                        continue;
                                                    }
                                                    else{
                                                        if($val['tid'] == 5){
                                                            if($val['status']== 1 || $val['status']== 2){
                                                                $com ="-danger"; 
                                                            }elseif($val['status']== 3){
                                                                $com ="-success";
                                                                $sts5 = 3;
                                                            }else{
                                                                $com ="-info";
                                                            } 
                                                        }
                                                    } 
                                                }
                                ?><?php foreach($query as $val){ 
                                                if($val['tid'] == 5 && ($val['status'] != 4)){ 
                                                    $oid5 = $val['oid']; 
                                                } 
                                            }?>
                                <a href="<?php if(isset($oid5)){ echo base_url('index.php/Admin/searchD?oid='.$oid5.'');}else if(isset($sts5)){ if($sts5==0){ echo base_url('index.php/Admin/DineIn?tid=5'); }else if($sts5==3){echo base_url('index.php/Admin/cashOrder');} }?>">  
                                <button type="button" style="height: 125px;width: 125px;" class="btn btn<?php if($com == NULL){echo '-info';}else{echo $com;}?>">
                                
                                <div style="margin: 5px 22px 5px 22px;">
                                    <h3>5</h3><hr>
                                    <h4><?php if(isset($oid5)){ echo $oid5.' '; }?>
                                    </h4>
                                </div>
                                </button>
                                </a>
                            </td>
                            <!-- table 5 end -->
                            <!-- table no: 6 -->
                            <td style="padding: 3px 3px 3px 3px" >
                                <?php $com=NULL;$sts6=0;foreach($query as $val){ 
                                                    if($val['status']==4){
                                                        continue;
                                                    }
                                                    else{
                                                        if($val['tid'] == 6){
                                                            if($val['status']== 1 || $val['status']== 2){
                                                                $com ="-danger"; 
                                                            }elseif($val['status']== 3){
                                                                $com ="-success";
                                                                $sts6 = 3;
                                                            }else{
                                                                $com ="-info";
                                                            } 
                                                        }
                                                    } 
                                                }
                                ?><?php foreach($query as $val){ 
                                                if($val['tid'] == 6 && ($val['status'] != 4)){ 
                                                    $oid6 = $val['oid']; 
                                                } 
                                            }?>
                                <a href="<?php if(isset($oid6)){ echo base_url('index.php/Admin/searchD?oid='.$oid6.'');}else if(isset($sts6)){ if($sts6==0){ echo base_url('index.php/Admin/DineIn?tid=6'); }else if($sts6==3){echo base_url('index.php/Admin/cashOrder');} }?>">  
                                <button type="button" style="height: 125px;width: 125px;" class="btn btn<?php if($com == NULL){echo '-info';}else{echo $com;}?>">
                                
                                <div style="margin: 5px 22px 5px 22px;">
                                    <h3>6</h3><hr>
                                    <h4><?php if(isset($oid6)){ echo $oid6.' '; }?>
                                    </h4>
                                </div>
                                </button>
                                </a>
                            </td>
                            <!-- table 6 end -->
                            <!-- table no: 7 -->
                            <td style="padding: 3px 3px 3px 3px" >
                                <?php $com=NULL;$sts7=0;foreach($query as $val){ 
                                                    if($val['status']==4){
                                                        continue;
                                                    }
                                                    else{
                                                        if($val['tid'] == 7){
                                                            if($val['status']== 1 || $val['status']== 2){
                                                                $com ="-danger"; 
                                                            }elseif($val['status']== 3){
                                                                $com ="-success";
                                                                $sts7 = 3;
                                                            }else{
                                                                $com ="-info";
                                                            } 
                                                        }
                                                    } 
                                                }
                                ?><?php foreach($query as $val){ 
                                                if($val['tid'] == 7 && ($val['status'] != 4)){ 
                                                    $oid2 = $val['oid']; 
                                                } 
                                            }?>
                                <a href="<?php if(isset($oid7)){ echo base_url('index.php/Admin/searchD?oid='.$oid7.'');}else if(isset($sts7)){ if($sts7==0){ echo base_url('index.php/Admin/DineIn?tid=7'); }else if($sts7==3){echo base_url('index.php/Admin/cashOrder');} }?>">  
                                <button type="button" style="height: 125px;width: 125px;" class="btn btn<?php if($com == NULL){echo '-info';}else{echo $com;}?>">
                                
                                <div style="margin: 5px 22px 5px 22px;">
                                    <h3>7</h3><hr>
                                    <h4><?php if(isset($oid7)){ echo $oid7.' '; }?>
                                    </h4>
                                </div>
                                </button>
                                </a>
                            </td>
                            <!-- table 7 end -->
                            <!-- table no: 8 -->
                            <td style="padding: 3px 3px 3px 3px" >
                                <?php $com=NULL;$sts8=0;foreach($query as $val){ 
                                                    if($val['status']==4){
                                                        continue;
                                                    }
                                                    else{
                                                        if($val['tid'] == 8){
                                                            if($val['status']== 1 || $val['status']== 2){
                                                                $com ="-danger"; 
                                                            }elseif($val['status']== 3){
                                                                $com ="-success";
                                                                $sts8 = 3;
                                                            }else{
                                                                $com ="-info";
                                                            } 
                                                        }
                                                    } 
                                                }
                                ?><?php foreach($query as $val){ 
                                                if($val['tid'] == 8 && ($val['status'] != 4)){ 
                                                    $oid8 = $val['oid']; 
                                                } 
                                            }?>
                                <a href="<?php if(isset($oid8)){ echo base_url('index.php/Admin/searchD?oid='.$oid8.'');}else if(isset($sts8)){ if($sts8==0){ echo base_url('index.php/Admin/DineIn?tid=8'); }else if($sts8==3){echo base_url('index.php/Admin/cashOrder');} }?>">  
                                <button type="button" style="height: 125px;width: 125px;" class="btn btn<?php if($com == NULL){echo '-info';}else{echo $com;}?>">
                                
                                <div style="margin: 5px 22px 5px 22px;">
                                    <h3>8</h3><hr>
                                    <h4><?php if(isset($oid8)){ echo $oid8.' '; }?>
                                    </h4>
                                </div>
                                </button>
                                </a>
                            </td>
                            <!-- table 8 end -->
                        </tr>

                    </table>
                    <br><br><br><br>
                <?php }?>
            </div>
        </div>

        
    </div>
    
    <!-- jQuery -->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../assets/vendor/raphael/raphael.min.js"></script>
    <script src="../../assets/vendor/morrisjs/morris.min.js"></script>
    <script src="../../assets/data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../assets/dist/js/sb-admin-2.js"></script>
     <script>
  /* When the user clicks on the button,
  toggle between hiding and showing the dropdown content */
  function myFunction() {
      document.getElementById("page-header").classList.toggle("show");
  }

  
  </script>

	<!-- Refreshing the table view after each 5 seconds-->
	<script>
	$(document).ready(function(){
		setInterval(checkLiveOrder,(5*1000));
        setInterval(liveNotification,5000);
	});
	function checkLiveOrder(){
		$.ajax({
			url: "<?php echo base_url();?>index.php/Admin/check_live_order",
			success: function(data){
				if(data!=2 && data!=3)
				$("#live_order .table-responsive").html(data);
				else
				$("#live_order .table-responsive").html("");
			}
		});
	}

    function liveNotification(){
        $.ajax({
			url: "<?php echo base_url();?>index.php/Admin/ajax_notify",
            method:"GET",
            dataType:"json",
			success: function(data){
				console.log(data);
                var popup = document.getElementById("order-notify");
                popup.innerHTML="";
                
                popup.innerHTML+=`<li><h5 style="padding-left: 3px; background-color: white">You have `+data.countNotifications+` notifications</h5></li>
                         <hr style="padding: 0px; margin: 0px; color: #fff">`;
                         
                    data.todaysOrders.forEach(function(obj){
                        popup.innerHTML+=`<li><a href="#"><i class="fa fa-sign-out fa-fw"></i>
                         <i style="padding-left: 2px;font-size: 2;margin-left: 2px">New Order:`+obj.Order_id+`</i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i>
                        <i style="padding-left: 2px;font-size: 2;margin-left: 2px">Table Assistance: `+obj.Table_id+`</i></a>
                        </li>`;
                    });
                        
                
                    data.preparedList.forEach(function(obj){
                        popup.innerHTML+=`<li><a href="#"><i class="fa fa-sign-out fa-fw"></i>
                         <i style="padding-left: 2px;font-size: 2;margin-left: 2px">Order Preparation Timeout :`+obj.Order_id+` </i></a>
                        </li>`;

                    });
                        
                    

                    data.servedOrders.forEach(function(obj){
                        popup.innerHTML+=`<li><a href="#"><i class="fa fa-sign-out fa-fw"></i>
                         <i style="padding-left: 2px;font-size: 2;margin-left: 2px">Order Ready To Serve:`+obj.Order_id+` </i></a>
                        </li>`;
                    });        
                
			}
		});
    }

	</script>
	<script>
	/* When the user clicks on the button, 
	toggle between hiding and showing the dropdown content */
	function myFunction() {
	    document.getElementById("myDropdown").classList.toggle("show");
	}

	// Close the dropdown if the user clicks outside of it
	window.onclick = function(event) {
	  if (!event.target.matches('.dropbtn')) {

	    var dropdowns = document.getElementsByClassName("dropdown-content");
	    var i;
	    for (i = 0; i < dropdowns.length; i++) {
	      var openDropdown = dropdowns[i];
	      if (openDropdown.classList.contains('show')) {
	        openDropdown.classList.remove('show');
	      }
	    }
	  }
	}

    		function addOpeningAmt(){
			var opening_amount = $('#opening_amount').val();
			if(opening_amount !=""){
				$.ajax({
					type: 'GET',
					dataType: "json",
					url: '<?php echo base_url(); ?>index.php/Admin/addOpeningAmt',
					data:{
						'opening_amount':opening_amount
					},
					//cache:false,
					success: function(resp){
						if(resp==1){
							alert('Opening amount added successfully!');
							location.reload();
						}else{
							alert('Opening amount not added!');
						}	
					}

				});
			}			
			
		} 
	</script>

	
</body>

</html>