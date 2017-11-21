<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Post
 * @property Ion_auth $ion_auth
 * @property Language_model $Language
 */
class Language extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('backend/language_model', 'Language', true);
        if ($this->session->userdata('languagesettings_language_uid') === false) {
            $this->session->set_userdata('languagesettings_language_uid', 1);
        }

    }

    public function activate($uid) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            $this->Language->activate($uid);
            $this->session->set_flashdata('message', 'Sprache wurde erfolgreich aktiviert.');
            redirect('backend/language', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/language', 'refresh');
        }
    }

    public function add_string() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            if ($this->Language->insert_value()) {
                $this->session->set_flashdata('message', 'String wurde erfolgreich hinzugefügt.');
            } else {
                $this->session->set_flashdata('error', 'String konnte nicht hinzugefügt werden.');
            }
            redirect('backend/language', 'refresh');

        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/language', 'refresh');
        }
    }

    public function deactivate($uid) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            $this->Language->deactivate($uid);
            $this->session->set_flashdata('message', 'Sprache wurde erfolgreich deaktiviert.');
            redirect('backend/language', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/language', 'refresh');
        }
    }

    public function index() {

        if ($this->ion_auth->logged_in()) {
            $this->load->model('backend/language_model', 'Language', true);
            $headerdata['title'] = 'Spracheinstellungen | BIB - Betreiberbackend';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            if ($this->session->flashdata('message') != "") {
                $data['message'] = $this->session->flashdata('message');
            }
            if ($this->session->flashdata('error') != "") {
                $data['message'] = $this->session->flashdata('error');
            }

            $data['languages'] = $this->Language->get_languages();
            $data['currentlang'] = $this->session->userdata('languagesettings_language_uid');
            $data['langstrings'] =
                $this->Language->get_language_strings($this->session->userdata('languagesettings_language_uid'));

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/language/index', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            redirect('backend/auth/login', 'refresh');
        }
    }

    public function insert_or_update($identifier, $value, $language) {
        return $this->Language->add_or_update_string($identifier, $value, $language);
    }

    public function reorder() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            $this->Language->reorder($this->input->post('data'));
            echo "Sortierung erfolgreich gespeichert.";
        } else {
            echo "Beim Speichern der Sortierung ist ein Fehler aufgetreten.";
        }
    }

    public function show_form($language) {
        $data['language_uid'] = (int)$language;

        $this->load->view('backend/language/form', $data);
    }

    public function switch_language($language_uid) {
        $uid = (int)$language_uid;
        $this->session->set_userdata('languagesettings_language_uid', $uid);
        $this->session->set_flashdata('message', 'Sprache erfolgreich gewechselt');
        redirect('backend/language', 'refresh');
    }

    public function update_language() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            $this->Language->update_language();
        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/language', 'refresh');
        }
    }

    public function update_string() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            $this->Language->update_value();
        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/language', 'refresh');
        }
    }
}

/* End of file home.php */
/* Location: ./application/controllers/backend/home.php */