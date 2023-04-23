<?php
include 'home/blocks.php';
include 'includes/topbar.php';
include 'includes/navbar.php';
if (isset($categTest2)) {
  if ($categTest2 == TRUE) {
    usort($block_news_orig, 'idDescSort');
  }
}



$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM pinned WHERE block_id=:block_id AND page=:page");
$stmt->execute(['block_id' => $block[$block_id]['id'], 'page' => $page]);
$block_auth = $stmt->fetch();

$stmt = $conn->prepare("SELECT * FROM pinned
LEFT JOIN news ON pinned.card_id = news.id 
WHERE NOT category=:cat_not
AND type=:type
AND pin=:pin
AND block_id=:block_id
AND page=:page
ORDER BY pinned.position ASC");
$stmt->execute(['cat_not' => 'international', 'type' => "", 'pin' => 1, 'block_id' => $block[$block_id]['id'], 'page' => $page]);
$block_news_pinned = $stmt->fetchAll();
foreach ($block_news_pinned as $value => $row) {
  $pos = $row['position'];
  $val = array(
    'id' => $row['id'],
    'position' => $row['position'],
    'source' => $row['source'],
    'deep_link' => $row['deep_link'],
    'title' => $row['title'],
    'published' => $row['published'],
    'author' => $row['author'],
    'article' => $row['article'],
    'tag_1' => $row['tag_1'],
    'tag_2' => $row['tag_2'],
    'tag_3' => $row['tag_3'],
    'photo' => $row['photo'],
    'photo_url' => $row['photo_url'],
    'p_grapher' => $row['p_grapher'],
    'category' => $row['category'],
    'time' => $row['time'],
    'code' => $row['code'],
    'parent' => $row['parent'],
    'type' => $row['type'],
    'video_url' => $row['video_url'],
    'frame_color' => $row['frame_color'],
    'title_badge' => $row['title_badge'],
    'meta_title' => $row['meta_title'],
    'meta_desc' => $row['meta_desc'],
    'meta_keywords' => $row['meta_keywords'],
    'post_date' => $row['post_date'],
    'pin' => $row['pin'],
    'sub_1' => $row['sub_1'],
    'sub_2' => $row['sub_2'],
    'intefax' => $row['intefax'],
    'source_error' => $row['source_error'],
    'input' => $row['input']
  );

  $block_news = array_merge(array_slice($block_news_orig, 0, $pos), array($val), array_slice($block_news_orig, $pos));

  $block_news_orig = $block_news;
}
if ($block_auth['numrows'] < 1) {
  $block_news = $block_news_orig;
}

if (isset($_GET['subcat']) || isset($_GET['A0034'])) {
  $topSt = "visually-hidden";
} else {
  $topSt = "";
}
//////////////////////////////////////////
if (isset($_GET['cat_type'])) {
  if ($_GET['cat_type'] == '') {
    $prevCont = 'home.php';
  } else {
    $prevCont = 'category.php?cat_id=' . $_GET['cat_type'];
  }
} elseif (isset($_GET['cat_type_two'])) {
  $prevCont = 'all_content.php?cat_id=' . $_GET['cat_id'] . '&subcat=' . $_GET['cat_type_two'];
} elseif (isset($_GET['cat_type_three'])) {
  $prevCont = 'city.php?id=' . $_GET['cat_type_three'];
} elseif (isset($_GET['cat_type_four'])) {
  $prevCont = $_GET['cat_type_four'];
}
