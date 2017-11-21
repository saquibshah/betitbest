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
class Post extends CI_Controller {
    public function edit($uid) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->helper('form');

            $this->load->model('post_model', 'post', true);
            $this->load->model('tournament_model', 'tournament', true);
            $this->load->model('feed_model', 'feed', true);
            $this->load->model('team_model', 'team', true);

            $headerdata['title'] = 'Nachricht bearbeiten | BET-IT-BEST';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $post = $this->post->get_post_by_id($uid);

            $data['uid'] = $uid;

            $data['form']['title'] = array(
                'name' => 'title',
                'id' => 'title',
                'type' => 'text',
                'value' => $post->title,
                'class' => 'form-control',
            );
            $data['form']['url'] = array(
                'name' => 'url',
                'id' => 'url',
                'type' => 'text',
                'value' => $post->url,
                'class' => 'form-control',
            );
            $data['form']['vendor'] = array(
                'name' => 'vendor',
                'id' => 'vendor',
                'type' => 'text',
                'value' => $post->feedname,
                'class' => 'form-control',
                'disabled' => true
            );

            $data['form']['hidden'] = array(
                'name' => 'hidden',
                'id' => 'hidden',
                'value' => '1',
                'class' => 'form-control',
                'checked' => false
            );

            if ($post->hidden === '1') {
                $data['form']['hidden']['checked'] = true;
            }

            $data['form']['teaser'] = $post->teaser;

            $data['form']['posted_on'] = array(
                'name' => 'posted_on',
                'id' => 'posted_on',
                'value' => date("d.m.y - H:i", $post->posted_on),
                'class' => 'form-control',
                'disabled' => true
            );

            $data['form']['crawled_on'] = array(
                'name' => 'crawled_on',
                'id' => 'crawled_on',
                'value' => date("d.m.y - H:i", $post->crawled_on),
                'class' => 'form-control',
                'disabled' => true
            );

            $data['form']['sport'] = $this->feed->get_sports();
            $data['form']['sport_selected'] = $post->sport_uid;

            $data['form']['category'] = $this->feed->get_categories();
            $data['form']['category_selected'] = $post->category_uid;

            $data['form']['tournament'] = $this->tournament->get_dropdown();

            if ((int)$post->unique_tournament_uid > 0) {
                $data['form']['tournament_selected'] = 'unq-' . (int)$post->unique_tournament_uid;
            } else {
                $data['form']['tournament_selected'] = $post->tournament_uid;
            }

            if ($post->team1_uid > 0) {
                $team = $this->team->get_by_id($post->team1_uid);
                $data['form']['team1_selected_name'] =
                    " data-option=\"" . $team['name'] . ' [' . $team['gender'] . '] <i>(' . $team['spname'] . ' -> '
                    . $team['catname'] . ' -> ' . $team['tnname'] . ')</i>' . "\" ";
                $data['form']['team1_selected'] = $post->team1_uid;
            } else {
                $data['form']['team1_selected_name'] = '';
                $data['form']['team1_selected'] = "";
            }

            if ($post->team2_uid > 0) {
                $team = $this->team->get_by_id($post->team2_uid);
                $data['form']['team2_selected_name'] =
                    " data-option=\"" . $team['name'] . ' [' . $team['gender'] . '] <i>(' . $team['spname'] . ' -> '
                    . $team['catname'] . ' -> ' . $team['tnname'] . ')</i>' . "\" ";
                $data['form']['team2_selected'] = $post->team2_uid;
            } else {
                $data['form']['team2_selected_name'] = '';
                $data['form']['team2_selected'] = "";
            }

            $data['submitbtn'] = array(
                'class' => 'btn green',
                'type' => 'submit',
                'content' => 'Speichern',
                'name' => 'submitbutton'
            );

            $data['form']['language'] = $this->feed->get_languages();
            $data['form']['language_selected'] = $post->language;

