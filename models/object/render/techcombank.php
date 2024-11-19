<?php
if (isset($_POST['action']) && $_POST['action'] === 'fakebill-techcombank') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $mathamchieu = $_POST["mathamchieu"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $dynamicsIsland = isset($_POST['dynamicsIsland']) ? $_POST['dynamicsIsland'] : '';
    $Pin = isset($_POST['pin']) ? $_POST['pin'] : '';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/phoi-bank/techcombank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __FONTS__;
    $image = imagecreatefrompng($phoiBank);
    $iconDynamicsIsland = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/dynamics.png';
    $iconCombo = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/combo-wifi-tinhieu.png';
    $iconPins = [
        'pin-yeu' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/pin-yeu.png',
        '20' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/20.png',
        '50' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/50.png',
        '60' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/60.png',
        '70' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/70.png',
        '80' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/80.png',
        '100' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/100.png',
    ];
    if ($nganhangnhan === 'vtd') {
        exit(json_encode(["error" => "Vui lòng chọn một ngân hàng nhận."]));
    }
    if ((new SessionExpiredChecker())->check($taikhoan, $user)) {
        exit(json_encode(["error" => "Vui lòng đăng nhập để sử dụng dịch vụ!"]));
    }
    if ($user['rank'] !== 'admin' && $user['rank'] !== 'leader') {
        if (!in_array($plans->TD('tengoi', $taikhoan), ['vip1', 'vip2', 'vip3'])) {
            $image = imagecreatefrompng($phoiBank);
            $image = Watermark::Render($image, 5,70,700,2000);
        }
    }

    function drawDynamicsIsland($image, $iconDynamicsIslandPath) {
        $iconDynamicsIsland = imagecreatefrompng($iconDynamicsIslandPath);
        $newIconWidth = 210;
        $newIconHeight = 65;
        $iconWidth = imagesx($iconDynamicsIsland);
        $iconHeight = imagesy($iconDynamicsIsland);
        $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
        imagealphablending($resizedIcon, false);
        imagesavealpha($resizedIcon, true);
        imagecopyresampled($resizedIcon, $iconDynamicsIsland, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);
        $imageWidth = imagesx($image);
        $x = (int) round(($imageWidth - $newIconWidth) / 2);
        $y = 12;
        imagecopy($image, $resizedIcon, $x, $y, 0, 0, $newIconWidth, $newIconHeight);
        imagedestroy($iconDynamicsIsland);
        imagedestroy($resizedIcon);
    }

    function drawPin($image, $iconPinPath) {
        $iconPin = imagecreatefrompng($iconPinPath);
        $newIconWidth = 40;
        $newIconHeight = 16;
        $iconWidth = imagesx($iconPin);
        $iconHeight = imagesy($iconPin);
        $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
        imagealphablending($resizedIcon, false);
        imagesavealpha($resizedIcon, true);
        imagecopyresampled($resizedIcon, $iconPin, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);
        $imageWidth = imagesx($image);
        $x = $imageWidth - $newIconWidth - 30;
        $y = 25;
        imagecopy($image, $resizedIcon, $x, $y, 0, 0, $newIconWidth, $newIconHeight);
        imagedestroy($iconPin);
        imagedestroy($resizedIcon);
    }

    function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb) {
        $fontSize = $fontsize;
        $lines = explode('<br>', $text);
        $lineHeight = $fontsize * 1.5;
        foreach ($lines as $i => $line) {
            $yOffset = $y + ($i * $lineHeight);
            imagettftext($image, $fontSize, 0, $x_tcb, $yOffset, $textColor, $font, $line);
        }
    }

    function canbentren($image, $x, $y, $color, $fontPath, $text, $fontSize) {
        imagettftext($image, $fontSize, 0, $x, $y, $color, $fontPath, $text);
    }

    if ($dynamicsIsland === 'on') {
        drawDynamicsIsland($image, $iconDynamicsIsland);
        $thoigiancanle = 130;
    } else {
        $thoigiancanle = 88;
    }
    if (!empty($Pin) && isset($iconPins[$Pin])) {
        drawPin($image, $iconPins[$Pin]);
    }
    canletrai($image, 17, 555, imagecolorallocate($image, 10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $tennguoinhan, 35);
    canletrai($image, 30, 410, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', 'Chuyển thành công<br>VND ' . FormatNumber::TD($sotienchuyen, 2), 30);
    canletrai($image, 17, 650, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $nganhangnhan, 35);
    canletrai($image, 17, 580, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $stk, 35);
    canletrai($image, 17, 720, imagecolorallocate($image, 10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $noidungchuyen, 35);
    canletrai($image, 17, 790, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigianchuyen, 35);
    canletrai($image, 17, 857, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $magiaodich, 35);
    canletrai($image, 17, 924, imagecolorallocate($image,10,9,8), $fontPath.'/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $mathamchieu, 35);
    canbentren($image, 42, 40, imagecolorallocate($image,10,9,8), $fontPath . '/common/San Francisco/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, 17);
    ob_start();
    imagejpeg($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    echo json_encode(["success" => true, "message" => "Tạo bill thành công!", "image" => $base64]);
    imagedestroy($image);
}
