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
	}
	public function index()
	{
		$studentCount= $this->Analytics_model->getStudentsCount();
		$maleStudents= $this->Analytics_model->getMaleStudents();
		$femaleStudents= $this->Analytics_model->getFemaleStudents();
		$signupsToday= $this->Analytics_model->getDailySignups();
		$data=array(
			'studentCount'=>$studentCount,
			'maleCount'=> $maleStudents,
			'femaleCount'=>$femaleStudents,
			'signupsToday'=>$signupsToday
		);
	//	var_dump($studentCount);
		$this->load->view('index.php', $data);
	}
}
