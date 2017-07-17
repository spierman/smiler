<?php
namespace Smiler\Util;

class FileUtil
{

    public static function getFilePathArr($dir, &$result)
    {
        $handle = opendir($dir);
        if ($handle) {
            while (($file = readdir($handle)) !== false) {
                if ($file != '.' && $file != '..') {
                    $curPath = $dir . DIRECTORY_SEPARATOR . $file;
                    if (is_dir($curPath)) {
                        self::getFilePathArr($curPath, $result);
                    } else {
                        $result[] = $curPath;
                    }
                }
            }
            closedir($handle);
        }
        return $result;
    }
}