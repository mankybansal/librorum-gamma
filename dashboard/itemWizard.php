<?PHP
	
	ERROR_REPORTING(0);

	//PREREQUISITE VARIABLES FOR THE SessionValidate.php PAGE
	$REDIRECT_PATH = "";
	$MY_PAGE_SET = TRUE;
	$LOGIN_PAGE_SET = FALSE;
	$LOGIN_REQUIRED = TRUE; 
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
	<link href="itemWizard.css" rel="stylesheet" type="text/css"/>
	
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	<link rel="icon" href="../favicon.ico" type="image/x-icon">
	
	<!-- JAVASCRIPT LINKS -->
	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.logout.js"></script>
	
	<script type="text/javascript" src="../includes/jquery.menu-launcher.js"></script>
	<script type="text/javascript" src="../includes/AdaptiveBackground.js"></script>
	<script type="text/javascript" src="../includes/jquery.dashboard.js"></script>
	
	<script>
			
		var drawCircle = true;
		var categoryID;
		var categoryNUM;
		var getColor; 
		var subCategoryID;
	$(document).ready(function(){
	
	


		$('.iconBox').hover(
			function(){				
				var buttonID = $(this).attr('id');
			},
			
			function(){
				var buttonID = $(this).attr('id');
			}	
		);
		
		$('.goBack').click(function(){
			$(".container").not('.iconContainer').removeClass('bounceInUp').addClass('bounceOutDown').delay(1000).fadeOut(100);
			$(".iconContainer").delay(700).fadeIn(300);
			$(".wizardTitle").delay(700).fadeIn(500);
		});
		
		
		
		function fetchCategories()
		{
			$('.subCategory').empty();
			$('.subCategory').append("<option selected disabled>Select Sub Category</option>");
					
			var dataString = "ACTION=fetchCategories" + "&CATEGORY_ID=" + categoryNUM[1];
			$.post('scripts/itemWizardFunctions.php', dataString,  function success(data){
				var json = JSON.parse(data);
				$.each(json,function(index, value){
					$.each(value,function(index2, value2){
						categoryValue = value['CATEGORY ID'];
						categoryName  = value['SUB CATEGORY'];
					});	
					$('.subCategory').append("<option value='"+categoryValue+"'>"+categoryName+"</option>");	
					$("option").css("background-color", getColor);
				});
			});	
		}
		
		function validateURL(textval) {
			var urlregex = new RegExp(
				"^(http|https|ftp)\://([a-zA-Z0-9\.\-]+(\:[a-zA-Z0-9\.&amp;%\$\-]+)*@)*((25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])|([a-zA-Z0-9\-]+\.)*[a-zA-Z0-9\-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\?\'\\\+&amp;%\$#\=~_\-]+))*$");
			return urlregex.test(textval);
		}
		
		$('.imageUrl').on('input keyup keydown click hover', function() {
			var title = $(this).val();
			$("#testBox").text(validateURL(title));
		
		});
		
		
		
		
				
		var currentSuggestions = [];
		var newSuggestions = [];
		var diff = [];
		var counter = 0;
		
		$('.itemTitle').on('input', function() {	
				
			var title = $(this).val();
			categoryNUM = categoryID.split('-');
			ajax(title, categoryNUM[1]);
			if(title!=""){

				if (!$(this).is(':animated')) {
					$('.startTyping').stop().animate({
						'margin-top': "-160px",
						'opacity':'0'
					}, 700);
					$(this).stop().animate({ 
							 'margin-top': "155px",
							 'width': "550px",
							 'height': "60px",
							 'font-size': '25px',
							 'padding': '17.5px',
							 'border-radius':'0px'
					}, 700);
						
					$(".continueTwo").stop().animate({ 
					 'font-size': '20px',
					 'padding': '13px 25px 13px 25px',
					 'border-radius':'0px'
					}, 700);
			
					$('.suggestionFrame').stop().animate({
							'margin-top': "20px"
					}, 1000);	
				}
			}else{
			
			
				$(".suggestionInnerFrame").empty();
				
					$('.startTyping').stop().delay(500).animate({
							'margin-top': "90px",
							'opacity':'1'
					}, 700);
						
					$(this).stop().delay(500).animate({ 
					 'margin-top': "15px",
					 'width': "700px",
					 'height': "78px",
					 'font-size': '30px',
					 'padding': '30px',
					 'border-radius':'10px'
					}, 700);
					
					$(".continueTwo").stop().delay(700).animate({ 
					 'font-size': '30px',
					 'padding': '17px 35px 17px 35px',
					 'border-radius':'10px'
					}, 700);
			
			
				$('.suggestionFrame').stop().animate({
					'margin-top': "300px"
				}, 700);
				
				newSuggestions = [];
				diff = [];
				currentSuggestions = [];
			}
		
		});
		
		setInterval(function(){
			if ($('.suggestionInnerFrame:not(#noSuggestions)').children().length == 0){
				 $('.suggestionInnerFrame').append("<div id='noSuggestions' style='margin-top: 80px; width: 100%;'><text style='color: black; font-size: 25px;'>Sorry, no suggestions available!</text></div>");
			}
		}, 2000);

		
		function ajax(search2, search3){
			counter++; 
			if(counter%2!=0){
				return;
			}
			var datalist3 = 'mySEARCH='+encodeURIComponent(search2)+'&myCat=' + encodeURIComponent(search3) ;
			$.post('scripts/itemWizardFunctions.php', 'ACTION=suggestionArray&SEARCH=' + search2 + '&CAT='+search3, function success(data2){
				
				var json = JSON.parse(data2);			
				
				$.each(json,function(index, value){
					newSuggestions.push(value);
				});
						
				$('.suggestionInnerFrame > .ITEM-CONTAINER').each(function(){
				   currentSuggestions.push($(this).attr('id'));
				});
				
				diff = $(currentSuggestions).not(newSuggestions).get();
				$.each(diff, function(index, value){
					$("#" + value).remove();
				});
				
				diff = [];				
				diff = $(newSuggestions).not(currentSuggestions).get();

				$.each(diff, function(index,value){
				
					var myItem =	{
										title:"",
										publisher: "",
										categoryColor: "",
										image: "",
										mainCategory: "",
										infoID: "" 
									};
					
					$.post('scripts/itemWizardFunctions.php', 'ACTION=fetchSuggestion&INFO_ID='+value,  function success(data){
						var json2 = JSON.parse(data);
						$.each(json2,function(index7, myvalue){
							$.each(myvalue,function(index2, value2){
								myItem.title = myvalue['TITLE SHORT'];
								myItem.publisher = myvalue['PUBLISHER'];
								myItem.categoryColor = myvalue['CATEGORY COLOR'];
								myItem.image = myvalue['IMAGE'];
								myItem.mainCategory = myvalue['MAIN CATEGORY'];
								myItem.infoID = myvalue['INFO ID'];
							});		
						});		

						$("#noSuggestions").remove();
						
						if($("#"+myItem.infoID).length==0){
						
							$('#itemTemplate').clone().attr('id', myItem.infoID).appendTo(".suggestionInnerFrame");
							$('#' + myItem.infoID + ' > .ITEM-TITLE').append(myItem.title);
							$('#' + myItem.infoID + ' > .ITEM-IMAGE-CONTAINER > .ITEM-CATEGORY').append(myItem.mainCategory);
							$('#' + myItem.infoID + ' > .ITEM-IMAGE-CONTAINER > .ITEM-CATEGORY').css('background', myItem.categoryColor);
							$('#' + myItem.infoID + ' > .ITEM-AUTHOR').append(myItem.publisher);
							$('#' + myItem.infoID + ' > .ITEM-IMAGE-CONTAINER').css('background', myItem.categoryColor);
							
							if(myItem.image!="default2.jpg" && myItem.image!="default2.png"){
								$('#' + myItem.infoID + ' > .ITEM-IMAGE-CONTAINER > .ITEM-IMAGE-BACKGROUND').append("<img class='ITEM-IMAGE' data-adaptive-background='1' src='../images/items/thumbs/"+myItem.image+"'>");
							}else{
								$('#' + myItem.infoID + ' > .ITEM-IMAGE-CONTAINER > .ITEM-IMAGE-BACKGROUND').append("<img class='ITEM-IMAGE' style='width: 100%; height: 105%;' src='../images/items/thumbs/"+myItem.image+"'>");
							}
							$.adaptiveBackground.run();
						}
						
						
					});	
									
				});	
					
				newSuggestions = [];
				currentSuggestions = [];
				diff = [];

			});
			
			
				
		
			
		}
		
		

		setInterval(function(){
			$.adaptiveBackground.run();
		}, 2000);
	
	function ViewportResize() {

		var viewportWidth = $(this).width();
		var viewportHeight = $(this).height();

		console.log(viewportHeight);
		
		var headerHeight = $(".header").height();
		var footerHeight = $(".footer").height();
		var contentHeight = $(".content").height();
		console.log(headerHeight);
		console.log(footerHeight);
		console.log(contentHeight);
		
		var spacerHeight = (viewportHeight - (headerHeight + footerHeight + contentHeight)) / 2;
		console.log(spacerHeight);
		$('#spacer-1').css('height', spacerHeight);
		$('#spacer-2').css('height', spacerHeight);

	};
	
	$(window).resize(function() {
		ViewportResize();
	});
	
	ViewportResize();



	
		var itemTitle;
		var itemCategory;
		var itemDescription;
		var itemISBN;
		
		function updateItem(){
			itemTitle = $('.itemTitle').val();
			itemDescription = $('.itemDescription').val();
			itemCategory = $('#categorySelect2 option:selected').text();
		}
		
		$('.giveMeSuggestions').click(function(){
			updateItem();
			alert(itemTitle + itemCategory);
		});
		
		$('.continueTwo').click(function(){
			if(categoryNUM[1]==2)
			{
				$(".container").not('.iconContainer').removeClass('bounceInUp').addClass('bounceOutDown').delay(1000).fadeOut(100);
				$(".imdbContainer").fadeIn(200).addClass('bounceInUp').removeClass('bounceOutDown');
				itemISBN = $('.itemISBN').val();
				itemTitle = $('.itemTitle').val();
				var dataString = "ITEM_TITLE=" + itemTitle; 
				$.post('imdb.php', dataString,  function success(data){
					var json = JSON.parse(data);			
					$.each(json,function(index, value){
						if(index=='Poster'){
							$(".imdbImage").append("<img src='"+value+"' data-adaptive-background='1' style=' margin-top: -100px; margin-left: -50px; width: 110%;-moz-filter: blur(10px); -webkit-filter: blur(10px); filter: blur(10px);'>");
							
						}
						
						if(index=='Title')
						{
								$(".imdbText").append("<text id='imdbTitle' style='color: white; font-size: 45px;'><b>"+value+"<b><br></text>");
						
						}
						if(index=='Released'|| index=='Awards'||index=='Genre'||index=='Director'||index=='Actors'||index=='Plot'||index=='Rating'){
						
						
							$(".imdbText").append("<text  style='color: white; font-size: 20px;'><b>"+index+":</b> "+value+"</text><br>");
						}
						
						if(index=='imdbRating'){
							var stars = Math.floor(value);
							var fstars = Math.floor(stars/2);
							var hstars = stars-fstars*2
							var left= 5-Math.floor(value/2)-1;
							$("#imdbTitle").after("<div id='mySpacer'><br><div>");
							
							for(var i=0; i<fstars; i++){
								$("#mySpacer").before("<i class='fa fa-star' style='font-size: 25px; color: #E7711B;' ></i>");
							}
							for(var i=0; i<hstars; i++){
								$("#mySpacer").before("<i class='fa fa-star-half-o' style='font-size: 25px; color: #E7711B;' ></i>");
							}
							for(var i=0; i<left; i++){
								$("#mySpacer").before("<i class='fa fa-star-o' style='font-size: 25px; color: #CCCCCC;' ></i>");
							}
							$("#mySpacer").before("<text style='color: white; font-size: 25px;'>&nbsp;&nbsp;"+value+"/10 &nbsp; <b>IMDb</b></text> ");
							
						}
					});
				
					$(".imdbText").append("<text style='color: white; font-size: 25px;'><br>Does this match your item?<br></text><div id='match'>Yes it matches</div><div id='noMatch'>No it doesn't</div>");
				});
			}
			$.adaptiveBackground.run();
		});
		

		
		$('.iconBox').click(function(){
			categoryID = $(this).attr('id');
			categoryNUM = categoryID.split('-');
			getColor   = $("#"+categoryID).css("background-color");			
			$(".container").not('.iconContainer').removeClass('bounceInUp').addClass('bounceOutDown').delay(1000).fadeOut(100);
				
			$(".iconContainer").delay(300).fadeOut(300);
			$(".wizardTitle").delay(300).fadeOut(500);
			$(".container").not('.iconContainer, .imdbContainer').css("background-color", getColor);
			$(".itemTitle").css("background-color", getColor);
			
			
			var titlePrompt = "";
			$('.formVaries').hide();
			switch(parseInt(categoryNUM[1])){
				case 1: titlePrompt = "Title of the Book/Magazine";
						break;
				case 2: titlePrompt = "Name of the Movie/TV Series/Album";
						break;
				case 3: titlePrompt = "Title of the Video Game";
						break;
				case 4: titlePrompt = "Name of the Product/Tool/Appliance";
						break;
				case 5: titlePrompt = "Name of the Product/Item (Other)";
						break;
			}
			$('.itemTitle').attr("placeholder", titlePrompt);
			$(".inputContainer").fadeIn(200).addClass('bounceInUp').removeClass('bounceOutDown');
			/*
			//Change Title Prompt
			
			*/
			//FOR CHANGING FORM
			var mainCategoryTitle = $("#"+categoryID+"-title").text();
			$(".mainCategoryTitle").text(mainCategoryTitle);

			fetchCategories();
			
			
		});
	});
	
	</script>
	
