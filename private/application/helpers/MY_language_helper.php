<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function lang($line, $id = '') {
    $CI =& get_instance();
    $line = $CI->lang->line($line);

    $args = func_get_args();

    if (is_array($args)) {
        array_shift($args);
    }

    if (is_array($args) && count($args)) {
        foreach ($args as $arg) {
            $line = str_replace_first('%s', $arg, $line);
        }
    }

    if (!empty($id)) {
        $line = "<label for=\"{$id}\">{$line}</label>";
    }

    return $line;
}

function dblang($string, $language = false, $defaultvalue = true) {
    $CI =& get_instance();

    if (!$language) {
        $lang = $CI->lang->lang();
        $langdb = $CI->config->item('language_db');

        $language = (int)$langdb[$lang];
    }

    $cacheFile = 'localization_' . (int)$language . '_ident_' . $CI->security->sanitize_filename($string);

    if (!$res = $CI->cache->get($cacheFile)) {
        $res = $CI->db
            ->get_where('localization', array('language_uid' => $language, 'identifier' => $string), 1, 0)
            ->result();

        $CI->cache->write($res, $cacheFile, 86400);
    }

    if (count($res) > 0 && $res[0]->value != "") {
        return $res[0]->value;
    } elseif ($defaultvalue) {
        return htmlspecialchars($string);
    } else {
        return "";
    }
}

function string_trim($string, $trimLength = 40) {
    $length = strlen($string);
    if ($length > $trimLength) {
        $count = 0;
        $prevCount = 0;
        $array = explode(" ", $string);
        foreach ($array as $word) {
            $count = $count + strlen($word);
            $count = $count + 1;
            if ($count > ($trimLength - 3)) {
                $string = substr($string, 0, $prevCount) . "...";
                break;
            }
            $prevCount = $count;
        }
    }

    return $string;
}

function str_replace_first($search_for, $replace_with, $in) {
    $pos = strpos($in, $search_for);
    if ($pos === false) {
        return $in;
    } else {
        return substr($in, 0, $pos) . $replace_with . substr($in, $pos + strlen($search_for), strlen($in));
    }
}

function create_seo_block($itemtype, $uid) {
    $CI =& get_instance();
    $res = $CI->db->order_by('sorting')->get('language')->result();

    $html = '<div style="padding:20px"><div class="tabbable-custom">';

    $html .= '<ul class="nav nav-tabs">';

    for ($i = 0; $i < count($res); ++$i) {
        $html .= '<li';
        if ($i === 0) {
            $html .= ' class="active"';
        }
        $html .= '>';
        $html .= '<a href="#seotab_' . $itemtype . '_' . $uid . '_' . $res[$i]->uid . '" data-toggle="tab">';
        $html .= $res[$i]->name;
        $html .= '</a>';
        $html .= '</li>';
    }

    $html .= '</ul>';

    $html .= '<div class="tab-content">';

    for ($i = 0; $i < count($res); ++$i) {

        $CI->load->model('Seo_model', 'seo', true);
        $content = $CI->seo->get_contents($itemtype, $uid, $res[$i]->uid);

        $html .= '<div class="tab-pane ';
        if ($i === 0) {
            $html .= ' active';
        }
        $html .= '" id="seotab_' . $itemtype . '_' . $uid . '_' . $res[$i]->uid . '">';

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-md-3">Seitentitel</label>';
        $html .=
            '<div class="col-md-9"><input type="text" class="form-control" name="seo_title_' . $itemtype . '_' . $uid
            . '_' . $res[$i]->uid . '" value="' . $content['title'] . '" /></div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-md-3">Seitenkeywords</label>';
        $html .=
            '<div class="col-md-9"><input type="text" class="form-control" name="seo_keywords_' . $itemtype . '_' . $uid
            . '_' . $res[$i]->uid . '" value="' . $content['keywords'] . '" /></div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-md-3">Seitenbeschreibung</label>';
        $html .=
            '<div class="col-md-9"><input type="text" class="form-control" name="seo_description_' . $itemtype . '_'
            . $uid . '_' . $res[$i]->uid . '" value="' . $content['description'] . '" /></div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-md-3">SEO Überschrift</label>';
        $html .=
            '<div class="col-md-9"><input type="text" class="form-control" name="seo_headline_' . $itemtype . '_' . $uid
            . '_' . $res[$i]->uid . '" value="' . $content['headline'] . '" /></div>';
        $html .= '</div>';

        $html .= '<div class="form-group">';
        $html .= '<label class="control-label col-md-3">SEO Text</label>';
        $html .=
            '<div class="col-md-9"><textarea class="wysihtml5 form-control" rows="15" name="seo_text_' . $itemtype . '_'
            . $uid . '_' . $res[$i]->uid . '">' . $content['text'] . '</textarea></div>';
        $html .= '</div>';

        $html .= '</div>';
    }

    $html .= '</div></div></div>';

    return $html;
}