<?php 
require_once("../../config/config.php");
require_once("../../config/function.php");

if ($_POST['type'] == 'BuffLike') {
    if (empty($_SESSION['username'])) {
        msg_error2("Vui lòng đăng nhập để thanh toán!");
        exit;
    }

    $uid = check_string($_POST['uid']);

    if (empty($uid)) {
        msg_error2("Vui lòng nhập UID game!");
        exit;
    }

    if (strlen($uid) < 8) {
        msg_error2("UID ít nhất 8 số!");
        exit;
    }

    $money = $NMQ->site('sotienbuff');
    $getUser = $NMQ->get_row("SELECT * FROM users WHERE username = '".$_SESSION['username']."'");

    if ($money > $getUser['money']) {
        msg_error2("Số dư không đủ vui lòng nạp thêm");
        exit;
    }
    $keybuff = $NMQ->site('keybuff');
    $api_url = "https://iamquan.info/api/like.php?id=" . urlencode($uid) . "&name=minhquan&key=" .$keybuff. "";
    $response = @file_get_contents($api_url);

    if ($response === FALSE) {
        msg_error2("Không thể kết nối đến API");
        exit;
    }

    // Phân tích dữ liệu phản hồi từ API
    $response_data = json_decode($response, true);

    if (!isset($response_data['status'])) {
        msg_error2("Dữ liệu phản hồi không hợp lệ");
        exit;
    }

    if ($response_data['status'] === 'error') {
       
        msg_error2($response_data['message']);
        exit;
    } elseif ($response_data['status'] === 'success') {
        $usergame = check_string($response_data['PlayerNickname']);
        $buffduoc = (int) $response_data['LikesGivenByAPI'];
        $liketruoc = (int) $response_data['LikesbeforeCommand'];
        $like_sau = (int) $response_data['LikesafterCommand'];

        // Trừ tiền từ tài khoản người dùng
        $isMoney = $NMQ->tru("users", "money", $money, " `username` = '".$getUser['username']."' ");

        if ($isMoney) {
            // Lưu đơn hàng vào lịch sử
            $isOrder = $NMQ->insert("history_bufflike", [
                'username' => $getUser['username'],
                'uid'      => $uid,
                'usergame' => $usergame,
                'buffduoc' => $buffduoc,
                'liketruoc' => $liketruoc,
                'likesau'  => $like_sau,
                'time' => time() + 25200
            ]);

            if ($isOrder) {
                // Ghi log dòng tiền
                $NMQ->insert("dongtien", [
                    'sotientruoc'   => $getUser['money'] - $money,
                    'sotienthaydoi' => $money,
                    'sotiensau'     => $getUser['money'],
                    'thoigian'      => gettime(),
                    'noidung'       => 'Buff Like ('.$uid.')',
                    'username'      => $getUser['username']
                ]);

               
                $success_message = "Thành công!<br>ID: $uid<br>Tên Tài Khoản: $usergame<br>Số Like Trước: $liketruoc<br>Số Like Sau: $like_sau<br>Số Like Buff Được: $buffduoc";
                msg_success($success_message, BASE_URL("/"),60000);
               
            } else {
               
                $NMQ->cong("users", "money", $money, " `username` = '".$getUser['username']."'");
                msg_error2("Không thể xử lý giao dịch, vui lòng thử lại");
            }
        } else {
            msg_error2("Không thể xử lý giao dịch, vui lòng thử lại");
        }
    }
}
?>
