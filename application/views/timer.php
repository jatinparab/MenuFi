<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menufi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/media.css" type="text/css"/>
  <style>
  * {
  margin:0px;
  padding:0px;
  }
  
  body {
      background:url(<?php echo base_url(); ?>images/background_timmer.png);
		background-size:cover;
		height:100vh;
		color:#fff;
	  }
	  .modal-body{
              background-color: rgba(0,0,0,0.45);
          }
	  .container {
		  	width:95%;
		  }
		.padding-top {
		    padding-top: 30%;
   		   text-align: center;
			}
		.padding-top h1  { 
			font-size:80px;
			margin-bottom: 0px;
		}
		
		.padding-top span  { 
			font-size:16px;
		}
		
		.padding-top p { 
			font-size:22px;
			text-transform:uppercase;
			padding-top:8%;
		}
		.gohome {
			padding-top:30%;
			}
		.gohome h3 {
				text-align:center;
				text-transform:uppercase;
				font-size:15px;
			}
		/*@media (max-width:667px ){
			.padding-top { padding-top: 8%;}
			.gohome { padding-top: 18%;}	
		}*/
                
                body {
                <?php
                if (isset($bg)) {
                    ?>
                    background:url(<?php echo base_url(); ?>images/background/<?php echo $bg; ?>);
                <?php
                } ?>
                background-size:cover;

            }
            @media (max-width: 667px) {



                body {

                    background:url(<?php echo base_url(); ?>images/background/<?php echo isset($bg) ? $bg : 'table_bg.png'; ?>) no-repeat;
                    font-family: <?php echo isset($font) ? $font : 'Didact Gothic'; ?>;
                }

                .modal-content {

                    background:url(<?php echo base_url(); ?>images/background/<?php echo isset($bg) ? $bg : 'table_bg.png'; ?>) no-repeat center center fixed;
                font-family: <?php echo isset($font) ? $font : 'Didact Gothic'; ?>;
                }


            }
  </style>  

</head>
<body>

<div class="container padding-top">
	<div class="row">
    	<h1><?php echo $waitingTime; ?></h1>
        <span>MINS</span>
        <p>Your Food is on the way...</p>
        <p style="color:white!important;">Order ID: <?php echo !empty($order_id)?$order_id:'Data Not Available.';?></p>
        <div class="gohome">
            <a href="<?php echo base_url(); ?>index.php/Home/toHome" style="color:white!important;"><img src="<?php echo base_url(); ?>images/home-icon.png" alt="" />
            <h3>Lets go back to home</h3></a>
        </div>
    </div>
    <!--feedback modal-->
<!--<div class="modal fade bd-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "item_details">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="add_items()">Add to Order</button>
      </div>
    </div>
  </div>
