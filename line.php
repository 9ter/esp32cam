<?php

$access_token = 'alvDI2aZV1OzfUOv6alPIVjb7mqTigkdbjpwQsKlV15';

// ข้อความที่ต้องการส่ง
$message = "ร้านค้า  \nยอดขายของวันนี้ \n บาท \nยอดขายย้อนหลัง 30 วัน \n บาท ";

// URL ของ Line Notify API
$url = 'https://notify-api.line.me/api/notify';

// ตัวแปรที่จำเป็นสำหรับการเรียก API
$data = array('message' => $message);
$options = array(
    'http' => array(
        'header' => "Authorization: Bearer $access_token\r\n" .
            "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data),
    ),
);

// ใช้ stream context ในการเรียก API
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// ตรวจสอบผลลัพธ์
if ($result === FALSE) {
    echo 'Error sending Line Notify!';
} else {
    echo 'Line Notify sent successfully!';
}
?>