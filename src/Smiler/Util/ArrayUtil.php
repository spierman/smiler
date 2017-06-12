<?php
namespace Smiler\Util;

class ArrayUtil
{

    /**
     *
     * @param array $arr            
     * @return array
     */
    public static function filterNullVal($arr)
    {
        foreach ($arr as $key => $val) {
            if ($val === null || $val === '') {
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
    public static function objectToArray($object, $is_filter_nullval = true)
    {
        $arr = is_object($object) ? get_object_vars($object) : $object;
        $new_arr = array();
        if ($is_filter_nullval) {
            foreach ($arr as $key => $a) {
                if ($a === null) {
                    continue;
                }
                $new_arr[$key] = $a;
            }
        } else {
            $new_arr = $arr;
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
}