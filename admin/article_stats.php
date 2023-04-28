<?php
// Sets to unlimited period of time
function isValidImage($imagePath)
{
  // Check if the file exists
  if (!file_exists($imagePath)) {
    return false;
  }

  // Check if the file is an image
  $imageTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
  $detectedType = exif_imagetype($imagePath);
  if (!in_array($detectedType, $imageTypes)) {
    return false;
  }

  return true;
}


ini_set('max_execution_time', 0);
function formatBytes($bytes, $precision = 2)
{
  $units = array('B', 'KB', 'MB', 'GB', 'TB');

  $bytes = max($bytes, 0);
  $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
  $pow = min($pow, count($units) - 1);

  // Uncomment one of the following alternatives
  $bytes /= pow(1024, $pow);
  // $bytes /= (1 << (10 * $pow)); 

  return round($bytes, $precision) . ' ' . $units[$pow];
}
include 'components/header.php';
if (!isset($_GET['id'])) {
  header('location: home.php');
} else {
  $conn = $pdo->open();
  $stmt = $conn->prepare("SELECT * FROM news WHERE id=:id");
  $stmt->execute(['id' => $_GET['id']]);
  $auth = $stmt->fetch();
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


    $stmt = $conn->prepare("SELECT * FROM news");
    $stmt->execute();
    $author2 = $stmt->fetchAll();
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Article Data</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Article Data</li>
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
              <div class="row">
                <div class="col-md-12">
                  <div class="callout callout-info w-100">
                    <h4><b>Title: </b><?php echo $auth['title'] ?></h4>
                    <h5><b>Uploaded on: </b><?php echo $auth['time'] ?></h5>
                    <h5><b>Source page: </b><?php echo $auth['source'] ?></h5>
                    <h5><b>Deep link: </b><a class="btn btn-info btn-sm" href="<?php echo $auth['deep_link'] ?>" target="_blank">Content deep link</a></h5>
                  </div>
                </div>

                <div class="col-md-6">
                  <p class="text-left">
                    <strong>Author: <?php echo $auth['author'] ?></strong>
                  </p>

                  <!-- /.progress-group -->

                  <div class="progress-group">
                    Trust Index
                    <span class="float-right"><b>80</b>/100</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-danger" style="width: 80%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Total clicks</span>
                    <span class="float-right"><b>1200</b>/10000</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: 12%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    Evaluation average
                    <span class="float-right"><b>36</b>/100</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-warning" style="width: 36%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    Relevancy
                    <span class="float-right"><b>64</b>/100</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 64%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                </div>
                <div class="col-md-6">
                  <h3>Article clicks data</h3>
                  <div id="myfirstchart" style="height: 250px;"></div>
                </div>
                <div class="col-md-6">
                  <!-- DONUT CHART -->
                  <div class="card card-danger">
                    <div class="card-header">
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                          <i class="fas fa-sync-alt"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                          <i class="fas fa-expand"></i>
                        </button>
                      </div>
                      <h3 class="card-title">Content analysis</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <div class="col-md-6">
                  <div class="card card-danger">
                    <div class="card-header">
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="<?php echo $nav_link ?>" data-source-selector="#card-refresh-content" data-load-on-init="false">
                          <i class="fas fa-sync-alt"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                          <i class="fas fa-expand"></i>
                        </button>
                      </div>
                      <h3 class="card-title">Image metadata</h3>

                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <img src="../images/<?php echo $auth['photo'] ?>" width="100%" />
                        </div>
                        <div class="col-md-6">
                          <div class="row">
                            <div style="display: none;">
                            </div>

                            <div class="col-md-12">
                              <ul class="list-group list-group-flush">
                                <?php
                                $exif = generate_exif_data_from_url($auth['photo_url']);
                                if (is_array($exif)) {
                                  foreach ($exif as $id => $row) {
                                    if ($id == 'FileDateTime') {
                                      $fl_outp = date('', $row);
                                    } elseif ($id == 'FileSize') {
                                      $fl_outp = formatBytes($row);
                                    } elseif (is_array($row)) {
                                      foreach ($row as $id => $row2) {
                                        if(!is_array($row2)){
                                          $fl_outp = $row2;
                                        }
                                        
                                      }
                                    } else {
                                      $fl_outp = $row;
                                    }
                                    echo '<li class="list-group-item"><b>' . $id . ':</b> ' . $row . ' </li>';
                                  }
                                } else {
                                  echo '<li class="list-group-item"><b>Error:</b> ' . $exif . ' </li>';
                                }

                                ?>

                              </ul>
                            </div>






                          </div>
                        </div>
                        <div class="col-md-6">
                          <a class="btn btn-primary w-100" href="<?php echo $auth['photo_url'] ?>" target="_blank">Deep link for image</a>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>

                </div>
              </div>


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
    new Morris.Line({
      // ID of the element in which to draw the chart.
      element: 'myfirstchart',
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      data: [{
          day: 'Monday',
          value: 0
        },


      ],
      // The name of the data record attribute that contains x-values.
      xkey: 'day',
      // A list of names of data record attributes that contain y-values.
      ykeys: ['value'],
      // Labels for the ykeys -- will be displayed when you hover over the
      // chart.
      labels: ['Clicks']
    });
  </script>
  <script>
    $(function() {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      //-------------
      //- DONUT CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
      <?php
      $full_article = strlen($auth['article']);
      $plain_article = strlen(strip_tags($auth['article']));
      $html_article = $full_article - $plain_article;
      ?>
      var donutData = {
        labels: [
          'HTML text',
          'Plain text',
          'Full text',

        ],
        datasets: [{
          data: [<?php echo $html_article ?>, <?php echo $plain_article ?>, <?php echo $full_article ?>],
          backgroundColor: ['#f56954', '#00a65a', '#f39c12'],
        }]
      }
      var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
      })

    })
  </script>
</body>

</html>