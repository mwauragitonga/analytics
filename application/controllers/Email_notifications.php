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

		$students = $this->app->getAllStudents();
		foreach ($students as $student)
		{
			$user_id = $student->user_id;
			$email = $student->email;
			$app_usage = $this->appUsage($user_id);
			$web_usage = $this->webUsage($user_id);
			try
			{
				$pdf_path = $this->generatePdf($app_usage, $web_usage, $student);
			} catch (MpdfException $e)
			{
			}
			$this->sendMail($pdf_path,$email);
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
			$mpdf->Output(APPPATH . 'views/reports/pdfs/' . $time . '.pdf', 'F');
		} catch (MpdfException $e)
		{
		}
		return '';
	}

	/**
	 * @param $pdf_path
	 * @param $email
	 * @return bool
	 */
	private function sendMail($pdf_path,$email)
	{
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
		$this->email->subject('Dawati App Usage For The Last Month');
		//select newest file
		$files = scandir(APPPATH . 'views/reports/pdfs/', SCANDIR_SORT_DESCENDING);
		$newest_file = $files[0];
		$this->email->message('Generated Report on ' . $title);
		$this->email->attach(APPPATH . 'views/reports/pdfs/' . $newest_file);
		try
		{
			if ($this->email->send())
			{
				echo 'Email sent';
			} else
			{
				echo 'Fail';
			}
			unlink(APPPATH . 'views/reports/pdfs/' . $newest_file);

		} catch (Exception $e)
		{
			return FALSE;
		}

	}
}
