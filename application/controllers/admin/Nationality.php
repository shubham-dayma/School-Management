	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class nationality extends Admin_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('nationality');	
				$this->breadcrumbs->unshift(1, lang('nationality'), 'admin/nationality');
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_all('nationalities')->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('nationality');
				$this->template->admin_render('admin/nationality/index',$this->data);
			}
			public function form($id = ''){
				$this->breadcrumbs->unshift(2, lang('form'), 'admin/nationality/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('nationality');
					$save['creat_date'] = date('Y-m-d h:i:s');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('nationality');
					$this->data['row'] = $this->custom_lib->get_where('nationalities','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:nationality', 'required');
					if (empty ($id)){
					$this->form_validation->set_rules('name', 'lang:nationality', 'required|is_unique[nationalities.name]');
					}
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$save['desc'] = $this->input->post('desc');
						$this->custom_lib->form('nationalities',$save);
						redirect ('admin/nationality');
					}
				}
				$this->template->admin_render('admin/nationality/form',$this->data);
			}

			public function delete($id){
				
				$student = $this->custom_lib->get_where ('students','nationality',$id)->result();
				if (empty ($student)) {
					$this->custom_lib->delete_where('nationalities','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('admin/nationality');
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'admin/nationality/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_nationality_exist_error');
					$this->data['back_url'] = site_url('admin/nationality');
					$this->data['redirect_url'] = site_url('admin/student/sections');
					$this->data['redirect_caption'] = lang('back_to_student');
					$this->template->admin_render('admin/nationality/delete',$this->data);
				}
			}
			public function profile($id){
				$this->breadcrumbs->unshift(2, lang('view'), 'admin/nationality/profile');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['row'] = $this->custom_lib->get_where('nationalities','id',$id)->row();
				$this->template->admin_render('admin/nationality/profile',$this->data);
			}
		}	
