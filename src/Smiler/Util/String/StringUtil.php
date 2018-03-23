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

    public static function formatNumber($number, $precision = 2)
    {
        if (empty($number)) {
            $number = 0;
        }
        $number = number_format($number, $precision, '.', '');
        return $number;
    }

    public static function getSearchArr()
    {
        return array(
            "=",
            " ",
            "　",
            ",",
            "\t",
            "\n",
            "\r",
            "\r\n",
            "\r</br>",
            "</br>"
        );
    }

    /**
     *
     * @param string $str
     * @return string
     */
    public static function cleanStr($str)
    {
        $searchArr = self::getSearchArr();
        return str_replace($searchArr, '', $str);
    }

    /**
     * get the product discount
     *
     * @param float $salePrice
     * @param float $originalPrice
     * @param int $precision
     * @return float
     */
    public function getDiscount($salePrice, $originalPrice, $precision = 2)
    {
        return floatval(number_format(round($salePrice / $originalPrice, 2) * 10, 2));
    }

    public function cleanExcelOperation($str)
    {
        if (strpos('=', $str) === 0) {
            $str = "'" . $str;
        }
        return $str;
    }

    /**
     * 时间区间是否存在交集
     *
     * @param array $timePeriod1
     * @param array $timePeriod2
     * @return boolean
     */
    public static function isIntersectionTimePeriod($timePeriod1, $timePeriod2)
    {
        $beginTime1 = strtotime($timePeriod1[0]);
        $endTime1 = strtotime($timePeriod1[1]);
        $beginTime2 = strtotime($timePeriod2[0]);
        $endTime2 = strtotime($timePeriod2[1]);
        $status = $beginTime2 - $beginTime1;
        if ($status > 0) {
            $status2 = $beginTime2 - $endTime1;
            if ($status2 >= 0) {
                return false;
            } else {
                return true;
            }
        } else {
            $status2 = $endTime2 - $beginTime1;
            if ($status2 > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     *
     * @param array $ids
     * @return string
     */
    public static function getStrByIds(array $ids)
    {
        $str = '';
        foreach ($ids as $id) {
            $str .= "'{$id}',";
        }
        return substr($str, 0, strlen($str) - 1);
    }

    public static function makeSqlLimit($page, $size)
    {
        $marker = $page * $size;
        return " limit $marker,$size";
    }

    public function getWebPage($page)
    {
        $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
        if ($page >= 1) {
            $page -= 1;
        }
        return $page;
    }
}