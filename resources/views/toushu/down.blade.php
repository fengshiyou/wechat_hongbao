
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no" name="format-detection">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta name="wap-font-scale" content="no">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title>&#25237;&#35785;</title>
    <link rel="stylesheet" href="{{asset('css/down.css')}}" />
    <script type="text/javascript" src="{{asset('js/2.1.js')}}"></script>
</head>
<body>
<div class="out">
    <img src="{{asset('img/done.png')}}"  class="icon"/>
    <p class="title">&#25237;&#35785;&#24050;&#25552;&#20132;</p>
    <p class="content">&#20320;&#30340;&#25237;&#35785;&#24050;&#25552;&#20132;&#65292;&#25237;&#35785;&#21333;&#21495;&#65306;382450390&#12290;&#25105;&#20204;&#20250;&#22312;&#55;&#20010;&#24037;&#20316;&#26085;&#20869;&#22788;&#29702;&#65292;&#24863;&#35874;&#20320;&#23545;&#24179;&#21488;&#30340;&#25903;&#25345;&#12290;</p>//@todo 随机数
    <p class="refund">&#30830;&#23450;</p>
</div>
<script>
    $(".refund").click(function(){
        window.location.href = "{{URL::to('index')}}";//@todo 补充登陆信息
//        if (navigator.userAgent.indexOf("MSIE") > 0) {
//            if (navigator.userAgent.indexOf("MSIE 6.0") > 0) {
//                window.opener = null;
//                window.close();
//            } else {
//                window.open('', '_top');
//                window.top.close();
//            }
//        }
//        else if (navigator.userAgent.indexOf("Firefox") > 0) {
//            window.location.href = 'about:blank ';
//        } else {
//            window.opener = null;
//            window.open('', '_self', '');
//            window.close();
//        }
    });
</script>
</body>
</html>


<script type="text/javascript" src="{{asset('js/common.js')}}" ></script>


