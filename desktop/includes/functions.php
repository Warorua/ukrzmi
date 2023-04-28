<?php
function filter_by_key($array, $allowed_values, $key, $unique_key)
{
      $unique_ages = [];
    $filtered_array = array_filter($array, function($item) use ($allowed_values, &$unique_ages, $unique_key, $key) {
        if(isset($item[$key]) && in_array($item[$key], $allowed_values) && !in_array($item[$unique_key], $unique_ages)) {
            $unique_ages[] = $item[$unique_key];
            return true;
        }
        return false;
    });
    usort($filtered_array, function($a, $b) {
        return $b['id'] - $a['id'];
    });
    return $filtered_array;
}

function newsFetch()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM news 
 WHERE NOT category=:cat_not
 AND type=:type
 AND pin=:pin
ORDER BY id;");
    $stmt->execute(['cat_not' => 'international', 'type' => "", 'pin' => 0]);
    $allNews = $stmt->fetchAll();
    return $allNews;
}

function rowParent($row){
    if ($row['parent'] == "ua.korrespondent.net") {
        $rowParent = "Кореспондент";
      } elseif ($row['parent'] == "pravda.com.ua") {
        $rowParent = "правда";
      } elseif ($row['parent'] == "eurointegration.com.ua") {
        $rowParent = "євроінтеграція";
      } elseif ($row['parent'] == "unian.ua") {
        $rowParent = "уніанської";
      } elseif ($row['parent'] == "life.pravda.com.ua") {
        $rowParent = "правда";
      } elseif ($row['parent'] == "theguardian.com") {
        $rowParent = "The guardian";
      } elseif ($row['parent'] == "") {
        $rowParent = "правда";
      }

      return $rowParent;
}

function getTimeDifference($dateStr) {
    $timestamp = strtotime($dateStr);
    $currentTimestamp = time();
    $difference = $currentTimestamp - $timestamp;
    return $difference;
  }

  function table_columns($table){
    global $conn;
    $stmt = $conn->prepare("SHOW COLUMNS FROM ".$table);
    $stmt->execute([ 'code' => '']);
    $data = $stmt->fetch();
    $output = '';
    foreach($data as $row){
        //$output .= $row['']
    }

    return $data;
  }

  function isValidImage($imagePath) {
    // Check if the file exists
    if (!file_exists($imagePath)) {
      return false;
    }
  
    // Check if the file is an image
    $imageTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
    $detectedType = exif_imagetype($imagePath);
    if (!in_array($detectedType, $imageTypes)) {
      return false;
    }
  
    return true;
  }


function articleCard($row, $block, $block_id, $rowParent, $frameColor, $filtTit, $titleBadge, $rowtitle = null, $catHolder)
{
  if (isValidImage('../images/' . $row['photo'])) {
    $image = '../images/' . $row['photo'];
  } else {
    $image = $row['photo_url'];
  }
  return '
    <div class="col-md-3">    
    <div class="card col-sm-4 col-md-3 newsCard" style="background-color:' . $block[$block_id]['bg_color'] . '">
      <div class="card-content">
  
  <a href="article_content.php?code=' . $row['code'] . '">
   <div class="imgFrame">
        <div class="imgTitle">
           <p class="blogTitle">' . rowParent($row) . '</p>
          <div class="cardFrame" style="border-color: ' . $frameColor . ';"></div>
          <img class="cardPhoto" src="' . $image . '" height="122px" alt="' . $row['title'] . '" />
      </div>
   </div>   
    </a>    
      <div class="">
            <a href="article_content.php?code=' . $row['code'] . '" class="cardLink cardTitRow"> 
          <h6 class="cardHead" data-toggle="tooltip" data-placement="bottom" title="' . $filtTit . '">' . $titleBadge . '' . $row['title'] . '</h6>
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

function blockControl($block_total_cards){
  
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

  return [$slide_control, $hide_control_button];
}

function blockAux($row)
{

  $maxPos = 500;
  if ($row['sub_1'] != '') {
    $catHolder = $row['sub_1'];
  } else {
    $catHolder = 'General';
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

  return ['titleBadge' => $titleBadge, 'frameColor' => $frameColor, 'filtTit' => $filtTit, 'rowtitle' => $rowtitle, 'lastPos' => $lastPos, 'catHolder' => $catHolder];
}