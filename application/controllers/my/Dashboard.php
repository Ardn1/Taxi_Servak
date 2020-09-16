<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller
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

    	$this->template->set('title', "Дашборд");
		$this->template->load('admin', 'contents' , 'my/dashboard', $data);
	}
}