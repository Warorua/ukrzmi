
<div class="row">
  <?php

$block_news_4 = array_slice($block_news,24,8);

foreach($block_news_4 as $row){
  $catHolder = blockAux($row)['catHolder'];
  $lastPos = blockAux($row)['lastPos'];
  $rowtitle = blockAux($row)['rowtitle'];
  $filtTit = blockAux($row)['filtTit'];
  $frameColor = blockAux($row)['frameColor'];
  $titleBadge = blockAux($row)['titleBadge'];

      echo articleCard($row, $block, $block_id, $rowParent, $frameColor, $filtTit, $titleBadge, $rowtitle, $catHolder);
}

//for ($x = 0; $x <= 48; $x++) {}
?>  

</div>
