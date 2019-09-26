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
		$this->load->library('upload');
		$this->load->library("bcrypt");
	}
	public function index()
	{
		if($this->is_logged_in()==true){
			$studentCount= $this->Analytics_model->getStudentsCount();
			$maleStudents= $this->Analytics_model->getMaleStudents();
			$femaleStudents= $this->Analytics_model->getFemaleStudents();
			$signupsToday= $this->Analytics_model->getDailySignups();
			$formOnes= $this->Analytics_model->getFormOne();
			$formTwos= $this->Analytics_model->getFormTwo();
			$formThrees= $this->Analytics_model->getFormThree();
			$formFours= $this->Analytics_model->getFormFour();
			$activeSubscriptions = $this->Analytics_model->getActiveSubscriptions();
			$inactiveSubscriptions= $this->Analytics_model->getInactiveSubscriptions();
			$annualSubscriptions= $this->Analytics_model->getAnnualSubscriptions();
			$termlySusbscriptions = $this->Analytics_model->getTermlySubscriptions();
			$monthlySusbscriptions= $this->Analytics_model->getMonthlySubscriptions();
			$nonSusbcribers= $this->Analytics_model->getNonSubscribers();
			$topVideos= $this->Analytics_model->getVideosViews();
			$topEbooks= $this->Analytics_model->getEbooksViews();

			$data=array(
				'studentCount'=>$studentCount,
				'maleCount'=> $maleStudents,
				'femaleCount'=>$femaleStudents,
				'signupsToday'=>$signupsToday,
				'formOnes'=>$formOnes,
				'formTwos'=>$formTwos,
				'formThrees'=>$formThrees,
				'formFours'=>$formFours,
				'activeSubs'=>$activeSubscriptions,
				'inactiveSubs'=>$inactiveSubscriptions,
				'annualSubs'=>$annualSubscriptions,
				'termlySubs'=>$termlySusbscriptions,
				'monthlySubs'=>$monthlySusbscriptions,
				'nonSubs'=>$nonSusbcribers,
				'topVideos'=>$topVideos,
				'topEbooks'=> $topEbooks,
				'title' => "General Analytics",
				'view' => "general/general.php"
			);
			$this->load->view('index.php', $data);
		}else{
			$this->load->view('login/login.php');
		}

	}



    /**
     *
     */
    public function appAnalytics(){
        $data=array(

            'title' => "App analytics",
            'view' => "app_analytics/app.php"
        );
        //var_dump($formFours);
        $this->load->view('index.php', $data);

    }

    /**
     *
     */
    public function payments(){
        $data=array(

            'title' => "Payments And Subscriptions",
            'view' => "payments/payments.php"
        );
        //var_dump($formFours);
        $this->load->view('index.php', $data);
    }
	/**
	 *
	 */
	public function accounts(){
		if($this->is_logged_in()==true){
		$signupsToday= $this->Analytics_model->getDailySignups();
		$webRegistrations= $this->Analytics_model->getWebRegistrations();
		$appRegistrations= $this->Analytics_model->getAppRegistrations();
		$unclassifiedRegistrations = $this->Analytics_model->getUnclassifiedRegistrations();
		$activeSubscriptions = $this->Analytics_model->getActiveSubscriptions();
		$inactiveSubscriptions= $this->Analytics_model->getInactiveSubscriptions();
	//	$nonSusbcribers= $this->Analytics_model->getNonSubscribers();
		$weeklySignups= $this->Analytics_model->averageSignups();
		$monthlyActiveUsers= $this->Analytics_model->monthlyActiveUsers();
		$weeklyActiveUsers = $this->Analytics_model->weeklyActiveUsers();
		$loggedInUsers= $this->Analytics_model->loggedInUsers();
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
		$today= date('Y-m-d ');
		//var_dump($loggedInUsers);
		$data=array(
			'signupsToday'=>$signupsToday,
			'webRegistrations'=>$webRegistrations,
			'appRegistrations'=> $appRegistrations,
			'unclassified'=>$unclassifiedRegistrations,
			'active'=>$activeSubscriptions,
			'inactive'=>$inactiveSubscriptions,
			'average'=>$weeklySignups,
			'monthlyUsers'=>$monthlyActiveUsers,
			'weeklyUsers'=>$weeklyActiveUsers,
			'annualUsers'=>$users,
			'loggedIn'=>$loggedInUsers,
			'loggedOut'=>$loggedOut,
			'title' => "Accounts Management",
			'view' => "accounts/accounts.php"
		);
		//var_dump($formFours);
		$this->load->view('index.php', $data);
		}else{
			$this->load->view('login/login.php');
		}
	}

	public function accountsByDay(){
		$data=array(

			'title' => "Sign Ups ",
			'view' => "accounts/signups.php"
		);
		//var_dump($formFours);
		$this->load->view('index.php', $data);
	}
    /**
     *
     */
    public function authentication(){
		$email = $this->input->post('email');
		$password=	$this->input->post('password');

		$status= $this->Analytics_model->login_validation($email, $password);
		$userDetails= $this->Analytics_model->getUserDetails($email);
		if($status == true){
			//lead to portal logged in

			$this->session->set_userdata('status','true');
			$this->session->set_userdata('fname',$userDetails->fname);
			$this->session->set_userdata('lname',$userDetails->lname);

			$this->index();

		}elseif ($status == false){
			//lead to log in page showing error message
			$message = 'Log in failed!! Incorrect username or password';
			$data = array(
				'message' =>$message
			);
		#var_dump($email);
			$this->load->view('login/login',$data);
		}
    }
	public function is_logged_in()
	{
		if ( $this->session->userdata('status') == true ) {
			return true;
		} else {
			redirect('login');
		}
	}

	public function login(){
		$this->load->view('login/login');
	}
	public function logout(){
		//unset all user & session data and redirect to index page

		$this->session->unset_userdata('status');
		$this->session->unset_userdata('fname');
		$this->session->unset_userdata('lname');
		$this->session->sess_destroy();
		$this->load->view('login/login.php');
	}
}
