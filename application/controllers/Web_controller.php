<?php

require APPPATH . '/libraries/REST_Controller.php';
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

class Web_controller extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->data [ 'title' ] = "Dawati Analytics | Web App Analysis";
		$this->data [ 'description' ] = "";

		$this->load->model('Web_model');

	}
	/**
	 *
	 */

	public function webAnalytics(){

			$signUps= $this->Web_model->getSignUps();

			$data=array(

				'signUps'=>$signUps,
				'title' => "Web Analytics",
				'view' => "web_analytics/web.php"
			);

			$this->load->view('index.php', $data);

	}
}
