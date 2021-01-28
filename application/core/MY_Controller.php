<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		
		parent::__construct();
		//error_reporting(0);
		ini_set('max_execution_time', 300);
		date_default_timezone_set('Asia/Kolkata');
		$this->load->library('breadcrumbs');
		$this->load->helper(array('language','custom'));
		$this->setting = $this->custom_lib->get_all('g_setting')->row();
		$this->as = $this->custom_lib->get_all('academic_settings')->row();
		/*--Language--*/
		if (! $this->session->has_userdata ('lang')) {
			$lang = $this->setting->d_language;
			$this->session->set_userdata('lang' , $lang);
		}
		$this->lang->load($this->session->userdata('lang') , $this->session->userdata('lang'));
		$this->languages = $this->custom_lib->get_all('languages')->result();
		$this->sessions = $this->custom_lib->get_all('academic_session')->result();
		$this->user = $this->custom_lib->get_where('staff' ,'id' ,$this->session->userdata('user_id'))->row();
		if (! $this->session->has_userdata ('academic_session')) {
			$this->session->set_userdata ('academic_session',$this->as->current_session);
		}
		if (!$this->session->has_userdata('user_id')){
			redirect ('auth');
		}
		
	}
}


class Admin_Controller extends MY_Controller
{	
	public function __construct()
	{
		parent::__construct();
		if ($this->user->type != 'Admin'){
			if ($this->user->type == 'Staff'){
				redirect('staff');
			}
			if ($this->user->type == 'Fees'){
				redirect('fees');
			}
		}
		$this->breadcrumbs->unshift(0, lang('dashboard'), 'admin/dashboard');
	}
}


class Staff_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->user->type != 'Staff'){
			if ($this->user->type == 'Admin'){
				redirect('admin');
			}
			if ($this->user->type == 'Fees'){
				redirect('fees');
			}
		}
		$this->breadcrumbs->unshift(0, lang('dashboard'), 'staff/dashboard');
	}
}

class Fees_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->user->type != 'Fees'){
			if ($this->user->type == 'Staff'){
				redirect('staff');
			}
			if ($this->user->type == 'Admin'){
				redirect('admin');
			}
		}		
		$this->breadcrumbs->unshift(0, lang('dashboard'), 'fees/dashboard');
	}
}
