<?php   SESSION_START();	?>
<?php   ERROR_REPORTING(0);	?>


<?php

	$MY_EMAIL = $_SESSION['MY_EMAIL'];	
	$MY_ID = $_SESSION['MY_ID'];	
	
	$TITLE = $_POST['TITLE'];
	$AUTHOR = $_POST['AUTHOR'];
	$CATEGORY = $_POST['CATEGORY'];
	$PUBLISHER = $_POST['PUBLISHER'];
	$PLATFORM = $_POST['PLATFORM'];
	$DESCRIPTION = $_POST['DESCRIPTION'];
	
	if($TITLE=="" || $CATEGORY=="" || $PUBLISHER=="")
	{
			echo 0;
	}
	else
	{
		
		
		
		if($AUTHOR=="" && $CATEGORY!="14" && $CATEGORY!="15" && $CATEGORY!="16" && $CATEGORY!="17" && $CATEGORY!="10"  && $CATEGORY!="11"  && $CATEGORY!="12"  && $CATEGORY!="13" )
		{
			echo 0;
			exit();
		}
		
		include '../../includes/ServerConnect.php';
		
		$query = "SELECT * FROM librorum_items.items_original WHERE `TITLE/PRODUCT` = '$TITLE' AND `AUTHOR/ARTISTS` = '$AUTHOR' AND `ITEM_CATEGORY_ID` = '$CATEGORY' AND `PLATFORM` = '$PLATFORM'";
		$result = mysql_query( $query) or die(mysql_error()); 
		$exists = mysql_num_rows($result);
		while($ROW = mysql_fetch_array($result))
		{
			$ITEM_ID = $ROW['INFO_ID'];
		}
		
		if($exists < 1)
		{
			$query = "INSERT INTO librorum_items.items_original (`TITLE/PRODUCT`, `AUTHOR/ARTISTS`, `ITEM_CATEGORY_ID`, `PUBLISHER/NETWORK/MANUFACTURER`, `DESCRIPTION` , `PLATFORM`) VALUES ('".$TITLE."', '".$AUTHOR."', '".$CATEGORY."', '".$PUBLISHER."', '".$DESCRIPTION."', '".$PLATFORM."')";
			mysql_query( $query) or die(mysql_error()); 		
			$ITEM_ID = mysql_insert_id();
			
			$query = "INSERT INTO librorum_items.items_processing (ITEM_INFO_ID, PROCESS_STATUS) VALUES ($ITEM_ID, '0')";		
			mysql_query( $query) or die(mysql_error()); 
		}
	
		$query = "INSERT INTO items (ITEM_INFO_ID, OWNER_ID,  DATE_ADDED) VALUES ($ITEM_ID, $MY_ID, NOW())";		
		mysql_query( $query) or die(mysql_error()); 
		
		echo 1;
	}

?>