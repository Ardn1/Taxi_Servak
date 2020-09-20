<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller
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
		// init params
        $data = array();
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_new_orders();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_new_orders();
        $settings_pagination['base_url'] = base_url() . 'my/orders/index';

        if ($total_records > 0) {
            // get current page records
            $data["orders"] = $this->content_model->get_new_orders($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

    	$this->template->set('title', "Регистрация");
		$this->template->load('admin', 'contents' , 'my/orders', $data);
	}

    public function fail()
    {
        // init params
        $data = array();
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_fail_orders();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_fail_orders();
        $settings_pagination['base_url'] = base_url() . 'my/orders/fail';

        if ($total_records > 0) {
            // get current page records
            $data["orders"] = $this->content_model->get_fail_orders($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

        $this->template->set('title', "Регистрация");
        $this->template->load('admin', 'contents' , 'my/orders_fail', $data);
    }

    public function accepting()
    {
        // init params
        $data = array();
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_accept_orders();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_accept_orders();
        $settings_pagination['base_url'] = base_url() . 'my/orders/accepting';

        if ($total_records > 0) {
            // get current page records
            $data["orders"] = $this->content_model->get_accept_orders($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

        $this->template->set('title', "Регистрация");
        $this->template->load('admin', 'contents' , 'my/orders_accept', $data);
    }

    public function success()
    {
        // init params
        $data = array();
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_success_orders();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_accept_orders();
        $settings_pagination['base_url'] = base_url() . 'my/orders/success';

        if ($total_records > 0) {
            // get current page records
            $data["orders"] = $this->content_model->get_success_orders($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

        $this->template->set('title', "Регистрация");
        $this->template->load('admin', 'contents' , 'my/orders_success', $data);
    }

    public function uncorrect()
    {
        // init params
        $data = array();
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_uncorrect_orders();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_uncorrect_orders();
        $settings_pagination['base_url'] = base_url() . 'my/orders/uncorrect';

        if ($total_records > 0) {
            // get current page records
            $data["orders"] = $this->content_model->get_uncorrect_orders($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

        $this->template->set('title', "Исправить фото");
        $this->template->load('admin', 'contents' , 'my/orders_uncorrect', $data);
    }

    public function short()
    {
        // init params
        $data = array();
        $start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $total_records = $this->content_model->get_total_short_orders();

        // load config file
        $this->config->load('pagination', TRUE);
        $settings_pagination = $this->config->item('pagination');
        $settings_pagination['total_rows'] = $this->content_model->get_total_short_orders();
        $settings_pagination['base_url'] = base_url() . 'my/orders/short';

        if ($total_records > 0) {
            // get current page records
            $data["orders"] = $this->content_model->get_short_orders($settings_pagination['per_page'], $start_index);
            // use the settings to initialize the library
            $this->pagination->initialize($settings_pagination);
            // build paging links
            $data["links"] = $this->pagination->create_links();
        }

        $data["total_records"] = $total_records;

        $this->template->set('title', "Регистрация");
        $this->template->load('admin', 'contents' , 'my/orders_short', $data);
    }

    public function edit($id)
    {
        if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/orders'));

        }

        $order = $this->content_model->get_order($id);

        if (!$order) {

            redirect(site_url('my/orders'));

        }

        $data = array(
            "order" => $order
        );

        $this->template->set('title', 'Заявка от '.$order->name);
        $this->template->load('admin', 'contents' , 'my/orders_edit', $data);

    }

    public function accept($id, $isRed = 0)
    {
        if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/orders'));

        }

        $order = $this->content_model->get_order($id);

        if (!$order) {

            redirect(site_url('my/orders'));

        }

        if (!$order->status) {

            $sms = $this->sms->send_sms($order->phone, 2);

            $this->content_model->update_order($id, array(
                "status" => 2
                )
            );

            $this->session->set_flashdata('success', 'Статус заявки успешно изменен!<br>Статус SMS: '.$sms);
            if($isRed==0)
                redirect(site_url('my/orders/edit/'.$id));

        } else {
            redirect(site_url('my/orders'));

        }

    }

    public function uncorrectset($id, $isRed = 0)
    {
        if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/orders'));

        }

        $order = $this->content_model->get_order($id);

        if (!$order) {

            redirect(site_url('my/orders'));

        }

        if (!$order->status) {

            $sms = $this->sms->send_sms($order->phone, 2);

            $this->content_model->update_order($id, array(
                    "status" => 5
                )
            );

            $this->session->set_flashdata('success', 'Статус заявки успешно изменен!<br>Статус SMS: '.$sms);
            if($isRed==0)
                redirect(site_url('my/orders/edit/'.$id));

        } else {
            redirect(site_url('my/orders'));

        }

    }

    public function reject($id)
    {
        if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/orders'));

        }

        $order = $this->content_model->get_order($id);

        if (!$order) {

            redirect(site_url('my/orders'));

        }

        $sms = $this->sms->send_sms($order->phone, 1);

        $this->content_model->update_order($id, array(
            "status" => 1
            )
        );

        $this->session->set_flashdata('success', 'Статус заявки успешно изменен!<br>Статус SMS: '.$sms);
        redirect(site_url('my/orders/edit/'.$id));

    }

    public function created($id)
    {
        if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/orders'));

        }

        $order = $this->content_model->get_order($id);

        if (!$order) {

            redirect(site_url('my/orders'));

        }

        if ($order->status == 2) {

            $sms = $this->sms->send_sms($order->phone, 3);

            $this->content_model->update_order($id, array(
                "status" => 3
                )
            );

            $this->session->set_flashdata('success', 'Статус заявки успешно изменен!<br>Статус SMS: '.$sms);
            redirect(site_url('my/orders/edit/'.$id));

        } else {

            redirect(site_url('my/orders'));

        }

    }

    public function delete_order($id)
    {
        if (is_null($id) OR ! is_numeric($id)) {

            redirect(site_url('my/orders'));

        }

        $order = $this->content_model->get_order($id);

        if (!$order) {

            redirect(site_url('my/orders'));

        }

        $this->content_model->del_order($id);

        $this->session->set_flashdata('success', 'Заявка удалена!');
        redirect(site_url('my/orders'));

    }

}