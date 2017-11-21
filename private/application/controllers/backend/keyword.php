<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Keyword
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
class Keyword extends CI_Controller {

    public function add_new() {

        $this->load->model('keyword_model', 'keyword', true);

        $returnArray = array();
        $data = $this->input->post();
        $data = $data['data'];

        if ((int)$data['keyword_uid'] <= 0
            && (strlen($data['keyword']) == 0
                || $data['keyword'] == "Keyword eingeben")
        ) {
            $returnArray['status'] = 'ERROR';
            $returnArray['message'] = 'Sie müssen einen Wert für das Keyword angeben.';
        } else {
            $returnArray['status'] = 'SUCCESS';
            if ($data['keyword_uid'] > 0) {
                $matchingID = $this->keyword->insertMatching($data);
                $returnArray['message'] = 'Das Keyword wurde erfolgreich zugeordnet';
            } else {
                $matchingID = $this->keyword->insertKeywordWithMatching($data);
                $returnArray['message'] = 'Das Keyword wurde erfolgreich hinzugefügt und zugeordnet';
            }
            $data['added'] = $this->keyword->get_matching_with_rel($matchingID);
            $returnArray['data'] = $data;
        }

        echo json_encode($returnArray);

    }

    public function edit($id, $relations = false) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->helper('form');

            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $data = array();

