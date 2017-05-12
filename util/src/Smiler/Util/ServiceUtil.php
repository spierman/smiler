<?php
namespace Smiler\Util;

use GuzzleHttp\Client;

class ServiceUtil
{

    /**
     * 生成短链接
     *
     * @param string $url            
     * @return array
     */
    public static function makeShortUrl($url)
    {
        $params = array(
            'url' => urlencode($url),
            'alias' => '',
            'access_type' => 'web'
        );
        $client = new Client();
        $res = $client->request('POST', 'http://dwz.cn/create.php', $params);
        $code = $res->getStatusCode() / 100;
        $shortUrl = '';
        if ($code >= 2 && $code < 3) {
            $rst = json_decode($res->getBody(), true);
            if ($rst) {
                if ($data['status'] == 0) {
                    $shortUrl = $data['tinyurl'];
                }
            }
        } else {
           throw new Exception('unable to make short url'.$res->getBody());
        }
        return $shortUrl;
    }
}