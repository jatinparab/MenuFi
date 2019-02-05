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
    $tables = array();
	// Pending Cash Order
	$q = $this->db->query("SELECT order_status.Order_id as Order_id,sales.net_total as net_total from order_status ,sales where day(order_status.TIMESTAMP)= day(curdate()) and (order_status.status=3 or order_status.status=1) and sales.Order_id = order_status.Order_id")->result_array();
    $pendingOrders = $q;
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
                                array_push($tables,$rew['Table_id']);
                            
                            }
                                
                    //        print_r($tables);
    
    
	
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
                    <a  href="<?php echo base_url(); ?>index.php/Admin/DineIn" >
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
                    <a style="z-index:999;" class="dropdown-toggle"  href="<?php echo base_url(); ?>index.php/Admin/DineIn" >
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
          <br><br>
                <div class="col-sm-6">
                <a href="<?php echo base_url('index.php/Admin/HomeDelivery'); ?>" class="btn btn-success btn-lg">Home Delivery</a>
                </div>
                <div class="col-sm-6"><a href="<?php echo base_url('index.php/Admin/TakeAway'); ?>" class="btn btn-success btn-lg">Take Away</a></div>
                
                 
                <br><br>
                
                   
                <div class="row" style="padding:20px;">
                    <?php if(!(isset($_SESSION['order_id']))){ ?>
                                            <h1 style="color:#fff">Ground Floor</h1>
                                            <?php
                                            for($i=0; $i<5; $i++){
                                                if(in_array($i+1,$tables)){
                                                    $color = 'danger';
                                                }else{
                                                    $color = 'success';
                                                }
                                                ?>
<a class="btn btn-<?=$color?> btn-lg" 


<?php if($color == 'success'){ ?>

onclick="order('<?=$i+1?>')"  

<?php }else{ ?>

href="<?=base_url()?>index.php/Admin/Tickets?table=<?=$i+1?>"
<?php
}

?>

 style="font-size:50px;padding:30px;margin:10px;"><?=$i+1?></a>

                                                <?php

                                            }
                                            ?>
                                            
                                            
                                            <h1 style="color:#fff">First Floor</h1>
                                             <?php
                                             
                                            for($i=11; $i<21; $i++){
                                                if(in_array($i,$tables)){
                                                    $color = 'danger';
                                                }else{
                                                    $color = 'success';
                                                }
                                                if($i==13){
                                                    continue;
                                                }

                                                ?>
<a class="btn btn-<?=$color?> btn-lg" 

<?php if($color == 'success'){ ?>

onclick="order('<?=$i?>')"  

<?php }else{ ?>

href="<?=base_url()?>index.php/Admin/Tickets?table=<?=$i?>"
<?php
}

?>
style="font-size:50px;padding:30px;margin:10px;"><?=$i?></a>

                                                <?php

                                            }
                                            ?>
                                        </div>
               
<?php } ?>



         
                                <div class="col-sm-12
                               
                                
                            
								">
									
									<div class="form-body">
										<!-- JAVASCRIPT ADD ITEM TO ORDER CONTENT WILL BE HERE -->
										<?php if(!(isset($_SESSION['order_id']))){ ?>
										<div class="col-lg-" style="color: white">
											<form method="post" action="create_orderD">
												<div class="form-group">
													<input class="hidden" id="nu" pattern="[7-9]{1}[0-9]{9}" type="text" value="9999999999" name="mobno" class="form-control" required>
												</div>
												<br>
												<div class="form-group">
													<input class="hidden" id="tbl" width="50px" style="font-size:40px;width:100px;height:100px;" type="number" name="table" class="form-control" value="<?php if(isset($tid)){echo $tid;}?>" required>
												</div>
												<br>
												<input class="hidden" id="some" class="form-control" type="submit" name="CreateOrder" class="form-control" value="Create Order">
													<br>
												</div>

                                        
											</form>
										</div>
                                       
										
            <!-- /.row -->
            
            <?php
            
            ?>
                        
          
          
						<br/><br/>
										<?php }
                        else{ ?>
										<div class="col-md-12">
                                        <div class="col-sm-6"  style="padding:0px;margin-left:0px;margin-top:-10px;">
															<input style="margin-top:5px;margin-right:5px; width:140px;height:50px;" type="button" value="Show All" onclick="filter('')" class="btn btn-primary">
															<?php foreach($categories as $category){ ?>
															<input style="margin-top:5px;margin-right:5px; width:140px;height:50px;" type="button" value="<?php echo $category; ?>" onclick="filter('<?php echo $category ?>')"
															class="btn btn-primary">
															<?php } ?>
                                                            
								<div style="max-height: 600px; overflow:auto;" class="panel panel-info">
									<div class="panel-heading">
										Menu
									</div>
									<!-- /.panel-heading -->
									<div class="panel-body">

										<div class="table-responsive">

											
												
												<?php 
                                                if(isset($query2) && !empty($query2)){
                                                  //  print_r($query2);
                                                    foreach ($query2 as $value) {
                                                      
                                                ?>
												<button  onclick="addItem('<?php echo $value['Menu_Id'] ?>','<?php echo $_SESSION['customer_id'] ?>')" class="btn btn-success menu-item <?php echo $value['Category'] ?> col-sm-5 se" style="margin:5px;padding:20px;margin-left:20px;">
                                                
                                                        <?php   echo $value['Name']; ?>
                                                        
                                                </button>

                                                <?php }
                                                foreach ($query1 as $value) {
                                                      
                                                    ?>
                                                    <button  onclick="addItem('<?php echo $value['Menu_Id'] ?>','<?php echo $_SESSION['customer_id'] ?>')" class="btn btn-success menu-item <?php echo $value['Category'] ?> col-sm-5 hidden " style="margin:5px;padding:20px;margin-left:20px;">
                                                    
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
									
							<div class="col-md-6">
											
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
                                            
													<form method="post" action="searchD">
                                                    <div class="col-sm-6">
                                                    <input name="search" placeholder="search menu item"  class="form-control" id="search">
														<br>
														<input type="submit" id="sch_btn" value="Search" class="form-control" />
                                                    </div>
														
														

													</form>
										</div>
										
                                           
											<div class="col-lg-12">
												<div>
                                       
												</div>
												<br>
												<hr>
												<br>

											</div>
											
									</div>
								</div>
							</div>
							

		
                            <?php }?>
				    
                                


                            </div>
                                
                                
    
                                
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

 <div class="modal fade" id = "addComment">
        <div class="modal-dialog">
            <div class="modal-content ">
            </div>
        </div>
    </div>


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
                        //  $('body').load('http://localhost/menufi/index.php/Admin/searchD');
                            if (category == '') {
                                $(".menu-item").removeClass('hidden');
                                $(".se").addClass('hidden');
                                return;
                            }
                            category = category.replace(/\s/g, "");
                            $('.menu-item').addClass('hidden');
                            $('.' + category).removeClass('hidden');
                            $(".se").addClass('hidden');
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

	<!-- Refreshing the table view after each 5 seconds-->
	<script>
	
    $('#addComment').on('hide.bs.modal', function (e) {
           $('body').load('<?=base_url()?>index.php/Admin/searchD');
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

get_fake_order();

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
        function editItem(id,value){
            $.ajax({
                type: 'POST',
                url: 'ajax_editItem',
                data:{
                    'id':id,
                    'value':value
                },
                cache:false,
                
                success: function(resp){
                    if(resp=='success'){
                        //alert(' Coupon!');
                        get_fake_order();
                    }else{
                        alert(resp);
                    }

            }
            });
        }

        function removeItem(id){
            $.ajax({
                type: 'POST',
                url: 'ajax_removeItem',
                data:{
                    'id':id
                },
                cache:false,
                
                success: function(resp){
                    if(resp=='success'){
                        //alert(' Coupon!');
                        get_fake_order();
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
                    console.log(resp);
                    if(resp == 'success'){
                       pay_it(id);
                       // alert('If Want Bill Then Allow Popup Window');
                       print(id);
                       // alert('done');
                       // window.location = '';

                    }

            }
        });
    
    
}

function order(table_no){
    $('#tbl').val(table_no);
    $('#some').click();

}

function deleteOrderItem(id,order_id,amount){
	//console.log(id);
	$.ajax({
                type: 'GET',
                url: 'ajax_deleteorderitem',
                data:{
                    'id':id,'order_id':order_id,'amount':amount
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