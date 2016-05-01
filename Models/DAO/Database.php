<?php 

namespace Models\DAO;

class Database extends PDO{

    public function __construct(){
      $dsn = 'mysql:dbname=' . $GLOBALS['DBNAME'] . ';host=' . $GLOBALS['SERVER'];
      $user = $GLOBALS['USERNAME'];
      $pw = $GLOBALS['PASSWORD'];
      $arrayopt = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES, false
        );
      try{ 
        parent::__construct($dsn, $user, $pw, $arrayopt);
      }catch (PDOException $e){
        die($e->getMessage());
      }
    }

    public function getNumRows($query){
        $stmt = $this->prepare($query);

        if($stmt){
            $stmt->execute();
            return $stmt->rowCount();
        }else{
            return self::get_error();
        }
    }

    public function getError(){
        $this->connection->errorInfo();
    }

    public function __destruct(){
        $this->connection = null;
    }
}

?>