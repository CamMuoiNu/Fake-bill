<?php
if (isset($_POST['action']) && $_POST['action'] === 'fakebill-momo') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $kieupin = $_POST["kieupin"];
    $dynamicsIsland = isset($_POST['dynamicsIsland']) ? $_POST['dynamicsIsland'] : '';
    $Pin = isset($_POST['pin']) ? $_POST['pin'] : '';
    if ($kieupin === 'off') {
        $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/phoi-bank/momo-chuyentien-pinoff.png';
    } else {
        $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/phoi-bank/momo-chuyentien-pinon.png';
    }
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
    $iconDynamicsIsland = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/dynamics.png';
    $image = imagecreatefrompng($phoiBank);
    $iconPins = [
        'pin-yeu' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/light/pin-yeu.png',
        '30' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/light/30.png',
        '50' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/light/50.png',
        '60' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/light/60.png',
        '80' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/light/80.png',
        '90' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/light/90.png',
        '100' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/light/100.png',
    ];
    if ((new SessionExpiredChecker())->check($taikhoan, $user)) {
        exit(json_encode(["error" => "Vui lòng đăng nhập để sử dụng dịch vụ!"]));
    }
    if ($user['rank'] !== 'admin' && $user['rank'] !== 'leader') {
        if (!in_array($plans->TD('tengoi', $taikhoan), ['vip1', 'vip2', 'vip3'])) {
            $image = imagecreatefrompng($phoiBank);
            $image = Watermark::Render($image, 2,30,400);
        }
    }
        function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
        {
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $x = ($customX === null) ? ($imageWidth - $textWidth - 85) : $customX;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
        function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text)
        {
            $fontSize = (int)$fontsize; 
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $x = (int)(($imageWidth - $textWidth) / 2); 
            $y = (int)$y;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
        
        function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
        {
            $fontSize = (int)$fontsize;
            $x = (int)$x_tcb; 
            $y = (int)$y;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
        function drawDynamicsIsland($image, $iconDynamicsIslandPath)
        {
            $iconDynamicsIsland = imagecreatefrompng($iconDynamicsIslandPath);
            $newIconWidth = 385;
            $newIconHeight = 145;
            $iconWidth = imagesx($iconDynamicsIsland);
            $iconHeight = imagesy($iconDynamicsIsland);
            $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $iconDynamicsIsland, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);
            $imageWidth = imagesx($image);
            $x = ($imageWidth - $newIconWidth) / 2;
            $y = 12;
            imagecopy($image, $resizedIcon, (int)$x, (int)$y, 0, 0, (int)$newIconWidth, (int)$newIconHeight);
            imagedestroy($iconDynamicsIsland);
            imagedestroy($resizedIcon);
        }
        function drawPin($image, $iconPinPath)
        {
            $iconPin = imagecreatefrompng($iconPinPath);
            $newIconWidth = 73;
            $newIconHeight = 33;
            $iconWidth = imagesx($iconPin);
            $iconHeight = imagesy($iconPin);
            $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $iconPin, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);

            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);
            $x = $imageWidth - $newIconWidth - 78;
            $y = 54;

            imagecopy($image, $resizedIcon, $x, $y, 0, 0, $newIconWidth, $newIconHeight);

            imagedestroy($iconPin);
            imagedestroy($resizedIcon);
        }

        function canchinhphai_noidung($image, $fontSize, $y, $textColor, $font, $text, $lineHeight = 1.2)
        {
            $lines = explode("\n", $text);
            $imageWidth = imagesx($image);

            for ($index = 0; $index < min(2, count($lines)); $index++) {
                $line = $lines[$index];
                $textBoundingBox = imagettfbbox($fontSize, 0, $font, $line);
                $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
                $x = $imageWidth - $textWidth - 85;

                imagettftext($image, (int)$fontSize, 0, (int)$x, (int)($y + ($index * $fontSize * $lineHeight)), $textColor, $font, $line);
            }
        }
        if ($kieupin === 'on' && !empty($Pin) && isset($iconPins[$Pin])) {
            drawPin($image, $iconPins[$Pin]);
        }
        if ($dynamicsIsland === 'on') {
            drawDynamicsIsland($image, $iconDynamicsIsland);
            $thoigiancanle = 140;
        } else {
            $thoigiancanle = 88;
        }
        canchinhphai($image, 35, 1363, imagecolorallocate($image, 71,71,71), $fontPath . '/common/San Francisco/SanFranciscoText-Bold.otf', $tennguoinhan);
        canletrai($image, 50, 467, imagecolorallocate($image, 50,50,50), $fontPath . '/common/San Francisco/SanFranciscoText-Bold.otf', '-'.FormatNumber::TD($sotienchuyen).'đ',292);
        canchinhphai($image, 35, 725, imagecolorallocate($image, 53,53,53), $fontPath . '/common/San Francisco/SanFranciscoText-Semibold.otf', $thoigianchuyen);
        canchinhphai($image, 35, 1575, imagecolorallocate($image, 53,53,53), $fontPath . '/common/San Francisco/SanFranciscoText-Semibold.otf', $stk);
        canletrai($image, 35, 80, imagecolorallocate($image, 243,223,236), $fontPath . '/common/San Francisco/SanFranciscoText-Bold.otf', $thoigiantrendt, $thoigiancanle);
        canchinhphai($image, 35, 871, imagecolorallocate($image, 53,53,53), $fontPath . '/common/San Francisco/SanFranciscoText-Semibold.otf', $magiaodich,845);
        canletrai($image, 30, 1875, imagecolorallocate($image, 53,53,53), $fontPath . '/common/San Francisco/SanFranciscoText-Semibold.otf', $noidungchuyen,90);
        ob_start();
        imagejpeg($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        echo json_encode(["success" => true, "message" => "Tạo bill thành công!", "image" => $base64]);
        imagedestroy($image);
}