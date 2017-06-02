<?php
namespace Smiler\Util\Log;

use Monolog\Logger;
// use Monolog\Handler\StreamHandler;
use Monolog\Handler\BufferHandler;
use Smiler\Util\Log\Monolog\AggregateFileHandler;
use Monolog\Formatter\LineFormatter;
use Psr\Log\LogLevel;

class Log
{

    private static $logInstance;

    public static function getLogInstance($logName, $logPath, $startTime, $logLevel = LogLevel::INFO)
    {
        date_default_timezone_set('Asia/Shanghai');
        if (! self::$logInstance) {
            $log = new Logger($logName);
            $fileFullPath = $logPath . $logName . date('Ymd') . '.log';
            // $log->pushHandler(new StreamHandler($fileFullPath, $logLevel));
            $handler = new AggregateFileHandler($fileFullPath);
            $handler->setStartTime($startTime);
            $handler->setFormatter(new LineFormatter("[%datetime%]%level_name% %message% %context% %extra%\n", 'i:s', true, true));
            $log->pushHandler(new BufferHandler($handler));
            self::$logInstance = $log;
        }
        return self::$logInstance;
    }
}