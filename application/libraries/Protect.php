<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("PasswordHash.php");

class Protect
{

	function __construct()
	{
		$this->CI =& get_instance();
	}

	// ** Password Encryption ** //
	public function encrypt($password) 
  	{
  		$phpass = new PasswordHash(12, false);
    	$hash = $phpass->HashPassword($password);
    	return $hash;
  	}

}