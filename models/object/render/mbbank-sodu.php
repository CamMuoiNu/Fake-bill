<?php
if (isset($_POST['action']) && $_POST['action'] === 'fakesodu-mbbank') {
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $dynamicsIsland = isset($_POST['dynamicsIsland']) ? $_POST['dynamicsIsland'] : '';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/sodu-mbbank.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/';
    $iconDynamicsIsland = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/dynamics.png';
    $source_img = imagecreatefrompng($phoiBank);
    if ((new SessionExpiredChecker())->check($taikhoan, $user)) {
        exit(json_encode(["error" => "Vui lòng đăng nhập để sử dụng dịch vụ!"]));
    }
    // if ($user['rank'] !== 'admin' && $user['rank'] !== 'leader') {
    //     if (!in_array($plans->TD('tengoi', $taikhoan), ['vip1', 'vip2', 'vip3'])) {
    //         $source_img = imagecreatefrompng($phoiBank);
    //         $source_img = Watermark::Render($source_img, 2,30,400);
    //     }
    // }
    function CanSoDu($image, $text, $font, $size, $color, $y, $vndFont, $vndSize, $vndColor, $vndY) {
        $fixed_left_position = 340;  // Căn phải trái
        $right_padding = 15; 
        $image_width = imagesx($image);
        $formatted_number = FormatNumber::TD($text,2);
        $vnd_text = ' VND';
        $number_bbox = imagettfbbox($size, 0, $font, $formatted_number);
        $number_width = $number_bbox[2] - $number_bbox[0];
        $vnd_bbox = imagettfbbox($vndSize, 0, $vndFont, $vnd_text);
        $vnd_width = $vnd_bbox[2] - $vnd_bbox[0];
        $number_left_margin = $fixed_left_position;
        if ($number_width + $vnd_width + $fixed_left_position + $right_padding > $image_width) {
            $number_left_margin = $image_width - $number_width - $vnd_width - $right_padding;
        }
        imagettftext($image, $size, 0, $number_left_margin, $y, $color, $font, $formatted_number);
        $vnd_left_margin = $number_left_margin + $number_width + 5; 
        imagettftext($image, $vndSize, 0, $vnd_left_margin, $vndY, $vndColor, $vndFont, $vnd_text);
    }
    
    function CanThoiGian($image, $text, $font, $size, $color, $y) {
        $fixed_left_position = 100; 
        $image_width = imagesx($image);

        $text_bbox = imagettfbbox($size, 0, $font, $text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;

        if ($text_width + $fixed_left_position > $image_width) {
            $text_left_margin = $image_width - $text_width;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $text);
    }
    function drawDynamicsIsland($source_img, $iconDynamicsIslandPath)
    {
        $iconDynamicsIsland = imagecreatefrompng($iconDynamicsIslandPath);
        $newIconWidth = 300;
        $newIconHeight = 110;
        $iconWidth = imagesx($iconDynamicsIsland);
        $iconHeight = imagesy($iconDynamicsIsland);
        $resizedIcon = imagecreatetruecolor($newIconWidth, $newIconHeight);
        imagealphablending($resizedIcon, false);
        imagesavealpha($resizedIcon, true);
        imagecopyresampled($resizedIcon, $iconDynamicsIsland, 0, 0, 0, 0, $newIconWidth, $newIconHeight, $iconWidth, $iconHeight);
        $imageWidth = imagesx($source_img);
        $x = ($imageWidth - $newIconWidth) / 2;
        $y = 10;
        imagecopy($source_img, $resizedIcon, $x, $y, 0, 0, $newIconWidth, $newIconHeight);
        imagedestroy($iconDynamicsIsland);
        imagedestroy($resizedIcon);
    }
    if ($dynamicsIsland === 'on') {
        drawDynamicsIsland($source_img, $iconDynamicsIsland);
    } 
    $width = imagesx($source_img);
    $height = imagesy($source_img);
    $dest_img = imagecreatetruecolor($width, $height);
    imagecopy($dest_img, $source_img, 0, 0, 0, 0, $width, $height);

    CanSoDu($dest_img, $sodu, $fontPath . '/common/San Francisco/SanFranciscoText-Bold.otf', 33, imagecolorallocate($dest_img, 254, 254, 243), 500, $fontPath . '/common/URWGrotesk/URW Grotesk Regular.ttf', 25, imagecolorallocate($dest_img, 249,254,252), 500);
    CanThoiGian($dest_img, $thoigiantrendt, $fontPath.'/common/San Francisco/SanFranciscoText-Bold.otf', 27, imagecolorallocate($dest_img, 229,246,255), 67);    
    
    ob_start();
    imagejpeg($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);

    echo json_encode(["success" => true, "message" => "Tạo bill thành công!", "image" => $base64]);
    
    imagedestroy($dest_img);
}