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
                                                <i class="fa fa-money fa-5x" aria-hidden="true"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $cash ?></div>
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
                                    <i class="fa fa-line-chart fa-5x" aria-hidden="true"></i>
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
                                    <i class="fa fa-wifi fa-5x"></i>
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
                                    <i class="fa fa-pie-chart fa-5x"></i>
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
        <br>
        <br>

     <div class="row" id="div_offlineOrders">
                <?php if(!empty($pendingOrders)){
					//print_r($pendingOrders);
                                     foreach ($pendingOrders as $value) {
//    echo '<option value="'.$value["id"].'">'.$value['Order_id'].'</option>';
                                     
						$idr = $value['Order_id'];
						$sss = "SELECT * FROM orders WHERE Order_id='$idr'";
						$re1 = $conn ->query($sss);
						$rew = $re1 -> fetch_assoc();
						if($rew['Table_id'] == '-1'){
							$table_no = 'Home Delivery';
						}else if($rew['Table_id'] == '99'){
							$table_no = 'Take Away';
						}else{
							$table_no = "Table No: ".$rew['Table_id'];
						}
                        $sq3 = "SELECT * FROM customer_order WHERE Order_id='$idr'";
						$ress = $conn -> query($sq3);
						
                        // print_r($ress);
                        if(mysqli_num_rows($ress) == 0 ){
                            continue;
                        }
                                        ?>  
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-12" >
                                    <input type="hidden" name="id" value="<?php echo $value['Order_id'];?>">
                                    <span id="printspan<?php echo $value['Order_id']; ?>">
									<i class="fa fa-times fa-2x pull-right" onclick="deleteOrderPayment(<?php echo $value['Order_id']; ?>)" aria-hidden="true"></i>
                                    <h3 class="text-center">Order No.<?php echo $value['Order_id']; ?></h3>
									<p style="font-size:20px" class="text-center"><?php echo $table_no; ?></p>
                                    <?php while($raw = $ress -> fetch_assoc()){
										$cust_id = $raw['customer_id']; ?>
                    <p><strong ><?php 
                        //print_r($raw);
                        $q = $raw['Quantity'];
                        echo $raw['Quantity']." x "; ?>
                        
                    </strong>
                    <?php
                            $mid = $raw['Menu_Id'];
                            $sq4 = "SELECT * FROM menu WHERE Menu_Id='$mid'";
                            $ra = $conn -> query($sq4);
                            $rs = $ra -> fetch_assoc();    
							echo $rs['Name'].": ".($q*$rs['Price']); 
							if($table_no == 'Home Delivery'){
								$cid = $raw['customer_id'];
                            $sq5 = "SELECT * FROM customers WHERE customer_id='$cid'";
                            $rr = $conn -> query($sq5);
                            $rf = $rr -> fetch_assoc();
                            $mob = $rf['mobile'];
                            $sq6 = "SELECT * FROM addresses WHERE mobile='$mob'";
                            $rg = $conn -> query($sq6);
                            $rk = $rg -> fetch_assoc();
                            $add = $rk['address'];
							$name = $rk['name'];
							$number = $mob;

								
							}
							
                            ?>
								<i class="fa fa-times  fa-1x" style='color:red' onclick="deleteOrderItem(<?php echo $raw['id']; ?>)" aria-hidden="true"></i>
                </p>								

                        <?php } ?>
                        <p><strong>CGST: </strong><?php 
                    
                    $sq = "SELECT * FROM sales WHERE Order_id='$idr'";
                    $r = $conn -> query($sq);
                    $r2 = $r -> fetch_assoc();
                    
                    echo $r2['cgst']; ?></p>
                    <p><strong>SGST: </strong><?php echo $r2['sgst']; ?></p>
                                    <h4>Bill Amount :<?php echo $value['net_total'];
                                        if($r2['coupon_apply']){
                                            echo "<br><small> (coupon applied)</small>";
                                        }
                                    
                                    ?>
                    <a style="margin-left:20px;" href="<?php echo base_url(); ?>index.php/Admin/searchD?oid=<?php echo $idr."&"; ?>customer_id=<?php echo $cust_id; ?>"  class="btn btn-info">Add</a>

                                        
                                </h4>
								<?php if($table_no == 'Home Delivery'){ ?>
								<p><strong>Name:</strong> <?php if(isset($name)){echo $name;} ?><br><br>
								<strong>Number:</strong> <?php if(isset($number)){echo $number;} ?>	<br><br>
                	    <strong>Address:</strong> <?php if(isset($add)){echo $add;} ?>
								<?php } ?>
                    </p>

                                    </span>
                                    <?php
                                        if(!$r2['coupon_apply']){
                                    ?>
                                    <input id="code" class="form-control" placeholder="Coupon Code" >
                                    <br>
                                    <input type="submit" value="Apply Coupon" class="btn btn-success form-control" onclick="apply_code('<?php echo $idr; ?>')" >
                                    <br>
                                    <?php 
                                        }
                                    ?>
                                    <div>
                                        <br>
                                        <input type="submit" value="Pay" class="btn btn-success form-control" 
										<?php if($table_no == 'Home Delivery'){ ?>
											onclick="showModal('<?php echo $idr; ?>','<?php echo $table_no ?>');print_home('<?php echo $idr; ?>','<?php if(isset($add)){echo $add;}?>','<?php if(isset($name)){echo $name;} ?>','<?php
											if(isset($number)){echo $number;} ?>');"
										<?php }else{ ?>
										onclick="showModal('<?php echo $idr; ?>','<?php echo $table_no ?>');" 
										
										<?php } ?>
										>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                            
                        
                    </div>
                </div>
            </div>

                <?php
                }
                                  }
                                  
                                  else{
                                      echo '<div class="col-lg-12">No Offline Orders.</div>';
                                  }
