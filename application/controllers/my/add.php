<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends Admin_Controller
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

        $this->template->set('title', "SMS шлюз");
        $this->template->load('admin', 'contents' , 'my/add', $data);
    }

    public function update_key()
    {
        $this->form_validation->set_rules('key', 'API ключ', 'trim|required|min_length[8]');

        if ($this->form_validation->run() == true) {

            $key = $this->input->post("key", true);

            $this->settings_model->update_settings(array(
                    "sms_api"  =>  $key
                )
            );

            $this->session->set_flashdata('success', "Успешно обновлено!");
            redirect(site_url('my/add'));

        } else {

            $this->session->set_flashdata('error', "Неверно заполнена форма!");
            redirect(site_url('my/add'));

        }
    }
}