<?php
//header('Content-Type: text/html; charset=utf-8');
include_once('inc/simple_html_dom.php');
include 'includes/session.php';
require '../vendor/autoload.php';
$httpClient = new \simplehtmldom\HtmlWeb();
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////         HOME PAGE TRENDING            ///////////////////////////////
$url = 'https://www.theguardian.com/international';
$response001 = $httpClient->load($url);

//Get Parent Link
$box = $response001->find('section[id=ukraine-invasion] div div div.fc-slice-wrapper ul.fc-slice--mf li.u-faux-block-link div.fc-item--live-updates div.fc-item__content--above h3.fc-item__title a.fc-item__link');
$link = $box[0]->href;



//$link = 'https://www.theguardian.com/world/live/2022/mar/11/russia-ukraine-war-latest-news-we-are-dealing-with-a-terrorist-state-says-zelenskiy-biden-plans-fresh-russian-trade-crackdown-live';
$output = '';

$response00 = $httpClient->load($link);
//Content container
$box = $response00->find('div[itemprop=liveBlogUpdate]');
$data = $box[0]->outertext;
$code = $box[0]->id;
//$output .= $data.'<br/>';
//$output .= sizeof($box);

$response = str_get_html($data);

//Title

$title = $response->find('h2.block-title', 0)->plaintext . PHP_EOL . PHP_EOL;
$output .= $title."<br/>";
//Image
$img = $response00->find('meta[itemprop=image]');
$pic_1 = $img[1]->content;
$output .= $pic_1.'<br/>';
//$output .= sizeof($img).' - size of image array <br/>';
//Link HREF
$href =  $response->find('p.block-time a.block-time__link');
$f_href = 'https://www.theguardian.com'.$href[0]->href;
$output .= $f_href.'<br/>';

//Date
$date =  $response->find('p.block-time time');
$date_size = sizeof($date);
if($date_size > 0){
  $published = $date[0]->datetime;  
}
else{
    $date =  $response->find('div[itemprop=liveBlogUpdate]');
    $published = $date[0]->{'data-sort-time'};  
}
$output .= $published."<br/>";

//////////////////////   DETAILS OF ARTICLE    /////////////////////////////
$output .= '<h2 style="text-align:center">Article details</h2>';
$h_link = $f_href;
/*
$content = $httpClient->load($h_link);
*/
$content = $response;
//Video Fetch
$output .= '<h3>Video</h3>';
$video_2 =  $content->find('.article-text iframe');
if(sizeof($video_2) == 0){
    $news_type = "";
    $video_f = "";
    $output .= $video_f."<br/>";
}
else{
    $news_type = "video";
$video_f = $video_2[0]->src;
$output .= $video_f."<br/>";
$output .= '<iframe allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen="true" frameborder="0" height="314" scrolling="no" src="'.$video_f.'" style="border:none;overflow:hidden" width="560"></iframe>';

}
$sub_2 = "";

//Subcategory Fetch
//$subc = $content->find('.article div.top-bredcr div.breadcrumbs ol li a span');
$sub_1 = "війни";
$output .= $sub_1." - <b>Sub Category</b> <br/><br/>";

//Author Fetch
$author = $response->find('p[itemprop=author]');
$author_size = sizeof($author);
if($author_size > 0){
    $p_author = $author[0]->plaintext;
}
else{
    $p_author = "theguardian";
}
$output .= $p_author." - <b>Author</b> <br/><br/>";

//Article Content Fetch
$output .= '<h3>Article content</h3>';
$article =  $content->find('div.block-elements');
$ar_1 = $article[0]->outertext;
$output .= $ar_1;
//$ar_full = join($article);
$ar_full = $ar_1;
$ar_size = strlen($ar_full);
$output .= "<b>Size of this article is ".$ar_size."</b><br/>";
if($ar_size < 700){
    $output .= '<b style="color:red">Not fetched. Characters < 700</b>';
}
elseif($ar_size > 1000){
    $output .= '<b style="color:red">Not fetched. Characters > 1000</b>';
}
else{
    $output .= '<b style="color:green">Fetched. Characters are greater than 700 & less than 1000</b></b>';
}

