<?php

namespace Home\Model;
use Think\Model;


/**
 * {0}
 * 
 * @author
 * @version 
 */
class LeftmsgModel extends Model
{

    
    public function addMsg(){
        $data = array(
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'state' => $_POST['state'],
            'message' => $_POST['message'],
            'lefttime'=>time(),
        );
        if($this->create($data)){
            $uid = $this->add();
            return $uid ? $uid : 0; //0-未知错误，大于0-注册成功
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }
 
    
    
    
}