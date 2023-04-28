<?php
include './includes/session.php';
$conn = $pdo->open();
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

  $stmt = $conn->prepare("SELECT id, category, published, deep_link, pin FROM news 
  WHERE NOT category=:cat_not
  AND pin=:pin
 ORDER BY id DESC");
  $stmt->execute(['cat_not'=>'international', 'pin'=>0]);
  $block_news_orig = $stmt->fetchAll();

  //*
          

            $block_news_orig = filter_by_key(
              $block_news_orig,
              [
                'Lifestyle'
              ],
              'category',
              'id'
            );
      
          //*/
  print_r($block_news_orig);