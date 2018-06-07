<!DOCTYPE html>
<html lang="en">
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
	::selection {
		 background-color: #E13300; color: white; 
		 }
	::-moz-selection { 
		background-color: #E13300; color: white; 
		}
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
	body {
		font-family: "Lato", sans-serif;
		}
	.tablink {
    	background-color: #555;
    	color: white;
    	float: left;
    	border: none;
    	outline: none;
    	cursor: pointer;
    	padding: 14px 16px;
    	font-size: 17px;
    	width: 25%;
		}
	.tablink:hover {
	    background-color: #777;
		}
	/* Style the tab content */
	.tabcontent {
    	color: white;
	    display: none;
    	padding: 50px;
        }
	#London {
		background-color:#ffffff;color: #000000;
		}
	#Paris {
		background-color:#ffffff;color: #000000;
		}
	#Tokyo {
		background-color:#ffffff;color: #000000;
		}
	#Oslo {
		background-color:#ffffff;color: #000000;
		}
	#total{
		width: 300px;
		height: 50px;
		background-color: #ffffff;
		box-shadow: 10px 10px 5px #888888;
		}
	</style>
</head>
<body>

	<img class="img-responsive" style="width:8%;" src="<?php echo base_url();?>images/logo/menufi.png" />
	<hr>
	<div id="total">
		<h1>Total Orders: <?php echo count($total);?></h1>
    </div>
	<div id="total">
		<h1>Total Sales:<?php $net_total = 0;foreach($sales as $sale){$net_total += $sale->net_total;}echo "Rs ".$net_total;?></h1>
	</div>

	<button class="tablink" onclick="openCity('London', this, 'green')" id="defaultOpen">Pending Orders</button>
	<button class="tablink" onclick="openCity('Paris', this, 'red')">Out of stock</button>
	<button class="tablink" onclick="openCity('Tokyo', this, 'blue')">Inventory</button>
	<button class="tablink" onclick="openCity('Oslo', this, 'light-blue')">Sales Report</button>

	<div id="London" class="tabcontent">
		<div id="orders">

		</div>

	</div>
	<div id="Paris" class="tabcontent">
		<div id="out_of_stock">

		</div>
	</div>
	<div id="Tokyo" class="tabcontent">
		<div id="inventory">
	
		</div>
	</div>
	<div id="Oslo" class="tabcontent">
		<div id="sales">

		</div>
	</div>

	<script>
	function openCity(cityName,elmnt,color) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");

		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablink");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].style.backgroundColor = "";
		}
		document.getElementById(cityName).style.display = "block";
		elmnt.style.backgroundColor = color;
	}
	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();
	</script>

	<script>
	$( document ).ready(function() {
		sendRequest();
		setTimeout(1500);
		outOfStock();
		setTimeout(1500);
		inventory();
		setTimeout(1500);
		sales();
	});

	function sendRequest(){
		$.ajax({
			url: "<?php echo base_url();?>index.php/Admin/",
			success:
			function(result){
			$('#orders').html(result); //insert text of test.php into your div
			setTimeout(function(){
					sendRequest(); //this will send request again and again;
			}, 5000);
			}});
	};

	</script>
	<script>

	function outOfStock(){
		$.ajax({
			url: "<?php echo base_url();?>index.php/Admin/out_of_stock",
			success:
			function(result){
			$('#out_of_stock').html(result); //insert text of test.php into your div
			setTimeout(function(){
					outOfStock(); //this will send request again and again;
			}, 5000);
			}});
	};

	</script>
	<script>

	function inventory(){
		$.ajax({
			url: "<?php echo base_url();?>index.php/Admin/inventory",
			success:
			function(result){
			$('#inventory').html(result); //insert text of test.php into your div
			setTimeout(function(){
					inventory(); //this will send request again and again;
				}, 5000);
			}});
	};

	</script>
	<script>
	function sales(){
		$.ajax({
			url: "<?php echo base_url();?>index.php/Admin/sales_report",
			success:
			function(result){
			$('#sales').html(result); //insert text of test.php into your div
			setTimeout(function(){
					sales(); //this will send request again and again;
				}, 5000);
			}});
	};
	</script>
</body>
</html>


