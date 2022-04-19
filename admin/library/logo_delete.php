<?php
include '../includes/conn.php';
session_start();
if(!isset($_GET['id'])){
    $_SESSION['error'] = 'Invalid request';
    header('location: ../logo_view.php');
}
else{
unlink('../components/logos/'.$_GET['image']);
$conn = $pdo->open();
$stmt = $conn->prepare("DELETE FROM logo WHERE id=:id");
$stmt->execute(['id'=>$_GET['id']]);

$_SESSION['success'] = 'The logo has been successfully deleted';
header('location: ../logo_view.php');
}
?>