<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Home
 * @property Ion_auth $ion_auth
 * @property home_model $home
 */
class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('backend/auth/login', 'refresh');
        }
    }

    public function getAsync() {
        $this->load->model('backend/home_model', 'home', true);
        echo json_encode($this->home->getStatus());
    }

    public function getNewsCount() {
      $count = $this->db
        ->select('COUNT(crawled_on) as cnt')
        ->from('post')
        ->where('crawled_on >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 DAY))')
        ->get()
        ->row();

        if(!empty($count)){
          if(isset($count->cnt)){
            return $count->cnt;
          }
        }

      return 0;
    }

    public function getFeedCount() {
      $feeds = $this->db
        ->select('COUNT(uid) as cnt')
        ->from('feed')
        ->where(array(
          "deleted" => 0,
          "hidden" => 0
        ))
        ->get()
        ->row();

      if(!empty($feeds)){
        if(isset($feeds->cnt)){
          return $feeds->cnt;
        }
      }

      return 0;
    }

    public function getLastImport(){
        $lastImport = $this->db
          ->select('created_on')
          ->from('log')
          ->where('message LIKE "%finished%"')
          ->order_by('created_on', 'desc')
          ->limit(1)
          ->get()
          ->row();

        if (!empty($lastImport)) {
          if(isset($lastImport->created_on)){
            return date("H:i | d.m.Y", $lastImport->created_on);
          }
        }

        return 'Noch nicht gelaufen.';
    }

    public function index() {
        $headerdata['title'] = 'Dashboard | BIB - Betreiberbackend';
        $headerdata['langcode'] = 'de';
        $headerdata['userid'] = $this->ion_auth->user()->row()->id;
        $headerdata['username'] = $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;

        $data = array();
        $data['newsCount'] = $this->getNewsCount();
        $data['feedCount'] = $this->getFeedCount();
        $data['lastImport'] = $this->getLastImport();

        $this->load->view('backend/layouts/header', $headerdata);
        $this->load->view('backend/layouts/sidebar');
        $this->load->view('backend/home/index', $data);
        $this->load->view('backend/layouts/footer');
    }
}

/* End of file home.php */
/* Location: ./application/controllers/backend/home.php */
