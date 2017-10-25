<?php
namespace Ydapi\Controller;
use Think\Controller;
use Home\Model\UserModel;
use Admin\Controller\AdminController;
use Admin\Model\FileModel;
use Admin\Model\LineModel;
use Admin\Model\TeamModel;
use Aliyun\Core\Profile\DefaultProfile;
use Org\Util\String;
use Admin\Controller\validationMap;
use Lib\Tool\Tool;
use Admin\Model\MenuModel;
use Lib\Alipay\MyAliPay;
use Admin\Controller\PcarController;
use Admin\Model\PcarModel;
class IndexController extends Controller {
    public function index(){
        layout(false);
        $this->show();
    }
    /**
     * 登录
     */
    public function login(){
        $user = new UserModel();
        $result = $user->login($_POST['phonenum'], $_POST['password']);
        if ($result > 0) {
            S('user',$result,3600);
            $data['code'] = 200;
            $data['msg'] = "登陆成功";
            $data['info'] = $result;
        }else if($result==0){
            $data['code'] = 0;
            $data['msg'] = "用户名不存在";
        } else {
            $data['code'] = 0;
            $data['msg'] = "用户名或密码不正确";
        }
        $this->ajaxReturn($data);
    }
    /**
     * 验证
     */
    public function yanzheng(){
        $sms= new SendmsgController();
        $result=$sms->sendMsgAli(1);
        $data["code"]=$result['status'];
        $data["msg"]=$result['msg'];
        $this->ajaxReturn($data);
    }
    /**
     * 发送短信通知
     */
    public function smsnotice(){
        $sms= new SendmsgController();
        $oid = $_POST['oid'];
        $result=$sms->sendMsgAli(2,$oid);
        $data["code"]=$result['status'];
        $data["msg"]=$result['msg'];
        $this->ajaxReturn($data);
    }
    
    /**
     * 注册
     */
    public function register(){
        $user = new UserModel();
        $type = $_POST['usertype'];
        $phonenum = $_POST['phonenum'];
        if("0"==$type){
            $id ='yh'.$phonenum;
        }elseif("1"==$type ){
            $id ='sfc'.$phonenum;
        }elseif('2'==$type){
            $id = 'zc'.$phonenum;
        }elseif('3'==$type){
            $id = 'zxc'.$phonenum;
        }elseif('4'==$type){
            $id = 'dd'.$phonenum;
        }else{
            $id = "qt".$phonenum;
        }
        $carteam = $_POST['carteam'];
        if($carteam!=""){
            $carteam = 1;
        }
        if($user->checkDenyMember($id)){
            $data['code'] = 0;
            $data['msg'] = "手机号已被注册";
//         }else if("1111"!=$_POST["smsverify"]){
        }else if(S("verifycode")!=$_POST["smsverify"]){
           $data['code'] = 0;
           $data['msg'] = "短信验证码不正确";
        }else{
            $result=$user->register($phonenum, $_POST['password']);
            if($result > 0){
                $data['code'] = 200;
                $data['msg'] = "注册成功";
                $info['uid'] = $id;
                $info['phonenum'] =$phonenum;
                $data['info']=$info;
            } else {
                $data['code'] = 0;
                $data['msg'] = "注册失败";
            }
        }
        $this->ajaxReturn($data);
    }
    
