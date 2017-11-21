<?php

class Euro_news_model extends CI_Model{
    
    public function get_euro($only_localized, $start, $limit = 20, $teamBetradarIds, $tournamentBetradarIds, $categoryBetadarIDs, $sportBetradarIDs, $mark_time, $language = 2){
       
        $where = "";
        
        //Filter by translate
        if (!(empty($only_localized) && empty($language))) {
            if (empty($only_localized) && in_array($language, array(1, 2, '1', '2'))) {
                $where = " AND `p`.`language` = '{$language}' ";
            } else {
                $langs = $this->config->item('language_db');
                $where = " AND `p`.`language` = {$langs[$this->lang->lang()]} ";
            }
        }
        
        //Filter by sport
        $sportJoin = 'LEFT JOIN `sportnews_sport` as sp ON `sp`.`uid` = `p`.`sport_uid`';
        if (!empty($sportBetradarIDs))  {
            if (count($sportBetradarIDs) > 1) {
                $in = "('".implode("','", $sportBetradarIDs)."')";
                $sportJoin = "INNER JOIN `sportnews_sport` as sp ON `sp`.`uid` = `p`.`sport_uid` AND `sp`.betradar_uid IN {$in}";
            } else {
                $sportJoin = "INNER JOIN `sportnews_sport` as sp ON `sp`.`uid` = `p`.`sport_uid` AND `sp`.betradar_uid = {$sportBetradarIDs[0]} ";
            }
        }
        
        //Filter by category
        $categoryJoin = 'LEFT JOIN `sportnews_category` as cat ON `cat`.`uid` = `p`.`category_uid`';
        if (!empty($categoryBetadarIDs)) {
            if (count($categoryBetadarIDs) > 1) {
                $in = "('".implode("','", $categoryBetadarIDs)."')";
                $categoryJoin = "INNER JOIN `sportnews_category` as cat ON `cat`.`uid` = `p`.`category_uid` AND `cat`.betradar_uid IN {$in} ";
            } else {
                $categoryJoin = "INNER JOIN `sportnews_category` as cat ON `cat`.`uid` = `p`.`category_uid` AND `cat`.betradar_uid = {$categoryBetadarIDs[0]} ";
            }
        }
        
        //Filter by team
        $teamJoin1 = 'LEFT JOIN `sportnews_team` as t ON `t`.`uid` = `p`.`team1_uid`';
        $teamJoin2 = 'LEFT JOIN `sportnews_team` as t ON `t`.`uid` = `p`.`team2_uid`';
        if (!empty($teamBetradarIds)) {
            if (count($teamBetradarIds) > 1) {
                $in = "('".implode("','", $teamBetradarIds)."')";
                $teamJoin1 = "INNER JOIN `sportnews_team` as t ON `t`.`uid` = `p`.`team1_uid` AND `t`.betradar_uid IN {$in} ";
                $teamJoin2 = "INNER JOIN `sportnews_team` as t ON `t`.`uid` = `p`.`team2_uid` AND `t`.betradar_uid IN {$in} ";
            } else {
                $teamJoin1 = "INNER JOIN `sportnews_team` as t ON `t`.`uid` = `p`.`team1_uid` AND `t`.betradar_uid = {$teamBetradarIds[0]} ";
                $teamJoin2 = "INNER JOIN `sportnews_team` as t ON `t`.`uid` = `p`.`team2_uid` AND `t`.betradar_uid = {$teamBetradarIds[0]} ";
            }
        }
        
        //Filter by tournament
        $tournamentJoin = 'LEFT JOIN `sportnews_tournament` as tn ON `tn`.`uid` = `p`.`tournament_uid`';
        if (!empty($tournamentBetradarIds))  {
            if (count($tournamentBetradarIds) > 1) {
                $in = "('".implode("','", $tournamentBetradarIds)."')";
                $tournamentJoin = "INNER JOIN `sportnews_tournament` as tn ON `tn`.`uid` = `p`.`tournament_uid` AND `tn`.betradar_uid IN {$in} ";
            } else {
                $tournamentJoin = "INNER JOIN `sportnews_tournament` as tn ON `tn`.`uid` = `p`.`tournament_uid` AND `tn`.betradar_uid = {$tournamentBetradarIds[0]} ";
            }
        }
        
        //Filter by time
        $timestamp = $mark_time>0?$mark_time:-time();
        if ($timestamp > 0) {
            $where .= " AND `p`.`posted_on_negate` < {$timestamp}";
        } else {
            $where .= " AND `p`.`posted_on_negate` > {$timestamp}";
        }
        
        //Not get the deleted new
        $where = "WHERE `p`.`deleted` =  0 ".$where;
        
        $limitInside = $start + $limit + 1;
        $query = "
                SELECT * FROM 
                (SELECT * FROM (
                SELECT `p`.*, `sportnews_feed`.`vendor_icon` as feedicon, `sportnews_feed`.`name` as feedname, `sp`.`name` as sportname, `cat`.`name` as catname, `tn`.`name` as trnmntname,
                `untn`.`name` as untnname, `t`.`uid` as tn1uid, NULL as tn2uid, `t`.`name` as team1_name,
                NULL as team2_name, `t`.`betradar_uid` AS team1_betradaruid, NULL AS team2_betradaruid, `t`.`seourl` AS teamseourl, `t`.`seourl` AS team1seourl,
                NULL AS team2seourl
                FROM (`sportnews_post` as p)
                LEFT JOIN `sportnews_feed` ON `p`.`feed_uid` = `sportnews_feed`.`uid`
                {$sportJoin}
                {$categoryJoin}
                {$tournamentJoin}
                LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `tn`.`unique_uid`
                {$teamJoin1}
                {$where}
                ORDER BY p.posted_on_negate ASC
                LIMIT {$limitInside}
                ) AS post

                UNION
                SELECT * FROM (
                SELECT `p`.*, `sportnews_feed`.`vendor_icon` as feedicon, `sportnews_feed`.`name` as feedname, `sp`.`name` as sportname,
                `cat`.`name` as catname, `tn`.`name` as trnmntname, `untn`.`name` as untnname, NULL as tn1uid, `t`.`uid` as tn2uid, NULL as team1_name,
                `t`.`name` as team2_name, NULL AS team1_betradaruid, `t`.`betradar_uid` AS team2_betradaruid, NULL AS teamseourl, NULL AS team1seourl, `t`.`seourl` AS team2seourl
                FROM (`sportnews_post` as p)
                LEFT JOIN `sportnews_feed` ON `p`.`feed_uid` = `sportnews_feed`.`uid`
                {$sportJoin}
                {$categoryJoin}
                {$tournamentJoin}
                LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `tn`.`unique_uid`
                {$teamJoin2}
                {$where}
                ORDER BY p.posted_on_negate ASC
                LIMIT {$limitInside}
                ) AS post)
                AS r
                ORDER BY r.`posted_on_negate` ASC
                LIMIT $start,$limit;";
                
        return $this->db->query($query)->result_array();
    }
    
}
