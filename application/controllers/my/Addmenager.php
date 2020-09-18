<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addmenager extends Admin_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('users_model');
		$this->load->library('protect');
	}

	public function index()
	{

		$data = array(

		);

    	$this->template->set('title', "Добавление менеджеров");
		$this->template->load('admin', 'contents' , 'my/addmenager', $data);
	}

	public function update_manager()
	{
		$this->form_validation->set_rules('email', 'Email адрес', 'trim|required|max_length[60]|valid_email');
		$this->form_validation->set_rules('password', 'Пароль', 'trim|required|min_length[8]');

		if ($this->form_validation->run() == true) {

			$email = $this->input->post("email", true);
	      	$password = $this->input->post("password", true);

	      	$stamp_pass = $this->protect->encrypt($password);

	      	$this->users_model->update_user($this->user->id, array(
                "password"  =>  $stamp_pass
                )
            );

            $this->session->set_flashdata('success', "Менеджер добавлен");
			redirect(site_url('my/addmenager'));

		} else {

			$this->session->set_flashdata('error', "Неверно заполнена форма!");
			redirect(site_url('my/addmenager'));

		}
	}

}