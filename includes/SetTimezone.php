<?php

$query = "	SELECT TIMEZONE FROM users
					INNER JOIN user_group_relation ON user_group_relation.USER_ID = users.USER_ID
					INNER JOIN groups ON user_group_relation.GROUP_ID = groups.GROUP_ID
					WHERE users.USER_ID = ".$_SESSION['MY_ID']."
					LIMIT 1
				";

$data = mysql_query($query);
while($rows = mysql_fetch_array($data))
{
	$timezone = $rows['TIMEZONE'];
}				

date_default_timezone_set($timezone);

?>