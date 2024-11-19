<?php $options_header=['title' => 'Trang Hướng Dẫn - FAQ - Bạn Hỏi Chúng Tôi Trả Lời'];?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <div class="faq-header d-flex flex-column justify-content-center align-items-center">
            <h3 class="text-center z-1">Bạn hỏi chúng tôi trả lời</h3>
            <p class="text-center text-body z-1 mb-0 px-3">Không tìm thấy câu trả lời phù hợp?</p>
            <a href="<?=$TD->Setting('zalo')?>" class="btn btn-xs btn-primary mt-4"><i class='bx bxl-telegram'></i>&ensp;Liên hệ ngay</a>
        </div>

        <div class="row mt-4">
            <!-- Navigation -->
            <div class="col-lg-3 col-md-4 col-12 mb-md-0 mb-3">
                <div class="d-flex justify-content-between flex-column mb-2 mb-md-0">
                    <ul class="nav nav-align-left nav-pills flex-column" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#naptien"
                                aria-selected="true" role="tab">
                                <i class="bx bx-credit-card faq-nav-icon me-1"></i>
                                <span class="align-middle">Nạp Tiền &amp; Thanh Toán</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tos" aria-selected="false"
                                role="tab" tabindex="-1">
                                <i class="bx bx-check-shield faq-nav-icon me-1"></i>
                                <span class="align-middle">Dịch Vụ &amp; Chính Sách</span>
                            </button>
                        </li>
                    </ul>
                    <div class="d-none d-md-block">
                        <div class="mt-5">
                            <img src="/<?=__IMG__?>/icon/front-pages/boy-working-dark.png"
                                class="img-fluid scaleX-n1" alt="FAQ Image">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Navigation -->
            <!-- FAQ's -->
            <div class="col-lg-9 col-md-8 col-12">
                <div class="tab-content py-0">
                    <div class="tab-pane fade active show" id="naptien" role="tabpanel">
                        <div class="d-flex mb-3 gap-3">
                            <div>
                                <span class="badge bg-label-primary rounded-2 p-2">
                                    <i class="bx bx-credit-card fs-3 lh-1"></i>
                                </span>
                            </div>
                            <div>
                                <h5 class="mb-0">
                                    <span class="align-middle">Nạp Tiền &amp; Thanh Toán</span>
                                </h5>
                                <span>Hỗ trợ nạp tiền - thanh toán trên website</span>
                            </div>
                        </div>
                        <div id="WsNapTien" class="accordion accordion-header-primary">
                            <div class="card accordion-item active">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        aria-expanded="true" data-bs-target="#WsNapTien-1" aria-controls="WsNapTien-1">
                                        Lưu ý khi nạp tiền vào tài khoản?
                                    </button>
                                </h2>

                                <div id="WsNapTien-1" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        - Nạp sai cú pháp, sai số tài khoản, sai ngân hàng sẽ bị trừ 20% phí giao dịch
                                        và phải liên hệ admin để cộng tay.<br />
                                        - Min nạp 10.000 VNĐ cố tình nạp dưới mức nạp sẽ không hỗ trợ.<br />
                                        - Nếu sau 10-15p kể từ khi chuyển tiền, mà tiền vẫn chưa được cộng vào tài
                                        khoản, vui lòng liên hệ cho admin để cộng tay, sẽ không tính thêm phí.
                                    </div>
                                </div>
                            </div>

                            <div class="card accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#WsNapTien-2" aria-controls="WsNapTien-2" aria-expanded="false">
                                        Bạn hỗ trợ phương thức thanh toán nào?
                                    </button>
                                </h2>
                                <div id="WsNapTien-2" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        - Với sự phát triển của công nghệ số hiện nay, chúng tôi hỗ trợ thanh toán qua
                                        tất cả tài khoản Ngân Hàng vì vậy nạp qua thẻ cào không còn được áp dụng nữa.<br>
                                        - Nếu bạn vẫn muốn nạp qua phương thức khác hãy chủ động liên hệ riêng cho bộ
                                        phận CSKH hoặc Quản trị viên trang này.
                                    </div>
                                </div>
                            </div>

                            <div class="card accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#WsNapTien-3" aria-controls="WsNapTien-3">
                                        Dịch vụ của bạn có hỗ trợ hoàn tiền?
                                    </button>
                                </h2>
                                <div id="WsNapTien-3" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        Không có chính sách và qui định hoàn tiền được áp dụng trên trang này, như đã
                                        nói chúng tôi không hỗ trợ hoàn tiền khi khách hàng đã nạp.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tos" role="tabpanel">
                        <div class="d-flex mb-3 gap-3">
                            <div>
                                <span class="badge bg-label-primary rounded-2 p-2">
                                    <i class="bx bx-check-shield fs-3 lh-1"></i>
                                </span>
                            </div>
                            <div>
                                <h5 class="mb-0">
                                    <span class="align-middle">Dịch Vụ &amp; Chính Sách</span>
                                </h5>
                                <span>Những lưu ý khi sử dụng dịch vụ của chúng tôi</span>
                            </div>
                        </div>
                        <div id="WsTos" class="accordion accordion-header-primary">
                            <div class="card accordion-item active">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        aria-expanded="true" data-bs-target="#WsTos-1" aria-controls="WsTos-1">
                                        Chính sách bảo mật?
                                    </button>
                                </h2>

                                <div id="WsTos-1" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        - Chúng tôi tự hào là một trong những dịch vụ tôn trọng quyền riêng tư nhất hiện
                                        có, đồng thời là một trong những dịch vụ an toàn nhất.<br>
                                        - Chúng tôi không lưu giữ bất kỳ logs IP nào, và chúng tôi không xâm phạm quyền
                                        riêng tư của bạn bằng hệ thống theo dõi, keylogger.<br>
                                        - Ngoài ra, chúng tôi chưa bao giờ xâm phạm hoặc rò rỉ thông tin của khách hàng
                                        bất kỳ hình thức nào.<br>
                                    </div>
                                </div>
                            </div>

                            <div class="card accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#WsTos-2" aria-controls="WsTos-2">
                                     Chúng tôi là ai và website này là gì?
                                    </button>
                                </h2>
                                <div id="WsTos-2" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                      - Cảm thấy lĩnh vực dịch vụ online ngày càng phát triển và được nhiều khách hàng đang tìm kiếm.<br/>
                                      - Để bắt kịp xu thế này và giúp khách hàng đang cần sử dụng dịch vụ, chúng tôi đã triển khai website này.<br>
                                      - Với các developer tận tâm, chúng tôi đã đặt ra 3 tiêu chí Ngon - Bổ - Rẻ và dễ dàng sử dụng nhất có thể đến với khách hàng.<br/>
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#WsTos-3" aria-controls="WsTos-3">
                                        Có ưu đãi gì với khách hàng sử dụng miễn phí?
                                    </button>
                                </h2>
                                <div id="WsTos-3" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                    - Bạn sẽ nhận được các ưu đãi và đặc quyền miễn phí, sẽ tự động được trao cho bạn sau khi bạn đăng ký.<br/>
                                    - Chúng tôi luôn quan tâm đến khách hàng của mình và phân bổ nhiều quyền lợi nhất có thể cho họ.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#WsTos-4" aria-controls="WsTos-4">
                                      Bạn còn cung cấp dịch vụ gì khác ngoài FakeBill?
                                    </button>
                                </h2>
                                <div id="WsTos-4" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                    - Ngoài dịch vụ fakebill, chúng tôi còn cung cấp thêm hệ thống tiện ích như: Up Ảnh Lấy Link, Find Info Fb, Download Tiktok No Logo, v.v.. đặc biệt sử dụng hoàn toàn miễn phí không cần đăng ký bất kỳ gói VIP nào.<br/>
                                    - Ngoài ra chúng tôi còn thêm tính năng và ra mắt dịch vụ khác trong tương lai.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /FAQ's -->
        </div>

        <!-- Contact -->
        <div class="row mt-5">
            <div class="col-12 text-center mb-4">
                <div class="badge bg-label-primary">Cần Câu Hỏi Khác?</div>
                <h4 class="my-2">Bạn vẫn còn thắc mắc?</h4>
                <p>Nếu bạn không thể tìm thấy câu hỏi trong Câu hỏi thường gặp của chúng tôi, bạn luôn có thể liên hệ với chúng tôi. Chúng tôi sẽ trả lời cho bạn
                    trong thời gian ngắn!
                </p>
            </div>
        </div>
        <div class="row text-center justify-content-center gap-sm-0 gap-3">
            <div class="col-sm-6">
                <div class=" py-3 rounded bg-faq-section text-center">
                    <span class="badge bg-label-primary rounded-3 p-2 my-3">
                    <img style="width:28px;" src="/<?=__IMG__?>/icon/front-pages/zalo.png" alt="Icon Zalo">
                    </span>
                    <h4 class="mb-2"><a class="h4" href="<?=$TD->Setting('zalo')?>">Zalo</a></h4>
                    <p>Chúng tôi luôn sẵn lòng hỗ trợ</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class=" py-3 rounded bg-faq-section text-center">
                    <span class="badge bg-label-primary rounded-3 p-2 my-3">
                    <img style="width:28px;" src="/<?=__IMG__?>/icon/front-pages/telegram.webp" alt="Icon Telegram">
                    </span>
                    <h4 class="mb-2"><a class="h4" href="<?=$TD->Setting('telegram')?>">Telegram</a></h4>
                    <p>Cách tốt nhất để có được câu trả lời nhanh chóng</p>
                </div>
            </div>
        </div>
        <!-- /Contact -->
    </div>
    <!-- / Content -->
    <?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/include/foot.php'); ?>