<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** @noinspection ALL
 * @author Cyrus Muchiri
 * @mail cmuchiri8429@gmail.com
 * @date : 28th April 2020 1613hrs
 */

class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('search_model','lookup');
	}
	public function searchView(){
		$data = array(
			'title' => "Search",
			'view' => "lookup/searchView.php"
		);
		$this->load->view('index.php', $data);
	}
	public function search()
	{
		$phrase = $this->input->post('phrase');
		$result = $this->lookup->search($phrase);
		if (empty($result)) {
			$data = array(
				'title' => "Search",
				'message' => 'No user is associated with the details',
				'view' => "lookup/searchView.php"
			);
			$this->load->view('index.php', $data);
		} else {
			$data = array(
				'result' => $result,
				'title' => "Student Look Up",
				'view' => "lookup/search.php"
			);
			$this->load->view('index.php', $data);
		}
	}
}
