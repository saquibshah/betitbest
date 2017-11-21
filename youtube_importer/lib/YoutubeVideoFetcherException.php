<?php
if (!defined('APPPATH')) {
    die('APPPATH not defined');
}

require_once APPPATH . 'lib/AppConfig.php';

class YoutubeVideoFetcherException extends Exception {
    public function __construct($value, $type, $message) {
        $this->_disableVideoChannel($value, $type, $message);
        parent::__construct($message);
    }

    protected function _disableVideoChannel($value, $type, $message) {
        $config = AppConfig::getInstance();

        switch ($type) {
            case YoutubeVideoFetcher::TYPE_PLAYLIST:
                $type = 'playlist';
                break;

            case YoutubeVideoFetcher::TYPE_CHANNEL:
                $type = 'channel';
                break;

            case YoutubeVideoFetcher::TYPE_USER:
                $type = 'user';
                break;

            case YoutubeVideoFetcher::TYPE_SINGLEVIDEO:
                $type = 'singlevideo';
                break;
        }

        $dbh = new PDO(sprintf("mysql:host=%s;port=%i;dbname=%s;charset=utf8", $config->db['host'], $config->db['port'],
            $config->db['database']), $config->db['username'], $config->db['password']);

        $sth = $dbh->prepare("UPDATE sportnews_videochannel SET disabled = 1, disable_reason = ?, last_update = ? "
            . "WHERE value = ? AND type = ?;");
        if (!$sth) {
            throw new Exception('Disable of channel failed: ' . implode(', ', $dbh->errorInfo()));
        }

        if (!$sth->execute(array($message, time(), $value, $type))) {
            throw new Exception('Disable of channel failed: ' . implode(', ', $sth->errorInfo()));
        }
    }
}