            if (!$relations) {
                $this->load->model('keyword_model', 'keyword', true);

                $data['keyword'] = $this->keyword->get_keyword($id);

                $headerdata['title'] = 'Keyword Konfiguration | BET-IT-BEST';

                $data['action'] = 'update/' . $data['keyword']->uid;
                $data['headline'] = 'Keyword <strong>' . $data['keyword']->value . '</strong> bearbeiten';

                $data['form']['value'] = array(
                    'class' => 'form-control',
                    'name' => 'value',
                    'id' => 'keyword_value',
                    'type' => 'text',
                    'value' => $data['keyword']->value
                );

                $data['form']['dynamic'] = array(
                    'name' => 'dynamic',
                    'id' => 'keyword_dynamic',
                    'value' => '1',
                    'class' => 'form-control',
                    'disabled' => 'disabled'
                );
                if ($data['keyword']->dynamic === '1') {
                    $data['form']['dynamic']['checked'] = true;
                }

                $data['submitbtn'] = array(
                    'class' => 'btn green',
                    'type' => 'submit',
                    'content' => 'Speichern',
                    'name' => 'submitbutton'
                );

                $this->load->view('backend/layouts/header', $headerdata);
                $this->load->view('backend/layouts/sidebar');
                $this->load->view('backend/keyword/edit', $data);
                $this->load->view('backend/layouts/footer');
            } else {

                $headerdata['title'] = 'Keyword Relationen | BET-IT-BEST';
                $data['headline'] = 'Keyword Relation bearbeiten';

                $data['submitbtn'] = array(
                    'class' => 'btn green',
                    'type' => 'submit',
                    'content' => 'Speichern',
                    'name' => 'submitbutton'
                );

                $this->load->view('backend/layouts/header', $headerdata);
                $this->load->view('backend/layouts/sidebar');
                $this->load->view('backend/keyword/edit_relation', $data);
                $this->load->view('backend/layouts/footer');

            }


        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/feed', 'refresh');
        }
    }

    public function getAsync() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->model('keyword_model', 'keyword', true);

            $iTotalRecords = $this->keyword->count();
            $iDisplayLength = intval($this->input->post('iDisplayLength'));
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['iDisplayStart']);
            $sEcho = intval($_REQUEST['sEcho']);

            $records = array();
            $records["aaData"] = array();

            $search = array();

            $search['uid'] = $this->input->post('filter_uid');
            $search['value'] = $this->input->post('filter_value');
            $search['dynamic'] = $this->input->post('filter_dynamic');

            $status_list = array(
                array("red" => "manuell"),
                array("yellow" => "dynamisch")
            );

            $cols = array(
                'uid',
                'value',
                'count',
            );

            $sortby = $cols[$this->input->post('iSortCol_0')];
            $dir = $this->input->post('sSortDir_0');

            $filtercount = $this->keyword->countFiltered($search);

            $keywords = $this->keyword->get($iDisplayStart, $iDisplayLength, $sortby, $dir, $search);

            foreach ($keywords["result"] as $kw) {
                $status = $status_list[$kw['dynamic']];
                $records["aaData"][] = array(
                    $kw['uid'],
                    $kw['value'],
                    $kw['count'],
                    '',
                    '<a href="#" class="btn-xs btn default ' . (key($status)) . '">' . (current($status)) . '</a>',
                    anchor(
                        "backend/keyword/edit/" . $kw['uid'],
                        '<i class="fa fa-edit"></i>',
                        array('class' => 'btn default btn-xs grey')
                    ) . anchor(
                        "backend/keyword/remove/" . $kw['uid'],
                        '<i class="fa fa-times"></i>',
                        array(
                            'class' => 'btn default btn-xs red must-confirm',
                            'data-message' => 'Sind Sie sicher, dass Sie das Keyword <strong>' . $kw['value']
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

    public function getBlacklistDropdown() {
        $q = $this->input->get('q');
        $p = $this->input->get('page');

        $this->load->model('keyword_model', 'keyword', true);

        $search['value'] = $q;
        $records = $this->keyword->get(($p - 1), 30, 'value', 'asc', $search, true);

        if ($records["count"] == 0) {
            $records = array(
                "result" => array(array("uid" => -1, "value" => $q . " [neu]")),
                "count" => 1
            );
        }

        echo json_encode($records);

    }

    public function getKeywordDropdown() {
        $q = $this->input->get('q');
        $p = $this->input->get('page');

        $this->load->model('keyword_model', 'keyword', true);
        $this->load->model('team_model', 'team', true);
        $search['value'] = $q;
        $records = $this->keyword->get(($p - 1), 30, 'value', 'asc', $search, true);

        if (count($records["result"]) == 0) {
            $records = array(
                "result" => array(array("uid" => -1, "value" => $q . " [neu]")),
                "count" => 1
            );
        } else {
            for ($i = 0; $i < count($records["result"]); ++$i) {
                if ($records["result"][$i]['ref_table'] == 'sportnews_team') {

                    $team = $this->team->get(0, 1, 'uid', 'asc', array("uid" => $records["result"][$i]['ref_uid']), true);

                    if(isset($team) && isset($team['result']) && count($team["result"]) > 0) {

                      $team = $team["result"][0];

                      $appends = "";
                      if ($team['sportname'] != "") {
                          $appends .= " Sport: " . $team['sportname'] . ",";
                      }
                      if ($team['categoryname'] != "") {
                          $appends .= " Kategorie: " . $team['categoryname'] . ",";
                      }
                      if ($team['uniquetnname'] != "") {
                          $appends .= " Turnier: " . $team['uniquetnname'] . ",";
                      } else {
                          if ($team['tournamentname'] != "") {
                              $appends .= " Turnier: " . $team['tournamentname'] . ",";
                          }
                      }
                      if (strlen($appends) > 0) {
                          $appends = substr($appends, 0, (strlen($appends) - 1));
                      }

                      $records["result"][$i]['value'] .= '[' . $team['gender'] . '] <em>' . $appends . '</em>';

                    }
                }
            }
            $records["result"][] = array("uid" => -1, "value" => $q . " [neu]");
        }


        echo json_encode($records);

    }

    public function index() {

        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {
            $this->load->model('keyword_model', 'keyword', true);

            $data = array();

            if ($this->session->flashdata('message') != "") {
                $data['message'] = $this->session->flashdata('message');
            }
            if ($this->session->flashdata('error') != "") {
                $data['message'] = $this->session->flashdata('error');
            }

            $headerdata['title'] = 'Feed Konfiguration | BET-IT-BEST';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/keyword/index', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            redirect('backend/auth/login', 'refresh');
        }
    }

}

/* End of file home.php */
/* Location: ./application/controllers/backend/home.php */
