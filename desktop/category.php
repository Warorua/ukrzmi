<?php
if (!isset($_GET['cat_id'])) {
    header('location: home.php');
}
include 'includes/header.php';
$page = 'category';
?>

<body class="">

    <?php include_once("analyticstracking.php") ?>

    <?php
    $allNews = newsFetch();
    $wanted_panels = 5;
    $wanted_blocks = 100;


    include 'category/blocks.php';
    include 'includes/topbar.php';
    include 'includes/navbar.php';
    ?>
    <div class="newsContainer">
        <div class="row homeContent">
            <div class="col-md-9 col-lg-9 col-xl-9 cardColumn">
                <?php

                include 'category/headlines/main.php';
                //include 'category/international_block.php';

                for ($i = 1; $i <= $wanted_blocks; $i++) {
                    $block_id = $i;
                    // $block_no = $block[$block_id];
                    $i_ = $i - 1;
                    $i__ = $i + 1;

                 
                    if (isset($sub_cats[$i]['subcat'])) {
                        $block_id == $i;
                        $sub_cat_rule = $sub_cats[$i]['subcat'];
                        include 'category/block_ft.php';
                    }
                    if (isset($thematic_block[$i]['name'])) {
                        $thematic_id = $i;
                        include 'category/thematic/b1.php';
                    }
                }



/*
                if (isset($sub_cats[1]['subcat'])) {
                    $block_id == 1;
                    $sub_cat_rule = $sub_cats[1]['subcat'];
                    include 'category/block_03.php';
                }
                if (isset($thematic_block[1]['name'])) {
                    $thematic_id = 1;
                    include 'category/thematic/b2.php';
                }

                if (isset($sub_cats[2]['subcat'])) {
                    $block_id == 2;
                    $sub_cat_rule = $sub_cats[2]['subcat'];
                    include 'category/block_04.php';
                }
                if (isset($thematic_block[2]['name'])) {
                    $thematic_id = 2;
                    include 'category/thematic/b3.php';
                }


                if (isset($sub_cats[3]['subcat'])) {
                    $block_id == 3;
                    $sub_cat_rule = $sub_cats[3]['subcat'];
                    include 'category/block_05.php';
                }
                if (isset($thematic_block[3]['name'])) {
                    $thematic_id = 3;
                    include 'category/thematic/b4.php';
                }


                if (isset($sub_cats[4]['subcat'])) {
                    $block_id == 4;
                    $sub_cat_rule = $sub_cats[4]['subcat'];
                    include 'category/block_06.php';
                }
                if (isset($thematic_block[4]['name'])) {
                    $thematic_id = 4;
                    include 'category/thematic/b5.php';
                }


                if (isset($sub_cats[5]['subcat'])) {
                    $block_id == 5;
                    $sub_cat_rule = $sub_cats[5]['subcat'];
                    include 'category/block_07.php';
                }
                if (isset($thematic_block[5]['name'])) {
                    $thematic_id = 5;
                    include 'category/thematic/b6.php';
                }


                if (isset($sub_cats[6]['subcat'])) {
                    $block_id == 6;
                    $sub_cat_rule = $sub_cats[6]['subcat'];
                    include 'category/block_08.php';
                }
                if (isset($thematic_block[6]['name'])) {
                    $thematic_id = 6;
                    include 'category/thematic/b7.php';
                }


                if (isset($sub_cats[7]['subcat'])) {
                    $block_id == 7;
                    $sub_cat_rule = $sub_cats[7]['subcat'];
                    include 'category/block_09.php';
                }
                if (isset($thematic_block[7]['name'])) {
                    $thematic_id = 7;
                    include 'category/thematic/b8.php';
                }


                if (isset($sub_cats[8]['subcat'])) {
                    $block_id == 8;
                    $sub_cat_rule = $sub_cats[8]['subcat'];
                    include 'category/block_10.php';
                }
                if (isset($thematic_block[8]['name'])) {
                    $thematic_id = 8;
                    include 'category/thematic/b9.php';
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