<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/config/common.php");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
////////////////////////////////////////////////////////////////////////////////
//                                                                            //
//   Copyright (C) 2021  WusTeam Development Team                             //
//   http://www.thanhdieu.com                                                 //
//                                                                            //
//   This program is free software. You can redistribute it and/or modify     //
//   it under the terms of either the current WusTeam License (viewable at    //
//   WusTeam.Com) or the WusTeam License that was distributed with this file  //
//                                                                            //
//   This program is distributed in the hope that it will be useful,          //
//   but WITHOUT ANY WARRANTY, without even the implied warranty of           //
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.                     //
//                                                                            //
//   You should have received a copy of the WusTeam License                   //
//   along with this program.                                                 //
//                                                                            //
////////////////////////////////////////////////////////////////////////////////

/** LANGUAGE [ VI-VN || FUNCTION [ EN-UK ] **/
class DatabaseConnection
{
    protected static $db;

    public static function SetDatabase($db)
    {
        self::$db = $db;
        self::$db->query("SET NAMES 'utf8mb4'");
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        if (!$db) {
            die(require_once($_SERVER['DOCUMENT_ROOT'].'/app/insert/error/Error.Connection.Database.php'));
        }
    }

    public static function ThanhDieuDB()
    {
        return self::$db;
    }
    public static function CurrentTime()
    {
        return date("Y-m-d H:i:s");
    }
}
class THANHDIEUSTART extends DatabaseConnection
{

    public function __construct()
    {
        $this->setTimeZone();
    }

    public function setTimeZone()
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }

    public function setDatabaseCharset()
    {
        self::ThanhDieuDB()->query("SET NAMES 'utf8mb4'");
    }

    public function getUserAgent()
    {
        return $_SERVER["HTTP_USER_AGENT"];
    }

    public function setSessionRequestTime()
    {
        $_SESSION["session_request"] = time();
    }

    public function getIPClient()
    {
        return $_SERVER["REMOTE_ADDR"];
    }

    public function getCurrentTime()
    {
        return date("Y-m-d H:i:s");
    }

    public function getFormatCurrentTime()
    {
        return date("H:i:s d-m-Y");
    }

    public function getWebsiteDomain()
    {
        return $_SERVER["HTTP_HOST"];
    }

    public function getCurrentURL()
    {
        return $_SERVER["REQUEST_URI"];
    }

    public function getDomain()
    {
        return $_SERVER["HTTP_HOST"];
    }

    public function getFullURL()
    {
        return 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
}
DatabaseConnection::SetDatabase($thanhdieudb);
$databaseWs = new THANHDIEUSTART();
$databaseWs->setDatabaseCharset();
$databaseWs->setSessionRequestTime();
$userAgent = $databaseWs->getUserAgent();
$time = $databaseWs->getCurrentTime();
$timeft = $databaseWs->getFormatCurrentTime();
$website_domain = $databaseWs->getWebsiteDomain();
$current_url = $databaseWs->getCurrentURL();
$domain = $databaseWs->getDomain();
$actual_link = $databaseWs->getFullURL();
$mysqlversion = DatabaseConnection::ThanhDieuDB()->get_server_info();
$ip = $databaseWs->getIPClient();
class Settings extends DatabaseConnection
{
    private $TD;

    public function __construct()
    {
        $this->TD = self::ThanhDieuDB()->query("SELECT * FROM `ws_settings`")->fetch_assoc();
    }

    public function Setting($data)
    {
        if ($data === 'ads' || $data === 'modal-content') {
            return $this->TD[$data] ?? null;
        }
        return isset($this->TD[$data]) ? THANHDIEU($this->TD[$data]) : null;
    }
}

$TD = new Settings();
class WebsResource
{
    public function MainResources()
    {
        return "public/src/vtd";
    }
    public function CSSResources()
    {
        return "public/src/vtd/css";
    }

    public function JSResources()
    {
        return "public/src/vtd/js";
    }

    public function IMGResources()
    {
        return "public/src/vtd/img";
    }

    public function LibraryResources()
    {
        return "public/src/vtd/libs";
    }
    public function PluginsResources()
    {
        return "public/src/vtd/plugins";
    }
    public function VendorResources()
    {
        return "public/src/vtd/vendor";
    }
    
    
    public function FontsResources()
    {
        return "public/src/vtd/fonts";
    }
    public function UserInfo($thanhdieudb)
    {
        global $TD;
        if (isset($_COOKIE["taikhoan"])) {
            $username = decrypt($_COOKIE["taikhoan"], $TD->Setting('key-aes'));
            $OoO = $thanhdieudb->prepare("SELECT * FROM `users` WHERE `username`=?");
            $OoO->bind_param("s", $username);
            if (!$OoO->execute()) {
                exit(
                    "Không thể truy vấn từ cơ sở dữ liệu, vui lòng kiểm tra lại!<br>" .
                    "<font color='red'>Lỗi: " . $OoO->error . "</font>"
                );
            }
            $result = $OoO->get_result();
            return $result->num_rows > 0 ? $result->fetch_assoc() : [];
        }
        return [];
    }
}
function encrypt($data, $key)
{
    $method = 'aes-256-cbc';
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
    $encrypted = openssl_encrypt($data, $method, $key, 0, $iv);
    $encrypted = base64_encode($iv . $encrypted);
    return $encrypted;
}

