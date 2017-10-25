<?php
namespace Admin\Model;
use Think\Model;

/**
 * {0}
 * 
 * @author
 * @version 
 */
class AdminModel extends Model{
    
    function addAdmin() {
        $data=array(
            'username' =>$_POST['username'],
            'password' =>md5($_POST['password']),
            'tpassword'=>$_POST['password'],
            'phone' =>$_POST['phone'],
            'email' =>$_POST['email'],
            'statue' =>$_POST['statue'],
        );
        /* 添加用户 */
        if($this->create($data)){
            $uid = $this->add($data);
            return $uid ? $uid : 0; //0-未知错误，大于0-注册成功
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }
    function getAdmins(){
        $admin = $this->order('id,cdate asc')->select();
        return $admin;
    }
    
    function findOne($param){
        $where = array('id'=>$param);
//         var_dump($where);
        $admin = $this->where($where)->find();
        return $admin;
        
    }
    function updateAdmin(){
        $data=array(
            'id'=>$_POST['id'],
            'username' =>$_POST['username'],
            'password' =>md5($_POST['password']),
            'tpassword'=>$_POST['password'],
            'phone'  =>$_POST['phone'],
            'email'  =>$_POST['email'],
            'statue' =>$_POST['statue'],
            'cdate'  =>$_POST['cdate'],
        );
        /* 更新用户 */
        if($this->create($data)){
            $uid = $this->save($data);
            return $uid ;
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }
    function deleteAdmin($param){
        $where = array('id'=>$param);
        return $this->where($where)->delete();
    }
    
    /**
     * 用户登录认证
     * @param  string  $username 用户名
     * @param  string  $password 用户密码
     * @param  integer $type     用户名类型 （1-用户名，2-邮箱，3-手机，4-UID）
     * @return integer           登录成功-用户ID，登录失败-错误编号
     */
    public function login($username, $password, $type = 1){
        $map = array();
        switch ($type) {
            case 1:
                $map['username'] = $username;
                break;
            case 2:
                $map['email'] = $username;
                break;
            case 3:
                $map['mobile'] = $username;
                break;
            case 4:
                $map['id'] = $username;
                break;
            default:
                return 0; //参数错误
        }
    
        /* 获取用户数据 */
        $user = $this->where($map)->find();
        if(is_array($user) ){
            /* 验证用户密码 */
            if(md5($password) == md5($user['password'])){
                $this->updateLogin($user['id']); //更新用户登录信息
                return $user; //登录成功，返回用户ID
            } else {
                return -2; //密码错误
            }
        } else {
            return -1; //用户不存在或被禁用
        }
    }
    function updateLogin($id){
        
    }
}