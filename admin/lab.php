<?php
include './includes/session.php';
$conn = $pdo->open();

$tag_1 ='';
$tag_2= 'alex';
$tag_3= 'andrew';
$type = 'antony';

if ($tag_1 != '') {
      $tag_1_fin = " AND tag_1 ='" . $tag_1 . "'";
} else {
      $tag_1_fin = '';
}
///////////////////////////////////////
if ($tag_2 != '') {
      $tag_2_fin = " AND tag_2 ='" . $tag_2 . "'";
} else {
      $tag_2_fin = '';
}
///////////////////////////////////////
if ($tag_3 != '') {
      $tag_3_fin = " AND tag_3 ='" . $tag_3 . "'";
} else {
      $tag_3_fin = '';
}
///////////////////////////////////////
if ($type != '') {
      $type_fin = " AND type = '" . $type . "'";
} else {
      $type_fin = '';
}  

//$ser_obj = '{'.cleandt($tag_1_fin).','.cleandt($tag_2_fin).','.cleandt($tag_3_fin).','.cleandt($type_fin).'}';

$ser_obj = '{';
if($tag_1 != ''){
      $ser_obj .= cleandt($tag_1_fin).',';
}
if($tag_2 != ''){
      $ser_obj .= cleandt($tag_2_fin).',';
}
if($tag_3 != ''){
      $ser_obj .= cleandt($tag_3_fin).',';
}
if($type != ''){
      $ser_obj .= cleandt($type_fin).',';
}
$ser_obj .= '}';
$ser_obj = str_replace(",}","}", $ser_obj);

//print_r(json_decode($ser_obj, true));
echo $ser_obj.'<br/>';
$enc = base64_encode($ser_obj);
echo $enc.'<br/>';
$dec = base64_decode($enc);
echo $dec.'<br/>';
print_r(json_decode($dec, true));
 ?>
