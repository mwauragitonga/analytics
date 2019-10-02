<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class AppAnalytics extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('AppModel');

	}

	public function index()
	{


		$data = array(

		"book_Minutes_Read" => $this->AppModel->book_Minutes_Read(),
		"video_Minutes_Watched" =>$this->AppModel->video_Minutes_Watched(),
		"app_Usage_Minutes" => $this->AppModel->app_Usage_Minutes(),
		"total_Watchers" =>$this->AppModel->total_Watchers(),
		"total_Readers" => $this->AppModel->total_Readers(),
		"signins"=>$this->AppModel->signIns(),
		"students" =>$this->AppModel->students(),
		//"internet_type" => $this->AppModel->internetType(),
		'title' => "App analytics",
		'view' => "app_analytics/app.php"
		);
		//var_dump($formFours);
		$this->load->view('index.php', $data);

	}


}
