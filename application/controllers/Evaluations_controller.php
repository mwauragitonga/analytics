<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluations_controller extends CI_Controller
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
		$this->data [ 'title' ] = "Dawati Analytics | Evaluations";
		$this->data [ 'description' ] = "";

		$this->load->model('Evaluations_model');
		$this->load->library('upload');
		$this->load->library("bcrypt");
	}
	public function evaluations(){
		$availableExams = $this->Evaluations_model->getExams();
		$attemptsToday = $this->Evaluations_model->getExamAttemptsToday();
		$averageScore = $this->Evaluations_model->getExamAverage();
		$totalAttempts = $this->Evaluations_model->getAllAttempts();
		$topExams = $this->Evaluations_model->getTopExams();
		$topStudents = $this->Evaluations_model->getTopStudents();

		//var_dump($topStudents);
		$data=array(
			'available' => $availableExams,
			'attemptsToday' => $attemptsToday,
			'average' => $averageScore,
			'totalAttempts' =>count($totalAttempts),
			'topExams' => $topExams,
			'topStudents' => $topStudents,
			'title' => "Evaluations Analytics",
			'view' => "evaluations/evaluations.php"
		);

		$this->load->view('index.php', $data);

	}
	public function examsAttemptsToday(){
		$users = $this->Evaluations_model->getAttemptsToday();

		$data=array(
			'users' => $users,

			'title' => "Today's Evaluations Analytics",
			'view' => "evaluations/attemptsToday.php"
		);
		$this->load->view('index.php', $data);

	}
	public function  examAttempts(){
		$users = $this->Evaluations_model->getAllAttempts();
		//var_dump(count($users));

		$data=array(
			'users' => $users,
			'title' => "Evaluations Analytics",
			'view' => "evaluations/examAttempts.php"
		);
		$this->load->view('index.php', $data);

	}
}
