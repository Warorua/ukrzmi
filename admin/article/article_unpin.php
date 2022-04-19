<?php
include '../includes/conn.php';
session_start();

$conn = $pdo->open();

if(!isset( $_GET['id'])){
    $_SESSION['error'] = 'Error processing your action!';
    header('location:../home.php');
}
else{
    $id = $_GET['id'];

    $stmt = $conn->prepare("UPDATE news SET pin=:pin WHERE id=:id");
    $stmt->execute(['pin'=>0, 'id'=>$id]);

    $stmt = $conn->prepare("DELETE FROM pinned WHERE card_id=:id");
    $stmt->execute(['id'=>$id]);


    $_SESSION['success'] = 'Article status successfully set!';
    header('location:../home.php');

}
?>