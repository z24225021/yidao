<?php
namespace Lib\Alidayu;
include 'TopSdk.php';
use TopClient;
use AlibabaAliqinFcSmsNumSendRequest;

class SendSMS {
    private $appkey="";
    private $secretKey="";
    
    
    public function send($recNum,$smsParam,$smsTemplateCode,$smsFreeSignName){
        var_dump($recNum." ".$smsParam." ".$smsTemplateCode." ".$smsFreeSignName);
//         exit();
        $c = new TopClient;
        $c->appkey = "24527157";
        $c->secretKey = "a0e2d52acaf3cf71211fe80e48f4d96b";
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend("232323");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName($smsFreeSignName);
        $req->setSmsParam($smsParam);
        $req->setRecNum($recNum);
        $req->setSmsTemplateCode($smsTemplateCode);
        return  $resp = $c->execute($req);
    }
    
}