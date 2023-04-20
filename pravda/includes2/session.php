<?php
	include 'includes2/conn.php';
	session_start();
	
date_default_timezone_set("Europe/Kiev");
	if(isset($_SESSION['admin'])){
		header('location: admin/home.php');
	}

	if(isset($_SESSION['user'])){
		$conn = $pdo->open();

		try{
			$stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
			$stmt->execute(['id'=>$_SESSION['user']]);
			$user = $stmt->fetch();
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}
		

		$pdo->close();
	}

	
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
	file_put_contents($path, file_get_contents($url));
	$filename = $img;
	 return $filename;
}
?>