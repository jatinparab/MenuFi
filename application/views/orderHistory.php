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

    <link href="<?=base_url()?>assets/datatables1/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/datepicker.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap/css/datepicker3.min.css" rel="stylesheet">

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
                    <h1 class="page-header">Orders History</h1>
                </div>
                <div class="col-lg-12"> 
                <div class="panel panel-danger">
                  <div class="panel-heading">Search</div>
                  <div class="panel-body"> 
                    <form action = "<?=base_url()?>index.php/Admin/orderHistory" method = "post">
                      <div class="row">
                        <div class="col-md-1"><label>From</label></div>
                        <div class="col-md-3">
                          <input type = "text" class = "form-control datepicker"  id = "start_date" name = "start_date" value = "<?php echo $start_date; ?>" placeholder="Start Date">
                        </div>
                        <div class="col-md-1"><label>To</label></div>
                        <div class="col-md-3">
                          <input type = "text" class = "form-control datepicker"  id = "end_date" name = "end_date" value = "<?php echo $end_date; ?>" placeholder="End Date">
                        </div>
                        <div class="col=md-2">
                            <input type = "submit" class = "btn btn-success" value = "Search">
                        </div>
                      </div>    
                    </form>
                  </div>
                </div>
              </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <!-- /.row -->
            <div class="row" id="outOfStock">
                <div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            History
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">

                                    <table id="orderHistory" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Order No.</th>
                                                <th>Order Type</th>
                                                <th>CGST</th>
                                                <th>SGST</th>
                                                <th>Net Total</th>
                                                <th>Payment Type</th>
                                                <th>Customer Mobile</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($pendingOrdershistory)){
                                        //    $pendingOrdershistory = array_unique($pendingOrdershistory);
                                            //print_r($pendingOrdershistory);
                                            $pendingOrdershistory = array_map("unserialize", array_unique(array_map("serialize", $pendingOrdershistory)));

                                             $i=1;
                                             foreach ($pendingOrdershistory as $value) { ?>
                                                <?php if($value['status'] == '4'){$status="Completed";}?>
                                                <tr>
                                                    <td><?=$i?></td>
                                                    <td><?=$value[ 'Order_id' ]?></td>
                                                    <td><?=$value[ 'order_type' ]?></td>
                                                    <td><?=$value[ 'cgst' ]?></td>
                                                    <td><?=$value[ 'sgst' ]?></td>
                                                    <td><?=$value[ 'net_total' ]?></td>
                                                    <td><?=$value[ 'payment_type' ]?></td>
                                                    <td><?=$value[ 'mobile' ]?></td>
                                                    <td><?=$status?></td>
                                                    <td><?=date('d-m-Y h:i:s a', strtotime($value[ 'Timestamp' ]))?></td>
                                                    <td><a data-remote="<?=base_url()?>index.php/Admin/showOrderDetails/<?=$value['Order_id'];?>" data-target="#orderDetails" data-toggle="modal">View</a></td>
                                                </tr>
                                            <?php 
                                                $i++;} }
                                            ?>
                                        </tbody>
                                    </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                
                <!-- /.col-lg-6 -->
            </div>
            
            
            
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div class="modal fade" id = "orderDetails">
        <div class="modal-dialog">
            <div class="modal-content ">
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
    <script src="<?=base_url()?>assets/js/datatables/jquery.dataTables.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function(){
            $( '#orderHistory' ).dataTable();
        });

        $( "#start_date,#end_date" ).datepicker({   
          format: 'dd-mm-yyyy'
      }).on( 'changeDate', function( ev ) {   
          $( this ).datepicker( 'hide' );   
      });

      $('#orderDetails').on('hide.bs.modal', function (e) {
           location.reload();
       });
    </script>

</body>
</html>