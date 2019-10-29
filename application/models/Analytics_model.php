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
//		$this->db->join('students', 'students.user_id = users.user_id', 'left');
//		$this->db->join('schools', 'schools.school_code = students.school_code', 'left');
//		$this->db->join('study_levels', 'study_levels.level_code = students.study_level', 'left');
		$this->db->where('user_type', '1');
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
		$this->db->where('user_type', '1');
		$query= $this->db->get();
		return $query->result();
	}
	public function getFemaleStudents(){
		$this->db->select('users.user_id, users.fname, users.lname, users.email, users.user_status, users.date_joined, users.prof_img, users.about_me');
		$this->db->from('users');
		$this->db->where('gender','Female' );
		$this->db->where('user_type', '1');
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
		$query= $this->db->get();
		return $query->num_rows();
	}

	/*get active vs inactive subscribers*/
	public function getActiveSubscriptions(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('student_subscriptions', 'student_subscriptions.user_id=users.user_id');
		$this->db->where('status', 'active');
		$this->db->where('user_type', '1');
		$query= $this->db->get();
		return $query->num_rows();
	}
	public function getInactiveSubscriptions(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('student_subscriptions', 'student_subscriptions.user_id=users.user_id');
		$this->db->where('status', 'inactive');
		$this->db->where('user_type', '1');
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
		$this->db->limit(5);
		$query= $this->db->get();
		return $query->result();

	}
	public function getEbooksViews(){
		$this->db->select('*');
		$this->db->from('multimedia_content');
		$this->db->where('file_type', 'slides');
		$this->db->order_by('Views', 'DESC');
		$this->db->limit(5);
		$query= $this->db->get();
		return $query->result();

	}

	/*get daily sign-ups */
	public function getDailySignups(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('users');
		$this->db->like('date_joined', $date);
		$query= $this->db->get();
		return $query->num_rows();
	}

	/*login validation */

	public function login_validation($email, $password){
		$this->db->select('user_id, fname, lname, online_status, mobile, email, hash, username, password, gender, user_type, user_status');
		$this->db->from('users');
		$this->db->where('email',$email);
		$this->db->where('user_type', '5');
		$result =$this->db->get()->row();
		if(empty($result)){
			//this is to prevent errors  when the email is not found
			'Wamlambez';
		}else{
			$hashed=$result->password;
		}
		if(!empty($result)){
			if ($this->bcrypt->compare($password, $hashed)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function getUserDetails($email){
		$this->db->select('user_id, fname, lname, online_status, mobile, email, hash, username, password, gender, user_type, user_status');
		$this->db->from('users');
		$this->db->where('email',$email);
		$result =$this->db->get()->row();
		return$result;
	}

	/* accounts management functions */
	public function getWebRegistrations(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type', '1');
		$this->db->where('registration_source','source_001');
		$query= $this->db->get();
		return $query->num_rows();

	}
	public function getAppRegistrations(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type', '1');
		$this->db->where('registration_source','source_002');
		$query= $this->db->get();
		return $query->num_rows();

	}
	public function getUnclassifiedRegistrations(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type', '1');
		$this->db->where('registration_source',NULL);
		$query= $this->db->get();
		return $query->num_rows();

	}
	public function averageSignups(){
		date_default_timezone_set("Africa/Nairobi");
		$date = new DateTime();
		$date->modify('-1 week');
		$week= $date->format('Y-m-d');
		//var_dump($week);
		$today= date('Y-m-d ');
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type', '1');
		$this->db->where('date_joined >=',  $week);
		$this->db->where('date_joined <=', $today );
		$query= $this->db->get();
		return ($query->num_rows())/7;


	}
//	get users active in the last month
	public function monthlyActiveUsers(){
		date_default_timezone_set("Africa/Nairobi");
		$date = new DateTime();
		$date->modify('-1 month');
		$month= $date->format('Y-m-d');
		//var_dump($week);
		$today= date('Y-m-d ');
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type', '1');
		$this->db->where('last_seen >=',  $month);
		//$this->db->where('last_seen <=', $today );
		$query= $this->db->get();
		return $query->num_rows();
	}
	public function monthlyUsers(){
		date_default_timezone_set("Africa/Nairobi");
		$date = new DateTime();
		$date->modify('-1 month');
		$month= $date->format('Y-m-d');
		$today= date('Y-m-d ');
		$this->db->select('users.user_id, fname, lname, online_status, last_seen , mobile, email, hash, username, password, gender, user_type, user_status, study_levels.level_name,schools.name as school_name, student_subscriptions.status ,users.user_status as userstatus');
		$this->db->from('users');
		$this->db->join("students","users.user_id = students.user_id");
		$this->db->join("schools","students.school_code = schools.school_code");
		$this->db->join("study_levels","students.study_level = study_levels.level_code");
		$this->db->join("student_subscriptions","users.user_id = student_subscriptions.user_id");
		$this->db->where('user_type', '1');
		$this->db->where('last_seen >=',  $month);
		$this->db->order_by('last_seen', 'DESC');
		$query= $this->db->get();
		return $query->result();
	}
	//	get users active in the last week

	public function weeklyActiveUsers(){
		date_default_timezone_set("Africa/Nairobi");
		$date = new DateTime();
		$date->modify('-1 week');
		$week= $date->format('Y-m-d');
		//var_dump($week);
		$today= date('Y-m-d ');
		$this->db->select('user_id, fname, lname, online_status, mobile, email, hash, username, password, gender, user_type, user_status');
		$this->db->from('users');
		$this->db->where('user_type', '1');
		$this->db->where('last_seen >=',  $week);
		//$this->db->where('last_seen <=', $today );
		$query= $this->db->get();
		return $query->num_rows();
	}
	public function weeklyUsers(){
		date_default_timezone_set("Africa/Nairobi");
		$date = new DateTime();
		$date->modify('-1 week');
		$week= $date->format('Y-m-d');
		$today= date('Y-m-d ');
		$this->db->select('users.user_id, fname, lname, online_status, last_seen , mobile, email, hash, username, password, gender, user_type, user_status, study_levels.level_name,schools.name as school_name, student_subscriptions.status ,users.user_status as userstatus');
		$this->db->from('users');
		$this->db->join("students","users.user_id = students.user_id");
		$this->db->join("schools","students.school_code = schools.school_code");
		$this->db->join("study_levels","students.study_level = study_levels.level_code");
		$this->db->join("student_subscriptions","users.user_id = student_subscriptions.user_id");
		$this->db->where('user_type', '1');
		$this->db->where('last_seen >=',  $week);
		$this->db->order_by('last_seen', 'DESC');
		$query= $this->db->get();
		return $query->result();
	}
//	get active users over the last 12 months
	public function users_By_Months($instance_month){

		$this->db->select("COUNT(user_id) as users");
		$this->db->from("users");
		$this->db->where("user_type","1");
		$this->db->like('last_seen',$instance_month);
		$query = $this->db->get()->row();
		//var_dump($query->users);
		return $query->users;

	}
	public function signUps_By_Day($date){
		$this->db->select("fname , mobile, gender , user_registration_source.source_name  as source ,study_levels.level_name,schools.name as school_name, student_subscriptions.status ,users.user_status as userstatus");
		$this->db->from("users");
		$this->db->join("students","users.user_id = students.user_id");
		$this->db->join("schools","students.school_code = schools.school_code");
		$this->db->join("study_levels","students.study_level = study_levels.level_code");
		$this->db->join("student_subscriptions","users.user_id = student_subscriptions.user_id");
		$this->db->join('user_registration_source', 'users.registration_source = user_registration_source.source_code');
		$this->db->like("date_joined", $date);
		$query = $this->db->get()->result();
		return $query;
	}
	public function signUps_By_Range($start,$end){
	    $this->db->select("fname , mobile, gender,  user_registration_source.source_name  as source ,study_levels.level_name,schools.name as school_name, student_subscriptions.status ,users.user_status as userstatus");
	    $this->db->from("users");
	    $this->db->join("students","users.user_id = students.user_id");
        $this->db->join("schools","students.school_code = schools.school_code");
        $this->db->join("study_levels","students.study_level = study_levels.level_code");
        $this->db->join("student_subscriptions","users.user_id = student_subscriptions.user_id");
		$this->db->join('user_registration_source', 'users.registration_source = user_registration_source.source_code');
		$this->db->WHERE("date_joined BETWEEN '$start'  AND '$end'");
	    $query = $this->db->get()->result();

	   return $query;

    }
	//get logged in accounts
	public function loggedInUsers()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type', '1');
		$this->db->where('online_status', '1');
		$query = $this->db->get();
		return $query->num_rows();
	}
		//get logged out accounts
	public function loggedOutUsers(){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('user_type', '1');
			$this->db->where('online_status','2');
		//	$this->db->where('online_status','0');
			$query= $this->db->get();
			return $query->num_rows();
		}
		public function neverLoggedIn(){
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('user_type', '1');
			$this->db->where('online_status','0');
			$query= $this->db->get();
			return $query->num_rows();
		}

	public function filterSignUps(){
		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d ');
	}
}
