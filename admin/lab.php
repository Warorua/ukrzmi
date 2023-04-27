<?php
include './includes/session.php';
$conn = $pdo->open();

function getTimeDifference($dateStr) {
      $timestamp = strtotime($dateStr);
      $currentTimestamp = time();
      $difference = $currentTimestamp - $timestamp;
      return $difference;
    }

$stmt = $conn->prepare("SELECT * FROM pinned WHERE block_id=:block_id AND page=:page ORDER BY id DESC LIMIT 1");
    $stmt->execute(['block_id' => 12, 'page' => '']);
    $block_auth = $stmt->fetch();

    //print_r($block_auth);
    $dateStr = "04/29/2023 12:10 AM";
    $dateStr = $block_auth['pinned_to'];
   echo getTimeDifference($dateStr);
 ?>
