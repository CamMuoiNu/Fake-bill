<?php $options_header = ['title' => 'Thông Tin Tài Khoản']; ?>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/head.php'); ?>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/nav.php'); ?>
<?php if ($taikhoan == null) {
    die('<meta http-equiv="refresh" content="0;url=/oauth/dang-nhap">');
} ?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Thông Tin Cá Nhân /</span> @<?= $user['username'] ?? 'Tài khoản khách' ?>
        </h4>
        <div class="row fv-plugins-icon-container">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header"><i class="ri-user-line me-2"></i>Thông Tin Của Bạn</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="/<?= __IMG__ . '/' . $user['avatar'] ?? 'default-avatar.webp'?>" alt="user-avatar"
                                class="d-block rounded-circle" height="100" width="100">
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                <label for="firstName" class="form-label">Tên Đăng Nhập</label>
                                <input class="form-control" type="text" value="<?= $user['username'] ?? 'Tài khoản khách' ?>" disabled>
                            </div>
                            <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                <label for="" class="form-label">Địa Chỉ E-mail</label>
                                <input class="form-control" type="text"
                                    value="<?= valid_email($user['email']) ? $user['email'] : 'Chưa xác minh' ?>"
                                    disabled>
                            </div>
                            <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                <label for="" class="form-label">Số Dư Khả Dụng</label>
                                <input class="form-control" type="text" value="<?= FormatNumber::TD($user['sodu']) ?>đ"
                                    disabled>
                            </div>
                            <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                <label for="" class="form-label">Tổng Nạp</label>
                                <input class="form-control" type="text"
                                    value="<?= FormatNumber::TD($user['tongnap']) ?>đ" disabled>
                            </div>
                            <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                <label for="" class="form-label">Tổng Tiêu</label>
                                <input class="form-control" type="text"
                                    value="<?= FormatNumber::TD($user['tongtieu']) ?>đ" disabled>
                            </div>
                            <div class="mb-3 col-md-6 fv-plugins-icon-container">
                                <label for="" class="form-label">Ngày Đăng Ký</label>
                                <input class="form-control" type="text"
                                    value="<?= FormatTime::TD($user['ngaythamgia'], 1) ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <!-- /Account -->
                </div>
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header"><i class="ri-code-s-slash-line me-2"></i>API Key - Access</h5>
                        <div class="card-body">
                            <p>Khóa API này là một chuỗi mã hóa dùng để xác minh quyền truy cập mà không cần thông qua bất kỳ nguyên tắc nào. Với api key này bạn có thể truy cập và kết nối các dịch vụ có trên nền tảng này.</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="bg-lighter rounded p-3 mb-3 position-relative">
                                        <div class="dropdown api-key-actions">
                                            <a class="btn dropdown-toggle text-muted hide-arrow p-0"
                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                    class="bx bx-dots-vertical-rounded"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a href="javascript:;" class="dropdown-item change-apikey"><i class="ri-refresh-line me-2"></i>Thay đổi</a>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center flex-wrap mb-3">
                                            <h4 class="mb-0 me-3">Access Key</h4>
                                            <span class="badge bg-label-primary">ĐÃ KÍCH HOẠT</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="me-3"><span
                                                    class="fw-medium" id="api-key"><?=$user['access_key']?></span></span>
                                            <span class="text-light cursor-pointer" data-ws-copy="<?=$user['access_key'] ?? 'WusThanhDieu'?>"><i class="bx bx-copy"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header"><i class="ri-lock-2-line me-2"></i>Đổi Mật Khẩu</h5>
                        <div class="row">
                            <div class="col-md-5 order-md-0 order-1">
                                <div class="card-body">
                                    <form class="user-change-password fv-plugins-bootstrap5 fv-plugins-framework">
                                        <input type="hidden" name="action" value="user-change-password">
                                        <div class="row fv-plugins-icon-container">
                                            <div class="mb-3 col-12">
                                                <label class="form-label" for="password-old">Mật Khẩu Hiện Tại</label>
                                                <div
                                                    class="input-group input-group-merge has-validation form-password-toggle">
                                                    <input class="form-control" type="password" autocomplete="off"
                                                        name="password-old" placeholder="············" required>
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="bx bx-hide"></i></span>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label" for="password-new">Mật Khẩu Mới</label>
                                                <div
                                                    class="input-group input-group-merge has-validation form-password-toggle">
                                                    <input class="form-control" type="password" name="password-new"
                                                        placeholder="············" autocomplete="off" required>
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="bx bx-hide"></i></span>
                                                </div>
                                            </div>
                                            <div class="mb-3 col-12">
                                                <label class="form-label" for="password-new-again">Nhập Lại Mật Khẩu
                                                    Mới</label>
                                                <div
                                                    class="input-group input-group-merge has-validation form-password-toggle">
                                                    <input class="form-control" type="password"
                                                        name="password-new-again" autocomplete="off"
                                                        placeholder="············" required>
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="bx bx-hide"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-4">
                                                <p class="fw-medium mt-2">Yêu cầu mật khẩu:</p>
                                                <ul class="ps-3 mb-0">
                                                    <li class="mb-1">
                                                        Tối thiểu 6 ký tự - càng nhiều càng tốt
                                                    </li>
                                                    <li class="mb-1">Ít nhất một ký tự chữ thường</li>
                                                    <li>Ít nhất một số, ký hiệu, kí tự đặc biệt</li>
                                                </ul>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-2 w-100">Đổi Mật
                                                    Khẩu</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-7 order-md-1 order-0">
                                <div class="text-center mt-md-n4 mx-3 mx-md-0">
                                    <img src="/<?= __IMG__ ?>/icon/front-pages/change-pw.png" class="img-fluid"
                                        alt="Api Key Image" width="600">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card">
                    <h5 class="card-header">Xoá Tài Khoản</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading mb-1">Bạn có chắc rằng bạn muốn xóa tài khoản của bạn?</h6>
                                <p class="mb-0">Một khi bạn xóa tài khoản của mình, sẽ không có cách nào khôi phục lại được nữa. Hãy cân nhắc.
                                </p>
                            </div>
                        </div>
                        <form class="fv-plugins-bootstrap5 fv-plugins-framework">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name=""
                                    id="">
                                <label class="form-check-label" for="">Tôi chấp nhận xoá tài khoản của mình</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Xoá Tài Khoản</button>
                            <input type="hidden">
                        </form>
                    </div>
                </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>