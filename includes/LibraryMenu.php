
<script>
$(document).on("click",".LIBRARY-QUICK-LINKS",function(e){
	var myFunction = $(this).attr("id");
	if(myFunction!="Upload")
	{
		window.location.assign("filter.php?ITEM_FILTER="+myFunction)
	}
	else
	{
		window.location.assign("../dashboard/items.php");
	}
});
</script>

<style>
button.LIBRARY-QUICK-LINKS:hover{
  box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
}
button.searchGo {
	cursor: pointer; 
	box-shadow: inset 0 33px rgba(255,255,255,0.1); 
	width: 70px; height: 37px; 
	border-top-right-radius: 10px; 
	border-bottom-right-radius: 10px;
	background: #385D8A; 
	border-style:none; 
	outline: none; 
	margin-right: 37px; 
	float: right;
}
button.searchGo:hover {
	box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
}
</style>


<div style="height: 37px; width: 100%; float: top; background: #4F81BD; padding: 6.5px 20px 6.5px 20px;">
		
	<div style="width: 180px; height: 37px; float: left; padding-left: 10px; margin-top: -2px;">
		<text style="font-size: 30px;">Browse Items</text>
	</div>
	
	<button id="CATEGORY-MENU-LAUNCHER" class="LIBRARY-CATEGORY-LAUNCHER">
	<text style="font-size: 17px;"><i class="fa fa-bars"></i> &nbsp; <strong>CATEGORIES &nbsp;&nbsp;</strong><span id="NAV">&#9660;</span></text>
	</button>

	<button class="LIBRARY-QUICK-LINKS" id="Hot and New">
		<text style="font-size: 16px;"><i class="fa fa-bolt"></i> &nbsp; Hot & New</text>
	</button>
	
	<button class="LIBRARY-QUICK-LINKS" id="Trending">
		<text style="font-size: 16px;"><i class="fa fa-heart"></i> &nbsp; Trending</text>
	</button>
	
	<button class="LIBRARY-QUICK-LINKS" id="Upload">
		<text style="font-size: 16px;"><i class="fa fa-cloud-upload"></i> &nbsp; Upload</text>
	</button>
	
	
	<form action='filter.php' method='GET'>
		<button type="submit" class="searchGo">
			<text style="font-size: 18px;">Search</text>
		</button>

		<style>
		input::-webkit-calendar-picker-indicator {
		  display: none;
		}
		</style>
		
		<script>
		$(document).ready(function(){
			$('#SEARCH').on('keyup', function (e) {
				var search2 = $('#SEARCH').val();
				var datalist2 = 'mySEARCH='+encodeURIComponent(search2);
				ajax(datalist2);
			});
			
			function ajax(datalist2)
			{
				$.post('../includes/datalist.php', datalist2,  function success(data2){
					console.log(data2);
					$('#items').empty();
					var json = JSON.parse(data2);	
					$.each(json,function(index, value){
						console.log(value);
						$('#items').append("<option value='"+value+"'>");
					});
			});
			}
		});
		</script>
		

		
		<input type="textbox" placeholder="Looking for something?" autocomplete="off" style="background: url(search.png) white no-repeat left; background-size: 23px 26px;  background-position: 7px 6px;" id="SEARCH" class="LIBRARY-SEARCH-BOX" name="SEARCH" list='items'/>
	
		<?php
		
		if(isset($_GET['ITEM_FILTER']))
		{
			print "<input type='hidden' name='ITEM_FILTER' value='".$_GET['ITEM_FILTER']."'/>";
		}
		
		?>
		
		<datalist id='items'>

			
		</datalist>		
	</form>
	
</div>

<div class="LIBRARY-CATEGORY-MENU" id="CATEGORY-MENU">
	<?php
	
		$query = "SELECT * FROM main_categories";
		$result = mysql_query($query);
		
		while($row = mysql_fetch_array($result))
		{
			$CATEGORY_TITLE = $row['CATEGORY_MAIN_TITLE'];
			$CATEGORY_ID = $row['CATEGORY_ID'];
			
			if($CATEGORY_TITLE == "OTHER ITEMS")
			{
			
						
			
			print	"
					<div class='LIBRARY-CATEGORY-LINK-CONTAINER'  style='background: rgba(0,0,0,0);'>	
						<text style='font-size: 18px;'><b>$CATEGORY_TITLE</b></text>
						<div class='SPACER-5'></div>
						<hr class='white'>
						<div class='SPACER-30'></div>
						<div class='SPACER-30'></div>
						<div class='SPACER-10'></div>
						<text style='font-size: 25px; font-weight: bold;'>COMING SOON</text>
					";
					

			}else
			{
			
					print	"
							<div class='LIBRARY-CATEGORY-LINK-CONTAINER'>	
								<text style='font-size: 18px;'><b>$CATEGORY_TITLE</b></text>
								<div class='SPACER-5'></div>
								<hr class='white'>
								<div class='SPACER-5'></div>
								<div class='SPACER-2'></div>
								<div class='parent' style='width: 100%; height: 150px;'>
								<div class= 'LINK-CONTAINER'; style='width: 100%; min-height: 1px;' id='link-container$CATEGORY_ID'>
							";
					$query2 = "SELECT * FROM sub_categories WHERE MAIN_CATEGORY_ID = '$CATEGORY_ID'";
					$result2 = mysql_query($query2);
				
					while($row2 = mysql_fetch_array($result2))
					{
						$SUB_CATEGORY_TITLE = $row2['SUB_CATEGORY'];
						$URL = urlencode($SUB_CATEGORY_TITLE);
						Print	"
								<a href='filter.php?ITEM_FILTER=$URL' class='CATEGORY-MENU'>$SUB_CATEGORY_TITLE</a><br>
								";
					}
					print "</div></div>";
			
			}
			
			Print	"
						
					</div>
						";
		}
		
	?>

</div>