function decrypt($data, $key)
{
    $method = 'aes-256-cbc';
    $data = base64_decode($data);
    $iv_length = openssl_cipher_iv_length($method);
    $iv = substr($data, 0, $iv_length);
    $encrypted = substr($data, $iv_length);
    $decrypted = openssl_decrypt($encrypted, $method, $key, 0, $iv);
    return $decrypted;
}
$taikhoan = isset($_COOKIE['taikhoan']) ? decrypt($_COOKIE['taikhoan'], $TD->Setting('key-aes')) : null;
$admin = isset($_COOKIE['admin']) ? decrypt($_COOKIE['admin'], $TD->Setting('key-aes')) : null;
$webs = new WebsResource();
if ($taikhoan !== null) {
    $user = $webs->UserInfo($thanhdieudb);
} else {
    $user = null;
}
if (!isset($user['username'])) {
    setcookie('taikhoan', '', time() - 3600, "/", "", true, true);
    setcookie('admin', '', time() - 3600, "/", "", true, true);
}
$prefix ??= "";
$xetduyet = isset($user['rank']) && $user['rank'] == 'ctv' ? 2 : (isset($user['rank']) && in_array($user['rank'], ['admin', 'partner']) ? 1 : 0);
define("__SRC__", $webs->MainResources());
define("__CSS__", $webs->CSSResources());
define("__JS__", $webs->JSResources());
define("__IMG__", $webs->IMGResources());
define("__LIBRARY__", $webs->LibraryResources());
define("__PLUGINS__", $webs->PluginsResources());
define("__VENDOR__", $webs->VendorResources());
define("__FONTS__", $webs->FontsResources());
function THANHDIEU($value)
{
    if (is_array($value)) {
        return array_map("THANHDIEU", $value);
    } else {
        return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
    }
}
class Redirect
{
    public static function getParameter($name) {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
        return null;
    }
    public static function Login() {
        $redirect = self::getParameter('redirect');
        $login = '/oauth/dang-nhap';
        if ($redirect !== null) {
            $login .= '?redirect=' . urlencode($redirect);
        }
        return $login;
    }
    public static function Register() {
        $redirect = self::getParameter('redirect');
        $register = '/oauth/dang-ky';
        if ($redirect !== null) {
            $register .= '?redirect=' . urlencode($redirect);
        }
        return $register;
    }
}
class UserSession
{
    public static function CheckAdmin($user)
    {
        global $TD;
        if (
            isset($user["rank"]) &&
            (strtolower($user["rank"]) === "admin" || strtolower($user["rank"]) === "partner")
        ) {
            return true;
        } else {
            return false;
        }
    }

    public static function GetUsername($user)
    {
        return isset($user["username"]) ? $user["username"] : null;
    }
}
class CheckSessionLogin
{
    private $encryption_key;

    public function __construct()
    {
        global $TD;
        $this->encryption_key = $TD->Setting('key-aes');
    }

    public function TD($taikhoan, $user)
    {
        if (
            isset($_COOKIE["taikhoan"]) &&
            !empty($taikhoan) &&
            isset($user) &&
            (!isset($user["banned"]) || $user["banned"] != 1)
        ) {
            return decrypt($_COOKIE["taikhoan"], $this->encryption_key) === $taikhoan;
        } else {
            return false;
        }
    }
}

$isLogin = new CheckSessionLogin();
class SessionExpiredChecker
{
    private $encryption_key;

    public function __construct()
    {
        global $TD;
        $this->encryption_key = $TD->Setting('key-aes');
    }

    public function check($taikhoan, $user)
    {
        if ($taikhoan === null || (isset($user["banned"]) && $user["banned"] == 1)) {
            $this->logout();
            return true;
        }
        return false;
    }

    private function logout()
    {
        $taikhoan = null;
        setcookie('taikhoan', '', time() - 3600, "/");
        setcookie('admin', '', time() - 3600, "/");
    }
}

class CheckRank
{
    public static function rank($user)
    {
        if (!isset($user["rank"]) || $user["rank"] !== "admin") {
            return true;
        }
        return false;
    }
}
class CheckRankAndSession
{
    public static function TD($user, $taikhoan)
    {
        $sessionExpired = (new SessionExpiredChecker())->check($taikhoan, $user);
        if ($sessionExpired) {
            exit(
                json_encode([
                    "success" => false,
                    "message" => "Phiên đã hết hạn vui lòng đăng nhập lại!",
                ])
            );
        }
        if (!self::checkAdmin($user)) {
            exit(
                json_encode([
                    "success" => false,
                    "message" => "Chức năng này cần quyền hạn cao hơn!",
                ])
            );
        }

    }
    private static function checkAdmin($user)
    {
        return isset($user["rank"]) && $user["rank"] === "admin";
    }
}


