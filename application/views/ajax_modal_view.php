<style>



.addon_button



{



		margin-right: 5px;



	



}



</style>







					<div>



						<table class="table table-responsive table-hover table-sm">



						<tr style="display:none;">



							<td id="Menu_id" name="<?php echo $row['data_nutrition'][0]->Menu_Id;?>" colspan="4" style="text-align:center;" class="food_modal_id"><?php echo $row['data_nutrition'][0]->Menu_id;?></td>



						</tr>



						<tr>



							<td  colspan="4" style="color:white!important;"><img src="<?php

if(!empty($row['data_nutrition'][0]->Image)){

echo base_url();?>images/food_images/<?php echo $row['data_nutrition'][0]->Image;?>" class="img-responsive thumbnail" /><?php }else {echo 'Image not available'; }?></td>



						</tr>



						<tr>



							<td  colspan="4" style="text-align:center;" class="food_modal_title"><?php echo $row['data_nutrition'][0]->Name;?></td>



						</tr>



						<tr>



							<td colspan="4" style="text-align:justify;" class="food_modal_desc"><?php echo $row['data_nutrition'][0]->Description;?></td>



						</tr>



						<tr>



						<td  colspan="4" class="width-veg">



							<div style="margin:auto;" class="input-group">



								<span class="input-group-btn">



							  <button type="button" class="btn btn-default btn-number btn-number-m1"  data-type="minus" data-field="quant[1]">



								  <span class="glyphicon glyphicon-minus"></span>



								</button>



								</span>



								<!--<input id="quantity" style="text-align:center;" type="text" data-id="quantity_from_details_view" name="quantity_from_details_view" class="form-control input-number" value="0" min="0" max="10">-->
<input id="quantity_desc_<?php echo $row['data_nutrition'][0]->Menu_Id;?>" data-id="<?php echo $row['data_nutrition'][0]->Menu_Id;?>" style="text-align:center;" type="text" data-id="quantity_from_details_view" name="quantity_from_details_view" class="form-control input-number" value="<?php echo !empty($row['data_nutrition'][0]->Quantity)?$row['data_nutrition'][0]->Quantity:0 ?>" min="0" max="10">


								<span class="input-group-btn">



							  <button type="button" class="btn btn-default btn-number btn-number2" data-type="plus" data-field="quant[1]">



								  <span class="glyphicon glyphicon-plus"></span>



								</button>



								</span>



							</div>



							</td>



						</tr>



						<tr class="bg-color1">



							<td>Calories</td>



							<td>Fats</td>



							<td>Carbs</td>



							<td>Protein</td>



						</tr>



						<tr class="bg-color2">



							<td><?php echo $row['data_nutrition'][0]->Calories;?></td>



							<td><?php echo $row['data_nutrition'][0]->Fats;?></td>



							<td><?php echo $row['data_nutrition'][0]->Carbs;?></td>



							<td><?php echo $row['data_nutrition'][0]->Protein;?></td>



						</tr>



						<tr>



						<td colspan="4" style="text-align:center;"><h1>INGREDIENTS</h1></td>



						</tr>



						



						<?php 
                                                $total_ing = count($row['data_ingredients']);
                                                $split=0;
                                                foreach($row['data_ingredients'] as $ingredient ) { 

if($split%4==0){
    echo '<tr class="bg-color1">';
}

							if($ingredient->addons == 0) {



						?>					



							<td style="padding-top:20px !important"><?php echo $ingredient->Name;?></td>
<?php $split++; ?>


						<?php



							}



							elseif($ingredient->addons == 2){



						



						?>					



							<td class="tb-padd" style="padding-top:20px !important;"><button class="addon_button_ing" onclick = "remove_ing(this)" value="0" id="<?php echo $ingredient->Name;?>"><span class="glyphicon glyphicon-minus glyphicon-minus-iing"></span></button><?php echo $ingredient->Name;?></td>

<?php $split++; ?>

						<?php



								



							}


if($split%4===0){
    echo '</tr>';
}
						}



						?>



						



						<tr>



						<td colspan="4" style="text-align:center;"><h1>ADD ON'S</h1></td>



						</tr>



						



						<?php $split_addon=0;
                                                foreach($row['data_ingredients'] as $ingredient_addons ) { 



							if($ingredient_addons->addons == 1) {

//$counts = $row['counts'][0];

if($split_addon%4==0){
    echo '<tr id="addons" class="bg-color1">';
}

						?>



							



<td class="tb-padd" style="padding-top:20px !important;"><button class="addon_button" onclick = "removeaddon(this)" value="0" id="<?php echo $ingredient_addons->Name;?>"><span class="glyphicon glyphicon-plus glyphicon-plus-inn"></span></button><?php echo $ingredient_addons->Name;?></td>



						<?php
$split_addon++;


							}

if($split_addon%4===0){
    
    echo '</tr>';
}

						}



						?>



						



						</table>



						</div>



						



<script>


function remove_ing(e){
    if($(e).val() == 1)
		{
			$(e).children('span').removeClass('glyphicon-plus');
			$(e).children('span').addClass('glyphicon-minus');
			$(e).val(0);
		}
		else
		{
			$(e).children('span').removeClass('glyphicon-minus');
			$(e).children('span').addClass('glyphicon-plus');
			$(e).val(1);
		}
}
	function removeaddon(e)



	{



		if($(e).val() == 1)
		{
			$(e).children('span').removeClass('glyphicon-minus');
			$(e).children('span').addClass('glyphicon-plus');
			$(e).val(0);
		}
		else
		{
			$(e).children('span').removeClass('glyphicon-plus');
			$(e).children('span').addClass('glyphicon-minus');
			$(e).val(1);
		}



	}







</script>