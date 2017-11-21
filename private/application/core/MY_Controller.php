<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Base-controller that should be extended by any non-cli controller.
 *
 * @package BIBSB\Core
 *
 * @property Ion_auth ion_auth
 * @property Ion_auth_model $ion_auth_model
 * @property User_model $User
 * @property Settings_model $Settings
 * @property MY_Lang lang
 */
class MY_Controller extends CI_Controller {

    /**
     * The constructor loads common models and libraries and loads the application-config.
     */
    public function __construct() {
        parent::__construct();

        $this->load->model('ion_auth_model');
        $this->load->library('ion_auth');

        $this->config->load('application', true, true);
    }

    /**
     * Displays json-content and sets correct headers etc.
     *
     * @param string|array|stdClass $content
     * @param bool $return If false the method will exit
     * @return void|string
     *
     * @deprecated Use json-helper.
     */
    protected function returnJson($content, $return = false) {
        if (!is_string($content)) {
            $content = json_encode($content);
        }
        $this->output->set_content_type('application/json')->set_output($content);

        if (!$return) {
            echo $content;
            exit;
        }
    }
}
