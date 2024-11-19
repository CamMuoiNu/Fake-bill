for (var items = $("select[default]"), i = 0; i < items.length; i++) $(items[i]).val($(items[i]).attr("default") || 0);

function searchSubmit() {
    return $("#listTable").bootstrapTable("refresh"), !1
}

function searchClear() {
    $("#searchToolbar").find("input[name]").each(function() {
        $(this).val("")
    }), $("#searchToolbar").find("select[name]").each(function() {
        $(this).find("option:first").prop("selected", "selected")
    }), $("#listTable").bootstrapTable("refresh")
}

function updateToolbar() {
    $("#searchToolbar").find(":input[name]").each(function() {
        var n = $(this).attr("name");
        void 0 !== window.$_GET[n] && $(this).val(window.$_GET[n])
    })
}

function updateQueryStr(n) {
    var e = [];
    for (var a in n) n.hasOwnProperty(a) && void 0 !== n[a] && "" != n[a] && e.push(a + "=" + encodeURIComponent(n[a]));
    history.replaceState({}, null, "?" + e.join("&"))
}

function getCurrentTime() {
    var n = new Date,
        e = n.getHours(),
        a = n.getMinutes(),
        t = n.getSeconds();
    e = e < 10 ? "0" + e : e, a = a < 10 ? "0" + a : a, t = t < 10 ? "0" + t : t;
    var o, c = n.getDate(),
        s = n.getMonth() + 1;
    return e + ":" + a + ":" + t + " " + (c = c < 10 ? "0" + c : c) + "-" + (s = s < 10 ? "0" + s : s) + "-" + n.getFullYear()
}

function updateCurrentTime() {
    var n = document.getElementById("current-time");
    n && (n.textContent = getCurrentTime())
}

function speedModeNotice() {
    var n = window.navigator.userAgent;
    n.indexOf("Windows NT") > -1 && n.indexOf("Trident/") > -1 && $("#browser-notice").html("<div class=\"panel panel-default\"><div class=\"panel-body\">Tr\xecnh duyệt hiện tại đang ở chế độ tương th\xedch. Để đảm bảo sử dụng b\xecnh thường c\xe1c chức năng nền, vui l\xf2ng chuyển sang<b style='color:#51b72f'>Chế độ tốc độ cực cao</b>！<br>C\xe1ch thao t\xe1c: Click v\xe0o biểu tượng IE ở b\xean phải thanh địa chỉ tr\xecnh duyệt<b style='color:#51b72f;'><i class='fa fa-internet-explorer fa-fw'></i></b>→Chọn'<b style='color:#51b72f;'><i class='fa fa-flash fa-fw'></i></b><b style='color:#51b72f;'>Chế độ tốc độ cực cao</b>”</div></div>")
}
$(function() {
    $('[data-toggle="tooltip"]').length > 0 && $('[data-toggle="tooltip"]').tooltip()
}), window.onload = function() {
    speedModeNotice(), updateCurrentTime()
}, setInterval(updateCurrentTime, 1e3), $(function() {
    $("[data-fancybox]").length > 0 && Fancybox.bind("[data-fancybox]", {})
});
var isMobile = function() {
    return !!/Android|SymbianOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Windows Phone|Midp/i.test(navigator.userAgent)
};

