<?php
namespace Admin\Controller;
use Think\Think;
use Think\Verify;
use Home\Model\UserModel;
use Admin\Model\LineModel;
use Admin\Model\TeamModel;
use Lib\Tool\Page;
/**
 * 
 * @author zhou
 * 炼人的世界，生活亦如此
 */


class ManagerController extends InitController {
    
    public function index(){
        $this->display('index');
    }
    
    public function lineList(){
        $lineObj=new LineModel();
        $count = $lineObj->where()->count();
        $Page = new Page($count,10);
        $show = $Page->show();
        $lines=$lineObj->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('page',$show);// 赋值分页输出
        $this->assign("lines",$lines);
        $this->display('Line/list') ;
    }
    
    public function lineAdd(){
        if(empty($_POST)){
            $this->assign('title','添加线路');
            $this->display('Line/add');
        }else{
            $lineObj=new LineModel();
            $result=$lineObj->addLine();
            if($result>0){
                $this->success("操作成功！！",U('llist'),2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    }
    public function lineEdit(){
        if(empty($_POST)){
            $this->assign('title','添加线路');
            $this->display('Line/add');
        }else{
            $lineObj=new LineModel();
            $result=$lineObj->editLine();
            if($result>0){
                $this->success("操作成功！！",U('llist'),2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    }
    
    public function linedelete(){
            $lineObj=new LineModel();
            $result=$lineObj->deleteLine($_GET['id']);
            if($result>0){
                $this->success("操作成功！！",U('llist'),2);
            }else{
                $this->error("操作失败！！请重试");
            }
    }
    
    public function teamList(){
           $teamObj = new TeamModel();
           $count = $teamObj->where()->count();
           $Page = new Page($count,10);
           $show = $Page->show();
           $result=$teamObj->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
           $this->assign('page',$show);// 赋值分页输出
           $this->assign("teams",$result);
           $this->display('Team/list');
    }
    
    
    
    public function teamAdd(){
        if(empty($_POST)){
            $lineObj=new LineModel();
            $lines=$lineObj->llist();
            $this->assign('title','添加车队');
            $this->assign('lines',$lines);
            $this->display('Team/add');
        }else{
            $teamObj=new TeamModel();
            $result=$teamObj->addTeam();
            if($result>0){
                $this->success("操作成功！！",U('tlist'),2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    }
    
    public function teamEdit(){
        if(empty($_POST)){
            $lineObj=new LineModel();
            $lines=$lineObj->llist();
            $this->assign('title','更新车队');
            $this->assign('lines',$lines);
            $teamObj = new TeamModel();
            $result = $teamObj->findOne($_GET['id']);
            $this->assign('info',$result);
            $this->display('Team/add');
        }else{
            $teamObj=new TeamModel();
            $result=$teamObj->editTeam();
            if($result>0){
                $this->success("操作成功！！",U('tlist'),2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    }
    
    public function teamDelete(){
        $teamObj=new TeamModel();
        $result =  $teamObj->deleteTeam($_GET['id']);
        if($result>0){
            $this->success("操作成功！！",U('tlist'),2);
        }else{
            $this->error("操作失败！！请重试");
        }
    }
    
    
    
    
    
    
}