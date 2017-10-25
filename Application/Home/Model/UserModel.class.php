<?php

namespace Home\Model;
use Think\Model;
use Think\Image;
use Admin\Model\FileModel;
use Lib\Tool\Tool;

/**
 * {0}
 * 
 * @author
 * @version 
 */
class UserModel extends Model
{
    /**
     * 注册一个新用户
     * @param  string $username 用户名
     * @param  string $password 用户密码
     * @param  string $email    用户邮箱
     * @param  string $mobile   用户手机号码
     * @return integer          注册成功-用户信息，注册失败-错误编号
     */
    public function register($phonenum, $password){
        $isopen = $_POST['isopen'];
        $carteam = $_POST['carteam'];
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
        $data = array(
            'id' =>$id,
            'username' => $phonenum,
            'password' => md5($password),
            'pass' => $password,
            'type'=> $type,
            'isopen'=>$isopen ,
            'carteam'=>$carteam ,
            'email' => $_POST['email'],
            'create_time'=>Date('Y-m-d H:i:s')
        );
        /* 添加用户 */
        if($this->create($data)){
            $reid = $this->add();
            $this->createUserInfo($id, $phonenum, $type);
            $this->createUserLoc($id);
            return $reid; //0-未知错误，大于0-注册成功
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }
    
    function userEdit(){
        $type = $_POST['usertype'];
        $isopen = $_POST['isopen'];
        $carteam = $_POST['carteam'];
        $data = array(
            'username' => $_POST['username'],
            'password' => md5($_POST['password']),
            'pass' => $_POST['password'],
            'type'=> $type,
            'isopen'=>$isopen ,
            'carteam'=>$carteam ,
            'email' => $_POST['email'],
            'create_time'=>$_POST['create_time']
        );
        /* 添加用户 */
        $where['id'] = $_POST['id'];
        return $this->where($where)->save($data);
    }
    
    
    
    
    
    
    /**
     * 检测用户名是不是被禁止注册
     * @param  string $username 用户名
     * @return boolean          ture - 未禁用，false - 禁止注册
     */
    public function checkDenyMember($uid){
        $map['id'] = $uid;
        $user = $this->where($map)->find();
        if(is_array($user) ){
            return true; 
        } else {
            return false; //用户不存在
        }
    }
    
    
    
    /**
     * 检测用户名是不是被禁止注册
     * @param  string $username 用户名
     * @return boolean          ture - 未禁用，false - 禁止注册
     */
    public function checkPass($uid,$pass){
        $map['id'] = $uid;
        $map['password'] = md5($pass);
        $user = $this->where($map)->find();
        if(is_array($user) ){
            return true; 
        } else {
            return false; //用户不存在
        }
    }
    
    
    /**
     * 用户登录认证
     * @param  string  $username 用户名
     * @param  string  $password 用户密码
     * @param  integer $type     用户名类型 （1-用户名，2-邮箱，3-手机，4-UID）
     * @return integer           登录成功-用户ID，登录失败-错误编号
     */
    public function login($username, $password){
        $map['username'] = $username;
        $type = $_POST['usertype']==null?0:$_POST['usertype'];
        $map['type'] = $type;
        /* 获取用户数据 */
        $user = $this->where($map)->find();
        if(is_array($user) ){
            /* 验证用户密码 */
            if(md5($password) ==$user['password']){
//                 $this->updateLogin($user['id']); //更新用户登录信息
                $this->setRegId($user['id']);
                return $user; //登录成功，返回用户ID
            } else {
                return -2; //密码错误
            }
        } else {
            return 0; //用户不存在或被禁用
        }
    }
    /**
     * 更新密码
     * @param unknown $username
     * @param unknown $password
     * @return boolean|string
     */
    function updatePwd($uid, $password){
        $data=array(
            'password' =>md5($password),
            'pass'=>$password,
        );
        /* 更新用户 */
        if($this->create($data)){
            $map["id"] = $uid;
            $reid = $this->where($map)->save($data);
            return $reid ;
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }
    //更新登陆信息
    function updateLogin($userid){
        
            
        
    }
    
    
    
    
    function getUserRegId(){
        
    }
    
    /**
     * 获取司机可推送用户Id
     */
    function getSpecailPushUserId($type=0){
        $map['isopen']="1";
        $carteam = $_POST['carteam'];
        $map['type']=$type;
        $ids = $this->where($map)->getField('regid',true);
        return $ids;
    }
    
    
    
    function getCarteamIdFromOid($oid){
        $where['id']=$oid;
        $result= $this->table("yd_orderlist")->where($where)->field('carteam')->find();
        return $result['carteam'];
    }
    
    
    
    function getLinePushUserId($type=0,$oid){
        $carteam = $_POST['carteam'];
        if($carteam ==''){
            $carteam=$this->getCarteamIdFromOid($oid);
        }
        $map['carteam']=$carteam;
        $map['type']=$type;
        $ids = $this->where($map)->getField('regid',true);
        return $ids;
    }
    /**
     * 根据OID获取uid,did
     * @param unknown $oid
     * @return mixed|boolean|NULL|string|unknown|object
     */
    function getPushUser($oid){
        $where['oid']=$oid;
        $orderuser=$this->table('yd_orderlist')->field('uid,did')->where($where)->find();
        return $orderuser;
    }
    /**
     * 根据uid获取Regid
     * @param unknown $userid
     */
    function getPushUserRegid($userid){
        $where['id']= $userid;
        $result = $this->field('regid')->where($where)->find();
        return $result['regid'];
    }
    
    
    
    function getUserInfo($uid){
        $map['id']=$uid;
        $user = $this->where($map)->find();
        return $user;
    }
    
    function getUserAllInfo(){
        $m=M();
        $result=$m->query("select * from yd_user_info ");
    }
    /**
     * 获取用户详细信息
     * @param unknown $uid
     * @return mixed|boolean|NULL|string|unknown|object
     */
    function getUserDetail($uid){
        $m=M('user_info');
        $map['id']=$uid;
        $user = $m->where($map)->find();
        return $user;
    }
    
    /**
     * 创建用户信息
     * @param  $uid
     * @return mixed|boolean|unknown|string|string
     */
    function createUserInfo($uid,$phonenum,$usertype){
        $m=M('user_info');
        $data=array(
            'id' =>$uid,
            'uid' =>$uid,
            'phonenum' =>$phonenum,
            'usertype' =>$usertype,
        );
        if($m->create($data)){
            $reid = $m->add();
            $this-> $reid; //0-未知错误，大于0-注册成功
        } else {
            return $m->getError(); //错误详情见自动验证注释
        }
    }
    
    /**
     * 更新用户信息
     * @return boolean|string
     */
    function saveUserInfo(){
        $m=M('user_info');
        $data=array(
            'id'=>$_POST['uid'],
            'name' => $_POST['name'],
            'addr' => $_POST['addr'],
            'age' => $_POST['age'],
            'cardid' => $_POST['cardid'],
            'sex' => $_POST['sex'],
            'pic' => $_POST['pic'],
            'cardbackpic' => $_POST['cardbackpic'],
            'cardfontpic' => $_POST['cardfontpic'],
        );
        if($m->create($data)){
            $reid = $m->save();
            return $reid ;
        } else {
            return $m->getError(); //错误详情见自动验证注释
        }
    }
    /**
     * 更新用户图像
     * @return boolean|string
     */
    function saveUserPic(){
        $file = new FileModel();
        $result = $file->uploadPic();
        if($result['code']==200){
            $re = $this->saveUserPicIn($result['path']);
            if($re>0){
                return $result;
            }else{
                $data['code']=0;
                $data['msg']="更新失败！";
                return $data;
            }
        }else{
           return $result;
        }
    }
    
    function saveUserPicIn($path){
        $m=M('user_info');
        $data=array(
            'id'=>$_POST['uid'],
            'pic' => $path,
        );
        if($m->create($data)){
            $reid = $m->save();
            return $reid ;
        } else {
            return $m->getError(); //错误详情见自动验证注释
        }
    }
    
    /**
     * 设置司机开始接单状态
     * @return boolean
     */
    function setOpen(){
        $map['id']=$_POST['did'];
        return $this->where($map)->setField("isopen",$_POST['isopen']);
    }
    /**
     * 获取要推送的司机
     * @param 用户的类型 int $type
     * @return mixed|boolean|string|NULL|unknown|object
     */
    function getDriverTOPush($type){
        $where['isopen'] = 1;
        $where['type'] = $type;
        return $this->field('id')->where($where)->select();
    }
    /**
     * 司机认证
     */
    function certDriver(){
        $m=M();
        $sql = 'update yd_user_info set name="'.$_POST['name'].'",cardid="'.$_POST['cardid'].'",cardfontpic="'.$_POST["cardfontpic"].'",cardbackpic="'.$_POST["cardbackpic"].'",drivercard="'.$_POST["drivercard"].'",driverlicense="'.$_POST["driverlicense"].'" where id="'.$_POST['did'].'"';
        $result = $m->execute($sql,true);
        if($result>0){
            $where['id']=$_POST['did'];
            $this->where($where)->setField("iscert",1);
        }
        return $result;
    }
    /**
     * 用户认证
     */
    function certUser(){
//         $m=M('user_info');
//         $where["id"] = $_POST['uid']; 
//         $field["name"] = $_POST['name'];
//         $field["cardid"] = $_POST['cardid'];
//         $field["cardfontpic"] = $_POST['cardfontpic'];
//         $field["cardbackpic"] = $_POST['cardbackpic'];
//         var_dump($field);
//         $result = $m->where($where)->setField($field,true);
//         var_dump($result); 
        $m = M();
        $sql = 'update yd_user_info set name="'.$_POST["name"].'",cardid="'.$_POST["cardid"].'",cardfontpic="'.$_POST["cardfontpic"].'",cardbackpic="'.$_POST["cardbackpic"].'"  where id="'.$_POST["uid"].'"';
        $result = $m->execute($sql,true);
        if($result>0){
            $where['id']=$_POST['uid'];
            $this->where($where)->setField("iscert",4);
        }
        return $result;
    }
    
    /**
     * 修改认证状态
     */
    function certState(){
       $id=$_POST['uid'];
       if($id==null){
           $id=$_GET['uid'];
           $usertype=$_GET['usertype'];
           if($usertype==0){
               $iscert = 3;
           }else{
               $iscert = 2;
           }
       }else{
           $iscert=$_POST['iscert'];
       }
       $where['id']=$id;
       return $this->where($where)->setField("iscert",$iscert);
    }
    /**
     * 获取认证状态
     */
    function getCertState(){
        $where['id']=$_POST['uid'];
        return $this->where($where)->getField("iscert");
    }
    /**
     * 删除用户信息
     * @return boolean
     */
    function deleteUser(){
        $uid = $_GET['uid'];
        $re = $this->delete($uid);
        $userInfoObj = M('user_info');
        $re1 = $userInfoObj->delete($uid);
        $userLocObj = M('user_loc');
        $re2 = $userLocObj->delete($uid);
        return $re>0&&$re1>0&&$re2>0?true:false;
    }
    
    /**
     * 创建用户位置信息
     */
    function createUserLoc($id){
        $m = M('user_loc');
        $data=array(
            'id'=>$id,
        );
        if($m->create($data)){
            $reid = $m->add();
            return $reid ;
        } else {
            return $m->getError(); //错误详情见自动验证注释
        }
    }
    /**
     * 设置推送id
     * @param unknown $id
     */
    function setRegId($id){
        $regid = $_POST['regid'];
        $where['id']=$id;
        $this->where($where)->setField("regid",$regid);
    }
    
    
    
    /**
     * 定位地址
     */
    function setUserLocCurr(){
        $m = M('user_loc');
        $loc = $_POST['nowloc'];
        $uid = $_POST['uid'];        
        $where['id']=$uid;
        $m->where($where)->setField('nowloc',$loc);
        $this->setOrderLocLine($uid, $loc);
    }
    
    /**
     * 设置订单路线
     * @param unknown $uid
     * @param unknown $loc
     */
    function setOrderLocLine($uid,$loc){
        $ids = S('ids');
        if($ids['did'] == $uid && 2==$ids['state']){
            if(Tool::chechTime(time())){
                $ids['endntime'] =time();
                if($ids['startntime']==''){
                    $ids['startntime']=time();
                }
                S('ids',$ids);
            }
            S('ids',$ids);
            $oid = $ids['oid'];
            $pcarobj = new \Admin\Model\PcarModel();
            $point = $pcarobj->changePointTo($loc);
            $multi = $pcarobj->getOrderLine($oid);
            $pointarr = $pcarobj->setMultiPointToArray($multi, $point);
            $multipointstr = $pcarobj->setArrayToMultiPoint($pointarr);
            $pcarobj->setOrderLine($oid,$multipointstr);
        }
    }
    /**
     * 获取用户位置
     */
    function getUserLocCurr(){
        $carteam=$_POST['carteam'];
        if($carteam!=""){
            $where['user.carteam']=$carteam;
            $where['user.type'] = 3;
        }
        $isopen =$_POST['isopen'];
        if($isopen!=""){
            $where['user.isopen']=$isopen;
        }
        $where['_string']='user.id=loc.id AND user.id = info.uid';
        $did = $_POST['did'];
        if($did!=""){
            $where['user.id']=$did;
            $result = $this->table('yd_user user,yd_user_loc loc,yd_user_info as info')->field('user.id as uid,info.name as name,loc.nowloc as loc')->where($where)->find();
        }else{
            $result = $this->table('yd_user user,yd_user_loc loc,yd_user_info as info')->field('user.id as uid,info.name as name,loc.nowloc as loc')->where($where)->select();
        }
        return $result;
    }
    
    
    /**
     * 后台获取位置
     * @return mixed|boolean|string|NULL|unknown|object
     */
    function getUserLoc(){
        $carteam = S('admin')['carteam'];
        $type = $_GET['type'];
        if($carteam!=''&&$type==""){
            $where['user.carteam']=$carteam;
            $where['user.type']= 3;
        }
        if($type != ''){
            $where['type']=$type;
        }
        $where['_string']='user.id=loc.id';
        $result = $this->table('yd_user user,yd_user_loc loc')->field('user.id as uid,user.username as name,loc.nowloc as loc')->where($where)->select();
        return $result;
    }
    
    /**
     * 获取指定用户电话列表
     * @param number $type
     */
    function getUsersPhone($type=4){
        $carteam = $_POST['carteam'];
        if($carteam!=""){
            $where['carteam'] =$carteam;
        }
        $utype = $_POST['utype'];
        if($utype!=''){
            $where['type'] =$utype;
        }else{
            $where['type'] =$type;
        }
        return $this->field('id,username as phone')->where($where)->select();
    }
    
    
}