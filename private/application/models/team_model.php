<?php

/**
 * Class Team_model
 * @property MY_Lang $lang
 */
class Team_model extends CI_Model {
    public function addVideo($uid, $videotype, $videoid, $videotitle) {
        if ($videotype == 'video') {
            $videotype = 'singlevideo';
        }

        $this->db->insert('videochannel', array(
            "team_uid" => $uid, "name" => $videotitle, "type" => $videotype, "value" => $videoid));
    }

    public function clearVideos($uid) {
        $this->db->where('team_uid', $uid)->delete('videochannel');
    }

    public function clearTweets($feedid) {
      $this->db->where('twitter_feed_uid', $feedid);
      $this->db->delete('post');
    }

    public function instaFeed($feedid) {
      $this->db->where('twitter_feed_uid', $feedid);
      $this->db->delete('post');
    }

    public function count() {
        return $this->db->select('team.uid')->from('team')
            ->join('tournament_team', 'tournament_team.team_uid = team.uid')
            ->group_by('team.uid')
            ->get()->num_rows();
    }

    public function add_twitterfeed($uid, $name, $feedid) {
      $this->db->insert('twitterfeeds', array('name' => $name, 'team_uid' => $uid, 'feed_uid' => $feedid, 'disabled' => 0));
    }

    public function remove_twitterfeed($uid) {
      $this->db->where('uid', $uid)->delete('twitterfeeds');
      $this->db->where('twitter_feed_uid', $uid)->update('post', array('deleted' => 1));
    }

    public function get_twitterfeeds($uid) {
      $this->db->select('*')->from('twitterfeeds')->where('team_uid', $uid)->where('disabled', 0);
      return $this->db->get()->result_array();
    }

    /*public function add_instagramfeed($uid, $name, $feedid, $feedname) {
      $this->db->insert('instagramfeeds', array('name' => $name, 'team_uid' => $uid, 'feed_uid' => $feedid, 'feed_name' => $feedname, 'disabled' => 0));
    }

    public function remove_instagramfeed($uid) {
      $this->db->where('uid', $uid)->delete('instagramfeeds');
      $this->db->where('twitter_feed_uid', $uid)->update('post', array('deleted' => 1));
    }*/

    public function get_instagramfeeds($uid) {
      $this->db->select('*')->from('instagramfeeds')->where('team_uid', $uid)->where('disabled', 0);
      return $this->db->get()->result_array();
    }

