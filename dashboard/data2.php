<?PHP	ERROR_REPORTING(0);	?>
<?php 
			include '../includes/ServerConnect.php';
			// FILL THIS IN WITH THE USER ID / NAME
			$MY_ID = "1";
			
			$query = "SELECT * FROM messages WHERE FROM_ID='".$MY_ID."' or TO_ID='".$MY_ID."' GROUP BY CASE WHEN FROM_ID != '".$MY_ID."' THEN FROM_ID ELSE TO_ID END ORDER BY MESSAGE_ID ASC";
			
			$DATA = mysql_query($query);
			
			while($info = mysql_fetch_array( $DATA ))
			{
				
				$to = $info['TO_ID'];
				$from = $info['FROM_ID'];
				
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
				
				$query3 = "SELECT * FROM messages WHERE (TO_ID = '$from' AND FROM_ID = '$to') OR (TO_ID = '$to' AND FROM_ID = '$from') ORDER BY MESSAGE_ID DESC LIMIT 1;";
				$DATA3 = mysql_query($query3);
				while($info3 = mysql_fetch_array( $DATA3 ))
				{
					$message = $info3['MESSAGE'];
				}
			
				if($from == $MY_ID)
				{
					$print_name  = $to_name;
					$DP_LINK = $to_dp;
				}
				else
				{
				
					$print_name = $from_name;
					$DP_LINK = $from_dp;
				}
				
				
					Print 	"
						<div style='display: inline-block; margin: 0 auto; width: 90%; height: 40px; float: top; background: rgba(0,0,0,0.02); margin-top: 2px; margin-bottom: -1px; padding: 10px; '>
							<div style='display: block; width: 40px; height: 40px; float: left; background: black;'>
								<img src = '../images/users/$DP_LINK' style = 'width: 40px; height: 40px; border-radius: 2px;'>
							</div>
							
							<div style='display: block; text-align: left; margin-left: 10px; width: 145px; height: 40px; float: left;'>
						 
							<text style=\"font-family: 'Calibri'; font-size: 15px; color: #1AA0E2;\"><b>$print_name</b></text>	<br>	
							<text style=\"font-family: 'Calibri'; font-size: 15px; color: black;\">$message</text>
							</div>
						</div>
							";
				
			}
			
			?>