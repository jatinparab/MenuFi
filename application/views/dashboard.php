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
                    <ul class="dropdown-menu dropdown-user" >
                       
                         <li><h5 style="padding-left: 3px; background-color: white">You have 5 notifications</h5></li>
                         <hr style="padding: 0px; margin: 0px; color: #fff">
                         <li><a href="#"><i class="fa fa-sign-out fa-fw"></i>
                         <i style="padding-left: 2px;font-size: 2;margin-left: 2px">New Order: 438 </i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i>
                        <i style="padding-left: 2px;font-size: 2;margin-left: 2px">Table Assistance: 3</i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i>
                         <i style="padding-left: 2px;font-size: 2;margin-left: 2px">Order Served: 432 </i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-sign-out fa-fw"></i>
                        <i style="padding-left: 2px;font-size: 2;margin-left: 2px">Table Assistance: 2</i></a>
                        </li>
                  
                   
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
        <div class="row" style="padding-top:30px;padding-bottom:30px;">
            <div class="col-sm-3">

            <a href="<?php echo base_url('index.php/Admin/DineIn'); ?>" style="font-size:40px;" class="btn btn-info btn-lg">Dine In</a>
            </div>
            
            <div class="col-sm-3">

            <a href="<?php echo base_url('index.php/Admin/TakeAway'); ?>" style="font-size:40px;" class="btn btn-info btn-lg">Take Away</a>
            </div>
            <div class="col-sm-3">

            <a href="<?php echo base_url('index.php/Admin/HomeDelivery'); ?>" style="font-size:40px;" class="btn btn-info btn-lg">Home Delivery</a>
            </div>
                                        </div>
 
            <!-- /.row -->
        

        
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
	</script>

	
</body>

</html>
