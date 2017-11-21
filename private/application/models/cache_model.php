<?php

class Cache_model extends CI_Model {
    public function initAll() {
        $this->initPost();
    }

    public function initPost() {
        $this->initPostTeam();
        $this->initPostTournament();
        $this->initPostCategory();
        $this->initPostSport();
    }

    public function initPostCategory() {
        $this->createPostTable('sportnews_cache_post_category',
            array('team1_category_uid' => 'INT UNSIGNED', 'team2_category_uid' => 'INT UNSIGNED',
                  'tournament_category_uid' => 'INT UNSIGNED', 'unique_tournament_category_uid' => 'INT UNSIGNED'),
            array('category_uid', 'team1_category_uid', 'team2_category_uid', 'tournament_category_uid', 'unique_tournament_category_uid'));
        $this->createPostCategoryFunction();
    }

    public function initPostSport() {
        $this->createPostTable('sportnews_cache_post_sport',
            array('team1_sport_uid' => 'INT UNSIGNED', 'team2_sport_uid' => 'INT UNSIGNED',
                  'category_sport_uid' => 'INT UNSIGNED', 'tournament_sport_uid' => 'INT UNSIGNED', 'unique_tournament_sport_uid' => 'INT UNSIGNED'),
            array('sport_uid', 'team1_sport_uid', 'team2_sport_uid', 'category_sport_uid', 'tournament_sport_uid', 'unique_tournament_sport_uid'));
        $this->createPostSportFunction();
    }

    public function initPostTeam() {
        $this->createPostTable('sportnews_cache_post_team', array(), array('team1_uid', 'team2_uid'));
        $this->createPostTeamFunction();
    }

    public function initPostTournament() {
        $this->createPostTable('sportnews_cache_post_tournament',
            array('team1_tournament_uid' => 'INT UNSIGNED', 'team2_tournament_uid' => 'INT UNSIGNED'),
            array('tournament_uid', 'team1_tournament_uid', 'team2_tournament_uid'));
        $this->createPostTournamentFunction();
    }

    public function createPostCategoryFunction() {
        $this->db->query("DROP PROCEDURE IF EXISTS `cache_post_category_update`;");
        $sql = "CREATE PROCEDURE cache_post_category_update() "
            . "MODIFIES SQL DATA "
            . "BEGIN "
            . "START TRANSACTION; "
            . "DELETE FROM `sportnews_cache_post_category`; "
            . "ALTER TABLE `sportnews_cache_post_category` AUTO_INCREMENT = 1";

        $sql .=
            "INSERT INTO `sportnews_cache_post_category` (`uid`, `feed_uid`, `sport_uid`, `category_uid`, `tournament_category_uid`, `unique_tournament_category_uid`, `tournament_uid`, `unique_tournament_uid`, `team1_uid`, `team2_uid`, `url`, `language`, `posted_on`, `seourl`, `feedname`, `feedicon`, `sportname`, `catname`, `trnmntname`, `untnname`, `team1_category_uid`, `team1_name`, `team1_seourl`, `team1_betradaruid`, `team2_category_uid`, `team2_name`, `team2_seourl`, `team2_betradaruid`) "
            . "SELECT `p`.`uid`, `p`.`feed_uid`, `p`.`sport_uid`, `p`.`category_uid`, `tn`.`category_uid`, `untn`.`category_uid`, `p`.`tournament_uid`, `p`.`unique_tournament_uid`, `p`.`team1_uid`, `p`.`team2_uid`, `p`.`url`, `p`.`language`, `p`.`posted_on`, `p`.`seourl`, `feed`.`name` AS feedname, `feed`.`vendor_icon` AS `feedicon`, `sport`.`name` AS `sportname`, `cat`.`name` AS `catname`, `tn`.`name` AS `trnmntname`, `untn`.`name` AS `untnname`, `cttm1`.`category_uid` AS `team1_category_uid`, `tm1`.`name` AS `team1_name`, `tm1`.`seourl` AS `team1_seourl`, `tm1`.`betradar_uid` AS `team1_betradaruid`, `cttm2`.`category_uid` AS `team2_category_uid`, `tm2`.`name` AS `team2_name`, `tm2`.`seourl` AS `team2_seourl`, `tm2`.`betradar_uid` AS `team2_betradaruid` "
            . "FROM `sportnews_post` AS `p` "
            . "LEFT JOIN `sportnews_feed` AS `feed` ON `p`.`feed_uid` = `feed`.`uid` "
            . "LEFT JOIN `sportnews_tournament` as tn ON `p`.`tournament_uid` = `tn`.`uid` "
            . "LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `p`.`unique_tournament_uid` "
            . "LEFT JOIN `sportnews_category` AS `cat` ON `cat`.`uid` = `p`.`category_uid` "
            . "LEFT JOIN `sportnews_sport` AS `sport` ON `sport`.`uid` = `p`.`sport_uid` "
            . "LEFT JOIN `sportnews_category_team` AS `cttm1` ON `cttm1`.`team_uid` = `p`.`team1_uid` "
            . "LEFT JOIN `sportnews_category` AS `cat1` ON `cat1`.`uid` = `cttm1`.`category_uid` "
            . "LEFT JOIN `sportnews_category_team` AS `cttm2` ON `cttm2`.`team_uid` = `p`.`team2_uid` "
            . "LEFT JOIN `sportnews_category` AS `cat2` ON `cat2`.`uid` = `cttm2`.`category_uid` "
            . "LEFT JOIN `sportnews_team` AS tm1 ON `tm1`.`uid` = `p`.`team1_uid` "
            . "LEFT JOIN `sportnews_team` AS tm2 ON `tm2`.`uid` = `p`.`team2_uid` "
            . "WHERE ( `tn`.`uid` IS NULL OR `tn`.`hidden` = 0 ) "
            . "AND ( `untn`.`uid` IS NULL OR `untn`.`hidden` = 0 ) "
            . "AND ( `cat`.`uid` IS NULL OR `cat`.`hidden` = 0 ) "
            . "AND ( `sport`.`uid` IS NULL OR `sport`.`hidden` = 0 ) "
            . "AND (( `cat1`.`uid` IS NULL OR `cat1`.`hidden` = 0 ) "
            . "OR ( `cat2`.`uid` IS NULL OR `cat2`.`hidden` = 0 )) "
            . "AND (( `tm1`.`uid` IS NULL OR `tm1`.`deleted` = 0 ) "
            . "OR ( `tm2`.`uid` IS NULL OR `tm2`.`deleted` = 0 )) "
            . "AND `p`.`hidden` = 0 AND `p`.`deleted` = 0 "
            . "AND `p`.`posted_on` < UNIX_TIMESTAMP() "
            . "AND `p`.`posted_on` > UNIX_TIMESTAMP() - 7776000 "
            . "GROUP BY `p`.`uid`, `p`.`category_uid`, `cttm1`.`category_uid`, `cttm2`.`category_uid` "
            . "ORDER BY `p`.`posted_on` DESC; ";

        $sql .= "COMMIT; END";

        $this->db->query($sql);
    }

