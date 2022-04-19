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
            <h1 class="m-0">Active Flags Library</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Flags Library</li>
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
                    <th>CCN3</th>
                    <th>Name</th>
                    <th>Capital</th>
                    <th>Continent</th>
                    <th>Population</th>
                    <th>Language</th>
                    <th>Flag</th>
  
                  </tr>
                  </thead>
                  <tbody>
<?php
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM country");
$stmt->execute();
$block = $stmt->fetchAll();
foreach($block as $row){
   echo '
                    <tr>
                    <td>'.$row['ccn3'].'</td>
                    <td>'.$row['common_name'].'</td>
                    <td>'.$row['capital'].'</td>
                    <td>'.$row['region'].'</td>
                    <td>'.$row['population'].'</td>
                  <td>'.$row['language'].'</td>
                    <td><img src="components/coun_flags/'.$row['flag'].'" width="100px"/></td>
 
                  </tr>
  
   '; 
}
?>
 

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>CCN3</th>
                    <th>Name</th>
                    <th>Capital</th>
                    <th>Continent</th>
                    <th>Population</th>
                    <th>Language</th>
                    <th>Flag</th>
  
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
