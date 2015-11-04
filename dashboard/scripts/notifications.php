<?php   SESSION_START();	?>
<?php  ERROR_REPORTING(0);	?>


<?php

	include '../../includes/ServerConnect.php';
	include '../../includes/ItemData.php';
	include '../../includes/SetTimezone.php';
	
	$ACTION = $_POST['ACTION'];
	$REQUEST_ID = $_POST['REQUEST_ID'];
	
    if($ACTION == 'myRequests')
	{
		myRequests($_SESSION['MY_ID'], $REQUEST_ID);
	} 
	else if($ACTION == 'otherRequests')
	{
		otherRequests($_SESSION['MY_ID'], $REQUEST_ID);
	}
	else if($ACTION == 'myNotifications')
	{
		myNotifications($_SESSION['MY_ID'], $REQUEST_ID);
	}
	else 
	{
		
		if($ACTION == 'cancel')
		{
			cancelRequest($REQUEST_ID);	
		}	
		else if($ACTION == 'decline')
		{
			declineRequest($REQUEST_ID);
		}
		else if($ACTION == 'clear')
		{
			clearNotification($REQUEST_ID);
		}	
		else if($ACTION == 'return')
		{
			returnRequest($REQUEST_ID);
		}	
		else if($ACTION == 'acceptRequest')
		{
			acceptRequest($REQUEST_ID);
		}	
		else if($ACTION == 'remindBorrower')
		{
			remindBorrower($REQUEST_ID);
		}
		else if($ACTION == 'remindOwner')
		{
			remindOwner($REQUEST_ID);
		}		
		else if($ACTION == 'returnedRequest')
		{
			returnedRequest($REQUEST_ID);
		}
	}

    function reqCred($ITEM_ID)
    {
        $QUERY =    "
                        SELECT REQ_CREDITS from items
                        INNER JOIN librorum_items.items_original ON items.ITEM_INFO_ID = librorum_items.items_original.INFO_ID
                        INNER JOIN sub_categories ON sub_categories.CATEGORY_ID = librorum_items.items_original.ITEM_CATEGORY_ID
                        INNER JOIN main_categories ON main_categories.CATEGORY_ID = sub_categories.MAIN_CATEGORY_ID
                        WHERE ITEM_ID = $ITEM_ID;
                        ";

        $RESULT = mysql_query($QUERY);
        while($ROW = mysql_fetch_array($RESULT))
        {
            $reqCredits = $ROW['REQ_CREDITS'];
        }

        return $reqCredits;

    }

    function myCred($myID)
    {

        $QUERY = "SELECT CREDITS FROM credits WHERE USER_ID = ".$myID;

        $RESULT = mysql_query($QUERY);
        while($ROW = mysql_fetch_array($RESULT))
        {
            $myCredits = $ROW['CREDITS'];
        }

        return $myCredits;

    }

	function cancelRequest($REQUEST_ID)
	{
	
		$query = "SELECT * FROM requests WHERE REQUEST_ID = $REQUEST_ID";
		$data = mysql_query($query);
			
		while($row = mysql_fetch_array($data))
		{	
			$ITEM_ID = $row['ITEM_ID'];
		}

        $newTotal =  myCred($_SESSION['MY_ID'])+reqCred($ITEM_ID);
        $query = "UPDATE credits SET credits.CREDITS=$newTotal WHERE USER_ID =".$_SESSION['MY_ID'];
        mysql_query( $query) or die(mysql_error());

        $query1 = "DELETE FROM requests WHERE REQUEST_ID = $REQUEST_ID";
	    mysql_query($query1);
				
		$query2 = "UPDATE items SET STATUS = 'AVAILABLE' WHERE ITEM_ID = $ITEM_ID";
		mysql_query($query2);
		
		//$query = "INSERT INTO notifications (NOTIFICATION_TYPE, ITEM_ID, TIMESTAMP, TO_ID) VALUES ('CANCELED', $ITEM_ID, NOW(), "
		//$data = mysql_query($query);
		
		echo "$REQUEST_ID";
		
	}	
	
	function clearNotification($REQUEST_ID)
	{
	
		$query = "DELETE FROM notifications WHERE NOTIFICATION_ID = $REQUEST_ID";
		mysql_query($query);
		echo "$REQUEST_ID";	
	}
	
	function declineRequest($REQUEST_ID)
	{
				
		$query = "SELECT * FROM requests WHERE REQUEST_ID = $REQUEST_ID";
		$data = mysql_query($query);
			
		while($row = mysql_fetch_array($data))
		{	
			$ITEM_ID = $row['ITEM_ID'];
			$FROM_ID = $row['FROM_ID'];
		}

        $newTotal =  myCred($FROM_ID)+reqCred($ITEM_ID);
        $query = "UPDATE credits SET credits.CREDITS=$newTotal WHERE USER_ID =".$FROM_ID;
        mysql_query( $query) or die(mysql_error());
		
		$query1 = "DELETE FROM requests WHERE REQUEST_ID = $REQUEST_ID";
	    mysql_query($query1);
				
		$query2 = "UPDATE items SET STATUS = 'AVAILABLE' WHERE ITEM_ID = $ITEM_ID";
		mysql_query($query2);
		
		$DATE = date('Y-m-d H:i:s');
		
		$query = "INSERT INTO notifications (NOTIFICATION_TYPE, ITEM_ID, TIMESTAMP, TO_ID) VALUES ('DECLINED', $ITEM_ID, '$DATE', $FROM_ID)";
		mysql_query($query);
		
		echo "$REQUEST_ID";
	}
	
	function acceptRequest($REQUEST_ID)
	{
		$query =	"SELECT * FROM requests WHERE REQUEST_ID = $REQUEST_ID";
		$data = mysql_query($query);
			
		while($row = mysql_fetch_array($data))
		{	
			$ITEM_ID = $row['ITEM_ID'];
			$FROM_ID = $row['FROM_ID'];
		}

        $newTotal =  myCred($_SESSION['MY_ID'])+reqCred($ITEM_ID);
        $query = "UPDATE credits SET credits.CREDITS=$newTotal WHERE USER_ID =".$_SESSION['MY_ID'];
        mysql_query( $query) or die(mysql_error());
		
		$query1 = "DELETE FROM requests WHERE REQUEST_ID = $REQUEST_ID";
	    mysql_query($query1);
	   
		$query =	"SELECT * FROM items WHERE ITEM_ID = $ITEM_ID";
		$data = mysql_query($query);
			
		while($row = mysql_fetch_array($data))
		{	
			$borrow_count = $row['BORROW_COUNT'];
		}
		
		$borrow_count++;
		
		$PERIOD = time() + (14*60*60*24);
		$NOW_DATE = date('Y-m-d H:i:s');
		
		$RETURN_DATE = date('Y-m-d H:i:s', $PERIOD);
				
		$query2 = "UPDATE items SET STATUS = 'BORROWED', BORROW_COUNT= $borrow_count WHERE ITEM_ID = $ITEM_ID";
		mysql_query($query2);
		
		
		$query = "INSERT INTO notifications (NOTIFICATION_TYPE, ITEM_ID, TIMESTAMP, TO_ID) VALUES ('ACCEPTED', $ITEM_ID, '$NOW_DATE', $FROM_ID)";
		mysql_query($query);		

		$query = "INSERT INTO borrowed (TIMESTAMP, RETURN_TIMESTAMP, ITEM_ID, BORROWER_ID) VALUES ('$NOW_DATE', '$RETURN_DATE', $ITEM_ID, $FROM_ID)";
		mysql_query($query);
		
		echo "$REQUEST_ID";
	}
	
	function returnedRequest($REQUEST_ID)
	{
		
		$query = "
						SELECT * FROM requests WHERE REQUEST_ID = $REQUEST_ID
						";
		$data = mysql_query($query);
			
		while($row = mysql_fetch_array($data))
		{	
			$ITEM_ID = $row['ITEM_ID'];
			$FROM_ID = $row['FROM_ID'];
		}
		
		$query1 = "DELETE FROM requests WHERE REQUEST_ID = $REQUEST_ID";
	   mysql_query($query1);
	   
		$query3 = "DELETE FROM borrowed WHERE ITEM_ID = $ITEM_ID";
	   mysql_query($query3);
	   
		$query3 = "DELETE FROM notifications WHERE ITEM_ID = $ITEM_ID";
	   mysql_query($query3);
	   
	   
		$query2 = "UPDATE items SET STATUS = 'AVAILABLE' WHERE ITEM_ID = $ITEM_ID";
		mysql_query($query2);

		
		echo "$REQUEST_ID";
	}
		
	function returnRequest($REQUEST_ID)
	{
		
		$query = "SELECT * FROM notifications WHERE NOTIFICATION_ID = $REQUEST_ID";
		$data = mysql_query($query);
			
		while($row = mysql_fetch_array($data))
		{	
			$ITEM_ID = $row['ITEM_ID'];
			$FROM_ID = $row['TO_ID'];
		}
		
		$query1 = "DELETE FROM notifications WHERE NOTIFICATION_ID = $REQUEST_ID";
	   mysql_query($query1);
	   
	   	$NOW_DATE = date('Y-m-d H:i:s');
	   	
		$query = "INSERT INTO requests (REQUEST_TYPE, ITEM_ID, TIMESTAMP, FROM_ID) VALUES ('RETURN', $ITEM_ID, '$NOW_DATE', $FROM_ID)";
		mysql_query($query);		 	
	   
		echo "$REQUEST_ID";
	}
	
	function remindOwner($REQUEST_ID)
	{
	
		$query = "
						SELECT FROM_ID, OWNER_ID, requests.ITEM_ID  FROM requests 
						INNER JOIN items ON requests.ITEM_ID = items.ITEM_ID 
						INNER JOIN users ON  users.USER_ID = requests.FROM_ID
						WHERE requests.REQUEST_ID = $REQUEST_ID
						";
		$data = mysql_query($query);
			
		while($row = mysql_fetch_array($data))
		{	
			$ITEM_ID = $row['ITEM_ID'];
			$FROM_ID = $row['FROM_ID'];
			$TO_ID = $row['OWNER_ID'];
		}
		
		$query = "SELECT * FROM notifications WHERE TO_ID = $TO_ID AND ITEM_ID = $ITEM_ID AND (NOTIFICATION_TYPE='RETURNED SENT' OR NOTIFICATION_TYPE='RETURNED ALREADY')";
		$data = mysql_query($query);
		$count1 = 0;
		while($row = mysql_fetch_array($data))
		{	
			$count1++;
		}	
		
		$query = "SELECT * FROM notifications WHERE TO_ID = $FROM_ID AND (ITEM_ID = $ITEM_ID AND NOTIFICATION_TYPE='RETURNED SENT' OR NOTIFICATION_TYPE='RETURNED ALREADY')";
		$data = mysql_query($query);
		$count2 = 0;
		while($row = mysql_fetch_array($data))
		{	
			$count2++;
		}
		
		// ONLY ADDS IF IT DOESNT EXIST
		if($count1 == 0)
		{
			$NOW_DATE = date('Y-m-d H:i:s');
			
			$query = "INSERT INTO notifications (NOTIFICATION_TYPE, ITEM_ID, TIMESTAMP, TO_ID) VALUES ('RETURNED ALREADY', $ITEM_ID, '$NOW_DATE', $TO_ID)";
			mysql_query($query);		 	
		}
		
		if($count2 == 0)
		{
			$NOW_DATE = date('Y-m-d H:i:s');
			
			$query = "INSERT INTO notifications (NOTIFICATION_TYPE, ITEM_ID, TIMESTAMP, TO_ID) VALUES ('RETURNED SENT', $ITEM_ID, '$NOW_DATE', $FROM_ID)";		 	
			mysql_query($query);
		}
		
		echo "$REQUEST_ID";	
		
	}
	
	function remindBorrower($REQUEST_ID)
	{
		$query = "
						SELECT FROM_ID, OWNER_ID, requests.ITEM_ID  FROM requests 
						INNER JOIN items ON requests.ITEM_ID = items.ITEM_ID 
						INNER JOIN users ON  users.USER_ID = requests.FROM_ID
						WHERE requests.REQUEST_ID = $REQUEST_ID
						";
		$data = mysql_query($query);
			
		while($row = mysql_fetch_array($data))
		{	
			$ITEM_ID = $row['ITEM_ID'];
			$FROM_ID = $row['FROM_ID'];
			$TO_ID = $row['OWNER_ID'];
		}
		
		$query = "SELECT * FROM notifications WHERE TO_ID = $TO_ID AND ITEM_ID = $ITEM_ID AND (NOTIFICATION_TYPE='RETURN REMINDED' OR NOTIFICATION_TYPE='RETURN REMINDER')";
		$data = mysql_query($query);
		$count1 = 0;
		while($row = mysql_fetch_array($data))
		{	
			$count1++;
		}	
		
		$query = "SELECT * FROM notifications WHERE TO_ID = $FROM_ID AND ITEM_ID = $ITEM_ID AND (NOTIFICATION_TYPE='RETURN REMINDED' OR NOTIFICATION_TYPE='RETURN REMINDER')";
		$data = mysql_query($query);
		$count2 = 0;
		while($row = mysql_fetch_array($data))
		{	
			$count2++;
		}
		
		// ONLY ADDS IF IT DOESNT EXIST
		if($count1 == 0)
		{
			$NOW_DATE = date('Y-m-d H:i:s');
			
			$query = "INSERT INTO notifications (NOTIFICATION_TYPE, ITEM_ID, TIMESTAMP, TO_ID) VALUES ('RETURN REMINDER', $ITEM_ID, '$NOW_DATE', $TO_ID)";
			mysql_query($query);		 	
		}
		
		if($count2 == 0)
		{
			$NOW_DATE = date('Y-m-d H:i:s');
			
			$query = "INSERT INTO notifications (NOTIFICATION_TYPE, ITEM_ID, TIMESTAMP, TO_ID) VALUES ('RETURN REMINDED', $ITEM_ID, '$NOW_DATE', $FROM_ID)";		 	
			mysql_query($query);
		}
		
		echo "$REQUEST_ID";	
	}
	
	function myRequests($MY_ID, $REQUEST_ID)
	{
			$index = 0;
			$array = array();
			
			$query = "
							SELECT REQUEST_ID, FROM_ID, REQUEST_TYPE, `TIMESTAMP`, `TITLE/PRODUCT`, users.USER_NAME as `NAME`, OWNER_ID FROM requests 
							INNER JOIN items ON requests.ITEM_ID = items.ITEM_ID 
							INNER JOIN librorum_items.items_original ON librorum_items.items_original.INFO_ID = items.ITEM_INFO_ID
							INNER JOIN users ON  users.USER_ID = items.OWNER_ID
							WHERE REQUEST_ID = $REQUEST_ID
							";
							
			$data = mysql_query($query);
			while($row = mysql_fetch_array($data))
			{	
			
					$array[$index] =  array(
															"REQUEST_ID"		=> $row['REQUEST_ID'],
															"REQUEST_TYPE"	=> $row['REQUEST_TYPE'],
															"FROM_ID"				=> $row['OWNER_ID'],
															"NAME"						=> $row['NAME'],
															"ITEM_TITLE"			=> $row['TITLE/PRODUCT'],
															"DATE"						=> $row['TIMESTAMP'],
															);
					$index++;
			}
		
			echo json_encode($array);
	}	
		
	function myNotifications($MY_ID, $REQUEST_ID)
	{
			$index = 0;
			$array = array();
			
			$query = "
							SELECT NOTIFICATION_ID, TO_ID, NOTIFICATION_TYPE, `TIMESTAMP`, `TITLE/PRODUCT`, users.USER_NAME as `NAME`, OWNER_ID  FROM notifications 
							INNER JOIN items ON notifications.ITEM_ID = items.ITEM_ID 
							INNER JOIN librorum_items.items_original ON librorum_items.items_original.INFO_ID = items.ITEM_INFO_ID
							INNER JOIN users ON  users.USER_ID = items.OWNER_ID
							WHERE notifications.NOTIFICATION_ID = $REQUEST_ID
							";
			$data = mysql_query($query);
			while($row = mysql_fetch_array($data))
			{	
			
					if(($row['NOTIFICATION_TYPE']=="RETURN REMINDER") || ($row['NOTIFICATION_TYPE']=="RETURNED ALREADY"))
					{
					  
						$query5 = "
									SELECT users.USER_NAME as `NAME`, users.USER_ID FROM notifications 
									INNER JOIN borrowed ON borrowed.ITEM_ID = notifications.ITEM_ID
									INNER JOIN users ON  users.USER_ID = borrowed.BORROWER_ID
									WHERE notifications.NOTIFICATION_ID  = ".$row['NOTIFICATION_ID']."
									";
							
							$data5 = mysql_query($query5);
							while($row5 = mysql_fetch_array($data5))
							{	
									$NAME = $row5['NAME'];
									$USER_ID = $row5['USER_ID'];
							}
					}
					else
					{
						$NAME = $row['NAME'];
						$USER_ID = $row['OWNER_ID'];
					}
			
					$array[$index] =  array(
															"NOTIFICATION_ID"		=> $row['NOTIFICATION_ID'],
															"NOTIFICATION_TYPE"	=> $row['NOTIFICATION_TYPE'],
															"TO_ID"								=> $row['TO_ID'],
															"FROM_ID"				=> $USER_ID,
															"NAME"						=> $NAME,
															"ITEM_TITLE"			=> $row['TITLE/PRODUCT'],
															"DATE"						=> $row['TIMESTAMP'],
															);
					$index++;
			}
		
			echo json_encode($array);
	}	
	
	function otherRequests($MY_ID, $REQUEST_ID)
	{
			$index = 0;
			$array = array();
			
			$query = "
							SELECT REQUEST_ID, FROM_ID, REQUEST_TYPE, `TIMESTAMP`, `TITLE/PRODUCT`, users.USER_NAME as `NAME`  FROM requests 
							INNER JOIN items ON requests.ITEM_ID = items.ITEM_ID 
							INNER JOIN librorum_items.items_original ON librorum_items.items_original.INFO_ID = items.ITEM_INFO_ID
							INNER JOIN users ON  users.USER_ID = requests.FROM_ID
							WHERE REQUEST_ID = $REQUEST_ID
							";
							
			$data = mysql_query($query);
			while($row = mysql_fetch_array($data))
			{	
			
					$array[$index] =  array(
															"REQUEST_ID"		=> $row['REQUEST_ID'],
															"REQUEST_TYPE"	=> $row['REQUEST_TYPE'],
															"FROM_ID"				=> $row['FROM_ID'],
															"NAME"						=> $row['NAME'],
															"ITEM_TITLE"			=> $row['TITLE/PRODUCT'],
															"DATE"						=> $row['TIMESTAMP'],
															);
					$index++;
			}
		
			echo json_encode($array);
	}	
	
?>
	

