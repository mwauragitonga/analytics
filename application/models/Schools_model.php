<?php
/*@cyrus Muchiri*/


class Schools_model extends CI_Model
{
	function __construct()
	{
	}

	function usage()
	{
		$this->db->select('schools.name,schools.school_code as code,
		SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp)))) as appMinutes , count(DISTINCT(mobile_analysis_data.user_ID)) as count');
		$this->db->from('mobile_analysis_data');
		$this->db->join('users', 'mobile_analysis_data.user_ID = users.user_ID');
		$this->db->join("students", "users.user_ID = students.user_ID");
		$this->db->join("schools", "students.school_code = schools.school_code");
		$this->db->group_by('schools.name');
		$this->db->order_by('appMinutes','DESC');
		$this->db->where('(content_type ="Videos" OR content_type ="Ebooks")');
		$this->db->where('(start_stamp < end_stamp)');
		$usage = $this->db->get()->result();
		return $usage;
	}

	function students($school_code = "school_032")
	{
		$this->db->select('users.fname,SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp)))) as appMinutes');
		$this->db->from('mobile_analysis_data');
		$this->db->join('users','mobile_analysis_data.user_ID = users.user_ID');
		$this->db->join("students", "users.user_ID = students.user_ID");
	//	$this->db->join("schools", "schools.school_code = students.school_code");
		$this->db->where('students.school_code',$school_code);
		$this->db->group_by('mobile_analysis_data.user_ID');
		$this->db->where('(content_type ="Videos" OR content_type ="Ebooks")');
		$this->db->where('(start_stamp < end_stamp)');
		$students = $this->db->get()->result();
		return $students;
	}
	function getSchoolName($code){
		$this->db->select('schools.name');
		$this->db->from('schools');
		$this->db->where('schools.school_code',$code);

		$school = $this->db->get()->row();
		return $school;
	}
	function students_schools($code = 'school_033'){
		$this->db->select('users.fname,study_levels.level_name,');
		$this->db->from('users');
		$this->db->join('students','students.user_ID = users.user_ID');
		$this->db->join('study_levels','study_levels.level_code = students.study_level');
		$this->db->join('schools','students.school_code = schools.school_code');
		$this->db->where('schools.school_code',$code);

		$student = $this->db->get()->result();
		print_r($student);
	}

	function distribution()
	{
		$this->db->select();
		$this->db->from();
		$this->db->join();
		$this->db->from();
		$this->db->where();

		$student = $this->db->get()->result();
	}

}
