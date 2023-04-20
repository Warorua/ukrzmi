
    <div class="row justify-content-center">
        <div class="col-12 py-5">
          
            <?php 
            // Current Page Value
            $page = isset($_GET['page']) ? $_GET['page'] - 1 : 0;

            // Current Display Entry Length
            $length = (isset($_GET['length']))? $_GET['length'] : 8 ;

            // Tag 1 Search value
            $tag_1 = isset($_GET['tag_1']) ? $_GET['tag_1'] : '';
            // Tag 2 Search value
            $tag_2 = isset($_GET['tag_2']) ? $_GET['tag_2'] : '';
            // Tag 3 Search value
            $tag_3 = isset($_GET['tag_3']) ? $_GET['tag_3'] : '';
            // Type Search value
            $type = isset($_GET['type']) ? $_GET['type'] : '';
            // Tag 1 Search value
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            // Tag 1 Search value
            $tag_id = isset($_GET['tag_id']) ? $_GET['tag_id'] : '';

            // Search query where clause :: Execute only when search keyword exists
           
           if($tag_1 != ''){
             $tag_1_fin = " AND tag_1 ='".$tag_1."'";
           }
           else{
            $tag_1_fin = ''; 
           }
           ///////////////////////////////////////
           if($tag_2 != ''){
            $tag_2_fin = " AND tag_2 ='".$tag_2."'";
          }
          else{
           $tag_2_fin = ''; 
          }
         ///////////////////////////////////////
            if($tag_3 != ''){
                $tag_3_fin = " AND tag_3 ='".$tag_3."'";
              }
              else{
               $tag_3_fin = ''; 
              }
         ///////////////////////////////////////
         if($type != ''){
            $type_fin = " AND type = '".$type."'";
          }
          else{
           $type_fin = ''; 
          }

                $search_where = " WHERE NOT category='international'
                ".$type_fin."
                ".$tag_1_fin."
                ".$tag_2_fin."
                ".$tag_3_fin."
                 OR title='%{$search}%'
                 OR tag_1 ='%{$tag_id}%'
                 OR tag_2 ='%{$tag_id}%'
                 OR tag_3 ='%{$tag_id}%'
                 ";
            
            // Total data row count in the database
            $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM `news` {$search_where}");
            $stmt->execute();
            $dt_c = $stmt->fetch();
            $data_count = $dt_c['numrows'];

            // Number of page buttons
            $page_btn_count = ($data_count > 0 && intval($length )> 0) ? ceil($data_count / $length) : 1;

            // Setting up pagination query :: uses OFFSET and LIMIT clauses
            $offset = ($page > 0 && $length > 0) ? $page * $length : 0;
            $paginate = "";
            if(intval($length) >0)
            $paginate = " LIMIT {$length} OFFSET {$offset} ";

            // Data Query :: Fetching Query of data from database
            $sql = "SELECT * FROM `news` ".$search_where." order by id desc {$paginate}";

            // Setting up url $_GET Data if display length and search keyword is set.
            $with_length = (isset($_GET['length']))? "&length=".$_GET['length'] : 8;
            $with_search = (isset($_GET['search']))? "&search=".$_GET['search'] : '';
            ?>
            <div class='row d-flex justify-content-between'>
                <!-- Display Entries Length Select/Dropdown Block-->
                <div class="col-md-3">
                 <div class="input-group input-group-sm mb-3">
                    <select id="length" class="form-select" onchange="
                    location.replace('search.php?tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&length='+this.value)
                    ">
                    <option selected>Entries</option>
                       <option <?php echo (isset($_GET['length']) && $_GET['length'] == 3) ? 'selected' : '' ?>>3</option>
                            <option <?php echo (isset($_GET['length']) && $_GET['length'] == 10) ? 'selected' : '' ?>>10</option>
                            <option <?php echo (isset($_GET['length']) && $_GET['length'] == 50) ? 'selected' : '' ?>>50</option>
                            <option <?php echo (isset($_GET['length']) && $_GET['length'] == 100) ? 'selected' : '' ?>>100</option>
                            <option <?php echo (isset($_GET['length']) && $_GET['length'] == 'All') ? 'selected' : '' ?>>All</option>
                    </select>
                </div>    
                </div>

    <div class="col-md-3">
                <div class="input-group input-group-sm mb-3"> 
  <select class="form-select" id="inputGroupSelect01"  onchange="
                    location.replace('search.php?tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&type='+this.value)
     ">
    <option selected disabled>Items</option>
    <?php
