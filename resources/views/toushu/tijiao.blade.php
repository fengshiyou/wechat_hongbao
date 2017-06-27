
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
    <link rel="stylesheet" href="{{asset('css/tijiao.css')}}" />
    <script type="text/javascript" src="{{asset('js/2.1.js')}}"></script>
</head>
<body>
<p class="content">&#20320;&#21487;&#20197;&#65306;</p>
<div class="out">
    <div class="in"><p class="type">&#25552;&#20132;&#32473;&#24494;&#20449;&#22242;&#38431;&#23457;&#26680;</p><img src="{{asset('img/arrow.png')}}" /></div>
</div>
<p class="bottom"> <a class="rule" href="https://weixin.qq.com/cgi-bin/readtemplate?t=weixin_external_links_content_management_specification">&#25237;&#35785;&#39035;&#30693;</a></p>
</body>
<script>
    $(".in").click(function(){
        $.post('report.php',{},function (data) {

        },'json');
        location.href="{{URL::to('toushu/down')}}";
    });
</script>
</html>

<script type="text/javascript" src="{{asset('js/common.js')}}" ></script>
