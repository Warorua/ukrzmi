<?php
include 'components/header.php';
ini_set('max_execution_time', 0);
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
            <h1 class="m-0">Article tags data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Article tags data</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM news");
$stmt->execute();
$tag_data = $stmt->fetchAll();
$tags = array();
$tag_1 = array();
$tag_2 = array();
$tag_3 = array();
foreach($tag_data as $row){
 array_push($tags, $row['tag_1']);
 array_push($tag_1, $row['tag_1']);

array_push($tags, $row['tag_2']);
array_push($tag_2, $row['tag_2']);

array_push($tags, $row['tag_3']);   
array_push($tag_3, $row['tag_3']); 

}
$tag_1_count = array_count_values($tag_1);
$tag_2_count = array_count_values($tag_2);
$tag_3_count = array_count_values($tag_3);

$tag_count = array_count_values($tags);
$tag = array_unique($tags);

$total = sizeof($tag_1_count) + sizeof($tag_2_count) + sizeof($tag_3_count);

$unique_size = sizeof($tag);
$tag1_size = sizeof($tag_1_count);
$tag2_size = sizeof($tag_2_count);
$tag3_size = sizeof($tag_3_count);
?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="card">
              <div class="card-header">
                <h3 class="card-title">System Article tags data</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                  <div class="row">
                      
                  <div class="col-md-4">
                      <!-- /.progress-group -->
<div style="position: fixed; width:25%">
<div class="col-12">
            <div class="info-box shadow-lg">
              <span class="info-box-icon bg-success"><i class="fa fa-tags"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total tags</span>
                <span class="info-box-number" id="counter"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
 </div>

                    <div class="progress-group">
                      Unique tags average
                      <span class="float-right"><b><?php echo $unique_size ?></b>/<?php echo $total ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: <?php echo ($unique_size*100)/$total ?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Tag 1 average</span>
                      <span class="float-right"><b><?php echo $tag1_size ?></b>/<?php echo $total ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?php echo ($tag1_size*100)/$total ?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                    Tag 2 average
                      <span class="float-right"><b><?php echo $tag2_size ?></b>/<?php echo $total ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: <?php echo ($tag2_size*100)/$total ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                  <!-- /.progress-group -->
                   <div class="progress-group">
                   Tag 3 average
                      <span class="float-right"><b><?php echo $tag3_size ?></b>/<?php echo $total ?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?php echo ($tag3_size*100)/$total ?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
</div>

                  
</div>
                      <div class="col-md-8">
     <table id="scrapedData" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Tag 1 count</th>
                    <th>Tag 2 count</th>
                    <th>Tag 3 count</th>
                    <th>Total</th> 
                    <th></th>              
                  </tr>
                  </thead>
                  <tbody>

<?php
foreach($tag as $row){
if(!isset($tag_1_count[$row])){
    $tag_01 = 0;
}
else{
    $tag_01 = $tag_1_count[$row]; 
}

if(!isset($tag_2_count[$row])){
    $tag_02 = 0;
}
else{
    $tag_02 = $tag_2_count[$row]; 
}

if(!isset($tag_3_count[$row])){
    $tag_03 = 0;
}
else{
    $tag_03 = $tag_3_count[$row]; 
}
   echo '
                    <tr>
                    <td></td>
                    <td>'.$row.'</td>
                    <td>'.$tag_01.'</td>
                    <td>'.$tag_02.'</td>
                    <td>'.$tag_03.'</td>
                    <td>'.$tag_count[$row].'</td>
                    <td></td>
                  </tr>
  
   '; 
}

//print_r($tag);
?>
 

                  </tbody>
                
   </table>         
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
        let counts=setInterval(updated);
        let upto=0;
        function updated(){
            var count= document.getElementById("counter");
            count.innerHTML=++upto;
            if(upto===<?php echo sizeof($tags) ?>)
            {
                clearInterval(counts);
            }
        }
    </script>
</body>
</html>
