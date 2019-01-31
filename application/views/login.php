<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="<?php echo base_url();?>assets/js/custom.js"></script>

	<link href='https://fonts.googleapis.com/css?family=Didact Gothic' rel='stylesheet'>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/css/media.css" media="all" /> 

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/css/hover.css" media="all" /> 

	<title>Menufi</title>



	<style type="text/css">



	::selection { background-color: #E13300; color: white; }

	::-moz-selection { background-color: #E13300; color: white; }



	body {

		background-color: #fff;

		margin:40px;

		font: 13px/20px normal Helvetica, Arial, sans-serif;

		color: #4F5155;

	}



	a {

		color: #003399;

		background-color: transparent;

		font-weight: normal;

	}



	.header_align_center{

		text-align: center;

	}



	code {

		font-family: Consolas, Monaco, Courier New, Courier, monospace;

		font-size: 12px;

		background-color: #f9f9f9;

		border: 1px solid #D0D0D0;

		color: #002166;

		display: block;

		margin: 14px 0 14px 0;

		padding: 12px 10px 12px 10px;

	}



	#body {

		margin: 0 15px 0 15px;

	}



	p.footer {

		text-align: right;

		font-size: 11px;

		border-top: 1px solid #D0D0D0;

		line-height: 32px;

		padding: 0 10px 0 10px;

	}





	.header_align{

		float:left;

	}

	.modal-body{

		padding: 0px;

	}

	.modal-content{

			

	position: relative;

    background-color: #fff;

   -webkit-background-clip: unset;

    border: 0px;

    border-radius: 0px;

    outline: 0;

    -webkit-box-shadow: 0 3px 9px rgba(0,0,0,.5);

    box-shadow: 0 3px 9px rgba(0,0,0,.5);

}

	.icon-food{

		font-size: 22px;

	}

	.food_icon{

		margin-right: 8px;

		margin-top: 8px;

		

	}

	.select_label{

		width: 100%;

		text-align: center;

		

		

	}

	#sell{

		text-align: center;

	}

	.combo {

    background: silver;

    margin: 10px 0;

    position: relative;

}
<?php if(isset($fontName) && isset($fontSrc)){ 
    
    echo '@font-face {';
                echo 'font-family: "'.$fontName.'";';
                echo 'font-style: normal;
  font-weight: 400;';
                echo 'src: '.$fontSrc.' format("woff2"); }';
                     } ?>
body {
    font-family: <?php echo isset($fontName) ? $fontName : 'Didact Gothic'; ?>;
    <?php
    if (isset($bg)) {
        
        ?>
        background:url(<?php echo base_url(); ?>images/background/<?php echo $bg; ?>) no-repeat center;
    <?php
    } else {
        ?>
        background:url(<?php echo base_url(); ?>images/table-image/table_bg.png) no-repeat center;
    <?php } ?>
    background-size:cover;

}
@media (max-width: 667px) {



    body {
font-family: <?php echo isset($fontName) ? $fontName : 'Didact Gothic'; ?>;
        background:url(<?php echo base_url(); ?>images/background/<?php echo isset($bg) ? $bg : 'table_bg.png'; ?>) no-repeat;
    }

    .modal-content {
font-family: <?php echo isset($fontName) ? $fontName : 'Didact Gothic'; ?>;
        background:url(<?php echo base_url(); ?>images/background/<?php echo isset($bg) ? $bg : 'table_bg.png'; ?>) no-repeat center center fixed;
    }


}







	</style>

</head>

<body>



<div id="container">

<div class="header">

	<div class="row">

		<div class="co-md-12">

                    <a href="<?php echo base_url();?>index.php/Home/toHome"><img src="<?php echo base_url();?>images/table-image/logo-main.png" style="float:right;"/></a>

		</div>

	</div>

	

	<div class="row logo">

		<div class="col-md-12">

                    <?php
                    if (isset($logo)) {
                        ?>
                            <!--<img src="<?php echo base_url(); ?>images/table-image/logo-main.png" style="float:right;"/>-->
                        <img src="<?php echo base_url(); ?>images/logo/<?php echo $logo; ?>"/>

                    <?php } else { ?>
                        <img src="<?php echo base_url(); ?>images/table-image/logo.png" />
                    <?php } ?>

		</div>

	</div>

		

</div>



<div id="body">

