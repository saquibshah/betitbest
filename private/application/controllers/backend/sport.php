<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Sport
 * @property Ion_auth $ion_auth
 * @property sport_model $sport
 * @property language_model $language
 * @property keyword_model $keyword
 * @property seo_model $seo
 */
class Sport extends CI_Controller {

    public function create_seourls() {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(array(1, 2))) {
            redirect('/backend/auth/login');
        }

        $this->load->model('seo_model', 'Seo', true);

        $result = $this->db->where('seourl', '')->get('sport')->result();

        foreach ($result as $res) {
            $url = $this->Seo->sanitizeUrl($res->name);
            $urlCheck = $url;

            for ($i = 1; ; $i++) {
                $numRows = $this->db->select('uid')->where('seourl', $urlCheck)->get('sport')->num_rows();

                if ($numRows !== false && $numRows > 0) {
                    $urlCheck = "{$url}-{$i}";
                } else {
                    break;
                }
            }

            $url = $urlCheck;

            $this->db->where('uid', $res->uid)->update('sport', array('seourl' => $url));
        }
    }

    public function edit($id) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->model('sport_model', 'sport', true);
            $this->load->model('keyword_model', 'keyword', true);
            $this->load->model('backend/language_model', 'language', true);

            $this->load->helper('form');

            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $data = array();

            $data['sport'] = $this->sport->get_single($id);

            $data['uid'] = $data['sport']['uid'];

            $headerdata['title'] = 'Sportart Konfiguration | BET-IT-BEST';

            $data['action'] = 'update/' . $data['sport']['uid'];
            $data['headline'] = 'Sportart <strong>' . $data['sport']['name'] . '</strong> bearbeiten';

            $data['form']['uid'] = array(
                'name' => 'uid',
                'id' => 'uid',
                'value' => $data['sport']['uid'],
                'class' => 'form-control',
                'disabled' => 'disabled'
            );

            $langs = $this->language->get_languages();
            $data['langs'] = $langs;

            foreach ($langs as $item) {

                $data['form']['name_local_' . $item->uid] = array(
                    'name' => 'name_local_' . $item->uid,
                    'id' => 'name_local_' . $item->uid,
                    'type' => 'text',
                    'value' => dblang('sport_' . $data['sport']['uid'] . '_name', $item->uid, false),
                    'class' => 'form-control'
                );
            }

            $data['form']['name'] = array(
                'class' => 'form-control',
                'name' => 'name',
                'id' => 'name',
                'type' => 'text',
                'value' => $data['sport']['name']
            );

            $data['form']['hidden'] = array(
                'name' => 'hidden',
                'id' => 'hidden',
                'value' => '1',
                'class' => 'form-control',
                'checked' => false
            );

            $data['form']['header_image'] = array(
                'name' => 'header_image',
                'id' => 'header_image',
                'type' => 'file',
            );

            $data['form']['current_image'] = $data['sport']['header_image'];

            if ($data['sport']['hidden'] === '1') {
                $data['form']['hidden']['checked'] = true;
            }

            $data['keywords'] = $this->keyword->get_sport_matchings($data['sport']['uid']);

            $bl = $this->keyword->get_blacklist($data['sport']['uid'], 'sportnews_sport');
            if (count($bl['uids']) > 0 && count($bl['texts']) === count($bl['uids'])) {
                $data['blacklistitem_uids'] = implode(',', $bl['uids']);
                $data['blacklistitem_texts'] = implode('||', $bl['texts']);
            } else {
                $data['blacklistitem_uids'] = "";
                $data['blacklistitem_texts'] = "";
            }

            $data['submitbtn'] = array(
                'class' => 'btn green',
                'type' => 'submit',
                'content' => 'Speichern',
                'name' => 'submitbutton'
            );

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/sport/edit', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/feed', 'refresh');
        }
    }

    public function index() {

        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {
            $this->load->model('sport_model', 'sport', true);

            $data = array();

            if ($this->session->flashdata('message') != "") {
                $data['message'] = $this->session->flashdata('message');
            }
            if ($this->session->flashdata('error') != "") {
                $data['message'] = $this->session->flashdata('error');
            }

            $headerdata['title'] = 'Sportarten Konfiguration | BET-IT-BEST';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $data['sports'] = $this->sport->get_sports();

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/sport/index', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            redirect('backend/auth/login', 'refresh');
        }
    }

    public function update($uid) {

        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $sport_array = $this->input->post();


            $this->load->model('seo_model', 'seo', true);
            $sport_array = $this->seo->backend_save($sport_array);

            $this->load->model('backend/language_model', 'language', true);
            $this->load->model('sport_model', 'sport', true);
            $this->load->model('keyword_model', 'keyword', true);

            $ulconfig = array(
                'upload_path' => 'pool/uploads/sport/',
                'allowed_types' => 'jpg|png',
                'max_size' => '300000',
                'encrypt_name' => true
            );

            $this->load->library('upload', $ulconfig);

            if ($this->upload->do_upload('header_image') == true) {
                $imgdata = $this->upload->data();
                $this->sport->set_headerimage($uid, $imgdata['file_name']);
            }

            unset($sport_array['submitbutton']);


            $this->keyword->deleteBlacklist("sportnews_sport", $uid);
            $this->keyword->delete_keyword_matchings($sport_array['remove_keywords_string']);
            unset($sport_array['remove_keywords_string']);

            $blacklistitems = explode("||", $sport_array['blacklistitems']);

            foreach ($blacklistitems as $item) {
                if ((string)(int)$item == $item) {
                    $this->keyword->addBlacklistKeyword($item, "sportnews_sport", $uid);
                } else {
                    $this->keyword->createBlacklistKeyword($item, "sportnews_sport", $uid);
                }
            }
            foreach ($sport_array as $key => $val) {
                if (strpos($key, 'name_local') !== false) {
                    $this->language->insert_or_update_string('sport_' . $uid . '_name', $val,
                        (int)str_replace('name_local_', '', $key));
                }
            }


            $this->sport->set_name($uid, $sport_array['name']);

            if (isset($sport_array['hidden'])) {
                $this->sport->deactivate($uid);
            } else {
                $this->sport->activate($uid);
            }

            $this->session->set_flashdata('message', 'Ihre Änderungen wurden erfolgreich gespeichert.');
            redirect('backend/sport', 'refresh');

            $this->session->set_flashdata('error',
                'Beim Speichern Ihrer Änderungen ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.');
            redirect('backend/sport', 'refresh');

        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/sport', 'refresh');
        }

    }

}

/* End of file home.php */
/* Location: ./application/controllers/backend/home.php */