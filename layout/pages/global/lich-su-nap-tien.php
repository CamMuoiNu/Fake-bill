<?php $options_header = ['title' => 'Lịch Sử Nạp Tiền']; ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/head.php');?>
<?php if ($taikhoan == null) {die(header('Location: /oauth/dang-nhap?redirect='.urlencode($actual_link)));}?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/nav.php');?>
<style>.table-responsive{max-height:500px;overflow-y:auto}</style>
<div class="content-wrapper">
    <!-- Content -->
    <div class="flex-grow-1 container-p-y container-fluid">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">Dịch Vụ /</span> Lịch Sử Nạp Tiền
        </h4>
        <div class="card">
            <h5 class="card-header">Lịch Sử Nạp Tiền</h5>
            <div class="card-datatable text-nowrap">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="table-responsive">
                        <table class="datatables-ajax table table-bordered dataTable no-footer">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã Giao Dịch</th>
                                    <th>Số Tiền</th>
                                    <th>Nội Dung</th>
                                    <th>Thời Gian</th>
                                    <th>Trạng Thái</th>
                                </tr>
                            </thead>
                            <tbody class="rl-history"><tr class="odd"><td valign="center" colspan="8" class="dataTables_empty">Đang tải...</td></tr></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- / Content -->
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/include/foot.php'); ?>