<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AdminModel;
use Admin\Model\RoleModel;
class LoginController extends Controller {
    
    function _empty() {
        $this->error("空操作！","Login/login");
    }
    
    public function login(){
        if (! empty($_POST)) {
            $verify = new \Think\Verify();
            if (! $verify->check($_POST['verify'],'')) {
                $data['code'] =0;
                $data['msg']= '验证码错误！';
            } else {
                $user = new AdminModel();
                $result = $user->login($_POST['username'], md5($_POST['password']));
                if ($result > 0) {
                    $roleobj = new RoleModel();
                    $where['id'] = $result['statue'];
                    $role = $roleobj->field('id as roleid,name as rolename,rules')->where($where)->find();
                    $data['code'] = 200;
                    $data['url'] = "Admin/index/index";
                    $data['msg'] = "登陆成功";
                    $result = array_merge($result,$role);
                    S('admin',$result,3600);
                    $data['admin'] = $result;
                    $this->getIndexRoles();
                } else {
                    $data['code'] = 0;
                    $data['msg'] = "用户名或密码不正确";
                }
            }
            $this->ajaxReturn($data);
        } else {
            layout(false);
            $this->display("Public/login");
        }
    }
    public function getIndexRoles(){
        $roleObj = new RoleModel();
        $roles = $roleObj->field('id,name,rules')->order("id")->select();
        S('roles',$roles);
    }
    
    public function logout(){
        S('admin',null);
        $this->redirect('Login/login', 1);
    }
}