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
		//$this->db->join('users','users.user_id=web_actions_logs.id');
		//$this->db->where('users.registration_source', 'source_001');
		$this->db->like('time_of_action', $date);
		$this->db->where('(action = "registration")');
		$query= $this->db->get();
		return $query->num_rows();

	}

	public function getLoginsToday(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->like('time_of_action', $date);
		$this->db->where('(action = "login")');
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
		$this->db->where('(action = "initiate_payment" OR action ="proceedToPayment")');
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

	public function getVideoViewers(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('COUNT(id)  as views, web_actions_logs.user_id , users.fname, lname, online_status, last_seen , mobile, email, hash, username, password, gender, user_type, user_status, study_levels.level_name,schools.name as school_name, student_subscriptions.status ,users.user_status as userstatus');
		$this->db->from('web_actions_logs');
		$this->db->join("users","web_actions_logs.user_id = users.user_id");
		$this->db->join("students","web_actions_logs.user_id = students.user_id");
		$this->db->join("schools","students.school_code = schools.school_code");
		$this->db->join("study_levels","students.study_level = study_levels.level_code");
		$this->db->join("student_subscriptions","web_actions_logs.user_id = student_subscriptions.user_id");
		$this->db->where('(action = "watch_video" OR action ="free_video")');
		$this->db->where('web_actions_logs.user_id !=', NULL);
		$this->db->group_by('user_id');
		$this->db->like('time_of_action', $date);
		$query= $this->db->get();
		return $query->result();
	}
	public function getbookReaders(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('COUNT(id)  as views , web_actions_logs.user_id , users.fname, lname, online_status, last_seen , mobile, email, hash, username, password, gender, user_type, user_status, study_levels.level_name,schools.name as school_name, student_subscriptions.status ,users.user_status as userstatus');
		$this->db->from('web_actions_logs');
		$this->db->join("users","web_actions_logs.user_id = users.user_id");
		$this->db->join("students","web_actions_logs.user_id = students.user_id");
		$this->db->join("schools","students.school_code = schools.school_code");
		$this->db->join("study_levels","students.study_level = study_levels.level_code");
		$this->db->join("student_subscriptions","web_actions_logs.user_id = student_subscriptions.user_id");
		$this->db->where('(action = "read_book" OR action ="readFreeBook")');
		$this->db->where('web_actions_logs.user_id !=', NULL);
		$this->db->group_by('user_id');
		$this->db->like('time_of_action', $date);
		$query= $this->db->get();
		return $query->result();
	}
	public function getPayments(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');

		$this->db->select('mpesa_callbacks.email, mpesa_callbacks.mobile, mpesa_callbacks.amount, mpesa_callbacks.transaction_ID, action , web_actions_logs.user_id ,web_actions_logs.time_of_action as time ,  
		 users.fname, lname,, last_seen , users.mobile, users.email, gender, user_type,  study_levels.level_name,schools.name as school_name');
		$this->db->from('web_actions_logs');
		$this->db->join("users","web_actions_logs.user_id = users.user_id");
		$this->db->join("students","users.user_id = students.user_id");
		$this->db->join("schools","students.school_code = schools.school_code");
		$this->db->join("mpesa_callbacks","users.email = mpesa_callbacks.email");
		$this->db->join("study_levels","students.study_level = study_levels.level_code");
		$this->db->join("student_subscriptions","users.user_id = student_subscriptions.user_id");
		$this->db->where('(action = "initiate_payment" OR action ="proceedToPayment") ');
		$this->db->where('web_actions_logs.user_id !=', 0);
		$this->db->group_by('id');
		$this->db->like('time_of_action', $date);
		$query= $this->db->get();
		return $query->result();
	}
}
