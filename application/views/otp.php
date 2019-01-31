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
   -    webkit-background-clip: unset;
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
        $_SESSION['bg'] = $bg;
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
			<img src="<?php echo base_url();?>images/table-image/logo-main.png" style="float:right;"/>
		</div>
	</div>
	<div class="row logo">
		<div class="co-md-12">
<?php 
if(isset($logo)){
?>
			<!--<img src="<?php echo base_url();?>images/table-image/logo-main.png" style="float:right;"/>-->
            <img src="<?php echo base_url();?>images/logo/<?php echo $logo;?>"/>
<?php } else { ?>
			<img src="<?php echo base_url();?>images/table-image/logo.png" />
<?php } ?>
		</div>
	</div>
    <div class="row">
      <form method="post" action="otpverify">  
    	<div class="social-login">
    	    <ul>
				<li><a href="javascript: void(0);"><input type="number" style="height: 45px; width: 100%; padding-left: 10px; background: rgba(99, 88, 85, 0.33); color: #fff; border: none; border: 1px solid rgba(255, 255, 255, 0.22);" value="<?php echo $mnumber;?>" name="mnumber" required></a></li>
        	    <li><a href="javascript: void(0);"><input type="password" style="height: 45px; width: 100%; padding-left: 10px; background: rgba(99, 88, 85, 0.33); color: #fff; border: none; border: 1px solid rgba(255, 255, 255, 0.22);" placeholder="Enter OTP" name="otp" required></a></li>
                <li><button class="btn btn-primary pull-right" style="margin-left: 40px; width:100%; height:45px;">Submit</button></li>
            </ul>
        </div>
       </form> 
    </div>
</div>
</body>
</html>

