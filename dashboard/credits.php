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

	//CONNECT SCRIPT FOR DATABASE ACCESS
	include '../includes/ItemData.php';
	
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
	<meta charset="UTF-8"
	
	<!-- LINKS FOR FILES REQUIRED ON PAGE. -->
	<link href="../css/MainSheetCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/AnimateCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/FontAwesomeCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/DashboardApps.css" rel="stylesheet" type="text/css"/>
	<link rel="icon" type="image/ico" href="http://www.librorum.in/beta/favicon.ico"/>

	<!-- JAVASCRIPT LINKS -->
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.logout.js"></script>
	<script type="text/javascript" src="../includes/jquery.color.js"></script>
	<script type="text/javascript" src="../includes/BackgroundBubbles.js"></script>
	<script type="text/javascript" src="../includes/ColorFinder.js"></script>
	<script type="text/javascript" src="../includes/jquery.dashboard.js"></script>

	<script>
	
		SideBarWidth = "300px";
		AppBaseColor = "#000";
		AppTextColor = "#000";
		AppTextForegroundColor = "#EEE";
		AppIcon 	 = AppBaseColor;
		
		
		$(document).ready(function(){

			TabSelector();
			AppStyler();
		
		});
		
	</script>	
	
	<script>
	$(document).ready(function(){
			pushListener();
			setInterval(function(){
				pushListener();
			},500);

	});
	
	function pushListener()
	{
		var dataString = "ACTION=credits";
		$.post('scripts/push.php', dataString,  function success(data){
		
				$(".myCredits").text(data.trim());
				
		});	
	}
	</script>
	

</head>

<body class="animated fadeIn">

	
	<div id="BODY-CONTENT">
	
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
							
						<div class="APP-ICON">
                            <div style="width: 100%; height: 12px;"></div>
                            <text style="font-size: 15px;"><span class="myCredits"></span></text><br>
                            <div style="margin-top: -7px;"><text style="font-size: 8px;">Remaining</text></div>
						</div>
						
						<div class="APP-TITLE">
							<text class="APP-TITLE">Credit Center</text>
						</div>
						<!--
						<div class="APP-SEARCH">
							<input type="text" placeholder="Search in My Items" class="APP-SEARCH">
						</div>		

						<div class="APP-HEADER-BUTTON" id="AddItem">
							<text class="APP-HEADER-BUTTON">+ Add New Item</text>
						</div>
						-->
					</div>	

					<div class="APP-COLOR-BAR"></div>		

					<div class="APP-CONTENT">
							
						<div class="APP-SIDEBAR">
							<div class="APP-SIDEBAR-TITLE">
								<text class="APP-SIDEBAR-TITLE"><b>Actions</b></text>
							</div>
							<div  class="APP-SIDEBAR-CONTENT">
					
								<div id="LANDING" style='color: #EEE;' class="tab-button">My Credits</div>
								<div id="Button3" class="tab-button">Redeem Credits</div>
					
							</div>
							<div class="APP-BACK-BUTTON">
								<text style="color: #333;"><i class="fa  fa-chevron-left"></i> &nbsp; Back to Dashboard&nbsp; <i class="fa fa-home"></i></text>
							</div>
						</div>
						
						<div class="APP-CONTENT-CONTAINER" >
							<div class="APP-CONTENT-DISPLAY">
								<!--					
								<div class="containers" style="display: block; padding-top: 100px;">
									<i class="fa fa-arrow-circle-left" style="color: #333; font-size: 100px;"></i><br>
									<text style="color: #333; font-size: 30px;">Which items do you want to view?</text><br>
									<text style="color: #333; font-size: 20px;">Select an option on the left to get started</text>
								</div>
								-->
								
								<div id="Button3Div" class="containers animated fadeInUp">
									<div class="APP-CONTENT-TITLE animated fadeInDown">
										<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing how to <b>Redeem Credits</b></text>
									</div>
									<div style="box-sizing: border-box; padding: 20px 50px 20px 50px; overflow-y: auto; height: 364px;'">
										
									</div>
								</div>	

								<div  id="LANDINGDiv" class="containers animated fadeInUp" style="display: block; background: #000; overflow: hidden;">
									
									
									<div style="box-sizing: border-box; padding: 10px; overflow-y: auto; height: 364px;'">
										<div class='SPACER-40'></div>
										<div style='width: 90%; height: 288px; box-sizing: border-box; padding: 35px; margin: 0 auto;'>
										
											<text style='font-size: 40px; color: white;'>Your account has</text><br>
											<text style='font-size: 90px; color: white;'><b><span class="myCredits"></span></b></text><br>
											<text style='font-size: 40px; color: white;'>available credits</text><br>
											<a href='help.php'><text style='font-size: 25px; color: #0066FF;'><i class='fa fa-question-circle'></i>&nbsp;&nbsp;How do I get more credits?</text><br></a>
										
										</div>
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
		
	</div>
	
</body>
	
</html>
