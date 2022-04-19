
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Article Main Image</h3>
              </div>
              <div class="card-body">
               <div class="row">
                 <div class="col-md-4">
                 <img src="../scrap2/images/<?php echo $data['photo'] ?>" width="100%">
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
 