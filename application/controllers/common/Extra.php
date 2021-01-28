<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Extra extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
	}
	public function change_session(){
		$this->session->set_userdata ('academic_session',$_POST['session_id']);
	}
}	