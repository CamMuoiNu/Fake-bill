<?php include 'partials/head.php'; ?>
<div id="pjax-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Quản Lý Gói VIP
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="/admin/quan-ly/goi-dang-ky">MANAGE</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Quản Lý Gói VIP
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Thống kê gói thành viên</h3>
            </div>
            <div class="block-content">
                <p class="alert alert-dark fs-sm">
                    <i class="fa fa-fw fa-info-circle me-1"></i> Các số liệu thống kê bên dưới được bao gồm cả các gói
                    đã hết hạn.
                </p>
                <div
                    class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center text-center text-sm-start">
                    <div class="flex-grow-1"></div>
                    <div class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3">
                        <span class="d-inline-block">
                            <a class="btn btn-sm btn-primary px-4 py-2 js-click-ripple-enabled" data-toggle="modal"
                                data-target="#modal-setgiagoi"><span class="click-ripple animate"></span>
                                <i class="fa fa-plus me-1 opacity-50"></i> Cài Đặt Giá Gói
                            </a>
                        </span>
                    </div>
                </div>
                <div class="row items-push mt-4">
                    <div class="col-md-4">
                        <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0"
                            href="javascript:void(0)">
                            <div
                                class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="fw-semibold mb-1 text-primary">GÓI VIP 1</div>
                                    <div class="fs-sm text-muted"><b><?= $totals->VIP1() ?></b> Lượt Mua</div>
                                </div>
                                <div class="ms-3">
                                    <img class="img-avatar" src="/<?= __IMG__ ?>/icon/front-pages/paper-airplane.png"
                                        alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0"
                            href="javascript:void(0)">
                            <div
                                class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="fw-semibold mb-1 text-warning">GÓI VIP 2</div>
                                    <div class="fs-sm text-muted"><b><?= $totals->VIP2() ?></b> Lượt Mua</div>
                                </div>
                                <div class="ms-3">
                                    <img class="img-avatar" src="/<?= __IMG__ ?>/icon/front-pages/plane.png" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a class="block block-rounded block-bordered block-link-shadow h-100 mb-0"
                            href="javascript:void(0)">
                            <div
                                class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="fw-semibold mb-1 text-success">GÓI VIP 3</div>
                                    <div class="fs-sm text-muted"><b><?= $totals->VIP3() ?></b> Lượt Mua</div>
                                </div>
                                <div class="ms-3">
                                    <img class="img-avatar" style="border-radius:0 !important;"
                                        src="/<?= __IMG__ ?>/icon/front-pages/shuttle-rocket.png" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-primary"><?= $history_goivip->TongMuaHomNay() ?? 0 ?></div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Tổng Mua Hôm Nay
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-dark"><?= $history_goivip->TongMuaHomQua() ?? 0 ?></div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Tổng Mua Hôm Qua
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-dark"><?= $history_goivip->TongMuaTuanNay() ?? 0 ?></div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Tổng Mua Tuần Này
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-dark"><?= $history_goivip->TongMuaThangNay() ?? 0 ?></div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0 text-nowrap">
                            Tổng Mua Tháng Này
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">gói thành viên vip </h3>
                <div class="block-options">
                    <button type="button" onclick="" class="btn-block-option" data-toggle="block-option"
                        data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
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
                        <a class="dropdown-item" href="#!xoa-tat-ca-goi" id=""><i class="fa fa-trash"></i>&ensp;Xóa
                            tất
                            cả gói hiện có</a>
                    </div>
                </div>
                <?php
                /**
                 * @author Vương Thanh Diệu
                 */
                class DanhSachGoiVIP extends DatabaseConnection
                {
                    public function ShowPlans()
                    {
                        $oOo = mysqli_query(self::ThanhDieuDB(), "SELECT * FROM ws_plans ORDER BY ngaymua DESC");
                        if ($oOo) { ?>
                <table id="listTable" border="2" data-toggle="table" data-search="true" data-show-columns="true"
                    data-pagination="true" data-page-list="[10, 25, 50, 100]">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tài Khoản</th>
                            <th>Tên Gói</th>
                            <th>Giá Tiền</th>
                            <th>Ngày Mua</th>
                            <th>Ngày Hết Hạn</th>
                            <th>Trạng Thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    while ($goi = mysqli_fetch_assoc($oOo)) { ?>
                        <tr class="text-nowrap">
                            <td><?= $goi['plans_id']; ?></td>
                            <td><?= $goi['taikhoan']; ?></td>
                            <td><?= strtoupper($goi['tengoi']) ?>
                            </td>
                            <td><?= FormatNumber::TD($goi['giatien']) ?>đ
                            </td>
                            <td><?= FormatTime::TD($goi["ngaymua"]) ?></td>
                            <td><?= FormatTime::TD($goi["ngayhethan"]) ?></td>
                            <td>
                                <?php if ($goi['trangthai'] == '0') { ?>
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-danger" title="Gói này đã hết hạn" data-toggle="tooltip"
                                        data-id="<?= $goi['plans_id']; ?>">Đã Hết Hạn</a>
                                </div>
                                <?php } else { ?>
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-success" title="Đang sử dụng" data-toggle="tooltip"
                                        data-id="<?= $goi['plans_id']; ?>">Hoạt
                                        động</a>
                                </div>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-danger" data-id="<?= $goi['plans_id']; ?>"
                                        data-toggle="tooltip" title="Xóa gói đăng ký" onclick="DeletePlans(this)"><i
                                            class="fa fa-window-close"></i>&ensp;Xóa&ensp;</a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <?php } else { ?>
                    <tr>
                        <td colspan="8">Chưa có dữ liệu.</td>
                    </tr>
                    <?php }
                    }
                }
                (new DanhSachGoiVIP())->ShowPlans();
                ?>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-setgiagoi" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <ul class="nav nav-tabs nav-tabs-block" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" id="giagoivip1-tab" data-bs-toggle="tab"
                            data-bs-target="#giagoivip1" role="tab" aria-controls="giagoivip1"
                            aria-selected="true">GÓI VIP 1</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" id="giagoivip2-tab" data-bs-toggle="tab"
                            data-bs-target="#giagoivip2" role="tab" aria-controls="giagoivip2"
                            aria-selected="false">GÓI VIP 3</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" id="giagoivip3-tab" data-bs-toggle="tab"
                            data-bs-target="#giagoivip3" role="tab" aria-controls="giagoivip3"
                            aria-selected="false">GÓI VIP 3</button>
                    </li>
                </ul>
                <form class="admin-set-giagoi">
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="giagoivip1" role="tabpanel"
                        aria-labelledby="giagoivip1-tab" tabindex="0">
                        <div class="mb-2">
                            <label for="giavip1">Giá Gói VIP 1</label>
                            <input type="text" placeholder="Nhập giá gói" name="giavip1" value="<?=FormatNumber::TD($TD->Setting('vip1'))?>đ"
                                class="form-control ws-sotien" required autofocus="">
                        </div>
                    </div>
                    <div class="tab-pane" id="giagoivip2" role="tabpanel"
                        aria-labelledby="giagoivip2-tab" tabindex="0">
                        <div class="mb-2">
                            <label for="giavip2">Giá Gói VIP 2</label>
                            <input type="text" placeholder="Nhập giá gói" name="giavip2" value="<?=FormatNumber::TD($TD->Setting('vip2'))?>đ"
                                class="form-control ws-sotien" required autofocus="">
                        </div>
                    </div>
                    <div class="tab-pane" id="giagoivip3" role="tabpanel"
                        aria-labelledby="giagoivip3-tab" tabindex="0">
                        <div class="mb-2">
                            <label for="giavip3">Giá Gói VIP 3</label>
                            <input type="text" placeholder="Nhập giá gói" name="giavip3" value="<?=FormatNumber::TD($TD->Setting('vip3'))?>đ"
                                class="form-control ws-sotien" required autofocus="">
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <input type="hidden" name="action" value="admin-set-giagoi">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Cập nhật</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'partials/foot.php'; ?>