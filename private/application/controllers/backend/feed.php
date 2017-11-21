<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Post
 * @property Ion_auth $ion_auth
 * @property sport_model $sport
 * @property language_model $language
 * @property keyword_model $keyword
 * @property seo_model $seo
 * @property feed_model $feed
 * @property team_model $team
 * @property tournament_model $tournament
 * @property post_model $post
 */
class Feed extends CI_Controller {

    public function activate($id) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {
            $this->load->model('feed_model', 'feed', true);
            $this->feed->activate($id);
            $this->session->set_flashdata('message', 'Feed wurde erfolgreich aktiviert.');
            redirect('backend/feed', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/feed', 'refresh');
        }
    }

    public function create() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->helper('form');

            $this->load->model('feed_model', 'feed', true);
            $this->load->model('team_model', 'team', true);
            $this->load->model('tournament_model', 'tournament', true);

            $headerdata['title'] = 'Feed Konfiguration | BET-IT-BEST';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $data['form']['name'] = array(
                'name' => 'name',
                'id' => 'name',
                'type' => 'text',
                'value' => '',
                'class' => 'form-control',
            );
            $data['form']['url'] = array(
                'name' => 'url',
                'id' => 'url',
                'type' => 'text',
                'value' => '',
                'class' => 'form-control',
            );
            $data['form']['vendor_url'] = array(
                'name' => 'vendor_url',
                'id' => 'vendor_url',
                'type' => 'text',
                'value' => '',
                'class' => 'form-control',
            );
            $data['form']['vendor_icon'] = array(
                'name' => 'vendor_icon',
                'id' => 'vendor_icon',
                'type' => 'file',
            );
            $data['form']['hidden'] = array(
                'name' => 'hidden',
                'id' => 'hidden',
                'value' => '1',
                'class' => 'form-control',
                'checked' => false
            );

            $data['form']['description'] = "";

            $data['form']['sport'] = $this->feed->get_sports();
            $data['form']['sport_selected'] = "";
            $data['form']['category'] = $this->feed->get_categories();
            $data['form']['category_selected'] = "";
            $data['form']['tournament'] = $this->tournament->get_dropdown();
            $data['form']['tournament_selected'] = "";

            $data['form']['team_selected_name'] = '';
            $data['form']['team_selected'] = "";

            $data['submitbtn'] = array(
                'class' => 'btn green',
                'type' => 'submit',
                'content' => 'Speichern',
                'name' => 'submitbutton'
            );

            $data['headline'] = 'Feed hinzufügen';
            $data['action'] = 'save';

            $data['feed'] = new Feed();
            $data['feed']->uid = "0";
            $data['feed']->name = "";
            $data['feed']->vendor_icon = "";

