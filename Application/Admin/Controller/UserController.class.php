<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Think;
use Think\Verify;
use Home\Model\UserModel;
use Lib\Tool\Page;
use Admin\Model\TeamModel;
/**
 * 
 * @author zhou
 * 炼人的世界，生活亦如此
 */


class UserController extends InitController {
    
    
    public function index(){

        $this->display('index');
    }
    
    public function ulist(){
        $user = new UserModel();
        $count = $user->where()->count();
        $Page = new Page($count,10);
        $show = $Page->show();
        $userInfo = M('user_info');
        $ulist=$userInfo->field('user.id as id,info.name as name,info.phonenum as phonenum,info.cardid as cardid,info.cardfontpic as cardfontpic,info.drivercard as drivercard,info.driverlicense as driverlicense,user.type as type,user.iscert as iscert,user.able as able,user.carteam as carteam')->table(array('yd_user'=>'user','yd_user_info'=>'info'))->where('user.id=info.uid')->order('user.id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('page',$show);// 赋值分页输出
        $carteamobj = new TeamModel();
        $teams = $carteamobj->tlist();
        
        $this->assign("ulist",$ulist);
        $this->assign("teams",$teams);
        
        $this->display('User/list') ;
    }
    
    public function uadd(){
        if(empty($_POST)){
            $cteam = new TeamModel();
            $teams = $cteam->tlist();
            $this->assign('title','添加用户');
            $this->assign('teams',$teams);
            $this->display('User/add');
        }else{
            $user=new UserModel();
            $phonenum=$_POST['username'];
            $result=$user->register($phonenum, $_POST['password']);
            if($result>0){
                $this->success("操作成功！！","ulist",2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    }
    public function uedit(){
        $user=new UserModel();
        if(empty($_POST)){
            $info = $user->getUserInfo($_GET['uid']);
            $cteam = new TeamModel();
            $teams = $cteam->tlist();
            $this->assign('title','修改用户');
            $this->assign('teams',$teams);
            $this->assign('info',$info);
            $this->display('User/add');
        }else{
            $result=$user->userEdit();
            if($result>0){
                $this->success("操作成功！！",U("ulist"),2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    }
    
    public function userDelete(){
        $user=new UserModel();
        $result=$user->deleteUser();
        if($result>0){
            $this->success("操作成功！！",U("ulist"),2);
        }else{
            $this->error("操作失败！！请重试");
        }
    }
    
    
    function userCertAct(){
        $user =new UserModel();
        $result = $user->certState();
        if($result){
            $this->success("操作成功！！",U("ulist"),2);
        }else{
            $this->error("操作失败！！请重试");
        }
    }
    
    function getUserLoc(){
        $user =new UserModel();
        return $user->getUserLoc();
    }
    
    
}