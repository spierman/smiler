<?php

/**
 * 
 * @author  fuyou <fuyou@yourmall.com>
 * @copyright liequ May 10, 2017  6:59:52 PM
 * @description
 */
namespace Smiler\Util\String;

class StringUtil
{

    public static function strAdd($str1, $str2)
    {
        $res = array();
        if (strlen($str1) > strlen($str2)) {
            $str2 = str_pad($str2, strlen($str1), '0', STR_PAD_LEFT);
        } else {
            $str1 = str_pad($str1, strlen($str2), '0', STR_PAD_LEFT);
        }
        for ($i = strlen($str1) - 1; $i >= 0; $i --) {
            $tmp = $str1[$i] + $str2[$i];
            $res[$i] += $tmp;
            if ($res[$i] >= 10) {
                $res[$i] -= 10;
                $res[$i - 1] += 1;
            }
        }
        ksort($res);
        $res = implode('', $res);
        return $res;
    }

    public static function format_number($number, $precision = 2)
    {
        if (empty($number)) {
            $number = 0;
        }
        $number = number_format($number, $precision, '.', '');
        return $number;
    }
}