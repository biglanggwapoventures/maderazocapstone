<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Creditor_model extends MY_Model
{

	protected $table = 'creditors';
	
	function __construct()
	{
		parent::__construct();
	}

	function all()
	{
		return $this->db->select('c.id, c.name, ct.name AS type')
			->from($this->table. ' AS c')
			->join('creditor_types AS ct', 'ct.id = c.creditor_type_id')
			->order_by('name')
			->get()
			->result_array();
	}

}