    public function get($start = 0, $end = 20, $sortby = "uid", $dir = "asc", $search = array(), $grouped = false) {
        $s = array();
        if (isset($search['uid']) && $search['uid'] != "") {
            $s[] = "theteam.uid = " . $search['uid'];
        }
        if (isset($search['name']) && $search['name'] != "") {
            if (substr($search['name'], 0, 1) == "!") {
                $s[] = "theteam.name LIKE '" . substr($search['name'], 1) . "'";
            } else {
                $stringParts = explode(" ", $search['name']);
                if (count($stringParts) > 0) {
                    $_team = "";
                    $and = "";
                    for ($i = 0; $i < count($stringParts); ++$i) {
                        if ($i > 0) {
                            $and = " AND ";
                        }
                        $_team .= $and . " theteam.name LIKE '%" . $stringParts[$i] . "%'";
                    }
                    $s[] = $_team;
                } else {
                    $s[] = " theteam.name LIKE '%" . $search['name'] . "%'";
                }
            }
        }

        if ($sortby == "name") {
            $sortby = "name " . strtoupper($dir) . ", theteam.uid ASC";
            $dir = " ";
        }

        if (isset($search['sportname']) && $search['sportname'] != "") {
            if (substr($search['sportname'], 0, 1) == "!") {
                $_sport = " AND sport.name LIKE '" . substr($search['sportname'], 1) . "'";
            } else {
                $stringParts = explode(" ", $search['sportname']);
                if (count($stringParts) > 0) {
                    $_sport = "";
                    for ($i = 0; $i < count($stringParts); ++$i) {
                        $_sport .= " AND sport.name LIKE '%" . $stringParts[$i] . "%'";
                    }
                } else {
                    $_sport = " AND sport.name LIKE '%" . $search['sportname'] . "%'";
                }
            }
        } else {
            $_sport = "";
        }

        if (isset($search['categoryname']) && $search['categoryname'] != "") {
            if (substr($search['categoryname'], 0, 1) == "!") {
                $_cat = " AND cat.name LIKE '" . substr($search['categoryname'], 1) . "'";
            } else {
                $stringParts = explode(" ", $search['categoryname']);
                if (count($stringParts) > 0) {
                    $_cat = "";
                    for ($i = 0; $i < count($stringParts); ++$i) {
                        $_cat .= " AND cat.name LIKE '%" . $stringParts[$i] . "%'";
                    }
                } else {
                    $_cat = " AND cat.name LIKE '%" . $search['categoryname'] . "%'";
                }
            }
        } else {
            $_cat = "";
        }

        if (isset($search['tournamentname']) && $search['tournamentname'] != "") {
            if (substr($search['tournamentname'], 0, 1) == "!") {
                $_trn = " AND trnmnt.name LIKE '" . substr($search['tournamentname'], 1) . "'";
            } else {
                $stringParts = explode(" ", $search['tournamentname']);
                if (count($stringParts) > 0) {
                    $_trn = "";
                    for ($i = 0; $i < count($stringParts); ++$i) {
                        $_trn .= " AND trnmnt.name LIKE '%" . $stringParts[$i] . "%'";
                    }
                } else {
                    $_trn = " AND trnmnt.name LIKE '%" . $search['tournamentname'] . "%'";
                }
            }
        } else {
            $_trn = "";
        }

        $s[] = 'theteam.deleted = 0';
        $where = "WHERE " . implode(' AND ', $s);

        $queryString =
            "SELECT theteam.*, trnmnt.name AS tournamentname, cat.name AS categoryname, sport.name AS sportname, untn.name as uniquetnname ";
        $queryString .= "FROM sportnews_team AS theteam ";
        $queryString .= "inner JOIN sportnews_tournament_team AS tntm ON tntm.team_uid = theteam.uid ";
        $queryString .= "inner JOIN sportnews_tournament AS trnmnt ON tntm.tournament_uid = trnmnt.uid " . $_trn;
        $queryString .= "inner JOIN sportnews_category AS cat ON trnmnt.category_uid = cat.uid " . $_cat;
        $queryString .= "inner JOIN sportnews_sport AS sport ON cat.sport_uid = sport.uid " . $_sport;
        $queryString .= "left outer JOIN sportnews_unique_tournament as untn ON trnmnt.unique_uid = untn.uid ";
        $queryString .= "inner join ";
        $queryString .= "		(select theteam.uid ";
        $queryString .= "		from sportnews_team AS theteam ";
        $queryString .= "		inner JOIN sportnews_tournament_team AS tntm ON tntm.team_uid = theteam.uid ";
        $queryString .= "		inner JOIN sportnews_tournament AS trnmnt ON tntm.tournament_uid = trnmnt.uid "
            . $_trn;
        $queryString .= "		inner JOIN sportnews_category AS cat ON trnmnt.category_uid = cat.uid " . $_cat;
        $queryString .= "		inner JOIN sportnews_sport AS sport ON cat.sport_uid = sport.uid " . $_sport;
        $queryString .= "		" . $where . " ";
        $queryString .= "		group BY theteam.uid ";
        $queryString .= "		order by theteam." . $sortby . " " . strtoupper($dir);
        $queryString .= "		limit " . $end . " offset " . $start . ") AS t ON theteam.uid = t.uid ";

        $queryString .= "		" . $where . " ";

        if ($grouped) {
            $queryString .= " group by theteam.uid ";
        }

        $queryString .= "order by theteam." . $sortby . " " . strtoupper($dir);


        $qry = $this->db->query($queryString);

        $ret["result"] = $qry->result_array();
        $ret['count'] = $this->getCount($_trn, $_cat, $_sport, $where, $sortby, $dir);


        return $ret;

    }

