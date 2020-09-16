<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends Admin_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('users_model');
		$this->load->model('content_model');
		$this->load->library('pagination');
		$this->load->library('sms');
	}

	public function index()
	{
		$this->form_validation->set_rules('phone', "Номер телефона", 'trim|required|numeric|max_length[11]|min_length[11]');

		if ($this->form_validation->run() == false) {

			$this->session->set_flashdata('error', "Телефон указан неверно! Вводите в формате 79001234567");
			redirect(site_url('my/orders'));

		} else {

			$phone = $this->input->post("phone", true);

			$total_restration = $this->content_model->get_total_registratopn_search($phone);
			$total_rent = $this->content_model->get_total_rent_search($phone);
			$total_feedback = $this->content_model->get_total_feedback_search($phone);

			$restration = $this->content_model->get_search_orders($phone);
			$rent = $this->content_model->get_search_rent($phone);
			$feedback = $this->content_model->get_search_feedback($phone);

			$data = array(
				"total_restration" 	=> $total_restration,
				"total_rent" 		=> $total_rent,
				"total_feedback" 	=> $total_feedback,
				"restration" 		=> $restration,
				"rent" 				=> $rent,
				"feedback" 			=> $feedback,
				"phone" 			=> $phone
			);

	    	$this->template->set('title', "Поиск");
			$this->template->load('admin', 'contents' , 'my/search', $data);

		}
	}

}