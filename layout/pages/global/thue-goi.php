<?php $options_header=['title' => 'Thuê Gói Thành Viên VIP']; ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php'); ?>
<?php $currentPlan = $plans->TD('tengoi', $taikhoan); ?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Dịch Vụ /</span> Thuê Gói
        </h4>
        <section class="section-py bg-body landing-pricing">
            <div class="<?=(!isMobile() ? 'container' : '')?>">
                <h3 class="text-center mb-1">
                    <span class="section-title fw-bold">Gói Đăng Ký</span>
                </h3>
                <p class="text-center mb-4 pb-3">Hãy chọn một gói phù hợp với nhu cầu sử dụng của bạn</p>
                <div class="row gy-4 pt-lg-3">
                    <!-- Basic Plan: Start -->
                    <div class="col-xl-4 col-lg-6">
                        <div class="card <?=($currentPlan == 'vip1' ? 'border border-primary shadow-lg' : '')?>">
                            <div class="card-header">
                                <div class="text-center">
                                    <img src="/<?=__IMG__?>/icon/front-pages/paper-airplane.png"
                                        alt="paper airplane icon" class="mb-4 pb-2 scaleX-n1-rtl">
                                    <h4 class="mb-1">Trải Nghiệm</h4>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span
                                            class="price-yearly h1 text-primary fw-bold mb-0"><?=FormatNumber::TD($TD->Setting('vip1'),2)?>đ</span>
                                        <sub class="h6 text-muted mb-0 ms-1">/day</sub>
                                    </div>
                                    <div class="position-relative pt-2">
                                        <div class="text-muted">Gói VIP 1</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Xoá quảng cáo
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Xoá watermark
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2">
                                                <i class="bx bx-x bx-xs"></i>
                                            </span> Access key (đấu api)
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Tạo bill không giới hạn
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Ưu tiên hỗ trợ
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> HSD: 1 ngày
                                        </h5>
                                    </li>
                                </ul>
                                <div class="d-grid mt-4 pt-3">
                                <?php if ($currentPlan == 'vip1'): ?>
                                    <button data-plan="vip1" class="btn btn-info vip1">Nhấn Để Gia Hạn Thêm</button>
                                    <?php elseif ($currentPlan): ?>
                                    <button disabled class="btn btn-label-primary">Đã Có Gói Không Thể Thuê</button>
                                    <?php else: ?>
                                    <button data-plan="vip1" class="btn btn-label-primary">Thuê Ngay</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Basic Plan: End -->
                    <!-- Favourite Plan: Start -->
                    <div class="col-xl-4 col-lg-6">
                        <div class="card <?=($currentPlan == 'vip2' ? 'border border-primary shadow-lg' : '')?>">
                            <div class="card-header">
                                <div class="text-center">
                                    <img src="/<?=__IMG__?>/icon/front-pages/plane.png" alt="plane icon"
                                        class="mb-4 pb-2 scaleX-n1-rtl">
                                    <h4 class="mb-1">Khuyến Nghị</h4>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span
                                            class="price-yearly h1 text-primary fw-bold mb-0"><?=FormatNumber::TD($TD->Setting('vip2'),2)?>đ</span>
                                        <sub class="h6 text-muted mb-0 ms-1">/month</sub>
                                    </div>
                                    <div class="position-relative pt-2">
                                        <div class="text-muted">Gói VIP 2</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Xoá quảng cáo
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Xoá watermark
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Access key (đấu api)
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Tạo bill không giới hạn
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Ưu tiên hỗ trợ
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> HSD: 30 ngày
                                        </h5>
                                    </li>
                                </ul>
                                <div class="d-grid mt-4 pt-3">
                                <?php if ($currentPlan == 'vip2'): ?>
                                    <button data-plan="vip2" class="btn btn-info vip2">Nhấn Để Gia Hạn Thêm</button>
                                    <?php elseif ($currentPlan): ?>
                                    <button disabled class="btn btn-label-primary">Đã Có Gói Không Thể Thuê</button>
                                    <?php else: ?>
                                    <button data-plan="vip2" class="btn btn-label-primary">Thuê Ngay</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Favourite Plan: End -->
                    <!-- Standard Plan: Start -->
                    <div class="col-xl-4 col-lg-6">
                        <div class="card <?=($currentPlan == 'vip3' ? 'border border-primary shadow-lg' : '')?>">
                            <div class="card-header">
                                <div class="text-center">
                                    <img src="/<?=__IMG__?>/icon/front-pages/shuttle-rocket.png"
                                        alt="shuttle rocket icon" class="mb-4 pb-2 scaleX-n1-rtl">
                                    <h4 class="mb-1">Lâu Dài</h4>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span
                                            class="price-yearly h1 text-primary fw-bold mb-0"><?=FormatNumber::TD($TD->Setting('vip3'),2)?>đ</span>
                                        <sub class="h6 text-muted mb-0 ms-1">/year</sub>
                                    </div>
                                    <div class="position-relative pt-2">
                                        <div class="text-muted">Gói VIP 3</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Xoá quảng cáo
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Xoá watermark
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Access key (đấu api)
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Tạo bill không giới hạn
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> Ưu tiên hỗ trợ
                                        </h5>
                                    </li>
                                    <li>
                                        <h5>
                                            <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2">
                                                <i class="bx bx-check bx-xs"></i>
                                            </span> HSD: 1 năm
                                        </h5>
                                    </li>
                                </ul>
                                <div class="d-grid mt-4 pt-3">
                                    <?php if ($currentPlan == 'vip3'): ?>
                                    <button data-plan="vip3" class="btn btn-info vip3">Nhấn Để Gia Hạn Thêm</button>
                                    <?php elseif ($currentPlan): ?>
                                    <button disabled class="btn btn-label-primary">Đã Có Gói Không Thể Thuê</button>
                                    <?php else: ?>
                                    <button data-plan="vip3" class="btn btn-label-primary">Thuê Ngay</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Standard Plan: End -->
                </div>
            </div>
        </section>
    </div>
</div>
<!-- / Content -->
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>