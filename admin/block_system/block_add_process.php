<?php
include '../includes/conn.php';
session_start();
if(!isset($_POST['title'])){
    $_SESSION['error'] = 'Invalid request!';
    header('location: ../home.php');
}

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM blocks WHERE position=:position");
$stmt->execute(['position'=>$_POST['position']]);
$position_auth = $stmt->fetch();
if($position_auth['numrows'] > 0){
    $_SESSION['error'] = 'Block position is already occupied!';
    header('location: ../block_view.php');
}
else{
$title = $_POST['title'];
$color = $_POST['color'];
$size = $_POST['size'];
$position = $_POST['position'];
$status  = $_POST['status'];
$created_on = date('r');
$type = $_POST['type'];


$stmt = $conn->prepare("INSERT INTO blocks (name, articles, position, bg_color, active, created_on, type) VALUES (:name, :articles, :position, :bg_color, :active, :created_on, :type)");
$stmt->execute(['name'=>$title, 'created_on'=>$created_on, 'articles'=>$size, 'position'=>$position, 'active'=>$status, 'bg_color'=>$color, 'type'=>$type]);

$_SESSION['success'] = 'Block has been created successfully.';
header('location: ../block_view.php');
}
?>