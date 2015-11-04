
<?php

SESSION_START();

$output_dir = "../images/users/";

	include '../includes/ServerConnect.php';

if(isset($_FILES["myfile"]))
{
	//Filter the file types , if you want.
	if ($_FILES["myfile"]["error"] > 0)
	{
	  echo "Error: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
			$CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$NAME = substr(str_shuffle($CHARS),0,8);
			
			
			$temp = explode(".",$_FILES["myfile"]["name"]);
			$newfilename = $NAME . '.' .end($temp);
			move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $newfilename);
			
						
			$query4 = "UPDATE users SET DP_LINK = '$newfilename' WHERE EMAIL = '".$_SESSION['MY_EMAIL']."'";
			mysql_query( $query4 ) or die(mysql_error()); 

	 $_SESSION['MY_DP'] = $newfilename;
   	 echo $newfilename;
	}

}
?>