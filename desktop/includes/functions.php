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