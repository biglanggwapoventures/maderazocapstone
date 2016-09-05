<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model
{

	const LOGIN = 'in';
	const LOGOUT = 'out';

	const LOGIN_TYPE_ADMIN = 'a';
	const LOGIN_TYPE_USER = 's';

	const DB_TIME_FORMAT = 'H:i:s';
	const APP_TIME_FORMAT = 'h:i A';

	protected $table = 'users';
	protected $attendanceTable = 'user_logs';
	
	function __construct()
	{
		parent::__construct();
	}

	function where($column, $val = NULL)
	{
		if(is_array($column)){
			$params = [];
			foreach ($column as $key => $value) {
				$params["u.{$key}"] = $value;
			}
			$this->db->where($params);
		}else{
			$this->db->where("u.{$column}", $val);
		}
		
		return $this;
	}

	function all()
	{
		return $this->db->select('u.*, CONCAT(u.lastname, ", ", u.firstname) AS fullname', FALSE)
			->from($this->table. ' AS u')
            ->order_by('fullname', 'DESC')
			->get()
			->result_array();
	}

	function auth($username, $password)
	{
		return $this->db->select('u.*, CONCAT(u.lastname, ", ", u.firstname) AS fullname', FALSE)
			->from($this->table.' AS u')
			->where([
				'u.login_username' => $username,
				'u.login_password' => md5($password)
			])
			->get()
			->row_array();
	}

	function get_shift($id)
	{
		$shifts = $this->db->select('login_type, am_shift_start, am_shift_end, pm_shift_start, pm_shift_end')
			->get_where($this->table, ['id' => $id])
			->row_array();

		if(!$shifts){
			return NULL;
		}

		return [
			'am_shift_start' => strtotime($shifts['am_shift_start']),
			'am_shift_end' => strtotime($shifts['am_shift_end']),
			'pm_shift_start' => strtotime($shifts['pm_shift_start']),
			'pm_shift_end' => strtotime($shifts['pm_shift_end'])
		];

		
	}

	function check_shift($id)
	{
		
		$schedule = $this->get_shift($id);
		
		if(!$schedule){
			return TRUE;
		}

		$currentTime = time();

		if($currentTime >= $schedule['am_shift_start'] && $currentTime <= $schedule['am_shift_end']){
			return TRUE;
		}

		if($currentTime >= $schedule['pm_shift_start'] && $currentTime <= $schedule['pm_shift_end']){
			return TRUE;
		}

		return FALSE;

	}

	function check_in($id)
	{
		$schedule = $this->get_shift($id);

		$logs = $this->db->select('*')
			->from($this->attendanceTable)
			->where('user_id', $id)
			->where('DATE(datetime_in) = CURDATE()')
			->get()
			->result_array();
			

		if(empty($logs)){

			$this->db->insert($this->attendanceTable, ['user_id' => $id, 'shift_type' => 'AM']);
			return $this->db->insert_id();

		}else{
			
			if(count($logs) === 1){
				$log = $logs[0];
				$now = time();
				if(($now >= $schedule['pm_shift_start'] && $now <= $schedule['pm_shift_end'])){
					$this->db->insert($this->attendanceTable, ['user_id' => $id,  'shift_type' => 'PM']);
					return $this->db->insert_id();
				}else{
					return $log['id'];
				}
			}else{
				return $logs[1]['id'];
			}

		}

	}

	function save_sales($data, $user = FALSE)
	{
		$this->db->replace('sales_inventory', $data);
	}

	function get_sales($log_id)
	{
		$data = $this->db->get_where('sales_inventory', ['log_id' => $log_id])->row_array();

		if(!$data){
			return [];
		}

		$data['data'] = json_decode($data['data'], TRUE);
		return $data;
	}

	function get_all_shifts()
	{
		return $this->db->select('CONCAT(u.firstname, " ", u.lastname) AS user, l.id, l.shift_type, DATE(l.datetime_in) AS shift_date')
			->from('user_logs AS l')
			->join('users AS u', 'u.id = l.user_id')
			->order_by('shift_date', 'DESC')
			->get()
			->result_array();
	}


}