<?php
include './includes/session.php';
$conn = $pdo->open();
$stmt = $conn->prepare(
    'SHOW COLUMNS FROM `news`'
  );
  $stmt->execute();
  $news_clms = $stmt->fetchAll();

 // echo json_encode($news_clms);

 foreach($news_clms as $rows){
       echo $rows['Field'].', <br/>';   
 }