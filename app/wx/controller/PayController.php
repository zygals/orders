<?php

namespace app\wx\controller;

use app\wx\model\Order;
use app\wx\model\OrderGood;
use app\wx\model\Pay;
use app\wx\model\User;
use think\Request;
class PayController extends BaseController {
    public function pay_ok(Request $request) {

    }
    public function pay_now(Request $request) {
        $rules = ['username' => 'require', 'order_id' => 'require|number'];
        $data= $request->param();
        $res = $this->validate($data, $rules);
        if ($res !== true) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        $user_id = User::getUserIdByName($data['username']);
        if(is_array($user_id)){
            return json($user_id);
        }
        $row_order = Order::where(['id'=>$data['order_id']])->find();

        if(!empty($data['note'])){
            $row_order->note = $data['note'];
            $row_order->save();
        }
        $fee = $row_order->sum_price;
        $appid = config('wx_appid');//如果是公众号 就是公众号的appid
        $body = 'xiaochengxu zhifu';
        $mch_id =  config('wx_mchid');
        $nonce_str = (new Pay())->nonce_str();//随机字符串
        $notify_url = url('pay_ok','order_id='.$row_order->id);
        $openid = User::where(['id'=>$user_id])->value('open_id');
        $out_trade_no = $row_order->trade_no;//商户订单号
        $spbill_create_ip = config('wx_spbill_create_ip');
        $total_fee = $fee * 100;//最不为1
        $trade_type = 'JSAPI';//交易类型 默认

        //这里是按照顺序的 因为下面的签名是按照顺序 排序错误 肯定出错
        $post['appid'] = $appid;
        $post['body'] = $body;
        $post['mch_id'] = $mch_id;
        $post['nonce_str'] = $nonce_str;//随机字符串
        $post['notify_url'] = $notify_url;
        $post['openid'] = $openid;
        $post['out_trade_no'] = $out_trade_no;
        $post['spbill_create_ip'] = $spbill_create_ip;//终端的ip
        $post['total_fee'] = $total_fee;//总金额 最低为一块钱 必须是整数
        $post['trade_type'] = $trade_type;
        $sign = (new Pay())->sign($post);//签名            <notify_url>' . $notify_url . '</notify_url>
        $post_xml = '<xml>
           <appid>' . $appid . '</appid>
           <body>' . $body . '</body>
           <mch_id>' . $mch_id . '</mch_id>
           <nonce_str>' . $nonce_str . '</nonce_str>
            <notify_url>' . $notify_url . '</notify_url>
           <openid>' . $openid . '</openid>
           <out_trade_no>' . $out_trade_no . '</out_trade_no>
           <spbill_create_ip>' . $spbill_create_ip . '</spbill_create_ip>
           <total_fee>' . $total_fee . '</total_fee>
           <trade_type>' . $trade_type . '</trade_type>
           <sign>' . $sign . '</sign>
        </xml> ';
        //统一接口prepay_id
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $xml = (new Pay())->http_request($url, $post_xml);
        $array = (new Pay())->xml($xml);//全要大写
        if ($array['RETURN_CODE'] == 'SUCCESS' && $array['RESULT_CODE'] == 'SUCCESS') {
            $time = time();
            $tmp = '';//临时数组用于签名
            $tmp['appId'] = $appid;
            $tmp['nonceStr'] = $nonce_str;
            $tmp['package'] = 'prepay_id=' . $array['PREPAY_ID'];
            $tmp['signType'] = 'MD5';
            $tmp['timeStamp'] = "$time";

            $ret['code'] = 0;
            $ret['timeStamp'] = "$time";//时间戳
            $ret['nonceStr'] = $nonce_str;//随机字符串
            $ret['signType'] = 'MD5';//签名算法，暂支持 MD5
            $ret['package'] = 'prepay_id=' . $array['PREPAY_ID'];//统一下单接口返回的 prepay_id 参数值，提交格式如：prepay_id=*
            $ret['paySign'] = (new Pay())->sign($tmp);//签名,具体签名方案参见微信公众号支付帮助文档;
            $ret['out_trade_no'] = $out_trade_no;

        } else {
            $ret['code'] = __LINE__;
            $ret['msg'] = "错误";
            $ret['RETURN_CODE'] = $array['RETURN_CODE'];
            $ret['RETURN_MSG'] = $array['RETURN_MSG'];
        }
        echo json_encode($ret);
    }

