<?php
$conn = $pdo->open();
if(!isset($_GET['code'])){
    $_SESSION['error'] = "Link error!";
    header('location: home.php');
}
else{
$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM news WHERE code=:code");
$stmt->execute(['code'=>$_GET['code']]);
$cnt = $stmt->fetch();
$auth = $cnt['numrows'];
if($auth < 1){
    $_SESSION['error'] = "Article error or not found!";
    header('location: home.php');
}
else{
    $code = $_GET['code'];
}
}

$stmt = $conn->prepare("SELECT * FROM news WHERE code=:code");
$stmt->execute(['code'=>$code]);
$data = $stmt->fetch();


$content1 = $data['article'];

//echo $_SERVER['PHP_SELF'];
//echo $content1;
/////////////////////////////////////////////////////////////Pre REMOVED
$pre_array = array();
//pravda
array_push($pre_array, 'class=""');
$content1  = str_replace($pre_array, "", $content1);
////////////////////////////////////////////////////////////////////////////////////////////////////
//$sourceURL="https://www.ukrzmi.com/article_data.php?id=prav_H65BoOGLV13l";
//$content=file_get_contents($sourceURL);
$content = strip_tags($content1,"<a>");

$my_arr = array();
$url_array = array();
$full_arr = '';
$subString = preg_split("/<\/a>/",$content);
foreach ( $subString as $val ){
 if( strpos($val, "<a href=") !== FALSE ){
 $val = preg_replace("/.*<a\s+href=\"/sm","",$val);
 $val = preg_replace("/\".*/","",$val);

 if(str_starts_with($val, '/')){
  array_push($url_array, $val);
    array_push($my_arr,'href="'.$val.'"');
 }
 if(str_starts_with($val, 'https://www.unian')){
  array_push($url_array, $val);
  array_push($my_arr,'href="'.$val.'"');
}
if(str_starts_with($val, 'https://sport.unian')){
  array_push($url_array, $val);
  array_push($my_arr,'href="'.$val.'"');
}
if(str_starts_with($val, 'https://www.pravda')){
  array_push($url_array, $val);
  array_push($my_arr,'href="'.$val.'"');
}
if(str_starts_with($val, 'https://www.eurointegration')){
  array_push($url_array, $val);
  array_push($my_arr,'href="'.$val.'"');
}
if(str_starts_with($val, 'http://www.eurointegration')){
  array_push($url_array, $val);
  array_push($my_arr,'href="'.$val.'"');
}
if(str_starts_with($val, 'https://ua.korrespondent')){
  array_push($url_array, $val);
  array_push($my_arr,'href="'.$val.'"');
}
if(str_starts_with($val, 'http://ua.korrespondent')){
  array_push($url_array, $val);
  array_push($my_arr,'href="'.$val.'"');
}
if(str_starts_with($val, 'https://korrespondent')){
  array_push($url_array, $val);
  array_push($my_arr,'href="'.$val.'"');
}
if(str_starts_with($val, 'https://www.epravda')){
  array_push($url_array, $val);
  array_push($my_arr,'href="'.$val.'"');
}
 //print $val."<br/>";
 }
}
//unian
array_push($my_arr, '<p></p>');
array_push($my_arr, '<br/>');
array_push($my_arr, 'УНІАН');
array_push($my_arr, 'href="https://www.unian');
array_push($my_arr, 'href="https://sport.unian');
//pravda
array_push($my_arr, 'ЄвроПравди');
array_push($my_arr, 'href="https://www.pravda');
array_push($my_arr, 'https://www.eurointegration');
array_push($my_arr, 'https://www.epravda');
array_push($my_arr, '#dbdfd6');
//array_push($my_arr, 'class=""');
//korrespondent
array_push($my_arr, 'https://ua.korrespondent');
array_push($my_arr, 'http://ua.korrespondent');
array_push($my_arr, 'https://korrespondent');
//the guardian
array_push($my_arr, 'href="https://www.theguardian');
$article = str_replace($my_arr, "", $content1);
//echo $article;
//print_r ($my_arr);
///////////////////////////////////////////////////////////////////////////////////////////////
?>
<?php
/////CLEAN TITLE/////////
$orig_title = $data['title'];
$head_array = array();
////////////////////////////////////removes
array_push($head_array, '(карта)');
array_push($head_array, '(відео)');
array_push($head_array, '(фото)');
array_push($head_array, '(фото, відео)');
///////////////////////////
$my_title = str_replace($head_array, "", $orig_title);

