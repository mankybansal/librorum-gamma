<?php   SESSION_START();	?>
<?php	ERROR_REPORTING(0);	?>

<?php


	function encryptIt($input) {
		$cryptKey  = $input;
		$qEncoded  = base64_encode(mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5($cryptKey), $input, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
		return( $qEncoded );
	}

	$MY_EMAIL = $_SESSION['MY_EMAIL'];	
	
	$errors = array();
	
	$index=0;
	
	if($_POST['Password']=="" || $_POST['ConfirmPassword']=="")
	{
		$errors[$index] = "1";
		$index++;
	}
	elseif(strlen($_POST['Password'])<8 || strlen($_POST['ConfirmPassword'])<8)
	{
		$errors[$index] = "5";
		$index++;
	}
	
	if($_POST['Password'] != $_POST['ConfirmPassword'])
	{
		$errors[$index] = "2";
		$index++;
	}
	
	if($_POST['Day']=="" || $_POST['Month']=="" || $_POST['Year']=="" )
	{
		$errors[$index] = "3";
		$index++;
	}
	elseif(checkdate($_POST['Month'],$_POST['Day'],$_POST['Year'])==false || $_POST['Year']>2014 || $_POST['Year']<1900)
	{
		$errors[$index] = "4";
		$index++;
	}	
	

		
	if(empty($errors))
	{
		include '../includes/ServerConnect.php';
		$query = "UPDATE users SET DOB = '".$_POST['Year']."-".$_POST['Month']."-".$_POST['Day']."', PASSWORD = '".encryptIt($_POST['Password'])."', ACCOUNT_STATUS = 'NO-ADDRESS' WHERE EMAIL = '$MY_EMAIL'";
		mysql_query( $query) or die(mysql_error()); 
		echo json_encode("VALID");
	
	}else
	{
		echo json_encode($errors);
	}
	
?>