<!--<form method="POST" action="<?php echo base_url();?>index.php/Orders/Table_select">-->

    <div class="form-group">

	<div class="input-group">

	 <span class="input-group-addon"><img src="<?php echo base_url();?>images/table-image/menu-icon.png" /></span>

     	<button type="name" name="name" class="form-control form-control1" id="exampleInputName" aria-describedby="nameHelp" placeholder="MENU" onclick="showMenu()">MENU</button>

	 </div>

	  

	</div>



	<div class="form-group">

	<div class="input-group">

	 <span class="input-group-addon"><img src="<?php echo base_url();?>images/table-image/myorders.png" /></span>

     	<button type="name" name="name" onclick="myOrders()" class="form-control form-control1" id="exampleInputName" aria-describedby="nameHelp" placeholder="Use Internet">My Orders</button>

	 </div>
</div>	 


	   <div class="form-group">

	<div class="input-group">

	 <span class="input-group-addon"><img src="<?php echo base_url();?>images/table-image/askassistance.png" /></span>

     	<button type="name" name="name" onclick="askAss()" class="form-control form-control1" id="exampleInputName" aria-describedby="nameHelp" placeholder="Ask for Assistance">Ask for Assistance</button>

	 </div>

	</div>

  


	 

    <!--</form>-->

    

  <!--<div class="form-group form-group-btn-table" style="background:rgba(255, 0, 0, 0.48);">

  <button type="submit"  class="btn btn-primary btn-lg btn-block btn-bg-none">SELECT TABLE NUMBER</button>

  </div>-->


	  

	

    <div class="form-group">

	<div class="input-group">

	 <span class="input-group-addon"><img src="<?php echo base_url();?>images/table-image/useinternet.png" /></span>

     	<button type="name" name="name" class="form-control form-control1" id="exampleInputName" aria-describedby="nameHelp" placeholder="Use Internet">Use Internet</button>

	 </div>

	  

	</div>


	 <div class="form-group">

	<div class="input-group">

	 <span class="input-group-addon">&nbsp&nbsp<img src="<?php echo base_url();?>images/table-image/checkout.png" /></span>

     	<button type="name" name="checkout" class="form-control form-control1" id="exampleInputName" aria-describedby="nameHelp" placeholder="Checkout" onclick="generate_bill()">Checkout</button>




	 </div>

	  

	</div>

	  </div>

	</div>
  <!--final order modal-->
<div class="modal fade bd-example-modal-sm" id="myModal_final" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "final_item_details" >

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="push_order()">Confirm order</button>
      </div>
    </div>
  </div>
</div>

  <!--Success Modal-->
<div class="modal fade bd-example-modal-sm" id="myModal_success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
           <img class="img-responsive img-center width-img-sucess" src="<?php echo base_url();?>images/modal_images/success-icon-10.png" />
        <!--<input type="button" class="btn btn-primary" value="Check Order Time" onclick="showTimer()">-->
        </div>
    </div>
  </div>

</div>
<!-- </form>-->

<!--myOrders modal-->
<div class="modal fade bd-example-modal-sm" id="myOrders_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h2 style="text-align: center;color:white;">My Orders</h2>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
       
        </div>
        <div class="modal-body" style="color:white;">
            
        </div>
    </div>
  </div>

</div>


<div class="modal fade bd-example-modal-sm" id="askAss_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="text-align: center;color:white;">Assistance will be provided soon ! </h3>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body" style="color:white;">
            
        </div>
    </div>
  </div>

</div>



<!--Select Online/Offline Payment Modal-->
<div class="modal fade bd-example-modal-sm" id="myModal_payment_type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-content-bg">
      <div class="modal-header">
          Select Payment Type
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id ="payment_type">
          <div class="row">
              <div class="col-xs-12">
                  <p>How would you like to pay the bill?</p>
                  <button type="button" class="btn btn-primary btn-lg" onclick="pay_online()">Pay Online</button>&nbsp;
                  <button type="button" class="btn btn-primary btn-lg" onclick="pay_offline()">Pay Offline/Pay by Cash</button>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary" onclick="pay_bill()">Pay Amount</button>-->
        <!--<button type="button" class="btn btn-primary" onclick="show_payment_type()">Pay Amount</button>-->
      </div>
    </div>
  </div>
</div>


