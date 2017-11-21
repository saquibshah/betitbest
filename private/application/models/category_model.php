<?php

class Category_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function activate($uid)
    {
        $this->db->where('uid', $uid);
        $cat = $this->db->get('category')->row();
        $this->cache->delete('categories_bysport_' . $cat->sport_uid);

        $this->db->where('uid', $uid);
        $this->db->update('category', array('hidden' => 0));
    }

    public function deactivate($uid)
    {
        $this->db->where('uid', $uid);
        $cat = $this->db->get('category')->row();
        $this->cache->delete('categories_bysport_' . $cat->sport_uid);

        return $this->db->where('uid', $uid)->update('category', array('hidden' => 1));
    }

    public function count()
    {
        return $this->db->select('uid')->get('category')->num_rows();
    }

    public function get($start = 0, $end = 20, $sortby = "uid", $dir = "asc", $search = array())
    {
        $this->db->select('category.*, sport.name as sportname')
                ->from('category')
                ->join('sport', 'sport.uid = category.sport_uid')
                ->order_by($sortby, $dir)
                ->limit($end, $start);

        if (!empty($search)) {
            if (isset($search['uid']) && $search['uid'] != "") {
                $this->db->where('category.uid', intval($search['uid']));
            }
            if (isset($search['name']) && $search['name'] != "") {
                if (substr($search['name'], 0, 1) == "!") {
                    $this->db->where('category.name LIKE', '' . substr($search['name'], 1) . '');
                } else {
                    $this->db->where('category.name LIKE', '%' . $search['name'] . '%');
                }
            }
            if (isset($search['sport']) && $search['sport'] != "") {
                if (substr($search['sport'], 0, 1) == "!") {
                    $this->db->where('sport.name LIKE', '' . substr($search['sport'], 1) . '');
                } else {
                    $this->db->where('sport.name LIKE', '%' . $search['sport'] . '%');
                }
            }
        }

        return array("result" => $this->db->get()->result_array(), "count" => $this->countFiltered($search));
    }

    public function countFiltered($search)
    {
        $this->db->select('	category.*, sport.name as sportname')
                ->from('category')
                ->join('sport', 'sport.uid = category.sport_uid');

        if ($search) {
            if (isset($search['uid']) && $search['uid'] != "") {
                $this->db->where('category.uid', intval($search['uid']));
            }
            if (isset($search['name']) && $search['name'] != "") {
                if (substr($search['name'], 0, 1) == "!") {
                    $this->db->where('category.name LIKE', '' . substr($search['name'], 1) . '');
                } else {
                    $this->db->where('category.name LIKE', '%' . $search['name'] . '%');
                }
            }
            if (isset($search['sport']) && $search['sport'] != "") {
                if (substr($search['sport'], 0, 1) == "!") {
                    $this->db->where('sport.name LIKE', '' . substr($search['sport'], 1) . '');
                } else {
                    $this->db->where('sport.name LIKE', '%' . $search['sport'] . '%');
                }
            }
        }
        return $this->db->get()->num_rows();
    }

    public function get_by_sport($uid, $withoutHidden = false)
    {
        $this->db->select('category.*, sport.uid as sportuid, sport.seourl as sporturl')->from('category')
                ->join('sport', 'sport.uid = category.sport_uid')->where('sport_uid', $uid);

        if ($withoutHidden) {
            $this->db->where('category.hidden', 0);
        }
        $this->db->order_by('category.name');
        return $this->db->get()->result_array();
    }

    public function get_by_url($sport, $url)
    {
        $this->db->select('*')
                ->from('category')
                ->where('seourl LIKE', $url)
                ->where('sport_uid =', $sport);
        return $this->db->get()->row_array();
    }

    public function get_db_videos($uid)
    {
        $this->db->select('*')
                ->from('videoitems')
                ->join('category_team', 'category_team.team_uid = videoitems.team_uid')
                ->where('category_team.category_uid', $uid)//->order_by('videoitems.published', 'desc')
                ->group_by('videoitems.uid')->limit(15);

        return $this->db->get()->result_array();
    }

    public function get_single($uid, $teamcat = 0, $showHidden = true)
    {
        $this->db->select('category.*, sport.name as sportname, sport.uid as sport_uid, sport.seourl as sport_seourl')
                ->from('category')
                ->join('sport', 'sport.uid = category.sport_uid');

        if ($teamcat > 0) {
            $this->db->where('category.uid', $teamcat);
        } else {
            $this->db->where('category.uid', $uid);
        }

        if (!$showHidden) {
            $this->db->where('category.hidden', 0);
        }

        $row = $this->db->get()->row_array();

        if (!$row && $teamcat != 0) {
            $this->db->select('category.*, sport.name as sportname, sport.uid as sport_uid, sport.seourl as sport_seourl')
                    ->from('category')
                    ->join('sport', 'sport.uid = category.sport_uid');

            $this->db->where('category.uid', $uid);
            if (!$showHidden) {
                $this->db->where('category.hidden', 0);
            }

            $row = $this->db->get()->row_array();
        }

        return $row;
    }

    public function get_single_tennis($teamuid)
    {
        $row = $this->db->select('category.seourl')->from('category')
        ->join('category_team as ct', 'ct.category_uid = category.uid AND ct.team_uid = ' . $teamuid)
        ->where('category.hidden', 0)->get()->row();
        return $row;
    }

    public function set_headerimage($uid, $path)
    {
        $this->db->where('uid', $uid);
        $this->db->update('category', array('header_image' => $path));
    }

    public function set_name($uid, $name)
    {
        $this->db->where('uid', $uid);
        $this->db->update('category', array('name' => $name));
    }
}
