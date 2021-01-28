<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Staff_category extends Admin_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('staff').' '.lang('category');	
			$this->breadcrumbs->unshift(1, lang('staff').' '.lang('category'), 'admin/staff_category');
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['result'] = $this->custom_lib->get_all('staff_category')->result();
			$this->data['delete_msg']  = lang('delete_msg').' '.lang('staff').' '.lang('category');
			$this->template->admin_render('admin/staff_category/index',$this->data);
		}
		public function form($id = ''){
			$this->breadcrumbs->unshift(2, lang('form'), 'admin/staff_category/form');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			if (empty ($id)){
				$this->data['page_sub_title'] = lang('creat').' '.lang('staff').' '.lang('category');
				$save['creat_date'] = date('Y-m-d h:i:s');
			}
			if (!empty ($id)){
				$this->data['page_sub_title'] = lang('edit').' '.lang('staff').' '.lang('category');
				$this->data['row'] = $this->custom_lib->get_where('staff_category','id',$id)->row();
				//print_r($this->data['row']);die;
			}
			if ($this->input->post('submit')){
				$this->form_validation->set_rules('name', 'lang:category lang:name', 'required');
				if ($this->form_validation->run() == TRUE){
					$save['id'] = $id;
					$save['name'] = $this->input->post('name');
					$save['desc'] = $this->input->post('desc');
					$this->custom_lib->form('staff_category',$save);
					redirect ('admin/staff_category');
				}
			}
			$this->template->admin_render('admin/staff_category/form',$this->data);
		}

		public function delete($id){
			if ($id != 1){
				$staff = $this->custom_lib->get_where ('staff','staff_cat_id',$id)->result();
				if (empty ($staff)) {
					$this->custom_lib->delete_where('staff_category','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('admin/staff_category');
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'admin/staff_category/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_staff_category_exist_error');
					$this->data['back_url'] = site_url('admin/staff_category');
					$this->data['redirect_url'] = site_url('admin/staff');
					$this->data['redirect_caption'] = lang('back_to_staff');
					$this->template->admin_render('admin/staff_category/delete',$this->data);
				}

				$this->custom_lib->delete_where('staff_category','id',$id);
				$this->session->set_flashdata('danger',lang('record_deleted'));
				redirect ('admin/staff_category');
			}
		}
		public function profile($id){
			$this->breadcrumbs->unshift(2, lang('view'), 'admin/staff_category/profile');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['row'] = $this->custom_lib->get_where('staff_category','id',$id)->row();
			$this->template->admin_render('admin/staff_category/profile',$this->data);
		}
	}	