?>
                                        



<div class="col-sm-4" style="margin-bottom:2%;">

<a href="<?php echo base_url('index.php/Admin/DineIn'); ?>" class="btn btn-info btn-lg" style="font-size:15px;width:150px">Dine In</a>
</div>
<div class="col-sm-4" style="margin-bottom:2%;">

<a href="<?php echo base_url('index.php/Admin/TakeAway'); ?>"  class="btn btn-info btn-lg" style="font-size:15px;width:150px">Take Away</a>
</div>

<div class="col-sm-4" style="margin-bottom:2%;">

<a href="<?php echo base_url('index.php/Admin/HomeDelivery'); ?>"  class="btn btn-info btn-lg" style="font-size:15px;width:150px">Home Delivery</a>
</div>

        
    </div>
    <br>
    <br>
    <!-- jQuery -->
    <div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="mySmallModalLabel">Payment</h4>
                        <input class="hidden" id="modal_oid">
				</div>
				<form action="">
					<div class="modal-body">
						<div class="form-group">
						  	<label for="email">Payment Type:</label>
						 	<select class="form-control" name="payment_type" id="payment_type">
						 		<option value="">Select Payment Type</option>
								<option value="Cash">Cash</option>
								<option value="Card">Card</option>
								<option value="Online">Online</option>
							</select>
						</div>
						<div id="cash_div" style="display: none;">
							<div class="form-group">
							  <label for="pwd">Given Amount:</label>
							  <input type="text" class="form-control" oninput="getReturnAmount()" id="given_amount" placeholder="Enter Given Amount" name="given_amount" onblur="getReturnAmount()">
							</div>
							<div class="form-group">
							  <label for="pwd">Return Amount:</label>
							  <input type="text" class="form-control" id="return_amount" placeholder="Enter Return Amount" name="return_amount">
							</div>
						</div>			
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" id="subp" class="btn btn-primary" >Submit</button>
					</div>
				</form>	
			</div>
		</div>
	</div>
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
    
    function changeBatter(id,item){
    batter_id = item;
    console.log(id,batter_id);
    $.ajax({
                type: 'GET',
                url: 'changeBatter_ajax',
                data:{
                    'id':id,
                    'batter_id': batter_id
                },
                cache:false,
                
                success: function(resp){
                   // console.log(resp);
				  if(resp == 'success'){
                      get_fake_order();
                  }
					
            }
        });
}

function addAddon(id,item){
    $.ajax({
                type: 'GET',
                url: 'addAddon_ajax',
                data:{
                    'id':id,
                    'addon_id':item
                },
                cache:false,
                
                success: function(resp){
                   // console.log(resp);
				  if(resp == 'success'){
                      get_fake_order();
                  }
					
            }
    });
}

