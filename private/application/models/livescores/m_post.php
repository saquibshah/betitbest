<?php

class M_post extends CI_Model {

    var $newItem = null;
    var $listFeeds = array();
    var $possibleTeams = array();
    var $betradarTeamIDs = array();
    var $whereReadPosts = "";
    var $arrIds = array();
    var $arrBetradars = array();
    
    //Team images variables
    var $arrTeamImages = array();
    var $teamImagePath = '';
    
    //Tournament images variables
    var $arrTournamentImages = array();
    var $tournamentImagePath = '';
    var $tournamentFolderName = 'tournaments';
    var $uniqueTournamentFolderName = 'unique_tournaments';
    
    //Categories variables
    var $arrImageNames = array();
    

    function __construct() {
        $this->load->model('team_model', 'team', true);
        $this->teamImagePath = dirname(__FILE__).'/../../../../pool/placeholders/teams/';
        $this->tournamentImagePath = dirname(__FILE__).'/../../../../pool/placeholders/';
    }

    public function getRelateNews($newItem) {
        $this->newItem = $newItem;
        $isPass = FALSE;
        $moreWhere = ' AND seourl IS NOT NULL AND seourl <> "" ';
        $firstSection = array();
        if ($this->newItem == NULL)
            return array();

        $readedPosts = $this->getReadPost();
        $whereReadPosts = "";
        if (count($readedPosts) > 0) {
            $whereReadPosts = " AND uid NOT IN ('" . implode("','", $readedPosts) . "') ";
        }

        if ($this->newItem->team1_uid > 0) {
            $sql = "SELECT * FROM `sportnews_post` WHERE `team1_uid` = '{$this->newItem->team1_uid}' AND `uid` <> '{$this->newItem->uid}' {$whereReadPosts} {$moreWhere}  AND `sport_uid` = '{$this->newItem->sport_uid}' ORDER BY `posted_on` DESC LIMIT 0,3";
            $firstSection = $this->db->query($sql)->result_array();
            if (count($firstSection) > 0) {
                $isPass = true;
            }
        }
        if (!$isPass && $this->newItem->team2_uid > 0) {
            $sql = "SELECT * FROM `sportnews_post` WHERE `team2_uid` = '{$this->newItem->team2_uid}' AND `uid` <> '{$this->newItem->uid}' {$whereReadPosts} {$moreWhere}  AND `sport_uid` = '{$this->newItem->sport_uid}' ORDER BY `posted_on` DESC LIMIT 0,3";
            $firstSection = $this->db->query($sql)->result_array();
            if (count($firstSection) > 0) {
                $isPass = true;
            }
        }
        if (!$isPass && $this->newItem->tournament_uid > 0) {
            $sql = "SELECT * FROM `sportnews_post` WHERE `tournament_uid` = '{$this->newItem->tournament_uid}' AND `uid` <> '{$this->newItem->uid}' {$whereReadPosts} {$moreWhere}  AND `sport_uid` = '{$this->newItem->sport_uid}' ORDER BY `posted_on` DESC LIMIT 0,3";
            $firstSection = $this->db->query($sql)->result_array();
            if (count($firstSection) > 0) {
                $isPass = true;
            }
        }
        if (!$isPass && $this->newItem->unique_tournament_uid > 0) {
            $sql = "SELECT * FROM `sportnews_post` WHERE `unique_tournament_uid` = '{$this->newItem->unique_tournament_uid}' AND `uid` <> '{$this->newItem->uid}' {$whereReadPosts} {$moreWhere}  AND `sport_uid` = '{$this->newItem->sport_uid}' ORDER BY `posted_on` DESC LIMIT 0,3";
            $firstSection = $this->db->query($sql)->result_array();
            if (count($firstSection) > 0) {
                $isPass = true;
            }
        }
        if (!$isPass && $this->newItem->category_uid > 0) {
            $sql = "SELECT * FROM `sportnews_post` WHERE `category_uid` = '{$this->newItem->category_uid}' AND `uid` <> '{$this->newItem->uid}' {$whereReadPosts} {$moreWhere}  AND `sport_uid` = '{$this->newItem->sport_uid}' ORDER BY `posted_on` DESC LIMIT 0,3";
            $firstSection = $this->db->query($sql)->result_array();
            if (count($firstSection) > 0) {
                $isPass = true;
            }
        }
        $feedIds = array();
        $secondSection = array();
        $extendWhere = '';
        if (count($firstSection) > 0) {
            $arr = array();
            for ($i = 0; $i < count($firstSection); $i++) {
                $arr[] = $firstSection[$i]['uid'];
                $feedIds[] = $firstSection[$i]['feed_uid'];
                if (!empty($firstSection[$i]['team1_uid'])) {
                    $this->possibleTeams[] = $firstSection[$i]['team1_uid'];
                }
                if (!empty($firstSection[$i]['team2_uid'])) {
                    $this->possibleTeams[] = $firstSection[$i]['team2_uid'];
                }
            }
            $extendWhere = "AND uid NOT IN ('" . implode("','", $arr) . "')";
        }

        if (isset($_COOKIE['read'])) {
            $exclude = "AND `uid` NOT IN ('" . implode("','", $_COOKIE['read']) . "')";
        } else {
            $exclude = "";
        }

        $sql = "SELECT * FROM `sportnews_post` WHERE `sport_uid` = '{$this->newItem->sport_uid}'  AND `uid` <> '{$this->newItem->uid}' {$extendWhere} {$whereReadPosts} {$moreWhere}  {$exclude} ORDER BY `uid` DESC LIMIT 0,3";
        $secondSection = $this->db->query($sql)->result_array();

        for ($i = 0; $i < count($secondSection); $i++) {
            $feedIds[] = $secondSection[$i]['feed_uid'];
            if (!empty($secondSection[$i]['team1_uid'])) {
                $this->possibleTeams[] = $secondSection[$i]['team1_uid'];
            }
            if (!empty($secondSection[$i]['team2_uid'])) {
                $this->possibleTeams[] = $secondSection[$i]['team2_uid'];
            }
        }

        if (count($feedIds) > 0) {
            $sql = "SELECT * FROM `sportnews_feed` WHERE uid IN ('" . implode("','", $feedIds) . "')";
            $query = $this->db->query($sql);
            foreach ($query->result_array() as $row) {
                $this->listFeeds[$row['uid']] = array('name' => $row['name'], 'icon' => $row['vendor_icon']);
            }
        }

        $this->getTeamBetradarIDs();
        for ($i = 0; $i < count($firstSection); $i++) {
            $this->refreshMoreNews($firstSection[$i]);
        }

        for ($i = 0; $i < count($secondSection); $i++) {
            $this->refreshInterestingNews($secondSection[$i]);
        }
        return array('firstSection' => $firstSection, 'secondSection' => $secondSection);
    }
    
