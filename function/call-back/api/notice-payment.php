<?php
/**
 * Kết Nối CSDL
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
if ($taikhoan !== null) {
    $check = isset($_SESSION['check_' . $taikhoan]) ? $_SESSION['check_' . $taikhoan] : '1970-01-01 00:00:00';
    $vtd = $thanhdieudb->prepare("SELECT * FROM ws_history_bank WHERE username = ? AND thoigian > ? ORDER BY thoigian DESC LIMIT 1");
    $vtd->bind_param("ss", $taikhoan, $check);
    $vtd->execute();
    $OoO = $vtd->get_result();
    if ($OoO->num_rows > 0) {
        $transaction = $OoO->fetch_assoc();
        $current_time = new DateTime();
        $transaction_time = new DateTime($transaction['thoigian']);
        $time_diff = $current_time->getTimestamp() - $transaction_time->getTimestamp();
        if ($transaction['trangthai'] === 'thanhcong' && $time_diff <= 120) {
            $response['status'] = 'success';
            $response['message'] = 'Bạn đã nạp tiền ' . number_format($transaction['sotien']) . 'đ vào tài khoản thành công!';
        }
        $_SESSION['check_' . $taikhoan] = $transaction['thoigian']; 
    } else {
        $_SESSION['check_' . $taikhoan] = $time;
    }
    $vtd->close();
}

if (!empty($response)) {
    header('Content-Type: application/json');
    echo json_encode($response);
}