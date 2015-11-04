<?php

function check_messages()
{

	$MY_ID = $_SESSION['MY_ID'];
	$query = "SELECT * FROM users WHERE USER_ID = $MY_ID";
	$data = mysql_query($query);
	
	while($row = mysql_fetch_array($data))
	{
		$seen = $row['MESSAGE_VIEW'];
		
		if($seen == 'NO')
		{
				print "
						<script>
						$('#MESSAGE').fadeIn(500);
						</script>
						";
						
				//$query = "UPDATE users SET MESSAGE_VIEW = 'YES'  WHERE USER_ID = $MY_ID";
				//$data = mysql_query($query);
		}	
	}
	
}

?>