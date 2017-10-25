<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\PcarModel;
use Lib\Tool\Page;
class PcarController extends InitController {
    public function index(){
        
        $this->display('index');
    }
    
    public function clist(){
        $pcarModel= new PcarModel();
        $count = $pcarModel->where()->count();
        $Page = new Page($count,10);
        $show = $Page->show();
        $result=$pcarModel->where($map)->order('book_time asc')->limit($Page->firstRow.','.$Page->listRows)->select(); // $Page->firstRow 起始条数 $Page->listRows 获取多少条$Data->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select(); // $Page->firstRow 起始条数 $Page->listRows 获取多少条
        $this->assign('title','用车信息列表');
        $this->assign('clist',$result);
        $this->assign('page',$show);// 赋值分页输出
        $this->display('Pcar/list');
    } 
    public function add(){
        if(empty($_POST)){
            $this->assign('title','添加用车信息');
            $this->display('Pcar/add');
        }else{
            $pcarModel= new PcarModel();
            $result=$pcarModel->addPcar();
            if($result>0){
                $this->success("操作成功！！",U('clist'),2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
        
    } 
    
    public function edit(){
        $pcarModel= new PcarModel();
        if(empty($_POST)){
            $result=$pcarModel->findOne($_GET['cid']);
            $this->assign('title','修改用车信息');
            $this->assign('info',$result);
            $this->display('Pcar/add');
        }else{
            $result=$pcarModel->editPcar();
            if($result>0){
                $this->success("操作成功！！",U('clist'),2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    } 
    
    
    public function delete(){
        $pcar=new PcarModel();
        $result=$pcar->deletePcar($_GET['cid']);
        if($result>0){
            $this->success("操作成功！！",U('clist'),2);
        }else{
            $this->error("操作失败！！请重试");
        }
    }
}