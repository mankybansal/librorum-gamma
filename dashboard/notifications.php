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
	
	if($_SESSION['MY_STATUS']!="CONFIRMED")
	{
		
		Print	"
		<script>
		   parent.location.href  = '../dashboard' ;
		</script>
		";
		exit();
	}


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
	<link rel="icon" type="image/ico" href="http://www.librorum.in/beta/favicon.ico"/>

	<!-- JAVASCRIPT LINKS -->
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.logout.js"></script>
	<script type="text/javascript" src="../includes/jquery.color.js"></script>
	<script type="text/javascript" src="../includes/BackgroundBubbles.js"></script>
	<script type="text/javascript" src="../includes/ColorFinder.js"></script>
	<script type="text/javascript" src="../includes/jquery.dashboard.js"></script>
	<script type="text/javascript" src="scripts/jquery.notifications.js"></script>
	<script type="text/javascript" src="scripts/jquery.formatDate.js"></script>

	<script>
	
		SideBarWidth = "300px";
		AppBaseColor = "#EF9B00";
		AppTextColor = "#EF9B00";
		AppTextForegroundColor = "#333";
		AppIcon 	 = "url('../NotificationsIcon.png') no-repeat " + AppBaseColor + " center";

		$(document).ready(function(){

			TabSelector();
			AppStyler();
		
		});
	</script>
	
	<style>
	div.ITEM-LIST {
	float: top;
	display: inline-block;
	box-sizing: border-box;
	padding: 15px 15px 15px 15px;
	width: 100%;
	margin: 0 auto;
	margin-top: 5px;
	border-radius: 10px; 
	min-height: 90px;
	padding-left: 30px;
	text-align: left;
}

div.noNotifications {
	border-radius: 0px 0px 10px 10px; 
	padding-top: 90px; 
	box-sizing: border-box; 
	background: #EEE; 
	text-align: center; 
	height: 335px; 
}

span.user{
	cursor: pointer;
	padding: 2px 5px 2px 5px;
	margin: 0px 5px 0px 5px;
	background: rgba(255,255,255,0.6);
	border-radius: 5px;

}

span.user:hover {

background: rgba(255,255,255,1);
box-shadow: 0px 0px 5px rgba(0,0,0,0.2);
}

span.user2{
	cursor: pointer;
	padding: 2px 5px 2px 5px;
	margin: 0px 5px 0px 5px;
	background: rgba(255,255,255,0.1);
	border-radius: 5px;
	color: #AAA;

}

div.user-info{
width: 400px; height: 200px; background: rgba(255,255,255,0.3); margin-top: 10px; margin-bottom: 10px; border-radius: 10px;
box-sizing: border-box;
padding: 20px;
display: none;
}

div.item-actions {
	float: right; 
	min-width: 40px; 
	cursor: pointer;
	text-align: center; 
	padding: 4px; 
	border-radius: 5px; 
	min-height: 5px; 
	margin: 2px;   
	background: rgba(255,255,255,0.3);
}


div.actionContainer {
	float: right; 
	height: 70px; 
	margin-top: 0px; 
	width: 200px; 
}

text.T333-15PX{
	color: #333;
	font-size: 15px;
}
text.T333-18PX{
	color: #333;
	font-size: 18px;
}
text.T333-25PX{
	color: #333;
	font-size: 25px;
}
text.TEEE-15PX{
	color: #EEE;
	font-size: 15px;
}
text.TEEE-18PX{
	color: #EEE;
	font-size: 18px;
}
text.TEEE-25PX{
	color: #EEE;
	font-size: 25px;
}
</style>

</head>

