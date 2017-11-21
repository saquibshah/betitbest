<?php

/**
 * Class Match_model
 * @property MY_Lang $lang
 */
class Match_model extends CI_Model {
    public function get($limit = 20, $offset = 0, $sport = false, $category = false, $tournament = false, $team = false) {

        $nested  = " SELECT `match`.* ";
        $nested .= " FROM `sportnews_match` as `match` ";

        $dblang = $this->config->item('language_db');
        $lang = $dblang[$this->lang->lang()];


        if ($team) {
          $nested .= " JOIN `sportnews_match_team` as `mttm` ON `mttm`.`match_uid` = `match`.`uid` AND `mttm`.`team_uid`= " . $team ;
        } elseif ($tournament) {
            $tnuid = $tournament['uid'];

            if ($tournament['tntype'] == 'unique_tournament') {
              $nested .= " JOIN `sportnews_match_team` as `mttm` ON `mttm`.`match_uid` = `match`.`uid` AND `mttm`.`type`= 1" ;
              $nested .= " JOIN `sportnews_tournament_team` as `tntm` ON `tntm`.`team_uid` = `mttm`.`team_uid`";
              $nested .= " JOIN `sportnews_tournament` as `tm` ON `tm`.`uid` = `tntm`.`tournament_uid` AND `tm`.`unique_uid` = " . $tnuid;
            } else {
              $nested .= " JOIN `sportnews_match_team` as `mttm` ON `mttm`.`match_uid` = `match`.`uid` AND `mttm`.`type`= 1" ;
              $nested .= " JOIN `sportnews_tournament_team` as `tntm` ON `tntm`.`team_uid` = `mttm`.`team_uid` AND `tntm`.`tournament_uid` = " . $tnuid;
            }
        } elseif ($category) {
          $nested .= " JOIN `sportnews_match_team` as `mttm` ON `mttm`.`match_uid` = `match`.`uid` AND (`mttm`.`type`= 1 OR `mttm`.`type`= 2)" ;
          $nested .= " JOIN `sportnews_tournament_team` as `tntm` ON `tntm`.`team_uid` = `mttm`.`team_uid`";
          $nested .= " JOIN `sportnews_tournament` as `tm` ON `tm`.`uid` = `tntm`.`tournament_uid` AND `tm`.`category_uid` = " . $category;
          //$nested .= " JOIN `sportnews_category_team` as `cattm` ON `cattm`.`team_uid` = `mttm`.`team_uid` AND `cattm`.`category_uid` = " . $category;
        } elseif ($sport) {
            $nested .= " JOIN `sportnews_match_team` as `mttm` ON `mttm`.`match_uid` = `match`.`uid` AND `mttm`.`type`= 1" ;
            $nested .= " JOIN `sportnews_sport_team` as `sptm` ON `sptm`.`team_uid` = `mttm`.`team_uid` AND `sptm`.`sport_uid` = " . $sport;
        }


        $nested .= " WHERE `match`.`date` > " . (time() - 86400);

        $this->db->from('('.$nested.') as m');

        $this->db->select('m.*,
            t1.name as team1_name,
            t1.uid as team1_uid,
            t1.seourl as team1_seourl,
            t2.name as team2_name,
            t2.uid as team2_uid,
            t2.seourl as team2_seourl,
            t1.betradar_uid as team1_betradar,
            t2.betradar_uid as team2_betradar,
            m.betradar_score1 as team1_score,
            m.betradar_score2 as team2_score,
            m.betradar_uid as match_betradar,
            untn.seourl as uniquetournamenturl,
            cat.seourl as catseourl,
            sport.seourl as sportseourl')
            ->select('IFNULL(tennistn.seourl, tn.seourl) as tournamenturl', false)
            //->select('IFNULL(lcx.`value`, IFNULL(lc1.`value`, tn.`name`)) as tournamentname', false)
            ->select('IFNULL(lc1.`value`, IFNULL(tennistn.name, tn.`name`)) as tournamentname', false)
            //->select('IFNULL(lc1.`value`, tn.`name`) as tournamentname', false)
            ->select('IFNULL(lc2.`value`, untn.`name`) as uniquetournamentname', false)
            ->join('match_team as mt1', 'mt1.match_uid = m.`uid` AND mt1.`type` = 1')
            ->join('match_team as mt2', 'mt2.match_uid = m.`uid` AND mt2.`type` = 2')
            ->join('team as t1', 'mt1.team_uid = t1.`uid` ')
            ->join('team as t2', 'mt2.team_uid = t2.`uid` ')

            ->join('season as s', 's.uid = m.season_uid', 'left')

            ->join('tournament as tennistn', 'm.tournament_uid = tennistn.uid', 'left')

            ->join('tournament as tn', ' tn.uid = tn.uid AND s.uid IS NOT NULL AND s.tournament_uid = tn.uid ')
            ->join('localization as lc1', "lc1.identifier = CONCAT('tournament_',tn.uid,'_name') AND lc1.language_uid = " . $this->db->escape($lang) . "", 'left')
            ->join('unique_tournament as untn', 'tn.unique_uid = untn.uid', 'left')
            ->join('localization as lc2', "lc2.identifier = CONCAT('unique_tournament_',untn.uid,'_name') AND lc2.language_uid = " . $this->db->escape($lang) . "", 'left')

            ->join('category as cat', 'tn.category_uid = cat.uid')
            ->join('sport', 'cat.sport_uid = sport.uid')

            ->group_by('m.uid')

            ->where('sport.hidden', 0)
            ->where('cat.hidden', 0)
            ->where('tn.hidden', 0)
            ->where('t1.deleted', 0)
            ->where('t2.deleted', 0);


        if($tournament) {
            $tnuid = $tournament['uid'];

            if ($tournament['tntype'] == 'unique_tournament') {
              $this->db->where('tn.unique_uid', $tnuid);
            } else {
              $this->db->where('tn.uid', $tnuid);
            }

        } elseif ($category) {
            $this->db->where('cat.uid', $category);
        } elseif ($sport) {
            $this->db->where('cat.sport_uid', $sport);
        }

        $_result = $this->db->order_by('m.date ASC, m.uid ASC')->limit($limit, $offset)->get()->result_array();

        return $_result;
    }

    public function get_roundup($teamuid, $offset = 0, $limit = 10) {

        $dblang = $this->config->item('language_db');
        $lang = $dblang[$this->lang->lang()];

        $this->db->select(' match.uid,
                          match.date,
                          match.status,
                          mt2.team_uid as team2,
                          mt2.type as team2_type,
                          t.betradar_uid as team2_betradar_uid,
                          t.seourl,
                          match.betradar_uid as match_betradar
      ');

        $this->db->select('IF(mt2.type = "2", match.betradar_score1, match.betradar_score2) as team1_score', false);
        $this->db->select('IF(mt2.type = "2", match.betradar_score2, match.betradar_score1) as team2_score', false);
        $this->db->select('IFNULL(lc1.`value`, t.`name`) as team2_name', false);
        $this->db->from('match');
        $this->db->join('match_team as mt', 'mt.match_uid = match.uid AND mt.team_uid = ' . $teamuid);
        $this->db->join('match_team as mt2', 'mt2.match_uid = mt.match_uid AND mt2.team_uid != ' . $teamuid);
        $this->db->join('team as t', "t.uid = mt2.team_uid");
        $this->db->join('localization as lc1',
            "lc1.identifier = CONCAT('team_',t.uid,'_name') AND lc1.language_uid = " . $this->db->escape($lang) . "",
            'left');

        $this->db->where('match.date <', time());
        $this->db->where('match.betradar_score1 IS NOT NULL');
        $this->db->where('match.betradar_score2 IS NOT NULL');
        $this->db->limit($limit);
        $this->db->offset($offset);
        $this->db->order_by('match.date desc');

        $res = $this->db->get()->result();
        return $res;
    }
}
