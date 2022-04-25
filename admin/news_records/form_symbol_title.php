
<div class="card card-primary card-outline">
                        <div class="card-header">
       <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
       </div> 
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Symbol before title
            </h3>
          </div>
          <div class="card-body">        

            <div class="tab-content" id="custom-content-above-tabContent">

            <div class="row">
             <div class="col-md-6">
                  <div class="form-group">
                  <div class="icheck-primary d-inline">
                        <input type="radio" onclick="titleBadgeHide()" id="radioPrimary5" name="r2" checked>
                        <label for="radioPrimary5">
                            None
                        </label>
                      </div>
                  <div class="icheck-primary d-inline">
                        <input type="radio" onclick="flagA()" id="radioPrimary3" name="r2">
                        <label for="radioPrimary3">
                            Flag
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" onclick="logoA()" id="radioPrimary4" name="r2">
                        <label for="radioPrimary4">
                            Logo
                        </label>
                      </div>
                  </div>
             </div>

         </div>

<div class="row">
         <div class="form-group col-md-6" id="preSelectFlagA" style="display: none;">
                    <label >Select Flag</label>
                    <select class="form-control select2bs4" id="preSelectFlag" name="title_badge">
                    <?php
$stmt = $conn->prepare("SELECT * FROM country ORDER BY common_name ASC");
$stmt->execute();
$author_select = $stmt->fetchAll();
foreach($author_select as $row){
  $javasflag = "components/coun_flags/".$row['flag']."";
    echo '
    <option onclick="show()" value="'.$javasflag.'">'.$row['common_name'].'</option>
    ';
}
                    ?>

                  </select>
    
                  </div>
 
        <div class="form-group col-md-6"  id="preSelectLogoA"  style="display: none;">
                    <label >Select Logo</label>
                    <select class="form-control select2bs4" id="preSelectLogo" name="title_badge">
                    <option></option>
                    <?php
$stmt = $conn->prepare("SELECT * FROM logo ORDER BY name ASC");
$stmt->execute();
$author_select = $stmt->fetchAll();
foreach($author_select as $row){
  $javaslogo = "components/logos/".$row['image']."";
    echo '
    <option onclick="show()" value="'.$javaslogo.'">'.$row['name'].'</option>
    ';
}
                    ?>
                  </select>
    
                  </div>
                  <div class="col-md-2"></div>       
              <div class="col-md-4">
               
              <img id="hoImage" src="" width="150px" />
              </div>
                </div>  
 <!-- /.form group -->
          </div>
          </div>
          <!-- /.card -->
        </div>
