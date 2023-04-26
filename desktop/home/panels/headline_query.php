<?php

function filter_by_key($array, $allowed_values, $key, $unique_key) {
  //$allowed_values = ['Ken', 'pet', 'John', 'mat', 'Mike'];
  //$key = $key_value;
  $unique_ages = [];
return array_filter($array, function($item) use ($allowed_values, &$unique_ages, $key, $unique_key) {
    if(isset($item[$key]) && in_array($item[$key], $allowed_values) && !in_array($item[$unique_key], $unique_ages)) {
        $unique_ages[] = $item[$unique_key];
        return true;
    }
    return false;
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
  'source',
  'deep_link'
);

 $block_news_orig = array_slice($block_allNews, 0, 39);

$pageName = 'home';
$_SESSION[$pageName] = $block_allNews;

 ////////////////////////////////////////////////////////////////////////////////
 
?>