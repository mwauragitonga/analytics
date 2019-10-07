<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Web_model extends CI_Model
{
	public function  getSignUps(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->join('users','users.user_id=web_actions_logs.id');
		$this->db->where('registration_source', 'source_001');
		$this->db->like('time_of_action', $date);
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
		$this->db->where('(action = "watch_video" OR action ="free_video")');
		$this->db->like('time_of_action', $date);
		$query= $this->db->get();
		return $query->num_rows();
	}
	public function getBookReadsToday(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->where('action', 'read_book');
		$this->db->like('time_of_action', $date);
		$query= $this->db->get();
		return $query->num_rows();
	}
	public function getAttemptedPaymentsToday(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->where('action', 'initiate_payment');
		$this->db->like('time_of_action', $date);
		$query= $this->db->get();
		return $query->num_rows();
	}

	public function users_By_Day($instance_day){

			$this->db->select("COUNT(id) as users");
			$this->db->from("web_actions_logs");
			$this->db->where("action","login");
			$this->db->like('time_of_action',$instance_day);
			$query = $this->db->get()->row();
			//var_dump($instance_day);
			return $query->users;

		}
	public function signups_By_Day($instance_day){

		$this->db->select("COUNT(id) as users");
		$this->db->from("web_actions_logs");
		$this->db->where("action","registration");
		$this->db->like('time_of_action',$instance_day);
		$query = $this->db->get()->row();
		return $query->users;

	}
}