    public function getCount($_trn, $_cat, $_sport, $where, $sortby, $dir) {
        $queryString = "SELECT theteam.uid ";
        $queryString .= "FROM sportnews_team AS theteam ";

        $queryString .= "inner JOIN sportnews_tournament_team AS tntm ON tntm.team_uid = theteam.uid ";
        $queryString .= "inner JOIN sportnews_tournament AS trnmnt ON tntm.tournament_uid = trnmnt.uid " . $_trn;
        $queryString .= "inner JOIN sportnews_category AS cat ON trnmnt.category_uid = cat.uid " . $_cat;
        $queryString .= "inner JOIN sportnews_sport AS sport ON cat.sport_uid = sport.uid " . $_sport;
        $queryString .= "left outer JOIN sportnews_unique_tournament as untn ON trnmnt.unique_uid = untn.uid ";
        $queryString .= "inner join ";
        $queryString .= "		(select theteam.uid ";
        $queryString .= "		from sportnews_team AS theteam ";
        $queryString .= "		inner JOIN sportnews_tournament_team AS tntm ON tntm.team_uid = theteam.uid ";
        $queryString .= "		inner JOIN sportnews_tournament AS trnmnt ON tntm.tournament_uid = trnmnt.uid "
            . $_trn;
        $queryString .= "		inner JOIN sportnews_category AS cat ON trnmnt.category_uid = cat.uid " . $_cat;
        $queryString .= "		inner JOIN sportnews_sport AS sport ON cat.sport_uid = sport.uid " . $_sport;
        $queryString .= "		" . $where . " ";
        $queryString .= "		group BY theteam.uid ";
        $queryString .= "		order by theteam." . $sortby . " " . strtoupper($dir);
        $queryString .= "		) AS t ON theteam.uid = t.uid ";
        $queryString .= $where . " AND theteam.deleted = 0 ";
        $queryString .= "group by theteam.uid ";

        return $this->db->query($queryString)->num_rows();
    }

    public function getVideos($uid) {
        return $this->db->select('*')->from('videochannel')->where('team_uid', $uid)->get()->result_array();
    }

