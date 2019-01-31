
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
                  <h1 class="page-header">Daily Sales Report</h1>
              </div>
              <div class="col-lg-12"> 
                <div class="panel panel-info">
                  <div class="panel-heading">Search</div>
                  <div class="panel-body"> 
                    <form action = "<?=base_url()?>index.php/Admin/sales_daily_reports" method = "post">
                      <div class="row">
                        <div class="col-md-3">
                          <input type = "text" class = "form-control datepicker"  id = "date_dt" name = "date_dt" value = "<?php echo $date; ?>" placeholder="Select date">
                        </div>
                        <div class="col=md-2">
                          <input type = "submit" class = "btn btn-success" value = "Search">
                        </div>
                      </div>    
                    </form>
                  </div>
                </div>
              </div>
         		  <div class="col-lg-12"> 
       		 		  <div class="panel panel-info">
                  <div class="panel-heading">Daily Sales Report</div>
                  <div class="panel-body"> 
     		 		        <table class="table table-striped table-dark">
                      <thead class="thead-light">
                        <tr>
                          <th>Hour</th>
                          <th>Number of customers</th>   
                          <th>Sales of the hour</th>
                          <th>Avg bill of the hour</th>
                          <th>Total bill</th>
                        </tr>  
                      </thead>
                      <tbody>
                      <?php foreach($report_data as $data){ ?>
                        <tr>
                          <td><?php echo $data['hour'];?></td>
                          <td><?php echo $data['total_customer'];?></td>
                          <td><?php echo $data['sales_hour'];?></td>
                          <td><?php echo $data['avg_sales_hour'];?></td>
                          <td><?php echo $data['total_sales'];?></td>
                        </tr>
                      <?php } ?>
                        <tr>
                          <td></td>
                          <td></td>
                          <td><b>Total</b></td>
                          <td><?php echo $final_avg_sales_total;?></td>
                          <td><?php echo $final_total;?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
         		 	</div>
            </div>
            <!-- /.row -->
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

    <!--Chart.JS Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
      
      

      $( "#date_dt" ).datepicker({   
          format: 'dd-mm-yyyy'
      }).on( 'changeDate', function( ev ) {   
          $( this ).datepicker( 'hide' );   
      });

    </script>

   
</body>
</html>
