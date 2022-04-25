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
            <h1 class="m-0">Authors Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Authors Data</li>
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
                <h3 class="card-title">Authors Data.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="scrapedData" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Photo</th>

                    <th>Role</th>
                    <th>Status</th>
                    <th>Reports</th>
                    <th>Evaluations</th>
                    <th>Trust Index</th>
                    <th>Description</th>
                    <th>Content</th>
                    

                    <th>Admin</th>
                  </tr>
                  </thead>
                  <tbody>
<?php
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM authors");
$stmt->execute();
$author = $stmt->fetchAll();
foreach($author as $row){
$name = mb_convert_encoding($row['name'], "utf-8");
$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE author=:author");
$stmt->execute(['author'=>$name]);
$author_count = $stmt->fetch();
   echo '
                    <tr>
                    <td></td>
                    <td>'.$name.'</td>
                    <td></td>

                    <td></td>
                    <td>Active</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
          



                    <td>'.$author_count['numrows'].'</td>
                    <td><a class="btn btn-info" href="author_article.php?id='.$row['id'].'">Admin</a></td>
                  </tr>
  
   '; 
}
?>
 

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Name</th>
                    <th>Photo</th>
                    
                    <th>Role</th>
                    <th>Status</th>
                    <th>Reports</th>
                    <th>Evaluations</th>
                    <th>Trust Index</th>
                    <th>Description</th>
                    <th>Content</th>
       
                    <th>Admin</th>
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
<script>
      ////news
setInterval(function(){ 
      $.ajax({    
        type: "GET",
        url: "home_ajax/author_view_table.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#authorView").html(data); 
         
        }
    });

}, 100);
</script>
</body>
</html>
