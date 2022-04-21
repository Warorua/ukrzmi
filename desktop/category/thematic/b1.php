<div style="background-color: <?php echo $thematic_block[$thematic_id]['bg_color'] ?>;" class="w-100 cardBlock row">
    <div class="row p-3">
        <div class="col-md-12">
        <img src="../admin/components/logos/<?php echo $thematic_block[$thematic_id]['logo'] ?>" width="50px" class="rounded-circle border border-2 border-secondary" alt="...">
        <b class="text-primary fs-4"><?php echo $thematic_block[$thematic_id]['name'] ?></b>
        </div>
        <div class="col-md-12">
       
<style>

#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> {
  position: relative;
}
#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 5%;
  margin-top: 30px;
  margin-bottom: -10px;
}
#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-content .item {
  display: inline-block;
  width: 25%;
  position: relative;
  vertical-align: top;
  overflow: hidden;
  height: 100%;
  white-space: normal;
  padding: 0 10px;
}




#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls button {
  position: absolute;
  border: none;
  background-color: transparent;
  outline: 0;
  font-size: 30px;
  top: 70px;
  color: rgba(0, 0, 0, 0.4);
  transition: 0.15s linear;
}
#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls button:hover {
  color: rgba(0, 0, 0, 0.8);
}


#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls .MS-left {
  left: 0px;
}

#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls .MS-right {
  right: 0px;
}

#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> { position: relative; }

#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 2%;
  height: 50px;
}

#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-content .item {
  display: inline-block;
  width: 20%;
  position: relative;
  vertical-align: top;
  overflow: hidden;
  height: 100%;
  white-space: normal;
  line-height: 50px;
  vertical-align: middle;
}


#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-content .item a {
  line-height: 50px;
  vertical-align: middle;
}

#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls button { position: absolute; }

#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls .MS-left {
  top: 35px;
  left: 10px;
}

#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?> .MS-controls .MS-right {
  top: 35px;
  right: 10px;
}
</style>
<?php 
 $block_name = $thematic_block[$thematic_id]['id'];
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

<div id="mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>" class=" ">






<div class="MS-content">

  <?php
//////////////////////////////////////////////////////////////////////////////////////////////////
$query = '';
if($thematic_block[$thematic_id]['type'] != ''){
    $query .= "AND category = '".$thematic_block[$thematic_id]['type']."'";
}

if($thematic_block[$thematic_id]['sub_cat'] != ''){
    $query .= "AND sub_1 = '".$thematic_block[$thematic_id]['sub_cat']."'";
}

if($thematic_block[$thematic_id]['content'] != ''){
    $query .= "AND type = '".$thematic_block[$thematic_id]['content']."'";
}

if($thematic_block[$thematic_id]['city'] != ''){
    $city = $thematic_block[$thematic_id]['city'];
    if($city == 'kyiv'){
        $query .= "AND source = 'Unian.ua/kyiv' OR source = 'ua.korrespondent.net/city/kiev/'";
      }
      elseif($city == 'lviv'){
        $query .= "AND source = 'Unian.ua/lviv'";
      }
      elseif($city == 'odessa'){
        $query .= "AND source = 'Unian.ua/odessa'";
      }
      elseif($city == 'kharkiv'){
        $query .= "AND source = 'Unian.ua/kharkiv'";
      }
      elseif($city == 'dnepropetrovsk'){
        $query .= "AND source = 'Unian.ua/dnepropetrovsk'";
      }
      else{
        $query .= "";
      }
}

/////////////////////////////////////////////////////////////////////////////////////////////////
  $stmt = $conn->prepare("SELECT * FROM news 
  WHERE NOT category=:cat_not
  ".$query."
  AND pin=:pin
 ORDER BY id DESC LIMIT 60");
  $stmt->execute(['cat_not'=>'international', 'pin'=>0]);
  $block_news_orig = $stmt->fetchAll();

   
  $block_name = $thematic_block[$thematic_id]['id'];
 
    $block_news = $block_news_orig;


  $block_news_1 = array_slice($block_news,0,$thematic_block[$thematic_id]['articles']);

foreach($block_news_1 as $row){
$rowtitle = $row['title'];  

$maxPos = 102;
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
      $filtTit = str_replace('"', '', $row['title']); 
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
  $fc_icon = '<div class="fcIconVid_2"><i class="fa fa-play-circle" aria-hidden="true"></i></div>';
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

      echo '
  <div class=" item">    
  <div style="background-color: '.$thematic_block[$thematic_id]['bg_color'].';" class="card newsCard">
  <div class="card-content">

<a href="'.$fc_link.'.php?code='.$row['code'].'">
<div class="imgFrame" style="border-color: '.$frameColor.';">
    <div class="imgTitle">
       <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
      <img class="cardPhoto_2" src="https://www.ukrzmi.com/images/'.$row['photo'].'" height="122px" alt="'.$row['title'].'" />
      '.$fc_icon.'
  </div>
</div>   
</a>    
  <div class="card-body">
        <a href="'.$fc_link.'.php?code='.$row['code'].'" class="cardLink"> <h6 class="cardHead" data-toggle="tooltip" data-placement="bottom" title="'.$row['title'].'">'.$titleBadge.''.$rowtitle.'</h6></a>
    <div class="cardFoot clearfix">
      <div class="cardCat">
       <div class="btn-group dropend shareIcon">
      <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
      </a>
      <ul class="dropdown-menu">
       <li><h6 class="dropdown-header">Share</h6></li>
        <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/'.$fc_link.'.php?code='.$row['code'].'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
        <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/'.$fc_link.'.php?code='.$row['code'].'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
        <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/'.$fc_link.'.php?code='.$row['code'].'" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
        <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/'.$fc_link.'.php?code='.$row['code'].'&media=https://www.ukrzmi.com/images/'.$row['photo'].'&description='.$row['title'].'" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="full_coverage.php?id='.$row['id'].'" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
        <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
      </ul>
    </div>

  <p class="cardTime">'.timeago($row['time']).'</p>  

  <div class="ellipBox">
    <p class="cardEllip"></p>
  </div>
  
<p class="cardCategory">'.$row['category'].'</p>
       </div>
    </div>
  </div>
 
  
</div>
</div>   </div>
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
        <?php
if($thematic_block[$thematic_id]['speed'] != ''){
    $intervalo = $thematic_block[$thematic_id]['speed'];
}
else{
    $intervalo = 3000;
}
            ?>
<script src="../bower/multislider.js"></script> 
<script>
$('#basicSlider<?php echo $thematic_block[$thematic_id]['id'] ?>').multislider({
			continuous: true,
			duration: 2000
		});
		$('#mixedSlider<?php echo $thematic_block[$thematic_id]['id'] ?>').multislider({
			duration: 750,
    
			interval: <?php echo $intervalo ?>
		});
</script>

    
        </div>
    </div>
</div>