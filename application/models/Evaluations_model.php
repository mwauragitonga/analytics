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
	public function getExamAverage(){
		$this->db->select('response_id, exam_id, user_id, AVG(score) as average');
		$this->db->from('test_respondents');
//		$this->db->where('response_status !=', NULL);
//		$this->db->where('score !=', NULL);
		$query = $this->db->get()->row();
		return $query->average;
	}
	public function getExamAttempts(){
		$this->db->select('*');
		$this->db->from('test_respondents');
		$query = $this->db->get();
		return $query->num_rows();

	}
}