function DeleteTickets(n) {
    var e = $(n).data("id");
    layer.confirm("Sau khi x\xf3a, kh\xf4ng thể kh\xf4i phục bằng c\xe1ch n\xe0o!", {
        btn: ["X\xf3a Lu\xf4n", "Hủy Bỏ"],
        title: "X\xe1c nhận x\xf3a"
    }, function() {
        $.ajax({
            url: "../ajax/replyTickets",
            type: "POST",
            data: {
                id: e,
                action: "XoaTickets"
            },
            success: function(e) {
                "success" === e ? ($(n).closest("tr").remove(), layer.msg("X\xf3a th\xe0nh c\xf4ng ticket n\xe0y!")) : layer.msg(e)
            },
            error: function(n, e, a) {
                layer.msg("Lỗi: " + a)
            }
        })
    }, function() {
        layer.closeAll(), layer.msg("Hủy bỏ x\xf3a ticket")
    })
}
 $("#closeModalBtn").click(function() {
    $(".modal").modal("hide")
}), $(function() {
    if ($("#chat").length > 0) {
        var n = $("#chat");
        n.scrollTop(n[0].scrollHeight)
    }
}), $(function() {
    $("a.c8q9c.ckvr2.cl1vv.c1xbd.cl17h.cqlg5.crcb7.cmk82").click(function() {
        $("#resetpw-modal").show()
    }), $("#resetpw-modal .close-modal, #closemodal").click(function() {
        $("#resetpw-modal").hide()
    })
})
$('.ws-sotien,input[name="sotien"]').on('input', function() {
    var a = $(this).val().replace('đ', ''); 
    var b = a.replace(/\D/g, '');
    var c = b.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    $(this).val(c);
});
$('body').on('submit', '.admin-cong-tien', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: '/ajax/global/admin',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('input[name="sotien"]').val('');
                    $(".thanhdieu-refresh-form").load(location.href + " .thanhdieu-refresh-form > *");
                    layer.alert(response.message);
                } else {
                    layer.alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                layer.msg("Lỗi: " + error)
            }
        });
});
$('body').on('submit', '.admin-tru-tien', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: '/ajax/global/admin',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('input[name="sotien"]').val('');
                    $(".thanhdieu-refresh-form").load(location.href + " .thanhdieu-refresh-form > *");
                    layer.alert(response.message);
                } else {
                    layer.alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                layer.msg("Lỗi: " + error)
            }
        });
});
$('body').on('submit', '#td-setting', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: '/ajax/global/admin',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    layer.msg(response.message)
                } else {
                    layer.alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                layer.msg("Lỗi: " + error)
            }
        });
});
$('body').on('submit', '.set-mxh', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: '/ajax/global/admin',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    layer.alert(response.message);
                } else {
                    layer.alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                layer.msg("Lỗi: " + error)
            }
        });
});
$('body').on('submit', '#td_suaUsers', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: '/ajax/global/admin',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    layer.msg(response.message)
                } else {
                    layer.alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                layer.msg("Lỗi: " + error)
            }
        });
});
// if ($('#main-list-log').length) {
//     function Logs() {
//         $.ajax({
//             url: '/ajax/global/admin',
//             method: 'POST',
//             data: {action: 'main-list-log'},
//             dataType: 'json',
//             success: function(data) {
//                 var tbody = $('#listTable tbody');
//                 tbody.empty();
//                 $.each(data, function(index, log) {
//                     var row = $('<tr>').addClass('odd');
//                     row.append($('<td>').addClass('text-center fs-sm').text(log.log_id));
//                     var usernameTd = $('<td>').addClass('fw-semibold fs-sm');
//                     if (log.username == 'Hệ Thống') {
//                         usernameTd.html('<span class="text-nowrap fs-xs fw-semibold py-1 px-3 rounded-pill bg-warning text-white">' + log.username + '</span>');
//                     } else {
//                         usernameTd.text(log.username);
//                     }
//                     row.append(usernameTd);
//                     row.append($('<td>').addClass('d-sm-table-cell fs-sm sorting_1').text(log.content));
//                     row.append($('<td>').html('<span class="text-nowrap fs-xs fw-semibold py-1 px-3 rounded-pill bg-info text-white">' + log.time + '</span>'));
//                     row.append($('<td>').html('<span class="text-muted fs-sm">' + log.action + '</span>'));
//                     tbody.append(row);
//                 });
//             },
//             error: function() {
//             }
//         });
//     }
//     Logs();
//     setInterval(Logs,2000);
// }
function DeleteUser(user_id) {
    var userId = $(user_id).data('id');
    layer.confirm("Sau khi xoá thành viên sẽ không thể khôi phục bằng cách nào!", {
        btn: ["Xoá luôn", "Huỷ bỏ"],
        title: "Xác Nhận Xoá: #"+userId
    }, function() {
        $.ajax({
            url: '/ajax/global/admin',
            type: 'POST',
            data: {action:'admin-delete-user', user_id: userId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    layer.msg(response.message)
                    $(user_id).closest('tr').remove();
                } else {
                    layer.msg(response.message)
                }
            },
            error: function() {
                layer.msg("Lỗi: " + error)
            }
        });
    }, function() {
        layer.closeAll(), layer.msg("Hủy bỏ xoá thành viên")
    })
 }
 $('body').on('submit', '.admin-set-giagoi', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: '/ajax/global/admin',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    layer.msg(response.message)
                } else {
                    layer.alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                layer.msg("Lỗi: " + error)
            }
        });
});