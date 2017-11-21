<?php

/**
 * Class Post_model
 *
 * @property team_model $team
 * @property MY_Lang $lang
 */
class Post_model extends CI_Model {
    public function count() {
        return $this->db->select('uid')->from('post')->where('deleted', 0)->get()->num_rows();
    }

    public function countFiltered($search, $sortby = "", $future = false) {

      $addWhere = "";
      $sql = "SELECT p.uid AS uid ";

      switch($sortby) {
        case 'feedname':
        case 'sportname':

        break;
        case 'categoryname':
          $sql .= ", c.name as categoryname ";
          $joinCategory = true;
        break;
        case 'tournamentname':
          $sql .= ", tournament.name as tournamentname, untn.name as untnname ";
          $joinTournament = true;
        break;
        case 'teamname':
          $sql .= ", t1.name as teamname, t1.name as team1name, t2.name as team2name ";
          $joinTeam = true;
        break;
      }

      $sql .= "FROM sportnews_post as p ";

      if (!empty($search)) {
          if (!empty($search['feedname']) || isset($joinFeed)) {
            $sql .= "JOIN sportnews_feed as f ON f.uid = p.feed_uid ";
            if(!empty($search['feedname'])) {
              $sql .= "AND f.name LIKE '" . $this->generateSearchString($search['feedname']) . "' ";
            }
          }

          if (!empty($search['sportname']) || isset($joinSport)) {
            $sql .= "JOIN sportnews_sport as s ON s.uid = p.sport_uid ";
            if(!empty($search['sportname'])) {
              $sql .= "AND s.name LIKE '" . $this->generateSearchString($search['sportname']) . "' ";
            }
          }

          if (!empty($search['categoryname']) || isset($joinCategory)) {
            $sql .= "JOIN sportnews_category as c ON c.uid = p.category_uid ";
            if(!empty($search['categoryname'])) {
              $sql .= "AND c.name LIKE '" . $this->generateSearchString($search['categoryname']) . "' ";
            }
          }

          if (!empty($search['tournamentname']) || isset($joinTournament)) {
            $sql .= "LEFT JOIN sportnews_tournament as tournament ON tournament.uid = p.tournament_uid AND p.tournament_uid > 0 ";
            $sql .= "LEFT JOIN sportnews_unique_tournament as untn ON untn.uid = p.unique_tournament_uid AND p.unique_tournament_uid > 0 ";
            if (!empty($search['tournamentname'])) {
              $addWhere .= "AND (tournament.name LIKE '" . $this->generateSearchString($search['tournamentname']) . "' ";
              $addWhere .= "OR untn.name LIKE '" . $this->generateSearchString($search['tournamentname']) . "') ";
            }
          }

          if (!empty($search['teamname']) || isset($joinTeam)) {
            $sql .= "JOIN sportnews_team as t1 ON t1.uid = p.team1_uid ";
            $sql .= "LEFT JOIN sportnews_team as t2 ON t2.uid = p.team2_uid AND p.team2_uid > 0 ";
            if (!empty($search['teamname'])) {
              $addWhere .= "AND (t1.name LIKE '" . $this->generateSearchString($search['teamname']) . "' ";
              $addWhere .= "OR t2.name LIKE '" . $this->generateSearchString($search['teamname']) . "') ";
            }
          }

      }

      $sql .= "WHERE p.deleted = 0 " . $addWhere;
      if (!empty($search)) {
        if (!empty($search['uid'])) {
            $sql .= "AND p.uid = " . intval($search['uid']) . " ";
        }
        if (!empty($search['title'])) {
            $sql .= "AND p.title LIKE '%" . $this->db->escape_like_str($search['title']) . "%' ";
        }
      }

      if (!$future) {
        $sql .= "AND p.posted_on < " . time() . " ";
      }

      $data = $this->db->query($sql)->num_rows();
      return $data;

    }

