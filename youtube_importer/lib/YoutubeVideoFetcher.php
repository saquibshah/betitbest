<?php
if (!defined('APPPATH')) {
    die('APPPATH not defined');
}

require_once APPPATH . 'lib/YoutubeVideoFetcherException.php';
require_once APPPATH . 'lib/AppConfig.php';
require_once APPPATH . 'vendor/google-api-php-client/autoload.php';

class YoutubeVideoFetcher {
    const TYPE_PLAYLIST = 1;
    const TYPE_CHANNEL = 2;
    const TYPE_USER = 3;
    const TYPE_SINGLEVIDEO = 4;

    const TYPE_MIN_VAL = 1;
    const TYPE_MAX_VAL = 4;

    protected $_config;

    protected $_id;
    protected $_type;

    protected $_apiInitialized;
    protected $_yt;

    public function __construct($id, $type) {
        if (is_null($id) || empty($id)) {
            throw new Exception('id must not be empty');
        }

        if ($type < self::TYPE_MIN_VAL || $type > self::TYPE_MAX_VAL) {
            throw new Exception('type cannot be out of bounds');
        }

        $this->_config = AppConfig::getInstance();
        $this->_id = $id;
        $this->_type = $type;
        $this->_apiInitialized = false;
    }

    public function fetchVideos() {
        $this->_initYoutubeApi();

        $args = array(
            'maxResults' => $this->_config->youtube['max_results']
        );

        $result = array();

        switch ($this->_type) {
            case self::TYPE_USER:
                // Quota cost: 3
                try {
                    $channelResponse = $this->_yt->channels->listChannels('contentDetails',
                        array_merge($args, array('forUsername' => $this->_id)));
                    if (!isset($channelResponse['items'][0]['contentDetails']['relatedPlaylists']['uploads'])) {
                        throw new YoutubeVideoFetcherException($this->_id, $this->_type, 'Uploads-Playlist not found.');
                    }

                    // Quota cost: 3
                    $response = $this->_yt->playlistItems->listPlaylistItems('snippet', array_merge($args, array
                    ('playlistId' => $channelResponse['items'][0]['contentDetails']['relatedPlaylists']['uploads'])));
                } catch (Exception $e) {
                    throw new YoutubeVideoFetcherException($this->_id, $this->_type, $e->getMessage());
                }
                break;

            case self::TYPE_PLAYLIST:
                // Quota cost: 3
                try {
                    $response = $this->_yt->playlistItems->listPlaylistItems('snippet', array_merge($args,
                        array('playlistId' => $this->_id)));
                } catch (Exception $e) {
                    throw new YoutubeVideoFetcherException($this->_id, $this->_type, $e->getMessage());
                }
                break;

            case self::TYPE_SINGLEVIDEO:
                // Quota cost: 3
                try {
                    $response = $this->_yt->videos->listVideos('snippet',
                        array_merge($args, array('id' => $this->_id)));
                    $result = array($response['items'][0]['id']);
                } catch (Exception $e) {
                    throw new YoutubeVideoFetcherException($this->_id, $this->_type, $e->getMessage());
                }
                break;

            case self::TYPE_CHANNEL:
                try {
                    // Quota cost: 3
                    $playlistsResponse = $this->_yt->playlists->listPlaylists('snippet', array_merge($args, array
                    ('channelId' => $this->_id)));

                    $result = array();
                    foreach ($playlistsResponse['items'] as $playlist) {
                        // Quota cost: 3
                        $playlistItemsResponse = $this->_yt->playlistItems->listPlaylistItems('snippet',
                            array_merge($args, array('playlistId' => $playlist['id'])));
                        $result = array_merge($result, $this->_getVideos($playlistItemsResponse));
                    }
                } catch (Exception $e) {
                    throw new YoutubeVideoFetcherException($this->_id, $this->_type, $e->getMessage());
                }
                break;
        }

        if ($this->_type != self::TYPE_SINGLEVIDEO && isset($response) && empty($result)) {
            $result = $this->_getVideos($response);
        }

        return array_unique($result);
    }

    protected function _getVideos($response) {
        $result = array();
        foreach ($response['items'] as $item) {
            $result[] = $item['snippet']['resourceId']['videoId'];
        }

        return $result;
    }

    protected function _initYoutubeApi() {
        if ($this->_apiInitialized) {
            return;
        }

        $client = new Google_Client();
        $client->setApplicationName($this->_config->google['application_name']);
        $client->setDeveloperKey($this->_config->google['developer_key']);

        $this->_yt = new Google_Service_YouTube($client);
        $this->_apiInitialized = true;
    }

    public static function getVideo($id) {
        $out = array();

        if (is_array($id)) {
            $id = implode(',', $id);
        }

        $config = AppConfig::getInstance();

        $client = new Google_Client();
        $client->setApplicationName($config->google['application_name']);
        $client->setDeveloperKey($config->google['developer_key']);

        $yt = new Google_Service_YouTube($client);

        $result = $yt->videos->listVideos('status,snippet', array('id' => $id, 'maxResults' => 50));

        foreach ($result['items'] as $item) {
            array_push($out, $item);
        }

        return $out;
    }
}