<?php
defined('BASEPATH') OR exit('No direct script access allowed');
unset($_SESSION['ar']);
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Didact Gothic' rel='stylesheet'>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/css/media.css" media="all" /> 
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>static/css/hover.css" media="all" /> 
	<script src="<?php echo base_url();?>assets/js/custom.js"></script>
	<title>Menufi</title>
        <style>
            body {
                <?php
                if (isset($bg)) {
                    ?>
                    background:url(../images/background/<?php echo $bg; ?>) center;
                <?php
                } else {
                    ?>
                    background:url(../images/table-image/table_bg.png) no-repeat center;
                <?php } ?>
                background-size:cover;

            }
            @media (max-width: 667px) {

<?php if(isset($fontName) && isset($fontSrc)){ 
    
    echo '@font-face {';
                echo 'font-family: "'.$fontName.'";';
                echo 'font-style: normal;
  font-weight: 400;';
                echo 'src: '.$fontSrc.' format("woff2"); }';
                     } ?>

                body {

                    background:url(../images/background/<?php echo isset($bg) ? $bg : 'table_bg.png'; ?>);
                    font-family: <?php echo isset($fontName) ? $fontName : 'Didact Gothic'; ?>;
                }

                .modal-content {

                    background:url(../images/background/<?php echo isset($bg) ? $bg : 'table_bg.png'; ?>) no-repeat center center fixed;
                }


            }
        </style>
	<!--<style type="text/css">


	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 0px 0;
		padding: 14px 15px 10px 15px;
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

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
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
	.icon-food icon-ok-sign{
		font-size: 22px;
	}
	.food_icon{
		margin-right: 8px;
		margin-top: 8px;

	}
	.modal-header{
		text-align:center;

	}
	.img-center{
		margin: 0 auto;
	}



	</style>-->
</head>
<body>

<div id="container">
<div class="header header2">
	<div class="row">
		<div class="co-sm-6 co-md-6">
                    <a href="<?php echo base_url();?>index.php/Home/toHome"><img src="<?php echo base_url();?>images/table-image/logo-main.png" style="float: left; padding-left: 30px; padding-top: 15px;"/></a>
		</div>
		<div class="co-sm-6 co-md-6 icon-property">
			<!--<button type="button" class="btn btn-default  pull-right food_icon hvr-bounce-in" onclick="generate_bill()"><i class="icon-ok-sign"></i></button>-->
            <!--navbars-->
           	<button type="button" class="btn btn-default   food_icon hvr-bounce-in" onclick="show_order()"><i  class="icon-food"></i></button>
                <span class="badge" style="position:relative; top:-20px;"><?php if(!empty($TotalMenuItems)){echo $TotalMenuItems;}else{echo 0;} ?></span>
              <!--navbars end-->
                 <div id="mySidenav" class="sidenav">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
<!--                  <a href="#">Menu1</a>
                  <a href="#">Menu2</a>
                  <a href="#">Menu3</a>
                  <a href="#">Menu14</a>-->
                  <?php
                  foreach($categories as $row){
                      echo '<a class="link" href="javascript:void(0);">'.$row['Category'].'</a>';
                  }
                  ?>
                </div>
                
                <span style="font-size:30px;cursor:pointer; margin-left:10px; font-weight:bold;" onclick="openNav()">&#9776;</span>
			 
		</div>
	</div>		
