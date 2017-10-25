<?php
namespace Admin\Controller;
/**
 * 验证坐标点是否在某区域内
 * @author xiaoliang <1058436713@qq.com>
 * Class validationMap
 */
class validationMap{
    private static $coordArray;
    private static $vertx = [];
    private static $verty = [];
    /**
     * 设置坐标区域
     * @param mixed $coordArray
     */
    public static function setCoordArray(array $coordArray)
    {
        self::$coordArray = $coordArray;
    }
    /**
     * 验证区域范围
     * @param array $coordArray
     * @return bool
     */
    public static function isCityCenter(array $coordArray){
        if(!self::vaildatePoint($coordArray)){
            return false;
        }
        return self::pnpoly(count(self::$coordArray), $coordArray['lng'], $coordArray['lat']);
    }
    /**
     * 比较区域坐标
     * @param $nvert
     * @param $testx
     * @param $testy
     * @return bool
     */
    private static function pnpoly($nvert,$testx, $testy)
    {
        $c = false;
        for ($i = 0, $j = $nvert-1; $i < $nvert; $j = $i++) {
            if ( ( (self::$verty[$i]>$testy) != (self::$verty[$j]>$testy) ) && ($testx < (self::$vertx[$j]-self::$vertx[$i]) * ($testy-self::$verty[$i]) / (self::$verty[$j]-self::$verty[$i]) + self::$vertx[$i]) )
                $c = !$c;
        }
        return $c;
    }
    /**
     * 验证坐标
     * @param array $pointArray
     * @return bool
     */
    private static function vaildatePoint(array $pointArray){
        $maxY = $maxX = 0;
        $minY = $minX = 9999;
        foreach (self::$coordArray as $item){
            if($item['lng']>$maxX) $maxX = $item['lng'];
            if($item['lng'] < $minX) $minX = $item['lng'];
            if($item['lat']>$maxY) $maxY = $item['lat'];
            if($item['lat'] < $minY) $minY = $item['lat'];
            self::$vertx[] = $item['lng'];
            self::$verty[] = $item['lat'];
        }
        if ($pointArray['lng'] < $minX || $pointArray['lng'] > $maxX || $pointArray['lat'] < $minY || $pointArray['lat'] > $maxY) {
            return false;
        }
        return true;
    }
    
    /**
     * @desc 根据两点间的经纬度计算距离
     * @param float $lat 纬度值
     * @param float $lng 经度值
     */
    private static function getDistance($fontpoint,$point )
    {   
        $lat1 = $fontpoint['lat'];
        $lng1 = $fontpoint['lng'];
        $lat2 = $point['lat'];
        $lng2 = $point['lng'];
        $earthRadius = 6367000; //approximate radius of earth in meters
        $lat1 = ($lat1 * pi() ) / 180;
        $lng1 = ($lng1 * pi() ) / 180;
        $lat2 = ($lat2 * pi() ) / 180;
        $lng2 = ($lng2 * pi() ) / 180;
        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;
        return round($calculatedDistance);
    }
    /**
     * 点转换
     * @param unknown $point
     * @return mixed
     */
    private static function changePointBack($point){
        $rep = str_replace(" ", ",", $point);
        $re  = preg_replace('/\(|\)/', '', $rep);
        return $re;
    }
    
    /**
     * 计算坐标点数组距离
     * @param unknown $arr
     * @return number
     */
    public static function getArrDistance($arr){
        $length = 0;
        for ($i=0;$i<count($arr)-1;$i++){
            $fponit = validationMap::changePointBack($arr[$i]);
            $point  = validationMap::changePointBack($arr[$i+1]);
            $length += validationMap::getDistance($fponit,$point);
        }
        return $length;
    }
}




/**************************** test *************************************/
// $map = [  //上海
//     ["lng" => 121.488286, "lat" => 31.420147],
//     ["lng" => 121.702154, "lat" => 31.294828],
//     ["lng" => 121.780918, "lat" => 31.141157],
//     ["lng" => 121.782068, "lat" => 30.941157],
//     ["lng" => 121.492885, "lat" => 30.909931],
//     ["lng" => 121.22325, "lat" => 30.890099],
//     ["lng" => 121.161482, "lat" => 31.015526],
//     ["lng" => 121.076395, "lat" => 31.226239],
//     ["lng" => 121.189873, "lat" => 31.339688],
//     ["lng" => 121.459509, "lat" => 31.41368],
// ];
// $array = ["lat"=>31.218681,"lng"=>121.08604];//进行验证的区域
// validationMap.class::setCoordArray($map);
// var_dump(validationMap.class::isCityCenter($array));