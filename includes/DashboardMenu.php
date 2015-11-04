	
	<script>
	$(document).ready(function(){
			pushListener();
			setInterval(function(){
				pushListener();
			},500);

	});
	
	function pushListener()
	{
		$.post('../dashboard/scripts/push.php', "ACTION=credits",  function success(data){
            $(".myCredits").text(data.trim());
		});
	}
	</script>
	


<div  id="DASHBOARD-MENU-CONTAINER" class="DASHBOARD-MENU-CONTAINER" style="display: none;">

	<div  id="DASHBOARD-MENU" class="DASHBOARD-MENU">
		
		<div ID= "DB-CONT" style="display: none; width: 1010px; float: top; height: 100px; margin: 0 auto;">
			
			<a href="../dashboard">
			<div class="MENU1-BOX" style="background: url('../Homeicon.png') no-repeat #FFF8CE; background-size: 80% 80%; background-position: center; ">
			</div>
			</a>
			
			<div class="MENU1-BOX" style="background: url('../BorrowIcon.png') no-repeat #630460; background-size: 80% 80%; background-position: center; ">
				<div style='width: 100%; height: 100%; background: #333; opacity: 0.9;'>
				</div>
			</div>
			
			<a href="../dashboard/notifications.php">
			<div class="MENU1-BOX" style="background: url('../NotificationsIcon.png') no-repeat #EF9B00; background-size: 80% 80%; background-position: center; ">
			</div>
			</a>
			
			<div class="MENU1-BOX" style="background: url('../MessagesIcon.png') no-repeat #1AA0E2; background-size: 80% 80%; background-position: center; ">
				<div style='width: 100%; height: 100%; background: #333; opacity: 0.9;'>
				</div>
			</div>
			
			<a href="../dashboard/credits.php">
			<div class="MENU1-BOX" style="background: black;">
				<div style="width: 100%; height: 7px;"></div>
				<text style="font-size: 40px;  color: #EEE;"><span class="myCredits"></span></text><br>
				<text style="font-size: 15px;  color: #EEE;" >Remaining</text>		
			</div>
			</a>
			
			<div class="MENU1-BOX" style="background: url('../HistoryIcon.png') no-repeat #009E3B; background-size: 80% 80%; background-position: center; ">
				<div style='width: 100%; height: 100%; background: #333; opacity: 0.9;'>
				</div>
			</div>
			
			<a href="../dashboard/items.php">
			<div class="MENU1-BOX" style="background: url('../MyItemIcon.png') no-repeat #F2D013; background-size: 80% 80%; background-position: center; ">
			</div>
			</a>
			
			<a href="../dashboard/settings.php">
			<div class="MENU1-BOX" style="background: url('../SettingsIcon.png') no-repeat #FFF; background-size: 70% 70%; background-position: center; ">
			</div>
			</a>
			
			<a href="../dashboard/help.php">
			<div class="MENU1-BOX" style="background: url('../HelpIcon.png') no-repeat #1857B6; background-size: 80% 80%; background-position: center; ">
			</div>
			</a>
		</div>
		
		<div style="width: 1010px; float: top; height: 30px; margin: 0 auto;">
		
			<div class="MENU1-BOX2">
			Dashboard
			</div>
			
			<div class="MENU1-BOX2" style="color: #AAA;">
			My Borrows
			</div>
			
			<div class="MENU1-BOX2">
			Notifications
			</div>
			
			<div class="MENU1-BOX2"  style="color: #AAA;">
			Messages
			</div>
			
			<div class="MENU1-BOX2"  style="color: #AAA;">
			Credits
			</div>
			
			<div class="MENU1-BOX2"  style="color: #AAA;">
			History
			</div>
			
			<div class="MENU1-BOX2">
			My Items
			</div>
			
			<div class="MENU1-BOX2">
			Settings
			</div>
			
			<div class="MENU1-BOX2">
			Help
			</div>
			
		</div>
		
		

	</div>

</div>
