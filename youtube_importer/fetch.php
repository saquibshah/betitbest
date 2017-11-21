<?php
define('APPPATH', realpath(dirname(__FILE__)) . '/');

require_once APPPATH . 'lib/Debug.php';
require_once APPPATH . 'lib/YoutubeVideoFetcher.php';
require_once APPPATH . 'lib/Queue.php';

Debug::setDebugMode(Debug::MODE_TRACE);
Debug::setExceptionHandler();
AppConfig::setIniFile(APPPATH . 'config.ini');

$config = AppConfig::getInstance();

$types = array('playlist' => YoutubeVideoFetcher::TYPE_PLAYLIST, 'channel' => YoutubeVideoFetcher::TYPE_CHANNEL,
    'user' => YoutubeVideoFetcher::TYPE_USER, 'singlevideo' => YoutubeVideoFetcher::TYPE_SINGLEVIDEO,
    'topic' => YoutubeVideoFetcher::TYPE_CHANNEL);

$options = getopt("t:");

if (!isset($options['t']) || !array_key_exists($options['t'], $types)) {
    throw new Exception('type not accepted.');
}

$q = new Queue($types[$options['t']]);
$q->process();
