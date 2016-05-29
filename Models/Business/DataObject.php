<?php

namespace Models\Business;

use App\Utility\Debug as Debug;

/**
 * Classe DataObject que actua com a capa de servei entre el model ORM i l'aplicació.
 * @package \Models\Business\DataObject
 */
abstract class DataObject {

    /**
     * Instancia un objecte DAO segons l'estructura de la propia classe que la crida.
     * @return object Retorna el objecte DAO instanciat.
     */
    protected function buildDAO() {
        $typeOf = get_class($this);
        $typeOf = str_replace("Business", "DAO", $typeOf);
        $typeOf .= "DAO";
        $dao = new $typeOf;
        return $dao;
    }

    /**
     * Metode getSetters que permet obtenir en un array la llista de metodes setters de la classe que la crida.
     * @return array Llista de metodes setters de la classe.
     */
    public function getSetters() {
        $settersArray = array();
        foreach ($this as $key => $value) {
            $key = ucfirst($key);
            array_push($settersArray, "set" . $key);
        }

        return $settersArray;
    }

    /**
     * Metode get, obtenim un objecte a partir del model generat.
     * @return object Objecte model
     */
    public function get() {
        $dao = $this->buildDAO();
        return $dao->getById($this->getId())[0];
    }

    /**
     * Metode getAll, obtenim una llista d'objectes a partir del model generat.
     * @return array Llista d'objectes
     */
    public function getAll() {
        $dao = $this->buildDAO();
        return $dao->getAll();
    }

    /**
     * Metode create, crea l'objecte a partir de la classe es cridada
     * @return boolean Retorna cert o fals segons l'exit de l'operació.
     */
    public function create() {
        $dao = $this->buildDAO();
        return $dao->create($this);
    }

    /**
     * Metode delete, elimina l'objecte a partir de la classe es cridada
     * @return boolean Retorna cert o fals segons l'exit de l'operació.
     */
    public function delete() {
        $dao = $this->buildDAO();
        return $dao->delete($this->getId());
    }

    /**
     * Metode update, actualitza l'objecte a partir de la classe es cridada
     * @return boolean Retorna cert o fals segons l'exit de l'operació.
     */
    public function update() {
        $dao = $this->buildDAO();
        return $dao->update($this);
    }

    /**
     * Metode objectToAarray, genera un array associatiu a partir a partir d'un objecte.
     * @param object $data Objecte a evaluar 
     * @return array Array associatiu del objecte
     */
    public function objectToArray($data) {
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = $this->objectToArray($value);
                if (is_object($result[$key])) {
                    return $this->objectToArray($result[$key]);
                }
            }
            return $result;
        }
        return $data;
    }

    //testejar.
    public function objectToInt($object) {
        $id = null;
        foreach ($object as $key => $value) {
            if (is_object($value)) {
                $id = $value->getId();
                $setter = "set" . ucfirst($key);
                $object->$setter($id);
            }
        }
        return $object;
    }

    public function toJson() {
        return json_encode($this);
    }

}

?>