<?php

/************
* AUTHOR(S) *
*************
**********************************************
* Code written by Arjhun Srinivas			 *
* Date of creation : 01-Feb-2015			 *
* Last modified : 028-Apr-2015				 *
* Last modofied by : Arjhun Srinivas		 *
* Written for Liborum, The Sharing Community *
* E-mail : arjhun[dot]s[at]gmail[dot]com 	 *
*********************************************/

/************************
* REQUIRED DEPENDENCIES *
************************/
require_once "vendor/autoload.php";

use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\ApaiIO;
use ApaiIO\Operations\Lookup;

/********************
* CLASS DEFINITIONS *
********************/
class connection
{
	public $host ="localhost";
	public $user = "root"; 
	public $password = '$haringan';
	public $db="isbn";
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

class isbn
{
	private $data = array();
	private $stats = array();
	private $response;
	private $error = array();

	function __construct($isbn)
	{
		$this->data['isbn'] = $isbn;

		// Call lookup function
		$this->lookup();

		// Call error check function before extr() and write()
		if($this->error_check() == 0)
		{
			// Call extract function for data and stats
			$this->extr();

			// Insert data into DB
			if(!array_key_exists('ASIN',$this->response['Items']['Item']))
			{
				$this->write(count($this->data) - 1);
			}
			else
			{
				$this->write(1);
			}
		}
	}

	function __destruct()
	{
		// Include code for collection of statistics
	}

	function lookup()
	{
		$conf = new GenericConfiguration();

		$conf	->setCountry('in')
			->setAccessKey('AKIAJYPGB6FGVI3SC2GA')
			->setSecretKey('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')
			->setAssociateTag('librorum-21')
			->setRequest('\ApaiIO\Request\Soap\Request')
			->setResponseTransformer('\ApaiIO\ResponseTransformer\ObjectToArray');

		$lookup = new Lookup();
		$lookup->setItemId($this->data['isbn']);
		$lookup->setIdType('ISBN');
		$lookup->setSearchIndex('Books');
		$lookup->setResponseGroup(array('Small', 'ItemAttributes', 'EditorialReview', 'Images'));
	
		// Making the request to AWS
		$apaiIo = new ApaiIO($conf);
		$this->response = $apaiIo->runOperation($lookup);
	
		//print_r($this->response);
	}

	function error_check()
	{
		$check_data = $this->response['Items']['Request'];
		if(array_key_exists('Errors', $check_data))
		{
			if(array_key_exists('Error', $check_data['Errors']))
			{
				$this->error['IdType'] = $check_data['ItemLookupRequest']['IdType'];
				$this->error['ItemId'] = $check_data['ItemLookupRequest']['ItemId'];
				$this->error['SearchIndex'] = $check_data['ItemLookupRequest']['SearchIndex'];
				$this->error['ErrorCode'] = $check_data['Errors']['Error']['Code'];
				$this->error['Message'] = $check_data['Errors']['Error']['Message'];

				/*foreach ($this->error as $key => $value)
				{
					echo PHP_EOL.$key." => ".$value;
				}*/

				// Insert error data into 
				$connection = new connection();
				$query = "INSERT INTO error_log(IdType,ItemId,SearchIndex,ErrorCode,Message) VALUES(?,?,?,?,?)";
				$stmt = $connection->dbc->prepare($query);
				
				$stmt->bind_param('sssss',
					$this->error['IdType'],
					$this->error['ItemId'],
					$this->error['SearchIndex'],
					$this->error['ErrorCode'],
					$this->error['Message']);

				$stmt->execute();
				$stmt->close();
				$connection = null;

				return 1;
			}
		}
		else
			return 0;
	}

	function extr()
	{
		$i = 0;

		$temp = $this->response['Items']['Item'];

		if(!array_key_exists('ASIN', $temp))
		{
			while($i < count($temp))
			{
				$tmp = $this->response['Items']['Item'][$i];			

				// Find required values
				foreach($tmp as $key => $val)
				{
					if($key == "ASIN" || $key == "DetailPageURL")
					{
						$this->data[$i][$key] = $val;
					}

					if($key == "LargeImage")
					{
						$this->data[$i]['Image'] = $tmp[$key]['URL'];
					}

					if($key == "ItemAttributes")
					{
						$this->data[$i]['Author'] = $tmp[$key]['Author'];
						$this->data[$i]['isbn_10'] = $tmp[$key]['ISBN'];
						$this->data[$i]['Publisher'] = $tmp[$key]['Publisher'];
						$this->data[$i]['Title'] = $tmp[$key]['Title'];
						$thi->data['isbn'] = $tmp[$key]['EAN'];
					}
					if($key == "EditorialReviews")
					{
						$this->data[$i]['EditorialReview'] = $tmp[$key]['EditorialReview']['Content'];
					}
				}

				$i++;
			}
		}
		else
		{
			foreach($temp as $key => $val)
			{
				if($key == "ASIN" || $key == "DetailPageURL")
				{
					$this->data[$key] = $val;
				}

				if($key == "LargeImage")
				{
					$this->data['Image'] = $temp[$key]['URL'];
				}

				if($key == "ItemAttributes")
				{
					$this->data['Author'] = $temp[$key]['Author'];
					$this->data['isbn_10'] = $temp[$key]['ISBN'];
					$this->data['Publisher'] = $temp[$key]['Publisher'];
					$this->data['Title'] = $temp[$key]['Title'];
					$this->data['isbn'] = $temp[$key]['EAN'];
				}
				if($key == "EditorialReviews")
				{
					$this->data['EditorialReview'] = $temp[$key]['EditorialReview']['Content'];
				}
			}
		}

		echo (json_encode($this->data));
	}

	function write($count)
	{
		$i = 0;
		$connection = new connection();
		$query = "INSERT INTO data(isbn_13,isbn_10,asin,title,author,publisher,url,EditorialReview,Image) VALUES(?,?,?,?,?,?,?,?,?)";
		if($count > 1)
		{
			while($i < $count)
			{
				$stmt = $connection->dbc->prepare($query);
				$stmt->bind_param('sssssssss',
					$this->data['isbn'],
					$this->data[$i]['isbn_10'],
					$this->data[$i]['ASIN'],
					$this->data[$i]['Title'],
					$this->data[$i]['Author'],
					$this->data[$i]['Publisher'],
					$this->data[$i]['DetailPageURL'],
					$this->data[$i]['EditorialReview'],
					$this->data[$i]['Image']
				);
				$stmt->execute();

				$i++;
			}
		}
		else
		{
			$stmt = $connection->dbc->prepare($query);
			$stmt->bind_param('sssssssss',
				$this->data['isbn'],
				$this->data['isbn_10'],
				$this->data['ASIN'],
				$this->data['Title'],
				$this->data['Author'],
				$this->data['Publisher'],
				$this->data['DetailPageURL'],
				$this->data['EditorialReview'],
				$this->data['Image']
			);
			$stmt->execute();
		}

		$stmt->close();
	}
}

/*********************************************
* SECTION RESERVED FOR PARALLEL PROCESSING   *
**********************************************
// Execute process
function isbn_start($job)
{
	$obj = new isbn($job->workload());
	$obj = null;
}

// Set Gearman worker node
$worker = new GearmanWorker();
$worker->addServer();
$worker->addFunction("isbn", "isbn_start");

while($worker->work());
*/

/****************
* USAGE EXAMPLE *
****************/

// Create object and pass ISBN-10 or ISBN-13 value

$isbn_number = '9781780220253';
$obj = new isbn($isbn_number);

// The constructor of the isbn class processes everthing
// Destroy object to save memory space

$obj = null;
?>
