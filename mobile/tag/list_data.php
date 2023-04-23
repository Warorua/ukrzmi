<?php
session_start();
$row = $_POST['row'];
$rowperpage = 4;
$data = $_SESSION['tag_items'];
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
    
    $content = strip_tags(substr($row['article'],0,260)).'...';
    
    $html .= '
    <li style="border:none" class="list-group-item my-2 post">
    <div class="row">
    <div class="col-md-3">
     <div class="imgFrame">
      <div class="imgTitle">
       <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
      <img class="" src="https://www.ukrzmi.com/images/'.$row['photo'].'" height="160px" width="100%" alt="'.$row['title'].'" />
       </div>
       </div> 
    </div>
    <div class="col-md-9">
       <h5 class="">'.$row['title'].'</h5>
      
     
       <div class="w-100 d-flex justify-content-start">
       <small style="margin-top:25px"><span class="text-muted">'.$row['category'].' | '.$row['author'].' | '.$row['time'].'</span></small>
    
       </div>
      
          
    </div>
    <div style="width:98%"><hr/></div>
    <a href="article_content.php?code='.$row['code'].'" class="stretched-link"></a>
    </div>

</li>  
    ';
    
    
    }

echo $html;
