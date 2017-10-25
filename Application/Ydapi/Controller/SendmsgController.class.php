<?php
namespace Ydapi\Controller;
use Think\Controller;
use Admin\Model\PcarModel;
use Lib\Tool\Tool;

class SendmsgController extends Controller {
    
    
    
   /**
    * 唯一客阿里云短信
    * 阿里大于
    * @return string
    */ 
    public function sendSMSYZ(){
        $recNum =$_POST['phonenum'];
//         $recNum =$_POST['phonenum'];
        $verifycode = strval(rand(1000,9999));
        S("verifycode",$verifycode,120);
        $alidayu = new SendSMS();
        $result = $alidayu->send($recNum, $smsParam='{"number":"'.$verifycode.'"}', $smsTemplateCode="SMS_75235001", $smsFreeSignName=唯一客网站);
        return $result="成功！";
    }
    
    /**
     *一道阿里云短信
     * @return string
     */
    public function sendMsgAli($i,$oid){
        if(1==$i){
            $verifycode = strval(rand(10000,99999));
            S("verifycode",$verifycode,120);
            $tempparam['code'] = $verifycode;
            $tempcode=C('yzmtempcode');
            $signnum = "河南一道科技有限公司";
            $phonenum = $_POST['phonenum'];
            return $this->sendMsgYZM(
                $phonenum, // 短信接收者
                $signnum, // 短信签名
                $tempcode, // 短信模板编号
                json_encode($tempparam));
        }elseif (2==$i){
            $tempcode=C('notitempcode');
            $signnum = "一道约车";
            if($oid!=''){
                $pcar= new PcarModel();
                $tempparam=$pcar->getInfoToSendMsg($oid);
                $phonenum = $tempparam['name'];
                if (Tool::isMobile($phonenum)){
                   $result = $this->sendMsgYZM(
                        $phonenum, // 短信接收者
                        $signnum, // 短信签名
                        $tempcode, // 短信模板编号
                        json_encode($tempparam));
                    return $result;
                }else {
                    return array('status' => 0, 'msg' => '用户手机号有误');
                }
            }
        }
        
 /*       
        session_start();
        vendor('AliyunSms.smsObject');
        $demo= new \smsObject('LTAI9WkTYeW9Pp6v', 'QI8XG2qYFrkh1vzf3DmZflaBsrRFzP');
        $verifycode = strval(rand(10000,99999));
        S("verifycode",$verifycode,120);
//         echo "SmsDemo::sendSms\n";
        $response = $demo->sendSms(
            "河南一道科技有限公司", // 短信签名
            "SMS_80235035", // 短信模板编号
            $_POST['phonenum'], // 短信接收者
            Array(  // 短信模板中字段的值
                "code"=>$verifycode,
                )
            );
       
        $response = $demo->queryDetails(
            "13939916661",  // phoneNumbers 电话号码
            "20170729", // sendDate 发送时间
            10, // pageSize 分页大小
            1 // currentPage 当前页码
            // "abcd" // bizId 短信发送流水号，选填
            );
        
        var_dump($response);
         */
    }
    
    
    public function sendMsgYZM($phone,$signnum,$tempcode,$tempparam){
        include_once './vendor/aliyun-php-sdk-core/Config.php';
        include_once './vendor/aliyun-php-sdk-core/Request/V20170525/SendSmsRequest.php';
        
        vendor("aliyun-php-sdk-core.Config");
        vendor("aliyun-php-sdk-core.Request.V20170525.SendSmsRequest");
        $accessKeyId ="LTAI9WkTYeW9Pp6v";//阿里云短信keyId
        $accessKeySecret ="QI8XG2qYFrkh1vzf3DmZflaBsrRFzP";//阿里云短信keysecret
        
        //短信API产品名
        $product = "Dysmsapi";
        //短信API产品域名
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region
        $region = "cn-hangzhou";
        
        //初始化访问的acsCleint
        $profile = \DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        \DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        $acsClient= new \DefaultAcsClient($profile);
        
        $request = new \SendSmsRequest;
        
        $request->setPhoneNumbers($phone);//必填-短信接收号码
        
        $request->setSignName($signnum);//必填-短信签名: 如何添加签名可以参考阿里云短信或TPshop官方文档
        //必填-短信模板Code
        $request->setTemplateCode($tempcode);//
        //选填-假如模板中存在变量需要替换则为必填(JSON格式)
        $request->setTemplateParam($tempparam);//短信签名内容:
        //选填-发送短信流水号
        //$request->setOutId("1234");
        
        //发起访问请求
        $resp = $acsClient->getAcsResponse($request);
        if ($resp && $resp->Code == 'OK') {
            return array('status' => 200, 'msg' => $resp->Code);
        } else {
            return array('status' => 0, 'msg' => $resp->Message . ' subcode:' . $resp->Code);
        }
    }
    
    
    
    
}