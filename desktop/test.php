<?php
/*
require_once realpath(__DIR__.'/vendor/autoload.php');

// Looing for .env at the root directory
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrive env variable
$userName = $_ENV['dbname'];
define('DBNAME',$_ENV['dbname']);
//const HOST = $_ENV['host'];
//const USERNAME = $_ENV['username'];
//const PASSWORD = $_ENV['password'];

//echo $userName; //jfBiswajit

$dt1 = file_get_contents(__DIR__.'/env.json');
$dt2 = json_decode($dt1, true);

echo $dt2['host'];
*/
function envFile(){
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
        $dir = 'https://localhost/ukrzmi/env.json';
    } else {
        $dir = 'https://ukrzmi.com/env.json';
    }

   // $dt1 = file_exists()
}

//echo json_encode($_SERVER);

//echo getenv('dbname');
//echo apache_getenv('dbname');
//echo __DIR__;

echo $_SERVER['USER_PASSWORD'];