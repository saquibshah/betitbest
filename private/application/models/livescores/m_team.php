<?php

class M_team extends CI_Model{

    public function get_by_betradar_uid($id) {

        $dblang = $this->config->item('language_db');
        $lang = $dblang[$this->lang->lang()];

        $this->db->select('t.*, tn.name AS tnname, cat.name AS catname, sp.uid AS spuid, sp.name AS spname')
                ->select('IFNULL(lc1.`value`, t.`name`) as name', false)
                ->from('team as t')
                ->join('localization as lc1', "lc1.identifier = CONCAT('team_',t.uid,'_name') AND lc1.language_uid = " . $this->db->escape($lang), 'left')
                ->join('tournament_team AS tntm', 'tntm.team_uid = t.uid', 'left outer')
                ->join('tournament AS tn', 'tntm.tournament_uid = tn.uid', 'left outer')
                ->join('category AS cat', 'tn.category_uid = cat.uid', 'left outer')
                ->join('sport AS sp', 'cat.sport_uid = sp.uid', 'left outer')
                ->where('t.betradar_uid', $id)
                ->order_by('t.name');

        return $this->db->get()->row_array();
    }

    public function get_by_category($uid) {
        return $this->db->select('team.*')->from('team')
                        ->join('tournament_team', 'tournament_team.team_uid = team.uid')
                        ->join('tournament', 'tournament_team.tournament_uid = tournament.uid')
                        ->where('tournament.category_uid', $uid)
                        ->where('team.deleted', 0)
                        ->group_by('team.uid')
                        ->order_by('team.name')
                        ->get()->result_array();
    }

    public function get_by_id($id, $showDeleted = true) {
        $this->db->select('team.*, tn.name AS tnname, cat.uid AS catuid, cat.name AS catname, sp.uid AS spuid, sp.name AS spname')
                ->from('team')
                ->join('tournament_team AS tntm', 'tntm.team_uid = team.uid', 'left outer')
                ->join('tournament AS tn', 'tntm.tournament_uid = tn.uid', 'left outer')
                ->join('category AS cat', 'tn.category_uid = cat.uid', 'left outer')
                ->join('sport AS sp', 'cat.sport_uid = sp.uid', 'left outer')
                ->where('team.uid', $id);

        if (!$showDeleted) {
            $this->db->where('team.deleted', 0);
        }

        return $this->db->get()->row_array();
    }

