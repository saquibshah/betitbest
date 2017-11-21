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
 * @property search_model $search
 * @property category_model $category
 * @property match_model $match
 * @property video_model $video
 * @property MY_Lang $lang
 * @property Cache $cache
 */
class Home extends CI_Controller {
    public $is_formcheck = false;
    public $is_kader = false;
    public $is_table = false;
    public $translated_only = false;
    public $videos_only = false;

    function __construct() {
        parent::__construct();
        $this->load->model('post_model', 'post', true);
        $this->load->model('navigation_model', 'nav', true);
        $this->load->helper('cache');
    }

    public function _remap() {
        $segs = $this->uri->segment_array();
		
		if ($segs[1] == 'sportsnews') {
            $i = 2;
            while (isset($segs[$i])) {
                $segs[$i-1] = $segs[$i];
                $i++;
            }
            unset($segs[$i-1]);
        }

        if ($segs[2] === 'search') {
            $this->load->model('search_model', 'search', true);
            echo json_encode($this->search->find(urldecode($segs[3])));
            return;
        }

        if ($segs[2] === 'tennis-tournaments') {
            $this->load->model('tournament_model', 'tournament', true);
            echo json_encode($this->tournament->get_tennis_tournaments($segs));
            return;
        }

        $section = false;  
        $this->load->helper('cookie');
        $this->session->set_flashdata('refer', current_url());

        $getFavs = $this->input->get("favourites");
        if ($this->input->get("only_localized") && (int)$this->input->get("only_localized") === 1) {
            $this->translated_only = true;
        } else if ($this->input->get("only_localized") && (int)$this->input->get("only_localized") === 2) {
            $this->translated_only = false;
        }

        if (count($segs) > 1 && $segs[2] === 'get_favs') {
            $this->get_favs($segs[3]);
        } elseif (count($segs) > 2 && $segs[count($segs) - 1] == 'reload') {
            if ($segs[count($segs)] === 'toggle_localized_news') {
                $this->toggle_localized_news();
            } else {
                $offset = $segs[count($segs)];
                unset($segs[count($segs)]);
                unset($segs[count($segs)]);
                $this->dynamic_reload($segs, $offset, $getFavs);
            }
        } elseif (count($segs) == 3 && $segs[2] == 'news') {
            $this->news($segs[3]);
        } else {
            switch ($segs[count($segs)]) {
                case 'get_kader':
                    $this->is_kader = true;
                    array_pop($segs);
                    break;
                case 'get_formcheck':
                    $this->is_formcheck = true;
                    array_pop($segs);
                    break;
                case 'get_table':
                    $this->is_table = true;
                    array_pop($segs);
                    break;
                case 'videos_only':
                    $this->videos_only = true;
                    array_pop($segs);
                    break;
                case 'toggle_localized_news':
                    $this->toggle_localized_news();
                    break;
            }

            switch ($segs[count($segs)]) {
                case 'table':
                case 'dates':
                case 'players':
//todo Translate!
                case 'last-matches':
                    $section = $segs[count($segs)];
                    if ($section == 'last-matches') {
                        $section = "roundup";
                    }
                    array_pop($segs);
                    break;
                case 'news':
                    array_pop($segs);
                    redirect(site_url($segs), 'location', 301);
                    break;
            }

            switch (count($segs)) {
                default:
                    show_404();
                    break;

                case 2:
                    if ($segs[2] == 'home') {
                        $cookie = explode(";", get_cookie('favorites'));
                        if (count($cookie) > 0 && $cookie[0] != "") {
                            $favoritesUrl = site_url('favourites');
                            if ($this->input->get()) {
                                $favoritesUrl .= "?{$this->input->server('QUERY_STRING')}";
                            }

                            redirect($favoritesUrl);
                        } else {
                            $this->landingpage();
                        }
                    } elseif ($segs[2] == 'favourites') {
                        $this->favourites($getFavs);
                    } else {
                        $this->sports($segs[2], $section);
                    }
                    break;

                case 3:
                    if ($segs[2] == 'teams') {
                        $this->team(false, false, false, $segs[3], $section);
                    } else {
                        $this->category($segs[2], $segs[3], $section);
                    }
                    break;

                case 4:
                    $this->tournament($segs[2], $segs[3], $segs[4], $section);
                    break;

                case 5:
                    $this->team($segs[2], $segs[3], $segs[4], $segs[5], $section);
                    break;
            }
        }

    }

    public function category($sport, $cat, $active = false) {
        $this->load->model('sport_model', 'sport', true);
        $this->load->model('category_model', 'category', true);
        $this->load->model('tournament_model', 'tournament', true);
        $this->load->model('match_model', 'match', true);
        $this->load->model('video_model', 'video', true);

        $this->load->model('seo_model', 'seo', true);
        $langs = $this->config->item('language_db');
        $l = $langs[$this->lang->lang()];

        if (!$cached_sport = $this->cache->get('sport_by_url_' . $this->security->sanitize_filename($sport))) {
            $cached_sport = $this->sport->get_by_url($sport);

            if (empty($cached_sport)) {
                show_404();
            }

            $this->cache->write($cached_sport, 'sport_by_url_' . $this->security->sanitize_filename($sport), 3600);
        }
        $sport = $cached_sport;

        if (count($sport) == 0) {
            die();
        }

        if (!$category =
            $this->cache->get('category_by_url_' . $this->security->sanitize_filename($cat) . '_and_sportid_'
                . $sport['uid'])
        ) {
            $category = $this->category->get_by_url($sport['uid'], $cat);

            if (empty($category)) {
                show_404();
            }

            $this->cache->write($category,
                'category_by_url_' . $this->security->sanitize_filename($cat) . '_and_sportid_' . $sport['uid'], 3600);
        }
        $seocontent = $this->seo->get_contents('category', $category['uid'], $l);

        if (count($category) == 0) {
            die();
        }

        if (dblang('category_' . $category['uid'] . '_name') != 'category_' . $category['uid'] . '_name') {
            $catname = dblang('category_' . $category['uid'] . '_name');
        } else {
            $catname = $category['name'];
        }

        if (!$navtournaments = $this->cache->get('tournaments_for_category_' . $category['uid'])) {
            $navtournaments = $this->tournament->get_by_category($category['uid']);
            $this->cache->write($navtournaments, 'tournaments_for_category_' . $category['uid'], 3600);
        }

        if (!$navsports = $this->cache->get('navsports')) {
            $navsports = $this->sport->get_sports(true);
            $this->cache->write($navsports, 'navsports', 3600);
        }

        if (!$navcategories = $this->cache->get('categories_bysport_' . $sport['uid'])) {
            $navcategories = $this->category->get_by_sport($sport['uid'], true);
            $this->cache->write($navcategories, 'categories_bysport_' . $sport['uid'], 3600);
        }

        if (count($category) > 0) {
            $headerdata = array(
                'sports' => $navsports,
                'categories' => $navcategories,
                'current_category' => '<span><b>' . $catname . '</b><i class="fa fa-times-circle"></i></span>',
                'tournaments' => $navtournaments,
                'current_tournament' => dblang("choose_tournament"),
                'current_sport_url' => site_url($sport['seourl']),
                'current_url' => site_url(array($sport['seourl'], $category['seourl'])),
                'current_category_uid' => $category['uid'],
                'current_cat_url' => site_url(array($sport['seourl'], $category['seourl'])),
                'headline' => $catname,
                'seo' => $seocontent
            );

            if (strlen($category['header_image']) > 0) {
                $headerdata['headerImage'] = ('pool/uploads/category/' . $category['header_image']);
            } elseif (strlen($sport['header_image']) > 0) {
                $headerdata['headerImage'] = ('pool/uploads/sport/' . $sport['header_image']);
            }

            if (!$tabs = $this->cache->get('sport_' . $sport['uid'] . '_category_tabnav_array_' . $this->lang->lang() . '_' . $category['uid'])) {
                $tabs = array();
                $tabs[] = array('id' => 'news', 'title' => dblang('tabnav_news'),
                    'link' => site_url(array($sport['seourl'], $category['seourl'])));
                if (count($this->match->get(1, 0, $sport['uid'], $category['uid'])) > 0) {
                    $tabs[] = array('id' => 'dates', 'title' => dblang('tabnav_dates'),
                        'link' => site_url(array($sport['seourl'], $category['seourl'], 'dates')));
                }
                $this->cache->write($tabs, 'sport_' . $sport['uid'] . '_category_tabnav_array_' . $this->lang->lang() . '_' . $category['uid'],
                    3600);
            }

            $curtab = $active == false ? 'news' : $active;

            if (!$active) {

                $videos = cacheVideos($category['uid'], 'category');

                $headerdata['facebookGraph'] = true;
                $headerdata['videos'] = $videos;

                $data = array(
                    'pagename' => dblang('sport_' . $sport['uid'] . '_name') . " <br class='mobile' />" . $catname,
                    'add_to_favs' => 'cat:' . $category['uid'],
                    'tabs' => $tabs,
                    'currenttab' => $curtab,
                    'news' => $this->post->get_frontend(false, 0, 40, $sport['uid'], $category['uid']),
                    'videos' => $videos,
                    'seo' => $seocontent
                );

                if ($this->videos_only) {
                    echo json_encode($data['videos']);
                } else {
                    $this->load->view('layouts/frontend_head', $headerdata);
                    $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                    $this->load->view('home', $data);
                    $this->load->view('layouts/frontend_footer', $data);
                }

            } else {

                if ($active == 'dates') {

                    $data = array(
                        'pagename' => 'Begegnungen',
                        'add_to_favs' => 'category:' . $category['uid'],
                        'tabs' => $tabs,
                        'currenttab' => $curtab,
                        'matches' => $this->match->get(20, 0, $sport['uid'], $category['uid'])
                    );

                    $this->load->view('layouts/frontend_head', $headerdata);
                    $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                    $this->load->view('matches', $data);
                    $this->load->view('layouts/frontend_footer', $data);

                }
            }
        } else {
            show_404();
        }
    }

