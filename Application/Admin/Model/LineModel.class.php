<?php
namespace Admin\Model;


use Think\Model;
class LineModel extends Model
{
    public function llist(){
        $carteam = $_POST['carteam'];
        if(""!=$carteam){
            $where['id'] = $carteam;
            $tlines = $this->table('yd_carteam')->where($where)->field('lines')->select();
            if(count($tlines)>0){
                $tlinearr = explode(',', $tlines[0]['lines']);
            }
            $map['id']=array('in',$tlinearr);
        }
        $lines = $this->where($map)->field('id,name,startcity,endcity')->select();
        return $lines;
    }
    public function addLine(){
        $name= $_POST['startcity']."-".$_POST['endcity'];
        $startcity = $_POST['startcity'];
        $endcity = $_POST["endcity"];
        $uid=$_POST['uid'];
        $startg=$_POST['startg'];
        $endg=$_POST['endg'];
        $bprice=$_POST['bprice'];
        $addp=$_POST['addp'];
        $data = array(
            'name' => $name ,
            'startcity'  =>$_POST['startcity'],
            'endcity'  =>$_POST['endcity'],
            'uid' =>$_POST['uid'],
        );
        $sql="insert into yd_line (name,startcity,endcity,startg,endg,uid,bprice,addp) values ('$name','$startcity','$endcity',GeomFromText( '$startg'),GeomFromText( '$endg'),'$uid','$startcity','$endcity');";
        if($this->create($data)){
            $id = $this->execute($sql);
            return $id ? $id : 0; 
        } else {
            return $this->getError(); //错误详情见自动验证注释
        } 
    }
    
    public function getCityLineArea($lid){
         $sql = "SELECT bprice,addp,AsText(startg) as startg,AsText(endg) as endg FROM yd_line where id=".$lid;
         $result= $this->query($sql);
         return $result;
    }
    
    
    public function deleteLine($param){
        $where = array('id'=>$param);
        $result = $this->where($where)->delete();
        return $result;
    }
    
    public function editLine(){
        $data=array(
            'id'=>$_POST['id'],
            'name'=>$_POST['startcity']."-".$_POST['endcity'],
            'startcity' =>$_POST['startcity'],
            'endcity' =>$_POST['endcity'],
            'startg' =>$_POST['startg'],
            'endg' =>$_POST['endg'],
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
        $type = $this->where($where)->find();
        return $type;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>