    /**
     * 司机认证
     */
    function drivercert(){
        $user = new UserModel();
        $result= $user->certDriver();
        if($result>0){
            $data['code'] = 200;
            $data['msg'] = "提交成功";
        }else{
            $data['code'] = 0;
            $data['msg'] = "提交失败";
        }
        $this->ajaxReturn($data);
    }
    /**
     * 用户认证
     */
    function usercert(){
        $user = new UserModel();
        $result= $user->certUser();
        if($result>0){
            $data['code'] = 200;
            $data['msg'] = "提交成功";
        }else{
            $data['code'] = 0;
            $data['msg'] = "提交失败";
        }
        $this->ajaxReturn($data);
    }
    /**
     * 修改认证状态
     */
    function certstate(){
        $user = new UserModel();
        $result= $user->certState();
        if($result){
            $data['code'] = 200;
            $data['msg'] = "修改成功";
        }else{
            $data['code'] = 0;
            $data['msg'] = "修改失败";
        }
        $this->ajaxReturn($data);
    }
    /**
     * 获取认证状态
     */
    public function getcertstate(){
        $user = new UserModel();
        $result = $user->getCertState();
        if($result!=null){
            $info["iscert"]=$result;
            $data['code'] = 200;
            $data['msg'] = "获取成功";
            $data['info'] = $info;
        }else{
            $data['code'] = 0;
            $data['msg'] = "获取失败";
        }
        $this->ajaxReturn($data);
    }
    
    
   /**
  * 用户信息
  */
    public function userinfo(){
        $user = new UserModel();
        $result=$user->getUserInfo($_POST['uid']);
        if(is_array($result)){
            $data['code'] = 200;
            $data['msg'] = "";
            $info=$user->getUserDetail($_POST['uid']);
            $data['info'] = $info;
        } else {
            $data['code'] = 0;
            $data['msg'] = "获取失败";
        }
        $this->ajaxReturn($data);
    }
   /**
    * 忘记密码
    */ 
    public function forgetpwd(){
        $user = new UserModel();
        $phonenum = $_POST['phonenum'];
        $type = $_POST['usertype'];
        if("0"==$type){
            $id ='yh'.$phonenum;
        }elseif("1"==$type ){
            $id ='sfc'.$phonenum;
        }elseif('2'==$type){
            $id = 'zc'.$phonenum;
        }elseif('3'==$type){
            $id = 'zxc'.$phonenum;
        }elseif('4'==$type){
            $id = 'dd'.$phonenum;
            $isopen=1;
        }else{
            $id = "qt".$phonenum;
        }
        if(S("verifycode")!=$_POST["smsverity"]){
            $data['code'] = 0;
            $data['msg'] = "短信验证码不正确";
        }else if(!$user->checkDenyMember($id)){
            $data['code'] = 0;
            $data['msg'] = "手机号未注册";
        }else{
            $result=$user->updatePwd($id, $_POST['password']);
            if($result> 0){
                $data['code'] = 200;
                $data['msg'] = "修改成功";
                $info['uid'] = $id;
                $data['info']=$info;
            } else if($result==0){
                $data['code'] = 0;
                $data['msg'] = "请使用不同密码";
            }else {
                $data['code'] = 0;
                $data['msg'] = "修改失败";
            }
        }
        $this->ajaxReturn($data);
    }
    
    
    public function changepwd(){
        $user = new UserModel();
        $uid = $_POST['uid'];
        $password = $_POST['password'];
        if($user->checkPass($uid, $password)){
            $result=$user->updatePwd($uid, $_POST['newpass']);
            $data['code'] = 200;
            $data['msg'] = "修改成功";
        }else {
            $data['code'] = 0;
            $data['msg'] = "修改失败";
        }
        $this->ajaxReturn($data);
    }
    
    
    
    
   /**
    * 更新用户信息
    */
    
    public function changeuser(){
        $user = new UserModel();
        $result=$user->saveUserInfo();
        if($result>0){
            $data['code'] = 200;
            $data['msg'] = "修改成功";
        }else {
            $data['code'] = 0;
            $data['msg'] = "修改失败";
        }
        $this->ajaxReturn($data);
    }
   
   /**
    * 更新用户图像
    */
    
    public function changeuserpic(){
        $user = new UserModel();
        $result=$user->saveUserPic();
        if($result>0){
            $data['code'] = 200;
            $data['msg'] = "修改成功";
        }else {
            $data['code'] = 0;
            $data['msg'] = "修改失败";
        }
        $this->ajaxReturn($data);
    }
   
    /**
     * 发布订单
     */
    public function carorder() {
        $pcar = new PcarModel();
//         if($pcar->checkCarOrder()){
            $result=$pcar->orderCar();
            if($result > 0||$result!=""){
                $data['code'] = 200;
                $data['msg'] = "发布订单";
                $info['oid']=$result;
                $data['info']=$info;
            } else {
                $data['code'] = 0;
                $data['msg'] = "发布失败";
            }
//         }else{
//             $data['code'] = 0;
//             $data['msg'] = "存在未完成的订单";
//         }
        $this->ajaxReturn($data);
    }
    
    /**
     * 修改订单
     */
    public function editorder(){
        $pcar= new PcarModel();
        $result=$pcar->editCarOrder();
        if($result > 0){
            $data['code'] = 200;          
            $data['msg'] = "修改成功";    
            //$data['info']=$info;
        } else {
            $data['code'] = 0;
            $data['msg'] = "修改失败";
        }
        $this->ajaxReturn($data);
    }
    /**
     * 获取订单信息
     */
    public function findorder(){
        $pcar = new PcarModel();
        $result = $pcar->getCarInfo();
        if(is_array($result)){
            $data['code'] = 200;
            $data['msg'] = "";   
            $info=$result;
            $data["info"] = $info;
        }else{
            $data['code'] = 0;
            $data['msg'] = "获取失败";
        }
        $this->ajaxReturn($data);
    }
    /**
     * 获取订单列表
     */
    public function orderlist(){
        $pcar = new PcarModel();
        $result = $pcar->getCarList();
        if(is_array($result)){
            $data['code'] = 200;
            $data['msg'] = "";   
            $info=$result;
            $data["info"] = $info;
        }else{
            $data['code'] = 0;
            $data['msg'] = "获取失败";
        }
        $this->ajaxReturn($data);
    }
    
