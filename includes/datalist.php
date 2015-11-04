
	<?php
	
		
			
			
		error_reporting(0);
		
		include '../includes/ServerConnect.php';
		
		$index = 0;
		$array = array();
		$SEARCH = $_POST['mySEARCH'];
	
		$DATA1 = mysql_query( "SELECT DISTINCT `SERIES_NAME` FROM librorum_items.series_relation WHERE `SERIES_NAME` LIKE '%".$SEARCH."%' LIMIT 3" ) or die(mysql_error()); 
		while($INFO1 = mysql_fetch_array( $DATA1 )) 
		{ 
			$array[$index++] = $INFO1['SERIES_NAME'];
		}

		$DATA1 = mysql_query("SELECT `TITLE/PRODUCT` FROM librorum_items.items_original WHERE `TITLE/PRODUCT` LIKE '%".$SEARCH."%' LIMIT 9");
		
		while($INFO1 = mysql_fetch_array( $DATA1 )) 
		{ 	
			$array[$index++] = $INFO1['TITLE/PRODUCT'];				
		}
	
		$DATA2 = mysql_query( "SELECT DISTINCT `AUTHOR/ARTISTS` FROM librorum_items.items_original  WHERE `AUTHOR/ARTISTS` LIKE '%".$SEARCH."%' LIMIT 3" ) or die(mysql_error()); 
		while($INFO2 = mysql_fetch_array( $DATA2 )) 
		{ 
			$array[$index++] = $INFO2['AUTHOR/ARTISTS'];
		}
		
		echo json_encode($array);
		
	?>