<html style="text-align: center;  height: 100%; width: 100%; overflow: hidden;">

	<title>Page Not Found - Error 404 | Librorum </title>
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
	<script type="text/javascript" src="../about/background.js"></script>
	
	
	<div class="header animated fadeInDown">
		<?php include('../includes/HeaderMenu.php'); ?>
	</div>
	
	<div id='front' class='animated fadeInUp'>
		<div id='spacer'></div>
		<div class='SPACER-30'></div>
		<div class='SPACER-10'></div>
	<text style="font-size: 50px; color: #333;">Whoops, This item doesn't exist!</text><br>
	<div class='SPACER-10'></div>
	<text style="font-size: 35px; color: White;">The item you are looking for doesn't exist<br> or may have been removed by the owner!
	</text><br><div class='SPACER-5'></div>
	<text style="font-size: 30px; color: White;">Go back to <a style='font-size: 30px;' href='../library'><b>Browse Library</b></a></text>
	<div class='SPACER-5'></div>
	<text style="font-size: 20px; color: #333;">#error #Whoops #ItemNotFound #UhOh</text><br>
	</div>
</html>