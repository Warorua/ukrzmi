<?php
include '../includes/conn.php';
$conn = $pdo->open();


$stmt = $conn->prepare("SELECT * FROM news 
WHERE NOT category=:cat_not
AND type=:type
AND pin=:pin
ORDER BY id DESC LIMIT 5");
$stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>0]);
$block_news_orig = $stmt->fetchAll();


$stmt = $conn->prepare("SELECT * FROM pinned
LEFT JOIN news ON pinned.card_id = news.id 
WHERE NOT category=:cat_not
AND type=:type
AND pin=:pin
AND block_id=:block_id
  AND page=:page
 
ORDER BY pinned.position ASC");
$stmt->execute(['cat_not'=>'international', 'page'=>'', 'type'=>"", 'pin'=>1, 'block_id'=>10]);
$block_news_pinned = $stmt->fetchAll();
foreach($block_news_pinned as $value => $row){
   $pos = $row['position'];      
  $val = Array
        (
            'id' => $row['id'],
            'position' => $row['position'],
            'source' => $row['source'],
           'deep_link' => $row['deep_link'],
            'title' => $row['title'],
            'published' => $row['published'],
            'author' => $row['author'],
            'article' => $row['article'],
            'tag_1' => $row['tag_1'], 
            'tag_2' => $row['tag_2'] ,
            'tag_3' => $row['tag_3'] ,
           'photo' => $row['photo'],
            'photo_url' => $row['photo_url'],
            'p_grapher' => $row['p_grapher'],
            'category' => $row['category'],
            'time' => $row['time'],
            'code' => $row['code'],
            'parent' => $row['parent'],
            'type' => $row['type'],
            'video_url' => $row['video_url'],
            'frame_color' => $row['frame_color'],
            'title_badge' => $row['title_badge'],
            'meta_title' => $row['meta_title'],
            'meta_desc' => $row['meta_desc'],
            'meta_keywords' => $row['meta_keywords'],
            'post_date' => $row['post_date'],
            'pin' => $row['pin'],
            'sub_1' => $row['sub_1'],
            'sub_2' => $row['sub_2'],
            'intefax' => $row['intefax'],
            'source_error' =>$row['source_error'],
            'input' => $row['input']
        );

$result = array_merge(array_slice($block_news_orig, 0, $pos), array($val), array_slice($block_news_orig, $pos));

$block_news_orig = $result;

}




echo $pos.'<br/>';

print_r($result);





/*
    $arr = [1, 2, 3, 5];
    $pos = 3;
    $val = 4;
    print_r($arr).'<br/>';

    $result = array_merge(array_slice($arr, 0, $pos), array($val), array_slice($arr, $pos));

    print_r($result);
 
    /* Output:
 
    Array
    (
        [0] => 1
        [1] => 2
        [2] => 3
        [3] => 4
        [4] => 5
    )
    */
?>