function removeAddon(id){
    $.ajax({
                type: 'GET',
                url: 'removeAddon_ajax',
                data:{
                    'id':id
                },
                cache:false,
                
                success: function(resp){
                   // console.log(resp);
				  if(resp == 'success'){
                      get_fake_order();
                  }
					
            }
    });
}

function deleteOrderPayment(id){
    $.ajax({
                type: 'GET',
                url: 'ajax_deletepayment',
                data:{
                    'id':id,
                  
                },
                cache:false,
                
                success: function(resp){
                   // console.log(resp);
				  if(resp == 'success'){
                      window.location = '';
                  }
					
            }
        });

}

function addItem(id,customer_id){
  //  alert('ehe');
    $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>index.php/Admin/addItem_ajax',
                data : {
                    'id':id,
                    'customer_id': customer_id
                },
                cache:false,
                dataType:'html',
                success: function(resp){
                    get_fake_order();
            }
        });

}

function kotprint(id){
  //  alert('print kot');

	             var printWindow = window.open('', '', 'height=300,width=600');

    //             printWindow.document.write(`<html><head><style>@page {
    //                 size: 3in 3.6in;
    // margin: 30%
    // }
    // </style><title></title>`);
    //             printWindow.document.write('</head><body style="height:100px;width:300px;">');
    //             printWindow.document.write(divContents);
    //             printWindow.document.write('</body></html>');
    //             printWindow.document.close();
             $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>index.php/Admin/printkot',
                data : {
                    'id':id
                },
                cache:false,
                dataType:'html',
                success: function(resp){
                    printWindow.document.write(resp);
                    printWindow.print();
            }
            });
}

function getOfflineOrders(){
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/Admin/ajx_cashOrders',
                
                cache:false,
                dataType:'html',
                success: function(resp){
                    $('#div_offlineOrders').html(resp);

            }
            });
        }

function get_fake_order(){
    $.ajax({
                type: 'GET',
                url: 'getFake',
                
                cache:false,
                
                success: function(resp){
                    $('#fakeOrder_here').html(resp);
            }
            });
}

        function apply_code(id){
			
            let code = $('#code').val();
            $.ajax({
                type: 'GET',
                url: 'ajax_applyCode',
                data:{
                    'id':id,
                    'code':code
                },
                cache:false,
                
                success: function(resp){
                    if(resp=='success'){
                        alert('Applied Coupon!');
                        window.location = '';
                    }else{
                        alert(resp);
                    }

            }
            });

        }

        function showModal(id,table){
    $('#modal_oid').val(id);
   // $('#modal_table').val(table);
   if(table=='Home Delivery'){
    document.getElementById("subp").addEventListener("click", call_home);
   }else{
    document.getElementById("subp").addEventListener("click", call);

   }
    $('#addPaymentModal').modal('show');
    $('#given_amount').val('');
    $('#return_amount').val('');
    console.log(id);
}

        function showModal_Home(id){
    $('#modal_oid').val(id);
    $('#addPaymentModal').modal('show');
    $('#given_amount').val('');
    $('#return_amount').val('');
    console.log(id);
}

function print_home(id,address,name,number){
           // var divContents = $("#printspan"+id).html();
               var printWindow = window.open('', '', 'height=300,width=600');
    //             printWindow.document.write(`<html><head><style>@page {
    //                 size: 3in 3.6in;
    // margin: 30%
    // }
    // </style><title></title>`);
    //             printWindow.document.write('</head><body style="height:100px;width:300px;">');
    //             printWindow.document.write(divContents);
    //             printWindow.document.write('</body></html>');
    //             printWindow.document.close();
             $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>index.php/Admin/printafterOrderD',
                data : {
                    'Order_id':id,
                    'name': name,
                    'address': address,
                    'number':number
                },
                cache:false,
                dataType:'html',
                success: function(resp){
                    printWindow.document.write(resp);
                    printWindow.print();

            }
            });
          
        }

		function call_home(){
    let gamt = 0;
    let ramt = 0;
    id = $('#modal_oid').val();
    if($('#given_amount').val()!=''){
        gamt = $('#given_amount').val();    
    }
    if($('#return_amount').val()!=''){
        ramt = $('#return_amount').val();    
    }

    $.ajax({
                type: 'GET',
                url: 'ajax_payitaway',
                data:{
                    'id':id,
                    'type': $('#payment_type').val(),
                    'given_amt':gamt,
                    'return_amt': ramt
                },
                cache:false,
                
                success: function(resp){
                    //console.log(resp);
                    if(resp == 'success'){
                       //sendDelivery(id);
                      pay_it(id);
                     // window.location = '';

                    }

            }
        });
    
    
}

