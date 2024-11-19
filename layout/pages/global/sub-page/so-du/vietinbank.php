<?php $options_header = ['title' => 'Tạo fake số dư ngân hàng Vietinbank miễn phí']?>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/head.php'); ?>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/nav.php'); ?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Fake Số Dư /</span> Vietinbank
        </h4>
        <div class="row">
            <div class="col-md-9">
                <form class="hk-sodu-vietinbank hk-refresh-form">
                    <div class="card mb-4">
                        <h5 class="card-header">
                            <i class="ri-bank-fill me-2"></i>Tạo Số Dư Vietinbank
                        </h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="ctk" data-limit-text="23" class="form-label">Tên Chủ Tài Khoản</label>
                                <input type="text" class="form-control td-format-text" name="ctk"
                                    placeholder="VUONG THANH DIEU" required>
                            </div>
                            <div class="mb-3">
                                <label for="stk" data-limit-text="12" class="form-label">Số Tài Khoản Của Bạn</label>
                                <input type="text" data-td-msg="Số tài khoản phải là một con số!"
                                    class="form-control td-format-number" name="stk"
                                    placeholder="Ví dụ: 10<?= random_int(10000000, 999999999) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="sodu" data-limit-text="14" class="form-label">Số Dư</label>
                                <input type="text" data-td-msg="Số dư phải là một con số!"
                                    class="form-control td-format-money" name="sodu" placeholder="Ví dụ: 100,000,000"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="thoigiantrendt" data-limit-text="5" class="form-label">Thời Gian Trên
                                    ĐT</label>
                                <input type="text" class="form-control" name="thoigiantrendt" value="<?= date('H:i') ?>"
                                    placeholder="Ví dụ: 00:00" required>
                            </div>
                            <div class="mb-3">
                            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/dynamics/island.php');?>
                            <!-- <div class="d-block d-md-none mt-2"></div>
                            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/pin/light.php');?> -->
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <input type="hidden" name="action" value="fakesodu-vietinbank">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-checkbox-circle-line me-2"></i>Tạo Bill Ngay </button>&ensp;
                                    <button type="button" class="btn btn-danger clear-form">
                                        <i class="ri-refresh-line me-2"></i>Làm Mới </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- View Bill Form -->
            <div class="col-md-3 d-none d-md-block">
                <div class="kq-bill text-center">
                    <img src="/<?=__IMG__?>/demo/vietinbank-sodu.png" alt="Vietinbank" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>