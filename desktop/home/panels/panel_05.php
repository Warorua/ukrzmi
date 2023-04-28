
<div class="row">
  <?php

$block_news_5 = array_slice($block_news,32,7);

foreach($block_news_5 as $row){
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


      echo articleCard($row, $block, $block_id, $rowParent, $frameColor, $filtTit, $titleBadge, $rowtitle, $catHolder);
}

//for ($x = 0; $x <= 48; $x++) {}
?>  
<div class="col-md-3 lastCard<?php echo $block[$block_id]['id']; ?>"> 
      <div class="card col-sm-4 col-md-3 newsCard" style="background-color:<?php echo $block[$block_id]['bg_color'] ?>">
    <div class="card-content">
<div class="card-body d-flex justify-content-center h-75">
          <div class="m-auto border border-dark rounded p-2 border-2 fw-bold fs-5">
              <tx class="text-dark text-center">Read all headlines</tx>
          </div>
          <a class="stretched-link" href="all_content.php?page=<?php echo $pageName ?>&block_id=<?php echo $block_id ?>&cat_id=<?php echo $block[$block_id]['name'] ?>&cat_type=<?php echo $block[$block_id]['type'] ?>"></a>
    </div>
  </div>
  </div> 
 </div>
</div>

<script>
  function isInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)

    );
}


const box<?php echo $block[$block_id]['id']; ?> = document.querySelector('.lastCard<?php echo $block[$block_id]['id']; ?>');

setInterval(function(){ 
  const messageText = isInViewport(box<?php echo $block[$block_id]['id']; ?>) ?
        'viewed' :
        'notViewed';
        
      if(messageText == 'viewed'){
       // alert(messageText);
        document.getElementById('carNext<?php echo $block[$block_id]['id']; ?>').style.visibility = 'hidden';
      } 
      else if(messageText == 'notViewed'){
        document.getElementById('carNext<?php echo $block[$block_id]['id']; ?>').style.visibility = '';
      } 

   
//alert(messageText);

}, 10);

</script>