<?php
include '../includes/conn.php';
session_start();
if(!isset($_POST['title'])){
    $_SESSION['error'] = 'Invalid request!';
    header('location: ../home.php');
}

$conn = $pdo->open();

$title = $_POST['title'];
$color = $_POST['color'];
$size = $_POST['size'];
$position = $_POST['position'];
$status  = $_POST['status'];
$type = $_POST['type'];
$id = $_POST['id'];

$stmt = $conn->prepare("SELECT * FROM blocks WHERE id=:id");
$stmt->execute(['id'=>$id]);
$position_auth_1 = $stmt->fetch();

$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM blocks WHERE position=:position");
$stmt->execute(['position'=>$position]);
$position_auth = $stmt->fetch();
if($position_auth_1['position'] != $position && $position != 404){
    if($position_auth['numrows'] > 0 ){
          $_SESSION['error'] = 'Block position is already occupied!';
    header('location: ../block_edit.php?id='.$id);
    }
    else{
$stmt = $conn->prepare("UPDATE blocks SET name=:name, articles=:articles, position=:position, bg_color=:bg_color, active=:active, type=:type WHERE id=:id");
$stmt->execute(['name'=>$title, 'articles'=>$size, 'position'=>$position, 'active'=>$status, 'bg_color'=>$color, 'type'=>$type, 'id'=>$id]);

$_SESSION['success'] = 'Block has been updated successfully.';
header('location: ../block_view.php');
    }
  
}
else{

$stmt = $conn->prepare("UPDATE blocks SET name=:name, articles=:articles, position=:position, bg_color=:bg_color, active=:active, type=:type WHERE id=:id");
$stmt->execute(['name'=>$title, 'articles'=>$size, 'position'=>$position, 'active'=>$status, 'bg_color'=>$color, 'type'=>$type, 'id'=>$id]);

$_SESSION['success'] = 'Block has been updated successfully.';
header('location: ../block_view.php');
}
?>