<?PHP

	ERROR_REPORTING(0);

	//PREREQUISITE VARIABLES FOR THE SessionValidate.php PAGE
	$REDIRECT_PATH = "";
	$MY_PAGE_SET = TRUE;
	$LOGIN_PAGE_SET = FALSE;
	$LOGIN_REQUIRED = FALSE;
	$THEME = "LIGHT";

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

	//GET VARIABLES
	$ITEM_PASSED_ID = $_GET['ITEM_ID'];
	
	$QUERY = "SELECT * FROM items WHERE ITEM_ID=".$ITEM_PASSED_ID;
	if(mysql_num_rows(mysql_query($QUERY))>0)
	{
		//Do nothing
	}
	else
	{
		print "<script>parent.location.href = 'notfound.php';</script>";
		exit(0);
	}
	
	if(isset($_SESSION['MY_STATUS']) && $_SESSION['MY_STATUS']!='CONFIRMED')
	{
		print "<script>var confirmed=false;</script>";
	}
	else
	{
		print "<script>var confirmed=true;</script>";
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
	<link rel="icon" type="image/ico" href="http://www.librorum.in/beta/favicon.ico"/>

	<!-- JAVASCRIPT LINKS -->
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.menu-launcher.js"></script>
	<script type="text/javascript" src="../includes/jquery.logout.js"></script>
	<script type="text/javascript" src="../includes/Slider.js"></script>
	<script type="text/javascript" src="../includes/jquery.borrow.js"></script>
	<script type="text/javascript" src="../includes/ColorFinder.js"></script>
	<script type="text/javascript" src="../includes/jquery.mCustomScrollbar.min.js"></script>

	<script>
		$(function() {
			$(".horscroll").mCustomScrollbar({
				horizontalScroll:true,
				mouseWheel:false,
				scrollButtons:	{
								  enable:true
								}
			});
		});

	</script>

    <script>
        $(document).ready(function(){
            rpushListener();
            setInterval(function(){
                rpushListener();
            },500);

        });

        function getQueryVariable(variable) {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                if (pair[0] == variable) {
                    return pair[1];
                }
            }
            return (false);
        }

        function rpushListener()
        {
            $.post('reqCredits.php', "ACTION=reqCredits&ITEM_ID="+getQueryVariable("ITEM_ID"),  function success(data){
                $(".reqCredits").text(data.trim());
            });
        }
    </script>

	<script>
	$(document).ready(
		function()
		{
			AdaptiveBackgrounds();
			
		}
	);
	</script>

</head>


<style>
	#ALERT {
		position: absolute;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: 2;
		background: rgba(0,0,0,0.7);
		text-align: center;
		box-sizing: border-box;
		padding: 200px;
		display: none;
	}

	span.otherItem{
		cursor: pointer;
	}
	
	#BODY-OVERLAY {
		position: absolute;
		left: 0;
		width: 100%;
		height: 100%;
		background: #EEE;
		z-index: 1;
		text-align: center;
		box-sizing: border-box;
		padding: 50px;
		display: none;
		min-width: 800px;
	}

	#BODY-CONTENT {
		position: relative;
		z-index: 0;
	}


.green {
	background: #006600;
}

.red {
	background: #660000;
}

div.action-containers {
	display: hidden;
}

div.YesNo {
		height: 60px;
		outline: none;
		width: 200px;
		border: 0px;
		cursor: pointer;
		font-size: 25px;
		font-family: SourceSans;
		float: left;
		margin: 10px;
		background: #688B25;
		color: white;
		padding: 15px;
		border-radius: 10px;
		box-sizing: border-box;
}


div.notification {
	position: fixed;
	box-sizing: border-box;
	padding-top: 300px;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	z-index: 100;
}

    div.alert{
        width: 500px;
        display: inline-block;
        min-height: 10px;
        box-sizing: border-box;
        padding: 40px;
        border-radius: 10px;
        margin: 0 auto;
        background: #eee
    }
</style>

