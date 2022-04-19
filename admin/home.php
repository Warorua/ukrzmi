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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
                      <!-- solid sales graph -->

 <div class="card bg-gradient-info col-12">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  News Content analysis
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <?php
$stmt = $conn->prepare("SELECT DISTINCT parent FROM news ORDER BY parent ASC");
$stmt->execute();
$data_sources = $stmt->fetchAll();
$data_sources_min = array_slice($data_sources, 0, 6);
foreach($data_sources_min as $row){
  $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news");
  $stmt->execute();
  $all_data = $stmt->fetch();

  $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE parent=:parent");
  $stmt->execute(['parent'=>$row['parent']]);
  $data = $stmt->fetch();
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
    $rowParent = "UNLABELED";
  }

  $value = ($data['numrows']*100)/$all_data['numrows'];
  echo '
                    <div class="col-2 text-center">
                    <input type="text" class="knob" data-readonly="true" value="'.number_format($value, 2).'" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">'.$rowParent.'</div>
                  </div>
  ';
}
                  ?>
 
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->



          <div class="col-lg-3 col-6">

            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
          <h3 id="newsArticles"></h3>
           <p>News Articles</p>
              </div>
              <div class="icon">
                <i class="ion ion-document"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="allUsers">53</h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="activeScrapers">44</h3>

                <p>Active Scrapers</p>
              </div>
              <div class="icon">
                <i class="ion ion-settings"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
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
include 'components/home_ajax.php';
?>
<?php
include 'components/alert.php';
?>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script>
// Sales graph chart
  var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');

  var salesGraphChartData = {
labels: [    
    <?php
foreach($data_sources as $row){
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
  $rowParent = "UNLABELED";
}
echo "
'".$rowParent."',
";
}

    ?>
   ],
    datasets: [
      {
        label: 'News articles',
        fill: false,
        borderWidth: 2,
        lineTension: 0,
        spanGaps: true,
        borderColor: '#efefef',
        pointRadius: 3,
        pointHoverRadius: 7,
        pointColor: '#efefef',
        pointBackgroundColor: '#efefef',
         data: [
        <?php
foreach($data_sources as $row){
  $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE parent=:parent");
  $stmt->execute(['parent'=>$row['parent']]);
  $data = $stmt->fetch();
  echo $data['numrows'].',';
}
        ?>
       ]
      }
    ]
  }

  var salesGraphChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        ticks: {
          fontColor: '#efefef'
        },
        gridLines: {
          display: false,
          color: '#efefef',
          drawBorder: false
        }
      }],
      yAxes: [{
        ticks: {
          stepSize: 5000,
          fontColor: '#efefef'
        },
        gridLines: {
          display: true,
          color: '#efefef',
          drawBorder: false
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  // eslint-disable-next-line no-unused-vars
  var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
    type: 'line',
    data: salesGraphChartData,
    options: salesGraphChartOptions
  })


</script>
</body>
</html>
