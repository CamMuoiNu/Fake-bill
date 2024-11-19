<?php
if (isset($_POST['action']) && $_POST['action'] === 'fakebill-acb') {
    $tennguoichuyen = $_POST["tennguoichuyen"];
    $tennguoinhan = $_POST["tennguoinhan"];
    $sotienchuyen = FormatNumber::PREG($_POST["sotienchuyen"]);
    $stk = FormatNumber::PREG($_POST["stk"]);
    $stk_nc = FormatNumber::PREG($_POST["stk_nc"]);
    $nganhangnhan = $_POST["nganhangnhan"];
    $thoigianchuyen = $_POST["thoigianchuyen"];
    $noidungchuyen = $_POST["noidungchuyen"];
    $phoiBank = $_SERVER['DOCUMENT_ROOT'] . '/' . __IMG__ . '/phoi-bank/acb.png';
    $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/' . __FONTS__;
    $image = @imagecreatefrompng($phoiBank);

    if ($nganhangnhan === 'vtd') {
        exit(json_encode(["error" => "Vui lòng chọn một ngân hàng nhận."]));
    }
    if ((new SessionExpiredChecker())->check($taikhoan, $user)) {
        exit(json_encode(["error" => "Vui lòng đăng nhập để sử dụng dịch vụ!"]));
    }
    if ($user['rank'] !== 'admin' && $user['rank'] !== 'leader') {
        if (!in_array($plans->TD('tengoi', $taikhoan), ['vip1', 'vip2', 'vip3'])) {
            $image = imagecreatefrompng($phoiBank);
            $image = Watermark::Render($image, 2,30,300);
        }
    }
    function splitIntoTwoLines($text, $maxLength, $font, $fontSize) {
        global $image;
        if (!$image) {
            return ['', ''];
        }
        
        $firstLine = mb_substr($text, 0, $maxLength);
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $firstLine);
        $firstLineWidth = $textBoundingBox[2] - $textBoundingBox[0];
        
        $x = imagesx($image) - 100 - $firstLineWidth;
        $line1 = $firstLine;
        $line2 = mb_substr($text, $maxLength);
        
        return [$line1, $line2];
    }

    function canlephai($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $x = imagesx($image) - 100 - $textWidth;
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }

    function canletrai($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        imagettftext($image, $fontSize, 0, 140, $y, $textColor, $font, $text);
    }

    function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text) {
        $fontSize = $fontsize;
        $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
        $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
        $imageWidth = imagesx($image);
        $x = (int) (($imageWidth - $textWidth) / 2); 
        imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
    }

    $dateString = $thoigianchuyen;
    $dateArray = explode(' - ', $dateString);
    $datePart = $dateArray[0]; 
    $datePart = substr($dateString, 0, strpos($dateString, ' - '));

    list($line1, $line2) = splitIntoTwoLines($nganhangnhan, 18, $fontPath.'/Helvetica.ttf', 37);
    $yPosition1 = 1565;
    $yPosition2 = $yPosition1 + 65;

    canlephai($image, 37, $yPosition1, imagecolorallocate($image,72, 72, 72), $fontPath.'/Helvetica.ttf', $line1);
    if (!empty($line2)) {
        canlephai($image, 37, $yPosition2, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Helvetica.ttf', $line2);
    }

    canlephai($image, 37, 1455, imagecolorallocate($image, 72, 72, 72), $fontPath.'/acb/Helvetica.ttf', $tennguoinhan);
    canletrai($image, 37, 1140, imagecolorallocate($image, 0, 37, 127), $fontPath.'/acb/Helvetica.ttf', $tennguoichuyen);
    canlephai($image, 37, 1745, imagecolorallocate($image, 72, 72, 72), $fontPath.'/acb/Helvetica.ttf', $stk);
    canletrai($image, 37, 1200, imagecolorallocate($image, 0, 37, 127), $fontPath.'/acb/Helvetica-Bold.ttf', $stk_nc);
    canletrai($image, 35, 630, imagecolorallocate($image, 72, 72, 72), $fontPath.'/acb/Helvetica.ttf', 'Ngày lập lệnh');
    canletrai($image, 35, 750, imagecolorallocate($image, 72, 72, 72), $fontPath.'/acb/Helvetica.ttf', 'Ngày hiệu lực');
    canlephai($image, 35, 630, imagecolorallocate($image, 72, 72, 72), $fontPath.'/acb/Helvetica.ttf', $thoigianchuyen);
    canlephai($image, 35, 750, imagecolorallocate($image, 72, 72, 72), $fontPath.'/acb/Helvetica.ttf', date('d-m-Y'));
    canlephai($image, 38, 2410, imagecolorallocate($image, 9, 42, 137), $fontPath.'/acb/Helvetica.ttf', $noidungchuyen);
    canchinhgiua($image, 45, 280, imagecolorallocate($image, 13, 107, 194), $fontPath.'/acb/UTM HelveBold.ttf', FormatNumber::TD($sotienchuyen) . ' VND');
    canchinhgiua($image, 30, 350, imagecolorallocate($image, 72, 72, 72), $fontPath.'/acb/Helvetica.ttf', ucfirst(convert_number_to_words($sotienchuyen)));

    ob_start();
    imagejpeg($image);
    $imageData = ob_get_clean();
    $base64 = base64_encode($imageData);
    imagedestroy($image);
    echo json_encode(["success" => true, "message" => "Tạo bill thành công!", "image" => $base64]);
}