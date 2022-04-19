<?php
require_once "../includes/conn_2.php";
//$_GET['term'] = 'Ро';
if (isset($_GET['term'])) {
     $conn = $pdo->open();

   $stmt = $conn->prepare("SELECT COUNT(title) AS numrows FROM news WHERE title LIKE :keyword");
   $stmt->execute(['keyword' => '%'.$_GET['term'].'%']);
   $count = $stmt->fetch();
   
   $stmt = $conn->prepare("SELECT title FROM news WHERE title LIKE :keyword LIMIT 25");
   $stmt->execute(['keyword' => '%'.$_GET['term'].'%']);
   $data = $stmt->fetchAll();
   
 
    if ($count['numrows'] > 0) {
      foreach($data as $row){
          $res[] = $row['title'];
      }   
    } else {
      $res = array();
    }
    //return json res
    echo json_encode($res);
    //echo $count['numrows'];
   // echo print_r($res);
}
?>