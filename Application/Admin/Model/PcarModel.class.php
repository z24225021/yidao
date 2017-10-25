<?php
namespace Admin\Model;
use Think\Model;
use Admin\Controller\validationMap;
use Lib\Tool\Tool;
use Ydapi\Controller\JPushController;
use Ydapi\Controller\SendmsgController;

/**
 * {0}
 * 
 * @author
 * @version 
 */
class PcarModel extends Model{
    protected $trueTableName = 'yd_orderlist';
    /**
     * 发布订单
     * @return number|mixed|boolean|unknown|string|string
     */
    function orderCar(){
        $oid = 'yc'.time();
        $type=$_POST['type'];
        $uid = $_POST['uid'];
        $state = $_POST['state'];
        if($state==''){
            $state='0';
        }
        $data = array(
            'id' =>$oid,
            'type' => $type,
            'uid' => $uid,
            'line' => $_POST['line'],
            'startxy' => $_POST['startxy'],
            'startaddr' => $_POST['startaddr'],
            'endxy' => $_POST['endxy'],
            'endaddr' => $_POST['endaddr'],
            'contact_name' => $_POST['contact_name'],
            'phonenum' => $_POST['phonenum'],
            'pnum' => $_POST['pnum'],
            'pay' => $_POST['pay'],
            'book_time' => $_POST['book_time'],
            'state' =>$state,
            'remark' => $_POST['remark'],
            'rname' =>$_POST['rname'],
            'rphone' =>$_POST['rphone'],
            'gname' =>$_POST['gname'],
            'gtype' =>$_POST['gtype'],
            'gweight' =>$_POST['gweight'],
            'glong' =>$_POST['glong'],
            'gwidth' =>$_POST['gwidth'],
            'gheight' =>$_POST['gheight'],
            'carteam' =>$_POST['carteam'],
            'create_time'=>date("Y-m-d h:i:s", time()),   
        );
        if($this->create($data)){
            $reid = $this->add($data);
            $jpush= new JPushController();
            if("1"==$type){//专车端推送
                $jpush->sendNotifyToDriverOrTeam($oid,2);
            }elseif('2'==$type||'3'==$type){//专线车或者快递端
                $jpush->sendNotifyToDriverOrTeam($oid,4);
            }
            if($reid>=1){
                $this->creatOrderLine($uid, $oid);
            }
            return $reid ? $oid : 0;
        } else {
            return $this->getError();
        }
    }
    /**
     * 修改约车订单
     * @return number|boolean|string
     */
    function editCarOrder(){
        $state = $_POST['state'];
        if($state==''){
            $state='0';
        }
        $data = array(
            'line' => $_POST['line'],
            'type' => $_POST['type'],
            'startxy' => $_POST['startxy'],
            'startaddr' => $_POST['startaddr'],
            'endxy' => $_POST['endxy'],
            'endaddr' => $_POST['endaddr'],
            'contact_name' => $_POST['contact_name'],
            'phonenum' => $_POST['phonenum'],
            'pnum' => $_POST['pnum'],
            'book_time' => $_POST['book_time'],
            'remark' => $_POST['remark'],
//             'uid' => $_POST['uid'],
            'pay' => $_POST['pay'],
            'state' => $state,
            'rname' =>$_POST['rname'],
            'rphone' =>$_POST['rphone'],
            'gname' =>$_POST['gname'],
            'gtype' =>$_POST['gtype'],
            'gweight' =>$_POST['gweight'],
            'glong' =>$_POST['glong'],
            'gwidth' =>$_POST['gwidth'],
            'gheight' =>$_POST['gheight'],
            'carteam' =>$_POST['carteam'],
        );
        $where['id'] = $_POST['id'];
        $result =  $this->where($where)->save($data);
        return $result;
    }
    
    /**
     * 判断用户没订单，或者订单已完成
     * @return boolean
     */
    function checkCarOrder(){
        $map['uid'] = $_POST['uid'];
        $order = $this->where($map)->find();
        if(stripos($uid,'dd')!=""){
            return true;
        }else{
            if(!is_array($order)|| $order['state']==0||$order['state']>=3){//判断用户没订单，或者订单已完成
                return true;
            } else {
                return false;
            }
        }
    }
    
    
    /**
     * 获取订单信息
     * @return mixed|boolean|NULL|string|unknown|array|object
     */
    function getCarInfo(){
        $map['list.id'] = $_POST['id'];
        $order = $this->field('list.id as oid,list.startxy as startxy,list.startaddr as startaddr,list.endxy as endxy,list.endaddr as endaddr,list.line as lineid,list.type as otype,list.contact_name as contact_name,list.phonenum as phonenum,list.pnum as pnum,list.info_from as info_from,list.did as did,list.book_time as book_time,list.create_time as create_time,list.state as state,list.orderdelete as orderdelete,list.pay as pay,list.grade as grade,list.suggest as suggest,list.remark as remark,list.uid as uid,list.rname as rname,list.rphone as rphone,list.gname as gname,list.gtype as gtype,list.gweight as gweight,list.glong as glong,list.gwidth as gwidth,list.gheight as gheight,list.carteam as carteam,oline.route as route,oline.gettime as gettime,oline.arrivetime as arrivetime,user.name as uname,line.name as linename')->table('yd_orderlist as list')->join('__ORDERLINE__ as oline on list.id = oline.oid','LEFT')->join('__USER_INFO__ as user on list.did = user.id','LEFT')->join('__LINE__ as line on list.line = line.id','LEFT')->where($map)->find();
        return $order;
    }
    
