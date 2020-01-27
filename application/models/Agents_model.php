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
	function agentName($agent_code){

		$this->db->select('fname');
		$this->db->from('users');
		$this->db->where('hash',$agent_code);
		return $this->db->get()->row()->fname;
	}
	function referalByAgents($agent_code){
		$this->db->select('fname,name,level_name,date_joined');
		$this->db->from('users');
		$this->db->join('users_agents','users.user_ID= users_agents.user_ID');
		$this->db->join("students", "users.user_ID = students.user_ID");
		$this->db->join("schools", "students.school_code = schools.school_code");
		$this->db->join("study_levels", "students.study_level = study_levels.level_code	");
		$this->db->where('users_agents.agent_code',$agent_code);
		return $this->db->get()->result();
	}
	function registered_schools($agent_code){
		$this->db->select('count(users.user_ID) as count');
		$this->db->from('users');
		$this->db->join('students','users.user_ID = students.user_ID');
		$this->db->join('schools','schools.school_code = students.school_code');
		$this->db->join('users_agents','users.user_ID= users_agents.user_ID');
		$this->db->where('users_agents.agent_code',$agent_code);
		$this->db->group_by("students.school_code");
		$this->db->order_by("count",'DESC');
		$count = $this->db->get()->num_rows();
		return $count;
	}
	function paidStudents($agent_code){
		$this->db->select('count(users.user_ID) as paid_students,SUM(amount) as total_revenue');
		$this->db->from('users');
		$this->db->join('users_agents','users.user_ID= users_agents.user_ID');
		$this->db->join('mpesa_callbacks','users.email = mpesa_callbacks.email');
		$this->db->where('users_agents.agent_code',$agent_code);
		return $this->db->get()->row();
	}
}
