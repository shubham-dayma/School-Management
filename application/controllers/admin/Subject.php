<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


	class Subject extends Admin_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('subject');	
			$this->breadcrumbs->unshift(1, lang('subject'), 'admin/subject');
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['result'] = $this->custom_lib->get_all('subjects')->result();
			$this->data['delete_msg']  = lang('delete_msg').' '.lang('subject');
			$this->template->admin_render('admin/subject/index',$this->data);
		}
		public function form($id = ''){
			$this->breadcrumbs->unshift(2, lang('form'),'admin/subject/form');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			if (empty ($id)){
				$this->data['page_sub_title'] = lang('add').' '.lang('subject');
				$save['creat_date'] = date('Y-m-d h:i:s');
			}
			if (!empty ($id)){
				$this->data['page_sub_title'] = lang('edit').' '.lang('subject');
				$this->data['row'] = $this->custom_lib->get_where('subjects','id',$id)->row();
				//print_r($this->data['row']);die;
			}
			if ($this->input->post('submit')){
				$this->form_validation->set_rules('name', 'lang:name', 'required');
				$this->form_validation->set_rules('subject_code', 'lang:subject_code', 'required');
				if ($this->form_validation->run() == TRUE){
					//print_r($this->input->post()); die;
					$save['id'] = $id;
					$save['name'] = $this->input->post('name');
					$save['subject_code'] = $this->input->post('subject_code');
					$save['desc'] = $this->input->post('desc');
					$save['add_in_marksheet'] = 0;
					if (!empty ($this->input->post('add_in_marksheet'))){
						$save['add_in_marksheet'] = $this->input->post('add_in_marksheet');
					}
					$this->custom_lib->form('subjects',$save);
					redirect ('admin/subject');
				}
			}
			$this->template->admin_render('admin/subject/form',$this->data);
		}
/*
		public function delete($id){
			if ($id != 1){
				$staff = $this->custom_lib->get_where ('staff','staff_cat_id',$id)->result();
				if (empty ($staff)) {
					$this->custom_lib->delete_where('subject','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('admin/subject');
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'admin/subject/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_category_exist_error');
					$this->data['back_url'] = site_url('admin/subject');
					$this->data['redirect_url'] = site_url('admin/staff');
					$this->data['redirect_caption'] = lang('back_to_staff');
					$this->template->admin_render('admin/subject/delete',$this->data);
				}

				$this->custom_lib->delete_where('subject','id',$id);
				$this->session->set_flashdata('danger',lang('record_deleted'));
				redirect ('admin/subject');
			}
		} */
		public function profile($id){
			$this->breadcrumbs->unshift(2, lang('view'), 'admin/subject/profile');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['row'] = $this->custom_lib->get_where('subjects','id',$id)->row();
			$this->template->admin_render('admin/subject/profile',$this->data);
		}
	}	
