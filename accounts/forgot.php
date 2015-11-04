<?PHP
	
	ERROR_REPORTING(0);	

	//PREREQUISITE VARIABLES FOR THE SessionValidate.php PAGE
	$REDIRECT_PATH = "../dashboard/";
	$MY_PAGE_SET = FALSE;
	$LOGIN_PAGE_SET = TRUE;
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

	<title>Forgot Password | Librorum - The Sharing Community</title>
	
	<!-- META TAGS. -->
	<meta name="description" content="Librorum - The Sharing Community, the one stop place to see what you can borrow in your community. We make sharing beneficial by giving back more when you lend.">
	<meta name="keywords" content="Librorum, Sharing, Community, Rentals, Community Sharing, Sharing in Bengaluru">
	<meta name="author" content="Librorum Web Team">
	<meta charset="UTF-8">
	
	<!-- LINKS FOR FILES REQUIRED ON PAGE. -->
	<link href="../css/MainSheetCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/AnimateCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/FontAwesomeCSS.css" rel="stylesheet" type="text/css"/>
	<link rel="icon" type="image/ico" href="http://www.librorum.in/gamma/favicon.ico"/>
	
	<!-- JAVASCRIPT LINKS -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.resetPassword.js"></script>
	<script type="text/javascript" src="../includes/BackgroundBubbles.js"></script>
	
	<style>
	html {
		height: 100%;
		margin: 0;
		padding: 0;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	
	body {
		display: none;
		height: 100%;
		margin: 0;
		padding: 0;
		min-width: 1000px; 
		min-height: 600px;
		text-align: center;
		background-size: 100% 100%; 
		text-align: center;
	}
	
	div.header {
		width: 100%;
		min-width: 1000px; 
		height: 70px;
		float: top;
	}
	
	div.viewport-spacer {
		width: 100%;
		min-height: 50px;
		min-width: 1000px; 
		float: top;
	}
	
	div.viewport-spacer-2 {
		width: 100%;
		min-height: 5px;
		min-width: 1000px; 
		float: top;
		background: white;
	}
	
	div.content {
		width: 100%;
		min-width: 1000px; 
		height: 360px;
		float: top;
	}	
	
	div.footer {
		width: 100%;
		min-width: 460px;
		height: 65px;
		float: top;
	}
	
	label.RememberMe input {
		display: none;
	}

	label.RememberMe span {
		width: 160px;
		height: 32px;
		display: block;
		background: url("RememberFalse.png");
		background-size:160px 32px;
		background-repeat:no-repeat;
	}

	label.RememberMe input:checked + span {
		background: url("RememberTrue.png");
		background-size:160px 32px;
		background-repeat:no-repeat;
	}
	</style>

	<!-- VIEWPORT SPACER JQUERY-->
	<script>
	
	$(window).load(function() {
		resize();
		$("body").fadeIn(2000);
	});

	$(window).resize(function() {
		resize();
	});

	function resize() {
		
		var viewportWidth = $(this).width();
		var viewportHeight = $(this).height();
		
		var headerHeight = $(".header").height();
		var footerHeight = $(".footer").height();
		var contentHeight = $(".content").height();
		
		var spacerHeight = (viewportHeight - (headerHeight + footerHeight + contentHeight))/2;
		
		$('#spacer-1').css('height', spacerHeight);
		$('#spacer-2').css('height', spacerHeight);
		
	};
	</script>
	<!-- VIEWPORT SPACER JQUERY-->
	
	<style>
	#BODY-BACKGROUND {
		position: absolute;
		left: 0;
		z-index: 0;
	}
	
	#BODY-FOREGROUND {
		width: 100%; 
		height: 100%; 
		position: relative; 
		z-index: 1;
	}
	
	</style>
<body>

<canvas id="BODY-BACKGROUND"></canvas>

<div id='BODY-FOREGROUND'>
	<div class="header">
		<?php include('../includes/HeaderMenu.php'); ?>
	</div>

	<!-- VIEWPORT SPACER -->
	<div class="viewport-spacer" id="spacer-1">
	
		<div class="SPACER-10"></div>
		
		<div id="ERROR1" class='LOGIN-ERROR animated bounce' style="background: #9B0000; border: 2px solid #790000;">
			<text>
			Account doesn't exist!
			</text>
		</div>

		<div id="ERROR2" class='LOGIN-ERROR animated bounce' style="background: #CC9900; border: 2px solid #916C00;">
			<text>
			Email can't be empty
			</text>
		</div>
		
		<div id="ERROR3" class='LOGIN-ERROR animated bounce' style="background: #4F81BD; border: 2px solid #385D8A;">
			<text>
			An unexpected error occurred!
			</text>
		</div>
		
	</div>
	<!-- VIEWPORT SPACER -->

	<div class="content">	

		<div class="LOGIN-BOX animated fadeInUp" style='box-shadow: 0px 0px 50px rgba(0,0,0,0.3);'>
		
		
			<img src="../images/logos/green-no-text.png" style="height: 110px; width: 110px; margin-top: 20px;">
			
			<div class="SPACER-5"></div>
			
			<text style="font-size: 30px; letter-spacing: -1px; color: #698C26;">
				<b>Reset Account Password</b>
			</text>
			
			<div class="SPACER-5"></div>
			
			<form method="post" id="LOGIN-FORM" accept-charset='UTF-8'>
			
				<text style='font-size: 20px; color: #333;'>Enter the email address associated with your Librorum account</text>
				<div class="SPACER-10"></div> 
				<input  type='text' autocomplete='off' id='MYEMAIL' name='MYEMAIL' maxlength='50' class='LOGIN-TEXTBOX' placeholder="Email Address" style="position: absolute; z-index: 0; width: 235px; padding-right: 50px;">
			
				<input type='submit' name='submit' value='' id='LOGIN-SUBMIT' class='LOGIN-SUBMIT' style="position: relative; z-index: 1; margin-left: 255px; background: url('go.png') center center no-repeat; background-size: contain;">
				<div class="SPACER-20"></div> 
				<text style='font-size: 18px; color: #333;'>We'll send you a new password.</text>
				
			</form>	
			
			<div id="PASSRESET" style='display: none;'>
			<div class="SPACER-10"></div> 
			<text style='font-size: 20px; color: #333;'>We have sent you a password reset email. The email can take upto 5 minutes to reach. Also, do check your spam folder and if you still don't recieve it, then contact us!</text>
			<div class="SPACER-10"></div> 
			</div>
		</div>

	</div>

	<!-- VIEWPORT SPACER -->
	<div class="viewport-spacer" id="spacer-2">
		
		<div class="SPACER-30"></div>
		<a href="register.php" class='LOGIN-LINKS'>
		Don't have an account?
		</a>
	
	</div>
	<!-- VIEWPORT SPACER -->

	<div class="footer">
		<div class="BOTTOM-MENU-BACKEND">
			<text>
				MMXIV &copy; Copyright Librorum. All Rights Reserved.
			</text>
		</div>
	</div>

</div>
</body>

</html>