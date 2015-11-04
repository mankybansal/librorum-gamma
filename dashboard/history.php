<?PHP
	
	ERROR_REPORTING(0);	

	//PREREQUISITE VARIABLES FOR THE SessionValidate.php PAGE
	$REDIRECT_PATH = "";
	$MY_PAGE_SET = TRUE;
	$LOGIN_PAGE_SET = FALSE;
	$LOGIN_REQUIRED = TRUE;

	//THIS SCRIPT VALIDATES THE CURRENT SESSION
	include('../includes/SessionValidate.php');
	
	//CONNECT SCRIPT FOR DATABASE ACCESS
	include '../includes/ServerConnect.php';
	
	//OTHER PAGE SETTINGS
	$DASHBOARD_MENU = FALSE;

?>	

<!DOCTYPE html>
<html>

<head>
	
	<title>Dashboard | Librorum - The Sharing Community</title>
	
	<!-- META TAGS. -->
	<meta name="description" content="Librorum - The Sharing Community, the one stop place to see what you can borrow in your community. We make sharing beneficial by giving back more when you lend.">
	<meta name="keywords" content="Librorum, Sharing, Community, Rentals, Community Sharing, Sharing in Bengaluru">
	<meta name="author" content="Librorum Web Team">
	<meta charset="UTF-8">
	
	<!-- LINKS FOR FILES REQUIRED ON PAGE. -->
	<link href="../css/MainSheetCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/AnimateCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/FontAwesomeCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/DashboardApps.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css" />
	<link rel="icon" type="image/ico" href="http://www.librorum.in/beta/favicon.ico"/>

	<!-- JAVASCRIPT LINKS -->
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.logout.js"></script>
	<script type="text/javascript" src="../includes/jquery.color.js"></script>
	<script type="text/javascript" src="../includes/jquery.dashboard.js"></script>
	<script type="text/javascript" src="../includes/BackgroundBubbles.js"></script>
	<script src="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	
	<script>
	
		SideBarWidth = "300px";
		AppBaseColor = "#009E3B";
		AppTextColor = "#333";
		AppIcon 	 = "url('../HistoryIcon.png') no-repeat " + AppBaseColor + " center";
		
		$(document).ready(function(){

			TabSelector();
			AppStyler();
		
		});
		
	</script>

</head>

<body class="animated fadeIn">
	
	<canvas id="BODY-BACKGROUND"></canvas>
		
	<div id="BODY-FOREGROUND">

		<div class="header animated fadeInDown">
		<?php include('../includes/HeaderMenu.php'); ?>
		</div>
	
		<!-- VIEWPORT SPACER -->
		<div class="viewport-spacer" id="spacer-1"></div>
		<!-- VIEWPORT SPACER -->

		<div class="content">	
			<div class="animated fadeInUp APP-CONTAINER">
				
				<div class="APP-HEADER">
						
					<div class="APP-ICON"></div>
					
					<div class="APP-TITLE">
						<text class="APP-TITLE">Borrow History</text>
					</div>
					
					<div class="APP-SEARCH">
						<input type="text" placeholder="Search in Borrow History" class="APP-SEARCH">
					</div>		

					<div class="APP-HEADER-BUTTON">
						<text class="APP-HEADER-BUTTON">+ Button Here</text>
					</div>

				</div>	

				<div class="APP-COLOR-BAR"></div>		

				<div class="APP-CONTENT">
						
					<div class="APP-SIDEBAR">
						<div class="APP-SIDEBAR-TITLE">
							<text class="APP-SIDEBAR-TITLE"><b>Actions</b></text>
						</div>
						<div  class="APP-SIDEBAR-CONTENT">
							
							<div id="Button1" class="button">History Action 1</div>
							<div id="Button2" class="button">History Action 2</div>
							<div id="Button3" class="button">History Action 3</div>
							
						</div>
					</div>
					
					<div class="APP-CONTENT-CONTAINER" >
						<div class="APP-CONTENT-DISPLAY">
											
							<div class="containers" id="LANDING" style="display: block; padding-top: 100px;">
								<i class="fa fa-arrow-circle-left" style="color: white; font-size: 100px;"></i><br>
								<text style="color: #FFF; font-size: 30px;">What history do you want to see?</text><br>
								<text style="color: #FFF; font-size: 20px;">Select a topic on the left to get started</text>
							</div>
							
							<div id="Button1Div" class="containers">
								<div class="APP-CONTENT-TITLE">
									<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing History of <b>Borrowing 1</b></text>
								</div>
							</div>
							
							<div id="Button2Div" class="containers">
								<div class="APP-CONTENT-TITLE">
									<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing History of <b>Borrowing 2</b></text>
								</div>
							</div>
							
							<div id="Button3Div" class="containers">
								<div class="APP-CONTENT-TITLE">
									<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing History of <b>Borrowing 3</b></text>
								</div>
							</div>
							
						</div>
					</div>
		
				</div>
				
			</div>	
		</div>	
		
		<!-- VIEWPORT SPACER -->
		<div class="viewport-spacer" id="spacer-2"></div>
		<!-- VIEWPORT SPACER -->
			
		<div class="footer animated fadeIn">
			<div class="BOTTOM-MENU-BACKEND">
				<text>
					MMXIV &copy; Copyright Librorum. All Rights Reserved.
				</text>
			</div>
		</div>
	
	</div>
	
</body>
	
</html>
