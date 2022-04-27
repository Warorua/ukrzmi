<div class="col-md-12">
 
<ul class="list-group list-group-flush">
<?php
$block_news_1 = array_slice($block_news,0,4);
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
    ///////////////////////////////////////////////////////////////////////////////////////
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
    
    
          echo '
          <li class="list-group-item post w-100 p-0 m-1">
          <div class="d-flex justify-content-between">

          <div style="width:60%" class="">
          <a href="'.$fc_link.'.php?code='.$row['code'].'" class="stretched-link"></a> 

          <div class="d-flex justify-content-between">
          <div class="col-md-10">      
          <div style="font-size:15px" class="text-dark fw-bold">'.$fc_icon_title.' '.$row['title'].'</div>        
            
             <div class="w-100 justify-content-start">
             <small style="margin-top:25px">
             <span class="text-muted">By '.$row['author'].'
           </span>
           </small>
             </div>  
          </div>
          </div>
           
                
          </div>

            <div style="width:40%" class="">
            <div class="imgTitle_fc">
             <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
            <img class="listImage" src="https://www.ukrzmi.com/images/'.$row['photo'].'" height="100px" alt="'.$row['title'].'" />
            '.$fc_icon.'
            </div>   
          </div>


         </div>
    
      </li>
      ';
     // echo $row['full_coverage'];
    }
?>
     </ul>   
</div>