    /**
     * 获取订单列表
     * @return mixed|boolean|string|NULL|array|unknown|object
     */
    function getCarList(){
        $uid = $_POST['uid'];
        if($uid!=""){
            $map['uid|did'] = $uid;
        }
        $state = $_POST['state'];
        if($state!=""){
            if($state=='011'){
                $map['state'] = array('IN',array('0','001'));
            }elseif ($state=='101'){
                $map['state'] = array('IN',array('0','001','1'));
            }elseif ($state=='999'){
                $map['state'] = array('IN',array('2','3','4','5','102','-1','-2'));
            }else{
                $map['state'] = $state;
            }
        }
        $ordertype = $_POST['ordertype'];
        if($ordertype!=""){
            $map['type'] = $ordertype;
        }
        $carteam = $_POST['carteam'];
        if($carteam!=""){
            $map['carteam'] = $carteam;
        }
        $line = $_POST['line'];
        if(""!=$line){
            $map['line'] = $line;
        }
        $tday  = $_POST['tday'];
        if(1==$tday){
            $map['book_time'] = array('between',array(strtotime(date('Y-m-d')),strtotime(date("Y-m-d",strtotime("+1 day")))-1));
        }elseif (2==$tday){
            $map['book_time'] = array('between',array(strtotime(date("Y-m-d",strtotime("+1 day"))),strtotime(date("Y-m-d",strtotime("+2 day")))-1));
        }elseif (3==$tday){
            $map['book_time'] = array('between',array(strtotime(date("Y-m-d",strtotime("+2 day"))),strtotime(date("Y-m-d",strtotime("+3 day")))-1));
        }elseif(4 ==$tday){
            $map['book_time'] =array('EGT', strtotime(date("Y-m-d",strtotime("+3 day"))));
        }
        $list = $this->where($map)->order('book_time asc,id desc')->select();
        return $list;
    }
    /**
     * 修改订单属性
     * @return boolean
     */
    function setCarAttr(){
        $map['id'] = $_POST['id'];
        $attr=array(
            $_POST["key"]=>$_POST["value"],
        );
        $result=$this->where($map)->setField($attr);
        return $result;
    }
    /**
     * 网站约车
     */
    function addPcar() {
       $this->orderCar();
    }
    
    function getPcars(){
        $clist = $this->order('create_time desc')->select();
        return $clist;
    }
    
    function findOne($param){
        $where = array('id'=>$param);
        $admin = $this->where($where)->find();
        return $admin;
    }
    
    function editPcar(){
       $this->editCarOrder();
    }
    
    
    function deletePcar($param){
        $where = array('id'=>$param);
        $map['oid'] = $param;
        $this->table('yd_orderline')->where($map)->delete();
        return $this->where($where)->delete();
    }
    
    
    /**
     * 
     * 抢单
     * oid//订单id
     * did//司机id
     * 
     */
    function robOrder(){
        $oid = $_POST['oid'];
        $where = array('id'=>$oid);
        $did = $_POST['did'];
        $data['did'] = $did;
        $data['state'] = 1;
        $result = $this->where($where)->setField($data);
        if($result){
            $map['oid'] = $oid;
            $this->table('yd_orderline')->where($map)->setField("did",$did);
            $jpush= new JPushController();
            $jpush->sendNotifyToLineUser($oid);
        }
        return $result;
    }
    
    
    
    function checkSetState($oid,$state){
        $where['id'] = $oid;
        $result = $this->field('state')->where($where)->find();
        $nstate = $result['state'];
        if($nstate < 0){
            return false;
        }elseif ($nstate>=2&&$state<0){
            return false;
        }else{
            return true;
        }
    }
    
    
    /**
     * 修改订单状态
     */
    
