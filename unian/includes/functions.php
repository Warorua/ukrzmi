<?php

use simplehtmldom\HtmlDocument;

$conn = $pdo->open();

function download_image($image)
{
    $url = $image;
    $gen = time();
    $filee = basename($url);
    $ext = pathinfo($filee, PATHINFO_EXTENSION);
    $img = $gen . "." . $ext;
    $path = '../images/' . $img;
    file_put_contents($path, file_get_contents($url));
    $filename = $img;
    return $filename;
}

function counter($h_link)
{
    global $pdo;
    $conn = $pdo->open();
    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE deep_link=:deep_link");
    $stmt->execute(['deep_link' => $h_link]);

    $ct = $stmt->fetch();

    return $ct['numrows'];
}

function code_gen()
{
    $set = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
    $code = substr(str_shuffle($set), 0, 18);

    return $code;
}

function validate_img($pic_1, $img_f)
{
    if (!filter_var($pic_1, FILTER_VALIDATE_URL) === false) {
        $image = $pic_1;
        // $output .=("$pic_1 is a valid URL");
    } elseif (!filter_var($img_f, FILTER_VALIDATE_URL) === false) {
        $image = $img_f;
        // $output .=("$img_f is a valid URL");
    }

    return $image;
}

function remove_text_after_string($string, $substring)
{
    $index = strpos($string, $substring);
    if ($index !== false) {
        $string = substr($string, 0, $index);
    }
    return $string;
}


function remove_text_after_sentence($string, $sentence)
{
    $index = strpos($string, $sentence);
    if ($index !== false) {
        $string = substr($string, 0, $index + strlen($sentence));
    }
    return $string;
}


function getElementClass($html, $element)
{
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_use_internal_errors(false);
    $xpath = new DOMXPath($dom);
    $class = '';

    // find the first matching element and get its class attribute
    $elements = $xpath->query("//{$element}");
    if ($elements->length > 0) {
        $class = $elements->item(0)->getAttribute('class');
    }

    return $class;
}

function getElementAttr($html, $element, $attribute)
{
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_use_internal_errors(false);
    $xpath = new DOMXPath($dom);
    $class = '';

    // find the first matching element and get its class attribute
    $elements = $xpath->query("//{$element}");
    if ($elements->length > 0) {
        $class = $elements->item(0)->getAttribute($attribute);
    }

    return $class;
}

function containsWord($string, $word)
{
    if ($string == $word) {
        return true;
    } else {
        if (strpos($string, $word) !== false) {
            return true;
        } else {
            return false;
        }
    }
}

function check_sentence_start($sentence, $start)
{
    $result = substr($sentence, 0, strlen($start)) === $start;
    return $result ? 'Yes' : 'No';
}


