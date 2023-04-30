<div class="row ">
  <?php


  if (isset($_GET['city'])) {
    $city = $_GET['city'];
    if ($city == 'kyiv') {
      $sqlAuth = "AND source IN ('Unian.ua/kyiv','ua.korrespondent.net/city/kiev/')";
    } elseif ($city == 'lviv') {
      $sqlAuth = "AND source = 'Unian.ua/lviv'";
    } elseif ($city == 'odessa') {
      $sqlAuth = "AND source = 'Unian.ua/odessa'";
    } elseif ($city == 'kharkiv') {
      $sqlAuth = "AND source = 'Unian.ua/kharkiv'";
    } elseif ($city == 'dnepropetrovsk') {
      $sqlAuth = "AND source = 'Unian.ua/dnepropetrovsk'";
    } else {
      $sqlAuth = "";
    }
  }else{
    $sqlAuth = "";
  }
  $stmt = $conn->prepare("SELECT * FROM news 
  WHERE NOT category=:cat_not
  AND type=:type
  AND pin=:pin
  " . $sqlAuth . "
 ORDER BY id DESC LIMIT 39");
  $stmt->execute(['cat_not' => 'international', 'type' => "interview", 'pin' => 0]);
  $block_news_orig = $stmt->fetchAll();
  if (isset($_GET['cat'])) {

    $block_news_orig = filter_by_key(
      $block_news_orig,
      [
        $_GET['cat']
      ],
      'category',
      'deep_link'
    );
  }



  ////////////////////////////////////////////////////////////////////////////////
  $stmt = $conn->prepare("SELECT * FROM news 
 WHERE NOT category=:cat_not
 AND type=:type
 AND pin=:pin
ORDER BY id;");
  $stmt->execute(['cat_not' => 'international', 'type' => "interview", 'pin' => 0]);
  $block_allNews = $stmt->fetchAll();

  $pageName = 'interview';
  $_SESSION[$pageName] = $block_allNews;

  $block_id = 0;
  $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM pinned WHERE block_id=:block_id AND page=:page");
  $stmt->execute(['block_id' => $block[$block_id]['id'], 'page' => 'interview']);
  $block_auth = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM pinned
  LEFT JOIN news ON pinned.card_id = news.id 
  WHERE NOT category=:cat_not
  AND type=:type
  AND pin=:pin
  AND block_id=:block_id
  AND page=:page
  ORDER BY pinned.position ASC");
  $stmt->execute(['cat_not' => 'international', 'type' => "", 'pin' => 1, 'block_id' => $block[$block_id]['id'], 'page' => 'interview']);
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

  $block_total_cards = sizeof($block_news);
  if ($block_total_cards >= 0 && $block_total_cards <= 8) {
    $slide_control = 0;
    $hide_control_button = 'disabled';
  }
  if ($block_total_cards >= 9 && $block_total_cards <= 16) {
    $slide_control = 1;
    $hide_control_button = '';
  }
  if ($block_total_cards >= 17 && $block_total_cards <= 24) {
    $slide_control = 2;
    $hide_control_button = '';
  }
  if ($block_total_cards >= 25 && $block_total_cards <= 32) {
    $slide_control = 3;
    $hide_control_button = '';
  }
  if ($block_total_cards >= 33 && $block_total_cards <= 40) {
    $slide_control = 4;
    $hide_control_button = '';
  }
  if ($block_total_cards >= 41 && $block_total_cards <= 48) {
    $slide_control = 5;
    $hide_control_button = '';
  }
  if (!isset($slide_control)) {
    $slide_control = 5;
    $hide_control_button = '';
  }

  $block_news_1 = array_slice($block_news, 0, 4);

  foreach ($block_news_1 as $row) {
    echo interviewGridCard($row, $block, $block_id);
  }

  //for ($x = 0; $x <= 48; $x++) {}
  ?>

</div>