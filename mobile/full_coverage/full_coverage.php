<?php
include '../includes/conn.php';
include ('vendor/autoload.php');
use \NlpTools\Tokenizers\WhitespaceTokenizer;
use \NlpTools\Similarity\CosineSimilarity;
 $tok = new WhitespaceTokenizer();
$cos = new CosineSimilarity();

$s1 = $_POST['st1'];
//$s2 = "Hello, I love you, let me jump in your game";

//echo sizeof($auth);
//echo '<h2>'.$s1.'</h2>';
 $s2 = $_POST['st2'];

$setA = $tok->tokenize($s1);
$setB = $tok->tokenize($s2);
 
$val = number_format($cos->similarity($setA,$setB), 3)*100;

echo '
<h1 class="display-6">Comparison results:</h1>
<p>Your sentences have a <b class="text-danger">'.$val.'%</b> match</p>
<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: '.$val.'%;" aria-valuenow="'.$val.'" aria-valuemin="0" aria-valuemax="100">'.$val.'%</div>
</div>
';

?>