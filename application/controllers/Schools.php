<?php
/*@cyrus Muchiri*/
/** @noinspection ALL
 *@author  Cyrus Muchiri
 *@mail cmuchiri8429@gmail.com
 */
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
			'students' =>$this->Schools_model->students($code),
			'title' => "School Analytics",
			'view' => "Schools/schools.php",
			'total_Schools'=>$this->Schools_model->total_schools(),
			'registered_Schools'=>$this->Schools_model->registered_schools(),
			'top_school_Reading'=>$this->Schools_model->top_schools_content(),
			'top_school_students' =>$this->Schools_model->top_School_Registered_Students(),
		);
		$this->load->view('index.php', $data);

	}
	function students($code){
		$data = array(
			'students' =>$this->Schools_model->students($code),
			'title' => $this->Schools_model->getSchoolName($code)->name,
			'view' => "Schools/individual_school.php"
		);
		$this->load->view('index.php', $data);
	}
	function distribution(){

	}
	function reg_schools(){
		$data = array(
			'schools' =>$this->Schools_model->schools_students(),
			'title' => "Schools with >= 1 student",
			'view' => "Schools/schools_students.php"
		);
		$this->load->view('index.php', $data);
	}
	function users($code){
		$data = array(
			'students' =>$this->Schools_model->users($code),
			'title' => $this->Schools_model->getSchoolName($code)->name,
			'view' => "Schools/schools_users.php"
		);
		$this->load->view('index.php', $data);
	}
	function top_reading(){
		$data = array(
			'school_usages' => $this->Schools_model->usage(),
			'title' => "Top Schools in watching and reading content",
			'view' => "Schools/top_schools_reading.php"
		);
		$this->load->view('index.php', $data);
	}

}
