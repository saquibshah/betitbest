<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of app_stats_service
 *
 * @author BIB Developer
 */
class App_stats_service extends CI_Controller {

    public function index() {
        $DEFAULT_API_KEY = 'a@AGa23$!abc9';
        $api_key = $this->input->get('apikey');

        $out = new stdClass();
        if ($DEFAULT_API_KEY !== $api_key) {
            $out->status = 'error';
            $out->message = 'Wrong API key';
            echo json_encode($out);
            exit;
        }

        $betradaruid = intval($this->input->get('bid'));
        $sport = $this->input->get('sport');
        
        if (empty($betradaruid) || empty($sport)) {
            $out->status = 'error';
            $out->message = 'Invalid data';
            echo json_encode($out);
            exit;
        }
        
        $this->load->model('livescores/m_statisticapp');
        $this->m_statisticapp->loadParameters(array($sport, $betradaruid));
        $data = $this->m_statisticapp->getData();
        
        if ($data === FALSE) {
            $out->status = 'error';
            $out->message = 'Invalid data';
            echo json_encode($out);
            exit;
        }
        
        $out->data = new stdClass();
        $out->data->recentMatches = $data['s7'];
        $out->data->lastMeetings = $data['s4'];
        $out->data->overUnder = $data['s17'];
        $out->status = 'success';
        echo json_encode($out);
        exit;
    }
}