$stmt = $conn->prepare("SELECT DISTINCT type FROM news");
$stmt->execute();
$type_fetch = $stmt->fetchAll();
foreach($type_fetch as $row){
if($row['type'] == ''){
    $item_type = 'News';
    $item_type_value = '';
}
else{
    $item_type = $row['type'];
    $item_type_value = $row['type'];
}

echo '<option value="'.$item_type_value.'"'; 

echo (isset($_GET['type']) && $_GET['type'] == $item_type_value) ? 'selected' : '';

echo '>'.$item_type.'</option>';
}
    ?>
  </select>
</div>
   </div>
                <div class="col-md-6">
                                <div class="">               
                    <div class="input-group input-group-sm mb-3">
                     <input type="text" id="search" class="form-control" value="<?php echo (isset($search)) ? $search : '' ?>" placeholder="Search">
                     <button class="btn btn-outline-secondary" type="button" onclick="location.replace('search.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&search='+document.getElementById('search').value)"><i class="fa fa-search" aria-hidden="true"></i></button>
                     <button class="btn btn-outline-danger" type="button" onclick="location.replace('search.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>')"><i class="fa fa-close" aria-hidden="true"></i></button>
                    </div>
                </div>    
                </div>

   <div class="col-md-4">
                <div class="input-group input-group-sm mb-3">
  <select class="form-select" id="inputGroupSelect01"   onchange="
                    location.replace('search.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_1='+this.value)
     ">
    <option selected disabled>Tag 1</option>
    <?php
$stmt = $conn->prepare("SELECT DISTINCT tag_1 FROM news");
$stmt->execute();
$tag_1_fetch = $stmt->fetchAll();
foreach($tag_1_fetch as $row){
if($row['tag_1'] == ''){
    $item_tag_1 = 'NO TAG 1';
    $item_tag_1_value = '';
}
else{
    $item_tag_1 = $row['tag_1'];
    $item_tag_1_value = $row['tag_1'];
}

echo '<option value="'.$item_tag_1_value.'"'; 

echo (isset($_GET['tag_1']) && $_GET['tag_1'] == $item_tag_1_value) ? 'selected' : '';

echo '>'.$item_tag_1.'</option>';
}
    ?>
  </select>
</div>
     </div>
                <div class="col-md-4">
                <div class="input-group input-group-sm mb-3">
  <select class="form-select" id="inputGroupSelect01"  onchange="
                    location.replace('search.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_2='+this.value)
     ">
    <option selected disabled>Tag 2</option>
    <?php
$stmt = $conn->prepare("SELECT DISTINCT tag_2 FROM news");
$stmt->execute();
$tag_2_fetch = $stmt->fetchAll();
foreach($tag_2_fetch as $row){
if($row['tag_2'] == ''){
    $item_tag_2 = 'NO TAG 2';
    $item_tag_2_value = '';
}
else{
    $item_tag_2 = $row['tag_2'];
    $item_tag_2_value = $row['tag_2'];
}

echo '<option value="'.$item_tag_2_value.'"'; 

echo (isset($_GET['tag_2']) && $_GET['tag_2'] == $item_tag_2_value) ? 'selected' : '';

echo '>'.$item_tag_2.'</option>';
}
    ?>
  </select>
</div>
    </div>
    <div class="col-md-3">
          <div class="input-group input-group-sm mb-3">
  <select class="form-select" id="inputGroupSelect01" onchange="
                    location.replace('search.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_3='+this.value)
     ">
    <option selected disabled>Tag 3</option>
    <?php
