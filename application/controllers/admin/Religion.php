	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Religion extends Admin_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('religion');	
				$this->breadcrumbs->unshift(1, lang('religion'), 'admin/religion');
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_all('religions')->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('religion');
				$this->template->admin_render('admin/religion/index',$this->data);
			}
			public function form($id = ''){
				$this->breadcrumbs->unshift(2, lang('form'), 'admin/religion/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('religion');
					$save['creat_date'] = date('Y-m-d h:i:s');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('religion');
					$this->data['row'] = $this->custom_lib->get_where('religions','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:religion', 'required');
					if (empty ($id)){
					$this->form_validation->set_rules('name', 'lang:religion', 'required|is_unique[religions.name]');
					}
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$save['desc'] = $this->input->post('desc');
						$this->custom_lib->form('religions',$save);
						redirect ('admin/religion');
					}
				}
				$this->template->admin_render('admin/religion/form',$this->data);
			}

			public function delete($id){
				$student = $this->custom_lib->get_where ('students','religion',$id)->result();
				if (empty ($student)) {
					$this->custom_lib->delete_where('religions','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('admin/religion');
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'admin/religion/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_religion_exist_error');
					$this->data['back_url'] = site_url('admin/religion');
					$this->data['redirect_url'] = site_url('admin/student/sections');
					$this->data['redirect_caption'] = lang('back_to_student');
					$this->template->admin_render('admin/religion/delete',$this->data);
				}
				
			}
			public function profile($id){
				$this->breadcrumbs->unshift(2, lang('view'), 'admin/religion/profile');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['row'] = $this->custom_lib->get_where('religions','id',$id)->row();
				$this->template->admin_render('admin/religion/profile',$this->data);
			}
		}	
