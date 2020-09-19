<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addmenager extends Admin_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('users_model');
		$this->load->model('content_model');
		$this->load->library('pagination');
		$this->load->library('protect');
	}

	public function index()
	{

		$data = array();

        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_manager();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_manager();
        $settings_pagination['base_url'] = base_url() . 'my/addmenager/index';

        if ($total_records > 0) {
            // get current page records
            $data["users"] = $this->content_model->get_manager($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

    	$this->template->set('title', "Добавление менеджеров");
		$this->template->load('admin', 'contents' , 'my/addmenager', $data);
	}

	public function updatemanager()
	{
		$this->form_validation->set_rules('email', 'Email адрес', 'trim|required|max_length[60]|valid_email');
		$this->form_validation->set_rules('password', 'Пароль', 'trim|required|min_length[8]');

		if ($this->form_validation->run() == true) {

			$email = $this->input->post("email", true);
	      	$password = $this->input->post("password", true);

			$stamp_pass = $this->protect->encrypt($password);
			
	     /* 	$this->users_model->add_user(array(
				"email"  =>  $email,
				"password"  =>  $stamp_pass,
				"ismanager"  =>  1,
                )
			);*/
			
			$this->db->query(
				"INSERT into users(email,password,ismanager) VALUES('".$email."', '".$stamp_pass."',1)"
			);

            $this->session->set_flashdata('success', "Менеджер добавлен");
			redirect(site_url('my/addmenager'));

		} else {

			$this->session->set_flashdata('error', "Неверно заполнена форма!");
			redirect(site_url('my/addmenager'));

		}
	}

	public function update_password()
	{
	    $password=$_GET['password'];


        if(strlen($password) < 6) {
            echo 'Пароль должен состоять не менее чем из 6 символов';
            return;
        }

		$stamp_pass = $this->protect->encrypt($_GET['password']);
		$this->users_model->update_user($_GET['id'], array(
			"password"  =>  $stamp_pass
			)
		);
		$this->session->set_flashdata('success', "Пароль успешно изменен!");
		echo "Успешно изменено";
	}

	public function delete($id)
	{
		if (is_null($id) OR !is_numeric($id) OR $id == 1) {

            redirect(site_url('my/addmenager'));

	    }

	    $manager = $this->content_model->get_onemanager($id);

	    if (!$manager) {
	    	redirect(site_url('my/addmenager'));
	    }

	    $this->content_model->del_manager($id);

		$this->session->set_flashdata('success', 'Менеджер успешно удален!');
		redirect(site_url('my/addmenager'));
	}

}