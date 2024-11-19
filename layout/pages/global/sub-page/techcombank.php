<?php $options_header = ['title' => 'Tạo fake bill Techcombank chuyển khoản','og:image'=> 'https://i.imgur.com/TloKTFb.png'];?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Fake Bill Chuyển Khoản /</span> Techcombank
        </h4>
        <div class="row">
            <div class="col-md-9">
                <form class="hk-techcombank hk-refresh-form">
                    <div class="card mb-4">
                        <h5 class="card-header">
                            <i class="ri-bank-fill me-2"></i>Tạo Bill Techcombank
                        </h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="tennguoinhan" data-limit-text="30" class="form-label">Tên Người Nhận</label>
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
                                    <option value="Ngân hàng TMCP Đông Nam Á">SeaBank</option>
                                    <option value="Ngân hàng Nông nghiệp và Phát triển nông thôn Việt Nam">Agribank</option>
                                    <option value="Ngân hàng TMCP Phương Đông">OCB</option>
                                    <option value="Ngân hàng TMCP Quân đội">MBBank</option>
                                    <option value="Ngân hàng TMCP Á Châu">ACB</option>
                                    <option value="Ngân hàng TMCP Việt Nam Thịnh Vượng">VPBank</option>
                                    <option value="Ngân hàng TMCP Tiên Phong">TPBank</option>
                                    <option value="Ngân hàng TMCP Sài Gòn Thương Tín">Sacombank</option>
                                    <option value="Ngân hàng TMCP Sài Gòn Hà Nội">SHB</option>
                                    <option value="Ngân hàng TMCP Sài Gòn Công Thương">SaigonBank</option>
                                    <option value="Ngân hàng Thương mại Đại Dương">Oceanbank</option>
                                    <option value="Ngân hàng TMCP Việt Á">VietABank</option>
                                    <option value="Ngân hàng TMCP Nam Á">NamABank</option>
                                    <option value="Ngân hàng TMCP Đông Á">DongABank</option>
                                    <option value="Ngân hàng TMCP Việt Nam Thương Tín">VietBank</option>
                                    <option value="Ngân hàng TMCP Sài Gòn">SCB</option>
                                    <option value="Ngân hàng TMCP Quốc tế Việt Nam">VIB</option>
                                    <option value="Ngân hàng TMCP Hàng Hải Việt Nam">MSB</option>
                                    <option value="Ngân hàng TMCP Lộc Phát Việt Nam">LPB</option>
                                    <option value="Ngân hàng TMCP An Bình">ABBank</option>
                                    <option value="Ngân hàng TMCP Quốc Dân">NCB</option>
                                    <option value="Ngân Hàng TMCP Thịnh vượng và Phát triển">PGB</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="thoigianchuyen" data-limit-text="27" class="form-label">Thời Gian
                                    Chuyển</label>
                                <input type="text" class="form-control" name="thoigianchuyen"
                                    value="<?=date('j \t\h\g n, Y \lú\c H:i');?>"
                                    placeholder="Ví dụ: <?=date('j \t\h\g n, Y \lú\c H:i');?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="thoigiantrendt" data-limit-text="5" class="form-label">Thời Gian Trên
                                    ĐT</label>
                                <input type="text" class="form-control" name="thoigiantrendt" value="<?= date('H:i') ?>"
                                    placeholder="Ví dụ: 00:00" required>
                            </div>
                            <div class="mb-3">
                                <label for="magiaodich" data-limit-text="15" class="form-label">Mã Giao Dịch</label>
                                <input type="text" class="form-control" name="magiaodich"
                                    value="FT<?=random_int(1000000000,99999999999)?>"
                                    placeholder="Ví dụ: FT<?= random_int(100000000,99999999999)?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="mathamchieu" data-limit-text="6" class="form-label">Mã Tham Chiếu</label>
                                <input type="text" class="form-control" name="mathamchieu"
                                    value="<?=random_int(10000,999999) ?>"
                                    placeholder="Ví dụ: <?=random_int(10000,999999)?>" required >
                            </div>
                            <div class="mb-3">
                                <label class="form-label" data-limit-text="30" or="noidungchuyen">Nội Dung
                                    Chuyển</label>
                                <textarea class="form-control" name="noidungchuyen" rows="3" placeholder="Ví dụ: VUONG THANH DIEU
chuyen tien" required>NGUYEN VAN A chuyen tien</textarea>
                            </div>
                            <div class="mb-3">
                            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/dynamics/island.php');?>
                            <div class="d-block d-md-none mt-2"></div>
                            <?php include_once($_SERVER['DOCUMENT_ROOT'].'/function/insert/pin/dark.php');?>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <input type="hidden" name="action" value="fakebill-techcombank">
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
                    <img data-fancybox src="/<?=__IMG__?>/demo/techcombank.png" alt="Techcombank" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content --> <?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>