</div>
<br>
<div class="row" style="float:right; position:relative; right:5px;">
	<label style="float:right; position:relative; right:180px;">Check this for veg</label>
	<input type="checkbox" class="vegNonveg" checked data-toggle="toggle" style="float:right; position:absolute; right:0px; margin-top: 5px; margin-bottom: 10px;">
 </div>


	<!--<button type="button"  class="btn btn-primary btn-lg btn-block btn-block-place hvr-wobble-skew" onclick="final_order()">Place order</button>-->
    <div style="padding-top:30px;"></div>

	<div class="container">
	<div class="row" style="padding:15px; background:<?php echo base_url();?>images/background/table_bg.png";">
		<?php
			//echo "<pre>";
			//print_r($menu_items)
			foreach($menu_items as $row){ ?>
                                        <!--onclick="show_order()"-->
					<div class="col-xs-6" style="padding-bottom:10px"><img src="<?php echo base_url();?>images/food_images/<?php 
						$x = $row -> Image;
						if($x!=''){
							echo $x;
						}else{
							echo "default.jpg";
						}

					?>" height="100px" width="100%"/><br><?php echo $row->Name;?><br>
					<i class="icon-inr"> </i><?php echo $row->Price;?>
<!--                    <td><span class="glyphicon glyphicon-minus mainminus"></span>
                    <span style="padding-left:3px; padding-right:3px; font-size:12px;" class="counter"> 1 </span>
                   <span class="glyphicon glyphicon-plus mainplus"></span> 
                    </td>--><br>
                                            <span class="input-group-btn">

							  <button type="button" data-id="<?php echo $row->Menu_Id;?>" name="<?php echo $row->Name;?>" id="btn<?php echo $row->Menu_Id;?>" class="btn btn-default btn-number_on_menu" data-type="minus" data-field="quant[1]">

								  <span class="glyphicon glyphicon-minus"></span>

								</button>

								</span>
<?php 
                                       
   $Q = $ctrlr->getQuantity($row->Menu_Id);
   
?>
								<input id="quantity<?php echo $row->Menu_Id;?>" style="text-align:center;" type="text" name="quant[1]" class="form-control form-control-m input-number_on_menu" value="<?php echo !empty($Q)?$Q:'0';?>" min="0" max="10">

                                                                

                                                                <span class="input-group-btn">

							  <button type="button" data-id="<?php echo $row->Menu_Id;?>" name="<?php echo $row->Name;?>" id="btn<?php echo $row->Menu_Id;?>" class="btn btn-default btn-number_on_menu" data-type="plus" data-field="quant[1]">

								  <span class="glyphicon glyphicon-plus"></span>

								</button>

								</span> 
								</div>
	
								
		<?php	}
		?>
</div>
<br>
		</div>
<!--Add order-->
<div class="modal fade bd-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <div class="modal-body" id = "final_item_details">

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
        </div>
    </div>
  </div>

</div>
<!--payment gateway modal-->
<div class="modal fade bd-example-modal-sm" id="payment_gateway" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
           <img class="img-responsive width-img-sucess" src="<?php echo base_url();?>images/modal_images/success-icon-10.png" />
        </div>
    </div>
  </div>

</div>

<!--feedback modal-->
<div class="modal fade bd-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>




<div class="modal fade bd-example-modal-sm" id="feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
		
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h1 style="font-size: 25px; text-align: center;">FEEDBACK FORM</h1>
      </div>
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
					  <input type="radio" name="optradio">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="optradio">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="optradio">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="optradio">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="optradio">
					</div>
					</td>
				</tr>
				<tr>
					<td>Quality</td>
					<td>
					<div class="radio">
					  <input type="radio" name="optradioquality">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="optradioquality">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="optradioquality">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="optradioquality">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="optradioquality">
					</div>
					</td>
				</tr>
				<tr>
					<td>Serving Portion</td>
					<td>
					<div class="radio">
					  <input type="radio" name="serving_portion">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="serving_portion">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="serving_portion">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="serving_portion">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="serving_portion">
					</div>
					</td>
				</tr>
				<tr>
					<td>Presentation</td>
					<td>
					<div class="radio">
					  <input type="radio" name="presentation">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="presentation">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="presentation">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="presentation">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="presentation">
					</div>
					</td>
				</tr>
				<tr>
					<td>Value for money</td>
					<td>
					<div class="radio">
					  <input type="radio" name="vfm">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="vfm">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="vfm">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="vfm">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="vfm">
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
					  <input type="radio" name="speed">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="speed">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="speed">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="speed">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="speed">
					</div>
					</td>
				</tr>
				<tr>
					<td>Staff Courtsey</td>
					<td>
					<div class="radio">
					  <input type="radio" name="courtsey">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="courtsey">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="courtsey">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="courtsey">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="courtsey">
					</div>
					</td>
				</tr>
				<tr>
					<td>Staff knowledge</td>
					<td>
					<div class="radio">
					  <input type="radio" name="knowledge">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="knowledge">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="knowledge">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="knowledge">
					</div>
					</td>
					<td>
					<div class="radio">
					  <input type="radio" name="knowledge">
					</div>
					</td>
				</tr>
			</table>
			</table>



		</div>
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" onclick="pay_bill_after_feedback">No Thanks</button>
        <button type="button" class="btn btn-primary" onclick="pay_bill_after_feedback()">Submit</button>
      </div>
		</div>



    </div>
  </div>





