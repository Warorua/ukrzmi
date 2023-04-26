<?php
include './includes/session.php';
function filter_by_key($array, $allowed_values, $key, $unique_key) {
      //$allowed_values = ['Ken', 'pet', 'John', 'mat', 'Mike'];
      //$key = $key_value;
      $unique_ages = [];
    return array_filter($array, function($item) use ($allowed_values, &$unique_ages, $key, $unique_key) {
        if(isset($item[$key]) && in_array($item[$key], $allowed_values) && !in_array($item[$unique_key], $unique_ages)) {
            $unique_ages[] = $item[$unique_key];
            return true;
        }
        return false;
    });
  }

  
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT id, source, deep_link, parent, photo FROM news");
$stmt->execute();
$author_select = $stmt->fetchAll();

$filtered_array = filter_by_key(
      $author_select,
      [
            'Unian.ua/home',
            'ua.korrespondent.net/home',
            'pravda.com.ua/home',
            'eurointegration.com.ua/news/home'
      ],
      'source',
      'deep_link'
);

//echo json_encode($author_select);
print_r($filtered_array);

$stmt = $conn->prepare("SELECT DISTINCT source FROM news WHERE NOT source=:source ORDER BY category ASC");
$stmt->execute(['source' => '']);
$parent_select = $stmt->fetchAll();
foreach ($parent_select as $row) {
  //echo $row['source'] . '<br/>';
}
 ?>
