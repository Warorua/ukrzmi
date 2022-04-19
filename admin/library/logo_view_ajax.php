<?php
include '../includes/conn.php';
function formatBytes($bytes, $precision = 2) { 
  $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

  $bytes = max($bytes, 0); 
  $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
  $pow = min($pow, count($units) - 1); 

  // Uncomment one of the following alternatives
  $bytes /= pow(1024, $pow);
  // $bytes /= (1 << (10 * $pow)); 

  return round($bytes, $precision) . ' ' . $units[$pow]; 
} 
$output = '';
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM logo");
$stmt->execute();
$block = $stmt->fetchAll();
foreach($block as $row){
    $output .=  '
                    <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['source'].'</td>
                    <td>'.$row['type'].'</td>
                    <td>'.formatBytes($row['size']).'</td>
                    <td>'.$row['width'].'px</td>
                    <td>'.$row['height'].'px</td>
                    <td><img src="components/logos/'.$row['image'].'" width="100px"/></td>
                  <td><a class="btn btn-outline-danger" href="library/logo_delete.php?id='.$row['id'].'&image='.$row['image'].'">Delete</a></td>
                  </tr>
  
   '; 
}
echo $output;
?>