<!doctype html>

<html>

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Menufi</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>

	<link rel="stylesheet" href="css/style.css" type="text/css"/>-->



</head>

<link rel="stylesheet" href="<?php echo base_url(); ?>static/css/style.css" type="text/css"/>

<style>

    body {

	  	background:url(<?php echo base_url(); ?>images/checkout-bg.png);

		background-size:cover;

		color:#fff;

                background-repeat: repeat-y;

	  }

          .menuImage{

              height:100px!important;

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
if(isset($bg)){
?>
		background:url(../images/background/<?php echo $bg;?>) no-repeat center;
<?php }
else{
?>
		background:url(../images/table-image/table_bg.png) no-repeat center;
<?php } ?>
                background-size:cover;

	}


</style>

<body>

<?php //var_dump($_SESSION['ar']);?>

<div class="container main">

	<div class="row">

    	<div class="col-md-12 col-sm-12">

			<a href="<?php echo base_url();?>index.php/Home"><span class="glyphicon glyphicon-arrow-left glyphicon-arrow-left-c"></span></a>

		</div>

    </div>

</div>

    

<div class="working-wrapper">

	<div class="container margin-s" id="divShowOrder">

            <?php

      $total = 0.0;





	  $i = 1;



//$items = (object)$items;

          if(isset($items) && count($items)>0){

			foreach($items as $item){



$item = (object)$item;

          $total += (float)$item->Price*(int)$item->Quantity;





        ?>

		<div class="row s-bg">

			<!--<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 width-sl">

                            <img src="<?php //echo base_url(); ?>images/food_images/<?php //echo $item->Image; ?>" alt="" class="img-responsive menuImage" />

			</div>-->

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 width-sr">

				<h3><?php echo $item->Name;?></h3>

                                <div class="chill-icon">

					<ul>

                                <?php 

                                if(isset($item->CSPICE) && $item->CSPICE != ""){

                                    $spice = $item->CSPICE;

                                }

                                else{

                                $spice = $item->spice_level;

                                

                                }

                                if($spice>0){

                                    for($i=0;$i<$spice;$i++) {

                                        

                                    

                                ?>

				

                                            <li><a href="JavaScript:void(0)" data-id="<?php echo $item->Menu_Id; ?>" id="ch<?php echo $i+1; ?>" class="Achilly" value="<?php echo $i+1; ?>"><img src="<?php echo base_url(); ?>images/redchillie.png" alt="" class="img-responsive chilly" id="imgch<?php echo $i+1; ?>"/></a></li>

						

					<?php }

                                        $whiteCH = 3-$spice;//1

                                        if($whiteCH != 0){

                                            for($i=$spice+1;$i<=3;$i++) { ?>

                                               <li><a href="JavaScript:void(0)" data-id="<?php echo $item->Menu_Id; ?>"  id="ch<?php echo $i; ?>" class="Achilly" value="<?php echo $i; ?>"><img src="<?php echo base_url(); ?>images/whitechillie.png" alt="" class="img-responsive chilly" id="imgch<?php echo $i; ?>"/></a></li> 

                                            <?php }

                                        }

                                }

                                ?>

                                        </ul>

				</div>

                                <div class="quantityCounters">

                                    <span class="input-group-btn">



							  <button type="button" data-id="<?php echo $item->Menu_Id;?>" name="<?php echo $item->Name;?>" id="btn<?php echo $item->Menu_Id;?>" class="btn btn-default btn-number_on_order" data-type="minus" data-field="quant[1]">



								  <span class="glyphicon glyphicon-minus"></span>



								</button>



								</span>



								<input id="quanti<?php echo $item->Menu_Id;?>" style="text-align:center;" type="text" name="quant[1]" class="form-control form-control-m input-number_on_order" value="<?php echo $item->Quantity;?>" min="0" max="10">



								<span class="input-group-btn">



							  <button type="button" data-id="<?php echo $item->Menu_Id;?>" name="<?php echo $item->Name;?>" id="btn<?php echo $item->Menu_Id;?>" class="btn btn-default btn-number_on_order" data-type="plus" data-field="quant[1]">



								  <span class="glyphicon glyphicon-plus"></span>



								</button>



								</span> 

                                </div>

				<div class="rs">

					<p><i class="fa fa-rupee fa-rupee-sc"></i><span><?php echo (float)$item->Price*(float)$item->Quantity;?></span></p>

				</div>

			</div>

		</div>

		<?php	





			$i++;





		}





		$cgst = ($total/100)*6;





		$sgst = ($total/100)*6;





		$net_total = $total + $cgst + $sgst;





		?>

		<div class="row  r-margin">

			<table class="table table-swidth">

                 <tbody>

                                              <tr>

                                                <td>SGST :</td>

                                                <td>2.5%</td>

                                              </tr>

                                              <tr>

                                                <td>CGST :</td>

                                                <td>2.5%</td>

                                              </tr>

                                              <tr class="total">

                                                <td>TOTAL :</td>

                                                <td><p><i class="fa fa-rupee"></i><span> <?php echo $net_total?></span></p></td>

                                              </tr>



                                            </tbody>

                                          </table>                           

		</div>

		<div class="row  r-margin comment-section">

			<div class="col-md-12">

				  <textarea rows="4" cols="50" placeholder="Special Instruction For the Chef" name="txtComments" id="txtComments" value="<?php echo $items[0]->comments; ?>" ></textarea> 

			</div>

		</div>

		<div class="row  r-margin place-order">

			<div class="col-md-12">

                            <button class="bth bth-placeorder" onclick="final_order()">Place Order</button>

			</div>

		</div>

            <?php }?>

	</div>