    public function favourites($getFavs = false) {
        $this->load->helper('cookie');
        $favs = array();

        if ($getFavs) {
            $cookie = explode(";", substr($getFavs, 0, strlen($getFavs) - 1));
        } else {
            $cookie = explode(";", get_cookie('favorites'));
        }

        if (empty($cookie) || empty($cookie[0])) {
            redirect(site_url('home'));
        }

        foreach ($cookie as $c) {
            if (strpos($c, ':') === FALSE)   continue;
            list($key, $val) = explode(":", $c);
            $favs[$key][] = $val;
        }

        $this->load->model('sport_model', 'sport', true);
        $headerdata = array(
            'sports' => $this->sport->get_sports(true),
            'ishome' => true,
            'headerImage' => 'assets/frontend/images/header_favoriten.jpg',
            'headline' => dblang('favourites')
        );

        $tabs = array();

        $this->load->model('video_model', 'video', true);
        $videos = $this->video->get_favourite_videos($favs);

        $data = array(
            'pagename' => dblang('my_favourites'),
            'tabs' => $tabs,
            'news' => $this->post->get_favourites(false, 0, 40, $favs),
            'videos' => $videos
        );

        if ($this->videos_only) {
            echo json_encode($data['videos']);
        } else {
            $this->load->view('layouts/frontend_head', $headerdata);
            $data['favs'] = $this->load->view('layouts/favorites', array(), true);
            $this->load->view('home', $data);
            $this->load->view('layouts/frontend_footer', $data);
        }

    }

    public function get_favs($favstring) {
        $this->load->model('category_model', 'category', true);
        $this->load->model('tournament_model', 'tournament', true);
        $this->load->model('team_model', 'team', true);

        $favs = explode("_", $favstring);
        $sports = array();

        if (count($favs) > 0) {
            foreach ($favs as $fav) {
                $val = explode("-", $fav);
                $data[$val[0]][] = $val[1];
            }

            //if we have at least one cat
            if (isset($data['cat']) && count($data['cat']) > 0) {
                for ($i = 0; $i < count($data['cat']); ++$i) {
                    $cat = $this->category->get_single($data['cat'][$i]);
                    if (dblang('sport_' . $cat['sport_uid'] . '_name') !== 'sport_' . $cat['sport_uid'] . '_name') {
                        $cat['sportname'] = dblang('sport_' . $cat['sport_uid'] . '_name');
                    }
                    $cat['thetype'] = 'category';
                    $sports[$cat['sport_uid']][] = $cat;
                }
            }
            if (isset($data['uniquetournament']) && count($data['uniquetournament']) > 0) {
                for ($i = 0; $i < count($data['uniquetournament']); ++$i) {
                    $tn = $this->tournament->get_single($data['uniquetournament'][$i], 'unique');
                    if (dblang('sport_' . $tn->sport_uid . '_name') !== 'sport_' . $tn->sport_uid . '_name') {
                        $tn->sportname = dblang('sport_' . $tn->sport_uid . '_name');
                    }
                    $tn->thetype = 'uniquetournament';
                    $sports[$tn->sport_uid][] = $tn;
                }
            }
            if (isset($data['tournament']) && count($data['tournament']) > 0) {
                for ($i = 0; $i < count($data['tournament']); ++$i) {
                    $tn = $this->tournament->get_single($data['tournament'][$i]);
                    if (dblang('sport_' . $tn->sport_uid . '_name') !== 'sport_' . $tn->sport_uid . '_name') {
                        $tn->sportname = dblang('sport_' . $tn->sport_uid . '_name');
                    }
                    $tn->thetype = 'tournament';
                    $sports[$tn->sport_uid][] = $tn;
                }
            }
            if (isset($data['team']) && count($data['team']) > 0) {
                for ($i = 0; $i < count($data['team']); ++$i) {
                    $tn = $this->team->get_by_id_for_favs($data['team'][$i]);
                    if (dblang('sport_' . $tn->sport_uid . '_name') !== 'sport_' . $tn->sport_uid . '_name') {
                        $tn->sportname = dblang('sport_' . $tn->sport_uid . '_name');
                    }
                    $tn->thetype = 'team';
                    $sports[$tn->sport_uid][] = $tn;
                }
            }
        }

        echo json_encode($sports);

    }

    public function index($active = false) {
        $this->load->model('sport_model', 'sport', true);
        $this->load->model('match_model', 'match', true);

        $headerdata = array(
            'sports' => $this->sport->get_sports(true),
            'current_category' => dblang("choose_category"),
            'ishome' => true,
            'headline' => 'Highlights'
        );
        $tabs = array(
            array('id' => 'news', 'title' => dblang('tabnav_news'), 'link' => site_url(array('home'))),
            array('id' => 'dates', 'title' => dblang('tabnav_dates'), 'link' => site_url(array('home', 'dates')))
        );

        $curtab = $active == false ? 'news' : $active;

        if (!$active) {
            $data = array(
                'pagename' => "Highlights",
                'add_to_favs' => "",
                'tabs' => $tabs,
                'currenttab' => $curtab,
                'news' => $this->post->get_frontend(false, 0, 40)
            );

            if (!$this->videos_only) {
                $this->load->view('layouts/frontend_head', $headerdata);
                $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                $this->load->view('home', $data);
                $this->load->view('layouts/frontend_footer', $data);
            }


        } else {

            if ($active == 'dates') {

                $data = array(
                    'pagename' => 'Begegnungen',
                    'tabs' => $tabs,
                    'currenttab' => $curtab,
                    'matches' => $this->match->get()
                );

                $this->load->view('layouts/frontend_head', $headerdata);
                $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                $this->load->view('matches', $data);
                $this->load->view('layouts/frontend_footer', $data);

            }

        }

    }

    public function landingpage() {
        $this->load->model('sport_model', 'sport', true);
        $this->load->model('post_model');
        $this->load->model('video_model');

        $headerdata = array(
            'sports' => $this->sport->get_sports(true),
            'ishome' => true,
            'landingpage' => true
        );

        $this->load->view('layouts/frontend_head', $headerdata);
        $data['favs'] = $this->load->view('layouts/favorites', array(), true);
        $data['landingpage'] = true;

        $sports = $this->sport->get_sports(true);

        for ($i = 0; $i < count($sports); ++$i) {
            if (dblang('sport_' . $sports[$i]['uid'] . '_name') != 'sport_' . $sports[$i]['uid'] . '_name') {
                $sports[$i]['name'] = dblang('sport_' . $sports[$i]['uid'] . '_name');
            }
            if (strlen($sports[$i]['header_image']) === 0) {
                unset($sports[$i]);
            }
        }

        $data['teaser'] = $sports;
        
        $dataNews = array();
        $this->load->database();
        $query = $this->db->query('SELECT * FROM sportnews_sport WHERE hidden = 0');
        foreach ($query->result_array() as $row) {
            $dataNews[$row['uid']] = array();
            $dataNews[$row['uid']]['posts'] = $this->post_model->get_frontend(false, 0, 8, $row['uid']);
            $dataNews[$row['uid']]['videos'] = cacheVideos($row['uid'], 'sport');
        }
        $data['dataNews'] = $dataNews;

        $this->load->view('landingpages/index-' . $this->lang->lang(), $data);
        $this->load->view('layouts/frontend_footer', $data);

    }

