<?php
//header('Content-Type: text/html; charset=utf-8');

define('DBNAME',$_SERVER['DBNAME']);
define('HOST',$_SERVER['HOSTNAME']);
define('USERNAME',$_SERVER['USERNAME']);
define('PASSWORD',$_SERVER['USER_PASSWORD']);



Class Database{
 
		private $server = 'mysql:host='.HOST.';dbname='.DBNAME;
	private $username = USERNAME;
	private $password = PASSWORD;
private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4");	protected $conn;
 	
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


function generate_code()
{
	$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$code = substr(str_shuffle($set), 0, 12);
	return $code;
}

function download_image($image)
{
	$url = $image;
	$sub_1 = "";
	$sub_2 = "";
	$ar_error = "";
	$gen = 'prav' . time() . generate_code();
	$filee = basename($url);
	$ext = pathinfo($filee, PATHINFO_EXTENSION);
	$img = $gen . "." . $ext;
	$path = '../images/' . $img;
	if($url == null || $url == ''){
		$url = 'https://yes-ukraine.org/imglib/_newimage/Yalta-annual-meeting/2019/partneri/media-partneri/yevropeyska-pravda/european_pravda.png';
	}else{
		$url = $url;
	}
	file_put_contents($path, file_get_contents($url));
	$filename = $img;
	 return $filename;
}

$sub_1 = '';
$sub_2 = '';
$ar_error = '';
 
?>