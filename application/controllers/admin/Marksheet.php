	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	
		class Marksheet extends Admin_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->data['page_title'] = lang('marksheets');	
				$this->breadcrumbs->unshift(1, lang('marksheets'), 'admin/marksheet');
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['result'] = $this->custom_lib->get_all('marksheets')->result();
				$this->data['delete_msg']  = lang('delete_msg').' '.lang('marksheet');
				//print_r($this->data['result']);die;
				$this->template->admin_render('admin/marksheet/index',$this->data);
			}
			public function form($id = ''){
				$this->breadcrumbs->unshift(2, lang('form'), 'admin/marksheet/form');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['schemes'] = $this->custom_lib->get_where('exam_schemes','session_id',$this->session->userdata('academic_session'))->result();
				$this->data['grade_schemes'] = $this->custom_lib->get_where('non_co_scolastic_grade_schemes','session_id',$this->session->userdata('academic_session'))->result();
				if (empty ($id)){
					$this->data['page_sub_title'] = lang('add').' '.lang('marksheet');
				}
				if (!empty ($id)){
					$this->data['page_sub_title'] = lang('edit').' '.lang('marksheet');
					$this->data['row'] = $this->custom_lib->get_where('marksheets','id',$id)->row();
				}
				//print_r($this->data['row']);die;
				if ($this->input->post('submit')){
					$this->form_validation->set_rules('name', 'lang:name', 'required');
					$this->form_validation->set_rules('exam_scheme_id', 'lang:exam_scheme', 'required');
					$this->form_validation->set_rules('url', 'lang:url', 'required');
					 if ($this->form_validation->run() == TRUE){
						$save['id'] = $id;
						$save['name'] = $this->input->post('name');
						$save['exam_scheme_id'] = $this->input->post('exam_scheme_id');
						$save['grade_scheme_id'] = $this->input->post('grade_scheme_id');
						$save['url'] = $this->input->post('url');
						$save['passing_percentage'] = $this->input->post('passing_percentage');
						$save['result_date'] = $this->input->post('result_date');
						$this->custom_lib->form('marksheets',$save);
						redirect ('admin/marksheet');
					}
				}
				$this->template->admin_render('admin/marksheet/form',$this->data);
			}

			public function delete($id){
				$this->custom_lib->delete_where('marksheets','id',$id);
				$this->session->set_flashdata('danger',lang('record_deleted'));
				redirect ('admin/marksheet');
				
			}
			public function profile($id){
				$this->breadcrumbs->unshift(2, lang('view'), 'admin/marksheet/profile');
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['row'] = $this->custom_lib->get_where('marksheets','id',$id)->row();
				$this->data['exam_scheme'] = $this->custom_lib->get_where('exam_schemes','id',$this->data['row']->exam_scheme_id)->row();
				$this->data['grade_scheme'] = $this->custom_lib->get_where('non_co_scolastic_grade_schemes','id',$this->data['row']->grade_scheme_id)->row();
				$this->template->admin_render('admin/marksheet/profile',$this->data);
			}
		}	
