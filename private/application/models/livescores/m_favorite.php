<?php
//ini_set("memory_limit", "-1");
class M_favorite extends CI_Model {

    private $isFavorite = false;
    private $isLive = false;
    private $sport = false;
    public $sportSeoURL = "";
    private $category = false;
    private $tournament = false;
    private $team = false;
    private $table = 'sportnews_livescores_soccer';
    private $where = "";
    private $htmlTemplates = array("matches-livescores", "matches-livescores-1");
    private $ajax = false;
    private $listCategory = array();
    private $listTournament = array();
    private $listTeams = array();
    private $lang = "en";
    private $acceptTime = 0;
    private $endTime = 0;
    private $loadStyle = true;
    private $noMatch = false;
    private $arrayLanguage = array(
        "Not started" => "Nicht gestartet",
        "1st period" => "1. Drittel",
        "2nd period" => "2. Drittel",
        "3rd period" => "3. Drittel",
        "4th period" => "4. Periode",
        "5th period" => "5. Periode",
        "1st half" => "1. HZ",
        "2nd half" => "2. HZ",
        "1st set" => "1. Satz",
        "2nd set" => "2. Satz",
        "3rd set" => "3. Satz",
        "4th set" => "4. Satz",
        "5th set" => "5. Satz",
        "1st quarter" => "1. Viertel",
        "2nd quarter" => "2. Viertel",
        "3rd quarter" => "3. Viertel",
        "4th quarter" => "4. Viertel",
        "Started" => "Läuft",
        "Break" => "Pause",
        "Halftime" => "Halbzeit",
        "Awaiting extra time" => "Verl.",
        "Extra time halftime" => "Halbzeit Verl.",
        "Awaiting penalties" => "Elfmeterschießen",
        "Overtime" => "Verlängerung",
        "1st extra" => "1. HZ Verlängerung",
        "2nd extra" => "2. HZ Verlängerung",
        "Penalties" => "Elfmeterschießen",
        "Postponed" => "Verschoben",
        "Start delayed" => "Start verzögert",
        "Cancelled" => "abgesagt",
        "Interrupted" => "unterbrochen",
        "Suspended" => "abgebrochen",
        "Abandoned" => "abgebrochen",
        "Walkover" => "Walkover",
        "Retired" => "Aufgegeben",
        "Ended" => "Beendet",
        "AET" => "n.V.",
        "AP" => "n.E.",
        "AGS" => "n.G.S."
    );
    //List acceptable category id at top navbar
    private $topCategories = null;

    public function getTopCategoryIDs() {
        if ($this->topCategories === null)
            $this->getTopCatAndTour();
        return $this->topCategories;
    }

    //List acceptable tournament id at top navbar
    private $topTours = null;

    public function getTopTourIDs() {
        if ($this->topTours === null)
            $this->getTopCatAndTour();
        return $this->topTours;
    }

    //List unique tournament
    private $topUniqueTour = null;

    public function getTopUniqueIDs() {
        if ($this->topUniqueTour === null)
            $this->getTopCatAndTour();
        return $this->topUniqueTour;
    }

    //Get all posible cat and tour
    private function getTopCatAndTour() {
        //Get star time and end time
        $this->getAcceptTime();

        //Get table name
        $this->generateSQLForLive();

        $this->db->select('uniquetournamentid, categoryid, leagueid');

        $query = $this->db->get($this->table);
        $this->topUniqueTour = array();
        $this->topTours = array();
        $this->topCategories = array();
        foreach ($query->result_array() as $row) {
            $this->topUniqueTour[$row['uniquetournamentid']] = $row['uniquetournamentid'];
            $this->topTours[$row['leagueid']] = $row['leagueid'];
            $this->topCategories[$row['categoryid']] = $row['categoryid'];
        }
    }

    public function filterTopCats($arr, $catId = 0) {
        if ($this->topCategories === null)
            $this->getTopCatAndTour();

        $dataReturn = array();
        for ($i = 0; $i < count($arr); $i++) {
            if (isset($this->topCategories[intval($arr[$i]['betradar_uid'])]) || (intval($arr[$i]['uid']) == intval($catId))) {
                $dataReturn[] = $arr[$i];
            }
        }
        return $dataReturn;
    }