    public function news($newsLink) {

        $this->load->model('sport_model', 'sport', true);
        $this->load->model('category_model', 'category', true);
        $this->load->model('tournament_model', 'tournament', true);
        $this->load->model('team_model', 'team', true);
        $this->load->model('match_model', 'match', true);
        $this->load->model('seo_model', 'seo', true);
        $this->load->model('video_model', 'video', true);
        $this->load->model('livescores/m_post');
        
        $arr = explode('_ajax_', $newsLink);
        if (count($arr) == 2) {
            echo json_encode($this->m_post->getFavoriteNews($arr[1]));
            exit;
        }
        
        $menuLvl = "";
        $newsLink = explode('-', $newsLink);
        $newsId = intval(end($newsLink));
        $headerImage = false;

        if (empty($newsId)) {
            show_404();
        }

        $newsItem = $this->post->get_post_by_id($newsId);
        if (empty($newsItem)) {
            show_404();
        }
        
        if ($newsItem->team1_uid == 0 && $newsItem->team2_uid != 0) {
            $newsItem->team1_uid = $newsItem->team2_uid;
        }

        if ($newsItem->team1_uid > 0) {
            $newsItem->hasTeam = true;
            
            $newsItem->team = (object)$this->team->get_by_id($newsItem->team1_uid);

            if (!$headerImage && strlen($newsItem->team->header_image) > 0) {
                $headerImage = "/pool/uploads/team/" . $newsItem->team->header_image;
            }

            $newsItem->tournament =
                (object) $this->tournament->get_by_team($newsItem->team1_uid, $newsItem->team->main_tournament_uid,
                    $newsItem->team->main_unique_tournament_uid);

            if(empty($newsItem->tournament->uid)) {
              redirect(site_url());
            }

            $newsItem->tournament_uid = $newsItem->tournament->uid;

            if (!$headerImage && strlen($newsItem->tournament->header_image) > 0) {
                if ($newsItem->tournament->tntype === 'unique_tournament') {
                    $headerImage = "/pool/uploads/unique_tournament/" . $newsItem->tournament->header_image;
                } else {
                    $headerImage = "/pool/uploads/tournament/" . $newsItem->tournament->header_image;
                }
            }

            $newsItem->category =
                (object)$this->category->get_single((int)$newsItem->tournament->category_uid, 0, false);

            if (!$headerImage && strlen($newsItem->category->header_image) > 0) {
                $headerImage = "/pool/uploads/category/" . $newsItem->category->header_image;
            }

            $newsItem->sport_uid = $newsItem->team->spuid;

            $newsItem->sport = (object)$this->sport->get_single($newsItem->sport_uid, false);

            if (!$headerImage && strlen($newsItem->sport->header_image) > 0) {
                $headerImage = "/pool/uploads/sport/" . $newsItem->sport->header_image;
            }

            $newsItem->trnmntname = $newsItem->tournament->name;

            $trnmnttrans = dblang("unique_tournament_{$newsItem->tournament->uid}_name");
            if ($trnmnttrans != "unique_tournament_{$newsItem->tournament->uid}_name") {
                $newsItem->trnmntname = $trnmnttrans;
            }

            $menuLvl = "team";
            $newsItem->teamname = dblang("team_{$newsItem->team1_uid}_name") == "team_{$newsItem->team1_uid}_name" ?
                $newsItem->team->name : dblang("team_{$newsItem->team1_uid}_name");

        } else {

            if (intval($newsItem->tournament_uid) != 0 || intval($newsItem->unique_tournament_uid) != 0) {
                if (intval($newsItem->unique_tournament_uid) > 0) {
                    $newsItem->tournament =
                        (object)$this->tournament->get_single($newsItem->unique_tournament_uid, true, FALSE);
                    $newsItem->trnmntname = $newsItem->tournament->name;
                    $trnmnttrans = dblang("unique_tournament_{$newsItem->tournament->uid}_name");
                    if ($trnmnttrans != "unique_tournament_{$newsItem->tournament->uid}_name") {
                        $newsItem->trnmntname = $trnmnttrans;
                    }
                    if (!$headerImage && strlen($newsItem->tournament->header_image) > 0) {
                        $headerImage = "/pool/uploads/unique_tournament/" . $newsItem->tournament->header_image;
                    }
                } else {
                    $newsItem->tournament =
                        (object)$this->tournament->get_single($newsItem->tournament_uid, false, true);
                    $newsItem->trnmntname = $newsItem->tournament->name;
                    $trnmnttrans = dblang("tournament_{$newsItem->tournament->uid}_name");
                    if ($trnmnttrans != "tournament_{$newsItem->tournament->uid}_name") {
                        $newsItem->trnmntname = $trnmnttrans;
                    }

                    if ($newsItem->tournament->unique_uid != 0) {

                        $newsItem->tournament =
                            (object)$this->tournament->get_single($newsItem->tournament->unique_uid, true, true);
                        $newsItem->trnmntname = $newsItem->tournament->name;
                        $trnmnttrans = dblang("unique_tournament_{$newsItem->tournament->uid}_name");
                        if ($trnmnttrans != "unique_tournament_{$newsItem->tournament->uid}_name") {
                            $newsItem->trnmntname = $trnmnttrans;
                        }
                        if (!$headerImage && strlen($newsItem->tournament->header_image) > 0) {
                            $headerImage = "/pool/uploads/unique_tournament/" . $newsItem->tournament->header_image;
                        }

                    } else {
                        if (!$headerImage && strlen($newsItem->tournament->header_image) > 0) {
                            $headerImage = "/pool/uploads/tournament/" . $newsItem->tournament->header_image;
                        }
                    }


                }

                $menuLvl = "tournament";
            }
        }

        if (!isset($newsItem->sport)) {
            $newsItem->sport = (object)$this->sport->get_single($newsItem->sport_uid, false);
        }

        if ($newsItem->tournament_uid != 0 || $newsItem->unique_tournament_uid != 0) {
            $newsItem->category = (object)$this->category->get_single($newsItem->tournament->category_uid);
        } elseif ($newsItem->category_uid != 0) {
            $newsItem->category = (object)$this->category->get_single($newsItem->category_uid);
        }

        if (!$headerImage && isset($newsItem->category->header_image)
            && strlen($newsItem->category->header_image) > 0
        ) {
            $headerImage = "/pool/uploads/category/" . $newsItem->category->header_image;
        }
        if (!$headerImage && strlen($newsItem->sport->header_image) > 0) {
            $headerImage = "/pool/uploads/sport/" . $newsItem->sport->header_image;
        }


        if (isset($newsItem->category)) {
            $trans = dblang("category_{$newsItem->category->uid}_name");
            if ($trans != "category_{$newsItem->category->uid}_name") {
                $newsItem->categoryName = $trans;
            } else {
                $newsItem->categoryName = $newsItem->category->name;
            }
            $menuLvl = "category";
        }

        if ($newsItem->team1_uid != 0) {
            $headerdata = array(
                'categories' => $this->category->get_by_sport($newsItem->sport_uid, true),
                'current_category' => '<span><b>' . $newsItem->categoryName . '</b><i class="fa fa-times-circle"></i></span>',
                'tournaments' => $this->tournament->get_by_category($newsItem->category->uid),
                'current_tournament' => '<span><b>' . $newsItem->trnmntname . '</b><i class="fa fa-times-circle"></i></span>',
                'current_category_uid' => $newsItem->category->uid,
                'current_tournament_uid' => $newsItem->tournament->uid,
                'current_tournament_type' => $newsItem->tournament->tntype,
                'current_team_uid' => $newsItem->team1_uid,
                'current_team_betradar_uid' => $newsItem->team->betradar_uid,
                'teams' => $this->team->get_by_tournament($newsItem->tournament->uid, $newsItem->tournament->tntype),
                'current_team' => '<span><b>' . $newsItem->teamname . '</b><i class="fa fa-times-circle"></i></span>',
                'team' => $newsItem->team,
                'headline' => $newsItem->teamname,
            );

            $videos = cacheVideos($newsItem->team->uid, 'team');

            $currentUrl = site_url("news/{$newsItem->seourl}");
            $taburls = site_url(array('teams', $newsItem->team->seourl));
            $data = array(
                'pagename' => $newsItem->teamname,
                'add_to_favs' => "team:{$newsItem->team1_uid}",
                'currenttab' => 'news'
            );


            if (!$tabs = $this->cache->get('team_tabnav_array_' . $this->lang->lang() . '_' . $newsItem->team1_uid)) {

                $hasPlayers = $this->team->has_players($newsItem->team1_uid);
                $tmptournaments = $this->team->get_tournaments($newsItem->team1_uid);
                $tncount = 0;
                foreach ($tmptournaments as $t) {
                    if ((int)$t['unique_uid'] > 0) {
                        $temp = $this->tournament->get_seasontable_by_unique($t['unique_uid'], $newsItem->team1_uid);
                        if (count($temp) > 0) {
                            $tncount++;
                        }
                    } else {
                        $temp = $this->tournament->get_seasontable($t['uid'], $newsItem->team1_uid);
                        if (count($temp) > 0) {
                            $tncount++;
                        }
                    }
                }

                $tabs = array();
                $tabs[] = array('id' => 'news', 'title' => dblang('tabnav_news'), 'link' => $taburls);
                if (count($this->match->get(1, 0, 0, 0, 0, $newsItem->team1_uid)) > 0) {
                    $tabs[] = array('id' => 'dates', 'title' => dblang('tabnav_dates'), 'link' => $taburls . '/dates');
                    $hasRoundup = true;
                } else {
                    $hasRoundup = false;
                }
                if ($tncount > 0) {
                    $tabs[] =
                        array('id' => 'table', 'title' => dblang('tabnav_leaguetable'), 'link' => $taburls . '/table');
                    /*$tabs[] =
                        array('id' => 'cuptree', 'title' => dblang('tabnav_cuptree'), 'link' => $taburls . '/cuptree');*/
                }
                if ($hasPlayers) {
                    $tabs[] =
                        array('id' => 'players', 'title' => dblang('tabnav_players'), 'link' => $taburls . '/players');
                }
                if ($hasRoundup) {
                    $tabs[] = array('id' => 'roundup', 'title' => dblang('tabnav_formcheck'),
                        'link' => $taburls . '/last-matches');
                }
                $this->cache->write($tabs, 'team_tabnav_array_' . $this->lang->lang() . '_' . $newsItem->team1_uid, 3600);
            }

            $data['tabs'] = $tabs;


            if ($newsItem->team->header_image > 0) {
                $headerdata['headerImage'] = ("pool/uploads/team/{$newsItem->team->header_image}");
            }
        } else {
            $addToFavs = '';

            if ($newsItem->tournament_uid != 0) {
                $pageName = $newsItem->tournament->name;
                $taburls = site_url(array($newsItem->sport->seourl, $newsItem->category->seourl,
                    $newsItem->tournament->seourl));
                $currentUrl = site_url(array($newsItem->sport->seourl, $newsItem->category->seourl,
                    $newsItem->tournament->seourl));

                if ($newsItem->tournament->tntype == 'unique_tournament') {
                    $addToFavs = "uniquetournament:{$newsItem->tournament->uid}";
                } else {
                    $addToFavs = "tournament:{$newsItem->tournament->uid}";
                }

                $videos = cacheVideos($newsItem->tournament->uid, $newsItem->tournament->tntype);
            } elseif ($newsItem->category_uid != 0) {
                $pageName = $newsItem->category->name;
                $taburls = site_url(array($newsItem->sport->seourl, $newsItem->category->seourl));
                $currentUrl = site_url(array($newsItem->sport->seourl, $newsItem->category->seourl));

                $videos = cacheVideos($newsItem->category->uid, 'category');
            } else {
                $pageName = $newsItem->sport->name;
                $taburls = site_url($newsItem->sport->seourl);
                $currentUrl = site_url($newsItem->sport->seourl);

                $videos = cacheVideos($newsItem->sport->uid, 'sport');
            }

            if (strlen($newsItem->sport->header_image) > 0) {
                $headerdata['headerImage'] = ("pool/uploads/sport/{$newsItem->sport->header_image}");
            }

            $headerdata = array(
                'headline' => $pageName
            );

            if ($newsItem->category_uid != 0) {
                $headerdata['categories'] = $this->category->get_by_sport($newsItem->sport_uid, true);
                $headerdata['current_category'] = '<span><b>' . $newsItem->categoryName . '</b><i class="fa fa-times-circle"></i></span>';
            }

            if ($newsItem->tournament_uid != 0 || $newsItem->unique_tournament_uid) {
                $headerdata['tournaments'] = $this->tournament->get_by_category($newsItem->category->uid);
                $headerdata['current_tournament'] = '<span><b>' . $newsItem->trnmntname . '</b><i class="fa fa-times-circle"></i></span>';
            }

            $data = array(
                'pagename' => $pageName,
                'add_to_favs' => $addToFavs,
                'currenttab' => 'news',
            );

            $tabs = array();

            if ($menuLvl === 'tournament') {

                if ($newsItem->tournament->unique_uid != 0) {
                    if (!$countTable =
                        $this->cache->get('countTable_uniquetournament_' . $newsItem->tournament->unique_uid)
                    ) {
                        $countTable =
                            count($this->tournament->get_seasontable_by_unique($newsItem->tournament->unique_uid));
                        $this->cache->write($countTable,
                            'countTable_uniquetournament_' . $newsItem->tournament->unique_uid, 3600);
                        $_tmptrn = array("uid" => $newsItem->tournament->unique_uid, "type" => "unique");
                    }
                } else if ($newsItem->tournament_uid != 0) {
                    if (!$countTable = $this->cache->get('countTable_tournament_' . $newsItem->tournament_uid)) {
                        $countTable = count($this->tournament->get_seasontable($newsItem->tournament_uid));
                        $this->cache->write($countTable, 'countTable_tournament_' . $newsItem->tournament_uid, 3600);
                        $_tmptrn = array("uid" => $newsItem->tournament->tournament_uid, "type" => "tournament");
                    }
                }
                if ($countTable > 0) {
                    $tabs[] =
                        array('id' => 'table', 'title' => dblang('tabnav_leaguetable'), 'link' => $taburls . '/table');
                    /*$tabs[] =
                        array('id' => 'cuptree', 'title' => dblang('tabnav_cuptree'), 'link' => $taburls . '/cuptree');*/
                }
                if (count($this->match->get(1, 0, $newsItem->sport->uid, $newsItem->category_uid, $_tmptrn)) > 0) {
                    $tabs[] = array('id' => 'dates', 'title' => dblang('tabnav_dates'), 'link' => $taburls . '/dates');
                }

            }
            if ($menuLvl === 'category') {
                if (count($this->match->get(1, 0, $newsItem->sport->uid, $newsItem->category_uid)) > 0) {
                    $tabs[] = array('id' => 'dates', 'title' => dblang('tabnav_dates'), 'link' => $taburls . '/dates');
                }
            }
            if ($menuLvl === '') {
                if (count($this->match->get(1, 0, $newsItem->sport->uid)) > 0) {
                    $tabs[] = array('id' => 'dates', 'title' => dblang('tabnav_dates'), 'link' => $taburls . '/dates');
                }
            }

            $tabs[] = array('id' => 'news', 'title' => dblang('tabnav_news'), 'link' => $taburls);

            # /\/\ menuLvl /\/\

            /*
            'tabs' => array(
                ,
                array('id' => 'dates', 'title' => dblang('tabnav_dates'), 'link' => $taburls . '/dates'),

            ),
            */


            $data['tabs'] = array_reverse($tabs);

        }

        $headerdata['sports'] = $this->sport->get_sports(true);
        $headerdata['current_url'] = $currentUrl;
        $headerdata['current_sport_url'] = site_url($newsItem->sport->seourl);
        $headerdata['facebookGraph'] = true;
        $headerdata['videos'] = $videos;
        $headerdata['teaser'] = $newsItem->teaser;

        if (isset($newsItem->category)) {
            $headerdata['current_cat_url'] = site_url(array($newsItem->sport->seourl, $newsItem->category->seourl));
        }

        if (isset($newsItem->tournament)) {
            $headerdata['current_trn_url'] =
                site_url(array($newsItem->sport->seourl, $newsItem->category->seourl, $newsItem->tournament->seourl));
        }

        if (!isset($newsItem->team)) {

            if (isset($newsItem->tournament)) {

                $headerdata['teams'] =
                    $this->team->get_by_tournament($newsItem->tournament->uid, $newsItem->tournament->tntype);
                $headerdata['current_team'] = dblang('choose_team');

            } else if (isset($newsItem->category)) {

                $headerdata['tournaments'] = $this->tournament->get_by_category($newsItem->category->uid);
                $headerdata['current_tournament'] = dblang('choose_tournament');

            } else if (isset($newsItem->sport)) {

                $headerdata['categories'] = $this->category->get_by_sport($newsItem->sport->uid, true);
                $headerdata['current_category'] = dblang('choose_category');

            }

        }


        $data['team'] = true;
        $data['item'] = $newsItem;
        $data['videos'] = $videos;

        if ($this->videos_only) {
            echo json_encode($data['videos']);
        } else {

            $headerdata['seo']['title'] = $newsItem->title;
            if ($headerImage) {
                $headerdata['headerImage'] = $headerImage;
            }
            
            $this->load->view('layouts/frontend_head', $headerdata);
            $data['favs'] = $this->load->view('layouts/favorites', array(), true);
            $data = array_merge($data, $this->m_post->getRelateNews($newsItem));
            $data['alterHeaderImage'] = $this->m_post->getTeamImageHolder($newsItem->team1_uid);
            if ($data['alterHeaderImage'] === FALSE) {
                $data['alterHeaderImage'] = $this->m_post->getTournamentImageHolder($newsItem);
            }
            $this->load->view('news', $data);
            $data['appendJS'] = base_url('assets/frontend/javascripts/news-favorites.js');
            $this->load->view('layouts/frontend_footer', $data);
        }
    }

