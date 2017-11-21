<?php

class Keyword_model extends CI_Model
{

    public function activate($id)
    {
        $this->db->where('uid', $id);
        $this->db->update('feed', array('disabled' => 0));
    }

    public function addBlacklistKeyword($item, $ref_table, $ref_uid)
    {
        $array = array("keyword_uid" => $item, "ref_table" => $ref_table, "ref_uid" => $ref_uid);
        $this->db->insert('blacklist', $array);
    }

    public function count()
    {
        return $this->db->select('uid')->where('deleted', 0)->get('keyword')->num_rows();
    }

    public function createBlacklistKeyword($item, $ref_table, $ref_uid)
    {
        if (strlen(trim($item)) > 0) {
            $array =
                array("lang" => 1, "value" => $item, "dynamic" => 0, "ref_table" => $ref_table, "ref_uid" => $ref_uid);
            $this->db->insert("keyword", $array);

            $id = $this->db->insert_id();
            $array = array("keyword_uid" => $id, "ref_table" => $ref_table, "ref_uid" => $ref_uid);
            $this->db->insert("blacklist", $array);
        }
    }

    public function deactivate($id)
    {
        $this->db->where('uid', $id);
        $this->db->update('feed', array('disabled' => 1));
    }

    public function deleteBlacklist($ref_table, $ref_uid)
    {
        $this->db->where('ref_table', $ref_table)->where('ref_uid', $ref_uid);
        $this->db->delete('blacklist');
    }

    public function delete_keyword_matchings($keyword_uids)
    {
        $this->db->where_in('uid', explode(',', $keyword_uids))->where('dynamic', 1);
        $this->db->update('keyword_matching', array('hidden' => 1));

        $this->db->where_in('uid', explode(',', $keyword_uids))->where('dynamic', 0);
        $this->db->delete('keyword_matching');
    }

    public function get($start = 0, $end = 20, $sortby = "uid", $dir = "asc", $search = array(), $grouped = false)
    {

        $this->db->select('	keyword.*, count(*) as count')
            ->from('keyword')
            ->join('keyword_matching', 'keyword_matching.keyword_uid = keyword.uid', 'left outer')
            ->where('keyword.deleted', 0);

        if (!empty($search)) {
            if (isset($search['uid']) && $search['uid'] != "") {
                $this->db->where('keyword.uid', intval($search['uid']));
            }
            if (isset($search['matching_uid']) && $search['matching_uid'] != "") {
                $this->db->where('keyword_matching.uid');
            }
            if (isset($search['value']) && $search['value'] != "") {
                $this->db->where('keyword.value LIKE', '%' . $search['value'] . '%');
            }
            if (isset($search['dynamic']) && $search['dynamic'] != "") {
                if (strpos('dynamisch', $search['dynamic']) !== false) {
                    $this->db->where('keyword.dynamic = 1');
                }
                if (strpos('manuell', $search['dynamic']) !== false) {
                    $this->db->where('keyword.dynamic = 0');
                }
            }
        }

        if ($grouped) {
            $this->db->group_by('keyword.value');
        } else {
            $this->db->group_by('keyword.uid');
        }


        $this->db->order_by($sortby, $dir)
            ->limit($end, $start);


        $result = array("result" => $this->db->get()->result_array(), "count" => $this->countFiltered($search));
        return $result;
    }

    public function countFiltered($search)
    {
        $this->db->select('	keyword.*, count(*) as count')
            ->from('keyword')
            ->join('keyword_matching', 'keyword_matching.keyword_uid = keyword.uid')
            ->where('keyword.deleted', 0);

        if ($search) {
            if (isset($search['uid']) && $search['uid'] != "") {
                $this->db->where('keyword.uid', intval($search['uid']));
            }
            if (isset($search['value']) && $search['value'] != "") {
                $this->db->where('keyword.value LIKE', '%' . $search['value'] . '%');
            }
        }
        $this->db->group_by('keyword.uid');
        return $this->db->get()->num_rows();

    }

