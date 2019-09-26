<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Web_model extends CI_Model
{
	public function  getSignUps(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('registration_source', 'source_001');
		$query= $this->db->get();
		return $query->num_rows();

	}

	public function getLoginsToday(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->like('time_of_action', $date);
		$query= $this->db->get();
		return $query->num_rows();
	}
	public function getVideoViewsToday(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->where('action', 'watch_video');
		$this->db->like('date_joined', $date);
		$query= $this->db->get();
		return $query->num_rows();
	}
	public function getBookReadsToday(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->where('action', 'read_book');
		$this->db->like('date_joined', $date);
		$query= $this->db->get();
		return $query->num_rows();
	}
	public function getAttemptedPaymentsToday(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->where('action', 'initiate_payment');
		$this->db->like('date_joined', $date);
		$query= $this->db->get();
		return $query->num_rows();
	}
}
