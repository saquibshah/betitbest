<?php

class Twitter_model extends CI_Model {
    const USER_AGENT = 'Bet IT Best Sportnachrichten';

    const MAX_TIMELINE_ITEMS = 50;

    public function updateTweets() {

        $this->db ->select('tw.uid, tw.feed_uid, tw.team_uid, sptm.sport_uid')
                  ->from('twitterfeeds as tw')
                  ->join('sport_team as sptm', 'sptm.team_uid = tw.team_uid')
                  ->where('tw.disabled', 0)
                  ->order_by('tw.last_update', 'asc')
                  ->limit(1);

        $row = $this->db->get()->row();

        if (empty($row)) {
            return;
        }

        $twitter_feed_uid = $row->uid;

        $screenname = $row->feed_uid;
        if (!($tweets = $this->getTweetsFrom($screenname, self::MAX_TIMELINE_ITEMS))) {
            $this->db->where('uid', $row->uid)->update('twitterfeeds', array(
                'disabled' => 1
            ));

            return;
        }

        $languages = $this->config->item('language_db');

        $data = array();
        foreach($tweets as $tweet) {
            if ($this->db->where('tweet_uid', $tweet->id_str)->count_all_results('post')) {
                continue;
            }

            $tmp = new stdClass();

            $tmp->feed_uid = 1;
            $tmp->team1_uid = $row->team_uid;
            $tmp->twitter_feed_uid = $twitter_feed_uid;
            $tmp->url = 'https://twitter.com/' . rawurlencode($tweet->user->screen_name) . '/status/' . $tweet->id_str;
            $tmp->title = $tweet->user->name . " @" . $tweet->user->screen_name;
            $tmp->teaser = $tweet->text;
            $tmp->retweet_count = $tweet->retweet_count;
            $tmp->favorite_count = $tweet->favorite_count;
            $tmp->tweet_uid = $tweet->id_str;
            $tmp->posted_on = strtotime($tweet->created_at);
            $tmp->posted_on_negate = -$tmp->posted_on;
            $tmp->crawled_on = time();
            $tmp->sport_uid = $row->sport_uid;
            $tmp->recategorize = 1;

            if (!isset($languages[$tweet->lang])) {
              $tmp->language = 2;
            } else {
              $tmp->language = $languages[$tweet->lang];
            }

            $tmp->media_url = '';
            if (!empty($tweet->extended_entities) && !empty($tweet->extended_entities->media)) {
                $tmp->media_url = $tweet->extended_entities->media[0]->media_url_https;
            }


            if (!empty($tweet->entities) && !empty($tweet->entities->urls)) {
              foreach($tweet->entities->urls as $url) {
                $tmp->teaser = str_replace($url->url, '<a href="'.$url->url.'" class="red" target="_blank">'.$url->display_url.'</a>', $tmp->teaser);
              }
            }


            $data[] = (array)$tmp;
        }

        if (!empty($data)) {
            $this->db->insert_batch('post', $data);
        }

        $this->db->where('uid', $row->uid)->update('twitterfeeds', array(
            'last_update' => time()
        ));
    }

    /**
     * @param string|int $user
     * @param int $limit
     *
     * @return bool|object
     *
     * Generic function to retrieve tweets
     * Will be called from other functions in this class
     *
     * @see getTweetsFromUser()
     * @see getTweetsFromUserWithId()
     */
    protected function getTweetsFrom($user, $limit) {
        if (!$this->config->load('application', true, true)) {
            return array();
        }

        if (!$this->config->item('twitter_consumer_key', 'application')
            || !($this->config->item('twitter_consumer_secret', 'application'))) {
            return array();
        }

        $connection = new Abraham\TwitterOAuth\TwitterOAuth($this->config->item('twitter_consumer_key', 'application'),
            $this->config->item('twitter_consumer_secret', 'application'));

        $connection->setUserAgent(self::USER_AGENT);

        $response = $connection->get('statuses/user_timeline', array(
            'screen_name' => $user,
            'exclude_replies' => 'true',
            'count' => $limit
        ));

        return $connection->getLastHttpCode() == 200 ? $response : false;
    }

    protected function clearUtf($string) {
        setlocale(LC_ALL, 'de_DE.UTF8');
        $r = iconv('UTF-8', 'UTF-8//IGNORE', $string);
        /*
        for ($i = 0; $i < strlen($s1); $i++) {
            $ch1 = $s1[$i];
            $r .= $ch1 == '?' ? '' : $ch1;
        }
        */

        return $r;
    }
}
