<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Seo
 * @property tournament_model $tournament
 * @property team_model $team
 */
class Seo extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group(array(1, 2))) {
            redirect('/backend/auth/login');
        }
    }

    public function create_post_seourls() {
        $posts = $this->db->select('uid, title')->where('seourl IS NULL', null, false)->limit(20000)->get('post')
            ->result();

        foreach ($posts as $p) {
            $title = $this->sanitzeUrl($p->title, 150);
            $this->db->where('uid', $p->uid)->update('post', array('seourl' => $title . '-' . $p->uid));
        }
    }

    public function create_sitemap() {

        $this->load->model('tournament_model', 'tournament', true);
        $this->load->model('team_model', 'team', true);

        $this->load->helper('url');
        $objDateTime = new DateTime('NOW');
        $objDateTime->format('c');

        $langs = array();
        $this->db->select('*')->from('language')->where('deleted', 0)->where('active', 1)->order_by('sorting');
        $res = $this->db->get()->result();

        $dblangs = $this->config->item('language_db');
        foreach ($res as $item) {
            foreach ($dblangs as $key => $val) {
                if ($val === (int)$item->uid) {
                    $langs[] = $key;
                }
            }
        }

        $this->db->select('uid, seourl')->from('sport')->where('hidden', 0);
        if ($sportres = $this->db->get()->result()) {
            $sIndex = fopen("sitemaps/sitemap.xml", "w") or die("Unable to open file!");
            fwrite($sIndex, pack("CCC", 0xef, 0xbb, 0xbf));
            fwrite($sIndex, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n");
            fwrite($sIndex, "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\r\n");

            $sGeneral = fopen("sitemaps/sitemap-general.xml", "w") or die("Unable to open file!");
            fwrite($sGeneral, pack("CCC", 0xef, 0xbb, 0xbf));
            fwrite($sGeneral, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n");
            fwrite($sGeneral,
                "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xhtml=\"http://www.w3.org/1999/xhtml\">\r\n");


            fwrite($sIndex, "\t<sitemap>\r\n");
            fwrite($sIndex, "\t\t<loc>" . base_url() . "sitemaps/sitemap-general.xml</loc>\r\n");
            fwrite($sIndex, "\t\t<changefreq>daily</changefreq>\r\n");
            fwrite($sIndex, "\t\t<lastmod>" . $objDateTime->format('c') . "</lastmod>\r\n");
            fwrite($sIndex, "\t</sitemap>\r\n");

            foreach ($sportres as $sportrow) {

                foreach ($langs as $l) {
                    fwrite($sGeneral, "\t<url>\r\n");
                    fwrite($sGeneral, "\t\t<loc>" . base_url() . $l . "/" . $sportrow->seourl . "</loc>\r\n");
                    foreach ($langs as $m) {
                        fwrite($sGeneral,
                            "\t\t<xhtml:link rel=\"alternate\" hreflang=\"" . $m . "\" href=\"" . base_url() . $m . "/"
                            . $sportrow->seourl . "\" />\r\n");
                    }
                    fwrite($sGeneral, "\t</url>\r\n");
                }

                $this->db->select('uid, seourl')->from('category')->where('hidden', 0)
                    ->where('sport_uid', $sportrow->uid);
                if ($catres = $this->db->get()->result()) {
                    foreach ($catres as $catrow) {

                        foreach ($langs as $l) {
                            fwrite($sGeneral, "\t<url>\r\n");
                            fwrite($sGeneral,
                                "\t\t<loc>" . base_url() . $l . "/" . $sportrow->seourl . "/" . $catrow->seourl
                                . "</loc>\r\n");
                            foreach ($langs as $m) {
                                fwrite($sGeneral,
                                    "\t\t<xhtml:link rel=\"alternate\" hreflang=\"" . $m . "\" href=\"" . base_url()
                                    . $m . "/" . $sportrow->seourl . "/" . $catrow->seourl . "\" />\r\n");
                            }
                            fwrite($sGeneral, "\t</url>\r\n");
                        }

                        if ($trnres = $this->tournament->get_by_category($catrow->uid)) {

                            $sSitemap =
                                fopen("sitemaps/sitemap-sport-" . $sportrow->uid . "-" . $catrow->uid . ".xml", "w")
                            or die("Unable to open file!");
                            fwrite($sSitemap, pack("CCC", 0xef, 0xbb, 0xbf));
                            fwrite($sSitemap, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n");
                            fwrite($sSitemap,
                                "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xhtml=\"http://www.w3.org/1999/xhtml\">\r\n");

                            fwrite($sIndex, "\t<sitemap>\r\n");
                            fwrite($sIndex, "\t\t<loc>" . base_url() . "sitemaps/sitemap-sport-" . $sportrow->uid . "-"
                                . $catrow->uid . ".xml</loc>\r\n");
                            fwrite($sIndex, "\t\t<changefreq>daily</changefreq>\r\n");
                            fwrite($sIndex, "\t\t<lastmod>" . $objDateTime->format('c') . "</lastmod>\r\n");
                            fwrite($sIndex, "\t</sitemap>\r\n");

                            foreach ($trnres as $trnrow) {

                                foreach ($langs as $l) {
                                    fwrite($sSitemap, "\t<url>\r\n");
                                    fwrite($sSitemap,
                                        "\t\t<loc>" . base_url() . $l . "/" . $sportrow->seourl . "/" . $catrow->seourl
                                        . "/" . $trnrow['seourl'] . "</loc>\r\n");
                                    foreach ($langs as $m) {
                                        fwrite($sSitemap, "\t\t<xhtml:link rel=\"alternate\" hreflang=\"" . $m . "\" ");
                                        fwrite($sSitemap, "href=\"" . base_url() . $m . "/" . $sportrow->seourl . "/"
                                            . $catrow->seourl . "/" . $trnrow['seourl'] . "\" />\r\n");
                                    }
                                    fwrite($sSitemap, "\t</url>\r\n");
                                }

                                if ($teamres = $this->team->get_by_tournament($trnrow['uid'], $trnrow['tntype'])) {

                                    foreach ($teamres as $teamrow) {

                                        foreach ($langs as $l) {
                                            fwrite($sSitemap, "\t<url>\r\n");
                                            fwrite($sSitemap,
                                                "\t\t<loc>" . base_url() . $l . "/teams/" . $teamrow['seourl']
                                                . "</loc>\r\n");
                                            foreach ($langs as $m) {
                                                fwrite($sSitemap,
                                                    "\t\t<xhtml:link rel=\"alternate\" hreflang=\"" . $m . "\" ");
                                                fwrite($sSitemap,
                                                    "href=\"" . base_url() . $m . "/teams/" . $teamrow['seourl']
                                                    . "\" />\r\n");
                                            }
                                            fwrite($sSitemap, "\t</url>\r\n");
                                        }

                                    }

                                }

                            }
                            fwrite($sSitemap, "</urlset>");
                            fclose($sSitemap);
                        }

                    }
                }
            }

            $statics = array('about_us', 'agb', 'privacy', 'imprint');

            foreach ($statics as $s) {

                foreach ($langs as $l) {
                    fwrite($sGeneral, "\t<url>\r\n");
                    fwrite($sGeneral, "\t\t<loc>" . base_url() . $l . "/pages/" . $s . "</loc>\r\n");
                    foreach ($langs as $m) {
                        fwrite($sGeneral,
                            "\t\t<xhtml:link rel=\"alternate\" hreflang=\"" . $m . "\" href=\"" . base_url() . $m
                            . "/pages/" . $s . "\" />\r\n");
                    }
                    fwrite($sGeneral, "\t</url>\r\n");
                }

            }

            fwrite($sGeneral, "</urlset>");
            fclose($sGeneral);
            fwrite($sIndex, "</sitemapindex>");
            fclose($sIndex);
        }

    }
}