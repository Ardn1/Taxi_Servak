<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends MY_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('users_model');
		$this->load->model('content_model');
	}

	public function get_page()
	{
		header('Access-Control-Allow-Origin: *');

		if (!empty($_GET["page_id"])) {

			$page_id = $this->security->xss_clean($_GET["page_id"]);

			$page = $this->content_model->get_page($page_id);

			if ($page) {

				$response = array ('event' => 'success', 'title' => $page->name, 'content' => $page->content);

				echo json_encode($response);

			} else {

				$response = array ('event' => 'fail', 'message' => 'Страница не найдена');

				echo json_encode($response);

			}

		} else {

			$response = array ('event' => 'fail', 'message' => 'Не получен ID страницы');

			echo json_encode($response);

		}
	}

}