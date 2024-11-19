<?php
class Watermark
{
    /**
     * Add watermark to img
     *
     * @param resource $image
     * @return resource|false
     */
    public static function Render($image,$scale = 0.7, $fontSize=30,$margin = 250,$lineSpacing = 700)
    {
        $texts = [
            'MUA GÓI ĐỂ XOÁ WATERMARK',
            '',
            'VUI LÒNG NÂNG CẤP LÊN GÓI VIP'
        ];
        $textColor = imagecolorallocatealpha($image, 59, 50, 191, 1);
        $fontPath = $_SERVER['DOCUMENT_ROOT'] . '/'.__FONTS__.'/FzRubik-Bold.ttf';
        $angle = 30;

        $stampPath = $_SERVER['DOCUMENT_ROOT'].'/'.__IMG__.'/icon/watermark.png';
        $stamp = imagecreatefrompng($stampPath);

        $stampWidth = imagesx($stamp);
        $stampHeight = imagesy($stamp);
        $newStampWidth = intval($stampWidth * $scale);
        $newStampHeight = intval($stampHeight * $scale);

        $resizedStamp = imagecreatetruecolor($newStampWidth, $newStampHeight);
        imagesavealpha($resizedStamp, true);
        $transparency = imagecolorallocatealpha($resizedStamp, 0, 0, 0, 127);
        imagefill($resizedStamp, 0, 0, $transparency);

        imagecopyresampled($resizedStamp, $stamp, 0, 0, 0, 0, $newStampWidth, $newStampHeight, $stampWidth, $stampHeight);

        $width = imagesx($image);
        $height = imagesy($image);

        $centerX = intval(($width - $newStampWidth) / 2);
        $centerY = intval(($height - $newStampHeight) / 2);

        imagecopy($image, $resizedStamp, $centerX, $centerY, 0, 0, $newStampWidth, $newStampHeight);

        imagedestroy($resizedStamp);
        imagedestroy($stamp);
        $textY = $height - $margin;

        foreach ($texts as $text) {
            $textBoundingBox = imagettfbbox($fontSize, $angle, $fontPath, $text);
            $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
            $textX = $width - $textWidth - $margin;

            self::drawTextWithRotation($image, $text, $fontPath, $fontSize, $textX, $textY, $angle, $textColor);
            
            $textY -= ($textBoundingBox[1] - $textBoundingBox[7]) + $lineSpacing;
        }

        return $image;
    }


    /**
     * Draw text with rotation on the image
     *
     * @param resource $image
     * @param string $text
     * @param string $fontPath
     * @param int $fontSize
     * @param int $x
     * @param int $y
     * @param int $angle
     * @param int $textColor
     * @return void
     */
    private static function drawTextWithRotation($image, $text, $fontPath, $fontSize, $x, $y, $angle, $textColor)
    {
        imagettftext($image, $fontSize, $angle, $x, $y, $textColor, $fontPath, $text);
    }
}