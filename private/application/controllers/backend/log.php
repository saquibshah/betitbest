<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Log
 * @property Ion_auth $ion_auth
 * @property log_model $log
 */
class Log extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('backend/auth/login', 'refresh');
        }

        $this->load->model('backend/home_model', 'home', true);
    }

    public function getAsync() {
        $this->load->model('backend/log_model', 'backendlog', true);
        $iTotalRecords = $this->backendlog->count();

        $iDisplayLength = intval($this->input->post('iDisplayLength'));
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($this->input->post('iDisplayStart'));

        $sEcho = intval($this->input->post('sEcho'));

        $search = array();
        $search['uid'] = $this->input->post('filter_uid');

        $level = array();
        if ($this->input->post('filter_level-error') == 'true') {
            $level[] = 'error';
        }

        if ($this->input->post('filter_level-warning') == 'true') {
            $level[] = 'warning';
        }

        if ($this->input->post('filter_level-info') == 'true') {
            $level[] = 'info';
        }

        $search['level'] = $level;
        $search['source'] = $this->input->post('filter_source');
        $search['item_type'] = $this->input->post('filter_message');
        $search['only_unread'] = $this->input->post('filter_unread-only');
        $search['item-feed_uid'] = $this->input->post('filter_item-feed_uid');

        $cols = array(
            'uid',
            'created_on',
            'level',
            'source',
            'message',
            'data',
            'feed_uid',
            'is_read'
        );

        $sortby = $cols[$this->input->post('iSortCol_0')];
        $dir = $this->input->post('sSortDir_0');

        $filtercount = $this->backendlog->countFiltered($search);
        $logs = $this->backendlog->get($search, false, $iDisplayStart, $iDisplayLength, $sortby, $dir);

        $records = array();
        $records["aaData"] = array();
        foreach ($logs as $log) {
            $data = "";

            $logdata = json_decode($log->data);
            if (isset($logdata) && isset($logdata->feed_uid)) {
                $data .= "<a href=\"/backend/feed/edit/{$logdata->feed_uid}\">Feed {$logdata->feed_uid}</a> ";
            }

            $logcontent = "";
            foreach((array)$logdata as $key => $value) {
                $logcontent .= "{$key}: {$value}<br>";
            }


            $data .= "<a href='javascript:;' class='popovers' data-container='body' "
                . "data-html='true' data-content='" . htmlspecialchars($logcontent) . "' "
                . "data-original-title='Details' data-placement='bottom'>(Details)</a>";

            $row = array($log->uid, date("d.m.Y, H:i:s", $log->created_on), $log->level, $log->source, $log->message, $data, $log->feed_uid);

            if ($log->is_read) {
                $row[] = "<span class=\"btn btn-xs green disabled\"><i class=\"fa fa-check\"></i></span>";
            } else {
                $row[] = anchor(
                    "backend/log/markRead/" . $log->uid,
                    "<i class=\"fa fa-check must-confirm\" data-message=\"Hallo\"></i>",
                    array('class' => 'btn btn-xs yellow must-confirm',
                        'data-message' => 'Möchten Sie den Eintrag als \'gelesen\' markieren?')
                );
            }

            $records["aaData"][] = $row;
        }

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $filtercount;

        echo json_encode($records);
    }

    public function index() {
        $headerdata['title'] = 'Ereignislog | BIB - Betreiberbackend';
        $headerdata['langcode'] = 'de';
        $headerdata['userid'] = $this->ion_auth->user()->row()->id;
        $headerdata['username'] = $this->ion_auth->user()->row()->first_name . ' '
            . $this->ion_auth->user()->row()->last_name;

        $data = array();

        $this->load->view('backend/layouts/header', $headerdata);
        $this->load->view('backend/layouts/sidebar');
        $this->load->view('backend/log/index', $data);
        $this->load->view('backend/layouts/footer');
    }

    public function markRead($id) {
        if ($this->ion_auth->in_group(array(1, 2))) {
            $this->load->model('backend/log_model', 'backendlog', true);
            $this->backendlog->markRead($id);
            redirect('backend/log');
        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/log');
        }
    }
}
