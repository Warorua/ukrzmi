<?php
set_time_limit(500); // 

define('DBNAME',$_SERVER['DBNAME']);
define('HOST',$_SERVER['HOSTNAME']);
define('USERNAME',$_SERVER['USERNAME']);
define('PASSWORD',$_SERVER['USER_PASSWORD']);



Class Database{
 
	private $server = 'mysql:host='.HOST.';dbname='.DBNAME;
	private $username = USERNAME;
	private $password = PASSWORD;
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	protected $conn;
 	
	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
 			return $this->conn;
 		}
 		catch (PDOException $e){
 			echo "There is some problem in connection: " . $e->getMessage();
 		}
 
    }
 
	public function close(){
   		$this->conn = null;
 	}
 
}

$pdo = new Database();
 
?>