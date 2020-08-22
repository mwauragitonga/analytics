<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'AfricasTalkingGateway.php';

/** @noinspection ALL
 * @author Cyrus Muchiri
 * @mail cmuchiri8429@gmail.com
 * @date : 28th April 2020 1613hrs
 */
class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

//load africastalking api
		$this->username = "boardpass";
		$this->apikey = "e64837ac0691f08049305379bc705e5f90d1f06bd99f3ecc15b874f57b32d283";
		$this->gateway = new  AfricasTalkingGateway($this->username, $this->apikey, "boardpass");
		$this->load->library('upload');
		$this->load->model('search_model', 'lookup');
		//load session
		//new addon
		$this->load->library('session');

	}

	public function searchView($data = '')
	{
		$data = array(
			'title' => "Search",
			'view' => "lookup/searchView.php"

		);
		$this->load->view('index.php', $data);
	}

	public function reloadSearchView($data)
	{

		$this->load->view('index.php', $data);
	}

	public function search()
	{
		$phrase = $this->input->post('phrase');
		$result = $this->lookup->search($phrase);


		//print_r($result->fname);
		if (empty($result)) {
			$data = array(
				'title' => "Search",
				'message' => 'No user is associated with the details',
				'view' => "lookup/searchView.php"
			);
			$this->load->view('index.php', $data);
		} else {
			$data = array(
				'result' => $result,
				'title' => "Student Look Up",
				'user_id' => $result->user_id,
				'view' => "lookup/search.php"
			);
			$this->load->view('index.php', $data);
		}

	}

	public function updateSubscription()
	{

		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d', time());
		$subscription = $this->input->post('subscription');
		$user_id = $this->input->post('user_id');

		//load post data
		if ($subscription == 'yearly') {
			$data = array(
				'subscription_type' => 'yearly',
				'status' => 'active',
				'start_date' => $date,
				'expiry' => date('Y-m-d', strtotime($date . ' + 365  days'))
			);
		} else if ($subscription == 'monthly') {
			$data = array(
				'subscription_type' => 'monthly',
				'status' => 'active',
				'start_date' => $date,
				'expiry' => date('Y-m-d', strtotime($date . ' + 30  days'))
			);
		} else if ($subscription == 'termly') {
			$data = array(

				'subscription_type' => 'termly',
				'status' => 'active',
				'start_date' => $date,
				'expiry' => date('Y-m-d', strtotime($date . ' + 91  days'))
			);
		}
		//send data to-from model
		$result = $this->lookup->updateSubscription($user_id, $data);
		if ($result == true) {

			/*	1.return alert to admin */
			$data_confirmation = array(
				'title' => "Search",
				'status' => 'true',
				'message' => 'User Subscription updated successfully! ',
				'view' => "lookup/searchView.php"
			);
			/*	2. send subscrioption message*/
			$userDetails = $this->lookup->getUserDetails($user_id);
			$name = $userDetails->fname;
			$mobile = $userDetails->mobile;
			$this->send_subscription_message($name, $mobile);
		} else {
			$data_confirmation = array(
				'title' => "Search",
				'status' => 'false',
				'message' => 'User Subscription Failed! ',
				'view' => "lookup/searchView.php"
			);
		}
		$this->reloadSearchView($data_confirmation);

	}

	public function send_subscription_message($name, $mobile)
	{
		$from_ = 'DAWATI';
		$message = 'Dear  ' . $name . '. Thank You for signing up to Dawati. To access our 100s of videos, ebooks, lab practicals and 
		revision materials subscribe to either  a monthly (ksh 200),  termly (ksh 500) or yearly (ksh 1000) package. For more information call, text or WhatsApp  +254745001456.';

		try {
			$this->gateway->sendMessage($mobile, $message, $from_);

			return true;


		} catch (Exception $e) {
			var_dump($e);
			return false;

		}

	}

}
