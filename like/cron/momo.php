<?php
    require_once("../config/config.php");
    require_once("../config/function.php");

    if($NMQ->site('api_momo') == '')
    {
        die('Thiếu API');
    }
    if(time() - $NMQ->site('check_time_cron') < 50)
    {
        die('Không thể cron vào lúc này!');
    }
    $NMQ->update("options", [
        'value' => time()
    ], " `name` = 'check_time_cron' ");
    $token = $NMQ->site('api_momo');
    $dataPost = array(
 "Loai_api" => "lsgd1h",
 );
 $curl = curl_init();
 curl_setopt_array($curl, array(
 CURLOPT_URL => "https://api.dichvudark.vn/api/ApiMomo",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_SSL_VERIFYPEER => false,
 CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 30,
 CURLOPT_CUSTOMREQUEST => "POST",
 CURLOPT_POSTFIELDS => $dataPost,
 CURLOPT_HTTPHEADER => array(
 "Code: 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",
 "Token: $token",
 "Hour: 1")
 ));
 $response = curl_exec($curl);
 curl_close($curl);
 //hiện kết quả
 
 
    $result = json_decode($response, true);
    foreach($result['tranList'] as $data)
    {
        $partnerId      = $data['partnerId'];               // SỐ ĐIỆN THOẠI CHUYỂN
        $comment        = $data['comment'];                 // NỘI DUNG CHUYỂN TIỀN
        $tranId         = $data['tranId'];                  // MÃ GIAO DỊCH
        $partnerName    = $data['partnerName'];             // TÊN CHỦ VÍ
        $id_momo        = parse_order_id($comment);         // TÁCH NỘI DUNG CHUYỂN TIỀN
        $amount         = $data['amount'];

       
        if ($id_momo)
        {
            $row = $NMQ->get_row(" SELECT * FROM `users` WHERE `id` = '$id_momo' ");
            if($row['id'])
            {
                if($NMQ->num_rows(" SELECT * FROM `momo` WHERE `tranId` = '$tranId' ") == 0)
                {
                    $create = $NMQ->insert("momo", array(
                        'tranId'        => $tranId,
                        'username'      => $row['username'],
                        'comment'       => $comment,
                        'time'          => gettime(),
                        'partnerId'     => $partnerId,
                        'amount'        => $amount,
                        'partnerName'   => $partnerName
                    ));
                    if ($create)
                    {
                        $real_amount = $amount + $amount * $NMQ->site('ck_bank') / 100;
                        $isCheckMoney = $NMQ->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");

                        if($isCheckMoney)
                        {
                            $NMQ->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                            $NMQ->insert("dongtien", array(
                                'sotientruoc'   => $row['money'],
                                'sotienthaydoi' => $real_amount,
                                'sotiensau'     => $row['money'] + $real_amount,
                                'thoigian'      => gettime(),
                                'noidung'       => 'Nạp tiền tự động qua ví MOMO ('.$tranId.')',
                                'username'      => $row['username']
                            ));
                        }
                    }
                }
            }
        }         
    }
 