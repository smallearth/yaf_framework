<?php

class Logger
{
    static private $_LOG_HANDLE;
    static private $_UNIQUE_LOG_ID;

    static public function info($msg, $context = [])
    {
        self::_log($msg, "info", $context);
    }

    static public function error($msg, $context = [])
    {
        self::_log($msg, "error", $context);
    }

    static public function err($msg, $context = [])
    {
        self::_log($msg, 'err', $context);
    }

    static public function debug($msg, $context = [])
    {
        self::_log($msg, "debug", $context);
    }

    static public function notice($msg, $context = [])
    {
        self::_log($msg, "notice", $context);
    }

    static public function warning($msg, $context = [])
    {
        self::_log($msg, "warning", $context);
    }

    static public function warn($msg, $context = [])
    {
        self::_log($msg, 'warn', $context);
    }

    static public function alert($msg, $context = [])
    {
        self::_log($msg, "alert", $context);
    }

    static public function critical($msg, $context = [])
    {
        self::_log($msg, "critical", $context);
    }

    static public function crit($msg, $context = [])
    {
        self::_log($msg, 'crit', $context);
    }

    static public function emergency($msg, $context = [])
    {
        self::_log($msg, "emergency", $context);
    }

    static public function emerg($msg, $context = [])
    {
        self::_log($msg, 'emerg', $context);
    }

    static private function _log($msg, $level = "info", $context)
    {
        if (!self::$_LOG_HANDLE) {
            self::_getLogHandle();
        }

        $class = isset(debug_backtrace()[2]['class']) ? debug_backtrace()[2]['class'] : debug_backtrace()[1]['class'];
        $function = isset(debug_backtrace()[2]['function']) ? debug_backtrace()[2]['function'] : debug_backtrace()[1]['function'];

        $logString = sprintf("[%s->%s] %s ", $class, $function, $msg);
        if (!empty($context)) {
            foreach ($context as $k => $v) {
                if (!is_string($v)) {
                    $v = json_encode($v, JSON_UNESCAPED_UNICODE);
                }
                $logString .= ' [' . $k . ': ' . $v . ']';
            }
        }
        self::$_LOG_HANDLE->$level($logString);
    }

    static private function _getLogHandle()
    {
        if (!self::$_LOG_HANDLE) {
            $dateFormat = "Y-m-d H:i:s";
            $logFormat = "[%datetime%] [%level_name%] [%channel%] %message%\n";
            $formatter = new Monolog\Formatter\LineFormatter($logFormat, $dateFormat);

            $filePath = Yaf\Application::app()->getConfig()->get('log.file.path');
            $logLevel = Yaf\Application::app()->getConfig()->get('log.level');
            $filePath .= '.' . date("Ymd");

            $streamHandler = new Monolog\Handler\StreamHandler($filePath, $logLevel);
            $streamHandler->setFormatter($formatter);

            self::$_UNIQUE_LOG_ID = self::_getUniqueLogId();
            self::$_LOG_HANDLE = new \Monolog\Logger(self::$_UNIQUE_LOG_ID);
            self::$_LOG_HANDLE->pushHandler($streamHandler);
        }
    }

    static private function _getUniqueLogId()
    {
        if (!self::$_UNIQUE_LOG_ID) {
            if (!empty($_REQUEST['request_id'])) {
                self::$_UNIQUE_LOG_ID = $_REQUEST['request_id'];
            } else {
                self::$_UNIQUE_LOG_ID = sprintf("%u%04u",
                    substr(sprintf("%.0f", microtime(true) * 1000000), 5),
                    rand(0, 9999));
            }
        }
        return self::$_UNIQUE_LOG_ID;
    }
}