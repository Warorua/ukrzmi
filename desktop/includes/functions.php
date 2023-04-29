<?php
$conn = $pdo->open();

function filter_by_key($array, $allowed_values, $key, $unique_key)
{
  $unique_ages = [];
  if (is_array($allowed_values)) {
    $filtered_array = array_filter($array, function ($item) use ($allowed_values, &$unique_ages, $unique_key, $key) {
      if (isset($item[$key]) && in_array($item[$key], $allowed_values) && !in_array($item[$unique_key], $unique_ages)) {
        $unique_ages[] = $item[$unique_key];
        return true;
      }
      return false;
    });
  } else {
    $filtered_array = $array;
  }
  usort($filtered_array, function ($a, $b) {
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

function rowParent($row)
{
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

function getTimeDifference($dateStr)
{
  $timestamp = strtotime($dateStr);
  $currentTimestamp = time();
  $difference = $currentTimestamp - $timestamp;
  return $difference;
}

function table_columns($table)
{
  global $conn;
  $stmt = $conn->prepare("SHOW COLUMNS FROM " . $table);
  $stmt->execute(['code' => '']);
  $data = $stmt->fetch();
  $output = '';
  foreach ($data as $row) {
    //$output .= $row['']
  }

  return $data;
}

function isValidImage($imagePath)
{
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


function articleCard($row, $block, $block_id, $frameColor, $filtTit, $titleBadge, $rowtitle = null, $catHolder)
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
          <img class="cardPhoto" src="' . $image . '" height="122px" alt="' . $row['title'] . '" loading="lazy"/>
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

function blockControl($block_total_cards)
{

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
    $lastPos = null;
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


function thematicCard($row, $thematic_block, $thematic_id)
{
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
    $rowParent = "правда";
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
  if ($row['type'] == 'video') {
    $fc_icon = '<div class="fcIconVid_2"><i class="fa fa-play-circle" aria-hidden="true"></i></div>';
  } else {
    $fc_icon = '';
  }
  ////////////////////////////////////////////////
  if ($row['type'] == 'video') {
    $fc_link = 'video_content';
  } elseif ($row['type'] == 'podcast') {
    $fc_link = 'podcast';
  } elseif ($row['type'] == '') {
    $fc_link = 'article_content';
  } else {
    $fc_link = 'article_content';
  }

  return '
  <div class=" item">    
  <div style="background-color: ' . $thematic_block[$thematic_id]['bg_color'] . ';" class="card newsCard">
  <div class="card-content">

  <a href="' . $fc_link . '.php?code=' . $row['code'] . '">
  <div class="imgFrame" style="border-color: ' . $frameColor . ';">
    <div class="imgTitle">
       <p class="blogTitle">' . $rowParent . '</p>
        <div class="cardFrame" style="border-color: ' . $frameColor . ';"></div>
      <img class="cardPhoto_2" src="https://www.ukrzmi.com/images/' . $row['photo'] . '" height="122px" alt="' . $row['title'] . '" />
      ' . $fc_icon . '
  </div>
  </div>   
  </a>    
  <div class="card-body">
        <a href="' . $fc_link . '.php?code=' . $row['code'] . '" class="cardLink"> <h6 class="cardHead" data-toggle="tooltip" data-placement="bottom" title="' . $row['title'] . '">' . $titleBadge . '' . $rowtitle . '</h6></a>
    <div class="cardFoot clearfix">
      <div class="cardCat">
       <div class="btn-group dropend shareIcon">
      <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
      </a>
      <ul class="dropdown-menu">
       <li><h6 class="dropdown-header">Share</h6></li>
        <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a></li>
        <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a></li>
        <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
        <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '&media=https://www.ukrzmi.com/images/' . $row['photo'] . '&description=' . $row['title'] . '" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="full_coverage.php?id=' . $row['id'] . '" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
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
  </div>   </div>
  ';
}

function listCard($row)
{
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
    $rowParent = "правда";
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

  $content = strip_tags(substr($row['article'], 0, 240)) . '...';

  return '

 <li id="post_' . $row['id'] . '" class="list-group-item my-2 post p-0">
 <div class="row d-flex justify-content-start">

 <div class="w-25 mt-2">
 <div class="imgFrame">
  <a href="article_content.php?code=' . $row['code'] . '">
  <div class="imgTitle">
   <p class="blogTitle">' . $rowParent . '</p>
        <div class="cardFrame" style="border-color: ' . $frameColor . ';"></div>
  <img class="cardPhotoList_2" src="../images/' . $row['photo'] . '" height="130px" alt="' . $row['title'] . '" />
   </div>
   </a> 
   </div> 
 </div>

 <div class="w-75">


 <div class="row">

 <div class="col-md-10">
 <div class="d-flex justify-content-between">
 <h5 class="text-dark" style="height:50px; overflow-y:hidden;"><b>' . $row['title'] . '</b></h5>
 <a href="article_content.php?code=' . $row['code'] . '" class="stretched-link" ></a>

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
      
 </div>


 <div class="w-100 d-flex justify-content-start">
   <small><span class="text-muted">' . $row['category'] . ' | ' . timeago($row['time']) . '</span></small>
   </div>
 </div>

 <div class="col-md-2">
 <div style="margin-top:0px" class="w-100">
   <a class="btn btn-outline-primary btn-sm " href="#">Full Coverage</a>
 </div> 
 </div>

 <div style="margin-top:4px" class="col-md-12">
 <p>
  ' . $content . '
  </p>
 </div>
 </div>
     
 </div>

 </div>

 </li>       
 ';
}

function timeago($date)
{
  $timestamp = strtotime($date);

  $strTime = array("sec", "min", "hr", "day", "mon", "year");
  $length = array("60", "60", "24", "30", "12", "10");

  $currentTime = date("D, d M Y H:i:s");;
  if ($currentTime >= $timestamp) {
    $diff     = time() - $timestamp;
    for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
      $diff = $diff / $length[$i];
    }

    $diff = round($diff);
    if ($diff > 1) {
      $final = $diff . " " . $strTime[$i] . "s ago ";
    } else {
      $final = "0 secs ago ";
    }

    return $final;
  }
}

function voicesCard($row, $tok)
{
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
    $rowParent = "правда";
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
    $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . '...';
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

  $content = strip_tags(substr($row['article'], 0, 260)) . '...';
  if ($row['type'] == 'video') {
    $fc_icon = '<div class="fcIcon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>';
    $fc_icon_title = '<i class="fa fa-play-circle" aria-hidden="true"></i>';
    $fc_link = 'video_content';
  } elseif ($row['type'] == 'podcast') {
    $fc_icon = '<div class="fcIcon"><i class="fa fa-podcast" aria-hidden="true"></i></div>';
    $fc_icon_title = '<i class="fa fa-podcast" aria-hidden="true"></i>';
    $fc_link = 'podcast';
  } elseif ($row['type'] == '') {
    $fc_icon = '';
    $fc_icon_title = '';
    $fc_link = 'article_content';
  } else {
    $fc_icon = '';
    $fc_icon_title = '';
    $fc_link = 'article_content';
  }
  if (!isset($row['voice_profile'])) {
    $profile = $row['photo_url'];
  } else {
    $profile = $row['voice_profile'];
  }
  $contentFull = strip_tags($row['article']);
  $setA = $tok->tokenize($contentFull);
  $contentTime = number_format(sizeof($setA) / 200, 0);
  return '
 <li class="list-group-item my-2 post ps-0 pe-0">
 <div class="row">

 <div class="col-md-9">
 <div class="row">
 <div class="col-md-1">
 <img width="35px" src="https://www.pravda.com.ua/android-chrome-192x192.png"/>
 </div>
 <div class="col-md-10">
 <a href="' . $fc_link . '.php?code=' . $row['code'] . '" class="text-dark stretched-link text-decoration-none">
 <h5 class="">' . $row['title'] . '</h5>        
 </a>  
   <div class="w-100 justify-content-start">
   <small style="margin-top:25px">
   <span class="text-muted">' . $contentTime . ' Minutes
    <span style="font-size:5px; margin-left:4px; margin-right:4px; padding-bottom:10px;">
    <i style="font-size:5px; margin-left:4px; margin-right:4px;" class="fa fa-circle" aria-hidden="true"></i>
 </span>
    
  ' . timeago($row['time']) . ' 
 </span>
 </small>
   </div>  
 </div>
 <div class="col-md-1">
 <div class="btn-group dropend shareIcon">
 <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
 <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
 </a>
 <ul class="dropdown-menu">
 <li><h6 class="dropdown-header">Share</h6></li>
  <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a></li>
  <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a></li>
  <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
  <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '&media=https://www.ukrzmi.com/images/' . $row['photo'] . '&description=' . $row['title'] . '" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
  <li><hr class="dropdown-divider"></li>
  <li><a class="dropdown-item" href="full_coverage.php?id=' . $row['id'] . '" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
  <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
 </ul>
 </div>
 </div>
 </div>
 
      
 </div>

 <div class="col-md-3">

 <div class="card voiceCard_2">
  <div class="card-body">
  <div class="d-flex">
  <img src="' . $row['photo_url'] . '" width="40px" height="40px"  class="rounded-circle" alt="...">
    <h6 style="white-space:nowrap" class="card-title p-2 lh-base fw-normal">' . $row['author'] . '</h6>
  </div>
  <p style="font-size:12px; line-height:1.2;" class="text-muted">With supporting text below as a natural lead-in.</p>
 
  </div>
 </div>

 </div>

 </li>
 ';
}

function voicesListCard($row)
{
  $rowtitle = $row['title'];

  $maxPos = 92;
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
    $rowParent = "правда";
  } elseif ($row['parent'] == "theguardian.com") {
    $rowParent = "The guardian";
  } elseif ($row['parent'] == "") {
    $rowParent = "правда";
  }



  if (strlen($row['title']) > $maxPos) {
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
  ///////////////////////////////////////////////////////////////////////////////////////
  if ($row['type'] == 'video') {
    $fc_icon = '<div class="fcIcon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>';
    $fc_icon_title = '<i class="fa fa-play-circle" aria-hidden="true"></i>';
    $fc_link = 'video_content';
  } elseif ($row['type'] == 'podcast') {
    $fc_icon = '<div class="fcIcon"><i class="fa fa-podcast" aria-hidden="true"></i></div>';
    $fc_icon_title = '<i class="fa fa-podcast" aria-hidden="true"></i>';
    $fc_link = 'podcast';
  } elseif ($row['type'] == '') {
    $fc_icon = '';
    $fc_icon_title = '';
    $fc_link = 'article_content';
  } else {
    $fc_icon = '';
    $fc_icon_title = '';
    $fc_link = 'article_content';
  }


  return '
          <li class="list-group-item my-2 post">
          <div class="row">

          <div class="col-md-9">
          <div class="row">
          <div class="col-md-1">
          <img width="35px" src="https://www.pravda.com.ua/android-chrome-192x192.png"/>
          </div>
          <div class="col-md-10">
          <a href="' . $fc_link . '.php?code=' . $row['code'] . '" class="text-dark stretched-link text-decoration-none">
          <h5 class="">' . $fc_icon_title . ' ' . $row['title'] . '</h5>        
          </a>  
             <div class="w-100 justify-content-start">
             <small style="margin-top:25px">
             <span class="text-muted">By ' . $row['author'] . '
              <span style="font-size:5px; margin-left:4px; margin-right:4px; padding-bottom:10px;">
              <i style="font-size:5px; margin-left:4px; margin-right:4px;" class="fa fa-circle" aria-hidden="true"></i>
           </span>
              
            ' . $row['time'] . '

            
            <span style="font-size:5px; margin-left:4px; margin-right:4px; padding-bottom:10px;">
            <i style="font-size:5px; margin-left:4px; margin-right:4px;" class="fa fa-circle" aria-hidden="true"></i>
         </span>
          17 minutes reading


           </span>
           </small>
             </div>  
          </div>
          <div class="col-md-1">
          <div class="btn-group dropend shareIcon">
          <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
          </a>
          <ul class="dropdown-menu">
           <li><h6 class="dropdown-header">Share</h6></li>
            <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a></li>
            <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a></li>
            <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
            <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '&media=https://www.ukrzmi.com/images/' . $row['photo'] . '&description=' . $row['title'] . '" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="full_coverage.php?id=' . $row['id'] . '" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
            <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
          </ul>
        </div>
          </div>
          </div>
           
                
          </div>
            <div class="col-md-3">
           <div class="imgFrame">
            <div class="imgTitle">
             <p class="blogTitle">' . $rowParent . '</p>
        <div class="cardFrame_2" style="border-color: ' . $frameColor . ';"></div>
            <img class="listImage" src="' . $row['photo_url'] . '" height="100px" width="80%" alt="' . $row['title'] . '" />
            ' . $fc_icon . '
            </div>
             </div> 
          </div>


         </div>
    
      </li>
      ';
}

function voicesGridcard($row)
{
  $rowtitle = $row['title'];

  $maxPos = 92;
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
    $rowParent = "правда";
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
  if (!isset($row['voice_profile'])) {
    $profile = $row['photo_url'];
  } else {
    $profile = $row['voice_profile'];
  }
  if ($row['type'] == 'video') {
    $fc_icon = '<div class="fcIcon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>';
    $fc_icon_title = '<i class="fa fa-play-circle" aria-hidden="true"></i>';
    $fc_link = 'video_content';
  } elseif ($row['type'] == 'podcast') {
    $fc_icon = '<div class="fcIcon"><i class="fa fa-podcast" aria-hidden="true"></i></div>';
    $fc_icon_title = '<i class="fa fa-podcast" aria-hidden="true"></i>';
    $fc_link = 'podcast';
  } elseif ($row['type'] == '') {
    $fc_icon = '';
    $fc_icon_title = '';
    $fc_link = 'article_content';
  } else {
    $fc_icon = '';
    $fc_icon_title = '';
    $fc_link = 'article_content';
  }
  return '
  <div class="col-md-4">    
 <div class="card voiceCard">
 <div class="card-body">
 <div class="d-flex">
 <img src="' . $row['photo_url'] . '" width="50px" height="50px"  class="rounded-circle" alt="...">
  <h6 class="card-title p-2 lh-lg fw-normal">' . $row['author'] . '</h6>
 </div>
 <div style="height:40px">
 <p style="font-size:12px; line-height:1.2" class="text-muted">With supporting text below as a natural lead-in to additional content.</p>
 </div>
 <div style="height:130px">
 <p class="card-text" style="color:black; font-size:20px; line-height:1.3; font-weight:500">
  ' . $row['title'] . '
  </p>
 </div>
 <a href="' . $fc_link . '.php?code=' . $row['code'] . '" class="stretched-link"></a>  
  <div class="d-flex justify-content-between">
  <i class="fa fa-square text-dark"></i> 

  <div>
  <i class="fa fa-eye text-dark"></i>
  <span class="text-muted lh-lg" style="font-size:10px;"> 1,000</span>
  </div>



  <i class="fa fa-ellipsis-v text-dark"></i>
  </div>
 </div>
 </div>
 </div>
 ';
}

function allContentGridCard($row)
{
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
    $rowParent = "правда";
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
    $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . '...';
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
  if ($row['type'] == 'video') {
    $fc_icon = '<div class="fcIconVid"><i class="fa fa-play-circle" aria-hidden="true"></i></div>';
  } else {
    $fc_icon = '';
  }
  ////////////////////////////////////////////////
  if ($row['type'] == 'video') {
    $fc_link = 'video_content';
  } elseif ($row['type'] == 'podcast') {
    $fc_link = 'podcast';
  } elseif ($row['type'] == '') {
    $fc_link = 'article_content';
  } else {
    $fc_link = 'article_content';
  }

  return '
  <div class="col-md-3 post">    
  <div class="card col-sm-4 col-md-3 newsCard">
    <div class="card-content">

 <a href="' . $fc_link . '.php?code=' . $row['code'] . '">
 <div class="imgFrame">
      <div class="imgTitle">
         <p class="blogTitle">' . $rowParent . '</p>
        <div class="cardFrame" style="border-color: ' . $frameColor . ';"></div>
        <img class="cardPhoto" src="' . $row['photo_url'] . '" height="122px" alt="' . $row['title'] . '" />
        ' . $fc_icon . '
    </div>
  </div>   
  </a>    
    <div class="card-body">
          <a href="' . $fc_link . '.php?code=' . $row['code'] . '" class="cardLink"> <h6 class="cardHead" data-toggle="tooltip" data-placement="bottom" title="' . $row['title'] . '">' . $titleBadge . '' . $rowtitle . '</h6></a>
      <div class="cardFoot clearfix">
        <div class="cardCat">
         <div class="btn-group dropend shareIcon">
        <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-ellipsis-v text-dark" aria-hidden="true"></i>
            </a>
        <ul class="dropdown-menu">
         <li><h6 class="dropdown-header">Share</h6></li>
          <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a></li>
          <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a></li>
          <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
          <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/' . $fc_link . '.php?code=' . $row['code'] . '&media=https://www.ukrzmi.com/images/' . $row['photo'] . '&description=' . $row['title'] . '" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="full_coverage.php?id=' . $row['id'] . '" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
          <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
        </ul>
      </div>

    <p class="cardTime">' . timeago($row['time']) . '[' . $row['id'] . ']</p>  

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

function get_ids($array, $key) {
  $ids = array();
  foreach($array as $element) {
      $ids[] = $element[$key];
  }
  return $ids;
}

function ukrzmiNavCard($row, $block, $block_id)
{
  $allcards = '';
  foreach ($row as $rr) {
    $catHolder = blockAux($rr)['catHolder'];
    $lastPos = blockAux($rr)['lastPos'];
    $rowtitle = blockAux($rr)['rowtitle'];
    $filtTit = blockAux($rr)['filtTit'];
    $frameColor = blockAux($rr)['frameColor'];
    $titleBadge = blockAux($rr)['titleBadge'];
    $allcards .= articleCard($rr, $block, $block_id, $frameColor, $filtTit, $titleBadge, $rowtitle, $catHolder);
  }
  return $allcards;
}

function ukrzmiCard($row, $block, $block_id)
{

  
    $catHolder = blockAux($row)['catHolder'];
    $lastPos = blockAux($row)['lastPos'];
    $rowtitle = blockAux($row)['rowtitle'];
    $filtTit = blockAux($row)['filtTit'];
    $frameColor = blockAux($row)['frameColor'];
    $titleBadge = blockAux($row)['titleBadge'];
    $allcards = articleCard($row, $block, $block_id, $frameColor, $filtTit, $titleBadge, $rowtitle, $catHolder);
  
  return $allcards;
}

function dropdown($row, $block, $block_id)
{

  $card = '';
  $row = filter_by_key(
    $row,
    [
      $block[$block_id]['type']
    ],
    'category',
    'deep_link'
  );
  $row = array_slice($row, 0, 2);
  
    $card = ukrzmiNavCard($row, $block, $block_id);
  

  return '
  <div style="width:100%;z-index:500" class="dropdown-menu shadow position-absolute">
   <div class="mega-content px-4">
     <div class="">
       <div class="row">

    
 ' . $card . '

 <div class="col-md-1"></div>
         <div class="col-md-5">
           
         <ol class="list-group list-group-numbered list-group-flush">
 <li class="list-group-item d-flex justify-content-between align-items-start">
 <div class="ms-2 me-auto">
   <div class="fw-bold">Subheading</div>
   Content for list item
  </div>
  <span class="badge bg-primary rounded-pill">14</span>
 </li>
 <li class="list-group-item d-flex justify-content-between align-items-start">
 <div class="ms-2 me-auto">
   <div class="fw-bold">Subheading</div>
   Content for list item
 </div>
 <span class="badge bg-primary rounded-pill">14</span>
 </li>
 <li class="list-group-item d-flex justify-content-between align-items-start">
 <div class="ms-2 me-auto">
   <div class="fw-bold">Subheading</div>
   Content for list item
 </div>
 <span class="badge bg-primary rounded-pill">14</span>
 </li>
 </ol>
  
         </div>

       </div>
       <hr/>
     </div>
   </div>
 </div>

 ';
}