<?php

class Categorization_model extends CI_Model {

    public function update() {

      $this->db->select('*')->from('post')->where('recategorize', 1)->limit(250);
      $res = $this->db->get()->result();

      foreach($res as $row) {

        $this->db->where('post_uid', $row->uid)->delete('post_category_cache');

        $qry = "";

        if ((int) $row->team1_uid > 0) {
          $qry  = "INSERT IGNORE INTO sportnews_post_category_cache (category_uid, post_uid, posted_on_negate) ";
          $qry .= "SELECT tn.category_uid, p.uid, p.posted_on_negate FROM sportnews_post as p ";
          $qry .= "JOIN sportnews_team AS tm ON tm.uid = p.team1_uid ";
          $qry .= "JOIN sportnews_tournament_team AS tntm ON tntm.team_uid = tm.uid ";
          $qry .= "JOIN sportnews_tournament AS tn ON tn.uid = tntm.tournament_uid ";
          $qry .= "WHERE p.uid = " . $row->uid . " ";
          $qry .= "GROUP BY tn.category_uid ";
        } else if ((int) $row->unique_tournament_uid > 0) {
          $qry  = "INSERT IGNORE INTO sportnews_post_category_cache (category_uid, post_uid, posted_on_negate) ";
          $qry .= "SELECT tn.category_uid, p.uid, p.posted_on_negate FROM sportnews_post as p ";
          $qry .= "JOIN sportnews_tournament AS tn ON tn.unique_uid = p.unique_tournament_uid ";
          $qry .= "WHERE p.uid = " . $row->uid . " ";
          $qry .= "GROUP BY tn.category_uid ";
        } else if ((int) $row->tournament_uid > 0) {
          $qry  = "INSERT IGNORE INTO sportnews_post_category_cache (category_uid, post_uid, posted_on_negate) ";
          $qry .= "SELECT tn.category_uid, p.uid, p.posted_on_negate FROM sportnews_post as p ";
          $qry .= "JOIN sportnews_tournament AS tn ON tn.uid = p.tournament_uid ";
          $qry .= "WHERE p.uid = " . $row->uid . " ";
          $qry .= "GROUP BY tn.category_uid ";
        } else if ((int) $row->category_uid > 0) {
          $qry  = "INSERT IGNORE INTO sportnews_post_category_cache (category_uid, post_uid, posted_on_negate) ";
          $qry .= "SELECT cat.uid, p.uid, p.posted_on_negate FROM sportnews_post as p ";
          $qry .= "JOIN sportnews_category AS cat ON cat.uid = p.category_uid ";
          $qry .= "WHERE p.uid = " . $row->uid . " ";
        }

        if ($qry !== "") {
          $this->db->query($qry);
        }
        $this->db->where('uid', $row->uid)->update('post', array('recategorize' => 0));

      }

    }

}
