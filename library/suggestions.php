								
<?php
function suggestions($SEARCH)
{	

	
	$counter = 0;
	$suggestions = array();
	$soundex = soundex($SEARCH);
	


	$DATA = mysql_query( "SELECT DISTINCT `SERIES_NAME` FROM librorum_items.series_relation" ) or die(mysql_error()); 
	while($ROW = mysql_fetch_array($DATA)) 
	{ 
		$ELEMENT  = $ROW['SERIES_NAME'];
		similar_text ($SEARCH, $ELEMENT, $percent);	
		if($soundex == soundex($ELEMENT))
		{
			soundex($ELEMENT);
			$suggestions[$counter] = $ELEMENT;
			$counter++;
		}
		if(ceil($percent) >= 50)
		{
			 $percent;
			 $suggestions[$counter] = $ELEMENT;
			 $counter++;
		}
	}

	$DATA = mysql_query( "SELECT DISTINCT `AUTHOR/ARTISTS` FROM librorum_items.items_original" ) or die(mysql_error()); 
	while($ROW = mysql_fetch_array($DATA)) 
	{ 
		$ELEMENT  = $ROW['AUTHOR/ARTISTS'];
		similar_text ($SEARCH, $ELEMENT, $percent);	
		if($soundex == soundex($ELEMENT))
		{
			soundex($ELEMENT);
			$suggestions[$counter] = $ELEMENT;
			$counter++;
		}
		if(ceil($percent) >= 50)
		{
			 $percent;
			 $suggestions[$counter] = $ELEMENT;
			 $counter++;
		}
	}

	$item = fetch_items("default", " GROUP BY librorum_items.items_original.`INFO_ID`");
	foreach($item as $element)
	{	
		$ELEMENT  = $element['TITLE FULL'];
		similar_text ($SEARCH, $ELEMENT, $percent);	
		if($soundex == soundex($ELEMENT))
		{
			soundex($ELEMENT);
			$suggestions[$counter] = $ELEMENT;
			$counter++;
		}
		if(ceil($percent) >= 50)
		{
			 $percent;
			 $suggestions[$counter] = $ELEMENT;
			 $counter++;
		}
	}
	
	return array_unique($suggestions);

}

?>