            $data['headline'] = 'Nachricht bearbeiten';
            $data['action'] = 'update/' . $post->uid;

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/post/edit', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/feed', 'refresh');
        }
    }

    public function getAsync() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->model('post_model', 'post', true);
            $iTotalRecords = $this->post->count();
            $iDisplayLength = intval($this->input->post('iDisplayLength'));
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['iDisplayStart']);
            $sEcho = intval($_REQUEST['sEcho']);
            $records = array();
            $records["aaData"] = array();
            $search = array();

            $search['uid'] = $this->input->post('filter_uid');
            $search['title'] = $this->input->post('filter_title');
            $search['feedname'] = $this->input->post('filter_feedname');
            $search['sportname'] = $this->input->post('filter_sportname');
            $search['categoryname'] = $this->input->post('filter_categoryname');
            $search['tournamentname'] = $this->input->post('filter_tournamentname');
            $search['teamname'] = $this->input->post('filter_teamname');

            $cols = array(
                'uid',
                'posted_on',
                'title',
                'feedname',
                'sportname',
                'categoryname',
                'tournamentname',
                'teamname',
                ''
            );

            $sortby = $cols[$this->input->post('iSortCol_0')];

            $dir = $this->input->post('sSortDir_0');

            $data = $this->post->get($iDisplayStart, $iDisplayLength, $sortby, $dir, $search);
            $posts = $data['posts'];
            $filtercount = $data['count'];

            foreach ($posts as $p) {
                $enh = "";
                $title = "";
                $cursor = "";
                if (strlen(strip_tags($p['title'])) >= 60) {
                    $enh = "...";
                    $title = $p['title'];
                    $cursor = "help";
                }


                if (!empty($p['untnname'])) {
                    $p['tournamentname'] = $p['untnname'];
                }

                $teamnames = '';

                if (strlen($p['teamname'])>0) {
                    $teamnames .= $p['team1name'] . ' (' . $p['team1gender'] . ')';
                }
                if (strlen($p['team2name'])>0) {
                  if(strlen($teamnames)>0) {
                    $teamnames .= '<br/>';
                  }
                  $teamnames .= $p['team2name'] . ' (' . $p['team2gender'] . ')';
                }

                $records["aaData"][] = array(
                    $p['uid'],
                    date("d.m.y - H:i", $p['posted_on']),
                    '<p class="teasertext"><a class="subtext ' . $cursor . '" title="' . $title . '">'
                    . mb_substr($p['title'], 0, 60) . '' . $enh . '</a><br/><br/>' . strip_tags($p['teaser']) . '</p>',
                    $p['feedname'] . '<br/><br/><p style="white-space:normal !important;">' . $p['keywords'] . '</p>',
                    $p['sportname'],
                    $p['categoryname'],
                    $p['tournamentname'],
                    $teamnames,
                    anchor(
                        "backend/post/edit/" . $p['uid'],
                        '<i class="fa fa-edit"></i>',
                        array('class' => 'btn default btn-xs grey')
                    ) . anchor(
                        "backend/post/remove/" . $p['uid'],
                        '<i class="fa fa-times"></i>',
                        array(
                            'class' => 'btn default btn-xs red must-confirm',
                            'data-message' => 'Sind Sie sicher, dass Sie die Nachricht löschen möchten?'
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

            $headerdata['title'] = 'Post Konfiguration | BET-IT-BEST';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $data['feeds'] = $this->feed->get();

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/post/index', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            redirect('backend/auth/login', 'refresh');
        }
    }

    public function remove($id) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->model('post_model', 'post', true);

            $this->post->remove($id);
            $this->session->set_flashdata('message', 'Der Eintrag wurde erfolgreich gel&ouml;scht');
        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
        }
        redirect('backend/post', 'refresh');

    }

    public function update($id) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Name', 'required');
            $this->form_validation->set_rules('url', 'URL', 'required');

            if ($this->form_validation->run() == true) {

                $post_array = $this->input->post();

                if (strpos($post_array['tournament_uid'], 'unq-') !== false) {
                    $post_array['unique_tournament_uid'] = (int)str_replace('unq-', '', $post_array['tournament_uid']);
                    $post_array['tournament_uid'] = 0;
                } else {
                    $post_array['unique_tournament_uid'] = 0;
                }

                $post_array['recategorize'] = 1;

                unset($post_array['submitbutton']);
                unset($post_array['crawled_on']);
                unset($post_array['posted_on']);
                unset($post_array['vendor']);

                $this->load->model('post_model', 'post', true);

                if (!isset($post_array['hidden'])) {
                    $post_array['hidden'] = 0;
                }

                $this->post->update($id, $post_array);
                $this->session->set_flashdata('message', 'Ihre Änderungen wurden erfolgreich gespeichert.');
                redirect('backend/post', 'refresh');

            } else {
                $this->session->set_flashdata('error',
                    'Beim Speichern Ihrer Änderungen ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.');
                redirect('backend/post', 'refresh');
            }

        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/post', 'refresh');
        }
    }

}

/* End of file home.php */
/* Location: ./application/controllers/backend/home.php */
