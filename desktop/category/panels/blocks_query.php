<?php

 $stmt = $conn->prepare("SELECT * FROM news 
 WHERE NOT category=:cat_not
 AND type=:type
 AND pin=:pin
ORDER BY id DESC LIMIT 39;");
 $stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>0]);
  $block_news_orig = $stmt->fetchAll();

 ////////////////////////////////////////////////////////////////////////////////
 $stmt = $conn->prepare("SELECT * FROM news 
 WHERE NOT category=:cat_not
 AND type=:type
 AND pin=:pin
ORDER BY id;");
 $stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>0]);
 $block_allNews = $stmt->fetchAll();

$pageName = 'category';
$_SESSION[$pageName] = $block_allNews;

?>


