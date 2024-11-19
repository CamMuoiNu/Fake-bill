<?php
/**
* Kết Nối CSDL
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
/**
* @author Vương Thanh Diệu
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/render/Watermark.php');
/**
* Xử Lý User-Auth
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/users/authModel.php');
/**
* Fakebill MB Bank Mới
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/render/mbbank-new.php');
/**
* Fakebill Vietcombank Mới
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/render/vietcombank-new.php');
/**
* Fakebill Techcombank
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/render/techcombank.php');
/**
* Fakebill Vietinbank
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/render/vietinbank.php');
/**
* Fakebill ACB
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/render/acb.php');
/**
* Fakebill Momo
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/render/momo.php');
/**
* Fakebill TPBank
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/render/tpbank.php');
/**
* Fakebill MSB
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/render/msb.php');
/**
* Fake Số Dư Vietinbank
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/render/vietinbank-sodu.php');
/**
* Fake Số Dư Momo
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/render/momo-sodu.php');
/**
* HandleMainModel
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/users/handleMainModel.php');
/**
* Fake Số Dư Mbbank
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/models/object/render/mbbank-sodu.php');
// function DearLicy_notice() {    
//     global $wpdb;    
    
//     // 定义SQL查询来获取最新注册的十个用户    
//     $sql = "SELECT ID, user_login, user_registered    
//             FROM $wpdb->users    
//             ORDER BY user_registered DESC    
//             LIMIT 10";    //将10改为20则获取20个用户
    
//     // 执行查询    
//     $users = $wpdb->get_results($sql);    
    
//     $slides = ''; // 初始化$slides变量，用于存储每个用户的HTML代码片段    
    
//     // 遍历结果集并生成HTML代码    
//     if ($users) {    
//         foreach ($users as $user) {    
//             $user_name = $user->user_login;    
//             $avatar     = zib_get_avatar_box($user->ID, 'avatar-img avatar-mini mr6', false, true);
//             $link     = zib_get_user_home_url($user->ID);
//             $registration_date = date('Y-m-d H:i:s', strtotime($user->user_registered));  
  
//             // 为每个用户生成一个swiper-slide  
//             $slide = '<div class="swiper-slide notice-slide">';  
//             $slide .= '<a class="text-ellipsis" href="'.$link.'">' . $avatar . $user_name . ' 在 ' . $registration_date . ' 加入了本站</a>';  
//             $slide .= '</div>';  
  
//             // 拼接每个用户的HTML代码片段  
//             $slides .= $slide;  
//         }    
//     } 
  
//     // 构建完整的HTML结构  
//     $html = '<div class="swiper-bulletin c-red radius8">';  
//     $html .= '<div class="new-swiper" data-interval="5000" data-direction="vertical" data-loop="true" data-autoplay="1">';  
//     $html .= '<div class="swiper-wrapper">';  
//     $html .= $slides; // 插入所有用户的HTML代码片段  
//     $html .= '</div>';  
//     $html .= '<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>';  
//     $html .= '</div>';  
//     $html .= '</div>';  
  
//     return $html; // 返回生成的HTML代码    
// }