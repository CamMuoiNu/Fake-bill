<?php
$title_web='Cài Đặt Website';
include 'partials/head.php';
?>
<div id="pjax-container">
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        <?php echo $title_web ?>
                    </h1>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="./index.php">Trang Chủ</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Cài đặt hệ thống
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="content animated fadeIn">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title"> Cài đặt thông tin trang web </h3>
                <div class="block-options">
                    <button type="button" onclick="" class="btn-block-option" data-toggle="block-option"
                        data-action="state_toggle" data-action-mode="demo">
                        <i class="si si-refresh"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form id="td-setting" method="post" class="form-horizontal">
                    <input type="hidden" name="action" value="admin-setting">
                    <div class="mb-2">
                        <label class="form-label" for="title"><b>Tiêu Đề Trang</b></label>
                        <input type="text" class="form-control form-control-lg" name="title" value="<?=$TD->Setting('title')?>"
                            required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="name-site"><b>Tên Thương Hiệu</b></label>
                        <input type="text" class="form-control form-control-lg" name="name-site" value="<?=$TD->Setting('name-site')?>"
                            required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="keywords"><b>Từ Khóa</b></label>
                        <input type="text" class="form-control form-control-lg" name="keywords"
                            placeholder="Từ khóa phân tách bằng dấu chấm phẩy" value="<?=$TD->Setting('keywords')?>">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="logo"><b>Logo Website</b></label>
                        <input type="text" class="form-control form-control-lg" name="logo" value="<?=$TD->Setting('favicon')?>">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="description"><b>Miêu Tả Của Trang Web</b></label>
                        <input type="text" class="form-control form-control-lg" name="description"
                            value="<?=$TD->Setting('description')?>">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="author"><b>Chủ Sở Hữu</b></label>
                        <input type="text" class="form-control form-control-lg" name="author"
                            placeholder="Tên chủ sở hữu" value="<?=$TD->Setting('author')?>">
                    </div>
                    <!-- <div class="mb-2">
                        <label class="form-label" for="vip1"><b>Giá Gói Theo Ngày</b></label>
                        <input type="text" class="form-control form-control-lg ws-sotien" name="vip1"
                            placeholder="Tên chủ sở hữu" value="<?=FormatNumber::TD($TD->Setting('vip1'))?>đ">
                    </div>
                    <div class="m
                    <div class="mb-2">
                        <label class="form-label" for="vip2"><b>Giá Gói Theo Tháng</b></label>
                        <input type="text" class="form-control form-control-lg ws-sotien" name="vip2"
                            placeholder="Tên chủ sở hữu" value="<?=FormatNumber::TD($TD->Setting('vip2'))?>đ">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="vip3"><b>Giá Gói Theo Năm</b></label>
                        <input type="text" class="form-control form-control-lg ws-sotien" name="vip3"
                            placeholder="Tên chủ sở hữu" value="<?=FormatNumber::TD($TD->Setting('vip3'))?>đ">
                    </div> -->
                    <div class="mb-2">
                        <label class="form-label" for="bao-tri">Bảo Trì Website</label>
                        <select class="form-select" name="bao-tri">
                            <option value="0" <?= $TD->Setting('bao-tri') == '0' ? 'selected' : '' ?>>Tắt</option>
                            <option value="1" <?= $TD->Setting('bao-tri') == '1' ? 'selected' : '' ?>>Bật</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <a class="btn btn-purple btn btn-sm btn-alt-secondary text-nowrap"
                            data-toggle="modal" data-target="#modal-caidat-lienket">
                            <i class="fa fa-link"></i>&ensp;Cài Đặt Liên Kết
                        </a>
                    </div>
                    <div class="mt-3 mb-4">
                        <button type="submit" class="btn btn-alt-primary">
                            <i class="fa fa-check opacity-50 me-1"></i> <b>Lưu Cài Đặt</b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-caidat-lienket" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cấu Hình Liên Kết MXH</h5>
            </div>
            <div class="modal-body">
                <form class="set-mxh" method="post">
                    <div class="mt-2">
                        <label class="text-info fw-bold" for="zalo">&mdash; Zalo &mdash;</label>
                        <input type="url" placeholder="https://zalo.me/vuongdieu2k3" value="<?=$TD->Setting('zalo')?>" name="zalo"
                            class="form-control">
                    </div>
                    <div class="mt-2">
                        <label class="text-warning fw-bold" for="telegram">&mdash; Telegram &mdash;</label>
                        <input type="url" placeholder="https://t.me/wusthanhdieu" value="<?=$TD->Setting('telegram')?>" name="telegram"
                            class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="action" value="set-mxh">
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Lưu Cài Đặt</button>
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Đóng</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php include 'partials/foot.php';?>