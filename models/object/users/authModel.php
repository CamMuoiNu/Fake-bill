<?php
/**
 * Xử Lý Đăng Ký Tài Khoản và Đăng Nhập
 */
if (!class_exists('DatabaseConnection')) {
    header('location: /');
    exit;
}

class UserAuthRegister extends DatabaseConnection
{
    public function __construct() {
    }

    public function register($username, $password, $repeat_password, $terms) {
        global $TD, $ip, $time;

        if (!$this->LimitSpamer()) {
            return $this->Response(false, 'Bạn thao tác quá thường xuyên. Vui lòng thử lại sau!');
        }
        if (!$terms) {
            return $this->Response(false, 'Bạn phải đồng ý với chính sách & điều khoản!');
        }
        if (empty($username) || empty($password) || empty($repeat_password)) {
            return $this->Response(false, 'Vui lòng không bỏ trống mục nào!');
        }
        if (!$this->ValidUsername($username)) {
            return $this->Response(false, 'Tên tài khoản không được chứa kí tự đặc biệt.');
        }
        if (!$this->ValidLength($username, 6, 22) || !$this->ValidLength($password, 6, 27)) {
            return $this->Response(false, 'Tên tài khoản hoặc mật khẩu quá ngắn, tối thiểu 6 ký tự!');
        }
        if ($this->ForbiddenUsername($username)) {
            return $this->Response(false, 'Tên tài khoản này không hợp lệ!');
        }
        if ($username === $password) {
            return $this->Response(false, 'Không được lấy tên tài khoản làm mật khẩu!');
        }
        if ($password !== $repeat_password) {
            return $this->Response(false, 'Mật khẩu nhập lại không khớp!');
        }
        if (!CheckPassword($password)) {
            return $this->Response(false, 'Mật khẩu không đúng định dạng!');
        }
        if (!CheckStrongPassword($password)) {
            return $this->Response(false, 'Mật khẩu của bạn quá dễ đoán, hãy chọn mật khẩu khác!');
        }
        if ($this->UsernameTaken($username)) {
            return $this->Response(false, 'Tên tài khoản đã tồn tại, hãy chọn tên tài khoản khác!');
        }
        if ($this->CreateUser($username, $password)) {
            return $this->Response(true, 'Tạo tài khoản mới thành công, tự động vào trang chủ sau 3s!');
        } else {
            return $this->Response(false, 'Đã xảy ra lỗi khi tạo tài khoản mới!');
        }
    }

    private function LimitSpamer() {
        global $TD, $ip;
        return TDSpamChecker::TD($ip, $TD);
    }

    private function ValidUsername($username) {
        return preg_match('/^[a-zA-Z0-9]+$/', $username);
    }

    private function ValidLength($input, $min, $max) {
        $length = mb_strlen($input, 'UTF-8');
        return $length >= $min && $length <= $max;
    }

    private function ForbiddenUsername($username) {
        $list = ['admin', 'dieu', 'cac', 'scam'];
        return array_filter($list, fn($keyword) => stripos($username, $keyword) !== false);
    }

    private function UsernameTaken($username) {
        $check = self::ThanhDieuDB()->prepare("SELECT COUNT(*) as count FROM users WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $result = $check->get_result();
        $row = $result->fetch_assoc();
        $check->close();
        return $row['count'] > 0;
    }

    private function CreateUser($username, $password) {
        global $TD, $ip, $time;
        $hashedpw = password_hash($password, PASSWORD_BCRYPT, ['cost' => 7]);
        $access_key = WsRandomString::Key();
        $vtd = self::ThanhDieuDB()->prepare("INSERT INTO users (username, password,access_key, ip) VALUES (?, ?, ?, ?)");
        $vtd->bind_param("ssss", $username, $hashedpw, $access_key, $ip);
        $insert = $vtd->execute();
        setcookie('taikhoan', encrypt($username, $TD->Setting('key-aes')), time() + (14 * 24 * 60 * 60), "/", "", true, true);
        $vtd->close();
        if ($insert) {
            $vtd_log = self::ThanhDieuDB()->prepare("INSERT INTO ws_logs (username, content, action, time) VALUES (?, ?, ?, ?)");
            $content = 'đã tạo tài khoản tại website';
            $action = 'Đăng Ký Tài Khoản';
            $vtd_log->bind_param("ssss", $username, $content, $action, $time);
            $vtd_log->execute();
            $vtd_log->close();
            return true;
        }
        return false;
    }

    private function Response($success, $message) {
        exit(json_encode(['success' => $success, 'message' => $message]));
    }
}

class UserLogin extends DatabaseConnection
{

    public function __construct()
    {
    }