    public function filterTopTours($arr, $catid = 0, $tID = 0, $type = 'unique_tournament') {
        if ($this->topCategories === null)
            $this->getTopCatAndTour();

        $catid = intval($catid);
        if ($catid > 0) {
            $query = $this->db->query("SELECT `betradar_uid` FROM `sportnews_category` WHERE `uid` = '{$catid}'");
            if ($query->num_rows() > 0)
            {
                $catid = intval($query->row('betradar_uid'));
            }
            else
            {
                $catid = 0;
            }
        }

        $listSeoUrls = array();
        for ($i = 0; $i < count($arr); $i++) {
            $listSeoUrls[$arr[$i]['seourl']] = $arr[$i];
        }

        if (count($listSeoUrls) > 0) {
            $keys = array_keys($listSeoUrls);
            $whereIn = " ('" . implode("','", $keys) . "') ";
            $table_query = 'sportnews_unique_tournament';
            if ($this->sport == 8)
                $table_query = 'sportnews_tournament';
            $query = $this->db->query("SELECT `seourl`, `betradar_uid` FROM `{$table_query}` WHERE `seourl` IN {$whereIn}");
            $query1 = $this->db->query("SELECT `seourl` FROM `{$table_query}` WHERE `uid` = '{$tID}'");
            $curl = '';
            if ($query1->num_rows() > 0) {
                $curl = $query1->row('seourl');
            }
            foreach ($query->result_array() as $row) {
                if (isset($listSeoUrls[$row['seourl']])) {
                    $dataReturn[$row['betradar_uid']] = $listSeoUrls[$row['seourl']];
                }
            }
        }

        if (count($dataReturn) > 0) {
            $keys = array_keys($dataReturn);
            $strIn = "(" . implode(",", $keys) . ")";
            $field = '';
            $where = '';
            if ($this->sport != 8) {
                $field = 'DISTINCT `uniquetournamentid` AS `key` ';
                $where = " `uniquetournamentid` in {$strIn}";
                if (intval($catid) > 0) {
                    $catid = intval($catid);
                    $where .= " AND categoryid = {$catid} ";
                }
            } else {
                $field = 'DISTINCT `leagueid` AS `key` ';
                $where = " `leagueid` in {$strIn}";
                if (intval($catid) > 0) {
                    $where .= " AND categoryid = {$catid} ";
                }
            }
            $sql = "SELECT {$field} FROM {$this->table} WHERE {$where} ";
            $query = $this->db->query($sql);
            $arrR = array();
            foreach ($query->result_array() as $row) {
                if (isset($dataReturn[$row['key']])) {
                    $arrR[] = $dataReturn[$row['key']];
                }
            }

            $dataReturn = array();
            foreach ($arrR as $item) {
                $dataReturn[$item['seourl']] = $item;
            }
            $dataReturn = array_values($dataReturn);
        }

        return $dataReturn;
    }

