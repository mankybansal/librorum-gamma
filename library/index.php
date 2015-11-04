
<div id="loader">
</div>
<?PHP
	
	ERROR_REPORTING(0);

	//PREREQUISITE VARIABLES FOR THE SessionValidate.php PAGE
	$REDIRECT_PATH = "";
	$MY_PAGE_SET = TRUE;
	$LOGIN_PAGE_SET = FALSE;
	$LOGIN_REQUIRED = FALSE;
	$THEME = 'LIGHT';
	
	//THIS SCRIPT VALIDATES THE CURRENT SESSION
	include('../includes/SessionValidate.php');
	
	//CONNECT SCRIPT FOR DATABASE ACCESS
	include '../includes/ServerConnect.php';
	
	//INCLUDE ITEM DISPLAY & FETCH FUNCTIONS
	include '../includes/ItemData.php';
	
	//OTHER PAGE SETTINGS
	if(isset($_SESSION['MY_EMAIL']))
	{
		$DASHBOARD_MENU = TRUE;
	}

?>

<html>
 
<head>

	<title>Library | Librorum - The Sharing Community</title>
	
	<!-- META TAGS. -->
	<meta name="description" content="Librorum - The Sharing Community, the one stop place to see what you can borrow in your community. We make sharing beneficial by giving back more when you lend.">
	<meta name="keywords" content="Librorum, Sharing, Community, Rentals, Community Sharing, Sharing in Bengaluru">
	<meta name="author" content="Librorum Web Team">
	<meta charset="UTF-8">
	
	<!-- LINKS FOR FILES REQUIRED ON PAGE. -->
	<link href="../css/MainSheetCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/AnimateCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/FontAwesomeCSS.css" rel="stylesheet" type="text/css"/>
	<link href="../css/mCustomScrollbarCSS.css" rel="stylesheet" type="text/css"/>
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	<link rel="icon" href="../favicon.ico" type="image/x-icon">
	
	<!-- JAVASCRIPT LINKS -->
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.menu-launcher.js"></script>
	<script type="text/javascript" src="../includes/jquery.logout.js"></script>
	<script type="text/javascript" src="../includes/Slider.js"></script>
	<script type="text/javascript" src="../includes/ColorFinder.js"></script>
	<script type="text/javascript" src="../includes/jquery.mCustomScrollbar.min.js"></script>

	<script>
		$(function() {
			$(".horscroll").mCustomScrollbar({
				horizontalScroll:true,
				mouseWheel:false,
				scrollButtons:	{
								  enable:false
								}
			});
		});		
	</script>
	
	<script>
	$(document).ready( 
		function()
		{
			AdaptiveBackgrounds();
		}
	);
	</script>
	
	<style>
	div.SLIDER {
		height: 350px; 
		width: 100%; 
		background: url('image4.jpg');
		background-size: cover;
		position: relative;
		float: top; 
		overflow: hidden;
	}	
	
	#BODY-OVERLAY {
		display: none;
		position: absolute;
		left: 0;
		width: 100%;
		height: 100%;
		background: #EEE;
		z-index: 1;
		text-align: center;
		box-sizing: border-box;
		padding-top: 225px;
	}
	
	#BODY-CONTENT {
		width: 100%; 
		height: 100%; 
		position: relative; 
		z-index: 0;
	}
	</style>

</head>

<script>
$(document).ready(function()
{
   // $('#BODY-OVERLAY').delay(2000).fadeIn(1000);
    //$('#BODY-CONTENT').delay(2000).css('overflow', "hidden");
    $('#BODY-CONTENT').delay(5500).css('overflow', "auto");
    //$('#BODY-OVERLAY').delay(5500).fadeOut(1000);
});
</script>


