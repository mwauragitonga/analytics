<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Analytics_model extends CI_Model
{
	/*get total count of students*/
	public function getStudentsCount()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type', 1);
		$query = $this->db->get();
		return $query->num_rows();
	}

	/*get all students*/
	public function getStudents()
	{
		$this->db->select('users.user_id, users.fname, users.lname, users.email, users.user_status, students.admission_number, schools.name, study_levels.level_name');
		$this->db->from('users');
		$this->db->join('students', 'students.user_id = users.user_id', 'left');
		$this->db->join('schools', 'schools.school_code = students.school_code', 'left');
		$this->db->join('study_levels', 'study_levels.level_code = students.study_level', 'left');
		$this->db->where('user_type', 1);
		$query = $this->db->get();
		return $query->result();
	}

	/*get student details */
	public function getStudentDetails($userID)
	{
		$this->db->select('users.user_id, users.fname, users.lname, users.email, users.user_status, users.date_joined, users.prof_img, users.about_me, schools.name, study_levels.level_name');
		$this->db->from('users');
		$this->db->join('students', 'students.user_id = users.user_id', 'left');
		$this->db->join('schools', 'schools.school_code = students.school_code', 'left');
		$this->db->join('study_levels', 'study_levels.level_code = students.study_level', 'left');
		$this->db->where('users.user_id', $userID);
		$this->db->where('user_type', 1);
		$query = $this->db->get();
		return $query->row();
	}

	/*get students by gender*/
	public function getMaleStudents(){
		$this->db->select('users.user_id, users.fname, users.lname, users.email, users.user_status, users.date_joined, users.prof_img, users.about_me');
		$this->db->from('users');
		$this->db->where('gender','Male' );
		$query= $this->db->get();
		return $query->result();
	}
	public function getFemaleStudents(){
		$this->db->select('users.user_id, users.fname, users.lname, users.email, users.user_status, users.date_joined, users.prof_img, users.about_me');
		$this->db->from('users');
		$this->db->where('gender','Female' );
		$query= $this->db->get();
		return $query->result();
	}

	/*Filter students by study level*/
	public function getFormOne(){
		$this->db->select('users.user_id, users.fname, users.lname, users.email, users.user_status, users.date_joined, users.prof_img, users.about_me');
		$this->db->from('users');
		$this->db->join('students', 'students.user_id = users.user_id', 'left');
		$this->db->join('schools', 'schools.school_code = students.school_code', 'left');
		$this->db->join('study_levels', 'study_levels.level_code = students.study_level', 'left');
		$this->db->where('students.study_level', 'level_001');
		$query=$this->db->get();
		return $query->num_rows();
	}
	public function getFormTwo(){
		$this->db->select('users.user_id, users.fname, users.lname, users.email, users.user_status, users.date_joined, users.prof_img, users.about_me');
		$this->db->from('users');
		$this->db->join('students', 'students.user_id = users.user_id', 'left');
		$this->db->join('schools', 'schools.school_code = students.school_code', 'left');
		$this->db->join('study_levels', 'study_levels.level_code = students.study_level', 'left');
		$this->db->where('students.study_level', 'level_002');
		$query=$this->db->get();
		return $query->num_rows();
	}
	public function getFormThree(){
		$this->db->select('users.user_id, users.fname, users.lname, users.email, users.user_status, users.date_joined, users.prof_img, users.about_me, schools.name, study_levels.level_name');
		$this->db->from('users');
		$this->db->join('students', 'students.user_id = users.user_id', 'left');
		$this->db->join('schools', 'schools.school_code = students.school_code', 'left');
		$this->db->join('study_levels', 'study_levels.level_code = students.study_level', 'left');
		$this->db->where('students.study_level', 'level_003');
		$query=$this->db->get();
		return $query->num_rows();
	}
	public function getFormFour(){
		$this->db->select('users.user_id, users.fname, users.lname, users.email, users.user_status, users.date_joined, users.prof_img, users.about_me, schools.name, study_levels.level_name');
		$this->db->from('users');
		$this->db->join('students', 'students.user_id = users.user_id', 'left');
		$this->db->join('schools', 'schools.school_code = students.school_code', 'left');
		$this->db->join('study_levels', 'study_levels.level_code = students.study_level', 'left');
		$this->db->where('students.study_level', 'level_004');
		$query=$this->db->get();
		return $query->num_rows();
	}

	/*filter students by subscription type */
	public function getAnnualSubscriptions(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('student_subscriptions', 'student_subscriptions.user_id=users.user_id');
		$this->db->where('subscription_type', 'yearly');
		$this->db->where('status', 'active');
		$query= $this->db->get();
		return $query->num_rows();
	}
	public function getTermlySubscriptions(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('student_subscriptions', 'student_subscriptions.user_id=users.user_id');
		$this->db->where('subscription_type', 'termly');
		$this->db->where('status', 'active');
		$query= $this->db->get();
		return $query->num_rows();
	}
	public function getMonthlySubscriptions(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('student_subscriptions', 'student_subscriptions.user_id=users.user_id');
		$this->db->where('subscription_type', 'monthly');
		$this->db->where('status', 'active');
		$query= $this->db->get();
		return $query->num_rows();
	}
	public function getNonSubscribers(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('student_subscriptions', 'student_subscriptions.user_id=users.user_id');
		$this->db->where('subscription_type', 'none');
		$this->db->where('status', 'inactive');
		$query= $this->db->get();
		return $query->num_rows();
	}

	/*get active vs inactive subscribers*/
	public function getActiveSubscriptions(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('student_subscriptions', 'student_subscriptions.user_id=users.user_id');
		$this->db->where('status', 'active');
		$query= $this->db->get();
		return $query->num_rows();
	}
	public function getInactiveSubscriptions(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('student_subscriptions', 'student_subscriptions.user_id=users.user_id');
		$this->db->where('status', 'inactive');
		$query= $this->db->get();
		return $query->num_rows();
	}

	/*Filter users by date joined*/

	/* */
	/*filter multimedia content by views/reads */

	public function getVideosViews(){
		$this->db->select('*');
		$this->db->from('multimedia_content');
		$this->db->where('file_type', 'video');
		$this->db->order_by('Views', 'DESC');
		$this->db->limit(10);
		$query= $this->db->get();
		return $query->num_rows();

	}
	public function getEbooksViews(){
		$this->db->select('*');
		$this->db->from('multimedia_content');
		$this->db->where('file_type', 'slides');
		$this->db->order_by('Views', 'DESC');
		$this->db->limit(10);
		$query= $this->db->get();
		return $query->num_rows();

	}

	/*get daily sign-ups */
	public function getDailySignups(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d H:i:s');
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('date_joined', $date);
		$query= $this->db->get();

		return $query->num_rows();
	}
	
}
