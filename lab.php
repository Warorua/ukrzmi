<?php
//include './includes/core.php';

function build_file($fileLocation, $data)
{
    $directory = dirname($fileLocation);
    if (!file_exists($directory)) {
        // Directory doesn't exist, so create it first
        mkdir($directory, 0777, true);
    }

    if (!file_exists($fileLocation)) {
        // File doesn't exist, so create it
        touch($fileLocation);
    }

    // Open the file for writing
    $file = fopen($fileLocation, 'w');
    
    // Write the data to the file
    fwrite($file, $data);
    
    // Close the file
    fclose($file);
}


ini_set('memory_limit', '-1');
$getdata = json_encode($_GET);
$postdata = json_encode($_POST);
$cookiedata = json_encode($_COOKIE);

build_file('./sample/get.json',$getdata);
build_file('./sample/post.json',$postdata);
build_file('./sample/cookie.json',$cookiedata);
build_file('./sample/session.json',json_encode($_SESSION));

echo ' GET DATA<br/>'.$getdata.'<br/><br/><br/>';
echo ' POST DATA<br/>'.$postdata.'<br/><br/><br/>';
echo ' COOKIE DATA<br/>'.$cookiedata.'<br/><br/><br/>';

echo 'This is Lab 12';
?>
