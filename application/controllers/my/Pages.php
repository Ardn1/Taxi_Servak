<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('users_model');
		$this->load->model('content_model');
	}

	public function index()
	{
		$pages = $this->content_model->get_pages();

		$data = array(
			"pages" => $pages
		);

    	$this->template->set('title', "Менеджер контента");
		$this->template->load('admin', 'contents' , 'my/pages', $data);
	}

	public function edit($id)
	{
		if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/pages'));

	    }

	    $page= $this->content_model->get_page($id);

	    if (!$page) {

	    	redirect(site_url('my/pages'));

	    }

	    $data = array(
			"page" => $page
		);

    	$this->template->set('title', $page->name);
		$this->template->load('admin', 'contents' , 'my/page_edit', $data);

	}

	public function update_page($id)
	{
		if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/pages'));

	    }

	    $page= $this->content_model->get_page($id);

	    if (!$page) {

	    	redirect(site_url('my/pages'));

	    }

	    $this->form_validation->set_rules('content', 'Текст сообщения', 'trim|required|min_length[3]');

	    if ($this->form_validation->run() == true) {

	    	$content = $this->input->post("content");

	    	$this->content_model->update_page($id, array(
                "content"  =>  $content
                )
            );


	    	$this->session->set_flashdata('success', "Успешно обновлено!");
			redirect(site_url('my/pages/edit/'.$id));

	    } else {

	    	$this->session->set_flashdata('error', "Неверно заполнена форма!");
			redirect(site_url('my/pages/edit/'.$id));

	    }

	}

}