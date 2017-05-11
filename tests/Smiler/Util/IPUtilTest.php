<?php
namespace Smiler\Util;

use Smiler\Util\IPUtil;

class IPUtilTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function getClientIP()
    {
        $clientIp = IPUtil::getClientIP();
        $this->assertNotEmpty($clientIp);
    }
}