class TDSpamChecker
{
    public static function TD($identifier, $TD)
    {
        global $TD;
        $timeWindow = 5;
        $blockTime = 30;
        $maxRequests = self::MaxRequests($TD->Setting('anti-spam'));
        $requestKey = "request_count_" . $identifier;
        $expiryKey = "request_expiry_" . $identifier;
        $blockUntilKey = "block_until_" . $identifier;
        $currentTime = time();
        if (!isset($_SESSION[$requestKey])) {
            $_SESSION[$requestKey] = 0;
        }
        if (!isset($_SESSION[$expiryKey])) {
            $_SESSION[$expiryKey] = $currentTime + $timeWindow;
        }
        if (!isset($_SESSION[$blockUntilKey])) {
            $_SESSION[$blockUntilKey] = 0;
        }

        if ($currentTime < $_SESSION[$blockUntilKey]) {
            return false;
        }

        if ($currentTime > $_SESSION[$expiryKey]) {
            $_SESSION[$requestKey] = 0;
            $_SESSION[$expiryKey] = $currentTime + $timeWindow;
        }

        $_SESSION[$requestKey]++;

        if ($_SESSION[$requestKey] > $maxRequests) {
            $_SESSION[$blockUntilKey] = $currentTime + $blockTime;
            return false;
        }
        return true;
    }
    private static function MaxRequests($sensitivity)
    {
        return $sensitivity == 0 ? random_int(3, 5) : random_int(2, 3);
    }
}
function valid_url($url)
{
    return filter_var($url, FILTER_VALIDATE_URL) !== false;

}
function valid_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

if ($TD->Setting("backupdb") == 1) {
    function BACKUP_DATABASE($thanhdieudb)
    {
        $folder = realpath(__DIR__ . "/../common/backup/");
        $latest_backup_file = glob($folder . "/backup-*.sql");
        if (!empty($latest_backup_file)) {
            $latest_backup_file = end($latest_backup_file);
            $last_backup_date = date("Y-m-d", filemtime($latest_backup_file));
        } else {
            $last_backup_date = null;
        }
        if ($last_backup_date !== date("Y-m-d")) {
            $backup_file_name = "backup-" . substr(uniqid(), -16) . ".sql";
            $backup_file_path = $folder . "/" . $backup_file_name;
            $return = "";
            $alltables = [];
            $result = mysqli_query($thanhdieudb, "SHOW TABLES");
            while ($row = mysqli_fetch_row($result)) {
                $alltables[] = $row[0];
            }

            foreach ($alltables as $table) {
                $result = mysqli_query($thanhdieudb, "SELECT * FROM " . $table);
                $num_fields = mysqli_num_fields($result);
                $return .= "DROP TABLE IF EXISTS " . $table . ";";
                $row2 = mysqli_fetch_row(
                    mysqli_query($thanhdieudb, "SHOW CREATE TABLE " . $table)
                );
                $return .= "\n\n" . $row2[1] . ";\n\n";

                for ($i = 0; $i < $num_fields; $i++) {
                    while ($row = mysqli_fetch_row($result)) {
                        $return .= "INSERT INTO " . $table . " VALUES(";
                        for ($j = 0; $j < $num_fields; $j++) {
                            $row[$j] = addslashes($row[$j]);
                            $row[$j] = str_replace("\n", "\\n", $row[$j]);
                            if (isset($row[$j])) {
                                $return .= '"' . $row[$j] . '"';
                            } else {
                                $return .= '""';
                            }
                            if ($j < $num_fields - 1) {
                                $return .= ",";
                            }
                        }
                        $return .= ");\n";
                    }
                }
                $return .= "\n\n";
            }

            $handle = fopen($backup_file_path, "w+");
            fwrite($handle, $return);
            fclose($handle);
        } else {
            $backup_file_created = false;
        }
    }
    BACKUP_DATABASE($thanhdieudb);
}
class WsCheckIMG
{
    public static function WsCheckImg($vlxx)
    {
        return in_array($vlxx, ["png", "jpg", "jpeg", "webp", "gif"]);
    }
    public static function SizeLimit($fileSize, $limit = 15)
    {
        if ($fileSize <= $limit * 1024 * 1024) {
            return true;
        } else {
            return "Kích thước của ảnh không được vượt quá giới hạn cho phép (15MB).";
        }
    }
}

class TimeFormatter
{
    private $dateTime;

    public function __construct($dateTime = null)
    {
        $this->dateTime = $dateTime ? new DateTime($dateTime) : new DateTime();
    }

    public function ThoiGian()
    {
        $FormattedDate = $this->dateTime->format('H:i');
        $DayOfWeek = $this->dateTime->format('l');
        $FormattedDate .= ' ' . $this->NgayTrongTuan($DayOfWeek) . ' ' . $this->dateTime->format('d/m/Y');
        return $FormattedDate;
    }

