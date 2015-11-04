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
	
	if($_SESSION['MY_TYPE']!="ADMIN")
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
	<script type="text/javascript" src="scripts/jquery.borrowedItems.js"></script>

    <script>
	
		SideBarWidth = "300px";
		AppBaseColor = "#ed1c24";
		AppTextColor = "#ed1c24";
        AppTextForegroundColor = "white";
		AppIcon 	 = "url('../AdminIcon.png') no-repeat " + AppBaseColor + " center";
		
		$(document).ready(function(){
			
            AdaptiveBackgrounds();
			AppStyler();
			TabSelector();
	
		});
	</script>
	
</head>

<body class="animated fadeIn">

	<div id="BODY-ACTIONS">

	</div>
	
	<script>
		$(document).ready(function(){
			var option; 
			var confirmOption;
			var userID;
			$(".confirm").click(function()
			{
				userID = $(this).attr('id');
				$("#ALERT").fadeIn(500);
				$("#notification-text").html("Are you sure you want to <b>ADD</b> this user to your community?");
				option = 'confirm';
			});
			
			$(".deny").click(function()
			{
				userID = $(this).attr('id');
				$("#ALERT").fadeIn(500);
				$("#notification-text").html("Are you sure you want to <b>DENY</b> this user to join your community?");
				option = 'deny';
			});
			
			$("#cancel").click(function()
			{
				$("#ALERT").fadeOut(500);
			});
	
			$("#okay").click(function()
			{
				var datastring;
				$("#ALERT").fadeOut(500);
				if(option === 'confirm')
				{
					dataString  = 'ACTION=confirm&USER_ID=' + userID;
					$.post('scripts/admin_functs.php', dataString,  function success(data){
						if(data.trim() === '1')
						{
							$("#ALERT").fadeOut(500);
							$("#user"+userID).fadeOut(1000);
						}else
						{
							alert("ERROR TRY AGAIN");
						}
					});
				}
				else
				{
					dataString  = 'ACTION=deny&USER_ID=' + userID;
					$.post('scripts/admin_functs.php', dataString,  function success(data){
						if(data.trim() === '1')
						{
							$("#ALERT").fadeOut(500);
							$("#user"+userID).fadeOut(1000);
						}else
						{
							alert("ERROR TRY AGAIN");
						}
					});
				
				}
			});
	
		});
	</script>
	
	<style>
	#ALERT {
		position: absolute;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: 2;
		background: rgba(50,50,50,0.8);
		text-align: center;
		box-sizing: border-box;
		padding: 200px;
		display: none;
	}	
	
	div.alert {
	display: inline-block; margin-top: 20px; min-width: 30px; min-height: 10px; font-family: SourceSans; color: black; border-radius: 5px; padding: 5px; background: #CCC; cursor: pointer;
	
	}
	
	
div.ITEM-LIST {
	float: top;
	box-sizing: border-box;
	padding: 15px;
	width: 100%;
	margin: 0 auto;
	height: 80px;
	padding-left: 90px;
	text-align: left;
	margin-top: 5px;
	overflow: hidden;
	cursor: pointer;
	background: #DDD;
}

