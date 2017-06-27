$(document).ready(function () {

    if (money < 10) {
        var valueone = rnd(40, 100);
        $("#moneyone").text(valueone + ".00");
        var valuetwo = rnd(40, 100);
        $("#moneytwo").text(valuetwo + ".00");
        var valuethree = rnd(40, 100);
        $("#moneythree").text(valuethree + ".00");
        var valuefour = rnd(40, 100);
        $("#moneyfour").text(valuefour + ".00");
        var valuefive = rnd(40, 100);
        $("#moneyfive").text(valuefive + ".00");
        var valuesix = rnd(40, 100);
        $("#moneysix").text(valuesix + ".00");
        var valueseven = rnd(40, 100);
        $("#moneyseven").text(valueseven + ".00");
        var valueeight = rnd(40, 100);
        $("#moneyeight").text(valueeight + ".00");
        var valuenine = rnd(40, 100);
        $("#moneynine").text(valuenine + ".00");
    } else {
        $("#moneyone").text("????");
        $("#moneytwo").text("????");
        $("#moneythree").text("????");
        $("#moneyfour").text("????");
        $("#moneyfive").text("????");
        $("#moneysix").text("????");
        $("#moneyseven").text("????");
        $("#moneyeight").text("????");
        $("#moneynine").text("????");
    }

    var valueget = rnd(1, 8);
    var payornot = 0;
    setTimeout(function () {
        $(".open").addClass("pairotatetwo");
        $(".money").css("display", "block");
        setTimeout(function () {
            $(".open").removeClass("pairotatetwo");
        }, 2500);
    }, 300);

    //$('.rule').fadeIn(500);    
    //$('.rule').css("visibility","visible");  
    $(".moneya").click(function () {
        $(this).addClass("money_se");
        $(this).siblings().removeClass("money_se");
        $(".choosetype").text("10元");
        $(".paytype").text("200元");
        type = $(this).attr("title");
        $(".thirty").text("");
        $(".hongbaodonghua").addClass("pairotatetwo");
        setTimeout(function () {
            $(".open").attr("src", "/img/page_3.jpeg");
        }, 800);
        setTimeout(function () {
            $(".hongbaodonghua").removeClass("pairotatetwo");
        }, 2200);
    });
    $(".moneyb").click(function () {
        $(this).addClass("money_se");
        $(this).siblings().removeClass("money_se");
        $(".choosetype").text("30元");
        $(".thirty").text("综合中奖率最高！！");
        $(".paytype").text("300元");
        type = $(this).attr("title");
        $(".hongbaodonghua").addClass("pairotatetwo");
        setTimeout(function () {
            $(".open").attr("src", "/img/golden30.jpg");
        }, 800);
        setTimeout(function () {
            $(".hongbaodonghua").removeClass("pairotatetwo");
        }, 2200);
    });
    $(".moneyc").click(function () {
        $(this).addClass("money_se");
        $(this).siblings().removeClass("money_se");
        $(".choosetype").text("50元");
        $(".paytype").text("500元");
        type = $(this).attr("title");
        $(".thirty").text("");
        $(".hongbaodonghua").addClass("pairotatetwo");
        setTimeout(function () {
            $(".open").attr("src", "/img/golden50.jpg");
        }, 800);
        setTimeout(function () {
            $(".hongbaodonghua").removeClass("pairotatetwo");
        }, 2200);
    });
    //关闭游戏规则弹窗
    $(".closev,.playnow").click(function () {
        $('.rule').css("visibility", "hidden");
    });
    $(".seerule,.seeruletop").click(function () {
        $('.rule').css("visibility", "visible");
    });
    $('.close,.payback').click(function () {
        $(".pay").css("visibility", "hidden");
    });

    //点击抽奖
    var flag = true;
    $(".open").click(function () {
        if (!flag) return;
        var money = $("#money").val();
        if (money < 10) {
            $(this).addClass("pairotatetwo");
            toast = "请先完成支付再拆红包！";
            //调用toast效果
            setTimeout(function () {
                $(".outtoast").trigger("toastit");
                $(".open").removeClass("pairotatetwo");
            }, 2500);
        } else {
            var _this = $(this);
            $.ajax({
                type: 'post',
                url: '/wechat/luncky',
                data: {'_token': $('meta[name=_token]').attr('content'), "user_id": $('meta[name=user_id]').attr('content')},
                dataType: 'json',
                success: function (data) {
                    if (data > 0) {
                        flag = false;
                        _this.addClass("pairotatetwo");
                        var hongbao_id = _this.attr("id");//获取红包id
                        $(".money").text("？？？？");
                        //调用toast效果
                        setTimeout(function () {
                            $("#" + hongbao_id).remove();
                            $(".money").text(data + "元");
                            setTimeout(function () {
                                window.location.href= "/index";
                            },5000)
                        }, 2500);

                    }else{
                        _this.addClass("pairotatetwo");
                        toast = "请先完成支付再拆红包！";
                        //调用toast效果
                        setTimeout(function () {
                            $(".outtoast").trigger("toastit");
                            $(".open").removeClass("pairotatetwo");
                        }, 2500);
                    }
                }

            });

        }

    });
    //动态显示中奖结果
    user = ["小希哥哥", "Wenky ren", "AMIN", "安全圈静静", "淡雅如水", "没有你在", "虐连一生", "像风一样自由", "陈慧", "Chole", "Crystal", "DANNY", "美鑫鑫", "vivi的苗", "魔力少女", "风吹过的发梢", "轻舞飞扬"];
    pay = ["56", "67", "88", "125", "44", "77", "98", "134", "23", "8", "45", "67", "73", "98", "39", "166"];
    boyava = [
        "../img/boy1.jpg",
        "../img/boy2.jpg",
        "../img/boy3.jpg",
        "../img/boy4.jpg",
        "../img/boy5.jpg",
        "../img/boy6.jpg",
        "../img/boy7.jpg",
        "../img/boy8.jpg",
        "../img/girl1.jpg",
        "../img/girl2.jpg",
        "../img/girl3.jpg",
        "../img/girl4.jpg",
        "../img/girl5.jpg",
        "../img/girl6.jpg",
        "../img/girl7.jpg",
        "../img/girl8.jpg"
    ];
    setInterval(function () {
        var paytype = rnd(0, 15);
        $(".canyulist li").eq(0).clone(true).prependTo(".canyulist");
        $(".winvalue").eq(0).text(pay[paytype]);
        $(".canyuname").eq(0).text(user[paytype]);
        $(".canyuavata").eq(0).attr("src", boyava[paytype]);
    }, 1000);
    function rnd(n, m) {
        var random = Math.floor(Math.random() * (m - n + 1) + n);
        return random;

    }


});
//toast
$(function () {
    $(".outtoast").bind("toastit", function () {
        $(".toast").text(toast);
        $(".outtoast").fadeIn(500, function () {
            setTimeout(function () {
                $(".outtoast").fadeOut(500);
            }, 1500);
        });
    });
});	