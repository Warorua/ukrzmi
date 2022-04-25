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
            <h1 class="m-0">Pinned articles Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pinned articles</li>
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
                <h3 class="card-title">Pinned articles. <a class="btn btn-primary btn-sm" href="pinned_articles_stats.php">Pinned articles stats</a></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="scrapedData" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    
                    <th>Code</th>
                    <th>Title</th>
                    <th>Block</th>
                    <th>Card No.</th>
                    <th>Page</th>
                    <th>From</th>
                    <th>To</th>                  
                    <th>Published on</th>
                    <th>Hours remaining</th>
                    <th>Days remaining</th>
                    <th>Source</th>
                    <th>Image</th>
                    <th>Details</th>
                  </tr>
                  </thead>
                  <tbody>
<?php
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT *, pinned.position AS pinplace FROM pinned LEFT JOIN news ON pinned.card_id=news.id LEFT JOIN blocks ON pinned.block_id=blocks.id ORDER BY pinned.id DESC ");
$stmt->execute();
$pinned = $stmt->fetchAll();
foreach($pinned as $row){
if($row['page'] == ''){
  $pinPage = 'Home';
}
else{
  $pinPage = $row['page'];
}

  // Declare and define two dates
  $date1 = strtotime(date("D, d M Y H:i:s"));
  $date2 = strtotime($row['pinned_to']);
 
  // Formulate the Difference between two dates
  $diff = $date2 - $date1;
if($date1 > $date2){
  $days = '<div class="badge badge-danger">EXPIRED</div>';
  $hours = '<div class="badge badge-danger">EXPIRED</div>';
}
else{
    $days = $diff/60/60/24; 

  $hours = $diff/60/60;
  $days = '<div class="badge badge-success text-dark">'.number_format($days, 1).' DAYS</div>';
  $hours = '<div class="badge badge-success text-dark">'.number_format($hours, 1).' HOURS</div>';
 
 
}

 echo '
                    <tr>
                    <td>'.$row['code'].'</td>
                    <td>'.$row['title'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>Card '.$row['pinplace'].'</td>
                    <td>'.$pinPage.'</td>
                    <td>'.$row['pinned_from'].'</td>
                    <td>'.$row['pinned_to'].'</td>
                    <td>'.$row['published'].'</td>
                    <td>'.$hours.'</td>
                    <td>'.$days.'</td>
                    <td>'.$row['source'].'</td>
                    <td><img src="../images/'.$row['photo'].'" width="80px" /></td>
                    <td>
                    <div class="dropdown">
  <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
    Admin action
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="pending_news.php?id='.$row['id'].'">Edit article</a>
    <a class="dropdown-item"  href="article_unpin.php?id='.$row['id'].'">Unpin</a>
  </div>
                    </td>
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
