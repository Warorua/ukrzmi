<?php
include '../includes/conn.php';
$output = '';
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM news");
$stmt->execute();
$data = $stmt->fetch();
    $output .= $data['numrows'];

 echo $output;

?>