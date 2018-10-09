<?php

class Curl
{
    /**
     * get请求,访问url返回结果
     */
    public function https_get($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        if ($output === false) {
            $output = array('error' => 'ERROR: ' . $error);
        } else {
            $output = json_decode($output, true);
        }
        return $output;
    }

    /**
     * get请求,访问url返回结果
     */
    public function https_post($url, $post_data = array())
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        if ($output === false) {
            $output = array('error' => 'ERROR: ' . $error);
        } else {
            $output = json_decode($output, true);
        }
        return $output;
    }

    public function https_request($url, $method = 'GET', $data = array())
    {
        $curl = curl_init(); //1.初始化
        curl_setopt($curl, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method); //3.请求方式
        //4.参数如下
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        if ($method == "POST") { //5.post方式的时候添加数据
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        if ($output === false) {
            $output = array('error' => 'ERROR: ' . $error);
        } else {
            $output = json_decode($output, true);
        }
        return $output;
    }

    public function curl_request($api, $method = 'GET', $params = array(), $headers = [])
    {
        $curl = curl_init();
        switch (strtoupper($method)) {
            case 'GET':
                if (!empty($params)) {
                    $api .= (strpos($api, '?') ? '&' : '?') . http_build_query($params);
                }
                curl_setopt($curl, CURLOPT_HTTPGET, true);
                break;
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
            case 'PUT':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
            case 'DELETE':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                break;
        }
        curl_setopt($curl, CURLOPT_URL, $api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);
        // var_dump($response);
        if ($response === false) {
            $response = array('error' => 'ERROR: ' . $error);
        } else {
            $response = json_decode($response, true);
        }
        
        return $response;
    }
}
