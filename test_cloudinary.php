<?php
$cloudName = 'dkfmuzqhk';
$apiKey = '687661971761944';
$apiSecret = 'jtxp4BeeJ2vpB3onR_PEa6qIn_4';

$timestamp = time();
$signature = sha1("timestamp={$timestamp}{$apiSecret}");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'file' => new CURLFile('test.jpg'),
    'api_key' => $apiKey,
    'timestamp' => $timestamp,
    'signature' => $signature,
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
