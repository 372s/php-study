<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>

    <title>测试</title>
    <meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,minimal-ui">
</head>
<body>
<div>
    <a id="J-call-app" href="javascript:;" class="label">立即打开&gt;&gt;</a>
    <input id="J-download-app" type="hidden" name="storeurl" value="http://m.chanyouji.cn/apk/chanyouji-2.2.0.apk">
</div>

<script>
    (function(){
        var ua = navigator.userAgent.toLowerCase();
        var app = navigator.appVersion;
        console.log(navigator);

        var android = ua.indexOf('android') > -1;
        var t;
        var config = {
            /*scheme:必须*/
            scheme_IOS: 'cundong://',
            scheme_Adr: 'cundong://splash',
            download_url: document.getElementById('J-download-app').value,
            timeout: 600
        };

        function openclient() {
            var startTime = Date.now();

            var ifr = document.createElement('iframe');


            ifr.src = ua.indexOf('os') > 0 ? config.scheme_IOS : config.scheme_Adr;
            ifr.style.display = 'none';
            document.body.appendChild(ifr);

            var t = setTimeout(function() {
                var endTime = Date.now();

                if (!startTime || endTime - startTime < config.timeout + 200) {
                    window.location = config.download_url;
                } else {

                }
            }, config.timeout);

            window.onblur = function() {
                clearTimeout(t);
            }
        }
        window.addEventListener("DOMContentLoaded", function(){
            document.getElementById("J-call-app").addEventListener('click',openclient,false);
        }, false);
    })()
</script>
</body>
</html>