<div style="height: 60px; width: 100%; min-width: 1000px;  text-align: center; padding-top: 10px; <?php if(isset($THEME) && $THEME = "DARK"){ print "background: #DDD;"; }else{ print ""; } ?>" id="HEADER-MENU">
	
	<div style="height: 50px; display: inline-block; width: 90%; min-width: 1000px; margin: 0 auto; overflow: hidden;">
		
		<div style="margin-top: 5px; height: 40px; width: 40px; border-radius: 5px; overflow: hidden; float: left; margin-left: 20px;">
			<img src="<?php if(isset($THEME) && $THEME = "DARK"){ print "../images/logos/green-no-text.png"; }else{ print "../images/logos/white-no-text.png"; } ?>" style="height: 40px; width: 40px;">
	
		</div>
		
		<div style="height: 50px; width: 100px; float: left; padding-top: 7px; margin-left: 10px;">
			<text style="font-size: 29px;<?php if(isset($THEME) && $THEME = "DARK"){print "color: black";}?>">librorum</text>
		</div>
		
		<div class="MENU-TITLE-MENU-LINKS" style="margin-left: 20px;">
			<a class="HEADER-MENU-LINKS" href="../gamma/" <?php if(isset($THEME) && $THEME = "DARK"){ /* DO NOTHING */ }else{ print "style='color: white;'"; } ?>>Home Page</a>
		</div>
		
		<div class="MENU-TITLE-MENU-LINKS">
			<a class="HEADER-MENU-LINKS" href="../library" <?php if(isset($THEME) && $THEME = "DARK"){ /* DO NOTHING */ }else{ print "style='color: white;'"; } ?>>Browse Library</a>
		</div>
		
		<div class="MENU-TITLE-MENU-LINKS">
			<a class="HEADER-MENU-LINKS" href="../about/" <?php if(isset($THEME) && $THEME = "DARK"){ /* DO NOTHING */ }else{ print "style='color: white;'"; } ?>>About Us</a>
		</div>
		
		<div class="MENU-TITLE-MENU-LINKS">
			<a class="HEADER-MENU-LINKS" href="../about/contact.php" <?php if(isset($THEME) && $THEME = "DARK"){ /* DO NOTHING */ }else{ print "style='color: white;'"; } ?>>Contact Us</a>
		</div>
		
		<div class="MENU-TITLE-MENU-LINKS" >
			<a class="HEADER-MENU-LINKS" href="../dashboard/help.php" <?php if(isset($THEME) && $THEME = "DARK"){ /* DO NOTHING */ }else{ print "style='color: white;'"; } ?>>Help</a>
		</div>
			
		<?php
		
			if(isset($THEME) && $THEME == "DARK")
			{ 
				$color =   "#444";
				$THEME = "DARK";
			}
			else
			{
				$color = "white";
				$THEME = "LIGHT";
			}
		
			if(isset($_SESSION['MY_EMAIL']))
			{	
				$MY_NAME = $_SESSION['MY_NAME'];
				$MY_ID = $_SESSION['MY_ID'];
			
				$query = "SELECT * FROM users WHERE USER_ID = $MY_ID";
				$result = mysql_query($query);
				
				while($row = mysql_fetch_array($result))
				{
					$MY_DP = $row['DP_LINK'];
				}
				
				print	"	
						<div style='float: right; min-width: 75px; margin-right: 15px; '>
							<form method='post' id='LOGOUT-FORM' accept-charset='UTF-8'>
								<input type='submit' name='submit' value='Log Out' class='button LOGOUT-BUTTON'>
							</form>
						</div>
						
						<div id='DASHBOARD-MENU-LAUNCHER' class='button MENU-LAUNCHER-".$THEME."'>
							<div  class='button' style='padding-top: 7.5px; float: right; min-width: 45px; height: 41px;'>
								<img id='MENU-DP' src='../images/users/$MY_DP' style='height: 35px; width: 35px; border-radius: 5px;'>
							</div>
							
						<div  class='button'  style=' float: right; min-width: 20px; padding-top: 7px; height: 38px; margin-right: 5px; margin-top: 5px;'>
								<text style='color: ".$color.";'>Welcome,  <b>".ucwords($MY_NAME)."</b>
						";		
				
					if(isset($DASHBOARD_MENU) && ($DASHBOARD_MENU != FALSE))
					{	
						Print	"
									&nbsp;<span id='NAV2'><i class='fa fa-bars' style='color: #444;'></i></span>&nbsp;
									";	
					}
									
					Print	"		
								
									</text>
									</div>
								</div>
						
								";
						
			}else
			{

				
					if(isset($HOME_PAGE) && $HOME_PAGE == TRUE)
					{
							
							
				print	"				
						<div  style='float: right; min-width: 75px;'>
							<form action='../accounts/login.php'>
								<input type='submit' value='Log In' class='button LOGOUT-BUTTON' style='border: 3px solid rgba(255,255,255,0.1);'>
							</form>
						</div>
							";
							
					print	"				
							<div style='float: right; min-width: 75px;'>
								<form action='../accounts/register.php'>
									<input type='submit' value='Register Now' class='button LOGOUT-BUTTON' style='background: #688B25; border: 3px solid rgba(255,255,255,0.1);'>
								</form>
							</div>
								";
					}else
					{
					
						print	"				
						<div  style='float: right; min-width: 75px;'>
							<form action='../accounts/login.php'>
								<input type='submit' value='Log In' class='button LOGOUT-BUTTON' >
							</form>
						</div>
							";
							
					Print 	"
							<div  id='DASHBOARD-MENU-LAUNCHER' class='MENU-LAUNCHER-$THEME'>
								<div  style=' float: right; min-width: 20px; padding-top: 7px; height: 38px; margin-right: 5px; margin-top: 5px;'>
									<text style='color: ".$color.";'>You aren't logged in.</text>
								</div>
							</div>
							";
					}
			}
		?>
		
	</div>

</div>

<?php
	if(isset($DASHBOARD_MENU) && $DASHBOARD_MENU == TRUE)
	{
		include('../includes/DashboardMenu.php');
		Print "<div class='SPACER3' id='SPACER'></div>";
	}
?>	


