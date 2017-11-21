<?php

function cacheVideos($uid, $type, $ttl = 600) {
    $CI =& get_instance();

    $identifier = 'videos_';

    switch ($type) {
        case 'team':
            $identifier .= 'team';
            $function = 'get_team_videos';
            $args = array($uid);
            break;

        case 'unique_tournament':
            $identifier .= 'unique_tournament';
            $function = 'get_tournament_videos';
            $args = array('unique_tournament', $uid);
            break;

        case 'tournament':
            $identifier .= 'tournament';
            $function = 'get_tournament_videos';
            $args = array('tournament', $uid);
            break;

        case 'category':
            $identifier .= 'category';
            $function = 'get_category_videos';
            $args = array($uid);
            break;

        case 'sport':
            $identifier .= 'sport';
            $function = 'get_sport_videos';
            $args = array($uid);
            break;

        default:
            return false;
    }

    $identifier .= "_{$uid}";

    $CI->load->library('Cache', 'cache');
    $result = $CI->cache->get($identifier);

    if ($result === false || $result === NULL) {
        $CI->load->model('video_model', 'video', true);
        $result = call_user_func_array(array($CI->video, $function), $args);
        $CI->cache->write($result, $identifier, $ttl);
    }
	

    return $result;
}