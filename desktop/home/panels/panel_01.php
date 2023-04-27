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
      $block_news_orig = array_slice($block_allNews, 0, 39);

      $pageName = 'home';
      $_SESSION[$pageName] = $block_allNews;
    } else {
      $block_allNews = filter_by_key(
        $allNews,
        [
          $block[$block_id]['type']
        ],
        'category',
        'deep_link'
      );

      $block_news_orig = array_slice($block_allNews, 0, 39);

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

    $block_news_1 = array_slice($block_news, 0, 8);

    foreach ($block_news_1 as $row) {
      $rowtitle = $row['title'];

      $maxPos = 500;
      if ($row['sub_1'] != '') {
        $catHolder = $row['sub_1'];
      } else {
        $catHolder = 'General';
      }

        $rowParent = rowParent($row);
     



      if (strlen($row['title']) < $maxPos) {
        $rowtitle = $row['title'];
        $filtTit = str_replace('"', '', $row['title']);
      } else {
        $lastPos = ($maxPos - 3) - strlen($row['title']);
        $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . ' 
 ...';
        $filtTit = str_replace('"', '', $row['title']);
      }


      if ($row['frame_color'] == "") {
        $frameColor = "rgb(0, 0, 0, 0.0)";
      } else {
        $frameColor = $row['frame_color'];
      }

      if ($row['title_badge'] == "") {
        $titleBadge = "";
      } else {
        $titleBadge = '<img src="../admin/' . $row['title_badge'] . '" class="titleBadge" />';
      }


      echo '
      <div class="col-md-3">    
      <div class="card col-sm-4 col-md-3 newsCard" style="background-color:' . $block[$block_id]['bg_color'] . '">
        <div class="card-content">
    
    <a href="article_content.php?code=' . $row['code'] . '">
     <div class="imgFrame">
          <div class="imgTitle">
             <p class="blogTitle">' . $rowParent . '</p>
            <div class="cardFrame" style="border-color: ' . $frameColor . ';"></div>
            <img class="cardPhoto" src="../images/' . $row['photo'] . '" height="122px" alt="' . $row['title'] . '" />
        </div>
     </div>   
      </a>    
        <div class="">
              <a href="article_content.php?code=' . $row['code'] . '" class="cardLink cardTitRow"> 
            <h6 class="cardHead" data-toggle="tooltip" data-placement="bottom" title="' . $filtTit . '">' . $titleBadge . '' . $rowtitle . '</h6>
          </a>
          <div class="cardFoot clearfix">
            <div class="cardCat">
             <div class="btn-group dropend shareIcon">
            <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-ellipsis-v text-dark" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
             <li>
             <a class="dropdown-item trigger right-caret">Share</a>
             <ul class="dropdown-menu sub-menu">
             <li><a class="dropdown-item" href="https://t.me/share/url?url=https://www.ukrzmi.com/desktop/article_content.php?code=' . $row['code'] . '&text=' . $row['title'] . '" target="_blank"><i class="fab fa-telegram" aria-hidden="true"></i> Telegram</a></li>
             <li><a class="dropdown-item" href="viber://forward?text=https://www.ukrzmi.com/desktop/article_content.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-viber" aria-hidden="true"></i> Viber</a></li>
              <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/article_content.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a></li>
              <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/article_content.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a></li>
              <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/article_content.php?code=' . $row['code'] . '" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
              <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/article_content.php?code=' . $row['code'] . '&media=https://www.ukrzmi.com/images/' . $row['photo'] . '&description=' . $row['title'] . '" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
              
             </ul>
             </li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="full_coverage.php?id=' . $row['id'] . '" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
              <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
            </ul>
          </div>
    
        <p class="cardTime">' . timeago($row['time']) . '</p>  
    
        <div class="ellipBox">
          <p class="cardEllip"></p>
        </div>
    <a href="category.php?cat_id=' . $row['category'] . '" target="_blank">    
    <p class="cardCategory text-muted">' . $catHolder . '</p>
    </a>
             </div>
          </div>
        </div>
       
        
      </div>
      </div>    </div>
  ';
    }
  }
  //for ($x = 0; $x <= 48; $x++) {}
  ?>

</div>