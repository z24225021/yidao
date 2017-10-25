<?php
namespace Admin\Model;
use Think\Model;

/**
 * {0}
 * 
 * @author
 * @version 
 */
class MenuModel extends Model{
    protected $trueTableName = 'yd_type';
    function addMenu() {
        $data=array(
            'pid' =>$_POST['pid'],
            'name' =>$_POST['name'],
            'order' =>$_POST['order'],
            'url' =>$_POST['url'],
        );
        if($this->create($data)){
            $uid = $this->add($data);
            return $uid ? $uid : 0; //0-未知错误，大于0-注册成功
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }
    /**
     * 获取登录者权限
     */
    public function getAdminRules(){
        $rules = S('admin')['rules'];
        return $rulearr = explode(',', $rules);
    }
    /**
     * 判断URL与菜单对应
     * @return boolean
     */
    public function checkUrlMenu(){
        $pid = $this->findPidFromUrl(ACTION_NAME);
        $rulearr = $this->getAdminRules();
        return in_array($pid['pid'], $rulearr);
    }
    
    
    
    function getMenu($param){
        $menu = $this->where($param)->order('id,cdate asc')->select();
        return $menu;
    }

    
    function getType(){
        $type = $this->order('id,cdate asc')->select();
        return $type;
    }
    
    function findOne($param){
        $where['id']=$param;
        $type = $this->where($where)->find();
        return $type;
        
    }
    function updateType(){
        $data=array(
            'id'=>$_POST['id'],
            'pid'=>$_POST['pid'],
            'name'  =>$_POST['name'],
            'order'  =>$_POST['order'],
            'url'  =>$_POST['url'],
            'cdate'  =>$_POST['cdate'],
        );
        /* 更新用户 */
        if($this->create($data)){
            $uid = $this->save($data);
            return $uid ;
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }
    function deleteMenu($param){
        $where = array('id'=>$param);
        return $this->where($where)->delete();
    }
    
    function findPidFromUrl($url){
        $where['url']=$url;
        $pid = $this->field('pid')->where($where)->find();
        return $pid;
    }
    
    
}