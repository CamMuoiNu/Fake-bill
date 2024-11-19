<?php include 'partials/head.php'; ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/admin/editUserModel.php');?>
<div id="pjax-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Sửa Thành Viên / @<?=THANHDIEU($userData['username'])?>
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="/admin/quan-ly/thanh-vien">Quản Lý Thành Viên</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Sửa thành viên
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content animated fadeIn thanhdieu-refresh-form">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title text-nowrap">Sửa thành viên - UID <?=$userData['user_id']?></h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option"
                        data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form method="post" id="td_suaUsers" class="edit-form">
                    <input class="form-control" type="hidden" name="taikhoan_edit" value="<?=THANHDIEU($userData['username'])?>">
                    <div class="mb-2">
                        <label class="form-label" for="email"><b>Email</b></label>
                        <input type="text" class="form-control" readonly
                            value="<?=$userData['email'] ? $userData['email'] : 'Chưa thêm email'?>">
                    </div>
                    <div class="mb-2">
                        <label for="sodu"><b>Số Dư Hiện Có</b></label>
                        <input class="form-control ws-sotien" name="sodu" type="text"
                            value="<?=FormatNumber::TD($userData['sodu'])?>đ">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="tongnap"><b>Tổng Nạp</b></label>
                        <input class="form-control ws-sotien" name="tongnap" type="text"
                            value="<?=FormatNumber::TD($userData['tongnap'])?>đ">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="tongtieu"><b>Tổng Tiêu</b></label>
                        <input class="form-control ws-sotien" name="tongtieu" type="text"
                            value="<?=FormatNumber::TD($userData['tongtieu'])?>đ">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="ngaythamgia"><b>Ngày Đăng Ký</b></label>
                        <input readonly class="form-control" value="<?=$userData["ngaythamgia"] ?>">
                    </div>
                    <div class="mt-2">
                        <label for="sua_quyenhan">Quyền Hạn</label>
                        <select class="form-select" name="quyenhan">
                            <option value="members" <?= $userData['rank'] == 'members' ? 'selected' : '' ?>>Thành Viên
                            </option>
                            <option value="leader" <?= $userData['rank'] == 'leader' ? 'selected' : '' ?>>Lãnh Đạo
                            </option>
                            <option value="admin" <?= $userData['rank'] == 'admin' ? 'selected' : '' ?>>Quản Trị Viên
                            </option>
                        </select>
                    </div>
                    <div class="mb-4"></div>
                    <div class="mb-4">
                        <a id="cong-tien" class="btn btn-purple btn btn-sm btn-alt-secondary text-nowrap"
                            data-toggle="modal" data-target="#modal-congtien">
                            <i class="fa fa-plus"></i> Cộng tiền
                        </a>&nbsp;or
                        <a id="tru-tien" class="btn btn-purple btn btn-sm btn-alt-secondary text-nowrap"
                            data-toggle="modal" data-target="#modal-trutien">
                            <i class="fa fa-minus"></i> Trừ tiền
                        </a>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" name="action" value="admin-edit-user">
                        <button type="submit" id="SuaNguoiDung" class="btn btn-primary">
                            <i class="fa fa-check opacity-50 me-1"></i> <b>Lưu lại</b>
                        </button>
                        <button onclick="window.history.back();" type="button" class="btn btn-default">
                            <b>Quay lại</b>
                        </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-congtien" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cộng Tiền Tài Khoản</h5>
            </div>
            <div class="modal-body">
                <form class="admin-cong-tien">
                    <input type="hidden" value="admin-cong-tien" name="action">
                    <input type="hidden" value="<?=$userData['username']?>" name="taikhoan">
                    <div class="mt-2">
                        <label for="congtien">Số Tiền Cần Cộng</label>
                        <input type="text" placeholder="Số tiền cần cộng: 1000 = 1.000đ" name="sotien"
                            class="form-control" required autofocus="">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info"><i class="fa fa-check-circle"></i> Cộng Tiền</button>
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Đóng</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--End modal cộng tiền-->
<div class="modal fade" id="modal-trutien" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trừ Tiền Tài Khoản</h5>
            </div>
            <div class="modal-body">
                <form class="admin-tru-tien">
                    <input type="hidden" value="admin-tru-tien" name="action">
                    <input type="hidden" value="<?=$userData['username']?>" name="taikhoan">
                    <div class="mt-2">
                        <label for="trutien">Số Tiền Cần Trừ</label>
                        <input type="text" placeholder="Số tiền cần trừ: 1000 = 1.000đ" name="sotien"
                            class="form-control" required autofocus="">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info"><i class="fa fa-check-circle"></i> Trừ Tiền</button>
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Đóng</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--End modal trừ tiền-->
<?php include 'partials/foot.php';?>