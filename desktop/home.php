<?php
include 'includes/header.php';
session_unset();
$page = 'home';
?>



<body class="">


    <?php include_once("analyticstracking.php") ?>

    <?php
    include 'home/blocks.php';
    include 'includes/topbar.php';
    include 'includes/navbar.php';
    ?>
    <div class="container">
        <div class="row ">
            <div class="col-md-9 col-lg-9 col-xl-9 ">
                <?php
                $allNews = newsFetch();
                $wanted_panels = 5;
                $wanted_blocks = 100;

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
                        include 'home/thematic/bft.php';
                    }
                }


                include 'includes/subscribe.php';
                ?>

            </div>

            <div class="col-md-3 sticky-top ">
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