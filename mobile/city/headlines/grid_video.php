
<style>

#mixedSlider {
  position: relative;
}
#mixedSlider .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 5%;
  margin-top: 30px;

}
#mixedSlider .MS-content .item {
  display: inline-block;
  width: 25%;
  position: relative;
  vertical-align: top;
  overflow: hidden;
  height: 100%;
  white-space: normal;
  padding: 0 10px;
}
@media (max-width: 991px) {
  #mixedSlider .MS-content .item {
    width: 50%;
  }
}
@media (max-width: 767px) {
  #mixedSlider .MS-content .item {
    width: 100%;
  }
}


#mixedSlider .MS-content .item  img {
  height: 120px;
  width: 100%;
}
#mixedSlider .MS-content .item p {
  font-size: 16px;
  margin: 2px 10px 0 5px;
  text-indent: 15px;
}
#mixedSlider .MS-content .item a {
  float: right;
  margin: 0 20px 0 0;
  font-size: 16px;
  color: rgba(0, 0, 0, 0.9);
  font-weight: bold;
  letter-spacing: 1px;
  transition: linear 0.1s;
}
#mixedSlider .MS-content .item a:hover {
  text-shadow: 0 0 1px grey;
}
#mixedSlider .MS-controls button {
  position: absolute;
  border: none;
  background-color: transparent;
  outline: 0;
  font-size: 30px;
  top: 110px;
  color: rgba(0, 0, 0, 0.4);
  transition: 0.15s linear;
}
#mixedSlider .MS-controls button:hover {
  color: rgba(0, 0, 0, 0.8);
}


#mixedSlider .MS-controls .MS-left {
  left: 0px;
}

#mixedSlider .MS-controls .MS-right {
  right: 0px;
}

#basicSlider { position: relative; }

#basicSlider .MS-content {
  white-space: nowrap;
  overflow: hidden;
  margin: 0 2%;
  height: 50px;
}

#basicSlider .MS-content .item {
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


#basicSlider .MS-content .item a {
  line-height: 50px;
  vertical-align: middle;
}

#basicSlider .MS-controls button { position: absolute; }

#basicSlider .MS-controls .MS-left {
  top: 35px;
  left: 10px;
}

#basicSlider .MS-controls .MS-right {
  top: 35px;
  right: 10px;
}
.titleBadge{
  width:20px!important;
}
</style>
<?php 
 $block_name = 'city_carousel';
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
 include 'videos/panels/headline_query.php';
   
  $block_name = 'video_carousel';
 
    $block_news = $block_news_orig;

  
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
if($row['sub_1'] != ''){
  $catHolder = $row['sub_1'];
 }else{
   $catHolder = 'Генеральний';
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
      $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . '...'; 
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

      echo '
      <div class="item w-50">    
      <div style="height:200px" class="card border border-dark rounded">
        <div class="card-content">
    
    <div class="">
          <div class="imgTitle_fc">
           
            <img class="cardPhoto_3" src="https://www.ukrzmi.com/images/'.$row['photo'].'" height="122px" alt="'.$row['title'].'" />
            '.$fc_icon.'
        </div>
     </div>   
     
    
        <div class="">
              <a href="'.$fc_link.'.php?code='.$row['code'].'" class="stretched-link"></a> 
              <h6 class="w-100">'.$titleBadge.''.$rowtitle.'</h6>
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
			duration: 750,
			interval: 3000
		});
</script>

