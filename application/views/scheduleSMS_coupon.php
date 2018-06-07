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
    
    <script type="text/javascript">
  function AllowNumbersOnly(e) {
    var code = (e.which) ? e.which : e.keyCode;
    if (code > 31 && (code < 48 || code > 57)) {
      e.preventDefault();
    }
  }
</script>
 
    <script type="text/javascript">
			$(document).ready(function() {
				var country = ["Australia", "Bangladesh", "Denmark", "Hong Kong", "Indonesia", "Netherlands", "New Zealand", "South Africa"];
				$("#country").select2({
				  data: country
				});
			});
	</script>

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
            
                <div class="col-lg-12">
                    <h1 class="page-header">Coupon Generator</h1>
               
                <!-- /.col-lg-12 -->
            
            <!-- /.row -->
           <div class="col-lg-6"> 
             <div class="panel panel-info">
                        <div class="panel-heading">
                         Coupon Generator
                        </div>
           <div class="panel-body">
                            <div class="table-responsive">
                                
                    <form action="coupon_add" method="post">
                    
                        <div class="form-group">
                        
                        <input class="form-control" type="text" name="coupon_code" placeholder="Enter Coupon Code" style="text-transform:uppercase" required><br>
                        <select class="form-control" name="coupon_type">
                            <option value="flat">FLAT OFF</option>
                            <option value="percent">DISCOUNT % OFF</option>
                        </select><br>
                        <input class="form-control" type="text" name="coupon_value" onkeypress = "return AllowNumbersOnly(event)" placeholder="Enter Coupon value" required><br>
						<input class="form-control" type="text" name="coupon_minvalue" onkeypress = "return AllowNumbersOnly(event)" placeholder="Enter Minimum Amount" required>
                    </div>
                    <div class="col-md-6" style="margin-left: 0px;padding-left: 0px;">
                  <button type="submit" style="float:left;" class="btn" name="send_msg" >Generate
                  </button></div>
              <div class="col-md-6" style="margin-left: 0px; padding-left: 0px;" >
                      <input class="form-control" style="float:right;" type="hidden" placeholder="Generated Coupon">
              </div>
            </form>
                                
                         </div> </div> </div> </div>

                         <div class="col-lg-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">Coupon Generated</div>
                            <div class="panel-body"> 
                        <table class="table table-striped table-dark">
  <thead class="thead-light">
   
      
   <tr><th>Sr No</th>
    <th>Type</th>   <th>Coupon Code</th> <th>Minimum Value</th> <th>Status</th> <th>Delete</th></tr>
      <?php $i=1; $data = $this->db->query('SELECT * FROM coupons;'); ?>
      <?php foreach ($data->result() as $coupon) { ?> 
      <tr><td><?php echo $i; ?></td><td><?php echo $coupon->c_type; ?></td><td><?php echo $coupon->c_code; ?></td><td><?php echo $coupon->c_minvalue ?></td><td><a href="coupon_toggle?code=<?php echo $coupon->id ?>"><?php echo $coupon->c_status; ?></a></td><td><a href="coupon_delete?code=<?php echo $coupon->id ?>">X</a></td></tr>  
      <?php $i++; } ?>
 
      
  </thead>
 
</table>
                                
                                            <?php
                    
                    if(isset($feedback)) {
                         echo '<script type="text/javascript">alert("' . $feedback . '"); </script>';
                    }
                    
                    ?>
</div>
</div>
                        
                    </div>



        </div>
          
    
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

    </div>
    
</body>

</html>