    public function get($start = 0, $end = 20, $sortby = "uid", $dir = "asc", $search = array(), $future = true) {

        $addWhere = "";
        $sql  = "SELECT post.*, feed.name as feedname, feed.vendor_icon as feedicon, "
              . "sport.name as sportname, category.name as categoryname, tournament.name as tournamentname, "
              . "untn.name as untnname, t1.name as teamname, t1.name as team1name, t1.gender as team1gender, t2.name as team2name, t2.gender as team2gender ";

        $sql .= "FROM ( ";

        $sql .= "SELECT p.* ";

        switch($sortby) {
          case 'feedname':
            $sql .= ", f.name as feedname ";
            $joinFeed = true;
          break;
          case 'sportname':
            $sql .= ", s.name as sportname ";
            $joinSport = true;
          break;
          case 'categoryname':
            $sql .= ", c.name as categoryname ";
            $joinCategory = true;
          break;
          case 'tournamentname':
            $sql .= ", tournament.name as tournamentname, untn.name as untnname ";
            $joinTournament = true;
          break;
          case 'teamname':
            $sql .= ", t1.name as teamname, t1.name as team1name, t2.name as team2name ";
            $joinTeam = true;
          break;
        }

        $sql .= "FROM sportnews_post as p ";

        if (!empty($search)) {
            if (!empty($search['feedname']) || isset($joinFeed)) {
              $sql .= "JOIN sportnews_feed as f ON f.uid = p.feed_uid ";
              if(!empty($search['feedname'])) {
                $sql .= "AND f.name LIKE '" . $this->generateSearchString($search['feedname']) . "' ";
              }
            }

            if (!empty($search['sportname']) || isset($joinSport)) {
              $sql .= "JOIN sportnews_sport as s ON s.uid = p.sport_uid ";
              if(!empty($search['sportname'])) {
                $sql .= "AND s.name LIKE '" . $this->generateSearchString($search['sportname']) . "' ";
              }
            }

            if (!empty($search['categoryname']) || isset($joinCategory)) {
              $sql .= "JOIN sportnews_category as c ON c.uid = p.category_uid ";
              if(!empty($search['categoryname'])) {
                $sql .= "AND c.name LIKE '" . $this->generateSearchString($search['categoryname']) . "' ";
              }
            }

            if (!empty($search['tournamentname']) || isset($joinTournament)) {
              $sql .= "LEFT JOIN sportnews_tournament as tournament ON tournament.uid = p.tournament_uid AND p.tournament_uid > 0 ";
              $sql .= "LEFT JOIN sportnews_unique_tournament as untn ON untn.uid = p.unique_tournament_uid AND p.unique_tournament_uid > 0 ";
              if (!empty($search['tournamentname'])) {
                $addWhere .= "AND (tournament.name LIKE '" . $this->generateSearchString($search['tournamentname']) . "' ";
                $addWhere .= "OR untn.name LIKE '" . $this->generateSearchString($search['tournamentname']) . "') ";
              }
            }

            if (!empty($search['teamname']) || isset($joinTeam)) {
              $sql .= "JOIN sportnews_team as t1 ON t1.uid = p.team1_uid ";
              $sql .= "LEFT JOIN sportnews_team as t2 ON t2.uid = p.team2_uid AND p.team2_uid > 0 ";
              if (!empty($search['teamname'])) {
                $addWhere .= "AND (t1.name LIKE '" . $this->generateSearchString($search['teamname']) . "' ";
                $addWhere .= "OR t2.name LIKE '" . $this->generateSearchString($search['teamname']) . "') ";
              }
            }

        }

        $sql .= "WHERE p.deleted = 0 " . $addWhere;
        if (!empty($search)) {
          if (!empty($search['uid'])) {
              $sql .= "AND p.uid = " . intval($search['uid']) . " ";
          }
          if (!empty($search['title'])) {
              $sql .= "AND p.title LIKE '%" . $this->db->escape_like_str($search['title']) . "%' ";
          }
        }

        if (!$future) {
          $sql .= "AND p.posted_on < " . time() . " ";
        }

        $sql .= "ORDER BY " . $sortby . " " . $dir . " ";
        $sql .= "LIMIT ".$start.", ".$end." ";
        $sql .= ") as post ";

        $sql .= "JOIN sportnews_feed as feed ON feed.uid = post.feed_uid ";
        $sql .= "LEFT JOIN sportnews_sport as sport ON sport.uid = post.sport_uid AND post.sport_uid > 0 ";
        $sql .= "LEFT JOIN sportnews_category as category ON category.uid = post.category_uid AND post.category_uid > 0 ";
        $sql .= "LEFT JOIN sportnews_tournament as tournament ON tournament.uid = post.tournament_uid AND post.tournament_uid > 0 ";
        $sql .= "LEFT JOIN sportnews_unique_tournament as untn ON untn.uid = post.unique_tournament_uid AND post.unique_tournament_uid > 0 ";
        $sql .= "LEFT JOIN sportnews_team as t1 ON t1.uid = post.team1_uid AND post.team1_uid > 0 ";
        $sql .= "LEFT JOIN sportnews_team as t2 ON t2.uid = post.team2_uid AND post.team2_uid > 0 ";

        $data = $this->db->query($sql)->result_array();
        $count = $this->countFiltered($search, $sortby, $future);

        return array("posts" => $data, "count" => $count);
    }

