<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Content
 * @property sport_model $sport
 */
class Content extends CI_Controller {

    public function _remap() {
        $segs = $this->uri->segment_array();

        $this->load->model('sport_model', 'sport', true);
        $this->load->model('match_model', 'match', true);

        $headerdata = array(
            'sports' => $this->sport->get_sports(true),
            'current_category' => dblang("choose_category"),
            'ishome' => true,
            'headline' => '',
            'headerImage' => '/assets/frontend/images/header_ueber_uns.jpg',
        );

        $this->load->view('layouts/frontend_head', $headerdata);
        $data['favs'] = $this->load->view('layouts/favorites', array(), true);
        switch ($segs[4]) {
            case 'imprint':
                $this->load->view('imprint');
                break;
            case 'about_us':
                $this->load->view('about');
                break;
            case 'agb':
                $this->load->view('agb');
                break;
            case 'privacy':
                $this->load->view('privacy');
                break;
            case 'jobs':
                break;
        }

        $this->load->view('layouts/frontend_footer', $data);

    }

}