<?php

	ERROR_REPORTING(0);

	if(isset($_GET['TID']) && $_GET['TID'] != "" )
	{
		
		// Include server data
		include '../includes/ServerConnect.php';
				
		// Connect to Database
		$link = mysql_connect("$host", "$username", "$password", "$db_name");
		mysql_select_db("$db_name") or die(mysql_error()); 

		// Define $TID 
		$TID= $_GET['TID']; 
		
		// To protect MySQL INJECTION
		$TID = stripslashes($TID);
		$TID = mysql_real_escape_string($TID);
		
		$query="SELECT * FROM qr_process WHERE TID='$TID'";
		$result = mysql_query($query);
				
		// Mysql_num_row is counting table row
		$count = mysql_num_rows($result);

		// If result matched $MYUSERNAME and $MYPASSWORD, table row must be 1 row
		if($count==1)
		{
			while($row = mysql_fetch_array($result)) 
			{
				$QR_ID = $row['QR_ID'];
				$TID = $row['TID'];
				$QR_TYPE = $row['QR_TYPE'];
				$REQUEST_ID = $row['REQUEST_ID'];
			}
			
			if($QR_TYPE == "LOGIN")
			{
				$query="SELECT * FROM users WHERE USER_ID='$REQUEST_ID'";
				$result = mysql_query($query);
				while($arrayData = mysql_fetch_array($result)) 
				{
					$MY_EMAIL = $arrayData['EMAIL'];
					$MY_ID = $arrayData['USER_ID'];
					$MY_NAME = $arrayData['USER_NAME'];
				}			
				$array = array(
								'QRStatus' => '1',
								'QRID' => $QR_ID,
								'TID' => $TID,
								'QRType' => $QR_TYPE,
								'UserName' => $MY_NAME,
								'UserID' => $MY_ID,
								'UserEMAIL' => $MY_EMAIL
							);
				mysql_close($link);
				echo json_encode($array);
			}

		}			
		else
		{
			//RESULT CODE 2: INVALID TID
			$array = array(
								'QRStatus' => '2'
							);
			mysql_close($link);
			echo json_encode($array);			
		}

	}else
	{
		//RESULT CODE 3: EMPTY TID
		$array = array(
							'QRStatus' => '3'
						);
		mysql_close($link);
		echo json_encode($array);
	}


?>