<!--Show order Modal-->
<div class="modal fade bd-example-modal-sm" id="myModal_show_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "show_order">

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
<!--Bill Modal-->
<div class="modal fade bd-example-modal-sm" id="myModal_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id = "bill">

      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="pay_bill()">Pay Amount</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(document).ready(function(){
            window.ar = [];
            $("a.link").click(function(e){
//            alert('1');
        var cat= $(e.target).text();
//               alert(cat);
               
                $.ajax({
                    type:'POST',
                    dataType:'JSON',
                    url:'<?php echo base_url()?>index.php/Home/getItems',
                    data:'cat='+cat,
                    success:function(data1)
                    {
                        
                        $('#MenuTable').html('');                      
//                        console.log(data1);
                        $('#MenuTable').html(data1);
                    }
            });
            e.preventDefault();
           return false;
           
        });
            
            
            $('.vegNonveg').change(function(){
                var mode= $(this).prop('checked');
                $.ajax({
                    type:'POST',
                    dataType:'JSON',
                    url:'Home/vegNonvegFilter',
                    data:'mode='+mode,
                    success:function(data1)
                    {
                        
                        $('#MenuTable').html('');                      
//                        console.log(data1);
                        $('#MenuTable').html(data1);
                    }
        });
            })
            
            $('.btn-number_on_menu').click(function(e){
    e.preventDefault();
//    console.log("in button");
var id = $(this).prop('id');
var menuId = $(this).attr('data-id');
var menu_name = $(this).attr('name');
//console.log(menu_name);
//alert(id);
var btn = document.getElementById(id);
//alert(btn);
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[id=quantity"+menuId+"]");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
                $("#"+id+".btn-number_on_menu[data-type='plus']").removeAttr("disabled");
            }
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }
            else{
                $("#"+id+".btn-number_on_menu[data-type='minus']").removeAttr("disabled");
            }
                remove_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
                $("#"+id+".btn-number_on_menu[data-type='minus']").removeAttr("disabled");
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
               
            }
            else{
                $("#"+id+".btn-number_on_menu[data-type='plus']").removeAttr("disabled");
            }
                add_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        }
    } else {
        input.val(0);
    }
});
            $('.input-number_on_menu').focusin(function(){
               $(this).data('oldValue', $(this).val());
            });
            $('.input-number_on_menu').change(function() {
console.log("changed value");
                minValue =  parseInt($(this).attr('min'));
                maxValue =  parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                name = $(this).attr('name');
                if(valueCurrent >= minValue) {
                    $(".btn-number_on_menu[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if(valueCurrent <= maxValue) {
                    $(".btn-number_on_menu[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }


            });
            $(".input-number_on_menu").keydown(function (e) {
                    // Allow: backspace, delete, tab, escape, enter and .
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                         // Allow: Ctrl+A
                        (e.keyCode == 65 && e.ctrlKey === true) ||
                         // Allow: home, end, left, right
                        (e.keyCode >= 35 && e.keyCode <= 39)) {
                             // let it happen, don't do anything
                             return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
            
            
            
		$('#MenuTable .itemName').click(function (event) {
          //alert($(this).attr('name')); //trying to alert id of the clicked row
		  var menu_id = $(this).attr('name');
console.log('menu_id:'+menu_id);
		  $.ajax({
			  type: 'POST',
			  url: '<?php echo base_url();?>index.php/Orders/Item_details',
			  data: {menu_id : menu_id},
			 // dataType: "string",
			  cache: false,
			  success: function (response) {
				  //console.log(response);
				  //alert(response.Name);
				  //alert(response.Name);
				 $('#item_details').html(response);
				 $('#myModal').modal('show');


$('.btn-number').click(function(e){
    e.preventDefault();
//var id = $(this).prop('id');
//var menuId = $(this).attr('data-id');
//var menu_name = $(this).attr('name');

    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='quantity_from_details_view']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {

            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            }
            if(parseInt(input.val()) == input.attr('min')) {
//                $(this).attr('disabled', true);
            }
//remove_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }
//add_items_from_menu(menuId,$(this),input,currentVal,menu_name);
        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {

    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());

    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }


});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


				}

					// populate data that returned from CI(yourFunction)
					// here `msg` is a returned data from your controller
					// see console.log to see the data
					//console.log(msg);

		  })

     });

	});
</script>
<script>

	function add_items(){
		var menu_id = $('#Menu_id').attr('name');
                console.log('menu_id:'+menu_id);
//		var quantity = $('#quantity').val(); //changed 06/11/17 3:11pm to make item details txtbox show quant in sync
        var quantity = $('#quantity_desc_'+menu_id).val();        
        console.log('quantity:'+quantity);
                if(quantity == 0){
                    alert('Quantity can not be zero.');
                }
                else{
		var arr = [];
		$.each($('.addon_button'),function(){
			if($(this).val() == 1)
			{
				arr.push($(this).attr('id'));
			}


		});
console.log('addon:'+arr);
		var arr_ing = [];
		$.each($('.addon_button_ing'), function(){
			if($(this).val() == 1)
			{
				arr_ing.push($(this).attr('id'));
			}
		})
console.log('addon_ing:'+arr_ing);

		 $.ajax({
			 type: 'POST',
			  url: '<?php echo base_url();?>index.php/Orders/Add_order_item/',
			  data: {'menu_id' : menu_id, 'quantity' : quantity, 'arr' : arr, 'arr_ing' : arr_ing},
			  //data: 'menu_id='+menu_id+'&quantity='+quantity+'&arr='+arr,
			 // dataType: "string",
			  cache: false,
			  success: function (response) {

				  $('#myModal').modal('toggle');
				  //alert(response.Name);
				  //alert(response.Name);
				  $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url();?>index.php/Orders/getItemCount/',
                                        cache: false,
                                         success: function (resp) {
                                             console.log(resp);
                                             $('.badge').text("");
                                             $('.badge').text(resp);
                                             $("#MenuTable tbody tr[name='"+menu_id+"'] td input#quantity"+menu_id).val(quantity).change();
//window.location.reload(true); 
                                         }
		 });
			  }

		 });
                 }
	}
        
        function add_order_direct(){



		 $.ajax({
			 type: 'POST',
			  url: '<?php echo base_url();?>index.php/Orders/Add_order_item_direct/',
			  data: {'ar' : ar, 'comments':'comments'},
			  //data: 'menu_id='+menu_id+'&quantity='+quantity+'&arr='+arr,
			 // dataType: "string",
			  cache: false,
			  success: function (response) {
window.location = '<?php echo base_url();?>index.php/Home/redirectToMyOrders';
//				  $('#myModal').modal('toggle');
				  //alert(response.Name);
				  //alert(response.Name);
			  }

		 });

	}

        function add_items_from_menu(menuId,control,input,currentVal,menu_name){

          
            
         var menu_id = menuId;
//                                console.log("control:"+control);

//                console.log("menu_id:"+menu_id);
                
		var quantity = $('#quantity'+menuId).val();
                $.ajax({
			type: 'POST',
			url: '<?php echo base_url();?>index.php/Home/getCurrentArray/',
			cache: false,
			async: false,
			success: function (response) {
				if(response!=''){
					arInSession = JSON.parse(response);
					ar = arInSession;
				}
			}
		});
                console.log("quantity:"+quantity);
                        console.log("length:"+ar.length);

		if(ar.length > 0){
                    
  var x = ar.some(function(el) {
    return el.id === menu_id;
  }); 
console.log("found:"+x);
if(x){

                    var foundAt = ar.map(function(o) { return o.id; }).indexOf(menu_id);
                        console.log("foundAt:"+foundAt);

  
                ar[foundAt].Quantity = quantity;
            }
            else{
                ar.push({'id':menu_id,'Name':menu_name, 'Quantity':quantity});

            }
                                    

            }
            else{
                ar.push({'id':menu_id, 'Name':menu_name, 'Quantity':quantity});
            }   
                       
console.log(ar);
//--------------------------below commented on 26oct 9.54am to check add_order_direct from here---------------------------
//		 $.ajax({
//			 type: 'POST',
//			  url: '<?php echo base_url();?>index.php/Orders/tempShowOrder',
//			  data: {'arr' : ar},
//			  //data: 'menu_id='+menu_id+'&quantity='+quantity+'&arr='+arr,
//			 // dataType: "string",
//			  cache: false,
////                                  dataType:'json',
//			  success: function (response) {
////                              console.log(response);
//                              $('#show_order').html(response);
////                              $('#myModal_show_order').modal('show');
//
////			 $('#myModal').modal('toggle');
//			  }
//
//		 });

$.ajax({
			 type: 'POST',
			  url: '<?php echo base_url();?>index.php/Orders/Add_order_item_direct/',
			  data: {'ar' : ar, 'comments':'comments'},
			  //data: 'menu_id='+menu_id+'&quantity='+quantity+'&arr='+arr,
			 // dataType: "string",
			  cache: false,
			  success: function (response) {
$.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url();?>index.php/Orders/getItemCount/',
                                        cache: false,
                                         success: function (resp) {
                                             console.log(resp);
                                             $('.badge').text("");
                                             $('.badge').text(resp);
//window.location.reload(true); 
                                         }
		 });
			  }

		 });

	}
        
        function remove_items_from_menu(menuId,control,input,currentVal,menu_name){


var menu_id = menuId;
//                                console.log("control:"+control);

                console.log("menu_id:"+menu_id);
                
		var quantity = $('#quantity'+menuId).val();
                console.log("quantity:"+quantity);
                        console.log("length:"+ar.length);
						$.ajax({
							type: 'POST',
							url: '<?php echo base_url();?>index.php/Home/getCurrentArray/',
							cache: false,
							async: false,
							success: function (response) {
								if(response!=''){
									arInSession = JSON.parse(response);
									ar = arInSession;
								}
							}
						});

		if(ar.length > 0){
                    var foundAt = ar.map(function(o) { return o.id; }).indexOf(menu_id);
                        console.log("foundAt:"+foundAt);

                  if(foundAt > -1){
                      if(quantity > 0){
                            ar[foundAt].Quantity = quantity;
                            $.ajax({
                                    type: 'POST',
                                     url: '<?php echo base_url();?>index.php/Orders/Add_order_item_direct/',
                                     data: {'ar' : ar, 'comments':'comments'},
                                     //data: 'menu_id='+menu_id+'&quantity='+quantity+'&arr='+arr,
//                                     dataType: "html",
                                     cache: false,
                                     success: function (response) {
//window.location.reload(true); 
//                                             $('#show_order').html(response);
                                     }

                            });
                      }
            else{
//                delete ar[foundAt];
    ar.splice(foundAt, 1);
//---------------------code added on 26/10 10.21-----------------------------------------------------
$.ajax({
			 type: 'POST',
			  url: '<?php echo base_url();?>index.php/Orders/remove_item',
			  data: {'ar' : ar, 'Menu_id':menu_id},
//			  dataType: 'html',
			  cache: false,
			  success: function (response) {
$.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url();?>index.php/Orders/getItemCount/',
                                        cache: false,
                                         success: function (resp) {
                                             console.log(resp);
                                             $('.badge').text("");
                                             $('.badge').text(resp);
//window.location.reload(true); 
                                         }
		 });  
			  }

		 });
                 }
//                 -----------------------------------------------------------------
            }
            else{

            }
              console.log(ar);                      

            }
