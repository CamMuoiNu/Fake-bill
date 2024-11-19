<?php
if (isset($_POST['action']) && $_POST['action'] === 'fakebill-tpbank') {
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk_nc = FormatNumber::STK($_POST["stk_nc"]);
    $stk = FormatNumber::STK($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $magiaodich = $_POST["magiaodich"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $nganhangnhan = $_POST["nganhangnhan"];
    $cachthucchuyen = $_POST["cachthucchuyen"];
    $dynamicsIsland = isset($_POST['dynamicsIsland']) ? $_POST['dynamicsIsland'] : '';
    $Pin = isset($_POST['pin']) ? $_POST['pin'] : '';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/phoi-bank/tpbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
    $iconDynamicsIsland = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/dynamics.png';
    $iconBankPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/icon/bank/'.$nganhangnhan.'.png';
    $image = imagecreatefrompng($phoiBank);
    if ((new SessionExpiredChecker())->check($taikhoan, $user)) {
        exit(json_encode(["error" => "Vui lòng đăng nhập để sử dụng dịch vụ!"]));
    }
    if ($user['rank'] !== 'admin' && $user['rank'] !== 'leader') {
        if (!in_array($plans->TD('tengoi', $taikhoan), ['vip1', 'vip2', 'vip3'])) {
            $image = imagecreatefrompng($phoiBank);
            $image = Watermark::Render($image, 2,30,400);
        }
    }
    function canchinhphai($image, $fontsize, $y, $textColor, $font, $text)
    {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = $imageWidth - $textWidth - 117;
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
        function canletrai_bank($image, $fontsize, $y, $textColor, $font, $text, $x_offset = 259)
        {
            $fontSize = (int)$fontsize;
            $x = (int)$x_offset;
            $y = (int)$y;
            imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
        }
        function drawBankIcon($image, $iconBankPath) {
            $iconBank = imagecreatefrompng($iconBankPath);
            $iconWidth = imagesx($iconBank);
            $iconHeight = imagesy($iconBank);
            $newIconWidth = 67;
            $newIconHeight = 67; 
            $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
            imagealphablending($resizedIcon, false);
            imagesavealpha($resizedIcon, true);
            imagecopyresampled($resizedIcon, $iconBank, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);
            $x = 120; 
            $y = 1163;
            imagecopy($image, $resizedIcon, $x, $y, 0, 0, $newIconWidth, $newIconHeight);
            imagedestroy($iconBank);
        }
        function drawUserAvatar($image, $avatarPath) {
            if (empty($avatarPath['tmp_name'])) {
                return; // Không có file được tải lên
            }
            $avatar = imagecreatefromjpeg($avatarPath['tmp_name']);
            $avatarWidth = imagesx($avatar);
            $avatarHeight = imagesy($avatar);
            $newAvatarWidth = 100;
            $newAvatarHeight = 100;
            $resizedAvatar = imagecreatetruecolor($newAvatarWidth, $newAvatarHeight);
            imagealphablending($resizedAvatar, false);
            imagesavealpha($resizedAvatar, true);
            imagecopyresampled($resizedAvatar, $avatar, 0, 0, 0, 0, $newAvatarWidth, $newAvatarHeight, $avatarWidth, $avatarHeight);
            $x = 50;
            $y = 50;
            imagecopy($image, $resizedAvatar, $x, $y, 0, 0, $newAvatarWidth, $newAvatarHeight);
            imagedestroy($avatar);
        }
    
            if ($dynamicsIsland === 'on') {
                drawDynamicsIsland($image, $iconDynamicsIsland);
                $thoigiancanle = 140;
            } else {
                $thoigiancanle = 88;
            }
            if (isset($_FILES['avatar'])) {
                drawUserAvatar($image, $_FILES['avatar']);
            }
        
        drawBankIcon($image, $iconBankPath);
        canletrai_bank($image, 24, 985, imagecolorallocate($image, 44, 30, 80), $fontPath . '/tpbank/Rubik-Regular.ttf', $tennguoichuyen);
        canletrai_bank($image, 23, 1030, imagecolorallocate($image,123,127,155), $fontPath . '/tpbank/Roboto-Regular.ttf', $stk_nc);
        canletrai_bank($image, 23, 1235, imagecolorallocate($image,123,127,155), $fontPath . '/tpbank/Roboto-Regular.ttf', $stk.' | '.strtoupper($nganhangnhan));
        canletrai_bank($image, 24, 1188, imagecolorallocate($image, 44, 30, 80), $fontPath . '/tpbank/Rubik-Regular.ttf', $tennguoinhan);
        canchinhgiua($image, 55, 730, imagecolorallocate($image, 44,30,80), $fontPath . '/tpbank/NotoSansGeorgian-Regular.ttf',FormatNumber::TD($sotienchuyen,2).' VND');
        canchinhphai($image, 28, 1598, imagecolorallocate($image, 44,30,80), $fontPath . '/tpbank/Roboto-Medium.ttf', $thoigianchuyen);
        canletrai($image, 30, 80, imagecolorallocate($image, 255,255,255), $fontPath . '/common/San Francisco/SanFranciscoText-Bold.otf', $thoigiantrendt, $thoigiancanle);
        canchinhphai($image, 28, 1315, imagecolorallocate($image, 44,30,80), $fontPath . '/tpbank/Roboto-Medium.ttf', $magiaodich);
        canchinhphai($image, 28, 1480, imagecolorallocate($image, 44,30,80), $fontPath . '/tpbank/Roboto-Medium.ttf', $noidungchuyen);
        canchinhphai($image, 28, 1720, imagecolorallocate($image, 44,30,80), $fontPath . '/tpbank/Roboto-Medium.ttf', $cachthucchuyen);
        ob_start();
        imagejpeg($image);
        $imageData = ob_get_clean();
        $base64 = base64_encode($imageData);
        echo json_encode(["success" => true, "message" => "Tạo bill thành công!", "image" => $base64]);
        imagedestroy($image);
}