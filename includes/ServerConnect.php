<?php

	$whitelist = array( '127.0.0.1', '::1' );
	
	if(in_array( $_SERVER['REMOTE_ADDR'], $whitelist) )
	{
		$host="localhost"; // Host name 
		$username="root"; // Mysql username 
		$password=""; // Mysql password 
		$db_name="librorum"; // Database name 
	}else
	{
		$host="128.199.92.34"; // Host name 
		$username="mayank"; // Mysql username 
		$password="sxNZw7nMcZy7FCmd"; // Mysql password 
		$db_name="librorum"; // Database name 
	}
	
	$link = mysql_connect("$host", "$username", "$password", "$db_name");
	mysql_select_db("$db_name") or die(mysql_error());
	mysql_set_charset('utf8', $link);

?>
