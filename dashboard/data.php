<?PHP	ERROR_REPORTING(0);	?>
<?php 

 
			include '../includes/ServerConnect.php';
				
			$MY_ID = "1";
			$OTHER_ID = "2";
				
			$query = "SELECT * FROM messages WHERE (FROM_ID='".$MY_ID."' AND TO_ID='".$OTHER_ID."') or (FROM_ID='".$OTHER_ID."' AND TO_ID='".$FROM_ID."1')";
			$DATA = mysql_query($query);
			
			while($info = mysql_fetch_array( $DATA ))
			{
				$message = $info['MESSAGE'];
				$to = $info['TO_ID'];
				$from = $info['FROM_ID'];
				$MESSAGE_ID = $info['MESSAGE_ID'];
				
				//MESSAGE FROM DETAILS
				$query1 = "SELECT * FROM users WHERE USER_ID='$to'";
				$DATA1 = mysql_query($query1);
				while($info1 = mysql_fetch_array( $DATA1 ))
				{
					$to_name = $info1['USER_NAME'];
					$to_dp = $info1['DP_LINK'];
				}
				
				//MESSAGE TO DETAILS
				$query2 = "SELECT * FROM users WHERE USER_ID='$from'";
				$DATA2 = mysql_query($query2);
				while($info2 = mysql_fetch_array( $DATA2 ))
				{
					$from_name = $info2['USER_NAME'];
					$from_dp = $info2['DP_LINK'];
				}				
				
				
				if($to==$MY_ID)
				{
					Print 	"
				
						
					<div style='display: inline-block; float: top; float: top; margin: 0 auto; margin-top: 5px;  width: 580px;  '>
							
							<div style='float: left; width: 40px; height: 40px; border-radius: 2px; overflow: hidden'>
								<img src = '../images/users/$from_dp' style = 'width: 100%; height: 100%; border-radius: 2px;'>
							</div>
							
							<div style='display: inline-block;  min-height: 50px; width: 480px; float: left; margin-left: 5px; margin-top: -3px;  padding: 0px 10px 5px 5px;  text-align: left; border-radius: 0px 3px 3px 0px;'>
								<text style=\" font-family: 'Calibri'; font-size: 17px; color: #1AA0E2;\">$from_name</text><br>
								<text style=\"word-wrap:break-word; font-family: 'Calibri'; font-size: 15px; color: black;\">$message</text>
							</div>
						
							
					</div>
							";
				}
				else
				{
					Print 	"
					<div style='display: inline-block; float: top; float: top; margin: 0 auto; margin-top: 5px;  width: 580px; '>
							
							<div style='float: left; width: 40px; height: 40px; border-radius: 2px; overflow: hidden'>
								<img src = '../images/users/$from_dp' style = 'width: 100%; height: 100%; border-radius: 2px;'>
							</div>
							
							<div style='display: inline-block; min-height: 50px; width: 480px; float: left; margin-left: 5px;  margin-top: -3px;  text-align: left; padding: 0px 10px 5px 5px; border-radius: 3px 0px 0px 3px;'>
							<text style=\" font-family: 'Calibri'; font-size: 17px; color: #1AA0E2;\">$from_name</text><br>
							<text style=\"word-wrap:break-word; font-family: 'Calibri'; font-size: 15px; color: black;\">$message</text>
							
							</div>
							
							
					</div>
							";
				}
			}

			?>