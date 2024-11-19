<?php $options_header = ['title' => 'Hệ thống fakebill - số dư ngân hàng miễn phí']; ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Hệ Thống Fake Bill /</span> Số Dư
        </h4>
        <?php if (!in_array($plans->TD('tengoi', $taikhoan), ['vip1', 'vip2', 'vip3'])): ?>
        <?php if (empty($user['rank']) || !in_array($user['rank'], ['admin', 'leader', 'partner'])): ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            ⚠️ <b>Thông báo</b>: Vui lòng cân nhắc nâng cấp tài khoản lên gói thành viên VIP để có thể mở khoá tất cả
            đặc quyền sử dụng mà không bị hạn chế!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php elseif (in_array($plans->TD('tengoi', $taikhoan), ['vip1', 'vip2', 'vip3'])): ?>
        <div class="alert alert-info alert-dismissible" role="alert">
            🔥 <b>Gói thành viên <?=strtoupper($plans->TD('tengoi', $taikhoan))?> của bạn sẽ hết hạn vào lúc: </b>
            <b class="text-success"><?=FormatTime::TD($plans->TD('ngayhethan', $taikhoan),1)?></b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <!-- Cards Fake Sodu -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card mb-lg-0 mb-4">
                    <div class="card-body text-center">
                    <a href="/fake-so-du/vietinbank">
                        <div class="fake-icon d-flex justify-content-center">
                            <img src="/<?=__IMG__?>/icon/vietinbank.webp" alt="Logo Vietinbank" class="img-fluid">
                        </div>
                        <h4>Vietinbank</h4>
                        </a>
                        <span>Fake số dư ngân hàng vietinbank (Free Tạo)</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card mb-lg-0 mb-4">
                    <div class="card-body text-center">
                    <a href="/fake-so-du/momo">
                        <div class="fake-icon d-flex justify-content-center">
                            <img src="/<?=__IMG__?>/icon/momo.png" alt="Logo Momo" class="img-fluid">
                        </div>
                        <h4>Ví Momo</h4>
                        </a>
                        <span>Fake số dư ví Momo (Free Tạo)</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card mb-lg-0 mb-4">
                    <div class="card-body text-center">
                    <a href="/fake-so-du/mb-bank">
                        <div class="fake-icon d-flex justify-content-center">
                            <img src="/<?=__IMG__?>/icon/mb-bank.png" alt="Logo MBBank" class="img-fluid">
                        </div>
                        <h4>MBBank</h4>
                        </a>
                        <span>Fake số dư ngân hàng MBBank (Free Tạo)</span>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Card Border Shadow -->
    </div>
    <!-- / Content -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>