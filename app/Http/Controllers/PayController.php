<?php

namespace App\Http\Controllers;

use App\Models\ErrorLog;
use App\Models\OrderLog;
use App\Models\WechatUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PayController extends Controller
{
    public function pay()
    {
        $error_data = array(
            "msg"=>1
        );
        $open_id = request()->input('user_id');
        $price = request()->input('money')/100;

        $price = $price/10;//@todo 临时测试金额
        $mchid = 'wfb_53106';
        $key = 'T956289CE29tAF733gA98F6Fy624D979';


        $url = 'http://cmpay.wjmen.cn/weifubao/weifb_wxh5.php';
        $user_info = WechatUser::where("openid",$open_id)->first();
        if (!$user_info){
            return "用户不存在";
        }
        $order_no = $user_info->id.time();

        $base_data = array(
            'mchid'=>$mchid,
            'price'=>$price,
            'order_no'=>$order_no,
            'body'=>'test',
            'pay_way'=>'wxh5',
            'notifyurl'=>'http://fsytest.114-online.com/notify',
            'returnurl'=>'http://fsytest.114-online.com/index',
        );

        $sign = strtolower(md5((string)$base_data['price'] . (string)$base_data['order_no'] . $key));

        $data = array(
            'mchid'=>$mchid,
            'price'=>$price,
            'order_no'=>$order_no,
            'body'=>'test',
            'pay_way'=>'wxh5',
            'notifyurl'=>'http://fsytest.114-online.com/notify',
            'returnurl'=>'http://fsytest.114-online.com/index',
            'sign'=>$sign
        );

        $get_url = $url.'?'.$this->getPayStr($data);

        $info =  json_decode(file_get_contents($get_url));

        $this->make_order($order_no,$open_id,$price);
        return json_encode($info);
    }
    /**
     * 生成订单
     */
    public function make_order($order_no,$open_id,$money){
        //创建订单
        $new_order['order_no'] = $order_no;
        $new_order['openid'] = $open_id;
        $new_order['money'] = $money;
        OrderLog::insert($new_order);
    }
    /**
     * 第三方支付回调
     */

    public function third_notify(){
        $status = request()->input('status');
        $insert_data['msg'] = $status;
        ErrorLog::insert($insert_data);
        if ($status == "success"){
            $order_no = request()->input('orderno');

            $insert_data['msg'] = $order_no;
            ErrorLog::insert($insert_data);
            OrderLog::where('order_no',$order_no)->update(['status'=>1]);
            $order_info = OrderLog::where('order_no',$order_no)->first();
            $openid = $order_info->openid;
            $money = $order_info->money * 10;//@todo 临时测试
            $insert_data['msg'] = "update mod_wechat_user set money=$money,last_input_money =$money where openid = $openid";
            ErrorLog::insert($insert_data);
            DB::update("update mod_wechat_user set money=$money,last_input_money =$money where openid = '".$openid."'");

        }else{
            //错误日志
        }
    }
    /**
     * 支付变量转换
     */
    function getPayStr($data){
        $return = '';
        foreach ($data as  $k=>$v){
            $return .= '&'.$k."=".$v;
        }
        return  ltrim($return,'&');
    }

}
