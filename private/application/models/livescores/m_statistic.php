<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class M_statistic extends CI_Model {

    var $mid = 0;
    var $sport = 7;
    var $sportSeoURL = '';
    var $mlang = 'en';
    var $table = 'sportnews_livescores_soccer';
    //Neccessary components
    var $listTournaments = array();
    var $listTeams = array();
    var $filePath = '/opt/users/www/betitbest-news/fileadmin/user_upload/logos/app_logos';
    var $mainInfo = array();

    public function loadSegments($segments) {
        if (isset($segments[3])) {
            if (intval($segments[3]) > 0) {
               $this->sport = intval($segments[3]); 
            } else {
                $arrMapSportIDs = array(
                    'soccer' => 7,
                    'tennis' => 8,
                    'handball' => 2,
                    'basketball' => 1,
                    'ice-hockey' => 3,
                    'football' => 6,
                    'volleyball' => 9
                );
                if (isset($arrMapSportIDs[$segments[3]])) $this->sport = $arrMapSportIDs[$segments[3]];
            }
            
        }
        if (isset($segments[4])) {
            $this->mid = intval($segments[4]);
        }

        //Determine the sport
        switch ($this->sport) {
            case 7:
                $this->sportSeoURL = "soccer";
                break;
            case 8:
                $this->sportSeoURL = "tennis";
                break;
            case 2:
                $this->sportSeoURL = "handball";
                break;
            case 1:
                $this->sportSeoURL = "basketball";
                break;
            case 3:
                $this->sportSeoURL = "ice-hockey";
                break;
            case 6:
                $this->sportSeoURL = "football";
                break;
            case 9:
                $this->sportSeoURL = "volleyball";
                break;
            default:
                $this->sportSeoURL = "soccer";
                $this->sport = 7;
                break;
        }

        //Hard code data
        $arrData = array(
            1 => 'sportnews_livescores_basketball',
            2 => 'sportnews_livescores_handball',
            3 => 'sportnews_livescores_ice_hockey',
            6 => 'sportnews_livescores_football',
            7 => 'sportnews_livescores_soccer',
            8 => 'sportnews_livescores_tennis',
            9 => 'sportnews_livescores_volleyball'
        );

        //Determine which table to use for live match
        if (isset($arrData[intval($this->sport)])) {
            $this->table = $arrData[intval($this->sport)];
        }

        //Load neccessary information
        $this->loadTournaments();
    }

    public function loadTournaments() {
        if ($this->sportSeoURL == "tennis") {
            $query = $this->db->get("sportnews_tournament");
            foreach ($query->result_array() as $row) {
                $this->listTournaments[$row['betradar_uid']] = $row;
            }
        } else {
            $query = $this->db->get("sportnews_unique_tournament");
            foreach ($query->result_array() as $row) {
                $this->listTournaments[$row['betradar_uid']] = $row;
            }
        }
    }

    public function loadTeams($lteams) {
        $whereIn = "('" . implode("','", $lteams) . "')";
        $query = $this->db->query("SELECT * FROM `sportnews_team` WHERE `uid` IN {$whereIn}");
        foreach ($query->result_array() as $row) {
            $row['name'] = htmlentities($row['name']);
            $this->listTeams[$row['uid']] = $row;
        }
    }

    private function getImageTeam($id) {
        if (isset($this->listTeams[$id]))
            return $this->listTeams[$id]['betradar_uid'];
        return "";
    }

    private function getNeccessaryInformation() {
        //Get main information from table sportnews_livescore_{sportName}
        $query = $this->db->get_where($this->table, array('matchid' => $this->mid));
        if ($query->num_rows() == 0) {
           echo '<div id="logo" title="Bet IT Best"><img src="https://www.betitbest.com/sportsnews/assets/frontend/images/betitbest-logo.png" alt="Bet IT Best"></div>';
              echo '<div style="bottom: 50%;
                left: 25%;
                width: 60%;
                height: 300px;
                position: absolute;
                left: 20%;
                top: 25%;
                text-shadow: 0px -1px 16px rgb(148, 112, 108);
                font-weight: normal;
                color: #6F1111;
                letter-spacing: 0pt;
                word-spacing: 3pt;
                font-size: 40px;
                text-align: center;
                font-family: arial black, sans-serif;
                line-height: 2;">';
            die(dblang('stat_data_does_not_exist'));
            echo '</div>';
        }
        $this->mainInfo = $query->row_array();

        //Get id of the home team and away team
        $sql = "SELECT `team_uid`, `season_uid`, `tournament_uid` FROM `sportnews_match_team` INNER JOIN `sportnews_match` ON `sportnews_match`.`uid` = `sportnews_match_team`.`match_uid` WHERE `betradar_uid` = '{$this->mid}' AND team_uid > 0 ORDER BY type ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 1) {
            $rows = $query->result_array();
            $homeid = $rows[0]['team_uid'];
            $awayid = $rows[1]['team_uid'];
            $this->mainInfo['season_uid'] = intval($rows[0]['season_uid']);
            $this->mainInfo['tournament_uid'] = intval($rows[0]['tournament_uid']);
        } else {
           echo '<div id="logo" title="Bet IT Best"><img src="https://www.betitbest.com/sportsnews/assets/frontend/images/betitbest-logo.png" alt="Bet IT Best"></div>';
              echo '<div style="bottom: 50%;
                left: 25%;
                width: 60%;
                height: 300px;
                position: absolute;
                left: 20%;
                top: 25%;
                text-shadow: 0px -1px 16px rgb(148, 112, 108);
                font-weight: normal;
                color: #6F1111;
                letter-spacing: 0pt;
                word-spacing: 3pt;
                font-size: 40px;
                text-align: center;
                font-family: arial black, sans-serif;
                line-height: 2;">';
            die(dblang('stat_data_does_not_exist'));
            echo '</div>';
        }

        $this->mainInfo['homeid'] = $homeid;
        $this->mainInfo['awayid'] = $awayid;
        $possibleTeams = array();
        $limitDate = intval($this->mainInfo['matchdate']);

        //Get information of league table
        $inYear = "('".date('y')."/".(intval(date('y')) + 1)."','".date('y')."','".date('Y')."')";
        $sql = "SELECT `sportnews_leaguetable_row`.*, `sportnews_team`.`name`, `sportnews_team`.`betradar_uid` 
FROM sportnews_leaguetable_row INNER JOIN sportnews_leaguetable 
ON sportnews_leaguetable.`uid` = sportnews_leaguetable_row.`league_table_uid` AND sportnews_leaguetable.`type`= 'normal' 
INNER JOIN sportnews_season ON sportnews_season.`uid` = sportnews_leaguetable.`season_uid`  
INNER JOIN sportnews_tournament ON sportnews_tournament.`uid` = sportnews_season.`tournament_uid` 
INNER JOIN `sportnews_team` ON sportnews_leaguetable_row.`team_uid` = sportnews_team.`uid` 
WHERE sportnews_tournament.`betradar_uid` = '{$this->mainInfo['leagueid']}'  AND sportnews_season.`year` IN  {$inYear}
ORDER BY sportnews_leaguetable_row.`positionTotal` LIMIT 0,50";
        $this->mainInfo['dataLeagues'] = $this->db->query($sql)->result_array();
        for ($i = 0; $i < count($this->mainInfo['dataLeagues']); $i++) {
            $possibleTeams[] = $this->mainInfo['dataLeagues'][$i]['team_uid'];
        }
        
        if (empty($this->mainInfo['dataLeagues'])) {
            $inYear = "('".(intval(date('y'))-1)."/".(intval(date('y')))."','".(intval(date('y'))-1)."','".(intval(date('Y'))-1)."')";
            $sql = "SELECT `sportnews_leaguetable_row`.*, `sportnews_team`.`name`, `sportnews_team`.`betradar_uid` 
    FROM sportnews_leaguetable_row INNER JOIN sportnews_leaguetable 
    ON sportnews_leaguetable.`uid` = sportnews_leaguetable_row.`league_table_uid` AND sportnews_leaguetable.`type`= 'normal' 
    INNER JOIN sportnews_season ON sportnews_season.`uid` = sportnews_leaguetable.`season_uid`  
    INNER JOIN sportnews_tournament ON sportnews_tournament.`uid` = sportnews_season.`tournament_uid` 
    INNER JOIN `sportnews_team` ON sportnews_leaguetable_row.`team_uid` = sportnews_team.`uid` 
    WHERE sportnews_tournament.`betradar_uid` = '{$this->mainInfo['leagueid']}'  AND sportnews_season.`year` IN  {$inYear}
    ORDER BY sportnews_leaguetable_row.`positionTotal` LIMIT 0,50";
            $this->mainInfo['dataLeagues'] = $this->db->query($sql)->result_array();
            for ($i = 0; $i < count($this->mainInfo['dataLeagues']); $i++) {
                $possibleTeams[] = $this->mainInfo['dataLeagues'][$i]['team_uid'];
            }
        }

        //Get recent matches. 
        // 1) Recent matches between home team and away team. Store in array $recentMatches
        // 2) Recent matches between home team and other teams. Store in array $recentHomeMatches
        // 3) Recent matches between away team and other teams. Store in array $recentAwayMatches
        $sql = "SELECT * FROM `sportnews_match` INNER JOIN
(SELECT A.`match_uid`, A.`team_uid` AS team1id, A.type AS team1type,
B.`team_uid` AS team2id, B.`type` AS team2type 
FROM sportnews_match_team AS A INNER JOIN sportnews_match_team AS B 
ON A.`match_uid` = B.`match_uid` AND A.uid <> B.uid WHERE A.`team_uid` IN ('{$homeid}','{$awayid}')
GROUP BY A.`match_uid`) `joinm`
ON sportnews_match.`uid` = joinm.match_uid 
WHERE `sportnews_match`.`date` < $limitDate
ORDER BY `sportnews_match`.`date` DESC LIMIT 0,100";

        $recentMatches = array();
        $recentAwayMatches = array();
        $recentHomeMatches = array();
        $this->mainInfo['meetings'] = array();
        $this->mainInfo['meetings']['homewin'] = 0;
        $this->mainInfo['meetings']['awaywin'] = 0;
        $this->mainInfo['meetings']['draw'] = 0;

        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            $row['tourname'] = "";
            $tid = intval($row['tournament_uid']);
            if (isset($this->listTournaments[$tid])) {
                $row['tourname'] = strtoupper(substr($this->listTournaments[$tid]['name'], 0, 2));
            }
            $row['date_str'] = date('d.m.Y', $row['date']);

            //Get last 5 matches between home team and away team
            if ($row['team1id'] == $homeid && $row['team2id'] == $awayid) {
                $possibleTeams[] = $row['team1id'];
                $possibleTeams[] = $row['team2id'];
                $recentMatches[] = $row;
                continue;
            }

            //Get last 15 recent matches of home team
            if ($row['team1id'] == $homeid) {
                if (count($recentHomeMatches) < 15) {
                    $possibleTeams[] = $row['team1id'];
                    $possibleTeams[] = $row['team2id'];
                    $recentHomeMatches[] = $row;
                }
                continue;
            }

            //Get last 15 recent matches of away team
            if ($row['team1id'] == $awayid) {
                if (count($recentAwayMatches) < 15) {
                    $possibleTeams[] = $row['team1id'];
                    $possibleTeams[] = $row['team2id'];
                    $recentAwayMatches[] = $row;
                }
                continue;
            }
        }

        //Build the team names array
        $possibleTeams = array_unique($possibleTeams);
        $this->loadTeams($possibleTeams);

        // 1) Recent matches between home team and away team. Store in array $recentMatches
        for ($i = 0; $i < count($recentMatches) && $i < 5; $i++) {
            $row = $recentMatches[$i];
            $team1name = '';
            $team2name = '';
            if (isset($this->listTeams[$row['team1id']])) {
                $team1name = $this->listTeams[$row['team1id']]['name'];
            }
            if (isset($this->listTeams[$row['team2id']])) {
                $team2name = $this->listTeams[$row['team2id']]['name'];
            }

            if ($row['team1type'] == 1) {
                $row['homescore'] = $row['betradar_score1'];
                $row['awayscore'] = $row['betradar_score2'];
                $row['team1name'] = $team1name;
                $row['team2name'] = $team2name;
                $row['result_str'] = $row['homescore'] . ":" . $row['awayscore'];
                $row['name_str'] = $team1name . ":" . $team2name;
            } else {
                $row['homescore'] = $row['betradar_score2'];
                $row['awayscore'] = $row['betradar_score1'];
                $row['team1name'] = $team1name;
                $row['team2name'] = $team2name;
                $row['result_str'] = $row['awayscore'] . ":" . $row['homescore'];
                $row['name_str'] = $team2name . ":" . $team1name;
            }
            if ($row['homescore'] > $row['awayscore']) {
                $this->mainInfo['meetings']['homewin'] ++;
            } else
            if ($row['homescore'] < $row['awayscore']) {
                $this->mainInfo['meetings']['awaywin'] ++;
            } else
                $this->mainInfo['meetings']['draw'] ++;
            $recentMatches[$i] = $row;
        }

        // 2) Recent matches between home team and other teams. Store in array $recentHomeMatches
        for ($i = 0; $i < count($recentHomeMatches); $i++) {
            $row = $recentHomeMatches[$i];
            $team1name = '';
            $team2name = '';
            if (isset($this->listTeams[$row['team1id']])) {
                $team1name = $this->listTeams[$row['team1id']]['name'];
            }
            if (isset($this->listTeams[$row['team2id']])) {
                $team2name = $this->listTeams[$row['team2id']]['name'];
            }

            if ($row['team1type'] == 1) {
                $row['homescore'] = $row['betradar_score1'];
                $row['awayscore'] = $row['betradar_score2'];
                $row['team1name'] = $team1name;
                $row['team2name'] = $team2name;
                $row['result_str'] = $row['homescore'] . ":" . $row['awayscore'];
                $row['name_str'] = "vs " . $team2name;
            } else {
                $row['homescore'] = $row['betradar_score2'];
                $row['awayscore'] = $row['betradar_score1'];
                $row['team1name'] = $team1name;
                $row['team2name'] = $team2name;
                $row['result_str'] = $row['awayscore'] . ":" . $row['homescore'];
                $row['name_str'] = "@ " . $team2name;
            }
            $recentHomeMatches[$i] = $row;
        }

        // 3) Recent matches between away team and other teams. Store in array $recentAwayMatches
        for ($i = 0; $i < count($recentAwayMatches); $i++) {
            $row = $recentAwayMatches[$i];
            $team1name = '';
            $team2name = '';
            if (isset($this->listTeams[$row['team1id']])) {
                $team1name = $this->listTeams[$row['team1id']]['name'];
            }
            if (isset($this->listTeams[$row['team2id']])) {
                $team2name = $this->listTeams[$row['team2id']]['name'];
            }

            if ($row['team1type'] == 1) {
                $row['homescore'] = $row['betradar_score1'];
                $row['awayscore'] = $row['betradar_score2'];
                $row['team1name'] = $team1name;
                $row['team2name'] = $team2name;
                $row['result_str'] = $row['homescore'] . ":" . $row['awayscore'];
                $row['name_str'] = "vs " . $team2name;
            } else {
                $row['homescore'] = $row['betradar_score2'];
                $row['awayscore'] = $row['betradar_score1'];
                $row['team1name'] = $team1name;
                $row['team2name'] = $team2name;
                $row['result_str'] = $row['awayscore'] . ":" . $row['homescore'];
                $row['name_str'] = "@ " . $team2name;
            }
            $recentAwayMatches[$i] = $row;
        }

        //Store these recent match to global variables to use later
        $this->mainInfo['recentMatches'] = $recentMatches;
        $this->mainInfo['recentHomeMatches'] = $recentHomeMatches;
        $this->mainInfo['recentAwayMatches'] = $recentAwayMatches;

        //Get next 5 matches of home team and away team
        $sql = "SELECT * FROM `sportnews_match` INNER JOIN
