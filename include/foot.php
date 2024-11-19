<?php if(strpos($current_url,'dang-nhap')===false&&strpos($current_url,'dang-ky')===false):?>
<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0 display-name">
            &copy; 2024 Developed by <a
                href="\u0068\u0074\u0074\u0070\u0073\u003a\u002f\u002f\u0074\u0068\u0061\u006e\u0068\u0064\u0069\u0065\u0075\u002e\u0063\u006f\u006d"
                target="_blank">V14 Team 💗</a>
        </div>
        <div class="d-none d-lg-inline-block">
            <a href="javascript:void(0)" class="footer-link">Version Code: <b>1.0.2</b></a>
        </div>
    </div>
</footer>
<!-- / Footer -->
<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>
<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->
<?php endif; ?>
<!-- Core JS -->
<script src="/<?=__LIBRARY__?>/jquery/jquery-3.7.1.min.js"></script>
<script src="/<?=__LIBRARY__?>/popper/popper.js"></script>
<script src="/<?=__JS__?>/bootstrap.js"></script>
<script src="/<?=__LIBRARY__?>/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/<?=__LIBRARY__?>/hammer/hammer.js"></script>
<script src="/<?=__JS__?>/menu.js"></script>
<script src="https://cdn.jsdelivr.net/npm/pxmu/dist/web/pxmu.min.js"></script>
<!-- Vendors JS -->
<script src="/<?=__LIBRARY__?>/toastr/toastr.js"></script>
<script src="/<?=__LIBRARY__?>/fancybox/fancybox.umd.js"></script>
<script src="/<?=__LIBRARY__?>/sweetalert2/sweetalert2.js"></script>
<?php if (strpos($current_url, '/dang-ky') !== false):?>
<script src="/<?=__LIBRARY__?>/captcha/gt4.js"></script>
<?php endif; ?>
<!-- Main JS -->
<script src="/<?=__JS__?>/main.js"></script>
<script src="/<?=__JS__?>/handle.min.js?v=15.20.21"></script>
</body>
</html>