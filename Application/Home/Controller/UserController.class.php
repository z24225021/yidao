<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
/**
 * 
 * @author zhou
 * 炼人的世界，生活亦如此
 */


class UserController extends HomeController{
    
    
    public function index(){

    }
    
    public function changePwd(){
        $userModel = new UserModel();
        var_dump($_POST['phonenum']."---".$_POST['password']);
        $result = $userModel->login($_POST['phonenum'], $_POST['password'],4);
        if ($result > 0) {
            $res = $userModel->updatePwd();
            if($res>0){
               $data['code']=200;
               $data['uid']=$res;
               $data['url']=U("index/login");
               $data['msg'] = "修改成功！";
               S('user',null);
            }else{
               $data['code']=0;
               $data['msg']="修改失败！";
            }
        } else {
            $data['code'] = 0;
            $data['msg'] = "原密码不正确！";   
        }
        $this->ajaxReturn($data);
    }
    
    
}