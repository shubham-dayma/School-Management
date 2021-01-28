	<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

		class Report extends Staff_Controller {
			public function __construct()
			{
				parent::__construct();
				$this->load->model(array('admin/session_student_section','admin/Staffs'));
				$this->data['page_title'] = lang('dynamic_report');	
				$this->breadcrumbs->unshift(1, lang('dynamic_report'), 'admin/dynamic_report');
				$this->staff_section = $this->Staffs->get_staff_class($this->session->userdata('user_id'),$this->session->userdata('academic_session'));
				if (empty($this->staff_section)){
					redirect ('staff/myclass/no_class_assign');
				}
			}
			public function index(){
				$this->data['breadcrumb'] = $this->breadcrumbs->show();
				$this->data['classes'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
				if (!empty($this->input->post('submit'))){
					$section_id = $this->staff_section->section_id;
					$this->data['students'] = $this->session_student_section->dynamic_columns($this->session->userdata('academic_session'),$this->input->post('rows'),$section_id);
					$this->data['columns'] = $this->input->post('rows');
					//echo '<pre>';print_r($this->data['students']);die;
				}	
				$this->template->staff_render('staff/reports/dynamic_report',$this->data);
			}
		}	
