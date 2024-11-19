<?php
if (isset($_POST['action']) && $_POST['action'] === 'fakebill-msb') {
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $dynamicsIsland = isset($_POST['dynamicsIsland']) ? $_POST['dynamicsIsland'] : '';
    $Pin = isset($_POST['pin']) ? $_POST['pin'] : '';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/msb.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
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
    $image = imagecreatefrompng($phoiBank);
    if ((new SessionExpiredChecker())->check($taikhoan, $user)) {
        exit(json_encode(["error" => "Vui lòng đăng nhập để sử dụng dịch vụ!"]));
    }
    if ($user['rank'] !== 'admin' && $user['rank'] !== 'leader') {
        if (!in_array($plans->TD('tengoi', $taikhoan), ['vip1', 'vip2', 'vip3'])) {
            $image = imagecreatefrompng($phoiBank);
            $image = Watermark::Render($image, 0.7);
        }
    }
        function canchinhphai($image, $fontsize, $y, $textColor, $font, $text, $customX = null)
        {
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $x = ($customX === null) ? ($imageWidth - $textWidth - 96) : $customX;
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
            $newIconWidth = 330;
            $newIconHeight = 121;
            $iconWidth = imagesx($iconDynamicsIsland);
            $iconHeight = imagesy($iconDynamicsIsland);
            $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $iconDynamicsIsland, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);
            $imageWidth = imagesx($image);
            $x = round(($imageWidth - $newIconWidth) / 2);
            $y = 12; 
            imagecopy($image, $resizedIcon, $x, $y, 0, 0, $newIconWidth, $newIconHeight);
            imagedestroy($iconDynamicsIsland);
            imagedestroy($resizedIcon);
        }
        
        function drawPin($image, $iconPinPath)
        {
            $iconPin = imagecreatefrompng($iconPinPath);
            $newIconWidth = 70;
            $newIconHeight = 30;
            $iconWidth = imagesx($iconPin);
            $iconHeight = imagesy($iconPin);
            $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $iconPin, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);

            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);
            $x = $imageWidth - $newIconWidth - 50;
            $y = 55;

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
        if ($dynamicsIsland === 'on') {
            drawDynamicsIsland($image, $iconDynamicsIsland);
            $thoigiancanle = 130;
        } else {
            $thoigiancanle = 88;
        }
        if (!empty($Pin) && isset($iconPins[$Pin])) {
            drawPin($image, $iconPins[$Pin]);
        }
        // if (!empty($Pin) && isset($iconPins[$Pin])) {
        //     drawPinAndCombo($image, $iconPins[$Pin], $iconCombo);
        // }
        $stc = number_format($sotienchuyen, 0, ',', ',');
        $vnd = 'VND';
        $textBox = imagettfbbox(46, 0, $fontPath . 'vietcombank-new/UTM HelveBold.ttf', $stc);
        $vndBox = imagettfbbox(26, 0, $fontPath . 'vietcombank-new/NivaSmallCaps-Light.ttf', $vnd);
        $textWidth = $textBox[2] - $textBox[0];
        $vndWidth = $vndBox[2] - $vndBox[0];
        $imageWidth = imagesx($image);
        $xAmount = ($imageWidth - $textWidth - $vndWidth - 15) / 2;
        $yAmount = 525;
        $xVND = $xAmount + $textWidth + 15;
        $yVND = 495;
        $xAmount = round($xAmount);
        $yAmount = round($yAmount);
        $xVND = round($xVND);
        $yVND = round($yVND);
        canchinhphai($image, 27, 820, imagecolorallocate($image, 39,39,39), $fontPath . 'vietcombank-new/UTM HelveBold.ttf', $tennguoichuyen);
        canchinhphai($image, 27, 945, imagecolorallocate($image, 39,39,39), $fontPath . 'vietcombank-new/UTM HelveBold.ttf',FormatNumber::TD($sotienchuyen,2).' VND');
        canchinhphai($image, 27, 1280, imagecolorallocate($image, 39,39,39), $fontPath . 'vietcombank-new/UTM HelveBold.ttf', $tennguoinhan);
        canchinhphai($image, 27, 1090, imagecolorallocate($image, 39,39,39), $fontPath . 'vietcombank-new/UTM HelveBold.ttf', $stk);
        canchinhphai($image, 27, 1600, imagecolorallocate($image, 39,39,39), $fontPath . 'vietcombank-new/UTM HelveBold.ttf', $thoigianchuyen);
        canletrai($image, 33, 77, imagecolorallocate($image, 0, 1, 2), $fontPath . 'vietcombank-new/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, $thoigiancanle);
        canchinhphai($image, 27, 1452, imagecolorallocate($image, 39,39,39), $fontPath . 'vietcombank-new/UTM HelveBold.ttf', $noidungchuyen);
        ob_start();
        imagejpeg($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        echo json_encode(["success" => true, "message" => "Tạo bill thành công!", "image" => $base64]);
        imagedestroy($image);
    }