<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pump_model extends MY_Model
{

	protected $table = 'pumps';
	
	function __construct()
	{
		parent::__construct();
	}

	function all()
	{
		$this->db->select('p.*')
            ->from($this->table. ' AS p')
            ->order_by('p.name');

        $pumps =  array_column($this->db->get()->result_array(), NULL, 'id');
        
        if(!$pumps){
            return [];
        }

        $this->db->select('ft.name, pf.pump_id')
            ->from('pump_fuels AS pf')
            ->join('fuel_types AS ft', 'ft.id = pf.fuel_type_id')
            ->where_in('pf.pump_id', array_keys($pumps));

        $fuelTypes = $this->db->get()->result_array();

        foreach($fuelTypes AS $row){
            if(isset($pumps[$row['pump_id']]['fuel_types'])){
                $pumps[$row['pump_id']]['fuel_types'][] = $row['name'];
            }else{
                $pumps[$row['pump_id']]['fuel_types'] = [$row['name']];
            }
            
        }

        return $pumps;
        
	}

    function get($id)
    {
        $data = $this->db->get_where($this->table, ['id' => $id])->row_array();

        if(!$data){
            return NULL;
        }

        $data['fuel_types'] = $this->db->get_where('pump_fuels', ['pump_id' => $id])->result_array();
        
        return $data;
    }

    function create($data)
    {
        $this->db->trans_start();

        $this->db->insert($this->table, $data['pump']);

        $id = $this->db->insert_id();

        foreach($data['fuel_types'] AS &$row){
            $row['pump_id'] = $id;
        }

        $this->db->insert_batch('pump_fuels', $data['fuel_types']);

        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

}