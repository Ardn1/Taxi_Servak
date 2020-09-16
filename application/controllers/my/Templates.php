<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends Admin_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('users_model');
	}

	public function index()
	{

		$templates = $this->settings_model->get_templates();

		$data = array(
			"templates" => $templates
		);

    	$this->template->set('title', "Шаблоны оповещений");
		$this->template->load('admin', 'contents' , 'my/templates', $data);
	}

	public function edit($id)
	{
		if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/templates'));

	    }

	    $template = $this->settings_model->get_template($id);

	    if (!$template) {

	    	redirect(site_url('my/templates'));

	    }

	    $data = array(
			"template" => $template
		);

    	$this->template->set('title', $template->name);
		$this->template->load('admin', 'contents' , 'my/template_edit', $data);

	}

	public function update_template($id)
	{
		if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/templates'));

	    }

	    $template = $this->settings_model->get_template($id);

	    if (!$template) {

	    	redirect(site_url('my/templates'));

	    }

	    $this->form_validation->set_rules('status', 'Статус', 'trim|required|in_list[0,1]');
	    $this->form_validation->set_rules('message', 'Текст сообщения', 'trim|required|min_length[3]');

	    if ($this->form_validation->run() == true) {

	    	$status = $this->input->post("status", true);
	    	$message = $this->input->post("message", true);

	    	$this->settings_model->update_template($id, array(
                "status"  =>  $status,
                "message" =>  $message
                )
            );

            $this->session->set_flashdata('success', "Успешно обновлено!");
			redirect(site_url('my/templates/edit/'.$id));

	    } else {

	    	$this->session->set_flashdata('error', "Неверно заполнена форма!");
			redirect(site_url('my/templates/edit/'.$id));

	    }
	}

}