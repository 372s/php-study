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

function curl_get_content($url) {
    $curl = curl_init();
    $setopt = array(
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
            "Referer: http://www.yidianzixun.com/article/0KHBxofo?s=",
            "User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Mobile Safari/537.36",
            "X-Requested-With: XMLHttpRequest",
            "cache-control: no-cache",
            "cookie: wuid=762921279572933; wuid_createAt=2018-10-16 16:45:49; fingerprint=luNtZjD6l6u1mS4ckMJX1539679549716; JSESSIONID=d11042bde8488a551abd6891f1df8a889be826a2b1134d3a804ff65d7637e507; weather_auth=2; UM_distinctid=1667c0f0f562df-0468ed6e12a4ee-43450521-13c680-1667c0f0f585be; captcha=s%3A3e5b1719ce9b5c524879e2d18956f035.PGe1rNPIyO1mxwndrXoJMFhLQFbjPHy0IF%2BxB555xKg; Hm_lvt_15fafbae2b9b11d280c79eff3b840e45=1539679550,1539686248,1539744811; CNZZDATA1255169715=956954724-1539679559-%7C1539741225; cn_1255169715_dplus=%7B%22distinct_id%22%3A%20%221667c0f0f562df-0468ed6e12a4ee-43450521-13c680-1667c0f0f585be%22%2C%22sp%22%3A%20%7B%22%24_sessionid%22%3A%200%2C%22%24_sessionTime%22%3A%201539744815%2C%22%24dp%22%3A%200%2C%22%24_sessionPVTime%22%3A%201539744815%7D%7D; Hm_lpvt_15fafbae2b9b11d280c79eff3b840e45=1539744827"
        ),
//        CURLOPT_REFERER => 'http://www.yidianzixun.com/article/0KHBxofo?s=',
        CURLOPT_USERAGENT => "Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Mobile Safari/537.36",
    );
    curl_setopt_array($curl, $setopt);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}

function curl_get_content_detail($url) {
    $curl = curl_init();
    $setopt = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
            "Accept-Encoding: gzip, deflate",
            "Accept-Language: zh-CN,zh;q=0.9",
            "Content-type: image/jpeg",
            "Connection: keep-alive",
            "User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Mobile Safari/537.36",
            "cookie: JSESSIONID=ca9cb4217619f6fa9cb9e1fb0251a25d6dcbe0fcb6b42f722731319d9f936e04; wuid=858333728975137; wuid_createAt=2018-10-17 21:21:13; weather_auth=2; UM_distinctid=166822ff75f2d9-0578cdeefa5cce-8383268-144000-166822ff760efc; fingerprint=njeLBO5agsBvgrdOZ3lR1539782477780; CNZZDATA1255169715=2039961635-1539782310-%7C1539785484; Hm_lvt_15fafbae2b9b11d280c79eff3b840e45=1539782473,1539794706; cn_1255169715_dplus=%7B%22distinct_id%22%3A%20%22166822ff75f2d9-0578cdeefa5cce-8383268-144000-166822ff760efc%22%2C%22sp%22%3A%20%7B%22%24_sessionid%22%3A%200%2C%22%24_sessionTime%22%3A%201539794715%2C%22%24dp%22%3A%200%2C%22%24_sessionPVTime%22%3A%201539794715%7D%7D; Hm_lpvt_15fafbae2b9b11d280c79eff3b840e45=1539794725",
            "Host: www.yidianzixun.com",
            "Referer: http://www.yidianzixun.com/",
            "Upgrade-Insecure-Requests: 1",
            "User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Mobile Safari/537.36",
        ),
    );
    curl_setopt_array($curl, $setopt);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}