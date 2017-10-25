<?php
namespace Ydapi\Controller;
use Think\Controller;
use Lib\Alipay\MyAliPay;
use Admin\Model\PcarModel;
class PayController extends Controller {
    
    /**
     * 支付API
     * @var string
     */
    public function createDealIntf(){
        $order = new PcarModel();
        $reorder = $order->getOrderInfoToPay();
        $paytype = $_POST['ptype'];
        if(is_array($reorder)){
            if($paytype=='1'){
                $wechat = new WechatPayController();
                return $wechat->wx_pay($reorder);
            }elseif($paytype=='2'){
                $aop = new MyAliPay();
                return $aop->useAlipay($reorder);
            }else{
                return "";
            }
        }else{
            return "";
        }
    }
    
}