<?php $options_header = ['title' => 'Đăng Nhập Hệ Thống','description' => 'Chào mừng bạn đến với trang đăng nhập, bắt đầu đăng nhập để sử dụng dịch vụ của chúng tôi!',];
require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/global/isLoginModel.php');?>
<style>a{color: #7367f0!important;text-decoration:none;}</style>
<div class="authentication-wrapper authentication-cover">
    <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center">
            <div class="flex-row text-center mx-auto ws-banner-auth">
                <img src="https://i.imgur.com/ba0NmLv.png" alt="Auth Cover Bg color"
                    class="img-fluid authentication-cover-img">
            </div>
        </div>
        <!-- /Left Text -->
        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                <!-- Logo -->
                <div class="app-brand mb-4">
                    <a href="/" class="app-brand-link gap-2 mb-2">
                       <img class="wusteam-logo" src="/<?=__IMG__?>/logo.png" alt="Logo <?=$TD->Setting('name-site')?>">
                        <span class="app-brand-text demo h3 mb-0 fw-bold"><?=$TD->Setting('name-site')?></span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Welcome to <?=$TD->Setting('name-site')?>! 👋</h4>
                <p class="mb-4">Vui lòng đăng nhập để có thể sử dụng dịch vụ</p>
                <form class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework user-auth-login">
                <input type="hidden" name="action" value="user-auth-login">
                    <div class="wusteam-alert"></div>
                    <div class="mb-3 fv-plugins-icon-container">
                        <label for="username" class="form-label">Email or Tài khoản</label>
                        <input type="text" class="form-control" name="username"
                            placeholder="Nhập email hoặc tài khoản" autofocus="" autocomplete="off" required>
                    </div>
                    <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                    <label for="password" class="form-label">Mật Khẩu</label>
                        <div class="input-group input-group-merge has-validation">
                            <input type="password" class="form-control" name="password"
                                placeholder="············" aria-describedby="password" autocomplete="off" required>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
                </form>
                <p class="text-center">
                    <span>Bạn chưa có tài khoản?</span>
                    <a href="<?=Redirect::Register()?>">
                        <span>Đăng ký ngay</span>
                    </a>
                </p>
                <div class="divider my-4">
                    <div class="divider-text">or</div>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                        <i class="tf-icons bx bxl-facebook"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                        <i class="tf-icons bx bxl-google-plus"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                        <i class="tf-icons bx bxl-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Login -->
    </div>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>