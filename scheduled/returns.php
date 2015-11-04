<?php

	/*********************************************************************
	 * CRON JOB FOR CHECKING RETURN DATES AND PUSHING NOTIFICATIONS      *
	 *																	 *
	 * This script will query current borrows and will check for records *
	 * which have a return date in the past and will push a notification *
	 * to the lender and borrower about the delay in the return. 		 *
	 *																	 *
	 * @category   Cron Jobs											 *
	 * @author     Mayank Bansal <mayank.bansal@librorum.im>			 *
	 * @copyright  2012-2015 Librorum - The Sharing Community			 *
	 * @version    SVN: 1.0.0											 *
	 * @modified   05-03-2015, 4:21 AM									 *
	 ********************************************************************/

	ERROR_REPORTING(0);
	
	//SET STANDARD TIMEZONE
	date_default_timezone_set('Asia/Kolkata');
		
	//CONNECT SCRIPT FOR DATABASE ACCESS
	include '../includes/ServerConnect.php';
	
	//MAILER SCRIPT FOR SENDING EMAILS
	include '../includes/mailerMandrill.php';	

	//QUERY THE CURRENT BORROWS
	$QUERY = "SELECT * FROM borrowed";
	$RESULT = mysql_query($QUERY);
	while($ROW = mysql_fetch_array($RESULT))
    {
        $ITEM_ID = $ROW['ITEM_ID'];
        $BORROWER_ID = $ROW['BORROWER_ID'];
        $TIMESTAMP = $ROW['TIMESTAMP'];
        $RETURN_TIMESTAMP = $ROW['RETURN_TIMESTAMP'];
    }
	
	//CREATE DATE OBJECTS
	$today = new DateTime();
	$returnDate = new DateTime($RETURN_TIMESTAMP);
		
	if($today>$returnDate)
	{
		//CHECK IF NOTIFICATION IS ALREADY PUSHED
		$QUERY = "SELECT * FROM notifications WHERE ITEM_ID = $ITEM_ID AND NOTIFICATION_TYPE = 'OVERDUE'";
		if(mysql_num_rows(mysql_query($QUERY))==0)
		{
			//INSERT NOTIFICATION INTO DATABASE
			$QUERY = "INSERT INTO notifications (NOTIFICATION_TYPE, TIMESTAMP, ITEM_ID, TO_ID) VALUES ('OVERDUE', NOW(), $ITEM_ID, $BORROWER_ID)";
			mysql_query($QUERY);
			
			//GET BORROWER DETAILS 
			$QUERY = "SELECT * FROM users WHERE USER_ID = $BORROWER_ID";
			$RESULT = mysql_query($QUERY);
			
			while($ROW = mysql_fetch_array($RESULT))
			{
				$BORROWER_NAME = $ROW['USER_NAME'];
				$BORROWER_EMAIL = $ROW['EMAIL'];
			}	
			
			//FIND INTERVAL OF TODAY AND RETURN DATE IN DAYS
			$interval = $today->diff($returnDate)->format("%a");
			
			//GET CREDIT COUNT OF USER
			$QUERY = "SELECT CREDITS FROM credits WHERE USER_ID=".$BORROWER_ID;
			$RESULT = mysql_query($QUERY);
			while($ROW = mysql_fetch_array($RESULT))
			{
				$userCredits = $ROW['CREDITS'];
			}
			
			//DEDUCT CREDITS FROM BORROWER
			$QUERY = "UPDATE credits SET credits.CREDITS=".($userCredits-$interval*2)." WHERE USER_ID =".$BORROWER_ID;
			mysql_query($QUERY);
				
			//SEND BORROWER EMAIL ABOUT OVERDUE ITEM
			$mailBody = "
						Hi <strong>".$BORROWER_NAME."</strong>,<br><br>
						An item you borrowed is overdue by ".$interval." day(s).<br><br>
						Please do return this item as soon as possible. If you've forgotten to update the return on Librorum, then please do so. 
						A total of ".($interval*2)." credits from your account will be deducted as not returning an item on time causes the owner an inconvenience.
						";
			$constructedMail = standardMailer('mailer3', $mailBody);
			sendMail($constructedMail, 'Overdue Borrow', 'notifications', $BORROWER_EMAIL, $BORROWER_NAME);	
		}	
	}

?>