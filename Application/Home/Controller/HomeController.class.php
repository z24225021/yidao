<?php
namespace Home\Controller;

use Home\Controller\IndexController;
use Home\Model\UserModel;
use Home\Model\PcarModel;
class HomeController extends IndexController
{
    function  _initialize(){
        $user= S('user');
        if(!$user) {
            $this->error('对不起,您还没有登录!请先登录再进行浏览', U('Index/login'), 1);
        }
    }
    
    public function selfCenter(){
        $this->display('selfCenter');
    }
    
    public function ycar(){
        $this->display('ycar');
    }
    public function test(){
        layout(false);
        $this->display('test');
    }
    
    
    public function logout(){
        S("user",null);
        $this->redirect('Home/Index/login');
    }
    
    function changePwd(){
        $user = new UserController();
        $user->changePwd();
    }
    
    public function fcar(){
        $pcarObj = new PcarModel(); 
        $pcarObj -> fastCar();
    }
    public function pcar(){
        
        
    }
    public function zcar(){
        
    }
    
  
    
}