    public function get_favourites($trans = false, $start = 0, $limit = 20, $favarray) {
        $this->load->model('team_model', 'team', true);
        $prejoin = "";
        $ids = array();

        if (isset($favarray['cat']) && count($favarray['cat']) > 0) {
            foreach ($favarray['cat'] as $cat) {
                $teams = $this->team->get_by_category($cat);
                if (count($teams)) {
                    foreach ($teams as $t) {
                        $ids[] = $t['uid'];
                    }
                }
            }
        }
        if (isset($favarray['tournament']) && count($favarray['tournament']) > 0) {
            foreach ($favarray['tournament'] as $trn) {
                $teams = $this->team->get_by_tournament($trn, "tournament");
                if (count($teams) > 0) {
                    foreach ($teams as $t) {
                        $ids[] = $t['uid'];
                    }
                }
            }
        }

        if (isset($favarray['uniquetournament']) && count($favarray['uniquetournament']) > 0) {
            foreach ($favarray['uniquetournament'] as $trn) {
                $teams = $this->team->get_by_tournament($trn, "uniquetournament");
                if (count($teams) > 0) {
                    foreach ($teams as $t) {
                        $ids[] = $t['uid'];
                    }
                }
            }
        }

        if (isset($favarray['team']) && count($favarray['team']) > 0) {
            foreach ($favarray['team'] as $tm) {
                $ids[] = $tm;
            }
        }

        if (count($ids) > 0) {
            $where = "sportnews_post.team1_uid IN (" . implode(",", $ids) . ")";
        } else {
            $where = "1=1";
        }

        if ($this->session->userdata('only_localized_news') && $this->session->userdata('only_localized_news') === 1
            || $trans
        ) {
            $langs = $this->config->item('language_db');
            $where .= " AND posted_on < " . time() . " AND language = " . (int)$langs[$this->lang->lang()] . " ";
        } else {
            $where .= " AND posted_on < " . time() . " ";
        }

        $queryString = "SELECT post.*, feed.name as feedname, feed.vendor_icon as feedicon, t1.betradar_uid as "
            . "team1_betradaruid, sport.name as sportname, cat.name as catname, trnmnt.name as trnmntname, untn.name "
            . "as untnname, t1.name as team1_name, t1.seourl as team1seourl, t2.seourl as team2seourl, t2.name as team2_name, t2.betradar_uid as team2_betradaruid, "
            . " '1' as tn1uid, '1' as tn2uid ";


        $queryString .= "FROM (SELECT sportnews_post.* FROM sportnews_post " . $prejoin . " WHERE " . $where
            . " AND deleted=0 AND hidden=0 ORDER BY posted_on desc LIMIT " . $limit . " OFFSET " . $start
            . ") AS post ";

        $queryString .= "LEFT OUTER JOIN sportnews_feed AS feed ON post.feed_uid = feed.uid ";
        $queryString .= "LEFT OUTER JOIN sportnews_sport AS sport ON post.sport_uid = sport.uid ";
        $queryString .= "LEFT OUTER JOIN sportnews_category AS cat ON post.category_uid = cat.uid ";
        $queryString .= "LEFT OUTER JOIN sportnews_tournament AS trnmnt ON post.tournament_uid = trnmnt.uid ";
        $queryString .= "LEFT OUTER JOIN sportnews_unique_tournament AS untn ON post.unique_tournament_uid = untn.uid ";
        $queryString .= "LEFT OUTER JOIN sportnews_team as t1 ON t1.uid = post.team1_uid ";
        $queryString .= "LEFT OUTER JOIN sportnews_team as t2 ON t2.uid = post.team2_uid ";

        return $this->db->query($queryString)->result_array();
    }
    
