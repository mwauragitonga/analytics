<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

		$this->load->model('search_model','lookup');
		//load session
		//new addon
		$this->load->library('session');

	}
	public function searchView(){
		$data = array(
			'title' => "Search",
			'view' => "lookup/searchView.php"
		);
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
				'view' => "lookup/search.php"
			);
			$this->load->view('index.php', $data);
		}
			// retain user_id using session
		$sess_data = array(
			'user_id' => $result->user_id
		);
		$this->session->set_userdata($sess_data);
		//print_r($sess_data);
	}
	public function updateSubscription(){

		date_default_timezone_set("Africa/Nairobi");
		$date = date('Y-m-d', time());
		$subscription= $this->input->post('subscription');

//		$yearly=$this->input->post('yearly');
//		$monthly=$this->input->post('monthly');
//		$termly=$this->input->post('termly');
		print_r($date);

		//load post data
		if ($subscription== 'yearly'){
			$data=array(
			'subscription_type'=>'yearly',
			'status'=>'active',
			'start_date'=>$date,
			'expiry'=>date('Y-m-d', strtotime($date . ' + 365  days'))
			);
		}else if($subscription== 'monthly'){
				$data =array(
					'subscription_type'=>'monthly',
					'status'=>'active',
					'start_date'=>$date,
					'expiry'=>date('Y-m-d', strtotime($date . ' + 30  days'))
				);
			}else if ($subscription =='termly'){
			$data =array(

				'subscription_type'=>'termly',
				'status'=>'active',
				'start_date'=>$date,
				'expiry'=>date('Y-m-d', strtotime($date . ' + 91  days'))
			);
		 }
		 //send data to-from model
		$sess=$this->session->get_userdata();
		$id=$sess['user_id'];
		print_r($id);
		$result = $this->lookup->updateSubscription($id,$data);

		//$this->session->set_flashdata('notification', 'Profile was successfully updated');
		redirect('searchView');

	}
}
