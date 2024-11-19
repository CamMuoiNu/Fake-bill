<?php $options_header = ['title' => 'Tạo fake bill Momo chuyển khoản','og:image'=> 'https://i.imgur.com/JyAOItv.png'];?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?> <div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Fake Bill Chuyển Khoản /</span> Momo
        </h4>
        <div class="row">
            <div class="col-md-9">
                <form class="hk-momo hk-refresh-form">
                    <div class="card mb-4">
                        <h5 class="card-header">
                            <i class="ri-bank-fill me-2"></i>Tạo Bill Momo
                        </h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="tennguoinhan" data-limit-text="23" class="form-label">Tên Người Nhận</label>
                                <input type="text" class="form-control" name="tennguoinhan"
                                    placeholder="Vương Thanh Diệu" required>
                            </div>
                            <div class="mb-3">
                                <label for="sotienchuyen" data-limit-text="11" class="form-label">Số Tiền Chuyển</label>
                                <input type="text" data-td-msg="Số tiền chuyển phải là một con số!"
                                    class="form-control td-format-money" name="sotienchuyen"
                                    placeholder="Ví dụ: 100,000,000" required>
                            </div>
                            <div class="mb-3">
                                <label for="stk" data-limit-text="11" class="form-label">Số ĐT Người Nhận</label>
                                <input type="text" data-td-msg="Số tài khoản phải là một con số!"
                                    class="form-control td-format-number" name="stk"
                                    placeholder="Ví dụ: 0<?=rand(7,9).random_int(1000000,99999999)?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="thoigianchuyen" data-limit-text="27" class="form-label">Thời Gian
                                    Chuyển</label>
                                <input type="text" class="form-control" name="thoigianchuyen"
                                    value="<?=date('H:i - d/m/Y');?>" placeholder="Ví dụ: <?=date('H:i - d/m/Y');?>"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="thoigiantrendt" data-limit-text="5" class="form-label">Thời Gian Trên
                                    ĐT</label>
                                <input type="text" class="form-control" name="thoigiantrendt" value="<?= date('H:i') ?>" placeholder="Ví dụ: 00:00" required>
                            </div>
                            <div class="mb-3">
                                <label for="kieupin" class="form-label">Kiểu Pin ĐT</label>
                                <select class="form-select" name="kieupin" aria-label="Kiểu Pin ĐT" required>
                                    <option value="off">Pin Mặc Định</option>
                                    <option value="on">Pin Tự Chọn</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="magiaodich" data-limit-text="11" class="form-label">Mã Giao Dịch</label>
                                <input type="text" class="form-control" name="magiaodich"
                                    value="632533<?=random_int(100,999)?>28"
                                    placeholder="Ví dụ: <?=random_int(10000000000,99999999999)?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" data-limit-text="35" or="noidungchuyen">Lời Nhắn</label>
                                <textarea class="form-control" name="noidungchuyen" rows="1" placeholder="Ví dụ: Anh gui em it tien uong cf" required></textarea>
                            </div>
                            <div class="mb-3">
                            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/dynamics/island.php');?>
                            <div class="d-block d-md-none mt-2"></div>
                            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/pin/light.php');?>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <input type="hidden" name="action" value="fakebill-momo">
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
                    <img data-fancybox src="/<?=__IMG__?>/demo/momo.png" alt="Momo" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>