    public function refund(Request $request){
//        return getcwd();
        $rules = ['username' => 'require', 'order_id' => 'require|number'];
        $data= $request->param();
        $res = $this->validate($data, $rules);
        if ($res !== true) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        $user_id = User::getUserIdByName($data['username']);
        if(is_array($user_id)){
            return json($user_id);
        }
        $row_order = Order::where(['id'=>$data['order_id']])->find();
        if(!$row_order){
            return json(['code' => __LINE__, 'msg' => '要退款的订单不存在']);
        }
        if(empty($row_order->refund_no)){
            $row_order->refund_no = Order::makeRefundNo($data['username']);
            $row_order->save();

        }

        $fee = $row_order->sum_price;
        $appid = config('wx_appid');//如果是公众号 就是公众号的appid
        $mch_id =  config('wx_mchid');
        $nonce_str = (new Pay())->nonce_str();//随机字符串
        //$body = 'xiaochengxu tuikuan';
       // $notify_url = url('pay_ok');
       // $openid = User::where(['id'=>$user_id])->value('open_id');
        $out_refund_no = $row_order->refund_no;//商户订单号
        $out_trade_no = $row_order->trade_no;//商户订单号
        $spbill_create_ip = config('wx_spbill_create_ip');
        $total_fee = $fee * 100;//最不为1
        //$trade_type = 'JSAPI';//交易类型 默认

        //这里是按照顺序的 因为下面的签名是按照顺序 排序错误 肯定出错
        $post['appid'] = $appid;
       // $post['body'] = $body;
        $post['mch_id'] = $mch_id;
        $post['nonce_str'] = $nonce_str;//随机字符串
        $post['op_user_id'] = $mch_id;
       //$post['notify_url'] = $notify_url;
        //$post['openid'] = $openid;
        $post['out_refund_no'] = $out_refund_no;
        $post['out_trade_no'] = $out_trade_no;
       // $post['spbill_create_ip'] = $spbill_create_ip;//终端的ip
        $post['total_fee'] = $total_fee;//总金额 最低为一块钱 必须是整数
        $post['refund_fee'] = $total_fee;//总金额 最低为一块钱 必须是整数
        //$post['trade_type'] = $trade_type;
        $sign = (new Pay())->sign($post);//签名            <notify_url>' . $notify_url . '</notify_url>
        $post_xml = '<xml>
           <appid>' . $appid . '</appid>
           <mch_id>' . $mch_id . '</mch_id>
           <nonce_str>' .$nonce_str . '</nonce_str>
           <op_user_id>'. $mch_id.'</op_user_id>
           <out_refund_no>'.$out_refund_no.'</out_refund_no>
           <out_trade_no>' . $out_trade_no . '</out_trade_no>
           <total_fee>' . $total_fee . '</total_fee>
           <refund_fee>' . $total_fee . '</refund_fee>
           <sign>' . $sign . '</sign>
        </xml> ';
        $url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
        $xml = (new Pay())->http_post($url, $post_xml);
        $array = (new Pay())->xml($xml);//全要大写
       // return json($array);
        if ($array['RETURN_CODE'] == 'SUCCESS' ) {
            if ($array['RESULT_CODE'] == 'SUCCESS' ) {
                $row_order->status = Order::ORDER_REFUND;
                $row_order->save();
                $ret['code'] = 0;
                $ret['msg'] = "退款申请接收成功，结果通过退款查询接口查询";
            }else{
                $ret['code'] = __LINE__;
                $ret['msg'] = "提交业务失败";
            }

        } else {
            $ret['code'] = __LINE__;
            $ret['msg'] = "错误";
            $ret['RETURN_CODE'] = $array['RETURN_CODE'];
            $ret['RETURN_MSG'] = $array['RETURN_MSG'];
        }
        return json($ret);

    }

}