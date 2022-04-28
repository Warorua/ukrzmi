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
            <h1 class="m-0">Categories & Sub-categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categories & Sub-categories</li>
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
                <h3 class="card-title">System Categories & Sub-categories</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="scrapedData" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Sub-category 1 count</th>
                    <th>Sub-category 2 count</th>
                    <th>Status</th>
                    <th>Data count</th> 
                    <th>Sub-Category 1</th>  
                    <th>Sub-Category 2</th>            
                  </tr>
                  </thead>
                  <tbody>
<?php
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT DISTINCT category FROM news");
$stmt->execute();
$cat = $stmt->fetchAll();
foreach($cat as $row){
    $stmt = $conn->prepare("SELECT COUNT(DISTINCT sub_1) AS numrows FROM news WHERE category=:category");
    $stmt->execute(['category'=>$row['category']]);
    $sub1 = $stmt->fetch();

    $stmt = $conn->prepare("SELECT COUNT(DISTINCT sub_2) AS numrows FROM news WHERE category=:category");
    $stmt->execute(['category'=>$row['category']]);
    $sub2 = $stmt->fetch();

    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE category=:category");
    $stmt->execute(['category'=>$row['category']]);
    $dtct = $stmt->fetch();

    if($sub1['numrows'] > 1){
      $sub1Btn = 'href="subcat_view.php?type=sc1&cat='.$row['category'].'" class="btn btn-primary btn-sm"';
    }else{
        $sub1Btn = 'href="#" class="btn btn-primary btn-sm disabled"';
    }

    if($sub2['numrows'] > 1){
        $sub2Btn = 'href="subcat_view.php?type=sc2&cat='.$row['category'].'" class="btn btn-info btn-sm"';
    }else{
        $sub2Btn = 'href="#" class="btn btn-info btn-sm disabled"';
    }

   echo '
                    <tr>
                    <td></td>
                    <td>'.$row['category'].'</td>
                    <td>'.$sub1['numrows'].'</td>
                    <td>'.$sub2['numrows'].'</td>
                    <td><div class="badge badge-success">ONLINE</div></td>
                    <td>'.$dtct['numrows'].'</td>
                    <td><a '.$sub1Btn.'>ACTION</a></td>
                    <td><a '.$sub2Btn.'>ACTION</a></td>
                  </tr>
  
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
