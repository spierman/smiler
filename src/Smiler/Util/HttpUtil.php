<?php
namespace Smiler\Util;

class HttpUtil
{

    /**
     *
     * @return boolean
     */
    public static function isAjaxRequest()
    {
        return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest";
    }
}