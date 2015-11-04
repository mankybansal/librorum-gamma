<?php   SESSION_START();	?>
<?php   ERROR_REPORTING(0);	?>


<?php

	include '../../includes/ServerConnect.php';

	$USER_ID = $_POST['REQUEST_ID'];
			
	$array = array();
	$index = 0;
	$query =   "SELECT admin_group_relation.ADMIN_ID from users 
				INNER JOIN user_group_relation ON users.USER_ID = user_group_relation.USER_ID
				INNER JOIN admin_group_relation ON admin_group_relation.GROUP_ID = user_group_relation.GROUP_ID
				WHERE users.USER_ID = $USER_ID
				LIMIT 1";
				
	$data = mysql_query($query);
	while($row = mysql_fetch_array($data))
	{
		$ADMIN_ID = $row['ADMIN_ID'];
	}	
		
	$query = "SELECT * FROM users WHERE USER_ID = $ADMIN_ID LIMIT 1;";
						
	$data = mysql_query($query);
	while($row = mysql_fetch_array($data))
	{	
		$array[$index] =  array(
								"NAME"		=> $row['USER_NAME'],
								"EMAIL"		=> $row['EMAIL'],
								"PHONE"		=> $row['PHONE_NUMBER'],
								"ADDRESS"	=> $row['ADDRESS'],
								"DP_LINK"	=> $row['DP_LINK'],
								);
		$index++;
	}

	echo json_encode($array);
	
?>
	
