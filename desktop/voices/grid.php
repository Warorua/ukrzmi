<div class="row ">
  <?php
  if (isset($_GET['auth'])) {
    $sqladd = "AND author=N'" . $_GET['auth'] . "'";
    $sqlhold = 'value="' . $_GET['auth'] . '"';
  } else {
    $sqladd = "";
    $sqlhold = "";
  }

  if (isset($_GET['cat'])) {
    $sqlAuth = "AND category=N'" . $_GET['cat'] . "'";
  } else {
    $sqlAuth = "";
  }

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
  }
  $stmt = $conn->prepare("SELECT * FROM news 
  WHERE NOT category=:cat_not
  AND type=:type
  AND pin=:pin
   " . $sqladd . "
   " . $sqlAuth . "
 ORDER BY id DESC LIMIT 39");
  $stmt->execute(['cat_not' => 'international', 'type' => "voice", 'pin' => 0]);
  $block_news_orig = $stmt->fetchAll();

  ////////////////////////////////////////////////////////////////////////////////
  $stmt = $conn->prepare("SELECT * FROM news 
 WHERE NOT category=:cat_not
 AND type=:type
 AND pin=:pin
ORDER BY id;");
  $stmt->execute(['cat_not' => 'international', 'type' => "", 'pin' => 0]);
  $block_allNews = $stmt->fetchAll();

  $pageName = 'home';
  $_SESSION[$pageName] = $block_allNews;

  $block_id = 0;
  $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM pinned WHERE block_id=:block_id AND page=:page");
  $stmt->execute(['block_id' => $block[$block_id]['id'], 'page' => 'voice']);
  $block_auth = $stmt->fetch();

  $stmt = $conn->prepare("SELECT * FROM pinned
  LEFT JOIN news ON pinned.card_id = news.id 
  WHERE NOT category=:cat_not
  AND type=:type
  AND pin=:pin
  AND block_id=:block_id
  AND page=:page
  ORDER BY pinned.position ASC");
  $stmt->execute(['cat_not' => 'international', 'type' => "", 'pin' => 1, 'block_id' => $block[$block_id]['id'], 'page' => 'voice']);
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
  
    $slide_control = blockControl($block_total_cards)[0];
    $hide_control_button = blockControl($block_total_cards)[1];
  

  $block_news_1 = array_slice($block_news, 0, 3);

  foreach ($block_news_1 as $row) {
   echo voicesGridcard($row);
  }

  //for ($x = 0; $x <= 48; $x++) {}
  ?>

</div>