<?php   SESSION_START();	?>
<?php  ERROR_REPORTING(0);	?>


<?php

	include '../../includes/ServerConnect.php';
	include '../../includes/ItemData.php';
	include '../../includes/SetTimezone.php';
	//INCLUDE MANDRILL
	include '../../includes/mailerMandrill.php';
	
	$ACTION = $_POST['ACTION'];
	$USER_ID = $_POST['USER_ID'];
	
    if($ACTION == 'confirm')
	{
		confirmUser($USER_ID);
	} 
	else if($ACTION == 'deny')
	{
		denyUser($USER_ID);
	}
	
	function confirmUser($USER_ID)
	{
			
		$query = "UPDATE users SET ACCOUNT_STATUS = 'CONFIRMED' WHERE USER_ID = $USER_ID";
		mysql_query($query);
		
		$query = "SELECT * FROM sessions WHERE USER_ID = $USER_ID";
		if(mysql_num_rows(mysql_query($query))>0)
		{
			$query = "DELETE FROM sessions WHERE USER_ID = $USER_ID";
			mysql_query($query);			
		}
			
		$query = "SELECT * FROM users WHERE USER_ID=".$USER_ID;
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)) 
		{
			$MY_EMAIL = $row['EMAIL'];
			$MY_NAME = $row['USER_NAME'];
		}
						
		$mailBody = "
					Hi <strong>".$MY_NAME."</strong>,<br><br>
					Congratulations! Your account has been confirmed and you can now start lending and borrowing on the site!<br><br>
					You can always contact your community administrator or contact us if you have any questions!
					";
		$constructedMail = standardMailer('mailerNew', $mailBody);
		sendMail($constructedMail, 'Your Account Has Been Verified', 'accounts', $MY_EMAIL, $MY_NAME);	
			
		echo "1";
	}	
	
	function denyUser($USER_ID)
	{
			
		$query2 = "UPDATE users SET ACCOUNT_STATUS = 'DENIED' WHERE USER_ID = $USER_ID";
		mysql_query($query2);
		
		echo "1";
	}	
	

?>
	