?>
<?php
////INTEFAX SCANNER//////
$word = 'Інтерфакс';
$word_b = 'href="http://www.intefax';
$word_c = 'intefax';
$word_d = 'Interfax';

$mystring = $data['article']; 
// Test if string contains the word 
if(strpos($mystring, $word) !== false || strpos($mystring, $word_b) !== false || strpos($mystring, $word_c) !== false || strpos($mystring, $word_d) !== false){
    $intefax = '<b style="color:red">INTEFAX Found!</b><br/>';
} else{
  $intefax = '<b style="color:green">INTEFAX Not Found!</b><br/>';
} 

?>
<?php
$w_a = '(карта)';
$w_b = '(відео)';
$w_c = '(фото)';
$w_d = '(фото, відео)';

$ti_scan = $data['title'];
if(strpos($ti_scan, $w_a) !== false){
 $title_scan = '<b style="color:red">'.$w_a.'</b>';
}
if(strpos($ti_scan, $w_b) !== false){
  $title_scan = '<b style="color:red">'.$w_b.'</b>';
 }
 if(strpos($ti_scan, $w_c) !== false){
  $title_scan = '<b style="color:red">'.$w_c.'</b>';
 }
 if(strpos($ti_scan, $w_d) !== false){
  $title_scan = '<b style="color:red">'.$w_d.'</b>';
 }
 if(strpos($ti_scan, $w_a) !== false || strpos($ti_scan, $w_b) !== false || strpos($ti_scan, $w_c) !== false || strpos($ti_scan, $w_d) !== false){
  //$title_scan = '<b style="color:green">Either words found</b>';
 }
 else{
  $title_scan = '<b style="color:green">Title is clean</b>';
 }
?>
<?php
/////pravda author filter
if($data['parent'] == 'pravda.com.ua'){
  if(strpos($data['published'], " — ") !== false){
    $author_edit = substr($data['published'], 0, strpos($data['published'], " — "));
  } 
  else{
    $author_edit = $data['author'];
  }
}
else{
  $author_edit = $data['author'];
}

////////////////source rename
if($data['parent'] == "ua.korrespondent.net"){
    $rowParent = "Кореспондент";
  }
  elseif($data['parent'] == "pravda.com.ua"){
    $rowParent = "правда";
  }
  elseif($data['parent'] == "eurointegration.com.ua"){
    $rowParent = "євроінтеграція";
  }
  elseif($data['parent'] == "unian.ua"){
    $rowParent = "уніанської";
  }
  elseif($data['parent'] == "life.pravda.com.ua"){
    $rowParent = "правда";
  }
  elseif($data['parent'] == "theguardian.com"){
    $rowParent = "The guardian";
  }
  elseif($data['parent'] == ""){
    $rowParent = "правда";
  }
  // close opened html tags
  function closetags ( $html )
  {
  #put all opened tags into an array
  preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $html, $result );
  $openedtags = $result[1];

  #put all closed tags into an array
  preg_match_all ( "#</([a-z]+)>#iU", $html, $result );
  $closedtags = $result[1];
  $len_opened = count ( $openedtags );

  # all tags are closed
  if( count ( $closedtags ) == $len_opened )
  {
      return $html;
  }
  $openedtags = array_reverse ( $openedtags );

  # close tags
  for( $i = 0; $i < $len_opened; $i++ )
  {
      if ( !in_array ( $openedtags[$i], $closedtags ) )
      {
          $html .= "</" . $openedtags[$i] . ">";
      }
      else
      {
          unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
      }
  }
  return $html;
}
// close open
?>
    <style>
    .dcr-1989ovb{
      width: 100% !important;
      height: auto !important;
    }
    </style>
    <style>
div.read-also-slider__carousel{
  display: none;
}
div.read-also-slider__info{
  display: none;
}
a.read-also-slider__image{
  display: none;
}
a.read-also-slider__link{
  display: none;
}
div.read-also-slider__title{
  display: none;
}
a.read-also-slider__image img{
  display: none;
}
span.strong{
    font-weight:800;
    font-size:22px;
    padding-top:15px;
    /*display: block;*/
}

</style>