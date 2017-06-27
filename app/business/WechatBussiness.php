<?php
/**
 * Created by PhpStorm.
 * User: kexiangzhang
 * Date: 17/1/10
 * Time: 下午4:16
 */

namespace App\Bussiness;
use App\Bussiness\TraitBussiness;


class WechatBussiness
{
    use TraitBussiness;

    private function get_open_id(){
        return 501453944;
        //判断是在微信里面打开
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == true) {

            //配置参数的数组
            $CONF =  array(
                '__APPID__' =>getenv("AppID"),
                '__SERECT__' =>getenv("AppSecret"),
                '__CALL_URL__' =>'http://fsytest.114-online.com/wechat/openid' //当前页地址
            );

            //没有传递code的情况下，先登录一下
            if(!isset($_GET['code']) || empty($_GET['code'])){

                $getCodeUrl  =  "https://open.weixin.qq.com/connect/oauth2/authorize".
                    "?appid=" . $CONF['__APPID__'] .
                    "&redirect_uri=" . $CONF['__CALL_URL__']  .
                    "&response_type=code".
                    "&scope=snsapi_base". #!!!scope设置为snsapi_base !!!
                    "&state=1";

                //跳转微信获取code值,去登陆
                header('Location:' . $getCodeUrl);
                exit;
            }

            $code     		=	trim($_GET['code']);
            //使用code，拼凑链接获取用户openid
            $getTokenUrl    =  "https://api.weixin.qq.com/sns/oauth2/access_token".
                "?appid={$CONF['__APPID__']}".
                "&secret={$CONF['__SERECT__']}".
                "&code={$code}".
                "&grant_type=authorization_code";
            $info = json_decode(file_get_contents($getTokenUrl));
            //拿到openid,下面就可以继续调起支付啦
//            $openid 		=	$token_get_all->openid;
            var_dump($info->openid);

        }
    }
}