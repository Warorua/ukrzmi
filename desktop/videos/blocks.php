<?php
$conn = $pdo->open();
///////////////////////////////////////////normal blocks
$stmt = $conn->prepare("SELECT * FROM blocks WHERE NOT position=:position AND NOT mode=:mode AND page=:page");
$stmt->execute(['position'=>404, 'mode'=>'thematic', 'page'=>'']);
$block = $stmt->fetchAll();
for($x=0; $x<=10; $x++){
unset($block[$x]['bg_color']);
$block[$x]['bg_color'] = '#FFF';
$block[$x]['position'] = $x;
    if(!isset($block[$x]['id'])){
        $blockNew = array(
            'id'=>$x,
            'bg_color'=>'#FFF',
            'position'=>$x
        );
        array_push($block, $blockNew);
    }
}
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



//print_r($block);

//print_r($block);
//print_r($block[3]);
/////////////////////////////TIME ELAPSED
function timeago($date) {
    $timestamp = strtotime($date);	
    
    $strTime = array("sec", "min", "hr", "day", "mon", "year");
    $length = array("60","60","24","30","12","10");

    $currentTime = date("D, d M Y H:i:s");;
    if($currentTime >= $timestamp) {
         $diff     = time()- $timestamp;
         for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
         $diff = $diff / $length[$i];
         }

         $diff = round($diff);
         return $diff . " " . $strTime[$i] . "s ago ";
    }
 }
?>