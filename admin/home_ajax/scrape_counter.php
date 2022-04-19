<?php
include '../includes/conn.php';
$output = '';
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT DISTINCT source FROM news");
$stmt->execute();
$data = $stmt->fetchAll();
    $output .= sizeof($data);

 echo $output;

?>