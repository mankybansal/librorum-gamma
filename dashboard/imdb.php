<?php

/************
* AUTHOR(S) *
*************
**********************************************
* Code written by Arjhun Srinivas			 *
* Date of creation : 01-Feb-2015			 *
* Last modified : 29-Mar-2015				 *
* Last modofied by : Arjhun Srinivas		 *
* Written for Liborum, The Sharing Community *
* E-mail : arjhun[dot]s[at]gmail[dot]com 	 *
*********************************************/

/********************
* CLASS DEFINITIONS *
********************/
class connection
{
	public $host ="localhost";
	public $user = "root"; 
	public $password = '$haringan';
	public $db="imdb";
	public $dbc;

	function __construct()
	{
		$con = mysqli_connect($this->host, $this->user, $this->password, $this->db);

		if(mysqli_errno($con))
		{
			echo "some error";
		}
        	else
		{
			$this->dbc = $con; // assign $con to $dbc
			//echo"connected ";
		}
	}
}

class imdb
{
	private $data = array();
	private $stats = array();
	private $response;
	private $error = array();
	private $query = "www.omdbapi.com/?";
	private $query_opts = array();
	private $buffer = array();

	function __construct($imdb)
	{
		// $imdb has to be an array with ID or title values
		if(array_key_exists('id', $imdb))
		{
			//$this->data['id'] = $imdb['id'];
			$this->query_opts['i'] = $imdb['id'];
		}
		elseif(array_key_exists('title', $imdb))
		{
			//$this->data['title'] = $imdb['title'];
			$this->query_opts['t'] = urlencode($imdb['title']);
		}

		if(array_key_exists('year', $imdb))
		{
			//$this->data['year'] = $imdb['year'];
			$this->query_opts['y'] = $imdb['year'];
		}

		// Construct error check buffer
		$this->construct_buffer($imdb);

		// Set additional options
		$this->set_opts();

		// Build final query
		$this->build_query();

		// Perform search
		$this->search();

		// Decode results
		$this->response_decode();

		// Perform error check on response & write if needed
		if($this->error_check() == 0)
		{
			// Save decoded results
			$this->response_save();

			// Write data to DB
			//$this->db_write();
		}
	}

	function __destruct()
	{
		// Include code for statistics collection
	}

	function construct_buffer($imdb)
	{
		foreach($imdb as $key => $value)
		{
			$this->buffer[$key] = $value;
		}
	}

	function error_check()
	{
		if(array_key_exists('Error', $this->response))
		{
			foreach($this->response as $key => $value)
			{
				$this->error[$key] = $value;
			}

			foreach($this->buffer as $key => $value)
			{
				$this->error[$key] = $value;
			}

			var_dump($this->error);

			/*
			// Establish new connection
			$connection = new connection();

			$query = "INSERT INTO error_log(Response,Error,id,title,year) VALUES (?,?,?,?,?)";
			$stmt = $connection->dbc->prepare($query);
			$stmt->bind_param('sssss',
				$this->error['Response'],
				$this->error['Error'],
				$this->error['id'],
				$this->error['title'],
				$this->error['year']
			);
			$stmt->execute();
			$stmt->close();
			$connection = null;
			*/

			return 1;
		}
		else
			return 0;
	}

	function set_opts()
	{
		// Set additional query options
		$this->query_opts['r'] = "json";
		$this->query_opts['plot'] = "short";
	}

	function build_query()
	{
		// Construct search query
		foreach ($this->query_opts as $key => $value)
		{
			// Append query options
			$this->query = $this->query.$key.'='.$value.'&';
		}

		//var_dump($this->query);
		echo "".PHP_EOL;
	}

	function search()
	{
		// Perfrom search on OMDb
		$ch = curl_init($this->query);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$this->response = curl_exec($ch);
		curl_close($ch);	
	}

	function response_decode()
	{
		// Decode JSON result and save as array
		$this->response = json_decode($this->response, true);
		//print_r($this->response);
	}

	function response_save()
	{
		foreach($this->response as $key => $value)
		{
			$this->data[$key] = $value;
		}

		echo(json_encode($this->data));
	}

	/*
	function db_write()
	{
		$connection = new connection();
		
		$query = "INSERT INTO data(Title,Year,Rated,Released,Runtime,Genre,Director,Writer,Actors,Plot,Language,Country,Awards,Poster,Metascore,imdbRating,imdbVotes,imdbID) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $connection->dbc->prepare($query);
		$stmt->bind_param('ssssssssssssssssss', 
			$this->data['Title'],
			$this->data['Year'],
			$this->data['Rated'],
			$this->data['Released'],
			$this->data['Runtime'],
			$this->data['Genre'],
			$this->data['Director'],
			$this->data['Writer'],
			$this->data['Actors'],
			$this->data['Plot'],
			$this->data['Language'],
			$this->data['Country'],
			$this->data['Awards'],
			$this->data['Poster'],
			$this->data['Metascore'],
			$this->data['imdbRating'],
			$this->data['imdbVotes'],
			$this->data['imdbID']
		);
		$stmt->execute();
		$stmt->close();

		$connection = null;
	}
	*/

}

/***************
* EXAMPLE CODE *
***************/

// Use either this
//$test['id'] = "tt0000000";
$test['title'] = $_POST['ITEM_TITLE'];
/*
// or this, not both
$test['title'] = "Invincible";

// Alternatively a year parameter maybe included in the array if you wish, like :
$test['title'] = "something";
$test['year'] = "2009";

// Year parameter can be added to either id or title, NEVER INCLUDE BOTH ID AND TITLE

*/
// Initialize object and pass value, constructor takes care of the rest
$omdbapi = new imdb($test);

// Unset object to save system resources
$omdbapi = null;

?>