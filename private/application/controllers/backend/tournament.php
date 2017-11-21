<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Tournament
 * @property Ion_auth $ion_auth
 * @property tournament_model $tournament
 * @property language_model $language
 * @property keyword_model $keyword
 * @property seo_model $seo
 */
class Tournament extends CI_Controller {
    public function create_seourls() {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(array(1, 2))) {
            redirect('/backend/auth/login');
        }

        $this->load->model('seo_model', 'Seo', true);

        $result = $this->db->where('seourl', '')->limit(100)->get('unique_tournament')->result();

        foreach ($result as $res) {
            $url = $this->Seo->sanitizeUrl($res->name);
            $urlCheck = $url;

            for ($i = 1; ; $i++) {
                $numRows = $this->db->select('uid')
                    ->where('seourl', $urlCheck)
                    ->where('category_uid', $res->category_uid)
                    ->get('unique_tournament')->num_rows();

                if ($numRows !== false && $numRows > 0) {
                    $urlCheck = "{$url}-{$i}";
                } else {
                    break;
                }
            }

            $url = $urlCheck;

            $this->db->where('uid', $res->uid)->update('unique_tournament', array('seourl' => $url));
        }

        $result = $this->db->where('seourl', '')->limit(100)->get('tournament')->result();
        foreach ($result as $res) {
            $url = $this->Seo->sanitizeUrl($res->name);
            $urlCheck = $url;

            for ($i = 1; ; $i++) {
                $numRows = $this->db->select('uid')
                    ->where('seourl', $urlCheck)
                    ->where('category_uid', $res->category_uid)
                    ->get('tournament')->num_rows();

                if ($numRows !== false && $numRows > 0) {
                    $urlCheck = "{$url}-{$i}";
                } else {
                    break;
                }
            }

            $url = $urlCheck;

            $this->db->where('uid', $res->uid)->update('tournament', array('seourl' => $url));
        }
    }

    public function edit($id) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->helper('form');

            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $data = array();

            $this->load->model('keyword_model', 'keyword', true);
            $this->load->model('tournament_model', 'tournament', true);
            $this->load->model('backend/language_model', 'language', true);

            $data['tournament'] = $this->tournament->get_single($id);

            $headerdata['title'] = 'Turnier Konfiguration | BET-IT-BEST';

            $data['action'] = 'update/' . $data['tournament']->uid;
            $data['headline'] = 'Turnier <strong>' . $data['tournament']->name . '</strong> bearbeiten';

            if ((int)$data['tournament']->unique_uid > 0) {
                $data['unique'] = true;
                $unique = true;
            } else {
                $data['unique'] = false;
                $unique = false;
            }

            $data['form']['name'] = array(
                'class' => 'form-control',
                'name' => 'name',
                'id' => 'name',
                'type' => 'text',
                'value' => $data['tournament']->name
            );

            $data['form']['uid'] = array(
                'name' => 'uid',
                'id' => 'uid',
                'value' => $data['tournament']->uid,
                'class' => 'form-control',
                'disabled' => 'disabled'
            );

            if ($unique) {
                $data['form']['unique_uid'] = array(
                    'name' => 'unique_uid',
                    'id' => 'unique_uid',
                    'value' => $data['tournament']->untn_uid,
                    'class' => 'form-control',
                    'disabled' => 'disabled'
                );

                $data['form']['unique_name'] = array(
                    'class' => 'form-control',
                    'name' => 'unique_name',
                    'id' => 'unique_name',
                    'type' => 'text',
                    'value' => $data['tournament']->untn_name
                );
            }

            $data['form']['sport'] = array(
                'name' => 'sportname',
                'id' => 'sportname',
                'value' => $data['tournament']->sportname,
                'class' => 'form-control',
                'disabled' => 'disabled'
            );

            $data['form']['category'] = array(
                'name' => 'catname',
                'id' => 'catname',
                'value' => $data['tournament']->catname,
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
                    'value' => dblang('tournament_' . $data['tournament']->uid . '_name', $item->uid, false),
                    'class' => 'form-control'
                );

                if ($unique) {
                    $data['form']['unique_name_local_' . $item->uid] = array(
                        'name' => 'unique_name_local_' . $item->uid,
                        'id' => 'unique_name_local_' . $item->uid,
                        'type' => 'text',
                        'value' => dblang('unique_tournament_' . $data['tournament']->untn_uid . '_name', $item->uid,
                            false),
                        'class' => 'form-control'
                    );
                }
            }

            if ($unique) {
                $data['keywords'] = $this->keyword->get_unique_tournament_matchings($data['tournament']->unique_uid);
                $bl = $this->keyword->get_blacklist($data['tournament']->unique_uid, 'sportnews_unique_tournament');

                $data['form']['unique_tournament_hidden'] = array(
                    'name' => 'unique_tournament_hidden',
                    'id' => 'unique_tournament_hidden',
                    'value' => '1',
                    'class' => 'form-control',
                    'checked' => false
                );

                $data['form']['unique_header_image'] = array(
                    'name' => 'unique_header_image',
                    'id' => 'unique_header_image',
                    'type' => 'file',
                );

                $data['form']['unique_current_image'] =
                    $this->tournament->get_unique_header($data['tournament']->unique_uid);

                if ($this->tournament->is_unique_hidden($data['tournament']->unique_uid)) {
                    $data['form']['unique_tournament_hidden']['checked'] = true;
                }

            } else {
                $data['keywords'] = $this->keyword->get_tournament_matchings($data['tournament']->uid);
                $bl = $this->keyword->get_blacklist($data['tournament']->uid, 'sportnews_tournament');

                $data['form']['tournament_hidden'] = array(
                    'name' => 'tournament_hidden',
                    'id' => 'tournament_hidden',
                    'value' => '1',
                    'class' => 'form-control',
                    'checked' => false
                );
                if ($data['tournament']->hidden === '1') {
                    $data['form']['tournament_hidden']['checked'] = true;
                }

                $data['form']['header_image'] = array(
                    'name' => 'header_image',
                    'id' => 'header_image',
                    'type' => 'file',
                );

                $data['form']['current_image'] = $data['tournament']->header_image;

            }

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

            $data['uid'] = $data['tournament']->uid;
            $data['sportuid'] = $data['tournament']->sport_uid;
            $data['catuid'] = $data['tournament']->category_uid;
            if ($unique) {
                $data['unique_tournament_uid'] = $data['tournament']->unique_uid;
            }

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/tournament/edit', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/feed', 'refresh');
        }
    }

    public function getAsync() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->model('tournament_model', 'tournament', true);

            $iTotalRecords = $this->tournament->count();
            $iDisplayLength = intval($this->input->post('iDisplayLength'));
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['iDisplayStart']);
            $sEcho = intval($_REQUEST['sEcho']);

            $records = array();
            $records["aaData"] = array();

            $search = array();

            $search['uid'] = $this->input->post('filter_uid');
            $search['name'] = $this->input->post('filter_name');
            $search['uniquetn'] = $this->input->post('filter_uniquename');
            $search['sport'] = $this->input->post('filter_sportname');
            $search['category'] = $this->input->post('filter_catname');


            $cols = array(
                'uid',
                'name',
                'uniquename',
                'sportname',
                'catname'
            );

            $sortby = $cols[$this->input->post('iSortCol_0')];
            $dir = $this->input->post('sSortDir_0');

            $filtercount = $this->tournament->countFiltered($search);

            $trns = $this->tournament->get($iDisplayStart, $iDisplayLength, $sortby, $dir, $search);

            foreach ($trns["result"] as $trn) {
                if ($trn['hidden'] != 0) {
                    $isHidden = "[hidden] ";
                } else {
                    $isHidden = "";
                }
                $records["aaData"][] = array(
                    $trn['uid'],
                    $isHidden . $trn['name'],
                    $trn['uniquename'],
                    $trn['sportname'],
                    $trn['catname'],
                    anchor(
                        "backend/tournament/edit/" . $trn['uid'],
                        '<i class="fa fa-edit"></i>',
                        array('class' => 'btn default btn-xs grey')
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
            $this->load->model('tournament_model', 'tournament', true);

            $data = array();

            if ($this->session->flashdata('message') != "") {
                $data['message'] = $this->session->flashdata('message');
            }
            if ($this->session->flashdata('error') != "") {
                $data['message'] = $this->session->flashdata('error');
            }

            $headerdata['title'] = 'Turnier Konfiguration | BET-IT-BEST';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/tournament/index', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            redirect('backend/auth/login', 'refresh');
        }
    }

    public function update($uid) {

        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $trn_array = $this->input->post();
            $this->load->model('seo_model', 'seo', true);
            $trn_array = $this->seo->backend_save($trn_array);

            unset($trn_array['submitbutton']);
            $this->load->model('backend/language_model', 'language', true);
            $this->load->model('tournament_model', 'tournament', true);
            $this->load->model('keyword_model', 'keyword', true);

            $this->tournament->set_name($uid, $trn_array['name']);
            if ($trn_array['tournamenttype'] == 'unique_tournament') {
                $this->tournament->set_unique_name($trn_array['the_uid'], $trn_array['unique_name']);
            }

            $ulconfig = array(
                'upload_path' => 'pool/uploads/tournament/',
                'allowed_types' => 'jpg|png',
                'max_size' => '300000',
                'encrypt_name' => true
            );

            if ($trn_array['tournamenttype'] == 'tournament') {

                $this->keyword->deleteBlacklist("sportnews_tournament", $trn_array['the_uid']);
                $this->load->library('upload', $ulconfig);
                if ($this->upload->do_upload('header_image') == true) {
                    $imgdata = $this->upload->data();
                    $this->tournament->set_headerimage($trn_array['the_uid'], $imgdata['file_name']);
                }
            } else {

                $this->keyword->deleteBlacklist("sportnews_unique_tournament", $trn_array['the_uid']);
                $ulconfig['upload_path'] = 'pool/uploads/unique_tournament/';
                $this->load->library('upload', $ulconfig);
                if ($this->upload->do_upload('unique_header_image') == true) {
                    $imgdata = $this->upload->data();
                    $this->tournament->set_unique_headerimage($trn_array['the_uid'], $imgdata['file_name']);
                }
            }

            $this->keyword->delete_keyword_matchings($trn_array['remove_keywords_string']);
            unset($trn_array['remove_keywords_string']);

            $blacklistitems = explode("||", $trn_array['blacklistitems']);

            foreach ($blacklistitems as $item) {
                if ($trn_array['tournamenttype'] == 'tournament') {
                    if ((string)(int)$item == $item) {
                        $this->keyword->addBlacklistKeyword($item, "sportnews_tournament", $trn_array['the_uid']);
                    } else {
                        $this->keyword->createBlacklistKeyword($item, "sportnews_tournament", $trn_array['the_uid']);
                    }
                } else {
                    if ((string)(int)$item == $item) {
                        $this->keyword->addBlacklistKeyword($item, "sportnews_unique_tournament",
                            $trn_array['the_uid']);
                    } else {
                        $this->keyword->createBlacklistKeyword($item, "sportnews_unique_tournament",
                            $trn_array['the_uid']);
                    }
                }
            }

            if (isset($trn_array['tournament_hidden'])) {
                $this->tournament->deactivate($uid);
            } else {
                $this->tournament->activate($uid);
            }

            if (isset($trn_array['unique_tournament_hidden'])) {
                $this->tournament->deactivate_unique($this->tournament->get_unique($uid));
            } else {
                if (!isset($trn_array['tournament_hidden'])) {
                    $this->tournament->activate_unique($this->tournament->get_unique($uid));
                }
            }

            foreach ($trn_array as $key => $val) {
                if (strpos($key, 'unique_name_local') !== false) {
                    $this->language->insert_or_update_string('unique_tournament_' . $trn_array['the_uid'] . '_name',
                        $val, (int)str_replace('unique_name_local_', '', $key));
                } elseif (strpos($key, 'name_local') !== false) {
                    $this->language->insert_or_update_string('tournament_' . $uid . '_name', $val,
                        (int)str_replace('name_local_', '', $key));
                }
            }

            $this->tournament->set_name($uid, $trn_array['name']);

            $this->session->set_flashdata('message', 'Ihre Änderungen wurden erfolgreich gespeichert.');
            redirect('backend/tournament', 'refresh');

            $this->session->set_flashdata('error',
                'Beim Speichern Ihrer Änderungen ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.');
            redirect('backend/tournament', 'refresh');

        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/tournament', 'refresh');
        }

    }

}

/* End of file home.php */
/* Location: ./application/controllers/backend/home.php */