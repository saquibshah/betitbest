<?php

class Instagram_model extends CI_Model {
    const USER_AGENT = 'Bet IT Best Sportnachrichten';

    const MAX_TIMELINE_ITEMS = 50;

    public function updateInstaFeeds() {

        $this->db ->select('ig.uid, ig.feed_uid, ig.team_uid, sptm.sport_uid')
                  ->from('instagramfeeds as ig')
                  ->join('sport_team as sptm', 'sptm.team_uid = ig.team_uid')
                  ->where('ig.disabled', 0)
                  ->order_by('ig.last_update', 'asc')
                  ->limit(1);

        $row = $this->db->get()->row();

        if (empty($row)) {
            return;
        }

        $instagram_feed_uid = $row->uid;

        $screenname = $row->feed_uid;

        $languages = $this->config->item('language_db');

        $data = array();
        foreach($feeds as $feed) {
            if ($this->db->where('tweet_uid', $feed->id_str)->count_all_results('post')) {
                continue;
            }

            $tmp = new stdClass();

            $tmp->feed_uid = 2;
            $tmp->team1_uid = $row->team_uid;
            $tmp->url = $feed->url;
            $tmp->title = $feed->title;
            $tmp->teaser = $feed->text;
            $tmp->tweet_uid = $feed->id_str;
            $tmp->posted_on = strtotime($feed->created_at);
            $tmp->posted_on_negate = -$tmp->posted_on;
            $tmp->crawled_on = time();
            $tmp->sport_uid = $row->sport_uid;
            $tmp->recategorize = 1;

            if (!isset($languages[$feed->lang])) {
              $tmp->language = 2;
            } else {
              $tmp->language = $languages[$feed->lang];
            }

            $tmp->media_url = '';
            if (!empty($feed->extended_entities) && !empty($feed->extended_entities->media)) {
                $tmp->media_url = $feed->extended_entities->media[0]->media_url_https;
            }


            if (!empty($feed->entities) && !empty($feed->entities->urls)) {
              foreach($feed->entities->urls as $url) {
                $tmp->teaser = str_replace($url->url, '<a href="'.$url->url.'" class="red" target="_blank">'.$url->display_url.'</a>', $tmp->teaser);
              }
            }


            $data[] = (array)$tmp;
        }

        if (!empty($data)) {
            $this->db->insert_batch('post', $data);
        }

        $this->db->where('uid', $row->uid)->update('instagramfeeds', array(
            'last_update' => time()
        ));
    }

    protected function clearUtf($string) {
        setlocale(LC_ALL, 'de_DE.UTF8');
        $r = iconv('UTF-8', 'UTF-8//IGNORE', $string);
        return $r;
    }
}
