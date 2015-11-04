<?php   SESSION_START();	?>
<?php	ERROR_REPORTING(0);	?>

<?php



	function encryptIt($input) {
		$cryptKey  = $input;
		$qEncoded  = base64_encode(mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5($cryptKey), $input, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
		return( $qEncoded );
	}

	$MY_ID = $_SESSION['MY_ID'];	
	
	$errors = array();
	
	$index=0;
	
	if($_POST['Password']=="" || $_POST['ConfirmPassword']=="")
	{
		$errors[$index] = "1";
		$index++;
	}
	elseif(strlen($_POST['Password'])<8 || strlen($_POST['ConfirmPassword'])<8)
	{
		$errors[$index] = "3";
		$index++;
	}
	if($_POST['Password'] != $_POST['ConfirmPassword'])
	{
		$errors[$index] = "2";
		$index++;
	}
	

	if(empty($errors))
	{
		include '../includes/ServerConnect.php';
		$query = "UPDATE users SET PASSWORD = '".encryptIt($_POST['Password'])."' WHERE USER_ID = ".$MY_ID;
		mysql_query( $query) or die(mysql_error()); 
		echo json_encode("VALID");
	
	}else
	{
		echo json_encode($errors);
	}
	
?>