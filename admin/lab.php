<?php
include './includes/session.php';
$conn = $pdo->open();
function starts_with($word, $characters) {
      $char_length = strlen($characters);
      return substr($word, 0, $char_length) === $characters;
  }
/*
function posiDescSort($item1,$item2)
{
    if ($item1['position'] == $item2['position']) return 0;
    return ($item1['position'] > $item2['position']) ? 1 : -1;
}
$stmt = $conn->prepare("SHOW COLUMNS IN news");
$stmt->execute();
$thematic_block = $stmt->fetchAll();
//usort($thematic_block,'posiDescSort'); 
  //*/
//*
  $stmt = $conn->prepare("SELECT id, category, published, deep_link, pin, type, p_grapher, photo, photo_url, code FROM news 
  WHERE NOT p_grapher=:cat_not
 ORDER BY id DESC");
  $stmt->execute(['cat_not'=>'None']);
  
  $block_news_orig = $stmt->fetchAll();
  
   /*
  foreach ($block_news_orig as $id => $row) {
        
      if (starts_with($row['video_url'], 'https://www.unian.ua/player/')) {
         
             echo $id . '<br/>' . $row['video_url'] . '<br/>' . $row['deep_link'] . '<br/>';
      }
  
     
  }
 
          

            //$block_news_orig = filter_by_key( $block_news_orig, [ 'Lifestyle' ], 'category', 'id' );
      
          //*/
  print_r( $block_news_orig);