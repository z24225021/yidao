<?php
namespace Ydapi\Model;

use Think\Model;
class AliyunModel extends Model
{
    
    function aliVerifyIdCard(){
        
        /* if($info['file']){
            $file=$info['file'];
            $data['code']=200;
            $data['msg'] = "上传成功！";
            $file['path']='Uploads/'.$file['savepath'].$file['savename'];
            $data['info'] = $file;
            $this->addFile($file);
        }else if($info['wangEditorH5File']){
            $file=$info['wangEditorH5File'];
            echo 'http://'.$_SERVER['SERVER_NAME']."/yidao/Uploads/". $file["savepath"].$file["savename"];
            exit();
        }else{
            $data['code']=0;
            $data['msg']="上传失败！";
            $data['other'] = "";
        }
        return $data; */
    }
    
    public function addFile($file){
        $data = array(
            'id' =>'f'.time(),
            'name' =>$file['name'],
            'type' =>$file['type'],
            'size' =>$file['size'],
            'path' =>'./Uploads/'.$file['savepath'].$file['savename'],
            'key' =>$file['key'],
            'ext' =>$file['ext'],
            'savename' =>$file['savename'],
            'uptype' =>$_POST['uptype'],
            'savepath' =>$file['savepath'],
        );
        if($this->create($data)){
            $fid = $this->add($data);
            return $fid ? $fid : 0; 
        } else {
            return $this->getError(); //错误详情见自动验证注释
        } 
    }
  
    
    public function sendSmsMess(){
      
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

?>