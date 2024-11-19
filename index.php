<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">V14Team / </span> Trang Chủ
        </h4>
         <div class="alert alert-primary alert-dismissible" role="alert">
            <h6 class="alert-heading mb-1">💥 THÔNG BÁO BẢO TRÌ</h6>
            <span>Chúng tôi sẽ tiến hành bảo trì website trong ngày 12/08/2024, vui lòng quay lại sau!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> 
        <!-- <div class="alert alert-warning alert-dismissible" role="alert">
            <h6 class="alert-heading mb-1">🤡 Thông Báo Nên Đọc!</h6>
            <span>Đây chỉ là trang web lập ra để demo code dịch vụ, vui lòng không nạp tiền vào trang này dưới mọi hình thức nào!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> -->
        <div class="alert alert-primary alert-dismissible" role="alert">
            <h6 class="alert-heading mb-1">📱 Liên Hệ Hỗ Trợ</h6>
            <span>Mọi liên hệ và nạp tiền vui lòng nhấn vào đây <a class="font-bold"
                    href="<?=$TD->Setting('telegram')?>">Group Telegram</a>.</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <!-- <div class="layout-demo-wrapper">
            <div class="layout-demo-placeholder banner-main">
                <img src="https://i.imgur.com/TWIR8e5.gif" class="img-fluid"
                    alt="">
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-7">
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class="ri-notification-line me-2"></i>Tin Mới Nhất</h5>
                    </div>
                    <div class="card-body newfeeds">
                        <ul class="timeline ms-2">
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-primary"></span>
<div class="timeline-event">
    <div class="timeline-header mb-1">
        <h6 class="mb-0">Thông Báo Bảo Trì</h6>
        <small class="text-muted">12/08/2024</small>
    </div>
    <div class="d-flex flex-wrap">
        <div class="overflow-auto">
            Chúng tôi đang tiến hành bảo trì hệ thống. Trong thời gian này, dịch vụ có thể bị gián đoạn. Chúng tôi xin lỗi về sự bất tiện này và cảm ơn quý khách đã thông cảm.<br>
            Dự kiến bảo trì sẽ hoàn tất vào lúc 21:00. Nếu có bất kỳ câu hỏi hoặc cần hỗ trợ, vui lòng liên hệ với chúng tôi qua các kênh hỗ trợ.<br>
            Tag: bảo trì, thông báo bảo trì, hệ thống, dịch vụ
        </div>
    </div>
</div>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class="ri-menu-2-line me-2"></i>Truy Cập Nhanh</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-3">
                                            <img src="https://cdn.haitrieu.com/wp-content/uploads/2022/02/Icon-MB-Bank-MBB.png" alt="Logo" class="rounded">
                                        </div>
                                        <div class="me-2">
                                            <h6 class="mb-0">Fakebill MBBank</h6>
                                            <small class="text-muted">xx Lượt tạo</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="/fake-bill/mb-bank-new"><span class="badge bg-label-primary">Tạo ngay
                                                <i class="ri-arrow-right-line"></i></span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-3">
                                            <img src="/<?=__IMG__?>/icon/vietcombank.png" alt="Logo" class="rounded">
                                        </div>
                                        <div class="me-2">
                                            <h6 class="mb-0">Fakebill Vietcombank</h6>
                                            <small class="text-muted">xx Lượt tạo</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="/fake-bill/vietcombank-new"><span class="badge bg-label-primary">Tạo
                                                ngay <i class="ri-arrow-right-line"></i></span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-3">
                                            <img src="/<?=__IMG__?>/icon/bank/techcombank.png" alt="Logo"
                                                class="rounded">
                                        </div>
                                        <div class="me-2">
                                            <h6 class="mb-0">Fakebill Techcombank</h6>
                                            <small class="text-muted">xx Lượt tạo</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="/fake-bill/techcombank"><span class="badge bg-label-primary">Tạo ngay
                                                <i class="ri-arrow-right-line"></i></span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-3">
                                            <img src="/<?=__IMG__?>/icon/tpbank.png" alt="Logo" class="rounded">
                                        </div>
                                        <div class="me-2">
                                            <h6 class="mb-0">Fakebill TP Bank</h6>
                                            <small class="text-muted">xx Lượt tạo</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="/fake-bill/tpbank"><span class="badge bg-label-primary">Tạo ngay <i
                                                    class="ri-arrow-right-line"></i></span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-3">
                                            <img src="/<?=__IMG__?>/icon/vietinbank.webp" alt="Logo" class="rounded">
                                        </div>
                                        <div class="me-2">
                                            <h6 class="mb-0">Fakebill Vietinbank</h6>
                                            <small class="text-muted">xx Lượt tạo</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="/fake-bill/vietinbank"><span class="badge bg-label-primary">Tạo ngay <i
                                                    class="ri-arrow-right-line"></i></span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-3" style="width:32px;height:32px;margin-left:2.5px;">
                                            <img src="/<?=__IMG__?>/icon/msb.png" alt="Logo" class="rounded">
                                        </div>
                                        <div class="me-2">
                                            <h6 class="mb-0">Fakebill MSB</h6>
                                            <small class="text-muted">xx Lượt tạo</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="/fake-bill/msb"><span class="badge bg-label-primary">Tạo ngay
                                                <i class="ri-arrow-right-line"></i></span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="text-center">
                                <a href="/fake-bill-chuyen-khoan">Xem tất cả bank</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section class="mt-4 section-py landing-fun-facts">
            <div class="container2">
                <div class="row gy-3">
                    <div class="col-md-3 mb-md-0 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="mb-4" src="/<?=__IMG__?>/icon/front-pages/an-toan.png" height="52"
                                    alt="Help center articles">
                                <h5>Độ An Toàn Cao</h5>
                                <p>Chúng tôi tự tin là một trong những dịch vụ an toàn nhất hiện có.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-md-0 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="mb-4" src="/<?=__IMG__?>/icon/front-pages/uy-tin.png" height="52"
                                    alt="Help center articles">
                                <h5>Dịch Vụ Uy Tín</h5>
                                <p>Châm ngôn của nền tảng chúng tôi là luôn đặt uy tín lên hàng đầu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-md-0 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="mb-4" src="/<?=__IMG__?>/icon/front-pages/toc-do.png" height="52"
                                    alt="Help center articles">
                                <h5>Xử Lý Nhanh</h5>
                                <p>Với hệ thống hoàn toàn tự động, đảm bảo tốc độ xử lý tốc độ cao.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-md-0 mb-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="mb-4" src="/<?=__IMG__?>/icon/front-pages/ho-tro.png" height="52"
                                    alt="Help center articles">
                                <h5>Hỗ Trợ 24/7</h5>
                                <p>Đội ngũ nhân viên hỗ trợ online mọi lúc, mọi nơi 24/7 kể cả ngày lễ.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- / Content -->
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>