</div>-->

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
				
				
				
				
				<th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
			</thead>
				<tr>
					<td>Variety</td>
					
					
					
					
					<td>
					<div class="radio">
					  <input type="radio" value="1"  name="optradio">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="2"  name="optradio">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="3"  name="optradio">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="4" name="optradio">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="5" name="optradio">
					</div>
					</td>
				</tr>
				<tr>
					<td>Quality</td>
					
					
					
					
					<td>
					<div class="radio">
					  <input type="radio" value="1"  name="optradioquality">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="2"  name="optradioquality">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="3"  name="optradioquality">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="4"  name="optradioquality">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="5"  name="optradioquality">
					</div>
					</td>
				</tr>
				<tr>
					<td>Serving Portion</td>
					
					
					
					
					<td>
					<div class="radio">
					  <input type="radio" value="1"  name="serving_portion">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="2" name="serving_portion">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="3"  name="serving_portion">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="4"  name="serving_portion">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="5"  name="serving_portion">
					</div>
					</td>
				</tr>
				<tr>
					<td>Presentation</td>
					
					
					
					
					<td>
					<div class="radio">
					  <input type="radio"  value="1" name="presentation">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="2" name="presentation">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="3"  name="presentation">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="4"  name="presentation">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="5"  name="presentation">
					</div>
					</td>
				</tr>
				<tr>
					<td>Value for money</td>
					
					
					
					
					<td>
					<div class="radio">
					  <input type="radio"  value="1" name="vfm">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="2" name="vfm">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="3"  name="vfm">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="4"  name="vfm">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="5"  name="vfm">
					</div>
					</td>
				</tr>
			</table>
		
		
		<table class="table table-responsive">
			<thead>
				<th>SERVICES</th>
				
				
				
				
				<th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
			</thead>
				<tr>
					<td>Speed</td>
					
					
					
					
					<td>
					<div class="radio">
					  <input type="radio"  value="1" name="speed">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="2" name="speed">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="3" name="speed">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="4" name="speed">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio" value="5"  name="speed">
					</div>
					</td>
				</tr>
				<tr>
					<td>Staff Courtesy</td>
					
					
					
					
					<td>
					<div class="radio">
					  <input type="radio"  value="1" name="courtsey">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="2" name="courtsey">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="3" name="courtsey">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="4" name="courtsey">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="5" name="courtsey">
					</div>
					</td>
				</tr>
				<tr>
					<td>Staff knowledge</td>
					
					
					
					
					<td>
					<div class="radio">
					  <input type="radio"  value="1" name="knowledge">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="2" name="knowledge">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="3" name="knowledge">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="4" name="knowledge">
					</div>
					</td>
                                        <td>
					<div class="radio">
					  <input type="radio"  value="5" name="knowledge">
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
<div class="modal fade bd-example-modal-sm" id="myModal_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-content-bg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "bill">

      </div>
      <div class="modal-footer">
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
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function createCookie(name,value,expiry) {    if (expiry) {        var date = new Date();        date.setTime(date.getTime()+(expiry*24*60*60*1000));        var expires = "; expires="+date.toGMTString();    }    else var expires = "";    document.cookie = name+"="+value+expires+"; path=/";}
function readCookie(name) {    var nameEQ = name + "=";    var ca = document.cookie.split(';');    for(var i=0;i < ca.length;i++) {        var c = ca[i];        while (c.charAt(0)==' ') c = c.substring(1,c.length);        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);    }    return null;}
function eraseCookie(name) {    createCookie(name,"",-1);}
$('document').ready(function(){

    var wait = '<?php echo $waitingTime; ?>';
    var fromajax = <?php echo $fromajax; ?>;
	var orderId = <?php echo $Order_id; ?>;
//var wait = 0.1;
//    var a = wait.split(':'); // split it at the colons
var milliseconds = 0;
if(fromajax==0){
	var date = new Date();
    milliseconds = (wait * 60)*1000;
	createCookie("myOrder",(date.getTime())+"|"+milliseconds,1);
}else{
	console.log("asdfasdfasdfasdf");	
	milliseconds = 1000;
}
//    (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2])*1000;
    setTimeout(function() {
//    $('#myModal').modal();
generate_bill();
}, milliseconds);
});

function generate_bill(){
	//alert("test");
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
            var error = 0;
            var knowledge = $('input:radio[name="knowledge"]:checked');
            var courtsey = $('input:radio[name="courtsey"]:checked');
            var speed = $('input:radio[name="speed"]:checked');
            var vfm = $('input:radio[name="vfm"]:checked');
            var presentation = $('input:radio[name="presentation"]:checked');
            var serving_portion = $('input:radio[name="serving_portion"]:checked');
            var optradioquality = $('input:radio[name="optradioquality"]:checked');
            var variety = $('input:radio[name="optradio"]:checked');
            
            if(variety.length == 0)//no buttons selected
            {
                error=1;
                alert("Please select at least one option for variety.");
                return false;
            }
            if(optradioquality.length == 0)//no buttons selected
            {
                error=1;
                alert("Please select at least one option for quality.");
                return false;
            }
            if(serving_portion.length == 0)//no buttons selected
            {
                error=1;
                alert("Please select at least one option for serving portion.");
                return false;
            }
            if(presentation.length == 0)//no buttons selected
            {
                error=1;
                alert("Please select at least one option for presentation.");
                return false;
            }
            if(vfm.length == 0)//no buttons selected
            {
                error=1;
                alert("Please select at least one option for Value for money.");
                return false;
            }
            if(speed.length == 0)//no buttons selected
            {
                error=1;
                alert("Please select at least one option for speed.");
                return false;
            }
            if(courtsey.length == 0)//no buttons selected
            {
                error=1;
                alert("Please select at least one option for courtsey.");
                return false;
            }
            if(knowledge.length == 0)//no buttons selected
            {
                error=1;
                alert("Please select at least one option for Knowledge.");
                return false;
            }
            
            if(error == 0){
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
            }
            
            
           
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
            $.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>index.php/Orders/save_offline_order/',
                cache:false,
                success:function(resp){
                    
                }
            });
            
            $.ajax({
                type:'POST',
                url:'<?php echo base_url(); ?>index.php/Orders/addOfflineOrder/',
                cache:false,
                success:function(resp){
                    $('#myModal_payment_type').modal('toggle');
            $('#feedback').modal('show');
                }
            });
            
        }

</script>
</html>