    public function refreshMoreNews(&$row) {
        $row['imageUrl'] = base_url("assets/frontend/images/placeholder.png");
        $imgUrl = FALSE;
        if (intval($row['team1_uid']) > 0) {
            $imgUrl = $this->getTeamImageHolder($row['team1_uid']);
            if ($imgUrl !== FALSE) {
                $row['imageUrl'] = base_url($imgUrl);
            } else {
                $row['imageUrl'] = false;
            }
        } else if (intval($row['team2_uid']) > 0) {
            $imgUrl = $this->getTeamImageHolder($row['team2_uid']);
            if ($imgUrl !== FALSE) {
                $row['imageUrl'] = base_url($imgUrl);
            } else {
                $row['imageUrl'] = false;
            }
        } 
        if ($imgUrl === FALSE) {
            $imgUrl = $this->getTournamentImageHolder($row);
            if ($imgUrl !== FALSE) {
                $row['imageUrl'] = base_url($imgUrl);
            } else {
                $row['imageUrl'] = false;
            }
        } 
        $row['newUrl'] = base_url($this->lang->lang() . '/news/' . $row['seourl']);
        $row['onDate'] = date('d.m.Y - H:i', intval($row['posted_on']));
        $row['feedName'] = '&nbsp;';
        if (isset($this->listFeeds[$row['feed_uid']])) {
            $row['feedName'] = $this->listFeeds[$row['feed_uid']]['name'];
            $row['feedIcon'] = base_url('pool/uploads/feed/' . $this->listFeeds[$row['feed_uid']]['icon']);
        }
    }

