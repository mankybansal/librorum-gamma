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
	<link rel="icon" type="image/ico" href="http://www.librorum.in/beta/favicon.ico"/>

	<!-- JAVASCRIPT LINKS -->
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.logout.js"></script>
	<script type="text/javascript" src="../includes/jquery.color.js"></script>
	<script type="text/javascript" src="../includes/BackgroundBubbles.js"></script>
	<script type="text/javascript" src="../includes/jquery.dashboard.js"></script>

	
	<script>
	
		SideBarWidth = "300px";
		AppBaseColor = "#1857B6";
		AppTextColor = "#1857B6";
		AppTextForegroundColor = "#FFF";
		AppIcon 	 = "url('../HelpIcon.png') no-repeat " + AppBaseColor + " center";
		
		$(document).ready(function(){
			
			AppStyler();
			TabSelector();
			
		});
		
	</script>
	
	<style>
	text.HELP-TITLE {
		font-size: 30px; 
		font-weight: bold;
		color: #1857B6;
	}	
	
	text.HELP-TEXT {
		font-size: 20px; 
		color: #000;
	}
	
	div.HELP-ANSWER {
		width: 100%;
		box-sizing: border-box;
		padding: 20px 50px 20px 50px; 
	}
	</style>

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
						<text class="APP-TITLE">Help</text>
					</div>
					<!--
					<div class="APP-SEARCH">
						<input type="text" placeholder="Search in Help" class="APP-SEARCH">
					</div>	
					-->

					<div class="APP-HEADER-BUTTON">
						<!--<text class="APP-HEADER-BUTTON">+ Post A Question</text>-->
					</div>

				</div>	

				<div class="APP-COLOR-BAR"></div>		

				<div class="APP-CONTENT">
						
					<div class="APP-SIDEBAR">
						<div class="APP-SIDEBAR-TITLE">
							<text class="APP-SIDEBAR-TITLE"><b>Help Topics</b></text>
						</div>
						<div  class="APP-SIDEBAR-CONTENT">
							
							<div id="MyProfile" class="tab-button">My Profile</div>
							<div id="Borrowing" class="tab-button">How do I borrow?</div>
							<div id="Button3" class="tab-button">How do I add or delete items?</div>
							<div id="Button4" class="tab-button">Who can see my stuff?</div>
							<div id="Button5" class="tab-button">Librorum Credits & Offers</div>
							<div id="Button6" class="tab-button">What else can I do?</div>
							<div id="Button7" class="tab-button">How can I help?</div>
							
						</div>
						<div class="APP-BACK-BUTTON">
							<text style="color: #333;"><i class="fa  fa-chevron-left"></i> &nbsp; Back to Dashboard&nbsp; <i class="fa fa-home"></i></text>
						</div>
					</div>
					
					<div class="APP-CONTENT-CONTAINER" >
						<div class="APP-CONTENT-DISPLAY">
											
							<div class="containers" id="LANDING" style="display: block; padding-top: 100px;">
								<i class="fa fa-arrow-circle-left" style="color: white; font-size: 100px;"></i><br>
								<text style="color: #FFF; font-size: 30px;">What topic do you want help on?</text><br>
								<text style="color: #FFF; font-size: 20px;">Select a topic on the left to get started</text>
							</div>
							
							<div id="MyProfileDiv" class="containers animated fadeInUp">
								<div class="APP-CONTENT-TITLE animated fadeInDown">
									<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing help on <b>My Profile</b></text>
								</div>
								<div class="HELP-ANSWER">
									<div class="SPACER-15"></div>
									<text class="HELP-TITLE">What can I do with My Profile?</text><br>
									<div class="SPACER-15"></div>
									<text class="HELP-TEXT">
									You can update your profile photo, address, communities, etc. Statistics about your account can be viewed as well. Click on <b>Settings</b> from the <b>Dashboard</b> to view information on how to log in to our Android application which is available on the <b>Google Play</b> store. 
									</text>
								</div>
							</div>
							
							<div id="BorrowingDiv" class="containers animated fadeInUp">
								<div class="APP-CONTENT-TITLE animated fadeInDown">
									<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing help on <b>How To Borrow</b></text>
								</div>
								<div class="HELP-ANSWER">
									<div class="SPACER-5"></div>
									<text class="HELP-TITLE">How do I borrow?</text><br>
									<div class="SPACER-15"></div>
									<text class="HELP-TEXT">To borrow items, find something in your community's library and click on it. On the page that shows information about the item, <br> click on the <b>Borrow Now</b> button. 
													<br><br>A request to borrow that item has now been placed. When the owner accepts the request, you can co-ordinate with the lender and pick the item up from an agreed upon location.
													<br><br>When you're ready to return the item, click on <b>Return Now</b> from <b>Notifications</b> and then you can return the item.
									</text>
								</div>
							</div>
							
							<div id="Button3Div" class="containers animated fadeInUp">
								<div class="APP-CONTENT-TITLE animated fadeInDown">
									<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing help on <b>Adding / Deleting Items</b></text>
								</div>
								<div class="HELP-ANSWER">
									<div class="SPACER-15"></div>
									<text class="HELP-TITLE">How do I add or delete my items?</text><br>
									<div class="SPACER-15"></div>
									<text class="HELP-TEXT">To add items, click on <b>My Items</b> from the <b>Dashboard</b> and then select the <b>Add Multiple Items</b> option from the left sidebar. Fill the details on the pop-up and click <b>Add</b>. The item will then be visible in your community's library! 
																		<br><br>To delete items, from the same menu, select the <b>All Items</b> option, which will show you all the items you've added. On each item, there is a <b>Remove</b> button which will remove it from the library completely.</text>
								</div>
							</div>
						
							<div id="Button4Div" class="containers animated fadeInUp">
								<div class="APP-CONTENT-TITLE animated fadeInDown">
									<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing help on <b>Viewing Items</b></text>
								</div>
								<div class="HELP-ANSWER">
									<div class="SPACER-15"></div>
									<text class="HELP-TITLE">Who can see my profile and items?</text><br>
									<div class="SPACER-15"></div>
									<text class="HELP-TEXT"> People who have borrowed your items or who have lended you items can see your profile. All users of only your community can see items that you have added to your library.
																			The adminsitrators of your community can view your account details and items as well for management purposes only.
																			Do contact us if your information is being misused in some manner.</text>
								</div>
							</div>
						
							<div id="Button5Div" class="containers animated fadeInUp">
								<div class="APP-CONTENT-TITLE animated fadeInDown">
									<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing help on <b>Credits & Offers</b></text>
								</div>
								<div class="HELP-ANSWER">
									<div class="SPACER-15"></div>
									<text class="HELP-TITLE">How does the Credit System work?</text><br>
									<div class="SPACER-15"></div>
									<text class="HELP-TEXT">
									Whenever you lend an item, your account recieves credits from the borrower as a token of appreciation. You can use these credits for borrowing someone else's items or you can redeem them on special offers & coupons accross our sharing partners.
									<br><br>When you borrow an item, a specific amount of credits is deducted from your account and 70%-80% of it is transferred to the lender's account. You can earn credits by lending your own items on the site.
									</text>
								</div>
							</div>
							
							<div id="Button6Div" class="containers animated fadeInUp">
								<div class="APP-CONTENT-TITLE animated fadeInDown">
									<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing help on <b>Other Features of Librorum</b></text>
								</div>
								<div class="HELP-ANSWER">
									<div class="SPACER-10"></div>
									<text class="HELP-TITLE">Any other features?</text><br>
									<div class="SPACER-15"></div>
									<text class="HELP-TEXT">
									If you'd like to help run Librorum in your community, contact us and we'll tell you what you can do! Librorum will soon have a credit system that rewards you for lending items on our library. Also, our messaging feature will be coming soon from which you can send messages to a lender/borrower.
									<br><br>Soon, you'll be able to find used items that people want to sell on Librorum and buy them right off our library. You'll be able to add items that people can borrow or buy from you! Stay tuned for more information about this new feature!
									</text>
								</div>
							</div>	
							
							<div id="Button7Div" class="containers animated fadeInUp">
								<div class="APP-CONTENT-TITLE animated fadeInDown">
									<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing help on <b>How do I Help?</b></text>
								</div>
								<div class="HELP-ANSWER">
									<div class="SPACER-15"></div>
									<text class="HELP-TITLE">How can I help Librorum?</text><br>
									<div class="SPACER-15"></div>
									<text class="HELP-TEXT">
									You can help us by speading the word and by telling people the advantages of Librorum! Participate in our user feedback program and help us make the services better. Help by reporting bugs and errors that you come accross while using our site. Be a responsible borrower/lender and be polite to your fellow community members.
									Contact your administrator to find out if you can help with Librorum events or help with running the service in your community!
									
									</text>
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