div.ITEM-LIST:hover {
	background: #CCC;
}
	</style>
	
	<div id="ALERT" >
		<div class="animated fadeInLeft" style="width: 400px; height: 250px; box-shadow: 0px 0px 70px rgba(255,255,255,0.5); box-sizing: border-box; padding: 30px; border-radius: 10px; margin: 0 auto; background: #333">
			
			<text style="color: #EEE; font-size: 70px;"><i class="fa fa-warning"></i></text><br>
			
			<text style="font-size: 20px; color: #EEE;"><span id="notification-text"></span></text><br>
			
			<div style="SPACER-40"></div>
			<div class="alert" id="okay">CONFIRM</div>
			<div class="alert" id="cancel">CANCEL</div>
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
							<text class="APP-TITLE">Admin Panel</text>
						</div>
						
					</div>	

					<div class="APP-COLOR-BAR"></div>		

					<div class="APP-CONTENT">
							
						<div class="APP-SIDEBAR">
							<div class="APP-SIDEBAR-TITLE">
								<text class="APP-SIDEBAR-TITLE"><b>Actions</b></text>
							</div>
							<div  class="APP-SIDEBAR-CONTENT">
								<div id="LANDING" class="tab-button" style="color: white;">General Overview</div>
								<div id="AllItems" class="tab-button">New Accounts</div>
								<div id="Borrowing" class="tab-button">All Accounts</div>
								<div id="Borrowing4" class="tab-button">All Items</div>
								<div id="Borrowing2" class="tab-button">Borrowed Items</div>
								<div id="Borrowing3" class="tab-button">Issues & Disputes</div>
								<div id="Button3" class="tab-button">Other Settings</div>
								

								
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
								
								<style>
								div.comm-user {
								width: 99%; height: 100px; box-sizing: border-box; padding: 5px;  background: #DDD; margin: 0 auto; margin-top: 7px; float: top; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
								}
								
								</style>
								
								<div id="BorrowingDiv" class="containers animated fadeInUp">
									<div class="APP-CONTENT-TITLE animated fadeInDown">
										<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing <b>All Accounts</b></text>
									</div>
									<div style="box-sizing: border-box; padding: 10px;  overflow-y: auto; height: 364px;'">
											<?php
											
												$query = "	SELECT groups.GROUP_ID, GROUP_NAME, CITY FROM librorum.admin_group_relation
																	INNER JOIN groups on admin_group_relation.GROUP_ID = groups.GROUP_ID
																	WHERE ADMIN_ID = ".$_SESSION['MY_ID'];
																	
												$result = mysql_query($query);
												
												while($data = mysql_fetch_array($result))
												{
													$GROUP_ID = $data['GROUP_ID'];
												}
												
												$query = "	SELECT * FROM users
																	INNER JOIN user_group_relation ON user_group_relation.USER_ID = users.USER_ID
																	WHERE GROUP_ID = ".$GROUP_ID."
																	AND ACCOUNT_STATUS = 'CONFIRMED'";
												$result = mysql_query($query);
												$count = mysql_num_rows($result);
												while($row = mysql_fetch_array($result))
												{
														$USER_NAME = $row['USER_NAME'];
														$USER_EMAIL = $row['EMAIL'];
														$USER_ID = $row['USER_ID'];
														$USER_PHONE = $row['PHONE_NUMBER'];
														$USER_ADDR = $row['ADDRESS'];
														$USER_DPLIN = $row['DP_LINK'];
														
														if (strlen($USER_ADDR) >40)
														{
															$USER_ADDR = substr($USER_ADDR, 0, 45)."...";
														}
														print "	<div class='comm-user' id='comm-user$USER_ID'>
																		<div style='width: 90px; height: 90px; float: left; overflow: hidden; background: url(\"../images/users/$USER_DPLIN\"); background-size: 100% 100%; '></div>
																		<div style='width: 425px; height: 90px; text-align: left;   float: left;  padding: 8px; box-sizing: border-box; margin-left: 5px;  overflow: hidden;'>
																			<text style='font-size: 22px; color:#333; '><b>$USER_NAME</b></text> &nbsp; <text style='font-size: 17px; color:#333; '>$USER_EMAIL</text><br>
																			<text style='font-size: 17px; color:#333; '><b>Mobile Number: </b>$USER_PHONE</text><br>
																			<text style='font-size: 17px; color:#333; '><b>Address: </b>$USER_ADDR</text>
																		
																		</div>
																		
																	
																	</div>";
												}
												
												if($count == 0)
												{
														Print 		"<div style='width: 100%; box-sizing: border-box; padding-top: 150px;  height: 100%; background: #ed1c24; '>
																			<text style='font-size: 25px; '><b>No new accounts created</b></text>
																		
																		</div>";
												}
											?>
									</div>
								</div>
								
								<div id="Borrowing2Div" class="containers animated fadeInUp">
									<div class="APP-CONTENT-TITLE animated fadeInDown">
										<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing <b>Borrowed Items</b></text>
									</div>
									<div style="box-sizing: border-box; padding: 10px; overflow-y: auto; height: 364px;'">
				
									<div id="load">
									</div>
												
									</div>
								</div>	
								
								<div id="Borrowing4Div" class="containers animated fadeInUp">
									<div class="APP-CONTENT-TITLE animated fadeInDown">
										<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing <b>All Items</b></text>
									</div>
									<div style="box-sizing: border-box; padding: 10px; overflow-y: auto; height: 364px;'">
				
									<div id="load2">
									</div>
												
									</div>
								</div>	
								
								<div id="Borrowing3Div" class="containers animated fadeInUp">
									<div class="APP-CONTENT-TITLE animated fadeInDown">
										<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing <b>Issues & Disputes</b></text>
									</div>
									<br>
									<br>
									<br>
									<br>
									<br><br>
									<br>
									Under Construction
								</div>	
								
								<div id="Button3Div" class="containers animated fadeInUp">
									<div class="APP-CONTENT-TITLE animated fadeInDown">
										<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing <b>Other Settings</b></text>
									</div>
									<br>
									<br>
									<br>
									<br><br>
									<br>
									<br>
									Under Construction
								</div>	

								<div  id="LANDINGDiv" class="containers animated fadeInUp" style="display: block; overflow: hidden;  background: url('kristal.png'); background-size: 100% 100%;">
									
									<div id="Loader" style='width: 100%; height: 100%; box-sizing: border-box; padding-top: 130px; position: absolute; z-index: 3; background: #ed1c24; '>
										<text style="color: #FFF; font-size: 80px;"><i class='fa fa-circle-o-notch fa-spin'></i></text><br>
										<text style="color: #FFF; font-size: 30px;">Loading...</text>
									</div>
									
									<script>
									$(document).ready(function(){
										setTimeout(function(){ $("#Loader").fadeOut(500)}, 3500);
									});
									</script>
									
									<?php
												$query = "	SELECT groups.GROUP_ID, GROUP_NAME, CITY FROM librorum.admin_group_relation
																	INNER JOIN groups on admin_group_relation.GROUP_ID = groups.GROUP_ID
																	WHERE ADMIN_ID = ".$_SESSION['MY_ID'];
																	
												$result = mysql_query($query);
												
												while($data = mysql_fetch_array($result))
												{
													$GROUP_NAME = ucwords(strtolower($data['GROUP_NAME'].", ".$data['CITY']));
													$GROUP_ID = $data['GROUP_ID'];
												}
												
												$query = "SELECT * FROM borrowed
																	INNER JOIN user_group_relation ON user_group_relation.USER_ID = borrowed.BORROWER_ID
																	WHERE GROUP_ID = ".$GROUP_ID;
												$result = mysql_query($query);					
												$GROUP_BORROWED = mysql_num_rows($result);
												
												$query = "SELECT * FROM items
																	INNER JOIN user_group_relation ON user_group_relation.USER_ID = items.OWNER_ID
																	WHERE GROUP_ID = ".$GROUP_ID;
												$result = mysql_query($query);					
												$GROUP_ITEMS = mysql_num_rows($result);
																							
												$query = "SELECT * FROM user_group_relation INNER JOIN users ON users.USER_ID = user_group_relation.USER_ID WHERE ACCOUNT_STATUS = 'CONFIRMED' AND GROUP_ID = ".$GROUP_ID;
												$result = mysql_query($query);
												$GROUP_COUNT = mysql_num_rows($result);
									?>
									
									<style>
										div.stats-white {
											height: 80px; 
											box-shadow: 0px 0px 30px rgba(0,0,0,0.3); 
											box-sizing: border-box;
											padding: 5px; 
											text-align: center; 
											background: #EDEDED; 
											width: 74.7%; 
											margin: 0 auto; 
											margin-top: 15px;
										}
									</style>
									
									<div style="width: 100%; height: 100%;">
									
										<div class="animated fadeInUp stats-white"  style=" margin-top: 45px; padding: 22px;" >
											<text style="color: #333; font-size: 30px;"><b><?php echo $GROUP_NAME; ?></b></text>									
										</div>
										
										<div  class="animated fadeInUp"  style="height: 60px; width: 90%; margin: 0 auto; margin-top: 15px;">
											<div style="height: 100%; width: 41.5%; float: left; background: green; margin-left: 8.5%; box-sizing: border-box; padding: 17px; text-align: center; ">
												<text style="font-size: 20px;">
													<i class="fa  fa-users"></i> &nbsp; <b><?php if($GROUP_COUNT!=1) {print $GROUP_COUNT."</b> group members"; }else{print $GROUP_COUNT."</b> group member"; } ?>
											</text>	
											</div>	
											<div style="height: 100%; width: 41.5%; float: left; background: #9b0000; box-sizing: border-box; padding: 17px; text-align: center; ">
												<text style="font-size: 20px;">
													<i class="fa  fa-circle-o"></i> &nbsp;  <b><?php if($GROUP_BORROWED!=1) {print $GROUP_BORROWED."</b> borrowed items"; }else{print $GROUP_BORROWED."</b> borrowed item"; } ?>
											</text>	
											</div>
										</div>
										
										<div  class="animated fadeInUp"  style="height: 60px; width: 74.7%; margin: 0 auto; background: #333; box-sizing: border-box; padding: 17px; text-align: center; ">
												<text style="font-size: 20px;">
													<i class="fa f fa-line-chart"></i> &nbsp; Your community has <b><?php print $GROUP_ITEMS; ?></b> items in it's library.
											</text>	
										</div>	
											
										<div  class="animated fadeInUp stats-white">
											<div style="float: left; height: 100%; width: 140px;  margin-left: 15px; box-sizing: border-box; padding-top: 23px; ">
											<text style="color: #333; font-size: 20px; ">
												<i class="fa fa-lightbulb-o"></i> &nbsp; <b>Useful Tips:</b> 
											</text>			
											</div>						
											<div style="float: left; height: 100%; width: 320px; box-sizing: border-box; margin-left: 10px;  padding-top: 10px;">
											<text style="color: #333; font-size: 17px; ">
												Meet the new users in person if you can. It helps build a stronger community!
											</text>	
											</div>						
										</div>
									
									</div>
																
								</div>					
								
								
								<style>
								div.new-user {
								width: 99%; height: 100px; box-sizing: border-box; padding: 5px;  background: #DDD; margin: 0 auto; margin-top: 7px; float: top; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
								}
								
								div.new-user-action {
								width: 100px; height: 35px; border-radius: 5px; margin-top: 7.5px; float: top;  padding: 8.5px; box-sizing: border-box; color: white; text-align: center;
								background: #AAA;
									transition: background-color 0.3s ease;
									transition: box-shadow 0.3s ease;
									transition: color 0.3s ease;
									box-shadow: 0px 0px 10px rgba(0,0,0,0);
									cursor: pointer;
									font-size: 15px; color: #333;
								
								}
								
								div.confirm:hover {
									background: #5AA831;
									box-shadow: 0px 0px 10px rgba(0,0,0,0.3);	
									color: white;
								}
								
								div.deny:hover {
									background: #D32D0A; 
									box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
									color: white;									
								}
								</style>
								<div id="AllItemsDiv" class="containers animated fadeInUp">
									<div class="APP-CONTENT-TITLE animated fadeInDown">
										<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing <b>New Accounts</b></text>
									</div>
									<div style="box-sizing: border-box; padding: 10px;  overflow-y: auto; height: 364px;'">
											<?php
												$query = "	SELECT * FROM users
																	INNER JOIN user_group_relation ON user_group_relation.USER_ID = users.USER_ID
																	WHERE GROUP_ID = ".$GROUP_ID."
																	AND ACCOUNT_STATUS = 'CWA'";
												$result = mysql_query($query);
												$count = mysql_num_rows($result);
												while($row = mysql_fetch_array($result))
												{
														$USER_NAME = $row['USER_NAME'];
														$USER_EMAIL = $row['EMAIL'];
														$USER_ID = $row['USER_ID'];
														$USER_PHONE = $row['PHONE_NUMBER'];
														$USER_ADDR = $row['ADDRESS'];
														$USER_DPLIN = $row['DP_LINK'];
														
														if (strlen($USER_ADDR) >40)
														{
															$USER_ADDR = substr($USER_ADDR, 0, 45)."...";
														}
														print "	<div class='new-user' id='user$USER_ID'>
																		<div style='width: 90px; height: 90px; float: left; overflow: hidden; background: url(\"../images/users/$USER_DPLIN\"); background-size: 100% 100%; '></div>
																		<div style='width: 425px; height: 90px; text-align: left;   float: left;  padding: 8px; box-sizing: border-box; margin-left: 5px;  overflow: hidden;'>
																			<text style='font-size: 22px; color:#333; '><b>$USER_NAME</b></text> &nbsp; <text style='font-size: 17px; color:#333; '>$USER_EMAIL</text><br>
																			<text style='font-size: 17px; color:#333; '><b>Mobile Number: </b>$USER_PHONE</text><br>
																			<text style='font-size: 17px; color:#333; '><b>Address: </b>$USER_ADDR</text>
																		
																		</div>
																		<div style='width: 120px; height: 90px; box-sizing: border-box; padding-left: 10px; float: left; margin-left: 5px;  overflow: hidden;'>
																			<div class='new-user-action confirm'  id='$USER_ID '>
																				Confirm &nbsp;<i class='fa fa-check'></i>
																			</div>
																			<div class='new-user-action deny' id='$USER_ID '>
																				Deny &nbsp;<i class='fa fa-remove'></i>
																			</div>
																		
																		</div>
																		
																	
																	</div>";
												}
												
												if($count == 0)
												{
														Print 		"<div style='width: 100%; box-sizing: border-box; padding-top: 150px;  height: 100%; background: #ed1c24; '>
																			<text style='font-size: 25px; '><b>No new accounts created</b></text>
																		
																		</div>";
												}
											?>
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

