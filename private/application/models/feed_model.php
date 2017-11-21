<?php

class Feed_model extends CI_Model
{

    public function activate($id)
    {
        $this->db->where('uid', $id)->update('feed', array('enabled' => 1));
    }


    public function count()
    {
        return $this->db->select('uid')->from('feed')->where('deleted', 0)->get()->num_rows();
    }


    public function countFiltered($search)
    {
        $this->db->select('	feed.*,
            sport.name as sportname,
            category.name as categoryname,
            tournament.name as tournamentname,
            team.name as teamname')
            ->from('feed')
            ->join('sport', 'sport.uid = feed.sport_uid', 'left outer')
            ->join('category', 'category.uid = feed.category_uid', 'left outer')
            ->join('tournament', 'tournament.uid = feed.tournament_uid', 'left outer')
            ->join('team', 'team.uid = feed.team_uid', 'left outer')
            ->where('feed.deleted', 0);

        if ($search) {
            if (!empty($search['uid'])) {
                $this->db->where('feed.uid', intval($search['uid']));
            }
            if (!empty($search['name'])) {
                $this->db->where('feed.name LIKE', '%'.$search['name'].'%');
            }
            if (!empty($search['url'])) {
                $this->db->where('feed.url LIKE', '%'.$search['url'].'%');
            }
            if (!empty($search['sportname'])) {
                $this->db->where('sport.name LIKE', '%'.$search['sportname'].'%');
            }
            if (!empty($search['categoryname'])) {
                $this->db->where('category.name LIKE', '%'.$search['categoryname'].'%');
            }
            if (!empty($search['tournamentname'])) {
                $this->db->where('tournament.name LIKE', '%'.$search['tournamentname'].'%');
            }
            if (!empty($search['teamname'])) {
                $this->db->where('team.name LIKE', '%'.$search['teamname'].'%');
            }
        }

        $this->db->group_by('feed.uid');

        return $this->db->get()->num_rows();
    }


    public function deactivate($id)
    {
        $this->db->where('uid', $id)->update('feed', array('enabled' => 0));
    }


    public function get($start = 0, $end = 20, $sortby = 'uid', $dir = 'asc', $search = array())
    {
        $this->db->select('feed.*,
            sport.name as sportname,
            category.name as categoryname,
            tournament.name as tournamentname,
            untn.name as untnname,
            team.name as teamname')
            ->from('feed')
            ->join('sport', 'sport.uid = feed.sport_uid', 'left outer')
            ->join('category', 'category.uid = feed.category_uid', 'left outer')
            ->join('tournament AS tournament', 'tournament.uid = feed.tournament_uid', 'left outer')
            ->join('unique_tournament AS untn', 'untn.uid = feed.unique_tournament_uid', 'left outer')
            ->join('team', 'team.uid = feed.team_uid', 'left outer')
            ->where('feed.deleted', 0);

        if (!empty($search)) {
            if (!empty($search['uid'])) {
                $this->db->where('feed.uid', intval($search['uid']));
            }

            if (!empty($search['name'])) {
                $this->db->where('feed.name LIKE', '%'.$search['name'].'%');
            }

            if (!empty($search['url'])) {
                $this->db->where('feed.url LIKE', '%'.$search['url'].'%');
            }

            if (!empty($search['sportname'])) {
                $this->db->where('sport.name LIKE', '%'.$search['sportname'].'%');
            }

            if (!empty($search['categoryname'])) {
                $this->db->where('category.name LIKE', '%'.$search['categoryname'].'%');
            }

            if (!empty($search['tournamentname'])) {
                $this->db->where("(tournament.name LIKE '%{$search['tournamentname']}%' OR untn.name LIKE "
                    ."'%{$search['tournamentname']}%')");
            }

            if (!empty($search['teamname'])) {
                $this->db->where('team.name LIKE', '%'.$search['teamname'].'%');
            }
        }

        return $this->db->group_by('feed.uid')
            ->order_by($sortby, $dir)
            ->limit($end, $start)
            ->get()->result_array();
    }


    public function get_categories()
    {
        $result = $this->db->select('category.uid, category.name, sport.name AS sportname')
            ->from('category')
            ->join('sport', 'category.sport_uid = sport.uid', 'left outer')
            ->order_by('category.name')->get()->result_array();

        $returnArray = array(
            0 => 'Kategorie w&auml;hlen'
        );

        foreach ($result as $r) {
            $returnArray[$r['uid']] = $r['name'].' ('.$r['sportname'].')';
        }

        return $returnArray;
    }


    public function get_category_dropdown($uid = -1)
    {
        $this->db->select('cat.uid, cat.name, sp.name AS sportname')
            ->from('category as cat')
            ->join('sport as sp', 'cat.sport_uid = sp.uid');

        $addWhere = '';
        if ($uid > -1) {
            $addWhere = ' or cat.uid = ' . $uid;
        }

        $this->db->where('(cat.hidden = 0 and sp.hidden = 0)' . $addWhere, null, false);
        $this->db->order_by('cat.name');

        $result = $this->db->get()->result_array();

        $returnArray = array(
            0 => 'Kategorie w&auml;hlen'
        );

        foreach ($result as $r) {
            $returnArray[$r['uid']] = $r['name'].' ('.$r['sportname'].')';
        }

        return $returnArray;
    }


    public function get_feed_by_id($id)
    {
        return $this->db->from('feed')->where('uid', $id)->limit(1)->get()->row();
    }


    public function get_languages()
    {

        $this->db->select('uid, name')->from('language')->where('deleted', '0')->order_by('name');
        $result = $this->db->get()->result_array();

        $returnArray = array(
            0 => 'Bitte w&auml;hlen'
        );

        foreach ($result as $r) {
            $returnArray[$r['uid']] = $r['name'];
        }

        return $returnArray;
    }


    public function get_sports()
    {
        $result = $this->db->select('uid, name')->from('sport')->order_by('name')->get()->result_array();
        $returnArray = array(
            0 => 'Sportart w&auml;hlen'
        );

        foreach ($result as $r) {
            $returnArray[$r['uid']] = $r['name'];
        }

        return $returnArray;
    }


    public function get_sports_dropdown($uid = -1)
    {
        $this->db->select('uid, name')->order_by('name');

        $addWhere = '';
        if ($uid >= -1) {
            $addWhere = ' or uid = ' . $uid;
        }

        $this->db->where('hidden = 0' . $addWhere, null, false);
        $result = $this->db->get('sport')->result_array();

        $returnArray = array(
            0 => 'Sportart w&auml;hlen'
        );

        foreach ($result as $r) {
            $returnArray[$r['uid']] = $r['name'];
        }

        return $returnArray;
    }


    public function get_teams()
    {

        $sel  = 'team.uid, team.name, team.gender, category.name AS catname, ';
        $sel .= 'tournament.name AS tournamentname, ut.name AS utname, sport.name AS sportname';

        $result = $this->db->select($sel)
                    ->from('team')
                    ->join('tournament_team', 'tournament_team.team_uid = team.uid', 'left outer')
                    ->join('tournament', 'tournament_team.tournament_uid = tournament.uid')
                    ->join('unique_tournament AS ut', 'tournament.unique_uid = ut.uid', 'left outer')
                    ->join('category', 'tournament.category_uid = category.uid', 'left outer')
                    ->join('sport', 'category.sport_uid = sport.uid', 'left outer')
                    ->order_by('team.name')->group_by('team.uid')->get()->result_array();

        $returnArray = array(
            0 => 'Bitte w&auml;hlen'
        );

        foreach ($result as $r) {
            if (strlen($r['utname']) > 0) {
                $r['tournamentname'] = $r['utname'];
            }
            $returnArray[$r['uid']] =
                $r['name'].' ['.$r['gender'].'] ('.$r['tournamentname'].'/'.$r['sportname'].')';
        }

        return $returnArray;
    }


    public function get_tournaments()
    {
        $result =
            $this->db->select('tournament.uid, tournament.name, category.name AS catname, sport.name AS sportname')
                ->from('tournament')
                ->join('category', 'tournament.category_uid = category.uid', 'left outer')
                ->join('sport', 'category.sport_uid = sport.uid', 'left outer')
                ->order_by('tournament.name')->get()->result_array();

        $returnArray = array(
            0 => 'Bitte w&auml;hlen'
        );

        foreach ($result as $r) {
            $returnArray[$r['uid']] = $r['name'].' ('.$r['sportname'].' -> '.$r['catname'].')';
        }

        return $returnArray;
    }


    public function insert($data)
    {
        $this->db->insert('feed', $data);
    }


    public function remove($id)
    {
        $this->db->where('uid', $id)->update('feed', array('deleted' => 1, 'enabled' => 0));
    }


    public function update($id, $data)
    {
        $this->db->where('uid', $id)->update('feed', $data);
    }
}