    public function createPostSportFunction() {
        $this->db->query("DROP PROCEDURE IF EXISTS `cache_post_sport_update`;");
        $sql = "CREATE PROCEDURE cache_post_sport_update() "
            . "MODIFIES SQL DATA "
            . "BEGIN "
            . "START TRANSACTION; "
            . "DELETE FROM `sportnews_cache_post_sport`; "
            . "ALTER TABLE `sportnews_cache_post_sport` AUTO_INCREMENT = 1";

        $sql .=
            "INSERT INTO `sportnews_cache_post_sport` (`uid`, `feed_uid`, `sport_uid`, `category_sport_uid`, `tournament_sport_uid`, `unique_tournament_sport_uid`, `category_uid`, `tournament_uid`, `unique_tournament_uid`, `team1_uid`, `team2_uid`, `url`, `language`, `posted_on`, `seourl`, `feedname`, `feedicon`, `sportname`, `catname`, `trnmntname`, `untnname`, `team1_sport_uid`, `team1_name`, `team1_seourl`, `team1_betradaruid`, `team2_sport_uid`, `team2_name`, `team2_seourl`, `team2_betradaruid`) "
            . "SELECT `p`.`uid`, `p`.`feed_uid`, `p`.`sport_uid`, `cat`.`sport_uid`, `tncat`.`sport_uid`, `untncat`.`sport_uid`, `p`.`category_uid`, `p`.`tournament_uid`, `p`.`unique_tournament_uid`, `p`.`team1_uid`, `p`.`team2_uid`, `p`.`url`, `p`.`language`, `p`.`posted_on`, `p`.`seourl`, `feed`.`name` AS feedname, `feed`.`vendor_icon` AS `feedicon`, `sport`.`name` AS `sportname`, `cat`.`name` AS `catname`, `tn`.`name` AS `trnmntname`, `untn`.`name` AS `untnname`, `sttm1`.`sport_uid` AS `team1_sport_uid`, `tm1`.`name` AS `team1_name`, `tm1`.`seourl` AS `team1_seourl`, `tm1`.`betradar_uid` AS `team1_betradaruid`, `sttm2`.`sport_uid` AS `team2_sport_uid`, `tm2`.`name` AS `team2_name`, `tm2`.`seourl` AS `team2_seourl`, `tm2`.`betradar_uid` AS `team2_betradaruid` "
            . "FROM `sportnews_post` AS `p` "
            . "LEFT JOIN `sportnews_feed` AS `feed` ON `p`.`feed_uid` = `feed`.`uid` "
            . "LEFT JOIN `sportnews_tournament` as tn ON `p`.`tournament_uid` = `tn`.`uid` "
            . "LEFT JOIN `sportnews_category` as tncat ON `tn`.`category_uid` = `tncat`.`uid` "
            . "LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `p`.`unique_tournament_uid` "
            . "LEFT JOIN `sportnews_category` as untncat ON `untn`.`category_uid` = `untncat`.`uid` "
            . "LEFT JOIN `sportnews_category` AS `cat` ON `cat`.`uid` = `p`.`category_uid` "
            . "LEFT JOIN `sportnews_sport` AS `sport` ON `sport`.`uid` = `p`.`sport_uid` "
            . "LEFT JOIN `sportnews_sport_team` AS `sttm1` ON `sttm1`.`team_uid` = `p`.`team1_uid` "
            . "LEFT JOIN `sportnews_sport` AS `sport1` ON `sport1`.`uid` = `sttm1`.`sport_uid` "
            . "LEFT JOIN `sportnews_sport_team` AS `sttm2` ON `sttm2`.`team_uid` = `p`.`team2_uid` "
            . "LEFT JOIN `sportnews_sport` AS `sport2` ON `sport2`.`uid` = `sttm2`.`sport_uid` "
            . "LEFT JOIN `sportnews_team` AS tm1 ON `tm1`.`uid` = `p`.`team1_uid` "
            . "LEFT JOIN `sportnews_team` AS tm2 ON `tm2`.`uid` = `p`.`team2_uid` "
            . "WHERE ( `tn`.`uid` IS NULL OR `tn`.`hidden` = 0 ) "
            . "AND ( `untn`.`uid` IS NULL OR `untn`.`hidden` = 0 ) "
            . "AND ( `cat`.`uid` IS NULL OR `cat`.`hidden` = 0 ) "
            . "AND ( `sport`.`uid` IS NULL OR `sport`.`hidden` = 0 ) "
            . "AND (( `sport1`.`uid` IS NULL OR `sport1`.`hidden` = 0 ) "
            . "OR ( `sport2`.`uid` IS NULL OR `sport2`.`hidden` = 0 )) "
            . "AND (( `tm1`.`uid` IS NULL OR `tm1`.`deleted` = 0 ) "
            . "OR ( `tm2`.`uid` IS NULL OR `tm2`.`deleted` = 0 )) "
            . "AND `p`.`hidden` = 0 AND `p`.`deleted` = 0 "
            . "AND `p`.`posted_on` < UNIX_TIMESTAMP() "
            . "AND `p`.`posted_on` > UNIX_TIMESTAMP() - 7776000 "
            . "GROUP BY `p`.`uid`, `p`.`sport_uid`, `sttm1`.`sport_uid`, `sttm2`.`sport_uid` "
            . "ORDER BY `p`.`posted_on` DESC; ";

        $sql .= "COMMIT; END";

        $this->db->query($sql);
    }

