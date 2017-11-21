<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of newservices
 *
 */
class Euro_news_service_new extends CI_Controller {
    public function _remap() {
        $segs = $this->uri->segment_array();
        if (@$segs[5] == "get_news") {
            $this->get_news();
        }
    }

    public function get_news() {
        $DEFAULT_API_KEY = 'a@AGa23$!abc9';
        $this->load->model('euro_news_new_model', 'euro_news_model', true);
        
        $api_key = $this->input->get('apikey');
        
        //Get parmeter from request. Format: &parameter=id,id,id...
        $team_string = rawurldecode(utf8_decode($this->input->get('team')));
        $tournament_string = rawurldecode(utf8_decode($this->input->get('tournament')));
        $category_string = rawurldecode(utf8_decode($this->input->get('category')));
        $language = rawurldecode(utf8_decode($this->input->get('lang')));
        $sport_string = rawurldecode(utf8_decode($this->input->get('sport')));
        $mark_time = intval($this->input->get('time'));
        
        $teamBetradarIds = trim($team_string);
        if (!empty($teamBetradarIds))  {
            $teamBetradarIds = explode(",", $teamBetradarIds);
            $teamBetradarIds = array_map('intval', $teamBetradarIds);
        }
        
        $tournamentBetradarIds = trim($tournament_string);
        if (!empty($tournamentBetradarIds)) {
            $tournamentBetradarIds = explode(",", $tournamentBetradarIds);
            $tournamentBetradarIds = array_map('intval', $tournamentBetradarIds);
        }
        
        $categoryBetadarIDs = trim($category_string);
        if (!empty($categoryBetadarIDs)) {
            $categoryBetadarIDs = explode(",", $categoryBetadarIDs);
            $categoryBetadarIDs = array_map('intval', $categoryBetadarIDs);
        }
        
        $sportBetradarIDs = trim($sport_string);
        if (!empty($sportBetradarIDs))  {
            $sportBetradarIDs = explode(",", $sportBetradarIDs);
            $sportBetradarIDs = array_map('intval', $sportBetradarIDs);
        }
        
        
        $only_localized = rawurldecode(utf8_decode($this->input->get('only_localized')));
        if ($only_localized == '' || $only_localized == 'false') {
            $only_localized = false;
        } else {
            $only_localized = true;
        }
        $page = intval(rawurldecode(utf8_decode($this->input->get('page')))) - 1;
        $page = $page < 0 ? 0 : $page;

        //Init return object that contains the return data
        $out = new stdClass();
        
        //Check that the api key is correct or not
        if ($api_key !== $DEFAULT_API_KEY) {
            $out->status = 'error';
            $out->message = 'Wrong API key';
            return $this->response($out, 200);
        }

        //Get data return
        $out->status = 'success';
        $out->result = $this->euro_news_model->get_euro($only_localized, $page * 20, $limit = 20, $teamBetradarIds, $tournamentBetradarIds, $categoryBetadarIDs, $sportBetradarIDs, $mark_time, $language);
        return $this->response($out, 200);
    }

    private function response($output, $http_code = 200) {
        header('HTTP/1.1: ' . $http_code);
        header('Status: ' . $http_code);
        exit(json_encode($output));
    }

}