    private function NgayTrongTuan($DayOfWeek)
    {
        $Map = [
            'Monday'    => 'Thứ Hai',
            'Tuesday'   => 'Thứ Ba',
            'Wednesday' => 'Thứ Tư',
            'Thursday'  => 'Thứ Năm',
            'Friday'    => 'Thứ Sáu',
            'Saturday'  => 'Thứ Bảy',
            'Sunday'    => 'Chủ Nhật',
        ];
        
        return $Map[$DayOfWeek] ?? $DayOfWeek;
    }
}
/////////////---Vươ4ng Tha2nh Diệ1u---/////////////
class CheckPlanStatus extends DatabaseConnection
{
    public function TD($taikhoan)
    {
        $VTD = self::ThanhDieuDB()->prepare("SELECT * FROM ws_plans WHERE taikhoan = ? AND ngayhethan > NOW() AND trangthai = 1");
        $VTD->bind_param("s", $taikhoan);
        $VTD->execute();
        $OoO = $VTD->get_result();
        if ($OoO->num_rows > 0) {
            return $OoO->fetch_assoc();
        } else {
            return null;
        }
    }
}
$planChecker = new CheckPlanStatus();
$planInfo = $planChecker->TD($taikhoan);
class PlanExpiredChecker extends DatabaseConnection
{
    public static function TD()
    {
        $db = self::ThanhDieuDB();
        $vtd = $db->query("SELECT plans_id, taikhoan, tengoi
        FROM ws_plans
        WHERE ngayhethan <= NOW() AND trangthai != 0");

        if ($vtd && $vtd->num_rows > 0) {
            while ($row = $vtd->fetch_assoc()) {
                $plan_id = $row['plans_id'];
                $taikhoan = $row['taikhoan'];
                $plan_name = $row['tengoi'];
                $current_time = self::CurrentTime();
                $db->query("UPDATE ws_plans SET trangthai = 0 WHERE plans_id = '{$plan_id}'");
                $db->query("INSERT INTO ws_logs (username, content, time, action) VALUES ('$taikhoan', 'gói thành viên " . strtoupper($plan_name) . " đã hết hạn', '$current_time', 'Hết Hạn Gói Đăng Ký')");
            }
        }
    }
}
PlanExpiredChecker::TD();
class Plans extends DatabaseConnection
{
    public function TD($column, $account = null)
    {
        $current_time = self::CurrentTime();
        $vtd = self::ThanhDieuDB()->prepare("SELECT $column FROM ws_plans WHERE taikhoan = ? AND ngayhethan >= ? AND trangthai = 1");
        $vtd->bind_param("ss", $account, $current_time);
        $vtd->execute();
        $OoO = $vtd->get_result();
        if ($OoO && $OoO->num_rows > 0) {
            $row = $OoO->fetch_assoc();
            if (isset($row[$column])) {
                return $row[$column];
            }
        }
        return null;
    }
}

$plans = new Plans();
class SecurityUtils
{
    public static function DetectSQLInjection($sql)
    {
        if (
            preg_match(
                "/\b(union|select|insert|update|delete|drop|alter|truncate|exec|xp_cmdshell|or|order\s*by|from|where|and|group\s*by|having|char|nchar|varchar|nvarchar|cast|convert|declare|script|' OR '1'='1' -- -|' OR '1'='1' #|' OR 1=1 --|' OR 'x'='x' --|' OR 1=1 LIMIT 1 -- -|' OR 1=1; --|' OR '1'='1' --|' OR '1'='1'; --|' OR '1'='1'; DROP TABLE users -- -|' OR 1=CONVERT\(int, \(SELECT @@version\)\) --|' OR 1=\(SELECT COUNT\(\*\) FROM information_schema\.tables\) --|' OR 'x'='x' AND 'y'='y' --|' OR 'x'='x' AND 'y'='z' --|' UNION SELECT null, username, password FROM users --)\b/i",
                $sql
            ) &&
            !preg_match(
                "/' UNION SELECT null, username, password FROM users --/i",
                $sql
            )
        ) {
            return true;
        }
        return false;
    }
}

class CountFormatter
{
    public static function TD($td)
    {
        $td = $td ?? 0;
        if ($td >= 1000 && $td < 1000000) {
            return round($td / 1000, 1) . "K";
        } elseif ($td >= 1000000 && $td < 1000000000) {
            return round($td / 1000000, 1) . "M";
        } elseif ($td >= 1000000000) {
            return round($td / 1000000000, 1) . "B";
        } else {
            return $td;
        }
    }
}
class FormatNumber
{
    public static function TD($coin, $type = 1)
    {
        if (is_null($coin)) {
            $coin = 0;
        }
    
        if ($type == 1) {
            return number_format($coin, 0, ",", ".");
        } elseif ($type == 2) {
            return number_format($coin, 0, ",", ",");
        } else {
            return number_format($coin, 0, ",", ".");
        }
    }
    
    public static function PREG($number)
    {
        return preg_replace('/[^0-9]/', '', trim($number));
    }
    public static function STK($number)
    {
        return preg_replace('/(\d{4})(?=\d)/', '$1 ', self::PREG($number));
    }
}

class FormatTime
{
    public static function TD($time, $type = 2)
    {
        if ($type == 1) {
            return date('H:i:s d/m/Y', strtotime($time));
        } else {
            return date('H:i d/m/Y', strtotime($time));
        }
    }
}
class WsRandomString
{
    public static function TD($length = 10)
    {
        $numbers = "0123456789";
        $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $Letters = max(1, intdiv($length, 5));
        $Numbers = $length - $Letters;
        $random = '';
        for ($i = 0; $i < $Numbers; $i++) {
            $random .= $numbers[rand(0, strlen($numbers) - 1)];
        }
        for ($i = 0; $i < $Letters; $i++) {
            $random .= $letters[rand(0, strlen($letters) - 1)];
        }
        $random = str_shuffle($random);
        
        return $random;
    }

