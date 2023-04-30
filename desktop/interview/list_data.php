<?php
include('../full_coverage/vendor/autoload.php');
include '../includes/conn_2.php';
session_start();
include '../includes/functions.php';

use \NlpTools\Tokenizers\WhitespaceTokenizer;

$tok = new WhitespaceTokenizer();


$row = $_POST['row'];
$rowperpage = 4;
$data = $_SESSION['interview_items'];
$list_item = array_slice($data, $row, $rowperpage);
$html = '';

foreach ($list_item as $row) {
  $html .= interviewsCard($row, $tok);
}

echo $html;
