<?php
include './includes/session.php';
$conn = $pdo->open();

  
  
  

  $image_url = 'https://images.unian.net/photos/2021_03/thumb_files/860_470_1614693804-2518.jpg';
  $exif_data = generate_exif_data_from_url($image_url);
  
  print_r($exif_data);