    function setOrderState(){
        $state = $_POST['state'];
        $oid = $_POST['oid'];
        $where = array('id'=>$oid);
        $orderstate = $this->checkSetState($oid,$state);
        if($orderstate){
            $result = $this->where($where)->setField('state',$state);
        }else{
            $result=false;
        }
        $price = 0;
        if($state==2&&$result){
            $ids = $this->field('uid,did,type')->where($where)->find();
            $ids['state'] = $state;
            $ids['oid'] = $oid;
            $ids['stime'] = time();
            if(Tool::chechTime(time())){
                $ids['startntime']=time();
            }
            S('ids',$ids);
            $this->updateOrderLine($oid,$ids['did']);
        }elseif($state==3&&$result){
            if(S('ids')['type']==1){
                $ids = S('ids');
                $longTime = time()-$ids['time'];
                $distance = $this->getOrderLineDistance($oid);
    //             $price = 200;
                $price = $this->checkMoney($longTime, $distance);
                $price = $price<C('p_s_q')?C('p_s_q'):$price;
            }else{
                $this->setArriveTime($oid);
            }
        }elseif($state=='001'&&$result){
            $sms = new SendmsgController();
            $sms->sendMsgAli(2, $oid);
        }
        return $price==0?$result:$price;
    }
    
    function checkMoney($ltime,$distance){
        $ntime=S('ids')['endntime']-S('ids')['startntime'];
        if($ntime<0){
            $ntime = C('daysecond')+$ntime;
        }
        if($ltime<0){
            $ltime = C('daysecond')+$ltime;
        }
        $mordis = 0;
        if($distance/1000 > 10){
            $mordis = $distance/1000-10;
        }
        $price = C('p_s_d')*$distance/1000 + $mordis*C('p_s_l')+$ltime*C('p_s_t')+$ntime*C('p_s_y');
        return $price;
    }
    
    
    
    /**
     * 更新订单线路信息
     */
    function updateOrderLine($oid,$did){
        $where['oid'] = $oid;
        $this->table('yd_orderline')->where($where)->setField(array('did','gettime'),array($did,time()));
    }
    /**
     * 添加订单线路
     */
    function creatOrderLine($uid,$oid){
        $m = M('orderline');
        $data= array(
            'uid' =>$uid,
            'oid' =>$oid,
        );
        if($m->create($data)){
            $cid = $m->add($data);
            return $cid ;
        } else {
            return $m->getError(); //错误详情见自动验证注释
        }
    }

    /**
     * 更新送达乘客时间
     * @param unknown $oid
     */
    function setArriveTime($oid){
        $m = M('orderline');
        $where['oid']=$oid;
        $m ->where($where)->setField('arrivetime',time());
    }
    
    
    /**
     * 添加订单路线位置
     * @param unknown $did
     * @param unknown $loc
     */
    function setOrderLine($oid,$multi){
        $m = M('orderline');
        $sql = "UPDATE yd_orderline SET line = GeomFromText('".$multi."') where oid = '".$oid."'";
        $m->execute($sql);
    }
    
    /**
     * 根据oid获取MultiPoint
     */
    function getOrderLine($oid){
        $m = M('orderline');
        $sql = "SELECT AsText(line) FROM yd_orderline where oid='".$oid."'";
        $result = $m->query($sql);
        return $result[0]['astext(line)'];
    }
    /**
     * 根据multi字符串添加point 生成数组
     * @param multipoint String $multi//MULTIPOINT((0 0),(20 20),(60 60)) 
     * @param point string $str//(33 33)
     */
    function setMultiPointToArray($multi,$point){
        $result = array();
        preg_match_all("/(?:\()(.*)(?:\))/i",$multi, $result);
        if(trim($result[1][0])!=""){
            $re=explode(',',$result[1][0]);
        }else{
            $re=array();
        }
        if($point!=""){
            array_push($re, $point);
        }
        return $re;
    }
    /**
     * 根据坐标组获取Multipoint 字符串
     * @param array $re
     * @return string
     */
    function setArrayToMultiPoint($re){
        $str = join(",", $re);
        return $result ="MULTIPOINT(".$str.")";
    }
    
    /**
     * 坐标变换
     * 34.676714,112.414644->(34.676714 112.414644)
     * @return mixed
     */
    function changePointTo($point){
        $rep = str_replace(",", " ", $point);
        return  "(".$rep.")";
    }
    
    /**
     * 坐标变换
     * (34.676714 112.414644)->34.676714,112.414644
     * @return mixed
     */
    function changePointBack($point){
        $rep = str_replace(" ", ",", $point);
        $re  = preg_replace('/\(|\)/', '', $rep);
        return $re;
    }
    
