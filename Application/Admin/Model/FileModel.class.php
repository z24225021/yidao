<?php
namespace Admin\Model;

use Think\Model;
class FileModel extends Model
{
    protected $trueTableName = 'yd_upload';
    public function flist(){
        $roles = $this->select();
        return $roles;
    }
    
    function imageUpload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     2*1024*1024 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $uptype= $_POST['uptype'];
        $upload->savePath  =  $uptype.'/'; // 设置附件上传（子）目录
        // 上传文件
//         log($_POST);
        $info = $upload->upload();
        if($info['file']){
            $file=$info['file'];
            $data['code']=200;
            $data['msg'] = "上传成功！";
            $file['path']='Uploads/'.$file['savepath'].$file['savename'];
            $data['info'] = $file;
            $this->addFile($file,$uptype);
        }else if($info['wangEditorH5File']){
            $file=$info['wangEditorH5File'];
            echo 'http://'.$_SERVER['SERVER_NAME']."/yidao/Uploads/". $file["savepath"].$file["savename"];
            exit();
        }else{
            $data['code']=0;
            $data['msg']="上传失败！";
            $data['other'] = "";
        }
        return $data;
    }
    
    public function uploadPic(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     2*1024*1024 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =  'pic/'; // 设置附件上传（子）目录
        //         log($_POST);
        $info = $upload->upload();
        if($info['file']){
            $file = $info['file'];
            $data['code']=200;
            $data['msg'] = "更新成功！";
            $data['path'] = 'Uploads/'.$file['savepath'].$file['savename'];
            $this->addFile($file,"pic");
        }else{
            $data['code']=0;
            $data['msg']="更新失败！";
        }
        return $data;
    }
    
    
    
    public function addFile($file,$type){
        $data = array(
            'id' =>'f'.time(),
            'name' =>$file['name'],
            'type' =>$file['type'],
            'size' =>$file['size'],
            'path' =>'./Uploads/'.$file['savepath'].$file['savename'],
            'key' =>$file['key'],
            'ext' =>$file['ext'],
            'savename' =>$file['savename'],
            'uptype' =>$type,
            'savepath' =>$file['savepath'],
        );
        if($this->create($data)){
            $fid = $this->add($data);
            return $fid ? $fid : 0; 
        } else {
            return $this->getError(); //错误详情见自动验证注释
        } 
    }
   /*  
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
     */
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>