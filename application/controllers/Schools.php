<?php
/*@cyrus Muchiri*/
/** @noinspection ALL */
defined('BASEPATH') OR exit('No direct script access allowed');



class Schools extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Schools_model');

	}

	function usage(){
		$data = array(
			'distribution' => $this->distribution(),
			'school_usages' => $this->Schools_model->usage(),
			'title' => "School Analytics",
			'view' => "Schools/schools.php"
		);
		$this->load->view('index.php', $data);

	}
	function students($code){
		$students = $this->Schools_model->students($code);
		$data = array(
			'students' =>$this->Schools_model->students($code),
			'title' => $this->Schools_model->getSchoolName($code)->name,
			'view' => "Schools/individual_school.php"
		);
		$this->load->view('index.php', $data);
	}
	function distribution(){

	}

}