<body id="BODY">
	
	
	<div id="BODY-OVERLAY">
		<text style="font-size: 45px; color: #333;"><b><i class='fa fa-terminal'></i> &nbsp; Developer Notes</b></text><br>
		<text style="font-size: 25px; color: #333;">The Library is currently in testing phase. We'd love your additional feedback!</text><br><br><br><br><br>
		<div id="enter">
		<text style="font-size: 18px; color: #333;">The page might have taken some time to load as it isn't optimised yet.<br>We're still working on it. </text>
		</div>
	</div>
	
	<div id="BODY-CONTENT">
	
		<?php include('../includes/HeaderMenu.php'); ?>
		
		
		<div class='SPACER-10' style='background: #333;'></div>
		<div class='SPACER-10'></div>

		<div class="LIBRARY-MAIN-CONTAINER" style="box-shadow: 0px 0px 20px rgba(0,0,0,0.3);">
			
			<!-- 
				LIBRARY MENU WITH CATEGORIES
					USAGE: IN A BOX WITH VARIABLE HEIGHT WIDTH 1200PX
					IMAGES: FOUND IN DEFAULT IMAGES DIRECTORY
					SCRIPTS: JAVASCRIPT, PHP & MySQL CONNECTION REQUIRED
			-->
			
			<?php include('../includes/LibraryMenu.php'); ?>
			
			<div class="SLIDER"  id="SLIDER">
	
				<div class="SLIDER-CONTENT" style='text-align: center;'>
										
						<div class="SPACER-25"></div>
						<hr class="white">
						<div class="SPACER-5"></div>
						
				
						<text style='font-size: 50px;'>
						<text style='font-size: 50px; color: #5579a1;'><b>#trending</b></text> & recently borrowed</text>
						<text style='font-size: 20px; margin-left: 20px;'>VIEW ALL</text>
						
						<div class="SPACER-10"></div>
						<hr class="white">
						<div class="SPACER-5"></div>
				
						<div class='SPACER-25'></div>
						<div>
							<?php

								$array = fetch_items("default", "ORDER BY DATE_ADDED DESC LIMIT 15");
								if (count($array)<15) 
								{
										if(count($array)==0)
										{
											print "	
													<br><br>
													<text style='font-size: 35px; '>This library is new and has no items.</text><br>
													<text style='font-size: 23px; '>Click on one of the boxes below to add an item you want to share!</text>
													<br><br><br><br>
													";		
										}
										elseif(count($array)>0 && count($array)<7)
										{
											print "	
													<br><br><text style='font-size: 35px; '>This library has nearly no items. Why don't you add some?</text><br>
													<text style='font-size: 23px; '>Click on one of the boxes below to add an item you want to share!</text>
													<br><br><br><br>
													";		
										}
										else
										{
											print "	
													<br><br><text style='font-size: 35px; '>This library has very few items. Why don't you add some?</text><br>
													<text style='font-size: 23px; '>Click on one of the boxes below to add an item you want to share!</text>
													<br><br><br><br>
													";		
										}
										
								}else
								{
									display_items(array(
										'SELECT CONDITIONS' =>  " GROUP BY librorum.items.`ITEM_INFO_ID` ORDER BY BORROW_COUNT DESC LIMIT 7"
									));
								}
							?>
						</div>
	
					
				</div>	
				
				<div class="SLIDER-CONTENT" style='text-align: center;'>

						<div class="SPACER-25"></div>
						<hr class="white">
						<div class="SPACER-5"></div>
						
						<text style='font-size: 50px; margin-left: 30px;'>
						<text style='font-size: 50px; color: #5579a1;'><b>#hot</b></text> & <text style='font-size: 50px; color: #5579a1;'><b>#new</b></text> additions</text>
						<text style='font-size: 20px; margin-left: 20px;'>VIEW ALL</text>
						<div class="SPACER-10"></div>
						<hr class="white">
						<div class="SPACER-5"></div>
				
						<div class='SPACER-25'></div>	
						<div>
							<?php
								
								$array = fetch_items("default", "ORDER BY DATE_ADDED DESC LIMIT 15");
								if (count($array)<15) 
								{
										if(count($array)==0)
										{
											print "	
													<br><br>
													<text style='font-size: 35px; '>This library is new and has no items.</text><br>
													<text style='font-size: 23px; '>Click on one of the boxes below to add an item you want to share!</text>
													<br><br><br><br>
													";		
										}
										elseif(count($array)>0 && count($array)<7)
										{
											print "	
													<br><br><text style='font-size: 35px; '>This library has nearly no items. Why don't you add some?</text><br>
													<text style='font-size: 23px; '>Click on one of the boxes below to add an item you want to share!</text>
													<br><br><br><br>
													";		
										}
										else
										{
											print "	
													<br><br><text style='font-size: 35px; '>This library has very few items. Why don't you add some?</text><br>
													<text style='font-size: 23px; '>Click on one of the boxes below to add an item you want to share!</text>
													<br><br><br><br>
													";		
										}
										
								}else
								{	
									display_items(array(
										'SELECT CONDITIONS' =>  "GROUP BY librorum.items.`ITEM_INFO_ID` ORDER BY DATE_ADDED DESC LIMIT 7"
									));
								}
							?>
						</div>
	
					
				</div>	


				
			</div>
			
			<div class="LIBRARY-LANDING-ALERT">
				<text>Welcome to the new library! Help us build our library in your community!</text>
			</div>
			
		</div>
		
		<div class="SPACER-10"></div>
	
		<div style="height: 700px;    width: 100%; min-width: 1200px; margin: 0 auto; overflow: hidden;">
			<div style="height: 700px; box-shadow: 0px 0px 20px rgba(0,0,0,0.3); background: #DDD; border-radius: 5px; margin: 0 auto; width: 1200px; margin: 0 auto; overflow: hidden;">
			
			<div class="LIBRARY-CONTENT-BOX" style=" border-radius: 5px; width: 825px; float: left; height: 700px;">
							<div class="SPACER-10"></div>
						<hr class="black">
						<div class="SPACER-5"></div>
						
				<div style="width: 100%; min-height: 40px;">	
					
					<div style="width: 20%; float: left; height: 35px;">
					</div>	
					
					<div style="width: 60%; float: left; height: 35px;">	
						<text style="font-size: 35px; text-align: center; color: #444;">New Additions To Librorum</text>
					</div>	
					
					<div style="width: 20%; float: left; min-height: 10px; margin-top: 12px; ">
						<text style="text-align:right; font-size: 18px; color: #444;">VIEW ALL</text>
					</div>
				</div>
			
					
				<div class="SPACER-10"></div>
				<hr class="black">
				<div class="SPACER-5"></div>

				
				<?php
					
					$array = fetch_items("default", "GROUP BY librorum.items.`ITEM_INFO_ID` ORDER BY DATE_ADDED DESC LIMIT 15");
					if (count($array)<15) 
					{
							if(count($array)==0)
							{
								print "	
										<div class='ITEM-SHORTAGE'>
										<text style='font-size: 28px; color: black; '>This library has no items. Be the first to add some!</text><br>
										<text style='font-size: 18px; color: black; '>Click on one of the boxes below to add an item you want to share!</text>
										</div>
										";		
							}
							elseif(count($array)>0 && count($array)<7)
							{
								print "	
										<div class='ITEM-SHORTAGE'>
										<text style='font-size: 25px; color: black;'>This library has nearly no items. Why don't you add some?</text><br>
										<text style='font-size: 18px; color: black;'>Click on one of the boxes below to add an item you want to share!</text>
										</div>
										";		
							}
							else
							{
								print "	
										<div class='ITEM-SHORTAGE'>
										<text style='font-size: 25px; color: black; '>This library has very few items. Why don't you add some?</text><br>
										<text style='font-size: 18px; color: black;'>Click </b>here</b> to add an item you want to share!</text>
										</div>
										";		
							}
					}
					
					display_items(array(
						'SELECT CONDITIONS' =>  "GROUP BY librorum.items.`ITEM_INFO_ID` ORDER BY DATE_ADDED DESC LIMIT 15",
						'COLOR' => 'black',
						'HOVER' => TRUE
					));
					
					if (count($array)<15) 
					{
							
							$counter;
							
							for($counter=0; $counter < 10-count($array) ;$counter++)
							{
							print "	
					<a href='../dashboard/items.php'>				
					<div class='ITEM-MISSING'>
					
						<div class='ITEM-IMAGE-CONTAINER' style=\"background: linear-gradient(to bottom, rgba(255,255,255,1) 0%, rgba(255,255,255,.8) 40%, rgba(255,255,255,.6) 60%, rgba(255,255,255,.1) 100%), url('../images/items/default2.png') #AAA; background-size:cover;\">
						
								<div class='ITEM-IMAGE-BACKGROUND' id='missing' style='height: 90px; padding-top: 5px;'>
								<div class='SPACER-5'></div>
								<text style=\"font-size: 15px; letter-spacing: -1px; color: #555;\"><b>ADD TO LIBRARY</b></text>
								<div style='margin-top: 5px;'>
								<text style=\"font-size: 50px; font-family: 'Blackoak Std'; color: #555;\">+</text>
								</div>
						
							</div>
							
							<div class='ITEM-CATEGORY' style='background: #AAA;'>Some Category</div>
						</div>

						<text class='ITEM-TITLE' style='color: black;'>Item Title Goes Here</text><br>
						<text class='ITEM-AUTHOR' style='color: black;'>Author / Publisher of Item</text>

					</div>
					</a>
							
									";
							}
					}
					
				?>
	
				
				
			</div>
			
			<div style="height: 700px;  width: 345px; float: left; margin-left: 10px;">
				
				<div class="SPACER-20"></div>
				
				<div class="PROMO-BOX">
					<img src="../images/photos/SLIDER_SLIDE7.jpg" style="height: 100%; width: 100%;">
				</div>
				
				
				<div class="PROMO-BOX" style="margin-top: 30px;">
					<img src="../images/photos/SLIDER_SLIDE8.jpg" style="height: 100%; width: 100%;">
				</div>
				
				<div class="PROMO-BOX" style="margin-top: 30px;">
					<img src="../images/photos/SLIDER_SLIDE9.jpg" style="height: 100%; width: 100%;">
				</div>
				
			</div>
		
			
			
			
		</div>
		
		</div>
		
		<div style='min-height: 100px; text-align: center; width: 1200px; margin: 0 auto;'>
		
						
							
						<div class="SPACER-10"></div>
						<hr class="white">
						<div class="SPACER-5"></div>
						
						<div style="width: 100%; min-height: 40px;">	
							
							<div style="width: 20%; float: left; height: 35px;">
							</div>	
							
							<div style="width: 60%; float: left; height: 35px;">	
								<text style="font-size: 35px; text-align: center; text-shadow: 0px 0px 10px #000;">Collections & Series</text>
							</div>	
							<!--
							<div style="width: 20%; float: left; min-height: 10px; margin-top: 12px; ">
								<text style="text-align:right; font-size: 18px; text-shadow: 0px 0px 10px #000;">VIEW ALL</text>
							</div>-->
						</div>
						
							<div class="SPACER-10"></div>
						<hr class="white">
						<div class="SPACER-10"></div>
						
						<?php
						
							$query =	"
										SELECT SERIES_ID, count(librorum_items.series_relation.RELATION_ID) AS ITEMS, SERIES_NAME, main_categories.CATEGORY_MAIN_TITLE, main_categories.CATEGORY_COLOR
										FROM librorum_items.items_original 

										LEFT JOIN items ON INFO_ID=ITEM_INFO_ID 
										LEFT JOIN sub_categories ON ITEM_CATEGORY_ID = CATEGORY_ID 
										LEFT JOIN main_categories ON main_categories.CATEGORY_ID = sub_categories.MAIN_CATEGORY_ID 
										INNER JOIN librorum_items.series_relation ON librorum_items.series_relation.ITEM_INFO_ID = librorum_items.items_original.INFO_ID 

										GROUP BY SERIES_ID
										HAVING count(librorum_items.series_relation.RELATION_ID)>'5'
										ORDER BY RAND()
										LIMIT 5
									";
									
							$result = mysql_query($query);
							

							while($row = mysql_fetch_array($result))
							{	

								$category = $row['CATEGORY_MAIN_TITLE'];
								$color = $row['CATEGORY_COLOR'];
				
								Print	"<div style='box-shadow: 0px 0px 20px rgba(0,0,0,0.3); text-align: left; width: 1160px; margin-bottom: 10px; overflow: hidden;height: 270px; background: #333; border-radius: 10px; padding: 10px 20px 10px 20px;'>
										
										<div style='min-height: 20px; min-width: 20px; float: left;'>
						
										<text style='font-size: 30px;'>&nbsp;&nbsp;&nbsp;".$row['SERIES_NAME']." Series</text>
										</div>
										<div style='display: inline-block; float: left; margin-bottom: 10px; min-height: 20px; min-width: 20px; background: $color; padding: 6px 10px 6px 10px ; border-radius: 10px; margin-left: 15px; margin-top: 5px; '><text style='font-size: 15px;'>".$category."</text></div>
										
										<div style='width: 20%; float: left; min-height: 10px; margin-top: 12px; margin-left: 20px'>
											<text style='text-align:right; font-size: 15px; text-shadow: 0px 0px 10px #000;'>VIEW ALL</text>
										</div>
										
										<br>
										<div class='SPACER-10'></div>	
											<div class='horscroll' style='white-space: nowrap; height: 230px; width: 1160px; overflow: hidden;'>
										";
								
										display_items(array(
											"SELECT STATEMENT" => 'series',
											"SELECT CONDITIONS" => "WHERE SERIES_ID = '".$row['SERIES_ID']."' GROUP BY librorum_items.items_original.`INFO_ID` ORDER BY librorum_items.series_relation.`ORDER` ASC LIMIT 20", 
											"HOVER" => true
										));
										
								Print	"   </div>
										</div>";
							}
						?>
		</div>
		
		<!-- 
			FOOTER MENU WITH LINKS
				USAGE: 5PX SPACER ABOVE, NO SPACER BELOW
				IMAGES: FOUND IN DEFAULT IMAGES DIRECTORY
				SCRIPTS: NONE
		-->
		<?php include('../includes/FooterMenu.html'); ?>

	</div>	
		
</body>

</html>


