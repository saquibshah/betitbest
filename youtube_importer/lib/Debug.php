<?php

class Debug {
    const MODE_FATAL = 1;
    const MODE_ERROR = 2;
    const MODE_WARNING = 4;
    const MODE_INFO = 8;
    const MODE_DEBUG = 16;
    const MODE_TRACE = 32;

    static protected $mode;

    static function getDebugMode() {
        return static::$mode;
    }

    static function setDebugMode($mode) {
        static::$mode = $mode;
    }

    static function setExceptionHandler() {
        set_exception_handler('Debug::exceptionHandler');
    }

    static function printStructured() {
        $args = func_get_args();

        if (empty($args)) {
            echo 'No printable data given!';
            return;
        }

        echo "<pre>\n";
        if (count($args) > 1) {
            print_r($args);
        } else {
            print_r($args[0]);
        }
        echo "</pre>\n";
    }

    static function exceptionHandler(Exception $e) {
        static::log('Exception', $e->getMessage());

        foreach (explode("\n", $e->getTraceAsString()) as $line) {
            static::log('Exception Trace', $line);
        }
    }

    static function log($module, $message, $insertEmptyLine = false) {
        $datetime = date('Y-m-d H:i:s');
        echo "[{$datetime}] {$module}: {$message}\n";

        if ($insertEmptyLine) {
            echo "\n";
        }
    }
}