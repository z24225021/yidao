<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\MenuModel;
use Think\Verify;
use Admin\Model\RoleModel;
class InitController extends Controller {
    function _empty() {
        $this->redirect("Admin/login/login");
    } 
    
    
    // 自动登录
    public function _initialize(){
        $admin= S('admin');
        if(!$admin) {
            $this->error('对不起,您还没有登录!请先登录再进行浏览', U('Login/login'), 1);
//         }else
//             if(!$this->checkUrlMenu()){
//             $this->error('对不起,页面不存在或权限不够', U('Login/login'), 1);
        }else{
            $this->getIndexMenu();
        }
    }
    
    /* 验证码，用于登录和注册 */
    public function verify(){
        $verify = new Verify();
        $verify->entry();
    }
    
    public function checkUrlMenu(){
        $menu = new MenuModel();
        $pid = $menu->findPidFromUrl(ACTION_NAME);
        $rulearr = $menu->getAdminRules();
        return in_array($pid['pid'], $rulearr);
    }
   
    
    public function getIndexMenu(){
        $menu=new MenuModel();
        $map['pid'] = 2;
        $rulearr = $menu->getAdminRules();
        $map['id'] = array('in',$rulearr);
        $menuList = $menu->getMenu($map);
        $this->assign('menu',$menuList);
        $this->assign("menupid",$_GET['pid']);
    }
    
    
    
    public function checkVerify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
 }