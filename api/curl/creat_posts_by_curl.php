<?php
$ch = curl_init();
$headers = [
    "Accept: application/json",
    "Content-Type: application/json"
];
$payloads = json_encode([
    "title" => "computer",
    "body" => "more than 200",
    "author" => "ahmed",
    "category_id" => "2"
]);
curl_setopt_array($ch, [
    CURLOPT_URL => "http://localhost/restapi/api/create.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_POSTFIELDS => $payloads

]);
$response = curl_exec($ch);


// Handle any errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Decode the response
    print_r(json_decode($response, true));
}

curl_close($ch);
