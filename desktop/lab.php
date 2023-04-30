<?php
include './includes/session.php';
include 'home/blocks.php';



  $stmt = $conn->prepare("SELECT * FROM navlinks WHERE id='27'");
  $stmt->execute();
  $dd = $stmt->fetchAll();
  echo count($dd);

  //print_r($dd);

