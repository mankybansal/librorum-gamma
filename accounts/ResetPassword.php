<?php

SESSION_START();
ERROR_REPORTING(0);

if(isset($_SESSION['MY_EMAIL']))
{
	Print	"
			<script>
			   parent.location.href  = '../dashboard' ;
			</script>
			";
}
else
{
	if($_POST['MYEMAIL']!="")
	{
		// Include server data
		include '../includes/ServerConnect.php';
			
		//INCLUDE MANDRILL
		include '../includes/mailerMandrill.php';
							
		// Connect to Database
		$link = mysql_connect("$host", "$username", "$password", "$db_name");
		mysql_select_db("$db_name") or die(mysql_error()); 

		// Define $MYUSERNAME and $MYPASSWORD 
		$MYUSERNAME = $_POST['MYEMAIL']; 
	

		// To protect MySQL INJECTION
		$MYUSERNAME = stripslashes($MYUSERNAME);
		$MYUSERNAME = mysql_real_escape_string($MYUSERNAME);
		
		$query="SELECT * FROM users WHERE EMAIL='$MYUSERNAME'";
		$result = mysql_query($query);
				
		// Mysql_num_row is counting table row
		$count = mysql_num_rows($result);

		// If result matched $MYUSERNAME
		if($count==1)
		{
			
			while($row = mysql_fetch_array($result)) 
			{
				$MY_EMAIL = $row['EMAIL'];
				$MY_NAME = $row['USER_NAME'];
				$MY_ID = $row['USER_ID'];
			}
			
					
			function encryptIt($input) {
				$cryptKey  = $input;
				$qEncoded  = base64_encode(mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5($cryptKey), $input, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
				return( $qEncoded );
			}
			
			
			$CHARS = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$PASS_KEY = substr(str_shuffle($CHARS),0,8);
			
			$NEW_PASSWORD = encryptIt($PASS_KEY);
			
			$QUERY = "UPDATE users SET PASSWORD='".$NEW_PASSWORD."' WHERE USER_ID=".$MY_ID;
			mysql_query($QUERY);
						
			//SEND USER PASSWORD RESET EMAIL
			$mailBody = "
						Hi <strong>".$MY_NAME."</strong>,<br><br>
						You have requested to change your password. Below, you'll find your new password.<br><br>
						<b>New Password</b>: ".$PASS_KEY."<br><br>
						You can use this password to sign-in Librorum. Please go to your account settings and change your password to something you'll remember once you've logged in.
						";
			$constructedMail = standardMailer('mailer4', $mailBody);
			sendMail($constructedMail, 'Password Reset', 'accounts', $MY_EMAIL, $MY_NAME);	
			
			//RESULT CODE 1: AUTHENTICATED
			mysql_close($link);
			echo "1";			
		}	
		else 
		{
			echo "2";
		}
	}else
	{
		if($MYUSERNAME=="")
		{
			//RESULT CODE 3: USERNAME EMPTY
			echo "3";
		}

	}
}
?>