<?php
include ('vendor/autoload.php');
 
use \NlpTools\Tokenizers\WhitespaceTokenizer;
use \NlpTools\Similarity\JaccardIndex;
use \NlpTools\Similarity\CosineSimilarity;
use \NlpTools\Similarity\Simhash;
 
$s1 = "New car";
$s2 = "New bar";
 
$tok = new WhitespaceTokenizer();
$J = new JaccardIndex();
$cos = new CosineSimilarity();
$simhash = new Simhash(16); // 16 bits hash
 
$setA = $tok->tokenize($s1);
$setB = $tok->tokenize($s2);
 
printf (
    "
    Jaccard:  %.3f
    Cosine:   %.3f
    Simhash:  %.3f
    SimhashA: %s
    SimhashB: %s
    ",
    $J->similarity(
        $setA,
        $setB
    ),
    $cos->similarity(
        $setA,
        $setB
    ),
    $simhash->similarity(
        $setA,
        $setB
    ),
    $simhash->simhash($setA),
    $simhash->simhash($setB)
);
 

?>