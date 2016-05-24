<?php 

namespace Models\Business;

use Models\Business\DataObject as DataObject;

class Language extends DataObject{

	public function __construct($id = null, $code = null, $description = null){
        $this->setId($id);
        $this->setCode($code);
        $this->setDescription($description);
	}

    function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
    }

    function getDescription() {
        return $this->description;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setDescription($description) {
        $this->description = $description;
    }
}

?>
