<?php
include './includes/session.php';
$conn = $pdo->open();
function starts_with($word, $characters) {
      $char_length = strlen($characters);
      return substr($word, 0, $char_length) === $characters;
  }

  function get_ids($array, $key) {
    $ids = array();
    foreach($array as $element) {
        $ids[] = $element[$key];
    }
    return $ids;
}

//*
function posiDescSort($item1,$item2)
{
    if ($item1['position'] == $item2['position']) return 0;
    return ($item1['position'] > $item2['position']) ? 1 : -1;
}
$stmt = $conn->prepare("SELECT *, sub_cat.name AS subcat FROM sub_cat LEFT JOIN category ON sub_cat.category=category.id");
$stmt->execute();
$block_news_orig = $stmt->fetchAll();
//usort($thematic_block,'posiDescSort'); 
  //*/
/*
  $stmt = $conn->prepare("SELECT id, category, time, deep_link, pin, type, post_date, photo, photo_url, code FROM news 
  WHERE NOT p_grapher=:cat_not
 ORDER BY id DESC");
  $stmt->execute(['cat_not'=>'None']);
  
  $block_news_orig = $stmt->fetchAll();

  $block_news_orig = get_ids($block_news_orig, 'id');
  
   /*
  foreach ($block_news_orig as $id => $row) {
        
      if (starts_with($row['video_url'], 'https://www.unian.ua/player/')) {
         
             echo $id . '<br/>' . $row['video_url'] . '<br/>' . $row['deep_link'] . '<br/>';
      }
  
     
  }
 
          

            //$block_news_orig = filter_by_key( $block_news_orig, [ 'Lifestyle' ], 'category', 'id' );
      
          //*/
  print_r( $block_news_orig);