<?php   SESSION_START();	?>
<?php  ERROR_REPORTING(0);	?>


<?php

	include '../../includes/ServerConnect.php';

	$USER_ID = $_POST['REQUEST_ID'];
			
	$array = array();
	$index = 0;
	$query = "
					SELECT * FROM users WHERE USER_ID = $USER_ID LIMIT 1;
					";
					
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
	
