<?php   SESSION_START();	?>
<?php   ERROR_REPORTING(0);	?>


<?php

		include 'ServerConnect.php';
		include 'ItemData.php';
		
		
	function checkStatus($ITEM_ID)
	{
		
		$query = "SELECT * FROM items WHERE ITEM_ID = '$ITEM_ID'";
		$result = mysql_query( $query) or die(mysql_error()); 
		
		while($ROW = mysql_fetch_array($result))
		{
			$STATUS = $ROW['STATUS'];
		}
		
		
		return $STATUS;
		
	}
	
	function checkInfoID($ITEM_ID)
	{
		$query = "SELECT * FROM items WHERE ITEM_ID = '$ITEM_ID'";
		$result = mysql_query( $query) or die(mysql_error()); 
		
		while($ROW = mysql_fetch_array($result))
		{
			$INFO_ID = $ROW['ITEM_INFO_ID'];
		}
		return $INFO_ID;
	}	
	
	function ownerID($ITEM_ID)
	{
		$query = "SELECT * FROM items WHERE ITEM_ID = '$ITEM_ID'";
		$result = mysql_query( $query) or die(mysql_error()); 
		
		while($ROW = mysql_fetch_array($result))
		{
			$OWNER_ID = $ROW['OWNER_ID'];
		}
		return $OWNER_ID;
	}
	
	
	$ITEM_ID = $_POST['ITEM_ID'];
	$ACTION = $_POST['ACTION'];
	
	if($ACTION == "CHECK")
	{
		checkBorrow($ITEM_ID);
	}
	elseif($ACTION == "BORROW")
	{
		borrowRequest($ITEM_ID);
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

	function borrowRequest($ITEM_ID)
	{
		$MY_ID = $_SESSION['MY_ID'];
		
		$query = "SELECT * FROM requests WHERE FROM_ID = $MY_ID AND REQUEST_TYPE = 'BORROW'";
		$result = mysql_query( $query) or die(mysql_error()); 
		$count = mysql_num_rows($result);
		
		if($count>=5)
		{
			echo "maximum request limit";
		}
		else
		{
			$query = "SELECT * FROM requests WHERE ITEM_ID = $ITEM_ID";
			$result = mysql_query( $query); 
			$count = mysql_num_rows($result);
		
			if($count==0)
			{
			
                //TODO COUPON DASHBOARD

                $remainder =  myCred($_SESSION['MY_ID'])-reqCred($ITEM_ID);
                $query = "UPDATE credits SET credits.CREDITS=$remainder WHERE USER_ID =".$_SESSION['MY_ID'];
                mysql_query( $query) or die(mysql_error());

                $query = "INSERT INTO requests (REQUEST_TYPE, FROM_ID,  ITEM_ID, TIMESTAMP) VALUES ('BORROW', $MY_ID, $ITEM_ID, NOW())";
				mysql_query( $query) or die(mysql_error()); 
				
				$query = "UPDATE items SET STATUS = 'BORROWED' WHERE ITEM_ID = '$ITEM_ID'";
				mysql_query( $query) or die(mysql_error()); 
				
				$ownerID = ownerID($ITEM_ID);
				
				$query =	"
							SELECT NOW() as `TIME`,`TITLE/PRODUCT`, `OWNER`.EMAIL as `OWNER_NAME`, `BORROWER`.EMAIL as `BORROWER_EMAIL`, `OWNER`.USER_NAME as `OWNER_NAME`, `BORROWER`.USER_NAME as `BORROWER_NAME` FROM `items`
							INNER JOIN librorum_items.items_original ON librorum_items.items_original.INFO_ID = items.ITEM_INFO_ID 
							INNER JOIN users AS `OWNER` ON `OWNER`.USER_ID = items.OWNER_ID
							INNER JOIN users AS `BORROWER` ON `BORROWER`.USER_ID = $MY_ID
							WHERE ITEM_ID = $ITEM_ID;
							";
				$result = mysql_query( $query) or die(mysql_error()); 
				while($row = mysql_fetch_array($result))
				{
					$TITLE = $row['TITLE/PROCUCT'];
					$TIMESTAMP = $row['TIME'];
					$OWNER_NAME = $row['OWNER_NAME'];
					$BORROWER_NAME = $row['BORROWER_NAME'];		
					$OWNER_EMAIL = $row['OWNER_EMAIL'];
					$BORROWER_EMAIL = $row['BORROWER_EMAIL'];			
				}
				
				include 'mailerMandrill.php';
				
				$mailBody1 =	"
							Hi <strong>".$OWNER_NAME."</strong>,<br><br>

							<b>".$BORROWER_NAME."</b> want's to borrow <b>".$TITLE."</b> from you.<br>
							Requested on: ".$TIMESTAMP."
							<br><br>
							You can log into your dashboard and accept/delete this request. You can also view details about this user for more information.
							Do decide soon as keeping users in your community waiting for long periods is not advised.							
							";			
				$mailBody2 =	"
							Hi <strong>".$BORROWER_NAME."</strong>,<br><br>

							You have requested to borrow <b>".$TITLE."</b> from <b>".$OWNER_NAME."</b>.<br>
							Requested on: ".$TIMESTAMP."
							<br><br>
							You can log into your dashboard and track/delete this request. You can also view details about this user once he/she has accepted your request for more information.
							Accepting your request can take a while, so sit back and relax! 						
							";
				
				$ownerMAIL = standardMailer('mailer2', $mailBody1);
				$borrowerMAIL = standardMailer('mailer2', $mailBody2);
				
				sendMail($ownerMAIL, 'Borrow Request', 'notifications', $OWNER_EMAIL, $OWNER_NAME);
				sendMail($borrowerMAIL, 'Borrow Request', 'notifications', $BORROWER_EMAIL, $BORROWER_NAME);
				
				echo "done";
			}
		}
	}

function checkBorrow($ITEM_ID)
{	
	if($_SESSION['MY_ID'] != "")
	{
		$MY_ID = $_SESSION['MY_ID'];	
		$STATUS = checkStatus($ITEM_ID);
		$INFO_ID = checkInfoID($ITEM_ID);
		$OWNER_ID = ownerID($ITEM_ID);

		if($OWNER_ID != $_SESSION['MY_ID'])
		{
			$array = array();
			$index = 0;
			
			if($STATUS == "BORROWED")
			{
				$array = fetch_items("default", " AND items.ITEM_INFO_ID = '".$INFO_ID."' AND items.ITEM_ID != '".$ITEM_ID."'");
				foreach($array as $item)
				{
					$STATUS = checkStatus($item['ID']);
					if($STATUS == "AVAILABLE")
					{
						$array[$index] = $item['ID'];
						$index++;
					}
				}
			
				if(count($array)>0)
				{
					echo $array[array_rand($array, 1)];
				}else
				{
					echo "all borrowed";
				}
			}else
			{

                if(myCred($_SESSION['MY_ID'])-reqCred($ITEM_ID)<0)
                {
                   echo "creditError";
                }else
                {
                    echo "available";
                }

			}
		}else
		{
			echo "owner";
		}
	
	}
	else
	{	
		echo "not signed in";
	}

}


?>