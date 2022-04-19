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
    $stmt = $conn->prepare("SELECT * FROM news WHERE id=:id");
    $stmt->execute(['id'=>$id]);
    $data = $stmt->fetch();

    unlink('../../scrap2/images/'.$data['photo']);


    $stmt = $conn->prepare("DELETE FROM news WHERE id=:id");
    $stmt->execute(['id'=>$id]);

    $_SESSION['success'] = 'Article successfully deleted!';
    header('location:../home.php');

}
?>