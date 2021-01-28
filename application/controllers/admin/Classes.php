<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


	class Classes extends Admin_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('classes');
			$this->breadcrumbs->unshift(1, lang('classes'), 'admin/classes');
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['result'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
			$this->data['delete_msg']  = lang('delete_msg').' '.lang('class');
			$this->template->admin_render('admin/classes/index',$this->data);
		}
		public function form($id = ''){
			$this->breadcrumbs->unshift(2, lang('form'),'admin/classes/form');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['result'] = $this->custom_lib->get_all('subjects')->result();
			if (empty ($id)){
				$this->data['page_sub_title'] = lang('add').' '.lang('classes');
				$save['creat_date'] = date('Y-m-d h:i:s');
			}
			if (!empty ($id)){
				$this->data['page_sub_title'] = lang('edit').' '.lang('classes');
				$this->data['row'] = $this->custom_lib->get_where('classes','id',$id)->row();
				//print_r($this->data['row']);die;
			}
			if ($this->input->post('submit')){
				$this->form_validation->set_rules('name', 'lang:name', 'required');
				if (empty ($id)) {
				$this->form_validation->set_rules('name', 'lang:name', 'required|is_unique[classes.name]');
				}

				if ($this->form_validation->run() == TRUE){
					$save['id'] = $id;
					$save['name'] = $this->input->post('name');
					$save['session_id'] = $this->session->userdata('academic_session'); 
					$save['desc'] = $this->input->post('desc');
					$save['subjects'] = json_encode($this->input->post('subjects'));
					$this->custom_lib->form('classes',$save);
					redirect ('admin/classes');
				}
			}
			$this->template->admin_render('admin/classes/form',$this->data);
		}

		public function delete($id){
			
		} 
		public function profile($id){
			$this->breadcrumbs->unshift(2, lang('view'), 'admin/classes/profile');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['row'] = $this->custom_lib->get_where('classes','id',$id)->row();
			$this->template->admin_render('admin/classes/profile',$this->data);
		}
	}	
