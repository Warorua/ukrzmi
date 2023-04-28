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

  
  function articleCard($row, $block, $block_id, $rowParent, $frameColor, $filtTit, $titleBadge, $rowtitle, $catHolder){
    return '
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