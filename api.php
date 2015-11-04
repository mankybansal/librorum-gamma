<?php 


if(isset($_GET['ACTION']))
{
	if($_GET['ACTION'] == "login")
	{
		login($_GET['EMAIL'],$_GET['PASSWORD']);
	}
	else if($_GET['ACTION'] == "addEvent")
	{
		addEvent($_GET['NAME'], $_GET['DESCRIPTION'], $_GET['LOCATION'], $_GET['IMG_LINK']);
	}
	else if($_GET['ACTION'] == "getEvents")
	{
		getEvents();
	}

}


	class response 
	{
		private $httpCode;
		public 	$responseType, $data;

		public function __construct($responseType, $data, $httpCode)
		{
			$this->responseType = $responseType;
			$this->data = $data;
			$this->httpCode = $httpCode;
		}

		public function sendToClient() {
			http_response_code($this->httpCode);
			echo json_encode($this);
		}
	}
	
	class connection
	{		
		public $result;
		public $host = 'localhost'; 

		public $user = 'mayank'; // Mysql username 
		public $password = '#I@m$h@r!ng';
		public $db = "unuglify";
		public $dbc;

		function __construct($query="")
		{
			$con = mysqli_connect($this->host, $this->user, $this->password, $this->db);

			if(mysqli_errno($con))
				echo "(MYSQL ERROR).";
			else
			{
				$this->dbc = $con;
				if($query!="")	$this->queryData($query);
			}	
		}
		
		function queryData($query)
		{
			$this->result = $this->dbc->query($query);
		}
		
	}	
	
	class user
	{
		public $ID, $NAME, $EMAIL, $PASSWORD, $PHONE, $IMG_LINK;

		//SET USER INFO
		public function setInfo($ID, $NAME, $EMAIL, $PASSWORD, $PHONE, $IMG_LINK) 
		{			
			$this->ID = $ID;
			$this->NAME = $NAME;
			$this->EMAIL = $EMAIL;
			$this->PASSWORD = $PASSWORD;
			$this->PHONE = $PHONE;
			$this->IMG_LINK = $IMG_LINK;
		}
		
		//GET USER INFO
		public function showInfo() 
		{
			$myUser = array(
				'ID'    	  => $this->ID,
				'NAME'    	  => $this->NAME,
				'EMAIL'		  => $this->EMAIL,
				'PHONE' 	  => $this->PHONE,
				'IMG_LINK' 	  => $this->IMG_LINK
			);
			return $myUser;
		}
	
		public function getInfo($email, $password)
		{		
			$mysqli = new connection("SELECT * FROM users WHERE EMAIL='".$email."' AND PASSWORD='".$password."'"); 
			if($mysqli->result->num_rows>0) 
			{
				$row = $mysqli->result->fetch_assoc();	
				$this->setInfo($row['ID'],$row['NAME'],$row['EMAIL'],$row['PASSWORD'],$row['PHONE'],$row['IMG_LINK']);
			}	
			else
			{
				throw new loginException();
			}
		}
	}
		
	class event
	{
		public $ID, $NAME, $TIMESTAMP, $DESCRIPTION, $LOCATION, $STATUS, $IMG_LINK, $MYCOUNT;

		//SET EVENT INFO
		public function setInfo($ID, $NAME, $TIMESTAMP, $DESCRIPTION, $LOCATION, $STATUS, $IMG_LINK, $MYCOUNT) 
		{			
			$this->ID = $ID;
			$this->NAME = $NAME;
			$this->TIMESTAMP = $TIMESTAMP;
			$this->DESCRIPTION = $DESCRIPTION;
			$this->LOCATION = $LOCATION;
			$this->STATUS = $STATUS;
			$this->IMG_LINK = $IMG_LINK;
			$this->MYCOUNT = $MYCOUNT;
		}
		
		//GET EVENT INFO
		public function showInfo() 
		{
			$myEvent = array(
				'ID'    	  => $this->ID,
				'NAME'    	  => $this->NAME,
				'TIMESTAMP'	  => $this->TIMESTAMP,
				'DESCRIPTION' => $this->DESCRIPTION,
				'LOCATION' 	  => $this->LOCATION,
				'STATUS' 	  => $this->STATUS,
				'IMG_LINK' 	  => $this->IMG_LINK,
				'MYCOUNT' 	  => $this->MYCOUNT
			);
			return $myEvent;
		}
	}
		
	class location
	{
		public $ID, $NAME, $LAT, $LON;

		//SET LOCATION INFO
		public function setInfo($ID, $NAME, $LAT, $LON) 
		{			
			$this->ID = $ID;
			$this->NAME = $NAME;
			$this->LAT = $LAT;
			$this->LON = $LON;
		}
		
		//GET LOCATION INFO
		public function showInfo() 
		{
			$myLocation = array(
				'ID'  	  => $this->ID,
				'NAME'    => $this->NAME,
				'LAT'	  => $this->LAT,
				'LON' 	  => $this->LON,
			);
			return $myLocation;
		}
	}
			
	class picture
	{
		public $ID, $EVENT_ID, $USER_ID, $TIMESTAMP, $IMG_LINK;

		//SET PICTURE INFO
		public function setInfo($ID, $EVENT_ID, $USER_ID, $TIMESTAMP, $IMG_LINK) 
		{			
			$this->ID = $ID;
			$this->EVENT_ID = $EVENT_ID;
			$this->USER_ID = $USER_ID;
			$this->TIMESTAMP = $TIMESTAMP;
			$this->IMG_LINK = $IMG_LINK;
		}
		
		//GET PICTURE INFO
		public function showInfo() 
		{
			$myPicture = array(
				'ID'     	 => $this->ID,
				'EVENT_ID'   => $this->EVENT_ID,
				'USER_ID'	 => $this->USER_ID,
				'TIMESTAMP'  => $this->TIMESTAMP,
				'IMG_LINK' 	 => $this->IMG_LINK,
			);
			return $myPicture;
		}
	}
	
	class loginException extends Exception 
	{
		public function errorMessage() {
			$errorMsg = "INVALID LOGIN";
			return $errorMsg;
		}
	}
	
	function login($username, $password)
	{
		$user = new user();
		try 
		{
			$user->getInfo($username, $password);
			$response = new response("login",$user->showInfo(),200);
				var_dump($response);
			
			$response->sendToClient();
		}
		catch(loginException $e)
		{
			$response = new response("login","INVALID-LOGIN",400);
			
		
			$response->sendToClient();
		}
	}
	
	function addEvent($name, $description, $location, $img_link)
	{
		
		$myLocation = explode(',',$location);
		
		$LOC_NAME = $myLocation[0];
		$LOC_LAT = $myLocation[1];
		$LOC_LON = $myLocation[2];
		
		$mysqli = new connection("INSERT INTO locations (NAME, LAT, LON) VALUES ('".$LOC_NAME."','".$LOC_LAT."','".$LOC_LON."')");
		
		$LOCATION_ID = $mysqli->dbc->insert_id;
		$mysqli = new connection("INSERT INTO events (NAME,TIME,DESCRIPTION,LOCATION_ID,STATUS,IMG_LINK) VALUES ('".$name."',NOW(),'".$description."','".$LOCATION_ID."','INCOMPLETE','".$img_link."')");
	
		$response = new response("addEvent","ADDED-EVENT",200);
		$response->sendToClient();
	}
	
	function getEvents()
	{
		$events = array();
		$mysqli = new connection("SELECT *,locations.ID AS `LOCATION_ID`,events.ID AS `EVENT_ID`,locations.NAME AS `LOCATION_NAME`,events.NAME AS `EVENT_NAME` FROM events JOIN locations ON events.LOCATION_ID WHERE events.LOCATION_ID = locations.ID");
		while($row = $mysqli->result->fetch_assoc())
		{
			$location = new location();
			$location->setInfo($row['LOCATION_ID'],$row['LOCATION_NAME'],$row['LAT'],$row['LON']);
			
			$mysqli2 = new connection("SELECT * FROM attend WHERE EVENT_ID = '".$row['EVENT_ID']."'");
			$myCount = $mysqli2->result->num_rows;
			
			$event = new event();
			$event->setInfo($row['EVENT_ID'],$row['EVENT_NAME'],$row['TIME'],$row['DESCRIPTION'],$location,$row['STATUS'],$row['IMG_LINK'],$myCount);
			array_push($events, $event);
		}
	
		$response = new response("getEvents",$events,200);
		$response->sendToClient();
	}
	
	function updateEvent($eventID, $status)
	{
		$mysqli = new connection("UPDATE events SET STATUS='".$status."' WHERE ID='".$eventID."'");
		
		$response = new response("updateEvents","EVENT-DONE",200);
		$response->sendToClient();
	}
	
	function rsvpEvent($eventID, $userID)
	{
		$mysqli = new connection("INSERT INTO attend (EVENT_ID, USER_ID) VALUES ('".$eventID."','".$userID."')");
		
		$response = new response("rsvpEvent","ADDED-RSVP",200);
		$response->sendToClient();
	}
	
	function addPicture($eventID, $userID, $imgLink)
	{
	
	}
	
	//rsvpEvent(2,4);
	
	//login("sunny.bansal@gmail.com","abcd");
	//updateEvent(1,"COMPLETE");
	// CREATE NOTIFICATION WHEN THE EVENT IS CREATED.

?> 