<?php
session_start();
include '../includes/conn_2.php';
include '../includes/functions.php';
include '../home/blocks.php';
$row = $_POST['row'];
$rowperpage = 8;
$data = $_SESSION['all_content_grid'];
$list_item = array_slice($data, $row, $rowperpage);
$html = '';

foreach ($list_item as $row) {
  echo allContentGridCard($row);
}

echo $html;
