<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('fuel_type_dropdown')){
	function fuel_type_dropdown($name, $val = FALSE, $attrs = 'class="form-control"')
	{
		$CI =& get_instance();
		$CI->load->model('Fuel_type_model', 'ftype');
		$list = $CI->ftype->all();
		return form_dropdown($name, ['' => ''] + array_column($list, 'name', 'id'), $val, $attrs);
	}
}

if(!function_exists('fuel_type_exists')){
	function fuel_type_exists($id)
	{
		$CI =& get_instance();
		$CI->load->model('Fuel_type_model', 'ftype');
		return $CI->ftype->exists($id);
	}
}