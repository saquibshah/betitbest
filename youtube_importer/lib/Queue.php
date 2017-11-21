<?php
if (!defined('APPPATH')) {
    die('APPPATH not defined');
}

require_once APPPATH . 'lib/Debug.php';
require_once APPPATH . 'lib/AppConfig.php';
require_once APPPATH . 'lib/YoutubeVideoFetcher.php';

class Queue {
    protected $_dbh;
    protected $_type;

    public function __construct($type) {
        if ($type < YoutubeVideoFetcher::TYPE_MIN_VAL || $type > YoutubeVideoFetcher::TYPE_MAX_VAL) {
            throw new Exception('type not in range.');
        }

        $this->_type = $type;

        try {
            $config = AppConfig::getInstance();
            $this->_dbh = new PDO(sprintf("mysql:host=%s;port=%i;dbname=%s;charset=utf8", $config->db['host'],
                $config->db['port'],
                $config->db['database']), $config->db['username'], $config->db['password']);
        } catch (PDOException $e) {
            die("Connection failed: {$e->getMessage()}");
        }
    }

    public function process() {
        $channelObjects = $this->_getChannels();
        $results = array();

        foreach ($channelObjects as $channelObject) {
            $vf = new YoutubeVideoFetcher($channelObject->value, $this->_type);
            $videoIds = $vf->fetchVideos();

            foreach ($videoIds as $index => $videoId) {
                if ($this->_checkVideoExists($videoId, $channelObject->uid)) {
                    unset ($videoIds[$index]);
                }
            }

            $chunks = array_chunk($videoIds, 50);
            $videoInfos = array();
            foreach ($chunks as $chunk) {
                $videoInfos = array_merge($videoInfos, YoutubeVideoFetcher::getVideo($chunk));
            }

            $results[] = array('channel_uid' => $channelObject->uid, 'team_uid' => $channelObject->team_uid,
                'video_infos' => $videoInfos);
        }

        $this->_updateVideoItems($results);

        foreach ($channelObjects as $channelObject) {
            $this->_updateChannelLastUpdate($channelObject->uid);
        }
    }

    protected function _getChannels() {
        $config = AppConfig::getInstance();

        switch ($this->_type) {
            case YoutubeVideoFetcher::TYPE_PLAYLIST:
                $type = 'playlist';
                $limit = $config->queue['max_playlist_items'];
                break;

            case YoutubeVideoFetcher::TYPE_CHANNEL:
                $type = 'channel';
                $limit = $config->queue['max_channel_items'];
                break;

            case YoutubeVideoFetcher::TYPE_USER:
                $type = 'user';
                $limit = $config->queue['max_user_items'];
                break;

            case YoutubeVideoFetcher::TYPE_SINGLEVIDEO:
                $type = 'singlevideo';
                $limit = $config->queue['max_singlevideo_items'];
                break;
        }

        $query = "SELECT uid, team_uid, `value` FROM sportnews_videochannel WHERE `type` = ? AND disabled = FALSE "
            . "ORDER BY last_update ASC LIMIT ?;";

        $sth = $this->_dbh->prepare($query);
        $sth->bindValue(1, $type);
        $sth->bindValue(2, intval($limit), PDO::PARAM_INT);

        if (!$sth || !$sth->execute()) {
            throw new Exception('Channel-fetch from database failed: ' . implode(', ', $sth->errorInfo()));
        }

        return $sth->fetchAll(PDO::FETCH_OBJ);
    }

    protected function _checkVideoExists($videoId, $channelId) {
        $sth = $this->_dbh->prepare("SELECT COUNT(*) FROM sportnews_videoitems WHERE videoid = ? AND channel_uid = ?;");
        if (!$sth) {
            throw new Exception('Check video-item failed: ' . implode(', ', $this->_dbh->errorInfo()));
        }

        $sth->bindValue(1, $videoId);
        $sth->bindValue(2, intval($channelId), PDO::PARAM_INT);

        if (!$sth->execute()) {
            throw new Exception('Check video-item failed: ' . implode(', ', $sth->errorInfo()));
        }

        return $sth->fetchColumn() > 0;
    }

    protected function _updateVideoItems(array $videoItems) {
        $query = "INSERT INTO sportnews_videoitems(channel_uid, team_uid, videoid, title, `desc`, published, thumb, "
            . "blocked) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

        $sth = $this->_dbh->prepare($query);
        if (!$sth) {
            throw new Exception('Insert video-item failed: ' . implode(', ', $this->_dbh->errorInfo()));
        }

        $itemCount = 0;

        foreach ($videoItems as $item) {
            foreach ($item['video_infos'] as $info) {
                if ($info['status']['privacyStatus'] != 'public' || !$info['status']['embeddable']) {
                    $data = array($item['channel_uid'], null, $info['id'], null, null, null, null, 1);
                } else {
                    $data = array($item['channel_uid'], $item['team_uid'], $info['id'], $info['snippet']['title'],
                        $info['snippet']['description'], strtotime($info['snippet']['publishedAt']),
                        $info['snippet']['thumbnails']['high']['url'], 0);
                }

                if (!$sth->execute($data)) {
                    throw new Exception('Insert video-item failed: ' . implode(', ', $sth->errorInfo()));
                };

                $itemCount++;
            }
        }

        Debug::log('Queue', "Added {$itemCount} items to database.");
    }

    protected function _updateChannelLastUpdate($uid) {
        $sth = $this->_dbh->prepare("UPDATE sportnews_videochannel SET last_update = ? WHERE uid = ?;");

        if (!$sth) {
            throw new Exception('Update videochannel failed: ' . $this->_dbh->errorInfo()[0]);
        }

        if (!$sth->execute(array(time(), $uid))) {
            throw new Exception('Update videochannel failed: ' . $sth->errorInfo()[0]);
        }

        Debug::log('Queue', "Updated last-update of channel {$uid}.");
    }
}
