<?php
/*Designed and written by Cyrus Muchiri <cmuchiri8429@gmail.com>*/
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class AppModel extends CI_Model
{
	function __construct()
	{
	}

	public function book_Minutes_Read()
	{
		$this->db->select('TIMEDIFF(end_stamp,start_stamp) as time_elapsed');
		$this->db->from('mobile_analysis_data');
		$this->db->where('content_type', 'Ebooks');
		$query = $this->db->get();
		$readTimes = $query->result();
		$totalReadTime = $this->calculateTime($readTimes);
		return round($totalReadTime, 2);

	}

	public function video_Minutes_Watched()
	{
		$this->db->select('TIMEDIFF(end_stamp,start_stamp) as time_elapsed');
		$this->db->from('mobile_analysis_data');
		$this->db->where('content_type', 'Videos');
		$query = $this->db->get();
		$watchTimes = $query->result();
		$totalWatchTime = $this->calculateTime($watchTimes);
		return round($totalWatchTime, 2);
	}

	public function app_Usage_Minutes()
	{
		$this->db->select('TIMEDIFF(end_stamp,start_stamp) as time_elapsed');
		$this->db->from('mobile_analysis_data');
		$this->db->where('content_type', 'App Usage');
		$query = $this->db->get();
		$appUsageTimes = $query->result();
		$totalAppUsageTime = $this->calculateTime($appUsageTimes);

		return round($totalAppUsageTime, 2);
	}

	public function total_Watchers()
	{
		$this->db->select('*');
		$this->db->from('mobile_analysis_data');
		$this->db->where('content_type', 'Videos');
		$this->db->group_by('user_id');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function total_Readers()
	{
		$this->db->select('*');
		$this->db->from('mobile_analysis_data');
		$this->db->where('content_type', 'Ebooks');
		$this->db->group_by('user_id');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function signIns()
	{
		$this->db->select('*');
		$this->db->from('mobile_analysis_data');
		$this->db->where('content_type', 'Signin');
		$this->db->group_by('user_id');
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function students(){
		$this->db->select('users.fname, users.mobile,schools.name, study_levels.level_name');
		$this->db->from('mobile_analysis_data');
		$this->db->join('users','mobile_analysis_data.user_ID = users.user_ID');
		$this->db->join("students", "users.user_ID = students.user_ID");
		$this->db->join("schools","students.school_code = schools.school_code");
		$this->db->join("study_levels", "students.study_level = study_levels.level_code	");
		$this->db->group_by('mobile_analysis_data.user_ID');
		$query = $this->db->get()->result();
		return $query;
	}
	public function internetType(){
		$this->db->select('internet_type');
		$this->db->from('mobile_analysis_data');
		$this->db->group_by('internet_type');
		$query = $this->db->get();
		$internetType =$query->result();

	}

	private function calculateTime($arr_time)
	{
		$count = 0;
		$time_seconds = array();
		foreach ($arr_time as $time) {

			sscanf($time->time_elapsed, "%d:%d:%d", $hours, $minutes, $seconds);
			$timee = $hours * 3600 + $minutes * 60 + $seconds;
			if ($timee <= 0) { //checks and skips elements with no end time
				continue;
			} else {
				$time_seconds[$count] =$timee;
					$count++;
			}
		}

		$totalTime = array_sum($time_seconds); // in seconds
		return $totalTime / 60; //in minutes
	}

}
