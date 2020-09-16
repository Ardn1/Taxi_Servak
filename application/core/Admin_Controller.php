<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller
{
    public $user;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('users_model');

        if (!empty($_SESSION['user'])) {

            $user = $this->users_model->get_user_from_id($_SESSION['user']);

            if ($user) {

                $this->user = $user;

            } else {

                $this->session->unset_userdata('user');
                redirect(site_url('sign'));

            }

        } else {

            redirect(site_url('sign'));

        }
    }
}