<div class="col-md-12">
 
<ul class="list-group list-group-flush">
<?php
foreach($fc_array as $row){
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
          <li class="list-group-item my-2 post">
          <div class="row">

          <div class="col-md-9">
          <div class="row">
          <div class="col-md-1">
          <img width="35px" src="https://www.pravda.com.ua/android-chrome-192x192.png"/>
          </div>
          <div class="col-md-10">
          <a href="'.$fc_link.'.php?code='.$row['code'].'" class="text-dark stretched-link text-decoration-none">
          <h5 class="">'.$fc_icon_title.' '.$row['title'].'</h5>        
          </a>  
             <div class="w-100 justify-content-start">
             <small style="margin-top:25px">
             <span class="text-muted">By '.$row['author'].'
              <span style="font-size:5px; margin-left:4px; margin-right:4px; padding-bottom:10px;">
              <i style="font-size:5px; margin-left:4px; margin-right:4px;" class="fa fa-circle" aria-hidden="true"></i>
           </span>
              
            '.timeago($row['time']).'  '.$row['full_coverage'].' 
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
           <div class="imgFrame">
            <div class="imgTitle">
             <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
            <img class="listImage" src="../images/'.$row['photo'].'" height="100px" width="80%" alt="'.$row['title'].'" />
            '.$fc_icon.'
            </div>
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