<!--feedback form-->
<div class="modal fade bd-example-modal-sm" id="feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-content-bg">
      <div class="modal-header">
		
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h1 style="font-size: 25px; text-align: center;">FEEDBACK FORM</h1>
      </div>
        <form method="post" action="#" name="feedbackForm" id="feedbackForm">	
      <div class="modal-body" id = "feedback_body">
          
			<table class="table table-responsive">
			<thead>
				<th>FOOD</th>
				<th>5</th>
				<th>4</th>
				<th>3</th>
				<th>2</th>
				<th>1</th>
			</thead>
				<tr>
					<td>Variety</td>
					<td>
					<div class="radio">
					  <input type="radio" value="5" name="optradio">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="4" name="optradio">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="3"  name="optradio">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="2"  name="optradio">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="1"  name="optradio">
					</div>
					</td>
				</tr>
				<tr>
					<td>Quality</td>
					<td>
					<div class="radio">
					  <input type="radio" value="5"  name="optradioquality">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="4"  name="optradioquality">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="3"  name="optradioquality">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="2"  name="optradioquality">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="1"  name="optradioquality">
					</div>
					</td>
				</tr>
				<tr>
					<td>Serving Portion</td>
					<td>
					<div class="radio">
					  <input type="radio" value="5"  name="serving_portion">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="4"  name="serving_portion">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="3"  name="serving_portion">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="2" name="serving_portion">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="1"  name="serving_portion">
					</div>
					</td>
				</tr>
				<tr>
					<td>Presentation</td>
					<td>
					<div class="radio">
					  <input type="radio" value="5"  name="presentation">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="4"  name="presentation">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="3"  name="presentation">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="2" name="presentation">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="1" name="presentation">
					</div>
					</td>
				</tr>
				<tr>
					<td>Value for money</td>
					<td>
					<div class="radio">
					  <input type="radio" value="5"  name="vfm">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="4"  name="vfm">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" value="3"  name="vfm">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="2" name="vfm">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="1" name="vfm">
					</div>
					</td>
				</tr>
			</table>
		
		
		<table class="table table-responsive">
			<thead>
				<th>SERVICES</th>
				<th>5</th>
				<th>4</th>
				<th>3</th>
				<th>2</th>
				<th>1</th>
			</thead>
				<tr>
					<td>Speed</td>
					<td>
					<div class="radio">
					  <input type="radio" value="5"  name="speed">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="4" name="speed">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="3" name="speed">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="2" name="speed">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="1" name="speed">
					</div>
					</td>
				</tr>
				<tr>
					<td>Staff Courtesy</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="5" name="courtsey">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="4" name="courtsey">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="3" name="courtsey">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="2" name="courtsey">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="1" name="courtsey">
					</div>
					</td>
				</tr>
				<tr>
					<td>Staff knowledge</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="5" name="knowledge">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="4" name="knowledge">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="3" name="knowledge">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="2" name="knowledge">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio"  value="1" name="knowledge">
					</div>
					</td>
				</tr>
			</table>
			</table>



		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" onclick="pay_bill_without_feedback()">No Thanks</button>
        <button type="button" class="btn btn-primary" onclick="pay_bill_after_feedback()">Submit</button>
        </div></form>
		</div>



    </div>
  </div>

<!--Bill Modal-->
<div class="modal fade bd-example-modal-sm" id="myModal_bill"   tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document"  >
    <div class="modal-content modal-content-bg" >
      <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "bill" >
      	

      </div>
      <div class="modal-footer" >
      	
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary" onclick="pay_bill()">Pay Amount</button>-->
        <button type="button" class="btn btn-primary" onclick="show_payment_type()">Pay Amount</button>
      </div>
    </div>
  </div>
</div>

<!--payment gateway modal-->
<div class="modal fade bd-example-modal-sm" id="payment_gateway" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0,0,0,0.45);">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
           <img class="img-responsive width-img-sucess" src="<?php echo base_url();?>images/modal_images/success-icon-10.png" />
           <br><br><br><button type="button" class="btn btn-secondary pull-right" data-dismiss="modal" onclick="window.location = '<?php echo base_url();?>index.php/Login/'">Close</button>
        </div>
    </div>
  </div>

</div>
<?php 
$customer_id = "";
                    $login_type = "";
                    if(isset($_SESSION['mCustId']) && !empty($_SESSION['mCustId'])){
                        $customer_id = $_SESSION['mCustId'];
                        $login_type = "mobile";
                    }
                    else if(isset($_SESSION['gUserId']) && !empty($_SESSION['gUserId'])){
                        $customer_id = $_SESSION['gUserId'];
                        $login_type = "google";
                    }
?>
</div>



</body>

<script>
    

