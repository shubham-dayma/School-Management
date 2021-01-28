<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


	class Sections extends Admin_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('sections');	
			$this->breadcrumbs->unshift(1, lang('sections'), 'admin/sections');
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['result'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
			$this->data['delete_msg']  = lang('delete_msg').' '.lang('section');
			$this->template->admin_render('admin/sections/index',$this->data);
		}
		public function form($id = ''){
			$this->breadcrumbs->unshift(2, lang('form'),'admin/sections/form');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['result'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
			if (empty ($id)){
				$this->data['page_sub_title'] = lang('add').' '.lang('section');
				$save['creat_date'] = date('Y-m-d h:i:s');
			}
			if (!empty ($id)){
				$this->data['page_sub_title'] = lang('edit').' '.lang('section');
				$this->data['row'] = $this->custom_lib->get_where('sections','id',$id)->row();
				//print_r($this->data['row']);die;
			}
			if ($this->input->post('submit')){
				$this->form_validation->set_rules('name', 'lang:name', 'required');
				$this->form_validation->set_rules('class_id', 'lang:class', 'required');
				if ($this->form_validation->run() == TRUE){
					//print_r($this->input->post()); die;
					$save['id'] = $id;
					$save['name'] = $this->input->post('name');
					$save['class_id'] = $this->input->post('class_id');
					$save['session_id'] = $this->session->userdata('academic_session'); 
					$save['desc'] = $this->input->post('desc');
					$subjects = $this->custom_lib->get_where('classes','id',$save['class_id'])->row();
					if (!empty ($subjects)) {
							$save['subjects'] = $subjects->subjects;
					}
					$this->custom_lib->form('sections',$save);
					redirect ('admin/sections');
				}
			}
			$this->template->admin_render('admin/sections/form',$this->data);
		}

		public function delete($id){
			
		} 
		public function profile($id){
			$this->breadcrumbs->unshift(2, lang('view'), 'admin/sections/profile');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['row'] = $this->custom_lib->get_where('sections','id',$id)->row();
			$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['row']->class_id)->row();
			$this->data['class']  = $this->data['class']->name;
			$this->template->admin_render('admin/sections/profile',$this->data);
		}
		public function apply_subjects($id){
			$this->breadcrumbs->unshift(2, lang('apply_subjects'), 'admin/sections/apply_subjects');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['page_sub_title'] = lang('apply_subjects');
			$this->data['row'] = $this->custom_lib->get_where('sections','id',$id)->row();
			$this->data['subjects'] = $this->custom_lib->get_all('subjects')->result();
			$class =  $this->custom_lib->get_where('classes','id',$this->data['row']->class_id)->row();
			$this->data['class_subjects'] = $class->subjects;
			if ($this->input->post('submit')){
				$section_sub['id'] = $id;
				$section_sub['subjects'] = json_encode($this->input->post('subjects'));
				$this->custom_lib->form('sections',$section_sub);
				redirect('admin/sections');
			}
			$this->template->admin_render('admin/sections/apply_subjects',$this->data);
		}
	}	
