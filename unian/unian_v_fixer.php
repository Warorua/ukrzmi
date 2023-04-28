<?php
//header('Content-Type: text/html; charset=utf-8');

include 'includes/session.php';
require '../vendor/autoload.php';
$httpClient = new \simplehtmldom\HtmlWeb();
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////         HOME PAGE TRENDING            ///////////////////////////////

$stmt = $conn->prepare("SELECT id, category, published, deep_link, pin, type, video_url FROM news 
WHERE type=:cat_not
ORDER BY id DESC");
$stmt->execute(['cat_not' => 'video']);

$block_news_orig = $stmt->fetchAll();

foreach ($block_news_orig as $id => $row) {
    $h_link = $row['deep_link'];

    $content = $httpClient->load($h_link);
    //////////////TEST
    $json = $content->find('head script[type=application/ld+json]');

    $vid_dtt = json_decode(headJson($json, 5), true);
    //$vid_dtt = json_decode(headJson($json, 5));
    $video_f = $vid_dtt['embedUrl'];

    if (starts_with($row['video_url'], 'https://www.unian.ua/player/')) {
        $stmt = $conn->prepare("UPDATE news SET video_url=:video_url WHERE id=:id");
        $stmt->execute(['video_url' => $video_f, 'id' => $row['id']]);
    }

    echo $id . '<br/>' . $video_f . '<br/><br/>';
}






//print_r($vid_dtt);
//echo headJson($json, 5);
//echo headJsonView($json);