    public function sports($sport, $active = false) {
        $this->load->model('sport_model', 'sport', true);
        $this->load->model('video_model', 'video', true);
        $this->load->model('category_model', 'category', true);
        $this->load->model('match_model', 'match', true);

        $this->load->model('seo_model', 'seo', true);
        $langs = $this->config->item('language_db');
        $l = $langs[$this->lang->lang()];

        if (!$cached_sport = $this->cache->get('sport_by_url_' . $this->security->sanitize_filename($sport))) {
            $cached_sport = $this->sport->get_by_url($sport);

            if (empty($cached_sport)) {
                show_404();
            }

            $this->cache->write($cached_sport, 'sport_by_url_' . $this->security->sanitize_filename($sport), 3600);
        }
        $sport = $cached_sport;

        $seocontent = $this->seo->get_contents('sport', $sport['uid'], $l);

        if (dblang('sport_' . $sport['uid'] . '_name') != 'sport_' . $sport['uid'] . '_name') {
            $sportname = dblang('sport_' . $sport['uid'] . '_name');
        } else {
            $sportname = $sport['name'];
        }

        if (!$navcategories = $this->cache->get('categories_bysport_' . $sport['uid'])) {
            $navcategories = $this->category->get_by_sport($sport['uid'], true);
            $this->cache->write($navcategories, 'categories_bysport_' . $sport['uid'], 3600);
        }

        if (!$navsports = $this->cache->get('navsports')) {
            $navsports = $this->sport->get_sports(true);
            $this->cache->write($navsports, 'navsports', 3600);
        }

        $headerdata = array(
            'sports' => $navsports,
            'categories' => $navcategories,
            'current_category' => dblang("choose_category"),
            'current_sport_url' => site_url(array($sport['seourl'])),
            'current_url' => site_url(array($sport['seourl'])),
            'current_cat_url' => site_url(array($sport['seourl'])),
            'isSport' => true,
            'headline' => $sportname,
            'seo' => $seocontent
        );

        if (!$tabs = $this->cache->get('sport_tabnav_array_' . $this->lang->lang() . '_' . $sport['uid'])) {
            $tabs = array();
            $tabs[] =
                array('id' => 'news', 'title' => dblang('tabnav_news'), 'link' => site_url(array($sport['seourl'])));
            if (count($this->match->get(20, 0, $sport['uid'])) > 0) {
                $tabs[] = array('id' => 'dates', 'title' => dblang('tabnav_dates'),
                    'link' => site_url(array($sport['seourl'], 'dates')));
            }
            $this->cache->write($tabs, 'sport_tabnav_array_' . $this->lang->lang() . '_' . $sport['uid'], 3600);
        }

        if (strlen($sport['header_image']) > 0) {
            $headerdata['headerImage'] = ('pool/uploads/sport/' . $sport['header_image']);
        }

        $curtab = $active == false ? 'news' : $active;

        if (!$active) {
            $videos = cacheVideos($sport['uid'], 'sport');

            $headerdata['facebookGraph'] = true;
            $headerdata['videos'] = $videos;

            $data = array(
                'pagename' => dblang('sport_' . $sport['uid'] . '_name'),
                'add_to_favs' => 'sport:' . $sport['uid'],
                'tabs' => $tabs,
                'currenttab' => $curtab,
                'news' => $this->post->get_frontend(false, 0, 40, $sport['uid']),
                'videos' => $videos,
                'seo' => $seocontent
            );

            if ($this->videos_only) {
                echo json_encode($data['videos']);
            } else {

                $this->load->view('layouts/frontend_head', $headerdata);
                $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                $this->load->view('home', $data);
                $this->load->view('layouts/frontend_footer', $data);

            }

        } else {

            if ($active == 'dates') {

                $data = array(
                    'pagename' => 'Begegnungen',
                    'add_to_favs' => 'sport:' . $sport['uid'],
                    'tabs' => $tabs,
                    'currenttab' => $curtab,
                    'matches' => $this->match->get(20, 0, $sport['uid'])
                );

                $this->load->view('layouts/frontend_head', $headerdata);
                $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                $this->load->view('matches', $data);
                $this->load->view('layouts/frontend_footer', $data);

            }
        }

    }

