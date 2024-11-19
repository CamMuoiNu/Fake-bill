<?php require_once 'partials/head.php'; ?>
<div id="pjax-container">
    <div class="content animated fadeIn">
        <div
            class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
                <h1 class="h3 fw-bold mb-2"> Tại đây bạn có thể quản lý tất cả tính năng của website </h1>
                <h2 class="h6 fw-medium fw-medium text-muted mb-0"> Chào mừng <a class="fw-semibold"
                        href="javascript:void(0)"> <?= THANHDIEU($user['username']); ?> </a>, mọi thứ trông thật tuyệt.
                </h2>
            </div>
            <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
                <a class="btn btn-sm btn-alt-secondary space-x-1" data-pjax href="/admin/quan-ly/goi-dang-ky">
                    <i class="fa fa-check-circle opacity-50"></i>
                    <span>DS Gói Đăng Ký</span>
                </a>
                <a class="btn btn-sm btn-alt-secondary space-x-1" data-pjax href="/admin/quan-ly/thanh-vien">
                    <i class="fa fa-users opacity-50"></i>
                    <span>DS Người Dùng</span>
                </a>
            </div>
        </div>
    </div>
    <div class="content animated fadeIn">
        <div class="row items-push">
            <div class="col-sm-12 col-xxl-12">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold">
                                <span id="current-time"></span>
                            </dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Giờ việt nam</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fa fa-clock fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            data-pjax href="https://time.is/vi/Vietnam">
                            <span>Giờ hiện tại của Việt Nam</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold" id="count1"><?= $totals->Users() ?></dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Tổng Thành Viên</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fa fa-users fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a
                            class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between">
                            <span>Kiểm tra chi tiết</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold" id="count2"><?= FormatNumber::TD($totals->Money()) ?>đ</dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Tổng Doanh Thu</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fa fa-usd fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a
                            class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between">
                            <span>Kiểm tra chi tiết</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold" id="count3"><?= $totals->BannedUsers() ?></dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Tổng Người Dùng Bị Cấm</dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fa fa-ban fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            data-pjax href="#">
                            <span>Kiểm tra chi tiết</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xxl-3">
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                    <div
                        class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                        <dl class="mb-0">
                            <dt class="fs-3 fw-bold" id="count4"><?= $totals->Plans() ?></dt>
                            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Tổng Gói Đăng Ký Còn Hạn </dd>
                        </dl>
                        <div class="item item-rounded-lg bg-body-light">
                            <i class="fa fa-star fs-3 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                            data-pjax href="#">
                            <span>Kiểm tra chi tiết</span>
                            <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lịch Sử Hoạt Động
                </h3>
            </div>
            <div class="block-content block-content-full">
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-sm-none">Hoạt động hàng loạt</span>
                        <span class="d-none d-sm-inline-block fw-semibold">Hoạt động hàng loạt</span>
                        <i class="fa fa-align-left opacity-50 ms-1"></i>
                    </button>
                    <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-content-rich-primary"
                        data-popper-placement="bottom-start">
                        <a class="dropdown-item" href="#!xoa-tat-ca-lich-su-logs" id="td_xoaAllLogs"><i
                                class="fa fa-trash"></i>&ensp;Xóa
                            tất
                            cả lịch sử logs</a>
                    </div>
                </div>
                <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row dt-row">
                        <div class="col-sm-12">
                            <table
                                class="table table-bordered table-striped table-vcenter js-dataTable-full dataTable no-footer"
                                id="listTable" border="2" data-toggle="table" data-search="true"
                                data-show-columns="true" data-pagination="true" data-page-list="[10, 25, 50, 100]">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tài Khoản</th>
                                        <th>Nhật Ký</th>
                                        <th>Thời Gian</th>
                                        <th>Thực Hiện</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $r = $thanhdieudb->query("SELECT * FROM `ws_logs` ORDER BY `time` DESC");
                                    if ($r) {
                                        while ($w = $r->fetch_assoc()) { ?>
                                            <tr class="odd">
                                                <td class="text-center fs-sm"><?= $w['log_id'] ?></td>
                                                <td class="fw-semibold fs-sm"><?php if ($w['username'] == 'Hệ Thống') { ?>
                                                        <span
                                                            class="text-nowrap fs-xs fw-semibold py-1 px-3Thốnnded-pill bg-warning text-white"><?= $w['username'] ?></span><?php } else {
                                                    echo $w['username'];
                                                } ?>
                                                </td>
                                                <td class="d-sm-table-cell fs-sm sorting_1"><?= $w['content'] ?></span></td>
                                                <td>
                                                    <span
                                                        class="text-nowrap fs-xs fw-semibold py-1 px-3 rounded-pill bg-info text-white"><?= FormatTime::TD($w["time"]) ?></span>
                                                </td>
                                                <td>
                                                    <span class="text-muted fs-sm"><?= $w['action'] ?></span>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        echo '<tr><td class="text-center" colspan="2">Chưa có dữ liệu</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content animated fadeIn">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <b>Thông tin máy chủ</b>
                        </h3>
                        <div class="block-options">
                            <button type="button" onclick="" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full" data-toggle="slimscroll" data-height="259px">
                        <div class="fw-medium fs-sm">
                            <div class="border-start border-4 rounded-2 border-primary mb-2">
                                <div class="rounded p-2 text-pulse-light">
                                    <ul class="list-group text-dark">
                                        <li class="list-group-item">
                                            <b>PHP Phiên bản: </b> <?php echo phpversion() ?>
                                            <?php if (ini_get('safe_mode')) {
                                                echo 'An toàn';
                                            } else {
                                                echo 'Không an toàn';
                                            } ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>MySQL Phiên bản: </b> <?php echo $mysqlversion ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>WEB Phần mềm: </b> <?php echo $_SERVER['SERVER_SOFTWARE'] ?>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Phiên Bản Mã Nguồn: </b> Null
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--
            <div class="col-lg-6 mb-4"><div class="block block-rounded mb-0"><div class="block-header block-header-default"><h3 class="block-title"><b>tin nhắn hệ thống 1</b></h3><div class="block-options"><button type="button" onclick="" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button></div></div><div class="block-content block-content-full" data-toggle="slimscroll" data-height="259px"><div class="fw-medium fs-sm"><div class="border-start border-4 rounded-2 border-primary mb-2"><div class="rounded p-2 text-pulse-light"><ul class="list-group text-dark"><li class="list-group-item"><font color="green">Bạn đang sử dụng phiên bản mới nhất!</font></li><li class="list-group-item">Phiên bản hiện tại：V5.5 (Build 1531)</li><li class="list-group-item">Powered by <a href="" target="_blank" rel="noopener noreferrer">ThanhDieu.Com</a></li></ul></div></div></div></div></div></div><div class="col-lg-6 mb-4"><div class="block block-rounded mb-0"><div class="block-header block-header-default"><h3 class="block-title"><b>tin nhắn hệ thống 2</b></h3><div class="block-options"><button type="button" onclick="" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button></div></div><div class="block-content block-content-full" data-toggle="slimscroll" data-height="259px"><div class="fw-medium fs-sm"><div class="border-start border-4 rounded-2 border-primary mb-2"><div class="rounded p-2 text-pulse-light"><ul class="list-group text-dark"><li class="list-group-item"><font color="green">Bạn đang sử dụng phiên bản mới nhất!</font></li><li class="list-group-item">Phiên bản hiện tại：V5.5 (Build 1531)</li><li class="list-group-item">Powered by <a href="" target="_blank" rel="noopener noreferrer">ThanhDieu.Com</a></li></ul></div></div></div></div></div></div></div>-->
            <div class="row">
                <div class="col-md-6">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <b>Phím tắt 1</b>
                            </h3>
                            <div class="block-options">
                                <button type="button" onclick="" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="block-content block-content-full">
                                <div class="py-3 text-center">
                                    <div class="mb-3">
                                        <i class="fa fa-ticket fa-4x text-primary"></i>
                                    </div>
                                    <div class="fs-4 fw-semibold">Xem Vé Hỗ Trợ</div>
                                    <div class="pt-3">
                                        <a class="btn btn-alt-primary" href="">
                                            <i class="fa fa-ticket opacity-50 me-1"></i>
                                            <b>Xem Vé Hỗ Trợ</b>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                <b>Phím tắt 2</b>
                            </h3>
                            <div class="block-options">
                                <button type="button" onclick="" class="btn-block-option" data-toggle="block-option"
                                    data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="block-content block-content-full">
                                <div class="py-3 text-center">
                                    <div class="mb-3">
                                        <i class="fa fa-users fa-4x text-primary"></i>
                                    </div>
                                    <div class="fs-4 fw-semibold">Quản Trị Thành Viên</div>
                                    <div class="pt-3">
                                        <a class="btn btn-alt-primary" href="/admin/quan-ly/thanh-vien">
                                            <i class="fa fa-users opacity-50 me-1"></i>
                                            <b>Danh Sách Thành Viên</b>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <?php include 'partials/foot.php'; ?>