    /**
     * 修改指定属性
     */
    function changeAttr(){
        $pcar = new PcarModel();
        $result = $pcar->setCarAttr();
        if($result){
            $data['code'] = 200;
            $data['msg'] = "修改成功";   
        }else{
            $data['code'] = 0;
            $data['msg'] = "修改失败";   
        }
        $this->ajaxReturn($data);
    }
    
    /**
     * 获取线路
     */
    function lines(){
        $lineobj = new LineModel();
        $result =  $lineobj->llist();
        if(is_array($result)){
            $data['code'] = 200;
            $data['msg'] = "";   
            $data['info'] = $result;
        }else{
            $data['code'] = 0;
            $data['msg'] = "修改失败";
        }
        $this->ajaxReturn($data);
    }
    
    function linetoteam(){
        $teamobj = new TeamModel();
        $result = $teamobj->findTeams();
        if(is_array($result)&&!empty($result)){
            $data['code'] = 200;
            $data['msg'] = "";
            $data['info'] = $result;
        }else{
            $data['code'] = 0;
            $data['msg'] = "获取异常";
        }
        $this->ajaxReturn($data);
    }
    
    /**
     * 
     * 推送
     * 
     */
    function jpush(){
        $jpushObj = new JPushController();
        $jpushObj->sendNotifyAll();
    }
    
    
    function sendmsg(){
        $msg = new SendmsgController();
        $msg->sendMsgTest();
    }
    function upload(){
        $fileModel = new FileModel();
        $data = $fileModel->imageUpload();
        $this->ajaxReturn($data);
    }
    
    
    /**
     * 认证身份证
     * 
     */
    function verifyidcard(){
        $aliyun = new PayController();
        $aliyun->verifyIdcard();
    }
    function certverify(){
        $aliyun = new PayController();
        $aliyun->certVerify();
    }
    
    
    /**
     * 抢单
     */
    function robdeal(){
        $pcar = new PcarModel();
        $result = $pcar->robOrder();
        if($result){
            $data['code'] = 200;
            $data['msg'] = "抢单成功";
        }else{
            $data['code'] = 0;
            $data['msg'] = "抢单失败";
        }
        $this->ajaxReturn($data);
    }
    /**
     * 更新订单状态
     */
    function upstate(){
        $pcar = new PcarModel();
        $result = $pcar->setOrderState();
        if($result>0){
            $data['code'] = 200;
            $data['msg'] = "更新成功";
            $info['price']=$result;
            $data['info'] = $info;
        }else{
            $data['code'] = 0;
            $data['msg'] = "更新失败";
        }
        $this->ajaxReturn($data);
    }
    /**
     * 开关功能
     */
    function open(){
        $user = new UserModel();
        $result=$user->setOpen();
        if($result){
            $data['code'] = 200;
            $data['msg'] = "更新成功";
        }else{
            $data['code'] = 0;
            $data['msg'] = "更新失败"; 
        }
        $this->ajaxReturn($data);
    }
    /**
     * 推送test
     */
    function pushtest(){
        $push = new JPushController();
        $push->sendNotifySpecail();
    }
    
    function pushtest2(){
        $user = new UserModel();
        $user->getSpecailPushUserId("2");
    }
    /**
     * 上传地址(定位)
     */
    function uloc(){
        $user = new UserModel();
        $result = $user->setUserLocCurr();
    }
    
    
    /**
     * 设置订单线路
     */
    function setorderline(){
        $pcar = new PcarModel();
        $pcar->setOrderLine();
    }
    
    /**
     * 查询订单线路
     */
    function getorderline(){
        $pcar = new PcarModel();
        $pcar->getOrderLine();
    }
    
    /**
     * 获取价格
     */
    function price(){
        $pcar = new PcarModel();
        $price = $pcar->countPrice();
        if($price>0){
            $data['code'] = 200;
            $data['msg'] = "获取成功";
            $info['price']=$price;
            $data['info'] = $info;
        }elseif($price<0){
            $data['code'] = 0;
            $data['msg'] = "超出范围";
            $info['price']=$price;
            $data['info'] = $info;
        }else{
            $data['code'] = 0;
            $data['msg'] = "获取失败";
        }
        $this->ajaxReturn($data);
    }
    
