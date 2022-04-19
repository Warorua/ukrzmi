<?php
	session_start();
	session_destroy();

   $_SESSION['success'] = "You have successfully logged out!";  
	header('location: login.php');
 
?>