$stmt = $conn->prepare("SELECT DISTINCT tag_3 FROM news");
$stmt->execute();
$tag_3_fetch = $stmt->fetchAll();
foreach($tag_3_fetch as $row){
if($row['tag_3'] == ''){
    $item_tag_3 = 'NO TAG 3';
    $item_tag_3_value = '';
}
else{
    $item_tag_3 = $row['tag_3'];
    $item_tag_3_value = $row['tag_3'];
}

echo '<option value="'.$item_tag_3_value.'"'; 

echo (isset($_GET['tag_3']) && $_GET['tag_3'] == $item_tag_3_value) ? 'selected' : '';

echo '>'.$item_tag_3.'</option>';
}
    ?>
  </select>
</div>
    </div>
    <div class="col-md-1">
        <div class=" mb-3">
    <button class="btn btn-warning btn-sm" onclick="location.replace('search.php')"><i class="fa fa-undo" aria-hidden="true"></i></button>
</div>           
    </div>
               <!-- End Display Entries Length Select/Dropdown Block-->
                <!-- Search Block -->

                <!-- End of Search Block -->
            </div>
            <!-- List Data Block -->
            <div class="row tagBody">
                <!-- Display List Item From Database-->
                <?php 
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $tag_content = $stmt->fetchAll();
                foreach($tag_content as $row){
                    
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
                    
      echo '
      <div class="col-md-3">    
      <div class="card col-sm-4 col-md-3 newsCard">
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
              <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a></li>
              <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a></li>
              <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
              <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/article_content.php?code='.$row['code'].'&media=https://www.ukrzmi.com/images/'.$row['photo'].'&description='.$row['title'].'" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
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
            <!-- Pagination Buttons Block -->
            <div class="w-100">
                <div class="btn-group paginate-btns  justify-content-center">
                    <!-- Previous Page Button -->
                    <a class="btn btn-outline-primary btn-sm  <?php echo ($page == 0)? 'disabled' :'' ?>" href="search.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&page=<?php echo ($page).$with_length.$with_search ?>" >Prev.</a>
                    <!-- End of Previous Page Button -->
                    <!-- Pages Page Button -->

                    <!-- looping page buttons  -->
                    <?php for($i = 1; $i <= $page_btn_count; $i++): ?>
                    <!-- Display button blocks  -->

                    <!-- Limiting Page Buttons  -->
                    <?php if($page_btn_count > 10): ?>
                    <!-- Show ellipisis button before the last Page Button  -->
                    <?php if($i == $page_btn_count && !in_array($i, range( ($page - 3), ($page + 3) ) )): ?>
                    <a class="btn btn-outline-primary btn-sm  ellipsis">...</a>
                    <?php endif; ?>

                    <!-- Show ellipisis button after the First Page Button  -->
                    <?php if($i == 1 || $i == $page_btn_count || (in_array($i, range( ($page - 3), ($page + 3) ) )) ): ?>
                    <a class="btn btn-outline-primary btn-sm  <?php echo ($i == ($page + 1)) ? 'bg-primary text-light border-primary' : '';  ?>" href = "search.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&page=<?php echo $i.$with_length.$with_search ?>"><?php echo $i; ?></a>
                    <?php if($i == 1 && !in_array($i, range( ($page - 3), ($page + 3) ) )): ?>
                    <a class="btn btn-outline-primary btn-sm  ellipsis">...</a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php else: ?>
                    <a class="btn btn-outline-primary btn-sm  <?php echo ($i == ($page + 1)) ? 'bg-primary text-light border-primary' : '';  ?>" href = "search.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&page=<?php echo $i.$with_length.$with_search ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                    <!-- Display button blocks  -->
                    <?php endfor; ?>
                    <!-- End of looping page buttons  -->

                    <!-- End of Pages Page Button -->
                    <!-- Next Page Button -->
                    <a class="btn btn-outline-primary btn-sm  <?php echo (($page+1) == $page_btn_count)? 'disabled' :'' ?>" href="search.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&page=<?php echo ($page+2).$with_length.$with_search ?>" >Next</a>
                    <!-- End of Next Page Button -->
                </div>
            </div>
            <!-- End Pagination Buttons Block -->
        </div>
    </div>
