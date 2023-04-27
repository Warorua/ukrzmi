<?php
include './includes/session.php';
function posiDescSort($item1,$item2)
{
    if ($item1['position'] == $item2['position']) return 0;
    return ($item1['position'] > $item2['position']) ? 1 : -1;
}

$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM blocks WHERE NOT position=:position AND NOT mode=:mode");
$stmt->execute(['position'=>404, 'mode'=>'thematic']);
$block = $stmt->fetchAll();
usort($block,'posiDescSort');
print_r($block);
 ?>
