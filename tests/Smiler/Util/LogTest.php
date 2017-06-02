<?php
use Smiler\Util\Log\Log;

class LogTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function monolog()
    {
        $log = Log::getLogInstance('123', '/home/fuyou/test/', microtime(true));
        $log->info('nihao');
    }
}