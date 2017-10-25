<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;
class ToolController extends Controller {
    
    /* 验证码，用于登录和注册 */
    public function verify(){
        ob_clean();
        $verify = new \Think\Verify();
        $verify->entry();
    }
    
    public function checkVerify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
 }
 
 
