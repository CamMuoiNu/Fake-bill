<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');?>
<?php
class AuthenticationHandler extends DatabaseConnection
{
    public function __construct() {
    }
    public function Admin($taikhoan) {
        if (isset($taikhoan)) {
            $user=$this->___Adminitrator($taikhoan);
            if ($user !== null && isset($user['rank']) && (THANHDIEU($user['rank']) !== 'admin' && THANHDIEU($user['rank']) !== 'partner')) {
                $this->___Logout("/");
            }
            if ($user !== null && isset($user['banned']) && THANHDIEU($user['banned']) == 1) {
                $this->___Login("/oauth/dang-nhap");
            }            
        } else {
            $this->___Logout("/");
        }
    }
    private function ___Adminitrator($taikhoan) {
        $r=self::ThanhDieuDB()->query("SELECT * FROM `users` WHERE `username`='$taikhoan'");
        if ($r && $r->num_rows > 0) {
            return $r->fetch_assoc();
        }

        return null;
    }
    private function ___Logout($redirect) {
        setcookie('taikhoan', '', time() - 3600, "/", "", true, true);
        setcookie('admin', '', time() - 3600, "/", "", true, true);
        $this->___Login($redirect);
    }
    private function ___Login($redirect) {
        header("Location: $redirect");
        exit();
    }
}

(new AuthenticationHandler())->Admin($taikhoan);
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="utf-8">
    <meta name="author" content="ThanhDieuTv">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Trang Quản Trị | Admin Manager</title>
    <link rel="icon" type="image/" sizes="64x64" href="/admin/assets/oneui/media/favicon.png" type="image/x-icon">
    <link rel="stylesheet" id="css-main" href="/admin/assets/oneui/css/oneui.min-5.6.css">
    <link rel="stylesheet" href="/admin/assets/oneui/js/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" id="css-main" href="/admin/assets/oneui/css/nprogress.min.css">
    <link rel="stylesheet" href="/admin/assets/oneui/js/lib/layer.css">
    <script src="/admin/assets/oneui/js/lib/jquery.min.js"></script>
    <script src="/admin/assets/oneui/js/plugins/jquery.pjax/jquery.pjax.min.js"></script>
    <script src="/admin/assets/oneui/js/nprogress.min.js"></script>
    <script src="/admin/assets/oneui/js/lib/layer.min.js"></script>
    <script src="/admin/assets/oneui/js/oneui.app.min-5.6.js"></script>
    <script src="/admin/assets/oneui/js/plugins/chart.js/chart.min.js"></script>
    <script src="/admin/assets/oneui/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="/admin/assets/oneui/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="/admin/assets/oneui/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <link href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css" rel="stylesheet">
    <script src="/admin/assets/oneui/js/bootstrap-table-123.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.3/extensions/filter-control/bootstrap-table-filter-control.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.3/extensions/filter-control/bootstrap-table-filter-control.js"></script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif !important;
        }
        .btn-xs {
            --bs-btn-padding-y: 0.125rem;
            --bs-btn-padding-x: 0.25rem;
            --bs-btn-font-size: 0.75rem;
            /*--bs-btn-border-radius: 0.125rem;*/
        }
        .table thead th {
            text-transform: none;
        }
        tbody, td, tfoot, th, thead, tr {
            border-color: inherit;
            border-style: none;
            border-width: 0;
        }
    </style>
</head>
<body>
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-dark main-content-narrow side-trans-enabled dark-mode">
 <?php include("partials/nav.php");?>
        <main id="main-container">