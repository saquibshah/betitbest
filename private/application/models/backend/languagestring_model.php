<?php

class Languagestring_model extends CI_Model {

    var $identifier;
    var $language_uid;
    var $user_uid;
    var $value;

    public function get_strings_for_language($language_uid) {
        $this->db->where(array('language_uid' => $language_uid, 'deleted' => 0));
        $this->db->where('identifier NOT LIKE "team_%"');
        $this->db->where('identifier NOT LIKE "category_%"');
        $this->db->where('identifier NOT LIKE "%tournament_%"');
        $this->db->where('identifier NOT LIKE "sport_%"');
        $this->db->order_by("identifier", "asc");
        $query = $this->db->get('localization');
        return $query->result();
    }

    public function insert_string() {
        $errors = false;

        $vals = array(
            'identifier' => $this->input->post('identifier'),
            'value' => $this->input->post('value'),
            'language_uid' => $this->input->post('language_uid')
        );

        if (empty($vals['identifier'])) {
            $errors = true;
        }
        if (empty($vals['value'])) {
            $errors = true;
        }
        if (!$errors) {
            $this->db->where(array('identifier' => $vals['identifier'], 'language_uid' => $vals['language_uid']));
            $this->db->from('localization');
            if ($this->db->count_all_results() > 0) {
                $errors = true;
            } else {
                $this->db->insert('localization', $vals);
            }
        }
        if (!$errors) {
            return true;
        } else {
            return false;
        }
    }

    public function update_string() {
        $vals = array('value' => $this->input->post('value'));
        $this->db->where('uid', (int)$this->input->post('pk'));
        if ($vals['value'] == '') {
            $this->db->delete('localization');
        } else {
            $this->db->update('localization', $vals);
        }
    }

}