<body class="animated fadeIn">

	<div id="BODY-ACTIONS">
		
		<div style="float: top; width: 100%; height: 30px;"><div id="close2" style="cursor: pointer; float: right;" ><text style="color: #333"> Close this window</text> &nbsp; <i class="fa fa-remove"></i></div></div>
		<div class="SPACER-40"></div>
		
		<div id="deniedAcc" class="action-containers" style='text-align: center; min-height: 400px;'>
			<div style='display: inline-block; width: 400px; margin: 0 auto;'>
				<div class='SPACER-40'></div>
				<div class='SPACER-40'></div>
				<text style="color: #333; font-size: 30px;">
				The user must accept your request for you to be able to get contact details! You'll have to wait a while!
				</text>
			</div>
		</div>
		<div id="user" class="action-containers" style='text-align: center; min-height: 400px;'>
			<div style='display: inline-block; min-width: 10%; margin: 0 auto;'>
				<div style='width: 500px; height: 100%; max-height: 400px; background: #333; text-align: left; box-sizing: border-box; padding: 30px; float: left;'>
				<text style="color: #EEE; font-size: 20px;">
				<div class = 'user_5' style="width: 150px; height: 150px; overflow: none; margin: 0 auto; border: 3px solid #EEE;"></div><br>
				This is how you contact:<br>
				<div class="SPACER-5"></div>
				<text style="font-size: 27px;"><i class='fa fa-user'></i>&nbsp;&nbsp;&nbsp;<b><span class = 'user_1'></span></b></text><br>

				<i class='fa fa-envelope'></i>&nbsp;&nbsp;&nbsp; <span class = 'user_2'></span><br>
				<i class='fa fa-phone'></i>&nbsp;&nbsp;&nbsp; <span class = 'user_3'></span><br>
				<i class='fa fa-home'></i>&nbsp;&nbsp;&nbsp; <span class = 'user_4'></span><br>

				</text>
				</div>	
				
				<div style='width: 500px; height: 100%; max-height: 400px;background: #333; text-align: left; box-sizing: border-box; padding: 30px; float: left; margin-left: 30px;'>
				<text style="color: #EEE; font-size: 20px;">
				<div class = 'admin_5' style="width: 150px; height: 150px; overflow: none; margin: 0 auto; border: 3px solid #EEE;"></div><br>
				Your community administrator:<br>
				<div class="SPACER-5"></div>
				<text style="font-size: 27px;"><i class='fa fa-user'></i>&nbsp;&nbsp;&nbsp;<b><span class = 'admin_1'></span></b></text><br>

				<i class='fa fa-envelope'></i>&nbsp;&nbsp;&nbsp; <span class = 'admin_2'></span><br>
				<i class='fa fa-phone'></i>&nbsp;&nbsp;&nbsp; <span class = 'admin_3'></span><br>
				<i class='fa fa-home'></i>&nbsp;&nbsp;&nbsp; <span class = 'admin_4'></span><br>

				</text>
				</div>
				
				
				
			</div>
			<br>
			<div class="SPACER-15"></div>
			<div class="SPACER-5" style="width: 700px; margin: 0 auto;">
				<text style="font-size: 18px; color: #333">
				Use this information for contacting the user only for lending/borrowing queries. 
				Do not share this information without the user's consent! 
				Contact the Administrator of your community if you have problems contacting this user!
			</text><br>
</div>
				
		</div>

		
	</div>
	
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
							
						<div class="APP-ICON"></div>
						
						<div class="APP-TITLE">
							<text class="APP-TITLE">My Notifications</text>
						</div>

					</div>	

					<div class="APP-COLOR-BAR"></div>		

					<div class="APP-CONTENT">
							
						<div class="APP-SIDEBAR">
							<div class="APP-SIDEBAR-TITLE">
								<text class="APP-SIDEBAR-TITLE"><b>Actions</b></text>
							</div>
							<div  class="APP-SIDEBAR-CONTENT">
							
								<div id="LANDING" class="tab-button">All Notifications</div>
								
								<div style="width: 95%; height: 170px; background: #CCC; float: top; margin: 0 auto; margin-top: 50px;  box-sizing:border-box; padding: 20px;  ">
								
									<text style="font-size: 18px; color: #333; "><i class='fa fa-lightbulb-o'></i> &nbsp; <b>Helpful Tip:</b></br></text>
									<text style="font-size: 18px; color: #333; ">
									Click on a user's name to see their contact details. <br>
									</text><text style="font-size: 16px; color: #333; ">
									NOTE: You can only do this if the user wants to borrow, return or lend you something.</text>
								</div>

							</div>
							<div class="APP-BACK-BUTTON">
								<text style="color: #333;"><i class="fa  fa-chevron-left"></i> &nbsp; Back to Dashboard&nbsp; <i class="fa fa-home"></i></text>
							</div>
						</div>
						
						<div class="APP-CONTENT-CONTAINER" >
							<div class="APP-CONTENT-DISPLAY">

								<div  id="LANDINGDiv" class="containers animated fadeInUp" style="display: block; overflow: hidden;">
										<div class="APP-CONTENT-TITLE animated fadeInDown">
											<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing <b>All Notifcations</b></text>
										</div>	
										<div style="box-sizing: border-box; padding: 10px; overflow-y: auto; height: 364px; ">
											<div id="load">

											
												<div id="loading" style='width: 680px; height: 344px; box-sizing: border-box; padding-top: 130px; position: absolute; z-index: 3; background: #ddd; '>
													<text style="color: #333; font-size: 60px;"><i class='fa fa-circle-o-notch fa-spin'></i></text><br>
													<text style="color: #333; font-size: 20px;">Loading Notifications...</text>
												</div>												
												
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

