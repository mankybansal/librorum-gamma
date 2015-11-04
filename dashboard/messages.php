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
	<link rel="stylesheet" href="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css" />
	<link rel="icon" type="image/ico" href="http://www.librorum.in/beta/favicon.ico"/>

	<!-- JAVASCRIPT LINKS -->
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.logout.js"></script>
	<script type="text/javascript" src="../includes/jquery.form.js"></script>
	<script type="text/javascript" src="../includes/jquery.newData.js"></script>	
	<script type="text/javascript" src="../includes/BackgroundBubbles.js"></script>
	<script src="http://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	
		<script>
	
		$(document).ready(function(){
		
		$("#threads").load("data2.php");
		$("#messages").load("data.php");
		setTimeout(function(){$(".verscroll1, .verscroll2").mCustomScrollbar({
			theme:"minimal-dark"
		})},10);	
			setInterval(function() {
			
				$("#messages").load("data.php");
				$("#threads").load("data2.php");
				
				
	
			}, 1500);

		});

		
	</script>
	
	<script type="text/javascript" >
		$(function() 
		{
			$(".submit").click(function() 
			{
				var name = $("#message_text").val();
				var dataString = 'message_text='+ name;

				if(name=='')
				{
					$("#message_text").attr("placeholder", "Why do you want to send a blank message?");
					setTimeout(function() {
						$("#message_text").attr("placeholder", "Type message here...");
					}, 3000);
				}
				else
				{
					$.ajax
					({
						type: "POST",
						url: "send.php",
						data: dataString,
						success: function()
						{

							$("#messages_container").scrollTop(10000);
						
							$("#message_text").attr("placeholder", "Message sent.");
							
							$('#message_text').val('');
							
							$("#treads").load("data2.php");
							
							setTimeout(function() {
							$("#message_text").attr("placeholder", "Type your message here...");
							}, 2000);
							
							
						}
					});
				}
				return false;
			});
		});
	</script>
	
	
	
	<!-- VIEWPORT SPACER CSS-->
	<style>
	div.viewport-spacer {
		width: 100%;
		min-height: 5px;
		min-width: 1000px; 
		float: top;
	}
		
	div.header {
		width: 100%;
		min-width: 1000px; 
		height: 70px;
		float: top;
	}
	
	div.content {
		width: 100%;
		min-width: 1000px; 
		height: 500px;
		float: top;
	}
		
	div.footer {
		width: 100%;
		min-width: 460px;
		height: 65px;
		float: top;
	}
	
	html, body {
	
			-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	overflow: hidden;
    background: #759E2F;

}


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
	<!-- VIEWPORT SPACER CSS-->
	
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
	
	
</head>

<body class="animated fadeIn" style="text-align: center; min-width: 1000px; min-height: 600px;">
	
		<canvas id="BODY-BACKGROUND">
		</canvas>
		
		<div id="BODY-FOREGROUND">
	
	
	<div class="header animated fadeInDown">
	<?php include('../includes/HeaderMenu.php'); ?>
	</div>
	
	<!-- VIEWPORT SPACER -->
	<div class="viewport-spacer" id="spacer-1"></div>
	<!-- VIEWPORT SPACER -->

	<div class="content">	
	
		<div class="animated fadeInUp" style="width: 1000px; height: 100%; overflow: hidden; margin: 0 auto; background: #ddd; border-radius: 10px;">
			
			<div style="float:top; width: 100%; height: 90px; background: white; ">
	      		
				<div class="ButtonIcon" style="margin-left: 20px; margin-top: 20px; height: 50px; width: 50px; float: left; border-radius: 10px; background:  #1AA0E2;  ">
					<div style="background: #1AA0E2; width: 100%; height: 100%;" id="INFO3">
						<div class="SPACER-10"></div>
				
						<img src="../MessagesIcon.png" style="width: 35px; height: 35px;">

					</div>
				</div>
				
				<div style="float: left; margin-left: 10px; margin-top: 18px; ">
					<text style="font-size: 45px; color: #000;">Messages</text>
				</div>
				
				<div style="float: right; margin-right: 30px; margin-top: 25px; ">
					<input type="textbox" placeholder="Seach in Messages" style="background: url(search.png) #FFF no-repeat left; background-size: 20px 23px;  background-position: 220px 10px; height: 25px; font-size: 17px; width: 220px; padding: 6px 15px 8px 15px; border-radius: 7px; border: 2px solid #DFDFDF; outline: none;  ">
				</div>		
		
		
				<div style="float: right; margin-right: 40px; margin-top: 35px; ">
					<text style="font-size: 20px; color: #000;"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;Delete Conversation</text>
				</div>
			
				<div style="float: right; margin-right: 40px; margin-top: 35px; ">
					<text style="font-size: 20px; color: #000;">+ New Message</text>
				</div>
			
			</div>	
			
			<div style="float:top; width: 100%; height: 6px; background: #1AA0E2; "></div>		
			
			<div style="float:top; width: 100%; height: calc(100% - 96px); background: white;">
				<div style="height: 100%; overflow-y: auto; box-sizing: border-box; float: left; width: 350px; background: #EDEDED; ">
					<div style="height: 40px; background: #EEEE; box-sizing: border-box; padding: 8px 20px 12px 20px; box-shadow: 0px 0px 20px #DDD; float: top; width: 100%; ">
						<text style="font-size: 20px; color: #1AA0E2">My <b>Inbox</b></text>
					</div>
					<div  class="verscroll1" style="height: calc(100% - 40px); box-sizing: border-box; padding: 10px 0px 20px 0px; overflow-y: auto; float: top; width: 100%; ">
						<div  id="threads" style="display: inline-block; overflow: none; min-height: 10px; width: 100%; ">
						</div>
					</div>
				</div>
				<div style="height: 100%; float: left; width: calc(100% - 350px); ">
					<div style="height: 40px; box-sizing: border-box; padding: 8px 20px 12px 20px; box-shadow: 0px 0px 20px #EEE; float: top; width: 100%; ">
						<text style="font-size: 20px; color: #1AA0E2">Conversation with <b>Yash Mehrotra</b></text>
					</div>
					<div  id="messages_container" class="verscroll2" style="height: 284px; box-sizing: border-box; padding-top: 30px; overflow: auto; float: top; width: 100%; ">
						<div  id="messages" style="display: inline-block; min-height: 10px; width: 100%; ">
						</div>
					</div>
					<div style="height: 80px; float: top; width: 100%; background: #CCC;">	
						<form method="post" name="form">
						<input type='textbox' name="message_text" id="message_text" placeholder='Type in your message here...' style='float: left; height: 60px; margin-left: 15px; margin-top: 10px;  width: 440px; border: 0px; border-radius: 5px 0px 0px 5px; padding: 0px 20px 0px 20px; font-size: 20px;'/>
						<input type="submit" value="Send" class="submit" style="color: white; font-size: 15px; float:left; width: 130px; height: 60px; margin-top: 10px; background: #4F81B3; border: 0px; border-radius: 0px 5px 5px 0px;"/>
						</form>
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
