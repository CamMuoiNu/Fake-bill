<?php
function callSimSimiAPI($text, $lc, $key) {
    $url = 'https://api.simsimi.vn/v1/simtalk';
    $data = http_build_query(array(
        'text' => $text,
        'lc' => $lc,
        'key' => $key
    ));

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/x-www-form-urlencoded'
    ));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    curl_close($ch);

    return $response;
}

$text = 'chào bạn là ai';
$lc = 'en';
$key = '';  // Thay thế bằng khóa API của bạn

$response = callSimSimiAPI($text, $lc, $key);
echo $response;
?>
