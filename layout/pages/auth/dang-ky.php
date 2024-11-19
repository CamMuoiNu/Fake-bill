<?php
$options_header = ['title' => 'Đăng Ký Tài Khoản','description' => 'Chào mừng bạn đến với trang đăng ký, bắt đầu đăng ký để sử dụng dịch vụ của chúng tôi!',];
require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/global/isLoginModel.php');?>
<style>a{color: #7367f0!important;text-decoration:none;}</style>
<div class="authentication-wrapper authentication-cover">
    <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center">
            <div class="flex-row text-center mx-auto ws-banner-auth">
                <img src="https://i.imgur.com/ba0NmLv.png" alt="Auth Cover Bg color" width="720"
                    class="img-fluid authentication-cover-img">
            </div>
        </div>
        <!-- /Left Text -->
        <!-- Register -->
        <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-5 p-4">
            <div class="w-px-400 mx-auto">
                <!-- Logo -->
                <div class="app-brand mb-4">
                    <a href="/" class="app-brand-link gap-2 mb-2">
                        <img class="wusteam-logo" src="/<?=__IMG__?>/logo.png"
                            alt="Logo <?=$TD->Setting('name-site')?>">
                        <span class="app-brand-text demo h3 mb-0 fw-bold"><?=$TD->Setting('name-site')?></span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Start with us <?=$TD->Setting('name-site');?> 🚀</h4>
                <p class="mb-4">Bắt đầu sử dụng dịch vụ bằng cách đăng ký tài khoản mới</p>
                <form class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework user-auth-register">
                <input type="hidden" name="action" value="user-auth-register">
                    <div class="wusteam-alert"></div>
                    <div class="mb-3 fv-plugins-icon-container">
                        <label for="username" class="form-label">Tài khoản</label>
                        <input type="text" class="form-control" name="username" placeholder="Nhập tên tài khoản"
                            autofocus="" autocomplete="off" required>
                    </div>
                    <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <div class="input-group input-group-merge has-validation">
                            <input type="password" class="form-control" name="password" placeholder="············"
                                aria-describedby="password" autocomplete="off" required>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                        <label for="repeat-password" class="form-label">Nhập Lại Mật Khẩu</label>
                        <div class="input-group input-group-merge has-validation">
                            <input type="password" class="form-control" name="repeat-password"
                                placeholder="············" aria-describedby="password" autocomplete="off" required>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div> 
                    <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                        <div class="input-group input-group-merge has-validation ws-captcha"></div>
                    </div>
                    <div class="mb-3 fv-plugins-icon-container">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terms">
                            <label class="form-check-label" for="terms">
                             Tôi đồng ý với
                                <a href="javascript:void(0);">chính sách &amp; điều khoản</a>
                            </label>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng Ký Ngay</button>
                </form>
                <p class="text-center">
                    <span>Đã có tài khoản?</span>
                    <a href="<?=Redirect::Login()?>">
                        <span>Đăng nhập ngay</span>
                    </a>
                </p>
            </div>
        </div>
        <!-- /Register -->
    </div>
</div>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>