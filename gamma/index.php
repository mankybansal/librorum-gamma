<?PHP
	
	ERROR_REPORTING(0);	

	//PREREQUISITE VARIABLES FOR THE SessionValidate.php PAGE
	$REDIRECT_PATH = "";
	$MY_PAGE_SET = TRUE;
	$LOGIN_PAGE_SET = FALSE;
	//$HOME_PAGE = TRUE;
	
	//THIS SCRIPT VALIDATES THE CURRENT SESSION
	include('../includes/SessionValidate.php');
	
	//CONNECT SCRIPT FOR DATABASE ACCESS
	include '../includes/ServerConnect.php';
	
	//OTHER PAGE SETTINGS
	$DASHBOARD_MENU = TRUE;
	$LIBRARY_PAGE = FALSE;
	$THEME = "DARK";

?>

	<style>
	
		@media (min-width: 1400px) { 
			div.CONTENT1, div.CONTENT2 {
						border-radius:5px;
			}
		}


		div.CONTENT-SPACER-TOP {
			display:block;
			float:top;
			width:100%;
			height:10px
		}

		div.CONTENT-SPACER-BOTTOM {
			display:block;
			float:top;
			width:100%;
			height:45px
		}

		div.SLIDER {
			overflow:hidden;
			display:block;
			float:top;
			min-width:1200px;
			max-width: 1366px;
			width:95%;
			height:550px;
			background: rgba(255,255,255,0.3);
			margin:0 auto;
			border-radius:5px;
			box-shadow: 0px 0px 30px rgba(0,0,0,0.3);
		}

		
		div.slide {
			width:100%;
			height:100%;
			text-align:center;
		}

		div.CONTENT1,div.CONTENT2 {
			display:inline-block;
			float:top;
			width:100%;
			min-width:1200px;
			min-height:600px;
			margin: 0 auto;
			margin-top: 25px;
			max-width: 1366px; 
			box-shadow: 0px 0px 30px rgba(0,0,0,0.5);		
		}

		div.CONTENT1 {
			background: #FBFBFB;
		}

		div.CONTENT2 {
			background: #EEE;
		}

		html{
			width: 100%;
			text-align: center; 
		}
		
		body.body {
			background-image:-moz-linear-gradient(left,rgba(0,0,0,0.4) 0%,rgba(0,0,0,0) 50%,rgba(0,0,0,0.4) 100%);
			background-image:-webkit-linear-gradient(left,rgba(0,0,0,0.4) 0%,rgba(0,0,0,0) 50%,rgba(0,0,0,0.4) 100%);
			background-image:linear-gradient(to right,rgba(0,0,0,0.4) 0%,rgba(0,0,0,0) 50%,rgba(0,0,0,0.4) 100%);
			overflow-x:hidden;
			min-width: 1000px; 
			width: 100%:
			text-align: center;
		}

		div.background-box {
			width:100px;
			height:100px;
			opacity:.8
		}
		
		#slideshow{
		position: relative;
		z-index: 0;
		margin-top: -550px;
		}

		#slide-nav {
		width: 100%;
		height: 38px;
		padding-top: 12px;
		position: relative;
		z-index: 1; 
			background-color:#558ED5;
		margin-top: 500px;
		
		}
		
		div.background-box-containers {
			display:inline-block;
			margin:-2px;
			width:100px;
			height:100px
		}

		div.stats-white {
			height:350px;
			box-shadow:0 0 30px rgba(0,0,0,0.3);
			padding:20px;
			text-align:center;
			background:#EDEDED;
			width:74.7%;
			margin:0 auto;
			margin-top:15px
		}
	</style>

	

<!DOCTYPE html>
<html>

<head>

	<title>Home | Librorum - The Sharing Community</title>
	
	<!-- META TAGS. -->
	<meta name="description" content="Librorum - The Sharing Community, the one stop place to see what you can borrow in your community. We make sharing beneficial by giving back more when you lend.">
	<meta name="keywords" content="Librorum, Sharing, Community, Rentals, Community Sharing, Sharing in Bengaluru">
	<meta name="author" content="Librorum Web Team">
	<meta charset="UTF-8">
	
	<!-- LINKS FOR FILES REQUIRED ON PAGE. -->
	<link href="../css/MainSheetCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/FontAwesomeCSS.css" rel="stylesheet" type="text/css"/>
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	<link rel="icon" href="../favicon.ico" type="image/x-icon">
	
	<!-- JS FILES -->
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.logout.js"></script>

	<script>
	$(function() {
		$("#slideshow > div:gt(0)").hide();
		setInterval(function() { 
			$('#slideshow > div:first').fadeOut(1000).next().fadeIn(1000).end().appendTo('#slideshow');
		},  7500);
	});
	</script>
	
		
	<script>
	
