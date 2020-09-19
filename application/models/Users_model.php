<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_model {

	public function get_user($email) 
	{
		$query = $this->db->where("email", $email)->get("users");
	    $row = $query->row();
	    return $row;
	}

	public function get_user_from_id($id) 
	{
		$query = $this->db->where("id", $id)->get("users");
	    $row = $query->row();
	    return $row;
	}

	public function update_user($user, $data) 
	{
		$where = array('id' => $user);
		$this->db->where($where)->update("users", $data);
	}

	/*public function add_user($data) 
	{
		$this->db->insert($data);
	}*/
}