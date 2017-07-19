<?php
namespace Smiler\Util\Arr;

use Smiler\Util\Arr\ArrayUtil;

class LieQuArrayUtil extends ArrayUtil
{

    private static $catRelation = array();

    public static function getCategoryListByCategoryIds($catIds, $class, $func)
    {
        $totalCatMap = array();
        $catRelation = array();
        $n = 0;
        while (sizeof($catIds) > 0) {
            $n ++;
            $categoryList = self::getMultiDataListByIds($catIds, $class, $func);
            $catIds = array();
            foreach ($categoryList as $category) {
                $categoryId = $category['category_id'];
                $pid = $category['pid'];
                $categoryName = $category['category_name'];
                // $totalCatMap[$n][$categoryId] = $categoryName;
                if (in_array($categoryId, $totalCatMap)) {
                    throw \Exception('category has existed');
                }
                $totalCatMap[$categoryId] = $categoryName;
                if ($pid != 0) {
                    $catIds[] = $pid;
                }
                self::$catRelation[$categoryId] = $pid;
            }
            unset($categoryList);
        }
        return $totalCatMap;
    }

    public static function getCategoryNameByCatId($catId, $index, $catIdMap)
    {
        $catName = '';
        $num = 0;
        $newCatId = $catId;
        while (isset(self::$catRelation[$newCatId])) {
            $num ++;
            $newCatId = self::$catRelation[$newCatId];
        }
        $snum = 0;
        while (isset(self::$catRelation[$catId])) {
            $snum ++;
            $catName = $catIdMap[$catId];
            $catId = self::$catRelation[$catId];
            if ($snum == $num - $index + 1) {
                break;
            }
        }
        return $catName;
    }
}