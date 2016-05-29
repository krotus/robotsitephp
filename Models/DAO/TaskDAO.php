<?php 

namespace Models\DAO;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\AbstractDAO as AbstractDAO;
use Models\Business\Team as Team;
use Models\Business\Worker as Worker;
use Models\Business\Order as Order;
use App\Utility\Debug as Debug;

/**
conte tota la funcionalitat associada a les tasques.

exten de AbstractDAO per tant pot accedir a tots els seus metodes o sobreescriure'ls.

@package Models\DAO\TaskDAO
*/
class TaskDAO extends AbstractDAO{
	/**
	attribut HTTPRequest es una instanciacio de la clase HTTPRequest per poder fer us dels metodes de la clase.
	*/
	private $HTTPRequest;

	public function __construct(){
		$this->HTTPRequest = new HTTPRequest();
	}

	/**
	metode sobreescrit del metode getById del AbstractDAO.

	realitza una peticio GET per obtenir un Task a partir de la id.

	@param int id del Task.
	@return array un array emplenat amb objectes Task.
	*/
	public function getById($id){
		$url = WEBSERVICE. "tasks/getById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToTask($arrayResponse, true);
	}
	/**
	metode sobreescrit del metode getAll del AbstractDAO.

	realitza una peticio GET per obtenir a tots els Tasks de la taula tasks del web service

	@return array un array emplenat amb objectes Task.
	*/
	public function getAll(){
		$url = WEBSERVICE. "tasks/getAll";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $this->arrayToTask($arrayResponse, false);
	}
    /**
	metode sobreescrit del metode create del AbstractDAO.

	realitza una peticio POST per inserir una task a la taula tasks del web service

	@param object un objecte task amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function create($object){
		$url = WEBSERVICE. "tasks/create";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("POST");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode update del AbstractDAO.

	realitza una peticio PUT per actualitzar una Task a la taula tasks del web service

	@param object un objecte Task amb tots els atributs emplenats.

	@return string el missatge que retorna el web service
	*/
	public function update($object){
		$id = $object->getId();
		$url = WEBSERVICE. "tasks/updateAll/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("PUT");
		$this->HTTPRequest->setData($object);
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode sobreescrit del metode delete del AbstractDAO.

	realitza una peticio DELETE per esborrar una Task de la taula Tasks del web service

	@param int la id de un Task existent a la base de dades del web service

	@return string el missatge que retorna el web service
	*/
	public function delete($id){
		$url = WEBSERVICE. "tasks/deleteById/" . $id;
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("DELETE");
		$response = $this->HTTPRequest->sendHTTPRequest();
		return $response;
	}
    /**
	metode que transforma el array de arrays a array de Tasks.

	@param int $items l'array de arrays amb les dades dels Tasks.
	@param int $foreigns si es true tornara les claus foraneas com a objectes i no com a ints(representant la id).
	@return array de objectes Tasks.
	*/
	public function arrayToTask($tasks,$foreigns = false){
		$arrayTasks = array();
		for ($i=0; $i < count($tasks); $i++) {
			$task = $this->arrayToObject($tasks[$i]);
			if($foreigns){
				$task = $this->fixForeingTask($task);
			}
			$task = $this->fixCanBeNull($task);
			array_push($arrayTasks,$task);
		}
		return $arrayTasks;
	}
    /**
	metode que transforma les id's de les claus foraneas de la task en objectes.

	@param object $task un objecte Task.
	@return object objecte task amb els atributs substituits per objectes.
	*/
	public function fixForeingTask($task){
		$team = new Team($task->getTeam());
		$team = $team->get();
		$task->setTeam($team);
		$order = new Order($task->getOrder());
		$order = $order->get();
		$task->setOrder($order);
		if($task->getWorker() != null){
        	$worker = new Worker($task->getWorker());
        	$worker = $worker->get();
        	$task->setWorker($worker);
    	}
		return $task;
	}
	/**
	metode que comproba els camps que poden ser nulls i els hi posa un espai en blanc en cas de ser-ho per evitar problemes al hora de retornar les dades

	@param object $task un objecte Task.
	@return object objecte task amb els atributs null substituits per espais en blanc.
	*/
	public function fixCanBeNull($task){
		if($task->getWorker() == null){
            $task->setWorker(new Worker(0));
        }
        if($task->getDateCompletion() == null){
        	$task->setDateCompletion("");
        }
        if($task->getJustification() == null){
        	$task->setJustification("");
        }

        return $task;
	}
	/**
	metode creat per poder obtenir totes les tasques en forma de array bidimensional, en comptes de array de objectes.
	
	aquest metode va ser creat per omplir les dataTables

	@return array un array amb arrays associatius dins amb totes les propietats
	*/
	public function getAllTasksAdmin()
	{
		$url = WEBSERVICE. "tasks/getAllTasksAdmin";
		$this->HTTPRequest->setUrl($url);
		$this->HTTPRequest->setMethod("GET");
		$arrayResponse = $this->HTTPRequest->sendHTTPRequest();
		return $arrayResponse;
	}

}


?>