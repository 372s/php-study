<!DOCTYPE html>
<html>
<head>
    <title>首页</title>
    <meta content="text/html;charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="../js/jquery/jquery-1.8.3.min.js"></script>
    <style>
        .piclick_loading_text {
            font-weight: bold;
            font-style: italic;
            line-height: 1.2em;
            color: #3c3c3c;
            display: block;
        }
        .piclick_point {
            display: block;
            background: url(http://test18.sciemr.com/bulbgrey.png) no-repeat;
            width: 40px;
            height: 40px;
            background-size: 100% 100%;
            text-align: center;
            font-size: 14px;
            line-height: 30px;
            color: red;
            position: absolute;
            cursor:pointer;
        }
    </style>
</head>
<body>
<div id="img_container"
     style="padding-top: 10px;text-align: center;height: 80px;position: relative;width: 295px;margin: 0 auto;">
    <img src=""/>
</div>
<script type="text/javascript" src="http://test18.sciemr.com/common/piclick.js"></script>
<script type="text/javascript">
    $(function(){
        var piclick = new Piclick('img_container',{
            loadingImg: 'http://test18.sciemr.com/loading.gif',
            basePath:'http://test18.sciemr.com/',
            appid:'kingyee001',
            onSuccess:function(data){
                console.log(data);
            },
            onError:function(type,msg) {
                console.error(msg);
            }
        });
        piclick.loadImage();
    });
</script>
</body>
</html>