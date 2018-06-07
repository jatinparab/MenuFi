
<div id="container">
	<h1 class="header_align_center" style="text-align: center; color: #fff; font-size:25px;">YOUR ORDER</h1>

	<div id="body">
		<div>
		<table class="table table-responsive table-hover table-sm" id="order_unconfirmed">
			<thead>
				<th style=" color: #fff;">Sr.No</th>
				<th style=" color: #fff;">Name</th>
				<th style=" color: #fff;">Quantity</th>

			</thead>
			<tbody>
		<?php
			//echo "<pre>";
			//print_r($menu_items)

			foreach($items as $item){

        ?>

				<tr  id="row_<?php echo $item->Menu_Id;?>">
					<td style=" color: #fff;"><?php echo $item->Menu_Id;?></td>
					<td style=" color: #fff;"><?php echo $item->Name;?></td>
					<td style=" color: #fff;"><?php echo $item->Quantity;?></td>
					<?php
						if($item->item_status == 2)
						{
							?>
								<td>
									<span class="glyphicon glyphicon-ok"></span>
								</td>
							<?php
						}
						else
						{
							?>
								<td>
										<button  type=button onclick="remove_item(<?php echo $item->Menu_Id;?>)" style="background:#000;"><span class="glyphicon glyphicon-remove"></span></button>
								</td>

							<?php
						}
					 ?>


				</tr>

		<?php	}
		?>


			</tbody>
		</table>

		</div>
	<div>

</div>
<script>
	function remove_item(id)
	{
		
		
			$.ajax({
				type: 'POST',
				 url: '<?php echo base_url();?>index.php/Orders/remove_item/',
				data: {Menu_id : id},
				 cache: false,
				 success: function (response) {
					//console.log(response);
					//$('#myModal_final').modal('toggle');
					if(response == 1){
						$('#row_'+id).remove();
					}
					else{
						//alert("Something went wrong");
					}
					//alert("Order has been placed successfully");
					 //$('#myModal').modal('toggle');
					 //alert(response.Name);
					 //alert(response.Name);
				 }

	});

	}
</script>