    public function refreshInterestingNews(&$row) { 
        $row['imageUrl'] = base_url("assets/frontend/images/placeholder.png");
        if (intval($row['team1_uid']) > 0 && isset($this->betradarTeamIDs[$row['team1_uid']])) {
            $row['imageUrl'] = base_url('pool/teams/' . $this->betradarTeamIDs[$row['team1_uid']] . '_.png');
        } else if (intval($row['team2_uid']) > 0 && isset($this->betradarTeamIDs[$row['team2_uid']])) {
            $row['imageUrl'] = base_url('pool/teams/' . $this->betradarTeamIDs[$row['team2_uid']] . '_.png');
        }
        $row['newUrl'] = base_url($this->lang->lang() . '/news/' . $row['seourl']);
        $row['onDate'] = date('d.m.Y - H:i', intval($row['posted_on']));
        $row['feedName'] = '&nbsp;';
        if (isset($this->listFeeds[$row['feed_uid']])) {
            $row['feedName'] = $this->listFeeds[$row['feed_uid']]['name'];
            $row['feedIcon'] = base_url('pool/uploads/feed/' . $this->listFeeds[$row['feed_uid']]['icon']);
        }
    }
    
    public function getTeamImageHolder($teamID) {
        if (!isset($this->betradarTeamIDs[$teamID])) return FALSE;
        $betradarID = $this->betradarTeamIDs[$teamID];
        if (empty($this->arrTeamImages[$betradarID])) {
            $this->arrTeamImages[$betradarID] = array(
                'get' => true,
                'data' => array()
            );
            for ($i = 0; $i < 10; $i++) {
                $index = $i;
                if ($index == 0) $index = ''; 
                else $index = '_'.$index;
                if (file_exists($this->teamImagePath."{$betradarID}{$index}.png")) {
                    $this->arrTeamImages[$betradarID]['data'][] = 'pool/placeholders/teams/'."{$betradarID}{$index}.png";
                }
            }
        }
        
        if (count($this->arrTeamImages[$betradarID]['data']) > 0) {
            $randKey = array_rand($this->arrTeamImages[$betradarID]['data'], 1);
            $returnData = $this->arrTeamImages[$betradarID]['data'][$randKey];
            unset($this->arrTeamImages[$betradarID]['data'][$randKey]);
            $this->arrTeamImages[$betradarID]['data'] = array_values($this->arrTeamImages[$betradarID]['data']);
            return $returnData;
        }
        return FALSE;
    }
    
    public function getTournamentImageHolder($newItem){
        $newItem = (object)$newItem;
        
        if ($newItem->sport_uid == 8) {
            $type = $this->tournamentFolderName;
        } else {
            $type = $this->uniqueTournamentFolderName;
        }
        
        if ($newItem->tournament_uid > 0) {
            $tournamentID = $newItem->tournament_uid;
        } else if ($newItem->unique_tournament_uid > 0) {
            $tournamentID = $newItem->unique_tournament_uid;
        } else {
            return FALSE;
        }
        
        if (!isset($this->arrTournamentImages[$type])) {
            $this->arrTournamentImages[$type] = array();
        }
        if (!isset($this->arrTournamentImages[$type][$tournamentID])) {
            $this->arrTournamentImages[$type][$tournamentID] = array(
                'get' => true,
                'data' => array()
            );
            if ($type == $this->uniqueTournamentFolderName) {
                $sql = "SELECT * FROM sportnews_unique_tournament WHERE uid = '{$tournamentID}' LIMIT 0,1";
            } else {
                $sql = "SELECT * FROM sportnews_tournament WHERE uid = '{$tournamentID}' LIMIT 0,1";
            }
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                $row = $query->row_array();
                for ($i = 0; $i < 10; $i++) {
                    $index = $i;
                    if ($index == 0) $index = ''; 
                    else $index = '_'.$index;
                    if (file_exists($this->tournamentImagePath."{$type}/{$row['betradar_uid']}{$index}.png")) {
                        $this->arrTournamentImages[$type][$tournamentID]['data'][] = 'pool/placeholders/'."{$type}/{$row['betradar_uid']}{$index}.png";
                    }
                }
            }
        }
        
