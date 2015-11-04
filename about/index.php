
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

	<title>Developers | Librorum </title>
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
	
	<script>
		$(document).ready(function(){
			$(".title").hide();
			$("#1").delay(1000).fadeIn(2000);
			$("#2").delay(2000).fadeIn(2000);
			
			
			$("#3").delay(5000).fadeIn(2000);
			$("#4").delay(6000).fadeIn(2000);
			$("#5").delay(8000).fadeIn(2000);
			$("#6").delay(9000).fadeIn(2000);
			
			
		});
	</script>
	
	<div class="header animated fadeInDown">
		<?php include('../includes/HeaderMenu.php'); ?>
	</div>
	
	<div id='front' class='animated fadeInUp' style="width: 800px; margin: 0 auto;">
		<div id='spacer'></div>
	<text id="1" class="title" style="font-size: 60px; color: white;">Hi, We're Librorum!<br></text>
	<text id="2" class="title" style="font-size: 35px; color: #333;">#TheSharingCommunity<br></text><br>
	<text id="3" class="title" style="font-size: 35px; color: white;">We're a group of people who want to<br></text>
	<text id="4" class="title" style="font-size: 25px; color: #333;">create a platform for people to share physical household items with their neighbours, friends, aquaintences, and other people around them without having to know them!</text><br><br>
	<text id="5" class="title" style="font-size: 35px; color: white;">Librorum Started in February 2015<br></text>
	<text id="6" class="title" style="font-size: 25px; color: #333;">by a group of friends who wanted to know whether someone in their community had a particular video game and was ready to share it!</text>
	
	</div>
	
</html>