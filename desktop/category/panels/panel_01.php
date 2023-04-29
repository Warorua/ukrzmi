
<div class="row">
  <?php
if(1 == 1){


  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
  if(!isset($block[$block_id]['bg_color'])){
      $block[$block_id]['bg_color'] = "#fff";
  }
    if(!isset($block[$block_id]['id'])){
      $block[$block_id]['id'] = 0;
  }

  $stmt = $conn->prepare("SELECT DISTINCT parent FROM news WHERE NOT parent=:parent");
  $stmt->execute(['parent'=>""]);
  $parent_array = $stmt->fetchAll();
  $parent_array_count = sizeof($parent_array);



  $block_news_orig = array();
  $full_arr = array();
  $blocked_arr = array();
  $my_size =0;

  foreach($parent_array as $value => $row_2){
    if(isset($sub_cat_rule)){
      $sql_01 = "AND sub_1=N'".$sub_cat_rule."'";
    }
    else{
      $sql_01 = '';
    }
    ////////////////////////////QUERY TO BE USED IN THIS PAGE
$stmt = $conn->prepare("SELECT * FROM news 
WHERE parent=:parent
AND type=:type
AND pin=:pin
AND category=N'".$_GET['cat_id']."'
".$sql_01."
ORDER BY id DESC");
$stmt->execute(['type'=>"", 'pin'=>0, 'parent'=>$row_2['parent']]);
$eval = $stmt->fetchAll();

$myarr = array();

foreach($eval as $row){
  $val_arr = Array
  (
     'card_id'=>$value,
      'id' => $row['id'],
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
array_push($myarr, $val_arr);

}


$dsll = sizeof($full_arr);
$final_arr = array_merge($myarr, $full_arr);

$full_arr = $final_arr;
array_push($blocked_arr, $myarr);
  }



$combined_array = array();
$size_001 = sizeof($blocked_arr);
  for ($x = 0; $x <= $size_001-1; $x++) {
    $size_002 = sizeof($blocked_arr[$x]);
    if($my_size < $size_002){
      $my_size = $size_002;
    }   
  } 

 $size_003 = $my_size-1;  
for ($v = 0; $v <= $size_003; $v++) {
  for ($x = 0; $x <= $parent_array_count-1; $x++) {
     if(isset($blocked_arr[$x][$v])){
         array_push($combined_array, $blocked_arr[$x][$v]);
      } 
   }    
  } 
  
 //echo $my_size;
  //echo sizeof($blocked_arr); 
//echo sizeof($blocked_arr[0]);  
//print_r($parent_array);
//print_r($combined_array);


$block_news_orig = $combined_array;



  //////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
  $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM pinned WHERE block_id=:block_id AND page=:page");
  $stmt->execute(['block_id'=>$block[$block_id]['id'], 'page'=>'category']);
  $block_auth = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM pinned
  LEFT JOIN news ON pinned.card_id = news.id 
  WHERE NOT category=:cat_not
  AND type=:type
  AND pin=:pin
  AND block_id=:block_id
  AND page=:page
  ORDER BY pinned.position ASC");
  $stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>1, 'block_id'=>$block[$block_id]['id'], 'page'=>'category']);
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
  
  $block_news = array_merge(array_slice($block_news_orig, 0, $pos), array($val), array_slice($block_news_orig, $pos));
  
    $block_news_orig = $block_news;
  
  }
  if($block_auth['numrows'] < 1){
    $block_news = $block_news_orig;
  }
  
  $block_total_cards = sizeof($block_news);
  if($block_total_cards >= 0 && $block_total_cards <= 8){
    $slide_control = 0;
    $hide_control_button = 'disabled';
  }
  if($block_total_cards >= 9 && $block_total_cards <= 16){
    $slide_control = 1;
    $hide_control_button = '';
  }
  if($block_total_cards >= 17 && $block_total_cards <= 24){
    $slide_control = 2;
    $hide_control_button = '';
  }
  if($block_total_cards >= 25 && $block_total_cards <= 32){
    $slide_control = 3;
    $hide_control_button = '';
  }
  if($block_total_cards >= 33 && $block_total_cards <= 40){
    $slide_control = 4;
    $hide_control_button = '';
  }
  if($block_total_cards >= 41 && $block_total_cards <= 48){
    $slide_control = 5;
    $hide_control_button = '';
  }
  if(!isset($slide_control)){
    $slide_control = 5;
    $hide_control_button = '';
  }


  $block_news_1 = array_slice($block_news,0,8);

//////////////////////////QUERY FOR GENERATING SESSION

$pageName = 'category'.$block[$block_id]['id'];
$_SESSION[$pageName] = $block_news;

/////////////////////////////////////////////////
foreach($block_news_1 as $row){
  echo ukrzmiCard($row, $block, $block_id);
}
}
//for ($x = 0; $x <= 48; $x++) {}
?>  

</div>