            $data['form']['language'] = $this->feed->get_languages();
            $data['form']['language_selected'] = 0;

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/feed/edit', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/feed', 'refresh');
        }
    }

    public function deactivate($id) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {
            $this->load->model('feed_model', 'feed', true);
            $this->feed->deactivate($id);
            $this->session->set_flashdata('message', 'Feed wurde erfolgreich deaktiviert.');
            redirect('backend/feed', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/feed', 'refresh');
        }
    }

    public function edit($id) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->helper('form');

            $this->load->model('feed_model', 'feed', true);
            $this->load->model('team_model', 'team', true);
            $this->load->model('tournament_model', 'tournament', true);

            $data['feed'] = $this->feed->get_feed_by_id($id);

            $headerdata['title'] = 'Feed Konfiguration | BET-IT-BEST';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] = $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $data['form']['name'] = array(
                'name' => 'name',
                'id' => 'name',
                'type' => 'text',
                'value' => $data['feed']->name,
                'class' => 'form-control',
            );
            $data['form']['url'] = array(
                'name' => 'url',
                'id' => 'url',
                'type' => 'text',
                'value' => $data['feed']->url,
                'class' => 'form-control',
            );
            $data['form']['vendor_url'] = array(
                'name' => 'vendor_url',
                'id' => 'vendor_url',
                'type' => 'text',
                'value' => $data['feed']->vendor_url,
                'class' => 'form-control',
            );
            $data['form']['vendor_icon'] = array(
                'name' => 'vendor_icon',
                'id' => 'vendor_icon',
                'type' => 'file',
            );
            $data['form']['hidden'] = array(
                'name' => 'hidden',
                'id' => 'hidden',
                'value' => '1',
                'class' => 'form-control',
            );
            if ($data['feed']->hidden === '1') {
                $data['form']['hidden']['checked'] = true;
            }

            $data['form']['description'] = $data['feed']->description;
            $data['form']['sport'] = $this->feed->get_sports_dropdown($data['feed']->sport_uid);
            $data['form']['sport_selected'] = $data['feed']->sport_uid;

            $data['form']['category'] = $this->feed->get_category_dropdown($data['feed']->category_uid);
            $data['form']['category_selected'] = $data['feed']->category_uid;

            $data['form']['tournament'] = $this->tournament->get_dropdown();

            if ((int)$data['feed']->unique_tournament_uid > 0) {
                $data['form']['tournament_selected'] = 'unq-' . (int)$data['feed']->unique_tournament_uid;
            } else {
                $data['form']['tournament_selected'] = $data['feed']->tournament_uid;
            }

            if ($data['feed']->team_uid > 0) {
                $team = $this->team->get_by_id($data['feed']->team_uid);
                $data['form']['team_selected_name'] =
                    " data-option=\"" . $team['name'] . ' [' . $team['gender'] . '] <i>(' . $team['spname'] . ' -> '
                    . $team['catname'] . ' -> ' . $team['tnname'] . ')</i>' . "\" ";
                $data['form']['team_selected'] = $data['feed']->team_uid;
            } else {
                $data['form']['team_selected_name'] = '';
                $data['form']['team_selected'] = "";
            }

            $data['form']['language'] = $this->feed->get_languages();
            $data['form']['language_selected'] = $data['feed']->language_uid;


            $data['submitbtn'] = array(
                'class' => 'btn green',
                'type' => 'submit',
                'content' => 'Speichern',
                'name' => 'submitbutton'
            );

            $data['action'] = 'update/' . $data['feed']->uid;
            $data['headline'] = 'Feed <strong>' . $data['feed']->name . '</strong> bearbeiten';

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/feed/edit', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/feed', 'refresh');
        }
    }

    public function getAsync() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->model('feed_model', 'feed', true);
            $iTotalRecords = $this->feed->count();
            $iDisplayLength = intval($this->input->post('iDisplayLength'));
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['iDisplayStart']);
            $sEcho = intval($_REQUEST['sEcho']);
            $records = array();
            $records["aaData"] = array();
            $search = array();

            $search['uid'] = $this->input->post('filter_uid');
            $search['name'] = $this->input->post('filter_name');
            $search['url'] = $this->input->post('filter_url');
            $search['sportname'] = $this->input->post('filter_sportname');
            $search['categoryname'] = $this->input->post('filter_categoryname');
            $search['tournamentname'] = $this->input->post('filter_tournamentname');
            $search['teamname'] = $this->input->post('filter_teamname');

            $cols = array(
                'uid',
                'name',
                'url',
                'sportname',
                'categoryname',
                'tournamentname',
                'teamname',
                ''
            );

            $sortby = $cols[$this->input->post('iSortCol_0')];

            $dir = $this->input->post('sSortDir_0');

            $filtercount = $this->feed->countFiltered($search);

            $feeds = $this->feed->get($iDisplayStart, $iDisplayLength, $sortby, $dir, $search);

            foreach ($feeds as $f) {
                $enh = "";
                $title = "";
                $cursor = "";
                if (strlen($f['url']) >= 80) {
                    $enh = "...";
                    $title = $f['url'];
                    $cursor = "help";
                }

                if (strlen($f['untnname']) > 0 && strlen($f['tournamentname']) == 0) {
                    $f['tournamentname'] = $f['untnname'];
                }

                $records["aaData"][] = array(
                    $f['uid'],
                    $f['name'],
                    '<a class="subtext ' . $cursor . '" title="' . $title . '">' . substr($f['url'], 0, 80) . '' . $enh
                    . '</a>',
                    $f['sportname'],
                    $f['categoryname'],
                    $f['tournamentname'],
                    $f['teamname'],
                    anchor(
                        "backend/feed/edit/" . $f['uid'],
                        '<i class="fa fa-edit"></i>',
                        array('class' => 'btn default btn-xs grey')
                    ) . anchor(
                        "backend/feed/remove/" . $f['uid'],
                        '<i class="fa fa-times"></i>',
                        array(
                            'class' => 'btn default btn-xs red must-confirm',
                            'data-message' => 'Sind Sie sicher, dass Sie den Feed <strong>' . $f['name']
                                . '</strong> löschen möchten?'
                        )
                    )
                );
            }

            $records["sEcho"] = $sEcho;
            $records["iTotalRecords"] = $iTotalRecords;
            $records["iTotalDisplayRecords"] = $filtercount;

            echo json_encode($records);

        } else {
            echo "";
        }

    }

    public function index() {

        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $data = array();

            if ($this->session->flashdata('message') != "") {
                $data['message'] = $this->session->flashdata('message');
            }
            if ($this->session->flashdata('error') != "") {
                $data['message'] = $this->session->flashdata('error');
            }

            $this->load->model('feed_model', 'feed', true);

            $headerdata['title'] = 'Feed Konfiguration | BET-IT-BEST';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $data['feeds'] = $this->feed->get();

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/feed/index', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            redirect('backend/auth/login', 'refresh');
        }
    }

    public function remove($id) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {
            $this->load->model('feed_model', 'feed', true);
            $this->feed->remove($id);
            $this->session->set_flashdata('message', 'Anbieter erfolgreich gelöscht');
            redirect('backend/feed', 'refresh');
        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/feed', 'refresh');
        }
    }

    public function save() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->library('form_validation');

            $ulconfig = array(
                'upload_path' => 'pool/uploads/feed/',
                'allowed_types' => 'jpg|png',
                'max_size' => '200000',
                'encrypt_name' => true
            );

            $this->load->library('upload', $ulconfig);

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('url', 'URL', 'required');

            if ($this->form_validation->run() == true) {

                $feed_array = $this->input->post();

                if (strpos($feed_array['tournament_uid'], 'unq-') !== false) {
                    $feed_array['unique_tournament_uid'] = (int)str_replace('unq-', '', $feed_array['tournament_uid']);
                    unset($feed_array['tournament_uid']);
                }

                if ($this->upload->do_upload('vendor_icon') == true) {
                    $imgdata = $this->upload->data();
                    $feed_array['vendor_icon'] = $imgdata['file_name'];
                }

                unset($feed_array['submitbutton']);
                $this->load->model('feed_model', 'feed', true);
                $this->feed->insert($feed_array);
                $this->session->set_flashdata('message', 'Ihre Änderungen wurden erfolgreich gespeichert.');
                redirect('backend/feed', 'refresh');

            } else {
                $this->session->set_flashdata('error',
                    'Beim Speichern Ihrer Änderungen ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.');
                redirect('backend/feed', 'refresh');
            }

        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/feed', 'refresh');
        }
    }

    public function update($id) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->library('form_validation');

            $ulconfig = array(
                'upload_path' => 'pool/uploads/feed/',
                'allowed_types' => 'jpg|png',
                'max_size' => '200000',
                'encrypt_name' => true
            );

            $this->load->library('upload', $ulconfig);


            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('url', 'URL', 'required');

            if ($this->form_validation->run() == true) {

                $feed_array = $this->input->post();

                if (strpos($feed_array['tournament_uid'], 'unq-') !== false) {
                    $feed_array['unique_tournament_uid'] = (int)str_replace('unq-', '', $feed_array['tournament_uid']);
                    $feed_array['tournament_uid'] = 0;
                } else {
                    $feed_array['unique_tournament_uid'] = 0;
                }

                if ($this->upload->do_upload('vendor_icon') == true) {
                    $imgdata = $this->upload->data();
                    $feed_array['vendor_icon'] = $imgdata['file_name'];
                }

                unset($feed_array['submitbutton']);
                $this->load->model('feed_model', 'feed', true);

                if (!isset($feed_array['enabled'])) {
                    $feed_array['enabled'] = 0;
                }

                $this->feed->update($id, $feed_array);
                $this->session->set_flashdata('message', 'Ihre Änderungen wurden erfolgreich gespeichert.');
                redirect('backend/feed', 'refresh');

            } else {
                $this->session->set_flashdata('error',
                    'Beim Speichern Ihrer Änderungen ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.');
                redirect('backend/feed', 'refresh');
            }

        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/feed', 'refresh');
        }
    }

}

/* End of file home.php */
/* Location: ./application/controllers/backend/home.php */
