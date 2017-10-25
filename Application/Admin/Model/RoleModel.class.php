<?php
namespace Admin\Model;


use Think\Model;
class RoleModel extends Model
{
    public function addRole(){
        $rules = join(',', $_POST['rules']);
        $data = array(
            'name' =>$_POST['name'],
            'rules' =>$rules,
            'uid' =>$_POST['uid'],
        );
        if($this->create($data)){
            $rid = $this->add($data);
            return $rid ? $rid : 0; 
        } else {
            return $this->getError(); //错误详情见自动验证注释
        } 
    }
    
    public function deleteRole($param){
        $where = array('id'=>$param);
        $result = $this->where($where)->delete();
        return $result;
    }
    
    public function editRole(){
        $data=array(
            'id'=>$_POST['id'],
            'name'=>$_POST['name'],
            'uid'  =>$_POST['uid'],
            'rules'  =>join(",",$_POST['rules']),
        );
        if($this->create($data)){
            $uid = $this->save($data);
            return $uid ;
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }
    
    public function findOne($param){
        $where = array('id'=>$param);
        $type = $this->where($where)->find();
        return $type;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>