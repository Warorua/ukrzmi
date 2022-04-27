
<div class="row ">
  <?php
 if(isset($_GET['auth'])){
    $sqladd = "AND author=N'".$_GET['auth']."'";
    $sqlhold = 'value="'.$_GET['auth'].'"';
}
else{
     $sqladd = "";
     $sqlhold = "";
} 
  if(isset($_GET['cat'])){
      $sqlAuth = "AND category=N'".$_GET['cat']."'";
  }
  else{
       $sqlAuth = "";
  }
  if(isset($_GET['city'])){
$city = $_GET['city'];
      if($city == 'kyiv'){
    $sqlAuth = "AND source IN ('Unian.ua/kyiv','ua.korrespondent.net/city/kiev/')";
  }
  elseif($city == 'lviv'){
    $sqlAuth = "AND source = 'Unian.ua/lviv'";
  }
  elseif($city == 'odessa'){
    $sqlAuth = "AND source = 'Unian.ua/odessa'";
  }
  elseif($city == 'kharkiv'){
    $sqlAuth = "AND source = 'Unian.ua/kharkiv'";
  }
  elseif($city == 'dnepropetrovsk'){
    $sqlAuth = "AND source = 'Unian.ua/dnepropetrovsk'";
  }
  else{
      $sqlAuth = "";
  }
  }
  $stmt = $conn->prepare("SELECT * FROM news 
  WHERE NOT category=:cat_not
  AND type=:type
  AND pin=:pin
   ".$sqladd."
   ".$sqlAuth."
 ORDER BY id DESC LIMIT 39");
  $stmt->execute(['cat_not'=>'international', 'type'=>"voice", 'pin'=>0]);
   $block_news_orig = $stmt->fetchAll();

 ////////////////////////////////////////////////////////////////////////////////
 $stmt = $conn->prepare("SELECT * FROM news 
 WHERE NOT category=:cat_not
 AND type=:type
 AND pin=:pin
ORDER BY id;");
 $stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>0]);
 $block_allNews = $stmt->fetchAll();

$pageName = 'home';
$_SESSION[$pageName] = $block_allNews;

  $block_id = 0;
  $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM pinned WHERE block_id=:block_id AND page=:page");
  $stmt->execute(['block_id'=>$block[$block_id]['id'], 'page'=>'voice']);
  $block_auth = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM pinned
  LEFT JOIN news ON pinned.card_id = news.id 
  WHERE NOT category=:cat_not
  AND type=:type
  AND pin=:pin
  AND block_id=:block_id
  AND page=:page
  ORDER BY pinned.position ASC");
  $stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>1, 'block_id'=>$block[$block_id]['id'], 'page'=>'voice']);
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

  $block_news_1 = array_slice($block_news,0,3);

foreach($block_news_1 as $row){
$rowtitle = $row['title'];  

$maxPos = 92;
if($row['sub_1'] != ''){
  $catHolder = $row['sub_1'];
 }else{
   $catHolder = 'General';
 }
 
if($row['parent'] == "ua.korrespondent.net"){
  $rowParent = "Кореспондент";
}
elseif($row['parent'] == "pravda.com.ua"){
  $rowParent = "правда";
}
elseif($row['parent'] == "eurointegration.com.ua"){
  $rowParent = "євроінтеграція";
}
elseif($row['parent'] == "unian.ua"){
  $rowParent = "уніанської";
}
elseif($row['parent'] == "life.pravda.com.ua"){
  $rowParent = "правда";
}
elseif($row['parent'] == "theguardian.com"){
  $rowParent = "The guardian";
}
elseif($row['parent'] == ""){
  $rowParent = "правда";
}



if (strlen($row['title']) < $maxPos){
  $rowtitle = $row['title'];
  $filtTit = str_replace('"', '', $row['title']);
}
else{
    $lastPos = ($maxPos - 3) - strlen($row['title']);
      $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . ' 
 ...'; 
} 
if($row['frame_color'] == ""){
  $frameColor = "rgb(0, 0, 0, 0.0)";
}
else{
  $frameColor = $row['frame_color'];
}
if($row['title_badge'] == ""){
  $titleBadge = "";
}
else{
  $titleBadge = '<img src="../admin/'.$row['title_badge'].'" class="titleBadge" />';
}
if(!isset($row['voice_profile'])){
  $profile = $row['photo'];
}
else{
  $profile = $row['voice_profile'];
}
if($row['type'] == 'video'){
  $fc_icon = '<div class="fcIcon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>';
  $fc_icon_title = '<i class="fa fa-play-circle" aria-hidden="true"></i>';
  $fc_link = 'video_content';
}
elseif($row['type'] == 'podcast'){
  $fc_icon = '<div class="fcIcon"><i class="fa fa-podcast" aria-hidden="true"></i></div>';
  $fc_icon_title = '<i class="fa fa-podcast" aria-hidden="true"></i>';
  $fc_link = 'podcast';
}
elseif($row['type'] == ''){
  $fc_icon = '';
  $fc_icon_title = '';
  $fc_link = 'article_content';
}
else{
  $fc_icon = '';
  $fc_icon_title = '';
  $fc_link = 'article_content';
}
      echo '
  <div class="col-md-4">    
 <div class="card voiceCard">
  <div class="card-body">
  <div class="d-flex">
  <img src="../images/'.$profile.'" width="50px" height="50px"  class="rounded-circle" alt="...">
    <h6 class="card-title p-2 lh-lg fw-normal">'.$row['author'].'</h6>
  </div>
  <div style="height:40px">
  <p style="font-size:12px; line-height:1.2" class="text-muted">With supporting text below as a natural lead-in to additional content.</p>
  </div>
  <div style="height:130px">
   <p class="card-text" style="color:black; font-size:20px; line-height:1.3; font-weight:500">
    '.$row['title'].'
    </p>
  </div>
 <a href="'.$fc_link.'.php?code='.$row['code'].'" class="stretched-link"></a>  
    <div class="d-flex justify-content-between">
    <i class="fa fa-square text-dark"></i> 

    <div>
    <i class="fa fa-eye text-dark"></i>
    <span class="text-muted lh-lg" style="font-size:10px;"> 1,000</span>
    </div>



    <i class="fa fa-ellipsis-v text-dark"></i>
    </div>
  </div>
</div>
  </div>
  ';
}

//for ($x = 0; $x <= 48; $x++) {}
?>  

</div>
