<?php
/**
 * Kết Nối CSDL
 */
require_once ($_SERVER['DOCUMENT_ROOT'] . '/config/database.php');
/**
 * @author Vương Thanh Diệu
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (isset($_POST['action']) && $_POST['action'] === 'admin-setting') {
    CheckRankAndSession::TD($user, $taikhoan);
    $set_title = $_POST['title'];
    $set_namesite = $_POST['name-site'];
    $set_keywords = $_POST['keywords'];
    $set_logo = $_POST['logo'];
    $set_description = $_POST['description'];
    $set_author = $_POST['author'];
    $set_baotri = $_POST['bao-tri'];
    // $set_vip1 = FormatNumber::PREG($_POST["vip1"]);
    // $set_vip2 = FormatNumber::PREG($_POST["vip2"]);
    // $set_vip3 = FormatNumber::PREG($_POST["vip3"]);
    $vtd = $thanhdieudb->prepare("UPDATE `ws_settings` SET `title` = ?, `name-site` = ?, `keywords` = ?, `favicon` = ?,`description`=?, `author` = ?, `bao-tri` = ?");
    if ($vtd) {
        $vtd->bind_param("ssssssi", $set_title, $set_namesite, $set_keywords, $set_logo, $set_description, $set_author, $set_baotri);
        if ($vtd->execute()) {
            exit(json_encode(array("success" => true, "message" => "Thông tin đã được cập nhật!")));
        } else {
            exit(json_encode(array("success" => false, "message" => $vtd->error)));
        }
    } else {
        exit(json_encode(array("success" => false, "message" => "Có lỗi khi cập nhật thông tin.")));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'set-mxh') {
    CheckRankAndSession::TD($user, $taikhoan);
    $zalo = $_POST['zalo'];
    $telegram = $_POST['telegram'];
    $vtd = $thanhdieudb->prepare("UPDATE `ws_settings` SET `zalo` = ?, `telegram` =?");
    if ($vtd) {
        $vtd->bind_param("ss", $zalo, $telegram);
        if ($vtd->execute()) {
            exit(json_encode(array("success" => true, "message" => "Thông tin đã được cập nhật!")));
        } else {
            exit(json_encode(array("success" => false, "message" => $vtd->error)));
        }
    } else {
        exit(json_encode(array("success" => false, "message" => "Có lỗi khi cập nhật thông tin.")));
    }
}
// Cộng Tiền
if (isset($_POST['action']) && $_POST['action'] === 'admin-cong-tien') {
    CheckRankAndSession::TD($user, $taikhoan);
    $sotien = FormatNumber::PREG($_POST["sotien"]);
    $taikhoan_users = mysqli_real_escape_string($thanhdieudb, $_POST["taikhoan"]);
    $display_username = ($taikhoan == $taikhoan_users) ? 'chính mình' : $taikhoan_users;
    if (!is_numeric($sotien)) {
        $TDTV = array('success' => 0, 'message' => "Số tiền phải là số, và có thể chứa dấu chấm!");
    } elseif ($sotien == 0) {
        $TDTV = array('success' => 0, 'message' => "Không thể cộng vì số tiền cần cộng quá thấp!");
    } else {
        $OoO = mysqli_query($thanhdieudb, "SELECT sodu FROM `users` WHERE `username`='$taikhoan_users'");
        if ($OoO && mysqli_num_rows($OoO) > 0) {
            $td = mysqli_fetch_assoc($OoO);
            $sodu_hientai = $td['sodu'];
            $sodu_moi = $sodu_hientai + $sotien;
            if (mysqli_query($thanhdieudb, "UPDATE `users` SET `sodu`= '$sodu_moi', `tongnap`=`tongnap` + '$sotien' WHERE `username`='$taikhoan_users'")) {
                $thanhdieudb->query("INSERT INTO `ws_logs` SET 
                `username`='$taikhoan', 
                `content`= 'đã cộng " . FormatNumber::TD($sotien) . "đ vào tài khoản $display_username', 
                `time`='$time', 
                `action`='Cộng Tiền'");
                $thanhdieudb->query("INSERT INTO `ws_history_bank` SET `loai`='Admin Cộng Tay', `magiaodich`='WT" . random_int(1000000, 9999999) . "', `sotien`='" . preg_replace('/\D/', '', $sotien) . "', `noidung`='Nạp tiền vào tài khoản', `thoigian`='$time', `username`='$taikhoan_users',`trangthai`='thanhcong'");
                $TDTV = array('success' => 1, 'message' => "Đã cộng " . FormatNumber::TD($sotien) . "đ cho tài khoản $display_username!");
            } else {
                $TDTV = array('success' => 0, 'message' => "Lỗi khi cập nhật thông tin!");
            }
        } else {
            $TDTV = array('success' => 0, 'message' => "Made by -> ThanhDieuTv");
        }
    }
    exit(json_encode($TDTV));
} elseif (isset($_POST['action']) && $_POST['action'] === 'admin-tru-tien') {
    CheckRankAndSession::TD($user, $taikhoan);
    $taikhoan_users = mysqli_real_escape_string($thanhdieudb, $_POST["taikhoan"]);
    $sotien = FormatNumber::PREG($_POST["sotien"]);
    $display_username = ($taikhoan == $taikhoan_users) ? 'chính mình' : $taikhoan_users;
    if (!is_numeric($sotien)) {
        $TDTV = array(
            'success' => 0,
            'message' => "Tổng Nạp hoặc Tổng Tiêu phải là số, và có thể chứa dấu chấm!"
        );
    } elseif ($sotien == 0) {
        $TDTV = array('success' => 0, 'message' => "Không thể trừ vì số tiền cần trừ quá thấp!");
    } else {
        $OoO = mysqli_query($thanhdieudb, "SELECT `sodu` FROM `users` WHERE `username`='$taikhoan'");
        if ($OoO && mysqli_num_rows($OoO) > 0) {
            $td = mysqli_fetch_assoc($OoO);
            $sodu_hientai = $td['sodu'];
            $sodu_moi = $sodu_hientai - $sotien;
            if ($sodu_moi >= 0) {
                if (mysqli_query($thanhdieudb, "UPDATE `users` SET `sodu`= '$sodu_moi', `tongtieu`=`tongtieu` + '$sotien' WHERE `username`='$taikhoan_users'")) {
                    $sotien_format = (strpos($sotien, '.') === false) ? number_format($sotien, 0, ',', '.') : $sotien;
                    $thanhdieudb->query("INSERT INTO `ws_logs` SET `username`='$taikhoan', `content`='đã trừ " . FormatNumber::TD($sotien) . "đ khỏi tài khoản $display_username', `time`='$time', `action`='Trừ Tiền'");
                    $TDTV = array(
                        'success' => 1,
                        'message' => "Đã trừ " . FormatNumber::TD($sotien) . "đ khỏi tài khoản $display_username!"
                    );
                } else {
                    $TDTV = array('success' => 0, 'message' => "Lỗi khi thực hiện trừ tiền!");
                }
            } else {
                $TDTV = array('success' => 0, 'message' => "Số dư trong tài khoản này không đủ để thực hiện trừ tiền!");
            }
        } else {
            $TDTV = array('success' => 0, 'message' => "Made by -> ThanhDieuTv");
        }
    }
    exit(json_encode($TDTV));
}
if (isset($_POST['action']) && $_POST['action'] === 'admin-edit-user') {
    CheckRankAndSession::TD($user, $taikhoan);
    $taikhoan_edit = $_POST['taikhoan_edit'];
    $sodu = FormatNumber::PREG($_POST["sodu"]);
    $tongnap = FormatNumber::PREG($_POST["tongnap"]);
    $tongtieu = FormatNumber::PREG($_POST["tongtieu"]);
    $quyenhan = $_POST['quyenhan'];
    $vtd = $thanhdieudb->prepare("UPDATE `users` SET `sodu` = ?, `tongnap` =?, `tongtieu` =?, `rank` =? WHERE username = ?");
    if ($vtd) {
        $vtd->bind_param("iiiss", $sodu, $tongnap, $tongtieu, $quyenhan, $taikhoan_edit);
        if ($vtd->execute()) {
            exit(json_encode(array("success" => true, "message" => "Thông tin đã được cập nhật!")));
        } else {
            exit(json_encode(array("success" => false, "message" => $vtd->error)));
        }
    } else {
        exit(json_encode(array("success" => false, "message" => "Có lỗi khi cập nhật thông tin.")));
    }
}
// if (isset($_POST['action']) && $_POST['action'] === 'main-list-log') {
// $OoO = $thanhdieudb->query("SELECT * FROM `ws_logs` ORDER BY `time` DESC");
// $logs = [];
// if($OoO) {
//     while($w = $OoO->fetch_assoc()) {
//         $logs[] = $w;
//     }
// }
// echo json_encode($logs);
// }
if (isset($_POST['action']) && $_POST['action'] === 'admin-delete-user') {
    CheckRankAndSession::TD($user, $taikhoan);
    $user_id = $_POST['user_id'];
    if ($user_id==$user['user_id']) {
        exit(json_encode(["success" => false, "message" => "Bạn không thể tự xoá chính mình!"]));
    }
    $vtd = $thanhdieudb->prepare("SELECT username FROM users WHERE user_id = ?");
    $vtd->bind_param("i", $user_id);
    $vtd->execute();
    $vtd->bind_result($username);
    $vtd->fetch();
    $vtd->close();
    if ($username) {
        $vtd = $thanhdieudb->prepare("DELETE FROM users WHERE user_id = ?");
        $vtd->bind_param("i", $user_id);
        $DELETE = $vtd->execute();
        $vtd->close();
        if ($DELETE) {
            $queries = [
                "DELETE FROM ws_plans WHERE taikhoan = ?",
                "DELETE FROM ws_history_bank WHERE username = ?",
                "DELETE FROM ws_logs WHERE username = ?"
            ];
            $success = true;
            foreach ($queries as $query) {
                $vtd = $thanhdieudb->prepare($query);
                $vtd->bind_param("s", $username);
                if (!$vtd->execute()) {
                    $success = false;
                    break;
                }
                $vtd->close();
            }
            if ($success) {
                exit(json_encode(["success" => true, "message" => "Đã xoá thành viên này thành công"]));
            } else {
                exit(json_encode(["success" => false, "message" => "Lỗi khi xóa dữ liệu liên quan!"]));
            }
        } else {
            exit(json_encode(["success" => false, "message" => "Không thể xóa tài khoản!"]));
        }
    } else {
        exit(json_encode(["success" => false, "message" => "Thành viên không tồn tại!"]));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'admin-set-giagoi') {
    CheckRankAndSession::TD($user, $taikhoan);
    $set_vip1 = FormatNumber::PREG($_POST["giavip1"]);
    $set_vip2 = FormatNumber::PREG($_POST["giavip2"]);
    $set_vip3 = FormatNumber::PREG($_POST["giavip3"]);
    $vtd = $thanhdieudb->prepare("UPDATE `ws_settings` SET vip1 = ?, vip2 = ?, vip3 = ?");
    if ($vtd) {
        $vtd->bind_param("iii", $set_vip1, $set_vip2, $set_vip3);
        if ($vtd->execute()) {
            exit(json_encode(array("success" => true, "message" => "Thông tin đã được cập nhật!")));
        } else {
            exit(json_encode(array("success" => false, "message" => $vtd->error)));
        }
    } else {
        exit(json_encode(array("success" => false, "message" => "Có lỗi khi cập nhật thông tin.")));
    }
}