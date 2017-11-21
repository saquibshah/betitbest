<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

// Originaly CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
// modification by Yeb Reitsma

class MY_Lang extends CI_Lang {
  private $lang_code;

  private $languages = array(
    "de" => "german",
    "en" => "english"
  );

  private $special = array(
    'backend'
  );

  private $uri;

  function MY_Lang() {
    parent::__construct();

    global $CFG;
    global $URI;
    global $RTR;

    $this->uri = $URI->uri_string();
    
    $this->redirectToGetFile($this->uri);
    $this->uri = str_replace('livescores', '', $this->uri);
    $this->uri = str_replace('livescores/', '', $this->uri);
    $this->uri = str_replace('sportsnews', '', $this->uri);
    $this->uri = str_replace('sportsnews/', '', $this->uri);
    
    $this->default_uri = $RTR->default_controller;
    $uri_segment = $this->get_uri_lang($this->uri);
    $this->lang_code = $uri_segment['lang'];

    $url_ok = false;
    if ((!empty($this->lang_code)) && (array_key_exists($this->lang_code, $this->languages))) {
      $language = $this->languages[$this->lang_code];
      $CFG->set_item('language', $language);
      if ($uri_segment !== false) {
        $url_ok = true;
      }

      if ($this->uri == $uri_segment['lang']) {
        $this->uri = '';
      }
    }

    if (PHP_SAPI != 'cli' && !$url_ok && (!$this->is_special($uri_segment['parts'][0]))) {
      $CFG->set_item('language', $this->languages[$this->default_lang()]);
      $uri = (!empty($this->uri)) ? $this->uri : '';
      $index_url = empty($CFG->config['index_page']) ? '' : $CFG->config['index_page'] . "/";

      $new_url = "{$CFG->config['base_url']}{$index_url}{$this->default_lang()}/{$uri}";

      header("Location: {$new_url}", true, 301);
      exit;
    }
  }
  
  function redirectToGetFile($uri){
    $old = $uri;
    $uri = str_replace('livescores/en/assets', 'assets', $uri);
    $uri = str_replace('livescores/de/assets', 'assets', $uri);
    $uri = str_replace('sportsnews/de/assets', 'assets', $uri);
    $uri = str_replace('sportsnews/en/assets', 'assets', $uri);
    $uri = str_replace('livescores/en/pool', 'pool', $uri);
    $uri = str_replace('livescores/de/pool', 'pool', $uri);
    $uri = str_replace('sportsnews/de/pool', 'pool', $uri);
    $uri = str_replace('sportsnews/en/pool', 'pool', $uri);
    $uri = str_replace('livescores/assets', 'assets', $uri);
    $uri = str_replace('livescores/assets', 'assets', $uri);
    $uri = str_replace('sportsnews/assets', 'assets', $uri);
    $uri = str_replace('sportsnews/assets', 'assets', $uri);
    $uri = str_replace('livescores/pool', 'pool', $uri);
    $uri = str_replace('livescores/pool', 'pool', $uri);
    $uri = str_replace('sportsnews/pool', 'pool', $uri);
    $uri = str_replace('sportsnews/pool', 'pool', $uri);
    if ($uri !== $old) {
        header("Location: https://{$_SERVER['HTTP_HOST']}/{$uri}");
        exit;
    }
  }

  function get_uri_lang($uri = '') {
    if (!empty($uri)) {
      $uri = ($uri[0] == '/') ? substr($uri, 1) : $uri;

      $uri_expl = explode('/', $uri, 2);
      $uri_segment['lang'] = null;
      $uri_segment['parts'] = $uri_expl;

      if (array_key_exists($uri_expl[0], $this->languages)) {
        $uri_segment['lang'] = $uri_expl[0];
      }

      return $uri_segment;
    } else {
      return false;
    }
  }

  function is_special($lang_code) {
    if ((!empty($lang_code)) && (in_array($lang_code, $this->special))) {
      return true;
    } else {
      return false;
    }
  }

  function default_lang() {
    $browser_lang =
      !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';
    $browser_lang = substr($browser_lang, 0, 2);
    if (!empty($browser_lang) && array_key_exists($browser_lang, $this->languages)) {
      return $browser_lang;
    } else {
      reset($this->languages);

      return key($this->languages);
    }
  }

  public function getLocalized($identifier, $default) {
    $localization = dblang($identifier);

    if ($localization == $identifier) {
      return $default;
    }

    return $localization;
  }

  function load($langfile = '', $idiom = '', $return = false, $add_suffix = true, $alt_path = '',
    $load_first_lang = false) {
    if ($load_first_lang) {
      reset($this->languages);
      $firstKey = key($this->languages);
      $firstValue = $this->languages[$firstKey];

      if ($this->lang_code != $firstKey) {
        $addedLang = parent::load($langfile, $firstValue, $return, $add_suffix, $alt_path);
        if ($addedLang) {
          if ($add_suffix) {
            $langfileToRemove = str_replace('.php', '', $langfile);
            $langfileToRemove = str_replace('_lang.', '', $langfileToRemove) . '_lang';
            $langfileToRemove .= '.php';
          }
          $this->is_loaded = array_diff($this->is_loaded, array($langfileToRemove));
        }
      }
    }

    return parent::load($langfile, $idiom, $return, $add_suffix, $alt_path);
  }

  function localized($uri) {
    if (!empty($uri)) {
      $uri_segment = $this->get_uri_lang($uri);
      if (!$uri_segment['lang']) {

        if ((!$this->is_special($uri_segment['parts'][0]))
          && (!preg_match('/(.+)\.[a-zA-Z0-9]{2,4}$/', $uri))
        ) {
          $uri = $this->lang() . '/' . $uri;
        }
      }
    }

    return $uri;
  }

  function lang() {
    global $CFG;
    $language = $CFG->item('language');

    $lang = array_search($language, $this->languages);
    if ($lang) {
      return $lang;
    }

    return null;    // this should not happen
  }

  function switch_uri($lang) {
    if ((!empty($this->uri)) && (array_key_exists($lang, $this->languages))) {

      if ($uri_segment = $this->get_uri_lang($this->uri)) {
        $uri_segment['parts'][0] = $lang;
        $uri = implode('/', $uri_segment['parts']);
      } else {
        $uri = $lang . '/' . $this->uri;
      }
    }

    return $uri;
  }
}