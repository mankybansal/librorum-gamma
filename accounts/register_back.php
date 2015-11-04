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
	$THEME = "DARK";
	$LIBRARY_PAGE = FALSE;
?>

<!DOCTYPE html>

<html>

	<title>New Account | Librorum - The Sharing Community</title>
	
	<!-- META TAGS. -->
	<meta name="description" content="Librorum - The Sharing Community, the one stop place to see what you can borrow in your community. We make sharing beneficial by giving back more when you lend.">
	<meta name="keywords" content="Librorum, Sharing, Community, Rentals, Community Sharing, Sharing in Bengaluru">
	<meta name="author" content="Librorum Web Team">
	<meta charset="UTF-8">
	
	<!-- LINKS FOR FILES REQUIRED ON PAGE. -->
	<link href="../css/MainSheetCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/AnimateCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/FontAwesomeCSS.css" rel="stylesheet" type="text/css"/>
	<link rel="icon" type="image/ico" href="http://www.librorum.in/beta/favicon.ico"/>
	
	<!-- JAVASCRIPT LINKS -->
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.signup.js"></script>
	<script type="text/javascript" src="../includes/jquery-ui.js"></script>
	
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

	a.menu-links {
		color: black;
	}

	body {
		height: 100%;
		margin: 0;
		padding: 0;
		min-width: 1000px; 
		min-height: 600px;
		text-align: center;
		background: #759E2F;
		text-align: center;
	}
	
	div.content {
		width: 100%;
		min-width: 1000px; 
		height: 500px;
		float: top;
	}	
	</style>

<body>

	
		<?php include('../includes/HeaderMenu.php'); ?>
		<div class="SPACER-10" style="background: #333;"></div>
		<div class="SPACER-10"></div>

	
	<style>
	
	text {
	
		white;
	}
	
	div.FOOTER-MENU {
			height: 190px; 
			width: 100%; 
			background: #333;
			padding-top: 5px;
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
	}
	
	span.error {
	
	color: #759E2F; position: absolute; 
	font-size: 20px; font-family: SourceSans;  
	}
	
			
	input.form, select.form {
		font-size: 25px; font-family: SourceSans; padding: 0px 20px 0px 20px; 
		height: 60px; 
		box-sizing: border-box;
		border: 0px;
		color: black;
		box-shadow: 0px 0px 20px rgba(0,0,0,.05);
		border-radius: 5px;
	}
	
	
	::-webkit-input-placeholder {
  text-transform: capitalize;
}

:-moz-placeholder { /* Firefox 18- */
   text-transform: capitalize; 
}

::-moz-placeholder {  /* Firefox 19+ */
  text-transform: capitalize; 
}

