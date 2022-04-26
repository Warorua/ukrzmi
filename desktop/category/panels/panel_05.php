
<div class="row">
  <?php

$block_news_5 = array_slice($block_news,32,7);

foreach($block_news_5 as $row){
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
  $rowParent = "life.правда";
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


      echo '
<div class="col-md-3">    
      <div class="card col-sm-4 col-md-3 newsCard" style="background-color:'.$block[$block_id]['bg_color'].'">
    <div class="card-content">

<a href="article_content.php?code='.$row['code'].'">
 <div class="imgFrame">
      <div class="imgTitle">
         <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
        <img class="cardPhoto" src="../images/'.$row['photo'].'" height="122px" alt="'.$row['title'].'" />
    </div>
 </div>   
  </a>    
    <div class="">
          <a href="article_content.php?code='.$row['code'].'" class="cardLink cardTitRow"> 
			  <h6 class="cardHead" data-toggle="tooltip" data-placement="bottom" title="'.$filtTit.'">'.$titleBadge.''.$rowtitle.'</h6>
			</a>
      <div class="cardFoot clearfix">
        <div class="cardCat">
         <div class="btn-group dropend shareIcon">
        <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-ellipsis-v text-dark" aria-hidden="true"></i>
        </a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
         <li>
         <a class="dropdown-item trigger right-caret">Share</a>
         <ul class="dropdown-menu sub-menu">
         <li><a class="dropdown-item" href="https://t.me/share/url?url=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'&text='.$row['title'].'" target="_blank"><i class="fas fa-telegram" aria-hidden="true"></i> Telegram</a></li>
         <li><a class="dropdown-item" href="viber://forward?text=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-viber" aria-hidden="true"></i> Viber</a></li>
          <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
          <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
          <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
          <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'&media=https://www.ukrzmi.com/images/'.$row['photo'].'&description='.$row['title'].'" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
          
         </ul>
         </li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="full_coverage.php?id='.$row['id'].'" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
          <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
        </ul>
      </div>

    <p class="cardTime">'.timeago($row['time']).'</p>  

    <div class="ellipBox">
      <p class="cardEllip"></p>
    </div>
<a href="category.php?cat_id='.$row['category'].'" target="_blank">    
<p class="cardCategory text-muted">'.$row['category'].'</p>
</a>
         </div>
      </div>
    </div>
   
    
  </div>
  </div>    </div>
  ';
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
          <a class="stretched-link" href="all_content.php?page=<?php echo $pageName ?>&block_id=<?php echo $block_id ?>&cat_id=<?php echo $_GET['cat_id'] ?>"></a>
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
        //alert(messageText);
        document.getElementById('carNext<?php echo $block[$block_id]['id']; ?>').style.visibility = 'hidden';
      } 
      else if(messageText == 'notViewed'){
        document.getElementById('carNext<?php echo $block[$block_id]['id']; ?>').style.visibility = '';
      } 

   
//alert(messageText);

}, 10);

</script>