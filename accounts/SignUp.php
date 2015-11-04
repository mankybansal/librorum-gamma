<?php   SESSION_START();	?>
<?php	ERROR_REPORTING(0);	?>

<?php



if(isset($_SESSION['MY_EMAIL']))
{
	Print	"
			<script>
			   parent.location.href  = '../dashboard' ;
			</script>
			";
}
else
{
	$errors = array();
	
	$index=0;
	
	if($_POST['FIRST-NAME']=="")
	{
		$errors[$index] = "1";
		$index++;
	}	
	
	if($_POST['LAST-NAME']=="")
	{
		$errors[$index] = "2";
		$index++;
	}	
	
	if($_POST['EMAIL']=="" || !filter_var($_POST['EMAIL'], FILTER_VALIDATE_EMAIL))
	{
		$errors[$index] = "3";
		$index++;
	}	
	
	if($_POST['PHONE-NUMBER']=="" || strlen($_POST['PHONE-NUMBER'])<10)
	{
		$errors[$index] = "4";
		$index++;
	}
	
	if($_POST['CITY']=="")
	{
		$errors[$index] = "5";
		$index++;
	}	
	
	if($_POST['LOCATION']=="")
	{
		$errors[$index] = "6";
		$index++;
	}

	if(empty($errors))
	{
		include '../includes/ServerConnect.php';
		$check = "SELECT * FROM users WHERE EMAIL='".$_POST['EMAIL']."' OR PHONE_NUMBER='".$_POST['PHONE-NUMBER']."'";
		$result = mysql_query($check);
		$count = mysql_num_rows($result);
		
		if($count==0)
		{
			$FIRST_NAME = stripslashes($_POST['FIRST-NAME']);
			$LAST_NAME = stripslashes($_POST['LAST-NAME']);
			$EMAIL = stripslashes($_POST['EMAIL']);
			$PHONE_NUMBER = $_POST['PHONE-NUMBER'];
			$CITY = stripslashes($_POST['CITY']);
			$LOCATION = stripslashes($_POST['LOCATION']);
			
			$CHARS = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
					
			function encryptIt($input) {
				$cryptKey  = $input;
				$qEncoded  = base64_encode(mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5($cryptKey), $input, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
				return( $qEncoded );
			}
			
			$PASS_CHARS = substr(str_shuffle($CHARS),0,8);
			
			$PASSWORD = encryptIt($PASS_CHARS);
	
			$query = "INSERT INTO users (USER_NAME, PASSWORD, EMAIL, PHONE_NUMBER) VALUES ('$FIRST_NAME $LAST_NAME', '$PASSWORD', '$EMAIL', '$PHONE_NUMBER')";
			mysql_query( $query ) or die(mysql_error()); 
						
			$query1 = "SELECT * FROM users WHERE EMAIL = '$EMAIL'";
			$result1 = mysql_query( $query1 ) or die(mysql_error()); 
			while($row1 = mysql_fetch_array($result1))
			{
				$USER_ID = $row1['USER_ID'];
			}
						
			$query = "INSERT INTO credits (USER_ID) VALUES ($USER_ID)";
			mysql_query( $query ) or die(mysql_error()); 
						
			$query = "INSERT INTO user_settings (USER_ID) VALUES ($USER_ID)";
			mysql_query( $query ) or die(mysql_error()); 			
			
			$query2 = "SELECT * FROM groups WHERE GROUP_NAME = '$LOCATION'";
			$result2 = mysql_query( $query2 ) or die(mysql_error()); 
			while($row2 = mysql_fetch_array($result2))
			{
				$GROUP_ID = $row2['GROUP_ID'];
			}
			
			$query3 = "INSERT INTO user_group_relation (USER_ID, GROUP_ID) VALUES('$USER_ID', '$GROUP_ID')";
			mysql_query( $query3 ) or die(mysql_error()); 
			
			
			include '../includes/mailerMandrill.php';
				
			$mailBody1 =	"
							Hi <strong>".$FIRST_NAME." ".$LAST_NAME."</strong>,<br><br>
							Thank you for signing up! 
							We take this opportunity to welcome you to librorum and we hope you have a pleasurable experience with us. Add items to enrich your community library and help make librorum bigger.<br><br>
							Your account details are given below:<br><br>
							<strong>&nbsp;&nbsp;&nbsp;&nbsp;Email:</strong> <text style='text-decoration: none;'>".$EMAIL."</text><br>
							<strong>&nbsp;&nbsp;&nbsp;&nbsp;Password:</strong> ".$PASS_CHARS."<br><br>
							You can login to <b><a href='www.librorum.in/accounts/login.php' style='text-decoration: none;'>www.librorum.in/accounts/login.php</a></b> using the credentials given above. Please do read our policies & terms on our page. 
							Feel free to contact us by replying to this mail if you have any queries or thoughts and we will get back to you as soon as possible. Happy sharing!							
							";
							
			$mailBody2 =	"
							Hi <strong>Admin</strong>,<br><br>
							We have one new user! 
							A new user has signed up, this mail is an account verification message.<br><br>
							The account details are given below:<br><br>
							<strong>&nbsp;&nbsp;&nbsp;&nbsp;Email:</strong> <text style='text-decoration: none;'>".$EMAIL."</text><br>
							<strong>&nbsp;&nbsp;&nbsp;&nbsp;Password:</strong> ".$PASSWORD."<br><br>
							Please make sure this account is verified soon.						
							";
			
			$userMAIL = standardMailer('mailerNew', $mailBody1);
			sendMail($userMAIL, 'Please Verify Your Librorum Account', 'accounts', $EMAIL, $FIRST_NAME." ".$LAST_NAME);
					
			$adminMAIL  = standardMailer('mailerNew', $mailBody2);
			sendMail($adminMAIL, 'New Account', 'users', 'admin@librorum.in', 'Admin');
			
			echo json_encode("VALID");
		}
		else
		{
			echo json_encode("EXISTS");
		}
		
	}else
	{
		echo json_encode($errors);
	}
	
}
?>