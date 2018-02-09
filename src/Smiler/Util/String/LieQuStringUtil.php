<?php
namespace Smiler\Util\String;

use Smiler\Util\String\StringUtil;

class LieQuStringUtil extends StringUtil
{

    /**
     *
     * @param unknown $status            
     * @return string
     */
    public static function getOrderStatusNameByStatus($status)
    {
        $name = '';
        switch ($status) {
            case 100:
                $name = '待支付';
                break;
            case 200:
                $name = '支付中';
                break;
            case 300:
                $name = '待发货';
                break;
            case 400:
                $name = '待收货';
                break;
            case 500:
                $name = '已完成';
                break;
            case 600:
                $name = '已取消';
                break;
        }
        return $name;
    }

    /**
     *
     * @param unknown $status            
     * @return string
     */
    public static function getPayStatusNameByStatus($status)
    {
        $name = '';
        switch ($status) {
            case 100:
                $name = '待支付';
                break;
            case 200:
                $name = '支付中';
                break;
            default:
                $name = '已支付';
                break;
        }
        return $name;
    }

    /**
     *
     * @param unknown $attrName            
     * @return string
     */
    public static function getProductAttrStr($attrName)
    {
        $attrNameArr = json_decode($attrName, true);
        $attrStr = '';
        $searchArr = self::getSearchArr();
        foreach ($attrNameArr as $attrNam) {
            $name = $attrNam['name']['name'];
            $name = str_replace($searchArr, '', $name);
            $val = $attrNam['value']['name'];
            $val = str_replace($searchArr, '', $val);
            $attrStr .= $name . ':' . $val . ';';
        }
        return $attrStr;
    }

    /**
     *
     * @param int $mainStatus            
     * @return string
     */
    public static function getSaleStateByStatus($mainStatus)
    {
        $saleState = '';
        switch ($mainStatus) {
            case 1:
                $saleState = '在售';
                break;
            case 3:
                $saleState = '下架';
                break;
            case 4:
                $saleState = '删除';
                break;
            case 30:
                $saleState = '商户下架';
                break;
            case 5:
                $saleState = '待审核';
                break;
            case 6:
                $saleState = '待调整';
                break;
        }
        return $saleState;
    }
}