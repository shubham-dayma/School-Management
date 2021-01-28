	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Title extends Admin_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('title');	
				$this->breadcrumbs->unshift(1, lang('title'), 'admin/title');
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_all('titles')->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('title');
				$this->template->admin_render('admin/title/index',$this->data);
			}
			public function form($id = ''){
				$this->breadcrumbs->unshift(2, lang('form'), 'admin/title/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('title');
					$save['creat_date'] = date('Y-m-d h:i:s');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('title');
					$this->data['row'] = $this->custom_lib->get_where('titles','id',$id)->row();
					//print_r($this->data['row']);die;
				}
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:title', 'required');
					if (empty ($id)){
					$this->form_validation->set_rules('name', 'lang:title', 'required|is_unique[titles.name]');
					}
					if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$save['for_gender'] = $this->input->post('for_gender');
						$this->custom_lib->form('titles',$save);
						redirect ('admin/title');
					}
				}
				$this->template->admin_render('admin/title/form',$this->data);
			}

			public function delete($id){
			
				$student = $this->custom_lib->get_where ('students','title',$id)->result();
				if (empty ($student)) {
					$this->custom_lib->delete_where('titles','id',$id);
					$this->session->set_flashdata('danger',lang('record_deleted'));
					redirect ('admin/title');
				}
				else {
					$this->breadcrumbs->unshift(2, lang('delete'), 'admin/title/delete');
					$this->data['breadcrumb'] = $this->breadcrumbs->show();
					$this->data['error_msg'] = lang('delete_title_exist_error');
					$this->data['back_url'] = site_url('admin/title');
					$this->data['redirect_url'] = site_url('admin/student/sections');
					$this->data['redirect_caption'] = lang('back_to_student');
					$this->template->admin_render('admin/title/delete',$this->data);
				}
			}
			public function profile($id){
				$this->breadcrumbs->unshift(2, lang('view'), 'admin/title/profile');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['row'] = $this->custom_lib->get_where('titles','id',$id)->row();
				$this->template->admin_render('admin/title/profile',$this->data);
			}
		}	
