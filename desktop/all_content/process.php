<?php
if (isset($_GET['subcat'])) {
    $block_news_orig = filter_by_key(
        $allNews,
        [
            $_GET['subcat']
        ],
        'sub_1',
        'deep_link'
    );

    $page = 'subcat';
    $block_id = 0;
    $titleHead = '<h2 class="newsHead">' . $_GET['subcat'] . ' sub-category content</h2>';
} else if (!isset($_GET['page']) && !isset($_GET['block_id'])) {
    header('location: home.php');
} else {
    $regex = '/^category/';
    $categTest = preg_match($regex, $_GET['page']);

    $regex2 = '/^home/';
    $categTest2 = preg_match($regex2, $_GET['page']);

    if ($categTest2 == TRUE || $categTest == TRUE || $_GET['page'] == 'video' || $_GET['page'] == 'city') {
        $page = $_GET['page'];
    } else {
        // echo '<script> location.replace("home.php"); </script>';
        header('location: home.php');
    }

    $block_id = $_GET['block_id'];
    ///////////////////////////////////////////////////////////////////////////
    if (!isset($_SESSION[$page])) {
        //  echo '<script> location.replace("home.php"); </script>';
        header('location: home.php');
    } else {
        $block_news_orig = $_SESSION[$page];
    }


    if (!isset($block[$block_id]['name'])) {
        $title = 'Headlines';
    } else {
        $title = $block[$block_id]['name'];
    }


    $titleHead = '<h2 class="newsHead">' . $title . ' all content</h2>';
}
if (isset($_GET['A0034'])) {
    $titleHead = '<h2 class="newsHead">All headlines</h2>';
    $btnHd = "visually-hidden";
} else {
    $btnHd = "";
}
