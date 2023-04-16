<?php
//header('Content-Type: text/html; charset=utf-8');

include 'includes/session.php';
require '../vendor/autoload.php';
$httpClient = new \simplehtmldom\HtmlWeb();
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////         HOME PAGE TRENDING            ///////////////////////////////
$link = 'https://www.unian.ua/detail/interviews';
$output = '';
//Title
$response = $httpClient->load($link);
$title = $response->find('div.author-round div.author-round__item div.author-round__info h3 a', 0)->plaintext . PHP_EOL . PHP_EOL;
$output .= $title."<br/>";
//Image
$img = $response->find('div.author-round div.author-round__item a.author-round__image img');
$pic_1 = $img[0]->{'data-src'};
$output .= $pic_1.'<br/>';
//$output .= sizeof($img).' - size of image array <br/>';
//Link HREF
$href =  $response->find('div.author-round div.author-round__item div.author-round__info h3 a');
$f_href = $href[0]->href;
$output .= $f_href.'<br/>';

//////////////////////   DETAILS OF ARTICLE    /////////////////////////////
$output .= '<h2 style="text-align:center">Article details</h2>';
$h_link = $f_href;
$content = $httpClient->load($h_link);
//////////////TEST
$json = $content->find('head script[type=application/ld+json]');

$js_1 = $json[0]->innertext;
$rtt = strval($js_1);
$datt = json_decode($rtt, TRUE);
//echo json_decode($rt, TRUE);
//$output .= $datt['datePublished']."<br/><br/>";
//$output .= $js_1."<br/><br/>";

//echo sizeof($json)." size of json<br/>";



/////////////////////////


//Date
$date =  $content->find('div.publication__info div.publication__info-item');
$published = $date[0]->plaintext;
$output .= $published."<br/>";
//Video Fetch
$output .= '<h3>Video</h3>';
$video_2 =  $content->find('div.publication div.publication-text iframe');
if(sizeof($video_2) == 0){
    $news_type = "interview";
    $video_f = "";
    $output .= $video_f."<br/>";
}
else{
    $news_type = "interview";
$video_f = $video_2[0]->src;
$output .= $video_f."<br/>";
$output .= '<iframe allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowfullscreen="true" frameborder="0" height="314" scrolling="no" src="'.$video_f.'" style="border:none;overflow:hidden" width="560"></iframe>';

}

$sub_2 = "";
//Subcategory Fetch
$sub_1 = "";
$output .= $sub_1." - <b>Sub Category</b> <br/><br/>";

//Author Fetch
$author = $content->find('div.publication div.publication__left-info div.publication__author a');
$p_author = $author[0]->plaintext;
$output .= $p_author." - <b>Author</b> <br/><br/>";

//Article Content Fetch
$output .= '<h3>Article content</h3>';
$article =  $content->find('div.publication div.publication-text');
$ar_1 = '';
foreach($article as $ar){
    $ar_1 .= body_scrap($ar);
}
//$ar_full = join($article);
$ar_full = $ar_1;
$ar_size = strlen($ar_full);
$output .= article_filter($ar_full);
$output .= article_size($ar_size);

//Image Fetch
$output .= '<h3>Image</h3>';
$img_2 =  $content->find('div.publication figure.publication__main-image img');
$img_f = $img_2[0]->src;
$output .= $img_f."<br/>";
$output .= '<img src='.$img_f.'/>';

//Tags Fetch
$output .= '<h3>Tags</h3>';
$tag =  $content->find('div.publication div.publication-text div.publication__tags a.publication__tag');
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
$p_cat = "[PREDEFINED]</b>";
$output .= '<b>News category</b> - '.$p_cat;

//Image URL Validation (Validates 1st Image fetched on homepage and last image fetched on the article page since 1 of the photos will bhe invalid)

$image = validate_img($pic_1, $img_f);
$output .= '<img src="'.$image.'"/>';
///////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////    INSERT DATA INTO THE DATABASE ///////////////////////////////////////////////
//generate code


//Insertion process
$ar_error = '';
if (counter($h_link) < 1) {
    // Download image, rename it and put it into folder
    //insert into database
    $db_item = [
        'sub_1' => $sub_1,
        'sub_2' => $sub_2,
        'source_error' => $ar_error,
        'video_url' => $video_f,
        'type' => $news_type,
        'parent' => "unian.ua",
        'source' => "Unian.ua/interviews",
        'deep_link' => $f_href,
        'title' => $title,
        'published' => $published,
        'author' => $p_author,
        'article' => $ar_full,
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