function sendDelivery(id){
    $.ajax({
            type: "GET",
            contentType: "application/json; charset=utf-8",
            url: "ajax_Deliver",
            data: {
                'id':id
            },
            success: function (result) {
                if(result == 'success'){
                    window.location = '';
                }
            }
        });
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


function getReturnAmount(){
	given = $('#given_amount').val();
	id = $('#modal_oid').val();
	$.ajax({
                type: 'GET',
                url: 'ajax_getreturn',
                data:{
                    'id':id,
                    'given':given
                },
                cache:false,
                
                success: function(resp){
                   // console.log(resp);
				   $('#return_amount').val(parseInt(resp));
					
            }
        });

}

function call(){
    let gamt = 0;
    let ramt = 0;
    id = $('#modal_oid').val();
    if($('#given_amount').val()!=''){
        gamt = $('#given_amount').val();    
    }
    if($('#return_amount').val()!=''){
        ramt = $('#return_amount').val();    
    }



    $.ajax({
                type: 'GET',
                url: 'ajax_payitaway',
                data:{
                    'id':id,
                    'type': $('#payment_type').val(),
                    'given_amt':gamt,
                    'return_amt': ramt
                },
                cache:false,
                
                success: function(resp){
                    //console.log(resp);
                    if(resp == 'success'){
                       pay_it(id);
                       print(id);
                       window.location = '';

                    }

            }
        });
    
    
}

function deleteOrderItem(id){
	//console.log(id);
	$.ajax({
                type: 'GET',
                url: 'ajax_deleteorderitem',
                data:{
                    'id':id
                },
                cache:false,
                
                success: function(resp){
                    console.log(resp);
                    if(resp == 'success'){
                        window.location = '';
                    }

            }
            });
}

function pay_it(id){
            $.ajax({
                type: 'GET',
                url: 'ajax_payOrder',
                data:{
                    'id':id
                },
                cache:false,
                
                success: function(resp){
                    console.log(resp);
                    if(resp == 'success'){
                        window.location = '';
                    }

            }
            });

        }

        $(function() {
		    $('#payment_type').change(function(){
		        if($('#payment_type').val() == 'Cash') {
		            $('#cash_div').show(); 
		        } else {
		            $('#cash_div').hide(); 
		        } 
		    });
		});

        
        function getOfflineOrders(){
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/Admin/ajx_cashOrders',
                
                cache:false,
                dataType:'html',
                success: function(resp){
                    $('#div_offlineOrders').html(resp);

            }
            });
        }

        function apply_code(id){
			
            let code = $('#code').val();
            $.ajax({
                type: 'GET',
                url: 'ajax_applyCode',
                data:{
                    'id':id,
                    'code':code
                },
                cache:false,
                
                success: function(resp){
                    if(resp=='success'){
                        alert('Applied Coupon!');
                        window.location = '';
                    }else{
                        alert(resp);
                    }

            }
            });

        }

        function print(id){
           // var divContents = $("#printspan"+id).html();
               var printWindow = window.open('', '', 'height=300,width=600');
    //             printWindow.document.write(`<html><head><style>@page {
    //                 size: 3in 3.6in;
    // margin: 30%
    // }
    // </style><title></title>`);
    //             printWindow.document.write('</head><body style="height:100px;width:300px;">');
    //             printWindow.document.write(divContents);
    //             printWindow.document.write('</body></html>');
    //             printWindow.document.close();
             $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>index.php/Admin/printafterOrder',
                data : {
                    'Order_id':id
                },
                cache:false,
                dataType:'html',
                success: function(resp){
                    printWindow.document.write(resp);
                    printWindow.print();

            }
            });
          
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