<?php

class M_tournament extends CI_Model {

    public function __construct() {
        $this->load->model('livescores/m_team', 'team');
    }
    
    public function get_by_category($uid) {
        $dblang = $this->config->item('language_db');
        $lang = $dblang[$this->lang->lang()];

        $this->db->_protect_identifiers = false;

        $this->db->select('`trn`.*');
        $this->db->select('IF(`trn`.`unique_uid` > 0, untn.`seourl`, `trn`.`seourl`) AS `seourl`');
        $this->db->select('IF(`trn`.`unique_uid` > 0, IFNULL(`lc2`.`value`, untn.`name`), IFNULL(`lc1`.`value`, `trn`.`name`)) AS `name`');
        $this->db->select('IF(`trn`.`unique_uid` > 0, "unique_tournament", "tournament") AS `tntype`');

        $this->db->from('tournament AS `trn`');

        $this->db->join('unique_tournament as untn', 'untn.`uid` = `trn`.`unique_uid`', 'left');
        $this->db->join('localization as lc1', "lc1.`identifier` = CONCAT('tournament_',`trn`.`uid`,'_name') AND `lc1`.`language_uid` = {$this->db->escape($lang)}", 'left');
        $this->db->join('localization as lc2', "lc2.`identifier` = CONCAT('unique_tournament_',`trn`.`unique_uid`,'_name') AND `lc2`.`language_uid` = {$this->db->escape($lang)}", 'left');

        if (is_array($uid)) {
            $catid = ' IN (' . implode(",", $uid) . ') ';  // $this->db->where_in('`trn`.`category_uid`', $uid);
        } else {
            $catid = ' = ' . $uid . ' '; // $this->db->where('`trn`.`category_uid`', $uid);
        }

        $where = "`trn`.`category_uid` " . $catid . " AND (";
        $where .= " (`trn`.`start` = 0 AND `trn`.`end` = 0) OR ";
        $where .= " (`trn`.`start` BETWEEN UNIX_TIMESTAMP() - 259200 AND UNIX_TIMESTAMP() + 259200) OR ";
        $where .= " (`trn`.`end` BETWEEN UNIX_TIMESTAMP() - 259200 AND UNIX_TIMESTAMP() + 259200) OR ";
        $where .= " (`trn`.`start` < UNIX_TIMESTAMP() AND `trn`.`end` > UNIX_TIMESTAMP()) ";
        $where .= ")";

        $this->db->where($where, null, false);
        $this->db->group_by('CASE WHEN (`trn`.`unique_uid` = 0 OR `trn`.`unique_uid` = NULL) THEN UUID() ELSE `trn`.`unique_uid` END');

        $this->db->order_by("`trn`.`name`");

        $qry = $this->db->get();
        $this->db->_protect_identifiers = true;

        return $qry->result_array();
    }

    public function get_by_team($uid, $main_tn = 0, $main_untn = 0) {

        if (!$row = $this->cache->get('get_tournaments_by_team_' . $uid . '_' . $main_tn . '_' . $main_untn)) {

            $dblang = $this->config->item('language_db');
            $lang = $dblang[$this->lang->lang()];

            $this->db->select('tournament.*')
                    ->from('tournament')
                    ->join('tournament_team', 'tournament_team.tournament_uid = tournament.uid')
                    ->join('category as category', 'category.uid = tournament.category_uid')
                    ->join('sport as sport', 'sport.uid = category.sport_uid');
            if ($main_untn > 0) {
                $this->db->where('tournament.unique_uid', $main_untn);
            } else if ($main_tn > 0) {
                $this->db->where('tournament.uid', $main_tn);
            }

            $this->db->where('tournament_team.team_uid', $uid);

            $rows = $this->db->get()->result_array();

            for ($i = 0; $i < count($rows);  ++$i) {
                $teams = $this->team->get_by_tournament($rows[$i]['uid'], 'tournament', 'uid');
                $del = true;
                foreach ($teams as $t) {
                    if ($t['uid'] == $uid) {
                        $del = false;
                        break;
                    }
                }
                if ($del) {
                    unset($rows[$i]);
                }
            }

            if (count($rows) === 0) {
                $this->db->select('tournament.*')
                        ->from('tournament')
                        ->join('tournament_team', 'tournament_team.tournament_uid = tournament.uid')
                        ->join('category as category', 'category.uid = tournament.category_uid')
                        ->join('sport as sport', 'sport.uid = category.sport_uid');
                $this->db->where('tournament_team.team_uid', $uid);

                $rows = $this->db->get()->result_array();

                for ($i = 0; $i < count($rows);  ++$i) {
                    $teams = $this->team->get_by_tournament($rows[$i]['uid'], 'tournament', 'uid');
                    $del = true;
                    foreach ($teams as $t) {
                        if ($t['uid'] == $uid) {
                            $del = false;
                            break;
                        }
                    }
                    if ($del) {
                        unset($rows[$i]);
                    }
                }
            }

            if ($row = reset($rows)) {
                if ($row['unique_uid'] != 0) {
                    $this->db->select('unique_tournament.*')->from('unique_tournament')->where('unique_tournament.uid', $row['unique_uid']);
                    $row = $this->db->get()->row_array();
                    $row['tntype'] = 'unique_tournament';
                } else {
                    $row['tntype'] = 'tournament';
                }
            } else {
                $row = false;
            }


            $this->cache->write($row, 'get_tournaments_by_team_' . $uid . '_' . $main_tn . '_' . $main_untn, 3600);
        }

        return $row;
    }

