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
	
	function __construct($url = null,$method = null,$data = null)	{

			$this->setUrl($url);
			$this->setMethod($method);
			if (!is_null($data)) {
				$this->setData($data);
			}
	}

	//inicialitza envia la request
	public function sendHTTPRequest() {
		$method = strtoupper($this->getMethod());
		switch ($method) {
			case 'GET':
				$output = $this->sendGetReq();
				break;
			case 'POST':
				$output = $this->sendPostReq();
				break;
			case 'PUT':
				$output = $this->sendPutReq();
				break;
			case 'DELETE':
				$output = $this->sendDeleteReq();
				break;
			default:
				//tractament de errors?
				break;
		}
		return $output;
	}


    private function initRequestParameters() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->getUrl());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$this->setCurlHandler($ch);
                
	}

	private function sendGetReq() {

		$this->initRequestParameters();
		// execute the request
		$ch = $this->getCurlHandler();
		$output = json_decode(curl_exec($ch), true);
		// close curl resource to free up system resources
		curl_close($ch);
		// output the profile information - includes the header
		$this->setOutput($output);
		//var_dump($output);
		return $this->validateResponse();
	}

	//se li ha de passar com a parametre un json en format string
	//ex:$data_string = json_encode($data); on data es un array.
	private function sendPostReq() {
		// set up the curl resource
		$this->initRequestParameters();
		$ch = $this->getCurlHandler();
		// s'ha de passar a string les dades abans de ser enviades en POST o PUT
		$data = $this->getData();
		if (!is_null($data)) {
			$data_string = json_encode($data->objectToArray($data));
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			    self::HEADER,                                                                                
			    'Content-Length: ' . strlen($data_string)                                                                       
			));       
			// execute the request
			$output = json_decode(curl_exec($ch), true);
			//var_dump(curl_exec($ch));
			// close curl resource to free up system resources
			curl_close($ch);
			// output the profile information - includes the header
			//echo($output) . PHP_EOL;
			$this->setOutput($output);
			return $this->validateResponse();
		}
	}


	//se li ha de passar com a parametre un json en format string
	//ex:$data_string = json_encode($data); on data es un array.
	private function sendPutReq() {
		// set up the curl resource
		$this->initRequestParameters();
		$ch = $this->getCurlHandler();
		// s'ha de passar a string les dades abans de ser enviades en POST o PUT
		$data = $this->getData();
		if (!is_null($data)) {
			$data_string = json_encode($data->objectToArray($data));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			    self::HEADER,                                                                                
			    'Content-Length: ' . strlen($data_string)                                                                       
			));       
			// execute the request
			$output = json_decode(curl_exec($ch), true);
			// close curl resource to free up system resources
			curl_close($ch);
			// output the profile information - includes the header
			//echo($output) . PHP_EOL;
			$this->setOutput($output);
			return $this->validateResponse();
		}
	}


	private function sendDeleteReq() {
		// set up the curl resource
		$this->initRequestParameters();
		$ch = $this->getCurlHandler();
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		// execute the request
		$output = json_decode(curl_exec($ch), true);
		// output the profile information - includes the header
		//echo($output) . PHP_EOL;
		// close curl resource to free up system resources
		curl_close($ch);
		$this->setOutput($output);
		return $this->validateResponse();
	}

	private function validateResponse()	{
		$output = $this->getOutput();
                //exit;
		if ($output["state"] == 200) {
                    return $output["data"];
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