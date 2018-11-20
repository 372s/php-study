<?php

// header("Content-type: text/html; charset=utf-8");

$data = array('content' => array(
    array(
        'articleInfoId' => 1000,
        'articleUrl' => 'http://www.sohu.com/a/276374191_115479?_f=index_chan08news_16',
        'articleUrlMd5' => md5('http://www.sohu.com/a/276374191_115479?_f=index_chan08news_16'),
        'articleTitle' => '航班上乘客要求靠窗，空乘人员给他画了一个',
        'articlePublisher' => '嘎嘎嘎',
        'articleContent' => '<article class="article" id="mp-editor">
      <p data-role="original-title" style="">原标题：航班上乘客要求靠窗，空乘人员给他画了一个</p>
            <p>　　“请给我一个靠窗的座位。” </p> 
<p>“好，我们尽力。” </p> 
<table> 
 <tbody> 
  <tr> 
   <td><p align="center"><img src="//5b0988e595225.cdn.sohucs.com/images/20181119/db6e374bf2d6478a871eb3b8b86665b6.jpeg" width="500" height="302"></p></td> 
  </tr> 
 </tbody> 
</table> 
<p>每个人搭飞机选座位的喜好各有不同，有人指定靠窗，因为喜欢眺窗看风景；有人选靠过道，方便随时起来走走、活动筋骨。但在航班上乘客想换到靠窗的座位，空乘人员该如何满足对方的要求呢？日前，有一位网友在推特上分享他的搭机经验，让不少网友称赞这空服员“有智慧”。 </p> 
<p>据日媒Sora News 24消息，一位日本网友@kooo_TmS_suke 日前在推特上分享了自己在11月5日搭机时所发生的小故事：座位旁边的男乘客虽然坐的是靠窗位置，但实际上没有窗户，所以这位男乘客趁空服员来询问饮品需求时，提出“给我一个靠窗的座位”的要求，空乘人员回答会“尽力满足”，然后离开了。 </p> 
<table> 
 <tbody> 
  <tr> 
   <td><p align="center"><img src="//5b0988e595225.cdn.sohucs.com/images/20181119/6422fac1477b4db0867cf1f7e855484c.jpeg" width="500" height="209"></p></td> 
  </tr> 
 </tbody> 
</table> 
<p>等到空乘人员再次回来时，手中拿着一张A4大小纸张，上面画了一扇窗户，窗外还有白云和海洋。然后用胶带贴在那位男乘客窗户的位置上。 </p> 
<p>从照片上看到这位提出要求的男乘客已经睡着，虽然无法了解他的反应，但空乘人员“有智慧”的服务方式，让不少网民 “会心一笑”。 </p> 
<table> 
 <tbody> 
  <tr> 
   <td><p align="center"><img src="//5b0988e595225.cdn.sohucs.com/images/20181119/02717f0abff74c3ba8e8c106c96d3753.png" width="500" height="476"></p></td> 
  </tr> 
 </tbody> 
</table> 
<p>不少网友认为乘务员很有趣、做得好：“从他睡觉的样子来看，这哥们儿很满意”、“他能有如此独特的景色，真是太幸运了！”有人还好奇究竟是哪家航空公司能提供如此温柔、特别的服务。 </p> 
<table> 
 <tbody> 
  <tr> 
   <td><p align="center"><img src="//5b0988e595225.cdn.sohucs.com/images/20181119/96a7fbb9a6ca4319b153db2b0e7ceb34.png" width="500" height="112"></p></td> 
  </tr> 
 </tbody> 
</table> 
<p>虽然空乘人员没有提供真的窗户，但别出心裁地对待乘客的需求，让网民感叹：“我们生活在一个多么富有同情心的世界。” </p> 
<table> 
 <tbody> 
  <tr> 
   <td><p align="center"><img src="//5b0988e595225.cdn.sohucs.com/images/20181119/cb7d83b8948443b8b06192ca96146887.png" width="500" height="114"></p></td> 
  </tr> 
 </tbody> 
</table> 
<p align="center">当然也有网民认为航空公司做法是在愚弄乘客。 </p>
</article>',
        'orgId' => 1,
    )
));

$data = json_encode($data, JSON_UNESCAPED_UNICODE);

// $header = array('Content-type: application/json');
$header = array('Content-type: application/x-www-form-urlencoded');

$url = 'http://php-study.test/test.php';

$res = curl_post($url, $data, $header);
echo $res;

function curl_post($url, $data = array(), $headers = array()) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    // curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    $output = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);
    return $output;
}