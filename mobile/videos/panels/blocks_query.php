<?php
 $stmt = $conn->prepare("SELECT * FROM news 
 WHERE category=:category 
AND NOT category=:cat_not
 AND type=:type
 AND pin=:pin
ORDER BY id DESC LIMIT 48");
 $stmt->execute(['cat_not'=>'international', 'type'=>"video", 'pin'=>0, 'category'=>$block[$block_id]['type']]);
 $block_news_orig = $stmt->fetchAll();

?>