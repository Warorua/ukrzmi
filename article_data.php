<?php
include 'includes/session.php';
$conn = $pdo->open();
if(!isset($_GET['id'])){
    $_SESSION['error'] = "Link error!";
    header('location: dash.php');
}
else{
$stmt = $conn->prepare("SELECT COUNT(*) as numrows FROM news WHERE code=:code");
$stmt->execute(['code'=>$_GET['id']]);
$cnt = $stmt->fetch();
$auth = $cnt['numrows'];
if($auth < 1){
    $_SESSION['error'] = "Article error or not found!";
    header('location: dash.php');
}
else{
    $code = $_GET['id'];
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
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>UkrZmi</title>
    <style>
    .dcr-1989ovb{
      width: 100% !important;
      height: auto !important;
    }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="jumbotron bg-light"><h6 class="text-primary display-6"><?php echo $my_title ?></h6></div>
        <div class="row">
            <div class="col-md-4">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Details</th>
     </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">Source</th>
      <td><?php echo $data['source'] ?></td>
     </tr>

     <tr>
      <th scope="row">Category</th>
      <td><?php echo $data['category'] ?></td>
     </tr>
     
    <tr>
      <th scope="row">Publisher time</th>
      <td><?php echo $data['published'] ?></td>
     </tr>
  </tbody>
</table>
            </div>
            <div class="col-md-4">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Details</th>
     </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">Author</th>
      <td><?php echo $author_edit ?></td>
     </tr>

     <tr>
      <th scope="row">Photograher</th>
      <td><?php echo $data['p_grapher'] ?></td>
     </tr>
     
    <tr>
      <th scope="row">Image</th>
      <td><?php echo $data['photo'] ?></td>
     </tr>
  </tbody>
</table>       
            </div>
            <div class="col-md-4">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tags</th>
     </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">Tag 1</th>
      <td><?php echo $data['tag_1'] ?></td>
     </tr>

     <tr>
      <th scope="row">Tag 2</th>
      <td><?php echo $data['tag_2'] ?></td>
     </tr>
     
    <tr>
      <th scope="row">Tag 3</th>
      <td><?php echo $data['tag_3'] ?></td>
     </tr>
  </tbody>
</table>            
            </div>
            <div class="col-md-6">
                <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Info</th>
     </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">Data ID</th>
      <td><?php echo $data['id'] ?></td>
     </tr>

     <tr>
      <th scope="row">Type</th>
      <td><?php
      if($data['type'] == ""){
          echo 'News';
      }
      else{
          echo $data['type'];
      }
      
      ?></td>
     </tr>
     
    <tr>
      <th scope="row">Hash ID</th>
      <td><?php echo $data['code'] ?></td>
     </tr>
  </tbody>
</table>      
            </div>

            <div class="col-md-6">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Details</th>
     </tr>
  </thead>
  <tbody>

    <tr>
      <th scope="row">Intefax Scan</th>
      <td><?php echo $intefax ?></td>
     </tr>

     <tr>
      <th scope="row">Title filter</th>
      <td><?php echo $title_scan ?></td>
     </tr>
     
    <tr>
      <th scope="row">Sub Category</th>
      <td><?php echo $data['sub_1'] ?></td>
     </tr>
  </tbody>
</table>            
            </div>


            <div class="col-md-12">
                <table class="table">
  <thead>
    <tr>
     
      <th scope="col" class="text-danger">INTERNAL URLS</th>
     </tr>
  </thead>
  <tbody>
<?php
foreach($url_array as $ur){
  echo '
   <tr>
      <td scope="row">'.$ur.'</td>
     </tr>
  ';
}
?>
   
  
  </tbody>
</table>      
            </div>
        </div>

        <img src="images/<?php echo $data['photo'] ?>" class="img-fluid" alt="...">
<hr/>
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
<p class="article_content">
  <?php echo $article ?>
</p>
<hr/>
<?php
if($data['video_url'] != ""){
  echo '<iframe allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen="true" frameborder="0" height="314" scrolling="no" src="'.$data['video_url'].'" style="border:none;overflow:hidden" width="560"></iframe>';
}
else{
  echo '<h6 class="display-6">This article has no videos!</h6>';
}
?>
<hr/>
<div class="row">
    <div class="col-md-3"><a class="btn btn-danger" href="<?php echo $data['deep_link'] ?>" role="button" target="_blank">Deep Link</a></div>
    <div class="col-md-3"><h6>Fetched at: <b><?php echo $data['time'] ?></b></h6></div>
    <div class="col-md-3"><a class="btn btn-danger" href="article_delete.php?id=<?php echo $data['id'] ?>" role="button">Delete Article</a></div>
</div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
  <script>
    var $window = $(window),
  window_height = $window.height() - 150, // I'm using 150 (a random number) so the image appears 150px after it enters the screen, so the effect can be appreciated
  $img = $('img.some_img'),
  img_loaded = false,
  img_top = $img.offset().top;

$window.on('scroll', function() {

  if (($window.scrollTop() + window_height) > img_top && img_loaded == false) {

    $img.attr('src', $img.attr('data-src'));

  }

});
</script>
<script>
///UNIAN
  $(document).ready(function(){
$("div[class='read-also-slider__item'],img[width='370'],img[data-width='200'],div[class='social-btn-bottom'],div[class='read-also-slider__info'],a[class='article__tag'],div[class='publication-bottom'],a[class='publication__tag'],a[class='publication__gn'],img[src='/images/gnews.svg'],a[class='anchor'],img[src='<?php echo $data['photo_url'] ?>'], div[class='bnr-block__bnr'], div[class='owl-photo'], div[class='owl-photo__item'], span[class='owl-photo__title'], div[class='owl-carousel']").remove();
$("div[class='owl-photo']").empty();
$('span').not('[class]').remove();
});
  </script>
 <script>
///PRAVDA
  $(document).ready(function(){
$("a[href='https://t.me/EurointegrationComUA'], ins[class='adsbygoogle'], div[class='article__title'], div[id='div-gpt-ad-1637938597466-0'], div[class='image-box'], a[href='https://www.patreon.com/EuropeanPravda']").remove();
});
  </script>
  <script>
    ////korrespondent
    $(document).ready(function(){
$("div[id='insertNewsBlock']").remove();
});
$('div').not('[class]').filter(function(){
     return  $.trim($(this).text()) === '' 
}).remove();
  </script>
   <script>
///theguardian
  $(document).ready(function(){
$("aside[data-component='rich-link']").remove();
});
  </script>
  <script>
///////p with no class, no id and no text
  $('p', '.ajaxPostText').not('[id],[class]').filter(function(){
     return  $.trim($(this).text()) === '' 
}).remove();
  </script>
</html>