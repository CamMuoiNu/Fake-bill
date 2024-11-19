<?php $options_header=['title' => 'Tạo fake bill MSB chuyển khoản','og:image'=> 'https://i.imgur.com/mDZsaW2.png'];?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Fake Bill Chuyển Khoản /</span> MSB
        </h4>
        <div class="row">
            <div class="col-md-9">
                <form class="hk-msb hk-refresh-form">
                    <div class="card mb-4">
                        <h5 class="card-header"><i class="ri-bank-fill me-2"></i>Tạo Bill MSB</h5>
                        <div class="card-body">
                        <div class="mb-3">
                                <label for="tennguoichuyen" data-limit-text="25" class="form-label">Tên Người Chuyển</label>
                                <input type="text" class="form-control" name="tennguoichuyen"
                                    placeholder="VUONG THANH DIEU" required>
                            </div>
                            <div class="mb-3">
                                <label for="stk" data-limit-text="20" class="form-label">Số Tài Khoản Người Nhận</label>
                                <input type="text" data-td-msg="Số tài khoản phải là một con số!"
                                    class="form-control td-format-number" name="stk"
                                    placeholder="Ví dụ: 10<?=random_int(10000000, 999999999)?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="tennguoinhan" data-limit-text="23" class="form-label">Tên Người Nhận</label>
                                <input type="text" class="form-control td-format-text" name="tennguoinhan"
                                    placeholder="VUONG THANH DIEU" required>
                            </div>
                            <div class="mb-3">
                                <label for="sotienchuyen" data-limit-text="20" class="form-label">Số Tiền Chuyển</label>
                                <input type="text" data-td-msg="Số tiền chuyển phải là một con số!"
                                    class="form-control td-format-money" name="sotienchuyen"
                                    placeholder="Ví dụ: 100,000,000" required>
                            </div>
                            <div class="mb-3">
                                <label for="thoigianchuyen" data-limit-text="27" class="form-label">Thời Gian
                                    Chuyển</label>
                                <input type="text" class="form-control" name="thoigianchuyen"
                                    value="<?=date('H:i d/m/Y')?>"
                                    placeholder="Ví dụ: <?=date('H:i d/m/Y')?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="thoigiantrendt" data-limit-text="5" class="form-label">Thời Gian Trên
                                    ĐT</label>
                                <input type="text" class="form-control" name="thoigiantrendt" value="<?= date('H:i') ?>"
                                    placeholder="Ví dụ: 00:00" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" data-limit-text="30" or="noidungchuyen">Nội Dung
                                    Chuyển</label>
                                <textarea class="form-control" name="noidungchuyen" rows="1" placeholder="Ví dụ: VUONG THANH DIEU chuyen tien" required>NGUYEN VAN A chuyen tien</textarea>
                            </div>
                            <div class="mb-3">
                            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/dynamics/island.php');?>
                            <div class="d-block d-md-none mt-2"></div>
                            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/pin/dark.php');?>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <input type="hidden" name="action" value="fakebill-msb">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="ri-checkbox-circle-line me-2"></i>Tạo Bill Ngay</button>&ensp;
                                    <button type="button" class="btn btn-danger clear-form"><i
                                            class="ri-refresh-line me-2"></i>Làm Mới</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- View Bill Form -->
            <div class="col-md-3 d-none d-md-block">
                <div class="kq-bill text-center">
                    <img src="/<?=__IMG__?>/demo/msb.png" alt="MSB" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>