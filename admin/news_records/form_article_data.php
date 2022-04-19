
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Article Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
           
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Article Title<small class="text-danger"> <i class="fa fa-asterisk" aria-hidden="true"></i> (Required)</small></label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Article Title" required>
                  </div>

         <div class="row">
             <div class="col-md-6">
                  <div class="form-group">
                    <label >Source<small class="text-danger"> <i class="fa fa-asterisk" aria-hidden="true"></i> (Required)</small></label>
                    <select class="form-control select2bs4" id="source" name="source"  placeholder="Article Source" required>

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
                    <label >Deep Link<small class="text-danger"> <i class="fa fa-asterisk" aria-hidden="true"></i> (Required)</small></label>
                    <input type="url" class="form-control" id="deep_link" name="deep_link" placeholder="Article Deep Link" required>
                  </div>
             </div>
         </div>

         <div class="row">
             <div class="col-md-12">
                  <label >Category<small class="text-danger"> <i class="fa fa-asterisk" aria-hidden="true"></i> (Required)</small></label>
             <div class="form-group">
                   
                    <select class="form-control select2bs4" id="category" name="category"  required>

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
             <label >Content type<small class="text-danger"> <i class="fa fa-asterisk" aria-hidden="true"></i> (Required)</small></label>           
             <div class="form-group">
                   
                   <select id="contSel" onchange="contentTyp()" class="form-control select2bs4" name="type" required>
                   <option value="" selected>News</option>
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

             <div id="videoRow" style="display: none;" class="col-md-12">
             <label >Video URL</label>           
             <div class="form-group">                  
             <input type="url" class="form-control" id="video_url" name="video_url" placeholder="Video Link" required>              
                 </div>
             </div>
         </div>


                </div>
                <!-- /.card-body -->

  
            </div>
            