
<div class="card">
        <div class="card-header">
          <h3 class="card-title">Edit pin details:</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
  <?php
  $stmt = $conn->prepare("SELECT *, blocks.id as blockid FROM pinned LEFT JOIN blocks ON blocks.id=pinned.block_id WHERE card_id=:card_id");
  $stmt->execute(['card_id'=>$data['id']]);
  $pin = $stmt->fetchAll();
  foreach($pin as $row){
    if($row['name'] != ''){
      $blockHide = 'style="display:none"';
      $blockName = $row['name'];
          if($row['active'] != 1){
      $disabled = 'disabled';
    }
    else{
      $disabled = '';
    }
    }
    else{
      $blockHide = '';
      $blockName = $row['page'].' page';
    }

  echo '
  <div class="row">
<div class="col-md-2 pt-3">
   <h5 class="font-weight-bold pt-3">'.$blockName.'</h5>
</div>

  <div class="col-md-1">
  <div class="icheck-primary d-inline">
  <input type="checkbox" name="pinCard'.$row['id'].'" value="1" id="pinCard'.$row['id'].'" checked>
  <label for="pinCard'.$row['id'].'">
  </label>
</div>
  </div>

  <div class="col-md-2">
  <label>Pin Position:</label>
  <div class="form-group">
                    <select class="form-control select2bs4" name="cardPosition'.$row['id'].'" '.$disabled.'>
                    <option value="'.$row['position'].'" selected>Card '.$row['position'].'</option>              
      ';

 for ($x = 0; $x <= intval($row['articles']); $x++) {
  $stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM pinned WHERE block_id=:block_id AND position=:position");
  $stmt->execute(['block_id'=>$row['id'], 'position'=>$x]);
  $pin_disabler = $stmt->fetch();
  if($pin_disabler['numrows'] > 0){
    $disabled = "disabled";
    $dis_message = '&#128711;';
  }
  else{
    $disabled = "";
    $dis_message = '';
  }
  
echo '
<option value="'.$x.'" '.$disabled.'>Card '.$x.' '.$dis_message.'</option>
';
   };

   echo '              
                  </select>
     </div>
          
  </div>

  <div class="col-md-2">
  <div class="form-group">
                  <label>Pin card from:</label>
                    <div class="input-group date" id="reservationdatetimeF'.$row['id'].'" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="pinFrom'.$row['id'].'" data-target="#reservationdatetimeF'.$row['id'].'" value="'.$row['pinned_from'].'" placeholder="From"  '.$disabled.'/>
                        <div class="input-group-append" data-target="#reservationdatetimeF'.$row['id'].'" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
  </div>
  <div class="col-md-3">
  <div class="form-group">
                  <label>Pin card to:</label>
                    <div class="input-group date" id="reservationdatetimeT'.$row['id'].'" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="pinTo'.$row['id'].'" data-target="#reservationdatetimeT'.$row['id'].'"  value="'.$row['pinned_to'].'" placeholder="To"  '.$disabled.'/>
                        <div class="input-group-append" data-target="#reservationdatetimeT'.$row['id'].'" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
  </div>
  </div>

  <div '.$blockHide.' class="col-md-2">
  <div class="form-group">
                  <label>Block number:</label>
                    <div class="form-group">
                       <select class="form-control select2bs4" name="block'.$row['id'].'"> 
                       <option value="'.$row['block_id'].'">Block '.$row['block_id'].'</option>
                       ';
              for($y = 0; $y<=10; $y++){
                echo '<option value="'.$y.'">Block '.$y.'</option>';
              }
                       
echo '
                       </select>
                    </div>
  </div>
  </div>

</div>
<hr/>
 
  ';
  }
  
  ?>

      </div>
        <!-- /.card-body -->
      </div>