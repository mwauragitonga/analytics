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
		$this->db->where('(content_type ="App Usage" OR content_type ="App+Usage")');
		$query = $this->db->get();
		$appUsageTimes = $query->result();
		$totalAppUsageTime = $this->calculateTime($appUsageTimes,'hours');

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
		//	$this->db->group_by('user_id');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function students()
	{
		$this->db->select('users.fname, users.mobile,schools.name, study_levels.level_name,SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp)))) as appMinutes,phone_type');
		$this->db->from('mobile_analysis_data');
		$this->db->join('users', 'mobile_analysis_data.user_ID = users.user_ID');
		$this->db->join("students", "users.user_ID = students.user_ID");
		$this->db->join("schools", "students.school_code = schools.school_code");
		$this->db->join("study_levels", "students.study_level = study_levels.level_code	");
		$this->db->group_by('mobile_analysis_data.user_ID');
		$this->db->where('(content_type ="Videos" OR content_type ="Ebooks")');
		$this->db->where('(start_stamp < end_stamp)');
		$this->db->limit(10);
		$this->db->order_by('appMinutes', 'DESC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function internetType()
	{
		$this->db->select('internet_type');
		$this->db->from('mobile_analysis_data');
		//$this->db->group_by('internet_type');
		$this->db->where('internet_type', 'Wi-FI');
		$query = $this->db->get();
		$wifi = $query->num_rows();

		$this->db->select('internet_type');
		$this->db->from('mobile_analysis_data');
		//	$this->db->group_by('internet_type');
		$this->db->where('internet_type', "mobile");
		$query2 = $this->db->get();
		$mobile = $query2->num_rows();

		$data = array(
			'wifi' => $wifi,
			'mobile' => $mobile
		);
		return $data;

	}

	public function Videos_Watched()
	{
		$this->db->select('mobile_analysis_data.subtopic_ID , subtopics.name, syllabus.subject ,SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp))) as watchSecs,AVG(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp))) as avgWatchSecs , COUNT(index_ID) as count');
		$this->db->from('mobile_analysis_data');
		$this->db->join('subtopics', 'subtopics.subtopicID = subtopic_ID');
		$this->db->join('syllabus', 'subtopics.topicID = syllabus.topicID');
		$this->db->group_by("subtopic_ID");
		$this->db->where('content_type', 'Videos');
		$this->db->where('(start_stamp < end_stamp)');
		$this->db->order_by('watchSecs', 'DESC');
		$data = $this->db->get()->result();

		$this->db->select('mobile_analysis_data.subtopic_ID ,multimedia_content.file_name as name, syllabus.subject ,SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp))) as watchSecs,AVG(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp))) as avgWatchSecs , COUNT(index_ID) as count');
		$this->db->from('mobile_analysis_data');
		$this->db->join('multimedia_content', 'mobile_analysis_data.subtopic_ID = multimedia_content.file_id');
		$this->db->join('subtopics', 'subtopics.subtopicID =  multimedia_content.subtopicID');
		$this->db->join('syllabus', 'subtopics.topicID = syllabus.topicID');
		$this->db->group_by("subtopic_ID");
		$this->db->where('content_type', 'Videos');
		$this->db->where('(start_stamp < end_stamp)');
		$this->db->order_by('watchSecs', 'DESC');
		$data2 = $this->db->get()->result();

		$data3 = array_merge($data,$data2);
		usort($data3, function($a, $b) {
			return $b->watchSecs <=> $a->watchSecs;
		});
		return $data3;
	}

	public function Books_Read()
	{
		$this->db->select('mobile_analysis_data.subtopic_ID, multimedia_content.file_name ,SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp))) as readSecs,AVG(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp))) as avgReadSecs, COUNT(index_ID) as count');
		$this->db->from('mobile_analysis_data');
		$this->db->join('multimedia_content', 'multimedia_content.file_id = subtopic_ID');
		$this->db->group_by("subtopic_ID");
		$this->db->where('content_type', 'Ebooks');
		$this->db->where('(start_stamp < end_stamp)');
		$this->db->order_by('readSecs', 'DESC');

		$data = $this->db->get()->result();
		//print_r($data);
		return $data;

	}

	private function calculateTime($arr_time,$format = 'mins')
	{
		$count = 0;
		$time_seconds = array();
		foreach ($arr_time as $time) {

			sscanf($time->time_elapsed, "%d:%d:%d", $hours, $minutes, $seconds);
			$timee = $hours * 3600 + $minutes * 60 + $seconds;
			if ($timee <= 0) { //checks and skips elements with no end time
				continue;
			} else {
				$time_seconds[$count] = $timee;
				$count++;
			}
		}

		$totalTime = array_sum($time_seconds); // in seconds
		if ($format == 'mins') {
			return $totalTime / 60; //in minutes
		}else if ($format == 'hours'){
			return $totalTime / 60 / 60; //in hours
		}
	}

}
