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
	
	
	if(isset($_GET['ITEM_FILTER'])) $ITEM_FILTER = $_GET['ITEM_FILTER'];
	if(isset($_GET['BORROWED'])) $BORROWED_FILTER = $_GET['BORROWED'];
	if(isset($_GET['SEARCH'])) $SEARCH = $_GET['SEARCH'];
	
	
	if(empty($_GET['PAGE']))
	{
		$_GET['PAGE'] = 1;
		
		if(isset($SEARCH) && isset($ITEM_FILTER))
		{
			print	"
					<script>
						history.pushState('', '', 'filter.php?SEARCH=".$SEARCH."&ITEM_FILTER=".$ITEM_FILTER."&PAGE=1');
					</script>
					";
		
		}
		elseif(isset($SEARCH))
		{
			print	"
					<script>
						history.pushState('', '', 'filter.php?SEARCH=".$SEARCH."&PAGE=1');
					</script>
					";
			
		}
		elseif(isset($ITEM_FILTER))
		{
			print	"
					<script>
						history.pushState('', '', 'filter.php?ITEM_FILTER=".$ITEM_FILTER."&PAGE=1');
					</script>
					";
		}
		else
		{
			print	"
					<script>
						history.pushState('', '', 'filter.php?&PAGE=1');
					</script>
					";	
		
		}
		
	
	}
	else
	{
		//DO NOTHING
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
	<link rel="icon" type="image/ico" href="http://www.librorum.in/beta/favicon.ico"/>
	
	<!-- JAVASCRIPT LINKS -->
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.menu-launcher.js"></script>
	<script type="text/javascript" src="../includes/jquery.logout.js"></script>
	<script type="text/javascript" src="../includes/Slider.js"></script>
	<script type="text/javascript" src="../includes/ColorFinder.js"></script>
	<script type="text/javascript" src="../includes/jquery.mCustomScrollbar.min.js"></script>
	
	<script>
	$(document).ready( 
		function()
		{
			AdaptiveBackgrounds();
		}
	);
	</script>
	
</head>

<body id="BODY">
	
	<?php include('../includes/HeaderMenu.php'); ?>
	<div class='SPACER-10' style='background: #333;'></div>
	<div class='SPACER-10'></div>

		<div class="LIBRARY-MAIN-CONTAINER" style="background: #928A7F; box-shadow: 0px 0px 20px rgba(0,0,0,0.3);">
			
			<!-- 
				LIBRARY MENU WITH CATEGORIES
					USAGE: IN A BOX WITH VARIABLE HEIGHT WIDTH 1200PX
					IMAGES: FOUND IN DEFAULT IMAGES DIRECTORY
					SCRIPTS: JAVASCRIPT, PHP & MySQL CONNECTION REQUIRED
			-->
			
			<?php include('../includes/LibraryMenu.php'); ?>
			
					<style>
		div.search-tags {
			display: inline-block; 
			height: 40px; 
			margin-top: 5px;
			min-width: 20px; 
			float: left;
			margin-left: 10px;
			margin-right: 10px;
			padding: 7px 15px 5px 15px; 
			box-sizing: border-box;
			border-radius: 5px; 
			background: #8064A2;
			border: 2px solid #5C4776;
			cursor: pointer;
		}
		
		div.pageChange {
			min-width: 50px; 
			height: 25px; 
			box-sizing: border-box; 
			padding: 3px 10px 6px 10px; 
			float: left; 
			margin-left: 10px;  
			background: #555; 
			border-radius: 5px;
			cursor: pointer;
			box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
			transition: background-color 0.5s ease;
		}
		
		div.pageChange:hover {
			background: #777;
		}
		
		div.suggestions{
			display: inline-block;
			min-width: 50px;
			height: 45px;
			box-sizing: border-box;
			background: #DDD;
			margin: 5px;
			padding: 7px;
			cursor: pointer;
			transition: background-color 0.5s ease;
			transition: box-shadow 0.5s ease;
		}
		
		div.suggestions:hover {
		background: #CCC;
		
		box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
		}
		
		</style>
		
			<div style="height: 50px; float: top; padding: 10px 20px 10px 20px;  width: 100%; overflow: hidden;">
				<div style="float: left; margin: 2px 20px 0px 10px;">
				<text style="font-size: 35px;">
				Search & Filter:
				</text>
				</div>
				<?php
				if(isset($ITEM_FILTER) || isset($SEARCH))
				{
				
					if(isset($ITEM_FILTER))
					{
						print	"
								<div class='search-tags' id='FilterClose'>
									<text style='font-size: 18px; color: white;'>$ITEM_FILTER &nbsp; <i class='fa fa-times-circle'></i></text>
								</div>
								";
					}
					if(isset($SEARCH) && $SEARCH!="")
					{
						print	"
								<div class='search-tags' id='SearchClose'>
									<text style='font-size: 18px; color: white;'>$SEARCH &nbsp; <i class='fa fa-times-circle'></i></text>
								</div>
								";
					}
				
				}else
				{
						print	"
								<div class='search-tags'>
									<text style='font-size: 18px; color: white;'>Showing All Items</text>
								</div>
								";
				}
				?>
			</div>
		
		
		<script>
		$(document).ready(function(){
	
			$("#FilterClose").click(function(){
					location.href=location.href.replace(/&?ITEM_FILTER=([^&]$|[^&]*)/i, "");
			});
			
			$("#SearchClose").click(function(){
					location.href=location.href.replace(/&?SEARCH=([^&]$|[^&]*)/i, "");
			});
		
			$(".next").click(function(){
			var page = $(this).attr('id');
			location.href=location.href.replace(/&?PAGE=([^&]$|[^&]*)/i,  "&PAGE=" +page); 
			});
			
			$(".previous").click(function(){
			var page = $(this).attr('id');
			location.href=location.href.replace(/&?PAGE=([^&]$|[^&]*)/i, "&PAGE=" + page);
			});
		
		});
		
		</script>

			<div style="min-height: 460px; margin: 0 auto; text-align: center;  background: #333;  width: 100%; overflow: hidden;">
			
				
			
							<?php
							
								$ITEM_FILTERS = "";
								$SEARCH_FILTER = "";
								
								if(isset($_SESSION['MY_ID'])==FALSE && isset($ITEM_FILTER)==TRUE && isset($SEARCH)==TRUE)
								{
									$Q_CON1 = " AND ";
									$Q_CON2 = " WHERE ";
								}elseif(isset($_SESSION['MY_ID'])==FALSE && (isset($ITEM_FILTER)==TRUE && isset($SEARCH)==FALSE))
								{
									$Q_CON1 = " ";
									$Q_CON2 = " WHERE ";
								}elseif(isset($_SESSION['MY_ID'])==FALSE && (isset($ITEM_FILTER)==FALSE && isset($SEARCH)==TRUE))
								{
									$Q_CON1 = " WHERE ";
									$Q_CON2 = " ";
								}elseif(isset($_SESSION['MY_ID']))
								{
									$Q_CON1 = " AND ";
									$Q_CON2 = " AND ";
								}
								
								if(isset($SEARCH))
								{
										$SEARCH_FILTER = " $Q_CON1 (`TITLE/PRODUCT` LIKE '%".$SEARCH."%' OR `AUTHOR/ARTISTS` LIKE '%".$SEARCH."%' OR `SERIES_NAME` LIKE '%".$SEARCH."%')";
								}	
								
								if(isset($ITEM_FILTER) && $ITEM_FILTER != "Hot and New" && $ITEM_FILTER != "Trending")
								{
										$ITEM_FILTERS = " $Q_CON2 SUB_CATEGORY = '".$ITEM_FILTER."'";
								}
								elseif(isset($ITEM_FILTER) && $ITEM_FILTER == "Hot and New")
								{
										$ITEM_FILTERS = "";
								}
								elseif(isset($ITEM_FILTER) && $ITEM_FILTER == "Trending")
								{
										$ITEM_FILTERS = "";
								}
								
								if(empty(fetch_items("default", "$ITEM_FILTERS $SEARCH_FILTER GROUP BY librorum_items.items_original.`INFO_ID`")))
								{
								}
								else
								{
										$total = count(fetch_items("default", "$ITEM_FILTERS $SEARCH_FILTER GROUP BY librorum_items.items_original.`INFO_ID`"));;
										if(isset($_GET['PAGE']))
										{
											$page = $_GET['PAGE']-1;
											if($page+1>ceil($total/35))
											{
												print "<script>  location.href=location.href.replace(/&?PAGE=([^&]$|[^&]*)/i, \"&PAGE=1\"); </script>";
												exit();
											}
										}
										else
										{
											$_GET['PAGE'] = 1;
											$page = $_GET['PAGE']-1;
											print "<script>  var myURL = window.location.href; window.location.href= myURL+'&PAGE=1'</script>";
											exit();
										}
										
										if($page<0 || $page>ceil($total/35))
										{
											$_GET['PAGE'] = 1;
											$page = $_GET['PAGE']-1;
											print "<script>  location.href=location.href.replace(/&?PAGE=([^&]$|[^&]*)/i, \"&PAGE=1\"); </script>";
											exit();
										}
										
										$from = ($page*35);
										
										$next = $page + 1;
										$previous = $page-1;
										
										if(($from + 35)>$total)
										{
											$to = $total; 
										}
										else
										{
										
										$to = $from + 35; 
										}
										
										print	"
												<div style='height: 40px; box-sizing: border-box; padding: 7.5px; padding-left: 70px; padding-right: 200px; float: top; background: #EEE; width: 100%;'>
													<div style='float: left'>	
														<text style='color: #333; font-size: 18.5px;'>You are viewing items <b>".($from+1)."</b> to <b>$to</b> of <b>$total</b></text>
													</div>
												";
												
										if($previous >= 0)
										{ 
										print "<div  class='previous pageChange'  id='".($previous+1)."'><text style='font-size: 15px;'><i style='font-size: 13px; ' class='fa fa-angle-left'></i>&nbsp;Previous Page</text></div>";
										}
										if($next <ceil($total/35))
										{ 
										print "<div class='next pageChange' id='".($next+1)."'><text style='font-size: 15px;'>Next Page&nbsp;<i style='font-size: 13px; ' class='fa fa-angle-right'></i></text></div>";
										}
										print		"
												
												</div>
												";
								}
								
								print "<div style='width: 100%; min-height: 300px; float: top; padding: 20px; box-sizing: border-box; '>";
								
								
								if(isset($ITEM_FILTER) && $ITEM_FILTER == "Hot and New")
								{
									display_items(array(
										"SELECT CONDITIONS" => "ORDER BY DATE_ADDED DESC LIMIT $from,35", 
										"HOVER" => true
									));										
								}
								elseif(isset($ITEM_FILTER) && $ITEM_FILTER == "Trending")
								{
									display_items(array(
										"SELECT CONDITIONS" => "GROUP BY librorum.items.`ITEM_INFO_ID` ORDER BY BORROW_COUNT DESC LIMIT $from,35", 
										"HOVER" => true
									));										
								}
								else
								{
									display_items(array(
										"SELECT CONDITIONS" => "$ITEM_FILTERS $SEARCH_FILTER GROUP BY librorum_items.items_original.`INFO_ID` LIMIT $from,35", 
										"HOVER" => true
									));															
								}
							
								if(empty(fetch_items("default", "$ITEM_FILTERS $SEARCH_FILTER GROUP BY librorum_items.items_original.`INFO_ID`")))
								{
								
									print	"
											<div style='text-align: center; width: 90%; margin: 0 auto; min-height: 320px; margin-top: 20px; background: #EEE; box-sizing: border-box; padding: 50px 100px 50px 100px; box-shadow: 0px 0px 20px rgba(0,0,0,0.3);'>
													<text style='color: #333; font-size: 60px;'><i class='fa fa-warning'></i><br><b>Whoops!</b></text><br><br>
											";
													
									if(isset($SEARCH)==TRUE && isset($ITEM_FILTER)==FALSE)
									{
										print "<text style='color: #333; font-size: 35px;'>We were unable to find anything related to <br><b>$SEARCH</b>.</text><br>";
									}
									elseif(isset($SEARCH)==FALSE && isset($ITEM_FILTER)==TRUE)
									{
										print	"
												<text style='color: #333; font-size: 35px;'>We don't have any items in the <br><b>$ITEM_FILTER</b> category.</text><br><br>
												<text style='color: #333; font-size: 25px;'>If you have any items, we'd love if you added them to the library!</text><br>
												";
									}
									elseif(isset($SEARCH) && isset($ITEM_FILTER))
									{
										print	"
												<text style='color: #333; font-size: 35px;'>We were unable to find anything related to <br><b>$SEARCH</b> in the <b>$ITEM_FILTER</b> category.</text><br><br>
												<text style='color: #333; font-size: 25px;'>If you have any items, we'd love if you added them to the library!</text><br>
												";
									}
									else
									{
										print "<text style='color: #333; font-size: 35px;'>Your library appears to have no items. <br>Why don't you add some?</text>";
									}
									
									
									if($SEARCH!="")
									{
										include 'suggestions.php';
										$suggestions = suggestions($SEARCH);
										$counter = 0;
										if(count($suggestions)>0)
										{
											print	"<br><text style='color: #333; font-size: 35px;'>But we did find some suggestions for you...</text><br><br>";
											
											foreach($suggestions as $element)
											{
												print	"<a href='../library/filter.php?SEARCH=$element'><div class='suggestions'><text style='color: #333; font-size: 25px;'><b>$element</b></div></a>";
												
												if($counter>=10) break;
												$counter++;
											}
										}
									}
									
									print	"
											</div>
											";
								}
							
				
							?>
			
				</div>
			</div>
			
				<?php	
								if(empty(fetch_items("default", "$ITEM_FILTERS $SEARCH_FILTER GROUP BY librorum_items.items_original.`INFO_ID`")))
								{
								}
								else
								{
										$total = count(fetch_items("default", "$ITEM_FILTERS $SEARCH_FILTER GROUP BY librorum_items.items_original.`INFO_ID`"));;
										if(isset($_GET['PAGE']))
										{
											$page = $_GET['PAGE']-1;
											if($page+1>ceil($total/35))
											{
												print "<script>  location.href=location.href.replace(/&?PAGE=([^&]$|[^&]*)/i, \"&PAGE=1\"); </script>";
												exit();
											}
										}
										else
										{
											$_GET['PAGE'] = 1;
											$page = $_GET['PAGE']-1;
											print "<script>  var myURL = window.location.href; window.location.href= myURL+'&PAGE=1'</script>";
											exit();
										}
										
										if($page<0 || $page>ceil($total/35))
										{
											$_GET['PAGE'] = 1;
											$page = $_GET['PAGE']-1;
											print "<script>  location.href=location.href.replace(/&?PAGE=([^&]$|[^&]*)/i, \"&PAGE=1\"); </script>";
											exit();
										}
										
										$from = ($page*35);
										
										$next = $page + 1;
										$previous = $page-1;
										
										if(($from + 35)>$total)
										{
											$to = $total; 
										}
										else
										{
										
										$to = $from + 35; 
										}
										
										print	"
												<div style='height: 40px; box-sizing: border-box; padding: 7.5px; padding-left: 70px; padding-right: 200px; float: top; background: #EEE; width: 100%;'>
													<div style='float: left'>	
														<text style='color: #333; font-size: 18.5px;'>You are viewing items <b>".($from+1)."</b> to <b>$to</b> of <b>$total</b></text>
													</div>
												";
												
										if($previous >= 0)
										{ 
										print "<div  class='previous pageChange'  id='".($previous+1)."'><text style='font-size: 15px;'><i style='font-size: 13px; ' class='fa fa-angle-left'></i>&nbsp;Previous Page</text></div>";
										}
										if($next <ceil($total/35))
										{ 
										print "<div class='next pageChange' id='".($next+1)."'><text style='font-size: 15px;'>Next Page&nbsp;<i style='font-size: 13px; ' class='fa fa-angle-right'></i></text></div>";
										}
										print		"
												
												</div>
												";
								}
								?>
			<div style="height: 0px; float: top; padding: 10px 20px 10px 20px;  width: 100%; overflow: hidden;">
			</div>
			
		</div>
		
			<div class="SPACER-10"></div>
			
		<!-- 
			FOOTER MENU WITH LINKS
				USAGE: 5PX SPACER ABOVE, NO SPACER BELOW
				IMAGES: FOUND IN DEFAULT IMAGES DIRECTORY
				SCRIPTS: NONE
		-->
		<?php include('../includes/FooterMenu.html'); ?>
		
</body>


</html>