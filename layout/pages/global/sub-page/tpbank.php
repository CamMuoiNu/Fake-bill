<?php $options_header = ['title' => 'Tạo fake bill TP Bank chuyển khoản','og:image'=> 'https://i.imgur.com/b8RGfh1.png'];?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Fake Bill Chuyển Khoản /</span> TP Bank
        </h4>
        <div class="alert alert-warning alert-dismissible" role="alert">
            ⚠️&ensp;Chúng tôi chưa hỗ trợ thay đổi avatar bank, tính năng này sẽ được cập nhật trong thời gian sắp tới.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        <div class="row">
            <div class="col-md-9">
                <form class="hk-tpbank hk-refresh-form" enctype="multipart/form-data">
                    <div class="card mb-4">
                        <h5 class="card-header">
                            <i class="ri-bank-fill me-2"></i>Tạo Bill TP Bank
                        </h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="tennguoichuyen" data-limit-text="30" class="form-label">Tên Người
                                    Chuyển</label>
                                <input type="text" class="form-control td-format-text" name="tennguoichuyen"
                                    placeholder="VUONG THANH DIEU" required>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="anhdaidien" class="form-label">Avatar Người Chuyển</label>
                                <input class="form-control" type="file" name="anhdaidien" accept="image/png,image/jpeg,image/jpg">
                            </div> -->
                            <div class="mb-3">
                                <label for="tennguoinhan" data-limit-text="30" class="form-label">Tên Người Nhận</label>
                                <input type="text" class="form-control td-format-text" name="tennguoinhan"
                                    placeholder="VUONG THANH DIEU" required>
                            </div>
                            <div class="mb-3">
                                <label for="stk" data-limit-text="17" class="form-label">Số Tài Khoản Người
                                    Chuyển</label>
                                <input type="text" data-td-msg="Số tài khoản phải là một con số!"
                                    class="form-control td-format-number" name="stk_nc"
                                    placeholder="Ví dụ: 10<?= random_int(10000000, 999999999) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="stk" data-limit-text="17" class="form-label">Số Tài Khoản Người Nhận</label>
                                <input type="text" data-td-msg="Số tài khoản phải là một con số!"
                                    class="form-control td-format-number" name="stk"
                                    placeholder="Ví dụ: 10<?= random_int(10000000, 999999999) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="sotienchuyen" data-limit-text="11" class="form-label">Số Tiền Chuyển</label>
                                <input type="text" data-td-msg="Số tiền chuyển phải là một con số!"
                                    class="form-control td-format-money" name="sotienchuyen"
                                    placeholder="Ví dụ: 100,000,000" required>
                            </div>
                            <div class="mb-3">
                                <label for="nganhangnhan" class="form-label">Ngân Hàng Nhận</label>
                                <select class="form-select" name="nganhangnhan" aria-label="Chọn Ngân Hàng" required>
                                    <option value="vtd">--- Chọn Ngân Hàng ---</option>
                                    <option value="vietinbank">VietinBank</option>
                                    <option value="vietcombank">Vietcombank</option>
                                    <option value="bidv">BIDV</option>
                                    <option value="tpbank">TPBank</option>
                                    <option value="techcombank">Techcombank</option>
                                    <option value="agribank">Agribank</option>
                                    <option value="ocb">OCB</option>
                                    <option value="mbbank">MBBank</option>
                                    <option value="acb">ACB</option>
                                    <option value="vpbank">VPBank</option>
                                    <option value="sacombank">Sacombank</option>
                                    <option value="shb">SHB</option>
                                    <option value="saigonbank">SaigonBank</option>
                                    <option value="oceanbank">Oceanbank</option>
                                    <option value="vietabank">VietABank</option>
                                    <option value="namabank">NamABank</option>
                                    <option value="vietbank">VietBank</option>
                                    <option value="dongabank">DongABank</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="thoigianchuyen" data-limit-text="27" class="form-label">Thời Gian
                                    Chuyển</label>
                                <input type="text" class="form-control" name="thoigianchuyen"
                                    value="<?=date('H:i:s, \N\g\à\y\ d/m/Y')?>"
                                    placeholder="Ví dụ: <?=date('H:i:s, \N\g\à\y\ d/m/Y')?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="thoigiantrendt" data-limit-text="5" class="form-label">Thời Gian Trên
                                    ĐT</label>
                                <input type="text" class="form-control" name="thoigiantrendt" value="<?= date('H:i') ?>"
                                    placeholder="Ví dụ: 00:00" required>
                            </div>
                            <div class="mb-3">
                                <label for="magiaodich" data-limit-text="20" class="form-label">Mã Giao Dịch</label>
                                <input type="text" class="form-control" name="magiaodich"
                                    value="<?=WsRandomString::TD2(16)?>"
                                    placeholder="Ví dụ: <?=WsRandomString::TD2(16)?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" data-limit-text="30" or="noidungchuyen">Nội Dung
                                    Chuyển</label>
                                <textarea class="form-control" name="noidungchuyen" rows="1" placeholder="Ví dụ: VUONG THANH DIEU
chuyen tien" required>NGUYEN VAN A chuyen tien</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="cachthucchuyen" data-limit-text="30" class="form-label">Cách Thức
                                    Chuyển</label>
                                <input type="text" class="form-control" name="cachthucchuyen"
                                    value="Chuyển nhanh Napas 247" placeholder="Ví dụ: Chuyển nhanh Napas 247" required>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <input type="hidden" name="action" value="fakebill-tpbank">
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
                    <img data-fancybox src="/<?=__IMG__?>/demo/tpbank.png" alt="TP Bank" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>