// ------------------------------ commented on 26/10 9.57 to check add_order_direct from here------------------------
//$.ajax({
//			 type: 'POST',
//			  url: '<?php echo base_url();?>index.php/Orders/tempShowOrder',
//			  data: {'arr' : ar},
//			
//			  cache: false,
//                                
//			  success: function (response) {
////                              console.log(response);
//                              $('#show_order').html(response);
////                              $('#myModal_show_order').modal('show');
//
////			 $('#myModal').modal('toggle');
//			  }
//
//		 });


//-------------end testing-------------
                        

	}

</script>
<script>
function final_order(){
	//alert("test");
	$.ajax({
		type: 'POST',
		 url: '<?php echo base_url();?>index.php/Orders/final_order/',
		 cache: false,
		 success: function (response) {
//			 $('#final_item_details').html(response);
//			 $('#myModal_final').modal('show');

			 //$('#myModal').modal('toggle');
			 //alert(response.Name);
			 //alert(response.Name);
		 }

	});
}
</script>
<script>
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
</script>
<script>
function show_order(){
    var callurl = '<?php echo base_url();?>index.php/Orders/show_order/' ;
	//alert(callurl);
	$.ajax({
		type: 'POST',
		 url: callurl,
		 cache: false,
//                 async: false,                
                data: {arr:ar},
                dataType: "html",
		 success: function (response) {                    
//                     console.log(response);
			 $('#show_order').html(response);
			 $('#myModal_show_order').modal('show');

//			 $('#myModal').modal('toggle');
			 //alert(response.Name);
			 //alert(response.Name);
		 }

	});
}
</script>
<script>
function generate_bill(){
	//alert("test");
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
</script>
<script>
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
				$('#myModal_bill').modal('toggle');
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

	function pay_bill_after_feedback()
	{
		$('#feedback').modal('toggle');
		$('#payment_gateway').modal('show');

	}

</script>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>

<script>
$("#mySidenav a").click(function(){
	// console.log("asd");
	document.getElementById("mySidenav").style.width = "0";
});
$("span").click(function(){
    $(".mainplus").css("color", "green");
});
$("span").click(function(){
    $(".mainminus").css("color", "red");
});


</script>
</body>
</html>
