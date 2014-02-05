<?php

/**
 * Update these with your values.
 */
$dozukiDomain = "example.dozuki.com";
$appId = 'example';
$postBody = [
   'email' => 'email@example.com',
   'password' => 'password'
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://$dozukiDomain/api/2.0/user/token");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postBody));
curl_setopt($curl, CURLOPT_HTTPHEADER, ["X-App-Id: $appId"]);

$response = json_decode(curl_exec($curl), true);

if (!isset($response['authToken'])) {
   var_dump($response);
   exit(1);
}

// Here is the auth token.
$authToken = $response['authToken'];

// Use the auth token to retrieve the user's images.
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://$dozukiDomain/api/2.0/user/media/images");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: api $authToken"]);

$response = json_decode(curl_exec($curl), true);

var_dump($response);
