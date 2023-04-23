<?php
include '../includes/conn.php';
include ('vendor/autoload.php');
use \NlpTools\Tokenizers\WhitespaceTokenizer;
use \NlpTools\Similarity\CosineSimilarity;
 $tok = new WhitespaceTokenizer();
$cos = new CosineSimilarity();
$s1 = $_POST['st1'];
//$s2 = "Hello, I love you, let me jump in your game";

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM news ORDER BY id DESC LIMIT 1");
$stmt->execute();
$evv = $stmt->fetch();
$id_evv = $evv['id'] - 200;

$stmt = $conn->prepare("SELECT * FROM news WHERE id>:id OR id=:id2 ORDER BY id ASC");
$stmt->execute(['id'=>$id_evv, 'id2'=>$evv['id']]);
$auth = $stmt->fetchAll();
//echo sizeof($auth);
echo '<h2>'.$s1.'</h2>';

foreach($auth as $row){
    $s2 = $row['title'];

$setA = $tok->tokenize($s1);
$setB = $tok->tokenize($s2);
 
echo number_format($cos->similarity($setA,$setB), 3)*100 .'% --- <b>'.$row['title'].'</b> ---- <a class="btn btn-warning" href="../article_data.php?id='.$row['code'].'" target="_blank" >Preview</a>--- <b>'.$row['time'].'</b>--- <b>'.$row['id'].'</b><br/>';
}
?>