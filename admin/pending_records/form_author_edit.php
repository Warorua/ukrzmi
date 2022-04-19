
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Author<small class="text-danger"> <i class="fa fa-asterisk" aria-hidden="true"></i> (Required)</small> </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
           
                <div class="card-body">

         <div class="row">
             <div class="col-md-6">
                  <div class="form-group">
                  <div class="icheck-primary d-inline">
                        <input type="radio" onclick="preSelectA()" id="radioPrimary1" name="r1" checked>
                        <label for="radioPrimary1">
                            Pre Select
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" onclick="addNewA()" id="radioPrimary2" name="r1">
                        <label for="radioPrimary2">
                            Add New
                        </label>
                      </div>
                  </div>
             </div>

         </div>

         <div class="row">
             <div id="authorA" class="col-md-12">
                  <div class="form-group">
                    <label >Pre Select</label>
                    <select class="form-control select2bs4" id="preSelectAuthor" name="author">
                    <option>Select Author</option>
                    <option value="<?php echo $data['author'] ?>" selected><?php echo $data['author'] ?></option> 
                    <option value="<?php echo $admin['firstname'] ?> <?php echo $admin['lastname'] ?>"><?php echo $admin['firstname'] ?> <?php echo $admin['lastname'] ?></option>                 
                   <?php
$stmt = $conn->prepare("SELECT DISTINCT author FROM news ORDER BY author ASC");
$stmt->execute();
$author_select = $stmt->fetchAll();
foreach($author_select as $row){
    echo '
    <option value="'.$row['author'].'">'.$row['author'].'</option>
    ';
}
                    ?>

                  </select>
    
                  </div>
             </div>
             <div id="authorB" class="col-md-12" style="display: none;">
             <div class="form-group">
                    <label >Add New</label>
                    <input type="text" class="form-control" id="addNewAuthor" name="author" placeholder="Add new author"/>
    
                  </div>
             </div>
         </div>


                </div>
                <!-- /.card-body -->

  
            </div>
            