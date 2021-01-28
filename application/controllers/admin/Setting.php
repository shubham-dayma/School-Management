<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Setting extends Admin_Controller {
		public function __construct()
		{
			parent::__construct();
			//$this->load->model('admin/Currencyes');
			$this->breadcrumbs->unshift(1, lang('setting'), 'admin/setting');
			$this->data['page_title'] = lang('setting');	
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['result'] = $this->custom_lib->get_all('g_setting')->row();
			$this->data['languages'] = $this->custom_lib->get_all('languages')->result();
			$this->data['countries'] = $this->custom_lib->get_all('countries')->result();
			$this->data['states'] = $this->custom_lib->get_where('states','country_id',$this->data['result']->country)->result();
			$this->data['cities'] = $this->custom_lib->get_where('cities','state_id',$this->data['result']->state)->result();
			if ($this->input->post('submit')){
				$this->form_validation->set_rules('firm_name', 'lang:firm_name', 'required');
				$this->form_validation->set_rules('owner_name', 'lang:owner_name', 'required');
				if ($this->form_validation->run() == TRUE){
					//echo '<pre>';print_r($_POST);die;
					$save['school_name'] = $this->input->post('firm_name');
					$save['owner_name'] = $this->input->post('owner_name');
					$save['phone'] = $this->input->post('phone');
					$save['email'] = $this->input->post('email');
					$save['website'] = $this->input->post('website');
					$save['address'] = $this->input->post('address');
					$save['d_language'] = $this->input->post('d_language');
					$save['country'] = $this->input->post('country');
					$save['state'] = $this->input->post('state');
					$save['city'] = $this->input->post('city');
					$save['footer_text'] = $this->input->post('footer_text');
					$img = $this->custom_lib->upload('logo');
					if (!empty ($img['success'])){
						$save['logo'] = $img['success'];
					}
					$img = $this->custom_lib->upload('favicon','favicon');
					if (!empty ($img['success'])){
						$save['favicon'] = $img['success'];
					}
					$img = $this->custom_lib->upload('principal_sign','principal_sign');
					if (!empty ($img['success'])){
						$save['principal_sign'] = $img['success'];
					}
					$this->custom_lib->update('g_setting' , 'id' , '1' , $save);
					redirect ('admin/setting');
				}	
			}
			$this->template->admin_render('admin/setting/index',$this->data);
		}
		public function academics (){
			$this->breadcrumbs->unshift(2, lang('academic').' '.lang('setting'), 'admin/setting');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['result'] = $this->custom_lib->get_all('academic_settings')->row();
			$this->data['sessions'] = $this->custom_lib->get_all('academic_session')->result();
			if ($this->input->post('submit')){
				//print_r($_POST);die;
				$save['current_session'] = $this->input->post('current_session');
				$save['auto_roll_no'] = 0;
				$save['auto_enroll_no'] = 0;
				$save['enrol_reg'] = 0;
				if ($this->input->post('auto_roll_no') == 1){
					$save['auto_roll_no'] = $this->input->post('auto_roll_no');
					$save['auto_roll_criteria'] = $this->input->post('auto_roll_criteria');
				}
				if ($this->input->post('auto_enroll_no') == 1){
					$save['auto_enroll_no'] = $this->input->post('auto_enroll_no');
					$save['enrol_no_prefix'] = $this->input->post('enrol_no_prefix');
				}
				$save['enrol_reg'] = $this->input->post('enrol_reg');
				$this->custom_lib->update('academic_settings','id',$this->data['result']->id,$save);
				$this->session->set_userdata ('academic_session',$save['current_session']);
				redirect ('admin/setting/academics');
			}
			$this->template->admin_render('admin/setting/academic',$this->data);
		}
		function ajax_country(){
			$states = $this->custom_lib->get_where('states','country_id',$_POST['country_id'])->result();
			foreach ($states as $state){
				echo '<option value = "'.$state->id.'">'.$state->name.'</option>';
			}
			die;
		}
		function ajax_state(){
			$cities = $this->custom_lib->get_where('cities','state_id',$_POST['state_id'])->result();
			foreach ($cities as $city){
				echo '<option value = "'.$city->id.'">'.$city->name.'</option>';
			}
			die;
		}
	}	