$(document).ready(function() {

	var DashboardMenuOpen = false;
	$( "#CATEGORY-MENU" ).hide();
	$( "#DASHBOARD-MENU-CONTAINER" ).hide();
	
	function ShowDashboardMenu() {
		$( "#DASHBOARD-MENU-CONTAINER" ).slideDown();
		DashboardMenuOpen = true;
		$("#DB-CONT").fadeIn(500);
	};
	
	function HideDashboardMenu() {
		DashboardMenuOpen = false;
		$( "#DASHBOARD-MENU-CONTAINER" ).slideUp();
		$("#DB-CONT").fadeOut(500);
	};

	$("#DASHBOARD-MENU-LAUNCHER").click(function() {
		if(DashboardMenuOpen == false) ShowDashboardMenu();
		else HideDashboardMenu();
	});
		
});
</script>

			
	<body class="body">
		<div style="min-width: 1200px; width: 100%; position: fixed; z-index: 100; box-shadow: 0px 0px 10px rgba(0,0,0,1);">
			<?php include('../includes/HeaderMenu.php'); ?>
			<div class="SPACER-10" style="background: #333;"></div>
		</div>
		
		<div class="SPACER-40" style='height: 85px;'></div>
			<!-- SLIDER -->
		<div class='CONTENT-SPACER-TOP'></div>
		
		<div class='SLIDER'>
		
			<div id="slide-nav">
			<text>
					Join now. Start off with free credit. Offer valid for beta users only.
					</text>
			</div>
			


			<div id="slideshow">
				
				<div class='animated fadeInUp slide' style="padding-top: 100px; background: url(' IMAGES/SITE_IMAGES/SLIDE1.jpg') no-repeat; background-size: 100% 100%;">
						<div style="float: top; display: inline-block; min-width: 815px; height: 200px;margin: 0 auto; ">
							<div style="float: left; ">
								<img src='IMAGES/SITE_IMAGES/logo.png' style='width: 220px; height: 220px; '>
							</div>
							<div style="float: left; margin-left: 35px; text-align: left;">
								<div style="margin-top: 10px;">
								<text style="font-size: 56px;   color: #000; font-family: SergoeLight;"><b>Welcome To Librorum!</b></text><br>
								</div>
								<div style="margin-top: 0px;">
								<text style="font-size: 44px;  letter-spacing: -1px; color: #000; font-family: SergoeLight;">We're up & live.</text><br>
								</div>
								<div style="margin-top: 10px;">
								<text style="font-size: 28px; letter-spacing: -0.5px; color: #000; font-family: SergoeLight;"><b>Share with your friends and neighbours near you.</b></text><br>
								</div>
								<div style="margin-top: 5px;">
								<text style="font-size: 28px;  letter-spacing: -1px; color: #000; font-family: SergoeLight;">Be amazed by the simplicity.</text><br>
								</div>
							</div>
						</div>
						
					<div style="float: top; width: 900px;padding-top:50px; height: 100px; margin: 0 auto; ">
							
								
								<text style="font-size: 35px;   color: #000; font-family: SergoeLight;"><b>Find out what you can borrow from people around you. </b></text><br>
								
								<div style="margin-top: 5px;">
								<text style="font-size: 27px;  letter-spacing: -1px; color: #000; font-family: SergoeLight;">It's easy, fast & effecient, and saves you time, space & money all at the same time. </text><br>
								</div>
					</div>
				</div>
			
				<div class='animated fadeInUp slide' style="display: none; ">
					<img src='IMAGES/SITE_IMAGES/SLIDE3.jpg' style=' width: 105%; height: 105%; margin-top: -5px; margin-left: -5px; -moz-filter: blur(8px); -webkit-filter: blur(8px); filter: blur(8px);'>
					<div style="display: block; z-index: 555; width: 100%; height: 500px; text-align: left; position: absolute; margin: 0 auto; top:0;">
						<div style="margin-left: 80px; margin-top: 120px; ">
						<text style="font-size: 56px; color: #FFF; text-shadow: 0px 0px 20px rgba(0,0,0,0.7);"><b>Why should I share?</b></text><br>
						<text style="font-size: 40px; color: #FFF; text-shadow: 0px 0px 10px rgba(0,0,0,0.7);">Because if you have a candle, <br> the light won't glow any dimmer <br> if I light yours off of mine.</text><br>
						</div>
					</div>
				</div>
					
				<div class='animated fadeInUp slide' style="display: none; ">
					<img src='IMAGES/SITE_IMAGES/SLIDE2.jpg' style="width: 105%; height: 105%; margin-top: -5px; margin-left: -5px;-moz-filter: blur(8px);-webkit-filter: blur(8px); filter: blur(8px);		">
					<div style="display: block; z-index: 555; width: 100%; height: 500px; text-align: left; position: absolute; margin: 0 auto; top:0;">
						<div style="margin-left: 80px; margin-top: 300px; ">
						<text style="font-size: 56px;   color: #000; text-shadow: 0px 0px 20px rgba(255,255,255,0.3);"><b>It benefits everyone.</b></text><br>
						<text style="font-size: 40px;   color: #FFF; text-shadow: 0px 0px 10px rgba(0,0,0,1);">Because, if you have an idea and I have an idea and we<br>exchange these ideas, then each of us will have two ideas.</text><br>
						</div>
					</div>
				</div>

				<div class='animated fadeInUp slide' style="display: none; ">
					<img src='IMAGES/SITE_IMAGES/SLIDE4.jpg' style='width: 105%; height: 105%; margin-top: -5px; margin-left: -5px; -moz-filter: blur(8px);-webkit-filter: blur(8px); filter: blur(8px);'>
					<div style="display: block; z-index: 555; width: 100%; height: 500px; text-align: left; position: absolute; margin: 0 auto; top:0;">
						<div style="margin-left: 80px; margin-top: 300px; ">
						<text style="font-size: 56px;   color: #FFF; text-shadow: 0px 0px 20px rgba(0,0,0,.5);"><b>Because, it speads love.</b></text><br>
						<text style="font-size: 40px;   color: #000; text-shadow: 0px 0px 20px rgba(255,255,255,1);">It restores faith in humanity. <br>Spreading a little love doesn't hurt!</text><br>
						</div>
					</div>
				</div>
						
				<div class='animated fadeInUp slide' style="display: none; ">
					<img src='IMAGES/SITE_IMAGES/SLIDE5.jpg' style='width: 105%; height: 105%; margin-top: -5px; margin-left: -5px; -moz-filter:blur(5px); -webkit-filter:blur(5px); filter:blur(5px);'>
					<div style="display: block; z-index: 555; width: 100%; height: 500px; text-align: left; position: absolute; margin: 0 auto; top:0;">
						<div style="margin-left: 70px; margin-top: 320px; ">
						<text style="font-size: 56px; text-shadow: 0px 0px 20px rgba(0,0,0,1);"><b>Share with the people close to you.</b></text><br>
						<text style="font-size: 40px; letter-spacing: -1px;  text-shadow: 0px 0px 20px rgba(0,0,0,1);">Or maybe not soo close - someone you're meeting for the first time.</text><br>
						</div>
					</div>
				</div>
					
				<div class='animated fadeInUp slide' style="display: none; ">
					<img src='IMAGES/SITE_IMAGES/SLIDE6.jpg' style='width: 105%; height: 105%; margin-top: -5px; margin-left: -5px;  -moz-filter:blur(5px); -webkit-filter:blur(5px); filter:blur(5px);'>
			
					<div style="display: block; z-index: 555; width: 100%; height: 500px; text-align: left; position: absolute; margin: 0 auto; top:0;">
						<div style="margin-left: 60px; margin-top: 300px; ">
						<text style="font-size: 56px; text-shadow: 0px 0px 20px rgba(0,0,0,1);"><b>Use the power of the web.</b></text><br>
						<text style="font-size: 40px; letter-spacing: -1px;  text-shadow: 0px 0px 20px rgba(0,0,0,1);">Share faster & smarter<br>using our innovative & organized system.</text><br>
						</div>
						</div>
				</div>
			</div>
			
			
			
		</div>

		<!-- SLIDER -->
		<div class='CONTENT1' style="height: 300px;  background: url('BG1.png') #EEE; background-size: cover;  ">
		<div style='display: block; width: 7%; height: 100%; float: left; text-align: center; overlow: hidden;'>
				</div>
			<div style='display: block; width: 45%; height: 100%; float: left; text-align: center; overlow: hidden;'>
				
					<img src='IMAGES/SITE_IMAGES/MAIN.png' style='width: 95%;  margin: 0 auto; margin-top: 35px; height: 87%;'>
				
			</div>
			<div style='display: block; width: 550px; text-align: center; height: 100%;  float: left;'>
					<div class="SPACER-30"></div>
					<img src='../images/logos/green-no-text.png' style='width: 130px; height: 130px;'>
				<div class="SPACER-20"></div>
				<div style='display: block;  width: 100%; box-sizing: border-box; padding: 0px  10px 0px 10px; height: 40%; float: top; text-align: center; margin-top: -15px;'>
				<text style="font-size: 50px; color: #555;"><b>Hi, we're Librorum!</b></text><br>
				<text style="font-size: 35px; color: #555;"><b>The Sharing Community</b></text><br>
				<text style="font-size: 25px; color: #555;">Your community is a hidden treasure trove which we want to help you discover!</text>
				
				<br><br>
				<text style="font-size: 19px; color: #555;">
				Sharing on Librorum is like throwing a boomerang and not only getting it back. 
				But getting it back with more and by more we mean a token of appreciation from us. 
				Its made sharing profitable!
				Most of the time we still end up going to the library or the bookstore because we don't know that it is available within our community. 
				That's what what we do! Librorum connects people and shows you who has what, making it easier to borrow things.
				</text>
				<br>
				
				<div style='text-align: right;'>
				
					<text style="font-size: 15px; color: #558ED5;">
					<a href="../about/" style='text-decoration: none;'><button style='cursor: pointer; margin-top: 10px; width: 150px; height: 40px; border: 2px solid #DDD; background-color: #4A8CF6; color: white; border-radius: 10px;'>Read more &rsaquo;</button></a>
					</text>
				</div>
				
				</div>
			</div>
		</div>
		
	
		<div class='CONTENT2' style="height: 500px; overflow: hidden; background: url('IMAGES/SITE_IMAGES/MAC.png') #EEE no-repeat; background-size: 80% 100%; background-position: 400px 0px; ">

				<div style='display: inline-block; min-height: 10px;  width: 400px; box-sizing: border-box;  float: left;  margin-left: 4%; margin-top: 75px; text-align: center;'>
				
					<text style="font-size: 40px; color: #555; "><b>Books. Movies. Games.</b></text><br>
					<text style="font-size: 25px;color: #555; ">All your items, in one place. <br> Making it easier to find and share.</text>
					
					<br><br>
					<text style="font-size: 20px; color: #555; font-family: SourceSans;">
					Choose from a wide range of books, movies, video games and even music CDs from your own community's library! 
					You don't have to worry about whether you know that person or not! Librorum is an excuse to meet new people and share new things!<br><br>
					We will be adding the option of borrowing things like musical instruments, kitchen appliances, toys, etc. soon! 
					</text>
					<br><br>
					
					<a href="../library/" style='text-decoration: none;'><button style='cursor: pointer; margin-top: 10px; width: 330px; height: 60px; border: 4px solid #DDD; background-color: #4A8CF6; color: white; font-size: 20px; border-radius: 10px;'>Browse through our library!</button></a>

				</div>
		</div>
	
		<div class='CONTENT2' style="background: url('image2.jpg'); background-size: 100% 100%;">
			<div style="margin-top: 40px; text-align: center; float: left; margin-left: 50px; ">
				<text style="font-size: 50px; text-shadow: 0px 0px 10px rgba(0,0,0,0.5);"><b>Need a barbeque for the weekend?</b></text><br>
				<text style="font-size: 30px; text-shadow: 0px 0px 10px rgba(0,0,0,0.5);">Now borrow one from your community.</text>
			</div>
			<div style="margin-top: 165px; float: top; box-sizing: border-box; padding: 20px; background: rgba(238, 238, 238, .8); box-shadow: 0px 0px 20px rgba(0,0,0,0.3); border-radius: 20px;  height: 310px; width: 680px; margin-left: 60px; ">
		
				<div class="SPACER-10"></div>
				
				<text style="font-size: 35px; color: #333; "><b>Easy 3-Step Community Sharing</b></text><br>
				<div class="SPACER-10"></div>
			
				<div style="float: top; margin-top: 15px;">
					<div style="float: left; margin-left: 20px; text-align: center; width: 200px; ">
					<text style="font-size: 90px; color: #4A8CF6; "><i class='fa fa-search'></i></text><br>
					<div class="SPACER-5"></div>
					<text style="font-size: 25px; color: #333; "><b>Find in Library</b></text><br>
					<hr class="black">
					<text style="font-size: 18px; color: #333; ">Browse through items in your community.</text>
					</div>
					<div style="float: left; margin-left: 0px; text-align: center; width: 200px; ">
					<text style="font-size: 90px; color: #4A8CF6;"><i class='fa fa-bell'></i></text><br>
					<div class="SPACER-5"></div>
					<text style="font-size: 25px; color: #333; "><b>Request for Item</b></text><br>
						<hr class="black">
					<text style="font-size: 18px; color: #333; ">Because we need to ask the lender for permission.</text>
					</div>
					<div style="float: left; margin-left: 0px; text-align: center; width: 190px; ">
					<text style="font-size: 90px; color: #4A8CF6; "><i class='fa fa-exchange'></i></text><br>
					<div class="SPACER-5"></div>
					<text style="font-size: 25px; color: #333; "><b>Borrow & Return</b></text><br>
					<hr class="black">
					<text style="font-size: 18px; color: #333; ">Take the item & and we'll remind you to return it!</text>
					</div>
				</div>
			</div>
				<div style='float: left; margin-left:295px; margin-top: 20px; '>
								<form action='../accounts/register.php'>
									<input type='submit' value='Register Now' class='button LOGOUT-BUTTON' style='background: #688B25; font-size: 20px; width: 200px; border-radius: 10px; height: 55px; '>
								</form>
							</div>
		</div>
				

		<div class='CONTENT1' style="display: inline-block; min-height: 10px; padding: 14px 0px 10px 0px;  background: url('BG2.png') #EEE; background-size: cover;  ">
		
			<img src='../images/photos/SLIDER_SLIDE7.jpg' style='width: 33%;'>
			<img src='../images/photos/SLIDER_SLIDE8.jpg' style='width: 33%; '>
			<img src='../images/photos/SLIDER_SLIDE9.jpg' style='width: 33%;'>
		</div>
				
	<div class='CONTENT1' style='height: 600px; overflow: hidden; '>
		
		<div style=' width: 100%;  min-width: 1200px; max-width: 1366px; padding-top: 0px; height: 560px; background: rbga(0,0,0,0.5); position: absolute; z-index: 2;  margin: 0 auto;'>
			<div class="animated fadeInUp stats-white"  style=" margin-top: 70px;  background: url('BG1.png') #EEE; background-size: cover;  padding: 60px 30px 60px 30px;" >
				<div style='display: inline-block; margin-top: -20px;'>
					<div style="float: left; margin-top: 35px;">
						<text style="color: #4A8CF6; font-size: 100px;">
						<?php echo mysql_num_rows(mysql_query("SELECT * FROM items"));?> items 
						</text>
					</div>
					<div style="float: left;">
					<text style="color: #4A8CF6; font-size: 150px;">&nbsp; <i class="fa  fa-line-chart"></i></text>
					</div>
				</div>
					<br>
						<div class="SPACER-10"></div><hr class="black"><div class="SPACER-10"></div>
				
				<text style="color: #333; font-size: 45px;"><b>Our Library is Constantly Growing</b></text><br>
						<div class="SPACER-10"></div>
				<hr class="black">
					<div class="SPACER-10"></div>
				<text style="color: #333; font-size: 30px;">New items are being added all the time!</text><br><br>
				<a href='../library/' style="color: #4A8CF6; font-size: 30px;">Click here to see what people are sharing!</a>									
			</div>
		</div>
		
		<div style="width: 120%;   height: 100%; overflow: hidden; margin: 0 auto; text-align: center; margin-left: -50px;">
		<?php
			
			include '../includes/ServerConnect.php';
			include '../includes/ItemData.php';
			
			$array =  fetch_items("special", " WHERE IMAGE != 'default2.png' ORDER BY RAND() LIMIT 100");

			function backgroundBox($array)
			{
				foreach($array as $ITEM)
				{
					print		"
					<div class='background-box-containers' style=\"background: url('../images/items/thumbs/".$ITEM['IMAGE']."'); background-size: 100% 100%;\">
						<div style='background: ".$ITEM['CATEGORY COLOR'].";' class='background-box'>
						</div>
					</div>";
				}	
			}
			if(count($array)<=100) for($count = 0; $count<=1; $count++) backgroundBox($array);
			backgroundBox($array);
			
		?>
		</div>
	
	</div>
	
		<div class='CONTENT1' style="min-height: 570px; max-height: 570px; padding-top: 20px; background: url('bangalore2.jpg') #EEE no-repeat; background-size: 100% 100%; ">
				<hr class="black">
				<div class="SPACER-10"></div>
				<text style="font-size: 40px; color: #555; "><b>We are now open at:</b></text>
					<div class="SPACER-10"></div>
				<hr class="black">
				<br>
				<style>
				div.locations {display: inline-block; vertical-align: top; overflow: hidden; height:  195px; width: 180px; }
				.loc-pic { float: top; width: 150px; margin: 0 auto; height: 150px; box-sizing: border-box; padding: 5px; box-shadow: 0px 0px 20px rgba(0,0,0,0.1); }
				.text { float: top; width: 180px; height: 30px;  box-sizing: border-box; padding: 5px 0px 0px 0px ;  }
				text.location{color: #333; font-size: 17px; text-transform: uppercase; text-shadow: 0px 0px 10px rgba(255,255,255,1); font-weight: bold; }
				</style>
				<div style='margin: 0 auto; float: top; width: 1100px; height: 195px; '>
					<div class='locations'>
						<div class='loc-pic' style="background: url('IMAGES/SITE_IMAGES/DAFFODIL.jpg'); background-size: 100% 100%;"></div>

						<div class="text"><text class='location'>
							Sobha Dafodil, Bangalore</text>
						</div>
					</div>

					<div class='locations'>
						<div class='loc-pic' style="background: url('IMAGES/SITE_IMAGES/JASMINE.jpg'); background-size: 100% 100%;"></div>

						<div class="text"><text class='location'>
							Sobha Jasmine, Bangalore</text>
						</div>
					</div>

					<div class='locations'>
						<div class='loc-pic' style="background: url('IMAGES/SITE_IMAGES/KRISTAL.jpg'); background-size: 100% 100%;"></div>

						<div class="text"><text class='location'>
							Kristal Campus 10, Bangalore</text>
						</div>
					</div>

					<div class='locations'>
						<div class='loc-pic' style="background: url('PLACE/APR.png'); background-size: 100% 100%;"></div>

						<div class="text"><text class='location'>
							Adarsh Palm Retreat, Bangalore</text>
						</div>
					</div>

					<div class='locations'>
						<div class='loc-pic' style="background: url('PLACE/NOIDA.jpg'); background-size: 100% 100%;"></div>
						<div class="text"><text class='location'>
							APC Greens, Noida</text>
						</div>
					</div>
				</div>

				<div style='margin: 0 auto; float: top; width: 1100px; margin-top: 5px; height: 195px; '>
					<div class='locations'>
						<div class='loc-pic' style="background: url('PLACE/MANIPAL.png'); background-size: 100% 100%;"></div>

						<div class="text"><text class='location'>
							Manipal University, Manipal</text>
						</div>
					</div>

					<div class='locations'>
						<div class='loc-pic' style="background: url('PLACE/RV.jpg'); background-size: 100% 100%;"></div>

						<div class="text"><text class='location'>
							RVCE, Bangalore</text>
						</div>
					</div>

					<div class='locations'>
						<div class='loc-pic' style="background: url('PLACE/UCD.jpg'); background-size: 100% 100%;"></div>

						<div class="text"><text class='location'>
							UC Davis, California</text>
						</div>
					</div>

					<div class='locations'>
						<div class='loc-pic' style="background: url('PLACE/mi.png'); background-size: 100% 100%;"></div>

						<div class="text"><text class='location'>
							Mitraz Financial, Bangalore</text>
						</div>
					</div>

					<div class='locations'>
						<div class='loc-pic' style="box-sizing: border-box; padding-top: 30px;"><text class='location' style="font-size: 25px;">MORE COMING SOON</text></div>
					</div>
				</div>
				<div class="SPACER-10"></div>
				<hr class="black">

				<div class="SPACER-10"></div>
				<text style="font-size: 25px;  color: #555;">Want us to join your community? Write to us!</text>
					
				<div class="SPACER-10"></div>
				<hr class="black">
				<div class="SPACER-10"></div>
		</div>
		
	
	<div class='CONTENT2' style="box-sizing: border-box; padding: 50px; background: url('BG2.png') #333; background-size: cover; max-height: 570px; min-height: 570px; box-shadow: 0px 0px 20px rgba(0,0,0,0.5); overflow: hidden;">
			<div style='display: inline-block;'>
				<text style='color: #A4C639; font-size: 150px'><i class='fa fa-android'></i></text>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<div style='display: inline-block;'>
			<text style='color:#EEE; font-size: 60px'>The Librorum App</text><br>
			<text style='color:#EEE; font-size: 35px'>Coming Soon on Mobile Devices</text>
			</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<div style='display: inline-block;'>
				<text style='color: #DDD; font-size: 150px'><i class='fa fa-apple'></i></text>
			</div>
			<br>
			<div style='display: inline-block; margin-top: 40px;'>
			
				<img src='ANDROID2.png' style='float: left; height: 80px;'>
				<img src='ANDROID-APP.png' style='float: left; margin-left: 30px;   height: 80px; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0,0,0,0.1);'>
				
				<img src='APPLE2.png' style='float: left; margin-left: 30px;  height: 80px;'>
			</div>
			<br>
			<div class="SPACER-30"></div>
			<div class="SPACER-10"></div>
			
			<div style='display: inline-block; width: 200px;'>
			<text style='color:#EEE; font-size: 45px'><i class='fa fa-barcode'></i></text><br>
				<div class="SPACER-10"></div><hr class='white'>	<div class="SPACER-10"></div>
					<text style='color:#DDD; font-size: 20px'>Automatically add books by scanning their ISBN barcodes</text>
			</div>
			
			<div style='display: inline-block; width: 200px; margin-left: 10px;'>
			<text style='color:#EEE; font-size: 45px'><i class='fa fa-dashboard'></i></text>
				<div class="SPACER-10"></div><hr class='white'>	<div class="SPACER-10"></div>
					<text style='color:#DDD; font-size: 20px'>Manage your account and view your dashboard on the go</text>
			</div>
			
			<div style='display: inline-block; width: 200px; margin-left: 10px;'>
			<text style='color:#EEE; font-size: 45px'><i class='fa fa-exchange'></i></text>
				<div class="SPACER-10"></div><hr class='white'>	<div class="SPACER-10"></div>
					<text style='color:#DDD; font-size: 20px'>Manage all your borrows, lends and returns from the app</text>
			</div>
			
			<div style='display: inline-block;width: 200px; margin-left: 10px;'>
			<text style='color:#EEE; font-size: 45px'><i class='fa fa-camera-retro'></i></text>
				<div class="SPACER-10"></div><hr class='white'>	<div class="SPACER-10"></div>
					<text style='color:#DDD; font-size: 20px'>Upload pictures of your items on the Library in just a few clicks</text>
			</div>
			
			<div style='display: inline-block;width: 200px; margin-left: 10px;'>
			<text style='color:#EEE; font-size: 45px'><i class='fa fa-bell'></i></text>
			<div class="SPACER-10"></div>
			<hr class='white'>
				<div class="SPACER-10"></div>
				<text style='color:#DDD; font-size: 20px'>Get all your push notifications so you don't miss anything</text>
			</div>
	</div>
	
		<div class='CONTENT1' style="background: url('BG.png') #EEE; background-size: cover; max-height: 420px; min-height: 420px; box-shadow: 0px 0px 20px rgba(0,0,0,0.5); overflow: hidden;">
		<div class="SPACER-20"></div>
		<hr class="black">
				<div class="SPACER-10"></div>
				<text style="font-size: 35px; color: #555; "><b>Meet the team:</b></text>
					<div class="SPACER-10"></div>
				<hr class="black">
				
					<div class="SPACER-10"></div>
					
						<div style="display: inline-block; min-width: 10px;  height: 240px; ">
								<style>
								div.team {
									display: inline-block;
									width: 180px; 
									height: 240px;
									margin: 0px 5px 0px 5px; 
									text-align: center;
								}
								div.picture-cont {
								width: 160px; 
									height: 160px;
									box-sizing: border-box;
									padding-top: 10px;
									margin: 0 auto;
									border-radius: 50%;
									background: #555;
								}
								div.picture {
									
									width: 140px; 
									height: 140px;
									
									border-radius: 50%;
									background: #CCC;
									margin: 0 auto;
								
								}
								</style>
								
								<div class="team">
									<div class="picture-cont">
									<div class="picture" style="background: url(MANKY2.jpg); background-size: 160px 160px;">
									</div>
									</div>
									<div class="SPACER-5"></div>
									<div style="width: 100%; min-height: 10px; float: top;">
									<text style="font-size: 23px; color: #333"><b>Mayank Bansal</b></text><br>
									<text style="font-size: 18px; color: #333">Co-founder, Project Lead & Head Developer</text>
									</div>
								</div>		
								
								<div class="team">
									<div class="picture-cont">
									<div class="picture" style="background: url(YASH.jpg) ; background-size: 160px 160px;">
									</div>
									</div>
									<div class="SPACER-5"></div>
									<div style="width: 100%; min-height: 10px; float: top;">
									<text style="font-size: 23px; color: #333"><b>Yash Pahade</b></text><br>
									<text style="font-size: 18px; color: #333">Co-founder & Communities Manager</text>
									</div>
								</div>				
								
								<div class="team">
									<div class="picture-cont">
									<div class="picture" style="background: url(MEH.jpg) ; background-size: 160px 160px;">
									</div>
									</div>
									<div class="SPACER-5"></div>
									<div style="width: 100%; min-height: 10px; float: top;">
									<text style="font-size: 23px; color: #333"><b>Yash Mehrotra</b></text><br>
									<text style="font-size: 18px; color: #333">Community & Public Relations Manager</text>
									</div>
								</div>								
								<div class="team">
									<div class="picture-cont">
									<div class="picture" style="background: url(SID.jpg) ; background-size: 160px 160px;">
									</div>
									</div>
									<div class="SPACER-5"></div>
									<div style="width: 100%; min-height: 10px; float: top;">
									<text style="font-size: 23px; color: #333"><b>Siddarth Sreelal</b></text><br>
									<text style="font-size: 18px; color: #333">Software Architect & Consultant</text>
									</div>
								</div>								
								<div class="team">
									<div class="picture-cont">
									<div class="picture" style="background: url(ARJHUN.jpg) ; background-size: 160px 160px;">
									</div>
									</div>
									<div class="SPACER-5"></div>
									<div style="width: 100%; min-height: 10px; float: top;">
									<text style="font-size: 23px; color: #333"><b>Arjhun Srinivas</b></text><br>
									<text style="font-size: 18px; color: #333">Head of Expansion & Backend Systems</text>
									</div>
								</div>
						
						
						
						</div>
									<div class="SPACER-10"></div>
						<hr class="black">
		
					
					<div class="SPACER-10"></div>
					<text style="font-size: 25px;  color: #555;">Do you think you can help us build better services?</text>
					<div class="SPACER-10"></div>
					<hr class="black">
		</div>
		
	</div>
	
		<div class="SPACER-10"></div>
	
		<div class='CONTENT2' style=" background: url('BG1.png') #EEE; background-size: cover;  min-height: 255px; max-height: 255px; padding-top: 20px; ">
					<hr class="black">
				<div class="SPACER-10"></div>
				<text style="font-size: 35px; color: #555; "><b>See what people are saying about us:</b></text>
					<div class="SPACER-10"></div>
				<hr class="black">
				
				<br>
				<div style='margin: 0 auto;'>
					<a href="http://www.campusdiaries.com/stories/the-sharing-community" target="_blank">
						<img src='IMAGES/SITE_IMAGES/CP.jpg' class="PRESS">
					</a>
					
					<a href="http://www.deccanchronicle.com/130924/lifestyle-offbeat/article/fundu-calibre-deliverance" target="_blank">
						<img src='IMAGES/SITE_IMAGES/DECCAN.png' class="PRESS">
					</a>
					
					<a href="https://www.youtube.com/watch?v=_skSg3zNZEA" target="_blank" >
						<img src='IMAGES/SITE_IMAGES/NEWS9.png' class="PRESS-SQUARE">
					</a>
					
					<a href="http://epaper.newindianexpress.com/c/1725713" target="_blank">
						<img src='IMAGES/SITE_IMAGES/TNIE.png' class="PRESS-SQUARE">
					</a>
					
					<style>
					img.PRESS, img.PRESS-SQUARE {
						height: 80px; margin-right: 10px; border-radius: 10px; 
					}
					
					img.PRESS-SQUARE
					{
						width: 80px;
					}
					</style>
					
					<br>
					<div class="SPACER-10"></div>
					<hr class="black">
					<div class="SPACER-10"></div>
					<text style="font-size: 25px;  color: #555;">Want to help us out? Contact us now!</text>
					<div class="SPACER-10"></div>
					<hr class="black">
				</div>
				
		</div>
		
			<div class="SPACER-10"></div>
			<div class="SPACER-10"></div>
			<div class="SPACER-10"></div>
		
		<div class='FOOTER-MENU-BACKEND'>
			<?php include('../includes/FooterMenu.html'); ?>
		</div>
	<div>
	
</body>

</html>