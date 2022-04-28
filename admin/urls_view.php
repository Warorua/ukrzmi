<?php
include 'components/header.php';
if(!isset($_GET['parent'])){
    header('location: home.php');
}else{
    $conn = $pdo->open();
    $stmt = $conn->prepare("SELECT DISTINCT source FROM news WHERE parent=:parent");
    $stmt->execute(['parent'=>$_GET['parent']]);
    $data = $stmt->fetchAll();
}
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
            <h1 class="m-0">URLs data analysis</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">URLs data analysis</li>
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
                <h3 class="card-title">System URLs data analysis</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table id="scrapedData" class="table table-bordered table-striped">
                  <thead>
                  <tr style="font-size: 14px;">
                    <th>URL</th>
                    <th>Social media platform</th>
                    <th>Social media channel name</th>
                    <th>Social media channel link</th>
                    <th>Social media #members</th>
                    <th>Videos platform</th>
                    <th>Videos channel name</th>
                    <th>Videos channel link</th>
                    <th>Videos #members</th>
                    <th>Podcasts</th> 
                    <th>Link for T&C</th>
                    <th>Placement</th>
                    <th>Admin comments</th>
                    <th>1 to 3</th>
                    <th>Level #characters</th>
                    <th>Level %</th>
                    <th>URL quality level</th>
                    <th>Alerts</th>
                    <th>Category(Theirs)</th>
                    <th>Category(Ours)</th>
                    <th>Admin</th>
                    <th>URL history</th>
                    <th>Total</th>
                    <th>Average per week</th>
                    <th>Average per workday</th>
                    <th>Average per weekend</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                    <th>Today</th>
                    <th>Average weekly visitors</th>
                    <th>Average weekly item clicks</th>
                    <th>Average weekly clicks</th>
                    <th>Average weekly clicks</th>
                    <th>Average article time</th>
                    <th>Average weekly revenue</th>
                    <th>Total views(Millions)</th>
                    <th>Total views(000)</th>
                    <th>Clicks from homepage</th>
                    <th>Clicks from category page</th>
                    <th>Clicks from subcategory page</th>
                    <th>After content page </th>
                    <th>Source & URL relevance</th>
                    <th>Total content view duration</th>
                    <th>Av view duration per article</th>
                    <th>Paid AD impressions on page</th>
                    <th>Total income generated</th>
                    <th>Evaluations</th>
                    <th>Comments</th>
                    <th>Broken links</th>
                    <th>Admin</th>
                    
                                 
                  </tr>
                  </thead>
                  <tbody>
<?php
foreach($data as $row){

   echo '
                    <tr>
                    <td>'.$row['source'].'</td>
                    <td>Social media platform</td>
                    <td>Social media channel name</td>
                    <td>Social media channel link</td>
                    <td>Social media #members</td>
                    <td>Videos platform</td>
                    <td>Videos channel name</td>
                    <td>Videos channel link</td>
                    <td>Videos #members</td>
                    <td>Podcasts</td> 
                    <td>Link for T&C</td>
                    <td>Placement</td>
                    <td>Admin comments</td>
                    <td>1 to 3</td>
                    <td>Level #characters</td>
                    <td>Level %</td>
                    <td>URL quality level</td>
                    <td>Alerts</td>
                    <td>Category(Theirs)</td>
                    <td>Category(Ours)</td>
                    <td>Admin</td>
                    <td>URL history</td>
                    <td>Total</td>
                    <td>Average per week</td>
                    <td>Average per workday</td>
                    <td>Average per weekend</td>
                    <td>Monday</td>
                    <td>Tuesday</td>
                    <td>Wednesday</td>
                    <td>Thursday</td>
                    <td>Friday</td>
                    <td>Saturday</td>
                    <td>Sunday</td>
                    <td>Today</td>
                    <td>Average weekly visitors</td>
                    <td>Average weekly item clicks</td>
                    <td>Average weekly clicks</td>
                    <td>Average weekly clicks</td>
                    <td>Average article time</td>
                    <td>Average weekly revenue</td>
                    <td>Total views(Millions)</td>
                    <td>Total views(000)</td>
                    <td>Clicks from homepage</td>
                    <td>Clicks from category page</td>
                    <td>Clicks from subcategory page</td>
                    <td>After content page </td>
                    <td>Source & URL relevance</td>
                    <td>Total content view duration</td>
                    <td>Av view duration per article</td>
                    <td>Paid AD impressions on page</td>
                    <td>Total income generated</td>
                    <td>Evaluations</td>
                    <td>Comments</td>
                    <td>Broken links</td>
                    <td>Admin</td>  
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
