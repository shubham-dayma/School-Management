<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


	class Certificates extends Admin_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('certificates');
			$this->breadcrumbs->unshift(1, lang('certificates'), 'admin/certificates');
			$this->load->model(array('admin/session_student_section','admin/Other'));
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['students'] = array();
			$this->data['classes'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
			if ($this->input->post('submit')){
				//print_r($_POST);die;
				if ($this->input->post('class_section') == 'all'){
					$section_id = '';
				}
				else{
					$section_id = $this->input->post('class_section');
				}
				$this->data['students'] = $this->session_student_section->search_student($this->input->post('enrol_no'),$this->input->post('name'),$section_id);
				
			}
			$this->template->admin_render('admin/certificates/index',$this->data);
		}
		public function cc($stu_id){
			$this->breadcrumbs->unshift(2, lang('cc'), 'admin/sections/profile');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['row'] = $this->session_student_section->get_student_section_session($this->session->userdata('academic_session'),$stu_id)->row();
			$this->data['issued'] = $this->custom_lib->get_where('cc_issued','student_id',$stu_id)->row();	
			if ($this->input->post('submit')){	
				if (empty ($this->data['issued'] )) {
					$issue['student_id'] = $stu_id;
					$issue['issue_date'] = date('Y-m-d h:i:s');
					$issue['serial_no'] = $this->Other->get_serial_no('cc');
					$this->custom_lib->insert('cc_issued',$issue);
					$this->data['issued'] = $this->custom_lib->get_where('cc_issued','student_id',$stu_id)->row();	
				}
			}
			$this->template->admin_render('admin/certificates/cc',$this->data);
		}
		public function tc($stu_id){
			$this->breadcrumbs->unshift(2, lang('tc'), 'admin/sections/profile');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['page_sub_title'] = lang('tc'); 
			$this->data['issued'] = $this->custom_lib->get_where('tc_issued','student_id',$stu_id)->row();
			if (!empty ($this->data['issued'])){
				$this->data['row'] = $this->session_student_section->get_student_section_session($this->session->userdata('academic_session'),$stu_id)->row();
			}
			if ($this->input->post('submit')){
				$this->form_validation->set_rules('leaving_date', 'lang:leaving_date', 'required');
				if ($this->form_validation->run() == TRUE){
					//print_r($_POST);die;
					$save['leaving_date'] = $this->input->post('leaving_date');
					$save['reason_of_leaving'] = $this->input->post('reason_of_leaving');
					$save['s_academic_status'] = 2;
					$this->custom_lib->update('students','id',$stu_id,$save);
					$this->data['row'] = $this->session_student_section->get_student_section_session($this->session->userdata('academic_session'),$stu_id)->row();
					if (empty ($this->data['issued'])) {
						$issue['student_id'] = $stu_id;
						$issue['issue_date'] = date('Y-m-d h:i:s');
						$issue['serial_no'] = $this->Other->get_serial_no('tc');
						$this->custom_lib->insert('tc_issued',$issue);
						$this->data['issued'] = $this->custom_lib->get_where('tc_issued','student_id',$stu_id)->row();
					}
				}	
			}
			//echo '<pre>';print_r($this->data['row']);die;
			$this->template->admin_render('admin/certificates/tc',$this->data);
		}
		
		
	}	
