<?php
/**
* Kết Nối CSDL
*/
require_once ($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/global/demoModel.php');
/**
 * Class CallDemo
 */
class CallDemo
{
    public function Demo($demoName)
    {
        $BankIMG = [
            'mb-bank-new' => '/'.__IMG__.'/demo/mbbank_moi.png',
            'vietcombank-new' => '/'.__IMG__.'/demo/vietcombank_moi.png',
            'techcombank' => '/'.__IMG__.'/demo/techcombank.png',
            'vietinbank' => '/'.__IMG__.'/demo/vietinbank.png',
            'acb' => '/'.__IMG__.'/demo/acb.png',
            'momo' => '/'.__IMG__.'/demo/momo.png',
            'tpbank' => '/'.__IMG__.'/demo/tpbank.png',
            'msb' => '/'.__IMG__.'/demo/msb.png',
        ];
        if (array_key_exists($demoName, $BankIMG)) {
            return [
                'success' => true,
                'result' => $this->DemoImg($BankIMG[$demoName],ucwords(str_replace('-', ' ', $demoName)))
            ];
        }
        return [
            'success' => false,
            'msg' => 'Demo not found'
        ];
    }

    /**
     * Return Demo
     *
     * @param string $ImgPath
     * @param string $demoName
     * @return string
     */
    private function DemoImg($ImgPath, $demoName)
    {
        ob_start(); ?>
        <div class="offcanvas offcanvas-end" id="ws-call-demo" aria-hidden="true">
            <div class="offcanvas-header border-bottom">
                <h6 class="offcanvas-title ws-rainbow">Xem Trước: <?= htmlspecialchars($demoName) ?></h6>
                <button type="button" class="btn-close text-reset" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1 call-demo">
                <p><img src="<?=$ImgPath?>" alt="Ảnh Demo"></p>
            </div>
        </div>
        <?php return ob_get_clean();
    }
}
