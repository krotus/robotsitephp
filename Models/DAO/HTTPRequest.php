<?php 

namespace Models\DAO;
/**
* Classe per enviar HTTP requests al Web service i realitzar les operacions basiques del CRUD.
*/
class HTTPRequest {
	const HEADER = 'Content-Type: application/json';
	private $method;
	private $data;
	private $url;
	private $curlHandler;
	private $output;
	
	function __construct($url,$method,$data = null)	{

		$this->setMethod($method);
		$this->setUrl($url);
		if (!is_null($data)) {
			$this->setData($data);
		}

	}

	//inicialitza envia la request
	public static function sendHTTPRequest() {
		$method = strtoupper($this->getMethod());
		switch ($method) {
			case 'GET':
				sendGetReq();
				break;
			case 'POST':
				sendPostReq();
				break;
			case 'PUT':
				sendPutReq();
				break;
			case 'DELETE':
				sendDeleteReq();
				break;
			default:
				//tractament de errors?
				break;
		}
	}


    private function initRequestParameters() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->getUrl());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$this->setCurlHandler($ch);
	}

	private function sendGetReq() {

		initRequestParameters();
		// execute the request
		$ch = $this->getCurlHandler();
		$output = curl_exec($ch);
		// close curl resource to free up system resources
		curl_close($ch);
		// output the profile information - includes the header
		$this->setOutput($output);
		return validateResponse();
	}

	//se li ha de passar com a parametre un json en format string
	//ex:$data_string = json_encode($data); on data es un array.
	function sendPostReq() {
		// set up the curl resource
		initRequestParameters();
		$ch = $this->getCurlHandler();
		// s'ha de passar a string les dades abans de ser enviades en POST o PUT
		$data = $this->getData();
		if (!is_null($data)) {
			if (is_array($data) || is_object($data)) {
				$data_string = json_encode($data);
			} else {
				$data_string = $data;
			}
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			    self::HEADER,                                                                                
			    'Content-Length: ' . strlen($data_string)                                                                       
			));       
			// execute the request
			$output = curl_exec($ch);
			// close curl resource to free up system resources
			curl_close($ch);
			// output the profile information - includes the header
			//echo($output) . PHP_EOL;
			$this->setOutput($output);
			return validateResponse();
		}
	}


	//se li ha de passar com a parametre un json en format string
	//ex:$data_string = json_encode($data); on data es un array.
	function sendPutReq() {
		// set up the curl resource
		initRequestParameters();
		$ch = $this->getCurlHandler();
		// s'ha de passar a string les dades abans de ser enviades en POST o PUT
		$data = $this->getData();
		if (!is_null($data)) {
			if (is_array($data) || is_object($data)) {
				$data_string = json_encode($data);
			} else {
				$data_string = $data;
			}
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			    self::HEADER,                                                                                
			    'Content-Length: ' . strlen($data_string)                                                                       
			));       
			// execute the request
			$output = curl_exec($ch);
			// close curl resource to free up system resources
			curl_close($ch);
			// output the profile information - includes the header
			//echo($output) . PHP_EOL;
			$this->setOutput($output);
			return validateResponse();
		}
	}


	function sendDeleteReq() {
		// set up the curl resource
		initRequestParameters();
		$ch = $this->getCurlHandler();
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		// execute the request
		$output = curl_exec($ch);

		// output the profile information - includes the header
		//echo($output) . PHP_EOL;
		// close curl resource to free up system resources
		curl_close($ch);
		$this->setOutput($output);
		return validateResponse();
	}

	function validateResponse()	{
		$output = $this->getOutput();
		if ($output["state"] == 200) {
			return $output;
		} else {
			throw new Exception($output["state"]);
		}
	}


    public function getMethod() {
        return $this->method;
    }


    public function setMethod($method) {
        $this->method = $method;
    }


    public function getData() {
        return $this->data;
    }


    public function setData($data) {
        $this->data = $data;

        return $this;
    }


    public function getUrl() {
        return $this->url;
    }


    public function setUrl($url) {
        $this->url = $url;
    }


    public function getCurlHandler() {
        return $this->curlHandler;
    }

  
    public function setCurlHandler($curlHandler) {
        $this->curlHandler = $curlHandler;
    }


    public function getOutput() {
        return $this->output;
    }


    public function setOutput($output) {
        $this->output = $output;
    }
}
 ?>