function before_generate_bill(){
    $.ajax({          
				url:"<?php echo base_url();?>index.php/Home/waitingTime/",   
				data:{"fromajax":1},       
				type:"POST",     
				async: false,     
				success: function(data){   
					document.write(data);      
					document.close();   

					console.log("cookie Deleted");    
				}      
			}); 
}
  function generate_bill(){
	
	eraseCookie("myOrder");
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url();?>index.php/Orders/generate_bill/',
		cache: false,
		success: function (response) {
			$('#bill').html(response);
			$('#myModal_bill').modal('show');

			//$('#myModal').modal('toggle');
			//alert(response.Name);
			//alert(response.Name);
		}

	});
}

function pay_bill()
	{
		//order status 2 means bill has been paid
		$.ajax({
		type: 'POST',
		 url: '<?php echo base_url();?>index.php/Orders/pay_bill/',
		 cache: false,
		 data: {'order_status': 2},
		 success: function (response) {
			if(response == 1)
			{
//				$('#myModal_bill').modal('toggle');
				$('#feedback').modal('show');
			}
			else
			{
				alert("Something went wrong");
			}


			 //$('#myModal').modal('toggle');
			 //alert(response.Name);
			 //alert(response.Name);
		 }

	});



	}

function pay_bill_without_feedback()
	{
            
           
		$('#feedback').modal('toggle');
		$('#payment_gateway').modal('show');

	}
	function pay_bill_after_feedback()
	{
            var formData = $('#feedbackForm').serialize();
            console.log(formData);
            $.ajax({
                type:'post',
                data:formData,
                url:"<?php echo base_url();?>index.php/Orders/saveFeedback",
                cache:false,
                success:function(resp){
                    $('#feedback').modal('toggle');
		$('#payment_gateway').modal('show');
                }
            });
           
//		

	}
        
        function show_payment_type(){
        $('#myModal_bill').modal('toggle');
        $('#myModal_payment_type').modal('show');
        }
        
        function pay_online(){
            $('#myModal_payment_type').modal('toggle');
            pay_bill();
        }
        function pay_offline(){
            $('#myModal_payment_type').modal('toggle');
            $('#feedback').modal('show');
        }
  
    
  function getFinalOrders(){
      $.ajax({
		type: 'POST',
		 url: '<?php echo base_url();?>index.php/Orders/final_order/',
		 cache: false,
		 success: function (response) {
			 $('#final_item_details').html(response);
			 $('#myModal_final').modal('show');

			 //$('#myModal').modal('toggle');
			 //alert(response.Name);
			 //alert(response.Name);
		 }

	});
  }  
  function push_order(){
	//alert("test");
	$.ajax({
		type: 'POST',
		 url: '<?php echo base_url();?>index.php/Orders/push_order/',
		 cache: false,
		 success: function (response) {
			//console.log(response);
			$('#myModal_final').modal('toggle');
			if(response == 1){
			$('#myModal_success').modal('show');
			setTimeout(function(){
			  $('#myModal_success').modal('hide');
			}, 1500);
                        window.location= '<?php echo base_url(); ?>index.php/Home/waitingTime/';
			}
			else{
				alert("Something went wrong");
			}
			//alert("Order has been placed successfully");
			 //$('#myModal').modal('toggle');
			 //alert(response.Name);
			 //alert(response.Name);
		 }

	});
}

//function showTimer(){
//window.location('<?php echo base_url(); ?>index.php/Home/waitingTime/');
//}

function myOrders(){
    var customer_id = '<?php echo $customer_id; ?>';
        var login_type = '<?php echo $login_type; ?>';
    $.ajax({
        
		type: 'POST',
		 url: '<?php echo base_url();?>index.php/Orders/myOrders/',
		 cache: false,
                 data:{'customer_id':customer_id, 'login_type':login_type},
                 dataType:'html',
		 success: function (response) {
			 $('#myOrders_modal .modal-body').html(response);
			 $('#myOrders_modal').modal('show');

			 
		 }

	});
        }


function askAss(){
   
     $.ajax({
        
		type: 'POST',
		 url: '<?php echo base_url();?>index.php/Orders/askAss/',
		 cache: false,
               
                 dataType:'html',
		 success: function (response) {
			 $('#askAss_modal .modal-body').html(response);
			 $('#askAss_modal').modal('show');

			 
		 }

	});
    


	
		
			 
	
        }        
        
        function showMenu(){
        window.location.href = "<?php echo base_url();?>index.php/Home";
        }
        
        
</script>

</html>
