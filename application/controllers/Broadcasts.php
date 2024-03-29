<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'AfricasTalkingGateway.php';

class Broadcasts extends CI_Controller {

	/**
	 * This is the broadcast messages controller for Dawati
	 *created by Kelvin
	 * 31/03/2020
	 * KAende sana
	 */
	function __construct()
	{
		parent::__construct();
		$this->data ['title'] = "Dawati Analytics | Broadcasts";
		$this->data ['description'] = "";
		//load africastalking api
		$this->username = "boardpass";
		$this->apikey = "e64837ac0691f08049305379bc705e5f90d1f06bd99f3ecc15b874f57b32d283";
		$this->gateway = new AfricasTalkingGateway($this->username, $this->apikey, "boardpass");
		//$this->load->model('Evaluations_model');
		$this->load->model('Broadcasts_model');

	}

	public function messages()
	{
		$data = array(

			'title' => "Broadcast Messages",
			'view' => "broadcasts/messages.php"
		);
		//var_dump($formFours);
		$this->load->view('index.php', $data);
	}

	public function broadcastEmail()
	{

		$title = $this->input->post('title');
		$message = $this->input->post('message');
		$checkbox = $this->input->post('checkbox');
		//if checkbox is checked send email to users listed only otherwise send to all users
		if ($checkbox == 1)
		{
			$email = $this->input->post('email');
			$send = $this->send_broadcast_email($title, $message, $email);
			if ($send == TRUE)
			{
				$status = "Message Sent!";
				$data = array(
					'message' => $status,
					'title' => "Broadcast Messages",
					'view' => "broadcasts/messages.php"
				);
				//var_dump($formFours);
				$this->load->view('index.php', $data);
			} else
			{
				$status = "Message Not Sent!";
				$data = array(
					'message' => $status,
					'title' => "Broadcast Messages",
					'view' => "broadcasts/messages.php"
				);
				//var_dump($formFours);
				$this->load->view('index.php', $data);
			}

		} else
		{
			//get all user emails from dB
			$emails = $this->Broadcasts_model->getUserEmails();
			foreach ($emails as $email)
			{
				$mail = $email->email;
				$name = $email->fName;
				if ( ! empty($mail))
				{
					$send = $this->send_broadcast_email($title, $message, $mail, $name);


				}


			}
		}
		$status = "Message Sent!";
		$data = array(
			'message' => $status,
			'title' => "Broadcast Messages",
			'view' => "broadcasts/messages.php"
		);

		$this->load->view('index.php', $data);


//		$data = array(
//
//			'title' => "Broadcast Messages",
//			'view' => "broadcasts/messages.php"
//		);
//		//var_dump($formFours);
//		$this->load->view('index.php', $data);
	}

	public function broadcastSMS()
	{
		$message = $this->input->post('message');
		//if checkbox is checked send to that number else fetch all student phone numbers from dB @kelvin
		$checkbox = $this->input->post('checkbox');
		if ($checkbox == 1)
		{
			$phone = $this->input->post('phone');

			$send = $this->send_broadcast_SMS($message, $phone);
			if ($send == TRUE)
			{
				$status = "Message Sent!";
				$data = array(
					'message' => $status,
					'title' => "Broadcast Messages",
					'view' => "broadcasts/messages.php"
				);
				$this->load->view('index.php', $data);
			} else
			{
				$status = "Message Not Sent!";
				$data = array(
					'message' => $status,
					'title' => "Broadcast Messages",
					'view' => "broadcasts/messages.php"
				);
				$this->load->view('index.php', $data);
			}

		} else
		{
			//get all user phone numbers from dB
			$numbers = $this->Broadcasts_model->getUserNumbers();
			foreach ($numbers as $number)
			{
				$phoneNo = $number->mobile;
				$name = $number->fName;
				if ( ! empty($phoneNo))
				{
					$send = $this->send_broadcast_SMS($message, $phoneNo, $name);

					if ($send == TRUE)
					{
						$status = "Message Sent!";
						$data = array(
							'message' => $status,
							'title' => "Broadcast Messages",
							'view' => "broadcasts/messages.php"
						);
						//var_dump($formFours);
						$this->load->view('index.php', $data);
					} else
					{
						$status = "Message Not Sent!";
						$data = array(
							'message' => $status,
							'title' => "Broadcast Messages",
							'view' => "broadcasts/messages.php"
						);
						//var_dump($formFours);
						$this->load->view('index.php', $data);
					}
				}
			}
		}
	}

	public function send_broadcast_SMS($text, $mobile, $name = '')
	{
		$from_ = 'DAWATI';
		$message = $text;
		try
		{
			$this->gateway->sendMessage($mobile, $message, $from_);
			return TRUE;

		} catch (Exception $e)
		{
			// var_dump($e);
			return FALSE;

		}

	}

	/**
	 * @param $code
	 * @param $id
	 * @param $email
	 * @return  boolean
	 */

	public function send_broadcast_email($title, $message, $email, $name = "")
	{
		$data = array(
			'name' => $name,
			'message' => $message
		);

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'dawati.co.ke';
		$config['smtp_port'] = '465';
		$config['smtp_user'] = 'account_confirmations@dawati.co.ke';
		$config['smtp_pass'] = 'D%bEPUE523yR';
		$config['smtp_crypto'] = 'ssl';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;

		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");

		$this->email->set_mailtype("html");
		$this->email->from('account_confirmations@dawati.co.ke', 'Dawati');
		$this->email->to($email);
		$this->email->subject($title);
		$body = $this->load->view('broadcasts/email', $data, TRUE); // to be provided
		$this->email->message($body);
		try
		{
			$this->email->send();
			// echo "mail sent";
			return TRUE;


		} catch (Exception $e)
		{
			echo "failed";
			return FALSE;

		}
	}

	public function loadEmail()
	{
		$data = array(
			'fName' => "Tosh",
			'message' => "By the way, if you're wondering where you can find more of this fine meaty filler, visitBy the way, if you're wondering where you can find more of this fine meaty filler, visitBy the way, if you're wondering where you can find more of this fine meaty filler, visit",
			'title' => "Broadcast Email",
			'view' => "broadcasts/email.php"
		);
		//var_dump($formFours);
		$this->load->view('index.php', $data);

	}
}
