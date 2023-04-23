<?php

require '../vendor/autoload.php';
$httpClient = new \simplehtmldom\HtmlWeb();
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
///////////////         HOME PAGE TRENDING            ///////////////////////////////
include 'includes/session.php';
$link = 'https://ua.korrespondent.net/';
$output = '';
//Title
$response = $httpClient->load($link);
$title = $response->find('.clone-content div.article_main div.royalSlider div.article div.article__title a', 0)->plaintext . PHP_EOL . PHP_EOL;
$output .= $title . "<br/>";

//Image
$img = $response->find('.clone-content div.article_main div.royalSlider div.article a.article__img-link img');
$pic_1 = $img[0]->src;
$output .= $pic_1 . '<br/>';
//$output .= sizeof($img).' - size of image array <br/>';

//Link HREF
$href =  $response->find('.clone-content div.article_main div.royalSlider div.article a.article__img-link');
$f_href = $href[0]->href;
$output .= $f_href . '<br/>';

//Date
$date =  $response->find('.clone-content div.article_main div.royalSlider div.article div.article__text span.article__time');
$published = $date[0]->plaintext;
$output .= $published . "<br/>";

//////////////////////   DETAILS OF ARTICLE    /////////////////////////////
$output .= '<h2 style="text-align:center">Article details</h2>';
$h_link = $f_href;
$content = $httpClient->load($h_link);
//Author Fetch
$p_author = fetch_author($content);
$output .= $p_author . " - <b>Author</b> <br/><br/>";

//Article Content Fetch
$output .= '<h3>Article content</h3>';

$article_p = $content->find('.col__big div.post-item div.post-item__text p');
$output .= sizeof($article_p) . " - <b>Size of P array</b><br/>";

$article_div = $content->find('.col__big div.post-item div.post-item__text div');
$output .= sizeof($article_div) . " - <b>Size of DIV array</b><br/>";


$ar_1 = article_scrape($article_p, $article_div, $content);
$output .= $ar_1[0] . "<br/>";

//$ar_full = join($article[1]);
$ar_full = $ar_1[0];
$ar_size = strlen($ar_full);
$output .= "<b>Size of this article is " . $ar_size . " and has " . $ar_arr . " array items</b><br/>";
$output .= "Last item that will be removed: <b>" . $article[$ar_arr - 1]->plaintext . "</b><br/>";

$output .= article_size($ar_size);

//Image Fetch
$output .= '<h3>Image</h3>';
$img_2 =  $content->find('.col__big div.post-item div.post-item__photo img');
$img_f = $img_2[0]->src;
$output .= $img_f . "<br/>";
$output .= '<img src=' . $img_f . '/>';

//Tags Fetch
$output .= '<h3>Tags</h3>';
$tag =  $content->find('.col__big div.post-item div.post-item__tags div.post-item__tags-item a');

for ($io = 0; $io <= 2; $io++) {
    if (isset($tag[$io])) {
        $tag1 = $tag[$io]->plaintext;
    } else {
        $tag1 = "";
    }
}

$output .= '<ol>';
foreach ($tag as $tg) {
    $output .= '<li>' . $tg->plaintext . "</li><br/>";
}
$output .= '</ol>';

//Name of photographer fetch
$output .= '<h3>Photographer</h3>';
$p_graph =  $content->find('.col__big div.post-item div.post-item__photo div.post-item__photo-about div.post-item__photo-author');


$photographer = photographer($p_graph);


$output .= '<b>Photographer</b> - ' . $photographer . '</br>';
//Category fetch
$cat =  $content->find('.header-menu div.header ul.nav li.nav__item a.nav__link_active');
$p_cat = $cat[0]->plaintext;
$output .= '<b>News category</b> - ' . $p_cat;

$image = $img_f;
$output .= '<img src="' . $image . '"/>';

///////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////    INSERT DATA INTO THE DATABASE ///////////////////////////////////////////////
//generate code

//Insertion process

if (data_insertion_verifier($h_link) < 1) {
    // Download image, rename it and put it into folder
    //insert into database
    $insertion = [
        'sub_1' => "",
        'sub_2' => "",
        'source_error' => "",
        'parent' => "ua.korrespondent.net",
        'source' => "ua.korrespondent.net",
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
        'p_grapher' => $photographer,
        'category' => $p_cat,
        'time' => date("D, d M Y H:i:s"),
        'code' => generate_code()
    ];
    $output .= insert_data($insertion);
} else {

    $output .= insert_data_error($h_link);
}

echo $output;