    public function get_frontend(
      $trans, $start = 0, $limit = 20, $sport = 0, $cat = 0, $trn = array("uid" => 0, "type" => 'tournament'), $team = 0
    ) {
        if (($this->session->userdata('only_localized_news') && $this->session->userdata('only_localized_news') === 1) || $trans) {
            $langs = $this->config->item('language_db');
            $langCond = " AND `p`.`language` = {$langs[$this->lang->lang()]} ";
        } else {
          $langCond = " ";
        }

        if ((int)$team > 0) {
            $timestamp = -time();

            $query = "SELECT * FROM (
                    SELECT `p`.*, `sportnews_feed`.`vendor_icon` as feedicon, `sportnews_feed`.`name` as feedname, `sp`.`name` as sportname, `cat`.`name` as catname, `tn`.`name` as trnmntname,
                    `untn`.`name` as untnname, `t`.`uid` as tn1uid, NULL as tn2uid, `t`.`name` as team1_name,
                    NULL as team2_name, `t`.`betradar_uid` AS team1_betradaruid, NULL AS team2_betradaruid, `t`.`seourl` AS teamseourl, `t`.`seourl` AS team1seourl,
                    NULL AS team2seourl
                    FROM (`sportnews_post` as p)
                    LEFT JOIN `sportnews_feed` ON `p`.`feed_uid` = `sportnews_feed`.`uid`
                    LEFT JOIN `sportnews_sport` as sp ON `sp`.`uid` = `p`.`sport_uid`
                    LEFT JOIN `sportnews_category` as cat ON `cat`.`uid` = `p`.`category_uid`
                    LEFT JOIN `sportnews_tournament` as tn ON `tn`.`uid` = `p`.`tournament_uid`
                    LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `tn`.`unique_uid`
                    LEFT JOIN `sportnews_team` as t ON `t`.`uid` = `p`.`team1_uid`
                    WHERE `p`.`deleted` =  0
                    AND `p`.`posted_on_negate` > {$timestamp}
                    AND p.team1_uid = {$team} {$langCond}
                    ORDER BY p.posted_on_negate
                    LIMIT {$limit}
                    OFFSET {$start}
                    ) AS post

                    UNION
                    SELECT * FROM (
                    SELECT `p`.*, `sportnews_feed`.`vendor_icon` as feedicon, `sportnews_feed`.`name` as feedname, `sp`.`name` as sportname,
                    `cat`.`name` as catname, `tn`.`name` as trnmntname, `untn`.`name` as untnname, NULL as tn1uid, `t`.`uid` as tn2uid, NULL as team1_name,
                    `t`.`name` as team2_name, NULL AS team1_betradaruid, `t`.`betradar_uid` AS team2_betradaruid, NULL AS teamseourl, NULL AS team1seourl, `t`.`seourl` AS team2seourl
                    FROM (`sportnews_post` as p)
                    LEFT JOIN `sportnews_feed` ON `p`.`feed_uid` = `sportnews_feed`.`uid`
                    LEFT JOIN `sportnews_sport` as sp ON `sp`.`uid` = `p`.`sport_uid`
                    LEFT JOIN `sportnews_category` as cat ON `cat`.`uid` = `p`.`category_uid`
                    LEFT JOIN `sportnews_tournament` as tn ON `tn`.`uid` = `p`.`tournament_uid`
                    LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `tn`.`unique_uid`
                    LEFT JOIN `sportnews_team` as t ON `t`.`uid` = `p`.`team2_uid`
                    WHERE `p`.`deleted` =  0
                    AND `p`.`posted_on_negate` > {$timestamp}
                    AND p.team2_uid = {$team} {$langCond}
                    ORDER BY p.posted_on_negate
                    LIMIT {$limit}
                    OFFSET {$start}
                    ) AS post

                    ORDER BY `posted_on_negate` asc
                    LIMIT $limit;";

            return $this->db->query($query)->result_array();

        } elseif ((int)$trn['uid'] > 0) {

          return $this->getPostsByTournament($trn['uid'], $trn['type'], $langCond, $limit, $start);

        } elseif ((int)$cat > 0) {

          $this->db   ->select('p.*, feed.name AS feedname, feed.vendor_icon AS feedicon')
                      ->select('sp.name AS sportname, cat.name AS catname, tn.name AS trnmntname, untn.name AS untnname')
                      ->select('tm1.name AS team1_name, tm1.betradar_uid AS team1_betradaruid, tm1.seourl AS team1seourl')
                      ->select('tm2.name AS team2_name, tm2.betradar_uid AS team2_betradaruid, tm2.seourl AS team2seourl')
                      ->select('tm1.seourl AS teamseourl')
                      ->select('tm1sp.uid AS tn1uid, tm2sp.uid AS tn2uid', false)
                      ->from('post_category_cache as pc')
                      ->join('category as cat', 'cat.uid = pc.category_uid')
                      ->join('post as p', 'p.uid = p.uid and p.deleted = 0 and p.hidden = 0 and p.uid = pc.post_uid' . $langCond)
                      ->join('sport as sp', 'sp.uid = p.sport_uid', 'left')
                      ->join('tournament as tn', 'tn.uid = p.tournament_uid', 'left')
                      ->join('unique_tournament as untn', 'untn.uid = p.unique_tournament_uid', 'left')
                      ->join('feed as feed', 'feed.uid = p.feed_uid', 'left')
                      ->join('team as tm1', 'tm1.uid = p.team1_uid', 'left')
                      ->join('team as tm2', 'tm2.uid = p.team2_uid', 'left')
                      ->join('category_team as tm1sp', 'tm1sp.team_uid = tm1.uid and tm1sp.category_uid = cat.uid', 'left')
                      ->join('category_team as tm2sp', 'tm2sp.team_uid = tm2.uid and tm2sp.category_uid = cat.uid', 'left')
                      ->where('pc.posted_on_negate > -NOW()', null, false);

          $this->db->where('pc.category_uid', $cat);
          $this->db->where('cat.hidden', 0);

          $this->db->limit($limit)->offset($start)->order_by('pc.posted_on_negate', 'asc');

          $res = $this->db->get()->result_array();

        } elseif ((int)$sport > 0) {

          $this->db   ->select('p.*, feed.vendor_icon as feedicon, feed.name as feedname')
                      ->select('sp.name as sportname, cat.name as catname, tn.name as trnmntname, untn.name as untnname')
                      ->select('t1.uid as tn1uid, t2.uid as tn2uid, t1.name as team1_name, t2.name as team2_name')
                      ->select('t1.betradar_uid AS team1_betradaruid, t2.betradar_uid AS team2_betradaruid')
                      ->select('t1.seourl AS teamseourl')
                      ->select('t1.seourl AS team1seourl, t2.seourl AS team2seourl')
                      ->from('post as p')
                      ->join('feed', 'p.feed_uid = feed.uid', 'left')
                      ->join('sport as sp', 'sp.uid = p.sport_uid', 'left')
                      ->join('category as cat', 'cat.uid = p.category_uid', 'left')
                      ->join('tournament as tn', 'tn.uid = p.tournament_uid', 'left')
                      ->join('unique_tournament as untn', 'untn.uid = tn.unique_uid', 'left')
                      ->join('team as t1', 't1.uid = p.team1_uid', 'left')
                      ->join('team as t2', 't2.uid = p.team2_uid', 'left')
                      ->where('p.deleted = 0 ' . $langCond)
                      ->where('p.sport_uid', $sport)
                      ->where('p.posted_on_negate >', -time())

                      ->limit($limit)
                      ->offset($start)
                      ->order_by('p.posted_on_negate', 'asc');

          $res = $this->db->get()->result_array();

        }

