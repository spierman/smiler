<?php
namespace Smiler\Util;

class ArrayUtil
{

    public static function filterNullVal($arr)
    {
        foreach ($arr as $key => $val) {
            if ($val === null || $val === '') {
               unset($arr[$key]);
            }
        }
        return $arr;
    }
}