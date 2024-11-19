<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'thanhdieu-installer-v2') {
    usleep(500000);
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $dbServer = trim($_POST['__ThanhDieuDbServer']);
    $dbName = trim($_POST['__ThanhDieuDbName']);
    $dbUser = trim($_POST['__ThanhDieuDbUser']);
    $dbPwd = trim($_POST['__ThanhDieuDbPwd']);
    $access_key = trim($_POST['access_key']);
    $taikhoan = trim($_POST['taikhoan']);
    $matkhau = password_hash($_POST['matkhau'], PASSWORD_BCRYPT, ['cost' => 7]);
    $quyenhan = $_POST['quyenhan'];
    $response = ['success' => false, 'message' => ''];
    try {
        $thanhdieudb = new mysqli($dbServer, $dbUser, $dbPwd);
        if ($thanhdieudb->connect_error) {
            throw new Exception('Kết nối thất bại: ' . $thanhdieudb->connect_error);
        }

        if ($thanhdieudb->select_db($dbName) === FALSE) {
            throw new Exception('Không thể chọn cơ sở dữ liệu: ' . $thanhdieudb->error);
        }

        $sql_file = $_SERVER['DOCUMENT_ROOT'] . '/install/fakebill.sql';
        if (file_exists($sql_file)) {
            $sql = file_get_contents($sql_file);
            $multi_query_result = $thanhdieudb->multi_query($sql);
            if (!$multi_query_result) {
                throw new Exception('Lỗi nhập dữ liệu SQL: ' . $thanhdieudb->error);
            }
            do {
                if ($result = $thanhdieudb->store_result()) {
                    $result->free();
                }
            } while ($thanhdieudb->next_result());

            $db_config = '<?php' . PHP_EOL .
                '$localhost_db = \'' . $dbServer . '\';' . PHP_EOL .
                '$username_db = \'' . $dbUser . '\';' . PHP_EOL .
                '$password_db = \'' . $dbPwd . '\';' . PHP_EOL .
                '$database_db = \'' . $dbName . '\';' . PHP_EOL;

            @file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/function/connect/db.php', $db_config);
            $thanhdieudb->set_charset("utf8mb4");
            $stmt = $thanhdieudb->prepare("INSERT INTO users (`access_key`, `username`, `password`, `rank`) VALUES (?, ?, ?, ?)");

            $stmt->bind_param("ssss", $access_key, $taikhoan, $matkhau, $quyenhan);
            if (!$stmt->execute()) {
                throw new Exception('Lỗi khi khi tạo tài khoản: ' . $stmt->error);
            }
            $stmt->close();
            $secret_key = bin2hex(openssl_random_pseudo_bytes(12));
            $UpdateDeploys = $thanhdieudb->prepare("UPDATE ws_settings SET `key-aes`=?");
            $UpdateDeploys->bind_param("s", $secret_key);
            if (!$UpdateDeploys->execute()) {
                throw new Exception('Lỗi khi cập nhật: ' . $UpdateDeploys->error);
            }
            $UpdateDeploys->close();
            if (!unlink($sql_file)) {
                throw new Exception('Không thể xóa tệp fakebill.sql.');
            }
            if (file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/install.lock', 'thanhdieu') === false) {
                throw new Exception('Không thể tạo file fakebill.lock.');
            }
            $response['success'] = true;
            function encrypt($data, $key)
            {
                $method = 'aes-256-cbc';
                $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
                $encrypted = openssl_encrypt($data, $method, $key, 0, $iv);
                $encrypted = base64_encode($iv . $encrypted);
                return $encrypted;
            }
            setcookie('taikhoan', encrypt($taikhoan, $secret_key), time() + (14 * 24 * 60 * 60), "/", "", true, true);
            $response['message'] = '<b>Cài đặt CSDL Hoàn Tất!</b><br>Tài Khoản: ' . $taikhoan . '<br>Mật Khẩu: ' . trim($_POST['matkhau']) . '';
        } else {
            throw new Exception('Không tìm thấy file sql fakebill.sql ở mục /install/.');
        }
        $thanhdieudb->close();
    } catch (Exception $e) {
        $response['message'] = 'Thông tin kết nối không chính xác, vui lòng quay lại bước cấu hình CSDL.<br><br>Lỗi chi tiết: ' . $e->getMessage();
        // $response['message'] = $e->getMessage();
    }
    exit(json_encode($response));
}