    public function team($sport = false, $cat = false, $trnmnt = false, $team, $active = false) {

        $wasSport = $sport;
        $this->load->model('sport_model', 'sport', true);
        $this->load->model('category_model', 'category', true);
        $this->load->model('tournament_model', 'tournament', true);
        $this->load->model('team_model', 'team', true);
        $this->load->model('match_model', 'match', true);
        $this->load->model('seo_model', 'seo', true);

        $tArray = explode("-", $team);
        $team = $this->team->get_by_betradar_uid($tArray[count($tArray) - 1]);

        if (empty($team)) {
            show_404();
        }

        $langs = $this->config->item('language_db');
        $l = $langs[$this->lang->lang()];

        $seocontent = $this->seo->get_contents('team', $team['uid'], $l);

        if ($sport) {

            if (!$cached_sport = $this->cache->get('sport_by_url_' . $this->security->sanitize_filename($sport))) {
                $cached_sport = $this->sport->get_by_url($sport);

                if (empty($cached_sport)) {
                    show_404();
                }

                $this->cache->write($cached_sport, 'sport_by_url_' . $this->security->sanitize_filename($sport), 3600);
            }
            $sport = $cached_sport;

            if (!$category =
                $this->cache->get('category_by_url_' . $this->security->sanitize_filename($cat) . '_and_sportid_'
                    . $sport['uid'])
            ) {
                $category = $this->category->get_by_url($sport['uid'], $cat);

                if (empty($category)) {
                    show_404();
                }

                $this->cache->write($category,
                    'category_by_url_' . $this->security->sanitize_filename($cat) . '_and_sportid_' . $sport['uid'],
                    3600);
            }

            if (!$tournament =
                $this->cache->get('tournament_by_url_' . $this->security->sanitize_filename($trnmnt) . '_and_catid_'
                    . $category['uid'])
            ) {
                $tournament = $this->tournament->get_by_url($category['uid'], $trnmnt);

                if (empty($tournament)) {
                    show_404();
                }

                $this->cache->write($tournament,
                    'tournament_by_url_' . $this->security->sanitize_filename($trnmnt) . '_and_catid_'
                    . $category['uid'], 3600);
            }

        } else {

            if (!$tournament = $this->cache->get('tournament_by_team_' . $team['uid'] . '_maintn_' . $team['main_tournament_uid']
                    . '_mainuntn_' . $team['main_unique_tournament_uid'])
            ) {
                $tournament = $this->tournament->get_by_team($team['uid'], $team['main_tournament_uid'], $team['main_unique_tournament_uid']);

                if (empty($tournament)) {
                    show_404();
                }

                $this->cache->write($tournament,
                    'tournament_by_team_' . $team['uid'] . '_maintn_' . $team['main_tournament_uid'] . '_mainuntn_'
                    . $team['main_unique_tournament_uid'], 3600);
            }

            if (!$category = $this->cache->get('category_by_tournament_' . $tournament['category_uid'] . '_main_catuid_'
                . $team['main_category_uid'])
            ) {
                $category = $this->category->get_single($tournament['category_uid'], $team['main_category_uid'], false);

                if (empty($category)) {
                    show_404();
                }

                $this->cache->write($category, 'category_by_tournament_' . $tournament['category_uid'] . '_main_catuid_'
                    . $team['main_category_uid'], 3600);
            }

            if (!$sport = $this->cache->get('sport_' . $category['sport_uid'])) {
                $sport = $this->sport->get_single($category['sport_uid']);

                if (empty($sport)) {
                    show_404();
                }

                $this->cache->write($sport, 'sport_' . $category['sport_uid'], 3600);
            }
        }

        $teamname = dblang('team_' . $team['uid'] . '_name') ==
        'team_' . $team['uid'] . '_name' ? $team['name'] : dblang('team_' . $team['uid'] . '_name');

        $tournamentname = "";

        if ($sport) {
            if ($tournament['tntype'] == "unique_tournament") {
                $trans = dblang('unique_tournament_' . $tournament['uid'] . '_name');
                if ($trans == 'unique_tournament_' . $tournament['uid'] . '_name') {
                    $tournamentname = $tournament['name'];
                } else {
                    $tournamentname = $trans;
                }
            } else {
                $trans = dblang('tournament_' . $tournament['uid'] . '_name');
                if ($trans == 'tournament_' . $tournament['uid'] . '_name') {
                    $tournamentname = $tournament['name'];
                } else {
                    $tournamentname = $trans;
                }
            }
        }

        if ($sport && $team !== false) {

            if (dblang('category_' . $category['uid'] . '_name') != 'category_' . $category['uid'] . '_name') {
                $catname = dblang('category_' . $category['uid'] . '_name');
            } else {
                $catname = $category['name'];
            }

            if (!$navtournaments = $this->cache->get('tournaments_for_category_' . $category['uid'])) {
                $navtournaments = $this->tournament->get_by_category($category['uid']);
                $this->cache->write($navtournaments, 'tournaments_for_category_' . $category['uid'], 3600);
            }

            if (!$navteams =
                $this->cache->get('teams_for_tournament_' . $tournament['uid'] . '_type_' . $tournament['tntype'])
            ) {
                $navteams = $this->team->get_by_tournament($tournament['uid'], $tournament['tntype']);
                $this->cache->write($navteams,
                    'teams_for_tournament_' . $tournament['uid'] . '_type_' . $tournament['tntype'], 3600);
            }

            if (!$navsports = $this->cache->get('navsports')) {
                $navsports = $this->sport->get_sports(true);
                $this->cache->write($navsports, 'navsports', 3600);
            }

            if (!$navcategories = $this->cache->get('categories_bysport_' . $sport['uid'])) {
                $navcategories = $this->category->get_by_sport($sport['uid'], true);
                $this->cache->write($navcategories, 'categories_bysport_' . $sport['uid'], 3600);
            }

            $headerdata = array(
                'sports' => $navsports,
                'categories' => $navcategories,
                'current_category' => '<span><b>' . $catname . '</b><i class="fa fa-times-circle"></i></span>',
                'tournaments' => $navtournaments,
                'current_tournament' => '<span><b>' . $tournamentname . '</b><i class="fa fa-times-circle"></i></span>',
                'current_category_uid' => $category['uid'],
                'current_tournament_uid' => $tournament['uid'],
                'current_tournament_type' => $tournament['tntype'],
                'current_team_uid' => $team['uid'],
                'current_url' => site_url(array($sport['seourl'], $category['seourl'], $tournament['seourl'])),
                'teams' => $navteams,
                'current_team' => '<span><b>' . $teamname . '</b><i class="fa fa-times-circle"></i></span>',
                'team' => $team,
                'headline' => $teamname,
                'current_sport_url' => site_url($sport['seourl']),
                'current_cat_url' => site_url(array($sport['seourl'], $category['seourl'])),
                'current_trn_url' => site_url(array($sport['seourl'], $category['seourl'], $tournament['seourl']))
            );

            if (strlen($team['header_image']) > 0) {
                $headerdata['headerImage'] = ('pool/uploads/team/' . $team['header_image']);
            } elseif (strlen($sport['header_image']) > 0) {
                $headerdata['headerImage'] = ('pool/uploads/sport/' . $sport['header_image']);
            }

        } else {
            $headerdata = array(
                'sports' => $this->sport->get_sports(true),
                'team' => $team

            );
            if (strlen($team['header_image']) > 0) {
                $headerdata['headerImage'] = ('pool/uploads/team/' . $team['header_image']);
            } elseif (strlen($sport['header_image']) > 0) {
                $headerdata['headerImage'] = ('pool/uploads/sport/' . $sport['header_image']);
            }
        }

        if (!$active) {
            $headerdata['canonical'] = site_url(array('teams', $team['seourl']));
        } else {
            $headerdata['canonical'] = site_url(array('teams', $team['seourl'], $active));
        }

        if ($wasSport == false) {
            $taburls = site_url(array('teams', $team['seourl']));
        } else {
            $taburls = site_url(array($sport['seourl'], $cat, $trnmnt, $team['seourl']));
        }

        if (!$tabs = $this->cache->get('team_tabnav_array_' . $this->lang->lang() . '_' . $team['uid'])) {

            $hasPlayers = $this->team->has_players($team['uid']);

            $tmptournaments = $this->team->get_tournaments($team['uid']);
            $seasontable = array();
            $tncount = 0;
            foreach ($tmptournaments as $t) {
                if ((int)$t['unique_uid'] > 0) {
                    $temp = $this->tournament->get_seasontable_by_unique($t['unique_uid'], $team['uid']);
                    if (count($temp) > 0) {
                        $seasontable[] = $temp;
                        $tncount++;
                    }
                } else {
                    $temp = $this->tournament->get_seasontable($t['uid'], $team['uid']);
                    if (count($temp) > 0) {
                        $seasontable[] = $temp;
                        $tncount++;
                    }
                }
            }

            $tabs = array();
            $tabs[] = array('id' => 'news', 'title' => dblang('tabnav_news'), 'link' => $taburls);
            if (count($this->match->get(20, 0, 0, 0, 0, $team['uid'])) > 0) {
                $tabs[] = array('id' => 'dates', 'title' => dblang('tabnav_dates'), 'link' => $taburls . '/dates');
                $hasRoundup = true;
            } else {
                $hasRoundup = false;
            }
            if ($tncount > 0) {
                $tabs[] =
                    array('id' => 'table', 'title' => dblang('tabnav_leaguetable'), 'link' => $taburls . '/table');
                /*$tabs[] =
                    array('id' => 'cuptree', 'title' => dblang('tabnav_cuptree'), 'link' => $taburls . '/cuptree');*/
            }
            if ($hasPlayers) {
                $tabs[] =
                    array('id' => 'players', 'title' => dblang('tabnav_players'), 'link' => $taburls . '/players');
            }
            if ($hasRoundup) {
                $tabs[] = array('id' => 'roundup', 'title' => dblang('tabnav_formcheck'),
                    'link' => $taburls . '/last-matches');
            }
            $this->cache->write($tabs, 'team_tabnav_array_' . $this->lang->lang() . '_' . $team['uid'], 3600);
        }

        $curtab = $active == false ? 'news' : $active;

        $videos = cacheVideos($team['uid'], 'team');

        $headerdata['isTeam'] = true;
        $headerdata['seo'] = $seocontent;
        $headerdata['facebookGraph'] = true;
        $headerdata['videos'] = $videos;

        if (!$active) {
            if ($sport == false) {
                $data = array(
                    'pagename' => $teamname,
                    'add_to_favs' => 'team:' . $team['uid'],
                    'tabs' => $tabs,
                    'currenttab' => $curtab,
                    'news' => $this->post->get_frontend(false, 0, 40, 0, 0, array("uid" => 0), $team['uid']),
                    'tournaments' => $navtournaments,
                    'videos' => $videos
                );
            } else {
                $data = array(
                    'pagename' => $teamname,
                    'add_to_favs' => 'team:' . $team['uid'],
                    'tabs' => $tabs,
                    'currenttab' => $curtab,
                    'news' => $this->post->get_frontend(false, 0, 40, $sport['uid'], $category['uid'],
                        array("uid" => $tournament['uid'], "type" => $tournament['tntype']), $team['uid']),
                    'tournaments' => $navtournaments,
                    'videos' => $videos
                );
            }
            $data['seo'] = $seocontent;
            $data['current_team'] = $team['uid'];

            if ($this->videos_only) {
                echo json_encode($data['videos']);
            } else {
                $this->load->view('layouts/frontend_head', $headerdata);
                $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                $this->load->view('home', $data);
                $this->load->view('layouts/frontend_footer', $data);
            }

        } else {

            if ($active == 'dates') {

                $data = array(
                    'pagename' => dblang('tabnav_dates'),
                    'add_to_favs' => 'team:' . $team['uid'],
                    'tabs' => $tabs,
                    'currenttab' => $curtab,
                    'team' => $team,
                    'matches' => $this->match->get(20, 0, 0, 0, 0, $team['uid'])
                );
                $data['seo'] = $seocontent;
                $this->load->view('layouts/frontend_head', $headerdata);
                $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                $this->load->view('matches', $data);
                $this->load->view('layouts/frontend_footer', $data);

            }

            if ($active == 'players') {

                $tournaments = $this->team->get_tournaments($team['uid']);

                $data = array(
                    'pagename' => dblang('tabnav_players'),
                    'add_to_favs' => 'team:' . $team['uid'],
                    'tabs' => $tabs,
                    'currenttab' => $curtab,
                    'players' => $this->team->get_players($team['uid']),
                    'tournaments' => $tournaments
                );
                $data['seo'] = $seocontent;
                if (isset($tournament['uid'])) {
                    $data['curtournament'] = array("uid" => $tournament['uid'], "tntype" => $tournament['tntype']);
                }

                if ($this->is_kader) {
                    echo json_encode($data);
                    die();
                } else {
                    $this->load->view('layouts/frontend_head', $headerdata);
                    $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                    $this->load->view('players', $data);
                    $this->load->view('layouts/frontend_footer', $data);
                }

            }

            if ($active == 'roundup') {

                $matches = array_reverse($this->match->get_roundup($team['uid']));
                for ($i = 0; $i < count($matches); $i++) {
                    $matches[$i]->seourl = base_url("/".$this->lang->lang().'/teams/'.$matches[$i]->seourl);
                }
                $data = array(
                    'pagename' => dblang('tabnav_formcheck'),
                    'add_to_favs' => 'team:' . $team['uid'],
                    'tabs' => $tabs,
                    'currenttab' => $curtab,
                    'matches' => $matches
                );
                $data["appendJS"][] = base_url("/assets/frontend/javascripts/formcheck.js");

                if ($this->is_formcheck) {
                    echo json_encode($data);
                    die();
                } else {
                    $this->load->view('layouts/frontend_head', $headerdata);
                    $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                    $this->load->view('roundup', $data);
                    $this->load->view('layouts/frontend_footer', $data);
                }

            }

            if ($active == 'table') {

                $tmptournaments = $this->team->get_tournaments($team['uid']);
                $seasontable = array();
                $tncount = 0;
                $tournamentFilters = array();
                $arr1 = array();
                $arr2 = array();
                foreach ($tmptournaments as $t) {
                    if ((int)$t['unique_uid'] > 0) {
                        if (in_array($t['unique_uid'],$arr1)) {
                            continue;
                        } else {
                            $arr1[] = $t['unique_uid'];
                        }
                        $temp = $this->tournament->get_seasontable_by_unique($t['unique_uid'], $team['uid']);
                        if (count($temp) > 0) {
                            $seasontable[] = $temp;
                            $tournamentFilters[] = $t;
                            $tncount++;
                        }
                    } else {
                        if (in_array($t['uid'],$arr2)) {
                            continue;
                        } else {
                            $arr1[] = $t['uid'];
                        }
                        $temp = $this->tournament->get_seasontable($t['uid'], $team['uid']);
                        if (count($temp) > 0) {
                            $seasontable[] = $temp;
                            $tournamentFilters[] = $t;
                            $tncount++;
                        }
                    }
                }
                $tablecount = $tncount;

                $data = array(
                    'pagename' => dblang('tabnav_leaguetable'),
                    'add_to_favs' => 'team:' . $team['uid'],
                    'tabs' => $tabs,
                    'currenttab' => $curtab,
                    'table' => $seasontable,
                    'tablecount' => $tablecount,
                    'currentteam' => $team['uid'],
                    'tournaments' => $tournamentFilters
                );
                $data['seo'] = $seocontent;
                if ($this->is_table) {
                    echo json_encode($data);
                    die();
                } else {
                    $this->load->view('layouts/frontend_head', $headerdata);
                    $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                    $this->load->view('table', $data);
                    $this->load->view('layouts/frontend_footer', $data);
                }

            }

        }

    }

