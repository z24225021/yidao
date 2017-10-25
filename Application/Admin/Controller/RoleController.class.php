<?php
namespace Admin\Controller;

use Admin\Model\RoleModel;
use Lib\Tool\Page;
class RoleController extends InitController
{
    public function getRoleList(){
        $roleObj= new RoleModel();
        return $roleObj->field($field)->order('id')->select();
    }
    
    public function rlist(){
        $roleObj= new RoleModel();
        $count = $roleObj->where()->count();
        $Page = new Page($count,10);
        $show = $Page->show();
        $role=$roleObj->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('page',$show);// 赋值分页输出
        $this->assign("title","角色列表");
        $this->assign("list",$role);
        $this->display("Role/list");
    }
    public function radd(){
        if(empty($_POST)){
            $this->assign('title','添加角色');
            $this->display('Role/add');
        }else{
            $roleObj=new RoleModel();
            $result=$roleObj->addRole();
            if($result>0){
                $this->success("操作成功！！","rlist",2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    }
    
    
    public function rdelete(){
        $roleObj=new RoleModel();
        $result =  $roleObj->deleteRole($_GET['rid']);
        if($result>0){
            $this->success("操作成功！！",U('rlist'),2);
        }else{
            $this->error("操作失败！！请重试");
        }
    }
    
    public function redit(){
        if(empty($_POST)){
            $roleObj=new RoleModel();
            $result=$roleObj->findOne($_GET['rid']);
            $this->assign('info',$result);
            $this->assign('title','更新角色');
            $this->display('Role/add');
        }else{
            $roleObj=new RoleModel();
            $result=$roleObj->editRole();
            if($result>0){
                $this->success("操作成功！！",U('rlist'),2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    }
    
    
}