</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>

    $('document').ready(function(){

        window.ar=[];

        var comments = "";

        var arInSession = "";

//        $.ajax({

//        type: 'POST',

//        url: '<?php echo base_url();?>index.php/Home/getCurrentArray/',

//        

//

//        cache: false,

//                

//        success: function (response) {

//            

//            

//            arInSession = JSON.parse(response);

////            console.log(arInSession);

//            ar = arInSession;

////            console.log(ar);

//        }

//    });

        

        

        

       $('.Achilly').click(function(){

           var spice = $(this).attr('value');

           var menu_id =  $(this).attr('data-id'); 



$.ajax({

			 type: 'POST',

			  url: '<?php echo base_url();?>index.php/Orders/update_spice_level',



			  data: {'spice_level':spice, 'menu_id':menu_id},

                          dataType: 'html',

			  cache: false,

			  success: function (response) {
console.log(response);
                              $('#divShowOrder').html(response);      

			  }



		 });

       }); 

    });

    

    function final_order(){

	//alert("test");

        comments = $('#txtComments').val().trim();

	$.ajax({

		type: 'POST',

		 url: '<?php echo base_url();?>index.php/Orders/final_order/',

		 cache: false,

                 data:{'comments':comments},

		 success: function (response) {

                        $('#myModal_show_order').modal('toggle');

                        push_order();

//			 $('#final_item_details').html(response);

//			 $('#myModal_final').modal('show');



			 //$('#myModal').modal('toggle');

			 //alert(response.Name);

			 //alert(response.Name);

		 }



	});

}



//-----------------------------------------------below: for quantity counter at 26/10 3.20 pm--------------------------------

$('.btn-number_on_order').click(function(e){

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

    var input = $("input[id=quanti"+menuId+"]");

    var currentVal = parseInt(input.val());

//    console.log('currentVal:'+currentVal);

    if (!isNaN(currentVal)) {

        if(type == 'minus') {



            if(currentVal > input.attr('min')) {

//               console.log('min:'+input.attr('min')); 

                input.val(currentVal - 1).change();

                

            }

            if(parseInt(input.val()) == input.attr('min')) {

                $(this).attr('disabled', true);

            }

                remove_items_from_yourorder(menuId,$(this),input,currentVal,menu_name);

        } else if(type == 'plus') {



            if(currentVal < input.attr('max')) {

//                console.log('max:'+input.attr('max'));

                input.val(currentVal + 1).change();

            }

            if(parseInt(input.val()) == input.attr('max')) {

                $(this).attr('disabled', true);

               

            }

                add_items_from_yourorder(menuId,$(this),input,currentVal,menu_name);

        }

    } else {

        input.val(0);

    }

});

$('.input-number_on_order').focusin(function(){

   $(this).data('oldValue', $(this).val());

});

