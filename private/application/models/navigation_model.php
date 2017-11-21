<?php

class Navigation_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_navigation_for_team($team) {
      $this->load->model('team_model', 'team', true);
      $this->load->model('tournament_model', 'tournament', true);
      $this->load->model('category_model', 'category', true);
      $this->load->model('sport_model', 'sport', true);
      $tournament = $this->tournament->get_by_team($team['uid'], $team['main_tournament_uid'], $team['main_unique_tournament_uid']);
      $category = $this->category->get_single($tournament['category_uid'], $team['main_category_uid']);
      $sport = $this->sport->get_single($category['sport_uid']);

      $categories = $this->category->get_by_sport($sport['uid'], true);
      $tournaments = $this->tournament->get_by_category($category['uid']);

      $ret = array(
        "teams" => array(),
        "tournaments" => $tournaments,
        "categories" => $categories,
        "sport" => $sport,
        "currentteam" => $team,
        "currenttournament" => $tournament,
        "currentcategory" => $category,
        "currentsport" => $sport
      );

      return $ret;

    }

}
