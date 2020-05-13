<?php
/*@cyrus Muchiri*/


class Search_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}
	function search($phrase){
		$this->db->select("fname , mobile, email, gender , study_levels.level_name,schools.name as school_name, student_subscriptions.status,code ,users.user_status as userstatus");
		$this->db->from("users");
		$this->db->join("students","users.user_id = students.user_id");
		$this->db->join("schools","students.school_code = schools.school_code");
		$this->db->join("study_levels","students.study_level = study_levels.level_code");
		$this->db->join("student_subscriptions","users.user_id = student_subscriptions.user_id");
		//$this->db->join('user_registration_source', 'users.registration_source = user_registration_source.source_code');
		$emailRegex = '^[_a-z0-9-]+(.[a-z0-9-]+)@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})^';
		if (preg_match($emailRegex, $phrase)) {
			$this->db->where('users.email', $phrase);
		}else{
			$this->db->where('users.mobile', $phrase);
		}
		$student = $this->db->get()->row();
		return $student;
	}
}