    /**
     * 获取位置
     */
    function gloc(){
        $userobj = new UserModel();
        $result = $userobj->getUserLocCurr();
        if(is_array($result)){
            $data['code'] = 200;
            $data['msg'] = "获取成功";
            $data['info'] = $result;
        }else{
            $data['code'] = 0;
            $data['msg'] = "获取失败";
        }
        $this->ajaxReturn($data);
    }
    
    /**
     * 获取用户电话
     */
    function uphone(){
        $userobj = new UserModel();
        $result = $userobj->getUsersPhone();
        if(is_array($result)){
            $data['code'] = 200;
            $data['msg'] = "获取成功";
            $data['info'] = $result;
        }else{
            $data['code'] = 0;
            $data['msg'] = "获取失败";
        }
        $this->ajaxReturn($data);
    }
    
    
    /**
     * 创建支付订单
     */
    function createpaydeal(){
        $pay = new PayController();
        $result = $pay->createDealIntf();
        if(is_array($result)||!empty($result)){
            $data['code'] = 200;
            $data['msg'] = "";
            if(is_array($result)){
                $info = $result;
            }else{
                $info['result'] = $result;
            }
            $data['info'] = $info;
        }else{
            $data['code'] = 0;
            $data['msg'] = "发起支付失败";
        }
        $this->ajaxReturn($data);
    }
    
    /**
     * 服务端验证异步通知
     */
    function alipay_notify(){
        $aop = new MyAliPay();
        $aop->alipay_notify();
    }
    /**
     * 服务端验证异步通知
     */
    function wechat_notify(){
        $wechat = new WechatPayController();
        $wechat->wx_notify();
    }
    
    /**
     * return_url接收页面
     */
    function alipay_return(){
        $aop = new MyAliPay();
        $aop->alipay_return();
    }
    
    function maptest(){
        $pcar = new PcarModel();
        $pcar->getOrderLineDistance();
    }
        
    function testpoint(){
        

//         $ids['mytime'] = time();
//         $d='05:59:00';
//         S('ids',$ids);
//         echo S('ids')['mytime'].'<br>';
//         sleep(5);
//         $nids = S('ids');
//         $nids['newtime'] = time();
//         S('ids',$nids);
//         $mytime = S('ids')['newtime']-S('ids')['mytime'];
//         echo $mytime.'<br>';
//        $d=strtotime($d);
//        echo $d=strtotime($d);
//        echo "+------+";
//        echo "+------+";
//        echo "+------+";
//        echo time();
//        echo "+---44---+";
//       if(Tool::chechTime($d)){
//           echo "22222";
//       } ;
//        echo strtotime($e);
//        echo $d>=$time_1&& $d<="24:00"||$d<=$time_2&&$d>='00:00';
//        echo date('H:i:s')>$time_1&&date('H:i')<$time_2;
//        echo "+------+";
     
//        echo date('H:i:s');
//         $array = ["lat"=>31.218681,"lng"=>121.08604];
//         validationMap::setCoordArray($points);
//         var_dump(validationMap::isCityCenter($array));
    }
    
    /**
     * 测试处理范围
     */
    function test(){
//         $ali = new PayController();
//         $ali->createDealIntf();
//         $menu = new MenuModel();
//         $menu->findPidFromUrl('ulist');
//         $order = new PcarModel();
//         $reorder = $order->getOrderInfoToPay();
//         var_dump($reorder);
//         $pcar=new PcarModel();
//         $result = $pcar->checkCarOrder();
//         var_dump($result);
//             $user = new UserModel();
//             $result= $user->getCarteamIdFromOid('yc1507953002');
//             var_dump($result);
//             $push = new JPushController();
//             $push->sendNotifyToDriverOrTeam('yc1507953002', 4);

//            $wechat = new WechatPayController();
// //            $result = $wechat->wx_pay();
// //            var_dump($result);
//             $result = $wechat->wx_search();
//             var_dump($result);
//             $user = new UserModel();
//             $re =  $user->getUsersPhone();
//             var_dump($re);
//             $pcar = new PcarModel();
//             $re = $pcar->getInfoToSendMsg('yc1507975698');
            
//             var_dump($re);
//             $str = "F5:15:BD:BC:D6:37:E6:39:43:A3:7B:CA:7A:6E:99:E5";
//             echo (str_replace(':',"",$str));
            $pcar = new PcarModel();
            $re = $pcar->checkSetState('yc1507975698','-1');
            var_dump($re);
        
    }
    
}