    public function get_by_id_for_favs($id) {
        return $this->db->select('team.*,
            tn.uid AS tnuid,
            tn.name AS tournament_name,
            tn.uid AS tournament_uid,
            cat.uid as category_uid,
            cat.name AS category_name,
            sp.uid as sport_uid,
            sp.name AS sportname,
            sp.seourl as sport_seourl,
            cat.seourl AS category_seourl,
            tn.seourl AS tournament_seourl,
            untn.uid AS unique_tournament_uid,
            untn.seourl AS unique_tournament_seourl')
                        ->from('team')
                        ->join('tournament_team AS tntm', 'tntm.team_uid = team.uid', 'left outer')
                        ->join('tournament AS tn', 'tntm.tournament_uid = tn.uid', 'left outer')
                        ->join('unique_tournament AS untn', 'untn.uid = tn.unique_uid', 'left outer')
                        ->join('category AS cat', 'tn.category_uid = cat.uid', 'left outer')
                        ->join('sport AS sp', 'cat.sport_uid = sp.uid', 'left outer')
                        ->where('team.uid', $id)
                        ->get()->row();
    }

    public function get_by_tournament($uid, $type, $fields = "*") {
        $uid = intval($uid);
        $dblang = $this->config->item('language_db');
        $lang = $dblang[$this->lang->lang()];

        $whereString = "lt.season_uid = (";
        $whereString .= "SELECT s.uid FROM sportnews_season as s ";
        $whereString .= "JOIN sportnews_tournament as tn ON tn.uid = s.tournament_uid ";
        if ($type == 'tournament') {
            $whereString .= "WHERE tn.uid = " . $uid . " ";
        } else {
            $whereString .= "WHERE tn.unique_uid = " . $uid . " ";
        }
        $whereString .= "ORDER BY s.start DESC LIMIT 1)";

        $this->db->select('t.' . $fields);
        if ($fields == '*') {
            $this->db->select('IFNULL(lc1.`value`, t.`name`) as name', false);
        }
        $this->db->from('leaguetable as lt');
        $this->db->join('leaguetable_row as ltr', 'ltr.league_table_uid = lt.uid');
        $this->db->join('team as t', 't.uid = ltr.team_uid');
        $this->db->join('tournament_team as tntm', 'tntm.team_uid = t.uid');

        if ($type == 'tournament') {
            $this->db->join('tournament as trn', 'trn.uid = tntm.tournament_uid AND trn.uid = ' . $uid);
        } else {
            $this->db->join('tournament as trn', 'trn.uid = tntm.tournament_uid AND trn.unique_uid = ' . $uid);
        }
        $this->db->join(
                'localization as lc1', "lc1.identifier = CONCAT('team_',t.uid,'_name') AND lc1.language_uid = " . $this->db->escape($lang), 'left'
        );
        $this->db->where($whereString, null, false);
        $this->db->group_by('t.uid');
        if ($fields == '*') {
            $this->db->order_by('name');
        }


        $res = $this->db->get()->result_array();
        if (count($res) > 0) {
            return $res;
        }

        $whereString = "cb.cupround_uid = (";
        $whereString .= "SELECT cp.uid ";
        $whereString .= "FROM sportnews_tournament AS tn ";
        $whereString .= "JOIN sportnews_cup AS c ON c.tournament_uid = tn.uid ";
        $whereString .= "JOIN sportnews_cuptree AS ct ON ct.cup_uid = c.uid ";
        $whereString .= "JOIN sportnews_cupround AS cp ON cp.cuptree_uid = ct.uid AND cp.round = ct.current_round ";
        if ($type == 'tournament') {
            $whereString .= "WHERE tn.uid = " . $uid . " ";
        } else {
            $whereString .= "WHERE tn.unique_uid = " . $uid . " ";
        }
        $whereString .= "ORDER BY c.start DESC LIMIT 1";
        $whereString .= ")";
        $whereString .= ";";

        $this->db->select('t.' . $fields);
        $this->db->from('cupblock as cb');
        $this->db->join('cupblockparticipant as cp', 'cp.cupblock_uid = cb.uid');
        $this->db->join('team as t', 't.uid = cp.team_uid');
        $this->db->join('tournament_team as tntm', 'tntm.team_uid = t.uid');

        if ($type == 'tournament') {
            $this->db->join('tournament as trn', 'trn.uid = tntm.tournament_uid AND trn.uid = ' . $uid);
        } else {
            $this->db->join('tournament as trn', 'trn.uid = tntm.tournament_uid AND trn.unique_uid = ' . $uid);
        }

        $this->db->join(
                'localization as lc1', "lc1.identifier = CONCAT('team_',t.uid,'_name') AND lc1.language_uid = " . $this->db->escape($lang), 'left'
        );
        $this->db->where($whereString, null, false);
        $res = $this->db->get()->result_array();

        if (count($res) > 0) {
            return $res;
        }

        $this->db->select('team.' . $fields)
                ->from('team')
                ->join('tournament_team', 'tournament_team.team_uid = team.uid')
                ->where('team.deleted', 0)
                ->order_by('team.name', 'asc');

        if ($type == "tournament") {
            $this->db->where('tournament_team.tournament_uid', $uid);
        } else {
            $this->db->join('tournament', 'tournament.uid = tournament_team.tournament_uid')
                    ->join('unique_tournament', 'tournament.unique_uid = unique_tournament.uid')
                    ->where('unique_tournament.uid', $uid)
                    ->group_by('team.uid');
        }
        return $this->db->get()->result_array();
    }

    public function get_players($id) {
        $this->db->select('player.*')
                ->from('player')
                ->join('team_player_mm as mm', 'mm.player_uid = player.uid AND mm.team_uid =' . $id)
                ->where('player.role = "player"')
                ->order_by('player.shirt_number');

        $dbres = $this->db->get()->result_array();

        $result = array();
        $result['keeper'] = array();
        $result['defence'] = array();
        $result['midfield'] = array();
        $result['striker'] = array();
        $result['substitute'] = array();

        $result['all'] = array();

        foreach ($dbres as $i) {

            if ($i['birthday'] != "") {
                $arr = explode("-", $i['birthday']);
                $i['birthday'] = $arr[2] . '.' . $arr[1] . '.' . $arr[0];
            }

            $this->db->select('*')->from('playerstatistics')->where('player_id', $i['uid']);
            $array = $this->db->get()->result_array();

            $i['statistics'] = array();

            foreach ($array as $a) {
                $i['statistics'][$a['season_id']][$a['name']] = $a['value'];
            }

            $result['all'][] = $i;
            switch ($i['position']) {
                case 'D':
                    $result['defence'][] = $i;
                    break;
                case 'F':
                    $result['striker'][] = $i;
                    break;
                case 'G':
                    $result['keeper'][] = $i;
                    break;
                case 'M':
                    $result['midfield'][] = $i;
                    break;
                default:
                    $result['substitute'][] = $i;
                    break;
            }
        }

        return $result;
    }

    public function has_players($id) {
        $numRows = $this->db->select('p.uid')
                        ->from('player as p')
                        ->join('team_player_mm as mm', 'mm.player_uid = p.uid AND mm.team_uid =' . $id)
                        ->join('tournament_team as tntm', 'tntm.team_uid = mm.team_uid')
                        ->join('playerstatistics as ps', 'ps.player_id = p.uid')
                        ->join('season as s', 's.uid = ps.season_id')// add from/to
                        ->join('tournament as tn', 'tn.uid = s.tournament_uid AND tn.uid = tntm.tournament_uid')
                        ->join('category as cat', 'cat.uid = tn.category_uid')
                        ->get()->num_rows();

        return $numRows > 0;
    }

}
