<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_player_name'))
{
    function get_player_name()
    {
			$CI =& get_instance();
			$user = $CI->ion_auth->user()->row();
			
			if($user) {
				return $user->first_name . " " . $user->last_name;
			} else {
				return "";
			}
    }
		
		function player_logged_in()
		{
			$CI =& get_instance();
			if($CI->ion_auth->in_group(4)) {
				return true;
			} else {
				return false;
			}			
		}
		
		function user_menu_active($menu, $lvl)
		{
			$CI =& get_instance();
			$CI->load->helper('url');
			
			if($CI->uri->segment(2+$lvl)==$menu || ($CI->uri->segment(2+$lvl)=='' && $menu=='index')) {
				return ' class="active" ';
			} else {
				return '';
			}
							
		}
}