(SELECT A.`match_uid`, A.`team_uid` AS team1id, A.type AS team1type,
B.`team_uid` AS team2id, B.`type` AS team2type 
FROM sportnews_match_team AS A INNER JOIN sportnews_match_team AS B 
ON A.`match_uid` = B.`match_uid` AND A.uid <> B.uid WHERE A.`team_uid` IN ('{$homeid}','{$awayid}')
GROUP BY A.`match_uid`) `joinm`
ON sportnews_match.`uid` = joinm.match_uid 
WHERE `sportnews_match`.`date` > $limitDate
ORDER BY `sportnews_match`.`date` ASC";
        $query = $this->db->query($sql);

        $next5HomeMatches = array();
        $next5AwayMatches = array();
        $possibleTeams = array();
        foreach ($query->result_array() as $row) {
            //Get next 5 matches of home team
            if ($row['team1id'] == $homeid) {
                if (count($next5HomeMatches) < 5) {
                    $possibleTeams[] = $row['team1id'];
                    $possibleTeams[] = $row['team2id'];
                    $next5HomeMatches[] = $row;
                }
                continue;
            }

            //Get next 5 matches of away team
            if ($row['team1id'] == $awayid) {
                if (count($next5AwayMatches) < 5) {
                    $possibleTeams[] = $row['team1id'];
                    $possibleTeams[] = $row['team2id'];
                    $next5AwayMatches[] = $row;
                }
                continue;
            }
        }

        //Add more team names
        $this->loadTeams($possibleTeams);

        //Build next 5 home matches
        for ($i = 0; $i < count($next5HomeMatches); $i++) {
            $row = $next5HomeMatches[$i];
            $row['tourname'] = "";
            $tid = intval($row['tournament_uid']);
            if (isset($this->listTournaments[$tid])) {
                $row['tourname'] = strtoupper(substr($this->listTournaments[$tid]['name'], 0, 2));
            }
            $row['date_str'] = date('d.m.Y', $row['date']);
            $team1name = '';
            $team2name = '';
            if (isset($this->listTeams[$row['team1id']])) {
                $team1name = $this->listTeams[$row['team1id']]['name'];
            }
            if (isset($this->listTeams[$row['team2id']])) {
                $team2name = $this->listTeams[$row['team2id']]['name'];
            }

            if ($row['team1type'] == 1) {
                $row['homescore'] = empty($row['betradar_score1'])?"-":$row['betradar_score1'];
                $row['awayscore'] = empty($row['betradar_score2'])?"-":$row['betradar_score2'];
                $row['team1name'] = $team1name;
                $row['team2name'] = $team2name;
                $row['result_str'] = $row['homescore'] . ":" . $row['awayscore'];
                $row['name_str'] = "vs " . $team2name;
            } else {
                $row['homescore'] = empty($row['betradar_score2'])?"-":$row['betradar_score2'];
                $row['awayscore'] = empty($row['betradar_score1'])?"-":$row['betradar_score1'];
                $row['team1name'] = $team1name;
                $row['team2name'] = $team2name;
                $row['result_str'] = $row['awayscore'] . ":" . $row['homescore'];
                $row['name_str'] = "@ " . $team2name;
            }
            $next5HomeMatches[$i] = $row;
        }

        // Build next 5 away matches
        for ($i = 0; $i < count($next5AwayMatches); $i++) {
            $row = $next5AwayMatches[$i];
            $row['tourname'] = "";
            $tid = intval($row['tournament_uid']);
            if (isset($this->listTournaments[$tid])) {
                $row['tourname'] = strtoupper(substr($this->listTournaments[$tid]['name'], 0, 2));
            }
            $row['date_str'] = date('d.m.Y', $row['date']);
            $team1name = '';
            $team2name = '';
            if (isset($this->listTeams[$row['team1id']])) {
                $team1name = $this->listTeams[$row['team1id']]['name'];
            }
            if (isset($this->listTeams[$row['team2id']])) {
                $team2name = $this->listTeams[$row['team2id']]['name'];
            }

            if ($row['team1type'] == 1) {
                $row['homescore'] = empty($row['betradar_score1'])?"-":$row['betradar_score1'];
                $row['awayscore'] = empty($row['betradar_score2'])?"-":$row['betradar_score2'];
                $row['team1name'] = $team1name;
                $row['team2name'] = $team2name;
                $row['result_str'] = $row['homescore'] . ":" . $row['awayscore'];
                $row['name_str'] = "vs " . $team2name;
            } else {
                $row['homescore'] = empty($row['betradar_score2'])?"-":$row['betradar_score2'];
                $row['awayscore'] = empty($row['betradar_score1'])?"-":$row['betradar_score1'];
                $row['team1name'] = $team1name;
                $row['team2name'] = $team2name;
                $row['result_str'] = $row['awayscore'] . ":" . $row['homescore'];
                $row['name_str'] = "@ " . $team2name;
            }
            $next5AwayMatches[$i] = $row;
        }

        $this->mainInfo['next5HomeMatches'] = $next5HomeMatches;
        $this->mainInfo['next5AwayMatches'] = $next5AwayMatches;

        //People of team home and team away
        $sql = "SELECT `sportnews_match_team`.`type`, `sportnews_player`.* 
