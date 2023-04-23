 <!-- List Data Block -->
 <div class="row tagBody">
                <!-- Display List Item From Database-->
                <?php 
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $tag_content = $stmt->fetchAll();
                foreach($tag_content as $row){
                    
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
                    
      echo '
      <div class="col-md-3">    
      <div class="card col-sm-4 col-md-3 newsCard">
        <div class="card-content">
    
    <a href="article_content.php?code='.$row['code'].'">
    <div class="imgFrame">
          <div class="imgTitle">
             <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
            <img class="cardPhoto" src="https://www.ukrzmi.com/images/'.$row['photo'].'" height="122px" alt="'.$row['title'].'" />
        </div>
     </div>   
      </a>    
        <div class="card-body">
              <a href="article_content.php?code='.$row['code'].'" class="cardLink"> <h6 class="cardHead" data-toggle="tooltip" data-placement="bottom" title="'.$row['title'].'">'.$titleBadge.''.$rowtitle.'</h6></a>
          <div class="cardFoot clearfix">
            <div class="cardCat">
             <div class="btn-group dropend shareIcon">
            <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu">
             <li><h6 class="dropdown-header">Share</h6></li>
              <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
              <li><a class="dropdown-item" href="https://twitter.com/share?url=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
              <li><a class="dropdown-item" href="whatsapp://send?text=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
              <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=http://localhost/news/desktop/article_content.php?code='.$row['code'].'&media=https://localhost/news/scrap2/images/'.$row['photo'].'&description='.$row['title'].'" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="full_coverage.php?id='.$row['id'].'" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
              <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
            </ul>
          </div>
    
        <p class="cardTime">'.timeago($row['time']).'</p>  
    
        <div class="ellipBox">
          <p class="cardEllip"></p>
        </div>
        
    <p class="cardCategory">'.$row['category'].'</p>
             </div>
          </div>
        </div>
       
        
      </div>
      </div>    </div>
      ';
                    
                } ?>
                <!-- End if Display List Item From Database-->

                <!-- No Data list item block-->
                <?php if($data_count <= 0): ?>
                    <li class="text-center list-group-item my-2"><b>No data to show.</b></li>
                <?php endif; ?>
                <!--End of No Data list item block-->
                </div>
            <!-- End List Data Block -->