    public static function TD2($length = 16)
    {
        $numbers = "0123456789";
        $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $random = '';
        for ($i = 0; $i < $length - 1; $i++) {
            $random .= $numbers[rand(0, strlen($numbers) - 1)];
        }
        $randomLetter = $letters[rand(0, strlen($letters) - 1)];
        $randomPosition = rand(0, strlen($random));
        $random = substr_replace($random, $randomLetter, $randomPosition, 0);
        return $random;
    }
    public static function Key($length = 36)
    {
        $hex = bin2hex(random_bytes(max(36, intdiv($length, 2) * 2) / 2));
        $uuid = sprintf(
            '%012s-%04s-%04x-%04x-%012s',
            substr($hex, 0, 12),
            substr($hex, 12, 4),
            hexdec(substr($hex, 16, 4)) & 0x0fff | 0x4000,
            hexdec(substr($hex, 20, 4)) & 0x3fff | 0x8000,
            substr($hex, 24, 12)
        );

        return $uuid;
    }
}

class TextCutter
{
    public function characters($string, $length)
    {
        if (mb_strlen($string, 'UTF-8') > $length) {
            return mb_substr($string, 0, $length, 'UTF-8') . '...';
        }
        return $string;
    }
}
$cut = new TextCutter();
/** ----------------------------------------------------------------------------- */
/**
 * Giải Thích Update
 * $update->wusteam('update','tenbang', array('username' => 'taikhoan'), "id = 1")
 * trong đó tenbang là tên bảng cần update | id= 1 tức cột cụ thể cần update
 * tương tự into chỉ cần thay update thành into, into khong cần sài cột cụ thể
 * eg. $into->wusteam('insert', 'tenbang',array('username' => 'taikhoan','message' => 'Đây là thông báo')))
 */
class WussunSQL extends DatabaseConnection
{

    public function wusteam($action, $table, $data, $condition = null)
    {
        if ($action == 'insert') {
            $this->insert($table, $data);
        } else {
            die(json_encode(array("success" => false, "message" => "Hành động không hợp lệ: $action")));
        }
    }
    private function insert($table, $data)
    {
        $columns = array_keys($data);
        $values = array_values($data);
        $stmt = self::ThanhDieuDB()->prepare("INSERT INTO $table (" . implode(', ', $columns) . ") VALUES (" . rtrim(str_repeat('?, ', count($columns)), ', ') . ")");
        $stmt->bind_param(str_repeat('s', count($columns)), ...$values);
        $stmt->execute();
        $stmt->close();
    }
    // private function update1($table, $data, $condition) {
    //     if ($condition === null) {
    //         die("Điều kiện cập nhật không được cung cấp!");
    //     }
    //     $setExpressions = array();
    //     foreach ($data as $column => $value) {
    //         $setExpressions[] = "$column = ?";
    //     }
    //     $stmt = self::ThanhDieuDB()->prepare("UPDATE $table SET ".implode(",", $setExpressions)." WHERE $condition");
    //     $stmt->bind_param(str_repeat('s', count($data)), ...array_values($data));
    //     $stmt->execute();
    // }
    public function update($sql)
    {
        if (empty($sql)) {
            die("Câu lệnh SQL không được cung cấp!");
        }
        $stmt = self::ThanhDieuDB()->prepare($sql);
        if (!$stmt) {
            die("Lỗi trong quá trình chuẩn bị câu lệnh SQL!");
        }
        $stmt->execute();
        if ($stmt->errno) {
            die($stmt->error);
        }
    }
}
$update = new WussunSQL();
$into = new WussunSQL();
/** ----------------------------------------------------------------------------- */
function Base64_Enc($value)
{
    $encoded = base64_encode($value);
    $ws = rtrim($encoded, '=');
    return $ws;
}

function Base64_Dec($value)
{
    $padding = strlen($value) % 4;
    if ($padding) {
        $value .= str_repeat('=', 4 - $padding);
    }
    return base64_decode($value);
}

function isMobile()
{
    return preg_match(
        "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|ipad|ipod|pie|tablet|up\.browser|up\.link|webos|wos)/i",
        $_SERVER["HTTP_USER_AGENT"]
    );
}

function CheckStrongPassword($password)
{
    $hasLetter = false;
    $hasDigit = false;
    $hasSpecial = false;
    $specialCharacters = "!@#$%^&*()_+";

    if (strlen($password) < 6) {
        return false;
    }
    for ($i = 0; $i < strlen($password); $i++) {
        if (ctype_alpha($password[$i])) {
            $hasLetter = true;
        } elseif (ctype_digit($password[$i])) {
            $hasDigit = true;
        } elseif (strpos($specialCharacters, $password[$i]) !== false) {
            $hasSpecial = true;
        }
    }
    return ($hasLetter && $hasDigit) ||
        ($hasDigit && $hasSpecial) ||
        ($hasLetter && $hasSpecial);
}

function CheckPassword($password)
{
    if (preg_match('/^[a-zA-Z0-9~!@#$%^&*()_+]+$/', $password)) {
        return true;
    } else {
        return false;
    }
}
function CheckFullName($hovaten)
{
    if (preg_match('/[^\p{L}\p{N}\s]|[!@#$%^&*()_+={}\[\]:;"\'<>?,.\/\\`~|\\\\]/u', $hovaten)) {
        return false;
    } else {
        return true;
    }
}
function VerifyOldPassword($username, $password, $db)
{
    $tdtv = $db->prepare("SELECT password FROM users WHERE username=?");
    $tdtv->bind_param("s", $username);
    $tdtv->execute();
    $result = $tdtv->get_result();
    if ($result->num_rows === 1) {
        $w = $result->fetch_assoc();
        $hashed_pass = $w["password"];
        return password_verify($password, $hashed_pass);
    }
    return false;
}
function TaoMatKhauManh(
    $length = 13,
    $add_dashes = false,
    $available_sets = "hack"
) {
    $sets = [];
    if (strpos($available_sets, "h") !== false) {
        $sets[] = "abcdefghjkmnpqrstuvwxyz";
    }
    if (strpos($available_sets, "a") !== false) {
        $sets[] = "ABCDEFGHJKMNPQRSTUVWXYZ";
    }
    if (strpos($available_sets, "c") !== false) {
        $sets[] = "0123456789";
    }
    if (strpos($available_sets, "k") !== false) {
        $sets[] = '.!@#$*~-';
    }

    $all = null;
    $password = null;
    foreach ($sets as $set) {
        $password .= $set[array_rand(str_split($set))];
        $all .= $set;
    }

    $all = str_split($all);
    for ($i = 0; $i < $length - count($sets); $i++) {
        $password .= $all[array_rand($all)];
    }

    $password = str_shuffle($password);

    if (!$add_dashes) {
        return $password;
    }

    $dash_len = floor(sqrt($length));
    $dash_str = null;
    while (strlen($password) > $dash_len) {
        $dash_str .= substr($password, 0, $dash_len) . "-";
        $password = substr($password, $dash_len);
    }
    $dash_str .= $password;
    return $dash_str;
}
class RequestPageCount extends DatabaseConnection
{
    public function TD($page)
    {
        $vtd = self::ThanhDieuDB()->prepare("UPDATE ws_requestpages SET count_request = count_request + 1 WHERE pages = ?");
        $vtd->bind_param('s', $page);
        $vtd->execute();
        if ($vtd->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
$RequestUpdater = new RequestPageCount();
class TotalGolbal extends DatabaseConnection
{
    private $taikhoan;

    public function __construct($taikhoan)
    {
        $this->taikhoan = $taikhoan;
    }

    public function Users()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `users`");
    }

    public function BannedUsers()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `users` WHERE `banned` > 0");
    }

    public function Traffic()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_traffic`");
    }

    public function Money()
    {
        return $this->TD("SELECT SUM(tongnap) AS COUNT FROM `users` WHERE `tongnap` > 0");
    }

    public function Logs()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_logs`");
    }

