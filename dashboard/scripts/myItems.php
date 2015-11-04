<?php   SESSION_START();	?>
<?php   ERROR_REPORTING(0);	?>


<?php

	include '../../includes/ServerConnect.php';
	include '../../includes/ItemData.php';
	$ITEM_ID = $_POST['ITEM_ID'];
	$ACTION = $_POST['ACTION'];
	
	
	if($ACTION == 'fetch')
	{
		fetchData($ITEM_ID);
	}	
	else if($ACTION == 'remove')
	{
		removeData($ITEM_ID);
	}	
	else if($ACTION == 'load')
	{
		loadITEMS($_SESSION['MY_ID']);
	}

	
	
	function fetchData($ITEM_ID)
	{
			$array = fetch_items("special", "WHERE ITEM_ID = '".$ITEM_ID."'");
			
				function array_flatten($array) { 
				  if (!is_array($array)) { 
					return FALSE; 
				  } 
				  $result = array(); 
				  foreach ($array as $key => $value) { 
					if (is_array($value)) { 
					  $result = array_merge($result, array_flatten($value)); 
					} 
					else { 
					  $result[$key] = $value; 
					} 
				  } 
				  return $result; 
				} 
				
				$array = array_flatten($array);
				
			echo json_encode($array);
	}	
	
	function removeData($ITEM_ID)
	{
			$query = "SELECT * FROM items WHERE ITEM_ID = '$ITEM_ID' AND STATUS='BORROWED'";
			if(mysql_num_rows(mysql_query($query))>0)
			{
					echo "FAILED";			
			}else
			{
				$query = "DELETE FROM items WHERE ITEM_ID = '$ITEM_ID' ";
				mysql_query($query);
				echo "SUCCESS";
			}
	}	
	
	function loadITEMS($MY_ID)
	{
			$array = fetch_items("special", "WHERE OWNER_ID = '$MY_ID'");
			echo json_encode($array);
	}	
	
?>
	

