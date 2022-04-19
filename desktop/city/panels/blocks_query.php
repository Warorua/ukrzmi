<?php
if($city == 'kyiv'){
    $query = "AND source = 'Unian.ua/kyiv' OR source = 'ua.korrespondent.net/city/kiev/'";
  }
  elseif($city == 'lviv'){
    $query = "AND source = 'Unian.ua/lviv'";
  }
  elseif($city == 'odessa'){
    $query = "AND source = 'Unian.ua/odessa'";
  }
  elseif($city == 'kharkiv'){
    $query = "AND source = 'Unian.ua/kharkiv'";
  }
  elseif($city == 'dnepropetrovsk'){
    $query = "AND source = 'Unian.ua/dnepropetrovsk'";
  }
  else{
      $query = "";
  }
 $stmt = $conn->prepare("SELECT * FROM news 
 WHERE category=:category 
AND NOT category=:cat_not
 AND type=:type
 AND pin=:pin
 ".$query."
ORDER BY id DESC LIMIT 39");
 $stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>0, 'category'=>$block[$block_id]['type']]);
  $block_news_orig = $stmt->fetchAll();

 ////////////////////////////////////////////////////////////////////////////////
 $stmt = $conn->prepare("SELECT * FROM news 
 WHERE category=:category 
AND NOT category=:cat_not
 AND type=:type
 AND pin=:pin
ORDER BY id;");
 $stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>0, 'category'=>$block[$block_id]['type']]);

 $block_allNews = $stmt->fetchAll();

$pageName = 'city';
$_SESSION[$pageName] = $block_allNews;

?>