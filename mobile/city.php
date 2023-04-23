<?php
include 'includes/header.php';
if(!isset($_GET['id'])){
    header('location:home.php');
}
else{
    $city = $_GET['id'];
}
?>
<body class="">
    
    <?php include_once("analyticstracking.php") ?>
    
<?php
include 'home/blocks.php';
include 'includes/topbar.php';
include 'includes/navbar.php';
?>
<div class="">
    <div class="row">
        <div class="col-md-9 col-lg-9 col-xl-9 cardColumn">


  
  <?php
include 'city/headlines/main.php';
//include 'city/international_block.php';
?>
 <div class="w-100 bg-light">
    <div class="mt-2">
        <div class="col-md-12">
        <img src="https://www.ubuy.com.tr/productimg/?image=aHR0cHM6Ly9tLm1lZGlhLWFtYXpvbi5jb20vaW1hZ2VzL0kvNjFNZ1piYS1PeUwuX1NMMTUwMF8uanBn.jpg" width="50px" class="rounded-circle border border-2 border-secondary" alt="...">
        <b class="text-primary fs-4">Local authorities</b>
        </div>
        <div class="col-md-12">
       <?php include 'city/headlines/grid_video.php'; ?>     
        </div>
    </div>
</div>


<div class="w-100 bg-light mt-5">
    <div class="mt-2">
        <div class="col-md-12">
        <img src="https://static.thenounproject.com/png/852208-200.png" width="50px" class="rounded-circle border border-2 border-secondary" alt="...">
        <b class="text-primary fs-4">Events</b>
        </div>
        <div class="col-md-12">
        <?php include 'city/headlines/grid_video_two.php'; ?>     
        </div>
    </div>
</div>
<?php
/*
if(isset($block[4]['name'])){
include 'city/block_05.php';
}
if(isset($block[5]['name'])){
include 'city/block_06.php';
}
if(isset($block[6]['name'])){
include 'city/block_07.php';
}
if(isset($block[7]['name'])){
include 'city/block_08.php';
}
if(isset($block[8]['name'])){
include 'city/block_09.php';
}
if(isset($block[9]['name'])){
include 'city/block_10.php';
}
*/
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