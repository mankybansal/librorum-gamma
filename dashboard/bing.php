<?php



class bingImageScraper
{
	private $acctKey = "cL7Nvm4lNgbLDiB4t7V0WjMmUOYXyGw473gU9J0e7kk=";
	private $rootUri = "https://api.datamarket.azure.com/Bing/Search";
	private $service = "Image";
	private $format = "json";
	private $filters = "Size:Medium+Aspect:Square";
	private $query;
	private $response;
	private $imageFolder;

	function __construct($q)
	{
		$this->imageFolder = $q;
		$this->query = urlencode($q);
		$this->filters = urlencode($this->filters);

		// Call URI construct function
		$this->buildQuery();

		// Get Response
		$this->getResponse();

		// Download images
		$this->getImages();
	}

	function buildQuery()
	{
		$this->query = $this->rootUri."/".$this->service."?\$format=".$this->format."&Query=%27".$this->query."%27"."&ImageFilters=%27".$this->filters."%27";
		echo $this->query."<br /><br />";
	}

	function getResponse()
	{
		$process = curl_init($this->query);
		curl_setopt($process, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($process, CURLOPT_USERPWD,  "$this->acctKey:$this->acctKey");
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($process);
		$response = json_decode($response, true);

		for($i=0;$i<5;$i++)
		{
			$this->response[$i] = $response['d']['results'][$i]['MediaUrl'];
		}
		
		foreach($this->response as $key => $value)
			echo $key." => ".$value."<br />";
	}

	function getImages()
	{
		for($i=0;$i<5;$i++)
		{
			$source = $this->response[$i];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $source);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			//curl_setopt($ch, CURLOPT_SSLVERSION,3);
			$data = curl_exec ($ch);
			$error = curl_error($ch); 
			curl_close ($ch);

			$rand = substr(md5(microtime()),rand(0,26),5);
			$destination = "".$this->imageFolder;
			if($i==0) mkdir($destination,0777,true);
			$destination = $destination."/".$rand.".jpg";
			echo $destination."<br />";
			$file = fopen($destination, "w+");
			fputs($file, $data);
			fclose($file);
		}

		
	}
}

$query = "Apple";
$imageScraper = new bingImageScraper($query);
$imageScraper = null;

?>