FROM `sportnews_match` INNER JOIN sportnews_match_team ON  sportnews_match.uid = sportnews_match_team.match_uid
INNER JOIN sportnews_team_player_mm ON sportnews_match_team.team_uid = sportnews_team_player_mm.team_uid
INNER JOIN sportnews_player ON sportnews_player.uid = sportnews_team_player_mm.player_uid 
WHERE `sportnews_match_team`.`type` IN (1,2)
AND sportnews_match.betradar_uid = '{$this->mid}' ORDER BY sportnews_player.shirt_number ASC";
        $query = $this->db->query($sql);
        $this->mainInfo['players'] = array(
            'home' => array('manager' => array(), 'G' => array(), 'D' => array(), 'M' => array(), 'F' => array()),
            'away' => array('manager' => array(), 'G' => array(), 'D' => array(), 'M' => array(), 'F' => array()),
            'lids' => array()
        );
        foreach ($query->result_array() as $row) {
            if ($row['role'] == 'manager') {
                $row['position'] = $row['role'];
            }
            if ($row['role'] == 'player' || $row['role'] == "manager") {
                $this->mainInfo['players']['lids'][] = $row['uid'];
                if ($row['type'] == 1) {
                    if (!isset($this->mainInfo['players']['home'][$row['position']])) {
                        $this->mainInfo['players']['home'][$row['position']] = array();
                    }
                    $this->mainInfo['players']['home'][$row['position']][] = $row;
                } else {
                    if (!isset($this->mainInfo['players']['away'][$row['position']])) {
                        $this->mainInfo['players']['away'][$row['position']] = array();
                    }
                    $this->mainInfo['players']['away'][$row['position']][] = $row;
                }
            }
        }
    }

    public function getStatisticInfo() {
        if ($this->mid <= 0)
            return array();
        $returnArray = array();
        $returnArray = $this->getData();

        return $returnArray;
    }

    public function getData() {
        $arrReturn = array(
            's1' => array(),
            's2' => array(),
            's3' => array(),
            's4' => array(),
            's5' => array(),
            's6' => array(),
            's7' => array(),
            's8' => array(),
            's9' => array(),
            's10' => array(),
            's12' => array(),
            's18' => array(),
        );

        if ($this->getNeccessaryInformation() === FALSE) {
            $arrReturn['main'] = $this->mainInfo;
            return $arrReturn;
        }

        //Get section 1
        $tid = 0;
        $stage = 'stage_type';
        if ($this->sport == 8) {
            $tid = intval($this->mainInfo['leagueid']);
        } else {
            $stage = 'description';
            $tid = intval($this->mainInfo['uniquetournamentid']);
        }
        $arrReturn['s1'] = array('name' => '', 'stage_type' => '', 'matchday' => '', 'stadium' => '', 'date' => '', 'referee' => '');
        if (isset($this->listTournaments[$tid])) {
            $arrReturn['s1']['name'] = $this->listTournaments[$tid]['name'];
            $arrReturn['s1']['stage_type'] = $this->listTournaments[$tid][$stage];
        }
        if (isset($this->mainInfo['VenueStadiumName'])) {
            $arrReturn['s1']['stadium'] = htmlentities($this->mainInfo['VenueStadiumName']);
            if ($arrReturn['s1']['stadium'] == "No name found") {
                $arrReturn['s1']['stadium'] = '';
            }
        }
        if (isset($this->mainInfo['RefereeName'])) {
            $arrReturn['s1']['referee'] = htmlentities($this->mainInfo['RefereeName']);
            if ($arrReturn['s1']['referee']== "No name found") {
                $arrReturn['s1']['referee'] = '';
            }
        }

        $this->db->select('round');
        $query = $this->db->get_where('sportnews_match', array('betradar_uid' => $this->mid));
        if ($query->num_rows() > 0) {
            $arrReturn['s1']['matchday'] = intval($query->row('round'));
        }
        $arrReturn['s1']['date'] = date("d.m.Y H:i", $this->mainInfo['matchdate']);

        //Get section 2
        $arrReturn['s2'] = array();

        //Get section 3
        $arrReturn['s3'] = array('homeimg' => '', 'awayimg' => '', 'homename' => '', 'awayname' => '', 'homecoach' => 'N/A', 'awaycoach' => 'N/A');
        $arrReturn['s3']['homeimg'] = "//www.betitbest.com/fileadmin/user_upload/logos/app_logos/{$this->mainInfo['uniqueTeamHome']}.png";
        $arrReturn['s3']['awayimg'] = "//www.betitbest.com/fileadmin/user_upload/logos/app_logos/{$this->mainInfo['uniqueTeamAway']}.png";
        $arrReturn['s3']['homename'] = htmlentities($this->mainInfo['hometeam']);
        $arrReturn['s3']['awayname'] = htmlentities($this->mainInfo['awayteam']);

        if (isset($this->mainInfo['players']['home']['manager'])) {
            $arrReturn['s3']['homecoach'] = @htmlentities($this->mainInfo['players']['home']['manager'][0]['full_name']);
        }
        if (isset($this->mainInfo['players']['away']['manager'])) {
            $arrReturn['s3']['awaycoach'] = @htmlentities($this->mainInfo['players']['away']['manager'][0]['full_name']);
        }
        if (empty($arrReturn['s3']['homecoach'])) {
            $arrReturn['s3']['homecoach'] = 'N/A';
        }
        if (empty($arrReturn['s3']['awaycoach'])) {
            $arrReturn['s3']['awaycoach'] = 'N/A';
        }

        //Get section 4
        $arrReturn['s4'] = array();
        $arrReturn['s4'] = $this->mainInfo['recentMatches'];

        //Get section 5
        $arrReturn['s5'] = array();

        //Get section 6
        //Get section 6 of home team
        $arrReturn['s6'] = array();
        $arrReturn['s6']['home']['win'] = array(NULL, NULL, NULL, NULL, NULL);
        $arrReturn['s6']['home']['draw'] = array(NULL, NULL, NULL, NULL, NULL);
        $arrReturn['s6']['home']['lost'] = array(NULL, NULL, NULL, NULL, NULL);
        $arrReturn['s6']['home']['data-canvas'] = '';
        for ($i = 0; $i < 5 && $i < count($this->mainInfo['recentHomeMatches']); $i++) {
            if ($this->mainInfo['recentHomeMatches'][$i]['homescore'] > $this->mainInfo['recentHomeMatches'][$i]['awayscore']) {
                $arrReturn['s6']['home']['data-canvas'] = ($i + 1) . ":win;".$arrReturn['s6']['home']['data-canvas'];
                $arrReturn['s6']['home']['win'][$i] = '<span class="opponent tooltipstered" data-match="' . $this->mainInfo['recentHomeMatches'][$i]['name_str'] . '" data-result="' . $this->mainInfo['recentHomeMatches'][$i]['result_str'] . '" style="background-image: url(https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/' . $this->getImageTeam($this->mainInfo['recentHomeMatches'][$i]['team2id']) . '_.png);"></span>';
            } else if ($this->mainInfo['recentHomeMatches'][$i]['homescore'] < $this->mainInfo['recentHomeMatches'][$i]['awayscore']) {
                $arrReturn['s6']['home']['data-canvas'] = ($i + 1) . ":loss;".$arrReturn['s6']['home']['data-canvas'];
                $arrReturn['s6']['home']['lost'][$i] = '<span class="opponent tooltipstered" data-match="' . $this->mainInfo['recentHomeMatches'][$i]['name_str'] . '" data-result="' . $this->mainInfo['recentHomeMatches'][$i]['result_str'] . '" style="background-image: url(https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/' . $this->getImageTeam($this->mainInfo['recentHomeMatches'][$i]['team2id']) . '_.png);"></span>';
            } else {
                $arrReturn['s6']['home']['data-canvas'] = ($i + 1) . ":draw;".$arrReturn['s6']['home']['data-canvas'];
                $arrReturn['s6']['home']['draw'][$i] = '<span class="opponent tooltipstered" data-match="' . $this->mainInfo['recentHomeMatches'][$i]['name_str'] . '" data-result="' . $this->mainInfo['recentHomeMatches'][$i]['result_str'] . '" style="background-image: url(https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/' . $this->getImageTeam($this->mainInfo['recentHomeMatches'][$i]['team2id']) . '_.png);"></span>';
            }
        }
        $arrReturn['s6']['home']['win'] = array_reverse($arrReturn['s6']['home']['win']);
        $arrReturn['s6']['home']['draw'] = array_reverse($arrReturn['s6']['home']['draw']);
        $arrReturn['s6']['home']['lost'] = array_reverse($arrReturn['s6']['home']['lost']);
        

        //Get section 6 of away team
        $arrReturn['s6']['away']['win'] = array(NULL, NULL, NULL, NULL, NULL);
        $arrReturn['s6']['away']['draw'] = array(NULL, NULL, NULL, NULL, NULL);
        $arrReturn['s6']['away']['lost'] = array(NULL, NULL, NULL, NULL, NULL);
        $arrReturn['s6']['away']['data-canvas'] = '';
        for ($i = 0; $i < 5 && $i < count($this->mainInfo['recentAwayMatches']); $i++) {
            if ($this->mainInfo['recentAwayMatches'][$i]['homescore'] > $this->mainInfo['recentAwayMatches'][$i]['awayscore']) {
                $arrReturn['s6']['away']['data-canvas'] = ($i + 1) . ":win;".$arrReturn['s6']['away']['data-canvas'];
                $arrReturn['s6']['away']['win'][$i] = '<span class="opponent tooltipstered" data-match="' . $this->mainInfo['recentAwayMatches'][$i]['name_str'] . '" data-result="' . $this->mainInfo['recentAwayMatches'][$i]['result_str'] . '" style="background-image: url(https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/' . $this->getImageTeam($this->mainInfo['recentAwayMatches'][$i]['team2id']) . '_.png);"></span>';
            } else if ($this->mainInfo['recentAwayMatches'][$i]['homescore'] < $this->mainInfo['recentAwayMatches'][$i]['awayscore']) {
                $arrReturn['s6']['away']['data-canvas'] = ($i + 1) . ":loss;".$arrReturn['s6']['away']['data-canvas'];
                $arrReturn['s6']['away']['lost'][$i] = '<span class="opponent tooltipstered" data-match="' . $this->mainInfo['recentAwayMatches'][$i]['name_str'] . '" data-result="' . $this->mainInfo['recentAwayMatches'][$i]['result_str'] . '" style="background-image: url(https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/' . $this->getImageTeam($this->mainInfo['recentAwayMatches'][$i]['team2id']) . '_.png);"></span>';
            } else {
                $arrReturn['s6']['away']['data-canvas'] = ($i + 1) . ":draw;".$arrReturn['s6']['away']['data-canvas'];
                $arrReturn['s6']['away']['draw'][$i] = '<span class="opponent tooltipstered" data-match="' . $this->mainInfo['recentAwayMatches'][$i]['name_str'] . '" data-result="' . $this->mainInfo['recentAwayMatches'][$i]['result_str'] . '" style="background-image: url(https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/' . $this->getImageTeam($this->mainInfo['recentAwayMatches'][$i]['team2id']) . '_.png);"></span>';
            }
        }
        $arrReturn['s6']['away']['win'] = array_reverse($arrReturn['s6']['away']['win']) ;
        $arrReturn['s6']['away']['draw'] = array_reverse($arrReturn['s6']['away']['draw']);
        $arrReturn['s6']['away']['lost'] = array_reverse($arrReturn['s6']['away']['lost']);

        //Get section 7
        $arrReturn['s7'] = array();
        $arrReturn['s7']['home'] = array_slice($this->mainInfo['recentHomeMatches'], 0, 10);
        $arrReturn['s7']['away'] = array_slice($this->mainInfo['recentAwayMatches'], 0, 10);

        //Get section 8
        $arrReturn['s8'] = array();
        $arrReturn['s8'] = $this->mainInfo['meetings'];

        //Get section 9
        $arrReturn['s9'] = array();
        $arrReturn['s9'] = $this->mainInfo['recentMatches'];

        //Get section 12
        $arrReturn['s12'] = $this->mainInfo['dataLeagues'];
        for ($i = 0; $i < count($arrReturn['s12']); $i++) {
            $arrReturn['s12'][$i]['team_name'] = 'N/A';
            if (isset($this->listTeams[$arrReturn['s12'][$i]['team_uid']])) {
                $arrReturn['s12'][$i]['team_name'] = $this->listTeams[$arrReturn['s12'][$i]['team_uid']]['name'];
            }
			if(isset($arrReturn['s12'][$i]['name']))
				$arrReturn['s12'][$i]['name'] = $this->__renameTeamName($arrReturn['s12'][$i]['name']);
        }

        //Get section 14
        $arrReturn['s14'] = $this->mainInfo['players'];
        $arrReturn['s14']['data_players'] = array();
        $whereIn = "('" . implode("','", $this->mainInfo['players']['lids']) . "')";
        $sql = "SELECT * FROM `sportnews_playerstatistics` "
                . "WHERE `tournament_id` = '{$this->mainInfo['tournament_uid']}' "
                . "AND `season_id` = '{$this->mainInfo['season_uid']}' AND `player_id` IN {$whereIn}";
        unset($this->mainInfo['players']['lids']);
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            if (!isset($arrReturn['s14']['data_players'][$row['player_id']])) {
                $arrReturn['s14']['data_players'][$row['player_id']] = array(
                    'red' => '-',
                    'yellow' => '-',
                    'sentoff' => '-',
                    'played' => '-',
                    'score' => '-'
                );
            }
            if ($row['name'] == "Red cards for team") {
                $arrReturn['s14']['data_players'][$row['player_id']]['red'] = $row['value'];
            }
            if ($row['name'] == "Yellow cards for team") {
                $arrReturn['s14']['data_players'][$row['player_id']]['yellow'] = $row['value'];
            }
            if ($row['name'] == "Yellow/red cards for team") {
                $arrReturn['s14']['data_players'][$row['player_id']]['sentoff'] = $row['value'];
            }
            if ($row['name'] == "Total matches") {
                $arrReturn['s14']['data_players'][$row['player_id']]['played'] = $row['value'];
            }
            if ($row['name'] == "Goals for team") {
                $arrReturn['s14']['data_players'][$row['player_id']]['score'] = $row['value'];
            }
        }
        //Get section 17
        $arrReturn['s17'] = array(
            'full' => array(
                'ahalf' => array('home' => array(0, 0), 'away' => array(0, 0)),
                'oneahalf' => array('home' => array(0, 0), 'away' => array(0, 0)),
                'twoahalf' => array('home' => array(0, 0), 'away' => array(0, 0)),
                'threeahalf' => array('home' => array(0, 0), 'away' => array(0, 0)),
            ),
            'firsthalf' => array(
                'ahalf' => array('home' => array(0, 0), 'away' => array(0, 0)),
                'oneahalf' => array('home' => array(0, 0), 'away' => array(0, 0)),
                'twoahalf' => array('home' => array(0, 0), 'away' => array(0, 0)),
                'threeahalf' => array('home' => array(0, 0), 'away' => array(0, 0)),
            ),
            'secondhalf' => array(
                'ahalf' => array('home' => array(0, 0), 'away' => array(0, 0)),
                'oneahalf' => array('home' => array(0, 0), 'away' => array(0, 0)),
                'twoahalf' => array('home' => array(0, 0), 'away' => array(0, 0)),
                'threeahalf' => array('home' => array(0, 0), 'away' => array(0, 0)),
            ),
            'home_nums' => 0,
            'away_nums' => 0
        );
        $allPossibleMatches = array_merge($this->mainInfo['recentMatches'], $this->mainInfo['recentHomeMatches'], $this->mainInfo['recentAwayMatches']);
        for ($i = 0; $i < count($allPossibleMatches); $i++) {
            if ($allPossibleMatches[$i]['tournament_uid'] == $this->mainInfo['tournament_uid'] &&
                    $allPossibleMatches[$i]['season_uid'] == $this->mainInfo['season_uid']) {
                $item = $allPossibleMatches[$i];
                //If we have the home team
                if ($item['team1id'] == $this->mainInfo['homeid']) {
                    $arrReturn['s17']['home_nums']++;
                    if ($item['homescore'] < 0.5) {
                        $arrReturn['s17']['full']['ahalf']['home'][0] ++;
                    } else {
                        $arrReturn['s17']['full']['ahalf']['home'][1] ++;
                    }

                    if ($item['homescore'] < 1.5) {
                        $arrReturn['s17']['full']['oneahalf']['home'][0] ++;
                    } else {
                        $arrReturn['s17']['full']['oneahalf']['home'][1] ++;
                    }
                    if ($item['homescore'] < 2.5) {
                        $arrReturn['s17']['full']['twoahalf']['home'][0] ++;
                    } else {
                        $arrReturn['s17']['full']['twoahalf']['home'][1] ++;
                    }
                    if ($item['homescore'] < 3.5) {
                        $arrReturn['s17']['full']['threeahalf']['home'][0] ++;
                    } else {
                        $arrReturn['s17']['full']['threeahalf']['home'][1] ++;
                    }
                }
                
                //If we have away team
                if ($item['team1id'] == $this->mainInfo['awayid']) {
                    $arrReturn['s17']['away_nums']++;
                    if ($item['homescore'] < 0.5) {
                        $arrReturn['s17']['full']['ahalf']['away'][0] ++;
                    } else {
                        $arrReturn['s17']['full']['ahalf']['away'][1] ++;
                    }

                    if ($item['homescore'] < 1.5) {
                        $arrReturn['s17']['full']['oneahalf']['away'][0] ++;
                    } else {
                        $arrReturn['s17']['full']['oneahalf']['away'][1] ++;
                    }
                    if ($item['homescore'] < 2.5) {
                        $arrReturn['s17']['full']['twoahalf']['away'][0] ++;
                    } else {
                        $arrReturn['s17']['full']['twoahalf']['away'][1] ++;
                    }
                    if ($item['homescore'] < 3.5) {
                        $arrReturn['s17']['full']['threeahalf']['away'][0] ++;
                    } else {
                        $arrReturn['s17']['full']['threeahalf']['away'][1] ++;
                    }
                }
                
                if ($item['team2id'] == $this->mainInfo['awayid']) {
                    $arrReturn['s17']['away_nums']++;
                    if ($item['awayscore'] < 0.5) {
                        $arrReturn['s17']['full']['ahalf']['away'][0] ++;
                    } else {
                        $arrReturn['s17']['full']['ahalf']['away'][1] ++;
                    }

                    if ($item['awayscore'] < 1.5) {
                        $arrReturn['s17']['full']['oneahalf']['away'][0] ++;
                    } else {
                        $arrReturn['s17']['full']['oneahalf']['away'][1] ++;
                    }
                    if ($item['awayscore'] < 2.5) {
                        $arrReturn['s17']['full']['twoahalf']['away'][0] ++;
                    } else {
                        $arrReturn['s17']['full']['twoahalf']['away'][1] ++;
                    }
                    if ($item['awayscore'] < 3.5) {
                        $arrReturn['s17']['full']['threeahalf']['away'][0] ++;
                    } else {
                        $arrReturn['s17']['full']['threeahalf']['away'][1] ++;
                    }
                }
                
            }
        }
        
        //Get section 18
        for ($i = 0; $i < count($this->mainInfo['dataLeagues']); $i++) {
            if (intval($this->mainInfo['dataLeagues'][$i]['team_uid']) == intval($this->mainInfo['homeid'])) {
                $arrReturn['s18']['home'] = $this->mainInfo['dataLeagues'][$i];
            }
            if (intval($this->mainInfo['dataLeagues'][$i]['team_uid']) == intval($this->mainInfo['awayid'])) {
                $arrReturn['s18']['away'] = $this->mainInfo['dataLeagues'][$i];
            }
        }

        $arrReturn['main'] = $this->mainInfo;

        return $arrReturn;
    }
	
	private function __renameTeamName($name = ''){
		if(strlen($name) <= 15) return $name;
		$names = preg_split("/[\s,_-]+/", $name);
		$count = count($names);
		if($count == 1) return $name;
		if($count == 2) return substr($names[0], 0, 3).' '.$names[1];
		preg_match_all('/(?<=\s|^)[a-z]/i', $name, $matches);
		//-- Remove last first character of $name
		array_pop($matches[0]);
		
		return strtoupper(implode('.', $matches[0])) .' '. end($names);
	}
}