</head>

<body>
	<div class="header">
	<?php include('../includes/HeaderMenu.php'); ?>
	</div>
	
	<!-- VIEWPORT SPACER -->
	<div class="viewport-spacer" id="spacer-1"></div>
	<!-- VIEWPORT SPACER -->

	<div class="content">
		<div class="mainContainer animated fadeInUp">
			
			<div class='wizardTitle' style='width: 100%; padding: 0px 45px 0px 45px; box-sizing: border-boxl'>
				<div class='SPACER-25'></div>
				<text style='font-size: 40px; color: #EEE;'>Item Upload Wizard</text><br>
				<text style='font-size: 25px; color: #EEE;'>What type of item do you want to add?</text>
			</div>
			
			<div class='iconContainer container animated fadeInUp'>
				<div class='iconBox animated fadeInLeft delay1-0S' id='category-1' style='background: #9BBB59'>
					<text class='IconCategoryTitle'><i class='fa fa-book'></i></text><br>
					<div class='SPACER-5'></div>
					<text style='font-size: 30px;' id='category-1-title'>BOOKS & READING</text><br>
					<text>Ficton, Non-Fiction, Magazines, Academic Material, etc.</text>
				</div>
				<div class='iconBox animated fadeInLeft delay1-2S' id='category-2' style='background: #8064A2'>
					<text class='IconCategoryTitle'><i class='fa fa-video-camera'></i></text>
					<div class='SPACER-5'></div>
					<text style='font-size: 30px;' id='category-2-title'>MOVIES, CDs, TV & DVDs</text><br>
					<text>DVDs, Collections, Television Series, CD Albums, Records</text>
				</div>
				<div class='iconBox animated fadeInLeft delay1-4S'  id='category-3'  style='background: #C0504D'>
					<text class='IconCategoryTitle'><i class='fa fa-gamepad'></i></text>
					<div class='SPACER-5'></div>
					<text style='font-size: 30px;' id='category-3-title'>GAMING & CONSOLES</text><br>
					<text>PC, PlayStation, XBox, Wii, and other Console Video Games</text>
				</div>
				<div class='iconBox animated fadeInLeft delay1-6S'  id='category-4' style='background: #F79646'>
					<text class='IconCategoryTitle'><i class='fa fa-wrench'></i></text>
					<div class='SPACER-5'></div>
					<text style='font-size: 30px;' id='category-4-title'>TOOLS & APPLIANCES</text><br>
					<text>Garage, Kitchen, Outdoor Tools & Applicances</text>
				</div>
				<div class='iconBox animated fadeInLeft delay1-8S'  id='category-5' style='background: #333'>
					<text class='IconCategoryTitle' style='color: white;'><i class='fa fa-circle-o'></i></text>
					<div class='SPACER-5'></div>
					<text style='font-size: 30px; color: #AAA;' id='category-5-title'>OTHER & MISC ITEMS</text><br>
					<text style='color: #AAA;'>Something that doesn't fit in these categories?</text>
				</div>
			</div>	
			
			<div class='inputContainer container animated bounceInUp'>
				<div class='formFrame animated fadeIn'>
					<div class='formTitleContainer animated fadeInDown'>
						<div class='wizardNavigation animated fadeInDown'>
							<span class='goBack textButton'>GO BACK</span>
							<span class='information textButton'>INFORMATION</span>
							<span class='guidelines textButton'>ITEM UPLOAD GUIDELINES</span>
						</div>
						<div style='margin-left: 30px; float: left;'>
							<text style='font-size: 40px; color: white;'><span class='mainCategoryTitle'></span></text>
						</div>
						<div style='margin-left: 30px; float: left;'>
							<select id='categorySelect2' style='margin-top: 2px;' class='subCategory wizardInputTheme'></select>
						</div>
						
					</div>
				
					<script>
					
					$(document).ready(function () {
						function addCircle() {
							var $circle = $('<div style="background: rgba(0,0,0,0.2);" class="circle"></div>');
							$circle.animate({
								'width': '500px',
								'height': '500px',
								'margin-top': '-280px',
								'margin-left': '-250px',
								'opacity': '0'
							}, 4000);
							$('.formContainer').append($circle);
						
							setTimeout(function __remove() {
								$circle.remove();
							}, 4000);
						}
						addCircle();
						setInterval(function(){
							if(drawCicle=true) addCircle();
						}, 2000);
					});
					</script>
				
					<div  class='formContainer animated fadeInUp'>
					
						<div style='position: absolute; width: 100%; margin: 0 auto; z-index: 2;'>
						<div class='formElements'>
							<div class='startTyping' style='margin-top: 90px;'>
								<text class='inputPrompt'>Start typing, and we'll help you out...</text><br>
							</div>
							<input type='textbox' name='itemTitle' style='margin-top: 15px;' id='itemTitle' class='itemTitle omniBarTheme' placeholder='Title of the Item'>
							<div class='continueButton continueTwo'>Next</div>
						
						</div>
			
						<!--
						<div class='authorPublisher formVaries formElements' style='display: none;'>
							<input type='textbox' name='itemAuthor' class='itemAuthor wizardInputTheme' placeholder='Author/Writer'>
							<input type='textbox' name='itemPublisher' class='itemPublisher wizardInputTheme' placeholder='Publisher'>
						</div>		
			
						<div class='formElements'>
							<textarea name='itemDescription' class='itemDescription wizardInputTheme' maxlength=500 placeholder='Enter the description of the Item (Optional)'></textarea>
						</div>
						-->
						<!--<span id='testBox'></span>-->
						
						
						
						<div class='suggestionFrame'>
							<div style='float: top; width: 100%;'><text>Here are some suggestions for you:</text></div>
							<div class='suggestionInnerFrame' style='float: top; width: 100%; height: 210px; margin-top: 10px;'>
							</div>
						</div>
						
						</div>
					</div>
				</div>
				<!--
				<div class='imageFrame animated fadeInUp'>
					
					<div class="SPACER-20"></div>
					<text style='color: white;'>ADD AN IMAGE</text>
					<div class='imageContainer'>
						<div style='margin-top: 60px;font-size: 50px; color: white;'>+</div>
					</div>
					
					<div class='uploadButtons'>REMOVE</div>
					<div class='uploadButtons'>ADD MORE</div>
					
					<div class="SPACER-10"></div>
					<div class="divider"><hr class="left">OR<hr class="right"></div>					
					<div class="SPACER-5"></div>
					
					<text style='color: white;'>UPLOAD FROM URL</text>
					<input type='textbox' name='imageUrl' id='imageUrl' class='imageUrl' placeholder='PASTE URL HERE'>
								
					<div class="SPACER-10"></div>
					<div class="divider"><hr class="left">OR<hr class="right"></div>					
					<div class="SPACER-5"></div>
					
					<text style='color: white;'>FIND IMAGES ON THE WEB</text>
					<div class="SPACER-5"></div>
					<div class='uploadButtons giveMeSuggestions'>GIVE ME SUGGESTIONS</div>
				</div>
				-->
			</div>
		
			
			<div class='imdbContainer container animated bounceInUp'>
				<div class='wizardNavigation animated fadeInDown' style='position: absolute; width: 100%;z-index: 10;'>
					<span class='goBack textButton'>GO BACK</span>
					<span class='information textButton'>INFORMATION</span>
					<span class='guidelines textButton'>ITEM UPLOAD GUIDELINES</span>
				</div>
				
				<div class='imdbImage' style='overflow: hidden; text-align: center; position: absolute; width: 100%; height: 100%; z-index: 0;'></div>
				<div class='imdbText'style='background: rgba(0,0,0,0.5);color: white; box-sizing: border-box; padding: 60px 70px 30px 70px; position: absolute; width: 100%; height: 100%; z-index: 5;' ></div>
				
			</div>
			
		</div>

	</div>
	
	<!-- VIEWPORT SPACER -->
	<div class="viewport-spacer" id="spacer-2" style='text-align: center'>
		
	</div>
	<!-- VIEWPORT SPACER -->
	
	<div class="footer">
		<text style='color: white;'>
				MMXIV &copy; Copyright Librorum. All Rights Reserved.
		</text>
	</div>

		
</body>

</html>



<div class='templates'>

		<div class='ITEM-CONTAINER' id='itemTemplate'>
		
			<div class='ITEM-IMAGE-CONTAINER'>
				<div class='ITEM-IMAGE-BACKGROUND'>
				
				</div>
				<div class='ITEM-CATEGORY'></div>
			</div>
			
			<text class='ITEM-TITLE' style='color: black;'></text><br>
			<text class='ITEM-AUTHOR' style='color: black;'></text>
		</div>
		
</div>