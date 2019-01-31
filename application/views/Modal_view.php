

					<form action="#" method="POST">
						<div>
						<table class="table table-responsive table-hover table-sm">
						<tr>
							<td  colspan="4"><img class="img-responsive thumbnail" src="'.base_url().'images/food_images/<?php echo $row->Image;?>"/></td>
						</tr>
						<tr>
							<td  colspan="4" style="text-align:center;" class="food_modal_title"><?echo $row->Name;?></td>
						</tr>
						<tr>
							<td colspan="4" style="text-align:justify;" class="food_modal_desc"><?php echo $row->Description;?></td>
						</tr>
						<tr>
							<div class="input-group">
								<span class="input-group-btn">
							  <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
								  <span class="glyphicon glyphicon-minus"></span>
								</button>
								</span>
								<input id="quantity" type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
								<span class="input-group-btn">
							  <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
								  <span class="glyphicon glyphicon-plus"></span>
								</button>
								</span>
							</div>
						</tr>
						<tr>
							<td>Calories</td>
							<td>Fats</td>
							<td>Carbs</td>
							<td>Protein</td>
						</tr>
						<tr>
							<td><?php echo $row->Calories;?></td>
							<td><?php echo $row->Fats;?></td>
							<td><?php echo $row->Carbs;?></td>
							<td><?php echo $row->Protein;?></td>
						</tr>

						</table>
						</div>
					</form>