<body id="BODY">

    <div id="ALERT">
        <div class="animated fadeInLeft alert">
            <text style="color: #333; font-size: 90px;"><i class="fa fa-warning"></i></text>
            <br><br>

            <text style="font-size: 25px; color: #333;"><span id="notification-text"></span></text>
            <br>

            <div style="SPACER-15"></div>
            <div
                style="display: inline-block; margin-top: 20px; min-width: 30px; min-height: 10px; border-radius: 5px; padding: 5px; background: #CCC; cursor: pointer;"
                id="notif-close">
                <text style="color: black;">CLOSE</text>
            </div>
        </div>
    </div>

	<div id="BODY-OVERLAY">
		<div style="float: top; width: 100%; height: 30px;">
            <div id="close2" style="cursor: pointer; float: right;" >
                <text style="color: #333"> Close this window</text> &nbsp; <i class="fa fa-remove"></i>
            </div>
        </div>
		<div class="SPACER-5"></div>

		<div id="borrow" class="action-containers animated bounceInLeft ">
			<div style="display: inline-block; width: 600px; box-shadow: 0px 0px 20px rgba(0,0,0,0.3); min-height: 400px; background: #333; border-radius: 20px; margin: 0 auto; margin-top: 50px; box-sizing: border-box; padding: 25px 40px 25px 40px;">
                <div  style="width: 100%; height: 50px; float: top; margin: 0 auto; " >
                    <text style="color: #EEE; font-size: 40px;">
                        <i class="fa fa-exchange"></i> &nbsp; Borrow Item
                    </text>
                </div>

                <div style="width:100%; height: 122px; margin-top: 15px;  float: top;">
                    <div style='width: 220px; height: 110px;float: left; margin-left: 30px; background: #094D74; box-sizing: border-box; padding: 15px ; border-radius: 10px;'>
                        <text>Your Credits:</text><br>
                        <text style="font-size:50px;"><b>
                            <span class="myCredits"></span></b>
                        </text>
                    </div>

                    <div style='width: 220px;  height: 110px;float: left; margin-left: 20px; background: #830EFF; box-sizing: border-box; padding: 15px ; border-radius: 10px;'>
                        <text>Required Credits:</text><br>
                        <text style="font-size:50px;"><b>
                        <span class="reqCredits"></span></b>
                        </text>
                    </div>
                </div>

                <div style='float: top; display: inline-block; margin-top: 0px; width: 100%; min-height: 10px;'>
                    <text style="color: #EEE; font-size: 30px;">
                        Are you sure you want to borrow <br><b> <span id="title"></span></b>?
                    </text>
                </div>

                <div style='float: top; display: inline-block; margin-top: 5px; width: 100%; min-height: 10px;'>
                    <div style="display: inline-block; min-width: 10px; margin: 0 auto;">
                        <div class="YesNo" id="BORROW-YES">Yes</div>
                        <div class="YesNo" id="BORROW-NO">No</div>
                    </div>
                </div>
            </div>
		</div>

	</div>

	<div id="BODY-CONTENT">

	<?php include('../includes/HeaderMenu.php'); ?>
	<div class='SPACER-10' style='background: #333;'></div>
	<div class='SPACER-10'></div>

	<div class="LIBRARY-MAIN-CONTAINER" style="box-shadow: 0px 0px 20px rgba(0,0,0,0.3); background: url('../images/backgrounds/BlackStripeBlur.png')">

		<!--
			LIBRARY MENU WITH CATEGORIES
				USAGE: IN A BOX WITH VARIABLE HEIGHT WIDTH 1200PX
				IMAGES: FOUND IN DEFAULT IMAGES DIRECTORY
				SCRIPTS: JAVASCRIPT, PHP & MySQL CONNECTION REQUIRED
		-->

		<?php include('../includes/LibraryMenu.php'); ?>



		<div style="height: 200px; float: top; padding: 20px 0px 20px 0px; width: 100%; background: url('image4.jpg');background-size: cover;overflow: hidden;">

			<div style='width: 200px; box-shadow: 0px 0px 10px rgba(0,0,0,0.3); margin-left: 20px; text-align: center; height: 200px; background: #FFF; overflow: hidden; float: left;'>
				<div style='width: 190px; margin-left: 5px; text-align: center; height: 190px; margin-top: 5px; background: #DDD; overflow: hidden;'>

				<?php

			if(isset($_SESSION['MY_ID']))
				{
					$query_connector = "AND";
				}else
				{
					$query_connector  = "WHERE";
				}

				$array = fetch_items("default", " $query_connector ITEM_ID = $ITEM_PASSED_ID");

				function array_flatten($array) {
				  if (!is_array($array)) {
					return FALSE;
				  }
				  $result = array();
				  foreach ($array as $key => $value) {
					if (is_array($value)) {
					  $result = array_merge($result, array_flatten($value));
					}
					else {
					  $result[$key] = $value;
					}
				  }
				  return $result;
				}

				$array = array_flatten($array);

				$copies = fetch_items("default", " $query_connector librorum_items.items_original.INFO_ID = '".$array['INFO ID']."'");

				if($array['IMAGE'] == 'default2.png')
				{
					$IMAGE = 'default.png';
					$ADAPTIVE = "";
					$STYLE = "style='width: 100%; height: 100%;'";
				}else
				{
					$IMAGE = $array['IMAGE'];
					$ADAPTIVE  = "data-adaptive-background='1'";
					$STYLE = "style='width: 80%;'";
				}

				print "<img src='../images/items/".$IMAGE."' ".$STYLE.$ADAPTIVE.">";

				?>

				</div>

			</div>



				<div style='display: inline-block; margin-top: 15px; float: left; min-height: 20px; min-width: 20px; background: <?php print $array['CATEGORY COLOR']; ?>; padding: 6px 10px 6px 10px ; border-radius: 10px; margin-left: 15px; '>
				<text style='font-size: 15px;'>
				<?php print $array['MAIN CATEGORY']; ?></text>
				</div>

				<?php

				if($array['MAIN CATEGORY']=="VIDEO GAMES" && $array['PLATFORM']!="")
				{
					print	"
							<div style='display: inline-block; margin-top: 15px; float: left; min-height: 20px; min-width: 20px; background: #6699FF; padding: 6px 10px 6px 10px ; border-radius: 10px; margin-left: 15px; '>
							<text style='font-size: 15px;'>
							".$array['PLATFORM']."</text>
							</div>
							";
				}
				?>



				<br>




				<div class='SPACER-30'></div>

				<text style='font-size: 40px; margin-left: 20px;' ><b><span id="gettitle"><?php print $array['TITLE FULL']; ?></span></b></text><br>
				<div class='SPACER-5'></div>

				<text style='font-size: 25px; margin-left: 20px;'>by <b><span id='getauthor'><?php print $array['PUBLISHER']; ?></span></b></text><br>



				<div style=' float: left;'>
					<img src='../images/icons/user.png' style='width: 25px;  margin-left: 20px; margin-top: 15px;height: 25px; '>
				</div>



				<div style=' float: left; margin-left: 7px; margin-top: 14px;'>
					<text style='color: #333; font-size: 20px; text-transform: uppercase;' ><b><?php print $array['OWNER']; ?></b></text>
				</div>


		</div>

		<div style="padding-top: 5px; box-sizing: border-box; height: 60px; float: top; padding: 17px 0px 20px 0px; width: 100%; background: #eee; background-size: cover;overflow: hidden;">



				<div style='float: left; margin-left: 180px; margin-top: 10px; width: 10px; height: 10px; border-radius: 5px;' class='<?php print $array['STATUS']?>'></div>

				<div style='float: left; margin-left: 6px; margin-top: 5px;'>
					<text style='font-size: 15px;' class='<?php print $array['STATUS']; ?>'><b><?php print $array['STATUS']; ?></b></text>
				</div>

				<div style=' float: left; margin-left: 40px; padding: 5px 8px 5px 8px; min-width: 20px; min-height: 10px; border-radius: 5px; background: #8064A2; border: 2px solid #5C4776; margin-top: 0px;'>

					<text style='color: #FFF; font-size: 12px; text-transform: uppercase;' ><b>
					Borrow:
					<?php

					if((count($copies)-1)==1)
					{
						print count($copies)-1;
						print " more copy";
					}
					elseif((count($copies)-1)==0)
					{
						print "Only 1 copy";
					}
					else
					{
						print count($copies)-1;
						print " more copies";
					}

					?>

					</b></text>
				</div>


			<div style="float: left; ">
			<text style="margin-left: 35px; font-size: 20px; color: black;">Borrowed <b>
			<?php
				print $array['BORROW COUNT'];
				if($array['BORROW COUNT']==1)
				{
					print "</b> time";
				}
				else
				{
					print "</b> times";
				}
			?>
			</text>

			<text style="margin-left: 35px; font-size: 20px; color: black;">Rating: &nbsp;
			<?php

				function to_stars($num){
					$half_star = false;
					$stars_echoed = 0;
					$rating = round($num*2,0)/2; //achieves rounding to a half
					$full_stars = floor($rating/2); //the number of full stars
					if($rating % 2 != 0){//if we have a half star
						$half_star = true;
					}
					while($full_stars > 0){//output full stars
						echo '<i class="fa fa-star" style="color: #E7711B;" ></i>';
						$full_stars-= 1;
						$stars_echoed++;
					}
					if($half_star === true){//output half star if needed
						echo '<i class="fa fa-star-half-o" style="color: #E7711B;"></i>';
						$stars_echoed++;
					}
					while($stars_echoed < 5){//if we've output less than 5 stars, output the remaining as empty stars
						echo '<i class="fa fa-star-o" style="color: #CCCCCC;"></i>';
						$stars_echoed++;
					}
				}

				if($array['RATING']!="")
				{
					to_stars($array['RATING']);
					print "<b>&nbsp;&nbsp;".$array['RATING']."/10</b>";
				}
				else
				{
					print "Not Available";
				}
			?>
			</text>
			</div>

		</div>

		<div style="box-sizing: border-box; height: 60px; float: top; width: 100%; background: #ccc; background-size: cover;overflow: hidden;">



			<button style="cursor: pointer; float: left;width: 200px; background: #657F28; height: 100%; border: none; outline: none;" id="LIBRARY-BORROW-NOW">
			<text style='font-size: 18px;'> <i class="fa fa-exchange"></i> &nbsp; <b>Borrow Now</b></text></button>


			<button id= "wishlist" style="cursor: pointer;	float: left;width: 190px; background: #C0504D;  height: 100%; border: none; outline: none;">
			<text style='font-size: 18px;'><b>+ Add To Wishlist</b></text></button>


			<button id= "google" style="	cursor: pointer;	float: left; width: 190px; background: #094D74; height: 100%; border: none; outline: none;">
			<text style='font-size: 18px;'><i class="fa fa-google"></i> &nbsp; <b>Google It</b></text></button>


			<button id="flipkart" style="cursor: pointer; background: url('flipkart_125.png') #166CED no-repeat; padding-left: 30px; background-position: 30px 15px; background-size: 30px 30px; float: left; width: 220px; height: 100%; border: none; outline: none;">
			<text style='font-size: 18px;'> &nbsp; <b>Buy on Flipkart</b></text></button>

			<?php

			if($array['MAIN CATEGORY']=='MOVIES, CDs, TV & DVDs')
			{

				print	"
						<button id= 'imdb' style='cursor: pointer;	background:#F9C931; float: left; width: 200px; height: 100%; border: none; outline: none;'>
						<text style='font-size: 18px; color: black;'> <i class='fa fa-film'></i> &nbsp; <b>Find on IMDb</b></text></button>
					
						<button id= 'itunes' style='cursor: pointer; background:#FFF; float: left; width: 200px; height: 100%; border: none; outline: none;'>
						<text style='font-size: 18px; color: black;'> <i class='fa fa-apple'></i> &nbsp; <b>Find on iTunes</b></text></button>
						";
			}

			if($array['MAIN CATEGORY']=='VIDEO GAMES')
			{

				print	"<button id= 'gamespot' style='cursor: pointer; background: url(\"gamespot.png\") #FFCD00 no-repeat; padding-left: 30px; background-position: 18px 15px; background-size: 30px 30px; float: left; width: 220px; height: 100%; border: none; outline: none;'>
						<text style='font-size: 18px; color: black;'> &nbsp; <b>Find on GameSpot</b></text></button>
						";
			}

			if($array['MAIN CATEGORY']=='BOOKS & READING')
			{

				print	"<button id= 'goodreads' style='cursor: pointer; background: url(\"goodread.png\") #EEE no-repeat; padding-left: 30px; background-position: 18px 15px; background-size: 30px 30px; float: left; width: 220px; height: 100%; border: none; outline: none;'>
						<text style='font-size: 18px; color: black;'>&nbsp; <b>Find on </b>good<b>reads</b></text></button>
						";
			}

			?>

		</div>

		<div class="SPACER-20"></div>

		<div style="box-shadow: 0px 0px 20px rgba(0,0,0,0.3); border-radius: 5px; padding: 40px 70px 40px 70px; box-sizing: border-box; float: top; min-height: 100px; background: white; width: 96%; margin: 0 auto;">

			<text style="font-size: 28px; color: #000;"><b>Description</b></text><br>
			<div class="SPACER-10"></div>

			<text style="font-size: 19px; color: #666;">
			<?php

				if($array['DESCRIPTION']!="") print $array['DESCRIPTION'];
				else print "Sorry! We don't have a description for this item."
			?>
			</text>

		</div>

		<div class="SPACER-20"></div>

		<div style="box-shadow: 0px 0px 20px rgba(0,0,0,0.3); border-radius: 5px; padding: 40px 70px 40px 70px; box-sizing: border-box; float: top; min-height: 100px; background: white; width: 96%; margin: 0 auto;">

			<text style="font-size: 28px; color: #000;"><b>Reviews</b></text><br>
			<div class="SPACER-10"></div>

			<text style="font-size: 19px; color: #666;">
			We couldn't find any reviews for this item.
			</text>

		</div>

		<div class="SPACER-20"></div>

		<div style="box-shadow: 0px 0px 20px rgba(0,0,0,0.3); overflow: hidden; border-radius: 5px; padding: 40px 70px 20px 70px; box-sizing: border-box; float: top; min-height: 100px; background: white; width: 96%; margin: 0 auto;">

			<text style="font-size: 28px; color: #000;"><b>Related Items</b></text>

			<br>
			<div class="SPACER-10"></div>

				<?php

				$count = fetch_items("series", "WHERE SERIES_ID = '".$array['SERIES']."' AND INFO_ID != '".$array['INFO ID']."' GROUP BY librorum_items.items_original.`INFO_ID` ORDER BY librorum_items.series_relation.`ORDER` ASC");
				if(count($count)<1)
				{
					print 	"
							<text style='font-size: 19px; color: #666;'>
							We weren't able to relate this to any other items.
							</text><br><br>
							";
				}
				else
				{
					print	"
							<div class='horscroll' style='margin-left: -20px; white-space: nowrap; height: 240px; min-width: 800px;'>
							";

					display_items(array(
						"SELECT STATEMENT" => 'series',
						"SELECT CONDITIONS" => "WHERE SERIES_ID = '".$array['SERIES']."' AND INFO_ID != '".$array['INFO ID']."' GROUP BY librorum_items.items_original.`INFO_ID` ORDER BY librorum_items.series_relation.`ORDER` ASC LIMIT 20",
						'COLOR' => 'black',
						"HOVER" => false
					));

					print	"
							</div>
							";
				}

				?>
		</div>

		<div class="SPACER-20"></div>

	</div>


	<div class="SPACER-10"></div>

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