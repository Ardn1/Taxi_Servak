<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $settings;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('settings_model');

        $settings = $this->settings_model->get_settings();

        $this->settings = $settings;
    }

}