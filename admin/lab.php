<?php
include './includes/session.php';
function filter_by_key($array, $allowed_values, $key_value) {
      //$allowed_values = ['Ken', 'pet', 'John', 'mat', 'Mike'];
      $key = $key_value;
      return array_filter($array, function($item) use ($allowed_values) {
          return isset($item['source']) && in_array($item['source'], $allowed_values);
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
      'source'
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
