<?php
include 'components/header.php';
function alphabet_to_number($string) {
    $string = strtoupper($string);
    $length = strlen($string);
    $number = 0;
    $level = 1;
    while ($length >= $level ) {
        $char = $string[$length - $level];
        $c = ord($char) - 64;        
        $number += $c * (26 ** ($level-1));
       $level++;
    }
   return $number;
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
            <h1 class="m-0">Active Images Library</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Images Library</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
<div class="row">
<div class="col-12">
            <div class="card card-primary">
                            <div class="card-header">
       <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize">
                    <i class="fas fa-expand"></i>
                  </button>
       </div> 
                <h4 class="card-title">Article images library</h4>
              </div>
              <div class="card-body">
                <div>
                  <div class="btn-group w-100 mb-2">
                <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> All items </a>      
<?php
$stmt = $conn->prepare("SELECT DISTINCT parent FROM news ORDER BY parent ASC");
$stmt->execute();
$sources = $stmt->fetchAll();
foreach($sources as $rows => $values){
$dataFil = alphabet_to_number($values['parent']);
    echo '
    <a class="btn btn-info" href="javascript:void(0)" data-filter="'.$dataFil.'"> '.$values['parent'].' </a>
    ';
}
?>
                 </div>
                  <div class="mb-2">
                    <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle> Shuffle items </a>
                    <div class="float-right">
                      <select class="custom-select" style="width: auto;" data-sortOrder>
                        <option value="index"> Sort by Position </option>
                        <option value="sortData"> Sort by Custom Data </option>
                      </select>
                      <div class="btn-group">
                        <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                        <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div>
                  <div class="filter-container p-0 row">
             <?php
             $stmt = $conn->prepare("SELECT * FROM news ORDER BY id DESC LIMIT 1000");
             $stmt->execute();
             $sources = $stmt->fetchAll();
             foreach($sources as $row){
                $dataCat = alphabet_to_number($row['parent']);
                 echo '
                    <div class="filtr-item col-sm-2" data-category="'.$dataCat.'" data-sort="'.$row['parent'].'">
                      <a href="../images/'.$row['photo'].'" data-toggle="lightbox" data-title="'.$row['title'].'">
                        <img src="../images/'.$row['photo'].'" class="img-fluid mb-2" alt="'.$row['parent'].'"/>
                      </a>
                    </div>
                 ';
             }
             ?>
              

                  </div>
                </div>

              </div>
            </div>
          </div>
</div>
       
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
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>
</body>
</html>
