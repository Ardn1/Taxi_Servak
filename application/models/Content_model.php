<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Content_model extends CI_model 
{

	public function get_pages() 
	{
        $query = $this->db->order_by('id', 'asc')->get("pages");
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

	public function get_page($id) 
	{
		$query = $this->db->where("id", $id)->get("pages");
	    $row = $query->row();
	    return $row;
	}

	public function update_page($id, $data) 
	{
		$where = array('id' => $id);
		$this->db->where($where)->update("pages", $data);
	}

	public function get_total_new_messages()
    {
        $where = array('status' => 0);
        $query = $this->db->where($where)->get("feedback");
        return $query->num_rows();
    }

    public function get_total_archive_messages()
    {
        $where = array('status' => 1);
        $query = $this->db->where($where)->get("feedback");
        return $query->num_rows();
    }

    public function get_new_messages($limit, $start)
    {
        $this->db->limit($limit, $start);
        $where = array('status' => 0);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("feedback");
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

    public function get_archive_messages($limit, $start)
    {
        $this->db->limit($limit, $start);
        $where = array('status' => 1);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("feedback");
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

    public function get_message($id) 
	{
		$query = $this->db->where("id", $id)->get("feedback");
	    $row = $query->row();
	    return $row;
	}

	public function update_message($id, $data) 
	{
		$where = array('id' => $id);
		$this->db->where($where)->update("feedback", $data);
	}

	public function del_message($id) 
	{
		$where = array('id' => $id);
		$this->db->where($where)->delete("feedback");
	}

    public function add_message($data)
    {
        $this->db->insert("feedback", $data);
        return $this->db->insert_id();
    }

	public function get_total_new_rent()
    {
        $where = array('status' => 0);
        $query = $this->db->where($where)->get("rent");
        return $query->num_rows();
    }

    public function get_total_success_rent()
    {
        $where = array('status' => 1);
        $query = $this->db->where($where)->get("rent");
        return $query->num_rows();
    }

    public function get_total_fail_rent()
    {
        $where = array('status' => 2);
        $query = $this->db->where($where)->get("rent");
        return $query->num_rows();
    }

    public function get_new_rent($limit, $start)
    {
        $this->db->limit($limit, $start);
        $where = array('status' => 0);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("rent");
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

    public function get_success_rent($limit, $start)
    {
        $this->db->limit($limit, $start);
        $where = array('status' => 1);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("rent");
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

    public function get_fail_rent($limit, $start)
    {
        $this->db->limit($limit, $start);
        $where = array('status' => 2);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("rent");
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

    public function get_rent($id) 
	{
		$query = $this->db->where("id", $id)->get("rent");
	    $row = $query->row();
	    return $row;
	}

    public function add_rent($data)
    {
        $this->db->insert("rent", $data);
        return $this->db->insert_id();
    }

	public function update_rent($id, $data) 
	{
		$where = array('id' => $id);
		$this->db->where($where)->update("rent", $data);
	}

	public function del_rent($id) 
	{
		$where = array('id' => $id);
		$this->db->where($where)->delete("rent");
	}

	public function get_total_new_orders()
    {
        $where = array('status' => 0);
        $query = $this->db->where($where)->get("orders");
        return $query->num_rows();
    }

    public function get_total_fail_orders()
    {
        $where = array('status' => 1);
        $query = $this->db->where($where)->get("orders");
        return $query->num_rows();
    }

    public function get_total_accept_orders()
    {
        $where = array('status' => 2);
        $query = $this->db->where($where)->get("orders");
        return $query->num_rows();
    }

    public function get_total_success_orders()
    {
        $where = array('status' => 3);
        $query = $this->db->where($where)->get("orders");
        return $query->num_rows();
    }

    public function get_total_short_orders()
    {
        $where = array('status' => 4);
        $query = $this->db->where($where)->get("orders");
        return $query->num_rows();
    }

    public function get_new_orders($limit, $start)
    {
        $this->db->limit($limit, $start);
        $where = array('status' => 0);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("orders");
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

    public function get_fail_orders($limit, $start)
    {
        $this->db->limit($limit, $start);
        $where = array('status' => 1);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("orders");
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

    public function get_accept_orders($limit, $start)
    {
        $this->db->limit($limit, $start);
        $where = array('status' => 2);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("orders");
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

    public function get_short_orders($limit, $start)
    {
        $this->db->limit($limit, $start);
        $where = array('status' => 4);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("orders");
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

    public function get_success_orders($limit, $start)
    {
        $this->db->limit($limit, $start);
        $where = array('status' => 3);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("orders");
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

    public function get_order($id) 
    {
        $query = $this->db->where("id", $id)->get("orders");
        $row = $query->row();
        return $row;
    }

    public function add_order($data)
    {
        $this->db->insert("orders", $data);
        return $this->db->insert_id();
    }

    public function update_order($id, $data) 
    {
        $where = array('id' => $id);
        $this->db->where($where)->update("orders", $data);
    }

    public function del_order($id) 
    {
        $where = array('id' => $id);
        $this->db->where($where)->delete("orders");
    }

    public function get_total_registratopn_search($phone)
    {
        $where = array('phone' => $phone);
        $query = $this->db->where($where)->get("orders");
        return $query->num_rows();
    }

    public function get_total_rent_search($phone)
    {
        $where = array('phone' => $phone);
        $query = $this->db->where($where)->get("rent");
        return $query->num_rows();
    }

    public function get_total_feedback_search($phone)
    {
        $where = array('phone' => $phone);
        $query = $this->db->where($where)->get("feedback");
        return $query->num_rows();
    }

    public function get_search_orders($phone)
    {
        $where = array('phone' => $phone);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("orders");
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

    public function get_search_rent($phone)
    {
        $where = array('phone' => $phone);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("rent");
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

    public function get_search_feedback($phone)
    {
        $where = array('phone' => $phone);
        $query = $this->db->order_by('id', 'desc')->where($where)->get("feedback");
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

}