:-ms-input-placeholder {  
  text-transform: capitalize; 
}
	</style>
		
	<div class="content">
				
		<div id="form">
			<div class="SPACER-10"></div>
			<text style="font-size: 35px;">Sign up for Librorum</text><br>
			<text style="font-size: 25px;">It's quick and simple!</text><br>
			<div class="SPACER-25"></div>
			
			<form  method="post" id="SIGNUP-FORM" accept-charset='UTF-8'>
				<span id="E-1" class="error"  style="margin-left: -200px; width: 150px;  margin-top: 2px;">We'd love to know your first name!</span>
				
			<script type="text/javascript">

			  
				function isNumberKey(evt){
					var charCode = (evt.which) ? evt.which : evt.keyCode
					return !(charCode > 31 && (charCode < 48 || charCode > 57));
				}
				
				   function onlyAlphabets(e, t) {
				try {
					if (window.event) {
						var charCode = window.event.keyCode;
					}
					else if (e) {
						var charCode = e.which;
					}
					else { return true; }
					if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
						return true;
					else
						return false;
				}
				catch (err) {
					alert(err.Description);
				}
			}
		
			  </script>
			  
				<input class="form"  onkeypress="return onlyAlphabets(event,this);" type="textbox" id="F-1"  name="FIRST-NAME" style="text-transform: capitalize; width: 280px;" placeholder="First Name">
				<input class="form" onkeypress="return onlyAlphabets(event,this);" type="textbox" id="F-2"  name="LAST-NAME"   style="text-transform: capitalize; margin-left: 15px; width: 280px;" placeholder="Last Name">
				<span  id="E-2" class="error" style="margin-left: 50px; width: 150px;  margin-top: 2px; ">We'd love to know your last name!</span>
				
				
				<div class="SPACER-15"></div>
				<input  class="form" type="textbox" id="F-3" name="EMAIL" style="text-transform: lowercase; width: 580px;" placeholder="Email Address">
				<span id="E-3" class="error" style=" margin-left: -790px; width: 180px;  margin-top: 2px;">You must enter a valid email address</span>
				
				
				<div class="SPACER-15"></div>
				
				<input class="form" type="text"  onkeypress="return isNumberKey(event);" id="F-4" name="PHONE-NUMBER" style="width: 580px; padding-left: 80px; " maxlength="10" placeholder="Phone Number">
				<span id="E-4" class="error" style="margin-left: 35px; width: 190px;  margin-top: 2px;">Please provide us with a valid phone number</span>
				<span style="position: absolute; margin-left: -560px; margin-top: 13px; font-size: 25px; font-family: SourceSans; z-index: 50; "><b><span id="ccode">+91</span></b></span>
				
				<div class="SPACER-15"></div>
				
				<select class="form" style="width: 220px;" id="F-5" name="CITY">
					<option selected="selected" disabled="disabled">Select City</option>
					<?php
						$QUERY = "SELECT * FROM groups GROUP BY CITY";
						$RESULT = mysql_query($QUERY);
						
						while($row = mysql_fetch_array($RESULT))
						{
							$CITY = $row['CITY'];
							$CITY = strtolower($CITY);
							$CITY = ucwords($CITY);
							
							$STATE = $row['STATE'];
							$STATE = strtolower($STATE);
							$STATE = ucwords($STATE);
							print "<option value='".$row['CITY']."'>".$CITY."</option>";
						}
					?>
				</select>
				
			
				<span id="E-5" class="error" style="margin-left: -440px; width: 180px;  margin-top: -10px;">We can't show you locations till you select a city</span>
				
				
				<select  class="form" id="F-6" style="margin-left: 15px;width: 340px;" name="LOCATION">
					<option selected="selected" disabled="disabled">Select Location</option>
					<script>
						$('#F-5').on('change', function() {
							var CITY =  this.value;
							
							if(CITY == "DAVIS")
							{
								$("#ccode").text("+1");
							}
							else
							{
								$("#ccode").text("+91");
							}
							
							$('#F-6').empty().append('<option selected="selected" disabled="disabled">Select Location</option>');								
							$.post( "get_locations.php", { 'CITY': CITY },
							  function( data ) {
								$.each(data, function( index, value ) {
									$( "#F-6" ).append( "<option value='"+value+"'>"+value+"</option>");
								});
							  }, 'json');
							
						});
					</script>	
				</select>
				
				<span id="E-6" class="error" style="margin-left: 40px; width: 190px;  margin-top: -10px;">Your location is required to affiliate you to a library</span>
				
				<div class="SPACER-15"></div>
				<span id="E-7" class="error" style="margin-left: -280px; width: 350px;  margin-top: 5px;">We're sorry, but an account matching these credentials has been found.</span>
				
				<button id="SIGNUP-SUBMIT"  class="SUBMIT" type="submit">Continue &nbsp; <img id="loader" src="loader-white.gif" style="display: none; position: absolute; width: 35px; height: 35px;"></button>
			</form>
		</div>

		<div id="complete" style="display: none;">
			
			<div class="SPACER-30"></div>
			<text style="font-size: 35px;">Sign up complete!</text><br>
			<text style="font-size: 25px;">Your new account has been made.</text><br>
			<div class="SPACER-40"></div>
			<div class="SPACER-20"></div>
			
			<text style="font-size: 25px;">Please check</text><br>
			<b><text style="font-size: 30px;" id="email"></text></b><br>
			<text> for a confirmation mail!</text><br>
			<div class="SPACER-40"></div>
			<div class="SPACER-20"></div>
			<text style="font-size: 15px;">The email may take a few minutes to reach.<br>Check your spam folder, just in case!</text><br>
			<div class="SPACER-40"></div>
			<button  type="submit" onclick="" id="email-url" class="SUBMIT" style="margin: 0 auto;">Go to your Email</button>
			<div class="SPACER-20"></div>
			
		</div>
		
		
	
	</div>

		
		<!-- 
			FOOTER MENU WITH LINKS
				USAGE: 5PX SPACER ABOVE, NO SPACER BELOW
				IMAGES: FOUND IN DEFAULT IMAGES DIRECTORY
				SCRIPTS: NONE
		-->
		<?php include('../includes/FooterMenu.html'); ?>
	

</body>

</html>
