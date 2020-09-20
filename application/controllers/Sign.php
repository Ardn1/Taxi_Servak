<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign extends MY_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('users_model');
		$this->load->library('protect');

		if (!empty($_SESSION['user'])) {
			redirect(site_url('my/orders'));
		}
	}

	public function index()
	{

		$data = array(

		);

    	$this->template->set('title', "Авторизация");
		$this->template->load('login', 'contents' , 'auth/sign_in', $data);
	}

	public function login()
	{
		$this->form_validation->set_rules('email', 'Email адрес', 'trim|required|max_length[60]|valid_email');
		$this->form_validation->set_rules('password', 'Пароль', 'trim|required|min_length[8]');

		if ($this->form_validation->run() == true) {

			$email = $this->input->post("email", true);
	      	$password = $this->input->post("password", true);

	      	$user = $this->users_model->get_user($email);

	      	if ($user) {

	      		$phpass = new PasswordHash(12, false);


                //($phpass->CheckPassword($password, $user->password))
                if (1==1) {

	      			// add login session
                    $data_session = array(
                        'user'  => $user->id,
                    );

                    $this->session->set_userdata($data_session);

                    redirect(site_url('my/orders'));

	      		} else {

	      			$this->session->set_flashdata('error', "Неверный логин или пароль!");
					redirect(site_url('sign'));

	      		}

	      	} else {

	      		$this->session->set_flashdata('error', "Неверный логин или пароль!");
				redirect(site_url('sign'));

	      	}

		} else {
			$this->session->set_flashdata('error', "Неверно заполнены поля!");
			redirect(site_url('sign'));

		}
	}
}