<?php

$curl = curl_init();
$agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36';

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.eurointegration.com.ua/news/2023/05/20/7162093/',
  CURLOPT_USERAGENT => $agent,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HEADER => true, // Include response headers
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_COOKIE => 'cbtYmTName=bRZPBAlPV09aWFkJDglbWwsIWwkMW1hVTxAn', // Add the cookie to the request header
  CURLOPT_HTTPHEADER=>array(
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
    'Accept-Language: en-US,en;q=0.5',
    'Accept-Encoding: gzip, deflate',
    'Connection: keep-alive',
    'Upgrade-Insecure-Requests: 1',
    'sec-ch-ua: "Google Chrome";v="113", "Chromium";v="113", "Not-A.Brand";v="24"'
),
));


$response = curl_exec($curl);

curl_close($curl);

// Extract encoding from the response headers
$encoding = '';
$headers = explode("\r\n", $response);
foreach ($headers as $header) {
    if (stripos($header, 'Content-Type:') === 0) {
        if (preg_match('/charset=([^\s]+)/i', $header, $matches)) {
            $encoding = $matches[1];
            break;
        }
    }
}

// Set a default encoding if no encoding is detected
if (empty($encoding)) {
    $encoding = 'UTF-8'; // Replace with the appropriate default encoding if known
}

// Convert the response to the detected or default encoding
$decodedResponse = mb_convert_encoding($response, 'UTF-8', $encoding);

// Display the response
echo $decodedResponse;



//$response = $decd;

//echo $response;
