<?php
include '../includes/conn.php';
session_start();
if(!isset($_POST['title'])){
    $_SESSION['error'] = 'Invalid request!';
    header('location: ../home.php');
}

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM blocks WHERE id=:id");
$stmt->execute(['id'=>$_POST['id']]);
$data = $stmt->fetch();

if($data['page'] == $_POST['page' && $data['position'] == $_POST['position']]){
$checkk = '';
}
else{
$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM blocks WHERE position=:position AND page=:page");
$stmt->execute(['position'=>$_POST['position'], 'page'=>$_POST['page']]);
$position_auth = $stmt->fetch();
if($position_auth['numrows'] > 0){
    $_SESSION['error'] = 'Block position is already occupied!';
    header('location: ../block_view.php');
}
}



$title = $_POST['title'];
$color = $_POST['color'];
$size = $_POST['size'];
$position = $_POST['position'];
$status  = $_POST['status'];
$created_on = date('r');
$type = $_POST['type'];
$speed = $_POST['speed']*1000;
$page =  $_POST['page'];

if($_POST['sub_cat'] == 0){
    $sub_cat = "";  
}
else{
  $sub_cat =  $_POST['sub_cat'];
}


if($_POST['content'] == 0){
    $content = "";  
}
else{
  $content =  $_POST['content'];
}


if($_POST['city'] == 0){
    $city =  "";  
}
else{
  $city =  $_POST['city'];  
}

if($data['logo'] == $_FILES['image']['name']){
    $filename = $data['logo'];
}
else{
    $photo = $_FILES['image']['name'];
  $photo_path = realpath($_FILES['image']['name']);
$ext = pathinfo($photo, PATHINFO_EXTENSION);
			$time_id = time();
			$the_id = sha1($time_id);
			$new_filename = $the_id.'.'.$ext;
			move_uploaded_file($_FILES['image']['tmp_name'], '../components/logos/'.$new_filename);
$filename = $new_filename;
}

$mode = 'thematic';


$stmt = $conn->prepare("UPDATE blocks SET name=:name, articles=:articles, position=:position, bg_color=:bg_color, active=:active, created_on=:created_on, type=:type, page=:page, sub_cat=:sub_cat, content=:content, city=:city, logo=:logo, mode=:mode, speed=:speed WHERE id=:id");
$stmt->execute(['name'=>$title, 'created_on'=>$created_on, 'articles'=>$size, 'position'=>$position, 'active'=>$status, 'bg_color'=>$color, 'type'=>$type, 'page'=>$page, 'sub_cat'=>$sub_cat, 'content'=>$content, 'city'=>$city, 'logo'=>$filename, 'mode'=>$mode, 'speed'=>$speed, 'id'=>$_POST['id']]);

$_SESSION['success'] = 'Thematic block has been updated successfully.';
header('location: ../block_view.php');

?>