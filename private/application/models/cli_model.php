<?php if (!defined('BASEPATH') || PHP_SAPI != 'cli') {
    exit('No direct script access allowed');
}

/**
 * Cli-model contains helper-method for controllers that are executed in cli (eg. via cron).
 *
 * @package BIBSB\Models
 */
class Cli_model extends CI_Model {
    /**
     * Holds current locks.
     * @type stdClass
     */
    protected $currentLocks;

    /**
     * The directory of lock-files.
     * @type string
     */
    protected $lockfilePath;

    /**
     * The constructor initializes common functions.
     */
    public function __construct() {
        parent::__construct();

        $this->initLocks();
    }

    /**
     * Acquires a lock for a specific method that should only be called once simultaneously.
     *
     * Creates a hash from $controller and $method variables and creates a file with that name and tries to
     * acquire a non-blocking exclusive lock on that file.
     *
     * @param string $controller The name of the controller.
     * @param string $method The name of the method.
     *
     * @return bool Returns false if the file-handle could not be acquired or the file is already locked.
     *
     * @link http://php.net/manual/de/function.flock.php
     *
     * @todo not yet cluster-ready
     */
    public function acquireLock($controller, $method) {
        $lockfilePath = $this->lockfilePath;

        if (!is_dir($lockfilePath)) {
            if (file_exists($lockfilePath)) {
                return false;
            } else {
                mkdir($lockfilePath);
            }
        }

        $identifier = hash('md5', $controller . $method);
        $lockfile = "{$lockfilePath}{$identifier}.lock";

        $handle = fopen($lockfile, 'c+');
        if ($handle === false) {
            return false;
        }

        $wouldBlock = false;
        $lock = flock($handle, LOCK_EX | LOCK_NB, $wouldBlock);
        if (!$lock) {
            fclose($handle);
            return false;
        }

        $this->currentLocks->{$identifier} = $handle;

        return true;
    }

    /**
     * Prints a message with prepended date-time-string and appended EOL to stdout.
     *
     * @param string $message The message to print.
     */
    public function log($message) {
        if (!is_string($message)) {
            $message = print_r($message, true);
        }

        echo date('c') . " {$message}" . PHP_EOL;
    }

    /**
     * Releases all currently active locks.
     */
    public function releaseAllLocks() {
        foreach ((array)$this->currentLocks as $identifier => $handle) {
            flock($handle, LOCK_UN);
            fclose($handle);
        }

        $this->currentLocks = new stdClass();
    }

    /**
     * Releases a lock.
     *
     * @param string $controller The name of the controller.
     * @param string $method The name of the method.
     *
     * @return bool
     */
    public function releaseLock($controller, $method) {
        $identifier = hash('md5', $controller . $method);

        /** @type bool|resource $handle */
        $handle = isset($this->currentLocks->{$identifier}) ? $this->currentLocks->{$identifier} : false;

        if ($handle === false) {
            return false;
        }

        flock($handle, LOCK_UN);
        fclose($handle);

        unset($this->currentLocks->{$identifier});
        return true;
    }

    /**
     * Initializes currentLocks, loads the lock-file-path and adds an shutdown-handler to remove active locks on
     * application-exit.
     */
    protected function initLocks() {
        $this->config->load('application', true);

        register_shutdown_function(array($this, 'releaseAllLocks'));

        $this->currentLocks = new stdClass();
        $this->lockfilePath = $this->config->item('lockfile_path', 'application');
    }
}