function body_scrap($ar)
{
    include_once('../pravda/inc/simple_html_dom.php');
    $output = '';
    $ar_001 = $ar->children();
    $output .= sizeof($ar_001) . " size of internal article<br/>";
    $ar_1 = '';
    foreach ($ar_001 as $ar_002) {
        //$ar_sb = str_get_html($ar_002);

        //$output .=  $ar_002;
        //$ar_1 .= $ar_002;
        ////////Particle-shares
        //[class!=read-also-slider__info][class!=read-also-slider__item]
        $p_a = $ar_002->find("[!href], p, h1, h3, h4, h5, h6, b, div[class!=owl-photo], strong, img[alt!=google], text");
        foreach ($p_a as $f) {
            $ar_tag = $f->tag;
            //$output .=  $ar_tag."<br/>";
            //$f->class=null;
            //$f->href=null;

            $class = getElementClass($f, 'div');
            $class_b = getElementClass($f, 'a');
            $class_c = GetElementAttr($f, 'img', 'src');
            if (
                containsWord($class, 'read-also-slider__title')  == FALSE &&
                containsWord($class, 'read-also-slider__carousel')  == FALSE &&
                containsWord($class, 'read-also-slider__item')  == FALSE &&
                containsWord($class, 'read-also-slider__link')  == FALSE &&
                containsWord($class, 'read-also-slider__info')  == FALSE &&
                containsWord($class, 'nts-video')  == FALSE &&
                containsWord($class, 'article__tags')  == FALSE &&
                containsWord($class, 'social-likes')  == FALSE &&
                containsWord($class, 'article-shares')  == FALSE &&
                containsWord($class, 'publication-bottom')  == FALSE &&
                containsWord($class, 'nts-video-wrapper') == FALSE &&
                containsWord($class, 'nts-video-label')  == FALSE &&
                containsWord($class_b, 'read-also-slider__link')  == FALSE &&
                containsWord($class_b, 'read-also-slider__image')  == FALSE &&
                containsWord($class, 'read-also-slider')  == FALSE &&
                //containsWord(getElementClass($f, 'figure'), 'photo_block')  == FALSE &&
                containsWord(getElementClass($f, 'span'), 'owl-photo__title')  == FALSE &&
                containsWord($class_b, 'read-also-slider__link') == FALSE
            ) {
                if (check_sentence_start($f, '<') == 'Yes') {
                    if (
                        check_sentence_start($f, '<a') == 'No' &&
                        check_sentence_start($f, '<path') == 'No' &&
                        check_sentence_start($f, '<rect') == 'No' &&
                        check_sentence_start($f, '<i') == 'No' &&
                        check_sentence_start($f, '<span>©') == 'No' &&
                        check_sentence_start($f, '<li><a') == 'No' &&
                        check_sentence_start($f, '<blockquote>') == 'No' &&
                        check_sentence_start($class_c, 'data:image/gif;') == 'No' &&
                        check_sentence_start($class_c, '/') == 'No' &&
                        check_sentence_start($class_c, '/') == 'No' &&
                        check_sentence_start($f, '<svg') == 'No'
                    ) {

                        $output .=  $f->outertext . "";
                        $ar_1 .=  $f->outertext . "<br/>";
                        // echo '|' . $class . '|<br/><br/><br/>';
                        // echo '|' . $class_b . '|<br/><br/><br/';
                    }
                }
            } else {
                //  echo 'REM|'.$class.'|<br/><br/><br/>';
                //  echo 'REM|'.$class_b.'|<br/><br/><br/';
            }
        }
        $ar_fil = str_get_html($ar_1);
        $ar_fil2 = $ar_fil->find('.owl-photo__item');
        $ar_fil3 = sizeof($ar_fil2);
        if ($ar_fil3 > 5) {
            $ar_error = 1;
        } else {
            $ar_error = "";
        }
    }

    return $ar_1;
}

function custom_scrap2($ar, $options)
{
    include_once('../pravda/inc/simple_html_dom.php');
    $html = new simple_html_dom();

    $ar = $html->load($ar);
    $p_a = $ar->find($options);
    foreach ($p_a as $f) {
        $ar_tag = $f->tag;
        //$output .=  $ar_tag."<br/>";
        //$f->class=null;
        //$f->href=null;
        $output .=  $f->outertext . "";
        $ar_1 .=  $f->outertext . "<br/>";
    }

    $ar_fil = str_get_html($ar_1);
    $ar_fil2 = $ar_fil->find('.owl-photo__item');
    $ar_fil3 = sizeof($ar_fil2);
    if ($ar_fil3 > 5) {
        $ar_error = 1;
    } else {
        $ar_error = "";
    }

    return $ar_1;
}

function removeEmptyHtmlElements($html)
{
    // Load HTML code into a new DOMDocument object
    $doc = new DOMDocument();
     // Disable warnings for invalid HTML code
     libxml_use_internal_errors(true);

     // Load the HTML code into the DOMDocument object
     $doc->loadHTML($html);
 
     // Restore error handling
     libxml_use_internal_errors(false);

    // Get all HTML elements
    $elements = $doc->getElementsByTagName('*');

    // Loop through each element
    foreach ($elements as $element) {
        // Check if the element has no content
        if (trim($element->textContent) == '') {
            // Remove the element
            $element->parentNode->removeChild($element);
        }
    }

    // Return the updated HTML code
    return $doc->saveHTML();
}


function printArray($arr, $level = 0)
{
    $fin = '';
    if (is_array($arr)) {
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $fin .= str_repeat('    ', $level);
                printArray($value, $level + 1);
            } else {
            }
        }
    } else {
        $fin .= str_repeat('    ', $level) . $arr;
    }


    return $fin;
}

function custom_scrap($ar, $options)
{
    $httpClient = new \simplehtmldom\HtmlWeb();
    $ar_1 = (new HtmlDocument())->load($ar)->find($options);

    $ar_1 = printArray($ar_1);

    return $ar_1;
}

function article_size($ar_size)
{
    $output = '';
    $output .= "<b>Size of this article is " . $ar_size . "</b><br/>";
    if ($ar_size < 700) {
        $output .= '<b style="color:red">Not fetched. Characters < 700</b>';
    } elseif ($ar_size > 1000) {
        $output .= '<b style="color:red">Not fetched. Characters > 1000</b>';
    } else {
        $output .= '<b style="color:green">Fetched. Characters are greater than 700 & less than 1000</b></b>';
    }

    return $output;
}

