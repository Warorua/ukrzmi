<?php
//include '../../includes/conn.php';
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT * FROM blocks");
$stmt->execute();
$block = $stmt->fetchAll();
//array_push($block,array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow","position"=>"10"),array("position"=>"17", "name"=>"test block"));

function posiDescSort($item1,$item2)
{
    if ($item1['position'] == $item2['position']) return 0;
    return ($item1['position'] > $item2['position']) ? 1 : -1;
}
usort($block,'posiDescSort');
//print_r($block);

//print_r($block);
//print_r($block[3]);
/////////////////////////////TIME ELAPSED
function timeago($date) {
    $timestamp = strtotime($date);	
    
    $strTime = array("sec", "minute", "hour", "day", "mon", "year");
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