<?php
ini_set('memory_limit', '2044M');
include 'includes/header.php';
$allNews = newsFetch();
include 'all_content/process.php';

?>

<body class="">
  <?php include 'all_content/includes_file.php' ?>
  <div class="newsContainer">
    <div class="row homeContent">
      <div class="col-md-9 col-lg-9 col-xl-9 cardColumn">



        <?php //echo $block[1]['name']; 
        ?>

        <div class="cardBlock">

          <?php include 'all_content/main_block.php' ?>

        </div>












        <?php
        include 'includes/subscribe.php';
        ?>

      </div>

      <div class="col-md-3 cardColumn_2">
        <?php
        include 'home/ad_column.php';
        ?>
      </div>
    </div>

  </div>


  <?php
  include 'includes/footer.php';
  include 'includes/script.php';
  $pdo->close();
  ?>
</body>

<script src="../bower/dist/js/adminlte.min.js"></script>