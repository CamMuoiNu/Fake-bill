<?php
require_once(__DIR__."/config/config.php");
require_once(__DIR__."/config/function.php");
$title = 'BUFF LIKE | '.$NMQ->site('tenweb');
require_once(__DIR__."/public/client/Header.php");
require_once(__DIR__."/public/client/Nav.php");
?>

<div class="mt-12 relative w-full max-w-6xl mx-auto text-gray-800 pb-8 px-2 md:px-0">
    <div class="mt-2">
        <div class="v-account-detail p-2 md:px-0 mt-5">
            <div class="v-infomations py-4 mb-10">
                <h2 class="mb-3 v-title border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold">
                    BUFF LIKE FREE FIRE
                </h2>
                <div class="w-full grid grid-cols-12 gap-4">
                    <div class="col-span-12 sm:col-span-8 md:col-span-8 lg:col-span-8 xl:col-span-8">
                        <div class="text-gray-900">
                            <div class="p-2 border border-gray-300 mb-4">
                                <div class="flex justify-between items-center cursor-pointer">
                                    <div class="flex select-none">
                                        <img src="https://i.imgur.com/D8pvDnz.gif" class="h-10 w-10 rounded">
                                        <div class="ml-2 text-left">
                                            <h2 class="font-bold text-base">
                                               Mỗi UID Buff Được 100 Like 1 Ngày Và Sẽ Reset Ngày Mới Vào 3h Sáng
                                            </h2>
                                        </div>
                                    </div>
                                    <button class="select-none focus:outline-none bg-blue-500 text-white text-xs inline-block h-5 flex items-center justify-center font-semibold px-2 rounded">
                                        Auto
                                    </button>
                                </div>
                                <div class="py-3">
                                    <table class="table-auto w-full">
                                        <tbody class="text-sm select-text">
                                            <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10">
                                                <td class="v-account-text py-2 font-bold text-gray-800">UID</td>
                                                <td class="v-table-title font-bold px-2 py-2 text-gray-800 uppercase">
                                                    <input type="text" id="uid" placeholder="Nhập UID" class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-4 md:col-span-4 lg:col-span-4 xl:col-span-4">
                        <div class="sticky top-20 rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 mt-6">
                            <div class="border-b border-gray-100 dark:border-gray-700 bg-black">
                                <h5 class="text-1xl text-white font-semibold px-2 py-2">THÔNG TIN</h5>
                            </div>
                            <div class="px-6">
                                <ul>
                                    <li class="flex justify-between items-center py-6">
                                        <div class="flex items-center">
                                            <div class="ml-3">
                                                <p class="font-semibold">TỔNG TIỀN</p>
                                                <p class="text-slate-400 text-sm"><b class="text-red-500" id="tongtien"><?=format_cash($NMQ->site('sotienbuff'));?></b><b class="text-red-500">đ</b></p>                                               
                                            </div>
                                        </div>
                                    </li>
                                    <li class="flex justify-between items-center py-6 border-t border-gray-100 dark:border-gray-700">
                                        <div class="flex items-center">
                                            <div class="mt-4 rounded-b-sm grid grid-cols-12 gap-5 p-2">
                                                <div class="col-span-6">
                                                    <div class="w-full">
                                                        <a href="javascript:;" id="btnBuffLike" class="cursor-pointer border rounded w-full text-center cursor-pointer hover:border-lime-600 bg-lime-600 transition duration-200 hover:bg-lime-600 text-white uppercase inline-block font-semibold py-1 px-3">
                                                            <i class="fa fa-shopping-cart"></i> TĂNG NGAY
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
           </div>

                <div class="v-bg w-full mb-2 px-2">
                    <h2 class="v-title border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold">LỊCH SỬ BUFF LIKE</h2>
                    <div class="v-table-content select-text">
                        <div class="py-2 overflow-x-auto scrolling-touch max-w-400">
                            <table id="datatable" class="table-auto w-full scrolling-touch min-w-850 dataTable no-footer">
                                <thead>
                                    <tr class="v-border-hr select-none border-b-2 border-gray-300">
                                        <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">STT</th>
                                        <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">USERNAME</th>
                                        <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">UID</th>
                                        <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">SỐ LIKE TRƯỚC</th>
                                        <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">SỐ LIKE SAU</th>
                                        <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">SỐ LIKE BUFF ĐƯỢC</th>
                                        <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">THỜI GIAN</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm font-semibold">
                                    <?php $i = 0; foreach ($NMQ->get_list("SELECT * FROM `history_bufflike` WHERE `username` = '" . $getUser['username'] . "' ORDER BY `id` DESC LIMIT 200") as $row) {?>
                                    <tr>
                                        <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$i++?></td>
                                        <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$row['usergame'];?></td>
                                        <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$row['uid'];?></td>
                                        <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$row['liketruoc'];?></td>
                                        <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$row['likesau'];?></td>
                                        <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$row['buffduoc'];?></td>
                                        <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
    <span class="badge badge-danger"><?=date('d-m-Y H:i:s', $row['time'])?></span>
</td>

                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <div class="v-table-note mt-1 py-1 font-semibold text-gray-800 text-sm">
                            Dùng điện thoại <i class="bx bxs-mobile"></i>, hãy vuốt bảng từ phải qua trái <i class="bx bxs-arrow-from-right"></i> để xem đầy đủ thông tin!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="thongbao"></div>

<script type="text/javascript">

$("#btnBuffLike").on("click", function() {
    $('#btnBuffLike').html('<i class="fa fa-spinner fa-spin"></i> ĐANG XỬ LÝ').prop('disabled', true);
    
    $.ajax({
        url: "<?=BASE_URL('assets/ajaxs/BuffLike.php');?>",
        method: "POST",
        data: {
            type: 'BuffLike',
            uid: $("#uid").val()
        },
        success: function(response) {
            // Xử lý phản hồi từ server
            $("#thongbao").html(response);
            $('#btnBuffLike').html('<i class="fa fa-shopping-cart"></i> TĂNG NGAY')
                .prop('disabled', false);
        },
        error: function() {
            $("#thongbao").html('<div class="msg_error2">LỖI XẢY RA</div>');
            $('#btnBuffLike').html('<i class="fa fa-shopping-cart"></i> TĂNG NGAY')
                .prop('disabled', false);
        }
    });
});

</script>

<?php
require_once(__DIR__."/public/client/Footer.php");
?>
