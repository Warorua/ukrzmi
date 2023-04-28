<?php
session_start();
include('../full_coverage/vendor/autoload.php');

use \NlpTools\Tokenizers\WhitespaceTokenizer;

$tok = new WhitespaceTokenizer();
include '../includes/conn_2.php';
include '../includes/functions.php';
include '../home/blocks.php';
$row = $_POST['row'];
$rowperpage = 4;
$data = $_SESSION['voice_items'];
$list_item = array_slice($data, $row, $rowperpage);
$html = '';

foreach ($list_item as $row) {
  $html .= voicesListCard($row);
}

echo $html;
