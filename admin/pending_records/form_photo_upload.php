
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
                            <div class="card-header">
       <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
       </div> 
                <h3 class="card-title">Article Main Image</h3>
              </div>
              <div class="card-body">
               <div class="row">
                 <div class="col-md-4">
                 <img src="<?php echo $myPhoto ?>" width="100%">
                 </div>
                 <div class="col-md-6">
                   <div class="form-group">
                                      <label for="exampleInputFile">New image input</label>
                   <div class="input-group">
                   <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" value="<?php echo $data['photo'] ?>" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose new image</label>
                   </div>
                  </div>
                   </div>

                 </div>
               </div>
              
              </div>
             



              <!-- /.card-body -->
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
 