    public function Bank()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_history_bank`");
    }

    public function Plans()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_plans` WHERE trangthai='1'");
    }

    public function VIP1()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_plans` WHERE tengoi='vip1'");
    }
    public function VIP2()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_plans` WHERE tengoi='vip2'");
    }  
    public function VIP3()
    {
        return $this->TD("SELECT COUNT(*) AS COUNT FROM `ws_plans` WHERE tengoi='vip3'");
    }
    public function checkBlackIP()
    {
        $oOo = self::ThanhDieuDB()->query("SELECT blackip FROM ws_settings");
        if ($oOo) {
            $data = $oOo->fetch_assoc();
            return $data ? $data["blackip"] : null;
        }
        return null;
    }

    private function TD($OWO)
    {
        $oOo = self::ThanhDieuDB()->query($OWO);
        if ($oOo) {
            $data = $oOo->fetch_assoc();
            return $data ? $data["COUNT"] : 0;
        }
        return 0;
    }
}
$totals = new TotalGolbal($taikhoan);
class Transfer extends DatabaseConnection
{
    public function TD($column, $record)
    {
        $offset = $record - 1;
        $vtd = self::ThanhDieuDB()->prepare("SELECT `$column` FROM ws_transfer LIMIT ?, 1");
        $vtd->bind_param("i", $offset);
        $vtd->execute();
        $result = $vtd->get_result();
        if ($row = $result->fetch_assoc()) {
            return $row[$column];
        } else {
            return 'Chưa cấu hình transfer';
        }
    }
}

$transfer = new Transfer();
class BlacklistChecker extends DatabaseConnection
{
    public function CheckBlacklist($ip, $TD)
    {
        $checkbanip = self::ThanhDieuDB()->query(
            "SELECT `black-ip` FROM ws_settings"
        );
        if ($checkbanip->num_rows > 0) {
            while ($row = $checkbanip->fetch_assoc()) {
                $blacklistIPs = explode("|", $row["black-ip"]);
                if (in_array($ip, $blacklistIPs)) {
                    $message = '<span>Your IP has been blacklisted, if you need support, contact us <a href="' .
                        $TD->Setting("zalo") .
                        '" target="_blank">here</a></span>.';
                    http_response_code(403);
                    header("HTTP/1.1 403 Forbidden");
                    die($message);
                }
            }
        }
    }
}
(new BlacklistChecker())->CheckBlacklist($ip, $TD);

