<?php

$apiUrl = 'https://cleanuri.com/api/v1/shorten';
$longURL = readline("Please enter url you want to shorten: ");

$passLongURL = array('url' => $longURL);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($passLongURL));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if ($response === false) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    $result = json_decode($response);

    if (isset($result->result_url)) {
        $shortURL = $result->result_url;
        echo 'Shortened URL: ' . $shortURL;
    } else {
        echo 'Error: Short URL not found';
    }
}

curl_close($ch);
