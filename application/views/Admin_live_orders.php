<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/custom.js"></script>
	<title>Menufi</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

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
		padding: 14px 15px 0px 15px;
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
		margin: 20px 0 0 0;
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




	</style>
</head>
	<div>
		<div id="live_order">
		<?php


			foreach($orders as $order){ ?>
				<table class="table table-responsive table-hover table-sm" id="MenuTable">
				<thead>
				<tr>
					<th colspan="3">
						<h2>Order Number: <?php echo $order[0]->Order_id;?></h2>
					</th>
				</tr>
				<tr>
					<th>Sr.No</th>
					<th>Name</th>
					<th>Optional Ingredients</th>
					<th>Addons</th>
					<th>Amount</th>
				</tr>
				</thead>
				<tbody>
			<?php	foreach($order as $order_item) { ?>
					<tr name="<?php echo $order_item->Menu_Id;?>">
					<td><?php echo $order_item->Menu_Id;?></td>
					<td><?php echo $order_item->Quantity;?> * <?php echo $order_item->Name;?></td>
					<?php
						if($order_item->Optional_ingredients != null) { ?>
							<td><?php echo $order_item->Optional_ingredients;?></td>
						<?php

						}
						else
						{ ?>
							<td>None</td>
					<?php	}
					?>
					<?php
						if($order_item->Addons != null) { ?>
							<td><?php echo $order_item->Addons;?></td>
						<?php

						}
						else
						{ ?>
							<td>"No Addons"</td>
					<?php	}
					?>

					<td><i class="icon-inr"> </i><?php echo (float)$order_item->Price*(float)$order_item->Quantity;?></td>
				</tr>

			<?php	}
			?>

		<?php

		}
		?>
			</tbody>
		</table>

		</div>
	</div>
