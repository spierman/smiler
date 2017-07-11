<?php
namespace Smiler\Util;

class ArrayUtil
{

    /**
     *
     * @param array $arr            
     * @return array
     */
    public static function filterNullVal($arr, $checkValues = array(null,''))
    {
        foreach ($arr as $key => $val) {
            if (in_array($val, $checkValues)) {
                unset($arr[$key]);
            }
        }
        return $arr;
    }

    /**
     *
     * @param array $object            
     * @param boolean $is_filter_nullval            
     * @return array
     */
    public static function objectToArray($object)
    {
        $arr = is_object($object) ? get_object_vars($object) : $object;
        $new_arr = array();
        foreach ($arr as $key => $a) {
            if ($a === null) {
                continue;
            }
            $new_arr[$key] = $a;
        }
        return $new_arr;
    }

    /**
     *
     * @param array $ids            
     * @param string $class            
     * @param string $func            
     * @return array
     */
    public static function getMultiDataListByIds($ids, $class, $func, $size = 256)
    {
        $instance = new $class();
        $flag = true;
        $newList = [];
        $page = 0;
        while ($flag) {
            $idArr = self::sliceArr($ids, $page, $size);
            if ($idArr) {
                $list = $instance->$func($idArr);
                if ($list) {
                    $newList = array_merge($newList, $list);
                }
                $page ++;
            } else {
                $flag = false;
            }
        }
        return $newList;
    }

    /**
     *
     * @param array $ids            
     * @param string $class            
     * @param string $func            
     * @return array
     */
    public static function getMultiDataListByMultiParams($class, $func, ...$parms)
    {
        $instance = new $class();
        $flag = true;
        $newList = [];
        $page = 0;
        $size = 256;
        while ($flag) {
            $idArr = self::sliceArr($ids, $page, $size);
            if ($idArr) {
                $list = $instance->$func($parms);
                if ($list) {
                    $newList = array_merge($newList, $list);
                }
                $page ++;
            } else {
                $flag = false;
            }
        }
        return $newList;
    }

    /**
     *
     * @param array $arr            
     * @param int $page            
     * @param int $size            
     * @return array
     */
    public static function sliceArr($arr, $page, $size)
    {
        $start = $page * $size;
        if ($start < 0) {
            $start = 0;
        }
        $newArr = array_slice($arr, $start, $size);
        return $newArr;
    }

    /**
     * 根据开始时间和结束时间获取区间内的日期
     *
     * @param int $startTimestamp            
     * @param int $endTimestamp            
     * @param string $dateFormat            
     * @return array
     */
    public static function getDateArrByDatePeriod($startTimestamp, $endTimestamp, $dateFormat = 'Y-m-d')
    {
        $daySeconds = 86400;
        $dateArr = array();
        $dateDiff = ($endTimestamp - $startTimestamp) / $daySeconds;
        for ($i = 0; $i <= $dateDiff; $i ++) {
            $dateArr[] = date($dateFormat, $startTimestamp + $i * $daySeconds);
        }
        return $dateArr;
    }

    /**
     * 获取数组最大值
     *
     * @param array $arr            
     * @return string
     */
    public function getMaxValue($arr)
    {
        $pos = array_search(max($arr), $arr);
        return $arr[$pos];
    }

    /**
     * 获取数组最小值
     *
     * @param array $arr            
     * @return string
     */
    public function getMinValue($arr)
    {
        $pos = array_search(min($arr), $arr);
        return $arr[$pos];
    }
}