    public function createPostTable($table, $addColumns, $indexColumns) {
        $this->db->query("DROP TABLE IF EXISTS `{$table}`;");
        $sql = "CREATE TABLE `{$table}` ("
            . "`cache_uid` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, "
            . "`uid` INT UNSIGNED NOT NULL, "
            . "`feed_uid` INT UNSIGNED NOT NULL, "
            . "`sport_uid` INT UNSIGNED, "
            . "`category_uid` INT UNSIGNED, "
            . "`tournament_uid` INT UNSIGNED, "
            . "`unique_tournament_uid` INT UNSIGNED, "
            . "`team1_uid` INT UNSIGNED, "
            . "`team2_uid` INT UNSIGNED, "
            . "`url` TEXT, "
            . "`language` INT UNSIGNED, "
            . "`posted_on` INT UNSIGNED, "
            . "`seourl` VARCHAR(255), "
            . "`feedname` VARCHAR(255), "
            . "`feedicon` VARCHAR(255), "
            . "`sportname` VARCHAR(255), "
            . "`catname` VARCHAR(255), "
            . "`trnmntname` VARCHAR(255), "
            . "`untnname` VARCHAR(255), "
            . "`team1_seourl` VARCHAR(255), "
            . "`team1_betradaruid` INT, "
            . "`team1_name` VARCHAR(255), "
            . "`team2_seourl` VARCHAR(255), "
            . "`team2_betradaruid` INT, "
            . "`team2_name` VARCHAR(255), ";


        foreach ($addColumns as $column => $type) {
            $sql .= "`{$column}` {$type}, ";
        }

        $index = '';
        foreach ($indexColumns as $column) {
            $index .= ", `{$column}`";
        }

        $sql .= "INDEX `sort_index` (`cache_uid`, `uid`, `language`{$index})) ENGINE=Innodb;";

        $this->db->query($sql);
    }

