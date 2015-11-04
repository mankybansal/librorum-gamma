<?php   SESSION_START();	?>
<?php   ERROR_REPORTING(0);	?>


<?php


	include '../../includes/ServerConnect.php';
	include '../../includes/ItemData.php';
	$ACTION = $_POST['ACTION'];

	if($ACTION == 'load')
	{
		loadITEMS($GROUP_ID);
	}
	
	function loadITEMS($GROUP_ID)
	{
	
			$query = "		SELECT 
								items.ITEM_ID,
								items.OWNER_ID,
								`TITLE/PRODUCT`,
								`AUTHOR/ARTISTS`,
								items_original.IMAGE,
								borrowed.`TIMESTAMP`,
								borrowed.`RETURN_TIMESTAMP`,
								`owner`.USER_NAME AS `OWNER_NAME`,
								`borrower`.USER_NAME AS `BORROWER_NAME`
								FROM borrowed
								LEFT JOIN items ON librorum.items.ITEM_ID = librorum.borrowed.ITEM_ID 
								LEFT JOIN librorum_items.items_original ON librorum.items.ITEM_INFO_ID = librorum_items.items_original.INFO_ID 
								LEFT JOIN users `owner` ON items.OWNER_ID = `owner`.USER_ID 
								LEFT JOIN user_group_relation on user_group_relation.USER_ID = `owner`.USER_ID
								LEFT JOIN users `borrower` on borrowed.BORROWER_ID = `borrower`.USER_ID
								WHERE OWNER_ID= ".$_SESSION['MY_ID'];
			$result = mysql_query($query);

			$index = 0;
			
			while($row = mysql_fetch_array($result))
			{
				$array[$index] =  array(
										'ID' =>  $row['ITEM_ID'], 
										'TITLE FULL' => $row['TITLE/PRODUCT'],
										'PUBLISHER' => $row['AUTHOR/ARTISTS'],
										'IMAGE' => $row['IMAGE'],
										'OWNER NAME' =>   $row['OWNER_NAME'],
										'BORROWER NAME' =>   $row['BORROWER_NAME'],	
										'BORROW' =>   $row['TIMESTAMP'],	
										'RETURN' =>   $row['RETURN_TIMESTAMP'],	
									  );	
				$index++;
			}
			
			echo json_encode($array);
	}	
	
	
?>
	

