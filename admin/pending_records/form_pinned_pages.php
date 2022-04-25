<div class="card">
                  <div class="card-header">
       <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
       </div> 
        <h3 class="card-title">Page specific pinning</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-warning" id="more_fields" onclick="add_fields();" value="Add More">
                New Block
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">


        <input type="hidden" name="blockk0" value="0" />
        <div class="row">
            <div class="col-md-1 pt-3">
                <h5 class="font-weight-bold pt-3">Block</h5>
            </div>

            <div class="col-md-1">
                <div class="icheck-primary d-inline">
                    <input type="checkbox" name="pinCardd0" value="1" id="pinCardd0">
                    <label for="pinCardd0">
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Pin card to page:</label>
                    <div class="form-group">
                        <select class="form-control select2bs4" name="cardPage0">
                            <option value="">Home page</option>
                            <option value="category">Category page</option>
                            <option value="tag">Tags page</option>
                            <option value="voice">Voices page</option>
                            <option value="interview">Interviews page</option>
                            <option value="video">Videos page</option>
                        </select>
                    </div>
                </div>
            </div>
<div class="col-md-2">
  <div class="form-group">
  <label>Block number:</label>
    <div class="form-group">
       <select class="form-control select2bs4" name="block0">                       
        <?php
           for($y = 1; $y<=10; $y++){
             echo '<option value="'.$y.'">Block '.$y.'</option>';
          }
        ?>
          </select>
      </div>
  </div>
</div>            
            <div class="col-md-2">
                <label>Pin Position:</label>
                <div class="form-group">
                    <select class="form-control select2bs4" name="cardPositionn0">

                        <?php
                        for ($x = 0; $x <= 12; $x++) {
                            echo '
<option value="' . $x . '">Card ' . $x . '</option>
';
                        };
                        ?>

                    </select>
                </div>

            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label>Pin card from:</label>
                    <div class="input-group date" id="reservationdatetimeFF0" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="pinFromm0" data-target="#reservationdatetimeFF0" placeholder="From" />
                        <div class="input-group-append" data-target="#reservationdatetimeFF0" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label>Pin card to:</label>
                    <div class="input-group date" id="reservationdatetimeTT0" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="pinToo0" data-target="#reservationdatetimeTT0" placeholder="To" />
                        <div class="input-group-append" data-target="#reservationdatetimeTT0" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <hr />

        <div id="room_fileds">

        </div>




    </div>
    <!-- /.card-body -->
</div>



