<?php
class Log_model extends CI_Model {
    public function count() {
        return $this->get(false, true);
    }

    public function countFiltered($search) {
        return $this->get($search, true);
    }

    public function get($search = false, $returnNumRows = false, $start = 0, $end = 20, $sortby = "uid", $dir = "asc") {
        $this->db->from('log');

        if ($search) {
            if (!empty($search['uid'])) {
                $this->db->where('log.uid', intval($search['uid']));
            }

            if (!empty($search['level'])) {
                $this->db->where_in('log.level', $search['level']);
            }

            if (!empty($search['source'])) {
                $this->db->where('log.source LIKE', '%' . $search['source'] . '%');
            }

            if (!empty($search['message'])) {
                $this->db->where('log.message LIKE', '%' . $search['item_type'] . '%');
            }

            if (!empty($search['only_unread']) && $search['only_unread'] == 'true') {
                $this->db->where('log.is_read', 0);
            }

            if (!empty($search['item-feed_uid'])) {
              $this->db->where('feed_uid LIKE', "%" . $search['item-feed_uid'] . "%");
            }
        }

        if ($returnNumRows) {
            return $this->db->get()->num_rows();
        }

        return $this->db->order_by($sortby, $dir)
            ->limit($end, $start)
            ->get()->result();
    }

    public function getTeamByChannelId($id) {
        return $this->db->select('team_uid')
            ->from('videochannel')
            ->where('uid', $id)
            ->get()->first_row()->team_uid;
    }

    public function markRead($id) {
        return $this->db->where('uid', $id)->update('log', array('is_read' => true));
    }
}
