<?php
//header('Content-Type: text/html; charset=utf-8');

include 'includes/session.php';
require '../vendor/autoload.php';
$httpClient = new \simplehtmldom\HtmlWeb();
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////         HOME PAGE TRENDING            ///////////////////////////////
$link = 'https://www.theguardian.com/international';
$output = '';
//Title
$response = $httpClient->load($link);
$title = $response->find('div.fc-slice-wrapper ul.fc-slice--qqq-q li.l-row__item--span-3 div.fc-item div.fc-item__container div.fc-item__content div.fc-item__header h3.fc-item__title a.fc-item__link', 0)->plaintext . PHP_EOL . PHP_EOL;
$output .= $title."<br/>";
//Image
$img = $response->find('div.fc-slice-wrapper ul.fc-slice--qqq-q li.l-row__item--span-3 div.fc-item div.fc-item__container div.fc-item__media-wrapper div.fc-item__image-container picture img');
$pic_1 = $img[1]->src;
$output .= $pic_1.'<br/>';
//$output .= sizeof($img).' - size of image array <br/>';
//Link HREF
$href =  $response->find('div.fc-slice-wrapper ul.fc-slice--qqq-q li.l-row__item--span-3 div.fc-item div.fc-item__container div.fc-item__content div.fc-item__header h3.fc-item__title a.fc-item__link');
$f_href = $href[0]->href;
$output .= $f_href.'<br/>';


//////////////////////   DETAILS OF ARTICLE    /////////////////////////////
$output .= '<h2 style="text-align:center">Article details</h2>';
$h_link = $f_href;
$content = $httpClient->load($h_link);

//Date
$date =  $content->find('aside.dcr-1aul2ye div.dcr-krkkhw div.dcr-ss9mnu div.dcr-1eucl2a div.dcr-fj5ypv div details.dcr-km9fgb summary.dcr-12fpzem');
$published = $date[0]->plaintext;
$output .= $published."<br/>";

//Video Fetch
$output .= '<h3>Video</h3>';
$video_2 =  $content->find('div.dcr-185kcx9 iframe');
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
$subc = $content->find('aside.dcr-hfp9tp div.dcr-10jdkim div.dcr-1u8qly9 a.content__label__link span');
$sub_1 = $subc[0]->plaintext;
$output .= $sub_1." - <b>Sub Category</b> <br/><br/>";

//Author Fetch
$author = $content->find('aside.dcr-1aul2ye div.dcr-krkkhw div.dcr-ss9mnu div.dcr-1eucl2a div.dcr-fj5ypv div address div.dcr-1mp5s8u a[rel=author]');
$p_author = $author[0]->plaintext;
$output .= $p_author." - <b>Author</b> <br/><br/>";

//Article Content Fetch
$output .= '<h3>Article content</h3>';
$article =  $content->find('div.dcr-185kcx9 div.dcr-2rh10c div.dcr-j7ihvk div.article-body-commercial-selector');
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
$img_2 =  $content->find('div.dcr-1b267dg picture img.dcr-1989ovb');
$img_f = $img_2[0]->src;
$output .= $img_f."<br/>";
$output .= '<img src="'.$img_f.'"/>';

//Tags Fetch
$output .= '<h3>Tags</h3>';
$tag =  $content->find('div.dcr-185kcx9 div.dcr-2rh10c div.dcr-1k32900 div.dcr-lwa3gj li');
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
$p_cat = "international";
$output .= '<b>News category</b> - '.$p_cat;

//Image URL Validation (Validates 1st Image fetched on homepage and last image fetched on the article page since 1 of the photos will bhe invalid)

    $image = $img_f;

$output .= '<img src="'.$image.'"/>';
///////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////    INSERT DATA INTO THE DATABASE ///////////////////////////////////////////////
//generate code
$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$code='tg_'.substr(str_shuffle($set), 0, 12);


//Insertion process
$time = date("D, d M Y H:i:s");
$conn = $pdo->open();
$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE deep_link=:deep_link");
$stmt->execute(['deep_link'=>$h_link]);

$ct = $stmt->fetch();
if($ct['numrows'] < 1){
  // Download image, rename it and put it into folder
$url = $image;
$gen = time();
$filee = basename($url);
$ext = pathinfo($filee, PATHINFO_EXTENSION);
$img = $gen.".jpg";
$ar_error = "";
$path = '../images/'.$img; 
file_put_contents($path, file_get_contents($url));
$filename = $img; 
$parent = "theguardian.com"; 
//insert into database
  $stmt = $conn->prepare("INSERT INTO news (sub_1, sub_2, source_error, video_url, type, parent, source, deep_link, title, published, author, article, tag_1, tag_2, tag_3, photo, photo_url, p_grapher, category, time, code) VALUES (:sub_1, :sub_2, :source_error, :video_url, :type, :parent, :source, :deep_link, :title, :published, :author, :article, :tag_1, :tag_2, :tag_3, :photo, :photo_url, :p_grapher, :category, :time, :code)");
  $stmt->execute(['sub_1'=>$sub_1, 'sub_2'=>$sub_2, 'source_error'=>$ar_error, 'video_url'=>$video_f, 'type'=>$news_type, 'parent'=>$parent, 'source'=>"theguardian.com", 'deep_link'=>$f_href, 'title'=>$title, 'published'=>$published, 'author'=>$p_author, 'article'=>$ar_full, 'tag_1'=>$tag1, 'tag_2'=>$tag2, 'tag_3'=>$tag3, 'photo'=>$filename, 'photo_url'=>$image, 'p_grapher'=>"None", 'category'=>"international", 'time'=>$time, 'code'=>$code]);
 $output .= '<h1>New Postage Successfully Added</h1>';
}
else{
 $stmt = $conn->prepare("SELECT * FROM news WHERE deep_link=:deep_link");
    $stmt->execute(['deep_link'=>$h_link]);
    
    $ct_p = $stmt->fetch();
    
    $output .= '<h1>Article already posted. <a class="btn btn-warning" href="../article_data.php?id='.$ct_p['code'].'" target="_blank" >Preview</a></h1>';
}

echo $output;
