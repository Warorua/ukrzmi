<?php

function filter_by_key($array, $allowed_values, $key_value) {
  //$allowed_values = ['Ken', 'pet', 'John', 'mat', 'Mike'];
  $key = $key_value;
  return array_filter($array, function($item) use ($allowed_values) {
      return isset($item['source']) && in_array($item['source'], $allowed_values);
  });
}

/*
  $stmt = $conn->prepare("SELECT * FROM news 
  WHERE NOT category=:cat_not
  AND type=:type
  AND pin=:pin
 ORDER BY id DESC LIMIT 39");
  $stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>0]);
   $block_news_orig = $stmt->fetchAll();
*/
 ////////////////////////////////////////////////////////////////////////////////
 $stmt = $conn->prepare("SELECT * FROM news 
 WHERE NOT category=:cat_not
 AND type=:type
 AND pin=:pin
ORDER BY id;");
 $stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>0]);
 $block_allNews = $stmt->fetchAll();

 $block_allNews = filter_by_key(
  $block_allNews,
  [
        'Unian.ua/home',
        'ua.korrespondent.net/home',
        'pravda.com.ua/home',
        'eurointegration.com.ua/news/home'
  ],
  'source'
);

 $block_news_orig = array_slice($block_allNews, 0, 39);

$pageName = 'home';
$_SESSION[$pageName] = $block_allNews;

 ////////////////////////////////////////////////////////////////////////////////
 
?>