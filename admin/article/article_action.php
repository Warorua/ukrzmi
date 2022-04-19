<?php
include '../includes/conn.php';
session_start();

$conn = $pdo->open();

if(!isset($_GET['action']) && !isset( $_GET['id'])){
    $_SESSION['error'] = 'Error processing your action!';
    header('location:../home.php');
}
else{
    $action = $_GET['action'];
    $id = $_GET['id'];

    $stmt = $conn->prepare("UPDATE news SET hide_status=:hide_status WHERE id=:id");
    $stmt->execute(['hide_status'=>$action, 'id'=>$id]);
    $_SESSION['success'] = 'Article status successfully set!';
    header('location:../home.php');

}
?>