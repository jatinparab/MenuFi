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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
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

            <ul style="z-index:999;"  class="nav navbar-top-links navbar-right" >
                

            
                    <!-- /.dropdown-user -->


                <li class="dropdown">
                    <a style="z-index:999;" class="dropdown-toggle"  href="<?php echo base_url(); ?>index.php/Admin/tableStatus" >
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
                <!-- /.navbar-top-links -->

                <?php include 'nav_links.php'; ?>
                <!-- /.navbar-static-side -->
            </nav>

            <div  id="page-wrapper">

            <div class="row">
            <div class="col-lg-12" style="margin-top:10px">
                <div class="col-md-2 ">
                    <input id="opening_amount" type="text" name="opening_amount" class="form-control" value="" placeholder="Enter opening amount">
                </div>
                <div class="col-md-2">
                    <input id="addOpeningAmt" type="button" name="addOpeningAmt" class="btn btn-success" value="ADD" onclick="addOpeningAmt()">
                </div>
                <div class="col-md-3 col-sm-offset-2">
                    <p style="color:white;font-size:16px;">Total Opening Amount : <?php echo $amt; ?> </p>
                     
                </div>

                 <div class="col-md-2">
                    <p style="color:white;font-size:16px;">Total Card Sales : <?php echo $card; ?> </p>
                     
                </div>
            </div>
            <div class="col-lg-12">
                
                <div class="col-md-3 col-sm-offset-6">
                     <p style="color:white;font-size:16px;">Total Cash Amount : <?php 
                     
                     echo $cash; ?> </p>
                </div>
                 <div class="col-md-3 ">
                     <p style="color:white;font-size:16px;">Total Online Sales : <?php 
                     
                     
                     echo  $online; ?> </p>
                </div>
            </div>
            <div class="col-lg-12">
                
                <div class="col-md-3 col-sm-offset-6">
                    <p style="color:white;font-size:16px;">Total Drawer Amount : <?php echo $amt + $cash; ?></p>
                </div>
                 <div class="col-md-3">
                    <p style="color:white;font-size:16px;">Total Gross Sales : <?php echo $online + $cash + $card; ?></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if(!(isset($_SESSION['order_id']))){ ?>
            
            <div class="col-sm-3 pull-right" style="padding-top:30px;padding-bottom:30px;">
            <br>
            <div class="col-sm-12">

            <a href="<?php echo base_url('index.php/Admin/DineIn'); ?>" style="font-size:15px;width:150px;text-align:center;margin-left:10px;margin-top:0px;" class="btn btn-info btn-lg">Dine In</a>
            </div>
            <br>
            <div class="col-sm-12">

            <a href="<?php echo base_url('index.php/Admin/TakeAway'); ?>" style="font-size:15px;width:150px;text-align:center;margin-left:10px;margin-top:20px;" class="btn btn-info btn-lg">Take Away</a>
            </div>
            <br>

            <div class="col-sm-12">

            <a href="<?php echo base_url('index.php/Admin/HomeDelivery'); ?>" style="font-size:15px;width:150px;text-align:center;margin-left:10px;margin-top:20px;" class="btn btn-info btn-lg">Home Delivery</a>
            </div>
                                        </div>
            <?php } ?>

                <div class="col-lg-9">
                    <h1 class="page-header">Manual Order</h1>
                    <div class="form-body" >
                       <!-- JAVASCRIPT ADD ITEM TO ORDER CONTENT WILL BE HERE -->
                        <?php if(!isset($orderid)){ ?>
                        <div class="col-lg-5" style="color: white">
                            <form method="post" action="create_orderH">
                                <div class="form-group">Mobile No.
                                    <input pattern="[7-9]{1}[0-9]{9}" id="nu" oninput='getAddress(this.value)' type="text" name="mobno" class="form-control" required>
                                </div>
                                <div class="form-group">Name 
                                    <input  id="nameee" type="text" name="nameee" class="form-control" required>
                                </div>
                                <div class="form-group">Address
                                    <textarea id="addressfield" type="text" name="address" class="form-control" required></textarea>
                                </div>
                                <br> 
                                <input name="table" value="-1" class="hidden">
                                <div class="form-group">
                                    <input class="form-control" id="some" type="submit" name="CreateOrder" class="form-control" value="Create Order"><br>
                                </div>
                            </form>
                        </div>
                        <?php }
                        else{?>
                        <div class="col-md-12">
                        <div class="col-lg-6">
                                <div>
                                    <h4 style="color:white;"><?php $oid=$orderid; echo "Order No.:".$oid;?></h4>
                                    <h4 style="color: white"> Search Menu Item</h4>
                                    <form method="post" action="searchH">
                                        <input name="search" class="form-control" id="search"><br>
                                        <input type="submit" value="Search" class="form-control" />
                                    </form>
                                </div>
                                <br><hr><br>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        Menu
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Menu Id</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th>Quantity</th>
                                                    <th>Add Item</th>
                                                </tr>
                                                <?php 
                                                if(isset($query2) && !empty($query2)){
                                                    foreach ($query2 as $value) {
                                                ?>
                                                <tr>
                                                <form action="addfakeH" method="post">
                                                    <td><input type="text" name="Menu_id" class="form-control" value='<?php echo $value['Menu_Id'];?>'></td>
                                                    <td><?php echo $value['Name']; ?></td>
                                                    <td><?php echo $value['Category'];?></td>
                                                    <td><input type="number" name="quantity" class="form-control"></td>
                                                    <td><input type="submit" name='add' value="Add Item" class="btn btn-primary"></td>
                                                </form>
                                                </tr> 
                                                
                                                <?php }
                                                
                                                }
                                                else{                
                                                        echo 'Data not available at this moment.';
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div align="center">
                                    <div class="panel panel-info" style="color:black;">
                                        <div class="panel panel-primary panel-heading">ORDER(Set Quantity Zero to Remove)</div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                            <form action="complete_orderH" method="post">
                                                <table class="table table-bordered">
                                                <tr>
                                                    <th>Item ID</th>
                                                    <th>Item Name</th>
                                                    <th class="col-md-4">Quantity</th>
                                                
                                                </tr>
                                                <?php 
                                                if(isset($fake) && !empty($fake)){
                                                    foreach ($fake as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $value['Menu_id']; ?><input type="hidden" name="Menu_id[]" value="<?php echo $value['Menu_id']?>" class="form-control"></td>
                                                    <td><?php echo $value['name']; ?><input type="hidden" name="name[]" value="<?php echo $value['name']?>" class="form-control"></td>
                                                    <td><div class="input-group">
                                                            <input type="number" id="quantity" name="quantity[]" class="form-control input-number" value="<?php echo $value['quantity']?>" min="0" max="100">
                                                        </div></td>
                                                </tr>
                                                    <?php }
                                                }else{
                                                    echo "No Item added Yet";
                                                }?>
                                                
                                                </table>
                                                <button type="submit" name="place_order" class="form-control btn btn-success">Place Order</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <br>
      
        <br><br><br>

    </div>
    <!-- /#wrapper -->

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
        function getAddress(mobile){
            $.ajax({
            type: "GET",
            contentType: "application/json; charset=utf-8",
            url: "ajax_Mobile",
            data: {
                'mobile':mobile
            },
            success: function (result) {
                $('#addressfield').val(result);
            }
        });
        }
        if(<?php echo $ye ?>){
            $('#addressfield').val('<?php if(isset($address)){
                echo $address;
            } ?>');
            $('#nameee').val('<?php if(isset($address)){
                echo $nameee;
            } ?>');
            $('#nu').val('<?php if(isset($mobno)){
                echo $mobno;
            } ?>'); 
            $('#some').click();
        }   
    
    </script>

</body>
</html>
