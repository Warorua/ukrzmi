<?php
include './includes/session.php';
$conn = $pdo->open();
function posiDescSort($item1,$item2)
{
    if ($item1['position'] == $item2['position']) return 0;
    return ($item1['position'] > $item2['position']) ? 1 : -1;
}
$stmt = $conn->prepare("SELECT * FROM blocks WHERE NOT position=:position AND NOT mode=:mode AND page=:page");
$stmt->execute(['position'=>404, 'mode'=>'', 'page'=>'home']);
$thematic_block = $stmt->fetchAll();
usort($thematic_block,'posiDescSort'); 
  
  print_r($thematic_block);