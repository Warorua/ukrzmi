<?php
  if(isset($_GET['cat'])){
      $sqlAuth = "AND category=N'".$_GET['cat']."'";
  }
  else{
       $sqlAuth = "";
  }
    if(isset($_GET['city'])){
$city = $_GET['city'];
      if($city == 'kyiv'){
    $sqlAuth = "AND source IN ('Unian.ua/kyiv','ua.korrespondent.net/city/kiev/')";
  }
  elseif($city == 'lviv'){
    $sqlAuth = "AND source = 'Unian.ua/lviv'";
  }
  elseif($city == 'odessa'){
    $sqlAuth = "AND source = 'Unian.ua/odessa'";
  }
  elseif($city == 'kharkiv'){
    $sqlAuth = "AND source = 'Unian.ua/kharkiv'";
  }
  elseif($city == 'dnepropetrovsk'){
    $sqlAuth = "AND source = 'Unian.ua/dnepropetrovsk'";
  }
  else{
      $sqlAuth = "";
  }
  }
 $stmt = $conn->prepare("SELECT * FROM news 
 WHERE category=N'".$block[$block_id]['type']."' 
AND NOT category=:cat_not
 AND type=:type
 AND pin=:pin
 ".$sqlAuth."
ORDER BY id DESC LIMIT 39");
 $stmt->execute(['cat_not'=>'international', 'type'=>"video", 'pin'=>0]);
  $block_news_orig = $stmt->fetchAll();

  $blockHide = sizeof($block_news_orig);

 ////////////////////////////////////////////////////////////////////////////////
 $stmt = $conn->prepare("SELECT * FROM news 
 WHERE NOT category=:cat_not
 AND type=:type
 AND pin=:pin
ORDER BY id;");
 $stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>0]);
 $block_allNews = $stmt->fetchAll();

$pageName = 'home';
$_SESSION[$pageName] = $block_allNews;

?>