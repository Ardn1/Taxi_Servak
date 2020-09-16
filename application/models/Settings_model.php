<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_model {

	public function get_settings() 
	{
		$query = $this->db->where("id", 1)->get("settings");
	    $row = $query->row();
	    return $row;
	}

	public function update_settings($data) 
	{
		$where = array('id' => 1);
		$this->db->where($where)->update("settings", $data);
	}

	public function get_templates() 
	{
        $query = $this->db->order_by('id', 'asc')->get("templates");
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }

            return $data;
        }
        return false;
	}

	public function get_template($id) 
	{
		$query = $this->db->where("id", $id)->get("templates");
	    $row = $query->row();
	    return $row;
	}

	public function update_template($id, $data) 
	{
		$where = array('id' => $id);
		$this->db->where($where)->update("templates", $data);
	}

}