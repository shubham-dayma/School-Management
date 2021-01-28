	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Caste extends Admin_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('caste');	
				$this->breadcrumbs->unshift(1, lang('caste'), 'admin/caste');
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_all('castes')->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('caste');
				$this->template->admin_render('admin/caste/index',$this->data);
			}
			public function form($id = ''){
				$this->breadcrumbs->unshift(2, lang('form'), 'admin/caste/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('caste');
					$save['creat_date'] = date('Y-m-d h:i:s');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('caste');
					$this->data['row'] = $this->custom_lib->get_where('castes','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:caste', 'required');
					if (empty ($id)){
					$this->form_validation->set_rules('name', 'lang:caste', 'required|is_unique[castes.name]');
					}
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$save['desc'] = $this->input->post('desc');
						$this->custom_lib->form('castes',$save);
						redirect ('admin/caste');
					}
				}
				$this->template->admin_render('admin/caste/form',$this->data);
			}

			public function delete($id){
				$student = $this->custom_lib->get_where ('students','cast',$id)->result();
				if (empty ($student)) {
					$this->custom_lib->delete_where('castes','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('admin/caste');
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'admin/caste/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_caste_exist_error');
					$this->data['back_url'] = site_url('admin/caste');
					$this->data['redirect_url'] = site_url('admin/student/sections');
					$this->data['redirect_caption'] = lang('back_to_student');
					$this->template->admin_render('admin/caste/delete',$this->data);
				}
				
			}
			public function profile($id){
				$this->breadcrumbs->unshift(2, lang('view'), 'admin/caste/profile');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['row'] = $this->custom_lib->get_where('castes','id',$id)->row();
				$this->template->admin_render('admin/caste/profile',$this->data);
			}
		}	
