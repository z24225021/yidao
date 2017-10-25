<?php
namespace Ydapi\Controller;
use Think\Controller;
use Admin\Controller\SendmsgController;
use Home\Model\UserModel;
use Home\Model\PcarModel;
use JPush\Client;
use Ydapi\Model\AlismsModel;
class JPushController extends Controller {
    /**
     * yidaocar
     * @var unknown
     */
    private $carKey = '4e908589e155c02b21b38db5';
    private $carSecret = '2a567370b5dcc01346d1b1e2';
    /**
     * 专车
     */
    private $specialcarKey='d6fa3cf2574da2b262be9a4a';
    private $specialcarSecret='45fbd9d62dc5333e5ab48bcf';
    /**
     * 专线车
     */
    private $zxcarKey='aac7a06578ee10b3965653d9';
    private $zxcarSecret='e3a98930f4eae2bdadebce61';
    
    /**
     * 调度
     */
    
    private $ddcarKey='579379db19c8c05e0b799c6f';
    private $ddcarSecret='f801b76be4ee3a7e68fe64c0';
    
    public function index(){
        layout(false);
        $this->show();
    }
    /**
     * 
     * @param 别名 array $all
     * @param 标题 string $title
     * @param 内容 string $msg_content
     * @param 参数 array $extras
     */
    public function sendNotifyAll($all,$title,$msg_content,$extras){
        
        $client = new Client($this->appKey, $this->masterSecret);
        $result = $client->push()
        ->setPlatform('all')
        ->addAllAudience()
        ->setNotificationAlert($title)
        ->setMessage($msg_content,$title,null,$extras)
        ->send();
//         print_r($result);
//         echo "success";
    }
    
//     public function sendNotifySpecail(){
//         $alias = array("yh139399122","yh18888888888");
//         $client = new Client($this->specialcarKey, $this->specialcarSecret);
//         $result = $client->push()
//         ->setPlatform('all')
//         ->addAlias($alias)
//         ->setNotificationAlert("您有一条订单")
//         ->setMessage("yc1504439859","您有一条订单")
//         ->send();
//     }
    public function sendNotifyToDriverOrTeam($orderId,$usertype){
        $user= new UserModel();
        if($usertype==2){//专车
            $appkey = $this->specialcarKey;
            $appSecret = $this->specialcarSecret;
            $regids= $user->getSpecailPushUserId($usertype);
            $this->pushMessage($appkey, $appSecret, $regids,$orderId);
        }elseif($usertype == 4){//调度
            $appkey = $this->ddcarKey;
            $appSecret = $this->ddcarSecret;
            $regids= $user->getLinePushUserId($usertype,$orderId);
            $this->pushMessage($appkey, $appSecret, $regids,$orderId);
        }elseif($usertype == 3){//专线车
            $appkey = $this->zxcarKey;
            $appSecret = $this->zxcarSecret;
        }else{
            $appkey = $this->carKey;
            $appSecret = $this->carSecret;
        }
    }
    /**
     * 专线车推送
     * @param unknown $oid
     */
    function sendNotifyToLineUser($oid){
        $user = new UserModel();
        $users= $user->getPushUser($orderId);
        if($users!=''){
            foreach ($users as $key=> $userid){
                $regid= $user->getPushUserRegid($userid);
                if($key=='uid'){
                    $appkey = $this->carKey;
                    $appSecret = $this->carSecret;
                }elseif($key=='did'){
                    $appkey = $this->zxcarKey;
                    $appSecret = $this->zxcarSecret;
                }
                $this->pushMessage($appkey, $appSecret, $regid,$oid);
            }
        }
    }
    
    
    /**
     * 推送实体
     * @param unknown $appkey
     * @param unknown $appSecret
     * @param unknown $regids
     * @param unknown $orderId
     */
    public function pushMessage($appkey,$appSecret,$regids,$orderId){
        $client = new Client($appkey,$appSecret);
        try {
            $result = $client->push()
            ->setPlatform('all')
            ->addRegistrationId($regids)
            ->setNotificationAlert("您有一条订单信息")
            ->setMessage($orderId,"您有一条订单信息")
            ->send();
        } catch (\JPush\Exceptions\APIConnectionException $e) {
            // try something here
        } catch (\JPush\Exceptions\APIRequestException $e) {
            // try something here
        } catch (\Exception $e){
        }
    }
    
    
    /**
     * 长连接+轮询调用获取信息的方法
     */
    public function get_message() {
        $loginer = session("loginer");
        // 接受者id
        $to = $loginer['id'];
        // 发送者id
        $from = I('from');
        // 超时时间
        $out_time = 80;
        //
        // 创建内容模型
        $Content = M('Content');
        // 根据from to 两个字段获得对应的聊天消息
        $map['to'] = (int)$to;
        $map['from'] = (int)$from;
        $map['isread'] = array('neq', 1);
        set_time_limit(0);
        $i = 0;
        while(true) {
            usleep(500000);
            $i++;
    
            // 获得数据
            $res = $Content->where($map)->select();
            //
            if($res){
                $content = "";
                $ids = array();
                foreach ($res as $value) {
                    $content .= $value["content"] . "<br />";
                    $ids[] = $value["id"];
                }
                unset($map);
                $map["id"] = array("in", $ids);
                $data["isread"] = 1;
                $Content->where($map)->save($data);
                $msg['success'] = "1";
                $msg['content'] = $content;
                $msg['to'] = $res[0]["to"];
                $msg['from'] = $res[0]["from"];
                $this->ajaxReturn($msg, "JSON");
                break;
            }
            // 服务器($_POST['time'] * 0.5)秒后告诉客服端无数据
            if($i >= $out_time){
                // $arr = array('success'=>"0",'name'=>'xiaocai','text'=>$rand);
                $msg['success'] = "0";
                $msg['content'] = "";
                $this->ajaxReturn($msg, "JSON");
                break;
            }
        }
    }
    
    public function send_message() {
        // 获取当前用户的信息：已登录或临时用户
        $loginer = session("loginer");
        $from = $loginer["id"];
        if ($from != I('from')) {
            $info['state'] = "-1";
            $this->ajaxReturn($info, "JSON");
            exit;
        }
        // 获取要发送到的用户ID
        $to = I('to');
        // 获得客户端提交的数据，并插入数据库中
        $content = I('content');
        // 定义数据模型
        $Content = M('Content');
        $data["from"] = (int)$from;
        $data["to"] = (int)$to;
        $data["content"] = $content;
        $res = $Content->add($data);
        // 插入成功这返回成功提示信息，便于客户端显示处理
        if ($res) {
            $info["state"] = "1";
        } else {
            $info["state"] = "0";
        }
        //
        $info["content"] = I('post.content');
        $this->ajaxReturn($info, "JSON");
    }
    
}