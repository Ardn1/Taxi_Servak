<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails extends Admin_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('users_model');
	}

	public function index()
	{

		$data = array(

		);

    	$this->template->set('title', "Email шлюз");
		$this->template->load('admin', 'contents' , 'my/emails', $data);
	}

	public function update_email()
	{
		$this->form_validation->set_rules('method', 'Метод отправки', 'trim|required|in_list[0,1]');
		$this->form_validation->set_rules('email', 'Email администратора', 'trim|required|max_length[60]|valid_email');
		$this->form_validation->set_rules('sender', 'Email отправителя', 'trim|required|max_length[60]|valid_email');
		$this->form_validation->set_rules('port', 'SMTP порт', 'trim|numeric');

		if ($this->form_validation->run() == true) {

			$method = $this->input->post("method", true);
			$email = $this->input->post("email", true);
			$sender = $this->input->post("sender", true);
			$port = $this->input->post("port", true);
			$host = $this->input->post("host", true);
			$smtp_password = $this->input->post("smtp_password", true);

			$this->settings_model->update_settings(array(
                "method"  		=>  $method,
                "email"  		=>  $email,
                "sender"  		=>  $sender,
                "port"  		=>  $port,
                "host"  		=>  $host,
                "smtp_password" =>  $method
                )
            );

            $this->session->set_flashdata('success', "Успешно обновлено!");
			redirect(site_url('my/emails'));

		} else {

			$this->session->set_flashdata('error', validation_errors());
			redirect(site_url('my/emails'));

		}
	}

}