function FilterTags($text)
{
    $blacklist = ["<script", "</script", "<?php", "?>"];
    foreach ($blacklist as $word) {
        $text = str_ireplace($word, Chars($word), $text);
    }
    return $text;
}
function Chars($text)
{
    return implode("/", str_split($text));
}
class BrowserInfo
{
    public $name;
    public $icon;

    public function __construct($userAgent)
    {
        $this->name = "Google Chrome";
        $this->icon = "chrome";

        if (strpos($userAgent, "Firefox") !== false) {
            $this->name = "Firefox";
            $this->icon = "firefox";
        } elseif (strpos($userAgent, "Chrome") !== false) {
            $this->name = "Google Chrome";
            $this->icon = "chrome";
        } elseif (strpos($userAgent, "Safari") !== false) {
            $this->name = "Safari";
            $this->icon = "safari";
        } elseif (strpos($userAgent, "Edge") !== false) {
            $this->name = "Microsoft Edge";
            $this->icon = "edge";
        } elseif (
            strpos($userAgent, "MSIE") !== false ||
            strpos($userAgent, "Trident") !== false
        ) {
            $this->name = "Internet Explorer";
            $this->icon = "ie";
        } elseif (strpos($userAgent, "Opera") || strpos($userAgent, "OPR")) {
            $this->name = "Opera";
            $this->icon = "opera";
        }
    }
}
class DeviceInfo
{
    public $name;
    public $icon;

    public function __construct($userAgent)
    {
        $this->name = "Không Xác Định";
        $this->icon = "android";

        if (strpos($userAgent, "Android") !== false) {
            $this->name = "Android";
            $this->icon = "android";
        } elseif (
            preg_match(
                "/iPhone(?:\s+OS)?\s([0-9_]+)?\s*.*\s*like\s*Mac OS X/",
                $userAgent,
                $matches
            )
        ) {
            $this->name = "iOS";
            $iphone_version = !empty($matches[1])
                ? str_replace("_", ".", $matches[1])
                : "";
            $this->name = $iphone_version ? "iPhone $iphone_version" : "iPhone";
            $this->icon = "apple";
        } elseif (strpos($userAgent, "iPad") !== false) {
            $this->name = "iPad";
            $this->icon = "apple";
        } elseif (strpos($userAgent, "Windows Phone") !== false) {
            $this->name = "Windows Phone";
            $this->icon = "win1";
        } elseif (strpos($userAgent, "Macintosh") !== false) {
            $this->name = "macOS";
            $this->icon = "mac";
        } elseif (strpos($userAgent, "Linux") !== false) {
            $this->name = "Linux";
            $this->icon = "linux";
        } elseif (strpos($userAgent, "Windows") !== false) {
            if (
                preg_match(
                    "/Windows\s(?:NT\s)?(\d+\.\d+)/",
                    $userAgent,
                    $windows_matches
                )
            ) {
                $windows_version = $windows_matches[1];
                $this->name = "Windows $windows_version";
            } elseif (
                preg_match(
                    "/Windows\s(?:NT\s)?(\d+)/",
                    $userAgent,
                    $windows_matches
                )
            ) {
                $windows_version = $windows_matches[1];
                $this->name = "Windows $windows_version";
            } else {
                $this->name = "Windows";
            }
            $this->icon = "win1";
        }
    }
}

$browser_info = new BrowserInfo($userAgent);
$device_info = new DeviceInfo($userAgent);
$browser_name = $browser_info->name;
$browser_icon = "icon-" . strtolower(str_replace(" ", "", $browser_info->icon));
$device_name = $device_info->name;
$device_icon = "icon-" . strtolower(str_replace(" ", "", $device_info->icon));
class ThoiGianTrongTuan
{
    public static $td = [
        "Monday" => "Thứ Hai",
        "Tuesday" => "Thứ Ba",
        "Wednesday" => "Thứ Tư",
        "Thursday" => "Thứ Năm",
        "Friday" => "Thứ Sáu",
        "Saturday" => "Thứ Bảy",
        "Sunday" => "Chủ Nhật",
    ];
}

$now = date("H:i l d/m/Y", time());

foreach (ThoiGianTrongTuan::$td as $english => $vietnamese) {
    $now = str_replace($english, $vietnamese, $now);
}

function SaveModal($f)
{
    return [
        'text' => $f ? 'Kích Hoạt' : 'Vô Hiệu Hoá',
        'color' => $f ? 'primary' : 'danger',
        'checked' => $f ? 'checked' : ''
    ];
}
function ucwordsFirst($str) {
    $words = explode(' ', $str);
    $words = array_map('ucfirst', $words);
    return implode(' ', $words);
}


function convertGroup($index)
{
    switch ($index) {
        case 11:
            return " decillion";
        case 10:
            return " nonillion";
        case 9:
            return " octillion";
        case 8:
            return " septillion";
        case 7:
            return " sextillion";
        case 6:
            return " quintrillion";
        case 5:
            return " nghìn triệu triệu";
        case 4:
            return " nghìn tỷ";
        case 3:
            return " tỷ";
        case 2:
            return " triệu";
        case 1:
            return " nghìn";
        case 0:
            return "";
    }
}

