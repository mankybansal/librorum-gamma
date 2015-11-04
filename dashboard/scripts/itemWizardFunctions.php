<?php

ERROR_REPORTING(0);
include '../../includes/ServerConnect.php';
include '../../includes/ItemData.php';

		
$ACTION = "";

if(isset($_POST['ACTION']))
{
	$ACTION = $_POST['ACTION'];
}

if(isset($_POST['CAT']))
{
	$CAT = $_POST['CAT'];
}

if(isset($_POST['SEARCH']))
{
	$SEARCH = $_POST['SEARCH'];
}

if(isset($_POST['CATEGORY_ID']))
{
	$CATEGORY_ID = $_POST['CATEGORY_ID'];
}

if(isset($_POST['INFO_ID']))
{
	$INFO_ID = $_POST['INFO_ID'];
}

if($ACTION == "fetchCategories")
{
	fetchTheCategories($CATEGORY_ID);
}else if($ACTION == "fetchSuggestion")
{
	fetchSuggestion($INFO_ID);
}
else if($ACTION == "suggestionArray")
{
	suggestionArray($SEARCH,$CAT);
}

function fetchSuggestion($INFO_ID)
{
	$array = fetch_items('suggestions', " WHERE `INFO_ID` = ".$INFO_ID." LIMIT 5");
	echo json_encode($array);
}


function fetchTheCategories($CATEGORY_ID)
{
	$ARRAY = array();
	$INDEX = 0;
	
	$QUERY = "SELECT * FROM  sub_categories WHERE MAIN_CATEGORY_ID='".$CATEGORY_ID."'";
	$RESULT = mysql_query($QUERY);
		
	while($ROW = mysql_fetch_array($RESULT))
	{
		$ARRAY[$INDEX++] = array(	
									'CATEGORY ID'  => $ROW['CATEGORY_ID'], 
									'SUB CATEGORY' => $ROW['SUB_CATEGORY']
								);
	}
	echo json_encode($ARRAY);			
}

function suggestionArray($SEARCH, $CAT)
{		
	$counter = 0;
	$suggestions = array();
	$soundex = soundex($SEARCH);

	$DATA1 = mysql_query("
				SELECT `INFO_ID` 
				FROM librorum_items.items_original 
				INNER JOIN librorum.sub_categories ON librorum_items.items_original.ITEM_CATEGORY_ID = librorum.sub_categories.CATEGORY_ID
				WHERE `TITLE/PRODUCT` 
				LIKE '%".$SEARCH."%' 
				AND MAIN_CATEGORY_ID = ".$CAT."
				LIMIT 6;
			 ");
	while($INFO1 = mysql_fetch_array( $DATA1 )) 
	{ 	
		$suggestions[$counter] = $INFO1['INFO_ID'];	
		$counter++;		
	}

	$item = fetch_items("default", " WHERE MAIN_CATEGORY_ID = ".$CAT." GROUP BY librorum_items.items_original.`INFO_ID`");
	foreach($item as $element)
	{	
		$ELEMENT  = $element['TITLE FULL'];
		
		similar_text($SEARCH, $ELEMENT, $percent);
	
		if(ceil($percent) >= 60)
		{
			 $percent;
			 $suggestions[$counter] = $element['INFO ID'];;
			 $counter++;
		}
	}
	$suggestions = array_slice($suggestions, 0, 6);
	echo json_encode(array_unique($suggestions));
}

?>