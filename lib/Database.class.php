<?php

class Database extends PDO {
    protected static $instance;
    protected $cache;
    
    public static function getInstance($dsn = NULL, $dbname = NULL, $dbpass = NULL) {
        if(!self::$instance) {
            self::$instance = new Database($dsn,$dbname,$dbpass);
        }
        return self::$instance;
    }
	
    function __construct($dsn,$dbname,$dbpass) {
        parent::__construct($dsn,$dbname,$dbpass);
        $this->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);   
        $this->cache = array();
        
    }
    
    function getPreparedStatment($query){
        $hash = md5($query);
        if(!isset($this->cache[$hash])){
            $this->cache[$hash] = $this->prepare($query);
        }
        return $this->cache[$hash];
    }
    
    function __destruct(){
        $this->cache = NULL;
    }
}

?>