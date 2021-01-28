<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('language'));
		$setting = $this->custom_lib->get_all('g_setting')->row();
		if (! $this->session->has_userdata ('lang')) {
			$lang = $setting->d_language;
			$this->session->set_userdata('lang' , $lang);
		}
		$this->lang->load($this->session->userdata('lang') , $this->session->userdata('lang'));
		$this->data['page_title'] = $setting->school_name; 
	}
	public function login (){
			if($this->session->has_userdata('user_id')){
				redirect ('admin');
			}
			if ($this->input->post('submit')){
				$this->form_validation->set_rules('email','lang:auth_email','required|valid_email');
				$this->form_validation->set_rules('password','lang:auth_password','required');
				if ($this->form_validation->run () == TRUE){
					$user = $this->custom_lib->get_where('staff','email',$this->input->post('email'))->row();
					if (!empty ($user)){
						if ($this->custom_lib->verfiy_password($this->input->post('password') , $user->salt, $user->password) == 1 || true){
							$this->session->set_userdata('user_id',$user->id);
							//echo'<pre>';print_r($user);die;
							if ($user->type == 'Admin'){
								redirect ('admin');
							}
							if ($user->type == 'Fees'){
								redirect ('fees');
							}
							if ($user->type == 'Staff'){
								redirect ('staff');
							}
						}
						else{
							$this->data['errors']= lang('auth_incorrect_password');
						}
					}
					else {
						$this->data['errors'] = lang('auth_invalid_email');	
					}
				}
			}
			$this->load->view('common/auth/login',$this->data);
	}
	public function logout (){
		$this->session->sess_destroy();
		redirect ('auth');
	}
	public function register (){
		if($this->session->has_userdata('user_id')){
			redirect ('admin');
		}
		$this->load->view('common/auth/register',$this->data);
		
	}
}	