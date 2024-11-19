<?php
if (isset($_POST['action']) && $_POST['action'] === 'fakebill-vietinbank') {
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $stk_nc = FormatNumber::PREG($_POST["stk_nc"]);
    $stk = FormatNumber::PREG($_POST["stk"]);
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $phigiaodich = $_POST["phigiaodich"];
    $magiaodich = $_POST["magiaodich"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/phoi-bank/vietinbank.jpg';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __FONTS__;
    $source_img = imagecreatefromjpeg($phoiBank);
    if ($nganhangnhan === 'vtd') {
        exit(json_encode(["error" => "Vui lòng chọn một ngân hàng nhận."]));
    }
    if ((new SessionExpiredChecker())->check($taikhoan, $user)) {
        exit(json_encode(["error" => "Vui lòng đăng nhập để sử dụng dịch vụ!"]));
    }
    if ($user['rank'] !== 'admin' && $user['rank'] !== 'leader') {
        if (!in_array($plans->TD('tengoi', $taikhoan), ['vip1', 'vip2', 'vip3'])) {
            $source_img = imagecreatefromjpeg($phoiBank);
            $source_img = Watermark::Render($source_img, 2,35,300);
        }
    }
    function canchinhphai($image, $text, $font, $size, $color, $y, $nhan = 50)
    {
        $bbox = imagettfbbox($size, 0, $font, $text);
        $text_width = $bbox[2] - $bbox[0];
        $x = imagesx($image) - $text_width - $nhan;
        imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
    }
    function alignCenter($image, $text, $font, $size, $color, $y)
    {
        $bbox = imagettfbbox($size, 0, $font, $text);
        $text_width = $bbox[2] - $bbox[0];
        $x = (imagesx($image) - $text_width) / 2;
        imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
    }

    $width = imagesx($source_img);
    $height = imagesy($source_img);
    $image = imagecreatetruecolor($width, $height);
    imagecopy($image, $source_img, 0, 0, 0, 0, $width, $height);

    $textColorGray = imagecolorallocate($image, 133, 146, 151);
    $textColorDark = imagecolorallocate($image, 13, 42, 70);
    $textColorBlue = imagecolorallocate($image, 4, 88, 146);
    canchinhphai($image, $thoigianchuyen, $fontPath . '/vietinbank/SVN-Gilroy SemiBold.otf', 24, $textColorGray, 300);
    canchinhphai($image, $magiaodich, $fontPath . '/vietinbank/SVN-Gilroy SemiBold.otf', 24, $textColorGray, 350);
    canchinhphai($image, '*******' . substr($stk_nc, 5), $fontPath . '/vietinbank/SVN-Gilroy Medium.otf', 30, $textColorDark, 730);
    canchinhphai($image, $tennguoichuyen, $fontPath . '/vietinbank/SVN-Gilroy Medium.otf', 30, $textColorDark, 790);
    canchinhphai($image, $stk, $fontPath . '/vietinbank/SVN-Gilroy Bold.otf', 30, $textColorDark, 890);
    canchinhphai($image, $tennguoinhan, $fontPath . '/vietinbank/SVN-Gilroy Bold.otf', 30, $textColorDark, 945);
    canchinhphai($image, $nganhangnhan, $fontPath . '/vietinbank/SVN-Gilroy Medium.otf', 30, $textColorDark, 1050);
    canchinhphai($image, number_format($sotienchuyen) . ' VND', $fontPath . '/vietinbank/SVN-Gilroy XBold.otf', 30, $textColorBlue, 1190);
    canchinhphai($image, convert_number_to_words($sotienchuyen), $fontPath . '/vietinbank/SVN-Gilroy XBold.otf', 30, $textColorBlue, 1250);
    canchinhphai($image, $phigiaodich, $fontPath . '/vietinbank/SVN-Gilroy Medium.otf', 30, $textColorDark, 1350);
    canchinhphai($image, $noidungchuyen, $fontPath . '/vietinbank/SVN-Gilroy Medium.otf', 30, $textColorDark, 1445);
    ob_start();
    imagejpeg($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    imagedestroy($source_img);
    exit(json_encode(["success" => true, "message" => "Tạo bill thành công!", "image" => $base64]));
}
