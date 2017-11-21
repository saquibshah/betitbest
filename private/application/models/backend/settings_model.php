<?php

class Settings_model extends CI_Model {

    public function get_logostatus() {
        $this->db->from('settings')->where('setting', 'show_logos')->limit(1);
        $row = $this->db->get()->row();

        if ($row->value == 1) {
            return true;
        } else {
            return false;
        }

    }

    public function get_navigation($showempty = false) {

        $data = array();

        if (!$showempty) {
            $this->db->select('sport.*, COUNT(current_odds.uid) as oddcount')
                ->from('sport')
                ->join('current_odds', 'current_odds.sport_uid = sport.uid')
                ->join('match', 'match.uid = current_odds.match_uid', 'right')
                ->where('match.date >=', time())
                ->group_by('sport.uid');
        } else {
            $this->db->select('*')
                ->from('sport');
        }
        $rows = $this->db->get()->result_array();

        foreach ($rows as $row) {
            $row['type'] = 'sport';
            $data[$row['type']][$row['uid']] = $row;
        }

        if (!$showempty) {
            $this->db->select('tournament.*, COUNT(current_odds.uid) as oddcount')
                ->from('tournament')
                ->join('current_odds', 'current_odds.tournament_uid = tournament.uid')
                ->join('match', 'match.uid = current_odds.match_uid', 'right')
                ->where('match.date >=', time())
                ->group_by('tournament.uid');
        } else {
            $this->db->select('*')
                ->from('tournament');
        }
        $rows = $this->db->get()->result_array();

        foreach ($rows as $row) {
            $row['type'] = 'tournament';
            $data[$row['type']][$row['uid']] = $row;
        }

        $this->db->select('*')->from('navigation');
        if (!$showempty) {
            $this->db->where('hidden != 1 AND (tstamp_start = 0 OR tstamp_start < UNIX_TIMESTAMP(NOW())) AND (tstamp_end = 0 OR tstamp_end > UNIX_TIMESTAMP(NOW())) ');
        }
        $this->db->order_by('sorting', 'ASC');

        $rows = $this->db->get()->result_array();
        $i = 0;
        foreach ($rows as &$row) {
            if (isset($data[$row['item_type']][$row['item_uid']])) {
                $navuid = $row['uid'];
                $row = $data[$row['item_type']][$row['item_uid']];
                $row['nav_uid'] = $navuid;
            } else {
                unset($rows[$i]);
            }
            ++$i;
        }

        return $rows;
    }

    public function get_sports() {
        $this->db->select('*')->from('sport')->order_by('name', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_sports_not_in_menu() {
        $this->db->select('item_uid')->from('navigation')->where('item_type', 'sport');
        $array = $this->db->get()->result_array();

        $this->db->select('*')->from('sport');
        $ids = "";
        for ($i = 1; $i <= count($array); ++$i) {
            if ($i == count($array)) {
                $ids .= $array[$i - 1]['item_uid'];
            } else {
                $ids .= $array[$i - 1]['item_uid'] . ", ";
            }
        }
        if (strlen($ids) > 0) {
            $this->db->where('uid NOT IN (' . $ids . ')');
        }
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_tournaments() {
        $this->db->select('*')->from('tournament')->order_by('name', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_tournaments_not_in_menu() {
        $this->db->select('item_uid')->from('navigation')->where('item_type', 'tournament');
        $array = $this->db->get()->result_array();
        $ids = "";

        $this->db->select('*')->from('tournament');

        for ($i = 1; $i <= count($array); ++$i) {
            if ($i == count($array)) {
                $ids .= $array[$i - 1]['item_uid'];
            } else {
                $ids .= $array[$i - 1]['item_uid'] . ", ";
            }
        }
        if (strlen($ids) > 0) {
            $this->db->where('uid NOT IN (' . $ids . ')');
        }
        $this->db->order_by('name', 'ASC');

        return $this->db->get()->result_array();
    }

    public function navigation_add_sport($id) {
        $this->db->select_max('sorting')->from('navigation');
        $row = $this->db->get()->row();

        $this->db->select('uid')->from('navigation')->where(array('item_type' => 'sport', 'item_uid' => $id));
        $qry = $this->db->get();

        if (!$qry->num_rows()) {
            $this->db->insert('navigation',
                array('item_type' => 'sport', 'item_uid' => $id, 'sorting' => $row->sorting + 1));
        }
    }

    public function navigation_add_tournament($id) {

        $this->db->select_max('sorting')->from('navigation');
        $row = $this->db->get()->row();

        $this->db->select('uid')->from('navigation')->where(array('item_type' => 'tournament', 'item_uid' => $id));
        $qry = $this->db->get();

        if (!$qry->num_rows()) {
            $this->db->insert('navigation',
                array('item_type' => 'tournament', 'item_uid' => $id, 'sorting' => $row->sorting + 1));
        }
    }

    public function remove_sport($id) {
        $this->db->where(array('item_type' => 'sport', 'item_uid' => $id));
        $this->db->delete('navigation');
    }

    public function remove_tournament($id) {
        $this->db->where(array('item_type' => 'tournament', 'item_uid' => $id));
        $this->db->delete('navigation');
    }

    public function reorder_navigation($values) {
        for ($i = 0; $i < count($values); ++$i) {
            $data[] = array('uid' => $values[$i][0], 'sorting' => $values[$i][1]);
        }

        $this->db->update_batch('navigation', $data, 'uid');

    }

    public function set_logos($value, $userid) {
        $this->db->where('setting', 'show_logos');
        $this->db->update('settings', array('value' => $value, 'backenduser_uid' => $userid));
    }

}