        return $res;

    }

    public function get_post_by_id($id) {
        return $this->db->select('post.*, feed.name as feedname, feed.vendor_icon as vendor_icon')
            ->from('post')
            ->where('post.uid', $id)
            ->join('feed', 'feed.uid = post.feed_uid')
            ->limit(1)->get()->row();
    }

    public function remove($uid) {
        $this->db->where('uid', $uid)->update('post', array('deleted' => 1));
    }

    public function update($id, $data) {
        $this->db->where('uid', $id);
        $this->db->update('post', $data);
    }

    protected function generateSearchString($string) {
      if(substr($string,0,1) == '!') {
        return $this->db->escape_like_str(substr($string,1));
      } else {
        return '%'.$this->db->escape_like_str($string).'%';
      }
    }

    protected function getPostsByTournament($tnUid, $tnType, $langCond, $limit, $start) {
        if (!$teams = $this->cache->get('post_cache_teams_by_tournament_' . $tnType . '_' . $tnUid)) {
            $this->load->model('team_model', 'team', true);
            $teamuids = $this->team->get_by_tournament($tnUid, $tnType, 'uid');
            $teams = array();
            foreach($teamuids as $item) {
                array_push($teams, $item["uid"]);
            }

            $this->cache->write($teams, 'post_cache_teams_by_tournament_' . $tnType . '_' . $tnUid, 3600);
        }

        $timestamp = -time();

        $untnConditions = "";
        $tnConditions = "";
        if ($tnType == 'unique_tournament') {
            $untnConditions = "AND `untn`.`uid` = {$tnUid} AND `untn`.`hidden` = 0";
        } else {
            $tnConditions = "AND `tn`.`uid` = {$tnUid}";
        }

        $innerLimit = 4 * $limit;

        $query = "SELECT `p`.*, `feed`.`name` AS `feedname`, `feed`.`vendor_icon` AS `feedicon`, "
            . "`sp`.`name` AS `sportname`, `cat`.`name` AS `catname`, `tn`.`name` AS `trnmntname`, "
            . "`untn`.`name` AS `untnname`, `tm1`.`name` AS `team1_name`, `tm1`.`betradar_uid` AS `team1_betradaruid`, "
            . "`tm1`.`seourl` AS `team1seourl`, `tm2`.`name` AS `team2_name`, "
            . "`tm2`.`betradar_uid` AS `team2_betradaruid`, `tm2`.`seourl` AS `team2seourl`, "
            . "`tm1`.`seourl` AS `teamseourl`, `tm1`.`uid` AS `tn1uid`, `tm2`.`uid` AS `tn2uid` "

            . "FROM ("
            . "SELECT `p`.`uid`, `p`.`posted_on_negate` FROM (
SELECT
	`p`.`uid`, `p`.`posted_on_negate`

FROM `sportnews_post` AS `p` USE INDEX(`deleted_posted_on_neg_team1_uid`)
JOIN `sportnews_tournament_team` AS `tntm` ON `tntm`.`team_uid` = `p`.`team1_uid`
JOIN `sportnews_tournament` AS `tn` ON `tn`.`uid` = `tntm`.`tournament_uid` {$tnConditions}
LEFT JOIN `sportnews_unique_tournament` AS `untn` ON `untn`.`uid` = `tn`.`unique_uid` {$untnConditions}
WHERE `p`.`deleted` = 0
	AND `p`.`posted_on_negate` > {$timestamp} " . $langCond;
            if (!empty($teams)) {
                $query .= " AND `p`.`team1_uid` IN (" . implode(',', $teams) . ") ";
            }
    $query .= "ORDER BY `posted_on_negate`
LIMIT {$innerLimit}
) AS `p`

