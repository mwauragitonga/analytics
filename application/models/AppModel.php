<?php
/*Designed and written by Cyrus Muchiri <cmuchiri8429@gmail.com>*/
if ( ! defined('BASEPATH'))
	exit('No direct script access allowed');

class AppModel extends CI_Model {
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
		$totalAppUsageTime = $this->calculateTime($appUsageTimes, 'hours', 'APPUSAGE');

		return round($totalAppUsageTime, 2);
	}

	public function total_Watchers()
	{
		$this->db->select('*');
		$this->db->from('mobile_analysis_data');
		$this->db->join('users', 'mobile_analysis_data.user_ID = users.user_ID');
		$this->db->where('content_type', 'Videos');
		$this->db->group_by('mobile_analysis_data.user_id');
		//$this->db->where('(start_stamp <= end_stamp)');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function total_Readers()
	{
		$this->db->select('*');
		$this->db->from('mobile_analysis_data');
		$this->db->join('users', 'mobile_analysis_data.user_ID = users.user_ID');
		$this->db->where('content_type', 'Ebooks');
		//$this->db->where('(start_stamp <= end_stamp)');
		$this->db->group_by('users.user_id');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function signIns($mode = 'unique')
	{
		$this->db->select('*');
		$this->db->from('mobile_analysis_data');
		$this->db->where('content_type', 'Signin');
		if ($mode == 'unique')
		{
			$this->db->group_by('user_id');
		}
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function users_signIns()
	{
		$this->db->select('users.fname,mobile_analysis_data.start_stamp');
		$this->db->from('mobile_analysis_data');
		$this->db->join('users', ',mobile_analysis_data.user_id = users.user_id');
		$this->db->where('content_type', 'Signin');
		$this->db->group_by('mobile_analysis_data.user_id');
		$this->db->order_by('start_stamp', 'DESC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function students()
	{
		$this->db->select('users.fname,users.user_id, users.mobile,schools.name, study_levels.level_name,
		SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp)))) as appMinutes,phone_type');
		$this->db->from('mobile_analysis_data');
		$this->db->join('users', 'mobile_analysis_data.user_ID = users.user_ID');
		$this->db->join("students", "users.user_ID = students.user_ID");
		$this->db->join("schools", "students.school_code = schools.school_code");
		$this->db->join("study_levels", "students.study_level = study_levels.level_code	");
		$this->db->group_by('mobile_analysis_data.user_ID');
		$this->db->where('(content_type ="Videos" OR content_type ="Ebooks")');
		$this->db->where('(start_stamp < end_stamp)');
		//	$this->db->limit(10);
		$this->db->order_by('appMinutes', 'DESC');

		$query = $this->db->get()->result();

		return $query;
	}

	public function internetType()
	{
		$this->db->select('internet_type');
		$this->db->from('mobile_analysis_data');
		$this->db->group_by('user_id');
		$this->db->where('internet_type', 'Wi-FI');
		$query = $this->db->get();
		$wifi = $query->num_rows();

		$this->db->select('internet_type');
		$this->db->from('mobile_analysis_data');
		$this->db->group_by('user_id');
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
		//$this->db->order_by('(avgWatchSecs*count)', 'DESC');
		$data = $this->db->get()->result();
		foreach ($data as $dat)
		{
			if ($dat->avgWatchSecs > VIDEOCAP)
			{
				$dat->avgWatchSecs = VIDEOCAP;
			}
		}
		$this->db->select('mobile_analysis_data.subtopic_ID ,multimedia_content.file_name as name, syllabus.subject ,SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp))) as watchSecs,AVG(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp))) as avgWatchSecs , COUNT(index_ID) as count');
		$this->db->from('mobile_analysis_data');
		$this->db->join('multimedia_content', 'mobile_analysis_data.subtopic_ID = multimedia_content.file_id');
		$this->db->join('subtopics', 'subtopics.subtopicID =  multimedia_content.subtopicID');
		$this->db->join('syllabus', 'subtopics.topicID = syllabus.topicID');
		$this->db->group_by("subtopic_ID");
		$this->db->where('content_type', 'Videos');
		$this->db->where('(start_stamp < end_stamp)');
		//$this->db->order_by('watchSecs', 'DESC');
		$data2 = $this->db->get()->result();
		foreach ($data2 as $dat2)
		{
			if ($dat2->avgWatchSecs > VIDEOCAP)
			{
				$dat2->avgWatchSecs = VIDEOCAP;
			}
		}
		$data3 = array_merge($data, $data2);
		usort($data3, function ($a, $b) {
			return $b->avgWatchSecs * $b->count <=> $a->avgWatchSecs * $a->count;
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
		foreach ($data as $dat)
		{
			if ($dat->avgReadSecs > VIDEOCAP)
			{
				$dat->avgReadSecs = VIDEOCAP;
			}
		}
		usort($data, function ($a, $b) {
			return $b->avgReadSecs * $b->count <=> $a->avgReadSecs * $a->count;
		});
		//print_r($data);
		return $data;

	}

	function userStudyInfo($user_id, $period = '')
	{
		$this->db->select("SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp)))) as readSecs,AVG(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp))) as avgReadSecs,multimedia_content.file_name,count(index_ID) as count");
		$this->db->from("mobile_analysis_data");
		$this->db->join('users', "users.user_id=mobile_analysis_data.user_id");
		$this->db->join('multimedia_content', 'subtopic_ID = multimedia_content.file_id');
		$this->db->where('mobile_analysis_data.content_type', "Ebooks");
		$this->db->where('mobile_analysis_data.user_id', $user_id);
		$this->db->where('(start_stamp < end_stamp)');
		if ( ! empty($period))
		{
			$today = date('Y-m-d', time());
			$usageStartDate = date('Y-m-d', strtotime($today . ' - 30  days'));
			$this->db->where('start_stamp >', $usageStartDate);
		}
		$this->db->group_by('subtopic_ID');
		$this->db->order_by('readSecs');
		$data_ebooks = $this->db->get()->result();
		//print_r($data_ebooks);
		foreach ($data_ebooks as $data_ebook)
		{
			if ($data_ebook->avgReadSecs > VIDEOCAP)
			{
				$data_ebook->avgReadSecs = VIDEOCAP;
			}
		}

		$this->db->select("name as file_name,SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp)))) as watchSecs,AVG(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp))) as avgWatchSecs,count(index_ID) as count");
		$this->db->from("mobile_analysis_data");
		$this->db->join('users', "users.user_id=mobile_analysis_data.user_id");
		$this->db->join('subtopics', 'subtopic_ID = subtopics.subtopicID');
		$this->db->where('mobile_analysis_data.content_type', "Videos");
		$this->db->where('mobile_analysis_data.user_id', $user_id);
		$this->db->where('(start_stamp < end_stamp)');
		$this->db->group_by('subtopic_ID');
		$this->db->order_by('avgWatchSecs');
		if ( ! empty($period))
		{
			$today = date('Y-m-d', time());
			$usageStartDate = date('Y-m-d', strtotime($today . ' - 30  days'));
			$this->db->where('start_stamp>', $usageStartDate);
		}

		$data_videos = $this->db->get()->result();
		foreach ($data_videos as $data_video)
		{
			if ($data_video->avgWatchSecs > VIDEOCAP)
			{
				$data_video->avgWatchSecs = VIDEOCAP;
			}
		}

		$this->db->select("file_name,SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp)))) as watchSecs,AVG(TIME_TO_SEC(TIMEDIFF(end_stamp,start_stamp))) as avgWatchSecs,count(index_ID) as count");
		$this->db->from("mobile_analysis_data");
		$this->db->join('users', "users.user_id=mobile_analysis_data.user_id");
		$this->db->join('multimedia_content', 'subtopic_ID = multimedia_content.file_id');
		$this->db->where('mobile_analysis_data.content_type', "Videos");
		$this->db->where('mobile_analysis_data.user_id', $user_id);
		$this->db->where('(start_stamp < end_stamp)');
		$this->db->group_by('subtopic_ID');
		$this->db->order_by('watchSecs');
		$data_videos2 = $this->db->get()->result();
		foreach ($data_videos2 as $datavideo)
		{
			if ($datavideo->avgWatchSecs > VIDEOCAP)
			{
				$datavideo->avgWatchSecs = VIDEOCAP;
			}
		}

		$data3 = array_merge($data_videos, $data_videos2);
		usort($data3, function ($a, $b) {
			return $b->watchSecs <=> $a->watchSecs;
		});

		$data = array("ebooks" => $data_ebooks, "videos" => $data3);

		return $data;

	}

	public function getUserName($user_id)
	{
		$this->db->select('fname');
		$this->db->from('users');
		$this->db->where('user_id', $user_id);
		$fname = $this->db->get()->row();
		return $fname;
	}

	private function calculateTime($arr_time, $format = 'mins', $usage = '')
	{
		$app_time = 0;
		$count = 0;
		$time_seconds = array();
		foreach ($arr_time as $time)
		{

			sscanf($time->time_elapsed, "%d:%d:%d", $hours, $minutes, $seconds);
			$timee = $hours * 3600 + $minutes * 60 + $seconds;
			if ($timee <= 0)
			{ //checks and skips elements with no end time
				continue;
			} else
			{
				if ($usage == 'APPUSAGE' && $timee > APPUSAGE)
				{
					$timee = APPUSAGE;
				} elseif ($timee > VIDEOCAP && empty($usage))
				{
					$timee = VIDEOCAP;
				}
				$time_seconds[$count] = $timee;
				$count++;
			}
		}

		$totalTime = array_sum($time_seconds); // in seconds
		if ($format == 'mins')
		{
			return $totalTime / 60; //in minutes
		} else if ($format == 'hours')
		{
			return $totalTime / 60 / 60; //in hours
		}
	}

	public function users_unique()
	{

		try
		{
			$this->db->query("DELETE t1 FROM mobile_analysis_data t1
INNER JOIN mobile_analysis_data t2 
WHERE 
    t1.index_ID < t2.index_ID AND
	t1.analysis_ID = t2.analysis_ID AND
	t1.user_ID = t2.user_ID;");

			return TRUE;
		} catch (Exception $e)
		{
			return FALSE;
		}

	}

	function make_unique($user_id = "")
	{

		//	echo  $user_id;

	}

	/**
	 * @param string $u
	 * @return array
	 */
	function getAllStudents($u = '')
	{
		$this->db->select('users.user_id,users.email,users.fname,users.lname,schools.name, study_levels.level_name,');
		$this->db->from('users');
		$this->db->join("students", "users.user_ID = students.user_ID");
		$this->db->join("schools", "students.school_code = schools.school_code");
		$this->db->join("study_levels", "students.study_level = study_levels.level_code	");
		$this->db->where('users.user_type', 1);
		if ( ! empty($u))
		{
			$this->db->where('users.email', $u);
		}
		$students = $this->db->get()->result();
		return $students;
	}

}
