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

            if($phone[0]=='8') {
                $phone[0]='+7'.substr($phone,1);
            }
            if ($phone=='9'){
                $phone='+7'.$phone;
            }

            if(strlen($phone)!=12){
                $this->session->set_flashdata('error', "Неверно заполнена форма!");
                redirect(site_url('my/addmenager'));
                return;
            } else {

                $this->db->query(
                    "INSERT into users(email,password,ismanager,name,phone) VALUES('" . $email . "', '" . $stamp_pass . "'," . $check . ",'" . $name . "', '" . $phone . "')"
                );

                $this->session->set_flashdata('success', "Менеджер добавлен");
                redirect(site_url('my/addmenager'));
            }

		} else {

			$this->session->set_flashdata('error', "Неверно заполнена форма!");
			redirect(site_url('my/addmenager'));

		}
	}

	public function update_password()
	{
	    $password=$_GET['password'];

        if($_GET['id']==1){
            echo 'НЕВОЗМОЖНО ИЗМЕНИТЬ ПАРОЛЬ АДМИНИСТРАТОРА!';
            return;
        }

        if(strlen($password) < 8) {
            echo 'Пароль должен состоять не менее чем из 8 символов';
            return;
        }

		$stamp_pass = $this->protect->encrypt($_GET['password']);
		$this->users_model->update_user($_GET['id'], array(
			"password"  =>  $stamp_pass
			)
		);
		echo "Успешно изменено";
	}


	public function update_editing()
	{
	    $ismanager=$_GET['ismanager'];

        if($_GET['id']==1){
            echo 'НЕВОЗМОЖНО ИЗМЕНИТЬ ВОЗМОЖНОСТИ АДМИНИСТРАТОРА!';
            return;
        }

		$this->users_model->update_user($_GET['id'], array(
			"ismanager"  =>  $ismanager
			)
		);
		echo "Успешно изменено";
	}


	public function update_all()
	{
		$password=$_GET['password'];
		$name=$_GET['name'];
		$phone=$_GET['phone'];
		//$ismanager=$_GET['ismanager'];

        if ($phone[0]=='9'){
            $phone='+7'.$phone;
        }
        if ($phone[0]=='7'){
            $phone='+'.$phone;
        }
        if($phone[0]=='8') {
            $phone="+7".substr($phone,1);
        }

        if(strlen($phone)!=12){
            $this->session->set_flashdata('error', "Неверно заполнена форма!");
            echo 'Неверный номер!'.$phone;
            return;
        }


        if($_GET['id']==1){
            echo 'НЕВОЗМОЖНО ИЗМЕНИТЬ ПАРОЛЬ АДМИНИСТРАТОРА!';
            return;
        }

        if(strlen($password) < 8 && strlen($password) != 0) {
            echo 'Пароль должен состоять не менее чем из 8 символов '.$password;
            return;
        }

		if (strlen($password) == 0)
		{
			$this->users_model->update_user($_GET['id'], array(
				"name"  =>  $name,
				"phone"  =>  $phone,
				//"ismanager"  =>  $ismanager
				)
			);
		}
		else
		{
			$stamp_pass = $this->protect->encrypt($_GET['password']);
			$this->users_model->update_user($_GET['id'], array(
				"password"  =>  $stamp_pass,
				"name"  =>  $name,
				"phone"  =>  $phone,
				//"ismanager"  =>  $ismanager
				)
			);
		}
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