
	<?php
	
		
			
			
		error_reporting(0);
		
		include '../includes/ServerConnect.php';
		
		$index = 0;
		$array = array();
		$SEARCH = $_POST['mySEARCH'];
		$CAT = $_POST['myCat'];
	
	
		$DATA1 = mysql_query("
		
				SELECT `INFO_ID` 
				FROM librorum_items.items_original 
				INNER JOIN librorum.sub_categories ON librorum_items.items_original.ITEM_CATEGORY_ID = librorum.sub_categories.CATEGORY_ID
				WHERE `TITLE/PRODUCT` 
				LIKE '%".$SEARCH."%' 
				AND MAIN_CATEGORY_ID = ".$CAT."
				LIMIT 4;
				
				");
		while($INFO1 = mysql_fetch_array( $DATA1 )) 
		{ 	
			$array[$index++] = $INFO1['INFO_ID'];				
		}
		
		echo json_encode($array);
		
	?>