<?php
include './includes/session.php';
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT DISTINCT tag_1, tag_2, tag_3 FROM news");
$stmt->execute();
$author_select = $stmt->fetchAll();
$data = [];
foreach ($author_select as $row) {
      if (strlen($row['tag_1']) > 1) {
            if (!valueExistsInArray($row['tag_1'], $data)) {
                  array_push($data, $row['tag_1']);
            }
      }
      if (strlen($row['tag_2']) > 1) {
            if (!valueExistsInArray($row['tag_2'], $data)) {
                  array_push($data, $row['tag_2']);
            }
      }
      if (strlen($row['tag_3']) > 1) {
            if (!valueExistsInArray($row['tag_3'], $data)) {
                  array_push($data, $row['tag_3']);
            }
      }
}

build_file('./components/tags.json', json_encode($data));
//echo json_encode($data);
//echo count($data);
foreach($data as $row){
     //echo $row.'<br/>';
}
 ?>
