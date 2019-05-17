<?php
/**
 * 获取状态码
 */
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "http://php-study.local/curl/input.php",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "deliver=你好|78249|8|13800000000|abcd|2016-09-10 11:08:14"
));
$response = curl_exec($curl);
$code = curl_getinfo($curl,CURLINFO_HTTP_CODE); // 获取HTTP状态码
$err = curl_error($curl);
curl_close($curl);
echo $code . "\n";
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response . "\n";
}