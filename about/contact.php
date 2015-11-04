
<?PHP

	ERROR_REPORTING(0);

	//PREREQUISITE VARIABLES FOR THE SessionValidate.php PAGE
	$REDIRECT_PATH = "";
	$MY_PAGE_SET = TRUE;
	$LOGIN_PAGE_SET = FALSE;
	$LOGIN_REQUIRED = FALSE;
	
	//THIS SCRIPT VALIDATES THE CURRENT SESSION
	include('../includes/SessionValidate.php');

	//CONNECT SCRIPT FOR DATABASE ACCESS
	include '../includes/ServerConnect.php';
	
?>


<html style="text-align: center;  height: 100%; width: 100%; overflow: hidden;">

	<title>Contact Us | Librorum </title>
	<link href="../css/MainSheetCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/AnimateCSS.css" rel="stylesheet" type="text/css"/>
	
	<style>
		#canvas {
		position: absolute;
		left: 0;
		z-index: 0;
		width: 100%;
		height: 100%; 
	}
	
	#front {
		width: 100%; 
		position: relative; 
		z-index: 1;
	}
	
	div.spacer {
		width: 100%; 
		height: 0px;
	}
	
	</style>
	
	<canvas id = "canvas"></canvas>
	
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="background.js"></script>
	
	
	<div class="header animated fadeInDown">
		<?php include('../includes/HeaderMenu.php'); ?>
	</div>
	
	<div id='front' class='animated fadeInUp'>
		<div id='spacer'></div>
	<text style="font-size: 50px; color: #333;">Here's how to reach us:</text><br>
	<div class='SPACER-20'></div>
	<text style="font-size: 30px; color: White;">
	Visit us on <b>www.librorum.in/gamma</b> to know more.<br>
	Or drop an email on <b>hello@librorum.in</b><br>
	Call <b>+91 97429 31741</b> to speak to us.
	</text><br>
	<div class='SPACER-20'></div>
	<text style="font-size: 20px; color: #333;">#TheSharingCommuntity #Share #NewAndImproved</text><br>
	</div>
</html>