    public function login($username_or_email, $password)
    {
        global $ip,$TD;
        $username_or_email = strtolower(trim($username_or_email));
        $password = trim($password);

        if (empty($username_or_email) || empty($password)) {
            return ['status' => false, 'message' => 'Vui lòng không bỏ trống mục nào!'];
        }
        if (!TDSpamChecker::TD($ip, $TD)) {
            exit(json_encode(['success' => false, 'message' => 'Bạn thao tác quá thường xuyên. Vui lòng thử lại sau!']));
        }
        if (valid_email($username_or_email)) {
            $vtd = self::ThanhDieuDB()->prepare("SELECT * FROM `users` WHERE `email`=?");
        } else {
            $vtd = self::ThanhDieuDB()->prepare("SELECT * FROM `users` WHERE `username`=?");
        }

        if (SecurityUtils::DetectSQLInjection($username_or_email) || SecurityUtils::DetectSQLInjection($password)) {
            return ['status' => false, 'message' => 'Phát hiện tấn công SQL Injection!', 'xss' => true];
        }
        $vtd->bind_param("s", $username_or_email);
        $vtd->execute();
        $OoO = $vtd->get_result();
        if ($OoO && $OoO->num_rows > 0) {
            $user = $OoO->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                if ($user['banned'] == 1) {
                    return ['status' => false, 'message' => 'Tài khoản của bạn đã bị đình chỉ, do không tuân thủ tiêu chuẩn cộng đồng!'];
                } else {
                    self::ThanhDieuDB()->query("UPDATE users SET ip='$ip' WHERE username='{$user['username']}'");
                    setcookie('taikhoan', encrypt($user['username'], $TD->Setting('key-aes')), time() + (14 * 24 * 60 * 60), "/", "", true, true);
                    return ['status' => true, 'message' => 'Đăng nhập thành công, tự động vào trang chủ sau 3s!'];
                }
            } else {
                return ['status' => false, 'message' => 'Tài khoản hoặc mật khẩu không chính xác!'];
            }
        } else {
            return ['status' => false, 'message' => 'Tài khoản hoặc mật khẩu không chính xác!'];
        }
    }
    public function Logout()
    {
        sleep(1);
        setcookie('taikhoan', '', time() - 3600, "/", "", true, true);
        setcookie('admin', '', time() - 3600, "/", "", true, true);
        return ['status' => true, 'message' => 'Đăng xuất thành công!'];
    }
}
class UserChangePassword extends DatabaseConnection
{    
    public function __construct(){}

    public function change($password_old, $password_new, $password_new_again)
    {
        global $taikhoan,$password2;

        if (empty($password_old) || empty($password_new) || empty($password_new_again)) {
            return ['success' => false, 'message' => 'Vui lòng không bỏ trống mục nào.'];
        }

        if ($password_new !== $password_new_again) {
            return ['success' => false, 'message' => 'Mật khẩu mới nhập lại không khớp.'];
        }
        if (!CheckPassword($password_new)) {
            return ['success' => false, 'message' => 'Mật khẩu không đúng định dạng!'];
        }
        if (!CheckStrongPassword($password_new)) {
            return ['success' => false, 'message' => 'Mật khẩu của bạn quá dễ đoán, hãy chọn mật khẩu khác!'];
        }
        $vtd = self::ThanhDieuDB()->prepare("SELECT password FROM users WHERE username = ?");
        $vtd->bind_param('s', $taikhoan);
        $vtd->execute();
        $vtd->bind_result($password2);
        $vtd->fetch();
        $vtd->close();

        if (!password_verify($password_old, $password2)) {
            return ['success' => false, 'message' => 'Mật khẩu cũ không chính xác.'];
        }

        if (password_verify($password_new, $password2)) {
            return ['success' => false, 'message' => 'Mật khẩu mới không được giống mật khẩu cũ.'];
        }

        $new_hashed_password = password_hash($password_new, PASSWORD_BCRYPT, ['cost' => 7]);
        $vtd = self::ThanhDieuDB()->prepare("UPDATE users SET password = ? WHERE username = ?");
        $vtd->bind_param('ss', $new_hashed_password, $taikhoan);
        if ($vtd->execute()) {
            return ['success' => true, 'message' => 'Mật khẩu đã được thay đổi thành công.'];
        } else {
            return ['success' => false, 'message' => 'Lỗi khi cập nhật mật khẩu.'];
        }
    }
}
if (isset($_POST['action']) && $_POST['action'] == 'user-auth-login') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $remember = isset($_POST['remember-me']) ? $_POST['remember-me'] : '';
    echo json_encode((new UserLogin($ip))->login($username, $password));
}
if (isset($_POST['action']) && $_POST['action'] == 'user-auth-register') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $repeat_password = trim($_POST['repeat-password']);
    $terms = isset($_POST['terms']) ? (bool)$_POST['terms'] : false;
    echo json_encode((new UserAuthRegister())->register($username, $password, $repeat_password, $terms));
}
if (isset($_POST['action']) && $_POST['action'] == 'user-change-password') {
    $password_old = trim($_POST['password-old']);
    $password_new = trim($_POST['password-new']);
    $password_new_again = trim($_POST['password-new-again']);
    echo json_encode((new UserChangePassword())->change($password_old, $password_new, $password_new_again));
}
if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    echo json_encode((new UserLogin($ip))->Logout());
}