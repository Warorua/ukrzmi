<?php
$conn = $pdo->open();
function generate_code()
{
    $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = 'korr_' . substr(str_shuffle($set), 0, 20);
    return $code;
}

function download_image($image)
{
    $url = $image;
    $gen = 'korr' . time().str_replace('korr_','',generate_code());
    $filee = basename($url);
    $ext = pathinfo($filee, PATHINFO_EXTENSION);
    $img = $gen . "." . $ext;
    $path = '../images/' . $img;
    file_put_contents($path, file_get_contents($url));
    $filename = $img;
    return $filename;
}

function insert_data($insertion)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO news (sub_1, sub_2, source_error, parent, source, deep_link, title, published, author, article, tag_1, tag_2, tag_3, photo, photo_url, p_grapher, category, time, code) VALUES (:sub_1, :sub_2, :source_error, :parent, :source, :deep_link, :title, :published, :author, :article, :tag_1, :tag_2, :tag_3, :photo, :photo_url, :p_grapher, :category, :time, :code)");
    $stmt->execute($insertion);
    return '<h1>New Postage Successfully Added</h1>';
}

function insert_data_error($h_link)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM news WHERE deep_link=:deep_link");
    $stmt->execute(['deep_link' => $h_link]);

    $ct_p = $stmt->fetch();

    return '<h1>Article already posted. <a class="btn btn-warning" href="../article_data.php?id=' . $ct_p['code'] . '" target="_blank" >Preview</a></h1>';
}

function data_insertion_verifier($h_link)
{
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM news WHERE deep_link=:deep_link");
    $stmt->execute(['deep_link' => $h_link]);
    $ct = $stmt->fetch();
    return $ct['numrows'];
}

function photographer($p_graph)
{
    if (sizeof($p_graph) == 0) {
        $photographer = "None";
    } else {
        $f_graph = $p_graph[0]->plaintext;
        $photographer = str_replace("Фото:", " ", $f_graph);
    }

    return $photographer;
}

function article_size($ar_size)
{
    if ($ar_size < 700) {
        return '<b style="color:red">Not fetched. Characters < 700</b>';
    } elseif ($ar_size > 1000) {
        return '<b style="color:red">Not fetched. Characters > 1000</b>';
    } else {
        return  '<b style="color:green">Fetched. Characters are greater than 700 & less than 1000</b></b>';
    }
}

function article_scrape($article_p, $article_div, $content)
{

    $s_article_p = sizeof($article_p);
    $s_article_div = sizeof($article_div);

    if ($s_article_p > $s_article_div) {
        $article = $content->find('.col__big div.post-item div.post-item__text p[!class]');
    } elseif ($s_article_div > $s_article_p) {
        $article = $content->find('.col__big div.post-item div.post-item__text div[!class]');
    }

    $ar_0 = '';
    $ar_arr = sizeof($article);
    foreach ($article as $ar => $ar_sz) {
        //$output .= $ar->plaintext."<br/>";
        if ($ar != ($ar_arr - 1)) {
            $ar_0 .= $ar_sz->outertext . "<br/>";
        } else {
            break;
        }
    }

    return [$ar_0, $article];
}

function fetch_author($content)
{
    $author = $content->find('.col__big div.post-item div.post-item__info a.article__author');
    $p_author = $author[0]->plaintext;
    return $p_author;
}

function displayWebPage($url)
{
    // Set custom headers
    $options = [
        'http' => [
            'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36\r\n"
        ]
    ];

    // Create a stream context with custom headers
    $context = stream_context_create($options);

    // Get the HTML content of the web page with custom headers
    $content = file_get_contents($url, false, $context);

    if ($content === false) {
        return false; // Return false if unable to fetch contents from URL
    }

    // Print the content to display it on the screen
    echo $content;
    return true; // Return true on successful display
}

function httpPost($url, $data, $headers = null, $cookie_jar = null)
{
    try {
        $ch = curl_init($url);
        if ($ch === false) {
            throw new Exception('failed to initialize');
        }
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($headers != null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }
    } catch (Exception $e) {

        trigger_error(
            sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(),
                $e->getMessage()
            ),
            E_USER_ERROR
        );
    } finally {
        // Close curl handle unless it failed to initialize
        if (is_resource($ch)) {
            curl_close($ch);
        }
    }

    return $response;
}

function httpGet($url, $data, $headers = null, $cookies = null, $cookie_jar = null)
{
    try {
        $ch = curl_init($url);
        if ($ch === false) {
            throw new Exception('failed to initialize');
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
        // curl_setopt($ch, CURLOPT_COOKIE, $cookies);
        if ($headers != null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }
    } catch (Exception $e) {

        trigger_error(
            sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(),
                $e->getMessage()
            ),
            E_USER_ERROR
        );
    } finally {
        // Close curl handle unless it failed to initialize
        if (is_resource($ch)) {
            curl_close($ch);
        }
    }

    return $response;
}
