<?php

/**
 * Class Language_model
 * @property Languagestring_model $Languagestring
 */
class Language_model extends CI_Model {

    var $active;
    var $deleted;
    var $flag;
    var $name;
    var $sorting;
    var $uid;

    function __construct() {
        parent::__construct();
        $this->load->model('backend/Languagestring_model', 'Languagestring', true);
    }

    public function activate($uid) {
        $this->db->where('uid', $uid);
        $this->db->update('language', array('active' => 1));
    }

    public function deactivate($uid) {
        $this->db->where('uid', $uid);
        $this->db->update('language', array('active' => 0));
    }

    public function get_language_strings($uid) {
        return $this->Languagestring->get_strings_for_language($uid);
    }

    public function get_languages() {
        $this->db->order_by('sorting');
        $query = $this->db->get_where('language', array('deleted' => 0));
        return $query->result();
    }

    public function insert_or_update_string($identifier, $value, $language, $user = 0) {
        if (strlen($value) > 0) {
            $query = $this->db->select('uid')->from('localization')->where('identifier', $identifier)
                ->where('language_uid', $language)->limit(1)->get();
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
                $id = $result['uid'];
                $updateArray = array('value' => $value);
                $this->db->where('uid', $id);
                $this->db->update('localization', $updateArray);
            } else {
                $insertArray = array('identifier' => $identifier, 'value' => $value, 'language_uid' => $language,
                    'user_uid' => $user);
                $this->db->insert('localization', $insertArray);
            }
        }

    }

    public function insert_value() {
        if ($this->Languagestring->insert_string()) {
            return true;
        } else {
            return false;
        }
    }

    public function reorder($values) {
        for ($i = 0; $i < count($values); ++$i) {
            $data[] = array('uid' => $values[$i][0], 'sorting' => $values[$i][1]);
        }

        $this->db->update_batch('language', $data, 'uid');
    }

    public function update_language() {
        $vals = array('name' => $this->input->post('value'));
        $this->db->where('uid', (int)$this->input->post('pk'));
        if ($vals['name'] == '') {
            $this->db->delete('language');
        } else {
            $this->db->update('language', $vals);
        }
    }

    public function update_value() {
        $this->Languagestring->update_string();
    }

}