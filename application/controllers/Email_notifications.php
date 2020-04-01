<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/** @noinspection ALL
 * @author Cyrus Muchiri
 * @mail cmuchiri8429@gmail.com
 * @date : 1st April 2020 1613hrs
 */

class Email_notifications extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	function notifications(){
		$students = array();
		foreach ($students as $student){
			$user_id = $student->user_id;
		$app_usage = $this->appUsage($user_id);
		$web_usage = $this->webUsage($user_id);
		$pdf_path =$this->generatePdf($app_usage,$web_usage);
		$this->sendMail($pdf_path);
		}
	}

	/**
	 * @param int $user_id
	 * @return array
	 */
	private function appUsage(int $user_id){
		$appUsage = array();
		return $appUsage;
	}

	/**
	 * @param int $user_id
	 * @return array
	 */
	private function webUsage(int $user_id){
		$webUsage = array();
		return $webUsage;
	}

	/**
	 * @param $appUsage
	 * @param $webUsage
	 * @return string
	 */
	private function generatePdf($appUsage , $webUsage ){
		return '';
	}

	/**
	 * @param $pdf_path
	 */
	private function sendMail($pdf_path){

	}
}
