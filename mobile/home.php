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
    $allNews = newsFetch();
    $wanted_panels = 5;
    $wanted_blocks = 100;

    ?>
    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <?php

                include 'home/headlines/main.php';
                include 'home/international_block.php';


                for ($i = 1; $i <= $wanted_blocks; $i++) {
                    $block_id = $i;
                    // $block_no = $block[$block_id];
                    $i_ = $i - 1;
                    $i__ = $i + 1;

                    if (isset($block[$i]['name'])) {
                        include 'home/block_ft.php';
                    }
                    if (isset($thematic_block[$i_]['name'])) {
                        $thematic_id = $i_;
                      //  include 'home/thematic/bft.php';
                    }
                }


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