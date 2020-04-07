<?php
require APPPATH . '/libraries/REST_Controller.php';
defined('BASEPATH') OR exit('No direct script access allowed');


class Web_controller extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->data ['title'] = "Dawati Analytics | Web App Analysis";
		$this->data ['description'] = "";
		$this->load->library('session');
		$this->load->model('Web_model');

	}

	/**
	 *
	 */

	public function webAnalytics()
	{
		$array_items = array('startDate', 'end_Date', 'target');
		$this->session->unset_userdata($array_items);
		$signUps = $this->Web_model->getSignUps();
		$logins = $this->Web_model->getLoginsToday();
		$videoViews = $this->Web_model->getVideoViewsToday();
		$bookReads = $this->Web_model->getBookReadsToday();
		$attemptedPayments = $this->Web_model->getAttemptedPaymentsToday();
		$freeBookViews = $this->Web_model->freeBooks();
		$freeVideos = $this->Web_model->freeVideos();

		$dat = date('Y-m-d');
		$date = new DateTime($dat);
		$sess_data = array(
			'startDate' => $date,
			'end_Date' => $date,
			'target' => 'single'
		);
		$this->session->set_userdata($sess_data);
		$users = array();
		$signups = array();
		$period = $date->modify("-6 days");
		for ($i = 0; $i < 7; $i++)
		{
			$users[$i] = $this->Web_model->users_By_Day($period->format('m-d'));
			$signups[$i] = $this->Web_model->signups_By_Day($period->format('m-d'));
			$period = $date->modify("+1 day");
		}
		$data = array(

			'signUps' => $signUps,
			'logins' => $logins,
			'views' => $videoViews,
			'reads' => $bookReads,
			'weeklyUsers' => $users,
			'weeklySignups' => $signups,
			'attempts' => $attemptedPayments,
			'freeContentViews' => $freeVideos + $freeBookViews,
			'title' => "Web Analysis",
			'view' => "web_analytics/web.php"
		);

		$this->load->view('index.php', $data);

	}

	/**
	 * @var $period ( contains first date and last date)
	 * responds ajax
	 * @author  Cyrus Muchiri
	 */
	public function webData()
	{
		$array_items = array('startDate', 'end_Date', 'target');
		$this->session->unset_userdata($array_items);
		$post_data = file_get_contents("php://input");
		$decoded_post_data = json_decode($post_data);
		$period = $decoded_post_data->date;
		$dates = explode('-', $period);
		$startDate = date("Y-m-d", strtotime($dates[0]));
		$end_Date = date("Y-m-d", strtotime($dates[1]));
		$target = ''; /*Depicts single and range dates*/
		if ($startDate == $end_Date)
		{
			$target = 'single';
		} else
		{
			$target = 'range';
		}
		$sess_data = array(
			'startDate' => $startDate,
			'end_Date' => $end_Date,
			'target' => $target
		);
		$this->session->set_userdata($sess_data);

		$signUps = $this->Web_model->getSignUps($startDate, $end_Date, $target);
		$logins = $this->Web_model->getLoginsToday($startDate, $end_Date, $target);
		$videoViews = $this->Web_model->getVideoViewsToday($startDate, $end_Date, $target);
		$bookReads = $this->Web_model->getBookReadsToday($startDate, $end_Date, $target);
		$attemptedPayments = $this->Web_model->getAttemptedPaymentsToday($startDate, $end_Date, $target);
		$freeBookViews = $this->Web_model->freeBooks($startDate, $end_Date, $target);
		$freeVideos = $this->Web_model->freeVideos($startDate, $end_Date, $target);

		$data = array(
			'sign_Ups' => $signUps,
			'logins' => $logins,
			'videos_Views' => $videoViews,
			'book_Reads' => $bookReads,
			'attempted_payments' => $attemptedPayments,
			'free_content' => $freeBookViews + $freeVideos
		);
		echo json_encode($data);
	}

	public function videoViewers()
	{

		$viewers = $this->Web_model->getVideoViewers();
		//var_dump($viewers);
		$data = array(

			'users' => $viewers,
			'title' => " Video Viewers",
			'view' => "web_analytics/videoViewers.php"
		);

		$this->load->view('index.php', $data);

	}

	public function bookReaders()
	{

		$readers = $this->Web_model->getbookReaders();
		//	var_dump(count($readers));
		$data = array(

			'users' => $readers,
			'title' => " Book Readers",
			'view' => "web_analytics/bookReaders.php"
		);

		$this->load->view('index.php', $data);

	}

	public function payments()
	{

		$users = $this->Web_model->getPayments();
//		var_dump(count($users));
		$data = array(

			'users' => $users,
			'title' => " Attempted and Complete Payments",
			'view' => "web_analytics/payments.php"
		);

		$this->load->view('index.php', $data);

	}

	//Cyrus
	public function logins()
	{
		$logins = $this->Web_model->moreInfoLogins();
		$data = array(

			'logins' => $logins,
			'title' => " Web Logins",
			'view' => "web_analytics/logins.php"
		);

		$this->load->view('index.php', $data);
	}
}
