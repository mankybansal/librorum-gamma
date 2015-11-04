<?php

SESSION_START();

//THE $REDIRECT_PATH VARIABLE IS DEFINED ON THE PAGE IT IS BEING USED

//$LOGIN_PAGE_SET VARIABLE INDICATES IF THE USER IS ON THE LOGIN PAGE

//$MY_PAGE_SET VARIABLE INDICATES THAT THE SCRIPT MUST REDIRECT TO THE CURRENT PAGE

if(isset($_SESSION['MY_ID']))
{
	
	//CHECK IF SESSION STILL EXISTS
	// Include ServerConnect
	include '../includes/ServerConnect.php';

	$link = mysql_connect("$host", "$username", "$password", "$db_name");
	mysql_select_db("$db_name") or die(mysql_error()); 	

	$query = "SELECT * FROM sessions WHERE SESSION_ID = '".$_SESSION['MY_SESSION_ID']."'";
	$result = mysql_query($query);
	$count = mysql_num_rows($result);

	if($count == 0)
	{
		SESSION_UNSET();
		SESSION_DESTROY();
		mysql_close($link);	
		
		Print	"
				<script>
				   parent.location.href  = '../accounts/login.php?SESSION=DEAD';
				</script>
				";	
		exit();
	}
	
	if(isset($MY_PAGE_SET) && $MY_PAGE_SET == TRUE)
	{
		//DO NOTHING (WILL LOAD CURRENT PAGE)
		if($_SESSION['MY_STATUS'] == "CWA" && isset($LOGIN_REQUIRED) && $LOGIN_REQUIRED == TRUE && isset($DASHBOARD)==FALSE)
		{
			Print	"
						<script>
						   parent.location.href  = '../dashboard/';
						</script>
						";	
			exit();
		}
	}
	else
	{
		Print	"
				<script>
				   parent.location.href  = '$REDIRECT_PATH';
				</script>
				";
		exit();
	}
}
else
{
	if(isset($LOGIN_PAGE_SET) && $LOGIN_PAGE_SET == TRUE)
	{
		//DO NOTHING (WILL LOAD LOGIN PAGE)
	}
	else
	{
		if(isset($LOGIN_REQUIRED) && $LOGIN_REQUIRED == TRUE)
		{
			//REDIRECT TO THE LOGIN PAGE
			Print	"
				<script>
				   parent.location.href  = '../accounts/login.php?LOGIN=FALSE';
				</script>
				";	
			exit();
		}
		else
		{
			//DO NOTHING (WILL LOAD CURRENT PAGE)
		}
	}
}

?>