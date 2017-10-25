<?php

namespace Ydapi\Controller;

use Think\Controller;

class WechatPayController extends Controller
{
    
    //微信APP支付后台响应接口
    function wx_notify(){
        Vendor('Wxpay.WxPay#Api');
        $raw_xml = file_get_contents("php://input");
        $notify = new \WxPayNotifyCallBack();
        $notify->Handle(false);
        $res = $notify->GetValues();
        if($res['return_code'] ==="SUCCESS" && $res['return_msg'] ==="OK"){
            libxml_disable_entity_loader(true);
            $ret = json_decode(json_encode(simplexml_load_string($raw_xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
            \Think\Log::write('微信APP支付成功订单号'.$ret['out_trade_no'], \Think\Log::DEBUG);
            //在此处处理业务逻辑部分
        }
    }
    
    function wx_pay($order){
        Vendor('Wxpay.WxPay#Api');
        $orderno = $order['id'];
        $orderpay = $order['pay']*100;
        $inputObj = new \WxPayUnifiedOrder();
        $inputObj->SetOut_trade_no($orderno);
        $inputObj->SetBody('一道约车-乘车费用');
        $inputObj->SetTotal_fee($orderpay);
        $inputObj->SetTrade_type('APP');
        $result = \WxPayApi::unifiedOrder($inputObj);
        return $result;
    }

    
    
    function wx_search(){
        Vendor('Wxpay.WxPay#Api');
        $orderno = $_POST['oid'];
        $inputObj = new \WxPayUnifiedOrder();
        $inputObj->SetOut_trade_no($orderno);
        $result = \WxPayApi::orderQuery($inputObj);
        return $result;
    }
    
    function wx_pay_h5(){
        Vendor('Wxpay.WxPay#Api');
        $orderno = $order['id'];
        $orderpay = 1;
        $inputObj = new \WxPayUnifiedOrder();
        $inputObj->SetOut_trade_no($orderno);
        $inputObj->SetBody('一道约车-乘车费用');
        $inputObj->SetTotal_fee($orderpay);
        $inputObj->SetTrade_type('APP');
        $result = \WxPayApi::unifiedOrder($inputObj);
        return $result;
    }

}
