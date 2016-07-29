<?php

namespace app\database;
use \PDO;

class Database{
	private static $db;
    private $host      = DB_HOST;
    private $user      = DB_USERNAME;
    private $pass      = DB_PASSWORD;
    private $dbname    = DB_NAME;

    private $dbh;
    private $error;
    private $stmt;
    //constructor creating conenction
    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    public static function getInstance() {
		if(self::$db)
			return self::$db;
		else
		{
			self::$db = new Database();
			return self::$db;
		}	
	}

    //function preparing the query
	public function query($query){
	    $this->stmt = $this->dbh->prepare($query);
	}

	//binding variables for execution
    public function bind($param, $value, $type = null){
	    if (is_null($type)) {
	        switch (true) {
	            case is_int($value):
	                $type = PDO::PARAM_INT;
	                break;
	            case is_bool($value):
	                $type = PDO::PARAM_BOOL;
	                break;
	            case is_null($value):
	                $type = PDO::PARAM_NULL;
	                break;
	            default:
	                $type = PDO::PARAM_STR;
	        }
	    }
	    	$this->stmt->bindValue($param, $value, $type);
	}
	//executing the query
	public function execute(){
		return $this->stmt->execute();
	}

	//fetching the data
	public function resultset(){
	    $this->execute();
	    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	//returns single record

	public function single(){
	    $this->execute();
	    return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	//returns Record count
	public function rowCount(){
	    return $this->stmt->rowCount();
	}

	//return last insert ID
	public function lastInsertId(){
	 	   return $this->dbh->lastInsertId();
	}
}

