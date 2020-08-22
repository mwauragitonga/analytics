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
		SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp))) as appMinutes , count(DISTINCT(mobile_analysis_data.user_ID)) as count');
		$this->db->from('mobile_analysis_data');
		$this->db->join('users', 'mobile_analysis_data.user_ID = users.user_ID');
		$this->db->join("students", "users.user_ID = students.user_ID");
		$this->db->join("schools", "students.school_code = schools.school_code");
		$this->db->group_by('schools.name');
		$this->db->order_by('appMinutes','DESC');
		$this->db->where('(content_type ="Videos" OR content_type ="Ebooks")');
		$this->db->where('(start_stamp < end_stamp)');
		$this->db->where('schools.name !=', 'Dawati Academy');
		$this->db->where('schools.name !=', ' BIRITHIA SECONDARY SCHOOL ');
		$this->db->where('schools.school_code !=', 'school_002');
		$usages = $this->db->get()->result();
		/*foreach ($usages as $usage) {
			if ($usage->appMinutes > 2045) {
				$usage->appMinutes = 2045;
			}
		}
		usort($data, function($a, $b) {
			return $b->avgReadSecs*$b->count <=> $a->avgReadSecs*$a->count;
		});*/
		return $usages;
	}

	function students($school_code = "school_032")
	{
		$this->db->select('users.fname,SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp)))) as appMinutes,users.user_ID');
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
	function total_schools(){
		$this->db->select('count(indexID) as count');
		$this->db->from('schools');

		$school_count = $this->db->get()->row()->count;
		return $school_count;
	}
	function registered_schools(){
		$this->db->select('count(users.user_ID) as count');
		$this->db->from('users');
		$this->db->join('students','users.user_ID = students.user_ID');
		$this->db->join('schools','schools.school_code = students.school_code');
		$this->db->group_by("students.school_code");
		$this->db->order_by("count",'DESC');
		$count = $this->db->get()->num_rows();
		return $count;
	}
	function top_schools_Content(){
		$top_schools = $this->usage();
		$top_school = array();
		for($i =0;$i<1;$i++){
			$top_school['appMinutes'] = $top_schools[0]->appMinutes;
			$top_school['name'] = $top_schools[0]->name;
			if($top_school['name'] == "Dawati Academy"){
				$top_school['appMinutes'] = $top_schools[1]->appMinutes;
				$top_school['name'] = $top_schools[1]->name;			}
		}
		return $top_school;
	}
	function schools_students(){
		$this->db->select('schools.name,count(users.user_ID) as count,students.school_code');
		$this->db->from('users');
		$this->db->join('students','users.user_ID = students.user_ID');
		$this->db->join('schools','schools.school_code = students.school_code');
		$this->db->where('schools.name !=', 'Dawati Academy');
		$this->db->where('schools.name !=', ' BIRITHIA SECONDARY SCHOOL ');
		$this->db->group_by("students.school_code");
		$this->db->order_by("count",'DESC');

		//$this->db->limit(10);

		$schools_students = $this->db->get()->result();
		return $schools_students;
	}
	function top_School_Registered_Students(){
		$top_Schools = $this->schools_students();
		$top_school =array();
		for($i =0;$i<1;$i++){
			$top_school['name'] = $top_Schools[0]->name;
			$top_school['count'] = $top_Schools[0]->count;
			if($top_school['name'] == "Dawati Academy"){
				$top_school['name'] = $top_Schools[1]->name;
				$top_school['count'] = $top_Schools[1]->count;
			}
		}

		return $top_school;
	}
	function users($code){
		$this->db->select('users.fname,users.lname,users.date_joined,study_levels.level_name');
		$this->db->from('users');
		$this->db->join("students", "users.user_ID = students.user_ID");
		//$this->db->join("schools", "schools.school_code = students.school_code");
		$this->db->join('study_levels','study_levels.level_code = students.study_level');
		$this->db->where('students.school_code',$code);
		$this->db->order_by('date_joined','DESC');

		$students = $this->db->get()->result();
		return $students;
	}

}
