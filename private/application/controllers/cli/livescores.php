<?php

if (!defined('BASEPATH')) {
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
 * @property match_live_model $match
 * @property video_model $video
 * @property MY_Lang $lang
 * @property Cache $cache
 */
class Livescores extends CI_Controller {

    public $is_formcheck = false;
    public $is_kader = false;
    public $is_table = false;
    public $sportU = '';
    public $translated_only = false;
    public $videos_only = false;
    private $is_live = false;
    private $liveURL = '//cs.betradar.com/ls/widgets/?/betitbest/en/page/widgets_lmts#matchId=';
    private $myLang = "en";
    private $segs = array();
    private $template = false;
    
    function __construct() {
        parent::__construct();
        $this->load->model('post_model', 'post', true);
        $this->load->model('navigation_model', 'nav', true);
        $this->load->helper('cache');
        $this->load->model('match_live_model', 'match', true);
    }

    public function _remap() {
        $segs = $this->uri->segment_array();
        array_shift($segs);
        array_unshift($segs, '');
        unset($segs[0]);
        
        $this->config->set_item('index_page', 'livescores/' . $this->config->item('index_page'));
        if (count($segs) <= 1) {
            header('Location: ' . base_url('/livescores/de/home'), true, 301);
            exit;
        }

        if (count($segs) > 2 && $segs[2] == 'live_watch') {
            $this->live_watch($segs[3]);
            exit;
        }
        
        if (count($segs) > 2 && $segs[2] == 'statistic') {
            $this->statisticbox($segs);
            exit;
        }

        $this->segs = $segs;

        if (count($segs) > 1 && $segs[2] == 'favourites') {
            //This is for live page
            if (isset($segs[count($segs)]) && $segs[count($segs)] == "live") {
                $this->is_live = true;
                $this->match->setIsLive(true);
                unset($segs[count($segs)]);
            }

            if (isset($segs[3]) && isset($segs[4]) && $segs[3] == "ajax") {
                $this->ajax($segs[4]);
                return;
            }

            $this->favourites();
            return;
        }

        if (isset($segs[count($segs)]) && $segs[count($segs)] == "live") {
            $this->is_live = true;
            $this->match->setIsLive(true);
            unset($segs[count($segs)]);
        }

        $this->sportU = $segs[2];
        if (!$this->match->extractWhereInformation($segs)) {
            header('Location: ' . base_url('/livescores/en/home'), true, 301);
            exit;
        }
        $this->myLang = $segs[1];
        $this->template = $this->match->getTemplate();

        //this is for ajax
        if ($this->input->get_post("ajax") == "yes") {
            $this->match->setAjax(true);
            if ($this->input->get_post("live") === "true" || $this->input->get_post("live") === true) {
                $this->match->setIsLive(true);
            }
            if ($this->input->get_post("loadstyle") !== false) {
                $this->match->setStyle(false);
            }

            if ($this->input->get_post('autoload') == "yes") {
                echo json_encode($this->match->get(1000, 0));
            } else {
                $offset = intval($this->input->get_post("offset"));
                echo json_encode($this->match->get(10, $offset));
            }
            exit;
        }

        if ($segs[2] === 'search') {
            $this->load->model('search_model', 'search', true);
            echo json_encode($this->search->find(urldecode($segs[3])));
            return;
        }

        if ($segs[2] === 'tennis-tournaments') {
            $this->load->model('livescores/m_tournament', 'tournament', true);
            echo json_encode($this->tournament->get_tennis_tournaments($segs));
            return;
        }

        $section = false;
        $this->load->helper('cookie');
        $this->session->set_flashdata('refer', current_url());

        $getFavs = $this->input->get("favourites");
        if ($this->input->get("only_localized") && (int) $this->input->get("only_localized") === 1) {
            $this->translated_only = true;
        } else if ($this->input->get("only_localized") && (int) $this->input->get("only_localized") === 2) {
            $this->translated_only = false;
        }

        if (count($segs) > 1 && $segs[2] === 'get_favs') {
            $this->get_favs($segs[3]);
        } elseif (count($segs) > 2 && $segs[count($segs) - 1] == 'reload') {

            $offset = $segs[count($segs)];
            unset($segs[count($segs)]);
            unset($segs[count($segs)]);
            $this->dynamic_reload($segs, $offset, $getFavs);
        } else {
            switch (count($segs)) {
                case 0:
                case 1:
                default:
                    $this->index();
                    break;
                case 2:
                    if ($segs[2] == 'home') {
                        $cookie = explode(";", get_cookie('favorites'));
                        if (count($cookie) > 0 && $cookie[0] != "") {
                            redirect(base_url(array($this->lang->lang(),'favourites')));
                        } else {
                            $this->landingpage();
                        }
                    } elseif ($segs[2] == 'favourites') {
                        redirect(base_url(array($this->lang->lang(),'favourites')));
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

    public function ajax($favstr) {
        $this->load->model('match_live_model', 'match', true);
        $this->load->model('livescores/m_category', 'category', true);
        $this->load->model('livescores/m_tournament', 'tournament', true);
        $this->load->model('livescores/m_team', 'team', true);

        $dataReturn = array();
        $favs = explode("_", $favstr);
        $listSports = array();

        if (count($favs) > 0) {
            foreach ($favs as $fav) {
                $val = explode("-", $fav);
                $data[$val[0]][] = $val[1];
            }

            if (isset($data['cat']) && count($data['cat']) > 0) {
                for ($i = 0; $i < count($data['cat']); ++$i) {
                    $cat = $this->category->get_single($data['cat'][$i]);
                    if (!isset($listSports[$cat['sport_uid']])) {
                        $listSports[$cat['sport_uid']] = array('categories' => array(), 'tournaments' => array(), 'teams' => array());
                    }
                    $listSports[$cat['sport_uid']]['categories'][] = $cat['uid'];
                }
            }
            if (isset($data['uniquetournament']) && count($data['uniquetournament']) > 0) {
                for ($i = 0; $i < count($data['uniquetournament']); ++$i) {
                    $tn = $this->tournament->get_single($data['uniquetournament'][$i], 'unique');
                    if (!isset($listSports[$tn->sport_uid])) {
                        $listSports[$tn->sport_uid] = array('categories' => array(), 'tournaments' => array(), 'teams' => array());
                    }
                    $listSports[$tn->sport_uid]['tournaments'][] = $tn->uid;
                }
            }
            if (isset($data['tournament']) && count($data['tournament']) > 0) {
                for ($i = 0; $i < count($data['tournament']); ++$i) {
                    $tn = $this->tournament->get_single($data['tournament'][$i]);
                    if (!isset($listSports[$tn->sport_uid])) {
                        $listSports[$tn->sport_uid] = array('categories' => array(), 'tournaments' => array(), 'teams' => array());
                    }
                    $listSports[$tn->sport_uid]['tournaments'][] = $tn->uid;
                }
            }
            if (isset($data['team']) && count($data['team']) > 0) {
                for ($i = 0; $i < count($data['team']); ++$i) {
                    $tn = $this->team->get_by_id_for_favs($data['team'][$i]);
                    if (!isset($listSports[$tn->sport_uid])) {
                        $listSports[$tn->sport_uid] = array('categories' => array(), 'tournaments' => array(), 'teams' => array());
                    }
                    $listSports[$tn->sport_uid]['teams'][] = $tn->uid;
                }
            }


            if (count($listSports) > 0) {
                $this->match->setFavorite();
                foreach ($listSports as $key => $value) {
                    $index = $this->match->setSportData(intval($key));
                    $this->match->buildWhereFromOutSide($value['categories'], $value['tournaments'], $value['teams']);
                    $dataReturn[$index] = $this->match->get(10000);
                }
            }
        }
        echo json_encode($dataReturn);
        exit;
    }

    public function category($sport, $cat, $active = false) {
        $this->load->model('livescores/m_sport', 'sport', true);
        $this->load->model('livescores/m_category', 'category', true);
        $this->load->model('livescores/m_tournament', 'tournament', true);
        $this->match->setIsLive($this->is_live);

        $langs = $this->config->item('language_db');
        $l = $langs[$this->lang->lang()];

        if (!$cached_sport = $this->cache->get('sport_by_url_' . $this->security->sanitize_filename($sport))) {
            $cached_sport = $this->sport->get_by_url($sport);
            $this->cache->write($cached_sport, 'sport_by_url_' . $this->security->sanitize_filename($sport), 3600);
        }
        $sport = $cached_sport;

        if (count($sport) == 0) {
            die();
        }

        if (!$category = $this->cache->get('category_by_url_' . $this->security->sanitize_filename($cat) . '_and_sportid_'
                . $sport['uid'])
        ) {
            $category = $this->category->get_by_url($sport['uid'], $cat);
            $this->cache->write($category, 'category_by_url_' . $this->security->sanitize_filename($cat) . '_and_sportid_' . $sport['uid'], 3600);
        }

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
                'categories' => $this->match->filterTopCats($navcategories, $category['uid']),
                'current_category' => '<span><b>' . $catname . '</b><i class="fa fa-times-circle"></i></span>',
                'tournaments' => $this->match->filterTopTours($navtournaments, $category['uid']),
                'current_tournament' => dblang("choose_tournament"),
                'current_sport_url' => site_url($sport['seourl']),
                'current_url' => base_url(array($this->lang->lang(),$sport['seourl'], $category['seourl'])),
                'current_category_uid' => $category['uid'],
                'current_cat_url' => base_url(array($this->lang->lang(),$sport['seourl'], $category['seourl'])),
                'headline' => $catname,
                'livescores' => true,
                'facebookGraph' => true
            );

            if (strlen($category['header_image']) > 0) {
                $headerdata['headerImage'] = base_url('pool/uploads/category/' . $category['header_image']);
            } elseif (strlen($sport['header_image']) > 0) {
                $headerdata['headerImage'] = base_url('pool/uploads/sport/' . $sport['header_image']);
            }


            $data = array(
                'pagename' => 'Livescores',
                'add_to_favs' => 'category:' . $category['uid'],
                'matches' => $this->match->get(100, 0, $sport['uid'], $category['uid']),
                'livescores' => true,
                'accept_time' => $this->match->getAcceptTime()
            );
            $this->generateHTMLTabs($data, $headerdata);

            $this->load->view('layouts/frontend_head', $headerdata);
            $data['favs'] = $this->load->view('layouts/favorites', array(), true);

            $data['appendJS'] = base_url('assets/frontend/javascripts/' . $this->template . '.js');
            $this->load->view($this->template, $data);
            $this->load->view('layouts/frontend_footer', $data);
        } else {
            redirect(site_url('home'));
        }
    }

    public function favourites() {
        $this->load->model('livescores/m_sport', 'sport', true);
        $data = array();
        $headerdata = array(
            'sports' => $this->sport->get_sports(true),
            'current_category' => dblang("choose_category"),
            'current_sport_url' => base_url(array($this->lang->lang(),'favorites')),
            'current_cat_url' => base_url(array($this->lang->lang(),'favorites')),
            'isSport' => true,
            'livescores' => true,
            'ishome' => true,
            'headerImage' => 'assets/frontend/images/header_favoriten.jpg',
            'headline' => dblang('favourites'),
            'livescores' => true
        );
        $data['favs'] = $this->load->view('layouts/favorites', array(), true);
        $data['livescores'] = true;
        $data['appendJS'] = base_url('assets/frontend/javascripts/livescores-favourites.js');
        $this->generateHTMLTabs($data, $headerdata);
        
        $this->load->view('layouts/frontend_head', $headerdata);
        if ($this->is_live) {
            $data['hasLive'] = "true";
        } else {
            $data['hasLive'] = "false";
        }
        $this->load->view('fav_view', $data);
        $this->load->view('layouts/frontend_footer', $data);
    }

    public function get_favs($favstring) {

        $this->load->model('livescores/m_category', 'category', true);
        $this->load->model('livescores/m_tournament', 'tournament', true);
        $this->load->model('livescores/m_team', 'team', true);

        $favs = explode("_", $favstring);
        $sports = array();

        if (count($favs) > 0) {
            foreach ($favs as $fav) {
                $val = explode("-", $fav);
                $data[$val[0]][] = $val[1];
            }

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
        $this->load->model('livescores/m_sport', 'sport', true);
        $this->match->setIsLive($this->is_live);
        $headerdata = array(
            'sports' => $this->sport->get_sports(true),
            'current_category' => dblang("choose_category"),
            'ishome' => true,
            'headline' => 'Highlights'
        );
        $tabs = array(
            array('id' => 'news', 'title' => dblang('tabnav_news'), 'link' => base_url(array($this->lang->lang(),'home'))),
            array('id' => 'dates', 'title' => dblang('tabnav_dates'), 'link' => base_url(array($this->lang->lang(),'home', 'dates')))
        );

        $curtab = $active == false ? 'news' : $active;

        $data = array(
            'pagename' => 'Livescores',
            'tabs' => $tabs,
            'currenttab' => $curtab,
            'matches' => $this->match->get(),
            'accept_time' => $this->match->getAcceptTime()
        );

        $this->load->view('layouts/frontend_head', $headerdata);
        $data['favs'] = $this->load->view('layouts/favorites', array(), true);
        $data['appendJS'] = base_url('assets/frontend/javascripts/' . $this->template . '.js');
        $this->load->view($this->template, $data);
        $this->load->view('layouts/frontend_footer', $data);
    }

    public function landingpage() {
        $this->load->model('livescores/m_sport', 'sport', true);

        $headerdata = array(
            'sports' => $this->sport->get_sports(true),
            'ishome' => true,
            'landingpage' => true,
            'livescores' => true
        );

        $this->load->view('layouts/frontend_head', $headerdata);
        $data['favs'] = $this->load->view('layouts/favorites', array(), true);
        $data['landingpage'] = true;

        $sports = $this->sport->get_sports(true);

        for ($i = 0; $i < count($sports); ++$i) {
            if (dblang('sport_' . $sports[$i]['uid'] . '_name') != 'sport_' . $sports[$i]['uid'] . '_name') {
                $sports[$i]['name'] = dblang('sport_' . $sports[$i]['uid'] . '_name');
            }
        }

        $data['teaser'] = $sports;

        $this->load->view('landingpages/livescores/index-' . $this->lang->lang(), $data);
        $this->load->view('layouts/frontend_footer', $data);
    }

    public function live_watch($matchID) {
        $fullURL = $this->liveURL . $matchID;
        echo '<!DOCTYPE html>
        <html>
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<meta name="apple-itunes-app" content="app-id=916854354">
		<meta name="google-play-app" content="app-id=de.betitbest.livescores">
		<link rel="apple-touch-icon" href="https://www.betitbest.com/pool/uploads/apps-logos/livescores-apple-touch-icon-precomposed.png">
        <title>betitbest</title>
		<link href="'.base_url('assets/frontend/stylesheets/screen.css').'" rel="stylesheet">
		<link href="'.base_url('assets/frontend/stylesheets/print.css').'" rel="stylesheet">
		<link href="'.base_url('assets/frontend/stylesheets/style.css').'" rel="stylesheet">
        <style>
        iframe {
            width: 100%;
            min-height: 100%;
        }
        </style>
        </head>
        <body style="margin:0px !important;">
			<iframe id="iframe" style="position: absolute; border: none;" src="' . $fullURL . '">
				<p>Your browser does not support iframes.</p>
			</iframe>
        </body>
        ';
		echo "
		<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
		<script src=\"".base_url('assets/frontend/javascripts/plugins.js')."\"></script>
		<script type=\"text/javascript\">
			$(document).ready(function(){
				var force = false;
				if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
					force = 'ios';
				} else if (location.href.match(/#android$/) || navigator.userAgent.match(/Android/i) != null) {
					force = 'android';
				}
				$.smartbanner({
					daysHidden: 0,
					daysReminder: 7,
					iconGloss: false,
					speedIn: 1,
					appStoreLanguage: '".$this->lang->lang()."',
					title: 'Livescores by Bet IT Best',
					author: 'Bet IT Best',
					price: '".dblang('app_price')."',
					inAppStore: '".dblang('app_banner_text_itunes')."',
					inGooglePlay: '".dblang('app_banner_text_playstore')."',
					button: '".dblang('app_link_open')."',
					force: force
				});
				$('#smartbanner').css({
					display: 'block',
					position: 'fixed'
				});
				if(force == 'ios'){
					setTimeout(function(){
						$('#iframe').css('margin-top', '80px');
					}, 800)
				}
			});
		</script>
		</html>
		";
        exit();
    }

    public function sports($sport, $active = false) {
        $this->load->model('livescores/m_sport', 'sport', true);
        $this->load->model('livescores/m_category', 'category', true);
        $this->match->setIsLive($this->is_live);

        $langs = $this->config->item('language_db');
        $l = $langs[$this->lang->lang()];

        if (!$cached_sport = $this->cache->get('sport_by_url_' . $this->security->sanitize_filename($sport))) {
            $cached_sport = $this->sport->get_by_url($sport);
            $this->cache->write($cached_sport, 'sport_by_url_' . $this->security->sanitize_filename($sport), 3600);
        }
        $sport = $cached_sport;

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
            'categories' => $this->match->filterTopCats($navcategories),
            'current_category' => dblang("choose_category"),
            'current_sport_url' => base_url(array($this->lang->lang(),$sport['seourl'])),
            'current_cat_url' => base_url(array($this->lang->lang(),$sport['seourl'])),
            'current_url' => base_url(array($this->lang->lang(),$sport['seourl'])),
            'isSport' => true,
            'headline' => $sportname,
            'livescores' => true,
            'facebookGraph' => true
        );

        if (strlen($sport['header_image']) > 0) {
            $headerdata['headerImage'] = base_url('pool/uploads/sport/' . $sport['header_image']);
        }

        if (!(isset($sport['uid']) && intval($sport['uid']) > 0)) {
            redirect(site_url('home'));
            exit;
        }

        $data = array(
            'pagename' => 'Livescores',
            'add_to_favs' => 'sport:' . $sport['uid'],
            'matches' => $this->match->get(100, 0, $sport['uid']),
            'livescores' => true,
            'accept_time' => $this->match->getAcceptTime()
        );
        $this->generateHTMLTabs($data, $headerdata);

        $this->load->view('layouts/frontend_head', $headerdata);
        $data['favs'] = $this->load->view('layouts/favorites', array(), true);
        $data['appendJS'] = base_url('assets/frontend/javascripts/' . $this->template . '.js');
        $this->load->view($this->template, $data);
        $this->load->view('layouts/frontend_footer', $data);
    }

    public function team($sport = false, $cat = false, $trnmnt = false, $team, $active = false) {

        $wasSport = $sport;

        $this->load->model('livescores/m_sport', 'sport', true);
        $this->load->model('livescores/m_category', 'category', true);
        $this->load->model('livescores/m_tournament', 'tournament', true);
        $this->load->model('livescores/m_team', 'team', true);
        $this->match->setIsLive($this->is_live);

        $tArray = explode("-", $team);
        $team = $this->team->get_by_betradar_uid($tArray[count($tArray) - 1]);

        $langs = $this->config->item('language_db');
        $l = $langs[$this->lang->lang()];

        if ($sport) {

            if (!$cached_sport = $this->cache->get('sport_by_url_' . $this->security->sanitize_filename($sport))) {
                $cached_sport = $this->sport->get_by_url($sport);
                $this->cache->write($cached_sport, 'sport_by_url_' . $this->security->sanitize_filename($sport), 3600);
            }
            $sport = $cached_sport;

            if (!$category = $this->cache->get('category_by_url_' . $this->security->sanitize_filename($cat) . '_and_sportid_'
                    . $sport['uid'])
            ) {
                $category = $this->category->get_by_url($sport['uid'], $cat);
                $this->cache->write($category, 'category_by_url_' . $this->security->sanitize_filename($cat) . '_and_sportid_' . $sport['uid'], 3600);
            }

            if (!$tournament = $this->cache->get('tournament_by_url_' . $this->security->sanitize_filename($trnmnt) . '_and_catid_'
                    . $category['uid'])
            ) {
                $tournament = $this->tournament->get_by_url($category['uid'], $trnmnt);
                $this->cache->write($tournament, 'tournament_by_url_' . $this->security->sanitize_filename($trnmnt) . '_and_catid_'
                        . $category['uid'], 3600);
            }
        } else {

            if (!$tournament = $this->cache->get('tournament_by_team_' . $team['uid'] . '_maintn_' . $team['main_tournament_uid']
                    . '_mainuntn_' . $team['main_unique_tournament_uid'])
            ) {
                $tournament = $this->tournament->get_by_team($team['uid'], $team['main_tournament_uid'], $team['main_unique_tournament_uid']);
                $this->cache->write($tournament, 'tournament_by_team_' . $team['uid'] . '_maintn_' . $team['main_tournament_uid'] . '_mainuntn_'
                        . $team['main_unique_tournament_uid'], 3600);
            }
            if (!$category = $this->cache->get('category_by_tournament_' . $tournament['category_uid'] . '_main_catuid_'
                    . $team['main_category_uid'])
            ) {
                $category = $this->category->get_single($tournament['category_uid'], $team['main_category_uid'], false);
                $this->cache->write($category, 'category_by_tournament_' . $tournament['category_uid'] . '_main_catuid_'
                        . $team['main_category_uid'], 3600);
            }
            if (!$sport = $this->cache->get('sport_' . $category['sport_uid'])) {
                $sport = $this->sport->get_single($category['sport_uid']);
                $this->cache->write($sport, 'sport_' . $category['sport_uid'], 3600);
                $this->sportU = $sport['seourl'];
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

            $navteams = array();
            if (!$this->match->isTennis()) {
                if (!$navteams = $this->cache->get('teams_for_tournament_' . $tournament['uid'] . '_type_' . $tournament['tntype'])
                ) {
                    $navteams = $this->team->get_by_tournament($tournament['uid'], $tournament['tntype']);
                    $this->cache->write($navteams, 'teams_for_tournament_' . $tournament['uid'] . '_type_' . $tournament['tntype'], 3600);
                }
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
                'categories' => $this->match->filterTopCats($navcategories, $category['uid']),
                'current_category' => '<span><b>' . $catname . '</b><i class="fa fa-times-circle"></i></span>',
                'tournaments' => $this->match->filterTopTours($navtournaments, $category['uid'], $tournament['uid'], $tournament['tntype']),
                'current_tournament' => '<span><b>' . $tournamentname . '</b><i class="fa fa-times-circle"></i></span>',
                'current_category_uid' => $category['uid'],
                'current_tournament_uid' => $tournament['uid'],
                'current_tournament_type' => $tournament['tntype'],
                'current_team_uid' => $team['uid'],
                'current_url' => base_url(array($this->lang->lang(),$sport['seourl'], $category['seourl'], $tournament['seourl'])),
                'teams' => $navteams,
                'current_team' => '<span><b>' . $teamname . '</b><i class="fa fa-times-circle"></i></span>',
                'team' => $team,
                'headline' => $teamname,
                'current_sport_url' => site_url($sport['seourl']),
                'current_cat_url' => base_url(array($this->lang->lang(),$sport['seourl'], $category['seourl'])),
                'current_trn_url' => base_url(array($this->lang->lang(),$sport['seourl'], $category['seourl'], $tournament['seourl'])),
                'current_trn_url_o' => base_url(array($this->lang->lang(),$sport['seourl'], $category['seourl'], $tournament['seourl'])),
                'livescores' => true,
                'facebookGraph' => true
            );

            if (strlen($team['header_image']) > 0) {
                $headerdata['headerImage'] = base_url('pool/uploads/team/' . $team['header_image']);
            } elseif (strlen($sport['header_image']) > 0) {
                $headerdata['headerImage'] = base_url('pool/uploads/sport/' . $sport['header_image']);
            }
        } else {
            $headerdata = array(
                'sports' => $this->sport->get_sports(true),
                'team' => $team,
                'current_team' => '<span><b>' . $teamname . '</b><i class="fa fa-times-circle"></i></span>',
                'headline' => $teamname,
                'livescores' => true
            );
            if (strlen($team['header_image']) > 0) {
                $headerdata['headerImage'] = base_url('pool/uploads/team/' . $team['header_image']);
            } elseif (strlen($sport['header_image']) > 0) {
                $headerdata['headerImage'] = base_url('pool/uploads/sport/' . $sport['header_image']);
            }
        }

        $headerdata['canonical'] = base_url(array($this->lang->lang(),'teams', $team['seourl'], $active));

        $taburls = base_url(array($this->lang->lang(),$sport['seourl'], $cat, $trnmnt, $team['seourl']));
        $hasPlayers = $this->team->has_players($team['uid']);

        $headerdata['isTeam'] = true;
        $headerdata['facebookGraph'] = true;


        $data = array(
            'pagename' => 'Livescores',
            'add_to_favs' => 'team:' . $team['uid'],
            'team' => $team,
            'matches' => $this->match->get(100, 0, 0, 0, 0, $team['uid']),
            'livescores' => true,
            'accept_time' => $this->match->getAcceptTime()
        );
        $this->generateHTMLTabs($data, $headerdata);

        $this->load->view('layouts/frontend_head', $headerdata);
        $data['favs'] = $this->load->view('layouts/favorites', array(), true);
        $data['appendJS'] = base_url('assets/frontend/javascripts/' . $this->template . '.js');
        $this->load->view($this->template, $data);
        $this->load->view('layouts/frontend_footer', $data);
    }

    public function tournament($sport, $cat, $trnmnt, $active = false) {

        $this->load->model('livescores/m_sport', 'sport', true);
        $this->load->model('livescores/m_category', 'category', true);
        $this->load->model('livescores/m_tournament', 'tournament', true);
        $this->load->model('livescores/m_team', 'team', true);
        $this->match->setIsLive($this->is_live);

        $langs = $this->config->item('language_db');
        $l = $langs[$this->lang->lang()];

        if (!$c_sport = $this->cache->get('sport_by_url_' . $this->security->sanitize_filename($sport))) {
            $c_sport = $this->sport->get_by_url($sport);
            $this->cache->write($c_sport, 'sport_by_url_' . $this->security->sanitize_filename($sport), 3600);
        }
        $sport = $c_sport;

        if (count($sport) == 0) {
            die();
        }

        if (!$category = $this->cache->get('category_by_url_' . $this->security->sanitize_filename($cat) . '_and_sportid_'
                . $sport['uid'])
        ) {
            $category = $this->category->get_by_url($sport['uid'], $cat);
            $this->cache->write($category, 'category_by_url_' . $this->security->sanitize_filename($cat) . '_and_sportid_' . $sport['uid'], 3600);
        }

        if (count($category) == 0) {
            die();
        }

        if (!$tournament = $this->cache->get('tournament_by_url_' . $this->security->sanitize_filename($trnmnt) . '_and_catid_'
                . $category['uid'])
        ) {
            $tournament = $this->tournament->get_by_url($category['uid'], $trnmnt);
            $this->cache->write($tournament, 'tournament_by_url_' . $this->security->sanitize_filename($trnmnt) . '_and_catid_' . $category['uid'], 3600);
        }

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

            $navteams = array();
            if (!$this->match->isTennis()) {
                if (!$navteams = $this->cache->get('teams_for_tournament_' . $tournament['uid'] . '_type_' . $tournament['tntype'])
                ) {
                    $navteams = $this->team->get_by_tournament($tournament['uid'], $tournament['tntype']);
                    $this->cache->write($navteams, 'teams_for_tournament_' . $tournament['uid'] . '_type_' . $tournament['tntype'], 3600);
                }
            }

            $headerdata = array(
                'sports' => $navsports,
                'categories' => $this->match->filterTopCats($navcategories, $category['uid']),
                'current_category' => '<span><b>' . $catname . '</b><i class="fa fa-times-circle"></i></span>',
                'current_category_uid' => $category['uid'],
                'tournaments' => $this->match->filterTopTours($navtournaments, $category['uid'], $tournament['uid'], $tournament['tntype']),
                'current_tournament' => '<span><b>' . $tnname . '</b><i class="fa fa-times-circle"></i></span>',
                'current_tournament_uid' => $tournament['uid'],
                'current_tournament_type' => $tournament['tntype'],
                'current_sport_url' => site_url($sport['seourl']),
                'current_url' => base_url(array($this->lang->lang(),$sport['seourl'], $category['seourl'], $tournament['seourl'])),
                'current_cat_url' => base_url(array($this->lang->lang(),$sport['seourl'], $category['seourl'])),
                'teams' => $navteams,
                'current_team' => dblang('choose_team'),
                'current_trn_url' => base_url(array($this->lang->lang(),$sport['seourl'], $category['seourl'], $tournament['seourl'])),
                'current_trn_url_o' => base_url(array($this->lang->lang(),$sport['seourl'], $category['seourl'], $tournament['seourl'])),
                'livescores' => true,
                'facebookGraph' => true
            );

            $trnname = $tnname;
            if ($tournament['tntype'] == 'tournament') {
                if (strlen($tournament['header_image']) > 0) {
                    $headerdata['headerImage'] = base_url('pool/uploads/tournament/' . $tournament['header_image']);
                }
            } else {
                if (strlen($tournament['header_image']) > 0) {
                    $headerdata['headerImage'] = base_url('pool/uploads/unique_tournament/' . $tournament['header_image']);
                }
            }

            if (!isset($headerdata['headerImage'])) {
                if (strlen($category['header_image']) > 0) {
                    $headerdata['headerImage'] = base_url('pool/uploads/category/' . $category['header_image']);
                } elseif (strlen($sport['header_image']) > 0) {
                    $headerdata['headerImage'] = base_url('pool/uploads/sport/' . $sport['header_image']);
                }
            }

            $headerdata['headline'] = $trnname;

            $data = array(
                'pagename' => 'Livescores',
                'add_to_favs' => str_replace('_', '', $tournament['tntype']) . ':' . $tournament['uid'],
                'matches' => $this->match->get(100, 0, $sport['uid'], $category['uid'], $tournament),
                'livescores' => true,
                'accept_time' => $this->match->getAcceptTime()
            );
            $this->generateHTMLTabs($data, $headerdata);

            $this->load->view('layouts/frontend_head', $headerdata);
            $data['favs'] = $this->load->view('layouts/favorites', array(), true);
            $data['appendJS'] = base_url('assets/frontend/javascripts/' . $this->template . '.js');
            $this->load->view($this->template, $data);
            $this->load->view('layouts/frontend_footer', $data);
        } else {
            redirect(site_url('home'));
        }
    }

    protected function dynamic_reload($segs, $offset = 0, $getFavs = false) {

        $this->load->model('livescores/m_sport', 'sport', true);
        $this->load->model('livescores/m_category', 'category', true);
        $this->load->model('livescores/m_tournament', 'tournament', true);
        $this->load->model('livescores/m_team', 'team', true);
        $this->match->setIsLive($this->is_live);

        $items = array();
        $action = 'dates';
        $offset = (int) $offset;
        if ($offset < 0) {
            $offset = 0;
        }

        switch (count($segs)) {
            case 2:
                if ($segs[2] == 'home') {
                    $items = $this->match->get(20, $offset);
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
                    $items = $this->match->get(20, $offset, $sport['uid']);
                }
                break;
            case 3:

                if ($segs[2] == 'teams') {

                    $arr = explode("-", $segs[3]);
                    $team = $this->team->get_by_betradar_uid($arr[count($arr) - 1]);
                    if (!isset($team['uid'])) {
                        die();
                    }

                    $tournament = $this->tournament->get_by_team($team['uid'], $team['main_tournament_uid'], $team['main_unique_tournament_uid']);
                    $category = $this->category->get_single($tournament['category_uid'], $team['main_category_uid']);
                    $sport = $this->sport->get_single($category['sport_uid']);

                    if ((int) $sport['uid'] === 8) {
                        $cat = $this->category->get_single_tennis($team['uid']);
                        $teampath = array($sport['seourl'], $cat->seourl, "none", $team['seourl']);
                        $tennisplayer = $team['name'];
                        $tennisplayeruid = $team['uid'];
                    } else {
                        $teampath = array($sport['seourl'], $category['seourl'], $tournament['seourl'], $team['seourl']);
                    }
                    $items = $this->match->get(20, $offset, $sport['uid'], $category['uid'], $tournament, $team['uid']);
                } else {

                    $sport = $this->sport->get_by_url($segs[2]);
                    if (isset($sport['uid'])) {
                        $category = $this->category->get_by_url($sport['uid'], $segs[3]);
                    } else {
                        die();
                    }

                    $items = $this->match->get(20, $offset, $sport['uid'], $category['uid']);
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
                $items = $this->match->get(20, $offset, $sport['uid'], $category['uid'], $tournament);

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
                $items = $this->match->get(20, $offset, $sport['uid'], $category['uid'], $tournament, $team['uid']);
        }


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

            $items[$i]['result'] = '<a href="' . dblang('livescores_url') . $items[$i]['betradar_uid'] . '" target="_blank">';

            if ($items[$i]['date'] < time()) {
                if ($items[$i]['status'] < 90 && $items[$i]['status'] != 60) {
                    $items[$i]['result'] .= dblang('livescores_live_match');
                } else {
                    $items[$i]['result'] .= dblang('livescores_post_match');
                }
            } else {
                $items[$i]['result'] .= dblang('livescores_pre_match');
            }

            $items[$i]['result'] .= '</a>';
        }

        $res = array(
            'status' => 'ok',
            'type' => $action,
            'segs' => $segs,
            'items' => $items
        );

        if (isset($tennisplayer)) {
            $res['tennisplayer'] = $tennisplayer;
            $res['tennisplayeruid'] = $tennisplayeruid;
        }

        echo json_encode($res);
    }

    private function generateHTMLTabs(&$data, &$headerdata = array()) {
        $arrSegs = array_values($this->segs);
        if (count($arrSegs) > 0 && $arrSegs[count($arrSegs) - 1] == "live") {
            unset($arrSegs[count($arrSegs) - 1]);
        }
        $arrLive = $arrSegs;
        $arrLive[count($arrLive)] = "live";

        $tabs = array(
            array('id' => 'match_dates', 'active' => '', 'title' => "Games", 'link' => base_url($arrSegs)),
            array('id' => 'match_live', 'active' => '', 'title' => "Live", 'link' => base_url($arrLive))
        );
        if (!$this->is_live) {
            $tabs[0]['active'] = 'active';
        } else {
            $tabs[1]['active'] = 'active';
        }
        $data['no_match'] = $this->match->isNoMatch();
        $data['load_previous'] = "Previous Matches";
        $data['loading'] = 'Loading...';
        $data['no_more_matches'] = 'There are no more matches!';
        $data['no_more_matches_old'] = 'There are no more older matches!';
        $data['soccer'] = ($this->sportU == "soccer" ? true : false);
        if ($this->myLang != "en") {
            $tabs[0]['title'] = "Spiele";
            $data['load_previous'] = ucfirst("ältere Spiele");
            $data['loading'] = 'Laden...';
            $data['no_more_matches'] = "Zur Zeit gibt es keine weiteren Spiele!";
            $data['no_more_matches_old'] = "Zur Zeit gibt es keine alteren Spiele!";
        }

        $data['tabs'] = $tabs;
        $data['live'] = $this->is_live;
        
        if ($this->sportU == "soccer") $data['boxstatistic'] = true;
    }
    
    public function statisticbox($segments)
    {
        $this->load->model('livescores/m_statistic');
        $this->m_statistic->loadSegments($segments);
        $data = $this->m_statistic->getStatisticInfo();
        echo $this->load->view('modals/stats-modal.php', $data, true);
        exit;
    }
}
