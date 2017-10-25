<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\AdminModel;
use Admin\Model\FileModel;
use Admin\Model\LineModel;
use Lib\Tool\Page;
use Home\Model\UserModel;

class IndexController extends InitController {
    /**
     * 上传图片
     */
    public function upload(){
        $fileModel = new FileModel();
        $data = $fileModel->imageUpload();
        $this->ajaxReturn($data);
    }
    
    public function cmenu(){
        $menu = new MenuController();
        $menu->cmenu();
    }
    
    
    public function index(){
        $this->display('Index/index');
    }

    public function test(){
        $this->display('Public/test');
    }
    
    public function alist(){
       $admin=new AdminModel();
       $count = $admin->where()->count();
       $Page = new Page($count,10);
       $show = $Page->show();
       $map['_string'] = 'admin.statue =role.id';
       $alist=$admin->table('yd_admin as admin,yd_role as role')->where($map)->order('admin.id')->limit($Page->firstRow.','.$Page->listRows)->select();
       $this->assign('page',$show);// 赋值分页输出
       $this->assign("alist",$alist);
       $this->display('Admin/list') ;
    }
    
    public function aadd(){
//             $this->display('Admin/add');
        if(empty($_POST)){
            $this->assign('title','添加管理员');
            $this->assign("roles",S("roles"));
            $this->display('Admin/add');
        }else{
            $admin=new AdminModel();
            $result=$admin->addAdmin();
            if($result>0){
                $this->success("操作成功！！","alist",2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    }
    
    public function aedit(){
        if(empty($_POST)){
            $admin=new AdminModel();
            $result = $admin->findOne($_GET['uid']);
            $this->assign('title','更新管理员');
            $this->assign('admin',$result);
            $this->display('Admin/add');
        }else{
            $admin=new AdminModel();
            $result=$admin->updateAdmin();
            if($result>=0){
                $this->success("操作成功！！",U('alist'),2);
            }else{
                $this->error("操作失败！！请重试");
            }
        }
    }
    
    public function adelete(){
        $admin=new AdminModel();
        $result=$admin->deleteAdmin($_GET['uid']);
        if($result>0){
            $this->success("操作成功！！",U('alist'),2);
        }else{
            $this->error("操作失败！！请重试");
        }
    }
    
    public function logout(){
        $login = new LoginController();
        $login ->logout();
    }
    
    
    public function register() {
       $this->display('register') ;
    }
    
    public function clist(){
        $pcarObj= new PcarController();
        $pcarObj->clist();
    }
    
    public function cadd(){
        $pcarObj= new PcarController();
        $pcarObj->add();
    }
    
    public function cedit(){
        $pcarObj= new PcarController();
        $pcarObj->edit();
    }
    public function cdelete(){
        $pcarObj= new PcarController();
        $pcarObj->delete();
    }
    
    public function nlist(){
        $newsObj = new NewsController();
        $newsObj->nlist();
    }
    
    public function nadd(){
        $newsObj = new NewsController();
        $newsObj->add();
    }
    
    public function nedit(){
        $newsObj = new NewsController();
        $newsObj->edit();
    }
    
    public function ndelete(){
        $newsObj = new NewsController();
        $newsObj->delete();
    }
    
    public function mlist(){
        $menuObj = new MenuController();
        $menuObj ->mlist();
    }
    public function madd(){
        $menuObj = new MenuController();
        $menuObj ->addMenu();
    }
    
    
    public function rlist(){
        $roleObj = new RoleController();
        $roleObj->rlist();
    }
    
    public function radd(){
        $roleObj = new RoleController();
        $roleObj ->radd();
    }
    
    public function redit(){
        $roleObj = new RoleController();
        $roleObj ->redit();
    }
    
    public function rdelete(){
        $roleObj = new RoleController();
        $roleObj ->rdelete();
    }
    
    public function map(){
        $this->display('Maps/polygon');
    } 
    
    
    public function llist(){
       $obj = new ManagerController();
       $obj->lineList();
    }
    
    public function ladd(){
        $obj = new ManagerController();
        $obj->lineAdd();
    }
    public function ledit(){
        $obj = new ManagerController();
        $obj->lineAdd();
    }
    
    public function ldelete(){
        $obj = new ManagerController();
        $obj->linedelete();
    }
    
    public function tlist(){
        $obj = new ManagerController();
        $obj->teamList();
    }
    
    public function tadd(){
        $obj = new ManagerController();
        $obj ->teamAdd();
    }
    public function tedit(){
        $obj = new ManagerController();
        $obj ->teamEdit();
    }
    public function tdelete(){
        $obj = new ManagerController();
        $obj ->teamDelete();
    }
   
    
   public function ulist(){
       $obj = new UserController();
       $obj ->ulist();
   } 
   public function uedit(){
       $obj = new UserController();
       $obj ->uedit();
   } 
   public function uadd(){
       $obj = new UserController();
       $obj ->uadd();
   } 
   public function udelete(){
       $obj = new UserController();
       $obj->userDelete();
   } 
    
    
   public function ucert(){
       $obj = new UserController();
       $obj->userCertAct();
   } 
    
   public function uloc(){
       $obj = new UserController();
       $locs = $obj->getUserLoc();
       $this->assign('locs',json_encode($locs));
       $this->display('User/loc');
   }
   
   public function getloc(){
       $obj = new UserController();
       $locs = $obj->getUserLoc();
       $this->ajaxReturn($locs);
   }
    
    
    
}