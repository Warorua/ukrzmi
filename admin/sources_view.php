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
            <h1 class="m-0">Sources & URLs</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sources & URLs</li>
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
                <h3 class="card-title">System Sources & URLs</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="scrapedData" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>URLs Count</th>
                    <th>Status</th>
                    <th>Logo</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Date added</th> 
                    <th>Trust index</th>
                    <th>About</th>
                    <th>Source URLs</th>
                                 
                  </tr>
                  </thead>
                  <tbody>
<?php
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT DISTINCT parent FROM news ORDER BY id ASC");
$stmt->execute();
$source = $stmt->fetchAll();
foreach($source as $row){
$stmt = $conn->prepare("SELECT * FROM news WHERE parent=:parent ORDER BY id ASC LIMIT 1");
$stmt->execute(['parent'=>$row['parent']]);
$url = $stmt->fetchAll(); 

$stmt = $conn->prepare("SELECT COUNT(DISTINCT source) AS numrows FROM news WHERE parent=:parent");
$stmt->execute(['parent'=>$row['parent']]);
$url_cont = $stmt->fetch(); 

foreach($url as $row2){
    if($row['parent'] == "ua.korrespondent.net"){
        $rowParent = "Кореспондент";
      }
      elseif($row['parent'] == "pravda.com.ua"){
        $rowParent = "правда";
      }
      elseif($row['parent'] == "eurointegration.com.ua"){
        $rowParent = "євроінтеграція";
      }
      elseif($row['parent'] == "unian.ua"){
        $rowParent = "уніанської";
      }
      elseif($row['parent'] == "life.pravda.com.ua"){
        $rowParent = "life.pravda";
      }
      elseif($row['parent'] == "theguardian.com"){
        $rowParent = "The guardian";
      }
      elseif($row['parent'] == ""){
        $rowParent = '<div class="badge badge-danger">UNKNOWN</div>';
      }
   echo '
                    <tr>
                    <td>'.$url_cont['numrows'].'</td>
                    <td><div class="badge badge-success">ONLINE</div></td>
                    <td><div class="badge badge-secondary">NULL</div></td>
                    <td>'.$rowParent.'</td>
                    <td>UKRAINE</td>
                    <td>'.$row2['time'].'</td>
                    <td>80</td>
                    <td><div class="badge badge-secondary">NULL</div></td>
                    <td><a class="btn btn-primary btn-sm" href="urls_view.php?parent='.$row['parent'].'">URLs</a></td>
                  </tr>
  
   '; 
}

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
