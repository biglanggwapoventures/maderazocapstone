<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	protected $table;

	function __construct()
	{
		parent::__construct();
	}

	function create($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->affected_rows() ? $this->db->insert_id() : NULL;
	}

	function update($id, $data)
	{
		return $this->db->update($this->table, $data, ['id' => $id]);
	}

	function delete($id)
	{
		$this->db->delete($this->table, ['id' => $id]);
		return $this->db->affected_rows();
	}

	function get($id)
	{
		return $this->db->get_where($this->table, ['id' => $id])->row_array();
	}

	function all()
	{
		return $this->db->get($this->table)->result_array();
	}

	function has_unique($field, $value, $excludeId = FALSE)
	{
		if($excludeId){
			$this->db->where('id !=', $excludeId);
		}
		return $this->db->get_where($this->table, [$field => $value])->num_rows() === 0;
	}

	function exists($id)
	{
		if(is_array($id)){
			$result = $this->db->select('COUNT(id) AS num', FALSE)
				->from($this->table)
				->where_in('id', $id)
				->get()
				->row_array();
			return $result ? $result['num'] == count(array_unique($id)) : FALSE;
		}
		return $this->db->get_where($this->table, ['id' => $id])->num_rows() > 0;
	}
}