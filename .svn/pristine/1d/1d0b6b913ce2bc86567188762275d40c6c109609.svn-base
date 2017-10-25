<?php

namespace Home\Model;
use Think\Model;


/**
 * {0}
 * 
 * @author
 * @version 
 */
class NewsModel extends Model
{
    function findAll(){
        return $this->select();
    }
    function addNews(){
       $data=array(
            'title' =>$_POST['title'],
            'subtitle' =>$_POST['subtitle'],
            'author'=>$_POST['author'],
            'type' =>$_POST['type'],
            'content' =>$_POST['content'],
            'remark' =>$_POST['remark'],
            'upload' =>$_POST['upload'],
            'state' =>$_POST['state'],
            'uid' =>$_POST['uid'],
        );
        if($this->create($data)){
            $uid = $this->add($data);
            return $uid ? $uid : 0;
        } else {
            return $this->getError();
        } 
    }
    function updateNews(){
       $data=array(
            'id' => $_POST['id'],
            'title' =>$_POST['title'],
            'subtitle' =>$_POST['subtitle'],
            'author'=>$_POST['author'],
            'type' =>$_POST['type'],
            'content' =>$_POST['content'],
            'remark' =>$_POST['remark'],
            'upload' =>$_POST['upload'],
            'state' =>$_POST['state'],
            'uid' =>$_POST['uid'],
        );
        if($this->create($data)){
            $uid = $this->save($data);
            return $uid ? $uid : 0;
        } else {
            return $this->getError();
        } 
    }
    
    function findOneNews($param){
        $where = array('id'=>$param);
        $admin = $this->where($where)->find();
        return $admin;
    }
    
    
    function deleteNews($param){
        $where = array('id'=>$param);
        return $this->where($where)->delete();
    }
    
}