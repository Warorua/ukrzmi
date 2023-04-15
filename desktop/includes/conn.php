<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php';


$detect = new Mobile_Detect;
if ( $detect->isMobile() ) {
	//echo 'You are on MOBILE';
	header('location:../mobile/home.php');
  }
else{
	//echo '<script>alert("WELCOME DESKTOP")</script>';
}
set_time_limit(500); // 


define('DBNAME',$_SERVER['DBNAME']);
define('HOST',$_SERVER['HOSTNAME']);
define('USERNAME',$_SERVER['USERNAME']);
define('PASSWORD',$_SERVER['USER_PASSWORD']);


Class Database{
	
	private $server = 'mysql:host='.HOST.';dbname='.DBNAME;
	private $username = USERNAME;
	private $password = PASSWORD;
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET UTF8",);
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
 
/*
Username:ukrzmico_ukrzmi
Database:ukrzmico_ukrzmi
Password:vs]gmsqr1M]7
*/
?>
