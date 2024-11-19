<?php
if (isset($_POST['action']) && $_POST['action'] === 'fakebill-mbbank-new') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $dynamicsIsland = isset($_POST['dynamicsIsland']) ? $_POST['dynamicsIsland'] : '';
    $Pin = isset($_POST['pin']) ? $_POST['pin'] : '';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/mbbank-moi.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
    $iconBankPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/icon/bank/' . $nganhangnhan . '.png';
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
            $image = Watermark::Render($image, 1.2);
        }
    }
    
    if ($nganhangnhan === 'vtd') {
        exit(json_encode(["error" => "Vui lòng chọn một ngân hàng nhận."]));
    } elseif (!file_exists($iconBankPath)) {
        exit(json_encode(["error" => "Ngân hàng nhận không hợp lệ."]));
    } else {

        function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text)
        {
            $fontSize = $fontsize;
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
            $textWidth = (int) ($textBoundingBox[2] - $textBoundingBox[0]);
            $imageWidth = imagesx($image);
            $x = (int) (($imageWidth - $textWidth) / 2);
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }


        function canletrai($image, $fontsize, $y, $textColor, $font, $text, $x_tcb)
        {
            $fontSize = $fontsize;
            imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);
        }

        function canchinhgiua_with_icon($image, $y, $textColor, $font, $iconBankPath, $nganhang_stk, $fontSize, $iconOffsetY = 5)
        {
            $icon = imagecreatefrompng($iconBankPath);
            $iconWidth = 40;
            $iconHeight = 40;
            $resizedIcon = imagecreatetruecolor($iconWidth, $iconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $icon, 0, 0, 0, 0, $iconWidth, $iconHeight, imagesx($icon), imagesy($icon));

            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $nganhang_stk);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $totalWidth = $iconWidth + 10 + $textWidth;
            $x = ($imageWidth - $totalWidth) / 2;
            $iconY = $y - $iconHeight + $iconOffsetY;
            imagecopy($image, $resizedIcon, round($x), round($iconY), 0, 0, $iconWidth, $iconHeight);
            imagettftext($image, $fontSize, 0, round($x + $iconWidth + 10), round($y), $textColor, $font, $nganhang_stk);


            imagedestroy($icon);
            imagedestroy($resizedIcon);
        }
        function drawDynamicsIsland($image, $iconDynamicsIslandPath)
        {
            $iconDynamicsIsland = imagecreatefrompng($iconDynamicsIslandPath);
            $newIconWidth = 330;
            $newIconHeight = 120;
            $iconWidth = imagesx($iconDynamicsIsland);
            $iconHeight = imagesy($iconDynamicsIsland);
            $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $iconDynamicsIsland, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);
            $imageWidth = imagesx($image);
            $x = ($imageWidth - $newIconWidth) / 2;
            $y = 12;
            imagecopy($image,$resizedIcon,intval($x),intval($y),0,0,intval($newIconWidth),intval($newIconHeight));
            imagedestroy($iconDynamicsIsland);
            imagedestroy($resizedIcon);
        }
        function drawPin($image, $iconPinPath)
        {
            $iconPin = imagecreatefrompng($iconPinPath);
            $newIconWidth = 57;
            $newIconHeight = 28;
            $iconWidth = imagesx($iconPin);
            $iconHeight = imagesy($iconPin);
            $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $iconPin, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);

            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);
            $x = $imageWidth - $newIconWidth - 96;
            $y = 50;

            imagecopy($image, $resizedIcon, $x, $y, 0, 0, $newIconWidth, $newIconHeight);

            imagedestroy($iconPin);
            imagedestroy($resizedIcon);
        }

        function drawPinAndCombo($image, $iconPinPath, $iconComboPath)
        {
            $iconPin = imagecreatefrompng($iconPinPath);
            $iconCombo = imagecreatefrompng($iconComboPath);
            $newIconWidth = 38;
            $newIconHeight = 38;
            $comboWidth = 65;
            $comboHeight = 50;
            $iconWidth = imagesx($iconPin);
            $iconHeight = imagesy($iconPin);
            $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $iconPin, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);
            $comboWidthOriginal = imagesx($iconCombo);
            $comboHeightOriginal = imagesy($iconCombo);
            $resizedCombo = imagecreatetruecolor($comboWidth, $comboHeight);
            imagealphablending($resizedCombo, false);
            imagesavealpha($resizedCombo, true);
            imagecopyresampled($resizedCombo, $iconCombo, 0, 0, 0, 0, $comboWidth, $comboHeight, $comboWidthOriginal, $comboHeightOriginal);

            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);

            $xCombo = $imageWidth - $comboWidth - 70;
            $yCombo = 10;

            $xPin = $xCombo + $comboWidth + 10;
            $yPin = 14;

            imagecopy($image, $resizedCombo, $xCombo, $yCombo, 0, 0, $comboWidth, $comboHeight);

            imagecopy($image, $resizedIcon, $xPin, $yPin, 0, 0, $newIconWidth, $newIconHeight);

            imagedestroy($iconPin);
            imagedestroy($resizedIcon);
            imagedestroy($iconCombo);
            imagedestroy($resizedCombo);
        }
        $bankNames = [
            'vietinbank' => 'Vietinbank (CTG)',
            'vietcombank' => 'Vietcombank (VCB)',
            'techcombank' => 'Techcombank (TCB)',
            'acbbank' => 'ACB Bank (ACB)',
            'agribank' => 'Agribank (ARB)',
            'bidv' => 'BIDV (BIDV)',
            'sacombank' => 'Sacombank (STB)',
            'mbbank' => 'MBBank (MB)',
            'namabank' => 'Nam Á Bank (NAB)',
            'ocb' => 'OCB (OCB)',
            'tpbank' => 'TP Bank (TPB)',
            'vpbank' => 'VP Bank (VPB)',
        ];
        $nganhang_stk = isset($bankNames[$nganhangnhan]) ? $bankNames[$nganhangnhan] . ' - ' . $stk : ucfirst($nganhangnhan) . ' - ' . $stk;

        if ($dynamicsIsland === 'on') {
            drawDynamicsIsland($image, $iconDynamicsIsland);
            $thoigiancanle = 130;
        } else {
            $thoigiancanle = 110;
        }
         if (!empty($Pin) && isset($iconPins[$Pin])) {
            drawPin($image, $iconPins[$Pin]);
        }
        // if (!empty($Pin) && isset($iconPins[$Pin])) {
        //     drawPinAndCombo($image, $iconPins[$Pin], $iconCombo);
        // }
        canchinhgiua($image, 46, 610, imagecolorallocate($image, 33, 33, 200), $fontPath . 'mbbank-new/SanFranciscoDisplay-Semibold.otf', FormatNumber::TD($sotienchuyen, 2) . ' VND');
        canchinhgiua($image, 29, 885, imagecolorallocate($image, 47, 46, 52), $fontPath . 'mbbank-new/URW Grotesk SC Regular.ttf', $tennguoinhan);
        canchinhgiua($image, 22, 680, imagecolorallocate($image, 122, 125, 130), $fontPath . 'mbbank-new/Helvetica.ttf', $thoigianchuyen);
        canletrai($image, 29, 79, imagecolorallocate($image, 0, 1, 2), $fontPath . 'mbbank-new/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, $thoigiancanle);
        canchinhgiua_with_icon($image, 950, imagecolorallocate($image, 49, 55, 58), $fontPath . 'mbbank-new/Helvetica.ttf', $iconBankPath, $nganhang_stk, 24, 10);
        canchinhgiua($image, 24, 1020, imagecolorallocate($image, 49, 55, 58), $fontPath . 'mbbank-new/SVN-Arial 3.ttf', $noidungchuyen);

        ob_start();
        imagejpeg($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        echo json_encode(["success" => true, "message" => "Tạo bill thành công!", "image" => $base64]);
        imagedestroy($image);
    }
}