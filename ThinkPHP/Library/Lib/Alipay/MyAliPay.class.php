<?php
namespace Lib\Alipay;
include 'AopSdk.php';
use AopClient;
use Aliyun\Core\DefaultAcsClient;
class MyAliPay {
    
    /**
     * 生成订单
     * @return string
     */
    public function useAlipay($order){
        $aop = new AopClient;
        $aop->gatewayUrl = "https://openapi.alipay.com/gateway.do";
        $aop->appId = C('ALIPAY_CONFIG')['appid'];
        $aop->rsaPrivateKey = C('ALIPAY_CONFIG')['private_key'];//'请填写开发者私钥去头去尾去回车，一行字符串';
        $aop->format = "json";
        $aop->charset = "UTF-8";
        $aop->signType = "RSA2";
        $aop->alipayrsaPublicKey = C('ALIPAY_CONFIG')['ali_public_key'];//'请填写支付宝公钥，一行字符串';
        //实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay
        $request = new \AlipayTradeAppPayRequest();
        //SDK已经封装掉了公共参数，这里只需要传入业务参数
        $orderno = $order['id'];
        $orderpay = $order['pay'];
        $content = array();
        $content['body'] = '支付车费';
        $content['subject'] = '乘车费用';//商品的标题/交易标题/订单标题/订单关键字等
        $content['out_trade_no'] = $orderno;//商户网站唯一订单号
        $content['timeout_express'] = '90m';//该笔订单允许的最晚付款时间
        $content['total_amount'] = $orderpay;//订单总金额(必须定义成浮点型)
        $content['product_code'] = 'QUICK_MSECURITY_PAY';//销售产品码，商家和支付宝签约的产品码，为固定值QUICK_MSECURITY_PAY
        $con = json_encode($content);//$content是biz_content的值,将之转化成字符串
        $bizcontent = $con;
                
        $request->setNotifyUrl("http://yidaoba.cn/index.php?Ydapi/index/alipay_notify");
        $request->setReturnUrl("http://yidaoba.cn/index.php?Ydapi/index/alipay_return");
        $request->setBizContent($bizcontent);
        //这里和普通的接口调用不同，使用的是sdkExecute
        $response = $aop->sdkExecute($request);
        //htmlspecialchars是为了输出到页面时防止被浏览器将关键参数html转义，实际打印到日志以及http传输不会有这个问题
//         return str_replace("alipay_sdk=alipay-sdk-php-20161101&amp;","",htmlspecialchars($response));;//就是orderString 可以直接给客户端请求，无需再做处理。
        $response=addslashes($response);
        return ($response);//就是orderString 可以直接给客户端请求，无需再做处理。
    }
    
    /**
     * return_url接收页面
     */
    public function alipay_return(){
        // 下面的file_put_contents是用来简单查看异步发过来的数据 测试完可以删除；
        file_put_contents('./return.txt', json_encode($_POST));
        // 引入支付宝
        vendor('Alipay.AlipayNotify','','.class.php');
        $config=C('ALIPAY_CONFIG');
        $notify=new \AlipayNotify($config);
        // 验证支付数据
        $status=$notify->verifyReturn();
        if($status){
            // 下面写验证通过的逻辑 比如说更改订单状态等等 $_GET['out_trade_no'] 为订单号；
            echo "alipay_return success";
            //$this->success('支付成功',U('User/Order/index'));  //正式上线跳转到用户订单页
        }else{
            echo "alipay_return failed";
            //$this->success('支付失败',U('User/Order/index'));  //正式上线跳转到用户支付失败页
        }
    }
    
    /**
     * notify_url接收页面
     */
    public function alipay_notify(){
        // 下面的file_put_contents是用来简单查看异步发过来的数据 测试完可以删除；
        $aop = new AopClient;
        $aop->alipayrsaPublicKey = $this->alipayrsaPublicKey;
        $flag = $aop->rsaCheckV1($_POST, NULL, "RSA2");
        if($flag) {
            echo "alipay_notify success";
            // 下面写验证通过的逻辑 比如说更改订单状态等等 $_POST['out_trade_no'] 为订单号；
        }else {
            echo "alipay_notify fail";
        }
    }
    
    
}