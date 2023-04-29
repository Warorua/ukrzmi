<div class="row">

  <?php
  echo '<!----
  ///////////BLOCK INFO:
  ' . json_encode($block[$block_id]) . '
  //////////BLOCK ID: ' . $block_id . '
  ---->';
  if ($block[$block_id]['active'] == 1) {

    //include 'home/panels/headline_query.php';
    //$allNews = newsFetch();
    $card_calc = ($wanted_panels*8)-1;
    if ($block_id == 0 && $block[$block_id]['type'] == "") {
      $block_allNews = filter_by_key(
        $allNews,
        [
          'Unian.ua/home',
          'ua.korrespondent.net/home',
          'pravda.com.ua/home',
          'eurointegration.com.ua/news/home'
        ],
        'source',
        'deep_link'
      );
      $block_news_orig = array_slice($block_allNews, 0, $card_calc);

      $pageName = 'home';

      $_SESSION[$pageName] = get_ids($block_allNews,'id');
    } else {
      $block_allNews = filter_by_key(
        $allNews,
        [
          $block[$block_id]['type']
        ],
        'category',
        'deep_link'
      );

      $block_news_orig = array_slice($block_allNews, 0, $card_calc);

      $pageName = 'home' . '_' . $block[$block_id]['id'];
      $_SESSION[$pageName] = $block_allNews;
    }


    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM pinned WHERE block_id=:block_id AND page=:page");
    $stmt->execute(['block_id' => $block[$block_id]['id'], 'page' => '']);
    $block_auth = $stmt->fetch();

    $stmt = $conn->prepare("SELECT * FROM pinned
  LEFT JOIN news ON pinned.card_id = news.id 
  WHERE NOT category=:cat_not
  AND type=:type
  AND pin=:pin
  AND block_id=:block_id
  AND page=:page
  ORDER BY pinned.position ASC
  ");
    $stmt->execute(['cat_not' => 'international', 'type' => "", 'pin' => 1, 'block_id' => $block[$block_id]['id'], 'page' => '']);
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
    } else {
      $stmt = $conn->prepare("SELECT * FROM pinned WHERE block_id=:block_id AND page=:page ORDER BY id DESC LIMIT 1");
      $stmt->execute(['block_id' => $block[$block_id]['id'], 'page' => '']);
      $block_auth = $stmt->fetch();

      if (getTimeDifference($block_auth['pinned_to']) > 1) {
        $block_news = $block_news_orig;
      }
    }

    $block_total_cards = sizeof($block_news);

    
      $slide_control = blockControl($block_total_cards)[0];
      $hide_control_button = blockControl($block_total_cards)[1];
   

    $block_news_1 = array_slice($block_news, 0, 8);

    foreach ($block_news_1 as $row) {
       $catHolder = blockAux($row)['catHolder'];
        $lastPos = blockAux($row)['lastPos'];
        $rowtitle = blockAux($row)['rowtitle'];
        $filtTit = blockAux($row)['filtTit'];
        $frameColor = blockAux($row)['frameColor'];
        $titleBadge = blockAux($row)['titleBadge'];

      echo articleCard($row, $block, $block_id, $frameColor, $filtTit, $titleBadge, $rowtitle, $catHolder);
    }
  }
  //for ($x = 0; $x <= 48; $x++) {}
  ?>

</div>