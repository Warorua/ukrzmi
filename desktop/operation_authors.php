<?php
set_time_limit(500); // 
include 'includes/conn.php';

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT DISTINCT author FROM news");
$stmt->execute();
$op1 = $stmt->fetchAll();
foreach($op1 as $row){
    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM authors WHERE name=:name");
    $stmt->execute(['name'=>$row['author']]);  
    $auth = $stmt->fetch();

    if($auth['numrows'] > 0){
    echo 'Already in the DB!!!<br/>';
    }
    else{
        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE author=:name");
        $stmt->execute(['name'=>$row['author']]);  
        $auth_ar = $stmt->fetch();

    $stmt = $conn->prepare("INSERT INTO authors (name, articles) VALUES (:name, :articles)");
    $stmt->execute(['name'=>$row['author'], 'articles'=>$auth_ar['numrows']]); 
    echo 'Inserted!!!<br/>';
    }

}

echo 'finished!!!';

?>