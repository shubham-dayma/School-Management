<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Profile extends Staff_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('profile');
			$this->breadcrumbs->unshift(1, lang('profile'), 'admin/profile');		
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['staff_categories'] = $this->custom_lib->get_all('staff_category')->result();
			//echo '<pre>'; print_r($this->data['staff_categories']);die;
			$this->data['subjects'] = $this->custom_lib->get_all('subjects')->result();
			$this->data['page_sub_title'] = lang('profile');
			$this->data['row'] = $this->custom_lib->get_where('staff','id',$this->session->userdata('user_id'))->row();
			if ($this->input->post('submit')){

				$this->form_validation->set_rules('fname', 'lang:staff_fname', 'required');
				$this->form_validation->set_rules('lname', 'lang:last', 'required');
				$this->form_validation->set_rules('phone', 'lang:phone', 'required|numeric|exact_length[10]');
				$this->form_validation->set_rules('address', 'lang:address', 'required');
				$this->form_validation->set_rules('doj', 'lang:doj', 'required');
				$this->form_validation->set_rules('assigned_subject[]', 'Assigne Subject', 'required');
				if (!empty ($this->input->post('password'))){
					$this->form_validation->set_rules('password', 'lang:password', 'required');
					$this->form_validation->set_rules('c_password', 'lang:confirm lang:password', 'required|matches[password]');
				}
				if ($this->form_validation->run() == TRUE){
					$save['id'] = $this->session->userdata('user_id');
					$save['fname'] = $this->input->post('fname');
					$save['lname'] = $this->input->post('lname');
					$save['gender'] = $this->input->post('gender');
					$save['phone'] = $this->input->post('phone');
					$save['email'] = $this->input->post('email');
					$save['qulification'] = $this->input->post('qulification');
					$save['extra_qulification'] = $this->input->post('extra_qulification');
					$save['work_experiance'] = $this->input->post('work_experiance');
					$save['dob'] = $this->input->post('dob');
					if (!empty ($this->input->post('password'))){
						$hash = $this->custom_lib->hash_password($this->input->post('password'));
						$save['salt']  = $hash['salt'];
						$save['password']  = $hash['password'];
					} 
					$save['doj'] = $this->input->post('doj');
					$save['address'] = $this->input->post('address');
					$photo = $this->custom_lib->upload('staff/staff_img','img');
					if (!empty ($photo['success'])){
						$save['photo'] = $photo['success'];
					} 
					
					$id_proof = $this->custom_lib->upload('staff/staff_id','id_proof');
					if (!empty ($id_proof['success'])){
						$save['id_proof'] = $id_proof['success'];
					} 
					$save['assigned_subject'] = json_encode($this->input->post('assigned_subject'));
					$this->custom_lib->form('staff',$save);
					redirect ('staff/dashboard');
				}

			}
			$this->template->staff_render('staff/profile',$this->data);
		}
	}