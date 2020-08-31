<?php
/** @noinspection ALL
 * @author Cyrus Muchiri
 * @mail cmuchiri8429@gmail.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class AppAnalytics extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('AppModel');
		$this->load->model('Payments_model');
		//new addon
		$this->load->library('session');

	}

	public function index()
	{
		$array_items=array('startDate','end_date','target');
		$this->session->unset_userdata($array_items);

		$dat = date('Y-m-d');

		$date = new DateTime($dat);
		$sess_data = array(
			'startDate' => $dat,
			'end_Date' => $dat,
			'target' => 'single'
		);
		$this->session->set_userdata($sess_data);


		$data = array(
			//"dblayout"=>$this->AppModel->db_layout(),
			"book_Minutes_Read" => $this->AppModel->book_Minutes_Read(),
			"video_Minutes_Watched" => $this->AppModel->video_Minutes_Watched(),
			"app_Usage_Minutes" => $this->AppModel->app_Usage_Minutes(),
			"total_Watchers" => $this->AppModel->total_Watchers(),
			"total_Readers" => $this->AppModel->total_Readers(),
			"unique_signins" => $this->AppModel->signIns(),
			"all_signins" => $this->AppModel->signIns(),
			"students" => $this->AppModel->students(),
			"internet_type" => $this->AppModel->internetType(),
			'total_reads' => $this->getCount($this->AppModel->Books_Read(), 'books'),
			'total_views' => $this->getCount($this->AppModel->Videos_Watched(), 'videos'),
			'title' => "App analytics",
			'view' => "app_analytics/app.php"
		);
		$this->load->view('index.php', $data);

//		print_r($data['unique_signins']);
		//print_r($data['all_signins']);

	}
	public function AppData(){
		/*new function-by Stan*/

		$array_items=array('startDate','end_date','target');
		$this->session->unset_userdata($array_items);
		$post_data= file_get_contents("php://input");
		$decoded_post_data= json_decode($post_data);
		$period= $decoded_post_data->date;
		$dates=explode('-',$period);
		$startDate=date("Y-m-d",strtotime($dates[0]));
		$end_Date=date("Y-m-d",strtotime($dates[1]));
		$target=''; /*Depicts single and rage dates*/
		if ($startDate==$end_Date)
		{
			$target='single';
		} else
			{
				$target='range';

		}
		$sess_data=array(
			'startDate'=> $startDate,
			'end_Date'=>$end_Date,
			'target'=>$target
		);
		$this->session->set_userdata($sess_data);

		$books_minutes_read = $this->AppModel->book_Minutes_Read($startDate, $end_Date, $target);
		$video_Minutes_Watched = $this->AppModel->video_Minutes_Watched($startDate, $end_Date, $target);
		$app_Usage_Minutes = $this->AppModel->app_Usage_Minutes($startDate, $end_Date, $target);
		$total_Watchers = $this->AppModel->total_Watchers($startDate, $end_Date, $target);
		$total_Readers = $this->AppModel->total_Readers($startDate, $end_Date, $target);
		$unique_signins = $this->AppModel->signIns('unique',$startDate, $end_Date, $target);
		$all_signins = $this->AppModel->signIns('all',$startDate, $end_Date, $target);
		$students = $this->AppModel->students($startDate, $end_Date, $target);
		$internet_type = $this->AppModel->internetType($startDate, $end_Date, $target);
		$total_reads = $this->getCount($this->AppModel->Books_Read($startDate, $end_Date, $target), 'books');
		$total_views = $this->getCount($this->AppModel->Videos_Watched($startDate, $end_Date, $target), 'videos');

		$data= array(
			'books_mins_Read'=>$books_minutes_read,
			'video_Minutes_watched'=>$video_Minutes_Watched,
			'app_usage_minutes'=>$app_Usage_Minutes,
			'total_watchers'=>$total_Watchers,
			'total_Readers'=>$total_Readers,
			'unique_signins'=>$unique_signins,
			'all_signs'=>$all_signins,
			'students'=>$students,
			'internet_type'=>$internet_type,
			'total_reads'=>$total_reads,
			'total_views'=>$total_views

		);
		echo  json_encode($data);

	}

	function videos()
	{	$videos=$this->AppModel->Videos_Watched();

		$data = array(
			'videos' => $videos,
			'title' => "More information on Videos",
			'view' => "app_analytics/videos.php"
		);
		$this->load->view('index.php', $data);
	}

	function ebooks()
	{ 	$ebooks = $this->AppModel->Books_Read();

		//print_r($ebooks);
		$data = array(

			'books' => $ebooks,

			'title' => "More Information on Ebooks",
			'view' => "app_analytics/ebooks.php"
		);
		$this->load->view('index.php', $data);
	}

	function users($user_id)
	{

		//	$user_id = "";
		$userStudyInfo = $this->AppModel->userStudyInfo($user_id);
//		$users=$this->AppModel->userStudyInfo();
		$user_name = $this->AppModel->getUserName($user_id);
		$data = array(
			/*new by stan*/
//			'users'=>$users,
			'userStudyInfo' => $userStudyInfo,
			'title' => $user_name->fname,
			'view' => "app_analytics/users.php"
		);
		$this->load->view('index.php', $data);

	}

	function signins()
	{
		$signins = $this->AppModel->users_signIns();

		$data = array(
			'signins' => $signins,
			'title' => "Signins",
			'view' => "app_analytics/signins.php"
		);
		$this->load->view('index.php', $data);
	}
	/*function duplicates(){

		 echo $this->AppModel->users_unique();



	}*/

	//payments
	function payment_reports()
	{
		$reports = $this->Payments_model->reports();
		$data = array(
			'payments' => $reports,
			'title' => "All Payments",
			'view' => "payments/mpesa_reports.php"
		);
		$this->load->view('index.php', $data);
	}
	function repeatCustomers(){
		$start_date='';
		$end_date ='';
		$repeatCustomers = $this->Payments_model->repeatCustomers($start_date,$end_date);
		$data = array(
			'repeatCustomers' => $repeatCustomers,
			'title' => "Repeat Customers Payments",
			'view' => "payments/repeatCustomers.php"
		);
		$this->load->view('index.php', $data);
	}
	function repeatCustomersInfo($user_id){
		$customer = $this->Payments_model->repeatTimes($user_id);
		$name ='';
		for($i=0;$i<1;$i++){
			$name = $customer[$i]->fname;
		}

		$data = array(
			'customer' => $customer,
			'title' => $name,
			'view' => "payments/repeatCustomersInfo.php"
		);
		$this->load->view('index.php', $data);
	}

	/**
	 * @param $array
	 */
	function getCount($arrays)
	{
		$sum = 0;
		foreach ($arrays as $array) {
			$sum += $array->count;
		}
		return $sum;
	}


}
