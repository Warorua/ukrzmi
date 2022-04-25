
          <div class="card card-primary">
                            <div class="card-header">
       <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
       </div> 
                <h3 class="card-title">Article Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
           
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Article Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Article Title" value="<?php echo $data['title'] ?>">
                  </div>

         <div class="row">
             <div class="col-md-6">
                  <div class="form-group">
                    <label >Source</label>
                    <select class="form-control select2bs4" id="source" name="source"  placeholder="Article Source">
                    <option value="<?php echo $data['source'] ?>" selected><?php echo $data['source'] ?></option>
<?php
$stmt = $conn->prepare("SELECT DISTINCT parent FROM news WHERE NOT parent=:parent ORDER BY category ASC");
$stmt->execute(['parent'=>'']);
$parent_select = $stmt->fetchAll();
foreach($parent_select as $row){
echo '
<option value="'.$row['parent'].'">'.$row['parent'].'</option>
';
}
  ?>

</select>
                  </div>
             </div>
             <div class="col-md-6">
             <div class="form-group">
                    <label >Deep Link</label>
                    <input type="url" class="form-control" id="deep_link" name="deep_link" placeholder="Article Deep Link"  value="<?php echo $data['deep_link'] ?>">
                  </div>
             </div>
         </div>

         <div class="row">
             <div class="col-md-12">
                  <label >Category</label>
             <div class="form-group">
                   
                    <select class="form-control select2bs4" id="category" name="category" >
                    <option  value="<?php echo $data['category'] ?>" selected><?php echo $data['category'] ?></option>
                  <?php
$stmt = $conn->prepare("SELECT DISTINCT category FROM news ORDER BY category ASC");
$stmt->execute();
$category_select = $stmt->fetchAll();
foreach($category_select as $row){
    echo '
    <option value="'.$row['category'].'">'.$row['category'].'</option>
    ';
}
                    ?>

                  </select>
    
                  </div>
             </div>
             <div class="col-md-12">
             <label >Content type</label>           
             <div class="form-group">
                   
                   <select id="contSel" onchange="contentTyp()" class="form-control select2bs4" name="type">
                   <?php
                    if($data['type'] == ''){
                      $typeData = 'News';
                      $typeDataVal = '';
                    } 
                    else{
                      $typeData = $data['type'];
                      $typeDataVal = $data['type'];
                    }                   
                    ?>
                   <option value="<?php echo $typeDataVal ?>"><?php echo $typeData ?></option>
                   <option value="">News</option>
                 <?php
$stmt = $conn->prepare("SELECT DISTINCT type FROM news WHERE NOT type=:type AND NOT type=:type_2 ORDER BY type ASC");
$stmt->execute(['type'=>'', 'type_2'=>'block']);
$type_select = $stmt->fetchAll();
foreach($type_select as $row){
   echo '
   <option value="'.$row['type'].'">'.$row['type'].'</option>
   ';
}
                   ?>

                 </select>
   
                 </div>
             </div>
<?php
if($data['type'] == 'video'){
  echo '
  <div id="videoRow" class="col-md-12">
  <label >Video URL</label>           
  <div class="form-group">                  
  <input type="url" class="form-control" id="video_url" name="video_url" value="'.$data['video_url'].'" placeholder="Video Link">              
      </div>
  </div>
  ';
}
else{
  echo '
  <div id="videoRow" style="display: none;" class="col-md-12">
  <label >Video URL</label>           
  <div class="form-group">                  
  <input type="url" class="form-control" id="video_url" name="video_url" placeholder="Video Link">              
      </div>
  </div>
  ';
}

?>

         </div>


                </div>
                <!-- /.card-body -->

  
            </div>
            