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
            <h1 class="m-0">SMTP Mails</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">SMTP Mails</li>
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
                <h3 class="card-title">System SMTP Mails</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="scrapedData" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Mail</th>
                    <th>Mail Key</th>

                    <th>Host</th>
                    <th>Port</th>
                    <th>Set from</th>

                    <th>Edit</th>
                  </tr>
                  </thead>
                  <tbody>
<?php
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM mail ORDER BY name ASC");
$stmt->execute();
$mail = $stmt->fetchAll();
foreach($mail as $row){
   echo '
                    <tr>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['subject'].'</td>
                    <td>'.$row['mail'].'</td>
                    <td>'.$row['mail_password'].'</td>
                    <td>'.$row['host'].'</td>
                    <td>'.$row['port'].'</td>
                    <td>'.$row['set_from'].'</td>
                    <td><a class="btn btn-success btn-sm" href="mail_edit.php?auth='.$row['name'].'&id='.$row['id'].'">Details</a></td>
                  </tr>
  
   '; 
}
?>
 

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Name</th>
                    <th>Subject</th>
                    <th>Mail</th>
                    <th>Mail Key</th>

                    <th>Host</th>
                    <th>Port</th>
                    <th>Set from</th>

                    <th>Edit</th>
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
