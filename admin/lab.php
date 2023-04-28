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
$stmt = $conn->prepare("SELECT * FROM blocks WHERE NOT position=:position AND NOT mode=:mode AND page=:page");
$stmt->execute(['position'=>404, 'mode'=>'', 'page'=>'home']);
$thematic_block = $stmt->fetchAll();
usort($thematic_block,'posiDescSort'); 
  */

  $stmt = $conn->prepare("SELECT id, category, published, deep_link, pin, type, voice_profile, photo, photo_url, code FROM news 
  WHERE type=:cat_not
 ORDER BY id DESC");
  $stmt->execute(['cat_not'=>'voice']);
  
  $block_news_orig = $stmt->fetchAll();
  
   /*
  foreach ($block_news_orig as $id => $row) {
        
      if (starts_with($row['video_url'], 'https://www.unian.ua/player/')) {
         
             echo $id . '<br/>' . $row['video_url'] . '<br/>' . $row['deep_link'] . '<br/>';
      }
  
     
  }
 
          

            //$block_news_orig = filter_by_key( $block_news_orig, [ 'Lifestyle' ], 'category', 'id' );
      
          //*/
  print_r($block_news_orig);