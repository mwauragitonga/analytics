<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Evaluations_model extends CI_Model
{

	public function getExams(){
		$this->db->select('*');
		$this->db->from('exams');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getExamAttemptsToday(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('test_respondents');
		$this->db->like('time_submitted', $date);
		$query = $this->db->get();
		return $query->num_rows();

	}
	public function getAttemptsToday(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('exams.exam_id, exam_name, subject,  response_id, test_respondents.exam_id, test_respondents.user_id, time_submitted, response_status, percentage_score, users.fname, lname, online_status, last_seen , mobile, email, hash, username, password, gender,
		 user_type, user_status, study_levels.level_name,schools.name as school_name,');
		$this->db->from('test_respondents');
		$this->db->join("users","test_respondents.user_id = users.user_id");
		$this->db->join("students","test_respondents.user_id = students.user_id");
		$this->db->join("schools","students.school_code = schools.school_code");
		$this->db->join("study_levels","students.study_level = study_levels.level_code");
		$this->db->join("exams","test_respondents.exam_id = exams.exam_id");
		$this->db->like('time_submitted', $date);
		$query = $this->db->get();
		return $query->result();

	}
	public function getAllAttempts(){
		$this->db->select('exams.exam_id , exam_name, subject,  response_id, test_respondents.exam_id, test_respondents.user_id, time_submitted, response_status, percentage_score, users.fname, lname, online_status, last_seen , mobile, email, hash, username, password, gender,
		 user_type, user_status, study_levels.level_name,schools.name as school_name,');
		$this->db->from('test_respondents');
		$this->db->join("users","test_respondents.user_id = users.user_id");
		$this->db->join("students","test_respondents.user_id = students.user_id");
		$this->db->join("schools","students.school_code = schools.school_code");
		$this->db->join("study_levels","students.study_level = study_levels.level_code");
		$this->db->join("exams","test_respondents.exam_id = exams.exam_id");
		$query = $this->db->get();
		return $query->result();

	}
	public function getExamAverage(){
			$this->db->select('response_id, exam_id, user_id, AVG(percentage_score) as average');
		$this->db->from('test_respondents');
//		$this->db->where('response_status !=', NULL);
		$this->db->where('percentage_score !=', 0);
		$query = $this->db->get()->row();

		return $query->average;
	}
	public function getExamAttempts(){
		$this->db->select('*');
		$this->db->from('test_respondents');
		$query = $this->db->get();
		return $query->num_rows();

	}
	public function getTopExams(){
		$this->db->select(' test_respondents.response_id, test_respondents.exam_id,exams.exam_id, exams.exam_name, test_respondents.user_id, COUNT(response_id) as count');
		$this->db->from('test_respondents');
		$this->db->join('exams', 'exams.exam_id = test_respondents.exam_id');
		$this->db->group_by('test_respondents.exam_id');
		$this->db->order_by('COUNT(response_id)', 'DESC');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}
	public function getTopStudents(){
		$this->db->select('users.user_id, users.fname, users.lname,  test_respondents.response_id, test_respondents.exam_id,exams.exam_id, exams.exam_name, test_respondents.user_id, COUNT(test_respondents.response_id) as count');
		$this->db->from('test_respondents');
		$this->db->join('exams', 'exams.exam_id = test_respondents.exam_id');
		$this->db->join('users', 'users.user_id = test_respondents.user_id');
		$this->db->group_by('test_respondents.user_id');
		//$this->db->distinct();
		$this->db->order_by('COUNT(test_respondents.response_id)', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}
}
