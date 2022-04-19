<?php
include 'components/header.php';
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../bower/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <?php
include 'components/topbar.php';
include 'components/navbar.php';
?>

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Active Blocks View</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blocks View</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="card">

              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Content Cat</th>
                    <th>Article Size</th>
                    <th>Background Color</th>
                    <th>Page</th>
                    <th>Position</th>
                    <th>Type</th>
                    <th>Created on</th>
                    <th></th>
                <th></th>
                  </tr>
                  </thead>
                  <tbody>
<?php
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM blocks");
$stmt->execute();
$block = $stmt->fetchAll();
foreach($block as $row){
  if($row['position'] == 404){
    $blockPos = '<div class="badge badge-danger">NEUTRAL</div>';
  }
  else{
    $posad = $row['position'] + 1;
    $blockPos = '<div class="badge badge-success">Row '.$posad.'</div>';
  }

  if($row['mode'] == 'thematic'){
    $blockType = '<div class="badge badge-primary">THEMATIC BLOCK</div>';
  }
  else{
    $blockType = '<div class="badge badge-warning">PANEL BLOCK</div>';
  }

  if($row['mode'] == 'thematic'){
    $blockPage = '<div class="badge badge-secondary">'.$row['page'].' page</div>';
  }
  else{
    $blockPage = '<div class="badge badge-light">Home page</div>';
  }

  if($row['mode'] == 'thematic'){
    $blockLink = 'data-toggle="modal" data-target="#thematicEdit'.$row['id'].'"';
  }
  else{
    $blockLink = 'href="block_edit.php?id='.$row['id'].'"';
  }
  $bid = str_replace($row['name'], " ", "");
   echo '
                    <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['type'].'</td>
                    <td>'.$row['articles'].'</td>
                    <td> <i class="fa fa-square show-icon" style="color:'.$row['bg_color'].'"></i>  '.$row['bg_color'].'</td>
                    <td>'.$blockPage.'</td>
                    <td>'.$blockPos.'</td>
                    <td>'.$blockType.'</td>
                    <td>'.$row['created_on'].'</td>
                    <td><a class="btn btn-primary" '.$blockLink.'>Edit</a></td>
  <td>
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#'.$bid.'_'.$row['id'].'">
                  Delete
  </button>
  <div class="modal fade" id="'.$bid.'_'.$row['id'].'">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete '.$row['name'].' block?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this block? <br/>&hellip;</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">No</button>
        <a class="btn btn-outline-success" href="block_system/block_delete.php?id='.$row['id'].'">Yes</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
  </td>
                  </tr>
                  <div class="modal fade" id="thematicEdit'.$row['id'].'">
                  <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <form method="POST" action="block_edit_thematic.php">  
                    <div class="modal-header">Edit "'.$row['name'].'" thematic block</div>
                    <div class="modal-body"> 
                      <div class="col-md-12">
                  <div class="form-group">
                                      <label for="exampleInputEmail1">Page to place the block</label>
                                      <div class="form-group">
                              
                                    <select class="form-control select2bs4" data-placeholder="Enter keywords" name="page" style="width: 100%;"  required>
                                    <option value="'.$row['page'].'" selected>'.$row['page'].' page</option>
                                    <option value="home">Home page</option>
                                      <option value="category">Category page</option>
                                      <option value="video">Video page</option>
                                          
                                    </select>
                                    <input type="hidden" name="id" value="'.$row['id'].'" />
                                  </div> 
                                    </div>
                  </div>
                  <div class="col-md-12">
                  <div class="form-group">
                                      <label for="exampleInputEmail1">Category Content</label>
                                      <div class="form-group">
                              
                                    <select class="form-control select2bs4" data-placeholder="Enter keywords" name="type" style="width: 100%;"  required>
                                    <option value="'.$row['type'].'" selected>'.$row['type'].'</option>
                                    ';
                  
                  $stmt = $conn->prepare("SELECT DISTINCT category FROM news");
                  $stmt->execute();
                  $cat = $stmt->fetchAll();
                  foreach($cat as $row2){
                          echo '<option value="'.$row2['category'].'">'.$row2['category'].'</option>';
                  }
                   echo '
                                    </select>
                                  </div> 
                                    </div>
                  </div>
                     
                    </div>
                  <div class="modal-footer">
                  <div class="d-flex justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-success">Process</button>
                  </div>
                  </div>
                    </form> 
                  </div>
                  </div>
                  </div>
                   
   '; 
}
?>
 

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
include 'components/footer.php';
?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php
include 'components/scripts.php';
?>
<?php
include 'components/alert.php';
?>
</body>
</html>
