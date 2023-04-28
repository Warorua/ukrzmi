<?php
$conn = $pdo->open();
///////////////////////////////////////////normal blocks
$stmt = $conn->prepare("SELECT * FROM blocks WHERE NOT position=:position AND NOT mode=:mode");
$stmt->execute(['position'=>404, 'mode'=>'thematic']);
$block = $stmt->fetchAll();
usort($block,'posiDescSort');
///////////////////////////////////////////thematic blocks
if(isset($page)){
 $stmt = $conn->prepare("SELECT * FROM blocks WHERE NOT position=:position AND NOT mode=:mode AND page=:page");
$stmt->execute(['position'=>404, 'mode'=>'', 'page'=>$page]);
$thematic_block = $stmt->fetchAll();
usort($thematic_block,'posiDescSort');   
}


////////////////////////////////////////////////////////////////////////////////
function posiDescSort($item1,$item2)
{
    if ($item1['position'] == $item2['position']) return 0;
    return ($item1['position'] > $item2['position']) ? 1 : -1;
}

function idDescSort($item1,$item2)
{
    if ($item1['id'] == $item2['id']) return 0;
    return ($item1['id'] > $item2['id']) ? -1 : 1;
}

//print_r($block);

//print_r($block);
//print_r($block[3]);
/////////////////////////////TIME ELAPSED

