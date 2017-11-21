<?php

class M_sport extends CI_Model{

    public function get_by_url($url) {
        $this->db->select('*')
                ->from('sport')
                ->where('seourl LIKE', $url);
        return $this->db->get()->row_array();
    }

    public function get_categories($uid) {
        $this->db->select('*')->from('category')->where('sport_uid', $uid)->order_by('name', 'asc');
        return $this->db->get()->result_array();
    }
    /*
    public function get_db_videos($uid) {
        $this->db->select('*')
                ->from('videoitems')
                ->join('sport_team', 'sport_team.team_uid = videoitems.team_uid')
                ->where('sport_team.sport_uid', $uid)->order_by('videoitems.published', 'desc')->group_by('videoitems.uid')
                ->limit(15);

        return $this->db->get()->result_array();
    }
    */
    public function get_single($id, $showHidden = true) {
        $this->db->select('sport.*')
                ->from('sport')
                ->where('uid', $id);

        if (!$showHidden) {
            $this->db->where('sport.hidden', 0);
        }

        return $this->db->get()->row_array();
    }

    public function get_sports($withoutHidden = false) {

        $this->db->select('sport.*, count(km.uid) as count')
                ->from('sport')
                ->join('keyword_matching AS km', 'km.sport_uid=sport.uid AND (km.category_uid=0 OR km.category_uid IS NULL) AND (km.tournament_uid = 0 OR km.tournament_uid IS NULL) AND (km.unique_tournament_uid = 0 OR km.unique_tournament_uid IS NULL) AND (km.team_uid = 0 OR km.team_uid IS NULL) ', 'left outer')
                ->group_by('sport.uid')
                ->order_by('sport.sorting');

        if ($withoutHidden) {
            $this->db->where('sport.hidden = 0');
        }

        $dataReturn = array();
        $result = $this->db->get()->result_array();
        
        $now = time();
        $next3Days = strtotime('+3 day');
        
        $arrData = array(
            1 => 'sportnews_livescores_basketball',
            2 => 'sportnews_livescores_handball',
            3 => 'sportnews_livescores_ice_hockey',
            6 => 'sportnews_livescores_football',
            7 => 'sportnews_livescores_soccer',
            8 => 'sportnews_livescores_tennis',
            9 => 'sportnews_livescores_volleyball',
            4 => 'sportnews_livescores_rugby'
        );
        
        foreach ($result as $row) {
            $row['matchcount'] = 0;
            if (isset($arrData[$row['uid']])) {
                $r = $this->db->query("SELECT COUNT(*) AS total FROM {$arrData[$row['uid']]} WHERE (matchdate >= '{$now}' AND matchdate <= '{$next3Days}') LIMIT 0,1")->result_array();
                if (!empty($r)) {
                    $row['matchcount'] = intval($r[0]['total']);
                }
            }
            $dataReturn[] = $row;
        }
        return $dataReturn;
    }
}