        if (count($this->arrTournamentImages[$type][$tournamentID]['data']) > 0) {
            $randKey = array_rand($this->arrTournamentImages[$type][$tournamentID]['data'], 1);
            $returnData = $this->arrTournamentImages[$type][$tournamentID]['data'][$randKey];
            unset($this->arrTournamentImages[$type][$tournamentID]['data'][$randKey]);
            $this->arrTournamentImages[$type][$tournamentID]['data'] = array_values($this->arrTournamentImages[$type][$tournamentID]['data']);
            return $returnData;
        }
        return FALSE;
    }

    public function getTeamBetradarIDs() {
        if (count($this->possibleTeams) > 0) {
            $query = $this->db->query("SELECT `uid`,`betradar_uid` FROM `sportnews_team` WHERE `uid` IN ('" . implode("','", $this->possibleTeams) . "')");
            foreach ($query->result_array() as $row) {
                $this->betradarTeamIDs[$row['uid']] = $row['betradar_uid'];
            }
        }
    }

    public function getFavoriteNews($str) {
        $readedPosts = $this->getReadPost();
        $this->whereReadPosts = "";
        if (count($readedPosts) > 0) {
            $this->whereReadPosts = " AND uid NOT IN ('" . implode("','", $readedPosts) . "') ";
        }

        $this->load->model('match_live_model', 'match', true);
        $this->load->model('livescores/m_category', 'category', true);
        $this->load->model('livescores/m_tournament', 'tournament', true);
        $this->load->model('livescores/m_team', 'team', true);

        $dataReturn = array();
        $favs = explode("_", $str);
        $listSports = array();

        if (count($favs) > 0) {
            foreach ($favs as $fav) {
                $val = explode("-", $fav);
                $data[$val[0]][] = $val[1];
            }

            if (isset($data['cat']) && count($data['cat']) > 0) {
                for ($i = 0; $i < count($data['cat']); ++$i) {
                    $cat = $this->category->get_single($data['cat'][$i]);
                    if (!isset($listSports[$cat['sport_uid']])) {
                        $listSports[$cat['sport_uid']] = array('categories' => array(), 'tournaments' => array(), 'teams' => array());
                    }
                    $listSports[$cat['sport_uid']]['categories'][] = $cat['uid'];
                }
            }
            if (isset($data['uniquetournament']) && count($data['uniquetournament']) > 0) {
                for ($i = 0; $i < count($data['uniquetournament']); ++$i) {
                    $tn = $this->tournament->get_single($data['uniquetournament'][$i], 'unique');
                    if (!isset($listSports[$tn->sport_uid])) {
                        $listSports[$tn->sport_uid] = array('categories' => array(), 'tournaments' => array(), 'teams' => array());
                    }
                    $listSports[$tn->sport_uid]['tournaments'][] = $tn->uid;
                }
            }
            if (isset($data['tournament']) && count($data['tournament']) > 0) {
                for ($i = 0; $i < count($data['tournament']); ++$i) {
                    $tn = $this->tournament->get_single($data['tournament'][$i]);
                    if (!isset($listSports[$tn->sport_uid])) {
                        $listSports[$tn->sport_uid] = array('categories' => array(), 'tournaments' => array(), 'teams' => array());
                    }
                    $listSports[$tn->sport_uid]['tournaments'][] = $tn->uid;
                }
            }
            if (isset($data['team']) && count($data['team']) > 0) {
                for ($i = 0; $i < count($data['team']); ++$i) {
                    $tn = $this->team->get_by_id_for_favs($data['team'][$i]);
                    if (!isset($listSports[$tn->sport_uid])) {
                        $listSports[$tn->sport_uid] = array('categories' => array(), 'tournaments' => array(), 'teams' => array());
                    }
                    $listSports[$tn->sport_uid]['teams'][] = $tn->uid;
                }
            }


            if (count($listSports) > 0 && isset($listSports[7])) {
                return $this->queryFavNews($listSports[7]);
            } else {
                return array();
            }
        }
        return $dataReturn;
    }

    public function queryFavNews($queryInfo) {
        $loadedNews = "(" . $this->input->get('loaded') . ")";
        $dataReturn = array();
        $isPass = FALSE;
        if (count($queryInfo['teams']) > 0) {
            $sql = "SELECT * FROM `sportnews_post` WHERE `team1_uid` IN ('" . implode("','", $queryInfo['teams']) . "') AND uid NOT IN {$loadedNews} {$this->whereReadPosts} AND `sport_uid` = '7' ORDER BY `posted_on` DESC LIMIT 0,3";
            $dataReturn = $this->db->query($sql)->result_array();
            if (count($dataReturn) > 0) {
                $isPass = true;
            }
        }

        if (!$isPass && count($queryInfo['teams']) > 0) {
            $sql = "SELECT * FROM `sportnews_post` WHERE `team2_uid` IN ('" . implode("','", $queryInfo['teams']) . "') AND `uid` NOT IN {$loadedNews} {$this->whereReadPosts} AND `sport_uid` = '7' ORDER BY `posted_on` DESC LIMIT 0,3";
            $dataReturn = $this->db->query($sql)->result_array();
            if (count($dataReturn) > 0) {
                $isPass = true;
            }
        }

        if (!$isPass && count($queryInfo['tournaments']) > 0) {
            $sql = "SELECT * FROM `sportnews_post` WHERE `unique_tournament_uid` IN ('" . implode("','", $queryInfo['tournaments']) . "') AND `uid` NOT IN {$loadedNews} {$this->whereReadPosts} AND `sport_uid` = '7' ORDER BY `posted_on` DESC LIMIT 0,3";
            $dataReturn = $this->db->query($sql)->result_array();
            if (count($dataReturn) > 0) {
                $isPass = true;
            }
        }

        if (!$isPass && count($queryInfo['categories']) > 0) {
            $sql = "SELECT * FROM `sportnews_post` WHERE `category_uid` IN ('" . implode("','", $queryInfo['categories']) . "') AND `uid` NOT IN {$loadedNews} AND `uid` NOT IN {$loadedNews} {$this->whereReadPosts} AND `sport_uid` = '7' ORDER BY `posted_on` DESC LIMIT 0,3";
            $dataReturn = $this->db->query($sql)->result_array();
            if (count($dataReturn) > 0) {
                $isPass = true;
            }
        }

        $feedIds = array();
        for ($i = 0; $i < count($dataReturn); $i++) {
            $feedIds[] = $dataReturn[$i]['feed_uid'];
            if (!empty($dataReturn[$i]['team1_uid'])) {
                $this->possibleTeams[] = $dataReturn[$i]['team1_uid'];
            }
            if (!empty($dataReturn[$i]['team2_uid'])) {
                $this->possibleTeams[] = $dataReturn[$i]['team2_uid'];
            }
        }
        if (count($feedIds) > 0) {
            $sql = "SELECT * FROM `sportnews_feed` WHERE uid IN ('" . implode("','", $feedIds) . "')";
            $query = $this->db->query($sql);
            foreach ($query->result_array() as $row) {
                $this->listFeeds[$row['uid']] = array('name' => $row['name'], 'icon' => $row['vendor_icon']);
            }
        }
        $this->getTeamBetradarIDs();
        for ($i = 0; $i < count($dataReturn); $i++) {
            $this->refreshRow($dataReturn[$i]);
        }
        return $dataReturn;
    }

    public function getReadPost() {
        $dataReturn = array();
        if (isset($_COOKIE['read']) && is_array($_COOKIE['read'])) {
            foreach ($_COOKIE['read'] as $key => $value) {
                if ($value == "read") {
                    $dataReturn[] = $key;
                }
            }
        }
        return $dataReturn;
    }

}
