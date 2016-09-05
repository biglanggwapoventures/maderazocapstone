<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('creditor_type_dropdown')){
	function creditor_type_dropdown($name, $val = FALSE, $attrs = 'class="form-control"')
	{
		$CI =& get_instance();
		$CI->load->model('Creditor_type_model', 'ctype');
		$list = $CI->ctype->all();
		return form_dropdown($name, ['' => ''] + array_column($list, 'name', 'id'), $val, $attrs);
	}
}

if(!function_exists('creditor_type_exists')){
	function creditor_type_exists($id)
	{
		$CI =& get_instance();
		$CI->load->model('Creditor_type_model', 'ctype');
		return $CI->ctype->exists($id);
	}
}