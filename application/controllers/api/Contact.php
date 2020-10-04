<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('users_model');
        $this->load->model('content_model');
        $this->load->library('sms');
        $this->load->library('aws');
    }

    public function feedback()
    {
        header('Access-Control-Allow-Origin: *');

        $this->form_validation->set_rules('message', "Вопрос", 'trim|required|max_length[4000]|min_length[5]');
        $this->form_validation->set_rules('name', "Имя", 'trim|required|max_length[150]|min_length[3]');
        $this->form_validation->set_rules('phone', "Номер телефона", 'trim|required|numeric|max_length[11]|min_length[11]');

        if ($this->form_validation->run() == false) {

            $response = array('event' => 'fail', 'message' => validation_errors());

            echo json_encode($response);

        } else {

            // Set variables for input data
            $message = $this->input->post("message", true);
            $name = $this->input->post("name", true);
            $phone = $this->input->post("phone", true);

            $this->content_model->add_message(array(
                    "status" => 0,
                    "created" => date('Y-m-d H:i:s'),
                    "name" => $name,
                    "message" => $message,
                    "phone" => $phone
                )
            );

            $response = array('event' => 'success');

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

    private function uploaderS3Rent($base64)
    {
        $uid = rand(11111111111111, 99999999999999);
        $newname = $uid . '.jpg';
        $this->aws->sendFile($newname, $base64);
        return $newname;
    }


    public function uploaderRentS3($base64, $field)
    {
        if (empty($_GET["rent"])) {
            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');
            echo json_encode($response);
            return;
        }

        $uid = rand(11111111111111, 99999999999999);
        $newname = $uid . '.jpg';
        $this->aws->sendFile($newname, $base64);
        $this->content_model->update_rent($_GET["rent"], array(
                $field => $newname
            )
        );
        $response = array('event' => 'success');

        echo json_encode($response);
        return;
    }


    public function upload_rent_pass1()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderRentS3($_POST['imagebase'], "pass1");
            return;
        }
    }

    public function upload_rent_pass2()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderRentS3($_POST['imagebase'], "pass2");
            return;
        }
    }

    public function upload_rent_vu1()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderRentS3($_POST['imagebase'], "vu1");
            return;
        }
    }

    public function upload_rent_vu2()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderRentS3($_POST['imagebase'], "vu2");
            return;
        }
    }

    public function rentonestep(){
        header('Access-Control-Allow-Origin: *');
        $id = $this->content_model->add_rent(array(
                "status" => -1,
                "created" => date('Y-m-d H:i:s'),
                "first_name" => "",
                "last_name" => "",
            )
        );
        $response = array('event' => 'success', 'rent' => $id);
        echo json_encode($response);
    }

    public function rent()
    {
        header('Access-Control-Allow-Origin: *');

        $this->form_validation->set_rules('citizenship', "Гражданство", 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('city', "Город", 'trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('age', "Возраст", 'trim|required|numeric|greater_than[20]');
        $this->form_validation->set_rules('first_name', "Имя", 'trim|required|max_length[150]|min_length[3]');
        $this->form_validation->set_rules('last_name', "Фамилия", 'trim|required|max_length[150]|min_length[3]');
        $this->form_validation->set_rules('phone', "Номер телефона", 'trim|required|numeric|max_length[11]|min_length[11]');

        if ($this->form_validation->run() == false) {

            $response = array('event' => 'fail', 'message' => validation_errors());

            echo json_encode($response);

        } else {

            $rent = $this->content_model->get_rent($_GET["rent"]);

            if (!$rent->pass1) {

                $response = array('event' => 'fail', 'message' => 'Добавьте фотографию паспорта (основной разворот)');
    
                echo json_encode($response);
                return false;
            }
            if($_POST['citizenship']==1) {
                if (!$rent->pass2) {
    
                    $response = array('event' => 'fail', 'message' => 'Добавьте фотографию паспорта (страница с пропиской)');
        
                    echo json_encode($response);
                    return false;
                }
            }

            if (!$rent->vu1) {
    
                $response = array('event' => 'fail', 'message' => 'Добавьте фотографию водительского удостоверения (внешняя сторона)');
    
                echo json_encode($response);
                return false;
            }

            if (!$rent->vu2) {
    
                $response = array('event' => 'fail', 'message' => 'Добавьте фотографию водительского удостоверения (обратная сторона)');
    
                echo json_encode($response);
                return false;
            }

        /*    $this->form_validation->set_rules('imagebase1', "фотография паспорта (основной разворот)", 'trim|required');
            
            if($_POST['citizenship']==1) {
                $this->form_validation->set_rules('imagebase2', "фотография паспорта (страница с пропиской)", 'trim|required');
            }
            $this->form_validation->set_rules('imagebase3', "фотография водительского удостоверения (внешняя сторона)", 'trim|required');
            $this->form_validation->set_rules('imagebase4', "фотография водительского удостоверения (обратная сторона)", 'trim|required');*/

           /* if ($this->form_validation->run() == false) {
                $response = array('event' => 'fail', 'message' => validation_errors());
                echo json_encode($response);
                return;
            }*/
            $api = 0;
            if(!empty($_POST["api"])){
                $api=$_POST["api"];
            }
            $citizenship = $this->input->post("citizenship", true);
            $city = $this->input->post("city", true);
            $age = $this->input->post("age", true);
            $first_name = $this->input->post("first_name", true);
            $last_name = $this->input->post("last_name", true);
            $phone = $this->input->post("phone", true);
       //     $pass1 = $this->uploaderS3Rent($_POST['imagebase1']);
         //   $pass2="";
        //    if(!empty($_POST['imagebase2'])){
       //     $pass2 = $this->uploaderS3Rent($_POST['imagebase2']);
        //    }

        //    $vu1 = $this->uploaderS3Rent($_POST['imagebase3']);
        //    $vu2 = $this->uploaderS3Rent($_POST['imagebase4']);
            $this->content_model->add_rent(array(
                    "status" => 0,
                    "created" => date('Y-m-d H:i:s'),
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "citizenship" => $citizenship,
                    "city" => $city,
                    "age" => $age,
                    "phone" => $phone,
                 //   "pass1"=>$pass1,
                //    "pass2"=>$pass2,
                 //   "vu1"=>$vu1,
                //    "vu2"=>$vu2,
                    "api"=>$api
                )
            );

            $response = array('event' => 'success');

            echo json_encode($response,JSON_UNESCAPED_UNICODE);

            $email_template = $this->settings_model->get_template(6);


            $cityName = "";

  
            if ($city == 1) 
                $cityName = "Москва";
            if ($city == 2) 
                $cityName = "Санкт-Петербург";
            if ($city == 3) 
                $cityName = "Волгоград";
            if ($city == 4) 
                $cityName = "Воронеж";
            if ($city == 5) 
                $cityName = "Екатеринбург";
            if ($city == 6) 
                $cityName = "Казань";
            if ($city == 7) 
                $cityName = "Краснодар";
            if ($city == 8) 
                $cityName = "Красноярск";
            if ($city == 9) 
                $cityName = "Нижний Новгород";
            if ($city == 10) 
                $cityName = "Новосибирск";
            if ($city == 11) 
                $cityName = "Омск";
            if ($city == 12) 
                $cityName = "Пермь";
            if ($city == 13) 
                $cityName = "Ростов-на-Дону";
            if ($city == 14) 
                $cityName = "Самара";
            if ($city == 15) 
                $cityName = "Саратов";
            if ($city == 16) 
                $cityName = "Тольятти";
            if ($city == 17) 
                $cityName = "Тюмень";
            if ($city == 18) 
                $cityName = "Ульяновск";
            if ($city == 19) 
                $cityName = "Уфа";
            if ($city == 20) 
                $cityName = "Челябинск";
            if ($city == 21) 
                $cityName = "Энгельс";
            if ($city == 22) 
                $cityName = "Ярославль";
            if ($city == 23) 
                $cityName = "Другой";

            if ($email_template->status) {
                $messages = $email_template->message;
                $email_variables = array('[NAME]', '[AGE]', '[CITY]', '[PHONE]');
                $code_variable = array($first_name, $age, $cityName, $phone);
                $replace = str_replace($email_variables, $code_variable, $messages);
                $this->sms->send_email($this->settings->email, $email_template->name, $replace);
            }

        }
    }

    public function rentonestep(){
        header('Access-Control-Allow-Origin: *');
        $id = $this->content_model->add_rent(array(
                "status" => -1,
                "created" => date('Y-m-d H:i:s'),
                "first_name" => "",
                "last_name" => "",
            )
        );
        $response = array('event' => 'success', 'rent' => $id);
        echo json_encode($response);
    }

    public function registeronestep()
    {
        header('Access-Control-Allow-Origin: *');

        $this->form_validation->set_rules('jobcity', "Город работы", 'trim|required|greater_than[0]'); //in_list[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
        $this->form_validation->set_rules('name', "Имя", 'trim|required|max_length[150]|min_length[3]');
        $this->form_validation->set_rules('phone', "Номер телефона", 'trim|required|numeric|max_length[11]|min_length[11]');
        $this->form_validation->set_rules('registration', "Гражданство", 'trim|required|greater_than[0]');

        if ($this->form_validation->run() == false) {

            $response = array('event' => 'fail', 'message' => validation_errors());

            echo json_encode($response);

        } else {

            // Set variables for input data
            $jobcity = $this->input->post("jobcity", true);
            $name = $this->input->post("name", true);
            $phone = $this->input->post("phone", true);
            $registration = $this->input->post("registration", true);

            $id = $this->content_model->add_order(array(
                    "status" => 4,
                    "created" => date('Y-m-d H:i:s'),
                    "cityjob" => $jobcity,
                    "name" => $name,
                    "phone" => $phone,
                    "registration" => $registration
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

            $response = array('event' => 'success', 'order' => $id, 'type' => $type);

            echo json_encode($response);

        }
    }


    public function uploaderS3($base64, $field)
    {

        if (empty($_GET["order"])) {
            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');
            echo json_encode($response);
            return;
        }

        $uid = rand(11111111111111, 99999999999999);
        $newname = $uid . '.jpg';
        $this->aws->sendFile($newname, $base64);
        $this->content_model->update_order($_GET["order"], array(
                $field => $newname
            )
        );
        $response = array('event' => 'success');

        echo json_encode($response);
        return;
    }


    public function upload_vu_one()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_vu_1");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_vu_1" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_vu_two()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_vu_2");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_vu_2" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_sts_one()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_sts_1");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_sts_1" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_sts_two()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_sts_2");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_sts_2" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_pass1()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_pass_1");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_pass_1" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_pass2()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_pass_2");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_pass_2" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_lic1()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_license_1");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_license_1" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_lic2()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_license_2");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_license_2" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_auto1()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_auto_1");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_auto_1" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_auto2()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_auto_2");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_auto_2" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_auto3()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_auto_3");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_auto_3" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_auto4()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_auto_4");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_auto_4" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }
        }

    }

    public function upload_face()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_face");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_face" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_reg1()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_reg_1");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_reg_1" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    public function upload_reg2()
    {
        header('Access-Control-Allow-Origin: *');

        if (!empty($_POST['imagebase'])) {
            $this->uploaderS3($_POST['imagebase'], "doc_reg_2");
            return;
        }

        if (empty($_GET["order"])) {

            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');

            echo json_encode($response);

        } else {

            if (!$_FILES['files']['name']) {

                $response = array('event' => 'fail', 'message' => 'Изображение не получено!');

                echo json_encode($response);

            } else {

                $uid = rand(11111111111111, 99999999999999);

                $info = pathinfo($_FILES['files']['name']);
                $ext = $info['extension'];
                $newname = $uid . '.' . $ext;

                $target = '' . $_SERVER['DOCUMENT_ROOT'] . '/docs/' . $newname;
                move_uploaded_file($_FILES['files']['tmp_name'], $target);

                $this->content_model->update_order($_GET["order"], array(
                        "doc_reg_2" => $newname
                    )
                );

                $response = array('event' => 'success');

                echo json_encode($response);

            }

        }

    }

    private function checker($param, $message)
    {
    }

    public function check_order()
    {
        header('Access-Control-Allow-Origin: *');

        if (empty($_GET["order"])) {
            $response = array('event' => 'fail', 'message' => 'Не получен ID заявки! Создайте новую заявку');
            echo json_encode($response);
            return;
        } else {
            $order = $this->content_model->get_order($_GET["order"]);
        }

        if (!$order->doc_vu_1) {

            $response = array('event' => 'fail', 'message' => 'Добавьте фотографию водительского удостоверения (внешняя сторона)');

            echo json_encode($response);
            return false;
        }
        if (!$order->doc_vu_2) {

            $response = array('event' => 'fail', 'message' => 'Добавьте фотографию водительского удостоверения (обратная сторона)');

            echo json_encode($response);
            return false;
        }
        if (!$order->doc_sts_1) {

            $response = array('event' => 'fail', 'message' => 'Добавьте фотографию Свидетельства о регистрации ТС (сторона 1)');

            echo json_encode($response);
            return false;
        }
        if (!$order->doc_sts_2) {

            $response = array('event' => 'fail', 'message' => 'Добавьте фотографию Свидетельства о регистрации ТС (сторона 2)');

            echo json_encode($response);
            return false;
        }
        if (!$order->doc_auto_1) {

            $response = array('event' => 'fail', 'message' => 'Добавьте фотографию автомобиля (спереди)');

            echo json_encode($response);
            return false;
        }
        if (!$order->doc_auto_2) {

            $response = array('event' => 'fail', 'message' => 'Добавьте фотографию автомобиля (левый бок)');

            echo json_encode($response);
            return false;
        }
        if (!$order->doc_auto_3) {

            $response = array('event' => 'fail', 'message' => 'Добавьте фотографию автомобиля (сзади)');

            echo json_encode($response);
            return false;
        }
        if (!$order->doc_auto_4) {

            $response = array('event' => 'fail', 'message' => 'Добавьте фотографию автомобиля (правый бок)');

            echo json_encode($response);
            return false;
        }
        if (!$order->doc_face) {

            $response = array('event' => 'fail', 'message' => 'Добавьте личную фотографию');

            echo json_encode($response);
            return false;
        }
        if (!$order->doc_pass_1) {

            $response = array('event' => 'fail', 'message' => 'Добавьте фотографию паспорта (основной разворот)');

            echo json_encode($response);
            return false;
        }

        $this->content_model->update_order($_GET["order"], array(
            "status" => 0
        ));

        $response = array('event' => 'success');

        echo json_encode($response);

        $email_template = $this->settings_model->get_template(7);

        if ($email_template->status) {

            $messages = $email_template->message;
            $email_variables = array('[NAME]', '[PHONE]');
            $code_variable = array($order->name, $order->phone);
            $replace = str_replace($email_variables, $code_variable, $messages);
            $this->sms->send_email($this->settings->email, $email_template->name, $replace);

        }

    }
}