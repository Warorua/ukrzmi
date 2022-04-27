<?php
session_start();
include '../includes/conn_2.php';
include '../home/blocks.php';
$row = $_POST['row'];
$rowperpage = 4;
$data = $_SESSION['search_items'];
$list_item = array_slice($data,$row,$rowperpage);
$html = '';

foreach($list_item as $row){
    $rowtitle = $row['title'];  
    
    $maxPos = 500;
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
    
    
    
    if (strlen($row['title']) > $maxPos)
    {
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
    
 $art_cont = substr(strip_tags($row['article']),0,280).'...';
 
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
    $html .= '
    
    <li class="list-group-item border border-0 post">
    <a href="'.$fc_link.'.php?code='.$row['code'].'" class="stretched-link"></a>
    <div><h3 class="searchHead">'.$row['title'].'<tx class="text-muted fs-6">('.$rowParent.')</tx></h3></div>
    <p class="searchCont text-muted mt-0">'.timeago($row['time']).' - '.$art_cont.'</p>
</li> 
    ';
    
    
    }

echo $html;
