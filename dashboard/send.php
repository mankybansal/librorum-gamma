<?php
	
	//CONNECT SCRIPT FOR MySQL Database
	include '../includes/ServerConnect.php';

	if($_POST)
	{
		$message_text = $_POST['message_text'];
		$query = "INSERT INTO messages (FROM_ID, TO_ID, MESSAGE, DATE_TIME) VALUES ('1', '2', '$message_text', NOW());";
		mysql_query($query);
	}
	else
	{
		//DO NOTHING 
	}

?>