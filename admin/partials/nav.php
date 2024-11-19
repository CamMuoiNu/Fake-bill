<nav id="sidebar" aria-label="Main Navigation">
            <div class="content-header">
                <a class="fw-semibold text-dual" data-pjax href="/admin/">
					<span class="smini-visible">
						<i class="fa fa-circle-notch text-primary"></i>
					</span>
                    <span class="smini-hide fs-5 tracking-wider">Administrator</span>
                </a>
                <div>
                    <button type="button" class="btn btn-sm btn-alt-secondary" onclick="layer.msg('Thay đổi màu nền thành công');" data-toggle="layout" data-action="dark_mode_toggle">
                        <i class="far fa-moon"></i>
                    </button>
                    <div class="dropdown d-inline-block ms-1">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-paint-brush"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0" aria-labelledby="sidebar-themes-dropdown">
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium active" data-toggle="theme" data-theme="default" href="#">
                                <span>Default</span>
                                <i class="fa fa-circle text-default"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="../assets/oneui/css/themes/amethyst.min-5.5.css" href="#">
                                <span>Amethyst</span>
                                <i class="fa fa-circle text-amethyst"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="../assets/oneui/css/themes/city.min-5.5.css" href="#">
                                <span>City</span>
                                <i class="fa fa-circle text-city"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="../assets/oneui/css/themes/flat.min-5.5.css" href="#">
                                <span>Flat</span>
                                <i class="fa fa-circle text-flat"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="../assets/oneui/css/themes/modern.min-5.5.css" href="#">
                                <span>Modern</span>
                                <i class="fa fa-circle text-modern"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme" data-theme="../assets/oneui/css/themes/smooth.min-5.5.css" href="#">
                                <span>Smooth</span>
                                <i class="fa fa-circle text-smooth"></i>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_light" href="javascript:void(0)">
                                <span>Sidebar Light</span>
                            </a>
                            <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_dark" href="javascript:void(0)">
                                <span>Sidebar Dark</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_light" href="javascript:void(0)">
                                <span>Header Light</span>
                            </a>
                            <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_dark" href="javascript:void(0)">
                                <span>Header Dark</span>
                            </a>
                        </div>
                    </div>
                    <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                        <i class="fa fa-fw fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="js-sidebar-scroll" data-simplebar="init">
                <div class="simplebar-wrapper" style="margin: 0px;">
                    <div class="simplebar-height-auto-observer-wrapper">
                        <div class="simplebar-height-auto-observer"></div>
                    </div>
                    <div class="simplebar-mask">
                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                            <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden;">
                                <div class="simplebar-content" style="padding: 0px;">
                                    <div class="content-side" id="nav-main">
                                        <ul class="nav-main">
                                            <li class="nav-main-heading">Index</li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="/admin/">
                                                    <i class="nav-main-link-icon fa fa-house-user"></i>
                                                    <span class="nav-main-link-name"><b>Trang Chủ</b></span>
                                                </a>
                                            </li>
                                            <li class="nav-main-heading">Manage</li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="/admin/quan-ly/thanh-vien">
                                                    <i class="nav-main-link-icon fa fa-users"></i>
                                                    <span class="nav-main-link-name"><b>Quản Lý Thành Viên</b></span>
                                                </a>
                                            </li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="/admin/quan-ly/goi-dang-ky">
                                                    <i class="nav-main-link-icon fa fa-star"></i>
                                                    <span class="nav-main-link-name"><b>Quản Lý Gói VIP</b></span>
                                                </a>
                                            </li>
                                            <li class="nav-main-heading">System</li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu"
                                                   aria-haspopup="true" aria-expanded="false" href="#">
                                                    <i class="nav-main-link-icon fa fa-cog"></i>
                                                    <span class="nav-main-link-name">Cài đặt hệ thống</span>
                                                </a>
                                                <ul class="nav-main-submenu">
                                                    <li class="nav-main-item">
                                                        <a class="nav-main-link" data-pjax href="/admin/settings">
                                                            <span class="nav-main-link-name">Cài đặt thông tin trang web</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-main-heading">Other</li>
                                            <li class="nav-main-item">
                                                <a class="nav-main-link" href="/oauth/dang-xuat" onclick="return confirm('Bạn có chắc chắn bạn muốn thoát?')">
                                                    <i class="nav-main-link-icon fa fa-sign-out"></i>
                                                    <span class="nav-main-link-name"><b>Đăng xuất</b></span>
                                                </a>
                                            </li><!--
                                            <li class="nav-main-heading text-center">- Mã nguồn được phát triển bởi ThanhDieu.Com -</li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="simplebar-placeholder" style="width: auto; height: 735px;"></div>
                </div>
                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                </div>
                <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                    <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                </div>
            </div>
        </nav>
        <header id="page-header">
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                        <i class="fa fa-fw fa-ellipsis-v"></i>
                    </button>
                </div>
                <div class="d-flex align-items-center">
                    <div class="dropdown d-inline-block ms-2">
                        <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle" src="https://i.imgur.com/jewF0Td.jpeg" alt="Admin Avatar" style="width: 25px;height:25px;object-fit:cover;">
                            <span class="d-none d-sm-inline-block ms-2"><?=THANHDIEU($user['username']);?></span>
                            <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1 mt-1"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
                            <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                                <img class="img-avatar img-avatar48 img-avatar-thumb" style="object-fit:cover;" src="https://i.imgur.com/jewF0Td.jpeg" alt="Admin Avatar">
                                <p class="mt-2 mb-0 fw-medium"><?=THANHDIEU($user['username']);?></p>
                                <p class="mb-0 text-muted fs-sm fw-medium">Web <?=THANHDIEU($user['username']);?>,Developer</p>
                            </div>
                            <div class="p-2">
                                <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" href="/oauth/dang-xuat" onclick="return confirm('Bạn có chắc chắn bạn muốn thoát?')">
                                    <span>Đăng xuất</span>
                                    <i class="fa fa-fw fa-sign-out-alt opacity-25"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="page-header-loader" class="overlay-header bg-body-extra-light">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                    </div>
                </div>
            </div>
        </header>