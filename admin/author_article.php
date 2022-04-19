<?php
// Sets to unlimited period of time
ini_set('max_execution_time', 0);
include 'components/header.php';
if(!isset($_GET['id'])){
    header('location: home.php');
}
else{
    $conn = $pdo->open();
    $stmt = $conn->prepare("SELECT * FROM authors WHERE id=:id");
    $stmt->execute(['id'=>$_GET['id']]);
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

$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM news WHERE author=:author");
$stmt->execute(['author'=>$auth['name']]);
$author = $stmt->fetchAll();

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
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <div class="row">
<div class="col-md-6">
                    <p class="text-left">
                      <strong>Author: <?php echo $auth['name'] ?></strong>
                    </p>

                    <div class="progress-group">
                     Articles
                      <span class="float-right"><b><?php echo sizeof($author) ?></b>/<?php echo sizeof($author2) ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php echo (sizeof($author)*100)/sizeof($author2) ?>%"></div>
                      </div>
                    </div>
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
                  
</div>
<div class="col-md-6">
      <div id="myfirstchart" style="height: 250px;"></div>
</div>
                </div>
          
                <table id="scrapedData" class="table table-bordered table-striped table-sm">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Publication date</th>
                    <th>Evaluation</th>

                    <th>Main Category</th>
                    <th>Sources</th>
                    <th>Times Displayed</th>
                    <th>Clicks</th>
                    <th>Unique Visitors</th>
                    <th>Clicks from home</th>
                    <th>Clicks from category</th>
                    <th>Clicks from search</th>
                    <th>Clicks from block</th>
                    <th>Author/Article relevance</th>
                    <th>Average time spent per page(Seconds)</th>
                    <th>Time on page (Minutes)</th>
                    <th># Paid ads</th>
                    <th>Rotations (Every 30 sec)</th>
                    <th>Paid AD impressions</th>
                    <th>Revenue (15/cpm)</th>
                    <th>Status</th>
                    <th>Broken links</th>
                    

                    <th>Admin</th>
                  </tr>
                  </thead>
                  <tbody>
<?php

foreach($author as $row){
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
        $rowParent = "правда";
      }
      elseif($row['parent'] == "theguardian.com"){
        $rowParent = "The guardian";
      }
      elseif($row['parent'] == ""){
        $rowParent = "правда";
      }
   echo '
                    <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['time'].'</td>
                    <td></td>
                    <td>'.$row['category'].'</td>
                    <td>'.$rowParent.'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><div class="badge badge-success">Online</div></td>
                    <td></td>
                    <td><a class="btn btn-info" href="author_article.php?id='.$row['id'].'">Admin</a></td>
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
<script>
new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
  <?php
  foreach($author as $row){
$stmt = $conn->prepare("SELECT * FROM news WHERE author=:author");
$stmt->execute(['author'=>$auth['name']]);
$author = $stmt->fetchAll();
$date = $row['time'];  
//converts date and time to seconds  
$sec = strtotime($date);  
//converts seconds into a specific format  
$newdate = date ("Y-m-d", $sec);  
$dateB =  date ("D, d M Y", $sec); 

$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE author=:author AND time LIKE '%{$dateB}%'");
$stmt->execute(['author'=>$auth['name']]);
$grVal = $stmt->fetch();

    echo "{ day: '".$newdate."', value: ".$grVal['numrows']." },";
  }

  ?>
  
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'day',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Articles']
});

</script>
</body>
</html>
