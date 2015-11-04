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
	<script type="text/javascript" src="../includes/jquery.changePassword.js"></script>

	<script>
	
		SideBarWidth = "300px";
		AppBaseColor = "#AAA";
		AppTextColor = "#333";
		AppTextForegroundColor = "#333"
		AppIcon 	 = "url('../SettingsIcon.png') no-repeat " + AppBaseColor + " center";
		
		
		$(document).ready(function(){

			TabSelector();
			AppStyler();
		
		});
		
	</script>	
	
	<style>
		
	input.form, select.form {
		font-size: 25px; 
		font-family: SourceSans; 
		padding: 0px 20px 0px 20px; 
		height: 55px; 
		box-sizing: border-box;
		border: 0px;
		color: black;
		box-shadow: 0px 0px 20px rgba(0,0,0,.05);
		border-radius: 5px;
	}
	
    button.SUBMIT {
        height: 60px;
        outline: none;
        width: 200px;
        border: 0px;
        font-size: 25px;
        font-family: SourceSans;
        margin-left: 380px;
        background: #688B25;
        color: white;
        border-radius: 10px;
        box-sizing: border-box;
		box-shadow: 0px 0px 10px rgba(0,0,0,.05);
        border-radius: 5px;
    }
	</style>

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
							
						<div class="APP-ICON"></div>
						
						<div class="APP-TITLE">
							<text class="APP-TITLE">Account Settings</text>
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
					
								<div id="LANDING" class="tab-button">My Account Details</div>
								<div id="Button3" class="tab-button">Librorum Settings</div>
					
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
										<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing <b>Librorum Settings</b></text>
									</div>
									<div id="SETTINGS1" style="box-sizing: border-box; padding: 20px 50px 20px 50px; overflow-y: auto; height: 364px;'">
										<text style="font-size: 35px; color: #333;">General Settings</text><br><br>
										<div style="width: 100%; text-align: left;">
										<text style="font-size: 22px; color: #333;">
										<b>Account Password:</b>&nbsp;&nbsp;&nbsp;&nbsp;xxxxxxxx <span id='CHANGE-PASS' style='color: #4F81BD; cursor: pointer;'>Change Password</span><br>
										<div class='SPACER-10'></div>
										<div style='float: left;'><b>Email Notifications:&nbsp;&nbsp;&nbsp;&nbsp;<span id="EMN-SWITCH">ON</span></b>&nbsp;&nbsp;</div>
										<div id='TOGGLE-2' style=' float: left;'><i id='EMN-TOGGLE' style='cursor: pointer; font-size: 30px; color: green;' class='fa fa-toggle-on'></i></div><br>
										<div class='SPACER-10'></div>
										
										<script>
										$(document).ready(function(){
											
											$("#CHANGE-PASS").click(function(){
												$("#SETTINGS1").slideUp(400);
												$("#SETTINGS2").delay(400).slideDown(600);
											});
											
											$("#EMN-TOGGLE").click(function(){
												var emn = $("#EMN-SWITCH").text();
												if(emn === 'ON')
												{			
													$("#EMN-TOGGLE").addClass( "fa-rotate-180" );
													$("#EMN-TOGGLE").css('color', '#333');
													$("#TOGGLE-2").css('marginTop', '0px');
													$("#TOGGLE-2").css('marginLeft', '0px');
													$("#EMN-SWITCH").text('OFF');
												}else
												{
													$("#EMN-TOGGLE").removeClass( "fa-rotate-180" );
													$("#EMN-TOGGLE").css('color', 'green');
													$("#TOGGLE-2").css('marginTop', '1px');
													$("#TOGGLE-2").css('marginLeft', '8px');
													$("#EMN-SWITCH").text('ON');
												}
											});
											$("#DDT-TOGGLE").click(function(){
												var emn = $("#DDT-SWITCH").text();
												if(emn === 'ON ')
												{			
													$("#DDT-TOGGLE").addClass( "fa-rotate-180" );
													$("#DDT-TOGGLE").css('color', '#333');
													$("#TOGGLE-1").css('marginTop', '0px');
													$("#TOGGLE-1").css('marginLeft', '0px');
													$("#DDT-SWITCH").text('OFF');
												}else
												{
													$("#DDT-TOGGLE").removeClass( "fa-rotate-180" );
													$("#DDT-TOGGLE").css('color', 'green');
													$("#TOGGLE-1").css('marginTop', '1px');
													$("#TOGGLE-1").css('marginLeft', '3px');
													$("#DDT-SWITCH").text('ON ');
												}
											});
										});
										</script>
										
										<div style='float: left;'><b>Dark Dashboard Theme:&nbsp;&nbsp;&nbsp;&nbsp;<span id="DDT-SWITCH">OFF</span></b>&nbsp;&nbsp;</div>
										<div id='TOGGLE-1' style=' float: left;'><i  id='DDT-TOGGLE' style='font-size: 30px; color: #333; cursor: pointer; ' class='fa fa-toggle-on fa-rotate-180'></i>&nbsp;&nbsp;</div><text style='font-size: 18px; color: #333;'>(Unstable)</text><br>
										</text>
										</div>
									</div>
									
									<div id="SETTINGS2" style="background: #DDD; display: none; box-sizing: border-box; padding: 20px 50px 20px 50px; overflow-y: auto; height: 364px;'">
										<text style="font-size: 35px; color: #333;">Change your password</text><br><br>
										
										<form id="CHANGE-PASSWORD" method="post">
										<input class="form" name="Password" type="password" style="width: 400px; font-family: 'Arial Black';" placeholder="New Password">
										   
										<div class="SPACER-15"></div>
										
										<input class="form" name="ConfirmPassword" type="password" style="width: 400px; float: top; font-family: 'Arial Black';"
											   placeholder="Confirm Password"><br>
											   
										<div class="SPACER-5"></div>
										
										<div id="E-1" style="display: none; margin-top: 5px;">
											<text style="color: #000; font-size: 15px;">Your password cannot be empty!</text>
										</div>

										<div id="E-2" style="display: none; margin-top: 5px;">
											<text  style="color: #000; font-size: 15px;">The passwords don't match!</text>
										</div>

										<div id="E-3" style="display: none; margin-top: 5px;">
											<text  style="color: #000; font-size: 15px;">The password is too short.</text>
										</div>

										<div class="SPACER-10"></div>
										
										<button type="submit" class="SUBMIT" style="margin: 0 auto; background: #4E80BC;">Continue &nbsp; <img id="loader" src="../accounts/loader-white.gif" style="display: none; position: absolute; width: 35px; height: 35px;"></button>
										</form>

									</div>
								</div>	

								<div  id="LANDINGDiv" class="containers animated fadeInUp" style="display: block; overflow: hidden;">
									
									<div class="APP-CONTENT-TITLE animated fadeInDown">
										<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing <b>My Account Details</b></text>
									</div>
									<div style="box-sizing: border-box; padding: 10px; overflow-y: auto; height: 364px;'">
										<div style="width: 100%; height: 140px; float: top;">
											<?php
												print "<img id='IMAGE' src='../images/users/".$_SESSION['MY_DP']."' style='width: 120px; margin-top: 10px; float: left; margin-left: 10px; height: 120px;'>";
											?>
											<div style="float: left; width: 550px; margin-top: 10px; box-sizing: border-box; text-align: left; padding: 5px 10px 10px 20px ; ">
												<text style="font-size: 35px; color: #333;"><b><?php echo $_SESSION['MY_NAME']; ?></b></text><br>
												<div class='SPACER-5'></div>
												<text style="font-size: 25px; color: #333;"><?php echo $_SESSION['MY_EMAIL']; ?></text><br>
												<div class="SPACER-5"></div>
												<text style="font-size: 20px; color: #333;"><?php echo "+91 ".$_SESSION['MY_PHONE']; ?></text><br>
											</div>
										</div>
											<div style="width: 100%; height: 100px; box-sizing: border-box; float: top; padding: 5px 10px 10px 15px; text-align: left; ">
											<text style="font-size: 20px; color: #333;">
											<b>Birthday: </b>&nbsp;
											<?php 
												
												$query = "SELECT * FROM users WHERE USER_ID = ".$_SESSION['MY_ID'];
												$result = mysql_query($query);
												
												while($row = mysql_fetch_array($result))
												{
													$DOB = $row['DOB'];
													$ADDRESS = $row['ADDRESS'];
												}

												echo $DOB."<br><div class='SPACER-5'></div><b>Password: </b>&nbsp;";
												echo "**********";
												
												
												echo "<br><div class='SPACER-5'></div><b>Address: </b>&nbsp;".$ADDRESS;
											
											
												$query = "	SELECT groups.GROUP_ID, GROUP_NAME, CITY FROM librorum.user_group_relation
															INNER JOIN groups on user_group_relation.GROUP_ID = groups.GROUP_ID
															WHERE USER_ID = ".$_SESSION['MY_ID'];
																	
												$result = mysql_query($query);
												
												while($data = mysql_fetch_array($result))
												{
													$GROUP_NAME = ucwords(strtolower($data['GROUP_NAME'].", ".$data['CITY']));
													$GROUP_ID = $data['GROUP_ID'];
												}
												
												echo "<br><div class='SPACER-5'></div><b>Community: </b>&nbsp;".$GROUP_NAME;
												
											?></text><br>
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
