<?php

namespace Models\Business;

use Models\DAO\HTTPRequest as HTTPRequest;
use Models\DAO\UserDAO as UserDAO;
use Models\Business\DataObject as DataObject;
use App\Utility\Debug as Debug;

/**
 * Classe abstracta User, hereta de DataObject i permet gestionar el CRUD de la taula workers a partir 
 * dels seus metodes i atributs.
 * S'utilitza per gestionar els usuaris de l'aplicació per ser posteriorment distribuïts en: administradors o treballadors
 * @package \Models\Business
 */
class User extends DataObject {

    protected $id;
    protected $username;
    protected $password;
    protected $nif;
    protected $name;
    protected $surname;
    protected $mobile;
    protected $telephone;
    protected $category;
    protected $team;
    protected $isAdmin;
    protected $language;

    function __construct($id = null, $username = null, $password = null, $nif = null, $name = null, $surname = null, $mobile = null, $telephone = null, $category = null, $team = null, $isAdmin = null, $language = null) {
        $this->setId($id);
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setIsAdmin($isAdmin);
        $this->setNif($nif);
        $this->setName($name);
        $this->setSurname($surname);
        $this->setMobile($mobile);
        $this->setTelephone($telephone);
        $this->setCategory($category);
        $this->setTeam($team);
        $this->setLanguage($language);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        if (strlen($password) == 40) {
            $this->password = $password;
        } else {
            $this->password = sha1($password);
        }
    }
    
    function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
    }
    
    function getIsAdmin() {
        return $this->isAdmin;
    }

    public function getNif() {
        return $this->nif;
    }

    public function setNif($nif) {
        $this->nif = $nif;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
    }

    public function getMobile() {
        return $this->mobile;
    }

    public function setMobile($mobile) {
        $this->mobile = $mobile;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getTeam() {
        return $this->team;
    }

    public function setTeam($team) {
        $this->team = $team;
    }
/**
 * Metode que autentica que un usuari i contrasenya existeix a la base de dades.
 * @return boolean
 */
    public function authenticate() {
        $userDAO = new UserDAO();
        $users = $userDAO->getAll();
        $valid = false;
        if (!empty($users)) {
            foreach ($users as $user) {
                if ($this->getUsername() == $user->getUsername() && $this->getPassword() == $user->getPassword()) {
                    $this->setId($user->getId());
                    $this->setIsAdmin($user->getIsAdmin());
                    $valid = true;
                    break;
                }
            }
        }
        return $valid;
    }
    /**
     * Metode que tanca la sessió de l'usuari
     */
    public function logout(){
        Session::destroy('user');
    }
    /**
     * Metode que a partir d'un objecte crea un json.
     * @return json
     */
    public function toJson() {
        return json_encode($this);
    }

    public function getLanguage(){
        return $this->language;
    }

    public function setLanguage($language){
        $this->language = $language;
    }

}

?>