    public function get_by_betradar_uid($id) {

        $dblang = $this->config->item('language_db');
        $lang = $dblang[$this->lang->lang()];

        $this->db->select('t.*, tn.name AS tnname, cat.name AS catname, sp.uid AS spuid, sp.name AS spname')
            ->select('IFNULL(lc1.`value`, t.`name`) as name', false)
            ->from('team as t')
            ->join('localization as lc1',
                "lc1.identifier = CONCAT('team_',t.uid,'_name') AND lc1.language_uid = " . $this->db->escape($lang),
                'left')
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

    public function get_by_id_with_rel($id) {
        return $this->db->select('team.*, tn.uid AS tnuid, tn.name AS tnname, cat.uid as catid, cat.name AS catname, sp.uid as sportid, sp.name AS sportname')
            ->from('team')
            ->join('tournament_team AS tntm', 'tntm.team_uid = team.uid', 'left outer')
            ->join('tournament AS tn', 'tntm.tournament_uid = tn.uid', 'left outer')
            ->join('category AS cat', 'tn.category_uid = cat.uid', 'left outer')
            ->join('sport AS sp', 'cat.sport_uid = sp.uid', 'left outer')
            ->where('team.uid', $id)
            ->get()->result_array();
    }

    public function get_by_tournament($uid, $type, $fields = "*") {

      $dblang = $this->config->item('language_db');
      $lang = $dblang[$this->lang->lang()];

      $whereString  = "lt.season_uid = (";
      $whereString .= "SELECT s.uid FROM sportnews_season as s ";
      $whereString .= "JOIN sportnews_tournament as tn ON tn.uid = s.tournament_uid ";
      if ($type == 'tournament') {
        $whereString .= "WHERE tn.uid = " . $uid . " ";
      } else {
        $whereString .= "WHERE tn.unique_uid = " . $uid . " ";
      }
      $whereString .= "ORDER BY s.start DESC LIMIT 1)";

      $this->db->select('t.'.$fields);
      if($fields == '*') {
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
        'localization as lc1',
        "lc1.identifier = CONCAT('team_',t.uid,'_name') AND lc1.language_uid = " . $this->db->escape($lang),
        'left'
      );
      $this->db->where($whereString, null, false);
      $this->db->group_by('t.uid');
      if($fields == '*') {
          $this->db->order_by('name');
      }


      $res = $this->db->get()->result_array();
      if(count($res) > 0) {
          return $res;
      }

      $whereString  = "cb.cupround_uid = (";
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

      $this->db->select('t.'.$fields);
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
        'localization as lc1',
        "lc1.identifier = CONCAT('team_',t.uid,'_name') AND lc1.language_uid = " . $this->db->escape($lang),
        'left'
      );
      $this->db->where($whereString, null, false);
      $res = $this->db->get()->result_array();

      if (count($res) > 0) {
          return $res;
      }

      $this->db ->select('team.'.$fields)
                ->from('team')
                ->join('tournament_team', 'tournament_team.team_uid = team.uid')
                ->where('team.deleted', 0)
                ->order_by('team.name', 'asc');

      if ($type == "tournament") {
          $this->db->where('tournament_team.tournament_uid', $uid);
      } else {
          $this->db ->join('tournament', 'tournament.uid = tournament_team.tournament_uid')
                    ->join('unique_tournament', 'tournament.unique_uid = unique_tournament.uid')
                    ->where('unique_tournament.uid', $uid)
                    ->group_by('team.uid');
      }
      return $this->db->get()->result_array();

    }

