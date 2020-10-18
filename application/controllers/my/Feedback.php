<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends Admin_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('users_model');
		$this->load->model('content_model');
		$this->load->library('pagination');
	}

	public function index()
	{
		// init params
        $data = array();
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_new_messages();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_new_messages();
        $settings_pagination['base_url'] = base_url() . 'my/feedback/index';

        if ($total_records > 0) {
            // get current page records
            $data["messages"] = $this->content_model->get_new_messages($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

    	$this->template->set('title', "Обратная связь");
		$this->template->load('admin', 'contents' , 'my/feedback', $data);
	}

	public function archive()
	{
		// init params
        $data = array();
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_archive_messages();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_archive_messages();
        $settings_pagination['base_url'] = base_url() . 'my/feedback/archive';

        if ($total_records > 0) {
            // get current page records
            $data["messages"] = $this->content_model->get_archive_messages($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

    	$this->template->set('title', "Обратная связь");
		$this->template->load('admin', 'contents' , 'my/feedback_archive', $data);
	}

	public function edit($id)
	{
		if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/feedback'));

	    }

	    $message = $this->content_model->get_message($id);

	    if (!$message) {

	    	redirect(site_url('my/feedback'));

	    }

	    $data = array(
			"message" => $message
		);

    	$this->template->set('title', 'Сообщение от '.$message->name);
		$this->template->load('admin', 'contents' , 'my/feedback_edit', $data);

	}

	public function in_archive($id)
	{
		if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/feedback'));

	    }

	    $message = $this->content_model->get_message($id);

	    if (!$message) {

	    	redirect(site_url('my/feedback'));

	    } else {

	    	if (!$message->status) {

	    		$this->content_model->update_message($id, array(
	                "status"  =>  1
	                )
	            );

	            $this->session->set_flashdata('success', "Успешно обновлено!");
				redirect(site_url('my/feedback/edit/'.$id));

	    	} else {

	    		redirect(site_url('my/feedback/edit/'.$id));

	    	}

	    }

	}

	public function delete_message($id, $isRed=0)
	{
		if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/feedback'));

	    }

	    $message = $this->content_model->get_message($id);

	    if (!$message) {
			if ($isRed==0)
        	{
			redirect(site_url('my/feedback'));
			}
	    } else {

	    	$this->content_model->del_message($id);
			if ($isRed==0)
			{
	    		$this->session->set_flashdata('success', "Успешно удалено!");
				redirect(site_url('my/feedback'));
			}
	    }

	}

}