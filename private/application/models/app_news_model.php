<?php

class App_news_model extends CI_Model {

    public function get_sports_news($only_localized, $start, $limit = 20, $teamBetradarIds, $tournamentBetradarIds, $categoryBetadarIDs, $sportBetradarIDs, $mark_time) {

        $where = "";

        //Filter by translate
        if ($only_localized) {
            $langs = $this->config->item('language_db');
            $where = " AND `p`.`language` = {$langs[$this->lang->lang()]} ";
        }

        //Filter by sport
        $sportJoin = 'LEFT JOIN `sportnews_sport` as sp ON `sp`.`uid` = `p`.`sport_uid`';
        if (!empty($sportBetradarIDs)) {
            if (count($sportBetradarIDs) > 1) {
                $in = "('" . implode("','", $sportBetradarIDs) . "')";
                $sportJoin = "INNER JOIN `sportnews_sport` as sp ON `sp`.`uid` = `p`.`sport_uid` AND `sp`.betradar_uid IN {$in}";
            } else {
                $sportJoin = "INNER JOIN `sportnews_sport` as sp ON `sp`.`uid` = `p`.`sport_uid` AND `sp`.betradar_uid = {$sportBetradarIDs[0]} ";
            }
        }

        //Filter by category
        $categoryJoin = 'LEFT JOIN `sportnews_category` as cat ON `cat`.`uid` = `p`.`category_uid`';
        if (!empty($categoryBetadarIDs)) {
            if (count($categoryBetadarIDs) > 1) {
                $in = "('" . implode("','", $categoryBetadarIDs) . "')";
                $categoryJoin = "INNER JOIN sportnews_category_team as cat_team ON "
                        . " (`cat_team`.`team_uid` = `p`.`team2_uid` OR `cat_team`.`team_uid` = `p`.`team1_uid` OR `p`.`category_uid` = cat_team.category_uid ) "
                        . " INNER JOIN sportnews_category as cat ON cat_team.category_uid = cat.uid  AND `cat`.betradar_uid IN {$in} "
                        . " AND (`p`.`category_uid` = 0 OR `p`.`category_uid` = cat.uid) ";
            } else {
                $categoryJoin = "INNER JOIN sportnews_category_team as cat_team ON "
                        . " (`cat_team`.`team_uid` = `p`.`team2_uid` OR `cat_team`.`team_uid` = `p`.`team1_uid` OR `p`.`category_uid` = cat_team.category_uid ) "
                        . " INNER JOIN sportnews_category as cat ON cat_team.category_uid = cat.uid  AND `cat`.betradar_uid = {$categoryBetadarIDs[0]} "
                        . " AND (`p`.`category_uid` = 0 OR `p`.`category_uid` = cat.uid) ";
            }
        }

        //Filter by tournament
        $tournamentJoin = 'LEFT JOIN `sportnews_tournament` as tn ON `tn`.`uid` = `p`.`tournament_uid`';
        if (!empty($tournamentBetradarIds)) {
            if (count($tournamentBetradarIds) > 1) {
                $in = "('" . implode("','", $tournamentBetradarIds) . "')";
                $tournamentJoin = "INNER JOIN `sportnews_tournament_team` as tour_team ON "
                        . " (`tour_team`.`team_uid` = `p`.`team2_uid` OR `tour_team`.`team_uid` = `p`.`team1_uid` OR `p`.`tournament_uid` = tour_team.tournament_uid) "
                        . " INNER JOIN sportnews_tournament as tn ON tour_team.tournament_uid = tn.uid  AND `tn`.betradar_uid IN {$in} "
                        . " AND (`p`.`tournament_uid` = 0 OR `p`.`tournament_uid` = tn.uid) ";
            } else {
                $tournamentJoin = "INNER JOIN `sportnews_tournament_team` as tour_team ON "
                        . " (`tour_team`.`team_uid` = `p`.`team2_uid` OR `tour_team`.`team_uid` = `p`.`team1_uid` OR `p`.`tournament_uid` = tour_team.tournament_uid) "
                        . " INNER JOIN sportnews_tournament as tn ON tour_team.tournament_uid = tn.uid  AND `tn`.betradar_uid = {$tournamentBetradarIds[0]} "
                        . " AND (`p`.`tournament_uid` = 0 OR `p`.`tournament_uid` = tn.uid) ";
            }
        }

        //Filter by time
        $timestamp = $mark_time > 0 ? $mark_time : -time();
        if ($timestamp > 0) {
            $where .= " AND `p`.`posted_on_negate` < {$timestamp}";
        } else {
            $where .= " AND `p`.`posted_on_negate` > {$timestamp}";
        }

        //Not get the deleted new
        $where = "WHERE `p`.`deleted` =  0 " . $where;


        //Filter by team
        if (!empty($teamBetradarIds)) {
            $tempIn = "('" . implode("','", $teamBetradarIds) . "')";
            $tempQuery = "SELECT * FROM sportnews_team where betradar_uid IN {$tempIn}";
            $tempResult = $this->db->query($tempQuery)->result_array();

            $tempTeamUids = array();
            foreach ($tempResult as $row) {
                $tempTeamUids[] = $row['uid'];
            }
            if (count($tempTeamUids) > 1) {
                $tempIn = "('" . implode("','", $tempTeamUids) . "')";
                $where .= " AND (`p`.`team1_uid` IN {$tempIn} OR `p`.`team2_uid` IN {$tempIn})";
            }
            if (count($tempTeamUids) == 1) {
                $where .= " AND (`p`.`team1_uid` = '{$tempTeamUids[0]}' OR `p`.`team2_uid` = '{$tempTeamUids[0]}')";
            }

            //We have team conditions but there is no data
            if (count($tempTeamUids) == 0) {
                return array();
            }
        }

        $limitInside = $start + $limit + 1;
        $query = "
                SELECT `p`.*, `sportnews_feed`.`vendor_icon` as feedicon, `sportnews_feed`.`name` as feedname, `sp`.`name` as sportname, `cat`.`name` as catname, `tn`.`name` as trnmntname,
                `untn`.`name` as untnname 
                FROM (`sportnews_post` as p)
                LEFT JOIN `sportnews_feed` ON `p`.`feed_uid` = `sportnews_feed`.`uid`
                {$sportJoin}
                {$categoryJoin}
                {$tournamentJoin}
                LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `tn`.`unique_uid`
                {$where}
                ORDER BY p.posted_on_negate ASC
                LIMIT {$start}, {$limit}";
        $result = $this->db->query($query)->result_array();

        //Add team information to the data
        $tempTeamUids = array();
        for ($i = 0; $i < count($result); $i++) {
            $result[$i]['tn1uid'] = $result[$i]['team1_uid'];
            $result[$i]['tn2uid'] = $result[$i]['team2_uid'];
            $result[$i]['team1_name'] = NULL;
            $result[$i]['team2_name'] = NULL;
            $result[$i]['team1_betradaruid'] = NULL;
            $result[$i]['team2_betradaruid'] = NULL;
            $result[$i]['team1seourl'] = NULL;
            $result[$i]['team2seourl'] = NULL;
            $result[$i]['teamseourl'] = NULL;
            if (!empty($result[$i]['team1_uid'])) {
                $tempTeamUids[] = $result[$i]['team1_uid'];
            }
            if (!empty($result[$i]['team2_uid'])) {
                $tempTeamUids[] = $result[$i]['team2_uid'];
            }
        }

        if (count($tempTeamUids) > 0) {
            $tempIn = "('" . implode("','", $tempTeamUids) . "')";
            $teamResult = $this->db->query("SELECT * FROM sportnews_team WHERE uid IN {$tempIn} LIMIT 0, " . count($tempTeamUids))->result_array();
            $reIndexTeamResult = array();
            for ($i = 0; $i < count($teamResult); $i++) {
                $reIndexTeamResult[$teamResult[$i]['uid']] = $teamResult[$i];
            }

            //Add team information to result
            for ($i = 0; $i < count($result); $i++) {
                if (isset($reIndexTeamResult[$result[$i]['tn1uid']])) {
                    $result[$i]['team1_name'] = $reIndexTeamResult[$result[$i]['tn1uid']]['name'];
                    $result[$i]['team1_betradaruid'] = $reIndexTeamResult[$result[$i]['tn1uid']]['betradar_uid'];
                    $result[$i]['team1seourl'] = $reIndexTeamResult[$result[$i]['tn1uid']]['seourl'];
                }

                if (isset($reIndexTeamResult[$result[$i]['tn2uid']])) {
                    $result[$i]['team2_name'] = $reIndexTeamResult[$result[$i]['tn2uid']]['name'];
                    $result[$i]['team2_betradaruid'] = $reIndexTeamResult[$result[$i]['tn2uid']]['betradar_uid'];
                    $result[$i]['team2seourl'] = $reIndexTeamResult[$result[$i]['tn2uid']]['seourl'];
                }

                $result[$i]['teamseourl'] = $result[$i]['team1seourl'];
            }
        }

        return $result;
    }

}
