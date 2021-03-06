<?php
namespace Admin\Model;


use Think\Model;
class TeamModel extends Model
{
    
    protected $trueTableName = "yd_carteam";
    
    public function tlist(){
        $teams = $this->select();
        return $teams;
    }
    public function addTeam(){
        $lines = join(",",$_POST['line']);
        $data = array(
            'name' =>$_POST['name'],
            'lines'  =>$lines,
            'uid' =>$_POST['uid'],
        );
        if($this->create($data)){
            $id = $this->add($data);
            return $id ? $id : 0; 
        } else {
            return $this->getError(); //错误详情见自动验证注释
        } 
    }
    
    public function deleteTeam($param){
        $where = array('id'=>$param);
        $result = $this->where($where)->delete();
        return $result;
    }
    
    public function editTeam(){
        $lines = join("," , $_POST['line']);
        $data=array(
            'id'=>$_POST['id'],
            'name' =>$_POST['name'],
            'lines'  =>$lines,
            'uid' =>$_POST['uid']
        );
        if($this->create($data)){
            $id = $this->save($data);
            return $id ;
        } else {
            return $this->getError(); //错误详情见自动验证注释
        }
    }
    
    public function findOne($param){
        $where = array('id'=>$param);
        $team = $this->where($where)->find();
        return $team;
    }
    
    
    function findTeams(){
        $param = $_POST['lineid'];
        $teams = $this->select();
        $result = array();
        if($param!=''){
            foreach ($teams as $team){
                $lines=explode(',',$team["lines"]);
                if(in_array($param, $lines)){
                    $result[]=$team;
                }
            }
        }else{
            $result=$teams;
        }
        return $result;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>