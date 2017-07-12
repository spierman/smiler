<?php
namespace Smiler\Util\Arr;

use Smiler\Util\Arr\ArrayUtil;

class LiequArrayUtil extends ArrayUtil
{

    public static function getCategoryListByCategoryIds($catIds, $class, $func)
    {
        $totalCatMap = array();
        $n = 0;
        while (sizeof($catIds) > 0) {
            $n ++;
            $categoryList = self::getMultiDataListByIds($catIds, $class, $func);
            $catIds = array();
            foreach ($categoryList as $category) {
                $categoryId = $category['category_id'];
                $pid = $category['pid'];
                $categoryName = $category['category_name'];
                $totalCatMap[$n][$categoryId] = $categoryName;
                if ($pid != 0) {
                    $catIds[] = $pid;
                }
            }
            unset($categoryList);
        }
        return $totalCatMap;
    }

    public static function getCategoryNameByCatId($catId, $index, $catIdMap)
    {
        $len = sizeof(array_keys($catIdMap));
        $key = $len - $index + 1;
        return $catIdMap[$key][$catId];
    }
}