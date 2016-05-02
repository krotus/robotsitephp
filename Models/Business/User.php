<?php 

namespace Models\Business;

class User{

	private $id;
	private $username;
	private $password;
	private $isAdmin;


	public function __construct(){

	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}


	public function getUsername(){
		return $this->username;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		if(strlen($password) == 40){
			$this->password = $password;
		}else{
			$this->password = sha1($password);
		}
	}

	public function getIsAdmin(){
		return $this->isAdmin;
	}

	public function setIsAdmin($isAdmin){
		$this->isAdmin = $isAdmin;
	}


}


?>