<?php
namespace Smiler\Util;

class ArrayUtil
{

    public static function filterNullVal($arr)
    {
        $newArr = [];
        foreach ($arr as $key => $val) {
            if ($val === null || $val === '') {
                continue;
            }
            $newArr[$key] = $val;
        }
        return $newArr;
    }
}