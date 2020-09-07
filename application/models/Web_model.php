<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Web_model extends CI_Model
{
	public function getSignUps($startDate='',$end_Date='',$target='')
	{
		if (empty($startDate) && empty($end_Date)){
			date_default_timezone_set("Africa/Nairobi");
			$startDate = date('Y-m-d');
			$target = 'single';

		}
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		if ($target == 'range') {
			$this->db->WHERE("time_of_action BETWEEN '$startDate'  AND '$end_Date'");
		}else{
			$this->db->like("time_of_action", $startDate);

		}
		$this->db->where('(action = "registration")');
		$query = $this->db->get();
		return $query->num_rows();

	}

	public function getLoginsToday($startDate='',$end_Date='',$target='')
	{
		if (empty($startDate) && empty($end_Date)){
			date_default_timezone_set("Africa/Nairobi");
			$startDate = date('Y-m-d');
			$target = 'single';

		}
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		if ($target == 'range') {
			$this->db->WHERE("time_of_action BETWEEN '$startDate'  AND '$end_Date'");
		}else{
			$this->db->like("time_of_action", $startDate);

		}
		$this->db->where('(action = "login")');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function moreInfoLogins()
	{
		$startDate = $_SESSION['startDate'];
		$end_Date =  $_SESSION['end_Date'];
		$target =  $_SESSION['target'];
		//mobile
		$this->db->select('web_actions_logs.user_ID as mobile,users.fname,schools.name as school, count(id) as count ');
		$this->db->from('web_actions_logs');
		$this->db->join('users', 'web_actions_logs.user_ID = users.mobile');
		$this->db->join('students', 'users.user_ID=students.user_ID');
		$this->db->join('schools', 'students.school_code = schools.school_code');
		$this->db->where('users.mobile !=','');

		if ($target == 'range') {
			$this->db->WHERE("time_of_action BETWEEN '$startDate'  AND '$end_Date'");
		}else{
			$this->db->like("time_of_action", $startDate);

		}		$this->db->where('(action = "login")');
		$this->db->group_by('web_actions_logs.user_ID', 'ASC');

		$logins_mobile = $this->db->get()->result();

		//email
		$this->db->select('web_actions_logs.user_ID as mobile,users.fname,schools.name as school, count(id) as count ');
		$this->db->from('web_actions_logs');
		$this->db->join('users', 'web_actions_logs.user_ID = users.email');
		$this->db->join('students', 'users.user_ID=students.user_ID');
		$this->db->join('schools', 'students.school_code = schools.school_code');
		if ($target == 'range') {
			$this->db->WHERE("time_of_action BETWEEN '$startDate'  AND '$end_Date'");
		}else{
			$this->db->like("time_of_action", $startDate);

		}		$this->db->where('(action = "login")');
		$this->db->group_by('web_actions_logs.user_ID', 'ASC');

		$logins_email = $this->db->get()->result();

		//combine
		$logins = array_merge($logins_email,$logins_mobile);

		return $logins;
	}

	public function getVideoViewsToday($startDate='',$end_Date='',$target='')
	{
		if (empty($startDate) && empty($end_Date)){
			date_default_timezone_set("Africa/Nairobi");
			$startDate = date('Y-m-d');
			$target = 'single';

		}
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->where('(action = "watch_video")');
		if ($target == 'range') {
			$this->db->WHERE("time_of_action BETWEEN '$startDate'  AND '$end_Date'");
		}else{
			$this->db->like("time_of_action", $startDate);

		}		$query = $this->db->get();
		return $query->num_rows();
	}
	public function freeVideos($startDate='',$end_Date='',$target=''){
		if (empty($startDate) && empty($end_Date)){
			date_default_timezone_set("Africa/Nairobi");
			$startDate = date('Y-m-d');
			$target = 'single';

		}
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->where('(action = "free_video")');
		if ($target == 'range') {
			$this->db->WHERE("time_of_action BETWEEN '$startDate'  AND '$end_Date'");
		}else{
			$this->db->like("time_of_action", $startDate);

		}		$query = $this->db->get();
		return $query->num_rows();
	}
	public function freeBooks($startDate='',$end_Date='',$target=''){
		if (empty($startDate) && empty($end_Date)){
			date_default_timezone_set("Africa/Nairobi");
			$startDate = date('Y-m-d');
			$target = 'single';

		}
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->where('(action = "readFreeBook")');
		if ($target == 'range') {
			$this->db->WHERE("time_of_action BETWEEN '$startDate'  AND '$end_Date'");
		}else{
			$this->db->like("time_of_action", $startDate);

		}		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getBookReadsToday($startDate='',$end_Date='',$target='')
	{
		if (empty($startDate) && empty($end_Date)){
			date_default_timezone_set("Africa/Nairobi");
			$startDate = date('Y-m-d');
			$target = 'single';

		}
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->where('action', 'read_book');
		if ($target == 'range') {
			$this->db->WHERE("time_of_action BETWEEN '$startDate'  AND '$end_Date'");
		}else{
			$this->db->like("time_of_action", $startDate);

		}		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getAttemptedPaymentsToday($startDate='',$end_Date='',$target='')
	{
		if (empty($startDate) && empty($end_Date)){
			date_default_timezone_set("Africa/Nairobi");
			$startDate = date('Y-m-d');
			$target = 'single';

		}
		$this->db->select('*');
		$this->db->from('web_actions_logs');
		$this->db->where('(action = "initiate_payment" OR action ="proceedToPayment")');
		if ($target == 'range') {
			$this->db->WHERE("time_of_action BETWEEN '$startDate'  AND '$end_Date'");
		}else{
			$this->db->like("time_of_action", $startDate);

		}
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function users_By_Day($instance_day)
	{

		$this->db->select("COUNT(id) as users");
		$this->db->from("web_actions_logs");
		$this->db->where("action", "login");
		$this->db->like('time_of_action', $instance_day);
		$query = $this->db->get()->row();
		//var_dump($instance_day);
		return $query->users;

	}

	public function signups_By_Day($instance_day)
	{

		$this->db->select("COUNT(id) as users");
		$this->db->from("web_actions_logs");
		$this->db->where("action", "registration");
		$this->db->like('time_of_action', $instance_day);
		$query = $this->db->get()->row();
		return $query->users;

	}

	public function getVideoViewers()
	{
		date_default_timezone_set("Africa/Nairobi");
		$startDate = $_SESSION['startDate'];
		$end_Date =  $_SESSION['end_Date'];
		$target =  $_SESSION['target'];

		$date = date('Y-m-d');
		$this->db->select('web_actions_logs.user_id , time_of_action , users.fname, lname, online_status, last_seen , mobile, email, hash, username, password, gender,
		 user_type, user_status, study_levels.level_name,schools.name as school_name, student_subscriptions.status ,users.user_status as userstatus, multimedia_content.file_id, multimedia_content.file_name');
		$this->db->from('web_actions_logs');
		$this->db->join("users", "web_actions_logs.user_id = users.user_id");
		$this->db->join("students", "web_actions_logs.user_id = students.user_id");
		$this->db->join("schools", "students.school_code = schools.school_code");
		$this->db->join("study_levels", "students.study_level = study_levels.level_code");
		$this->db->join("multimedia_content", "web_actions_logs.file_id = multimedia_content.file_id");
		$this->db->join("student_subscriptions", "web_actions_logs.user_id = student_subscriptions.user_id");
		$this->db->where('action = "watch_video"');
		if ($target == 'range') {
			$this->db->WHERE("time_of_action BETWEEN '$startDate'  AND '$end_Date'");
		}else{
			$this->db->like("time_of_action", $startDate);

		};
		$this->db->order_by('time_of_action', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getbookReaders()
	{
		date_default_timezone_set("Africa/Nairobi");
		$startDate = $_SESSION['startDate'];
		$end_Date =  $_SESSION['end_Date'];
		$target =  $_SESSION['target'];

		//var_dump($startDate );var_dump($end_Date );var_dump($target );
		$this->db->select('web_actions_logs.user_id , time_of_action , users.fname, lname, online_status, last_seen , mobile, email, hash, username, password, gender,
		 user_type, user_status, study_levels.level_name,schools.name as school_name, student_subscriptions.status ,users.user_status as userstatus, multimedia_content.file_id, multimedia_content.file_name');		$this->db->from('web_actions_logs');
		$this->db->join("users", "web_actions_logs.user_id = users.user_id");
		$this->db->join("students", "web_actions_logs.user_id = students.user_id");
		$this->db->join("schools", "students.school_code = schools.school_code");
		$this->db->join("study_levels", "students.study_level = study_levels.level_code");
		$this->db->join("multimedia_content", "web_actions_logs.file_id = multimedia_content.file_id");
		$this->db->join("student_subscriptions", "web_actions_logs.user_id = student_subscriptions.user_id");
		$this->db->where('action', "read_book");
		$this->db->where('web_actions_logs.user_id !=', NULL);
		$this->db->where('web_actions_logs.file_id !=', NULL);
		if ($target == 'range') {
//			$this->db->where('time_of_action >=', $startDate);
//			$this->db->where('time_of_action =', $end_Date);
			$this->db->WHERE("time_of_action BETWEEN '$startDate'  AND '$end_Date'");
		}else{
			$this->db->like("time_of_action", $startDate);

		};
		$this->db->order_by('time_of_action', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getPayments()
	{
		$startDate = $_SESSION['startDate'];
		$end_Date =  $_SESSION['end_Date'];
		$target =  $_SESSION['target'];

		$this->db->select('mpesa_callbacks.email, mpesa_callbacks.mobile, mpesa_callbacks.amount, mpesa_callbacks.transaction_ID, mpesa_callbacks.time_of_payment, action , web_actions_logs.user_id ,web_actions_logs.time_of_action as time ,  
		 users.fname, lname, last_seen , users.mobile, users.email, gender, user_type,  study_levels.level_name,schools.name as school_name');
		$this->db->from('web_actions_logs');
		$this->db->join("users", "web_actions_logs.user_id = users.user_id");
		$this->db->join("students", "users.user_id = students.user_id");
		$this->db->join("schools", "students.school_code = schools.school_code");
		$this->db->join("mpesa_callbacks", "users.email = mpesa_callbacks.email");
		$this->db->join("study_levels", "students.study_level = study_levels.level_code");
		$this->db->join("student_subscriptions", "users.user_id = student_subscriptions.user_id");
		$this->db->where('(action = "initiate_payment" OR action ="proceedToPayment") ');
		$this->db->where('web_actions_logs.user_id !=', 0);
		$this->db->group_by('id');
		if ($target == 'range') {
			$this->db->WHERE("time_of_action BETWEEN '$startDate'  AND '$end_Date'");
		}else{
			$this->db->like("time_of_action", $startDate);

		}				$query = $this->db->get();
		return $query->result();
	}

	/**
	 * @author Cyrus Muchiri
	 * @Gets Web usage of the student for the last month
	 * @param $user_id
	 * @return mixed
	 *
	 */
	public function userStudyInfo($user_id){

		$today = date('Y-m-d', time());
		$usageStartDate = date('Y-m-d', strtotime($today . ' - 30  days'));

		$this->db->select('web_actions_logs.user_id , time_of_action , users.fname, lname, study_levels.level_name, multimedia_content.file_name');
		$this->db->from('web_actions_logs');
		$this->db->join("users", "web_actions_logs.user_id = users.user_id");
		$this->db->join("students", "web_actions_logs.user_id = students.user_id");
		$this->db->join("study_levels", "students.study_level = study_levels.level_code");
		$this->db->join("multimedia_content", "web_actions_logs.file_id = multimedia_content.file_id");
		$this->db->where('action', "read_book");
		$this->db->where('web_actions_logs.user_id !=', NULL);
		$this->db->where('web_actions_logs.file_id !=', NULL);
		$this->db->where('time_of_action >', $usageStartDate);
		$this->db->where('users.user_id',$user_id);
		$ebooks = $this->db->get()->result();
//videos
		$this->db->select('web_actions_logs.user_id , time_of_action , users.fname, lname, study_levels.level_name, multimedia_content.file_name');
		$this->db->from('web_actions_logs');
		$this->db->join("users", "web_actions_logs.user_id = users.user_id");
		$this->db->join("students", "web_actions_logs.user_id = students.user_id");
		$this->db->join("study_levels", "students.study_level = study_levels.level_code");
		$this->db->join("multimedia_content", "web_actions_logs.subtopic_id = multimedia_content.subtopicID");
		//$this->db->join('subtopics','web_actions_logs.subtopic_id = subtopics.subtopicID','left');
		$this->db->where('action', "watch_video");
		$this->db->where('web_actions_logs.user_id !=', NULL);
		$this->db->where('web_actions_logs.file_id !=', NULL);
		$this->db->where('time_of_action >', $usageStartDate);
		$this->db->where('users.user_id',$user_id);
		$videos = $this->db->get()->result();
		$data = array("ebooks" => $ebooks, "videos" => $videos);

		return $data;

	}
}