    public function setSportData($sportID) {
        $this->sport = $sportID;
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
            case 4:
                $this->sportSeoURL = "rugby";
                break;
            default:
                $this->sportSeoURL = "soccer";
                $this->sport = 7;
                break;
        }
        return $this->sportSeoURL;
    }

    public function buildWhereFromOutSide($categories = array(), $tournaments = array(), $teams = array()) {
        $this->loadStyle = true;
        $this->where = "";
        if (count($categories) > 0) {
            $whereIn = "(" . implode(",", $categories) . ")";
            $query = $this->db->query("SELECT `betradar_uid` FROM `sportnews_category` WHERE `uid` IN {$whereIn}");
            if ($query->num_rows() > 0) {
                $strIn = "";
                foreach ($query->result_array() as $row) {
                    $strIn .= $row['betradar_uid'] . ",";
                }
                $strIn = "(" . substr($strIn, 0, -1) . ")";
                $this->where .= " `categoryid` in {$strIn} OR";
            }
        }

        if (count($tournaments) > 0) {
            $whereIn = "(" . implode(",", $tournaments) . ")";
            $table_query = 'sportnews_unique_tournament';
            if ($this->sport == 8) {
                $table_query = 'sportnews_tournament';
            }
            $query = $this->db->query("SELECT `betradar_uid` FROM `{$table_query}` WHERE `uid` IN {$whereIn} ");
            if ($query->num_rows() > 0) {
                $strIn = "";
                foreach ($query->result_array() as $row) {
                    $strIn .= $row['betradar_uid'] . ",";
                }
                $strIn = "(" . substr($strIn, 0, -1) . ")";
                if ($this->sport != 8)
                    $this->where .= " `uniquetournamentid` in {$strIn} OR";
                else
                    $this->where .= " `leagueid` in {$strIn} OR";
            }
        }

        if (count($teams) > 0) {
            $whereIn = "(" . implode(",", $teams) . ")";
            $query = $this->db->query("SELECT `betradar_uid` FROM `sportnews_team` WHERE `uid` IN {$whereIn}");
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $this->where .= " (`uniqueTeamHome` = CONCAT('{$row['betradar_uid']}','_') OR `uniqueTeamAway` = CONCAT('{$row['betradar_uid']}','_')) OR";
                }
            }
        }

        $this->where .= $this->generateAutoLoadWhere();

        if ($this->where != "") {
            $this->where = " WHERE (" . substr($this->where, 0, -2).")";
        } else {
            $this->where = " WHERE 0 = 1 ";
        }
    }

    public function setFavorite($value = true) {
        $this->isFavorite = $value;
    }

    public function isNoMatch() {
        return $this->noMatch;
    }

    private $displaySportLayouts = array(
        8 => array(
            'titles' => array('ST', '1', '2', '3', '4', '5', 'PT'),
            'fields_home' => array('scorehome', 'p1_scorehome', 'p2_scorehome', 'p3_scorehome', 'p4_scorehome', 'p5_scorehome', 'pointhome'),
            'fields_away' => array('scoreaway', 'p1_scoreaway', 'p2_scoreaway', 'p3_scoreaway', 'p4_scoreaway', 'p5_scoreaway', 'pointaway')
        ),
        3 => array(
            'titles' => array('1', '2', '3', 'PT'),
            'fields_home' => array('q1_scorehome', 'q2_scorehome', 'q3_scorehome', 'scorehome'),
            'fields_away' => array('q1_scoreaway', 'q2_scoreaway', 'q3_scoreaway', 'scoreaway')
        ),
        6 => array(
            'titles' => array('1', '2', '3', '4', 'PT'),
            'fields_home' => array('q1_scorehome', 'q2_scorehome', 'q3_scorehome', 'q4_scorehome', 'scorehome'),
            'fields_away' => array('q1_scoreaway', 'q2_scoreaway', 'q3_scoreaway', 'q4_scoreaway', 'scoreaway')
        ),
        1 => array(
            'titles' => array('1', '2', '3', '4', 'PT'),
            'fields_home' => array('q1_scorehome', 'q2_scorehome', 'q3_scorehome', 'q4_scorehome', 'scorehome'),
            'fields_away' => array('q1_scoreaway', 'q2_scoreaway', 'q3_scoreaway', 'q4_scoreaway', 'scoreaway')
        )
    );
    private $liveStatus = array(
        7 => array(
            "Halftime",
            "Awaiting extra time",
            "Extra time halftime",
            "Awaiting penalties",
            "1st half",
            "2nd half",
            "1st extra",
            "2nd extra",
            "Penalties"
        ),
        2 => array(
            "Halftime",
            "Awaiting extra time",
            "Extra time halftime",
            "Awaiting penalties",
            "1st half",
            "2nd half",
            "1st extra",
            "2nd extra",
            "Penalties"
        ),
        8 => array(
            "1st set",
            "2nd set",
            "3rd set",
            "4th set",
            "5th set",
            "Interrupted",
        ),
        9 => array(
            "1st set",
            "2nd set",
            "3rd set",
            "4th set",
            "5th set",
            "Interrupted",
            "Golden set",
            "GS",
        ),
        6 => array(
            "Halftime",
            "Awaiting extra time",
            "1st quarter",
            "2nd quarter",
            "3rd quarter",
            "4th quarter",
            "Pause",
            "Overtime",
        ),
        1 => array(
            "Halftime",
            "Awaiting extra time",
            "1st quarter",
            "2nd quarter",
            "3rd quarter",
            "4th quarter",
            "Pause",
            "Overtime",
        ),
        3 => array(
            "Pause",
            "Awaiting extra time",
            "Extra time halftime",
            "Awaiting penalties",
            "1st period",
            "2nd period",
            "3rd period",
            "Overtime",
            "1st extra",
            "2nd extra",
            "Penalties",
        ),
        4 => array(
            "Halftime",
            "Awaiting extra time",
            "1st quarter",
            "2nd quarter",
            "3rd quarter",
            "4th quarter",
            "Pause",
            "Overtime",
        )
    );

    public function __construct() {
        parent::__construct();
        $this->load->model('livescores/m_sport', 'sport_mode', true);
        $this->load->model('livescores/m_category', 'category_mode', true);
        $this->load->model('livescores/m_tournament', 'tournament_mode', true);
        $this->load->model('livescores/m_team', 'team_mode', true);
        $this->load->helper('cache');
    }

    public function setAjax($value) {
        $this->ajax = $value;
    }

    public function setStyle($value) {
        $this->loadStyle = $value;
    }

    public function getTemplate() {
        if ($this->sportSeoURL == "tennis" || $this->sportSeoURL == "basketball" || $this->sportSeoURL == "ice-hockey" || $this->sportSeoURL == "football") {
            return $this->htmlTemplates[1];
        }
        return $this->htmlTemplates[0];
    }

    public function setSport($team) {
        $tArray = explode("-", $team);
        $team = $this->team_mode->get_by_betradar_uid($tArray[count($tArray) - 1]);

        if (!$tournament = $this->cache->get('tournament_by_team_' . $team['uid'] . '_maintn_' . $team['main_tournament_uid']
                . '_mainuntn_' . $team['main_unique_tournament_uid'])
        ) {
            $tournament = $this->tournament_mode->get_by_team($team['uid'], $team['main_tournament_uid'], $team['main_unique_tournament_uid']);
            $this->cache->write($tournament, 'tournament_by_team_' . $team['uid'] . '_maintn_' . $team['main_tournament_uid'] . '_mainuntn_'
                    . $team['main_unique_tournament_uid'], 3600);
        }

        if (!$category = $this->cache->get('category_by_tournament_' . $tournament['category_uid'] . '_main_catuid_'
                . $team['main_category_uid'])
        ) {
            $category = $this->category_mode->get_single($tournament['category_uid'], $team['main_category_uid']);
            $this->cache->write($category, 'category_by_tournament_' . $tournament['category_uid'] . '_main_catuid_'
                    . $team['main_category_uid'], 3600);
        }

        if (!$sport = $this->cache->get('sport_' . $category['sport_uid'])) {
            $sport = $this->sport_mode->get_single($category['sport_uid']);
            $this->cache->write($sport, 'sport_' . $category['sport_uid'], 3600);
        }
        $this->sportSeoURL = 'soccer';
        if (isset($sport['seourl']))
            $this->sportSeoURL = $sport['seourl'];
        switch ($this->sportSeoURL) {
            case "soccer":
                $this->sport = 7;
                break;
            case "tennis":
                $this->sport = 8;
                break;
            case "handball":
                $this->sport = 2;
                break;
            case "basketball":
                $this->sport = 1;
                break;
            case "ice-hockey":
                $this->sport = 3;
                break;
            case "football":
                $this->sport = 6;
                break;
            case "volleyball":
                $this->sport = 9;
                break;
            case "rugby":
                $this->sport = 4;
                break;
        }
    }

    public function getListCategory() {
        $query = $this->db->query("SELECT `betradar_uid`, `seourl` FROM `sportnews_category`");
        foreach ($query->result_array() as $row) {
            $this->listCategory[$row['betradar_uid']] = $row['seourl'];
        }
        return $this;
    }

    public function getTournament() {
        if ($this->sportSeoURL == "tennis") {
            $query = $this->db->query("SELECT `betradar_uid`, `seourl` FROM `sportnews_tournament`");
            foreach ($query->result_array() as $row) {
                $this->listTournament[$row['betradar_uid']] = $row['seourl'];
            }
        } else {
            $query = $this->db->query("SELECT `betradar_uid`, `seourl` FROM `sportnews_unique_tournament`");
            foreach ($query->result_array() as $row) {
                $this->listTournament[$row['betradar_uid']] = $row['seourl'];
            }
        }
        return $this;
    }

    public function getTeams() {
        $query = $this->db->query('SELECT `betradar_uid`, `seourl` FROM `sportnews_team` 
INNER JOIN `sportnews_sport_team` ON `sportnews_sport_team`.`team_uid` = `sportnews_team`.`uid`
WHERE `sport_uid` = ' . $this->sport);
        foreach ($query->result_array() as $row) {
            $this->listTeams[$row['betradar_uid'] . "_"] = $row['seourl'];
        }
    }

    public function extractWhereInformation($arr) {
        if (isset($arr[1]))
            $this->lang = $arr[1];

        if (isset($arr[2]) && $arr[2] != "teams") {
            $this->sportSeoURL = $arr[2];
            switch ($this->sportSeoURL) {
                case "soccer":
                    $this->sport = 7;
                    break;
                case "tennis":
                    $this->sport = 8;
                    break;
                case "handball":
                    $this->sport = 2;
                    break;
                case "basketball":
                    $this->sport = 1;
                    break;
                case "ice-hockey":
                    $this->sport = 3;
                    break;
                case "football":
                    $this->sport = 6;
                    break;
                case "volleyball":
                    $this->sport = 9;
                    break;
                case "rugby":
                    $this->sport = 4;
                break;
            }
        }

        if (isset($arr[2]) && $arr[2] == "teams") {
            //Get team name to build the where filter
            if (isset($arr[3])) {
                $this->setSport($arr[3]);
                $this->team = $arr[3];
                $query = $this->db->query("SELECT `betradar_uid` FROM `sportnews_team` WHERE `seourl`= '{$this->team}'");
                if ($query->num_rows() > 0) {
                    foreach ($query->result_array() as $row) {
                        $this->where .= " (`uniqueTeamHome` = CONCAT('{$row['betradar_uid']}','_') OR `uniqueTeamAway` = CONCAT('{$row['betradar_uid']}','_')) AND";
                    }
                } else {
                    $this->where .= " 0 = 1 AND";
                }
            } else {
                return false;
            }
        } else {
            //Get team name to build the where filter
            if (isset($arr[5])) {
                $this->team = $arr[5];
                $query = $this->db->query("SELECT `betradar_uid` FROM `sportnews_team` WHERE `seourl`= '{$this->team}'");
                if ($query->num_rows() > 0) {
                    foreach ($query->result_array() as $row) {
                        $this->where .= " (`uniqueTeamHome` = CONCAT('{$row['betradar_uid']}','_') OR `uniqueTeamAway` = CONCAT('{$row['betradar_uid']}','_')) AND";
                    }
                } else {
                    $this->where .= " 0 = 1 AND";
                }
                if ($this->where != "") {
                    $this->where = " WHERE " . substr($this->where, 0, -3);
                }
                return true;
            }


            //Get category name to build the where filter
            if (isset($arr[3])) {
                $this->category = $arr[3];
                $query = $this->db->query("SELECT `betradar_uid` FROM `sportnews_category` WHERE `seourl` = '{$this->category}'");
                if ($query->num_rows() > 0) {
                    $strIn = "";
                    foreach ($query->result_array() as $row) {
                        $strIn .= $row['betradar_uid'] . ",";
                    }
                    $strIn = "(" . substr($strIn, 0, -1) . ")";
                    $this->where .= " `categoryid` in {$strIn} AND";
                } else {
                    $this->where .= " 0 = 1 AND";
                }
            }

            //Get tourname to build where filter
            if (isset($arr[4])) {
                $this->tournament = $arr[4];
                $table_query = 'sportnews_unique_tournament';
                if ($this->sport == 8)
                    $table_query = 'sportnews_tournament';
                $query = $this->db->query("SELECT `betradar_uid` FROM `{$table_query}` WHERE `seourl` LIKE '{$this->tournament}' ");
                if ($query->num_rows() > 0) {
                    $strIn = "";
                    foreach ($query->result_array() as $row) {
                        $strIn .= $row['betradar_uid'] . ",";
                    }
                    $strIn = "(" . substr($strIn, 0, -1) . ")";
                    if ($this->sport != 8)
                        $this->where .= " `uniquetournamentid` in {$strIn} AND";
                    else
                        $this->where .= " `leagueid` in {$strIn} AND";
                } else {
                    $this->where .= " 0 = 1 AND";
                }
            }
        }

        $this->where .= $this->generateAutoLoadWhere();

        if ($this->where != "") {
            $this->where = " WHERE " . substr($this->where, 0, -3);
        }
        return true;
    }

    private function generateAutoLoadWhere() {
        if ($this->input->get_post('autoload') == 'yes') {
            $list = $this->input->get_post('mids');
            $a = " `matchstatus` IN ('" . implode("','", $this->liveStatus[$this->sport]) . "') ";
            if (is_array($list) && count($list) > 0) {
                $a .= " OR `matchid` IN ('" . implode("','", $list) . "') ";
            }
            $a = " ({$a}) AND";
            return $a;
        } else if ($this->input->get_post('isFavourite') == "yes") {
            $list = $this->input->get_post(strtolower(str_replace('-', '', $this->sportSeoURL)) + "_alists");
            if ($list == FALSE)
                return '';
            $a = " `matchstatus` IN ('" . implode("','", $this->liveStatus[$this->sport]) . "') ";
            if (is_array($list) && count($list) > 0) {
                $a .= " OR `matchid` IN ('" . implode("','", $list) . "') ";
            }
            $a = " ({$a}) AND";
            return $a;
        }
    }

    private function generateSQLForLive() {
        //Hard code data
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

        //Determine which table to use for live match
        if (isset($arrData[intval($this->sport)])) {
            $this->table = $arrData[intval($this->sport)];
        }
    }

    public function setIsLive($value) {
        $this->isLive = $value;
    }

    public function getAcceptTime() {
        if ($this->acceptTime <= 0) {
            if ($this->ajax) {
                $this->acceptTime = intval($this->input->get_post('accepttime'));
            } else {
                $this->acceptTime = time() - (4 * 60 * 60);
            }
        }
        $this->endTime = $this->acceptTime + (28 * 60 * 60);
        return $this->acceptTime;
    }

    public function get($limit = 100, $offset = 0, $sport = false, $category = false, $tournament = false, $team = false) {
        if ($sport != FALSE) {
            $this->sport = $sport;
        }
        $this->getListCategory();
        $this->getTournament();
        $this->getTeams();
        $dataReturn = array();

        $this->generateSQLForLive();

        $sortDirection = $this->loadStyle ? "ASC" : "DESC";
        
        //Build where clause up to the request parameters
        if ($this->where == "") $this->where = 'WHERE 1 = 1';
        $startTime = time() - 4*86400;
        $endTime = time() + 4*86400;
        
        $this->where .= " AND matchdate > '".$startTime."'";
        $this->where .= " AND matchdate <= '".$endTime."'";
        
        if ($this->isLive) {
            $this->where .= " AND matchstatus IN ('".implode("','", $this->liveStatus[$this->sport])."')";
        }
        
        $query = $this->db->query("SELECT * FROM `{$this->table}`" . $this->where . " ORDER BY `matchdate` {$sortDirection} ".($this->isFavorite?"":" LIMIT {$offset}, {$limit}"));
        $i = 0;
        foreach ($query->result_array() as $row) {
            $row['date'] = $row['matchdate'];
            $row['homeurl'] = "";
            $row['awayurl'] = "";
            if (isset($this->listTeams[$row['uniqueTeamHome']])) {
                $row['homeurl'] = $this->listTeams[$row['uniqueTeamHome']];
            }
            if (isset($this->listTeams[$row['uniqueTeamAway']])) {
                $row['awayurl'] = $this->listTeams[$row['uniqueTeamAway']];
            }

            if (!$this->isFavorite) {
                //Limit item to display
                if (count($dataReturn) == $limit) {
                    $dataReturn = $this->formatDataBeforeReturn($dataReturn);
                    return $dataReturn;
                }

                $i++;
                if ($i < $offset + 1)
                    continue;
            }

            $row['league_url'] = "#";
            if ($this->sportSeoURL == "tennis") {
                if (isset($row['categoryid']) && $row['categoryid'] != NULL && isset($row['leagueid']) && $row['leagueid'] != NULL) {
                    $row['categoryid'] = intval($row['categoryid']);
                    $row['leagueid'] = intval($row['leagueid']);
                    if (isset($this->listCategory[$row['categoryid']]) && isset($this->listTournament[$row['leagueid']]))
                        $row['league_url'] = base_url() . $this->lang . "/" . $this->sportSeoURL . "/" . $this->listCategory[$row['categoryid']] . "/" . $this->listTournament[$row['leagueid']];
                }
                $row['maintourid'] = $row['leagueid'];
            }
            else {
                if (isset($row['categoryid']) && $row['categoryid'] != NULL && isset($row['uniquetournamentid']) && $row['uniquetournamentid'] != NULL) {
                    $row['categoryid'] = intval($row['categoryid']);
                    $row['uniquetournamentid'] = intval($row['uniquetournamentid']);
                    if (isset($this->listCategory[$row['categoryid']]) && isset($this->listTournament[$row['uniquetournamentid']]))
                        $row['league_url'] = base_url() . $this->lang . "/" . $this->sportSeoURL . "/" . $this->listCategory[$row['categoryid']] . "/" . $this->listTournament[$row['uniquetournamentid']];
                }
                $row['maintourid'] = $row['uniquetournamentid'];
            }
            $row['category_url'] = base_url() . $this->lang . "/" . $this->sportSeoURL . "/" . $this->listCategory[$row['categoryid']];
            
            if (dblang('category_' . @$this->listCategoryConvertIDs[$row['categoryid']] . '_name') != 'category_' . @$this->listCategoryConvertIDs[$row['categoryid']] . '_name') {
                $row['country'] = dblang('category_' . @$this->listCategoryConvertIDs[$row['categoryid']] . '_name');
            }
            if ($this->sportSeoURL == "tennis") {
                $trans = dblang('tournament_' . @$this->listTournamentConvertIDs[$row['maintourid']] . '_name');
                if ($trans != 'tournament_' . @$this->listTournamentConvertIDs[$row['maintourid']] . '_name') {
                    $row['league'] = $trans;
                }
            } else {
                $trans = dblang('unique_tournament_' . @$this->listTournamentConvertIDs[$row['maintourid']] . '_name');
                if ($trans != 'unique_tournament_' . @$this->listTournamentConvertIDs[$row['maintourid']] . '_name') {
                    $row['league'] = $trans;
                }
            }
            
            
            $row['homeurl'] = $row['league_url'] . "/" . $row['homeurl'];
            $row['awayurl'] = $row['league_url'] . "/" . $row['awayurl'];
            
            if ($this->isLive && $row['league_url'] != "#") {
                $row['league_url'] .= "/live";
            }

            if (!isset($row['scoredby']))
                $row['scoredby'] = "";
            if (strpos($row['matchstatus'], "Not started") !== FALSE) {
                $row['scorehome'] = "-";
                $row['scoreaway'] = "-";
            }

            $row['uid'] = $row['matchid'];
            $row['betradar_uid'] = $row['matchid'];
            $row['team1_name'] = $row['hometeam'];
            $row['team2_name'] = $row['awayteam'];
            $row['ostatus'] = $row['matchstatus'];
            $row['date_dm'] = date("d.m", $row['date']);
            $row['date_hi'] = date("H:i", $row['date']);
            $this->calculateMinutes($row);
            $row['matchstatus'] = $this->convertLanguage($row['matchstatus']);
            $this->generateLayoutForEachSport($row);
            $this->generateLayoutForAllSport($row);

            if (!isset($row['lastteamscored']))
                $row['lastteamscored'] = 'N/A';
            $dataReturn[] = $row;
        }

        if (count($dataReturn) == 0 && !$this->ajax && !$this->isLive && $query->num_rows() > 0) {
            $re = $query->result_array();
            $row = $re[count($re) - 1];
            $dataReturn[] = $this->buildFirstRow($row);
        }

        $dataReturn = $this->formatDataBeforeReturn($dataReturn);
        return $dataReturn;
    }

    private function generateLayoutForAllSport(&$row) {
        $row['img1'] = 'https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/' . $row['uniqueTeamHome'] . '.png';
        $row['img2'] = 'https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/' . $row['uniqueTeamAway'] . '.png';
        $row['imglive'] = "";
        if (in_array($row['ostatus'], $this->liveStatus[$this->sport])) {
            $row['imglive'] = "&nbsp;<span style='position:relative;'>&nbsp;&nbsp;&nbsp;<img class='img_live' style='position:absolute;top:-3px;left:-1px;'  src='https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/blink.gif'/></span>&nbsp;";
        }
        $row['league'] = "<a class='tournament_filter' style='text-decoration: none; color: #000;' href='{$row['league_url']}'>" . htmlentities($row['league']) . "</a>";
        $row['statistic_button'] = "<button style='margin-top: 50%; margin-left: 5px;padding: 4px;font-size: 10px;border-radius: 3px;box-shadow: none;border: none; border: none !important; background: none !important; 'type='button' onclick='alert(\"Comming Soon\")'><i class='statsHandle fa fa-bar-chart' style='font-size: 20px;'></i></button>";
        if ($this->sport == 7)
        {
            $row['statistic_button'] = "<button style='margin-top: 50%; margin-left: 5px;padding: 4px;font-size: 10px;border-radius: 3px;box-shadow: none;border: none; border: none !important; background: none !important; 'type='button' onclick='openBoxStats({$row['matchid']}, this)'><i class='statsHandle fa fa-bar-chart' style='font-size: 20px;'></i></button>";
        }
    }

    private function calculateMinutes(&$line) {
        if ($this->sport != 7)
            return;
        $minsinsession = round((time() - $line['lastperioddate']) / 60);
        $line['show_scoreby'] = false;
        if ((intval($line['scoremin']) - $minsinsession) <= 1 && (intval($line['scoremin']) - $minsinsession) >= 0) {
            $line['show_scoreby'] = true;
        }
        if ($line['matchstatus'] == "1st half") {
            $line['time'] = $minsinsession . " min.";
        } else if ($line['matchstatus'] == "2nd half") {
            $line['time'] = ($minsinsession + 45) . " min.";
        } else if ($line['matchstatus'] == "Halftime" || $line['matchstatus'] == "Not started" || $line['matchstatus'] == "AET" || $line['matchstatus'] == "Ended" || $line['matchstatus'] == "Postponed" || $line['matchstatus'] == "Cancelled" || $line['matchstatus'] == "Start delayed"
        ) {
            
        } else {
            $minsinsession++;
            $line['time'] = $minsinsession;
        }
    }

    private function generateLayoutForEachSport(&$row) {
        if ($this->sport == 8 || $this->sport == 1 || $this->sport == 6 || $this->sport == 3) {
            $row['titles'] = $this->displaySportLayouts[$this->sport]['titles'];
            $homeFields = $this->displaySportLayouts[$this->sport]['fields_home'];
            $awayFields = $this->displaySportLayouts[$this->sport]['fields_away'];
            $row['team1_details'] = array();
            $row['team2_details'] = array();

            if (!$this->isLive) {
                $row['matchstatus'] = date("d.m", $row['date']) . "&nbsp;-&nbsp;" . date("H:i", $row['date']) . "&nbsp;|&nbsp;" . $row['matchstatus'];
            }

            if ($this->sport == 8) {
                if (intval($row['pointhome']) >= 50)
                    $row['pointhome'] = "AD";
                if (intval($row['pointaway']) >= 50)
                    $row['pointaway'] = "AD";
            }
            for ($i = 0; $i < count($homeFields); $i++) {
                $row['team1_details'][] = $row[$homeFields[$i]];
            }

            for ($i = 0; $i < count($awayFields); $i++) {
                $row['team2_details'][] = $row[$awayFields[$i]];
            }

            if (($row['winner'] == 1 || $row['winner'] == "1") && !$this->isLive) {
                $row['team1_name'].= "</div><div class='large-left'><img style='width: 20px;height: 20px;margin-top: 16px;' src='https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/star.png'/>";
            }
            if (($row['winner'] == 2 || $row['winner'] == "2") && !$this->isLive) {
                $row['team2_name'].= "</div><div class='large-left'><img style='width: 20px;height: 20px;margin-top: 16px;' src='https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/star.png'/>";
            }
        }

        if ($this->sport == 8 && (in_array($row['ostatus'], $this->liveStatus[$this->sport]))) {
            if (($row['servingplayer'] == 1 || $row['servingplayer'] == "1")) {
                $row['team1_name'].= "</div><div class='large-left'><img style='width: 20px;height: 20px;margin-top: 16px;' src='https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/tennis.png'/>";
            }
            if (($row['servingplayer'] == 2 || $row['servingplayer'] == "2")) {
                $row['team2_name'].= "</div><div class='large-left'><img style='width: 20px;height: 20px;margin-top: 16px;' src='https://www.betitbest.com/fileadmin/user_upload/logos/app_logos/tennis.png'/>";
            }
        }

        if ($this->sport == 1 || $this->sport == 6) {
            if (($row['winner'] == 1 || $row['winner'] == "1") && !$this->isLive) {
                $row['matchstatus'] = "Winner: " . $row['hometeam'];
            }
            if (($row['winner'] == 2 || $row['winner'] == "2") && !$this->isLive) {
                $row['matchstatus'] = "Winner: " . $row['awayteam'];
            }
        }

        if ($this->sport == 7) {
            if ($this->isLive && $row['scoredby'] != "" && $row['scoredby'] != null && $row['show_scoreby']) {
                $row['scoredby'] = "<span class='show_scoreby'>&nbsp;/&nbsp;" . $row['scoredby'] . "</span>";
            } else {
                $row['scoredby'] = "";
            }
        }
    }

    private function buildFirstRow($row) {
        $this->noMatch = true;
        $row['homeurl'] = "";
        $row['awayurl'] = "";
        if (isset($this->listTeams[$row['uniqueTeamHome']])) {
            $row['homeurl'] = $this->listTeams[$row['uniqueTeamHome']];
        }
        if (isset($this->listTeams[$row['uniqueTeamAway']])) {
            $row['awayurl'] = $this->listTeams[$row['uniqueTeamAway']];
        }
        $row['date'] = $row['matchdate'];
        $this->acceptTime = intval($row['matchdate']);
        
        $row['league_url'] = "#";
        if ($this->sportSeoURL == "tennis") {
            if (isset($row['categoryid']) && $row['categoryid'] != NULL && isset($row['leagueid']) && $row['leagueid'] != NULL) {
                $row['categoryid'] = intval($row['categoryid']);
                $row['leagueid'] = intval($row['leagueid']);
                if (isset($this->listCategory[$row['categoryid']]) && isset($this->listTournament[$row['leagueid']]))
                    $row['league_url'] = base_url() . $this->lang . "/" . $this->sportSeoURL . "/" . $this->listCategory[$row['categoryid']] . "/" . $this->listTournament[$row['leagueid']];
            }
        }
        else {
            if (isset($row['categoryid']) && $row['categoryid'] != NULL && isset($row['uniquetournamentid']) && $row['uniquetournamentid'] != NULL) {
                $row['categoryid'] = intval($row['categoryid']);
                $row['uniquetournamentid'] = intval($row['uniquetournamentid']);
                if (isset($this->listCategory[$row['categoryid']]) && isset($this->listTournament[$row['uniquetournamentid']]))
                    $row['league_url'] = base_url() . $this->lang . "/" . $this->sportSeoURL . "/" . $this->listCategory[$row['categoryid']] . "/" . $this->listTournament[$row['uniquetournamentid']];
            }
        }

        $row['homeurl'] = $row['league_url'] . "/" . $row['homeurl'];
        $row['awayurl'] = $row['league_url'] . "/" . $row['awayurl'];
        
        if ($this->isLive && $row['league_url'] != "#")
            $row['league_url'] .= "/live";
        
        if (!isset($row['scoredby']))
            $row['scoredby'] = "";
        if (strpos($row['matchstatus'], "Not started") !== FALSE) {
            $row['scorehome'] = "-";
            $row['scoreaway'] = "-";
        }

        $row['uid'] = $row['matchid'];
        $row['betradar_uid'] = $row['matchid'];
        $row['team1_name'] = $row['hometeam'];
        $row['team2_name'] = $row['awayteam'];
        $row['ostatus'] = $row['matchstatus'];
        $row['date_dm'] = date("d.m", $row['date']);
        $row['date_hi'] = date("H:i", $row['date']);
        $this->calculateMinutes($row);
        $this->generateLayoutForEachSport($row);
        $this->generateLayoutForAllSport($row);

        if (!isset($row['lastteamscored']))
            $row['lastteamscored'] = 'N/A';
        return $row;
    }

    function convertLanguage($str) {
        if ($this->lang != "en" && isset($this->arrayLanguage[$str])) {
            return $this->arrayLanguage[$str];
        } else
            return $str;
    }

    function formatDataBeforeReturn($data) {
        if (($this->sport == 8 || $this->sport == 1 || $this->sport == 6 || $this->sport == 3) && $this->input->get_post('autoload') === FALSE && $this->input->get_post('isFavourite') === FALSE) {
            $field = 'uniquetournamentid';
            if ($this->sport == 8) {
                $field = 'leagueid';
            }
            $dReturn = array();
            $dataReturn = array();
            for ($i = 0; $i < count($data); $i++) {
                if (isset($dataReturn[$data[$i][$field]])) {
                    $dataReturn[$data[$i][$field]][] = $data[$i];
                } else {
                    $dataReturn[$data[$i][$field]] = array($data[$i]);
                }
            }

            foreach ($dataReturn as $key => $value) {
                $dReturn[] = array('id' => $key, 'data' => $value, 'league' => $value[0]['league']);
            }

            return $dReturn;
        }
        return $data;
    }
    
    public function isTennis()
    {
        return ($this->sport == 8);
    }

}
