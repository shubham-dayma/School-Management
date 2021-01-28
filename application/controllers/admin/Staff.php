<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Staff extends Admin_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('staff');
			$this->breadcrumbs->unshift(1, lang('staff'), 'admin/staff');		
		}
		public function index($id = ''){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['result'] = $this->custom_lib->get_where('staff','working_status',0)->result();
			if(!empty($id))
			{
				if (!empty($this->input->post())){
					$save['id'] = $id;
					$save['working_status'] = $this->input->post('status');
					$save['doj'] = $this->input->post('doj');
					if ($save['working_status'] == 1) {
					$save['dot'] = $this->input->post('dot');
					}
					else 
					{
						$save['dot'] = '';
					}
					//echo '<pre>';print_r($save);die;
					$this->custom_lib->update('staff','id',$save['id'],$save);
					redirect('admin/staff');
				} 
			} 
			$this->template->admin_render('admin/staff/index',$this->data);
		}
		public function form($id = ''){

			$this->breadcrumbs->unshift(2, lang('form'), 'admin/staff/form');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['staff_categories'] = $this->custom_lib->get_all('staff_category')->result();
			//echo '<pre>'; print_r($this->data['staff_categories']);die;
			$this->data['subjects'] = $this->custom_lib->get_all('subjects')->result();
			if (empty ($id)){
				$this->data['page_sub_title'] = lang('add').' '.lang('staff');
			}
			if (!empty ($id)){
				$this->data['page_sub_title'] = lang('edit').' '.lang('staff');
				$this->data['row'] = $this->custom_lib->get_where('staff','id',$id)->row();
			}
			if ($this->input->post('submit')){

				$this->form_validation->set_rules('fname', 'lang:staff_fname', 'required');
				$this->form_validation->set_rules('lname', 'lang:last', 'required');
				$this->form_validation->set_rules('phone', 'lang:phone', 'required|numeric|exact_length[10]');
				$this->form_validation->set_rules('address', 'lang:address', 'required');
				$this->form_validation->set_rules('doj', 'lang:doj', 'required');
				
				$this->form_validation->set_rules('staff_category', 'lang:staff lang:category', 'required');
				$this->form_validation->set_rules('assigned_subject[]', 'Assigne Subject', 'required');
				
				
				if (empty ($id)){
					$this->form_validation->set_rules('password', 'lang:password', 'required');
					$this->form_validation->set_rules('c_password', 'lang:confirm lang:password', 'required|matches[password]');
					$this->form_validation->set_rules('email', 'lang:email', 'required|is_unique[staff.email]|valid_email');
					$save['creat_date'] = date('Y-m-d h:i:s');
				}
				else {
					if (!empty ($this->input->post('password'))){
						$this->form_validation->set_rules('password', 'lang:password', 'required');
						$this->form_validation->set_rules('c_password', 'lang:confirm lang:password', 'required|matches[password]');
						/********************** READ ONLY EMAIL CODE HERE *********************/
					}
				}
				
				if ($this->form_validation->run() == TRUE){
					$save['id'] = $id;
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
					} // PASS END
					
					$save['doj'] = $this->input->post('doj');
					$save['address'] = $this->input->post('address');

					$photo = $this->custom_lib->upload('staff/staff_img','img');
					if (!empty ($photo['success'])){
						$save['photo'] = $photo['success'];
					} // PHOTO END
					
					$id_proof = $this->custom_lib->upload('staff/staff_id','id_proof');
					if (!empty ($id_proof['success'])){
						$save['id_proof'] = $id_proof['success'];
					} // ID PROOF END

					
					$save['staff_category'] = $this->input->post('staff_category');
					$save['assigned_subject'] = json_encode($this->input->post('assigned_subject'));
					$save['login_status'] = $this->input->post('login_status');
					$save['working_status'] = 0;
					$save['dot'] = '';
					


					$this->custom_lib->form('staff',$save);
					
					redirect ('admin/staff');
				}

			}
			$this->template->admin_render('admin/staff/form',$this->data);
		}
		function delete($id)
		{
			
		}
		function profile($id){
			$this->breadcrumbs->unshift(2, lang('profile'), 'admin/profile/form');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['row'] = $this->custom_lib->get_where('staff','id',$id)->row();
			$this->data['category'] = $this->custom_lib->get_where('staff_category','id',$this->data['row']->staff_category)->row();
			$this->data['subjects'] = $this->custom_lib->get_all('subjects')->result();
			$this->template->admin_render('admin/staff/profile',$this->data);
		}
	}