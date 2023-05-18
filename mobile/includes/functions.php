<?php
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


function newsFetch($limit = null)
{
    global $conn;
    if($limit != null){
        $ad = 'LIMIT '.$limit;
    }else{
        $ad = '';
    }
    $stmt = $conn->prepare("SELECT * FROM news 
 WHERE NOT category=:cat_not
 AND type=:type
 AND pin=:pin
 ORDER BY id ".$ad);
    $stmt->execute(['cat_not' => 'international', 'type' => "", 'pin' => 0]);
    $allNews = $stmt->fetchAll();
    return $allNews;
}

function thematicCard($row, $thematic_block, $thematic_id)
{
    $rowtitle = $row['title'];

    $maxPos = 92;
    if ($row['sub_1'] != '') {
        $catHolder = $row['sub_1'];
    } else {
        $catHolder = 'Генеральний';
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
    <div class="item w-50">    
     <div style="background-color: ' . $thematic_block[$thematic_id]['bg_color'] . ';" class="card border border-dark rounded h-100">
      <div class="card-content">

      <div class="">
         <div class="imgTitle_fc">
   
          <img class="cardPhoto_3" src="' . $row['photo_url'] . '" height="122px" alt="' . $row['title'] . '" />
          ' . $fc_icon . '
        </div>
      </div>   


      <div class="">
         <a href="' . $fc_link . '.php?code=' . $row['code'] . '" class="stretched-link"></a> 
         <h6 style="font-size:12px" class="w-100">' . $titleBadge . '' . $rowtitle . '</h6>
      </div>


      </div>
     </div> 
    </div>
       ';
}
