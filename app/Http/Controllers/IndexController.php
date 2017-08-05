<?php

namespace App\Http\Controllers;

use App\Bussiness\WechatBussiness;
use App\Models\Ad;
use App\Models\ErrorLog;
use App\Models\WechatUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = $this->get_open_id();
        if (!$user_id){
            $user_id = 501453944;
        }

        $user_info = WechatUser::where('openid',$user_id)->first();
        $return_data =array(
            'id'=>$user_info ? $user_info->openid : '',
            'money'=>$user_info ? $user_info->money : "",
            'score'=>$user_info ? $user_info->score : "",
        );
        print_r($user_info);die;
        return view('hongbao.index',$return_data);
    }

    public function get_open_id(){
//        return 501453944;

        //判断是在微信里面打开
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == true) {

            //配置参数的数组
            $CONF =  array(
                '__APPID__' =>getenv("AppID"),
                '__SERECT__' =>getenv("AppSecret"),
                '__CALL_URL__' =>'http://zhuanjinke.com/wechat/openid' //当前页地址
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
            if (!isset($info->openid)){
                var_dump($info);die;
            }
            //拿到openid,下面就可以继续调起支付啦
//            $openid 		=	$token_get_all->openid;
            $open_id = $info->openid;

            $this->make_user($open_id);

            $user_info = WechatUser::where('openid',$open_id)->first();
            $return_data =array(
                'id'=>$user_info ? $user_info->openid : '',
                'money'=>$user_info ? $user_info->money : "",
                'score'=>$user_info ? $user_info->score : "",
            );

            return view('hongbao.index',$return_data);

        }
    }
    /**
     * 生成用户
     */
    public function make_user($open_id){
        $check = WechatUser::where('openid',$open_id)->first();
        if (!$check){
            $new_user['openid'] = $open_id;
            WechatUser::insert($new_user);
        }
    }
    /**
     * 抽奖
     */
    public function luncky(){
        //todo 验证用户是否过期
        $openid = request()->input('user_id');
        $user_info = WechatUser::where('openid',$openid)->first();
        $money = $user_info->money;
        if (!$user_info){
            return 0;//没有用户
        }
        if ($user_info->money < 10){
            return -1;//余额不足
        }
        $ran = rand(0,10);
        DB::update("update mod_wechat_user set score=score+$ran,money=0 where openid='$openid'");//加积分 减钱
        $insert_data['msg'] = "update mod_wechat_user set score=score+$ran,money=money-10 where openid=$openid";
        ErrorLog::insert($insert_data);
        return $ran;

    }
}
