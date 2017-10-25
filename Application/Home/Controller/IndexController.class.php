<?php
namespace Home\Controller;
use Think\Controller;
use Think\Think;
use Think\Verify;
use Home\Model\UserModel;
use Home\Common;
use Home\Model\LeftmsgModel;
use Home\Model\NewsModel;
/**
 * 
 * @author zhou
 * 炼人的世界，生活亦如此
 */


class IndexController extends Controller {
    
    function _empty() {
        $this->redirect('Home/Index/index');
    }
    
    
    public function index(){
        $this->assign("titleli","index");
        $this->display('index');
    }
    public function download(){
        $this->display('download');
    }
    
    public function test(){
        layout(false);
        $this->display('test');
    }

    public function about(){
        $this->assign("titleli","about");
        $this->display('about');
    }
    
    public function news(){
        $this->assign("titleli","news");
        $newsM = new NewsModel();
        $news=$newsM->findAll();
        $this->assign("news",$news);
        $this->display('news');
    }
    
    
    public function contact(){
        if(empty($_POST)){
            $this->assign("titleli","contact");
            $this->display('contact');
        }else{
            $verify = new \Think\Verify();
            if(!$verify->check($_POST['verify'])){
                $this->error('验证码错误', 'contact',1);
            }else{   
                $msg= new LeftmsgModel();
                $result=$msg->addMsg();
                if ($result > 0) {
                    $this->success("留言成功！", "Index/index");
                } else {
                    $this->error("留言失败！","Index/contact");
                }
            }
        }
    }
    

    /**
     * 登录
     */
    
    public function login(){
        if (! empty($_POST)) {
            $verify = new \Think\Verify();
            if ( !($verify->check($_POST['verify'],''))) {
                $data['code'] =0;
                $data['msg']= '验证码错误！';
            } else {
                $user = new UserModel();
                $result = $user->login($_POST['username'], md5($_POST['password']));
                if ($result > 0) {
                    S('user',$result,3600);
                    $data['code'] = 200;
                    $data['url'] = U("Home/ycar");
                    $data['msg'] = "登陆成功";
                    $data['info'] = $result;
                } else {
                    $data['code'] = 0;
                    $data['msg'] = "用户名或密码不正确";
                }
            }
            $this->ajaxReturn($data);
        } else {
            $this->display('Index/login');
        }
    }
    
    /**
     * 注册
     */
    
    public function register(){
        if(!empty($_POST)){
            $verify = new \Think\Verify();
            if(!$verify->check($_POST['verify'])){
                $this->error('验证码错误', 'register');
            }else{
                $user=new UserModel();
                $result=$user->register($_POST['username'],md5($_POST['password']), $_POST['email']);
                if($result>0){
                  $this->success("注册成功！","Index/index");
                }else{
                   $this->error("注册失败，请重新注册！！","Index/register");
                }
            }
//             $this->success("注册成功！","Index/index",3000);
        }else{
            $this->display('register');
        }
    }
    

    
    /* 验证码，用于登录和注册 */
    public function verify(){
        $verify = new \Think\Verify();
        $verify->entry();
    }
    
    public function checkVerify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
    
    
}