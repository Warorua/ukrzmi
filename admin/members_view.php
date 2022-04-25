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
            <h1 class="m-0">Registered Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Registered Users</li>
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
                            <div class="card-header">
       <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
       </div> 
                <h3 class="card-title">System Registered Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="scrapedData" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Registered on</th>
                    <th>Activation</th> 
                    <th></th>              
                  </tr>
                  </thead>
                  <tbody>
<?php
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM users ORDER BY id ASC");
$stmt->execute();
$mail = $stmt->fetchAll();
foreach($mail as $row){
    if($row['status'] == 2){
        $activation = '<span class="badge badge-success">Activated</span>';
    }
    else{
        $activation = '<span class="badge badge-danger">UNACTIVATED</span>';
    }
    if($row['type'] == 1){
        $status = '<span class="badge badge-warning">Admin</span>';
    }
    else{
        $status = '<span class="badge badge-primary">User</span>';
    }
   echo '
                    <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['firstname'].'</td>
                    <td>'.$row['lastname'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['created_on'].'</td>
                    <td>'.$activation.'</td>
                    <td>'.$status.'</td>
                  </tr>
  
   '; 
}
?>
 

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Registered on</th>
                    <th>Activation</th>  
                    <th></th>      
                </tr>
                  </tfoot>
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
