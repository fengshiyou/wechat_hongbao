<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>&#24494;&#20449;&#32418;&#21253;&#25286;&#25286;&#25286;&#27963;&#21160;</title>
    <link rel="stylesheet" href="{{asset('css/index.css')}}" />
    <script type="text/javascript" src="{{asset('/js/2.1.js')}}" ></script>
    <script type="text/javascript" src="{{asset('/js/function.js')}}" ></script>
    <script type="text/javascript" src="{{asset('/js/index.js?v=1495576850')}}" ></script>
    <script type="text/javascript" src="{{asset('/js/jquery-2.0.3.min.js')}}" ></script>
    <script type="text/javascript" src="{{asset('/js/common.js')}}" ></script>



    <script type="text/javascript">
        //支付二维码控制
        $(function () {

            $('.tousu').click(function(){
                window.location.href= "{{URL::to('toushu/tousu')}}";
            });

            var  total_fee = $('.money_se').attr('title');


            $('.paynow').click(function(){
                $(".paynow").text("正在请求微信安全支付...");
                var  user_id =  $('meta[name=user_id]').attr('content');

                var  total_fee = $('.money_se').attr('title');

                var  iswxs = iswx();
                iswxs = true;// @todo  临时测试用
                if (iswxs){
                    $.post("/pay",{
                        '_token': $('meta[name=_token]').attr('content'),
                        "user_id":user_id,
                        "money":total_fee
                    },function(data){
                        if(data.status == 1){
                            window.location.href = data.msg;
                        }else{
                            alert('支付失败,请刷新重试');
                        }
                    },"json");
                }else{
                    alert('请在微信环境下使用');
                    funcName();
                }









        });

        function funcName() {
            $(".paynow").text("支付并立即拆红包");
        }
            $('.tixianqu').click(function(){
                var  remain = $("#score").val();
                if(remain < 50){
                    toast="当前余额:"+remain.toString()+"元，满50才能提现，再玩几局吧";
                    //调用toast效果
                    setTimeout(function(){
                        $(".outtoast").trigger("toastit");
                    },500);
                }else{
                    alert("功能待完善");
//                var  url = "./tixian.php?s=2000";
//                window.location.href = url;
                }
            })
    })
    </script>

</head>
<body>
<div class="main">
    <input type="text" id='money' value="{{$money}}" style='display:none' ></input>
    <input type="text" id='score' value="{{$score}}" style='display:none' ></input>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="user_id" content="{!!$id!!}"/>
    <p class="tousu">举报</p>
    <span class="top">支付10元，系统生成9个现金红包，1-200元，选一个拆开，最高现金<strong style="font-size: 16px;">200元</strong></span>
    <div class="chou">
        <div class="hongbaodonghua">
            <p class="money" ><span id="moneyone">????</span>元</p>
            <img class="open " id ="1" src="{{asset('/img/page_3.png')}}" />
        </div>
        <div class="hongbaodonghua">
            <p class="money" ><span id="moneytwo">????</span>元</p>
            <img class="open " id ="2" src="{{asset('/img/page_3.png')}}" />
        </div>
        <div class="hongbaodonghua">
            <p class="money" ><span id="moneythree">????</span>元</p>
            <img class="open " id ="3" src="{{asset('/img/page_3.png')}}" />
        </div>
    </div>
    <div class="chou">
        <div class="hongbaodonghua">
            <p class="money" ><span id="moneyfour">????</span>元</p>
            <img class="open " id ="4" src="{{asset('/img/page_3.png')}}" />
        </div>
        <div class="hongbaodonghua">
            <p class="money" ><span id="moneyfive">????</span>元</p>
            <img class="open " id ="5" src="{{asset('/img/page_3.png')}}" />
        </div>
        <div class="hongbaodonghua">
            <p class="money" ><span id="moneysix">????</span>元</p>
            <img class="open" id ="6" src="{{asset('/img/page_3.png')}}" />
        </div>
    </div>
    <div class="chou">
        <div class="hongbaodonghua">
            <p class="money" ><span id="moneyseven">????</span>元</p>
            <img class="open " id ="7" src="{{asset('/img/page_3.png')}}" />
        </div>
        <div class="hongbaodonghua">
            <p class="money" ><span id="moneyeight">????</span>元</p>
            <img class="open " id ="8" src="{{asset('/img/page_3.png')}}" />
        </div>
        <div class="hongbaodonghua">
            <p class="money" ><span id="moneynine">????</span>元</p>
            <img class="open " id ="9" src="{{asset('/img/page_3.png')}}" />
        </div>
    </div>
    <div class="titleout">
        <p class="title score">选择付款金额</p>
    </div>
    <div class="type">
        <div class="moneya money_se" title="1000" >10元</div>
        <div class="moneyb" title="3000" >30元<img src="{{asset('/img/jian.png')}}" class="jian"/></div>
        <div class="moneyc" title="5000" >50元</div>
    </div>
    <span class="buzhou" id="bangzhu1">
        支付
        <strong class="choosetype">10元</strong>
        即可抢
        <strong class="paytype">200元</strong>
        以内红包。
        <span class="thirty" style="color: white;">

        </span>支付得金额越大，拆到的红包将会越大。</span>
    <div class="paynow" >支付并立即拆红包</div>

    <span class="buzhou" id="bangzhu2" style="display: none;">
        已支付
        <strong class="choosetype">{{$money}}元</strong>
        可抢
        <strong class="paytype"></strong>
        以内红包。
        <span class="thirty" style="color: white;">

        </span>提示(支付得金额越大，拆到的红包将会越大。)</span>
    <img src="{{asset('/img/home.jpeg')}}" class="guize" style="display: none;" />
    <div class="zhanwei" style="height: 60px;"></div>
