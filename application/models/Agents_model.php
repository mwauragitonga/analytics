<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/*Author Cyrus*/

class Agents_model extends CI_Model
{
	/*public function __construct()
	{
		parent::__construct();
	}*/
	public function select_agents()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('referal_agents','user_id = agent_id');
		$this->db->where('user_type',6);
		return $this->db->get()->result();

	}
	public function checkmail($email)
	{
		$this->db->from('users');
		$this->db->where('email', $email);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return "false";
		} else {
			return "true";
		}
	}

	public function checkmobile($phone)
	{
		$this->db->from('users');
		$this->db->where('mobile', $phone);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return "false";
		} else {
			return "true";
		}
	}



	public function add_agents($data)
	{
		$this->db->insert('users', $data);
		$users_id = $this->db->insert_id();
		$agents_data = array(
			'agent_id'=> $users_id,
			'referal_code'=>$data['hash']
		);
		$this->db->insert('referal_agents', $agents_data);
	}
}