function db_insertion($db_item)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO news (sub_1, sub_2, source_error, video_url, type, parent, source, deep_link, title, published, author, article, tag_1, tag_2, tag_3, photo, photo_url, p_grapher, category, time, code) VALUES (:sub_1, :sub_2, :source_error, :video_url, :type, :parent, :source, :deep_link, :title, :published, :author, :article, :tag_1, :tag_2, :tag_3, :photo, :photo_url, :p_grapher, :category, :time, :code)");
    $stmt->execute($db_item);
    return '<h1>New Postage Successfully Added</h1>';
}

function db_insertion_err($h_link)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM news WHERE deep_link=:deep_link");
    $stmt->execute(['deep_link' => $h_link]);

    $ct_p = $stmt->fetch();

    return '<h1>Article already posted. <a class="btn btn-warning" href="../article_data.php?id=' . $ct_p['code'] . '" target="_blank" >Preview</a></h1>';
}

function filter_html_by_class($html, $class)
{
    // Get the encoding of the input HTML code
    $encoding = mb_detect_encoding($html);

    // Create a new DOMDocument object with the correct encoding
    $dom = new DOMDocument('1.0', $encoding);

    // Disable warnings for invalid HTML code
    libxml_use_internal_errors(true);

    // Load the HTML code into the DOMDocument object
    $dom->loadHTML($html);

    // Restore error handling
    libxml_use_internal_errors(false);

    // Create a new DOMXPath object to query the DOM
    $xpath = new DOMXPath($dom);

    // Find all elements that match the specified class
    $elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $class ')]");

    // Remove each element from its parent node
    foreach ($elements as $element) {
        $element->parentNode->removeChild($element);
    }

    // Return the filtered HTML code as a string
    return $dom->saveHTML();
}

function removeLinksInListItems($html) {
    // Load HTML code into a new DOMDocument object
    $doc = new DOMDocument();
    // Disable warnings for invalid HTML code
    libxml_use_internal_errors(true);

    // Load the HTML code into the DOMDocument object
    $doc->loadHTML($html);

    // Restore error handling
    libxml_use_internal_errors(false);
    // Get all <li> elements
    $listItems = $doc->getElementsByTagName('li');
  
    // Loop through each <li> element
    foreach ($listItems as $listItem) {
      // Get all <a> elements within the <li>
      $links = $listItem->getElementsByTagName('a');
  
      // Loop through each <a> element and remove it
      foreach ($links as $link) {
        $link->parentNode->removeChild($link);
      }
    }
  
    // Return the updated HTML code
    return $doc->saveHTML();
  }
  

function removeElementsByClass($html, $class)
{
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_use_internal_errors(false);
    $xpath = new DOMXPath($dom);
    $elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $class ')]");

    foreach ($elements as $element) {
        $element->parentNode->removeChild($element);
    }

    return $dom->saveHTML();
}


function article_filter($ar_full)
{
    // $httpClient = new \simplehtmldom\HtmlWeb();
    // $f_href = (new HtmlDocument())->load($ar_full)->find('input[name="_csrf_token"]', 0)->value . PHP_EOL;
    //$text = remove_text_after_string($ar_full, "jumps");

    //$ar_full = filter_html_by_class($ar_full, "read-also-slider__title");
    //$ar_full = filter_html_by_class($ar_full, "read-also-slider__carousel");
    //$ar_full = filter_html_by_class($ar_full, "read-also-slider__item");
    //$ar_full = filter_html_by_class($ar_full, "read-also-slider__link");

    //$ar_full = removeElementsByClass($ar_full, "read-also-slider__title");

    //$ar_full = custom_scrap($ar_full, "[class!=read-also-slider__item]");

    $ar_full = remove_text_after_sentence($ar_full, "<h2>Вас також можуть зацікавити новини:");
    $ar_full = str_replace("<h2>Вас також можуть зацікавити новини:", "", $ar_full);
    $ar_full = str_replace("Відео дня", "", $ar_full);
    $ar_full = str_replace('<svg xmlns', '<svgxmlns', $ar_full);
    $ar_full = str_replace("Вас также могут заинтересовать новости:", "", $ar_full);
    $ar_full = removeLinksInListItems('<?xml encoding="UTF-8">' . $ar_full);
    $ar_full = removeEmptyHtmlElements('<?xml encoding="UTF-8">' . $ar_full);

    return $ar_full;
}