    public function get_players($id) {
        $this->db->select('player.*, mm.shirt_number as shirt_number, mm.position as position')
            ->from('player')
            ->join('team_player_mm as mm', 'mm.player_uid = player.uid AND mm.team_uid =' . $id)
            ->where('player.role = "player"')
            ->order_by('mm.shirt_number');

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

    public function get_processed($id, $showDeleted = false)
    {
        $this->load->model('tournament_model', 'tournament', true);
        $this->load->model('category_model', 'category', true);
        $this->load->model('sport_model', 'sport', true);

        $team = (object) $this->get_by_id($id);
        $tournament = (object) $this->tournament->get_by_team($team->uid, $team->main_tournament_uid, $team->main_unique_tournament_uid);

        if (!isset($tournament->scalar)) {
            $category = (object) $this->category->get_single($tournament->category_uid);
            $sport = (object) $this->sport->get_single($category->sport_uid);

            $team->has_tournament = false;
            $team->has_unique_tournament = false;

            if ($tournament->tntype === 'unique_tournament') {
                $team->has_unique_tournament = true;
                $team->unique_tournament = $tournament;
                $team->unique_tournament->category = $category;
                $team->unique_tournament->category->sport = $sport;

            } else {
                $team->has_tournament = true;
                $team->tournament = $tournament;
                $team->tournament->category = $category;
                $team->tournament->category->sport = $sport;
            }
            return $team;
        }

        return false;

    }

    public function get_tournaments($id)
    {
        $dblang = $this->config->item('language_db');
        $lang = $dblang[$this->lang->lang()];

        $this->db->select('tn.*, untn.name as uniquename, s.uid as season_uid, s.tournament_uid stn_uid');
        $this->db->select('IFNULL(lc1.`value`, tn.`name`) as name', false);
        $this->db->select('IFNULL(lc2.`value`, NULL) as uniquename', false);

        $this->db->from('team as tm');

        $this->db->join('tournament_team as tntm', 'tntm.team_uid = tm.uid');
        $this->db->join('tournament as tn', 'tn.uid = tntm.tournament_uid AND tn.hidden = 0');
        $this->db->join('unique_tournament as untn', 'untn.uid = tn.unique_uid AND untn.hidden = 0');
        $this->db->join('tournament as tn2', 'tn2.unique_uid = untn.uid AND tn2.hidden = 0');
        $this->db->join('season as s', 's.tournament_uid = tn2.uid');

        $this->db->join(
            'localization as lc1',
            'lc1.identifier = CONCAT(\'tournament_\',tn.uid,\'_name\') AND lc1.language_uid = ' . $this->db->escape($lang),
            'left'
        );
        $this->db->join(
            'localization as lc2',
            'lc2.identifier = CONCAT(\'unique_tournament_\',tn.unique_uid,\'_name\') AND lc2.language_uid = ' . $this->db->escape($lang),
            'left'
        );

        $this->db->where('tm.uid', $id);
        $this->db->where('s.start < (UNIX_TIMESTAMP()) and s.end > (UNIX_TIMESTAMP())', null, false);
        $this->db->group_by('s.uid');
        $this->db->order_by('tn2.uid, s.end desc');

        $res = $this->db->get()->result_array();

        //echo $this->db->last_query(); die();

        return $res;
    }

    public function has_players($id)
    {

        // @TODO Remove soccer restriction in future
        $this->db->select('t.uid');
        $this->db->from('team as t');
        $this->db->join('sport_team as sptm', 'sptm.team_uid = t.uid');
        $this->db->join('sport as sp', 'sp.uid = sptm.sport_uid');
        $this->db->where('t.uid', $id);
        $this->db->where('sp.uid', 7);

        if ($this->db->get()->num_rows() === 0) {
            return false;
        }

        $numRows = $this->db->select('p.uid')
            ->from('player as p')
            ->join('team_player_mm as mm', 'mm.player_uid = p.uid AND mm.team_uid =' . $id)
            ->join('tournament_team as tntm', 'tntm.team_uid = mm.team_uid')
            ->join('playerstatistics as ps', 'ps.player_id = p.uid')
            ->join('season as s', 's.uid = ps.season_id')
            ->join('tournament as tn', 'tn.uid = tntm.tournament_uid AND tn.hidden = 0')
            ->join('category as cat', 'cat.uid = tn.category_uid AND cat.hidden = 0')
            ->where('s.start < (UNIX_TIMESTAMP()) and s.end > (UNIX_TIMESTAMP())', null, false)
            ->get()->num_rows();

        return $numRows > 0;
    }

    public function reset_squads() {

      // $qry  = 'DELETE kwm FROM sportnews_keyword_matching AS kwm ';
      // $qry .= 'JOIN sportnews_keyword AS kw on kwm.keyword_uid = kw.uid WHERE kw.ref_table = "sportnews_player";';
      // $this->db->query($qry);
      // $qry = 'DELETE kw FROM sportnews_keyword AS kw WHERE kw.ref_table = "sportnews_player"';
      // $this->db->query($qry);
      // $qry = 'DELETE FROM sportnews_team_player_mm';
      // $this->db->query($qry);

    }

    public function remove($id) {
        $this->db->where(array('uid' => $id, 'deleted' => 0))->update('team', array('deleted' => 1));
        $returnval = $this->db->affected_rows() > 0;

        $this->db->where('team_uid', $id);
        $this->db->update('keyword_matching', array('hidden' => 1));

        return $returnval;
    }

    public function saveName($uid, $name) {
        $this->db->where('uid', $uid)->update('team', array('name' => $name));
    }

    public function set_headerimage($uid, $path) {
        $this->db->where('uid', $uid)->update('team', array('header_image' => $path));
    }
}
