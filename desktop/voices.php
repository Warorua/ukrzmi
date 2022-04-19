<?php
include 'includes/header.php';

?>
<body class="">
<?php
include 'home/blocks.php';
include 'includes/topbar.php';
include 'includes/navbar.php';
?>
<div class="newsContainer">
    <div class="row homeContent">
        <div class="col-md-8">
  <?php
include 'voices/body.php';
//include 'home/international_block.php';
?>

        </div>
<div style="width:30px"></div>
        <div class="col-md-3">
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