UNION
SELECT `p`.`uid`, `p`.`posted_on_negate` FROM (
SELECT
	`p`.`uid`, `p`.`posted_on_negate`

FROM `sportnews_post` AS `p` USE INDEX(`deleted_posted_on_neg_team2_uid`)
JOIN `sportnews_tournament_team` AS `tntm` ON `tntm`.`team_uid` = `p`.`team2_uid`
JOIN `sportnews_tournament` AS `tn` ON `tn`.`uid` = `tntm`.`tournament_uid` {$tnConditions}
LEFT JOIN `sportnews_unique_tournament` AS `untn` ON `untn`.`uid` = `tn`.`unique_uid` {$untnConditions}
WHERE `p`.`deleted` = 0
	AND `p`.`posted_on_negate` > {$timestamp} " . $langCond;
        if (!empty($teams)) {
            $query .= " AND `p`.`team2_uid` IN (" . implode(',', $teams) . ") ";
        }
        $query .= "ORDER BY `posted_on_negate`
LIMIT
	{$innerLimit}
) AS `p`

UNION
SELECT `p`.`uid`, `p`.`posted_on_negate` FROM (
SELECT `p`.`uid`, `p`.`posted_on_negate`
FROM
	`sportnews_post` AS `p`
	JOIN `sportnews_tournament` AS `tn` ON `tn`.`uid` = `p`.`tournament_uid` {$tnConditions}
	JOIN `sportnews_tournament_team` AS `tntm` ON `tntm`.`tournament_uid` = `p`.`tournament_uid`
    LEFT JOIN `sportnews_unique_tournament` AS `untn` ON `untn`.`uid` = `tn`.`unique_uid` {$untnConditions}
WHERE
	`p`.`deleted` = 0
	AND `p`.`posted_on_negate` > {$timestamp} " . $langCond;
        if (!empty($teams)) {
            $query .= " AND `tntm`.`team_uid` IN (" . implode(',', $teams) . ") ";
        }
        $query .= "ORDER BY `posted_on_negate`
LIMIT
	{$innerLimit}
) AS `p`
UNION
SELECT `p`.`uid`, `p`.`posted_on_negate` FROM (
SELECT `p`.`uid`, `p`.`posted_on_negate`
FROM
	`sportnews_post` AS `p`
	JOIN `sportnews_unique_tournament` AS `untn` ON `untn`.`uid` = `p`.`unique_tournament_uid` {$untnConditions}
    JOIN `sportnews_tournament` AS `tn` ON `tn`.`unique_uid` = `untn`.`uid` {$tnConditions}
	JOIN `sportnews_tournament_team` AS `tntm` USE INDEX(`tournament_uid_team_uid`) ON `tntm`.`tournament_uid` = `tn`.`uid`
WHERE
	`p`.`deleted` = 0
	AND `p`.`posted_on_negate` > {$timestamp} " . $langCond;
        if (!empty($teams)) {
            $query .= " AND `tntm`.`team_uid` IN (" . implode(',', $teams) . ") ";
        }
        $query .= "ORDER BY `posted_on_negate`
LIMIT
	{$innerLimit}
) AS `p`

ORDER BY `posted_on_negate`"
            . ") AS `p2` "
            . "JOIN `sportnews_post` AS `p` ON `p`.`uid` = `p2`.`uid` "
            . "JOIN `sportnews_feed` AS `feed` ON `feed`.`uid` = `p`.`feed_uid` "
            . "LEFT JOIN `sportnews_team` AS tm1 ON `p`.`team1_uid` = `tm1`.`uid` "
            . "LEFT JOIN `sportnews_team` AS tm2 ON `p`.`team2_uid` = `tm2`.`uid` "
            . "LEFT JOIN `sportnews_unique_tournament` AS `untn` ON `p`.`unique_tournament_uid` = `untn`.`uid` "
            . "LEFT JOIN `sportnews_tournament` AS `tn` ON `p`.`tournament_uid` = `tn`.`uid`"
            . "LEFT JOIN `sportnews_category` AS cat ON `cat`.`uid` = `p`.`category_uid` "
            . "LEFT JOIN `sportnews_sport` AS sp ON `sp`.`uid` = `p`.`sport_uid` "

            . "ORDER BY `p`.`posted_on_negate` "
            . "LIMIT {$limit} OFFSET {$start}";

            return $this->db->query($query)->result_array();

        }
}
