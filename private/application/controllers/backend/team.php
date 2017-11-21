<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Team
 * @property Ion_auth $ion_auth
 * @property team_model $team
 * @property language_model $language
 * @property keyword_model $keyword
 * @property feed_model $feed
 * @property tournament_model $tournament
 * @property seo_model $seo
 */
class Team extends CI_Controller {

    public function create_seourls() {
        $this->load->helper('url');
        $result = $this->db->get('team')->result_array();

        foreach ($result as $res) {

            $url = strtolower(url_title($res['name'] . '-' . $res['betradar_uid']));
            if ($res['seourl'] == "") {
                $this->db->where('uid', $res['uid']);
                $this->db->update('team', array('seourl' => $url));
            }
        }

    }

    public function edit($uid) {
        if ($this->ion_auth->logged_in()) {

            $this->load->helper('form_helper');

            $this->load->model('team_model', 'team', true);
            $this->load->model('feed_model', 'feed', true);
            $this->load->model('tournament_model', 'tournament', true);
            $this->load->model('keyword_model', 'keyword', true);
            $this->load->model('backend/language_model', 'language', true);

            $team = $this->team->get_by_id_with_rel($uid);

            $videos = $this->team->getVideos($uid);
            $videosString = "";

            foreach ($videos as $v) {
                $videosString .= "[-1][" . $v['type'] . "][" . $v['value'] . "][" . $v['name'] . "]||";
            }

            $headerdata['title'] = 'Mannschaften | BIB - Betreiberbackend';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $data = array(
                'headline' => $team[0]['name'] . ' <small>bearbeiten</small>',
                'action' => 'update/' . $team[0]['uid'],
                'form' => array(),
                'submitbtn' => array(
                    'class' => 'btn green',
                    'type' => 'submit',
                    'content' => 'Speichern',
                    'name' => 'submitbutton'
                )
            );

            $data['form']['uid'] = array(
                'name' => 'uid',
                'id' => 'uid',
                'type' => 'text',
                'value' => $team[0]['uid'],
                'class' => 'form-control',
                'disabled' => true
            );

            $data['form']['name'] = array(
                'name' => 'name',
                'id' => 'name',
                'type' => 'text',
                'value' => $team[0]['name'],
                'class' => 'form-control'
            );

            $data['form']['header_image'] = array(
                'name' => 'header_image',
                'id' => 'header_image',
                'type' => 'file',
            );
            $data['form']['current_image'] = $team[0]['header_image'];


            $langs = $this->language->get_languages();
            $data['langs'] = $langs;

            foreach ($langs as $item) {

                $data['form']['name_local_' . $item->uid] = array(
                    'name' => 'name_local_' . $item->uid,
                    'id' => 'name_local_' . $item->uid,
                    'type' => 'text',
                    'value' => dblang('team_' . $uid . '_name', $item->uid, false),
                    'class' => 'form-control'
                );
            }

            $data['videosString'] = $videosString;
            $data['keywords'] = $this->keyword->get_team_matchings($team[0]['uid']);

            $bl = $this->keyword->get_blacklist($team[0]['uid'], 'sportnews_team');
            if (count($bl['uids']) > 0 && count($bl['texts']) === count($bl['uids'])) {
                $data['blacklistitem_uids'] = implode(',', $bl['uids']);
                $data['blacklistitem_texts'] = implode('||', $bl['texts']);
            } else {
                $data['blacklistitem_uids'] = "";
                $data['blacklistitem_texts'] = "";
            }

            $data['videos'] = $videos;
            $data['channels'] = $this->team->get_twitterfeeds($team[0]['uid']);
            $data['channelString'] = "";

            foreach($data['channels'] as $chan) {
              $data['channelString'] .= "[-1][" . $chan['feed_uid'] . "][" . $chan['name'] . "]||";
            }

            $data['channels2'] = $this->team->get_instagramfeeds($team[0]['uid']);

            foreach($data['channels2'] as $chan) {
              $data['channelString'] .= "[-1][" . $chan['feed_uid'] . "][" .$chan['feed_name'] . "][". $chan['name'] . "]||";
            }

            $data['addkw']['sport'] = $this->feed->get_sports();
            $data['addkw']['category'] = $this->feed->get_categories();
            $data['addkw']['tournament'] = $this->tournament->get_dropdown();

            $data['gender'] = $team[0]['gender'];
            $data['teamuid'] = $team[0]['uid'];

            $data['sports'] = array();
            $data['tournaments'] = array();
            $data['categories'] = array();
            foreach ($team as $t) {
                $data['tournaments'][$t['tnuid']] = $t['tnname'];
                if (!isset($data['sports'][$t['sportid']])) {
                    $data['sports'][$t['sportid']] = $t['sportname'];
                }
                if (!isset($data['categories'][$t['catid']])) {
                    $data['categories'][$t['catid']] = $t['catname'];
                }
            }
            $data['teamname'] = $team[0]['name'];

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/team/edit', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            redirect('backend/auth/login', 'refresh');
        }
    }

