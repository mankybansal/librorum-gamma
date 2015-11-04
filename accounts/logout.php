<?php 

	ERROR_REPORTING(0);

	SESSION_START();

	// Include server data
	include '../includes/ServerConnect.php';
			
	// Connect to Database
	$link = mysql_connect("$host", "$username", "$password", "$db_name");
	mysql_select_db("$db_name") or die(mysql_error()); 

	// Retrieve Session data
	$MY_SESSION_ID = $_SESSION['MY_SESSION_ID'];

	// Delete SESSION Data from DATABASE
	$query = "DELETE FROM sessions WHERE SESSION_ID = '$MY_SESSION_ID' ";
	mysql_query($query);	

	SESSION_UNSET();
	
	SESSION_DESTROY();
	
	mysql_close($link);	
	echo "1";
	
?>
