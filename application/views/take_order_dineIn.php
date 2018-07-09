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

            <ul  class="nav navbar-top-links navbar-right" >

            <li class="dropdown" >
                    <a  href="<?php echo base_url(); ?>index.php/Admin/tableStatus" >
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
		 		<div class="col-md-4 col-sm-offset-2">
		 			<p style="color:white;font-size:16px;">Total Opening Amount : <?php echo $amt; ?> </p>
					 
		 		</div>

				 <div class="col-md-2 pull-left">
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
								<div class="col-sm-
								 <?php if(!(isset($_SESSION['order_id']))){
									 echo 9;
								 }
									 else{
										 echo 12;
									 } ?> 
								
								">
									
									<div class="form-body">
										<!-- JAVASCRIPT ADD ITEM TO ORDER CONTENT WILL BE HERE -->
										<?php if(!(isset($_SESSION['order_id']))){ ?>
										<div class="col-lg-5" style="color: white">
											<form method="post" action="create_orderD">
												<div class="form-group">Mobile No.
													<input id="nu" pattern="[7-9]{1}[0-9]{9}" type="text" name="mobno" class="form-control" required>
												</div>
												<br>
												<div class="form-group">Table No.
													<input id="tbl" type="number" name="table" class="form-control" value="<?php if(isset($tid)){echo $tid;}?>" required>
												</div>
												<br>
												<div class="form-group">
													<input id="some" class="form-control" type="submit" name="CreateOrder" class="form-control" value="Create Order">
													<br>
												</div>
											</form>
										</div>
										<div class="row">
                
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <?php
            
            ?>
           
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
                <?php
                }
                                  }
                                  
                                  else{
                                      echo '<div class="col-lg-12">No Offline Orders.</div>';
                                  }
?>

					</div>
						<br/><br/>
										<?php }
                        else{ ?>
										<div class="col-md-12">
										<div  class="col-lg-7">
								<div style="max-height: 300px; overflow:auto;" class="panel panel-info">
									<div class="panel-heading">
										Menu
									</div>
									<!-- /.panel-heading -->
									<div class="panel-body">

										<div class="table-responsive">

											
												
												<?php 
                                                if(isset($query2) && !empty($query2)){
                                                    foreach ($query2 as $value) {
                                                      
                                                ?>
												<button onclick="addItem('<?php echo $value['Menu_Id'] ?>','<?php echo $_SESSION['customer_id'] ?>')" class="btn btn-success menu-item <?php echo $value['Category'] ?>" style="margin:5px;">
                                                
                                                        <?php   echo $value['Name']; ?>
                                                        
                                                </button>

												<?php }
                                                
                                                }
                                                else{                
                                                        echo 'Data not available at this moment.';
                                                }
                                                ?>
											
										</div>
									</div>
                                </div>
                               
                                


                            </div>
							<div class="col-md-5">
											
												<div align="center">
													<div class="panel panel-info" style="color:black;">
														<div class="panel panel-primary panel-heading">ORDER(Set Quantity Zero to Remove)</div>
														<div class="panel-body">
															<div class="table-responsive">
																<form action="complete_orderD" method="post">
																	<table class="table table-bordered" style="padding:10px" id="fakeOrder_here">
																		
								

																	</table>
																	<button type="submit" onclick="kotprint(<?php echo $_SESSION['order_id']; ?>)" name="place_order" class="form-control btn btn-success">Place Order</button>
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
                                           
											<div class="col-lg-12">
												<div>
													
													
													<form method="post" action="searchD">
                                                    <div class="col-sm-7">
                                                    <input name="search" placeholder="search menu item"  class="form-control" id="search">
														<br>
														<input type="submit" id="sch_btn" value="Search" class="form-control" />
                                                    </div>
														
														<div class="col-sm-5"  style="padding:0px;margin-left:0px;margin-top:-10px;">
															<input style="margin-top:5px;margin-right:5px; width:140px;height:50px;" type="button" value="Show All" onclick="filter('')" class="btn btn-primary">
															<?php foreach($categories as $category){ ?>
															<input style="margin-top:5px;margin-right:5px; width:140px;height:50px;" type="button" value="<?php echo $category; ?>" onclick="filter('<?php echo $category ?>')"
															class="btn btn-primary">
															<?php } ?>
														</div>

													</form>
												</div>
												<br>
												<hr>
												<br>

											</div>
											
									</div>
								</div>
							</div>
							

		
                            <?php }?>
				<div class="row">
					<div class="col-md-12" style="padding-top:20px;">
                            
                                
                                
                                
                                
    
                                
                                        </div>
                                        </div>
                                        </div>
                                    
                                						<!-- /.row -->
						
							</div>
                            </div>
                            
							
						</div>

					</div>
					<!-- /#wrapper -->

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
						function addon(idOfMenu) {
							console.log(idOfMenu);
							if ($('#ad' + idOfMenu).val() == -1) {
								//alert("here");
								$('#addonv' + idOfMenu).val('');
								$('#addon' + idOfMenu).html('');
								return;
							}
							let data = $('#' + idOfMenu + " option:selected").html();
							console.log(data);
							$('#addon' + idOfMenu).append(data + "<br>");
							let x = $("#addonv" + idOfMenu).val();
							console.log(x);
							x += $('#ad' + idOfMenu).val() + ",";
							console.log(x);
							$('#addonv' + idOfMenu).val(x);
						}

						function filter(category) {
							if (category == '') {
								$(".menu-item").removeClass('hidden');
								return;
							}
							category = category.replace(/\s/g, "");
							$('.menu-item').addClass('hidden');
							$('.' + category).removeClass('hidden');


						}
						if(<?php echo $ye ?>){
            
            $('#nu').val('<?php if(isset($mobno)){
                echo $mobno;
            } ?>'); 
			$('#tbl').val('<?php if(isset($tableno)){
				echo $tableno;
			} ?>')
            $('#some').click();
        }   

						

</script>

<script>
get_fake_order();

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
        
        
        
 
        
  
</script>
</script>

	</body>

	</html>