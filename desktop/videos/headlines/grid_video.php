
<?php 
 $block_name = 'video_carousel';
?>
<style>
  .slickk-next-<?php echo $block_name; ?>{
  width: 100%;
}
.slickk-prev-<?php echo $block_name; ?>{
  width: 100%;
}

</style>
<?php //echo $block_name; ?>

<div id="mixedSlider" class=" ">






<div class="MS-content">
  <?php

$s1 = $data['title'];
function fullDescSort($item1,$item2)
{
    if ($item1['full_coverage'] == $item2['full_coverage']) return 0;
    return ($item1['full_coverage'] > $item2['full_coverage']) ? -1 : 1;
}
$stmt = $conn->prepare("SELECT * FROM news WHERE type='video' ORDER BY id DESC");
$stmt->execute();
$auth = $stmt->fetchAll();
//echo sizeof($auth);
$fc_array = array();
foreach($auth as $row){
$s2 = $row['title'];
//$s2 = strip_tags($s2);
$setA = $tok->tokenize($s1);
$setB = $tok->tokenize($s2);
$eval_perc = number_format($fc_algorithm->similarity($setA,$setB), 3)*100;

if($eval_perc >= 0){
    
$fc = $eval_perc;      
$val = Array
      (
          'id' => $row['id'],
          'full_coverage' => $eval_perc,
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
    array_push($fc_array, $val);
    
}

usort($fc_array,'fullDescSort');
}
$block_news = array_slice($fc_array,0,24);

//////////////////////////////////////////////////////////////////

  $block_name = 'video_carousel';
 
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

  $block_news_1 = array_slice($block_news,0,24);

foreach($block_news_1 as $row){
$rowtitle = $row['title'];  

$maxPos = 92;
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



if (strlen($row['title']) > $maxPos)
{
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
if($row['type'] == 'video'){
  $fc_icon = '<div class="fcIconVid"><i class="fa fa-play-circle" aria-hidden="true"></i></div>';
}
else{
  $fc_icon = '';
}
////////////////////////////////////////////////
if($row['type'] == 'video'){
  $fc_link = 'video_content';
}
elseif($row['type'] == 'podcast'){
 $fc_link = 'podcast';
}
elseif($row['type'] == ''){
 $fc_link = 'article_content';
}
else{
$fc_link = 'article_content';
}
if($row['full_coverage'] == 100){
  $fc_icon = '<div class="fcIconVidPlay"><tx class="p-1 bg-warning">NOW PLAYING</tx></div>';  
}
else{
    $fc_icon = $fc_icon;
}
      echo '
  <div class=" item">    
  <div class="card newsCard ">
    <div class="card-content">

<a href="'.$fc_link.'.php?code='.$row['code'].'">
<div class="imgFrame">
      <div class="imgTitle w-100">
       
        <img class="cardPhotoPlay" src="../images/'.$row['photo'].'" alt="'.$row['title'].'" />
        '.$fc_icon.'
    </div>
 </div>   
  </a>    
    <div class="card-body">
          <a href="'.$fc_link.'.php?code='.$row['code'].'" class="cardLink"> <h6 class="" data-toggle="tooltip" data-placement="bottom" title="'.$row['title'].'">'.$titleBadge.''.$rowtitle.'</h6></a>

    </div>
   
    
  </div>
  </div>    </div>
  ';
}

//for ($x = 0; $x <= 48; $x++) {}
?>  

</div>
<div class="MS-controls">
                        <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </div>










</div>



<script src="../bower/multislider.js"></script> 
<script>
$('#basicSlider').multislider({
			continuous: true,
			duration: 2000
		});
		$('#mixedSlider').multislider({
			
			interval: 3600000,
			slideAll: true
		});
</script>

