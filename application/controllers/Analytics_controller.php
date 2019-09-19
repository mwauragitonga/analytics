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
		$this->data ['title'] = "Dawati E-Learning";
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
    public function webAnalytics(){

        $data=array(

            'title' => "Web Analytics",
            'view' => "web_analytics/web.php"
        );
        //var_dump($formFours);
        $this->load->view('index.php', $data);

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

            'title' => "Payments",
            'view' => "payments/payments.php"
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
