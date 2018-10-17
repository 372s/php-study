<?php
/**
 * Created by PhpStorm.
 * User: wangqiang
 * Date: 2018/10/16
 * Time: 15:32
 */
header("Content-type: text/html; charset=utf-8");
function curl_get($url, $cookie = '', $cookie_file = '') {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Mobile Safari/537.36");
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    // cookie
    curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    $output = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);
    $output = trim($output, "\xEF\xBB\xBF");
    return $output;
}

function curl($url, $location = 1,$origin = null,$referer = null,$host = null) {
    $header = array(
        'Accept: */*',
        'Accept-Encoding: gzip, deflate',
        'Accept-Language: zh-CN,zh;q=0.9',
        'Connection: keep-alive',
        'Cookie: wuid=762921279572933; wuid_createAt=2018-10-16 16:45:49; fingerprint=luNtZjD6l6u1mS4ckMJX1539679549716; JSESSIONID=d11042bde8488a551abd6891f1df8a889be826a2b1134d3a804ff65d7637e507; weather_auth=2; UM_distinctid=1667c0f0f562df-0468ed6e12a4ee-43450521-13c680-1667c0f0f585be; Hm_lvt_15fafbae2b9b11d280c79eff3b840e45=1539679550,1539686248,1539744811; CNZZDATA1255169715=956954724-1539679559-%7C1539746625; captcha=s%3A8d63a8fc87fecc9fbeffdd5054849c1e.c748cauuKzY5%2BrgGef5FCbDPw5910hPTaqARIRcdexo; Hm_lpvt_15fafbae2b9b11d280c79eff3b840e45=1539748158; cn_1255169715_dplus=%7B%22distinct_id%22%3A%20%221667c0f0f562df-0468ed6e12a4ee-43450521-13c680-1667c0f0f585be%22%2C%22sp%22%3A%20%7B%22%24_sessionid%22%3A%200%2C%22%24_sessionTime%22%3A%201539748160%2C%22%24dp%22%3A%200%2C%22%24_sessionPVTime%22%3A%201539748160%7D%7D',
        'Host: www.yidianzixun.com',
        'Referer: http://www.yidianzixun.com/',
        'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Mobile Safari/537.36',
        'X-Requested-With: XMLHttpRequest',
    );
    if($host){
        $header = array_merge_recursive($header,array("Host:".$host));
    }
    if($origin){
        $header = array_merge_recursive($header,array("Origin:".$origin));
    }
    if($referer){
        $header = array_merge_recursive($header,array("Referer:".$referer));
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    // curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    // curl_setopt($ch, CURLOPT_COOKIE, 'wuid=762921279572933; wuid_createAt=2018-10-16 16:45:49; fingerprint=luNtZjD6l6u1mS4ckMJX1539679549716; JSESSIONID=d11042bde8488a551abd6891f1df8a889be826a2b1134d3a804ff65d7637e507; weather_auth=2; UM_distinctid=1667c0f0f562df-0468ed6e12a4ee-43450521-13c680-1667c0f0f585be; captcha=s%3A3e5b1719ce9b5c524879e2d18956f035.PGe1rNPIyO1mxwndrXoJMFhLQFbjPHy0IF%2BxB555xKg; Hm_lvt_15fafbae2b9b11d280c79eff3b840e45=1539679550,1539686248,1539744811; CNZZDATA1255169715=956954724-1539679559-%7C1539741225; cn_1255169715_dplus=%7B%22distinct_id%22%3A%20%221667c0f0f562df-0468ed6e12a4ee-43450521-13c680-1667c0f0f585be%22%2C%22sp%22%3A%20%7B%22%24_sessionid%22%3A%200%2C%22%24_sessionTime%22%3A%201539744815%2C%22%24dp%22%3A%200%2C%22%24_sessionPVTime%22%3A%201539744815%7D%7D; Hm_lpvt_15fafbae2b9b11d280c79eff3b840e45=1539744827');
    // curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    // curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    $output = curl_exec($ch);
    curl_close($ch);
    return trim($output, "\xEF\xBB\xBF");
}

function curl_get_content($url) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Accept-Encoding: gzip, deflate",
            "Accept-Language: zh-CN,zh;q=0.9",
            "Connection: keep-alive",
            "Host: www.yidianzixun.com",
            "Postman-Token: 4208b02f-44bd-46c6-901d-f7d35e9996b5",
            "Referer: http://www.yidianzixun.com/",
            "User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Mobile Safari/537.36",
            "X-Requested-With: XMLHttpRequest",
            "cache-control: no-cache",
            "cookie: wuid=762921279572933; wuid_createAt=2018-10-16 16:45:49; fingerprint=luNtZjD6l6u1mS4ckMJX1539679549716; JSESSIONID=d11042bde8488a551abd6891f1df8a889be826a2b1134d3a804ff65d7637e507; weather_auth=2; UM_distinctid=1667c0f0f562df-0468ed6e12a4ee-43450521-13c680-1667c0f0f585be; captcha=s%3A3e5b1719ce9b5c524879e2d18956f035.PGe1rNPIyO1mxwndrXoJMFhLQFbjPHy0IF%2BxB555xKg; Hm_lvt_15fafbae2b9b11d280c79eff3b840e45=1539679550,1539686248,1539744811; CNZZDATA1255169715=956954724-1539679559-%7C1539741225; cn_1255169715_dplus=%7B%22distinct_id%22%3A%20%221667c0f0f562df-0468ed6e12a4ee-43450521-13c680-1667c0f0f585be%22%2C%22sp%22%3A%20%7B%22%24_sessionid%22%3A%200%2C%22%24_sessionTime%22%3A%201539744815%2C%22%24dp%22%3A%200%2C%22%24_sessionPVTime%22%3A%201539744815%7D%7D; Hm_lpvt_15fafbae2b9b11d280c79eff3b840e45=1539744827"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}