function convertThreeDigit($digit1, $digit2, $digit3)
{
    $buffer = "";

    if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0") {
        return "";
    }

    if ($digit1 != "0") {
        $buffer .= convertDigit($digit1) . " trăm";
        if ($digit2 != "0" || $digit3 != "0") {
            $buffer .= " ";
        }
    }

    if ($digit2 != "0") {
        $buffer .= convertTwoDigit($digit2, $digit3);
    } else if ($digit3 != "0") {
        $buffer .= convertDigit($digit3);
    }

    return $buffer;
}

function convertTwoDigit($digit1, $digit2)
{
    if ($digit2 == "0") {
        switch ($digit1) {
            case "1":
                return "mười";
            case "2":
                return "ai mươi";
            case "3":
                return "ba mươi";
            case "4":
                return "bốn mươi";
            case "5":
                return "năm mươi";
            case "6":
                return "sáu mươi";
            case "7":
                return "bảy mươi";
            case "8":
                return "tám mươi";
            case "9":
                return "chín mươi";
        }
    } else if ($digit1 == "1") {
        switch ($digit2) {
            case "1":
                return "mười một";
            case "2":
                return "mười hai";
            case "3":
                return "mười ba";
            case "4":
                return "mười bốn";
            case "5":
                return "mười lăm";
            case "6":
                return "mười sáu";
            case "7":
                return "mười bảy";
            case "8":
                return "mười tám";
            case "9":
                return "mười chín";
        }
    } else {
        $temp = convertDigit($digit2);
        if ($temp == 'năm') $temp = 'lăm';
        if ($temp == 'một') $temp = 'mốt';
        switch ($digit1) {
            case "2":
                return "hai mươi $temp";
            case "3":
                return "ba mươi $temp";
            case "4":
                return "bốn mươi $temp";
            case "5":
                return "năm mươi $temp";
            case "6":
                return "sáu mươi $temp";
            case "7":
                return "bảy mươi $temp";
            case "8":
                return "tám mươi $temp";
            case "9":
                return "chín mươi $temp";
        }
    }
}

function convertDigit($digit)
{
    switch ($digit) {
        case "0":
            return "không";
        case "1":
            return "một";
        case "2":
            return "hai";
        case "3":
            return "ba";
        case "4":
            return "bốn";
        case "5":
            return "năm";
        case "6":
            return "sáu";
        case "7":
            return "bảy";
        case "8":
            return "tám";
        case "9":
            return "chín";
    }
}
function convert_number_to_words($number)
{
    if (strpos($number, '.')) {
        list($integer, $fraction) = explode(".", (string)$number);
    } else { 
        $integer = $number;
        $fraction = NULL;
    }

    $output = "";

    if ($integer[0] == "-") {
        $output = "âm ";
        $integer = ltrim($integer, "-");
    } else if ($integer[0] == "+") {
        $output = "dương ";
        $integer = ltrim($integer, "+");
    }

    if ($integer[0] == "0") {
        $output .= "không";
    } else {
        $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
        $group = rtrim(chunk_split($integer, 3, " "), " ");
        $groups = explode(" ", $group);

        $groups2 = array();
        foreach ($groups as $g) {
            $groups2[] = convertThreeDigit($g[0], $g[1], $g[2]);
        }

        for ($z = 0; $z < count($groups2); $z++) {
            if ($groups2[$z] != "") {
                $output .= $groups2[$z] . convertGroup(11 - $z) . (
                    $z < 11
                    && !array_search('', array_slice($groups2, $z + 1, -1))
                    && $groups2[11] != ''
                    && $groups[11][0] == '0'
                        ? " "
                        : ", "
                    );
            }
        }

        $output = rtrim($output, ", ");
    }

    if ($fraction > 0) {
        $output .= " phẩy";
        for ($i = 0; $i < strlen($fraction); $i++) {
            $output .= " " . convertDigit($fraction[$i]);
        }
    }
$output .= " đồng";
$output = ucfirst($output);
    return $output;
}
class VIPHistory extends DatabaseConnection
{
    public function TongMuaGoi($condition) {
        $result = self::ThanhDieuDB()->query("SELECT COUNT(*) AS total FROM `ws_plans` WHERE $condition");
        if ($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }

    public function TongMuaHomNay() {
        $HomNay = date('Y-m-d');
        return $this->TongMuaGoi("DATE(ngaymua) = '$HomNay'");
    }

    public function TongMuaHomQua() {
        $HomQua = date('Y-m-d', strtotime('-1 day'));
        return $this->TongMuaGoi("DATE(ngaymua) = '$HomQua'");
    }

    public function TongMuaTuanNay() {
        $DauTuanNay = date('Y-m-d', strtotime('monday this week'));
        $CuoiTuanNay = date('Y-m-d', strtotime('sunday this week'));
        return $this->TongMuaGoi("DATE(ngaymua) BETWEEN '$DauTuanNay' AND '$CuoiTuanNay'");
    }

    public function TongMuaThangNay() {
        $DauThangNay = date('Y-m-01');
        $CuoiThangNay = date('Y-m-t');
        return $this->TongMuaGoi("DATE(ngaymua) BETWEEN '$DauThangNay' AND '$CuoiThangNay'");
    }
}

$history_goivip = new VIPHistory();
require_once($_SERVER['DOCUMENT_ROOT']. '/Bank/Bank1/Bank2/Bank3/Bank4/Bank5/yoooo.php');