<?php

$mycat = $block[$block_id]['type'];

 $stmt = $conn->prepare("SELECT * FROM news 
 WHERE category=N'$mycat'
AND NOT category=:cat_not
 AND type=:type
 AND pin=:pin
ORDER BY id DESC LIMIT 39;");
 $stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>0]);
 $block_news_orig = $stmt->fetchAll();

?>


