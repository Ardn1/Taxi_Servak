<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller
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

    	$this->template->set('title', "Пароль и Email");
		$this->template->load('admin', 'contents' , 'my/profile', $data);
	}

	public function update_profile()
	{
		$this->form_validation->set_rules('email', 'Email адрес', 'trim|required|max_length[60]|valid_email');
		$this->form_validation->set_rules('password', 'Пароль', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('repassword', 'Повтор пароля', 'trim|required|matches[password]');
		if ($this->form_validation->run() == true) {

			$email = $this->input->post("email", true);
	      	$password = $this->input->post("password", true);

	      	$stamp_pass = $this->protect->encrypt($password);

	      	$this->users_model->update_user($this->user->id, array(
                "password"  =>  $stamp_pass
                )
            );
            $this->session->set_flashdata('success', "Успешно обновлено!");
			redirect(site_url('my/profile'));

		} else {

			$this->session->set_flashdata('error', "Неверно заполнена форма!");
			redirect(site_url('my/profile'));

		}
	}

	
	
	public function update_profileINFO()
	{
		$this->form_validation->set_rules('phone', 'Телефон администратора', 'trim|required|max_length[60]');
		$this->form_validation->set_rules('name', 'Имя отправителя', 'trim|required|max_length[60]');

		if ($this->form_validation->run() == true) {

			$phone = $this->input->post("phone", true);
			$name = $this->input->post("name", true);

			$this->users_model->update_user(1, array(
                "phone"  		=>  $phone,
                "name"  		=>  $name
                )
            );

            $this->session->set_flashdata('success', "Успешно обновлено!");
			redirect(site_url('my/profile'));

		} else {

			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('my/profile'));

		}
	}

}