    public function get_blacklist($uid, $type)
    {

        $this->db->select('keyword.uid, keyword.value')->from('blacklist')
            ->join('keyword', 'blacklist.keyword_uid = keyword.uid')->where('blacklist.ref_table', $type)
            ->where('blacklist.ref_uid', $uid);
        $res = $this->db->get()->result_array();

        $arr = array();
        if (count($res) > 0) {
            for ($i = 0; $i < count($res); ++$i) {
                $r = $res[$i];
                $arr['uids'][$i] = $r['uid'];
                $arr['texts'][$i] = htmlentities($r['value']);
            }
        } else {
            $arr['uids'] = array('');
            $arr['texts'] = array('');
        }
        return $arr;
    }

    public function get_category_matchings($id)
    {
        $sel = 'km.*, keyword.value, sport.name as sportname, category.name as catname, tournament.name as tnname';
        $this->db->select($sel)
            ->from('keyword_matching as km')
            ->join('keyword', 'km.keyword_uid = keyword.uid')
            ->join('sport', 'km.sport_uid = sport.uid', 'left outer')
            ->join('category', 'km.category_uid = category.uid', 'left outer')
            ->join('tournament', 'km.tournament_uid = tournament.uid', 'left outer')
            ->where('km.category_uid', $id)
            ->where('(km.tournament_uid = 0 OR km.tournament_uid IS NULL)')
            ->where('(km.unique_tournament_uid = 0 OR km.unique_tournament_uid IS NULL)')
            ->where('(km.team_uid = 0 OR km.team_uid IS NULL)')
            ->where('km.hidden', 0)
            ->order_by('keyword.value, keyword.uid');

        return $this->db->get()->result_array();
    }

    public function get_keyword($id)
    {
        $this->db->select('*')->from('keyword')->where('uid', $id)->limit(1);
        return $this->db->get()->row();
    }

