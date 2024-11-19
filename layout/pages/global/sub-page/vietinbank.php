<?php $options_header = ['title' => 'Tạo fake bill Vietinbank chuyển khoản','og:image'=> 'https://i.imgur.com/inw4IWy.png'];?>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/head.php'); ?>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/nav.php'); ?> <div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Fake Bill Chuyển Khoản /</span> Vietinbank
        </h4>
        <div class="row">
            <div class="col-md-9">
                <form class="hk-vietinbank hk-refresh-form">
                    <div class="card mb-4">
                        <h5 class="card-header">
                            <i class="ri-bank-fill me-2"></i>Tạo Bill Vietinbank
                        </h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="tennguoichuyen" data-limit-text="23" class="form-label">Tên Người
                                    Chuyển</label>
                                <input type="text" class="form-control td-format-text" name="tennguoichuyen"
                                    placeholder="VUONG THANH DIEU" required>
                            </div>
                            <div class="mb-3">
                                <label for="tennguoinhan" data-limit-text="23" class="form-label">Tên Người Nhận</label>
                                <input type="text" class="form-control td-format-text" name="tennguoinhan"
                                    placeholder="VUONG THANH DIEU" required>
                            </div>
                            <div class="mb-3">
                                <label for="sotienchuyen" data-limit-text="11" class="form-label">Số Tiền Chuyển</label>
                                <input type="text" data-td-msg="Số tiền chuyển phải là một con số!"
                                    class="form-control td-format-money" name="sotienchuyen"
                                    placeholder="Ví dụ: 100,000,000" required>
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
                                <label for="nganhangnhan" class="form-label">Ngân Hàng Nhận</label>
                                <select class="form-select" name="nganhangnhan" aria-label="Chọn Ngân Hàng" required>
                                    <option value="vtd">--- Chọn Ngân Hàng ---</option>
                                    <option value="Ngân hàng TMCP Công Thương Việt Nam">VietinBank</option>
                                    <option value="Ngân hàng TMCP Ngoại thương Việt Nam">Vietcombank</option>
                                    <option value="Ngân hàng Đầu tư và phát triển Việt Nam">BIDV</option>
                                    <option value="Ngân hàng Nông thôn Việt Nam">Agribank</option>
                                    <option value="Ngân hàng TMCP Phương Đông">OCB</option>
                                    <option value="Ngân hàng Quân đội">MBBank</option>
                                    <option value="Ngân hàng TMCP Á Châu">ACB</option>
                                    <option value="Ngân hàng TMCP Việt Nam Thịnh Vượng">VPBank</option>
                                    <option value="Ngân hàng Thương mại Cổ phần Tiên Phong">TPBank</option>
                                    <option value="Ngân hàng TMCP Sài Gòn Thương Tín">Sacombank</option>
                                    <option value="Ngân hàng TMCP Sài Gòn-Hà Nội">SHB</option>
                                    <option value="Ngân hàng TMCP Sài Gòn Công Thương">SaigonBank</option>
                                    <option value="Ngân hàng Thương mại Oceanbank">Oceanbank</option>
                                    <option value="Ngân hàng Thương mại Cổ phần Việt Á">VietABank</option>
                                    <option value="Ngân hàng TMCP Nam Á">NamABank</option>
                                    <option value="Ngân hàng TMCP Việt Nam Thương Tín"> VietBank</option>
                                    <option value="Ngân hàng TMCP Đông Á">DongABank</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="thoigianchuyen" data-limit-text="27" class="form-label">Thời Gian
                                    Chuyển</label>
                                <input type="text" class="form-control" name="thoigianchuyen"
                                    value="<?=date('d/m/Y H:i');?>" placeholder="Ví dụ: <?=date('d/m/Y H:i');?>"
                                    required>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="thoigiantrendt" data-limit-text="5" class="form-label">Thời Gian Trên
                                    ĐT</label>
                                <input type="text" class="form-control" name="thoigiantrendt" value="<?= date('H:i') ?>" placeholder="Ví dụ: 00:00" required>
                            </div> -->
                            <div class="mb-3">
                                <label for="phigiaodich" data-limit-text="10" class="form-label">Phí Giao Dịch</label>
                                <input type="text" class="form-control" name="phigiaodich" value="Miễn phí"
                                    placeholder="Ví dụ: Miễn phí" required>
                            </div>
                            <div class="mb-3">
                                <label for="magiaodich" data-limit-text="20" class="form-label">Mã Giao Dịch</label>
                                <input type="text" class="form-control" name="magiaodich"
                                    value="<?=WsRandomString::TD(16)?>"
                                    placeholder="Ví dụ: <?=WsRandomString::TD(16)?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" data-limit-text="30" or="noidungchuyen">Nội Dung
                                    Chuyển</label>
                                <textarea class="form-control" name="noidungchuyen" rows="3" placeholder="Ví dụ: VUONG THANH DIEU
chuyen tien" required>NGUYEN VAN A chuyen tien</textarea>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <input type="hidden" name="action" value="fakebill-vietinbank">
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
                    <img data-fancybox src="/<?=__IMG__?>/demo/vietinbank.png" alt="Vietinbank" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>