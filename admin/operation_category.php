<?php
set_time_limit(500); // 

Class Database{
 
	private $server = "mysql:host=localhost;dbname=ukrzmico_good";
	private $username = "ukrzmico_miamivice";
	private $password = "vs]gmsqr1M]7";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES cp1251",);
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
 

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT DISTINCT category FROM news");
$stmt->execute();
$op1 = $stmt->fetchAll();
foreach($op1 as $row){
    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM category WHERE name=:name");
   $stmt->execute(['name'=>$row['category']]);  
   $auth = $stmt->fetch();

   if($auth['numrows'] > 0){
   echo 'Already in the DB!!!<br/>';
   }
   else{
    $stmt = $conn->prepare("INSERT INTO category (name) VALUES (:name)");
    $stmt->execute(['name'=>$row['category']]);  
    echo 'Inserted!!!<br/>';
}
}

echo 'finished!!!';

?>