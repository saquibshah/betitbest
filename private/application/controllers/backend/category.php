<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Category
 * @property Ion_auth $ion_auth
 * @property category_model $category
 * @property keyword_model $keyword
 * @property language_model $language
 * @property seo_model $seo
 */
class Category extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('category_model', 'category', true);
    }

    public function create_seourls() {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(array(1, 2))) {
            redirect('/backend/auth/login');
        }

        $this->load->model('seo_model', 'Seo', true);

        $result = $this->db->where('seourl', '')->limit(100)->get('category')->result();

        foreach ($result as $res) {
            $url = $this->Seo->sanitizeUrl($res->name);
            $urlCheck = $url;

            for ($i = 1; ; $i++) {
                $numRows = $this->db->select('uid')->where('seourl', $urlCheck)
                    ->where('sport_uid', $res->sport_uid)->get('category')->num_rows();

                if ($numRows !== false && $numRows > 0) {
                    $urlCheck = "{$url}-{$i}";
                } else {
                    break;
                }
            }

            $url = $urlCheck;

            $this->db->where('uid', $res->uid)->update('category', array('seourl' => $url));
        }
    }

    public function edit($id) {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(array(1, 2))) {
            redirect('/backend/auth/login');
        }

        $this->load->helper('form');

        $headerdata['langcode'] = 'de';
        $headerdata['userid'] = $this->ion_auth->user()->row()->id;
        $headerdata['username'] = $this->ion_auth->user()->row()->first_name . ' '
            . $this->ion_auth->user()->row()->last_name;

        $data = array();

        $this->load->model('keyword_model', 'keyword', true);
        $this->load->model('backend/language_model', 'language', true);

        $data['category'] = $this->category->get_single($id);

        $headerdata['title'] = 'Kategorie Konfiguration | BET-IT-BEST';

        $data['action'] = 'update/' . $data['category']['uid'];
        $data['headline'] = 'Kategorie <strong>' . $data['category']['name'] . '</strong> bearbeiten';

        $data['form']['name'] = array(
            'class' => 'form-control',
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $data['category']['name']
        );

        $data['form']['uid'] = array(
            'name' => 'uid',
            'id' => 'uid',
            'value' => $data['category']['uid'],
            'class' => 'form-control',
            'disabled' => 'disabled'
        );

        $data['form']['sport'] = array(
            'name' => 'sportname',
            'id' => 'sportname',
            'value' => $data['category']['sportname'],
            'class' => 'form-control',
            'disabled' => 'disabled'
        );

        $data['form']['hidden'] = array(
            'name' => 'hidden',
            'id' => 'hidden',
            'value' => '1',
            'class' => 'form-control',
            'checked' => false
        );

        if ($data['category']['hidden'] === '1') {
            $data['form']['hidden']['checked'] = true;
        }

        $langs = $this->language->get_languages();
        $data['langs'] = $langs;

        foreach ($langs as $item) {

            $data['form']['name_local_' . $item->uid] = array(
                'name' => 'name_local_' . $item->uid,
                'id' => 'name_local_' . $item->uid,
                'type' => 'text',
                'value' => dblang('category_' . $data['category']['uid'] . '_name', $item->uid, false),
                'class' => 'form-control'
            );
        }

        $data['form']['header_image'] = array(
            'name' => 'header_image',
            'id' => 'header_image',
            'type' => 'file',
        );

        $data['form']['current_image'] = $data['category']['header_image'];


        $data['keywords'] = $this->keyword->get_category_matchings($data['category']['uid']);

        $bl = $this->keyword->get_blacklist($data['category']['uid'], 'sportnews_category');
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

        $data['uid'] = $data['category']['uid'];
        $data['sportuid'] = $data['category']['sport_uid'];

        $this->load->view('backend/layouts/header', $headerdata);
        $this->load->view('backend/layouts/sidebar');
        $this->load->view('backend/category/edit', $data);
        $this->load->view('backend/layouts/footer');


    }

    public function getAsync() {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(array(1, 2))) {
            return;
        }

        $iTotalRecords = $this->category->count();
        $iDisplayLength = intval($this->input->post('iDisplayLength'));
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->input->post('iDisplayStart'));
        $sEcho = intval($this->input->post('sEcho'));

        $records = array();
        $records["aaData"] = array();

        $search = array();

        $search['uid'] = $this->input->post('filter_uid');
        $search['name'] = $this->input->post('filter_name');
        $search['sport'] = $this->input->post('filter_sportname');

        $cols = array(
            'uid',
            'name',
            'sport'
        );

        $sortby = $cols[$this->input->post('iSortCol_0')];
        $dir = $this->input->post('sSortDir_0');

        $filtercount = $this->category->countFiltered($search);

        $cats = $this->category->get($iDisplayStart, $iDisplayLength, $sortby, $dir, $search);

        foreach ($cats["result"] as $cat) {

            if ($cat['hidden'] == 1) {
                $name = "[disabled] " . $cat['name'];
            } else {
                $name = $cat['name'];
            }

            $records["aaData"][] = array(
                $cat['uid'],
                $name,
                $cat['sportname'],
                anchor(
                    "backend/category/edit/" . $cat['uid'],
                    '<i class="fa fa-edit"></i>',
                    array('class' => 'btn default btn-xs grey')
                )
            );
        }

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $filtercount;

        echo json_encode($records);
    }

    public function index() {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(array(1, 2))) {
            redirect('/backend/auth/login');
        }


        $data = array();

        if ($this->session->flashdata('message') != "") {
            $data['message'] = $this->session->flashdata('message');
        }
        if ($this->session->flashdata('error') != "") {
            $data['message'] = $this->session->flashdata('error');
        }

        $headerdata['title'] = 'Kategorie Konfiguration | BET-IT-BEST';
        $headerdata['langcode'] = 'de';
        $headerdata['userid'] = $this->ion_auth->user()->row()->id;
        $headerdata['username'] =
            $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

        $this->load->view('backend/layouts/header', $headerdata);
        $this->load->view('backend/layouts/sidebar');
        $this->load->view('backend/category/index', $data);
        $this->load->view('backend/layouts/footer');

    }

    public function update($uid) {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(array(1, 2))) {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/category', 'refresh');
        }

        $cat_array = $this->input->post();
        $this->load->model('seo_model', 'seo', true);
        $cat_array = $this->seo->backend_save($cat_array);

        unset($cat_array['submitbutton']);
        $this->load->model('backend/language_model', 'language', true);
        $this->load->model('keyword_model', 'keyword', true);

        $ulconfig = array(
            'upload_path' => 'pool/uploads/category/',
            'allowed_types' => 'jpg|png',
            'max_size' => '300000',
            'encrypt_name' => true
        );

        $this->load->library('upload', $ulconfig);

        if ($this->upload->do_upload('header_image') == true) {
            $imgdata = $this->upload->data();
            $this->category->set_headerimage($uid, $imgdata['file_name']);
        }


        $this->keyword->deleteBlacklist("sportnews_category", $uid);
        $this->keyword->delete_keyword_matchings($cat_array['remove_keywords_string']);
        unset($cat_array['remove_keywords_string']);

        $blacklistitems = explode("||", $cat_array['blacklistitems']);

        foreach ($blacklistitems as $item) {
            if ((string)(int)$item == $item) {
                $this->keyword->addBlacklistKeyword($item, "sportnews_category", $uid);
            } else {
                $this->keyword->createBlacklistKeyword($item, "sportnews_category", $uid);
            }
        }

        if (isset($cat_array['hidden'])) {
            $this->category->deactivate($uid);
        } else {
            $this->category->activate($uid);
        }

        foreach ($cat_array as $key => $val) {
            if (strpos($key, 'name_local') !== false) {
                $this->language->insert_or_update_string('category_' . $uid . '_name', $val,
                    (int)str_replace('name_local_', '', $key));
            }
        }

        $this->category->set_name($uid, $cat_array['name']);

        $this->session->set_flashdata('message', 'Ihre Änderungen wurden erfolgreich gespeichert.');
        redirect('backend/category', 'refresh');
    }

}