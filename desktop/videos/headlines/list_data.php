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
    <li id="post_'.$row['id'].'" class="list-group-item my-2 border post">
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
    <a href="article_content.php?code='.$row['code'].'"> <h5 class=""><b>'.$row['title'].'</b></h5></a>
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
