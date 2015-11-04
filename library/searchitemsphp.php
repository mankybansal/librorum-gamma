<?php

include '../includes/ServerConnect.php';

$MY_ID = "1";


function get_user_groups()
{
	global $MY_ID;	
	
	$query = "SELECT * FROM user_group_relation WHERE USER_ID = '$MY_ID'";
	$result = mysql_query($query);
	
	$index = 0;
	while($row = mysql_fetch_array($result)) 
	{
		$array[$index] = $row['GROUP_ID'];
		$index++;
	}
	
	return $array;
}

function get_users_from_same_groups()
{
	global $MY_ID;	
	$array1 = array();
	
	$MY_GROUPS = get_user_groups();
	
	foreach($MY_GROUPS as &$GROUP_ID)
	{
		$query = "SELECT * FROM user_group_relation WHERE GROUP_ID = '$GROUP_ID'";		
		$result = mysql_query($query);
		$array3 = array();
		while($row = mysql_fetch_array($result))
		{
			array_push($array3, $row['USER_ID']);
		}
		$array2[$GROUP_ID] = $array3;		
	}
	
	//CONVERTS MUTLTIDIMENSIONAL ARRAY TO SINGLE
	foreach($array2 as $element) 
	{
		$array1 = array_merge($array1, $element);
	}

	//RETURNS UNIQUE VALUES FROM ARRAY (RETURNS USER IDS ONLY ONCE)
	return array_unique($array1, SORT_NUMERIC);
}

//GET ITEMs FROM SAME GROUPS
function get_items_from_groups()
{
	$array1 = array();
	
	$USERS = get_users_from_same_groups();
	
	foreach($USERS as &$USER_ID)
	{
		$query = "SELECT * FROM items WHERE OWNER_ID = '$USER_ID'";		
		$result = mysql_query($query);
		$array3 = array();
		while($row = mysql_fetch_array($result))
		{
			array_push($array3, $row['ITEM_ID']);
		}
		$array2[$USER_ID] = $array3;		
	}
	
	//CONVERTS MUTLTIDIMENSIONAL ARRAY TO SINGLE
	foreach($array2 as $element) 
	{
		$array1 = array_merge($array1, $element);
	}
	
	return $array1;
}



var_dump(get_items_from_groups());




?>

