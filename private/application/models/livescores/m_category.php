<?php

class M_category extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    public function get_by_sport($uid, $withoutHidden = false) {
        $this->db->select('category.*, sport.uid as sportuid, sport.seourl as sporturl')->from('category')
                ->join('sport', 'sport.uid = category.sport_uid')->where('sport_uid', $uid);

        $this->db->order_by('category.name');
        return $this->db->get()->result_array();
    }
    public function get_by_url($sport, $url) {
        $this->db->select('*')
                ->from('category')
                ->where('seourl LIKE', $url)
                ->where('sport_uid =', $sport);
        return $this->db->get()->row_array();
    }
    /*
    public function get_db_videos($uid) {
        $this->db->select('*')
                ->from('videoitems')
                ->join('category_team', 'category_team.team_uid = videoitems.team_uid')
                ->where('category_team.category_uid', $uid)->order_by('videoitems.published', 'desc')
                ->group_by('videoitems.uid')->limit(15);

        return $this->db->get()->result_array();
    }
    */
    public function get_single($uid, $teamcat = 0, $showHidden = true) {
        $this->db->select('category.*, sport.name as sportname, sport.uid as sport_uid, sport.seourl as sport_seourl')
                ->from('category')
                ->join('sport', 'sport.uid = category.sport_uid');

        if ($teamcat > 0) {
            $this->db->where('category.uid', $teamcat);
        } else {
            $this->db->where('category.uid', $uid);
        }

        $row = $this->db->get()->row_array();

        if (!$row && $teamcat != 0) {

            $this->db->select('category.*, sport.name as sportname, sport.uid as sport_uid, sport.seourl as sport_seourl')
                    ->from('category')
                    ->join('sport', 'sport.uid = category.sport_uid');

            $this->db->where('category.uid', $uid);

            $row = $this->db->get()->row_array();
        }

        return $row;
    }
    public function get_single_tennis($teamuid) {
        $row = $this->db->select('category.seourl')->from('category')
        ->join('category_team as ct', 'ct.category_uid = category.uid AND ct.team_uid = ' . $teamuid)
        ->get()->row();
        return $row;
    }
}
