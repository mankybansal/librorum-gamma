<?php

	function userData($USER_ID)
	{
		$QUERY = "SELECT * FROM users WHERE USER_ID = $USER_ID";
		$RESULT = mysql_query($QUERY);
		
		while($ROW = mysql_fetch_array($RESULT))
		{
			$USER_NAME = $ROW['USER_NAME'];
			$USER_EMAIL = $ROW['USER_EMAIL'];
			$USER_DP = $ROW['DP_LINK'];
		}	
	}

?>
?>