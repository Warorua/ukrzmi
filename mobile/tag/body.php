
    <div class="row justify-content-center">
        <div class="col-12">
          
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
            $sql = "SELECT * FROM `news` ".$search_where." order by id desc";

            // Setting up url $_GET Data if display length and search keyword is set.
            $with_length = (isset($_GET['length']))? "&length=".$_GET['length'] : 8;
            $with_search = (isset($_GET['search']))? "&search=".$_GET['search'] : '';
            ?>
            <div class='row d-flex justify-content-between'>
                <!-- Display Entries Length Select/Dropdown Block-->

   
   <div class="col-md-3">
                <div class="input-group input-group-sm mb-3">
  <select class="form-select" id="inputGroupSelect01"   onchange="
                    location.replace('tag.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_1='+this.value)
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
    <div class="col-md-3">
                <div class="input-group input-group-sm mb-3">
  <select class="form-select" id="inputGroupSelect01"  onchange="
                    location.replace('tag.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_2='+this.value)
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
   
     <div class="col-md-2">
                <div class="input-group input-group-sm mb-3"> 
  <select class="form-select" id="inputGroupSelect01"  onchange="
                    location.replace('tag.php?tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_2=<?php echo (isset($_GET['tag_2'])) ? $_GET['tag_2'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&type='+this.value)
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
   <div class="col-md-3">
                <div class="input-group input-group-sm mb-3">
  <select class="form-select" id="inputGroupSelect01"  onchange="
                    location.replace('tag.php?type=<?php echo (isset($_GET['type'])) ? $_GET['type'] : '' ?>&tag_1=<?php echo (isset($_GET['tag_1'])) ? $_GET['tag_1'] : '' ?>&tag_3=<?php echo (isset($_GET['tag_3'])) ? $_GET['tag_3'] : '' ?>&length=<?php echo (isset($_GET['length'])) ? $_GET['length'] : 8 ?>&tag_id=<?php echo (isset($_GET['tag_id'])) ? $_GET['tag_id'] : '' ?>&tag_2='+this.value)
     ">
    <option selected disabled>Order by relevancy</option>
    <?php
$stmt = $conn->prepare("SELECT DISTINCT tag_2 FROM news");
$stmt->execute();
$tag_2_fetch = $stmt->fetchAll();
foreach($tag_2_fetch as $row){
if($row['tag_2'] == ''){
    $item_tag_2 = 'Search by relevance';
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
 

    <div class="col-md-1">
    <a id="testHide" class="">
        <i id="lightOff" class="fa fa-lightbulb-o fa-lg text-warning"></i>
        <i id="lightOn" class="fa fa-lightbulb-o fa-lg text-dark"></i>
    </a>  
    </div>
  
    <!-- End Display Entries Length Select/Dropdown Block-->
                <!-- Search Block -->

                <!-- End of Search Block -->
            </div>
<div class="row">
<div class="col-md-12">
        
  <?php
include 'tag/list.php'
      ?>    
</div>
</div>

      
        </div>
    </div>
