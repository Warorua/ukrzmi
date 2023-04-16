<?php
//header('Content-Type: text/html; charset=utf-8');

include 'includes/session.php';
require '../vendor/autoload.php';
$httpClient = new \simplehtmldom\HtmlWeb();
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////         HOME PAGE TRENDING            ///////////////////////////////
$link = 'https://www.unian.ua/kyiv';
$output = '';
//Title
$response = $httpClient->load($link);
$title = $response->find('.main-unit div.main-unit__info h3 a.main-unit__title', 0)->plaintext . PHP_EOL . PHP_EOL;
$output .= $title."<br/>";
//Image
$img = $response->find('.content-column div.main-unit a img');
$pic_1 = $img[0]->src;
$output .= $pic_1.'<br/>';
//$output .= sizeof($img).' - size of image array <br/>';
//Link HREF
$href =  $response->find('.content-column div.main-unit div.main-unit__info h3 a[href]');
$f_href = $href[0]->href;
$output .= $f_href.'<br/>';
//Date
$date =  $response->find('.content-column div.main-unit div.main-unit__bottom div.main-unit__time');
$published = $date[0]->plaintext;
$output .= $published."<br/>";
//////////////////////   DETAILS OF ARTICLE    /////////////////////////////
$output .= '<h2 style="text-align:center">Article details</h2>';
$h_link = $f_href;
$content = $httpClient->load($h_link);
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
$subc = $content->find('.article div.top-bredcr div.breadcrumbs ol li a span');
$sub_1 = $subc[1]->plaintext;
$output .= $sub_1." - <b>Sub Category</b> <br/><br/>";

//Author Fetch
$author = $content->find('.article__info p.article__author--bottom a.article__author-name');
$p_author = $author[0]->plaintext;
$output .= $p_author." - <b>Author</b> <br/><br/>";
//Article Content Fetch
$output .= '<h3>Article content</h3>';
$article =  $content->find('.article-text');
$ar_1 = '';
foreach($article as $ar){
    $ar_1 .= body_scrap($ar);
}
//$ar_full = join($article);
$ar_full = $ar_1;
$ar_size = strlen($ar_full);
$filtered_article = article_filter($ar_full);
$output .= $filtered_article;
$output .= article_size($ar_size);

//Image Fetch
$output .= '<h3>Image</h3>';
$img_2 =  $content->find('.article-text img');
$img_f = $img_2[0]->src;
$output .= $img_f."<br/>";
$output .= '<img src='.$img_f.'/>';
//Tags Fetch
$output .= '<h3>Tags</h3>';
$tag =  $content->find('.article__tags a.article__tag');
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
$cat =  $content->find('.top-bredcr div.breadcrumbs ol li a span');
$p_cat = $cat[1]->plaintext;
$output .= '<b>News category</b> - '.$p_cat;

//Image URL Validation (Validates 1st Image fetched on homepage and last image fetched on the article page since 1 of the photos will bhe invalid)

$image = validate_img($pic_1, $img_f);
$output .= '<img src="'.$image.'"/>';

//$output .= '<h1>'.$ar_fil3.' carousel items</h1>';
///////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////    INSERT DATA INTO THE DATABASE ///////////////////////////////////////////////


//Insertion process

if (counter($h_link) < 1) {
    // Download image, rename it and put it into folder
    //insert into database
    $db_item = [
        'sub_1' => $sub_1,
        'sub_2' => $sub_2,
        'source_error' => "",
        'video_url' => $video_f,
        'type' => $news_type,
        'parent' => "unian.ua",
        'source' => "Unian.ua/kyiv",
        'deep_link' => $f_href,
        'title' => $title,
        'published' => $published,
        'author' => $p_author,
        'article' => $filtered_article,
        'tag_1' => $tag1,
        'tag_2' => $tag2,
        'tag_3' => $tag3,
        'photo' => download_image($image),
        'photo_url' => $image,
        'p_grapher' => "None",
        'category' => $p_cat,
        'time' => date("D, d M Y H:i:s"),
        'code' => code_gen()
    ];

    $output .= db_insertion($db_item);
} else {
   
    $output .= db_insertion_err($h_link);
}
echo $output;
