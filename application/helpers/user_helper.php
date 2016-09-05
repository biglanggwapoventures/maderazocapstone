<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('user')){
	function user($prop = NULL, $val = FALSE)
	{
		$CI =& get_instance();
		$user =  $CI->session->userdata($prop);
		return $val ? $user === $val : $user;
	}
}

if(!function_exists('login_type_description')){
	function login_type_description($type)
	{
		switch ($type) {
			case 'a':
				return 'ADMIN';
			case 's':
				return 'STANDARD USER';
		}
	}
}