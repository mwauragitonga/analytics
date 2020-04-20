<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** @noinspection ALL
 * @author Cyrus Muchiri
 * @mail cmuchiri8429@gmail.com
 * @date : 1st April 2020 1613hrs
 */
use Mpdf\Mpdf;
use Mpdf\MpdfException;



class Email_notifications extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AppModel', 'app');
		$this->load->model('Web_model', 'web');
	}

	function notifications()
	{

		$students = $this->app->getAllStudents('');
		//print_r($students);
		foreach ($students as $student)
		{
			$user_id = $student->user_id;
			$email = $student->email;
			$app_usage = $this->appUsage($user_id);
			$web_usage = $this->webUsage($user_id);

			//print_r($web_usage);
			try
			{
				$pdf_path = $this->generatePdf($app_usage, $web_usage, $student);
			} catch (MpdfException $e)
			{
				print_r($e);
			}
			$this->sendMail($student);
		}
	}

	/**
	 * @param int $user_id
	 * @return array
	 */
	private function appUsage(int $user_id)
	{
		$appUsage = $this->app->userStudyInfo($user_id, 'month');
		return $appUsage;
	}

	/**
	 * @param int $user_id
	 * @return array
	 */
	private function webUsage(int $user_id)
	{
		$webUsage = $this->web->userStudyInfo($user_id);
		return $webUsage;
	}

	/**
	 * @param $appUsage
	 * @param $webUsage
	 * @param $student
	 * @return string
	 * @throws MpdfException
	 */
	private function generatePdf($appUsage='', $webUsage='', $student='')
	{
		$mpdf = new mPDF(['tempDir' => APPPATH . 'views/reports/tmp']);
		$data = array(
			'webUsage' => $webUsage,
			'appUsage' => $appUsage,
			'student' => $student
		);
		try
		{
			$html = $this->load->view('reports/template', $data);
			$string_version = serialize($html);
			$mpdf->WriteHTML($string_version);
			$time = date('ymdhis');
			$mpdf->Output(APPPATH . 'views/reports/pdfs/' . $student->fname .'_'. $student->lname . '.pdf', 'F');
		} catch (MpdfException $e)
		{
			echo 'fail';
		}
		return '';
	}

	/**
	 * @param $student
	 * @return bool
	 */
	private function sendMail($student)
	{
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'dawati.co.ke';
		$config['smtp_port'] = '465';
		$config['smtp_user'] = 'usagenotifications@dawati.co.ke';
		$config['smtp_pass'] = 'D%bEPUE523yR';
		$config['smtp_crypto'] = 'ssl';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$data=array(
			'student' =>$student,
			'url' =>''
		);
		$body = $this->load->view('reports/email', $data, True);
		$this->email->set_mailtype("html");
		$this->email->from('usagenotifications@dawati.co.ke', 'Dawati');
		$this->email->to($student->email);
		$this->email->subject('Dawati App Usage For The Last Month');
		$this->email->message($body);
		//$this->email->message("Dear .$student->fname, \n. Find the attached document containing you dawati usage for the previous month");
		$this->email->attach(APPPATH . 'views/reports/pdfs/' . $student->fname .'_'. $student->lname.'.pdf');
		try
		{
			$this->email->send();
			unlink(APPPATH . 'views/reports/pdfs/' . $student->fname .'_'. $student->lname.'.pdf');

		} catch (Exception $e)
		{
			return FALSE;
		}

	}
}
