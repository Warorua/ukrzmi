<?php
session_start();
$row = $_POST['row'];
$rowperpage = 4;
$data = $_SESSION['block_items'];
$list_item = array_slice($data,$row,$rowperpage);
$html = '';

foreach($list_item as $row){
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
    
    $content = strip_tags(substr($row['article'],0,260)).'...';
    
    $html .= '
    <li id="post_'.$row['id'].'" class="list-group-item my-2 post">
    <div class="row">
    
    <div class="col-md-3">
     <div class="imgFrame">
      <a href="article_content.php?code='.$row['code'].'">
      <div class="imgTitle">
       <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
      <img class="cardPhotoList_2" src="../images/'.$row['photo'].'" height="130px" alt="'.$row['title'].'" />
       </div>
       </a> 
       </div> 
    </div>
    
    <div class="col-md-9">
    
    
    <div class="row">
    
    <div class="col-md-10">
    <div class="d-flex justify-content-between">
<a href="article_content.php?code='.$row['code'].'"> <h5 class=""><b>'.$row['title'].'</b></h5></a>
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
      
</div>
     <div class="w-100 d-flex justify-content-start">
     <small><span class="text-muted">'.$row['category'].' | '.$row['time'].'</span></small>  
     </div>
    </div>
    
    <div class="col-md-2">
    <div style="margin-top:15px" class="">
       <a class="btn btn-outline-primary btn-sm" href="#">Full Coverage</a>
    </div> 
    </div>
    <div style="margin-top:15px" class="col-md-12">
    <p>
      '.$content.'
      </p>
    </div>
    </div>
         
    </div>
    
    </div>
    
    </li>    
    ';
    
    
    }

echo $html;
