<?php
/**
 * @noinspection ALL
 * @author  Cyrus Muchiri
 * @mail cmuchiri8429@gmail.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class Agents extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('agents_model');
	}

	public function agentsView()
	{
		$agents = $this->agents_model->select_agents();
		$data = array(
			'agents' => $agents,
			'title' => "Agents",
			'view' => "Agents/all_agents.php",
		);
		$this->load->view('index.php', $data);
	}
	public function createAccountView(){
		$data = array(
			'agents' => array(),
			'title' => "Add Agent",
			'view' => "Agents/add_agent",
		);
		$this->load->view('index.php', $data);
	}

	public function createAccount()
	{
		$this->load->library('bcrypt');
		$password = $this->input->post('password');
		$cpassword = $this->input->post('confirmPassword');
		$full_name = $this->input->post('full_name');
		$email = $this->input->post('email');
		$mobile = $this->input->post('phone');
		$user_type = '6';
		$emailRegex = '^[_a-z0-9-]+(.[a-z0-9-]+)@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})^';
		$phoneRegex = '^(?:254|\+254|0)?(7(?:(?:[12][0-9])|(?:0[0-8])|(?:[3][0-9])|(?:5[0-6])|(9[0-2])|(8[5-9])|(7[0-6]))[0-9]{6})^';

		if (empty($full_name) || empty($mobile) || empty($email) || empty($password) || empty($cpassword)) {
			$json_data = array(
				'message_status' => 'false',
				'message' => 'Ensure you have filled all data fields'
			);
			$data = array(
				'response' => $json_data,
				'title' => "Add Agent",
				'view' => "Agents/add_agent",
			);
			$this->load->view('index.php', $data);
		} elseif (preg_match($emailRegex, $email) || preg_match($phoneRegex, $mobile)) {
			if ($password == $cpassword) {
				$email_status = $this->agents_model->checkmail($email);// checks existence of an email address
				$mobile_status = $this->agents_model->checkmobile($mobile);// checks existence of a phone number
				$data = array(
					'fname' => $full_name,
					'email' => $email,
					'mobile' => $mobile,
					'hash' => substr(md5($email), 10, 5),
					'user_type' => $user_type,
					'password' => $this->bcrypt->hash($password),
					'user_status' => 'Confirmed',
				);

				if ($email_status == 'false' || $mobile_status == 'false') {
					$json_data = array(
						'message_status' => 'false',
						'message' => 'An account with the email address or mobile number already exists'
					);
					$data = array(
						'response' => $json_data,
						'title' => "Add Agent",
						'view' => "Agents/add_agent",
					);
					$this->load->view('index.php', $data);
				} elseif ($email_status == 'true' && $mobile_status == 'true') {
					$id = $this->agents_model->add_agents($data);
					redirect('agents');
				}
			} else {
				$json_data = array(
					'message_status' => 'false',
					'message' => 'passwords do not match'
				);
				$data = array(
					'response' => $json_data,
					'title' => "Add Agent",
					'view' => "Agents/add_agent",
				);
				$this->load->view('index.php', $data);
			}
		} else {
			$json_data = array(
				'message_status' => 'false',
				'message' => 'You entered an invalid email address or mobile number'
			);
			$data = array(
				'response' => $json_data,
				'title' => "Add Agent",
				'view' => "Agents/add_agent",
			);
			$this->load->view('index.php', $data);
		}
	}
}
