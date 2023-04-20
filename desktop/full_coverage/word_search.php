<?php
include '../includes/conn.php';
$word = 'Інтерфакс';
$word_b = 'href="http://www.intefax';
$word_c = 'intefax';

$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM news");
$stmt->execute();
$data = $stmt->fetchAll();
foreach($data as $row){
$mystring = $row['article']; 
// Test if string contains the word 
if(strpos($mystring, $word) !== false || strpos($mystring, $word_b) !== false || strpos($mystring, $word_c) !== false){
    echo $row['title'].' - <b style="color:red">Word Found!</b> ---- <a class="btn btn-warning" href="../article_data.php?id='.$row['code'].'" target="_blank" >Preview</a><br/>';
} else{
    echo $row['title'].' - <b style="color:green">Word Not Found!</b> ---- <a class="btn btn-warning" href="../article_data.php?id='.$row['code'].'" target="_blank" >Preview</a><br/>';
} 
}


?>