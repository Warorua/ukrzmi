
<div class="">
  <?php

$block_news_3 = array_slice($block_news,16,8);

foreach($block_news_3 as $row){
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
  $rowParent = "life.правда";
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


      echo '
      <div class="">   
      <div class="card w-100 cardSet" style="background-color:'.$block[$block_id]['bg_color'].'">
     
      <div class="d-flex justify-content-between">
      <div class="imgTitle">
             <p class="blogTitle">'.$rowParent.'</p>
            <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
            <img src="https://www.ukrzmi.com/images/'.$row['photo'].'" class=" cardPhoto_2" alt="'.$row['title'].'">
        </div>
        <a href="article_content.php?code='.$row['code'].'" class="stretched-link"></a>
       <div class="cardDesc">
            <div style="height:65px" class="card-title blockTitle">'.$titleBadge.''.$rowtitle.'</div>
            <div class="d-flex align-items-end">
            <span class="cardRow text-primary">'.$row['category'].'</span>
            </div>
        <a href="#"></a>  
      </div>
      </div>
     <hr class="cardHr"/>
    </div>
    </div>
  ';
}

//for ($x = 0; $x <= 48; $x++) {}
?>  

</div>
