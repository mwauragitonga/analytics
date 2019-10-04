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


		$data=array(

			'title' => "Evaluations Analytics",
			'view' => "evaluations/evaluations.php"
		);

		$this->load->view('index.php', $data);

	}
}
