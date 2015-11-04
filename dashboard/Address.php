<?php   SESSION_START();	?>
<?php	ERROR_REPORTING(0);	?>

<?php

	$MY_EMAIL = $_SESSION['MY_EMAIL'];	
	
	if($_POST['address']=="")
	{
		echo "false";
	}
	else
	{
		include '../includes/ServerConnect.php';
		$query = "UPDATE users SET ADDRESS = '".$_POST['address']."', ACCOUNT_STATUS = 'CWA' WHERE EMAIL = '$MY_EMAIL'";
		mysql_query( $query) or die(mysql_error()); 
		echo json_encode("VALID");
	
	}
	
?>
