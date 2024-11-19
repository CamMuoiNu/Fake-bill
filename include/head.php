<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');?>
<?php if ($TD->Setting('bao-tri')==1){die(require_once($_SERVER['DOCUMENT_ROOT'].'/layout/pages/global/error/maintenance.php'));}?>
<!DOCTYPE html>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7080848862767211"
     crossorigin="anonymous"></script>
<html lang="vi-VN" class="layout-navbar-fixed layout-compact layout-menu-100vh dark-style layout-menu-fixed" dir="ltr" data-theme="theme-bordered" data-assets-path="/<?=__SRC__?>/" data-template="vertical-menu-template-bordered">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title><?=$options_header['title'] ?? $TD->Setting('title')?></title>
    <meta property="og:description" content="<?=$options_header['description'] ?? $TD->Setting('description')?>" />
    <meta name="keywords" content="<?=$options_header['keywords'] ?? $TD->Setting('keywords')?>">
    <meta property="og:title" content="<?=$options_header['title'] ?? $TD->Setting('title')?>" />
    <!-- Canonical SEO -->
    <link rel="canonical" href="<?=$databaseWs->getFullURL()?>">
    <!-- Favicon -->
    <link rel='icon' type="image/x-icon" href='<?=$TD->Setting('favicon')?>'>
    <meta property="og:image" content="<?=$options_header['og:image'] ?? ($TD->Setting('og:image') === '' ? '/' . __IMG__ . '/banner.png' : $TD->Setting('og:image'))?>">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <!-- Custom -->
    <link rel="stylesheet" href="/<?=__CSS__?>/custom.css?v=22.2.4.2" />
    <!-- Icons -->
    <link rel="stylesheet" href="/<?=__VENDOR__?>/fonts/boxicons.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.min.css" rel="stylesheet">
    <!-- Core CSS -->
    <link rel="stylesheet" href="/<?=__VENDOR__?>/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/<?=__VENDOR__?>/css/rtl/theme-default-dark.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/<?=__CSS__?>/demo.css" />
    <link rel="stylesheet" href="/<?=__CSS__?>/color.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/<?=__LIBRARY__?>/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/<?=__LIBRARY__?>/spinkit/spinkit.css" />
    <link rel="stylesheet" href="/<?=__LIBRARY__?>/fancybox/fancybox.css" />
    <link rel="stylesheet" href="/<?=__LIBRARY__?>/animate-css/animate.css" />
    <link rel="stylesheet" href="/<?=__LIBRARY__?>/toastr/toastr.css" />
    <link rel="stylesheet" href="/<?=__LIBRARY__?>/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="/<?=__LIBRARY__?>/datatables-bs5/datatables.bootstrap5.css"> 
    <link rel="stylesheet" href="/<?=__LIBRARY__?>/datatables-bs5/responsive.bootstrap5.css">
    <!-- Helpers -->
    <script src="/<?=__JS__?>/helpers.js"></script>
    <script src="/<?=__JS__?>/template-customizer.js"></script>
    <script src="/<?=__JS__?>/config.js"></script>
</head>
<body>