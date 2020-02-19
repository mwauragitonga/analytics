<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics_controller extends CI_Controller
{

	/**
	 *This is the Analytics portal for Dawati 2.0
	 *created by Kelvin
	 * 11/09/2019
	 * KAende sana
	 */
	function __construct()
	{
		parent::__construct();
		$this->data ['title'] = "Dawati Analytics | General";
		$this->data ['description'] = "";

		$this->load->model('Analytics_model');
		$this->load->model('Payments_model');
		$this->load->model('agents_model');

		$this->load->library('upload');
		$this->load->library("bcrypt");
	}

	public function index()
	{
		if ($this->is_logged_in() == true) {
			$studentCount = $this->Analytics_model->getStudentsCount();
			$maleStudents = $this->Analytics_model->getMaleStudents();
			$femaleStudents = $this->Analytics_model->getFemaleStudents();
			$signupsToday = $this->Analytics_model->getDailySignups();
			$formOnes = $this->Analytics_model->getFormOne();
			$formTwos = $this->Analytics_model->getFormTwo();
			$formThrees = $this->Analytics_model->getFormThree();
			$formFours = $this->Analytics_model->getFormFour();
			$activeSubscriptions = $this->Analytics_model->getActiveSubscriptions();
			$inactiveSubscriptions = $this->Analytics_model->getInactiveSubscriptions();
			$annualSubscriptions = $this->Analytics_model->getAnnualSubscriptions();
			$termlySubscriptions = $this->Analytics_model->getTermlySubscriptions();
			$monthlySubscriptions = $this->Analytics_model->getMonthlySubscriptions();
			$nonSubscribers = $this->Analytics_model->getNonSubscribers();
			$topVideos = $this->Analytics_model->getVideosViews();
			$topEbooks = $this->Analytics_model->getEbooksViews();
			$webHits = $this->Analytics_model->getWebHits();
		//	var_dump($webHits);
			$data = array(
				'studentCount' => $studentCount,
				'maleCount' => $maleStudents,
				'femaleCount' => $femaleStudents,
				'signupsToday' => $signupsToday,
				'formOnes' => $formOnes,
				'formTwos' => $formTwos,
				'formThrees' => $formThrees,
				'formFours' => $formFours,
				'activeSubs' => $activeSubscriptions,
				'inactiveSubs' => $inactiveSubscriptions,
				'annualSubs' => $annualSubscriptions,
				'termlySubs' => $termlySubscriptions,
				'monthlySubs' => $monthlySubscriptions,
				'nonSubs' => $nonSubscribers,
				'topVideos' => $topVideos,
				'topEbooks' => $topEbooks,
				'webHits' => $webHits,
				'title' => "General Analytics",
				'view' => "general/general.php"
			);
			$this->load->view('index.php', $data);
		} else {
			$this->load->view('login/login.php');
		}

	}


	/**
	 *
	 */
	public function payments()
	{
		$data = array(

			'title' => "Payments And Subscriptions",
			'view' => "payments/payments.php"
		);
		//var_dump($formFours);
		$this->load->view('index.php', $data);
	}

	/**
	 *
	 */
	public function accounts()
	{
		if ($this->is_logged_in() == true) {
			$signupsToday = $this->Analytics_model->getDailySignups();
			$webRegistrations = $this->Analytics_model->getWebRegistrations();
			$appRegistrations = $this->Analytics_model->getAppRegistrations();
			$unclassifiedRegistrations = $this->Analytics_model->getUnclassifiedRegistrations();
			$activeSubscriptions = $this->Analytics_model->getActiveSubscriptions();
			$inactiveSubscriptions = $this->Analytics_model->getInactiveSubscriptions();
			//$nonSusbcribers= $this->Analytics_model->getNonSubscribers();
			$weeklySignups = $this->Analytics_model->averageSignups();
			$monthlyActiveUsers = $this->Analytics_model->monthlyActiveUsers();
			$weeklyActiveUsers = $this->Analytics_model->weeklyActiveUsers();
			$loggedInUsers = $this->Analytics_model->loggedInUsers();
			$loggedOutUsers = $this->Analytics_model->loggedOutUsers();
			$neverLogged = $this->Analytics_model->neverLoggedIn();

			$loggedOut = $loggedOutUsers + $neverLogged;


			$dat = date('Y-m-d');
			$date = new DateTime($dat);
			$users = array();
			$period = $date->modify("-11 months");
			for ($i = 0; $i < 12; $i++) {
				$users[$i] = $this->Analytics_model->users_By_Months($period->format('Y-m'));
				$period = $date->modify("+1 months");
				//var_dump($users);
			}
			//return $users;
			$today = date('Y-m-d ');

			$data = array(
				'signupsToday' => $signupsToday,
				'webRegistrations' => $webRegistrations,
				'appRegistrations' => $appRegistrations,
				'unclassified' => $unclassifiedRegistrations,
				'active' => $activeSubscriptions,
				'inactive' => $inactiveSubscriptions,
				'average' => $weeklySignups,
				'monthlyUsers' => $monthlyActiveUsers,
				'weeklyUsers' => $weeklyActiveUsers,
				'annualUsers' => $users,
				'loggedIn' => $loggedInUsers,
				'loggedOut' => $loggedOut,
				'title' => "Accounts Management",
				'view' => "accounts/accounts.php"
			);
			//var_dump($formFours);
			$this->load->view('index.php', $data);
		} else {
			$this->load->view('login/login.php');
		}
	}

	public function accountsByDay()
	{
		if ($this->is_logged_in() == true) {

			$data = array(

				'title' => "Sign Ups ",
				'view' => "accounts/signups.php"
			);
			//var_dump($formFours);
			$this->load->view('index.php', $data);
		}
	}
	public function weeklyActiveUsers(){

		$users = $this->Analytics_model->weeklyUsers();

		$data = array(
			'users' => $users,
			'title' => "Users Active in the last week",
			'view' => "accounts/weeklyUsers.php"
		);
		//var_dump($users);
		$this->load->view('index.php', $data);
	}
	public function monthlyActiveUsers(){

		$users = $this->Analytics_model->monthlyUsers();

		$data = array(
			'users' => $users,
			'title' => "Users Active in the last month",
			'view' => "accounts/monthlyUsers.php"
		);
		//var_dump($users);
		$this->load->view('index.php', $data);
	}

	/**
	 *
	 */
	public function authentication()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$status = $this->Analytics_model->login_validation($email, $password);
		$userDetails = $this->Analytics_model->getUserDetails($email);
		if ($status == true && $userDetails->user_type == '5') {
			//lead to portal logged in

			$this->session->set_userdata('status', 'true');
			$this->session->set_userdata('fname', $userDetails->fname);
			$this->session->set_userdata('lname', $userDetails->lname);
			$this->session->set_userdata('userType', 'admin');

			$this->index();

		}elseif ($status == true && $userDetails->user_type == '6'){
			$agent_code= $userDetails->hash;

			$this->session->set_userdata('status', 'true');
			$this->session->set_userdata('fname', $userDetails->fname);
			$this->session->set_userdata('lname', $userDetails->lname);
			$this->session->set_userdata('userType', 'agent');
			$this->session->set_userdata('agentCode', $agent_code);

			$agent_name = $this->agents_model->agentName($agent_code);
			$referals = $this->agents_model->referalByAgents($agent_code);
			$paid_students = $this->agents_model->paidStudents($agent_code);
			$total_revenue =0;
			if(is_null($paid_students->total_revenue)){

			}else{
				$total_revenue =$paid_students->total_revenue;
			}
			$agent_data = array(
				'total_students' => count($referals),
				'total_revenue'=> $total_revenue,
				'associated_schools'=>$this->agents_model->registered_schools($agent_code),
				'paid_students'=>$paid_students->paid_students,
				'students' =>$referals,
				'agentCode'=>$agent_code
			);
			$data = array(
				'response' => $agent_data,
				'title' => $agent_name,
				'view' => "Agents/referals",
			);
			$this->load->view('index.php', $data);

		} elseif ($status == false) {
			//lead to log in page showing error message
			$message = 'Log in failed!! Incorrect email or password';
			$data = array(
				'message' => $message
			);
			#var_dump($email);
			$this->load->view('login/login', $data);
		}
	}

	public function signUps_by_Day()
	{
		if ($this->is_logged_in() == true) {


			$post_data = file_get_contents("php://input");
			$decoded_post_data = json_decode($post_data);
			$date = $decoded_post_data->date;

			$dates = explode('-', $date);
			$startDate = date("Y-m-d", strtotime($dates[0]));
			$end_Date = date("Y-m-d", strtotime($dates[1]));
			if ($startDate == $end_Date) {
				$users = $this->Analytics_model->signUps_By_Day($startDate);

			} else {
				$users = $this->Analytics_model->signUps_By_Range($startDate, $end_Date);
			}
			echo json_encode($users);

		}
	}
	public function payers(){
		if ($this->is_logged_in() == true) {
			$data = array(

				'title' => "Paid Customers ",
				'payers' =>$this->Payments_model->payers(),
				'view' => "payments/payers.php"
			);
			$this->load->view('index.php', $data);
		}
		}

	public function is_logged_in()
	{
		if ($this->session->userdata('status') == true) {
			return true;
		} else {
			redirect('login');
		}
	}

	public function login()
	{
		$this->load->view('login/login');
	}

	public function logout()
	{
		//unset all user & session data and redirect to index page

		$this->session->unset_userdata('status');
		$this->session->unset_userdata('fname');
		$this->session->unset_userdata('lname');
		$this->session->sess_destroy();
		$this->load->view('login/login.php');
	}

}
