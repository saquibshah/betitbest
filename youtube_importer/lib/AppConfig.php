<?php
if (!defined('APPPATH')) {
    die('APPPATH not defined');
}

require_once APPPATH . 'lib/Debug.php';

class AppConfig {
    static protected $instance;
    static protected $iniFile;

    protected $data;

    protected function __construct($iniFile) {
        if (is_null($iniFile) || empty($iniFile) || !is_readable($iniFile)) {
            throw new Exception('File could not be opened');
        }

        $this->data = parse_ini_file($iniFile, true);
    }

    public function __isset($key) {
        if (!array_key_exists($key, $this->data)) {
            return false;
        }

        return true;
    }

    public function __get($key) {
        if (!array_key_exists($key, $this->data)) {
            $message = "Undefinierte Eigenschaft für __get(): {$key}\n";

            if (Debug::getDebugMode() == Debug::MODE_TRACE) {
                $trace = debug_backtrace();
                $message .= " in {$trace[0]['file']}\n";
                $message .= " line {$trace[0]['line']}\n";
            }

            trigger_error($message, E_USER_NOTICE);

            return null;
        }

        return $this->data[$key];
    }

    static public function getInstance() {
        if (!isset(static::$iniFile) || empty(static::$iniFile)) {
            throw new Exception('iniFile not set. Please set it before retrieving an instance.');
        }

        if (!isset(static::$instance)) {
            static::$instance = new AppConfig(static::$iniFile);
        }

        return static::$instance;
    }

    static public function setIniFile($iniFile) {
        if (is_null($iniFile) || empty($iniFile) || !is_readable($iniFile)) {
            throw new Exception('File could not be opened');
        }

        static::$iniFile = $iniFile;
    }
}