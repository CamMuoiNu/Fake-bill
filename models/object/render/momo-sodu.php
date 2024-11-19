<?php
if (isset($_POST['action']) && $_POST['action'] === 'fakesodu-momo') {
    $thoigiantrendt = $_POST["thoigiantrendt"];
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $dynamicsIsland = isset($_POST['dynamicsIsland']) ? $_POST['dynamicsIsland'] : '';
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/'.__IMG__.'/phoi-bank/sodu-momo.png';
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
    function CanSoDu($image, $text, $font, $size, $color, $y) {
        $fixed_left_position = 150;  // Căn phải trái
        $right_padding = 10; 
        $image_width = imagesx($image);
        
        $formatted_text = FormatNumber::TD($text) . 'đ';
        
        $text_bbox = imagettfbbox($size, 0, $font, $formatted_text);
        $text_width = $text_bbox[2] - $text_bbox[0];
        $text_left_margin = $fixed_left_position;
        
        if ($text_width + $fixed_left_position + $right_padding > $image_width) {
            $text_left_margin = $image_width - $text_width - $right_padding;
        }
        imagettftext($image, $size, 0, $text_left_margin, $y, $color, $font, $formatted_text);
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
        $newIconWidth = 400;
        $newIconHeight = 140;
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

    CanSoDu($dest_img, $sodu, $fontPath.'/vietinbank/SVN-Gilroy Bold.otf', 35, imagecolorallocate($dest_img, 55,55,63), 1090);
    CanThoiGian($dest_img, $thoigiantrendt, $fontPath.'/vietinbank/SanFranciscoText-Semibold.otf', 37, imagecolorallocate($dest_img, 0,5,13), 80);    
    
    ob_start();
    imagejpeg($dest_img);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);

    echo json_encode(["success" => true, "message" => "Tạo bill thành công!", "image" => $base64]);
    
    imagedestroy($dest_img);
}