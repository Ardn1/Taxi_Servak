<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taxopark extends Admin_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('content_model');
		$this->load->library('pagination');
		$this->load->library('protect');
	}

	public function index()
	{

		$data = array();

        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_workcity();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_workcity();
        $settings_pagination['base_url'] = base_url() . 'my/taxopark/index';

        if ($total_records > 0) {
            // get current page records
            $data["users"] = $this->content_model->get_taxopark($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

    	$this->template->set('title', "Изменение названий таксопарков");
		$this->template->load('admin', 'contents' , 'my/taxopark', $data);
	}

	public function updatemanager()
	{
		$this->form_validation->set_rules('email', 'Email адрес', 'trim|required|max_length[60]|valid_email');
		$this->form_validation->set_rules('password', 'Пароль', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('name', 'Имя', 'trim|required');
		$this->form_validation->set_rules('phone', 'Номер телефона', 'trim|required');

	//	$this->form_validation->set_rules('ismessegesallow', 'Разрешить отправку сообщений');

		if ($this->form_validation->run() == true) {

			$email = $this->input->post("email", true);
			$password = $this->input->post("password", true);
			$name = $this->input->post("name", true);
			$phone = $this->input->post("phone", true);
			  
			$check = $_POST["ismessegesallow"]=="Yes"?1:2;

			$stamp_pass = $this->protect->encrypt($password);
			
	     /* 	$this->users_model->add_user(array(
				"email"  =>  $email,
				"password"  =>  $stamp_pass,
				"ismanager"  =>  1,
                )
			);*/
			

			$this->db->query(
				"INSERT into users(email,password,ismanager,name,phone) VALUES('".$email."', '".$stamp_pass."',".$check.",'".$name."', '".$phone."')"
			);

            $this->session->set_flashdata('success', "Менеджер добавлен");
			redirect(site_url('my/addmenager'));

		} else {

			$this->session->set_flashdata('error', "Неверно заполнена форма!");
			redirect(site_url('my/addmenager'));

		}
	}

	public function update_all()
	{
		$id=$_GET['id'];
		$name=$_GET['name'];
		$where = array('id' => $id);
		$data = array(
			"name"  =>  $name
		);
		$this->db->where($where)->update("taxopark", $data);
		echo "Успешно изменено";
	}
}