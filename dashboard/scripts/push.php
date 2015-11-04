<?php   SESSION_START();	?>
<?php  ERROR_REPORTING(0);	?>


<?php

	include '../../includes/ServerConnect.php';
	include '../../includes/ItemData.php';
	include '../../includes/SetTimezone.php';
	
	$ACTION = $_POST['ACTION'];
	$MY_ID = $_SESSION['MY_ID'];
    if($ACTION == 'notifications')
	{
		$array1 = myRequests($MY_ID);
		$array2 = myNotifications($MY_ID);
		$array3 = otherRequests($MY_ID);
		
		echo json_encode($array1 + $array2 + $array3);
	}
	elseif($ACTION == 'credits')
	{
		echo myCredits($MY_ID);
	}

	
	function myCredits($MY_ID)
	{
			
				$query = "SELECT * FROM credits WHERE USER_ID = $MY_ID";
								
				$data = mysql_query($query);
				while($row = mysql_fetch_array($data))
				{	
						$credits = $row['CREDITS'];
				}
			
				return $credits;
	}	
		
	
	function myRequests($MY_ID)
	{
			
				$query = "
								SELECT count(*)  as 'COUNT' FROM requests 
								WHERE requests.FROM_ID = $MY_ID;
								";
								
				$data = mysql_query($query);
				while($row = mysql_fetch_array($data))
				{	
						$count = $row['COUNT'];
				}
			
				return $count;
	}	
		
	function myNotifications($MY_ID)
	{
				
				$query = "
								SELECT count(*)  as 'COUNT' FROM notifications 
								WHERE notifications.TO_ID = $MY_ID;
								";
								
				$data = mysql_query($query);
				while($row = mysql_fetch_array($data))
				{	
						$count = $row['COUNT'];
				}
			
				return $count;
	}	
	
	function otherRequests($MY_ID)
	{
		
			$query = "
							SELECT count(*)  as 'COUNT' FROM requests 
							INNER JOIN items ON requests.ITEM_ID = items.ITEM_ID 
							INNER JOIN users ON  users.USER_ID = requests.FROM_ID
							WHERE items.OWNER_ID = $MY_ID;
							";
							
			$data = mysql_query($query);
			while($row = mysql_fetch_array($data))
			{	
					$count = $row['COUNT'];
			}
		
			return $count;
	}	
	
?>
	

