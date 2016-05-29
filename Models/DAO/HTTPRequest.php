<?php

namespace Models\DAO;
use App\Utility\Debug as Debug;
/**
 * Classe per enviar HTTP requests al Web service i realitzar les operacions basiques del CRUD.
 *  @package Models\DAO\HTTPRequest
 */
class HTTPRequest {
    /**
    constant ja que estarem treballant amb JSON sempre
    */
    const HEADER = 'Content-Type: application/json';
    /**
    es guardara el metode a usar en la peticio.
    */
    private $method;
    /**
    les dades que s'hauran de enviar al web service.
    */
    private $data;
    /**
    la url a la que te que enviar la peticio HTTP.
    */
    private $url;
    /**
    el handler de la peticio HTTP servirap er poder anar construint la petició
    */
    private $curlHandler;
    /**
    aqui es guardara el que retorni la petició
    */
    private $output;

    function __construct($url = null, $method = null, $data = null) {

        $this->setUrl($url);
        $this->setMethod($method);
        if (!is_null($data)) {
            $this->setData($data);
        }
    }

    /**
    * envia la request segons el tipus de metode escollit cridara un metode diferent
    * @return resultat del web service.
    */
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
    /**
    aqui s'inicialitzen les request generals qualsevol canvi que es vulgui fer a totes les request s'ha de posar aqui.
    @param fa us de la URL settejada.
    @return CURL handler
    */
    private function initRequestParameters() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->getUrl());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $this->setCurlHandler($ch);
    }
    /**
    * realitza una peticio GET al web service.
    * @return resultat del web service.
    */
    private function sendGetReq() {

        $this->initRequestParameters();
        // execute the request
        $ch = $this->getCurlHandler();
        $output = json_decode(curl_exec($ch), true);
        // close curl resource to free up system resources
        curl_close($ch);
        // output the profile information - includes the header
        $this->setOutput($output);
        return $this->validateResponse();
    }
    /**
    realitza una peticio POST al web service.
    @param object se li ha de passar com a parametre un objecte
    @return string resultat del web service.
    */
    private function sendPostReq() {
        // set up the curl resource
        $this->initRequestParameters();
        $ch = $this->getCurlHandler();
        $data = $this->getData();
        if (!is_null($data)) {
            if (is_array($data)) {
                $data_string = json_encode($data);
            } else {
                $data_string = json_encode($data->objectToArray($data));
            }
            curl_setopt($ch, CURLOPT_POST, true);
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
    /**
    realitza una peticio PUT al web service.
    @param object se li ha de passar com a parametre un objecte
    @return string resultat del web service.
    */
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
            $this->setOutput($output);
            return $this->validateResponse();
        }
    }
    /**
    realitza una peticio DELETE al web service.
    @return string resultat del web service.
    */
    private function sendDeleteReq() {
        // set up the curl resource
        $this->initRequestParameters();
        $ch = $this->getCurlHandler();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        // execute the request
        $output = json_decode(curl_exec($ch), true);
        // output the profile information - includes the header
        // close curl resource to free up system resources
        curl_close($ch);
        $this->setOutput($output);
        return $this->validateResponse();
    }
    /**
    comproba que el resultat del web service sigui correcte.
    @throws Exception
    @return mixed resultat del web service.
    */
    private function validateResponse() {
        $output = $this->getOutput();
//        Debug::log($output);
//        exit;
        if ($output["state"] == 200) {
            return $output["data"];
        } else {
            throw new \Exception($output["state"]);
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
