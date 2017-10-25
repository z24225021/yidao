<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\MenuModel;
use Lib\Tool\Page;


class MenuController extends InitController {
    
    public function index(){
        layout('Layout/layout');
        $this->display();
    }
    
    public function cmenu()
    {
        $menu=new MenuModel();
        $param="pid=".$_GET['pid'];
        $menuList = $menu->getMenu($param);
        $arr['code']=0;
        $arr['msg']=$menuList;
        $this->ajaxReturn($arr);
    }
    
    
    
    public function mlist(){
       $menu=new MenuModel();
       $count = $menu->where()->count();
       $Page = new Page($count,10);
       $show = $Page->show();
       $mlist=$menu->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
       $this->assign('page',$show);// 赋值分页输出
       $this->assign("mlist",$mlist);
       $this->display('Menu/list') ; 
    }
    
    public function addMenu(){
        $menu=new MenuModel();
        if(empty($_POST)){
            $this->assign('title','添加列表信息');
            $type=$menu->getType();
            $this->assign('type',$type);
            $this->display('Menu/add');
        }else{
            $result=$menu->addMenu();
            if($result>0){
                $this->success("操作成功！！","mlist",2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    }
    
    public function update(){
        $menu=new MenuModel();
        if(empty($_POST)){
            $info = $menu->findOne($_GET['mid']);
            var_dump($info);
            $type=$menu->getType();
            $this->assign('type',$type);
            $this->assign('title','更新类别');
            $this->assign('info',$info);
            $this->display('Menu/add');
        }else{
            $result=$menu->updateType();
            if($result>=0){
                $this->success("操作成功！！",U('mlist'),2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    }
    
    public function delete(){
        $menu=new MenuModel();
        $result=$menu->deleteMenu($_GET['mid']);
        if($result>0){
            $this->success("操作成功！！",U('mlist'),2);
        }else{
            $this->error("操作失败！！请重试");
        } 
    }
    
    
    public function register() {
       $this->display('register') ;
    }
    
    
}