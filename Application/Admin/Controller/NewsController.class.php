<?php
namespace Admin\Controller;
use Think\Controller;
use Home\Model\NewsModel;
use Lib\Tool\Page;
class NewsController extends IndexController {
    public function index(){
        
        $this->display('index');
    }
    
    public function nlist(){
        $newsModel=new NewsModel();
        $count = $newsModel->where()->count();
        $Page = new Page($count,10);
        $show = $Page->show();
        $news=$newsModel->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select(); 
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('news',$news);
        $this->assign('title','新闻列表');
        $this->display('News/list');
    } 
    public function add(){
        if(empty($_POST)){
            $this->assign('title','添加新闻');
            $this->display('News/add');
        }else{
            $newsModel=new NewsModel();
            $result=$newsModel->addNews();
            if($result>0){
                $this->success("操作成功！！","nlist",2);
            }else{
                $this->error("操作失败！！请重试");
            } 
        }
       
    } 
    public function edit(){
        if(empty($_POST)){
            $newsModel=new NewsModel();
            $result=$newsModel->findOneNews($_GET['nid']);
            $this->assign('info',$result);           
            $this->assign('title','更新新闻');
            $this->display('News/add');
        }else{
            $newsModel=new NewsModel();
            $result=$newsModel->updateNews();
            if($result>0){
                $this->success("操作成功！！",U('nlist'),2);
            }else{
                $this->error("操作失败！！请重试");
            } 
        }
    } 
    
    public function delete(){
        $news=new NewsModel();
        $result=$news->deleteNews($_GET['nid']);
        if($result>0){
            $this->success("操作成功！！",U('nlist'),2);
        }else{
            $this->error("操作失败！！请重试");
        }
    }
    
    
}