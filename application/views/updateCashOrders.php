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
<!--<meta http-equiv="refresh" content="5; URL=http://demo.creaadesign.com/menufi/index.php/Admin/dashboard">-->
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
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    
                </li> -->
                
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
                    <h1 class="page-header">Update Cash Orders</h1>
                </div>
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
											onclick="showModal_Home('<?php echo $idr; ?>');print_home('<?php echo $idr; ?>','<?php if(isset($add)){echo $add;}?>','<?php if(isset($name)){echo $name;} ?>');"
										<?php }else{ ?>
										onclick="showModal('<?php echo $idr; ?>');" 
										
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
<!--                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Update Orders with Cash Payments
                        </div>
                         /.panel-heading 
                        <div class="panel-body">
                            <div class="form-group">
                                Select Order No.: 
                                <select name="ddlOrderNo" class="form-control">
                                  <?php // if(!empty($pendingOrders)){
                                     //foreach ($pendingOrders as $value) {
    //echo '<option value="'.$value["id"].'">'.$value['Order_id'].'</option>';
                                       // }
                                 // } ?>  
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="btnUpdateCashOrders" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </div>
                    
                </div>-->
            </div>
            <!-- /.row -->
           
            
            <h1><br>
            <br><br><br><br><br><br><br><br><br></h1>
            
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

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
							  <input type="text" oninput="getReturnAmount()" class="form-control" id="given_amount" placeholder="Enter Given Amount" name="given_amount" onblur="getReturnAmount()">
							</div>
							<div class="form-group">
							  <label for="pwd">Return Amount:</label>
							  <input type="text" class="form-control" id="return_amount" placeholder="Enter Return Amount" name="return_amount">
							</div>
						</div>			
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" <?php if($table_no == 'Home Delivery'){?>
						 onclick="call_home()"
						<?php }else{ ?>
						 onclick="call()"
						<?php } ?> >Submit</button>
					</div>
				</form>	
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js" integrity="sha384-CchuzHs077vGtfhGYl9Qtc7Vx64rXBXdIAZIPbItbNyWIRTdG0oYAqki3Ry13Yzu" crossorigin="anonymous"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../assets/dist/js/sb-admin-2.js"></script>

</body>
<script>
    

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

        function showModal(id){
    $('#modal_oid').val(id);
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

function print_home(id,address,name){
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
                    'address': address
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
                       sendDelivery(id);
                       pay_it(id);
                     //  window.location = '';

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
                       // window.location = '';
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
</html>
