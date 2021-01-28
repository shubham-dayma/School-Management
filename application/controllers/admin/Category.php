	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Category extends Admin_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('category');	
				$this->breadcrumbs->unshift(1, lang('category'), 'admin/category');
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_all('categories')->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('category');
				$this->template->admin_render('admin/category/index',$this->data);
			}
			public function form($id = ''){
				$this->breadcrumbs->unshift(2, lang('form'), 'admin/category/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('creat').' '.lang('category');
					$save['creat_date'] = date('Y-m-d h:i:s');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('category');
					$this->data['row'] = $this->custom_lib->get_where('categories','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:category', 'required');
					if (empty ($id)){
						$this->form_validation->set_rules('name', 'lang:category', 'required|is_unique[categories.name]');
					}
					
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$save['desc'] = $this->input->post('desc');
						$this->custom_lib->form('categories',$save);
						redirect ('admin/category');
					}
				}
				$this->template->admin_render('admin/category/form',$this->data);
			}

			public function delete($id){
				$student = $this->custom_lib->get_where ('students','category',$id)->result();
				if (empty ($student)) {
					$this->custom_lib->delete_where('categories','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('admin/category');
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'admin/category/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_category_exist_error');
					$this->data['back_url'] = site_url('admin/category');
					$this->data['redirect_url'] = site_url('admin/student/sections');
					$this->data['redirect_caption'] = lang('back_to_student');
					$this->template->admin_render('admin/category/delete',$this->data);
				}
			}
			public function profile($id){
				$this->breadcrumbs->unshift(2, lang('view'), 'admin/category/profile');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['row'] = $this->custom_lib->get_where('categories','id',$id)->row();
				$this->template->admin_render('admin/category/profile',$this->data);
			}
		}	
