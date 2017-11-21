<?php

class Video_model extends CI_Model {
    
    public function get_favourite_videos($favs) {

        function cmp($a, $b) {
            if ($a['published'] == $b['published']) {
                return 0;
            }
            return $b['published'] - $a['published'];
        }

        $videos = array();

        foreach ($favs as $key => $val) {
            switch ($key) {
                case 'team':
                    foreach ($val as $v) {
                        $to_add = $this->get_team_videos($v);
                        foreach ($to_add as $el) {
                            array_push($videos, $el);
                        }
                    }
                    break;
                case 'uniquetournament':
                    $type = 'unique';
                    foreach ($val as $v) {
                        $to_add = $this->get_tournament_videos($type, $v);
                        foreach ($to_add as $el) {
                            array_push($videos, $el);
                        }
                    }
                    break;
                case 'tournament':
                    $type = 'tournament';
                    foreach ($val as $v) {
                        $to_add = $this->get_tournament_videos($type, $v);
                        foreach ($to_add as $el) {
                            array_push($videos, $el);
                        }
                    }
                    break;
                case 'cat':
                    foreach ($val as $v) {
                        $to_add = $this->get_category_videos($v);
                        foreach ($to_add as $el) {
                            array_push($videos, $el);
                        }
                    }
                    break;
            }
        }



        if (count($videos) > 1) {
            usort($videos, "cmp");
        }

        $videos_found = array();
        $videos = array_filter($videos, function($video) use( &$videos_found) {

            if (in_array($video['uid'], $videos_found)) {
                return false;
            }

            $videos_found[] = $video['uid'];
            return true;
        });

        $videos = array_values($videos);

        if (count($videos) > 20) {
            $videos = array_slice($videos, 0, 20);
        }

        return $videos;
    }
    
    public function get_team_videos($uid, $offset = 0) {
        $this->db->select('videoitems.*')
            ->from('videoitems')
            ->where('team_uid', $uid)
            ->order_by('published', 'desc')
            ->group_by('videoid')
            ->limit(20, $offset);
        return $this->db->get()->result_array();
    }

    public function get_tournament_videos($tntype, $uid, $offset = 0) {

        if ($tntype != 'tournament') {
            $this->db->select('uid')->from('tournament')->where('unique_uid', $uid);
            $uid = array();
            $res = $this->db->get()->result();
            foreach ($res as $r) {
                array_push($uid, $r->uid);
            }
        }

        $this->db->select('videoitems.*')
            ->from('videoitems')
            ->join('tournament_team', 'tournament_team.team_uid = videoitems.team_uid');

        if (is_array($uid)) {
            $this->db->where_in('tournament_team.tournament_uid', $uid);
        } else {
            $this->db->where('tournament_team.tournament_uid', $uid);
        }

        $this->db->group_by('videoitems.videoid')
            ->order_by('published', 'desc')
            ->limit(20, $offset);

        return $this->db->get()->result_array();
    }

    public function get_category_videos($uid, $offset = 0) {
        $this->db->select('videoitems.*')
            ->from('videoitems')
            ->join('category_team', 'category_team.team_uid = videoitems.team_uid')
            ->where('category_team.category_uid', $uid)
            ->group_by('videoitems.videoid')
            ->order_by('published', 'desc')
            ->limit(20, $offset);
        return $this->db->get()->result_array();
    }

    public function get_sport_videos($uid, $offset = 0) {
        $this->db->select('videoitems.*')
            ->from('videoitems')
            ->join('sport_team', 'sport_team.team_uid = videoitems.team_uid')
            ->where('sport_team.sport_uid', $uid)
            ->group_by('videoitems.videoid')
            ->order_by('published', 'desc')
            ->limit(20, $offset);
        return $this->db->get()->result_array();
    }

}
