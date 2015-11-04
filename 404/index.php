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
	<text style="font-size: 50px; color: #333;">Whoops, That's a 404 Error!</text><br>
	<div class='SPACER-10'></div>
	<text style="font-size: 40px; color: White;">This page doesn't exist on our server!
	</text><br><div class='SPACER-5'></div>
	<text style="font-size: 30px; color: White;">Go to the <a style='font-size: 30px;' href='http://www.librorum.in/gamma'><b>Home Page</b></a></text>
	<div class='SPACER-5'></div>
	<text style="font-size: 20px; color: #333;">#404error #Whoops #PageNotFound #UhOh</text><br>
	</div>
</html>