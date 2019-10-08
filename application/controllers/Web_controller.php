<?php

require APPPATH . '/libraries/REST_Controller.php';
defined('BASEPATH') OR exit('No direct script access allowed');


class Web_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->data [ 'title' ] = "Dawati Analytics | Web App Analysis";
		$this->data [ 'description' ] = "";

		$this->load->model('Web_model');

	}
	/**
	 *
	 */

	public function webAnalytics(){

			$signUps= $this->Web_model->getSignUps();
			$logins = $this->Web_model->getLoginsToday();
			$videoViews = $this->Web_model->getVideoViewsToday();
			$bookReads = $this->Web_model->getBookReadsToday();
			$attemptedPayments = $this->Web_model->getAttemptedPaymentsToday();

		$dat = date('Y-m-d');
		$date = new DateTime($dat);
		$users = array();
		$signups = array();
		$period = $date->modify("-6 days");
		for ($i = 0; $i < 7; $i++) {
			$users[$i] = $this->Web_model->users_By_Day($period->format('m-d'));
			$signups[$i] = $this->Web_model->signups_By_Day($period->format('m-d'));
			$period = $date->modify("+1 day");
			//var_dump($users);
		}
			$data=array(

				'signUps'=>$signUps,
				'logins'=>$logins,
				'views' =>$videoViews,
				'reads' =>$bookReads,
				'weeklyUsers' =>$users,
				'weeklySignups'=> $signups,
				'attempts' => $attemptedPayments,
				'title' => "Web Analysis",
				'view' => "web_analytics/web.php"
			);

			$this->load->view('index.php', $data);

	}
}