    /**
     * 获取全路程距离
     */
    function getOrderLineDistance($oid){
//         $oid = "yc1505441326";
        $multipoints = $this->getOrderLine($oid);
        $arr =  $this->setMultiPointToArray($multipoints,"");
        if(count($arr)>1){
            $points = $this->setPointArrayToNPointArray($arr);
            return validationMap::getArrDistance($points);
        }else{
            return 0;
        }
    }
    /**
     * 点集转换
     * 
     * 
        array(8) {
          [0]=>
          string(22) "(34.677282 112.414554)"
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
    function setPointArrayToNPointArray($arr){
        $points = array();
        for ($i=0;$i<count($arr);$i++){
            $point = $this->changePointBack($arr[$i]);
            $multiParr1 = explode(',',$point);
            $newpoint["lng"]=$multiParr1[1];
            $newpoint["lat"]=$multiParr1[0];
            array_push($points, $newpoint);
        }
        return $points;
    }
    /**
     * 计算价格
     */
    function countPrice(){
        $type = $_POST['otype'];
        $sloc = $_POST['startxy'];
        $eloc = $_POST['endxy'];
        if($type == '2'||$type == '3'){
           return  $this->countLinePrice($sloc,$eloc);
        }elseif($type == '1'){
           return  $this->countSpecialPrice($sloc,$eloc);
        }
    }
    
    /**
     * 计算专车价格
     * @param unknown $sloc
     * @param unknown $eloc
     * @return number|mixed|void|NULL|number
     */
    function countSpecialPrice($sloc,$eloc){
        $url = C('url_gd_distance');
        //         http://restapi.amap.com/v3/distance?origins=116.481028,39.989643|114.481028,39.989643|115.481028,39.989643&destination=114.465302,40.004717&output=xml&key=<用户的key>
        //定义传递的参数数组；
        $slocarr = explode(',',$sloc);
        $sloc = $slocarr[1].",".$slocarr[0];
        $elocarr = explode(',',$eloc);
        $eloc = $elocarr[1].",".$elocarr[0];
        $data['origins']=$sloc;
        $data['destination']=$eloc;
        $data['output']='json';
        $data['key']=C('gd_server_key');
         
        //定义返回值接收变量；
        $httpstr = Tool::http($url, $data, 'get', array("Content-type: text/html; charset=utf-8"));
        $arr = json_decode($httpstr,true);
        if($arr['status']=='1'){
            $result = $arr['results'];
            $distance = $result[0]['distance'];
            $duration = $result[0]['duration'];
            $mordis = 0;
            if($distance/1000 > 10){
                $mordis = $distance/1000-10;
            }
            $price = C('p_s_d')*$distance/1000 + $mordis*C('p_s_l')+$duration*C('p_s_t')/60;
            return $price<C('p_s_q')?C('p_s_q'):$price;
        }else{
            return 0;
        }
    }
    
    /**
     * 计算线路价格
     * @param unknown $sloc
     * @param unknown $eloc
     * @return number
     */
    function countLinePrice($sloc,$eloc){
        $lineid = $_POST['line'];
        $pnum = $_POST['pnum']==""?"1":$_POST['pnum'];
        $linemodel = new LineModel();
        $polygon = $linemodel->getCityLineArea($lineid);
        //处理点
        $spoint = Tool::setPointToPointArray($sloc);
        $epoint = Tool::setPointToPointArray($eloc);
        if(count($polygon)==1){
            $price = $polygon[0]['bprice'];
            $add = $polygon[0]['addp'];
            $startg = $polygon[0]['startg'];
            $endg = $polygon[0]['endg'];
            $arrstart = Tool::setPOLYGONToArray($startg);
            $cre1=true;
            for($i=0;$i<count($arrstart);$i++){
                $re = Tool::isPointInPolygon($arrstart[$i], $spoint);
                if(!$re){
                    $price+=$add;
                }
                $cre1=$re;
            }
            $cre2=true;
            $arrend = Tool::setPOLYGONToArray($endg);
            for($i=0;$i<count($arrend);$i++){
//                 /* validationMap::setCoordArray($arrend[$i]);
//                 $re = validationMap::isCityCenter($epoint); */
                $re = Tool::isPointInPolygon($arrend[$i], $epoint);
                if(!$re){
                    $price+=$add;
                }
                $cre2=$re;
            }
            if($cre1&&$cre2){
                if($pnum=='50'){
                    $pnum = 4;
                }else if($pnum=='70'){
                    $pnum = 6;
                }
                return $price*$pnum;
            }else{
                return -1;
            }
        }else {
            return -2;
        }
        
    }
    
    function getOrderInfoToPay(){
        $where['id'] =$_POST['oid'];
        return $this->field("id,pay")->where($where)->find();
    }
    
    
    function getInfoToSendMsg($oid){
        $where['id'] =$oid;
        $re = $this->field('id as oid,phonenum as name,book_time as time')->where($where)->find();
        $rename = explode(',',$re['name']);
        $re['name'] = $rename[0];
        $re['time'] = date("Y-m-d H:i:s",$re['time']);
        return $re;
    }
    
    
    
    
    
}