<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Post
 * @property Ion_auth $ion_auth
 * @property Settings_model $Settings
 */
class User extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('backend/Settings_model', 'Settings', true);
    }

    public function bets($site = "first") {
        $this->load->helper('player_helper');

        if (player_logged_in()) {

            $headerdata['navigation'] = $this->Settings->get_navigation();
            $headerdata['bodyclass'] = 'scroll';

            $this->load->view('layouts/frontend_head', $headerdata);
            $this->load->view('layouts/user_head');
            if ($site == "second") {
                $this->load->view('user/bets2');
            } else {
                $this->load->view('user/bets');
            }
            $this->load->view('layouts/user_footer');
            $this->load->view('layouts/frontend_footer');

        } else {
            redirect('/home', 'refresh');
        }
    }

    public function form_login() {
        $this->load->helper('form');

        $settings = array(
            'width' => '550',
            'height' => '350'
        );

        $this->load->view('layouts/lightbox_head', $settings, true);
        $this->load->view('modals/form_login', array(), true);
        $this->load->view('layouts/lightbox_footer', array(), true);
    }

    public function index() {
        $this->load->helper('player_helper');

        if (player_logged_in()) {

            $headerdata = array();
            $headerdata['navigation'] = $this->Settings->get_navigation();
            $headerdata['bodyclass'] = 'scroll';

            $this->load->view('layouts/frontend_head', $headerdata);
            $this->load->view('layouts/user_head');
            $this->load->view('user/dashboard');
            $this->load->view('layouts/user_footer');
            $this->load->view('layouts/frontend_footer');

        } else {
            redirect('/home', 'refresh');
        }
    }

    public function login() {
        if ($this->ion_auth->login($this->input->post('login'), $this->input->post('password'), false)) {
            if ($this->ion_auth->in_group(4)) {
                echo '{"status" : "success"}';
            } else {
                echo '{"status" : "error"}';
            }
        } else {
            echo '{"status" : "error"}';
        }
    }

    public function logout() {
        $this->ion_auth->logout();
        redirect('home', 'refresh');
    }

    public function payments($site = "first") {
        $this->load->helper('player_helper');

        if (player_logged_in()) {

            $headerdata['navigation'] = $this->Settings->get_navigation();
            $headerdata['bodyclass'] = 'scroll';

            $this->load->view('layouts/frontend_head', $headerdata);
            $this->load->view('layouts/user_head');
            if ($site == 'second') {
                $this->load->view('user/payments2');
            } else {
                $this->load->view('user/payments');
            }
            $this->load->view('layouts/user_footer');
            $this->load->view('layouts/frontend_footer');

        } else {
            redirect('/home', 'refresh');
        }
    }

    public function settings($page = "first") {
        $this->load->helper('player_helper');

        if (player_logged_in()) {

            $headerdata['navigation'] = $this->Settings->get_navigation();
            $headerdata['bodyclass'] = 'scroll';

            $this->load->view('layouts/frontend_head', $headerdata);
            $this->load->view('layouts/user_head');

            $getpage = 'personal';

            switch ($page) {

                case 'second':
                    $getpage = 'personal2';
                    break;
                case 'third':
                    $getpage = 'personal3';
                    break;
                case 'four':
                    $getpage = 'personal4';
                    break;
                case 'five':
                    $getpage = 'personal5';
                    break;

            }

            $this->load->view('user/' . $getpage);
            $this->load->view('layouts/user_footer');
            $this->load->view('layouts/frontend_footer');

        } else {
            redirect('/home', 'refresh');
        }
    }
}