</div>


<ul class="canyulist">
    <li class="canyusingle">
        <img src="{{asset('/img/boy1.jpg')}}" class="canyuavata"/>
        <div class="nc">
            <span class="canyuname">&#36807;&#21435;&#30340;&#20964;</span>
            <span ></br></span>
            <div class="seeruletop">&#35268;&#21017;</div>
            <div class="tixianqu"  style="display:none;">提现</div>
            <span class="canyuxijie">&#25286;&#24320;&#20102;&#32418;&#21253;&#65292;&#36194;&#24471;<strong class="winvalue">49</strong>元</span>
        </div>
    </li>
</ul>
<!-- toast start -->
<div class="outtoast"><span class="toast">请先支付后在拆红包</span></div>
<!--游戏规则说明-->
<div class="rule" >
    <img src="{{asset('/img/ad3.png')}}" class="closev"></img>
    <div class="renzhengone">
        <div class="ruledetail">
            <p >【微信红包抢抢抢规则简介】</p>
            <span>支付<strong>10元</strong>，系统随机发送一组<strong>9个红包</strong>，红包金额<strong>200元</strong>以内随机。选择一个拆开，获得红包奖励</span>
            <div class="aaa">
                <img src="{{asset('/img/page_3.jpeg')}}" class="bbb"/>
                <img src="{{asset('/img/page_3.jpeg')}}" class="bbb"/>
                <img src="{{asset('/img/page_3.jpeg')}}" class="bbb"/>
                <img src="{{asset('/img/page_3.jpeg')}}" class="bbb"/>
                <img src="{{asset('/img/page_2.jpeg')}}" class="bbb"/>
                <img src="{{asset('/img/page_3.jpeg')}}" class="bbb"/>
                <img src="{{asset('/img/page_3.jpeg')}}" class="bbb"/>
                <img src="{{asset('/img/page_3.jpeg')}}" class="bbb"/>
                <img src="{{asset('/img/page_3.jpeg')}}" class="bbb"/>
                {{--<img src="http://cdn.maka827.cn/tianlaoshi//img/page_3.jpeg" class="bbb"/>--}}
            </div>
            <p >【抽到红包怎么给我】</p>
            <span>您所拆得的红包系统将自动进入您的账户<strong>余额到达50元可提现</strong>,我们会在1-7个工作日内为您提现。如有疑问请联系客服QQ:2378814484</span>
            <div class="playnow">&#24320;&#22987;&#25286;&#32418;&#21253;</div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var money = $("#money").val();
        var score = $("#score").val();

        if (money > 0){
            $(".type").remove();
            $(".paynow").remove();
            $(".score").text("当前拥有红包金额{{$score}}元")
            if (money == 30){
                $(".open").attr('src',"{{asset("/img/golden30.jpg")}}");
                $(".paytype").text("300元");
            }else if(money == 50){
                $(".open").attr('src',"/img/golden50.jpg");
                $(".paytype").text("500元");
            }else{

            }
            $("#bangzhu1").hide();
            $("#bangzhu2").show();
        }
        if (score > 0){
            $(".tixianqu").show();
        }
    })
</script>
</body>
</html>







