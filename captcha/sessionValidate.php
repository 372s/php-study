<?php
session_start();
//��ҳ����Ҫ����session,
//error_reporting(2047);
session_destroy();
//��sessionȥ����ÿ�ζ���ȡ�µ�sessionֵ;
//��seesion Ч������Ҳ�ܷ���
?>
    <html>
    <head>
        <title>session ͼƬ��֤ʵ��</title>
        <style type="text/css">
            #login p{
                margin-top: 15px;
                line-height: 20px;
                font-size: 14px;
                font-weight: bold;
            }
            #login img{
                cursor:pointer;
            }
            form{
                margin-left:20px;
            }
        </style>
    </head>
    <body>

    <form id="login" action="" method="post">
        <p>����Ϊsession��֤ʵ��</p>
        <p>
            <span>��֤�룺</span>
            <input type="text" name="validate" value="" size=10>
            <img  title="���ˢ��" src="./captcha.php" align="absbottom" onclick="this.src='captcha.php?'+Math.random();"></img>
        </p>
        <p>
            <input type="submit">
        </p>
    </form>
<?php
//��ӡ��һ��session;
//echo "��һ��session��<b>".$_SESSION["authnum_session"]."</b><br>";
$validate="";
if(isset($_POST["validate"])){
    $validate=$_POST["validate"];
    echo "���ղ�������ǣ�".$_POST["validate"]."<br>״̬��";
    if($validate!=$_SESSION["authnum_session"]){
//�ж�sessionֵ���û��������֤���Ƿ�һ��;
        echo "<font color=red>��������</font>";
    }else{
        echo "<font color=green>ͨ����֤</font>";
    }
}
/*
//��ӡȫ��session;
PrintArr($_SESSION);
function PrintArr($aArray){
echo '<xmp>';
print_r($aArray);
echo '</xmp>';
}
*/
?>