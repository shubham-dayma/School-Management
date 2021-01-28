<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Attendace extends Staff_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('attendacne_manager');		
			$this->breadcrumbs->unshift(1, lang('attendacne_manager'), 'staff/attendace');
			$this->load->model(array('admin/Staffs','admin/session_student_section','admin/attendance'));
			/*--Validating User Role--*/
			$valid_user = $this->Staffs->staff_role(1,$this->session->userdata('user_id'));
			if (empty ($valid_user)){
				redirect ('staff');
			}
		}
		public function index(){
			$this->data['page_title'] = lang('my_role');	
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['roles'] = $this->Staffs->get_staff_roles($this->session->userdata('user_id'));	
			$this->data['result'] = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result(); 
			//echo'<pre>';print_r($this->data['roles']);die;
			$this->template->staff_render('staff/attendace/index',$this->data);
		}
		public function class_section ($class_id){
			$this->breadcrumbs->unshift(2, lang('sections'), 'staff/attendace/class_section');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['class_detail'] = $this->custom_lib->get_where('classes','id',$class_id)->row(); 
			$this->data['result'] = $this->custom_lib->get_where('sections','class_id',$class_id)->result();
			$this->template->staff_render('staff/attendace/class_section',$this->data);
		}
		public function add($section_id){
			$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$section_id)->row(); 
			$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row(); 
			$this->data['result'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$section_id);
			
			if (!empty($this->input->post('submit'))){
				$this->form_validation->set_rules('working_days', 'lang:total_working_days', 'required');
				//$this->form_validation->set_rules('attendance[]', 'lang:attendance', 'greater_than_equal_to['.$this->input->post('working_days').']');
				if ($this->form_validation->run() == TRUE){
					if (!empty ($this->data['result'])) {
						foreach ($this->data['result'] as $student){
							$save['working_days'] = $this->input->post('working_days');
							$save['student_id'] = $student->id;
							$save['attendance'] = $this->input->post('attendance')[$student->id];
							$save['session_id'] = $this->session->userdata('academic_session');
							$this->attendance->form($save);
						}
					}
				}	
				redirect('staff/attendace/class_section/'.$this->data['class']->id);
			}
			$this->breadcrumbs->unshift(2, lang('sections'), 'staff/attendace/class_section/'.$this->data['class']->id);
			$this->breadcrumbs->unshift(3, lang('sections'), 'staff/attendace/add/'.$section_id);
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->template->staff_render('staff/attendace/add',$this->data);
		}
	}	
