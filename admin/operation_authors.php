<?php
set_time_limit(500); // 

Class Database{
 
	private $server = "mysql:host=localhost;dbname=tsavosto_news";
	private $username = "tsavosto_news";
	private $password = "[VLh_tR&489,";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",);
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

$stmt = $conn->prepare("SELECT DISTINCT author FROM news");
$stmt->execute();
$op1 = $stmt->fetchAll();
foreach($op1 as $row){
    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM authors WHERE name=:name");
    $stmt->execute(['name'=>$row['author']]);  
    $auth = $stmt->fetch();

    if($auth['numrows'] > 0){
    echo 'Already in the DB!!!<br/>';
    }
    else{
        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE author=:name");
        $stmt->execute(['name'=>$row['author']]);  
        $auth_ar = $stmt->fetch();

    $stmt = $conn->prepare("INSERT INTO authors (name, articles) VALUES (:name, :articles)");
    $stmt->execute(['name'=>$row['author'], 'articles'=>$auth_ar['numrows']]); 
    echo 'Inserted!!!<br/>';
    }

}

echo 'finished!!!';

?>