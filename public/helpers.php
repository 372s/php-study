<?php

if (!function_exists('str_microtime')) {
    /**
     * 获取当前毫秒的时间
     */
    function format_microtime()
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }
}

if (!function_exists('str_random')) {
    /**
     * 随机固定长度字符串
     * @param int $length
     * @param int $type
     * @return string
     */
    function str_random($length = 30, $type = 1)
    {
        if ($type == 1) {
            $pool = '0123456789';
        } else if ($type == 2) {
            $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } else if ($type == 3) {
            $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } else {
            return 1;
        }
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }
}

function json_encode_zh($array)
{
    if(version_compare(PHP_VERSION,'5.4.0','<')){
        $str = json_encode($array);
        $str = preg_replace_callback("#\\\u([0-9a-f]{4})#i",function($matchs){
            return iconv('UCS-2BE', 'UTF-8', pack('H4', $matchs[1]));
        },$str);
        return $str;
    }else{
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}

/**
 * 创建匿名函数 和 json_encode()中文不转义处理
 * @param string $str
 * @return string
 */
function decodeUnicode($str)
{
    return preg_replace_callback('/\\\u([0-9a-f]{4})/i',
        create_function(
            '$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
        ),
        $str);
}

function cutStr($string, $length, $dot = '...') {
    //记载原始内容
    $oldString = $string;
    $string = str_replace(array('&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array(' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
    $iActLength = (strlen($string)+mb_strlen($string,"UTF-8"))/2;
    if($iActLength <= $length) {
        return $oldString;
    }

    $strcut = '';
    $n = $tn = $noc = 0;
    while($n < strlen($string)) {

        $t = ord($string[$n]);
        if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
            $tn = 1; $n++; $noc++;
        } elseif(194 <= $t && $t <= 223) {
            $tn = 2; $n += 2; $noc += 2;
        } elseif(224 <= $t && $t <= 239) {
            $tn = 3; $n += 3; $noc += 2;
        } elseif(240 <= $t && $t <= 247) {
            $tn = 4; $n += 4; $noc += 2;
        } elseif(248 <= $t && $t <= 251) {
            $tn = 5; $n += 5; $noc += 2;
        } elseif($t == 252 || $t == 253) {
            $tn = 6; $n += 6; $noc += 2;
        } else {
            $n++;
        }

        if($noc >= $length) {
            break;
        }

    }
    if($noc > $length) {
        $n -= $tn;
    }

    $strcut = substr($string, 0, $n);
    $strcut = str_replace(array('"', "'", '<', '>'), array('&quot;', '&#039;', '&lt;', '&gt;'), $strcut);
    if (!empty($dot)) {
        $dot = '<em style="font-size:12px;">'.$dot.'</em>';
    }
    return $strcut.$dot;
}

function getStrLen($str) {
    $str = str_replace(array('&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array(' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $str);
    $iActLength = (strlen($str)+mb_strlen($str,"UTF-8"))/2;
    return $iActLength;
}

/**
 * 获取内容的第一个图片
 * @param string $sHtml
 * @return string
 */
function getFirstImg($sHtml) {
    preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $sHtml, $aMatches);
    if (!empty($aMatches[1][0])) {
        $aUrl = parse_url($aMatches[1][0]);
        // 如果是站内图片, 获取稍小的缩略图
        if (sg($aUrl['host']) == DOMAIN_WEBRES && (strpos($aUrl['path'], '/upload/thumb') === 0)) {
            $aPieces = preg_split('/[\/_]/', $aUrl['path']);
            return Upload::getThumb($aPieces[3].$aPieces[4].$aPieces[5], 'feed');
        } else {
            return $aMatches[1][0];
        }
    } else {
        return '';
    }
}

function sha256($str,$salt='pwoerqwelkasdpfouaidsvqweprouqwe') {
    return hash('sha256',$str . $salt);
}

//校验敏感词
function hasDenyWord($words, $bIsNeed=true, $iIntevalLen=5) {
    if ($bIsNeed) {
        if (!Profile::isNeedCheckDenyWordForbid(Session::id())) {
            return false;
        }
    }

    $aBlackList = BaseFacade::read_serialize('deny_word');

    foreach($aBlackList as $key => $value) {
        if (preg_match('/' . str_replace(' ', '.{0,' . $iIntevalLen . '}', $value) . '/', $words)) {
            return $value;
        }
    }
    return false;
}

//替换敏感词
function hasReplaceWord($words, $bReplace=true,$sReplace='*****', $iIntevalLen=5) {
    $aReplaceList = BaseFacade::read_serialize('replace_word');
    foreach($aReplaceList as $key => $value) {
        if (preg_match('/' . str_replace(' ', '.{0,' . $iIntevalLen . '}', $value) . '/', $words)) {
            $sResult = preg_replace('/' . str_replace(' ', '.{0,' . $iIntevalLen . '}', $value) . '/', $sReplace, $words);
            return array('replace_word' => $value,
                'result' => $sResult,);
        }
    }
    return false;
}
