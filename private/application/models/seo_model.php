<?php

class Seo_model extends CI_Model {

    public function backend_save($content) {

        $saveArray = array();

        foreach ($content as $key => $val) {
            if (substr($key, 0, 4) === 'seo_') {

                $key = str_replace("unique_tournament", "untn", $key);

                $keyArr = explode("_", $key);
                $saveArray[$keyArr[4]][$keyArr[1]] = $val;
                $saveArray[$keyArr[4]]['contenttype'] = $keyArr[2];
                $saveArray[$keyArr[4]]['language_uid'] = (int)$keyArr[4];
                $saveArray[$keyArr[4]]['item_uid'] = (int)$keyArr[3];

                unset($content[$key]);
            }
        }

        foreach ($saveArray as $item) {

            $item['contenttype'] = str_replace("untn", "unique_tournament", $item['contenttype']);

            $this->db->select('*')->from('seocontent')->where('contenttype', $item['contenttype'])
                ->where('item_uid', $item['item_uid'])->where('language_uid', $item['language_uid']);
            if ($row = $this->db->get()->row()) {
                $this->db->where('uid', $row->uid);
                $this->db->update('seocontent', $item);
                $this->cache->delete('seoitem_type_'.$item['contenttype'].'_uid_'.$item['item_uid'].'_lang_'.$item['language_uid']);
            } else {
                $this->db->insert('seocontent', $item);
                $this->cache->delete('seoitem_type_'.$item['contenttype'].'_uid_'.$item['item_uid'].'_lang_'.$item['language_uid']);
            }

        }

        unset($content['_wysihtml5_mode']);
        return $content;
    }

    public function get_contents($itemtype, $itemuid, $languid) {

      if ((int)$itemuid > 0) {
        if (!$row = $this->cache->get('seoitem_type_'.$itemtype.'_uid_'.$itemuid.'_lang_'.$languid)) {
          $this->db->select('*')->from('seocontent')->where('contenttype', $itemtype)->where('item_uid', $itemuid)->where('language_uid', $languid);
          if (!$row = $this->db->get()->row_array()) {
            $row = array(
              'title' => '',
              'keywords' => '',
              'description' => '',
              'headline' => '',
              'text' => ''
            );
          }
          $this->cache->write($row, 'seoitem_type_'.$itemtype.'_uid_'.$itemuid.'_lang_'.$languid, 86400);
        }
      } else {
        $row = array('title' => '', 'keywords' => '', 'description' => '', 'headline' => '', 'text' => '');
      }
      return $row;
    }

    public function sanitizeUrl($url, $maxLength = null) {
        $umlauts = array(
            'search' => array('ä', 'ö', 'ü', 'ß'),
            'replace' => array('ae', 'oe', 'ue', 'ss')
        );

        $out = $url;

        if (!empty($maxLength)) {
            $out = substr($out, 0, $maxLength);
        }

        $out = mb_strtolower(trim($out));
        $out = str_replace($umlauts['search'], $umlauts['replace'], $out);
        $out = url_title($out);

        return $out;
    }

}
