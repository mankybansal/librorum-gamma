<?php	SESSION_START();	?>
<?PHP	ERROR_REPORTING(0);	?>
<!DOCTYPE html>
<html>

<head>

	
	<!-- LINKS FOR FILES REQUIRED ON PAGE. -->
	<script type="text/javascript" src="../includes/jquery.min.js"></script>

	<!-- PHP INCLUDES. -->
	<?php 
		include '../includes/ServerConnect.php';
	?>
	
	<!-- OTHER SCRIPTS -->
	<style>
	input:focus,
	select:focus,
	textarea:focus,
	button:focus {
		outline: none;
	}
	</style>
	<script>
	
		$(document).ready(function(){
			$("#messages").load("data.php");
			setInterval(function() {
				$("#messages").load("data.php");
			}, 100);
				$("#treads").load("data2.php");
			setInterval(function() {
				$("#treads").load("data2.php");
			}, 100);
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
							$("#messages").animate({ scrollTop: $("#messages")[0].scrollHeight }, 1000);

							$("#message_text").attr("placeholder", "Message sent.");
							
							$('#message_text').val('');
							
							$("#treads").load("data2.php");
							
							setTimeout(function() {
							$("#message_text").attr("placeholder", "Type message here...");
							}, 2000);
							
							
						}
					});
				}
				return false;
			});
		});
	</script>


	<!-- PHP PAGE RESTRICTIONS & SESSION DATA -->
	<?php
		if(isset($_SESSION['MY_EMAIL']))
		{
			//Do Nothing
		}
		else
		{
			Print	"
					<script>
					   parent.location.href  = '../BACKEND/login.php' ;
					</script>
					";
		}
	?>


</head>
	
	
	
	<div style="width: 700px; height: 610px; margin: 0 auto; margin-top: 20px; background: #EEE; border-radius: 5px; border: 2px solid #DDD; overflow: hidden;">
		<div style="box-shadow: 0 0 0px #000, 0 0 1px #000, 0 0 0px #000, 0 0 0px #FFF, 0 0 25px #CCCCCC;  width: 680px; height: 75px; background: #529B6D; float: top; Padding: 5px 10px 10px 10px; text-align: center;">
			<text style="font-family: 'Calibri'; font-size: 40px; color: white;">Message Center</text><br>
			<text style="font-family: 'Calibri'; font-size: 20px; color: white;">Chat with <b>
				<?php //NAME GOES HERE 
					print 'NAME HERE'; 
				?>
				</b></text><br>
		</div>
		
		<div  style="width: 680px; height: 400px; background: #AAA; float: top; Padding: 10px 10px 10px 10px; text-align: center; ">
			<div id="treads" style="display: block; width: 200px; height: 400px; background: #CCC; float: left;  overflow: auto;">
			</div>
			<div id="messages" style="display: block; width: 480px; height: 400px; background: #BBB; float: left; overflow: auto;">
			</div>
		</div>
		
		<div  style="width: 680px; height: 80px; background: #666666; float: top; Padding: 10px 10px 10px 10px; text-align: center;">
			<form method="post" name="form">
				<input type='textbox' name="message_text" id="message_text" placeholder='Type message here...' style='float: left; height: 80px; width: 500px; border: 0px; border-radius: 5px; padding: 0px 20px 0px 20px; font-size: 20px;'/>
				<div >
					<input type="submit" value="Send" class="submit" style="color: white; font-size: 20px; float:left; width: 130px; height: 80px; margin-left: 10px; background: #4F81B3; border: 3px solid #385C81; border-radius: 5px;"/>
					<span class="error" style="display:none"> Type Something!</span>
					<span class="success" style="display:none"> Message Sent!</span>
				</div>
			</form>
		</div>
	</div>
</html>