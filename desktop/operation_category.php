<?php
set_time_limit(500); // 
include 'includes/conn.php';

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT DISTINCT category FROM news");
$stmt->execute();
$op1 = $stmt->fetchAll();
foreach($op1 as $row){
    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM category WHERE name=:name");
   $stmt->execute(['name'=>$row['category']]);  
   $auth = $stmt->fetch();

   if($auth['numrows'] > 0){
   echo 'Already in the DB!!!<br/>';
   }
   else{
    $stmt = $conn->prepare("INSERT INTO category (name) VALUES (:name)");
    $stmt->execute(['name'=>$row['category']]);  
    echo 'Inserted!!!<br/>';
}
}

echo 'finished!!!';

?>