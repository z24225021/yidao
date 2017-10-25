<?php
namespace Lib\Tool;

class Tool
{
    public static function chechTime($d){  
        $d=date('H:i:s',$d);
        $time_1 = C('nightstart');
        $time_2 = C('nightend');
        if($d>=$time_1&& $d<="24:00:00"||$d<=$time_2&&$d>='00:00:00'){
            return true;
        }else{
            return false;
        }
    }
    
    
      /**
     * 根据multi字符串添加point 生成数组
     * @param multipoint String $multi//MULTIPOINT((0 0),(20 20),(60 60)) 
     * @param point string $str//(33 33)
     */
    public static function setPOLYGONToArray($multi){
        $result = array();
        preg_match_all("/(?:\()(.*)(?:\))/i",$multi, $result);
        $re=explode('),(',$result[1][0]);
        $parrs=array();
        for($i=0;$i<count($re);$i++){
            $re[$i] = preg_replace('/\(|\)/', '',$re[$i]);
            $pointarr = Tool::changePointString($re[$i]);
            array_push($parrs, $pointarr);
        }
        return $parrs;
    }
    /**
     * 
     * 112.382283 34.69071,112.446828 34.699037,112.495064 34.704118,112.503648 34.677441,112.460217 34.6701,112.423482 34.651604,112.379365 34.660358,112.382283 34.69071
     * 
     */
    public static function changePointString($pointstr){
        $points = explode(",", $pointstr);
        $parrarr = Tool::setPointArrayToNPointArray($points);
        return $parrarr;
    }
    
    
    /**
     * 点集转换
     *
     *
     array(8) {
     [0]=>
     string(22) "34.677282 112.414554"
     }
     array(8) {
     [0]=>
     array(2) {
     ["lng"]=>
     string(10) "112.414554"
     ["lat"]=>
     string(9) "34.677282"
     }
     }
     *
     * @param unknown $arr
     */
    public static function setPointArrayToNPointArray($arr){
        $points = array();
        for ($i=0;$i<count($arr);$i++){
            $multiParr1 = explode(' ',$arr[$i]);
            $newpoint["lng"]=$multiParr1[0];
            $newpoint["lat"]=$multiParr1[1];
            array_push($points, $newpoint);
        }
        return $points;
    }
    public static function setPointToPointArray($point){
        $multiParr = explode(',',$point);
        $newpoint["lng"]=$multiParr[0];
        $newpoint["lat"]=$multiParr[1];
        return $newpoint;
    }
    
    /**
     * 发送HTTP请求方法
     * @param  string $url    请求URL
     * @param  array  $params 请求参数
     * @param  string $method 请求方法GET/POST
     * @return array  $data   响应数据
     */
    public static function http($url, $params, $method = 'GET', $header = array(), $multi = false){
        $opts = array(
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_HTTPHEADER     => $header
        );
        /* 根据请求类型设置特定参数 */
        switch(strtoupper($method)){
            case 'GET':
                $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
                break;
            case 'POST':
                //判断是否传输文件
                $params = $multi ? $params : http_build_query($params);
                $opts[CURLOPT_URL] = $url;
                $opts[CURLOPT_POST] = 1;
                $opts[CURLOPT_POSTFIELDS] = $params;
                break;
            default:
                throw new Exception('不支持的请求方式！');
        }
        /* 初始化并执行curl请求 */
        $ch = curl_init();
        curl_setopt_array($ch, $opts);
        $data  = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if($error) throw new Exception('请求发生错误：' . $error);
        return $data;
    }
    
    
     public static function distance(){
      
     }
    
    
     
    public static function isPointInPolygon($polygon,$lnglat){
         $count = count($polygon);
         $px = $lnglat['lng'];
         $py = $lnglat['lat'];
         $flag = FALSE;
         for ($i = 0, $j = $count - 1; $i < $count; $j = $i, $i++) {
             $sy = $polygon[$i]['lng'];
             $sx = $polygon[$i]['lat'];
             $ty = $polygon[$j]['lng'];
             $tx = $polygon[$j]['lat'];
             if ($px == $sx && $py == $sy || $px == $tx && $py == $ty)
                 return TRUE;
                 if ($sy < $py && $ty >= $py || $sy >= $py && $ty < $py) {
                     $x = $sx + ($py - $sy) * ($tx - $sx) / ($ty - $sy);
                     if ($x == $px)
                         return TRUE;
                         if ($x > $px)
                             $flag = !$flag;
                 }
         }
         return $flag;
     }
     
     /**
      * 验证手机号是否正确
      * @author honfei
      * @param number $mobile
      */
     static function isMobile($mobile) {
         if (!is_numeric($mobile)) {
             return false;
         }
         return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
     }
}

?>