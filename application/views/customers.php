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
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Menu Fi</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
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
                <div class="col-lg-12">
                    <h1 class="page-header">Customer Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <?php
            
            ?>
            
            <!-- /.row -->
            <div class="row" id="outOfStock">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Most Ordered Item by Customer (Account Type: Mobile)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Mobile No.</th>
                                        <th>Item Name</th>
                                        <th>Number Of Visits</th>
                                        <th>Last Visited</th>
                                    </tr>
                                    <?php 
                                    if(isset($cust_details_mobile) && !empty($cust_details_mobile)){
                                        $i=1;
                                        foreach ($cust_details_mobile as $value) {
                                            
                                          
                                        ?>
                                     <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $value->Mobile;?></td>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo $value->views; ?></td>
                                        <td><?php echo $value->Last_Visited; ?></td>
                                    </tr> 
                                    
                                    <?php $i++;}
                                    
                                        }
                                    else{
                                            
                                            echo 'Data not available at this moment.';
                                        }
                                    ?>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <!--
                <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Most Ordered Item by Customer (Account Type: Google)
                        </div>
                        <!-- /.panel-heading 
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Mobile No.</th>
                                        <th>Item Name</th>
										<th>Last Visited</th>
                                        <th>Number Of Visits</th>
                                        
                                    </tr><!--
                                    <?php 
                                    if(isset($cust_details_google) && !empty($cust_details_google)){
                                        $i=1;
                                        foreach ($cust_details_google as $value) {
                                            
                                          
                                        ?>
                                     <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $value->Email;?></td>
                                        <td><?php echo $value->name; ?></td>
                                         <td><?php echo $value->Last_Visited; ?></td>
                                        <td><?php echo $value->Number_of_visits; ?></td>
                                    </tr> 
                                    
                                    <?php $i++;}
                                    
                                        }
                                        else{
                                            
                                            echo 'Data not available at this moment.';
                                        }
                                    
                                    ?>
                                </table>
                            </div>
                            <!-- /.table-responsive 
                        </div>
                        <!-- /.panel-body 
                    </div>
                          
                </div> -->
                <!-- /.col-lg-6 -->
            </div>
            
            
            <h1><br><br><br><br></h1>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

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

</body>

</html>