    public function toggle_localized_news() {


        if (!$this->session->userdata('only_localized_news') || $this->session->userdata('only_localized_news') === 0) {
            $this->session->set_userdata('only_localized_news', 1);
        } else {
            $this->session->set_userdata('only_localized_news', 0);
        }

        if (isset($_SERVER['HTTP_REFERER'])) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(site_url(array('home')));
        }

    }

    public function tournament($sport, $cat, $trnmnt, $active = false) {
        $this->load->model('sport_model', 'sport', true);
        $this->load->model('category_model', 'category', true);
        $this->load->model('tournament_model', 'tournament', true);
        $this->load->model('team_model', 'team', true);
        $this->load->model('match_model', 'match', true);
        $this->load->model('seo_model', 'seo', true);
        $langs = $this->config->item('language_db');
        $l = $langs[$this->lang->lang()];

        if (!$c_sport = $this->cache->get('sport_by_url_' . $this->security->sanitize_filename($sport))) {
            $c_sport = $this->sport->get_by_url($sport);
            $this->cache->write($c_sport, 'sport_by_url_' . $this->security->sanitize_filename($sport), 3600);
        }
        $sport = $c_sport;

        if (empty($sport)) {
            show_404();
        }

        if (!$category =
            $this->cache->get('category_by_url_' . $this->security->sanitize_filename($cat) . '_and_sportid_'
                . $sport['uid'])
        ) {
            $category = $this->category->get_by_url($sport['uid'], $cat);
            $this->cache->write($category,
                'category_by_url_' . $this->security->sanitize_filename($cat) . '_and_sportid_' . $sport['uid'], 3600);
        }

        if (empty($category)) {
            show_404();
        }

        if (!$tournament =
            $this->cache->get('tournament_by_url_' . $this->security->sanitize_filename($trnmnt) . '_and_catid_'
                . $category['uid'])
        ) {
            $tournament = $this->tournament->get_by_url($category['uid'], $trnmnt);

            if (empty($tournament)) {
                show_404();
            }

            $this->cache->write($tournament,
                'tournament_by_url_' . $this->security->sanitize_filename($trnmnt) . '_and_catid_' . $category['uid'],
                3600);
        }

        $seocontent = $this->seo->get_contents($tournament['tntype'], $tournament['uid'], $l);

        if ($tournament !== false) {

            if (dblang('category_' . $category['uid'] . '_name') != 'category_' . $category['uid'] . '_name') {
                $catname = dblang('category_' . $category['uid'] . '_name');
            } else {
                $catname = $category['name'];
            }

            if ($tournament['tntype'] === 'tournament') {
                $loctntype = 'tournament';
            } else {
                $loctntype = 'unique_tournament';
            }

            if (dblang($loctntype . '_' . $tournament['uid'] . '_name') !=
                $loctntype . '_' . $tournament['uid'] . '_name'
            ) {
                $tnname = dblang($loctntype . '_' . $tournament['uid'] . '_name');
            } else {
                $tnname = $tournament['name'];
            }

            if (!$navsports = $this->cache->get('navsports')) {
                $navsports = $this->sport->get_sports(true);
                $this->cache->write($navsports, 'navsports', 3600);
            }

            if (!$navcategories = $this->cache->get('categories_bysport_' . $sport['uid'])) {
                $navcategories = $this->category->get_by_sport($sport['uid'], true);
                $this->cache->write($navcategories, 'categories_bysport_' . $sport['uid'], 3600);
            }

            if (!$navtournaments = $this->cache->get('tournaments_for_category_' . $category['uid'])) {
                $navtournaments = $this->tournament->get_by_category($category['uid']);
                $this->cache->write($navtournaments, 'tournaments_for_category_' . $category['uid'], 3600);
            }

            if (!$navteams =
                $this->cache->get('teams_for_tournament_' . $tournament['uid'] . '_type_' . $tournament['tntype'])
            ) {
                $navteams = $this->team->get_by_tournament($tournament['uid'], $tournament['tntype']);
                $this->cache->write($navteams,
                    'teams_for_tournament_' . $tournament['uid'] . '_type_' . $tournament['tntype'], 3600);
            }

            $headerdata = array(
                'sports' => $navsports,
                'categories' => $navcategories,
                'current_category' => '<span><b>' . $catname . '</b><i class="fa fa-times-circle"></i></span>',
                'current_category_uid' => $category['uid'],
                'tournaments' => $navtournaments,
                'current_tournament' => '<span><b>' . $tnname . '</b><i class="fa fa-times-circle"></i></span>',
                'current_tournament_uid' => $tournament['uid'],
                'current_tournament_type' => $tournament['tntype'],
                'current_sport_url' => site_url($sport['seourl']),
                'current_url' => site_url(array($sport['seourl'], $category['seourl'], $tournament['seourl'])),
                'current_cat_url' => site_url(array($sport['seourl'], $category['seourl'])),
                'teams' => $navteams,
                'current_team' => dblang('choose_team'),
                'current_trn_url' => site_url(array($sport['seourl'], $category['seourl'], $tournament['seourl'])),
                'seo' => $seocontent
            );

            $trnname = $tnname;
            if ($tournament['tntype'] == 'tournament') {
                if (!$countTable = $this->cache->get('countTable_tournament_' . $tournament['uid'])) {
                    $countTable = count($this->tournament->get_seasontable($tournament['uid']));
                    $this->cache->write($countTable, 'countTable_tournament_' . $tournament['uid'], 3600);
                }

                if (strlen($tournament['header_image']) > 0) {
                    $headerdata['headerImage'] = ('pool/uploads/tournament/' . $tournament['header_image']);
                }
            } else {
                if (!$countTable = $this->cache->get('countTable_uniquetournament_' . $tournament['uid'])) {
                    $countTable = count($this->tournament->get_seasontable_by_unique($tournament['uid']));
                    $this->cache->write($countTable, 'countTable_uniquetournament_' . $tournament['uid'], 3600);
                }


                if (strlen($tournament['header_image']) > 0) {
                    $headerdata['headerImage'] =
                        ('pool/uploads/unique_tournament/' . $tournament['header_image']);
                }
            }

            if (!isset($headerdata['headerImage'])) {
                if (strlen($category['header_image']) > 0) {
                    $headerdata['headerImage'] = ('pool/uploads/category/' . $category['header_image']);
                } elseif (strlen($sport['header_image']) > 0) {
                    $headerdata['headerImage'] = ('pool/uploads/sport/' . $sport['header_image']);
                }
            }

            $headerdata['headline'] = $trnname;

            if (!$tabs = $this->cache->get('tournament_tabnav_array_' . $this->lang->lang() . '_' . $sport['seourl'] . '_' . $cat . '_' . $trnmnt)
            ) {
                $tabs = array();
                $tabs[] = array('id' => 'news', 'title' => dblang('tabnav_news'),
                    'link' => site_url(array($sport['seourl'], $cat, $trnmnt)));
                if (count($this->match->get(1, 0, $sport['uid'], $category['uid'], $tournament)) > 0) {
                    $tabs[] = array('id' => 'dates', 'title' => dblang('tabnav_dates'),
                        'link' => site_url(array($sport['seourl'], $cat, $trnmnt, 'dates')));
                }
                if ($countTable > 0) {
                    $tabs[] = array('id' => 'table', 'title' => dblang('tabnav_leaguetable'),
                        'link' => site_url(array($sport['seourl'], $cat, $trnmnt, 'table')));
                    /*$tabs[] =
                        array('id' => 'cuptree', 'title' => dblang('tabnav_cuptree'), 'link' => $taburls . '/cuptree');*/
                }
                $this->cache->write($tabs, 'tournament_tabnav_array_' . $this->lang->lang() . '_' . $sport['seourl'] . '_' . $cat . '_' . $trnmnt,
                    3600);
            }

            $curtab = $active == false ? 'news' : $active;

            $cattrans = dblang('category_' . $category['uid'] . '_name');
            if ($cattrans == 'category_' . $category['uid'] . '_name') {
                $catname = $category['name'];
            } else {
                $catname = $cattrans;
            }

            $tournamentname = $trnname;

            if (!$active) {
                $videos = cacheVideos($tournament['uid'], $tournament['tntype']);
                $headerdata['facebookGraph'] = true;
                $headerdata['videos'] = $videos;

                $data = array(
                    'pagename' => $catname . " <br class='mobile' />" . $tournamentname,
                    'add_to_favs' => str_replace('_', '', $tournament['tntype']) . ':' . $tournament['uid'],
                    'tabs' => $tabs,
                    'currenttab' => $curtab,
                    'news' => $this->post->get_frontend(false, 0, 40, $sport['uid'], $category['uid'],
                        array("uid" => $tournament['uid'], "type" => $tournament['tntype'])),
                    'videos' => $videos,
                    'seo' => $seocontent
                );

                if ($this->videos_only) {
                    echo json_encode($data['videos']);
                } else {
                    $this->load->view('layouts/frontend_head', $headerdata);
                    $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                    $this->load->view('home', $data);
                    $this->load->view('layouts/frontend_footer', $data);
                }

            } else {
                if ($active == 'dates') {

                    $data = array(
                        'pagename' => dblang('tabnav_dates'),
                        'add_to_favs' => str_replace('_', '', $tournament['tntype']) . ':' . $tournament['uid'],
                        'tabs' => $tabs,
                        'currenttab' => $curtab,
                        'matches' => $this->match->get(20, 0, $sport['uid'], $category['uid'], $tournament)
                    );

                    $this->load->view('layouts/frontend_head', $headerdata);
                    $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                    $this->load->view('matches', $data);
                    $this->load->view('layouts/frontend_footer', $data);

                }
                if ($active == 'table') {
                    if ($tournament['tntype'] == 'unique_tournament') {
                        $seasontable[] = $this->tournament->get_seasontable_by_unique($tournament['uid']);
                    } else {
                        $seasontable[] = $this->tournament->get_seasontable($tournament['uid']);
                    }

                    $data = array(
                        'pagename' => dblang('tabnav_leaguetable'),
                        'add_to_favs' => str_replace('_', '', $tournament['tntype']) . ':' . $tournament['uid'],
                        'tabs' => $tabs,
                        'currenttab' => $curtab,
                        'table' => $seasontable
                    );

                    if ($this->is_table) {
                        echo json_encode($data);
                        die();
                    } else {
                        $this->load->view('layouts/frontend_head', $headerdata);
                        $data['favs'] = $this->load->view('layouts/favorites', array(), true);
                        $this->load->view('table', $data);
                        $this->load->view('layouts/frontend_footer', $data);
                    }

                }
            }
        } else {
            show_404();
        }
    }

    protected function dynamic_reload($segs, $offset = 0, $getFavs = false) {

        $this->load->model('sport_model', 'sport', true);
        $this->load->model('category_model', 'category', true);
        $this->load->model('tournament_model', 'tournament', true);
        $this->load->model('match_model', 'match', true);
        $this->load->model('team_model', 'team', true);

        $items = array();
        $action = 'news';
        $offset = (int)$offset;
        if ($offset < 0) {
            $offset = 0;
        }

        if ($segs[count($segs)] == 'dates') {
            unset($segs[count($segs)]);
            $action = 'dates';
        } else {

        }

        switch (count($segs)) {
            case 2:
                if ($segs[2] == 'home') {
                    switch ($action) {
                        case 'news' :
                            $items = $this->post->get_frontend($this->translated_only, $offset, 40);
                            break;
                        case 'dates' :
                            $items = $this->match->get(20, $offset);
                            break;
                    }
                } elseif ($segs[2] == 'favourites') {

                    $this->load->helper('cookie');
                    $favs = array();

                    if ($getFavs) {
                        $cookie = explode(";", substr($getFavs, 0, strlen($getFavs) - 1));
                    } else {
                        $cookie = explode(";", get_cookie('favorites'));
                    }
                    foreach ($cookie as $c) {
                        if (strpos($c, ":") !== false) {
                            list($key, $val) = explode(":", $c);
                            $favs[$key][] = $val;
                        }
                    }
                    $items = $this->post->get_favourites($this->translated_only, $offset, 40, $favs);
                } else {
                    $sport = $this->sport->get_by_url($segs[2]);
                    if (!isset($sport['uid'])) {
                        die();
                    }
                    switch ($action) {
                        case 'news':
                            $items = $this->post->get_frontend($this->translated_only, $offset, 40, $sport['uid']);
                            $cats = $this->sport->get_categories($sport['uid']);
                            for ($i = 0; $i < count($cats); ++$i) {
                                $dblang = dblang('category_' . $cats[$i]['uid'] . '_name', false, false);
                                if (strlen($dblang) > 0) {
                                    $cats[$i]['name'] = $dblang;
                                }
                            }

                            $navigation = array(
                                'sport' => $sport,
                                'categories' => $cats
                            );

                            break;
                        case 'dates':
                            $items = $this->match->get(20, $offset, $sport['uid']);
                            break;
                    }

                }
                break;
            case 3:

                if ($segs[2] == 'teams') {

                    $arr = explode("-", $segs[3]);
                    $team = $this->team->get_by_betradar_uid($arr[count($arr) - 1]);
                    if (!isset($team['uid'])) {
                        die();
                    }

                    $tournament = $this->tournament->get_by_team($team['uid'], $team['main_tournament_uid'],
                        $team['main_unique_tournament_uid']);
                    $category = $this->category->get_single($tournament['category_uid'], $team['main_category_uid']);
                    $sport = $this->sport->get_single($category['sport_uid']);

                    if(!isset($sport['uid'])) {
                      die();
                    }

                    if ((int)$sport['uid'] === 8) {
                        $cat = $this->category->get_single_tennis($team['uid']);
                        $teampath = array($sport['seourl'], $cat->seourl, "none", $team['seourl']);
                        $tennisplayer = $team['name'];
                        $tennisplayeruid = $team['uid'];
                    } else {
                        $teampath = array($sport['seourl'], $category['seourl'], $tournament['seourl'], $team['seourl']);
                    }

                    $navigation = array(
                      'has_kader' => $this->team->has_players($team['uid']),
                      'categories' => $this->sport->get_categories($sport['uid']),
                      'tournaments' => $this->tournament->get_by_category($category['uid']),
                      'teams' => $this->team->get_by_tournament($tournament['uid'], $tournament['tntype']),
                      'sport' => $sport
                    );

                    switch ($action) {
                        case 'news':
                            $items = $this->post->get_frontend($this->translated_only, $offset, 40, $sport['uid'],
                                $category['uid'],
                                array("uid" => $tournament['uid'], "type" => $tournament['tntype']), $team['uid']);
                            break;
                        case 'dates':
                            $items = $this->match->get(20, $offset, 0, 0, 0, $team['uid']);
                            break;
                    }

                } else {

                    $sport = $this->sport->get_by_url($segs[2]);
                    if (isset($sport['uid'])) {
                        $category = $this->category->get_by_url($sport['uid'], $segs[3]);
                    } else {
                        die();
                    }

                    $tournaments = $this->tournament->get_by_category($category['uid']);
                    $categories = $this->sport->get_categories($sport['uid']);

                    $navigation = array(
                        'categories' => $categories,
                        'tournaments' => $tournaments,
                        'sport' => $sport
                    );

                    switch ($action) {
                        case 'news':
                            $items = $this->post->get_frontend($this->translated_only, $offset, 40, $sport['uid'],
                                $category['uid']);
                            break;
                        case 'dates':
                            $items = $this->match->get(20, $offset, $sport['uid'], $category['uid']);
                            break;
                    }
                }
                break;
            case 4:
                $sport = $this->sport->get_by_url($segs[2]);
                if (!isset($sport['uid'])) {
                    die();
                }
                $category = $this->category->get_by_url($sport['uid'], $segs[3]);
                if (!isset($category['uid'])) {
                    die();
                }
                $tournament = $this->tournament->get_by_url($category['uid'], $segs[4]);
                if (!isset($tournament['uid'])) {
                    die();
                }

                $seasontables = false;

                if ($tournament['tntype'] === 'unique_tournament') {
                    $temp = $this->tournament->get_seasontable_by_unique($tournament['uid']);
                    if (count($temp) > 0) {
                        $seasontables = true;
                    }
                } else {
                    $temp = $this->tournament->get_seasontable($tournament['uid']);
                    if (count($temp) > 0) {
                        $seasontables = true;
                    }
                }

                $navteams = $this->team->get_by_tournament($tournament['uid'], $tournament['tntype']);
                $categories = $this->sport->get_categories($sport['uid']);
                $tournaments = $this->tournament->get_by_category($category['uid']);

                $navigation = array(
                  'categories' => $categories,
                  'tournaments' => $tournaments,
                  'teams' => $navteams,
                  'table' => $seasontables,
                  'sport' => $sport
                );

                switch ($action) {
                    case 'news':
                        $items = $this->post->get_frontend($this->translated_only, $offset, 40, 0, 0,
                            array("uid" => $tournament['uid'], "type" => $tournament['tntype']));
                        break;
                    case 'dates':
                        $items = $this->match->get(20, $offset, $sport['uid'], $category['uid'], $tournament);
                        break;
                }
                break;

            case 5:
                $sport = $this->sport->get_by_url($segs[2]);
                if (!isset($sport['uid'])) {
                    die();
                }
                $category = $this->category->get_by_url($sport['uid'], $segs[3]);
                if (!isset($category['uid'])) {
                    die();
                }
                $tournament = $this->tournament->get_by_url($category['uid'], $segs[4]);
                if (!isset($tournament['uid'])) {
                    die();
                }
                $arr = explode("-", $segs[5]);
                $team = $this->team->get_by_betradar_uid($arr[count($arr) - 1]);
                if (!isset($team['uid'])) {
                    die();
                }

                $seasontables = false;

                if ($tournament['tntype'] === 'unique_tournament') {
                    $temp = $this->tournament->get_seasontable_by_unique($tournament['uid']);
                    if (count($temp) > 0) {
                        $seasontables = true;
                    }
                } else {
                    $temp = $this->tournament->get_seasontable($tournament['uid']);
                    if (count($temp) > 0) {
                        $seasontables = true;
                    }
                }

                $navteams = $this->team->get_by_tournament($tournament['uid'], $tournament['tntype']);
                $categories = $this->sport->get_categories($sport['uid']);
                $tournaments = $this->tournament->get_by_category($category['uid']);

                $navigation = array(
                  'categories' => $categories,
                  'tournaments' => $tournaments,
                  'teams' => $navteams,
                  'table' => $seasontables,
                  'sport' => $sport,
                  'has_kader' => $this->team->has_players($team['uid'])
                );

                switch ($action) {
                    case 'news':
                        $items = $this->post->get_frontend($this->translated_only, $offset, 40, $sport['uid'],
                            $category['uid'],
                            array("uid" => $tournament['uid'], "type" => $tournament['tntype']), $team['uid']);
                        break;
                    case 'dates':
                        $items =
                            $this->match->get(20, $offset, 0, 0, 0, $team['uid']);
                        break;
                }
        }

        if ($action == 'news') {
            for ($i = 0; $i < count($items); ++$i) {

                $items[$i]['fulltext'] = strip_tags($items[$i]['teaser']);
                $items[$i]['teaser'] = string_trim(strip_tags($items[$i]['teaser']), 250);

                $items[$i]['preheadline'] = "";

                if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {
                    $items[$i]['preheadline'] .= "<strong><a href=\"/backend/post/edit/" . $items[$i]['uid']
                        . "\" target='_blank' class='admin-edit'>[post id: " . $items[$i]['uid'] . "]</a></strong> ";
                }

                $items[$i]['preheadline'] .= date('d.m.Y - H:i', $items[$i]['posted_on']) . ' Uhr';

                if (strlen($items[$i]['tweet_uid']) > 0) {
                  $items[$i]['preheadline'] .= ' <img src=\'' . base_url('assets/frontend/images/icon-twitter.png') . '\' />';
                } else {
                  if (strlen($items[$i]['feedicon']) > 0) {
                      $items[$i]['preheadline'] .= ' <img src=\'' . base_url('pool/uploads/feed/' . $items[$i]['feedicon']) . '\' />';
                  }
                }

                $items[$i]['preheadline'] .= $items[$i]['feedname'];



                if (strlen($items[$i]['tweet_uid']) > 0) {
                  $items[$i]['headline'] = "<a href='" . $items[$i]['url'] . "' target='_blank'>" . strip_tags($items[$i]['title']) . "</a>";
                } else {
                  $items[$i]['headline'] = "<a href='" . site_url('news/'.$items[$i]['seourl']) . "'>" . strip_tags($items[$i]['title']) . "</a>";
                }


                if ($this->ion_auth->logged_in() && $this->ion_auth->in_group(array(1, 2))) {
                    $items[$i]['admininfo'] = "";
                    $items[$i]['admininfo'] .= "Sport: <strong class='infosport'>" . $items[$i]['sportname']
                        . "</strong><br/>";
                    $items[$i]['admininfo'] .= "Kategorie: <strong class='infocat'>" . $items[$i]['catname']
                        . "</strong><br/>";
                    $items[$i]['admininfo'] .= "Turnier: <strong class='infotrnmnt'>" . $items[$i]['trnmntname']
                        . "</strong><br/>";
                    $items[$i]['admininfo'] .= "Turniergruppe: <strong class='infountn'>" . $items[$i]['untnname']
                        . "</strong><br/>";
                    $items[$i]['admininfo'] .= "Team: <strong class='infoteam1'>" . $items[$i]['team1_name']
                        . "</strong><br/>";
                } else {
                    $items[$i]['admininfo'] = "";
                }

            }
        }
        if ($action == 'dates') {
            for ($i = 0; $i < count($items); ++$i) {
                $items[$i]['_date'] = date('d.m', $items[$i]['date']);
                $items[$i]['_time'] = date('H:i', $items[$i]['date']);

                if (isset($items[$i]['uniquetournamentname']) && strlen($items[$i]['uniquetournamentname']) > 0) {
                    $items[$i]['tournamentname'] = "<strong class='mobile'>" . dblang('dates_tournament') . "</strong>"
                        . $items[$i]['uniquetournamentname'];
                } else {
                    $items[$i]['tournamentname'] = "<strong class='mobile'>" . dblang('dates_tournament') . "</strong>"
                        . $items[$i]['tournamentname'];
                }
                if (strlen($items[$i]['betradar_score1']) > 0 && $items[$i]['betradar_score1'] > -1) {
                    $items[$i]['result'] = $items[$i]['betradar_score1'];
                } else {
                    if ($items[$i]['date'] < time()) {
                        $items[$i]['result'] = "0";
                    } else {
                        $items[$i]['result'] = "-";
                    }
                }
                $items[$i]['result'] .= ' : ';

                if (strlen($items[$i]['betradar_score2']) > 0 && $items[$i]['betradar_score2'] > -1) {
                    $items[$i]['result'] .= $items[$i]['betradar_score2'];
                } else {
                    if ($items[$i]['date'] < time()) {
                        $items[$i]['result'] .= '0';
                    } else {
                        $items[$i]['result'] .= "-";
                    }
                }
                $items[$i]['result'] =
                    "<strong class='mobile'>" . dblang('dates_result') . "</strong>" . $items[$i]['result'];
            }
        }

        $res = array(
            'status' => 'ok',
            'type' => $action,
            'segs' => $segs,
            'items' => $items
        );

        if (isset($teampath)) {
            $res['teampath'] = $teampath;
        }

        if (isset($tennisplayer)) {
            $res['tennisplayer'] = $tennisplayer;
            $res['tennisplayeruid'] = $tennisplayeruid;
        }

        if (isset($navigation)) {
            $res['navigation'] = $navigation;
        }

        echo json_encode($res);
    }
}