//Image Fetch
$output .= '<h3>Image</h3>';
$img_f = $pic_1;
$output .= $img_f."<br/>";
$output .= '<img src="'.$img_f.'"/>';

//Tags Fetch
$output .= '<h3>Tags</h3>';
$tag =  $response00->find('div.submeta div.submeta__section-labels ul.submeta__links li');
if(isset($tag[0])){
    $tag1 = $tag[0]->plaintext;
}
else{
    $tag1 = "";
}
if(isset($tag[1])){
    $tag2 = $tag[1]->plaintext;
}
else{
    $tag2 = "";
}
if(isset($tag[2])){
    $tag3 = $tag[2]->plaintext;
}
else{
    $tag3 = "";
}
$output .= '<ol>';
foreach($tag as $tg){
    $output .= '<li>'.$tg->plaintext."</li><br/>";
}
$output .= '</ol>';
//Name of photographer fetch

//Category fetch
//$cat =  $content->find('.top-bredcr div.breadcrumbs ol li a span');
$p_cat = "війни";
$output .= '<b>News category</b> - '.$p_cat;

//Image URL Validation (Validates 1st Image fetched on homepage and last image fetched on the article page since 1 of the photos will bhe invalid)
if (!filter_var($pic_1, FILTER_VALIDATE_URL) === false) {
    $image = $pic_1;
   // $output .=("$pic_1 is a valid URL");
} elseif(!filter_var($img_f, FILTER_VALIDATE_URL) === false) {
    $image = $img_f;
   // $output .=("$img_f is a valid URL");
}
$output .= '<img src="'.$image.'"/>';
///////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////    INSERT DATA INTO THE DATABASE ///////////////////////////////////////////////
//generate code
//$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//$code=substr(str_shuffle($set), 0, 12);
//$code_auth = $response->find('div[itemprop=liveBlogUpdate]');
//$code = $code_auth[0]->id;
//$output .= $p_author." - <b>Author</b> <br/><br/>";

//Insertion process
$time = date("D, d M Y H:i:s");
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE code=:code");
$stmt->execute(['code'=>$code]);

$ct = $stmt->fetch();
if($ct['numrows'] < 1){
  // Download image, rename it and put it into folder
$url = $image;
$gen = time();
$filee = basename($url);
$ar_error = "";
$ext = pathinfo($filee, PATHINFO_EXTENSION);
$img = $gen.".jpg";
$path = '../images/'.$img; 
file_put_contents($path, file_get_contents($url));
$filename = $img; 
$parent = "theguardian.com"; 
//insert into database
  $stmt = $conn->prepare("INSERT INTO news (sub_1, sub_2, source_error, video_url, type, parent, source, deep_link, title, published, author, article, tag_1, tag_2, tag_3, photo, photo_url, p_grapher, category, time, code) VALUES (:sub_1, :sub_2, :source_error, :video_url, :type, :parent, :source, :deep_link, :title, :published, :author, :article, :tag_1, :tag_2, :tag_3, :photo, :photo_url, :p_grapher, :category, :time, :code)");
  $stmt->execute(['sub_1'=>$sub_1, 'sub_2'=>$sub_2, 'source_error'=>$ar_error, 'video_url'=>$video_f, 'type'=>$news_type, 'parent'=>$parent, 'source'=>"theguardian.com||ukraineWar", 'deep_link'=>$f_href, 'title'=>$title, 'published'=>$published, 'author'=>$p_author, 'article'=>$ar_full, 'tag_1'=>$tag1, 'tag_2'=>$tag2, 'tag_3'=>$tag3, 'photo'=>$filename, 'photo_url'=>$image, 'p_grapher'=>"None", 'category'=>"international", 'time'=>$time, 'code'=>$code]);
 $output .= '<h1>New Postage Successfully Added</h1>';
}
else{
 $stmt = $conn->prepare("SELECT * FROM news WHERE code=:code");
    $stmt->execute(['code'=>$code]);
    
    $ct_p = $stmt->fetch();
    
    $output .= '<h1>Article already posted. <a class="btn btn-warning" href="../article_data.php?id='.$ct_p['code'].'" target="_blank" >Preview</a></h1>';
}

echo $output;