    public function getAsync() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->model('team_model', 'team', true);
            $iTotalRecords = $this->team->count();
            $iDisplayLength = intval($this->input->post('iDisplayLength'));
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['iDisplayStart']);
            $sEcho = intval($_REQUEST['sEcho']);
            $records = array();
            $records["aaData"] = array();
            $search = array();

            $search['uid'] = $this->input->post('filter_uid');
            $search['name'] = $this->input->post('filter_name');
            $search['sportname'] = $this->input->post('filter_sportname');
            $search['categoryname'] = $this->input->post('filter_categoryname');
            $search['tournamentname'] = $this->input->post('filter_tournamentname');

            $cols = array('uid', 'name', 'sportname', 'categoryname', 'tournamentname');

            $sortby = $cols[$this->input->post('iSortCol_0')];
            $dir = $this->input->post('sSortDir_0');
            $teamres = $this->team->get($iDisplayStart, $iDisplayLength, $sortby, $dir, $search);
            $teams = $teamres['result'];
            $filtercount = $teamres['count'];

            $lastUID = 0;
            $lastI = -1;
            $lasttn = "";
            for ($i = 0; $i < count($teams); ++$i) {

                $t = $teams[$i];

                if ($t['uniquetnname'] != "") {
                    $t['tournamentname'] = $t['uniquetnname'];
                }

                if ($t['uid'] == $lastUID) {

                    if ($lasttn != $t['tournamentname']) {
                        $records["aaData"][$lastI][3] .= "<br/>" . $t['categoryname'];
                        $records["aaData"][$lastI][4] .= "<br/>" . $t['tournamentname'];
                    }

                } else {

                    ++$lastI;

                    $gender = "";
                    if ($t['gender'] != "") {
                        $gender = " (" . strtoupper($t['gender']) . ")";
                    }
                    $enh = "";
                    $title = "";
                    $cursor = "";
                    if (strlen($t['name']) >= 80) {
                        $enh = "...";
                        $title = $t['name'];
                        $cursor = "help";
                    }

                    $records["aaData"][$lastI] = array(
                        $t['uid'],
                        '<a class="subtext ' . $cursor . '" title="' . $title . '">'
                        . htmlspecialchars(substr($t['name'], 0, 80)) . '' . $enh . $gender . '</a>',
                        $t['sportname'],
                        $t['categoryname'],
                        $t['tournamentname'],
                        anchor(
                            "backend/team/edit/" . $t['uid'],
                            '<i class="fa fa-edit"></i>',
                            array('class' => 'btn default btn-xs grey')
                        ) . anchor(
                            "backend/team/remove/" . $t['uid'],
                            '<i class="fa fa-times"></i>',
                            array(
                                'class' => 'btn default btn-xs red must-confirm',
                                'data-message' => 'Sind Sie sicher, dass Sie die Mannschaft <strong>'
                                    . htmlspecialchars(substr($t['name'], 0, 80)) . $enh . '</strong> löschen möchten?'
                            )
                        )
                    );

                }
                $lasttn = $t['tournamentname'];
                $lastUID = $t['uid'];
            }

            $records["sEcho"] = $sEcho;
            $records["iTotalRecords"] = $iTotalRecords;
            $records["iTotalDisplayRecords"] = $filtercount;

            echo json_encode($records);

        } else {
            echo "";
        }

    }

    public function getTeamDropdown() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $q = $this->input->get('q');
            $p = $this->input->get('page');

            $this->load->model('team_model', 'team', true);
            $search['name'] = $q;
            $records = $this->team->get( ($p - 1)*30 , 30, 'name', 'asc', $search, true);

            echo json_encode($records);

        }
    }

    public function index() {

        if ($this->ion_auth->logged_in()) {

            $headerdata['title'] = 'Mannschaften | BIB - Betreiberbackend';
            $headerdata['langcode'] = 'de';
            $headerdata['userid'] = $this->ion_auth->user()->row()->id;
            $headerdata['username'] =
                $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

            $data = array();

            $this->load->view('backend/layouts/header', $headerdata);
            $this->load->view('backend/layouts/sidebar');
            $this->load->view('backend/team/index', $data);
            $this->load->view('backend/layouts/footer');

        } else {
            redirect('backend/auth/login', 'refresh');
        }
    }

    public function remove($id = false) {

        $this->load->model('team_model', 'team', true);

        if ($id == false) {
            redirect('/backend/team');
            return;
        }

        if ($this->team->remove($id)) {
            $this->session->set_flashdata('message', 'Das Team wurde erfolgreich gelöscht.');
        } else {
            $this->session->set_flashdata('message', 'Es ist ein Fehler aufgetreten.');
        }

        redirect('/backend/team', 'refresh');
    }

    public function resetSquads() {
      // if (!$this->ion_auth->is_admin()) {
      //   $this->session->set_flashdata('message', 'Diese Aktion kann nur als Administrator ausgeführt werden.');
      //   redirect('/backend/team', 'refresh');
      // }

      // $this->load->model('team_model', 'team', true);
      // $this->team->reset_squads();

      // $this->session->set_flashdata('message', 'Kaderdaten wurden erfolgreich zurückgesetzt.');
      // redirect('/backend/team', 'refresh');
    }

    public function update($uid) {
        if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {

            $this->load->model('seo_model', 'seo', true);

            $team_array = $this->input->post();
            $team_array = $this->seo->backend_save($team_array);

            unset($team_array['submitbutton']);
            $this->load->model('team_model', 'team', true);
            $this->load->model('backend/language_model', 'language', true);
            $this->load->model('keyword_model', 'keyword', true);

            $this->team->clearVideos($uid);
            if ($this->cache->get("videos_team_{$uid}") !== false) {
                $this->cache->delete("videos_team_{$uid}");
            }

            $feeds = $this->team->get_twitterfeeds($uid);
            foreach($feeds as &$f) {
              $f['toDelete'] = 1;
            }

            $ifeeds = $this->team->get_instagramfeeds($uid);
            foreach($ifeeds as &$if) {
              $if['toDeletei'] = 1;
            }

            if (strlen($team_array['twitter-channels']) > 0) {
                $relations = explode("||", substr($team_array['twitter-channels'], 0, -2));

                for ($i = 0; $i < count($relations); ++$i) {
                    $rel = explode("][", substr($relations[$i], 1, strlen($relations[$i]) - 2));
                    $newItem = true;
                    foreach($feeds as &$g) {
                      if (
                        $g['name'] === $rel[2] &&
                        $g['feed_uid'] === $rel[1] &&
                        $g['team_uid'] === $uid
                      ) {
                        $g['toDelete'] = 0;
                        $newItem = false;
                      }
                    }
                    if($newItem) {
                      $this->team->add_twitterfeed($uid, $rel[2], $rel[1]);
                    }
                }

                foreach($feeds as $h) {
                  if($h['toDelete'] === 1) {
                    $this->team->remove_twitterfeed($h['uid']);
                  }
                }

            } else {
              foreach($feeds as $h) {
                $this->team->remove_twitterfeed($h['uid']);
              }
            }
            /*
            if (strlen($team_array['instagram-channels']) > 0) {
                $relations = explode("||", substr($team_array['instagram-channels'], 0, -2));

                for ($i = 0; $i < count($relations); ++$i) {
                    $rel = explode("][", substr($relations[$i], 1, strlen($relations[$i]) - 2));
                    $newItem = true;
                    foreach($ifeeds as &$g) {
                      if (
                        $g['name'] === $rel[2] &&
                        $g['feed_uid'] === $rel[1] &&
                        $g['team_uid'] === $uid &&
                        $g['feed_name'] === $rel[5]
                      ) {
                        $g['toDeletei'] = 0;
                        $newItem = false;
                      }
                    }
                    if($newItem) {
                      $this->team->add_instagramfeed($uid, $rel[2], $rel[1], $rel[5]);
                    }
                }

                foreach($ifeeds as $h) {
                  if($h['toDeletei'] === 1) {
                    $this->team->remove_instagramfeed($h['uid']);
                  }
                }

            } else {
              foreach($ifeeds as $h) {
                $this->team->remove_instagramfeed($h['uid']);
              }
            }
            */

            if (strlen($team_array['youtube-relations']) > 0) {
                $relations = explode("||",
                    substr($team_array['youtube-relations'], 0, -2));

                for ($i = 0; $i < count($relations); ++$i) {
                    $rel = explode("][", substr($relations[$i], 1, strlen($relations[$i]) - 2));
                    $this->team->addVideo($uid, $rel[1], $rel[2], $rel[3]);
                }
            }

            if(strlen(trim($team_array['name']))>0) {
                $this->team->saveName($uid, $team_array['name']);
            }

            $ulconfig = array(
                'upload_path' => 'pool/uploads/team/',
                'allowed_types' => 'jpg|png',
                'max_size' => '300000',
                'encrypt_name' => true
            );

            $this->load->library('upload', $ulconfig);

            if ($this->upload->do_upload('header_image') == true) {
                $imgdata = $this->upload->data();
                $this->team->set_headerimage($uid, $imgdata['file_name']);
            }

            $this->keyword->deleteBlacklist("sportnews_team", $uid);
            $this->keyword->delete_keyword_matchings($team_array['remove_keywords_string']);
            unset($team_array['remove_keywords_string']);

            $blacklistitems = explode("||", $team_array['blacklistitems']);
            foreach ($blacklistitems as $item) {
                if ((string)(int)$item == $item) {
                    $this->keyword->addBlacklistKeyword($item, "sportnews_team", $uid);
                } else {
                    $this->keyword->createBlacklistKeyword($item, "sportnews_team", $uid);
                }
            }

            foreach ($team_array as $key => $val) {
                if (strpos($key, 'name_local') !== false) {
                    $this->language->insert_or_update_string('team_' . $uid . '_name', $val,
                        (int)str_replace('name_local_', '', $key));
                }
            }


            $this->session->set_flashdata('message', 'Ihre Änderungen wurden erfolgreich gespeichert.');
            redirect('backend/team', 'refresh');

            $this->session->set_flashdata('error',
                'Beim Speichern Ihrer Änderungen ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.');
            redirect('backend/team', 'refresh');

        } else {
            $this->session->set_flashdata('error', 'Sie haben nicht die nötigen Rechte um diese Aktion auszuführen');
            redirect('backend/team', 'refresh');
        }
    }
}

/* End of file home.php */
/* Location: ./application/controllers/backend/home.php */