    public function createPostTeamFunction() {
        $this->db->query("DROP PROCEDURE IF EXISTS `cache_post_team_update`;");
        $sql = "CREATE PROCEDURE cache_post_team_update() "
            . "MODIFIES SQL DATA "
            . "BEGIN "
            . "START TRANSACTION; "
            . "DELETE FROM `sportnews_cache_post_team`; "
            . "ALTER TABLE `sportnews_cache_post_team` AUTO_INCREMENT = 1";

        $sql .=
            "INSERT INTO `sportnews_cache_post_team` (`uid`, `feed_uid`, `sport_uid`, `category_uid`, `tournament_uid`, `unique_tournament_uid`, `team1_uid`, `team2_uid`, `url`, `language`, `posted_on`, `seourl`, `feedname`, `feedicon`, `sportname`, `catname`, `trnmntname`, `untnname`, `team1_name`, `team1_seourl`, `team1_betradaruid`, `team2_name`, `team2_seourl`, `team2_betradaruid`) "
            . "SELECT `p`.`uid`, `p`.`feed_uid`, `p`.`sport_uid`, `p`.`category_uid`, `p`.`tournament_uid`, `p`.`unique_tournament_uid`, `p`.`team1_uid`, `p`.`team2_uid`, `p`.`url`, `p`.`language`, `p`.`posted_on`, `p`.`seourl`, `feed`.`name` AS feedname, `feed`.`vendor_icon` AS `feedicon`, `sport`.`name` AS `sportname`, `cat`.`name` AS `catname`, `tn`.`name` AS `trnmntname`, `untn`.`name` AS `untnname`, `tm1`.`name` AS `team1_name`, `tm1`.`seourl` AS `team1_seourl`, `tm1`.`betradar_uid` AS `team1_betradaruid`, `tm2`.`name` AS `team2_name`, `tm2`.`seourl` AS `team2_seourl`, `tm2`.`betradar_uid` AS `team2_betradaruid` "
            . "FROM `sportnews_post` AS `p` "
            . "LEFT JOIN `sportnews_feed` AS `feed` ON `p`.`feed_uid` = `feed`.`uid` "
            . "LEFT JOIN `sportnews_tournament` as tn ON `p`.`tournament_uid` = `tn`.`uid` "
            . "LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `p`.`unique_tournament_uid` "
            . "LEFT JOIN `sportnews_category` AS `cat` ON `cat`.`uid` = `p`.`category_uid` "
            . "LEFT JOIN `sportnews_sport` AS `sport` ON `sport`.`uid` = `p`.`sport_uid` "
            . "LEFT JOIN `sportnews_team` AS `tm1` ON `tm1`.`uid` = `p`.`team1_uid` "
            . "LEFT JOIN `sportnews_team` AS `tm2` ON `tm2`.`uid` = `p`.`team2_uid` "
            . "WHERE ( `tn`.`uid` IS NULL OR `tn`.`hidden` = 0 ) "
            . "AND ( `untn`.`uid` IS NULL OR `untn`.`hidden` = 0 ) "
            . "AND ( `cat`.`uid` IS NULL OR `cat`.`hidden` = 0 ) "
            . "AND ( `sport`.`uid` IS NULL OR `sport`.`hidden` = 0 ) "
            . "AND (( `tm1`.`uid` IS NULL OR `tm1`.`deleted` = 0 ) "
            . "OR ( `tm2`.`uid` IS NULL OR `tm2`.`deleted` = 0 )) "
            . "AND `p`.`hidden` = 0 AND `p`.`deleted` = 0 "
            . "AND `p`.`posted_on` < UNIX_TIMESTAMP() "
            . "AND `p`.`posted_on` > UNIX_TIMESTAMP() - 7776000 "
            . "GROUP BY `p`.`uid`, `p`.`team1_uid`, `p`.`team2_uid` "
            . "ORDER BY `p`.`posted_on` DESC; ";

        $sql .= "COMMIT; END";

        $this->db->query($sql);
    }

    public function createPostTournamentFunction() {
        $this->db->query("DROP PROCEDURE IF EXISTS `cache_post_tournament_update`;");
        $sql = "CREATE PROCEDURE cache_post_tournament_update() "
            . "MODIFIES SQL DATA "
            . "BEGIN "
            . "START TRANSACTION; "
            . "DELETE FROM `sportnews_cache_post_tournament`; "
            . "ALTER TABLE `sportnews_cache_post_tournament` AUTO_INCREMENT = 1";

        $sql .=
            "INSERT INTO `sportnews_cache_post_tournament` (`uid`, `feed_uid`, `sport_uid`, `category_uid`, `tournament_uid`, `unique_tournament_uid`, `team1_uid`, `team2_uid`, `url`, `language`, `posted_on`, `seourl`, `feedname`, `feedicon`, `sportname`, `catname`, `trnmntname`, `untnname`, `team1_tournament_uid`, `team1_name`, `team1_seourl`, `team1_betradaruid`, `team2_tournament_uid`, `team2_name`, `team2_seourl`, `team2_betradaruid`) "
            . "SELECT `p`.`uid`, `p`.`feed_uid`, `p`.`sport_uid`, `p`.`category_uid`, `p`.`tournament_uid`, `p`.`unique_tournament_uid`, `p`.`team1_uid`, `p`.`team2_uid`, `p`.`url`, `p`.`language`, `p`.`posted_on`, `p`.`seourl`, `feed`.`name` AS feedname, `feed`.`vendor_icon` AS `feedicon`, `sport`.`name` AS `sportname`, `cat`.`name` AS `catname`, `tn`.`name` AS `trnmntname`, `untn`.`name` AS `untnname`, `tntm1`.`tournament_uid` AS `team1_tournament_uid`, `tm1`.`name` AS `team1_name`, `tm1`.`seourl` AS `team1_seourl`, `tm1`.`betradar_uid` AS `team1_betradaruid`, `tntm2`.`tournament_uid` AS `team2_tournament_uid`, `tm2`.`name` AS `team2_name`, `tm2`.`seourl` AS `team2_seourl`, `tm2`.`betradar_uid` AS `team2_betradaruid` "
            . "FROM `sportnews_post` AS `p` "
            . "LEFT JOIN `sportnews_feed` AS `feed` ON `p`.`feed_uid` = `feed`.`uid` "
            . "LEFT JOIN `sportnews_tournament_team` AS `tntm1` ON `tntm1`.`team_uid` = `p`.`team1_uid` "
            . "LEFT JOIN `sportnews_tournament` AS `tn1` ON `tn1`.`uid` = `tntm1`.`tournament_uid` "
            . "LEFT JOIN `sportnews_tournament_team` AS tntm2 ON `tntm2`.`team_uid` = `p`.`team2_uid` "
            . "LEFT JOIN `sportnews_tournament` AS `tn2` ON `tn2`.`uid` = `tntm2`.`tournament_uid` "
            . "LEFT JOIN `sportnews_team` AS tm1 ON `tm1`.`uid` = `p`.`team1_uid` "
            . "LEFT JOIN `sportnews_team` AS tm2 ON `tm2`.`uid` = `p`.`team2_uid` "
            . "LEFT JOIN `sportnews_tournament` as tn ON `p`.`tournament_uid` = `tn`.`uid` "
            . "LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `p`.`unique_tournament_uid` "
            . "LEFT JOIN `sportnews_category` AS `cat` ON `cat`.`uid` = `p`.`category_uid` "
            . "LEFT JOIN `sportnews_sport` AS `sport` ON `sport`.`uid` = `p`.`sport_uid` "
            . "WHERE ( `tn`.`uid` IS NULL OR `tn`.`hidden` = 0 ) "
            . "AND ( `untn`.`uid` IS NULL OR `untn`.`hidden` = 0 ) "
            . "AND ( `cat`.`uid` IS NULL OR `cat`.`hidden` = 0 ) "
            . "AND ( `sport`.`uid` IS NULL OR `sport`.`hidden` = 0 ) "
            . "AND (( `tn1`.`uid` IS NULL OR `tn1`.`hidden` = 0 ) "
            . "OR ( `tn2`.`uid` IS NULL OR `tn2`.`hidden` = 0 )) "
            . "AND (( `tm1`.`uid` IS NULL OR `tm1`.`deleted` = 0 ) "
            . "OR ( `tm2`.`uid` IS NULL OR `tm2`.`deleted` = 0 )) "
            . "AND `p`.`hidden` = 0 AND `p`.`deleted` = 0 "
            . "AND `p`.`posted_on` < UNIX_TIMESTAMP() "
            . "AND `p`.`posted_on` > UNIX_TIMESTAMP() - 7776000 "
            . "GROUP BY `p`.`uid`, `p`.`tournament_uid`, `tntm1`.`tournament_uid`, `tntm2`.`tournament_uid` "
            . "ORDER BY `p`.`posted_on` DESC; ";

        $sql .= "COMMIT; END";

        $this->db->query($sql);
    }

