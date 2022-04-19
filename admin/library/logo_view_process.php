<?php
include '../includes/conn.php';
session_start();
if(!isset($_POST['logo'])){
    $_SESSION['error'] = 'Invalid request';
    header('location: ../logo_view.php');
}
else{
  $name = $_POST['name'];

  $width = $_POST['width'];
  $height = $_POST['height'];
  $size = $_POST['filesize'];
  $source = $_POST['source'];
  $type = $_POST['type'];


  $photo = $_FILES['image']['name'];
  $photo_path = realpath($_FILES['image']['name']);
$ext = pathinfo($photo, PATHINFO_EXTENSION);
			$time_id = time();
			$the_id = sha1($time_id);
			$new_filename = $the_id.'.'.$ext;
			move_uploaded_file($_FILES['image']['tmp_name'], '../components/logos/'.$new_filename);
			$filename = $new_filename;
  $conn = $pdo->open();
  $stmt = $conn->prepare("INSERT INTO logo (name, image, height, width, size, source, type) VALUES (:name, :image, :height, :width, :size, :source, :type)");
  $stmt->execute(['name'=>$name, 'image'=>$filename, 'height'=>$height, 'width'=>$width, 'size'=>$size, 'source'=>$source, 'type'=>$type]);
  
  
  $_SESSION['success'] = 'Logo uploaded successfully';
  header('location: ../logo_view.php');
}

?>