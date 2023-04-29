<div class="row">
  <?php

  $block_news_2 = array_slice($block_news, 8, 8);

  foreach ($block_news_2 as $row) {
    $rowtitle = $row['title'];

    $maxPos = 500;
    if ($row['sub_1'] != '') {
      $catHolder = $row['sub_1'];
    } else {
      $catHolder = 'General';
    }
    if ($row['parent'] == "ua.korrespondent.net") {
      $rowParent = "Кореспондент";
    } elseif ($row['parent'] == "pravda.com.ua") {
      $rowParent = "правда";
    } elseif ($row['parent'] == "eurointegration.com.ua") {
      $rowParent = "євроінтеграція";
    } elseif ($row['parent'] == "unian.ua") {
      $rowParent = "уніанської";
    } elseif ($row['parent'] == "life.pravda.com.ua") {
      $rowParent = "life.правда";
    } elseif ($row['parent'] == "theguardian.com") {
      $rowParent = "The guardian";
    } elseif ($row['parent'] == "") {
      $rowParent = "правда";
    }


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
        <img class="cardPhoto" src="../images/' . $row['photo'] . '" height="122px" alt="' . $row['title'] . '" />
    </div>
 </div>   
  </a>    
    <div class="card-body">
          <a href="article_content.php?code=' . $row['code'] . '" class="cardLink"> <h6 class="cardHead" data-toggle="tooltip" data-placement="bottom" title="' . $row['title'] . '">' . $titleBadge . '' . $rowtitle . '</h6></a>
      <div class="cardFoot clearfix">
        <div class="cardCat">
         <div class="btn-group dropend shareIcon">
        <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-ellipsis-v text-dark" aria-hidden="true"></i>
            </a>
        <ul class="dropdown-menu">
         <li><h6 class="dropdown-header">Share</h6></li>
          <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/article_content.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a></li>
          <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/article_content.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a></li>
          <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/article_content.php?code=' . $row['code'] . '" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
          <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/article_content.php?code=' . $row['code'] . '&media=https://www.ukrzmi.com/images/' . $row['photo'] . '&description=' . $row['title'] . '" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
          <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
        </ul>
      </div>

    <p class="cardTime">' . timeago($row['time']) . '</p>  

    <div class="ellipBox">
      <p class="cardEllip"></p>
    </div>
    
<p class="cardCategory">' . $row['category'] . '</p>
         </div>
      </div>
    </div>
   
    
  </div>
  </div>    </div>
  ';
  }

  //for ($x = 0; $x <= 48; $x++) {}
  ?>

</div>