    public function updatePostCacheFunction() {
        $this->createPostTeamFunction();
        $this->createPostTournamentFunction();
        $this->createPostCategoryFunction();
        $this->createPostSportFunction();
    }
}

/*

  TO IMPLEMENT

  // TOURNAMENT UPDATE PROCEDURE
  DROP PROCEDURE IF EXISTS `cache_post_tournament_update`;
  DELIMITER ;;
  CREATE PROCEDURE cache_post_tournament_update() MODIFIES SQL DATA
  BEGIN
  START TRANSACTION;
  DROP TABLE IF EXISTS `sportnews_cache_post_tournament_tmp`;
  CREATE TABLE `sportnews_cache_post_tournament_tmp` LIKE `sportnews_cache_post_tournament`;
  INSERT INTO `sportnews_cache_post_tournament_tmp` (`uid`, `feed_uid`, `sport_uid`, `category_uid`, `tournament_uid`, `team1_uid`, `team2_uid`, `url`, `language`, `posted_on`, `seourl`, `feedname`, `feedicon`, `sportname`, `catname`, `trnmntname`, `untnname`, `team1_tournament_uid`, `team1_name`, `team1_seourl`, `team1_betradaruid`, `team2_tournament_uid`, `team2_name`, `team2_seourl`, `team2_betradaruid`) SELECT `p`.`uid`, `p`.`feed_uid`, `p`.`sport_uid`, `p`.`category_uid`, `p`.`tournament_uid`, `p`.`team1_uid`, `p`.`team2_uid`, `p`.`url`, `p`.`language`, `p`.`posted_on`, `p`.`seourl`, `feed`.`name` AS feedname, `feed`.`vendor_icon` AS `feedicon`, `sport`.`name` AS `sportname`, `cat`.`name` AS `catname`, `tn`.`name` AS `trnmntname`, `untn`.`name` AS `untnname`, `tntm1`.`tournament_uid` AS `team1_tournament_uid`, `tm1`.`name` AS `team1_name`, `tm1`.`seourl` AS `team1_seourl`, `tm1`.`betradar_uid` AS `team1_betradaruid`, `tntm2`.`tournament_uid` AS `team2_tournament_uid`, `tm2`.`name` AS `team2_name`, `tm2`.`seourl` AS `team2_seourl`, `tm2`.`betradar_uid` AS `team2_betradaruid` FROM `sportnews_post` AS `p` LEFT JOIN `sportnews_feed` AS `feed` ON `p`.`feed_uid` = `feed`.`uid` LEFT JOIN `sportnews_tournament_team` AS `tntm1` ON `tntm1`.`team_uid` = `p`.`team1_uid` LEFT JOIN `sportnews_tournament` AS `tn1` ON `tn1`.`uid` = `tntm1`.`tournament_uid` LEFT JOIN `sportnews_tournament_team` AS tntm2 ON `tntm2`.`team_uid` = `p`.`team2_uid` LEFT JOIN `sportnews_tournament` AS `tn2` ON `tn2`.`uid` = `tntm2`.`tournament_uid` LEFT JOIN `sportnews_team` AS tm1 ON `tm1`.`uid` = `p`.`team1_uid` LEFT JOIN `sportnews_team` AS tm2 ON `tm2`.`uid` = `p`.`team2_uid` LEFT JOIN `sportnews_tournament` as tn ON `p`.`tournament_uid` = `tn`.`uid` LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `p`.`unique_tournament_uid` LEFT JOIN `sportnews_category` AS `cat` ON `cat`.`uid` = `p`.`category_uid` LEFT JOIN `sportnews_sport` AS `sport` ON `sport`.`uid` = `p`.`sport_uid` WHERE ( `tn`.`uid` IS NULL OR `tn`.`hidden` = 0 ) AND ( `untn`.`uid` IS NULL OR `untn`.`hidden` = 0 ) AND ( `cat`.`uid` IS NULL OR `cat`.`hidden` = 0 ) AND ( `sport`.`uid` IS NULL OR `sport`.`hidden` = 0 ) AND (( `tn1`.`uid` IS NULL OR `tn1`.`hidden` = 0 ) OR ( `tn2`.`uid` IS NULL OR `tn2`.`hidden` = 0 )) AND (( `tm1`.`uid` IS NULL OR `tm1`.`deleted` = 0 ) OR ( `tm2`.`uid` IS NULL OR `tm2`.`deleted` = 0 )) AND `p`.`hidden` = 0 AND `p`.`deleted` = 0 AND `p`.`posted_on` < UNIX_TIMESTAMP() AND `p`.`posted_on` > UNIX_TIMESTAMP() - 15724800 GROUP BY `p`.`uid`, `p`.`tournament_uid`, `tntm1`.`tournament_uid`, `tntm2`.`tournament_uid` ORDER BY `p`.`posted_on` DESC;
  RENAME TABLE `sportnews_cache_post_tournament` TO `sportnews_cache_post_tournament_old`, `sportnews_cache_post_tournament_tmp` TO `sportnews_cache_post_tournament`;
  DROP TABLE `sportnews_cache_post_tournament_old`;
  COMMIT;
  END;;
  DELIMITER ;

  // TEAM UPDATE PROCEDURE
  DROP PROCEDURE IF EXISTS `cache_post_team_update`;
  DELIMITER ;;
  CREATE PROCEDURE cache_post_team_update()
  MODIFIES SQL DATA
  BEGIN START TRANSACTION;
  DROP TABLE IF EXISTS `sportnews_cache_post_team_tmp`;
  CREATE TABLE `sportnews_cache_post_team_tmp` LIKE `sportnews_cache_post_team`;
  INSERT INTO `sportnews_cache_post_team_tmp` (`uid`, `feed_uid`, `sport_uid`, `category_uid`, `tournament_uid`, `team1_uid`, `team2_uid`, `url`, `language`, `posted_on`, `seourl`, `feedname`, `feedicon`, `sportname`, `catname`, `trnmntname`, `untnname`, `team1_name`, `team1_seourl`, `team1_betradaruid`, `team2_name`, `team2_seourl`, `team2_betradaruid`) SELECT `p`.`uid`, `p`.`feed_uid`, `p`.`sport_uid`, `p`.`category_uid`, `p`.`tournament_uid`, `p`.`team1_uid`, `p`.`team2_uid`, `p`.`url`, `p`.`language`, `p`.`posted_on`, `p`.`seourl`, `feed`.`name` AS feedname, `feed`.`vendor_icon` AS `feedicon`, `sport`.`name` AS `sportname`, `cat`.`name` AS `catname`, `tn`.`name` AS `trnmntname`, `untn`.`name` AS `untnname`, `tm1`.`name` AS `team1_name`, `tm1`.`seourl` AS `team1_seourl`, `tm1`.`betradar_uid` AS `team1_betradaruid`, `tm2`.`name` AS `team2_name`, `tm2`.`seourl` AS `team2_seourl`, `tm2`.`betradar_uid` AS `team2_betradaruid` FROM `sportnews_post` AS `p` LEFT JOIN `sportnews_feed` AS `feed` ON `p`.`feed_uid` = `feed`.`uid` LEFT JOIN `sportnews_tournament` as tn ON `p`.`tournament_uid` = `tn`.`uid` LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `p`.`unique_tournament_uid` LEFT JOIN `sportnews_category` AS `cat` ON `cat`.`uid` = `p`.`category_uid` LEFT JOIN `sportnews_sport` AS `sport` ON `sport`.`uid` = `p`.`sport_uid` LEFT JOIN `sportnews_team` AS `tm1` ON `tm1`.`uid` = `p`.`team1_uid` LEFT JOIN `sportnews_team` AS `tm2` ON `tm2`.`uid` = `p`.`team2_uid` WHERE ( `tn`.`uid` IS NULL OR `tn`.`hidden` = 0 ) AND ( `untn`.`uid` IS NULL OR `untn`.`hidden` = 0 ) AND ( `cat`.`uid` IS NULL OR `cat`.`hidden` = 0 ) AND ( `sport`.`uid` IS NULL OR `sport`.`hidden` = 0 ) AND (( `tm1`.`uid` IS NULL OR `tm1`.`deleted` = 0 ) OR ( `tm2`.`uid` IS NULL OR `tm2`.`deleted` = 0 )) AND `p`.`hidden` = 0 AND `p`.`deleted` = 0 AND `p`.`posted_on` < UNIX_TIMESTAMP() GROUP BY `p`.`uid`, `p`.`team1_uid`, `p`.`team2_uid` ORDER BY `p`.`posted_on` DESC;
  RENAME TABLE `sportnews_cache_post_team` TO `sportnews_cache_post_team_old`, `sportnews_cache_post_team_tmp` TO `sportnews_cache_post_team`;
  DROP TABLE `sportnews_cache_post_team_old`;
  COMMIT;
  END;;

  // CATEGORY UPDATE PROCEDURE
  DROP PROCEDURE IF EXISTS `cache_post_category_update`;
  DELIMITER ;;
  CREATE PROCEDURE cache_post_category_update()
  MODIFIES SQL DATA
  BEGIN START TRANSACTION;
  DROP TABLE IF EXISTS `sportnews_cache_post_category_tmp`;
  CREATE TABLE `sportnews_cache_post_category_tmp` LIKE `sportnews_cache_post_category`;
  INSERT INTO `sportnews_cache_post_category_tmp` (`uid`, `feed_uid`, `sport_uid`, `category_uid`, `tournament_uid`, `team1_uid`, `team2_uid`, `url`, `language`, `posted_on`, `seourl`, `feedname`, `feedicon`, `sportname`, `catname`, `trnmntname`, `untnname`, `team1_category_uid`, `team1_name`, `team1_seourl`, `team1_betradaruid`, `team2_category_uid`, `team2_name`, `team2_seourl`, `team2_betradaruid`) SELECT `p`.`uid`, `p`.`feed_uid`, `p`.`sport_uid`, `p`.`category_uid`, `p`.`tournament_uid`, `p`.`team1_uid`, `p`.`team2_uid`, `p`.`url`, `p`.`language`, `p`.`posted_on`, `p`.`seourl`, `feed`.`name` AS feedname, `feed`.`vendor_icon` AS `feedicon`, `sport`.`name` AS `sportname`, `cat`.`name` AS `catname`, `tn`.`name` AS `trnmntname`, `untn`.`name` AS `untnname`, `cttm1`.`category_uid` AS `team1_category_uid`, `tm1`.`name` AS `team1_name`, `tm1`.`seourl` AS `team1_seourl`, `tm1`.`betradar_uid` AS `team1_betradaruid`, `cttm2`.`category_uid` AS `team2_category_uid`, `tm2`.`name` AS `team2_name`, `tm2`.`seourl` AS `team2_seourl`, `tm2`.`betradar_uid` AS `team2_betradaruid` FROM `sportnews_post` AS `p` LEFT JOIN `sportnews_feed` AS `feed` ON `p`.`feed_uid` = `feed`.`uid` LEFT JOIN `sportnews_tournament` as tn ON `p`.`tournament_uid` = `tn`.`uid` LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `p`.`unique_tournament_uid` LEFT JOIN `sportnews_category` AS `cat` ON `cat`.`uid` = `p`.`category_uid` LEFT JOIN `sportnews_sport` AS `sport` ON `sport`.`uid` = `p`.`sport_uid` LEFT JOIN `sportnews_category_team` AS `cttm1` ON `cttm1`.`team_uid` = `p`.`team1_uid` LEFT JOIN `sportnews_category` AS `cat1` ON `cat1`.`uid` = `cttm1`.`category_uid` LEFT JOIN `sportnews_category_team` AS `cttm2` ON `cttm2`.`team_uid` = `p`.`team2_uid` LEFT JOIN `sportnews_category` AS `cat2` ON `cat2`.`uid` = `cttm2`.`category_uid` LEFT JOIN `sportnews_team` AS tm1 ON `tm1`.`uid` = `p`.`team1_uid` LEFT JOIN `sportnews_team` AS tm2 ON `tm2`.`uid` = `p`.`team2_uid` WHERE ( `tn`.`uid` IS NULL OR `tn`.`hidden` = 0 ) AND ( `untn`.`uid` IS NULL OR `untn`.`hidden` = 0 ) AND ( `cat`.`uid` IS NULL OR `cat`.`hidden` = 0 ) AND ( `sport`.`uid` IS NULL OR `sport`.`hidden` = 0 ) AND (( `cat1`.`uid` IS NULL OR `cat1`.`hidden` = 0 ) OR ( `cat2`.`uid` IS NULL OR `cat2`.`hidden` = 0 )) AND (( `tm1`.`uid` IS NULL OR `tm1`.`deleted` = 0 ) OR ( `tm2`.`uid` IS NULL OR `tm2`.`deleted` = 0 )) AND `p`.`hidden` = 0 AND `p`.`deleted` = 0 AND `p`.`posted_on` < UNIX_TIMESTAMP() GROUP BY `p`.`uid`, `p`.`category_uid`, `cttm1`.`category_uid`, `cttm2`.`category_uid` ORDER BY `p`.`posted_on` DESC;
  RENAME TABLE `sportnews_cache_post_category` TO `sportnews_cache_post_category_old`, `sportnews_cache_post_category_tmp` TO `sportnews_cache_post_category`;
  DROP TABLE `sportnews_cache_post_category_old`;
  COMMIT;
  END;;
  DELIMITER ;

  // SPORT UPDATE PROCEDURE
  DROP PROCEDURE IF EXISTS `cache_post_sport_update`;
  DELIMITER ;;
  CREATE  PROCEDURE cache_post_sport_update()
  MODIFIES SQL DATA
  BEGIN START TRANSACTION; 

  DROP TABLE IF EXISTS `sportnews_cache_post_sport_tmp`;
  CREATE TABLE `sportnews_cache_post_sport_tmp` LIKE `sportnews_cache_post_sport`;


  INSERT INTO `sportnews_cache_post_sport_tmp` (`uid`, `feed_uid`, `sport_uid`, `category_uid`, `tournament_uid`, `team1_uid`, `team2_uid`, `url`, `language`, `posted_on`, `seourl`, `feedname`, `feedicon`, `sportname`, `catname`, `trnmntname`, `untnname`, `team1_sport_uid`, `team1_name`, `team1_seourl`, `team1_betradaruid`, `team2_sport_uid`, `team2_name`, `team2_seourl`, `team2_betradaruid`) SELECT `p`.`uid`, `p`.`feed_uid`, `p`.`sport_uid`, `p`.`category_uid`, `p`.`tournament_uid`, `p`.`team1_uid`, `p`.`team2_uid`, `p`.`url`, `p`.`language`, `p`.`posted_on`, `p`.`seourl`, `feed`.`name` AS feedname, `feed`.`vendor_icon` AS `feedicon`, `sport`.`name` AS `sportname`, `cat`.`name` AS `catname`, `tn`.`name` AS `trnmntname`, `untn`.`name` AS `untnname`, `sttm1`.`sport_uid` AS `team1_sport_uid`, `tm1`.`name` AS `team1_name`, `tm1`.`seourl` AS `team1_seourl`, `tm1`.`betradar_uid` AS `team1_betradaruid`, `sttm2`.`sport_uid` AS `team2_sport_uid`, `tm2`.`name` AS `team2_name`, `tm2`.`seourl` AS `team2_seourl`, `tm2`.`betradar_uid` AS `team2_betradaruid` FROM `sportnews_post` AS `p` LEFT JOIN `sportnews_feed` AS `feed` ON `p`.`feed_uid` = `feed`.`uid` LEFT JOIN `sportnews_tournament` as tn ON `p`.`tournament_uid` = `tn`.`uid` LEFT JOIN `sportnews_unique_tournament` as untn ON `untn`.`uid` = `p`.`unique_tournament_uid` LEFT JOIN `sportnews_category` AS `cat` ON `cat`.`uid` = `p`.`category_uid` LEFT JOIN `sportnews_sport` AS `sport` ON `sport`.`uid` = `p`.`sport_uid` LEFT JOIN `sportnews_sport_team` AS `sttm1` ON `sttm1`.`team_uid` = `p`.`team1_uid` LEFT JOIN `sportnews_sport` AS `sport1` ON `sport1`.`uid` = `sttm1`.`sport_uid` LEFT JOIN `sportnews_sport_team` AS `sttm2` ON `sttm2`.`team_uid` = `p`.`team2_uid` LEFT JOIN `sportnews_sport` AS `sport2` ON `sport2`.`uid` = `sttm2`.`sport_uid` LEFT JOIN `sportnews_team` AS tm1 ON `tm1`.`uid` = `p`.`team1_uid` LEFT JOIN `sportnews_team` AS tm2 ON `tm2`.`uid` = `p`.`team2_uid` WHERE ( `tn`.`uid` IS NULL OR `tn`.`hidden` = 0 ) AND ( `untn`.`uid` IS NULL OR `untn`.`hidden` = 0 ) AND ( `cat`.`uid` IS NULL OR `cat`.`hidden` = 0 ) AND ( `sport`.`uid` IS NULL OR `sport`.`hidden` = 0 ) AND (( `sport1`.`uid` IS NULL OR `sport1`.`hidden` = 0 ) OR ( `sport2`.`uid` IS NULL OR `sport2`.`hidden` = 0 )) AND (( `tm1`.`uid` IS NULL OR `tm1`.`deleted` = 0 ) OR ( `tm2`.`uid` IS NULL OR `tm2`.`deleted` = 0 )) AND `p`.`hidden` = 0 AND `p`.`deleted` = 0 AND `p`.`posted_on` < UNIX_TIMESTAMP() GROUP BY `p`.`uid`, `p`.`sport_uid`, `sttm1`.`sport_uid`, `sttm2`.`sport_uid` ORDER BY `p`.`posted_on` DESC;

  RENAME TABLE `sportnews_cache_post_sport` TO `sportnews_cache_post_sport_old`, `sportnews_cache_post_sport_tmp` TO `sportnews_cache_post_sport`;
  DROP TABLE `sportnews_cache_post_sport_old`;

  COMMIT; END;;
  DELIMITER ;



*/
