<?php
namespace Smiler\Util\Log\Monolog;

use Carbon\Carbon;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Smiler\Util\IPUtil;

class AggregateFileHandler extends StreamHandler
{

    private $startTime;

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Monolog\Handler\AbstractHandler::handleBatch()
     */
    public function handleBatch(array $records)
    {
        $duration = number_format(microtime(true) - $this->startTime, 3);
        $clientIp = IPUtil::getClientIP();
        $requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'unknown http method';
        $requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : 'unknown request url';
        $format = 'Y-m-d H:i:s.u';
        // 这一行是我们这个处理器自己加上的日志，记录请求时间、响应时间、访客IP，请求方法、请求Url
        $log = sprintf("[%s][%s]%s %s %s\n", date($format,$this->startTime), $duration, $clientIp, $requestMethod, $requestUrl);
        // 然后将内存中的日志追加到$log这个变量里
        foreach ($records as $record) {
            if (! $this->isHandling($record)) {
                continue;
            }
            $record = $this->processRecord($record);
            $log .= $this->getFormatter()->format($record);
        }
        // 调用日志写入方法
        $this->write([
            'formatted' => $log
        ]);
    }
}