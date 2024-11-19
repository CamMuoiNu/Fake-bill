<?php $options_header = ['title' => 'Hệ thống fakebill - chuyển khoản ngân hàng miễn phí']; ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Hệ Thống Fake Bill /</span> Chuyển Khoản
        </h4>
        <?php if (!in_array($plans->TD('tengoi', $taikhoan), ['vip1', 'vip2', 'vip3'])): ?>
        <?php if (empty($user['rank']) || !in_array($user['rank'], ['admin', 'leader', 'partner'])): ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            ⚠️ <b>Thông báo</b>: Vui lòng cân nhắc nâng cấp tài khoản lên gói thành viên VIP để có thể mở khoá tất cả
            đặc quyền sử dụng mà không bị hạn chế!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <?php elseif (in_array($plans->TD('tengoi', $taikhoan), ['vip1', 'vip2', 'vip3'])): ?>
        <div class="alert alert-info alert-dismissible" role="alert">
            🔥 <b>Gói thành viên <?=strtoupper($plans->TD('tengoi', $taikhoan))?> của bạn sẽ hết hạn vào lúc: </b>
            <b class="text-success"><?=FormatTime::TD($plans->TD('ngayhethan', $taikhoan),1)?></b>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="alert alert-info alert-dismissible" role="alert">
        🎃 Trong quá trình fakebill mà bị lỗi, vui lòng liên hệ cho bộ phận CSKH.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <!-- Cards with few info -->
        <div class="row">
            <!-- Mb Bank New -->
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" style="position:relative;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-MB-Bank-MBB.png" alt="Logo Mbbank">
                                </div>
                                <div class="card-info">
                                    <h5 class="card-title mb-0 me-2">MB Bank <span
                                            class="ws-left badge bg-success text-white badge-notifications">Gói
                                            VIP</span>
                                    </h5>
                                    <small class="text-muted">Ngân hàng Quân đội</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <div class="badge bg-label-secondary me-2 cur-pointer" data-demo-name="mb-bank-new"><i
                                    class="ri-eye-line me-1"></i>Xem
                                demo</div>
                            <a href="/fake-bill/mb-bank-new">
                                <div class="badge bg-label-primary"><i class="ri-arrow-right-line me-1"></i>Tạo Ngay
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vietcombank New-->
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" style="position:relative;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <img src="/<?=__IMG__?>/icon/vietcombank.png" alt="Logo Vietcombank">
                                </div>
                                <div class="card-info">
                                    <h5 class="card-title mb-0 me-2">Vietcombank <span
                                            class="ws-left badge bg-success text-white badge-notifications">Gói
                                            VIP</span>
                                    </h5>
                                    <small class="text-muted">Ngân hàng Vietcombank</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <div class="badge bg-label-secondary me-2 cur-pointer" data-demo-name="vietcombank-new"><i
                                    class="ri-eye-line me-1"></i>Xem
                                demo</div>
                            <a href="/fake-bill/vietcombank-new">
                                <div class="badge bg-label-primary"><i class="ri-arrow-right-line me-1"></i>Tạo Ngay
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Techcombank -->
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" style="position:relative;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <img style="margin-left:-10px;width:60px!important;height:45px!important;"
                                        src="/<?=__IMG__?>/icon/techcombank.webp" alt="Logo Techcombank">
                                </div>
                                <div class="card-info">
                                    <h5 class="card-title mb-0 me-2">Techcombank <span
                                            class="ws-left badge bg-success text-white badge-notifications">Gói
                                            VIP</span>
                                    </h5>
                                    <small class="text-muted">Ngân hàng Techcombank</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <div class="badge bg-label-secondary me-2 cur-pointer" data-demo-name="techcombank"><i
                                    class="ri-eye-line me-1"></i>Xem
                                demo</div>
                            <a href="/fake-bill/techcombank">
                                <div class="badge bg-label-primary"><i class="ri-arrow-right-line me-1"></i>Tạo Ngay
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vietinbank -->
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" style="position:relative;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <img src="/<?=__IMG__?>/icon/vietinbank.webp" alt="Logo Vietinbank">
                                </div>
                                <div class="card-info">
                                    <h5 class="card-title mb-0 me-2">Vietinbank <span
                                            class="ws-left badge bg-success text-white badge-notifications">Gói
                                            VIP</span>
                                    </h5>
                                    <small class="text-muted">Ngân hàng Vietinbank</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <div class="badge bg-label-secondary me-2 cur-pointer" data-demo-name="vietinbank"><i
                                    class="ri-eye-line me-1"></i>Xem
                                demo</div>
                            <a href="/fake-bill/vietinbank">
                                <div class="badge bg-label-primary"><i class="ri-arrow-right-line me-1"></i>Tạo Ngay
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ACB Bank -->
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" style="position:relative;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <img style="border-radius:10px;" src="/<?=__IMG__?>/icon/acb.png" alt="Logo ACB">
                                </div>
                                <div class="card-info">
                                    <h5 class="card-title mb-0 me-2">ACB <span
                                            class="ws-left badge bg-success text-white badge-notifications">Gói
                                            VIP</span>
                                    </h5>
                                    <small class="text-muted">Ngân hàng ACB</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <div class="badge bg-label-secondary me-2 cur-pointer" data-demo-name="acb"><i
                                    class="ri-eye-line me-1"></i>Xem
                                demo</div>
                            <a href="/fake-bill/acb-bank">
                                <div class="badge bg-label-primary"><i class="ri-arrow-right-line me-1"></i>Tạo Ngay
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Momo -->
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" style="position:relative;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <img style="border-radius:10px;" src="/<?=__IMG__?>/icon/momo.png" alt="Logo Momo">
                                </div>
                                <div class="card-info">
                                    <h5 class="card-title mb-0 me-2">Ví Momo <span
                                            class="ws-left badge bg-success text-white badge-notifications">Gói
                                            VIP</span>
                                    </h5>
                                    <small class="text-muted">Ví Momo</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <div class="badge bg-label-secondary me-2 cur-pointer" data-demo-name="momo"><i
                                    class="ri-eye-line me-1"></i>Xem
                                demo</div>
                            <a href="/fake-bill/momo">
                                <div class="badge bg-label-primary"><i class="ri-arrow-right-line me-1"></i>Tạo Ngay
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MSB Bank -->
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" style="position:relative;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <img style="border-radius:10px;" src="/<?=__IMG__?>/icon/msb.png"
                                        alt="Logo MSB Bank">
                                </div>
                                <div class="card-info">
                                    <h5 class="card-title mb-0 me-2">MSB Bank <span
                                            class="ws-left badge bg-success text-white badge-notifications">Gói
                                            VIP</span>
                                    </h5>
                                    <small class="text-muted">Ngân hàng Hàng Hải Việt Nam</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <div class="badge bg-label-secondary me-2 cur-pointer" data-demo-name="msb"><i
                                    class="ri-eye-line me-1"></i>Xem
                                demo</div>
                            <a href="/fake-bill/msb">
                                <div class="badge bg-label-primary"><i class="ri-arrow-right-line me-1"></i>Tạo Ngay
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TP Bank -->
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between" style="position:relative;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <img style="border-radius:10px;" src="/<?=__IMG__?>/icon/tpbank.png"
                                        alt="Logo TP Bank">
                                </div>
                                <div class="card-info">
                                    <h5 class="card-title mb-0 me-2">TP Bank <span
                                            class="ws-left badge bg-success text-white badge-notifications">Gói
                                            VIP</span>
                                    </h5>
                                    <small class="text-muted">Ngân hàng Tiên Phong Bank</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end mt-3">
                            <div class="badge bg-label-secondary me-2 cur-pointer" data-demo-name="tpbank"><i
                                    class="ri-eye-line me-1"></i>Xem
                                demo</div>
                            <a href="/fake-bill/tpbank">
                                <div class="badge bg-label-primary"><i class="ri-arrow-right-line me-1"></i>Tạo Ngay
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <hr>
            <div class="container-none">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between" style="position:relative;">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">
                                            <img src="/<?=__IMG__?>/icon/mb-bank.png" alt="Logo Mbbank">
                                        </div>
                                        <div class="card-info">
                                            <h5 class="card-title mb-0 me-2">MB Bank&ensp;&nbsp;<span
                                                    class="badge bg-secondary text-white badge-notifications">Old</span>
                                            </h5>
                                            <small class="text-muted">Ngân hàng Quân đội - Giao Diện Cũ</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-end mt-3">
                                    <div class="badge bg-label-secondary me-2 cur-pointer"><i
                                            class="ri-eye-line me-1"></i>Xem
                                        demo</div>
                                    <div class="badge bg-label-primary"><i class="ri-arrow-right-line me-1"></i><a
                                            href="/fake-bill/mb-bank">Tạo Ngay</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--/ End row -->
        </div>
        <!--/ Card Border Shadow -->
    </div>
    <!-- / Content -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>