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
	
	if($_SESSION['MY_STATUS']!="CONFIRMED")
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
	<script type="text/javascript" src="scripts/jquery.items.js"></script>

	
	<script>
	
		SideBarWidth = "300px";
		AppBaseColor = "#F2D013";
		AppTextColor = "#333";
		AppTextForegroundColor = "#333";
		AppIcon 	 = "url('../MyItemIcon.png') no-repeat " + AppBaseColor + " center";
		
		$(document).ready(function(){
			
			AdaptiveBackgrounds();
			AppStyler();
			TabSelector();
			
		});
		
	</script>


</head>

<body class="animated fadeIn">

	<style>
	input.form, select.form {
		font-size: 25px; font-family: SourceSans; padding: 0px 20px 0px 20px; 
		height: 60px; 
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
		cursor: pointer;
		font-size: 25px;
		font-family: SourceSans;
		margin-left: 380px;
		background: #688B25;
		color: white;
		border-radius: 10px; 
		box-sizing: border-box;
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

div.notification {
	position: fixed; 
	box-sizing: border-box; 
	padding-top: 320px; 
	left: 0; 
	top: 0; 
	width: 100%; 
	height: 100%; 
	z-index: 100;
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
}


div.ITEM-LIST2 {
	float: top;
	box-sizing: border-box;
	padding: 15px;
	width: 100%;
	margin: 0 auto;
	height: 80px;
	padding-left: 90px;
	text-align: left;
	margin-top: 5px;
}

div.item-actions {
	float: right; 
	min-width: 40px; 
	cursor: pointer;
	text-align: center; 
	padding: 4px; 
	border-radius: 5px; 
	min-height: 5px; 
	margin: 2px;   
	background: #EEE;
}
										
.green {
	background: #006600; 
}

.red {
	background: #FF4D4D; 
}

div.action-containers {
	display: none;
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
		margin: 20px;
		background: #688B25;
		color: white;
		padding: 15px;
		border-radius: 10px; 
		box-sizing: border-box;
}
</style>

						<style>
									
										div.background-box {
											width: 100px; height: 101px;  position: absolute; z-index: 1; opacity: 0.8;
										}
										
										img.background-box {
										
										 width: 100%; height: 100%;
										}
										
										div.background-box-containers {	
											float: left;
											background: #EEE;
											width: 100px;
											height: 101px;
											margin: 0;
										}
										
										div.view-container {
											width: 700px; 
											height: 350px; 
											margin: 0 auto;
											background: #AAA;
											overflow: hidden;
										}
										</style>
										

	<div id="BODY-ACTIONS">
		
		<div style="float: top; width: 100%; height: 30px;"><div id="close2" style="cursor: pointer; float: right;" ><text style="color: #333"> Close this window</text> &nbsp; <i class="fa fa-remove"></i></div></div>
		<div class="SPACER-5"></div>
		
		<div id="edit" class="action-containers animated bounceInLeft ">
			<div  style="width: 100%; height: 50px; float: top; margin: 0 auto; margin-top: 120px;" ><text style="color: #333; font-size: 40px;"><i class="fa fa-edit"></i> &nbsp; Edit Item</text> </div>
			<div  style="width: 100%; height: 50px; float: top; margin: 0 auto; margin-top: 100px;" ><text style="color: #333; font-size: 30px;">This feature will be added shortly!</text> </div>
		</div>
		
		<div id="remove" class="action-containers animated bounceInLeft ">
			<div  style="width: 100%; height: 50px; float: top; margin: 0 auto; margin-top: 120px;" ><text style="color: #333; font-size: 40px;"><i class="fa fa-trash"></i> &nbsp; Remove Item</text> </div>
			<div style='margin-top: 40px;'><text style="color: black; font-size: 30px;">Are you sure you want to remove <br><b><span class="title"></span></b>?<text></div>
			<br>
			<div style='display: inline-block; min-width: 10px; margin: 0 auto;'>
				<div class="YesNo" id="REMOVE-YES">Yes</div>
				<div class="YesNo" id="REMOVE-NO">No</div>
			</div>
		</div>
		
		<div id="view" class="action-containers">
			<div  style="width: 100%; height: 50px; float: top; margin: 0 auto; margin-top: 45px;" ><text style="color: #333; font-size: 40px;"><i class="fa fa-eye"></i> &nbsp; View Item</text> </div>
	
		
		</div>
		
		<div id="add" class="action-containers animated bounceInLeft ">
			<div  style="width: 100%; height: 50px; float: top; margin: 0 auto; margin-top: 35px;" ><text style="color: #333; font-size: 40px;">+&nbsp;Add New Item</text> </div>
			<div  style="width: 100%;min-height: 50px; float: top; margin: 0 auto; margin-top: 10px;" >
					<form action="" method="post" id="ADD-ITEM">				
						<select class="form" id="CAT" style="width: 580px;" name="CATEGORY">
							<option selected="selected"  disabled="disabled">Select Item Category</option>
							<?php
								fetchCategories();
							?>
						</select>
						
						<script>
						$('#CAT').on('change', function() {
						   if(this.value === '14' || this.value === '15' || this.value === '16' || this.value === '17')
						  {
							$('#Auth').attr("disabled", "disabled"); 
							$('#Auth').css('background','#DDD');
							$('#Auth').val("");
							$('#Auth2').val("");
						  }
						  else if(this.value === '10' || this.value === '11' || this.value === '12' || this.value === '13')
						  {
							$('#Auth').hide();
							$('#Auth2').show();
						  }
						  else
						  {
							$('#Auth').show();
							$('#Auth2').hide();
							$('#Auth2').val("");
							$('#Auth').removeAttr("disabled", "disabled"); 
							$('#Auth').css('background','');
						  }
						});
						</script>
						
						
						<div class="SPACER-10"></div>
						<input class="form"  type="textbox" id="TITLE" name="TITLE" style="text-transform: capitalize; width: 580px;" placeholder="Title/Product Name">
						<div class="SPACER-10"></div>
						<input  class="form" type="textbox" id="Auth" name="AUTHOR" style="text-transform: capitalize; width: 282.5px;" placeholder="Author/Artists">
						<input list='platforms'  class="form" type="textbox" id="Auth2" name="PLATFORM" style="display: none; text-transform: capitalize; width: 282.5px;" placeholder="Platform">
						
						<datalist id='platforms'>
							<option value='Xbox 360 - NTSC'>
							<option value='Xbox 360 - PAL'>
							<option value='Xbox One - NTSC'>
							<option value='Xbox One - PAL'>
							<option value='PS2 - NTSC'>
							<option value='PS2 - PAL'>
							<option value='PS3 - NTSC'>
							<option value='PS3 - PAL'>
							<option value='PS4 - NTSC'>
							<option value='PS4 - PAL'>
							<option value='Wii - NTSC'>
							<option value='Wii - PAL'>
						</datalist>
						
						
						<input  class="form" type="textbox" name="PUBLISHER" style="text-transform: capitalize; margin-left: 10px; width: 282.5px;" placeholder="Publisher/Manufacturer/Network">
						<div class="SPACER-10"></div>
						<textarea name="DESCRIPTION"  maxlength="500" style='font-size: 25px; font-family: SourceSans; padding: 10px 20px 10px 20px; 
						height: 100px; 
						box-sizing: border-box;
						width: 580px;
						resize: none;
						border: 0px;
						color: black;
						box-shadow: 0px 0px 20px rgba(0,0,0,.05);
						border-radius: 5px;' placeholder='Item Description (Optional)'></textarea>
						
						<div class="SPACER-10"></div>
						
						<text><div id="error" style="height: 40px; width: 100%; color: black; "></div></text>
						<button id="ITEM-SUBMIT"  class="SUBMIT" type="submit">Add Item &nbsp; <img id="loader" src="loader-white.gif" style="display: none; position: absolute; width: 35px; height: 35px;"></button>
					</form>
					
			</div>
		
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
							<text class="APP-TITLE">My Items</text>
						</div>
						
						<!--
						<div class="APP-SEARCH">
							<input type="text" placeholder="Search in My Items" class="APP-SEARCH">
						</div>	
						-->

						<div class="APP-HEADER-BUTTON" id="AddItem">
							<text class="APP-HEADER-BUTTON">+ Add New Item</text>
						</div>

					</div>	

					<div class="APP-COLOR-BAR"></div>		

					<div class="APP-CONTENT">
							
						<div class="APP-SIDEBAR">
							<div class="APP-SIDEBAR-TITLE">
								<text class="APP-SIDEBAR-TITLE"><b>Actions</b></text>
							</div>
							<div  class="APP-SIDEBAR-CONTENT">
								<div id="LANDING" class="tab-button">General Overview</div>
								<div id="AllItems" class="tab-button">All Items</div>
								<div id="Borrowing" class="tab-button">Items Currently Borrowed</div>
								<div id="Button3" class="tab-button">Add Multiple Items</div>
								

								
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
								
								<div id="AllItemsDiv" class="containers animated fadeInUp">
									<div class="APP-CONTENT-TITLE animated fadeInDown">
										<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing <b>All Items</b></text>
									</div>
									<div style="box-sizing: border-box; padding: 10px; overflow-y: auto; height: 364px;'">
				
									<div id="load">
									</div>
												
									</div>
								</div>
								
								<div id="BorrowingDiv" class="containers animated fadeInUp">
									<div class="APP-CONTENT-TITLE animated fadeInDown">
										<text class="APP-CONTENT-TITLE" id="CONTENT-TITLE">Showing <b>Items Currently Borrowed</b></text>
									</div>
									<div style="box-sizing: border-box; padding: 10px; overflow-y: auto; height: 364px;'">
				
									<div id="load3">
									</div>
												
									</div>
								</div>
							
								<div  id="LANDINGDiv" class="containers animated fadeInUp" style="display: block; overflow: hidden;">
									
									<div id="Loader" style='width: 100%; height: 100%; box-sizing: border-box; padding-top: 130px; position: absolute; z-index: 3; background: #F2D013; '>
										<text style="color: #333; font-size: 80px;"><i class='fa fa-circle-o-notch fa-spin'></i></text><br>
										<text style="color: #333; font-size: 30px;">Loading...</text>
									</div>
									
									<script>
									$(document).ready(function(){
										setTimeout(function(){ $("#Loader").fadeOut(500)}, 3000);
									});
									</script>
									
									<?php
									
										$array =  fetch_items("special", "WHERE OWNER_ID = '".$_SESSION['MY_ID']."'");

										$TOTAL_ITEMS = count($array);
										$BORROW_COUNT = 0;
										$BORROWED_ITEMS = 0;
										foreach($array as $ITEM)
												{
											$BORROW_COUNT += $ITEM['BORROW COUNT'];	
											if($ITEM['STATUS'] == "BORROWED") $BORROWED_ITEMS++;
										}
	
										$AVAILABLE_ITEMS = $TOTAL_ITEMS - $BORROWED_ITEMS; 		
										
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
									
									<div style='width: 100%; height: 100%; position: absolute; z-index: 2; '>
									
										<div class="animated fadeInUp stats-white"  style=" margin-top: 45px; padding: 22px;" >
											<text style="color: #333; font-size: 30px;">
												<i class="fa fa-plus"></i> &nbsp; You have added <b><?php echo $TOTAL_ITEMS; ?></b> items.
											</text>									
										</div>
										
										<div  class="animated fadeInUp"  style="height: 60px; width: 90%; margin: 0 auto; margin-top: 15px;">
											<div style="height: 100%; width: 41.5%; float: left; background: green; margin-left: 8.5%; box-sizing: border-box; padding: 17px; text-align: center; ">
												<text style="font-size: 20px;">
													<i class="fa  fa-circle-o"></i> &nbsp; <b><?php echo $AVAILABLE_ITEMS; ?></b> available items
											</text>	
											</div>	
											<div style="height: 100%; width: 41.5%; float: left; background: #9b0000; box-sizing: border-box; padding: 17px; text-align: center; ">
												<text style="font-size: 20px;">
													<i class="fa  fa-circle-o"></i> &nbsp;  <b><?php if($BORROWED_ITEMS!=0) {print $BORROWED_ITEMS."</b> borrowed items"; }elseif($BORROWED_ITEMS==1){print $BORROWED_ITEMS."</b> borrowed item"; }else{print "0</b> borrowed items"; } ?>
											</text>	
											</div>
										</div>
										
										<div  class="animated fadeInUp"  style="height: 60px; width: 74.7%; margin: 0 auto; background: #333; box-sizing: border-box; padding: 17px; text-align: center; ">
												<text style="font-size: 20px;">
													<i class="fa f fa-line-chart"></i> &nbsp; You've had <b><?php print $BORROW_COUNT; ?></b> borrows till now.
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
												Add  items which are popular, high-in-demand or something that we don't have. 
											</text>	
											</div>						
										</div>
									
									</div>
									
									<div>
			
										<?php
											$array =  fetch_items("special", "WHERE OWNER_ID = '".$_SESSION['MY_ID']."' ORDER BY RAND()");
											
											function backgroundBox($array)
											{
												foreach($array as $ITEM)
												{
													print		"
																<div class='background-box-containers'>
																	<div style='background: ".$ITEM['CATEGORY COLOR'].";' class='background-box'></div>
																	<img src='../images/items/".$ITEM['IMAGE']."' class='background-box'>
																</div>";
												}	
											}
											
											if(count($array)<=28 && count($array)>=7) for($count = 0; $count<=2; $count++) backgroundBox($array);
											backgroundBox($array);
											
											if(count($array)==0)
											{
												print	"
															<div style='width: 100%; box-sizing: border-box; padding: 300px;  height: 100%; background: #F2D013; '>
															</div>
														";
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
