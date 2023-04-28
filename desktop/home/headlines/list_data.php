<?php
session_start();
include '../includes/functions.php';
$row = $_POST['row'];
$rowperpage = 4;
$data = $_SESSION['block_items'];
$list_item = array_slice($data, $row, $rowperpage);
$html = '';

foreach ($list_item as $row) {
  echo listCard($row);
}

echo $html;
