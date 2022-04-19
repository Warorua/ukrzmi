<?php
set_time_limit(500); // 
include 'includes/conn.php';

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM news");
$stmt->execute();
$op1 = $stmt->fetchAll();
//echo sizeof($op1);
foreach($op1 as $row){
$tit_len = strlen($row['title']);
if($tit_len < 10){
    echo 'id:'.$row['id'].'<br/>';
    echo 'title:'.$row['title'].'<br/><br/>';

    $stmt = $conn->prepare("DELETE FROM news WHERE id=:id");
    $stmt->execute(['id'=>$row['id']]);

}
}

echo 'DELETED!!!';

?>