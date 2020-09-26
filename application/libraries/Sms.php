<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms
{
	public function __construct() 
  	{
    	$this->CI =& get_instance();
    	$this->CI->load->model('users_model');
    	$this->CI->load->model('settings_model');
  	}

  	public function send_sms($phone, $template)
    {
    	$settings = $this->CI->settings_model->get_settings();

    	$template = $this->CI->settings_model->get_template($template);

    	if ($template->status) {

    		$ch = curl_init("https://sms.ru/sms/send");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
			    "api_id" 	=> $settings->sms_api,
			    "to" 		=> $phone,
			    "msg" 		=> $template->message,
			    "json" 		=> 1
			)));
			$body = curl_exec($ch);
			curl_close($ch);

			$json = json_decode($body);
				if ($json) {

				    if ($json->status == "OK") { 

				        foreach ($json->sms as $phone => $data) {

				            if ($data->status == "OK") {

				                return 'Отправлено';

				            } else {
				                
				            	return 'Ошибка при отправке';

				            }
				        }

				    } else {
				        
				    	return 'Запрос не выполнился (возможно ошибка авторизации, параметрах, итд...)';

				    }
				} else {

					return 'Запрос не выполнился. Не удалось установить связь с сервером. ';

				}

    	} else {

    		return 'Шаблон оповещения отключен';

    	}

    }

    public function send_email($email, $title, $message)
    {
    	$CI =& get_instance();
		
		$settings = $this->CI->settings_model->get_settings();

		if (!$settings->method) { // CI sendmail

			$config = array(
		        'protocol'  => 'mail',
		        'charset'   => 'utf8',
		        'mailtype'  => 'html',
		        'wordwrap'  => 'true',
		    );

		    $CI->load->library('email', $config);

		    $CI->email->from($settings->sender, 'Ситимобил API');
		    $CI->email->to($email);

		    $CI->email->subject($title);
		    $CI->email->message($message);

		    $CI->email->send();

		} else { // SMTP

			$config = array(
		        'protocol'   => 'smtp',
		        'smtp_host'  => $settings->host,
		        'smtp_port'  => $settings->port,
		        'smtp_user'  => $settings->sender,
		        'smtp_pass'  => $settings->smtp_password,
		        'charset'    => 'utf8',
		        'mailtype'   => 'html',
		        'wordwrap'   => 'true',
		    );

		    $CI->load->library('email', $config);

		    $CI->email->from($settings->sender, 'Ситимобил API');
		    $CI->email->to($email);

		    $CI->email->subject($title);
		    $CI->email->message($message);

		    $CI->email->send();

		}
	}
	


	public function send_sms_text($phone, $message)
    {
    	$settings = $this->CI->settings_model->get_settings();

		$ch = curl_init("https://sms.ru/sms/send");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
			"api_id" 	=> $settings->sms_api,
			"to" 		=> $phone,
			"msg" 		=> $message,
			"json" 		=> 1
		)));
		$body = curl_exec($ch);
		curl_close($ch);

		$json = json_decode($body);
			if ($json) {

				if ($json->status == "OK") { 

					foreach ($json->sms as $phone => $data) {

						if ($data->status == "OK") {

							echo 'Отправлено';
							return 'Отправлено';
						} else {
							
							echo 'Ошибка при отправке';
							return 'Ошибка при отправке';
						}
					}

				} else {
					
					echo 'Запрос не выполнился (возможно ошибка авторизации, параметрах, итд...)';
					return 'Запрос не выполнился (возможно ошибка авторизации, параметрах, итд...)';
				}
			} else {

				echo 'Запрос не выполнился. Не удалось установить связь с сервером. ';
				return 'Запрос не выполнился. Не удалось установить связь с сервером. ';
			}
	//	echo 'Запрос не выполнился. Не удалось установить связь с сервером. ';
	//	return 'Запрос не выполнился. Не удалось установить связь с сервером.';
    }
}