<?php
if (isset($_POST['action']) && $_POST['action'] === 'thue-goi-vip') {
    $action = $_POST['action'] ?? '';
    $plan = $_POST['plan'] ?? '';
    if ((new SessionExpiredChecker())->check($taikhoan, $user)) {
        exit(json_encode(['success' => false, 'message' => 'Vui lòng đăng nhập để có thể thanh toán gói này!']));
    }
    $giatien = [
        'vip1' => $TD->Setting('vip1'),
        'vip2' => $TD->Setting('vip2'),
        'vip3' => $TD->Setting('vip3'),
    ];
    if (isset($giatien[$plan])) {
        if ($user['sodu'] < $giatien[$plan]) {
            $sotienThieu = $giatien[$plan] - $user['sodu'];
            exit(json_encode([
                'success' => false,
                'message' => 'Số dư không đủ để thuê gói ' . strtoupper($plan) . '. Vui lòng nạp thêm ' . FormatNumber::TD($sotienThieu, 2) . 'đ và thanh toán lại!'
            ]));
        }
        $vtd = $thanhdieudb->prepare("SELECT tengoi, ngayhethan FROM ws_plans WHERE taikhoan = ? AND trangthai = '1'");
        $vtd->bind_param('s', $taikhoan);
        $vtd->execute();
        $wusteam = $vtd->get_result();

        if ($wusteam->num_rows > 0) {
            $row = $wusteam->fetch_assoc();
            if ($row['tengoi'] === $plan) {
                if ($user['sodu'] < $giatien[$plan]) {
                    $sotienThieu = $giatien[$plan] - $user['sodu'];
                    exit(json_encode([
                        'success' => false,
                        'message' => 'Số dư không đủ để gia hạn gói ' . strtoupper($plan) . '. Vui lòng nạp thêm ' . FormatNumber::TD($sotienThieu, 2) . 'đ và thanh toán lại!'
                    ]));
                }
                switch ($plan) {
                    case 'vip1':
                        $expiry = "DATE_ADD(ngayhethan, INTERVAL 1 DAY)";
                        break;
                    case 'vip2':
                        $expiry = "DATE_ADD(ngayhethan, INTERVAL 1 MONTH)";
                        break;
                    case 'vip3':
                        $expiry = "DATE_ADD(ngayhethan, INTERVAL 1 YEAR)";
                        break;
                    default:
                        $expiry = "ngayhethan";
                }
                $vtd = $thanhdieudb->prepare("UPDATE ws_plans SET giatien = ?, ngaymua = NOW(), ngayhethan = $expiry WHERE taikhoan = ? AND tengoi = ?");
                $vtd->bind_param('dss', $giatien[$plan], $taikhoan, $plan);

                if ($vtd->execute()) {
                    $newSodu = $user['sodu'] - $giatien[$plan];
                    $vtd = $thanhdieudb->prepare("UPDATE users SET sodu = ?, tongtieu = tongtieu + ? WHERE username = ?");
                    $vtd->bind_param('dds', $newSodu, $giatien[$plan], $taikhoan);
                    if ($vtd->execute()) {
                        $thanhdieudb->query("INSERT INTO `ws_logs` SET `username`='$taikhoan', `content`='đã gia hạn gói " . strtoupper($plan) . " với giá $giatien[$plan]" . "đ', `time`='$time',`action`='Gia Hạn Gói Đăng Ký'");
                        exit(json_encode([
                            'success' => true,
                            'message' => 'Bạn đã gia hạn thành công gói ' . strtoupper($plan) . '. Gói sẽ hết hạn vào lúc: '.FormatTime::TD($plans->TD('ngayhethan', $taikhoan),1),
                            'vip' => $plan,
                            'hsd' => $plans->TD('ngayhethan', $taikhoan)
                        ]));
                    }
                } else {
                    exit(json_encode(['success' => false, 'message' => 'Lỗi khi gia hạn gói ' . strtoupper($plan) . '.']));
                }
            } elseif ($row['tengoi'] !== $plan) {
                exit(json_encode(['success' => false, 'message' => 'Bạn đang sử dụng gói ' . strtoupper($row['tengoi']) . '. Không thể thuê thêm gói này.']));
            }
        } else {
            switch ($plan) {
                case 'vip1':
                    $expiry = "DATE_ADD(NOW(), INTERVAL 1 DAY)";
                    break;
                case 'vip2':
                    $expiry = "DATE_ADD(NOW(), INTERVAL 1 MONTH)";
                    break;
                case 'vip3':
                    $expiry = "DATE_ADD(NOW(), INTERVAL 1 YEAR)";
                    break;
                default:
                    $expiry = "NULL";
            }
            $vtd = $thanhdieudb->prepare("INSERT INTO ws_plans (taikhoan, tengoi, giatien, ngaymua, ngayhethan, trangthai)
                    VALUES (?, ?, ?, NOW(), $expiry, '1')
                    ON DUPLICATE KEY UPDATE giatien = VALUES(giatien), ngaymua = VALUES(ngaymua), ngayhethan = VALUES(ngayhethan), trangthai = VALUES(trangthai)
                ");
            $vtd->bind_param('sss', $taikhoan, $plan, $giatien[$plan]);

            if ($vtd->execute()) {
                $newSodu = $user['sodu'] - $giatien[$plan];
                $vtd = $thanhdieudb->prepare("UPDATE users SET sodu = ?, tongtieu = tongtieu + ? WHERE username = ?");
                $vtd->bind_param('dds', $newSodu, $giatien[$plan], $taikhoan);
                if ($vtd->execute()) {
                    $thanhdieudb->query("INSERT INTO `ws_logs` SET `username`='$taikhoan', `content`='đã thuê gói " . strtoupper($plan) . " với giá $giatien[$plan]" . "đ', `time`='$time',`action`='Thuê Gói Đăng Ký'");
                    exit(json_encode([
                        'success' => true,
                        'message' => 'Bạn đã thanh toán thành công gói ' . strtoupper($plan) . '. Cảm ơn bạn đã tin tưởng sử dụng dịch vụ 😀.',
                        'vip' => $plan,
                        'hsd' => $plans->TD('ngayhethan', $taikhoan)
                    ]));
                } else {
                    exit(json_encode(['success' => false, 'message' => 'Lỗi khi cập nhật thông tin người dùng.']));
                }
            } else {
                exit(json_encode(['success' => false, 'message' => 'Lỗi khi thuê gói ' . strtoupper($plan) . '.']));
            }
        }
    } else {
        exit(json_encode(['success' => false, 'message' => 'Gói không tồn tại.']));
    }
}
if (isset($_POST['action']) && $_POST['action'] === 'change-apikey') {
    $vtd = $thanhdieudb->prepare("UPDATE users SET access_key = ? WHERE username = ?");
    if ($vtd) {
        $access_key = WsRandomString::Key();
        $vtd->bind_param('ss', $access_key, $taikhoan);
        if ($vtd->execute()) {
            exit(json_encode(['success' => true, 'message' => 'Access Key: '.$access_key , 'key' => $access_key]));
        } else {
            exit(json_encode(['success' => false, 'message' => 'Thay đổi khoá api key thất bại!']));
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] === 'history-payment') {
    if ((new SessionExpiredChecker())->check($taikhoan, $user)) {
        exit(json_encode(['success' => false, 'message' => 'Vui lòng đăng nhập để có thể xem lịch sử nạp tiền!']));
    }
    $result = $thanhdieudb->query("SELECT bank_id, username, loai, magiaodich, sotien, noidung, thoigian, trangthai FROM ws_history_bank WHERE username = '{$user['username']}' ORDER BY thoigian DESC");
    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                $row['magiaodich'],
                FormatNumber::TD($row['sotien']).'đ',
                $row['noidung'],
                FormatTime::TD($row['thoigian'],1),
                $row['trangthai']
            ];
        }
    } else {
        exit(json_encode(['success' => true, 'message' => 'Chưa có lịch sử giao dịch nào']));
    }
    $response = [
        'recordsTotal' => count($data),
        'data' => $data
    ];

    exit(json_encode(['success' => true, 'message' => $response]));
}