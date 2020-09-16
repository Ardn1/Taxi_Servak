<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Logout
     */
    public function index()
    {
        $this->session->unset_userdata('user');
        redirect(site_url('sign'));
    }

}