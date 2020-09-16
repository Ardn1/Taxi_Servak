<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller
{
	public function __construct()
    {
		parent::__construct();

		$this->load->model('users_model');
		$this->load->model('content_model');
		$this->load->library('sms');
	}

	public function feedback()
	{
		header('Access-Control-Allow-Origin: *');

		$this->form_validation->set_rules('message', "Вопрос", 'trim|required|max_length[4000]|min_length[5]');
		$this->form_validation->set_rules('name', "Имя", 'trim|required|max_length[150]|min_length[3]');
		$this->form_validation->set_rules('phone', "Номер телефона", 'trim|required|numeric|max_length[11]|min_length[11]');

		if ($this->form_validation->run() == false) {

			$response = array ('event' => 'fail', 'message' => validation_errors());

			echo json_encode($response);

		} else {

			// Set variables for input data
	      	$message = $this->input->post("message", true);
	      	$name = $this->input->post("name", true);
	      	$phone = $this->input->post("phone", true);

	      	$this->content_model->add_message(array(
	            "status"  	=> 0,
	            "created"	=> date('Y-m-d H:i:s'),
	            "name"		=> $name,
	            "message"	=> $message,
	            "phone"		=> $phone
	            )
	        );

	        $response = array ('event' => 'success');

			echo json_encode($response);

			$email_template = $this->settings_model->get_template(8);

			if ($email_template->status) {

				$messages = $email_template->message;
                $email_variables = array('[NAME]', '[MESSAGE]');
                $code_variable = array($name, $message);
                $replace = str_replace($email_variables, $code_variable, $messages);
                $this->sms->send_email($this->settings->email, $email_template->name, $replace);

			}

		}
	}

	public function rent()
	{
		header('Access-Control-Allow-Origin: *');

		$this->form_validation->set_rules('citizenship', "Гражданство", 'trim|required|in_list[1-5]');
		$this->form_validation->set_rules('city', "Город", 'trim|required|in_list[1-23]');
		$this->form_validation->set_rules('age', "Возраст", 'trim|required|numeric');
		$this->form_validation->set_rules('first_name', "Имя", 'trim|required|max_length[150]|min_length[3]');
		$this->form_validation->set_rules('last_name', "Фамилия", 'trim|required|max_length[150]|min_length[3]');
		$this->form_validation->set_rules('phone', "Номер телефона", 'trim|required|numeric|max_length[11]|min_length[11]');

		if ($this->form_validation->run() == false) {

			$response = array ('event' => 'fail', 'message' => validation_errors());

			echo json_encode($response);

		} else {

			// Set variables for input data
	      	$citizenship = $this->input->post("citizenship", true);
	      	$city = $this->input->post("city", true);
	      	$age = $this->input->post("age", true);
	      	$first_name = $this->input->post("first_name", true);
	      	$last_name = $this->input->post("last_name", true);
	      	$phone = $this->input->post("phone", true);

	      	$this->content_model->add_rent(array(
	            "status"  		=> 0,
	            "created"		=> date('Y-m-d H:i:s'),
	            "first_name"	=> $first_name,
	            "last_name"		=> $last_name,
	            "citizenship"	=> $citizenship,
	            "city"			=> $city,
	            "age"			=> $age,
	            "phone"			=> $phone
	            )
	        );

	        $response = array ('event' => 'success');

			echo json_encode($response);

			$email_template = $this->settings_model->get_template(6);

			if ($email_template->status) {

				$messages = $email_template->message;
                $email_variables = array('[NAME]', '[AGE]', '[CITY]', '[PHONE]',);
                $code_variable = array($first_name, $age, $city, $phone);
                $replace = str_replace($email_variables, $code_variable, $messages);
                $this->sms->send_email($this->settings->email, $email_template->name, $replace);

			}

		}
	}

	public function registeronestep()
	{
		header('Access-Control-Allow-Origin: *');

		$this->form_validation->set_rules('jobcity', "Город работы", 'trim|required|in_list[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]');
		$this->form_validation->set_rules('name', "Имя", 'trim|required|max_length[150]|min_length[3]');
		$this->form_validation->set_rules('phone', "Номер телефона", 'trim|required|numeric|max_length[11]|min_length[11]');
		$this->form_validation->set_rules('registration', "Гражданство", 'trim|required|in_list[1,2,3]');

		if ($this->form_validation->run() == false) {

			$response = array ('event' => 'fail', 'message' => validation_errors());

			echo json_encode($response);

		} else {

			// Set variables for input data
	      	$jobcity = $this->input->post("jobcity", true);
	      	$name = $this->input->post("name", true);
	      	$phone = $this->input->post("phone", true);
	      	$registration = $this->input->post("registration", true);

	      	$id = $this->content_model->add_order(array(
	            "status"  		=> 4,
	            "created"		=> date('Y-m-d H:i:s'),
	            "cityjob"		=> $jobcity,
	            "name"			=> $name,
	            "phone"			=> $phone,
	            "registration"	=> $registration
	            )
	        );

	        if ($jobcity == 1) {

	        	if ($registration == 1) {

	        		$type = 1;

	        	} else {

	        		$type = 2;

	        	}

	        } else {

	        	if ($registration == 1) {

	        		$type = 3;

	        	} else {

	        		$type = 4;

	        	}

	        }

	      	$response = array ('event' => 'success', 'order' => $id, 'type' => $type);

			echo json_encode($response);

		}
	}

	public function upload_vu_one()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_vu_1"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function upload_vu_two()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_vu_2"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function upload_sts_one()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_sts_1"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function upload_sts_two()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_sts_2"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function upload_pass1()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_pass_1"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function upload_pass2()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_pass_2"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function upload_lic1()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_license_1"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function upload_lic2()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_license_2"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function upload_auto1()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_auto_1"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function upload_auto2()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_auto_2"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function upload_face()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_face"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function upload_reg1()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_reg_1"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function upload_reg2()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	if (!$_FILES['files']['name']) {

			    $response = array ('event' => 'fail', 'message' => 'Изображение не получено!');

				echo json_encode($response);

			} else {

				$uid = rand(11111111111111,99999999999999);

				$info = pathinfo($_FILES['files']['name']);
				$ext = $info['extension'];
				$newname = $uid.'.'.$ext; 

				$target = ''.$_SERVER['DOCUMENT_ROOT'].'/docs/'.$newname;
				move_uploaded_file($_FILES['files']['tmp_name'], $target);

				$this->content_model->update_order($_GET["order"], array(
		            "doc_reg_2"	=> $newname
		            )
		        );

			    $response = array ('event' => 'success');

				echo json_encode($response);

			}

	    }

	}

	public function check_order()
	{
		header('Access-Control-Allow-Origin: *');

		if (empty($_GET["order"])) {

            $response = array ('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

			echo json_encode($response);

	    } else {

	    	$order = $this->content_model->get_order($_GET["order"]);

	    	if ($order->cityjob == 1) {

	        	if ($order->registration == 1) {

	        		$type = 1;

	        	} else {

	        		$type = 2;

	        	}

	        } else {

	        	if ($order->registration == 1) {

	        		$type = 3;

	        	} else {

	        		$type = 4;

	        	}

	        }

	        if ($type == 1) {

	        	if ($order->doc_vu_1) {

	        		if ($order->doc_vu_2) {

	        			if ($order->doc_sts_1) {

	        				if ($order->doc_sts_2) {

	        					if ($order->doc_auto_1) {

	        						if ($order->doc_auto_2) {

	        							if ($order->doc_face) {

	        								if ($order->doc_pass_1) {

	        									if ($order->doc_pass_2) {

	        										if ($order->doc_license_1) {

	        											if ($order->doc_license_2) {

	        												$this->content_model->update_order($_GET["order"], array(
													            "status"	=> 0
													            )
													        );

	        												$response = array ('event' => 'success');

															echo json_encode($response);

															$email_template = $this->settings_model->get_template(7);

															if ($email_template->status) {

																$messages = $email_template->message;
												                $email_variables = array('[NAME]');
												                $code_variable = array($order->name);
												                $replace = str_replace($email_variables, $code_variable, $messages);
												                $this->sms->send_email($this->settings->email, $email_template->name, $replace);

															}

									        			} else {

									        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию лицензии (сторона 2)');

															echo json_encode($response);

									        			}

								        			} else {

								        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию лицензии (сторона 1)');

														echo json_encode($response);

								        			}

							        			} else {

							        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию паспорта (страница с пропиской)');

													echo json_encode($response);

							        			}

						        			} else {

						        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию паспорта (основной разворот)');

												echo json_encode($response);

						        			}

					        			} else {

					        				$response = array ('event' => 'fail', 'message' => 'Добавьте личную фотографию');

											echo json_encode($response);

					        			}

				        			} else {

				        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию автомобиля (сзади с другого бока)');

										echo json_encode($response);

				        			}

			        			} else {

			        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию автомобиля (спереди с одного бока)');

									echo json_encode($response);

			        			}

		        			} else {

		        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию Свидетельства о регистрации ТС (сторона 2)');

								echo json_encode($response);

		        			}

	        			} else {

	        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию Свидетельства о регистрации ТС (сторона 1)');

							echo json_encode($response);

	        			}

	        		} else {

	        			$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию водительского удостоверения (обратная сторона)');

						echo json_encode($response);

	        		}

	        	} else {

	        		$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию водительского удостоверения (внешняя сторона)');

					echo json_encode($response);

	        	}

	        } elseif ($type == 2) {

	        	if ($order->doc_vu_1) {

	        		if ($order->doc_vu_2) {

	        			if ($order->doc_sts_1) {

	        				if ($order->doc_sts_2) {

	        					if ($order->doc_auto_1) {

	        						if ($order->doc_auto_2) {

	        							if ($order->doc_face) {

	        								if ($order->doc_pass_1) {

	        									if ($order->doc_reg_1) {

	        										if ($order->doc_reg_2) {

	        											if ($order->doc_license_1) {

		        											if ($order->doc_license_2) {

		        												$this->content_model->update_order($_GET["order"], array(
														            "status"	=> 0
														            )
														        );

		        												$response = array ('event' => 'success');

																echo json_encode($response);

																$email_template = $this->settings_model->get_template(7);

																if ($email_template->status) {

																	$messages = $email_template->message;
													                $email_variables = array('[NAME]');
													                $code_variable = array($order->name);
													                $replace = str_replace($email_variables, $code_variable, $messages);
													                $this->sms->send_email($this->settings->email, $email_template->name, $replace);

																}

										        			} else {

										        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию лицензии (сторона 2)');

																echo json_encode($response);

										        			}

									        			} else {

									        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию лицензии (сторона 1)');

															echo json_encode($response);

									        			}

								        			} else {

								        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию регистрации (бланк 2)');

														echo json_encode($response);

								        			}

							        			} else {

							        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию регистрации (бланк 1)');

													echo json_encode($response);

							        			}

						        			} else {

						        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию паспорта (основной разворот)');

												echo json_encode($response);

						        			}

					        			} else {

					        				$response = array ('event' => 'fail', 'message' => 'Добавьте личную фотографию');

											echo json_encode($response);

					        			}

				        			} else {

				        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию автомобиля (сзади с другого бока)');

										echo json_encode($response);

				        			}

			        			} else {

			        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию автомобиля (спереди с одного бока)');

									echo json_encode($response);

			        			}

		        			} else {

		        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию Свидетельства о регистрации ТС (сторона 2)');

								echo json_encode($response);

		        			}

	        			} else {

	        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию Свидетельства о регистрации ТС (сторона 1)');

							echo json_encode($response);

	        			}

	        		} else {

	        			$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию водительского удостоверения (обратная сторона)');

						echo json_encode($response);

	        		}

	        	} else {

	        		$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию водительского удостоверения (внешняя сторона)');

					echo json_encode($response);

	        	}

	        } elseif ($type == 3) {

	        	if ($order->doc_vu_1) {

	        		if ($order->doc_vu_2) {

	        			if ($order->doc_sts_1) {

	        				if ($order->doc_sts_2) {

	        					if ($order->doc_auto_1) {

	        						if ($order->doc_auto_2) {

	        							if ($order->doc_face) {

	        								if ($order->doc_pass_1) {

	        									if ($order->doc_pass_2) {

	        										$this->content_model->update_order($_GET["order"], array(
														"status"	=> 0
														)
													);

	        										$response = array ('event' => 'success');

													echo json_encode($response);

													$email_template = $this->settings_model->get_template(7);

															if ($email_template->status) {

																$messages = $email_template->message;
												                $email_variables = array('[NAME]');
												                $code_variable = array($order->name);
												                $replace = str_replace($email_variables, $code_variable, $messages);
												                $this->sms->send_email($this->settings->email, $email_template->name, $replace);

															}

							        			} else {

							        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию паспорта (страница с пропиской)');

													echo json_encode($response);

							        			}

						        			} else {

						        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию паспорта (основной разворот)');

												echo json_encode($response);

						        			}

					        			} else {

					        				$response = array ('event' => 'fail', 'message' => 'Добавьте личную фотографию');

											echo json_encode($response);

					        			}

				        			} else {

				        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию автомобиля (сзади с другого бока)');

										echo json_encode($response);

				        			}

			        			} else {

			        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию автомобиля (спереди с одного бока)');

									echo json_encode($response);

			        			}

		        			} else {

		        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию Свидетельства о регистрации ТС (сторона 2)');

								echo json_encode($response);

		        			}

	        			} else {

	        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию Свидетельства о регистрации ТС (сторона 1)');

							echo json_encode($response);

	        			}

	        		} else {

	        			$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию водительского удостоверения (обратная сторона)');

						echo json_encode($response);

	        		}

	        	} else {

	        		$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию водительского удостоверения (внешняя сторона)');

					echo json_encode($response);

	        	}

	        } elseif ($type == 4) {

	        	if ($order->doc_vu_1) {

	        		if ($order->doc_vu_2) {

	        			if ($order->doc_sts_1) {

	        				if ($order->doc_sts_2) {

	        					if ($order->doc_auto_1) {

	        						if ($order->doc_auto_2) {

	        							if ($order->doc_face) {

	        								if ($order->doc_pass_1) {

	        									if ($order->doc_reg_1) {

	        										if ($order->doc_reg_2) {

	        											$this->content_model->update_order($_GET["order"], array(
														    "status"	=> 0
														    )
														);

	        											$response = array ('event' => 'success');

														echo json_encode($response);

														$email_template = $this->settings_model->get_template(7);

															if ($email_template->status) {

																$messages = $email_template->message;
												                $email_variables = array('[NAME]');
												                $code_variable = array($order->name);
												                $replace = str_replace($email_variables, $code_variable, $messages);
												                $this->sms->send_email($this->settings->email, $email_template->name, $replace);

															}

								        			} else {

								        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию регистрации (бланк 2)');

														echo json_encode($response);

								        			}

							        			} else {

							        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию регистрации (бланк 1)');

													echo json_encode($response);

							        			}

						        			} else {

						        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию паспорта (основной разворот)');

												echo json_encode($response);

						        			}

					        			} else {

					        				$response = array ('event' => 'fail', 'message' => 'Добавьте личную фотографию');

											echo json_encode($response);

					        			}

				        			} else {

				        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию автомобиля (сзади с другого бока)');

										echo json_encode($response);

				        			}

			        			} else {

			        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию автомобиля (спереди с одного бока)');

									echo json_encode($response);

			        			}

		        			} else {

		        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию Свидетельства о регистрации ТС (сторона 2)');

								echo json_encode($response);

		        			}

	        			} else {

	        				$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию Свидетельства о регистрации ТС (сторона 1)');

							echo json_encode($response);

	        			}

	        		} else {

	        			$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию водительского удостоверения (обратная сторона)');

						echo json_encode($response);

	        		}

	        	} else {

	        		$response = array ('event' => 'fail', 'message' => 'Добавьте фотографию водительского удостоверения (внешняя сторона)');

					echo json_encode($response);

	        	}

	        }

	    }

	}

}