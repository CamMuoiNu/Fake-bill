<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo ">
                <a href="/" class="app-brand-link">
                    <img width="200px" src="" alt="Logo <?=$TD->Setting('name-site')?>">
                    <!-- <span class="app-brand-text demo menu-text fw-bold ms-2"><?=$TD->Setting('name-site')?></span> -->
                </a>
                <!-- <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
                    <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
                </a> -->
            </div>
            <div class="menu-divider mt-0"></div>
            <div class="menu-inner-shadow"></div>
            <ul class="menu-inner py-1">
                <!-- Home -->
                <li class="menu-item">
                    <a href="/" class="menu-link">
                        <img class="ws-icon menu-icon" src="/<?=__IMG__?>/icon/menu/home.png" alt="Ws Icon Menu">
                        Trang Chủ
                    </a>
                </li>
                <li class="menu-header small text-uppercase"><span class="menu-header-text" data-i18n="Charts & Maps">—
                        Dịch
                        Vụ —</span></li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <img class="ws-icon menu-icon" src="/<?=__IMG__?>/icon/menu/bank.png" alt="Ws Icon Menu">
                        <span>Hệ Thống Fake Bill</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="/fake-bill-chuyen-khoan" class="menu-link">
                                <span>Fake Bill Chuyển Khoản</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/fake-so-du" class="menu-link">
                                <span>Fake Số Dư Ngân Hàng</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/fake-bien-dong-so-du/fake-bdsd" class="menu-link">
                                <span>Fake Biến Động Số Dư</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Dich Vu -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <img class="ws-icon menu-icon" src="/<?=__IMG__?>/icon/menu/card.png" alt="Ws Icon Menu">
                        <span>Hệ Thống Fake CCCD</span>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                <span>Fake CCCD</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#" class="menu-link">
                                <span>Fake CMND</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="/thue-goi" class="menu-link">
                        <img class="ws-icon menu-icon" src="/<?=__IMG__?>/icon/menu/shop.png" alt="Ws Icon Menu">
                        <span>Thuê Gói VIP</span>
                    </a>
                </li>
                <?php if ($isLogin->TD($taikhoan, $user)): ?>
                <li class="menu-item">
                    <a href="/nap-tien" class="menu-link">
                        <img class="ws-icon menu-icon" src="/<?=__IMG__?>/icon/menu/deposit.png" alt="Ws Icon Menu">
                        <span>Nạp Tiền</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/lich-su-nap-tien" class="menu-link">
                        <img class="ws-icon menu-icon" src="/<?=__IMG__?>/icon/menu/htr-payment.png" alt="Ws Icon Menu">
                        <span>Lịch Sử Nạp Tiền</span>
                    </a>
                </li>
                <?php endif;?>
                <!-- Other -->
                <li class="menu-header small text-uppercase"><span class="menu-header-text" data-i18n="Misc">— Khác
                        —</span>
                </li>
                <li class="menu-item">
                    <a href="<?= $TD->Setting('telegram') ?>" target="_blank" class="menu-link">
                        <img class="ws-icon menu-icon" src="/<?=__IMG__?>/icon/menu/support.png" alt="Ws Icon Menu">
                        <span>Liên Hệ Hỗ Trợ</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/faq" class="menu-link">
                        <img class="ws-icon menu-icon" src="/<?=__IMG__?>/icon/menu/faq.png" alt="Ws Icon Menu">
                        <span>Hướng Dẫn - FAQ</span>
                    </a>
                </li>
                <?php if ($isLogin->TD($taikhoan,$user)): ?>
                <li class="menu-item">
                    <a href="/oauth/dang-xuat" class="menu-link log-out">
                        <img class="ws-icon menu-icon" src="/<?=__IMG__?>/icon/menu/logout.png" alt="Ws Icon Menu"
                            width="100">
                        <span>Đăng Xuất</span>
                    </a>
                </li>
                <?php endif;?>
            </ul>
            <?php if ($isLogin->TD($taikhoan,$user)): ?>
                <div class="nav-sodu d-none d-md-block">
                <div class="mx-3 mt-3">
                    <div class="card bg-primary-subtle mb-0 fixed-profile">
                        <div class="card-body p-4 ">
                            <div class="d-flex align-items-center justify-content-between gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="/<?= __IMG__ ?>/<?= $user['avatar']?? 'default-avatar.webp' ?>" width="45"
                                        height="45" class="rounded-circle" alt="spike-img">
                                    <div>
                                        <h5 style="font-size:15px;" class="mb-1 text-primary"><?=$user['username']?>
                                        </h5>
                                        <?php if($plans->TD('tengoi', $taikhoan)):?>
                                        <p class="mb-0 text-secondary">Gói:
                                            <b><?=strtoupper($plans->TD('tengoi', $taikhoan))?></b>
                                        </p>
                                        <?php else:?>
                                        <p class="mb-0 text-secondary">Gói:
                                            <b>Không</b>
                                        </p>
                                        <?php endif?>
                                    </div>
                                </div>
                                <a href="javascript:void();" class="position-relative log-out" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Đăng xuất">
                                    <i class="ri-logout-circle-r-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <span class="btn btn-success mb-10 waves-effect waves-light text-center">Số Dư:
                                <?=THANHDIEU(FormatNumber::TD($user['sodu'],2))?> VND</span> -->
            </div>
            <?php endif;?>
        </aside>
        <!-- / Menu -->
        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                <div class="container-fluid">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none ">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Style Switcher -->
                            <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <i class='bx bx-sm'></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                            <span class="align-middle"><i class='bx bx-sun me-2'></i>Chế độ sáng</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                            <span class="align-middle"><i class="bx bx-moon me-2"></i>Chế độ tối</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                            <span class="align-middle"><i class="bx bx-desktop me-2"></i>Mặc định</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>&ensp;
                            <!-- / Style Switcher-->
                            <?php if ($isLogin->TD($taikhoan, $user)): ?>
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="/<?= __IMG__ ?>/<?= $user['avatar']?? 'default-avatar.webp' ?>" alt
                                            class="rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="/user/">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-<? $taikhoan ? 'online' : 'offline'?>">
                                                        <img src="/<?= __IMG__ ?>/<?= $user['avatar'] ?? 'default-avatar.webp'?>"
                                                            alt class="rounded-circle">

                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span
                                                        class="fw-medium d-block lh-1"><?=$user['username']??'Tài khoản khách'?></span>
                                                    <small
                                                        style="text-transform:uppercase;font-size:12px;"><?=$user['rank']??'MEMBERS'?></small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/user/">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">Tài Khoản</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void();">
                                            <i class='bx bx-money me-2'></i>
                                            <span class="align-middle">Số Dư:
                                                <?= FormatNumber::TD($user['sodu']??'0') ?>đ</span>
                                        </a>
                                    </li>
                                    <?php if (isset($user['rank']) && $user['rank'] == 'admin') { ?>
                                    <li>
                                        <a class="dropdown-item" target="_blank" href="/admin">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="ri-settings-3-line me-2"></i>
                                                <span class="flex-grow-1 align-middle">&nbsp;Trang Quản Trị</span>
                                            </span>
                                        </a>
                                    </li>
                                    <?php } else {?>
                                    <li>
                                        <a class="dropdown-item" href="/nap-tien">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                <span class="flex-grow-1 align-middle">Nạp Tiền</span>
                                            </span>
                                        </a>
                                    </li>
                                    <?php }?>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item log-out" href="javascript:void();">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Đăng Xuất</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                            <?php else: ?>
                            <a href="/oauth/dang-nhap?redirect=<?=urlencode($actual_link)?>"
                                class="btn btn-primary btn-sm d-none d-md-block">
                                <span class="tf-icons bx bx-user me-md-1"></span>
                                <span>Đăng nhập</span>
                            </a>
                            <?php endif; ?>
                            <?php if (!$isLogin->TD($taikhoan, $user)): ?>
                            <li class="d-md-none">
                                <a class="dropdown-item" href="/oauth/dang-nhap?redirect=<?=urlencode($actual_link)?>">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-offline">
                                                <img src="/<?= __IMG__ ?>/default-avatar.webp" alt
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <span class="fw-medium d-block lh-1"></span>
                                            <small style="text-transform:uppercase;font-size:12px;"></small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- / Navbar -->