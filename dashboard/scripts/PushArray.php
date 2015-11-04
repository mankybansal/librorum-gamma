<?php  SESSION_START();	?>
<?php  ERROR_REPORTING(0);	?>


<?php

	include '../../includes/ServerConnect.php';
	include '../../includes/ItemData.php';
	
	$ACTION = $_POST['ACTION'];
	$MY_ID = $_SESSION['MY_ID'];
    if($ACTION == 'GetNotificationID')
	{
		$array1 = myRequests($MY_ID);
		$array2 = myNotifications($MY_ID);
		$array3 = otherRequests($MY_ID);
		
		$index = 0;
		$array = array();
		
		foreach($array1 as $element)
		{
			$array[$index] = $element;
			$index++;
		}
		
		foreach($array2 as $element)
		{
			$array[$index] = $element;
			$index++;
		}
		
		foreach($array3 as $element)
		{
			$array[$index] = $element;
			$index++;
		}
		
		echo json_encode($array);
	}

	
	function myRequests($MY_ID)
	{			
				$array = array();
				$index = 0;
				$query = "SELECT * FROM requests WHERE requests.FROM_ID = $MY_ID;";
								
				$data = mysql_query($query);
				while($row = mysql_fetch_array($data))
				{	
						$array[$index] = 'R-'.$row['REQUEST_ID'].'-M';
						$index++;
				}
				
				return $array;
	}	
		
	
	function myNotifications($MY_ID)
	{			
				$array = array();
				$index = 0;
				$query = "SELECT * FROM notifications WHERE notifications.TO_ID = $MY_ID";
								
				$data = mysql_query($query);
				while($row = mysql_fetch_array($data))
				{	
						$array[$index] = 'N-'.$row['NOTIFICATION_ID'].'-M';
						$index++;
				}
				
				return $array;
	}	
			
	
	function otherRequests($MY_ID)
	{			
				$array = array();
				$index = 0;
				$query =	"
								SELECT * FROM requests 
								INNER JOIN items ON requests.ITEM_ID = items.ITEM_ID 
								INNER JOIN users ON  users.USER_ID = requests.FROM_ID
								WHERE items.OWNER_ID = $MY_ID;
								";
								
				$data = mysql_query($query);
				while($row = mysql_fetch_array($data))
				{	
						$array[$index] = 'R-'.$row['REQUEST_ID'].'-O';
						$index++;
				}
				
				return $array;
	}	
	
?>
	

