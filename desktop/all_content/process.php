<?php
if(isset($_GET['subcat'])){
    $conn = $pdo->open();
   $stmt = $conn->prepare("SELECT * FROM news WHERE sub_1=N'".$_GET['subcat']."' ORDER BY id DESC");
   $stmt->execute();
   $block_news_orig = $stmt->fetchAll();
   $page = 'subcat';
   $block_id = 0;
   $titleHead = '<h2 class="newsHead">'.$_GET['subcat'].' sub-category content</h2>';
}
else if(!isset($_GET['page']) && !isset($_GET['block_id'])){
    header('location: home.php');
}
else{
$regex = '/^category/';
$categTest = preg_match($regex, $_GET['page']);

$regex2 = '/^home_/';
$categTest2 = preg_match($regex2, $_GET['page']);

    if($categTest2 == TRUE || $categTest == TRUE || $_GET['page'] == 'video' || $_GET['page'] == 'city'){
        $page = $_GET['page'];
    }
    else{
        header('location: home.php');
    }

$block_id = $_GET['block_id'];
///////////////////////////////////////////////////////////////////////////
$block_news_orig = $_SESSION[$page]; 

if(!isset($block[$block_id]['name'])){
    $title = 'Headlines';
}else{
    $title = $block[$block_id]['name'];
}

$titleHead = '<h2 class="newsHead">'.$title.' all content</h2>';
}
if(isset($_GET['A0034'])){
    $titleHead = '<h2 class="newsHead">All headlines</h2>';
    $btnHd = "visually-hidden";
}
else{
    $btnHd = "";
}
?>