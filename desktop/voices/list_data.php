<?php
session_start();
include ('../full_coverage/vendor/autoload.php');
use \NlpTools\Tokenizers\WhitespaceTokenizer;
 $tok = new WhitespaceTokenizer();
include '../includes/conn_2.php';
include '../home/blocks.php';
$row = $_POST['row'];
$rowperpage = 4;
$data = $_SESSION['voice_items'];
$list_item = array_slice($data,$row,$rowperpage);
$html = '';

foreach($list_item as $row){
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
    
    $content = strip_tags(substr($row['article'],0,260)).'...';
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
  if(!isset($row['voice_profile'])){
  $profile = $row['photo'];
}
else{
  $profile = $row['voice_profile'];
}
  $contentFull = strip_tags($row['article']);
$setA = $tok->tokenize($contentFull);
$contentTime = number_format(sizeof($setA)/200, 0);
    $html .= '
<li class="list-group-item my-2 post ps-0 pe-0">
<div class="row">

<div class="col-md-9">
<div class="row">
<div class="col-md-1">
<img width="35px" src="https://www.pravda.com.ua/android-chrome-192x192.png"/>
</div>
<div class="col-md-10">
<a href="'.$fc_link.'.php?code='.$row['code'].'" class="text-dark stretched-link text-decoration-none">
<h5 class="">'.$row['title'].'</h5>        
</a>  
   <div class="w-100 justify-content-start">
   <small style="margin-top:25px">
   <span class="text-muted">'.$contentTime.' Minutes
    <span style="font-size:5px; margin-left:4px; margin-right:4px; padding-bottom:10px;">
    <i style="font-size:5px; margin-left:4px; margin-right:4px;" class="fa fa-circle" aria-hidden="true"></i>
 </span>
    
  '.timeago($row['time']).' 
 </span>
 </small>
   </div>  
</div>
<div class="col-md-1">
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
</div>
</div>
 
      
</div>

<div class="col-md-3">

<div class="card voiceCard_2">
  <div class="card-body">
  <div class="d-flex">
  <img src="../images/'.$profile.'" width="40px" height="40px"  class="rounded-circle" alt="...">
    <h6 style="white-space:nowrap" class="card-title p-2 lh-base fw-normal">'.$row['author'].'</h6>
  </div>
  <p style="font-size:12px; line-height:1.2;" class="text-muted">With supporting text below as a natural lead-in.</p>
 
  </div>
</div>

</div>

</li>
    ';
    
    
    }

echo $html;
