<?php
set_time_limit(500); // 
include 'includes/conn.php';

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM news WHERE NOT sub_1=:sub_1");
$stmt->execute(['sub_1'=>""]);
$op1 = $stmt->fetchAll();
foreach($op1 as $row){
    $catdat = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $row['category']);
   $stmt = $conn->prepare("SELECT * FROM category WHERE name=N'".$catdat."'");
   $stmt->execute();
   $op2 = $stmt->fetch();
   
   $sub1dat = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $row['sub_1']);
   $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM sub_cat WHERE name=N'".$sub1dat."' AND category='".$op2['id']."'");
   $stmt->execute();  
   $auth = $stmt->fetch();

   if($auth['numrows'] > 0){
   echo 'Already in the DB!!!<br/>';
   }
   else{
   $stmt = $conn->prepare("INSERT INTO sub_cat (name, category) VALUES (N'".$sub1dat."', N'".$op2['id']."')");
   $stmt->execute(); 
   echo 'Inserted!!!<br/>';
   }

}

echo 'finished!!!';

?>