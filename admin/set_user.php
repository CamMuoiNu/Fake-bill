<?php include 'partials/head.php'; ?>
<div id="pjax-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Quản Lý Thành Viên
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="/admin/quan-ly/thanh-vien">MANAGE</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Quản Lý Thành Viên
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"> Danh sách thành viên </h3>
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
                        <a class="dropdown-item" href="#!xoa-tat-ca-nguoi-dung" id="td_xoaAllUsers"><i
                                class="fa fa-trash"></i>&ensp;Xóa
                            tất
                            cả người dùng</a>
                    </div>
                </div>
                <?php
                /**
                 * @author Vương Thanh Diệu
                 */
                class DanhSachThanhVien extends DatabaseConnection
                {
                    public function ShowUsers()
                    {
                        $oOo = mysqli_query(self::ThanhDieuDB(), "SELECT * FROM users ORDER BY ngaythamgia DESC");
                        if ($oOo) { ?>
                            <table id="listTable" border="2" data-toggle="table" data-search="true" data-show-columns="true"
                                data-pagination="true" data-page-list="[10, 25, 50, 100]">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tài Khoản</th>
                                        <th>Quyền Hạn</th>
                                        <th>Số Dư</th>
                                        <th>Tổng Nạp</th>
                                        <th>Tổng Tiêu</th>
                                        <th>Ngày Tham Gia</th>
                                        <th>IP</th>
                                        <th>Trạng Thái</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($td = mysqli_fetch_assoc($oOo)) { ?>
                                        <tr class="text-nowrap">
                                            <td><?= $td['user_id']; ?></td>
                                            <td><?= $td['username']; ?></td>
                                            <td><?php
                                            switch ($td['rank']) {
                                                case 'admin':
                                                    echo 'Quản Trị Viên';
                                                    break;
                                                case 'leader':
                                                    echo 'Lãnh Đạo';
                                                    break;
                                                default:
                                                    echo 'Thành Viên';
                                                    break;
                                            } ?></td>
                                            <td><?= FormatNumber::TD($td['sodu']) ?>đ
                                            </td>
                                            <td><?= FormatNumber::TD($td['tongnap']) ?>đ
                                            </td>
                                            <td><?= FormatNumber::TD($td['tongtieu']) ?>đ
                                            </td>
                                            <td><?= FormatTime::TD($td["ngaythamgia"]) ?></td>
                                            <td><?= $td["ip"] ?: 'null' ?></td>
                                            <td>
                                                <?php if ($td['banned'] == '1') { ?>
                                                    <div class="btn-group">
                                                        <a class="btn btn-xs btn-danger bannedUsers" title="Nhấn để mở khóa"
                                                            data-toggle="tooltip" data-id="<?= $td['user_id']; ?>">Đang bị khóa</a>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="btn-group">
                                                        <a class="btn btn-xs btn-success bannedUsers" title="Nhấn để khóa"
                                                            data-toggle="tooltip" data-id="<?= $td['user_id']; ?>">Hoạt
                                                            động</a>
                                                    </div>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-xs btn-info" href="/admin/edit-tv/<?= $td["user_id"]; ?>"
                                                        title="Chỉnh sửa" data-toggle="tooltip"><i
                                                            class="fa fa-pencil"></i>&ensp;Sửa&ensp;</a>
                                                </div>&ensp;
                                                <div class="btn-group">
                                                    <a class="btn btn-xs btn-danger" data-id="<?= $td['user_id']; ?>"
                                                        data-toggle="tooltip" title="Xóa tài khoản" onclick="DeleteUser(this)"><i
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
                (new DanhSachThanhVien())->ShowUsers();
                ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'partials/foot.php'; ?>