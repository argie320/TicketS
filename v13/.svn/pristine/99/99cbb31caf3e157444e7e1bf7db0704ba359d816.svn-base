<?php

class DB {

    public $dbhandler;
    public $query;
    private static $_instance;

    private function __construct(){
        try{
            $this->dbhandler = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE.'',''.DB_USER.'', ''.DB_PASSWORD.'' );
            $this->dbhandler->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }catch(PDOException $error){
            echo "Unexpected Error: ".$error."";
        }

    }

    public static function getInstance(){
        if(! isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql){
        return $this->dbhandler->query($sql);
    }

    public function prepare($sql){
        return $this->dbhandler->prepare($sql);
    }

    public function getResult($query){
        $this->query = $query;
    }

    public function mBeginTransaction(){
        /* Begin a transaction, turning off autocommit */
        $this->dbhandler->beginTransaction();
    }

    public function mRollBack(){
        /* Recognize mistake and roll back changes */
        $this->dbhandler->rollBack();
    }

    public function mCommit(){
        $this->dbhandler->commit();
    }

}


?>