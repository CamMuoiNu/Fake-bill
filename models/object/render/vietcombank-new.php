<?php
if (isset($_POST['action']) && $_POST['action'] === 'fakebill-vietcombank-new') {
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $kieuchuyen = $_POST["kieuchuyen"];
    $dynamicsIsland = isset($_POST['dynamicsIsland']) ? $_POST['dynamicsIsland'] : '';
    $Pin = isset($_POST['pin']) ? $_POST['pin'] : '';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/vietcombank_moi' . ($kieuchuyen === 'ngoaibank' ? '' : '-2') . '.jpg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
    $iconBankPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/icon/bank/' . $nganhangnhan . '.png';
    $iconDynamicsIsland = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/dynamics.png';
    $iconCombo = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/combo-wifi-tinhieu.png';
    $iconBankPath = $kieuchuyen === 'trongbank' ? $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/icon/bank/vietcombank.png': $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/icon/bank/' . $nganhangnhan . '.png';
    $iconPins = [
        'pin-yeu' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/pin-yeu.png',
        '20' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/20.png',
        '50' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/50.png',
        '60' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/60.png',
        '70' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/70.png',
        '80' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/80.png',
        '100' => $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/pin/dark/100.png',
    ];
    $image = ($kieuchuyen === 'trongbank') ? imagecreatefromjpeg($phoiBank) : imagecreatefrompng($phoiBank);
    if ((new SessionExpiredChecker())->check($taikhoan, $user)) {
        exit(json_encode(["error" => "Vui lòng đăng nhập để sử dụng dịch vụ!"]));
    }
    if ($user['rank'] !== 'admin' && $user['rank'] !== 'leader') {
        if (!in_array($plans->TD('tengoi', $taikhoan), ['vip1', 'vip2', 'vip3'])) {
            $image = imagecreatefrompng($phoiBank);
            $image = Watermark::Render($image, 0.7);
        }
    }
    if (!file_exists($iconBankPath)) {
        exit(json_encode(["error" => "Ngân hàng nhận không hợp lệ."]));
    } else{
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
        
        function canchinhphai_banks($image, $y, $textColor, $font, $iconBankPath, $nganhang_stk, $fullname, $fontSize, $fullnameFont, $fullnameColor, $iconOffsetY = 5, $iconWidth = 40, $iconHeight = 40, $vtBankWidth = 80, $vtBankHeight = 80)
        {
            $iconVtBank = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/vt-bank.png');
            $iconVtBankResized = imagecreatetruecolor($vtBankWidth, $vtBankHeight);
            // imagealphablending($iconVtBankResized, false);
            // imagesavealpha($iconVtBankResized, true);
            $transparent = imagecolorallocatealpha($iconVtBankResized, 0, 0, 0, 127);
            imagefill($iconVtBankResized, 0, 0, $transparent);
            imagecopyresampled($iconVtBankResized, $iconVtBank, 0, 0, 0, 0, $vtBankWidth, $vtBankHeight, imagesx($iconVtBank), imagesy($iconVtBank));
            $icon = imagecreatefrompng($iconBankPath);
            $resizedIcon = imagecreatetruecolor($iconWidth, $iconHeight);
            $transparent = imagecolorallocatealpha($resizedIcon, 0, 0, 0, 127);
            imagefill($resizedIcon, 0, 0, $transparent);
            imagecopyresampled($resizedIcon, $icon, 0, 0, 0, 0, $iconWidth, $iconHeight, imagesx($icon), imagesy($icon));
            $iconBankX = ($vtBankWidth - $iconWidth) / 2;
            $iconBankY = ($vtBankHeight - $iconHeight) / 2;
            imagecopy($iconVtBankResized, $resizedIcon, (int)$iconBankX, (int)$iconBankY, 0, 0, (int)$iconWidth, (int)$iconHeight);
            $textBoundingBox = imagettfbbox($fontSize, 0, $font, $nganhang_stk);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $imageWidth = imagesx($image);
            $totalWidth = $vtBankWidth + 10 + $textWidth;
            $x = $imageWidth - $totalWidth - 85;
            $iconY = $y - $vtBankHeight + $iconOffsetY;
            imagecopy($image, $iconVtBankResized, $x, $iconY, 0, 0, $vtBankWidth, $vtBankHeight);
            imagettftext($image, $fontSize, 0, $x + $vtBankWidth + 10, $y, $textColor, $font, $nganhang_stk);
            $fullnameBoundingBox = imagettfbbox($fontSize - 4, 0, $fullnameFont, $fullname);
            $fullnameWidth = $fullnameBoundingBox[2] - $fullnameBoundingBox[0];
            $fullnameX = $imageWidth - $fullnameWidth - 85;
            $fullnameY = $y + 60;
            imagettftext($image, $fontSize - 4, 0, $fullnameX, $fullnameY, $fullnameColor, $fullnameFont, $fullname);
            imagedestroy($icon);
            imagedestroy($resizedIcon);
            imagedestroy($iconVtBank);
            imagedestroy($iconVtBankResized);
        }
        
        function drawDynamicsIsland($image, $iconDynamicsIslandPath)
        {
            $iconDynamicsIsland = imagecreatefrompng($iconDynamicsIslandPath);
            $newIconWidth = 320;
            $newIconHeight = 115;
            $iconWidth = imagesx($iconDynamicsIsland);
            $iconHeight = imagesy($iconDynamicsIsland);
            $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $iconDynamicsIsland, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);
            $imageWidth = imagesx($image);
            $x = ($imageWidth - $newIconWidth) / 2;
            $y = 12;
            imagecopy($image, $resizedIcon, $x, $y, 0, 0, $newIconWidth, $newIconHeight);
            imagedestroy($iconDynamicsIsland);
            imagedestroy($resizedIcon);
        }
        function drawPin($image, $iconPinPath)
        {
            $iconPin = imagecreatefrompng($iconPinPath);
            $newIconWidth = 57;
            $newIconHeight = 27;
            $iconWidth = imagesx($iconPin);
            $iconHeight = imagesy($iconPin);
            $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $iconPin, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);

            $imageWidth = imagesx($image);
            $imageHeight = imagesy($image);
            $x = $imageWidth - $newIconWidth - 55;
            $y = 40;

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
        if ($kieuchuyen === 'ngoaibank') {
        $bankNames = [
            'vietinbank' => ['name' => 'Vietinbank', 'fullname' => 'Ngân hàng Công Thương Việt Nam'],
            'techcombank' => ['name' => 'Techcombank', 'fullname' => 'Ngân hàng Kỹ Thương Việt Nam'],
            'acbbank' => ['name' => 'ACB', 'fullname' => 'Ngân hàng TMCP Á Châu'],
            'agribank' => ['name' => 'Agribank', 'fullname' => 'Ngân hàng Nông thôn Việt Nam'],
            'bidv' => ['name' => 'BIDV', 'fullname' => 'Ngân hàng Đầu tư và phát triển Việt Nam'],
            'msb' => ['name' => 'MSB', 'fullname' => 'Ngân hàng TMCP Hàng Hải Việt Nam'],
            'sacombank' => ['name' => 'Sacombank', 'fullname' => 'Ngân hàng Sài Gòn Thương Tín'],
            'mbbank' => ['name' => 'MB', 'fullname' => 'Ngân hàng Quân đội'],
            'namabank' => ['name' => 'Nam Á Bank', 'fullname' => 'Ngân hàng thương mại cổ phần Nam Á'],
            'ocb' => ['name' => 'OCB', 'fullname' => 'Ngân Hàng TMCP Phương Đông'],
            'tpbank' => ['name' => 'TP Bank', 'fullname' => 'Ngân hàng Cổ phần Tiên Phong'],
            'vpbank' => ['name' => 'VP Bank', 'fullname' => 'Ngân hàng Việt Nam Thịnh Vượng'],
        ];
        $nganhang_stk = isset($bankNames[$nganhangnhan]) ? strtoupper($bankNames[$nganhangnhan]['name']) : strtoupper($nganhangnhan);
        $fullnamebank = isset($bankNames[$nganhangnhan]) ? $bankNames[$nganhangnhan]['fullname'] : '';
        } else {
            $nganhang_stk = 'Vietcombank';
            $fullnamebank = 'Ngân hàng TMCP Ngoại thương Việt Nam';
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
        imagettftext($image, 46, 0, $xAmount, $yAmount, imagecolorallocate($image, 10, 78, 56), $fontPath . 'vietcombank-new/UTM HelveBold.ttf', $stc);
        imagettftext($image, 26, 0, $xVND, $yVND, imagecolorallocate($image, 54, 96, 79), $fontPath . 'vietcombank-new/NivaSmallCaps-Light.ttf', $vnd);
        canchinhphai($image, 27, 820, imagecolorallocate($image, 39,39,39), $fontPath . 'vietcombank-new/UTM HelveBold.ttf', $tennguoinhan);
        canchinhphai($image, 29, 712, imagecolorallocate($image, 39,39,39), $fontPath . 'vietcombank-new/UTM HelveBold.ttf', $stk);
        canchinhgiua($image, 23, 588, imagecolorallocate($image, 90, 91, 84), $fontPath . 'vietcombank-new/Helvetica.ttf', $thoigianchuyen);
        canletrai($image, 29, 65, imagecolorallocate($image, 0, 1, 2), $fontPath . 'vietcombank-new/SanFranciscoDisplay-Semibold.otf', $thoigiantrendt, $thoigiancanle);
        canchinhphai_banks( $image, 920, imagecolorallocate($image, 35,35,35), $fontPath . 'vietcombank-new/UTM HelveBold.ttf', $iconBankPath, $nganhang_stk, $fullnamebank, 26, $fontPath . 'vietcombank-new/SVN-Arial 3.ttf', imagecolorallocate($image, 48, 48, 48), 22, 37, 37, 68, 68);
        canchinhphai_noidung($image, 27, 1071, imagecolorallocate($image, 39,39,39), $fontPath . 'vietcombank-new/UTM HelveBold.ttf', $noidungchuyen, 1.9, 30);
        canchinhphai($image, 29, 1477, imagecolorallocate($image, 39,39,39), $fontPath . 'vietcombank-new/UTM HelveBold.ttf', $magiaodich);
        ob_start();
        imagejpeg($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        echo json_encode(["success" => true, "message" => "Tạo bill thành công!", "image" => $base64]);
        imagedestroy($image);
    }
}