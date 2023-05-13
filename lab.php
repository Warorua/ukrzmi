<?php
//include './includes/core.php';

function build_file($file, $data)
{

    $file_data = fopen($file, "w");

    fwrite($file_data, $data);

    fclose($file_data);
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
