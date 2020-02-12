<?php
/**
 * @noinspection ALL
 * @author  Mwaura Gitonga
 * @mail mwauragitonga12@gmail.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class PayJoy extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('agents_model');
	}
	public function payjoy_check_device(){
		$apiKey = 'M8ZmO79uXQEt_g7Y1cBxV-dWbQaEiJ63';
		$deviceTag = 'DWXTSZG';

		$url = "https://api.payjoy.com/devicemanager/v1/device?key=" .
			$apiKey . "&deviceTag=" . $deviceTag;

		$options = array(
			'http'  => array (
				'method' => 'GET',
				'ignore_errors' => true,
			),
		);

		$context = stream_context_create($options);
		$response = file_get_contents($url, false, $context);
		$decoded = json_decode($response);
		$device= $decoded->device;
		$lock=$decoded->device->lock;
		$lockStatus= $lock->state;
		$expiration= $lock->expiration;
		$expirationDate= date('Y-m-d H:i:s', $expiration);

	//	print_r($device);
		$data = array(
			'lockStatus'=> $lockStatus,
			'expiration' => $expirationDate,
			'device'=> $device,
			'title' => "PayJoy Devices",
			'view' => "payjoy/devices.php",
		);
		$this->load->view('index.php', $data);
	}
	public function payjoy_deactivate_device(){

		$apiKey = 'M8ZmO79uXQEt_g7Y1cBxV-dWbQaEiJ63';
		$deviceTag = 'DWXTSZG';
		$url = "https://api.payjoy.com/devicemanager/v1/device/lock?key=" .
			$apiKey . "&deviceTag=" . $deviceTag . "&state=inactive";

		$options = array(
			'http'  => array (
				'method' => 'GET',
				'ignore_errors' => true,
			),
		);
		$context = stream_context_create($options);
		$response = file_get_contents($url, false, $context);
		$decoded = json_decode($response);

		$data = array(
			'message'=> 'Device state: inactive!',
			'title' => "PayJoy Devices",
			'view' => "payjoy/devices.php",
		);
		$this->load->view('index.php', $data);
	}
	public function payjoy_activate_device(){
		$apiKey = 'M8ZmO79uXQEt_g7Y1cBxV-dWbQaEiJ63';
		$deviceTag = 'DWXTSZG';
		$url = "https://api.payjoy.com/devicemanager/v1/device/lock?key=" .
			$apiKey . "&deviceTag=" . $deviceTag . "&state=active";

		$options = array(
			'http'  => array (
				'method' => 'GET',
				'ignore_errors' => true,
			),
		);
		$context = stream_context_create($options);
		$response = file_get_contents($url, false, $context);
		$decoded = json_decode($response);

		$data = array(
			'message'=> 'Device state: active!',
			'title' => "PayJoy Devices",
			'view' => "payjoy/devices.php",
		);
		$this->load->view('index.php', $data);
	}
	public function payjoy_lock_device(){
		$apiKey = 'M8ZmO79uXQEt_g7Y1cBxV-dWbQaEiJ63';
		$deviceTag = 'DWXTSZG';
		$expiration = time() ;

		$url = "https://api.payjoy.com/devicemanager/v1/device/lock?key=" .
			$apiKey . "&deviceTag=" . $deviceTag . "&state=active&expiration=" . $expiration;

		$options = array(
			'http'  => array (
				'method' => 'GET',
				'ignore_errors' => true,
			),
		);

		$context = stream_context_create($options);
		$response = file_get_contents($url, false, $context);
		$decoded = json_decode($response);

		$data = array(
			'message'=> 'Device state: active!',
			'title' => "PayJoy Devices",
			'view' => "payjoy/devices.php",
		);
		$this->load->view('index.php', $data);
	}
	public function payjoy_unlock_device(){
		$deviceTag = 'DWXTSZG';
		$apiKey = 'M8ZmO79uXQEt_g7Y1cBxV-dWbQaEiJ63';
		// unix timestamp. time now + one day
		//based on the subscription package; this timestamp will be updated accordingly after payment
		$expiration = time() + 86400;

		$url = "https://api.payjoy.com/devicemanager/v1/device/lock?key=" .
			$apiKey . "&deviceTag=" . $deviceTag . "&state=active&expiration=" . $expiration;

		$options = array(
			'http'  => array (
				'method' => 'GET',
				'ignore_errors' => true,
			),
		);

		$context = stream_context_create($options);
		$response = file_get_contents($url, false, $context);
		$decoded = json_decode($response);

		$data = array(
			'message'=> 'Device state: active!',
			'title' => "PayJoy Devices",
			'view' => "payjoy/devices.php",
		);
		$this->load->view('index.php', $data);
	}

}
