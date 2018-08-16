<?php

class Preg{

    /**
     * \d  匹配一个数字字符。等价于 [0-9]。
     * \D  匹配一个非数字字符。等价于 [^0-9]。
     * \f  匹配一个换页符。等价于 \x0c 和 \cL。
     * \n  匹配一个换行符。等价于 \x0a 和 \cJ。
     * \r  匹配一个回车符。等价于 \x0d 和 \cM。
     * \s  匹配任何空白字符，包括空格、制表符、换页符等等。等价于 [ \f\n\r\t\v]。
     * \S  匹配任何非空白字符。等价于 [^ \f\n\r\t\v]。
     * \t  匹配一个制表符。等价于 \x09 和 \cI。
     * \v  匹配一个垂直制表符。等价于 \x0b 和 \cK。
     * \w  匹配包括下划线的任何单词字符。等价于'[A-Za-z0-9_]'。
     * \W  匹配任何非单词字符。等价于 '[^A-Za-z0-9_]'。
     * \  将下一个字符标记为一个特殊字符、或一个原义字符、或一个 向后引用、或一个八进制转义符。例如，'n' 匹配字符 "n"。'\n' 匹配一个换行符。序列 '\\' 匹配 "\" 而 "\(" 则匹配 "("。
     * 
     * ^  匹配输入字符串的开始位置。如果设置了 RegExp 对象的 Multiline 属性，^ 也匹配 '\n' 或 '\r' 之后的位置。
     * $  匹配输入字符串的结束位置。如果设置了RegExp 对象的 Multiline 属性，$ 也匹配 '\n' 或 '\r' 之前的位置。
     * *  匹配前面的子表达式零次或多次。例如，zo* 能匹配 "z" 以及 "zoo"。* 等价于{0,}。
     * +  匹配前面的子表达式一次或多次。例如，'zo+' 能匹配 "zo" 以及 "zoo"，但不能匹配 "z"。+ 等价于 {1,}。
     * ?  匹配前面的子表达式零次或一次。例如，"do(es)?" 可以匹配 "do" 或 "does" 中的"do" 。? 等价于 {0,1}。
     * {n}  n 是一个非负整数。匹配确定的 n 次。例如，'o{2}' 不能匹配 "Bob" 中的 'o'，但是能匹配 "food" 中的两个 o。
     * {n,}  n 是一个非负整数。至少匹配n 次。例如，'o{2,}' 不能匹配 "Bob" 中的 'o'，但能匹配 "foooood" 中的所有 o。'o{1,}' 等价于 'o+'。'o{0,}' 则等价于 'o*'。
     * {n,m}  m 和 n 均为非负整数，其中n <= m。最少匹配 n 次且最多匹配 m 次。例如，"o{1,3}" 将匹配 "fooooood" 中的前三个 o。'o{0,1}' 等价于 'o?'。请注意在逗号和两个数之间不能有空格。
     * ?  当该字符紧跟在任何一个其他限制符 (*, +, ?, {n}, {n,}, {n,m}) 后面时，匹配模式是非贪婪的。非贪婪模式尽可能少的匹配所搜索的字符串，而默认的贪婪模式则尽可能多的匹配所搜索的字符串。例如，对于字符串 "oooo"，'o+?' 将匹配单个 "o"，而 'o+' 将匹配所有 'o'。
     * .  匹配除 "\n" 之外的任何单个字符。要匹配包括 '\n' 在内的任何字符，请使用象 '[.\n]' 的模式。
     * 
     * 
     * (pattern)  匹配 pattern 并获取这一匹配。所获取的匹配可以从产生的 Matches 集合得到，在VBScript 中使用 SubMatches 集合，在JScript 中则使用 $0…$9 属性。要匹配圆括号字符，请使用 '\(' 或 '\)'。
     * (?:pattern)  匹配 pattern 但不获取匹配结果，也就是说这是一个非获取匹配，不进行存储供以后使用。这在使用 "或" 字符 (|) 来组合一个模式的各个部分是很有用。例如， 'industr(?:y|ies) 就是一个比 'industry|industries' 更简略的表达式。
     * (?=pattern)  正向预查，在任何匹配 pattern 的字符串开始处匹配查找字符串。这是一个非获取匹配，也就是说，该匹配不需要获取供以后使用。例如，'Windows (?=95|98|NT|2000)' 能匹配 "Windows 2000" 中的 "Windows" ，但不能匹配 "Windows 3.1" 中的 "Windows"。预查不消耗字符，也就是说，在一个匹配发生后，在最后一次匹配之后立即开始下一次匹配的搜索，而不是从包含预查的字符之后开始。
     * (?!pattern)  负向预查，在任何不匹配 pattern 的字符串开始处匹配查找字符串。这是一个非获取匹配，也就是说，该匹配不需要获取供以后使用。例如'Windows (?!95|98|NT|2000)' 能匹配 "Windows 3.1" 中的 "Windows"，但不能匹配 "Windows 2000" 中的 "Windows"。预查不消耗字符，也就是说，在一个匹配发生后，在最后一次匹配之后立即开始下一次匹配的搜索，而不是从包含预查的字符之后开始
     * 
     * x|y  匹配 x 或 y。例如，'z|food' 能匹配 "z" 或 "food"。'(z|f)ood' 则匹配 "zood" 或 "food"。
     * [xyz]  字符集合。匹配所包含的任意一个字符。例如， '[abc]' 可以匹配 "plain" 中的 'a'。
     * [^xyz]  负值字符集合。匹配未包含的任意字符。例如， '[^abc]' 可以匹配 "plain" 中的'p'。
     * [a-z]  字符范围。匹配指定范围内的任意字符。例如，'[a-z]' 可以匹配 'a' 到 'z' 范围内的任意小写字母字符。
     * [^a-z]  负值字符范围。匹配任何不在指定范围内的任意字符。例如，'[^a-z]' 可以匹配任何不在 'a' 到 'z' 范围内的任意字符。
     * 
     *  *?  零次或多次，但尽可能少的匹配
     *  +?  一次或多次，但尽可能少的匹配
     *  ??  0次或1次，但尽可能少的匹配
     *  {n,}?  至少n次，但尽可能少的匹配
     *  {n,m}?  n到m次 ，但尽可能少的匹配
     * 
     * php中其他常用字符串操作函数

    字符串截取截取 
    string substr ( string string,intstart [, int length])stringmbsubstr(stringstr , int start[,intlength = NULL [, string $encoding = mb_internal_encoding() ]] )
    字符串中大小写转换 
    strtoupper 
    strtolower 
    ucfirst 
    ucwords
    字符串比较 
    -strcmp、strcasecmp、strnatcmp
    字符串过滤
    字符串翻转 
    strrev($str);
    字符串随机排序 
    string str_shuffle ( string $str )


     */
    /**
     * 验证：必须包含字母、数字、下划线；
     * @param $str
     * @return bool
     */
    public function checkPsd($str) {
        $pattern = '/^[a-z_0-9]+$/i';
        if (preg_match($pattern, $str)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 验证：email；
     * \w == [A-Za-z0-9_]
     * @param $str
     * @return bool
     */
    public function checkEmail($str) {
        $pattern = '/^(\w)+([-.]\w+)*@(\w)+(\.\w{2,4}){1,3}$/';
        if (preg_match($pattern, $str)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * url匹配
     * @param $str
     * @return bool
     */
    public function checkURL($str) {
        $pattern = '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(:\d+)?(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?/';
        if (preg_match($pattern, $str)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 验证：去除相邻重复；
     * 后向引用（逆向引用）：如果在模式中定义标准括号组，则之后可以在正则表达式中引用它。这称为“逆向引用”，并且此类型的组称为 “捕获组”。
     * 对一个正则表达式模式或部分模式两边添加圆括号将导致相关匹配存储到一个临时缓冲区中，所捕获的每个子匹配都按照在正则表达式模式中从左至右所遇到的内容存储。存储子匹配的缓冲区编号从 1 开始，连续编号直至最大99 个子表达式。每个缓冲区都可以使用 '\n' 访问，其中 n 为一个标识特定缓冲区的一位或两位十进制数。
     * 例如，在下面的正则表达式中，序列 \1 匹配在捕获括号组中匹配的任意子字符串： /(\d+)-by-\1/; // 匹配字符串：48-by-48
     * 可以通过键入 \1, \2,..., \99 在正则表达式中指定最多 99 个此类逆向引用。
     * @param $str
     * @return string
     */
    public function removeAdjacentRepetition($str) {
        $pattern = '/(.)\1/';
        return preg_replace($pattern,'$1',$str);
    }

    public function replaceImageStyle($str) {
        $pattern = '/(<img\s*.*?\s*style=\").*?(\".*?\/?\s*>)/i';
        return preg_replace($pattern, '${1}width:100%;height:auto;${2}', $str);
    }

    /**
     * 非捕获元字符 '?:','?=','?!' 来忽略对相关匹配的保存
     * 其中?:是非捕获元之一，还有两个非捕获元是?=和?!，这两个还有更多的含义，前者为正向预查，在任何开始匹配圆括号内的正则表达式模式的位置来匹配搜索字符串，后者为负向预查，在任何开始不匹配该正则表达式模式的位置来匹配搜索字符串
     * @param $str
     * @return bool
     */
    public function noCaptureSymbol() {
        $str1 ="你好<我>(爱)[北京]{天安门}";
        preg_match("/(?:<)(.*)(?:>)/i", $str1, $result1);
        preg_match_all("/(?:<)(.*)(?:>)/i", $str1, $result2);
        print_r($result1);
        /*
        Array
        (
            [0] => <我>
            [1] => 我
        )
         */
        print_r($result2); 
        /*
        Array
        (
            [0] => Array
                (
                    [0] => <我>
                )

            [1] => Array
                (
                    [0] => 我
                )

        )
         */
    }
}

