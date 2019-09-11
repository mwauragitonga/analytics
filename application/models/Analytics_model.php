<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Analytics_model extends CI_Model
{
	/*get total count of students*/
	public function getStudentsCount()
	{
		$this->db->select('user_id');
		$this->db->from('users');
		$this->db->where('user_type', 1);
		$query = $this->db->get();
		return $query->num_rows();
	}

}
