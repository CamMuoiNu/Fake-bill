<?php
/**
 * Kết Nối CSDL
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
header('Content-Type: application/json');
$callback_api = 'https://duongcodes.net/thanhdieu.php';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $callback_api);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);
$data = [];
preg_match_all('/\[(.*?)\] => (.*?)(?=\[\d+]|$)/s', $response, $matches, PREG_SET_ORDER);

foreach ($matches as $match) {
    $key = trim($match[1]);
    $value = trim($match[2]);

    if (strpos($value, 'Array') === 0) {
        $data[$key] = [];
    } else {
        $data[$key] = $value;
    }
}

$AutoBank = false;
if (isset($data['trans_count']) && $data['trans_count'] > 0 && isset($data['transactions'])) {
    $transactions = [];
    foreach ($data['transactions'] as $transaction) {
        if ($transaction['dorC'] === 'C') {
            if (preg_match('/'.$TD->Setting('cuphap-naptien').'(\d+)/', $transaction['remark'], $matches)) {
                $userId = $matches[1];
                $username = _Username($userId);
                if ($username) {
                    if ($username === $taikhoan) {
                        CongTien($username, $transaction['amount'], $transaction['processDate'], $transaction['trxId']);
                        $AutoBank = true;
                        exit(json_encode(['status' => 'success', 'message' => 'Bạn đã nạp thành công số tiền ' . FormatNumber::TD($transaction['amount'], 2) . 'đ vào tài khoản!']));
                    }
                }
            }
        }
    }
}

if (!$AutoBank) {
    exit(json_encode(['status' => 'no-payment', 'message' => 'Chưa có giao dịch mới hoặc giao dịch quá thời gian quy định.']));
}

function _Username($userId) {
    global $thanhdieudb;
    $result = $thanhdieudb->query("SELECT username FROM users WHERE user_id = '{$userId}'");
    if ($result && $row = $result->fetch_assoc()) {
        return $row['username'];
    }
    return null;
}

function CongTien($username, $amount, $transactionDate, $transactionID) {
    global $thanhdieudb, $TD,$time;

    if ($amount < $TD->Setting('min-nap')) {
        $thanhdieudb->query("INSERT INTO ws_history_bank (username, loai, magiaodich, sotien, noidung, thoigian, trangthai) VALUES ('{$username}', 'Nạp Tự Động', '{$transactionID}', '{$amount}', 'Số tiền nạp dưới mức nạp tối thiểu', '{$transactionDate}', 'thatbai')");
        return;
    }
    
    if ($thanhdieudb->query("SELECT * FROM ws_history_bank WHERE magiaodich = '{$transactionID}'")->num_rows > 0) {
        return; 
    }
    
    $thanhdieudb->query("UPDATE users SET sodu = sodu + {$amount}, tongnap = tongnap + {$amount} WHERE username = '{$username}'");
    
    $thanhdieudb->query("INSERT INTO ws_history_bank (username, loai, magiaodich, sotien, noidung, thoigian, trangthai) VALUES ('{$username}', 'Nạp Tự Động', '{$transactionID}', '{$amount}', 'Nạp tiền auto MBBank', '{$transactionDate}', 'thanhcong')");
    
    $thanhdieudb->query("INSERT INTO ws_logs (username, content, time, action) VALUES ('{$username}', 'nạp tiền auto MBBank - Số tiền: " . FormatNumber::TD($amount, 2) . "đ', '" . $time . "', 'Nạp Tiền')");
}