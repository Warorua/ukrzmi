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
            <h1 class="m-0">Pending articles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Saved articles</li>
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
                <h3 class="card-title">Pending articles.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="scrapedData" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Source</th>

                    <th>Category</th>
                    <th>Published</th>
                    <th>Photo Code</th>

                    <th>Details</th>
                  </tr>
                  </thead>
                  <tbody>
<?php
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM news WHERE input=:input AND post_status=1 ORDER BY id DESC");
$stmt->execute(['input'=>'manual']);
$scrape = $stmt->fetchAll();
foreach($scrape as $row){
   echo '
                    <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['code'].'</td>
                    <td>'.$row['title'].'</td>
                    <td>'.$row['source'].'</td>
                    <td>'.$row['category'].'</td>
                    <td>'.$row['time'].'</td>
                    <td><img src="../scrap2/images/'.$row['photo'].'" width="150px" /></td>
                    <td><a class="btn btn-success btn-sm" href="pending_news.php?id='.$row['id'].'">Preview</a></td>
                  </tr>
  
   '; 
}
?>
 

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Source</th>
                    <th>Category</th>
                    <th>Published</th>
                    <th>Photo Code</th>
                    <th>Details</th>
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
