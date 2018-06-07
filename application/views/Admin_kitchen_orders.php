<?php
$conn = mysqli_connect("localhost","root", "", "menufi");

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



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

<!--[if lt IE 9]>

<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->


<style>
	.OverDue{
		background-color: rgba(255,0,0,0.3);
	}

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

                    <h1 class="page-header"></h1>
                </div>

                <!-- /.col-lg-12 -->

            </div>

            <!-- /.row -->

            <!-- /.row -->

            <div id="live_order">
			<div class="panel panel-success">
				<div class="panel-heading">
					Live Orders
				</div>
				<div class="panel-body">
					<div class="table-responsive">

						<?php foreach($orders as $order){ ?>
						<table class="table table-responsive table-hover table-sm" id="MenuTable">
							<thead>
								<tr>
									<th>
										<h2>Order Number: <?php echo $order[0]->Order_id;?></h2>
										<h3>Table No:<?php echo $order[0]->Table_id;?></h3>
									</th>
									<th colspan="5">
										<h3>Instructions:<?php echo $order[0]->comments=="comments"?" ":$order[0]->comments;?></h3>
									</th>
								</tr>
								<tr>
									<th>Sr.No</th>
									<th>Name</th>
									<th>Spice Level</th>
									<th>Optional Ingredients</th>
									<th>Addons</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php	foreach($order as $order_item) { ?>
								<tr name="<?php echo $order_item->Menu_Id;?>">
									<td><?php echo $order_item->Menu_Id;?></td>
									<td><?php echo $order_item->Quantity;?> * <?php echo $order_item->Name;?></td>
									<td>
										<?php
										$spice_level = "";
										if (isset($order_item->co_spice_level) && !empty($order_item->co_spice_level)) {
											$sl = $order_item->co_spice_level;
											switch ($sl) {
												case 1:$spice_level = "Low";
												break;

												case 2:$spice_level = "Medium";
												break;

												case 3:$spice_level = "High";
												break;

												default:$spice_level = "N/A";
												break;
											}
										}
										else{
											$sl = $order_item->m_spice_level;
											switch ($sl) {
												case 1:$spice_level = "Low";
												break;

												case 2:$spice_level = "Medium";
												break;

												case 3:$spice_level = "High";
												break;

												default:
												$spice_level = "N/A";
												break;
											} 
										}
										echo $spice_level;
										?>
									</td>
									<?php
									if($order_item->Optional_ingredients != null) { ?>
									<td><?php echo $order_item->Optional_ingredients;?></td>
									<?php
								}
								else
									{ ?>
										<td>None</td>
										<?php	}
										if($order_item->Addons != null) { ?>
										<td><?php 
										
									$y  = $order_item->Addons;
									$arr = explode(',', $y);
									foreach($arr as $a){
										$sql = "SELECT * FROM ingredients WHERE Ingredients_id='$a'";
										$res = $conn -> query($sql);
										$row = $res -> fetch_assoc();
										echo $row['Name']."<br>";
									}
										
										?></td>
										<?php
									}
									else
										{ ?>
											<td>"No Addons"</td>
											<?php	}
											?>
											<td><i class="icon-inr"> </i><?php 
											$total = (float)$order_item->Price*(float)$order_item->Quantity;
											echo $total+($total*0.05);
											?></td>
										</tr>
										<?php	}
										?>
										<?php
									}
									?>
								</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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

	<!-- Refreshing the table view after each 5 seconds-->
	<script>
	$(document).ready(function(){
		setInterval(checkLiveOrder,(2*1000));
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
	function seen(id){
		$.ajax({
			url: "ajax_Seen",
			type:"GET",
			data: {
				'id':id
			},
			success: function(data){
				if(data == 'success'){
					checkLiveOrder();
				}
			}
		});
	}
	</script>


</body>

</html>