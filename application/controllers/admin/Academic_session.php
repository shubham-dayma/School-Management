<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


	class Academic_session extends Admin_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('academic_session');	
			$this->breadcrumbs->unshift(1, lang('academic_session'), 'admin/academic_session');
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['result'] = $this->custom_lib->get_all('academic_session')->result();
			$this->data['delete_msg']  = lang('delete_msg').' '.lang('academic_session');
			$this->template->admin_render('admin/academic_session/index',$this->data);
		}
		public function form($id = ''){
			$this->breadcrumbs->unshift(2, lang('form'),'admin/academic_session/form');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			if (empty ($id)){
				$this->data['page_sub_title'] = lang('add').' '.lang('academic_session');
				$save['creat_date'] = date('Y-m-d h:i:s');
			}
			if (!empty ($id)){
				$this->data['page_sub_title'] = lang('edit').' '.lang('academic_session');
				$this->data['row'] = $this->custom_lib->get_where('academic_session','id',$id)->row();
				//print_r($this->data['row']);die;
			}
			if ($this->input->post('submit')){
				$this->form_validation->set_rules('start_date', 'lang:start_date', 'required');
				$this->form_validation->set_rules('end_date', 'lang:end_date', 'required');
				$this->form_validation->set_rules('caption', 'lang:caption', 'required');
				if ($this->form_validation->run() == TRUE){
					//print_r($this->input->post()); die;
					$save['id'] = $id;
					$save['start_date'] = $this->input->post('start_date');
					$save['end_date'] = $this->input->post('end_date');
					$save['caption'] = $this->input->post('caption');
					$this->custom_lib->form('academic_session',$save);
					redirect ('admin/academic_session');
				}
			}
			$this->template->admin_render('admin/academic_session/form',$this->data);
		}
/*
		public function delete($id){
			if ($id != 1){
				$staff = $this->custom_lib->get_where ('staff','staff_cat_id',$id)->result();
				if (empty ($staff)) {
					$this->custom_lib->delete_where('academic_session','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('admin/academic_session');
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'admin/academic_session/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_category_exist_error');
					$this->data['back_url'] = site_url('admin/academic_session');
					$this->data['redirect_url'] = site_url('admin/staff');
					$this->data['redirect_caption'] = lang('back_to_staff');
					$this->template->admin_render('admin/academic_session/delete',$this->data);
				}

				$this->custom_lib->delete_where('academic_session','id',$id);
				$this->session->set_flashdata('danger',lang('record_deleted'));
				redirect ('admin/academic_session');
			}
		} */
		public function profile($id){
			$this->breadcrumbs->unshift(2, lang('view'), 'admin/academic_session/profile');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['row'] = $this->custom_lib->get_where('academic_session','id',$id)->row();
			$this->template->admin_render('admin/academic_session/profile',$this->data);
		}
	}	
