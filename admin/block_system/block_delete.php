<?php
include '../includes/conn.php';
session_start();
if(!isset($_GET['id'])){
    $_SESSION['error'] = 'Invalid delete request';
    header('location: ../block_view.php');
}
else{
    $conn = $pdo->open();
    $stmt = $conn->prepare("DELETE FROM blocks WHERE id=:id");
    $stmt->execute(['id'=>$_GET['id']]);

    $_SESSION['success'] = 'Block deleted successfully';
    header('location: ../block_view.php');
}

?>