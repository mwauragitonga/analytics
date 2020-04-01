<?php
/*@Mwaura Gitonga*/


class Broadcasts_model extends CI_Model
{
	function __construct()
	{
	}
	public function getUserEmails(){
		$this->db->select('email');
		$this->db->from('users');
		$this->db->where('user_type', 1);
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}
}
