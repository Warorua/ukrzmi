
  <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fa fa-object-group"></i>
              Frame (Around Image)
            </h3>
          </div>
          <div class="card-body">        
<div class="row">
<div class="col-md-3">
<div id="picFrame" style="border: solid 4px; border-color:<?php echo $data['frame_color'] ?>">
  <img src="../scrap2/images/<?php echo $data['photo'] ?>" width="100%">
</div>
</div>
<div class="col-md-9">
              <div class="tab-content" id="custom-content-above-tabContent">
<!-- Color Picker -->
<div class="form-group">
                  <label>Frame Color picker:</label>

                  <div class="input-group my-colorpicker2">
                    <input id="frameCol" onchange="frameColo()" type="text" class="form-control" value="<?php echo $data['frame_color'] ?>" name="frame_color">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
 <!-- /.form group -->
          </div>
</div>
</div>

          </div>
          <!-- /.card -->
        </div>
