<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rent extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('users_model');
        $this->load->model('content_model');
        $this->load->library('pagination');
        $this->load->library('sms');
        $this->load->library('aws');
    }

    public function index()
    {
        // init params
        $data = array();
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_new_rent();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_new_rent();
        $settings_pagination['base_url'] = base_url() . 'my/rent/index';

        if ($total_records > 0) {
            // get current page records
            $data["rent"] = $this->content_model->get_new_rent($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

        $this->template->set('title', "Аренда");
        $this->template->load('admin', 'contents', 'my/rent', $data);
    }

    public function accept()
    {
        // init params
        $data = array();
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_success_rent();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_success_rent();
        $settings_pagination['base_url'] = base_url() . 'my/rent/accept';

        if ($total_records > 0) {
            // get current page records
            $data["rent"] = $this->content_model->get_success_rent($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

        $this->template->set('title', "Аренда");
        $this->template->load('admin', 'contents', 'my/rent_accept', $data);
    }

    public function uncorrect()
    {
        // init params
        $data = array();
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_uncorrect_rent();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_uncorrect_rent();
        $settings_pagination['base_url'] = base_url() . 'my/rent/uncorrect';

        if ($total_records > 0) {
            // get current page records
            $data["rent"] = $this->content_model->get_uncorrect_rent($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

        $this->template->set('title', "Аренда");
        $this->template->load('admin', 'contents', 'my/rent_uncorrect', $data);
    }

    public function fail()
    {
        // init params
        $data = array();
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_fail_rent();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_fail_rent();
        $settings_pagination['base_url'] = base_url() . 'my/rent/fail';

        if ($total_records > 0) {
            // get current page records
            $data["rent"] = $this->content_model->get_fail_rent($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

        $this->template->set('title', "Аренда");
        $this->template->load('admin', 'contents', 'my/rent_fail', $data);
    }

    private function redirecter($forId)
    {
        if ($forId == 1) {
            redirect(site_url('my/rent'));
            return;
        }
        if ($forId == 2) {
            redirect(site_url('my/rent/accept'));
            return;
        }
        if ($forId == 3) {
            redirect(site_url('my/rent/uncorrect'));
            return;
        }
        if ($forId == 4) {
            redirect(site_url('my/rent/fail'));
            return;
        }

    }

    public function zamena(&$order,$what)
    {
        $order->{$what}=$this->aws->getFile(substr($order->{$what},2));
    }

    public function edit($id, $from=0)
    {
        if (is_null($id) or !is_numeric($id)) {

            redirect(site_url('my/rent'));

        }

        $rent = $this->content_model->get_rent($id);

        if (!$rent) {

            redirect(site_url('my/rent'));

        }
        
        ///
        $propertyes = array("vu1", "vu2", "pass1", "pass2");
        foreach ($propertyes as &$value) {
            if(strpos($order->{$value},"m:")!==false)
                $this->zamena($order,$value);
        }
        ///

        $data = array(
            "rent" => $rent,
            "from" => $from
        );

        $this->template->set('title', 'Заявка от ' . $rent->first_name);
        $this->template->load('admin', 'contents', 'my/rent_edit', $data);

    }

    public function reject($id, $isRed = 0)
    {
        if (is_null($id) or !is_numeric($id)) {

            redirect(site_url('my/rent'));

        }

        $rent = $this->content_model->get_rent($id);

        if (!$rent) {

            redirect(site_url('my/rent'));

        }

        $this->content_model->update_rent($id, array(
                "status" => 2
            )
        );

        $sms = $this->sms->send_sms($rent->phone, 4);

        $this->session->set_flashdata('success', 'Статус запрос успешно изменен!<br>Статус SMS: ' . $sms);
        if ($isRed == 0)
            redirect(site_url('my/rent'));
        else{
            $this->redirecter($isRed);
        }
    }

    public function successGet($id, $isRed = 0)
    {
        if (is_null($id) or !is_numeric($id)) {

            redirect(site_url('my/rent'));

        }

        $rent = $this->content_model->get_rent($id);

        if (!$rent) {

            redirect(site_url('my/rent'));

        }

        $this->content_model->update_rent($id, array(
                "status" => 1
            )
        );

        $sms = $this->sms->send_sms($rent->phone, 5);
    }

    public function success($id, $isRed = 0)
    {
        if (is_null($id) or !is_numeric($id)) {

            redirect(site_url('my/rent'));
            // header("Refresh:0");
        }

        $rent = $this->content_model->get_rent($id);

        if (!$rent) {

            redirect(site_url('my/rent'));
            // header("Refresh:0");
        }

        $this->content_model->update_rent($id, array(
                "status" => 1
            )
        );

        $sms = $this->sms->send_sms($rent->phone, 5);

        $this->session->set_flashdata('success', 'Статус запрос успешно изменен!<br>Статус SMS: ' . $sms);
        if ($isRed == 0)
            redirect(site_url('my/rent'));
        else{
            $this->redirecter($isRed);
        }
    }

    public function delete($id, $isRed=0)
    {
        if (is_null($id) or !is_numeric($id)) {
            header('Location: ' . $_SERVER['REQUEST_URI']);
        }

        $rent = $this->content_model->get_rent($id);

        if (!$rent) {
            redirect(site_url('my/rent'));
        }

        $this->content_model->del_rent($id);

        $this->session->set_flashdata('success', 'Заявка успешно удалена!');
        $this->redirecter($isRed);
    }


    public function uncorrectset($id, $isRed = 0)
    {
        if (is_null($id) or !is_numeric($id)) {
            redirect(site_url('my/rent'));
        }

        $rent = $this->content_model->get_rent($id);

        if (!$rent) {
            redirect(site_url('my/rent'));
        }

        $this->content_model->update_rent($id, array(
                "status" => 3
            )
        );

        $sms = $this->sms->send_sms($rent->phone, 10);

        $this->session->set_flashdata('success', 'Статус исправить фото успешно установлен!<br>Статус SMS: ' . $sms);
        if ($isRed == 0)
            redirect(site_url('my/rent'));
        else{
            $this->redirecter($isRed);
        }
    }
}