    public function get_by_url($catuid, $url) {

        $this->db->select('*')->from('tournament')->where('category_uid', $catuid)->where('seourl', $url)->order_by('start', 'DESC');
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $arr = $result->row_array();
            $arr['tntype'] = 'tournament';
            return $arr;
        } else {
            $this->db->select('*')->from('unique_tournament')->where('category_uid', $catuid)->where('seourl', $url)->order_by('uid', 'DESC');
            $result = $this->db->get();
            if ($result->num_rows() > 0) {
                $arr = $result->row_array();
                $arr['tntype'] = 'unique_tournament';
                return $arr;
            } else {
                return false;
            }
        }
    }
    /*
    public function get_db_videos($tntype, $tnuid) {

        if ($tntype == 'tournament') {
            $this->db->select('*')
                    ->from('videoitems')
                    ->join('tournament_team', 'tournament_team.team_uid = videoitems.team_uid')
                    ->where('tournament_team.tournament_uid', $tnuid)->order_by('videoitems.published', 'desc')
                    ->group_by('videoitems.uid')->limit(15);
        } else {
            $this->db->select('*')
                    ->from('videoitems')
                    ->join('tournament_team', 'tournament_team.team_uid = videoitems.team_uid')
                    ->join('tournament', 'tournament_team.tournament_uid = tournament.uid')
                    ->where('tournament.unique_uid', $tnuid)->order_by('videoitems.published', 'desc')
                    ->group_by('videoitems.uid')->limit(15);
        }
        return $this->db->get()->result_array();
    }
    */
    public function get_dropdown() {
        $tn = $this->db->select('tn.*, untn.name as uniquename, untn.uid uniqueuid, cat.name as catname, sp.name as sportname')
                        ->from('tournament AS tn')
                        ->join('unique_tournament AS untn', 'untn.uid = tn.unique_uid', 'left outer')
                        ->join('category as cat', 'tn.category_uid = cat.uid')
                        ->join('sport as sp', 'cat.sport_uid = sp.uid')
                        ->order_by('tn.name')->get()->result_array();

        $res = array(
            0 => "Turnier wählen"
        );

        $lastUnique = 0;
        foreach ($tn as $t) {
            if (intval($t['uniqueuid']) > 0) {
                $t['uid'] = "unq-" . $t['uniqueuid'];
                $t['name'] = $t['uniquename'];
            }

            if ($lastUnique <= 0 || intval($t['uniqueuid']) != $lastUnique) {
                $res[$t['uid']] = $t['name'] . ' (' . $t['sportname'] . ' -> ' . $t['catname'] . ')';
            }

            $lastUnique = intval($t['uniqueuid']);
        }

        return $res;
    }

    public function get_seasontable($uid) {

        $dblang = $this->config->item('language_db');
        $lang = $dblang[$this->lang->lang()];

        $this->db->select('leaguetable_row.*, team.uid as teamuid, team.betradar_uid as teambetradaruid, team.name as teamname, team.seourl as teamseourl')
                ->select('IFNULL(lc1.`value`, leaguetable.`name`) as tournamentname', false)
                ->from('leaguetable_row')
                ->join('leaguetable', 'leaguetable.uid = leaguetable_row.league_table_uid')
                ->join('season as s', 'leaguetable.season_uid = s.uid')
                ->join('localization as lc1', "lc1.identifier = CONCAT('tournament_', s.tournament_uid, '_name') AND lc1.language_uid = "
                        . $this->db->escape($lang) . "", 'left')
                ->join('team', 'leaguetable_row.team_uid = team.uid')
                ->where('s.tournament_uid', $uid)
                ->where('s.start <', time())
                ->where('type', 'normal')
                ->order_by('s.start desc, s.tournament_uid, leaguetable.round, leaguetable.name asc, leaguetable_row.sortPositionTotal asc');

        return $this->db->get()->result_array();
    }

    public function get_seasontable_by_unique($uid) {

        $dblang = $this->config->item('language_db');
        $lang = $dblang[$this->lang->lang()];

        $this->db->select('leaguetable_row.*, team.uid as teamuid, team.betradar_uid as teambetradaruid, team.name as teamname, team.seourl as teamseourl, season.start as seasonstart, season.end as seasonend, t.uid as tournamentuid, t.unique_uid')
                ->select('IFNULL(lc1.`value`, leaguetable.`name`) as tournamentname', false)
                ->from('leaguetable_row')
                ->join('leaguetable', 'leaguetable.uid = leaguetable_row.league_table_uid')
                ->join('season', 'leaguetable.season_uid = season.uid')
                ->join('team', 'leaguetable_row.team_uid = team.uid')
                ->join('tournament as t', 'season.tournament_uid = t.uid')
                ->join('localization as lc1', "lc1.identifier = CONCAT('unique_tournament_', t.unique_uid, '_name') AND lc1.language_uid = "
                        . $this->db->escape($lang) . "", 'left')
                ->where('season.start <', (time() + 2419200))
                ->where('season.end >', (time() - 2419200))
                ->where('t.unique_uid = ' . $uid)
                ->where('type', 'normal')
                ->order_by('leaguetable.name asc, leaguetable_row.league_table_uid, season.tournament_uid asc, leaguetable_row.sortPositionTotal asc');

        return $this->db->get()->result_array();
    }

    public function get_single($uid, $type = false, $only_visible = false) {
        if (!$type) {
            $this->db->select('tournament.*, sport.name as sportname, sport.uid as sport_uid, category.name as catname, category.uid as category_uid, unique_tournament.name as untn_name, unique_tournament.uid as untn_uid, sport.seourl as sport_seourl, category.seourl as category_seourl')
                    ->from('tournament')
                    ->join('category', 'category.uid = tournament.category_uid')
                    ->join('sport', 'sport.uid = category.sport_uid')
                    ->join('unique_tournament', 'unique_tournament.uid = tournament.unique_uid', 'left outer')
                    ->where('tournament.uid', $uid);

            if ($result = $this->db->get()->row()) {
                $result->tntype = 'tournament';
            }
        } else {
            $this->db->select('untn.*, sport.name as sportname, sport.uid as sport_uid, category.name as catname, category.uid as category_uid, sport.seourl as sport_seourl, category.seourl as category_seourl')
                    ->from('unique_tournament as untn')
                    ->join('category', 'category.uid = untn.category_uid')
                    ->join('sport', 'sport.uid = category.sport_uid')
                    ->where('untn.uid', $uid);

            if ($result = $this->db->get()->row()) {
                $result->tntype = 'unique_tournament';
            }
        }

        return $result;
    }

    public function get_tennis_tournaments($arr) {

        $dblang = $this->config->item('language_db');
        $lang = $dblang[$this->lang->lang()];

        $this->db->select('cat.name as catname, trn.*');
        $this->db->from('tournament as trn');
        $this->db->select('IFNULL(lc1.`value`, trn.`name`) as name', false);
        $this->db->join('localization as lc1', "lc1.identifier = CONCAT('tournament_', trn.uid, '_name') AND lc1.language_uid = "
                . $this->db->escape($lang) . "", 'left');
        $this->db->join('category as cat', 'cat.uid = trn.category_uid');
        $this->db->where('trn.end >', time());

        if (isset($arr[3]) && strlen($arr[3]) > 0) {
            switch ($arr[3]) {
                case 'atp':
                    $this->db->where('cat.uid', 158);
                    break;
                case 'wta':
                    $this->db->where('cat.uid', 165);
                    break;
            }
        }
        if (isset($arr[4]) && intval($arr[4], 10) > 0) {
            $this->db->limit(20, intval($arr[4]));
        } else {
            $this->db->limit(20);
        }

        $this->db->where('cat.sport_uid', 8);
        $this->db->order_by('trn.start', 'asc');

        return $this->db->get()->result();
    }

    public function get_unique($uid) {
        $this->db->select('unique_uid')->from('tournament')->where('uid', $uid);
        $qry = $this->db->get()->result();
        return $qry[0]->unique_uid;
    }

    public function get_unique_header($uid) {
        $this->db->select('header_image')->from('unique_tournament')->where('uid', $uid);
        $row = $this->db->get()->result();
        return $row[0]->header_image;
    }

    public function is_unique_hidden($uid) {
        return false;
    }

}
