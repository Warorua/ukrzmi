<?php
set_time_limit(500); // 
include 'includes/conn.php';

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM news WHERE category=:cat");
$stmt->execute(['cat'=>'Війна']);
$op1 = $stmt->fetchAll();
foreach($op1 as $row){
    $stmt = $conn->prepare("UPDATE news SET category=:category, sub_1=:sub_1 WHERE id=:id");
    $stmt->execute(['sub_1'=>"Війна", 'category'=>"Політика", 'id'=>$row['id']]);  
}

echo 'finished!!!';

?>