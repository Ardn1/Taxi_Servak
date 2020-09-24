<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailing extends Admin_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('users_model');
		$this->load->model('content_model');
		$this->load->library('pagination');
		$this->load->library('protect');
		$this->load->library('sms');
	}

	public function index()
	{

		$data = array();

        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_mailingphones();

        // load config file
        $this->config->load('pagination2', TRUE);
        $settings_pagination = $this->config->item('pagination2');
        $settings_pagination['total_rows'] = $this->content_model->get_total_mailingphones();
        $settings_pagination['base_url'] = base_url() . 'my/mailing/index';

        if ($total_records > 0) {
            // get current page records
            $data["phones"] = $this->content_model->get_phones($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

    	$this->template->set('title', "Добавление телефонов");
		$this->template->load('admin', 'contents' , 'my/mailing', $data);
	}

	public function sendSMS()
	{
		//$this->session->set_flashdata('success', "Сообщения отправленны");
		$this->sms->send_sms_text($_GET["phones"], $_GET["textSMS"]); 
	}

	public function addphone()
	{
		$this->form_validation->set_rules('phone', 'Телефон', 'trim|required|min_length[8]');//|valid_email');

		if ($this->form_validation->run() == true) {

			$phone = $this->input->post("phone", true);
			
			$this->db->query(
				"INSERT into phones(phone) VALUES('".$phone."')"
			);

            $this->session->set_flashdata('success', "Телефон для рассылки добавлен!");
			redirect(site_url('my/mailing'));

		} else {

			$this->session->set_flashdata('error', "Неверный формат!");
			redirect(site_url('my/mailing'));

		}
	}




	public function delete($id)
	{
		if (is_null($id) OR !is_numeric($id)) {

            redirect(site_url('my/mailing'));
	    }

	    $manager = $this->content_model->get_phone($id);

	    if (!$manager) {
	    	redirect(site_url('my/mailing'));
	    }

	    $this->content_model->del_phone($id);

		$this->session->set_flashdata('success', 'Телефон успешно удален!');
		redirect(site_url('my/mailing'));
	}

}