$('.input-number_on_order').change(function() {



    minValue =  parseInt($(this).attr('min'));

    maxValue =  parseInt($(this).attr('max'));

    valueCurrent = parseInt($(this).val());



    name = $(this).attr('name');

    if(valueCurrent >= minValue) {

        $(".btn-number_on_order[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')

    } else {

        alert('Sorry, the minimum value was reached');

        $(this).val($(this).data('oldValue'));

    }

    if(valueCurrent <= maxValue) {

        $(".btn-number_on_order[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')

    } else {

        alert('Sorry, the maximum value was reached');

        $(this).val($(this).data('oldValue'));

    }





});

$(".input-number_on_order").keydown(function (e) {

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

        function add_items_from_yourorder(menuId,control,input,currentVal,menu_name){



        //-------------------------------------------------------------    

         comments = $("#txtComments").val().trim();

         if(comments == ""){

             comments = "No comments";

         }

         var menu_id = menuId;

//                                console.log("control:"+control);



//                console.log("menu_id:"+menu_id);

                

		var quantity = $('#quanti'+menuId).val();

                console.log("quantity:"+quantity);

//                        console.log("length:"+ar.length);



		if(ar.length > 0){

                    

  var x = ar.some(function(el) {

    return el.id === menu_id;

  }); 

//console.log("found:"+x);

if(x){



                    var foundAt = ar.map(function(o) { return o.id; }).indexOf(menu_id);

//                        console.log("foundAt:"+foundAt);



  

                ar[foundAt].Quantity = quantity;

            }

            else{

                ar.push({'id':menu_id,'Name':menu_name, 'Quantity':quantity});



            }

                                    



            }

            else{

                ar.push({'id':menu_id, 'Name':menu_name, 'Quantity':quantity});

            }   



    console.log('ar:'+ar);

           

//                        

//console.log(ar);

//-------------------------below: commented to add ar to db instead of array-------------------------------------------------

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

//                              $('.main').html(response);

////                              $('#myModal_show_order').modal('show');

//

////			 $('#myModal').modal('toggle');

//			  }

//

//		 });



$.ajax({

			 type: 'POST',

			  url: '<?php echo base_url();?>index.php/Orders/Add_order_item_direct/',

			  data: {'ar' : ar, 'comments':comments},

			  //data: 'menu_id='+menu_id+'&quantity='+quantity+'&arr='+arr,

			 // dataType: "string",

			  cache: false,

                                  dataType: 'html',

			  success: function (response) {

//window.location = '<?php echo base_url();?>index.php/Home/redirectToMyOrders'; //commented on 26oct 9.55

//				  $('#myModal').modal('toggle');

				  //alert(response.Name);

				  //alert(response.Name);

                                  $('#show_order').html(response);

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

        

        function remove_items_from_yourorder(menuId,control,input,currentVal,menu_name){

console.log('arinRemove:'+ar);



if(ar.length==0){

    $.ajax({

        type: 'POST',

        url: '<?php echo base_url();?>index.php/Home/getCurrentArray/',

        async: false,



        cache: false,

                

        success: function (response) {

            

            

            arInSession = JSON.parse(response);

//            console.log(arInSession);

            ar = arInSession;

//            console.log(ar);

        }

    });

    

}

comments = $("#txtComments").val().trim();

         if(comments == ""){

             comments = "No comments";

         }



var menu_id = menuId;

//                                console.log("control:"+control);

console.log('arFromSession:'+ar);

                console.log("menu_id:"+menu_id);

                

		var quantity = $('#quanti'+menuId).val();

                console.log("quantity:"+quantity);

                        console.log("ar length:"+ar.length);



		if(ar.length > 0){

                    var foundAt = ar.map(function(o) { return o.id; }).indexOf(menu_id);

                        console.log("foundAt:"+foundAt);



                  if(foundAt > -1){

                      if(quantity > 0){

                        ar[foundAt].Quantity = quantity;

//                        alert(quantity);

                        $.ajax({

                                 type: 'POST',

                                  url: '<?php echo base_url();?>index.php/Orders/Add_order_item_direct/',

                                  data: {'ar' : ar, 'comments':comments},

                                 

                                  cache: false,

                                          dataType: 'html',

                                  success: function (response) {

        //window.location = '<?php echo base_url();?>index.php/Home/redirectToMyOrders';//commented on 26/10 9.58

        //				 

                                          $('#show_order').html(response);

//                                           alert(response);
$("#MenuTable tbody tr[name='"+menu_id+"'] td input#quantity"+menu_id).val(quantity).change();
//					window.location.reload(true); 					  

                                  }



                         });

                 }

            else{

//                delete ar[foundAt];

    ar.splice(foundAt, 1);

//---------------------code added on 27/10 9.10-----------------------------------------------------

$.ajax({

			 type: 'POST',

			  url: '<?php echo base_url();?>index.php/Orders/remove_item',

			  data: {'ar' : ar, 'Menu_id':menu_id},

			  dataType : 'html',

			  cache: false,

			  success: function (response) {

//------------------------------------------below: added on 27/10 9.46 to refresh your_order modal to reflect valid items and their current quantities--------------------

				$('#show_order').html(response);

$.ajax({

                                        type: 'POST',

                                        url: '<?php echo base_url();?>index.php/Orders/getItemCount/',

                                        cache: false,

                                         success: function (resp) {

                                             console.log(resp);

                                             $('.badge').text("");

                                             $('.badge').text(resp);
$("#MenuTable tbody tr[name='"+menu_id+"'] td input#quantity"+menu_id).val(0).change();
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

//-------------------------below: commented to update ar to db instead of array-------------------------------------------------



//$.ajax({

//			 type: 'POST',

//			  url: '<?php echo base_url();?>index.php/Orders/tempShowOrder',

//			  data: {'arr' : ar},

//			

//			  cache: false,

//                                

//			  success: function (response) {

////                              console.log(response);

//                              $('.main').html(response);

////                              $('#myModal_show_order').modal('show');

//

////			 $('#myModal').modal('toggle');

//			  }

//

//		 });





//-------------end testing-------------

                        



	}

</script>

</html>