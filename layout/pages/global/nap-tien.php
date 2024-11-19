<?php $options_header = ['title' => 'Nạp Tiền Vào Tài Khoản']; ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Dịch Vụ /</span> Nạp Tiền
        </h4>
        <?php if (!$isLogin->TD($taikhoan,$user)): ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
            ⚠️&ensp;Bạn chưa đăng nhập, vui lòng đăng nhập để có thể sử dụng dịch vụ:&nbsp;<a
                href="/oauth/dang-nhap?redirect=<?=urlencode($actual_link)?>" target="_blank">Tại đây.</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        <?php endif?>
        <div class="alert alert-info alert-dismissible" role="alert">
            💵&ensp;Liên hệ cho quản trị viên nếu bạn muốn cần hỗ trợ:&nbsp;<a href="<?=$TD->Setting('zalo')?>"
                target="_blank">Tại đây.</a><br>
            ⚠️&ensp;Vui lòng đọc các lưu ý trước khi chuyển, tránh chuyển nhầm và không được cộng tiền.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        <section class="section-py bg-body first-section-pt">
            <div class="card px-3">
                <div class="row">
                    <div class="col-lg-7 card-body border-end ">
                        <h4 class="mb-2">CHUYỂN KHOẢN NGÂN HÀNG</h4>
                        <p class="mb-0">Để nạp tiền vào tài khoản, quý khách vui lòng chuyển khoản cho chúng tôi theo
                            các phương thức sau.</p>
                        <div class="row py-4 my-2">
                            <div class="col-md mb-md-0 mb-2">
                                <div class="form-check custom-option custom-option-basic checked">
                                    <label
                                        class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                        for="payment1">
                                        <input name="naptien" class="form-check-input" type="radio" value="naptien"
                                            id="payment1" checked="">
                                        <span class="custom-option-body">
                                            <img src="<?= $transfer->TD('logo', 1) ?>"
                                                alt="<?= $transfer->TD('nganhang', 1) ?>" width="40">
                                            <span class="ms-3"><?= $transfer->TD('nganhang', 1) ?> (Tự Động)</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md mb-md-0 mb-2">
                                <div class="form-check custom-option custom-option-basic">
                                    <label
                                        class="form-check-label custom-option-content form-check-input-payment d-flex gap-3 align-items-center"
                                        for="payment2">
                                        <input name="naptien" class="form-check-input" type="radio" id="payment2">
                                        <span class="custom-option-body">
                                            <img src="<?= $transfer->TD('logo', 2) ?>"
                                                alt="<?= $transfer->TD('nganhang', 2) ?>" width="40">
                                            <span class="ms-3"><?=$transfer->TD('nganhang', 2)?> (Tự Động)</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="naptien1">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="stk">Số Tài Khoản</label>
                                    <input type="text" readonly class="form-control"
                                        data-ws-copy="<?=$transfer->TD('stk', 1)?>"
                                        value="<?=$transfer->TD('stk', 1)?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="ctk">Chủ Tài Khoản</label>
                                    <input type="text" readonly class="form-control"
                                        data-ws-copy="<?=$transfer->TD('chutaikhoan', 1)?>"
                                        value="<?=$transfer->TD('chutaikhoan',1)?>">
                                </div>
                            </div>
                            <ul class="list-group mb-3 mt-4">
                                <li class="list-group-item p-4">
                                    <div class="d-flex gap-3">
                                        <div class="flex-shrink-0 call-demo">
                                            <p><img style="border-radius:7px;" src="https://api.vietqr.io/<?=$transfer->TD('nganhang',1)?>/<?=$transfer->TD('stk',1)?>/0/<?= isset($user['user_id']) ? $TD->Setting('cuphap_naptien') . $user['user_id'] : 'Bạn chưa đăng nhập' ?>/vietqr_net_2.jpg?accountName=<?=$transfer->TD('chutaikhoan',1)?>"
                                                    alt="Logo <?=$transfer->TD('nganhang',1)?>" class="w-px-150 "></p>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h6 class="me-3"><a href="javascript:void(0)"
                                                            class="text-body">QR-Code
                                                            <?=$transfer->TD('nganhang',1)?></a></h6>
                                                    <div class="text-muted mb-1 d-flex flex-wrap"><span class="me-1">-
                                                            Quý
                                                            khách quét mã nhớ ghi nội dung:</span> <a
                                                            href="javascript:void(0)" class="me-1"
                                                            data-ws-copy="<?= isset($user['user_id']) ? $TD->Setting('cuphap_naptien') . $user['user_id'] : 'Bạn chưa đăng nhập' ?>"><?= isset($user['user_id']) ? $TD->Setting('cuphap_naptien') . $user['user_id'] : 'Bạn chưa đăng nhập' ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div id="naptien2" class="d-none">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="stk">Số Tài Khoản</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" readonly class="form-control"
                                            data-ws-copy="<?=$transfer->TD('stk', 2)?>"
                                            value="<?=$transfer->TD('stk', 2)?>">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="ctk">Chủ Tài Khoản</label>
                                    <input type="text" readonly class="form-control"
                                        data-ws-copy="<?=$transfer->TD('chutaikhoan', 2)?>"
                                        value="<?=$transfer->TD('chutaikhoan', 2)?>">
                                </div>
                            </div>
                            <ul class="list-group mb-3 mt-4">
                                <li class="list-group-item p-4">
                                    <div class="d-flex gap-3">
                                        <div class="flex-shrink-0 call-demo">
                                            <p><img style="border-radius:7px;" src="<?=$transfer->TD('qr-code', 2)?>"
                                                    alt="Logo <?=$transfer->TD('nganhang',2)?>" class="w-px-150 "></p>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h6 class="me-3"><a href="javascript:void(0)"
                                                            class="text-body">QR-Code
                                                            <?=$transfer->TD('nganhang',2)?></a></h6>
                                                    <div class="text-muted mb-1 d-flex flex-wrap"><span class="me-1">-
                                                            Quý
                                                            khách quét mã nhớ ghi nội dung:</span> <a
                                                            href="javascript:void(0)" class="me-1 text-primary"
                                                            data-ws-copy="<?= isset($user['user_id']) ? $TD->Setting('cuphap_naptien') . $user['user_id'] : 'Bạn chưa đăng nhập' ?>"><?= isset($user['user_id']) ? $TD->Setting('cuphap_naptien') . $user['user_id'] : 'Bạn chưa đăng nhập' ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <?php if ($isLogin->TD($taikhoan, $user)): ?>
                            <button type="button" class="btn btn-primary"
                                data-ws-copy="<?=$TD->Setting('cuphap_naptien') . $user['user_id'] ?>"
                                style="font-family:FzRubikRegular;">NỘI DUNG NẠP:
                                <?=$TD->Setting('cuphap_naptien') . $user['user_id']?>
                            </button>
                            <?php else: ?>
                            <button type="button" class="btn btn-danger" style="font-family:FzRubikRegular;">Vui lòng
                                đăng nhập
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr class="d-block d-md-none">
                    <div class="col-lg-5 card-body">
                        <h4 class="mb-2">LƯU Ý TRƯỚC KHI NẠP TIỀN</h4>
                        <p class="pb-2 mb-0">Những lưu ý cần đọc trước khi nạp tiền vào tài khoản mà bạn nên biết.</p>
                        <div class="bg-lighter p-4 rounded mt-4">
                            <div class="accordion" id="luu-y-nap-tien">
                                <div class="card accordion-item">
                                    <h2 class="accordion-header" id="luu-y-nap-tien1">
                                        <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                            data-bs-target="#luu-y-1" aria-expanded="true" aria-controls="luu-y-1">
                                            Lưu ý khi nạp tiền vào tài khoản là gì?
                                        </button>
                                    </h2>
                                    <div id="luu-y-1" class="accordion-collapse collapse show"
                                        data-bs-parent="#luu-y-nap-tien">
                                        <div class="accordion-body">
                                            - Nạp sai nội dung, sai số tài khoản, sai ngân hàng sẽ bị trừ 20% phí giao
                                            dịch và phải liên hệ admin để cộng tay.<br>
                                            - Min nạp <?= FormatNumber::TD($TD->Setting('min-nap')) ?> VNĐ cố tình nạp
                                            dưới mức nạp sẽ không hỗ trợ hoàn tiền.<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item">
                                    <h2 class="accordion-header" id="luu-y-nap-tien2">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#luu-y-2" aria-expanded="false"
                                            aria-controls="luu-y-2">
                                            Chuyển tiền rồi nhưng tiền vẫn chưa vào tài khoản?
                                        </button>
                                    </h2>
                                    <div id="luu-y-2" class="accordion-collapse collapse"
                                        aria-labelledby="luu-y-nap-tien2" data-bs-parent="#luu-y-nap-tien">
                                        <div class="accordion-body">
                                            - Hệ thống nạp tự động của chúng tôi đôi khi sẽ bị nghẽn hoặc gặp vài số vấn
                                            đề liên quan tới callback api bank.<br>
                                            - Nếu sau 10-15p kể từ khi chuyển tiền, mà tiền vẫn chưa được cộng vào tài
                                            khoản, vui lòng liên hệ cho admin để cộng tay, sẽ không tính thêm phí
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item">
                                    <h2 class="accordion-header" id="luu-y-nap-tien3">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#luu-y-3" aria-expanded="false"
                                            aria-controls="luu-y-3">
                                            Bạn hỗ trợ phương thức thanh toán nào?
                                        </button>
                                    </h2>
                                    <div id="luu-y-3" class="accordion-collapse collapse"
                                        aria-labelledby="luu-y-nap-tien3" data-bs-parent="#luu-y-nap-tien">
                                        <div class="accordion-body">
                                            - Với sự phát triển của công nghệ số hiện nay, chúng tôi hỗ trợ thanh toán
                                            qua tất cả tài khoản Ngân Hàng vì vậy nạp qua thẻ cào không còn được áp dụng
                                            nữa.
                                            <br>- Nếu bạn vẫn muốn nạp qua phương thức khác hãy chủ động liên hệ riêng
                                            cho bộ phận CSKH hoặc Quản trị viên trang này.
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item">
                                    <h2 class="accordion-header" id="luu-y-nap-tien4">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#luu-y-4" aria-expanded="false"
                                            aria-controls="luu-y-4">
                                            Tôi có thể ghi nội dung nạp không phân biệt chữ hoa hay không?
                                        </button>
                                    </h2>
                                    <div id="luu-y-4" class="accordion-collapse collapse"
                                        aria-labelledby="luu-y-nap-tien4" data-bs-parent="#luu-y-nap-tien">
                                        <div class="accordion-body">
                                            - Tất nhiên, bạn hoàn toàn có thể viết nội dung nạp mà không cần bận tâm nó
                                            có viết hoa hay không<br>
                                            - Ví dụ nội dung nạp của chúng tôi là NAPTIEN123 bạn có thể viết thành
                                            NapTien123 hay naptien123 mọi định dạng điều có thể chấp nhận.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
</div>
<!-- / Content -->
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>