<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('get_val')){
	function get_val($arr, $key, $fallback = NULL)
	{
		return isset($arr[$key]) ? $arr[$key] : $fallback;
	}
}

if(!function_exists('assets')){
	function assets($filename)
	{
		return base_url("assets/{$filename}");
	}
}

if(!function_exists('bower')){
	function bower($filename)
	{
		return base_url("bower_components/{$filename}");
	}
}

if(!function_exists('set_active_nav')){
	function set_active_nav($segmentName, $segmentNum = 1, $className = 'active')
	{
		$CI =& get_instance();
		$visited = $CI->uri->segment($segmentNum);
		return $visited === $segmentName ? $className : '';
	}
}
