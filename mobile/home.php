<?php
include 'includes/header.php';
$page = 'home';
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
        <div class="col-sm-12">
        <?php
include 'home/headlines/main.php';
include 'home/international_block.php';

if(isset($block[1]['name'])){
include 'home/block_02.php';
}
if(isset($thematic_block[0]['name'])){
$thematic_id = 0;
include 'home/thematic/b1.php';
}
if(isset($block[2]['name'])){
include 'home/block_03.php';
}
if(isset($thematic_block[1]['name'])){
$thematic_id = 1;
include 'home/thematic/b2.php';
}
if(isset($block[3]['name'])){
include 'home/block_04.php';
}
if(isset($thematic_block[2]['name'])){
$thematic_id = 2;
include 'home/thematic/b3.php';
}
if(isset($block[4]['name'])){
include 'home/block_05.php';
}
if(isset($thematic_block[3]['name'])){
$thematic_id = 3;
include 'home/thematic/b4.php';
}
if(isset($block[5]['name'])){
include 'home/block_06.php';
}
if(isset($thematic_block[4]['name'])){
$thematic_id = 4;
include 'home/thematic/b5.php';
}
if(isset($block[6]['name'])){
include 'home/block_07.php';
}
if(isset($thematic_block[5]['name'])){
$thematic_id = 5;
include 'home/thematic/b6.php';
}
if(isset($block[7]['name'])){
include 'home/block_08.php';
}
if(isset($thematic_block[6]['name'])){
$thematic_id = 6;
include 'home/thematic/b7.php';
}
if(isset($block[8]['name'])){
include 'home/block_09.php';
}
if(isset($thematic_block[7]['name'])){
$thematic_id = 7;
include 'home/thematic/b8.php';
}
if(isset($block[9]['name'])){
include 'home/block_10.php';
}
if(isset($thematic_block[8]['name'])){
$thematic_id = 8;
include 'home/thematic/b9.php';
}
?>
<?php
include 'includes/subscribe.php';
?>
        </div>

        <div class="col-md-3 cardColumn_2 mb-3">
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