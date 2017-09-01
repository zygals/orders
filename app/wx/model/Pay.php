<?php

namespace app\wx\model;
use think\Model;

class Pay extends model{


//随机32位字符串
    public function nonce_str() {
        $result = '';
        $str = 'QWERTYUIOPASDFGHJKLZXVBNMqwertyuioplkjhgfdsamnbvcxz';
        for ($i = 0; $i < 32; $i++) {
            $result .= $str[rand(0, 48)];
        }
        return $result;
    }




//签名 $data要先排好顺序
    public function sign($data) {
        $stringA = '';
        foreach ($data as $key => $value) {
            if (!$value) continue;
            if ($stringA) $stringA .= '&' . $key . "=" . $value;
            else $stringA = $key . "=" . $value;
        }

        $wx_key = config('wx_mchkey');//申请支付后有给予一个商户账号和密码，登陆后自己设置key

        $stringSignTemp = $stringA . '&key=' . $wx_key;
        return strtoupper(md5($stringSignTemp));
    }


//curl请求啊
    function http_request($url, $data = null, $headers = array()) {
        $curl = curl_init();
        if (count($headers) >= 1) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    function http_post($url, $vars, $second=30,$aHeader=array())
    {
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_TIMEOUT,$second);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);

        curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/../all.pem');

        if( count($aHeader) >= 1 ){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        }

        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
        $data = curl_exec($ch);
        if($data){
            curl_close($ch);
            return $data;
        }
        else {
            $error = curl_errno($ch);
            echo "call faild, errorCode:$error\n";
            curl_close($ch);
            return false;
        }
    }

//获取xml
    public function xml($xml) {
        $p = xml_parser_create();
        xml_parse_into_struct($p, $xml, $vals, $index);
        xml_parser_free($p);
        $data = "";
        foreach ($index as $key => $value) {
            if ($key == 'xml' || $key == 'XML') continue;
            $tag = $vals[$value[0]]['tag'];
            $value = $vals[$value[0]]['value'];
            $data[$tag] = $value;
        }
        return $data;
    }

    public function refund_query($order_id){

        $row_order = Order::where(['id'=>$order_id])->find();
        if(!$row_order || $row_order->refund_no==''){
            return ['code' => __LINE__, 'msg' => '订单不存在'];
        }

        $fee = $row_order->sum_price;
        $appid = config('wx_appid');//如果是公众号 就是公众号的appid
        $mch_id =  config('wx_mchid');
        $nonce_str = (new Pay())->nonce_str();//随机字符串
        $out_refund_no = $row_order->refund_no;//商户订单号
        //这里是按照顺序的 因为下面的签名是按照顺序 排序错误 肯定出错
        $post['appid'] = $appid;
        $post['mch_id'] = $mch_id;
        $post['nonce_str'] = $nonce_str;//随机字符串
        $post['out_refund_no'] = $out_refund_no;
        $sign = (new Pay())->sign($post);//签名            <notify_url>' . $notify_url . '</notify_url>
        $post_xml = '<xml>
           <appid>' . $appid . '</appid>
           <mch_id>' . $mch_id . '</mch_id>
           <nonce_str>' .$nonce_str . '</nonce_str>
           <out_refund_no>'.$out_refund_no.'</out_refund_no>
           <sign>' . $sign . '</sign>
        </xml> ';
        $url = 'https://api.mch.weixin.qq.com/pay/refundquery';
        $xml = $this->http_request($url, $post_xml);
        $array = $this->xml($xml);//全要大写
        //return $array;
        if ($array['RETURN_CODE'] == 'SUCCESS' ) {
            if ($array['RESULT_CODE'] == 'SUCCESS' ) {

                $ret['code'] = 0;
                $ret['msg'] = 'refund query ok';
                $ret['REFUND_STATUS'] = $array['REFUND_STATUS_0'];
            }else{
                $ret['code'] = __LINE__;
                $ret['msg'] = "提交业务失败";
            }

        } else {
            $ret['code'] = __LINE__;
            $ret['msg'] = $array['RETURN_MSG'];;
            $ret['RETURN_CODE'] = $array['RETURN_CODE'];
        }
        return $ret;

    }
}
