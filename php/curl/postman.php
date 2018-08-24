<?php

function get($url, $params = array(), $headers = array(), $refer= '')
{
    $curl = curl_init();
    if (count($params)) {
        $url = $url . '?' . http_build_query($params);
    }
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_REFERER => 'http://m.medlive.test/mymedlive/invite_setinfo.php'
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


function post($url, $params) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($params),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
}

function curl_post($url, $data)
{
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        // CURLOPT_POST => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_RETURNTRANSFER => true,
    ));
    $output = curl_exec($ch);
    if ($output === false) {
        return 'ERROR: ' . curl_error($ch);
    }
    curl_close($ch);
    return $output;
}


$d = isset($_GET['d']) ? $_GET['d'] : "";

if ($d == 'invite_edit_user') {
    $url = 'http://m.medlive.test/mymedlive/invite/invite_edit_user.php?operate=username&token=&hashid=79830732805682&checkid=418380283106482';
    echo get($url);die;
} elseif ($d == 'invite_edit_user_ajax') {
    $url = 'http://m.medlive.test/mymedlive/ajax/invite_edit_user.ajax.php';
    $data = array(
        'name' => 'wq', 'hashid' => '79830732805682', 'checkid' => '418380283106482'
    );
    // $data = http_build_query($data);
    echo post($url, $data);die;
} else {
    $url = "http://api.medlive.test/adcms/ads?platform=2&branch=0&type=0&post=139604";
    $params = array('platform' => 2, 'branch' => 0, 'type' => 0, 'post' => 139604);
    $headers = array(
        "Api-Key: 34819d7beeabb9260a5c854bc85b3e44",
        "Cache-Control: no-cache",
        "Postman-Token: e23e4623-63ef-4c21-95d9-f9863e1f72b1",
    );
    var_dump(get($url, $params, $headers));
}