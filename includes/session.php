<?php
	include 'includes/conn.php';
	session_start();
	

date_default_timezone_set("Europe/Kiev");
	if(isset($_SESSION['admin'])){
		header('location: admin/home.php');
	}

date_default_timezone_set("Africa/Nairobi");


		$conn = $pdo->open();
		

		$pdo->close();

?>