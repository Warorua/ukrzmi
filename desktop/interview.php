<?php
include 'includes/header.php';

?>
<body class="">
    
    <?php include_once("analyticstracking.php") ?>
    
<?php
include 'category/blocks.php';
include 'includes/topbar.php';
include 'includes/navbar.php';
?>
<div class="newsContainer">
    <div class="row homeContent">
        <div class="col-md-9 col-lg-9 col-xl-9 cardColumn">
  <?php
include 'interview/body.php';
//include 'home/international_block.php';
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
?>
</body>