    public function get_matching_with_rel($uid)
    {
        $this->db->select('	kwm.*,
													kw.value as keyword_value,
													tn.name as tn_name,
													untn.name as untn_name,
													cat.name as cat_name,
													sp.name as sp_name')
            ->from('keyword_matching as kwm')
            ->join('keyword as kw', 'kw.uid = kwm.keyword_uid')
            ->join('tournament as tn', 'tn.uid = kwm.tournament_uid', 'left outer')
            ->join('unique_tournament as untn', 'untn.uid = kwm.unique_tournament_uid', 'left outer')
            ->join('category as cat', 'cat.uid = kwm.category_uid', 'left outer')
            ->join('sport as sp', 'sp.uid = kwm.sport_uid', 'left outer')
            ->where('kwm.uid', $uid)
            ->limit(1);
        return $this->db->get()->row_array();
    }

    public function get_sport_matchings($id)
    {
        $sel = 'km.*, keyword.value, sport.name as sportname, category.name as catname, tournament.name as tnname';
        $this->db->select($sel)
            ->from('keyword_matching as km')
            ->join('keyword', 'km.keyword_uid = keyword.uid')
            ->join('sport', 'km.sport_uid = sport.uid', 'left outer')
            ->join('category', 'km.category_uid = category.uid', 'left outer')
            ->join('tournament', 'km.tournament_uid = tournament.uid', 'left outer')
            ->where('km.sport_uid', $id)
            ->where('(km.category_uid = 0 OR km.category_uid IS NULL)')
            ->where('(km.tournament_uid = 0 OR km.tournament_uid IS NULL)')
            ->where('(km.unique_tournament_uid = 0 OR km.unique_tournament_uid IS NULL)')
            ->where('(km.team_uid = 0 OR km.team_uid IS NULL)')
            ->where('km.hidden', 0)
            ->order_by('keyword.value, keyword.uid');

        return $this->db->get()->result_array();
    }

    public function get_team_matchings($id)
    {
        $sel  = 'keyword_matching.*, keyword.value, sport.name as sportname, ';
        $sel .= 'category.name as catname, tournament.name as tnname';
        $this->db->select($sel)
            ->from('keyword_matching')
            ->join('keyword', 'keyword_matching.keyword_uid = keyword.uid')
            ->join('sport', 'keyword_matching.sport_uid = sport.uid', 'left outer')
            ->join('category', 'keyword_matching.category_uid = category.uid', 'left outer')
            ->join('tournament', 'keyword_matching.tournament_uid = tournament.uid', 'left outer')
            ->where('keyword_matching.team_uid', $id)
            ->where('keyword_matching.hidden', 0)
            ->order_by('keyword.value, keyword.uid');

        return $this->db->get()->result_array();
    }

    public function get_tournament_matchings($id)
    {

        $sel = 'km.*, keyword.value, sport.name as sportname, category.name as catname, tournament.name as tnname';
        $this->db->select($sel)
            ->from('keyword_matching as km')
            ->join('keyword', 'km.keyword_uid = keyword.uid')
            ->join('sport', 'km.sport_uid = sport.uid', 'left outer')
            ->join('category', 'km.category_uid = category.uid', 'left outer')
            ->join('tournament', 'km.tournament_uid = tournament.uid', 'left outer')
            ->where('km.tournament_uid', $id)
            ->where('(km.unique_tournament_uid = 0 OR km.unique_tournament_uid IS NULL)')
            ->where('(km.team_uid = 0 OR km.team_uid IS NULL)')
            ->where('km.hidden', 0)
            ->order_by('keyword.value, keyword.uid');

        return $this->db->get()->result_array();
    }

    public function get_unique_tournament_matchings($id)
    {

        $sel = 'km.*, keyword.value, sport.name as sportname, category.name as catname, tournament.name as tnname';
        $this->db->select($sel);

        $this->db->from('unique_tournament as untn');
        $this->db->join('tournament as tn', 'tn.unique_uid = untn.uid');

        $kmJoin  = 'km.uid = km.uid AND km.hidden = 0 AND ';
        $kmJoin .= '(km.unique_tournament_uid = untn.uid OR km.tournament_uid = tn.uid) AND ';
        $kmJoin .= '(km.team_uid = 0 OR km.team_uid IS NULL)';

        $this->db->join('keyword_matching as km', $kmJoin);
        $this->db->join('keyword', 'km.keyword_uid = keyword.uid');
        $this->db->join('sport', 'km.sport_uid = sport.uid', 'left outer');
        $this->db->join('category', 'km.category_uid = category.uid', 'left outer');
        $this->db->join('tournament', 'km.tournament_uid = tournament.uid', 'left outer');

        $this->db->where('untn.uid', $id);
        $this->db->group_by('km.uid');

        return $this->db->get()->result_array();
    }

    public function insert($data)
    {
        $this->db->insert('keyword', $data);
    }

    public function insertKeywordWithMatching($data)
    {

        if (isset($data['ref_table']) && $data['ref_table'] != "") {
            $kw['ref_table'] = $data['ref_table'];
        } else {
            $kw['ref_table'] = 'sportnews_team';
        }

        if (isset($data['ref_uid']) && $data['ref_uid'] != "") {
            $kw['ref_uid'] = $data['ref_uid'];
        } else {
            $kw['ref_uid'] = $data['team_uid'];
        }


        $kw['value'] = $data['keyword'];
        $kw['dynamic'] = 0;
        $kw['lang'] = 1;

        $this->db->insert('keyword', $kw);
        unset($data['keyword']);
        $id = $this->db->insert_id();
        $data['keyword_uid'] = $id;
        $data['dynamic'] = 0;

        if (isset($data['tournament_uid']) && $data['tournament_uid'] != '') {
            if (strpos($data['tournament_uid'], 'unq-') !== false) {
                $data['unique_tournament_uid'] = str_replace('unq-', '', $data['tournament_uid']);
                unset($data['tournament_uid']);
            }
        }

        unset($data['ref_table']);
        unset($data['ref_uid']);

        $this->db->insert('keyword_matching', $data);
        return $this->db->insert_id();

    }

    public function insertMatching($data)
    {

        unset($data['keyword']);
        $data['dynamic'] = 0;

        unset($data['ref_table']);
        unset($data['ref_uid']);

        if (isset($data['tournament_uid']) && strpos($data['tournament_uid'], 'unq-') !== false) {
            $data['unique_tournament_uid'] = str_replace('unq-', '', $data['tournament_uid']);
            unset($data['tournament_uid']);
        }
        $this->db->insert('keyword_matching', $data);
        return $this->db->insert_id();

    }

    public function remove($id)
    {
        $this->db->where('uid', $id);
        $this->db->update('keyword', array('deleted' => 1, 'disabled' => 0));
    }

    public function update($id, $data)
    {
        $this->db->where('uid', $id);
        $this->db->update('keyword', $data);
    }
}
