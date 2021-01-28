<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends Admin_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('dashboard');		
			$this->load->model('admin/dashboards');
		}
		public function index(){
		
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$classes = $this->custom_lib->get_where('classes','session_id',$this->session->userdata('academic_session'))->result();
			$this->data['count_classes'] = count ($classes);
			$this->data['count_students'] = count ($this->custom_lib->get_where('sess_student_section','session_id',$this->session->userdata('academic_session'))->result());
			$this->data['count_staffs'] = count ($this->custom_lib->get_all('staff')->result());
			$this->data['count_subjects'] = count ($this->custom_lib->get_all('subjects')->result());
			$this->data['new_admissions'] = $this->dashboards->new_admissions_session_wise($this->session->userdata('academic_session'));
			//echo '<pre>';print_r($this->data['new_admissions']);die;
			/*--Session Wise Student Charts--*/
			$sessions = $this->custom_lib->get_all('academic_session')->result();
			if (!empty($sessions)) {
				foreach ($sessions as $session){
					$chart_sessions[] = ucwords($session->caption);
					$sess_students[] = count ($this->custom_lib->get_where('sess_student_section','session_id',$session->id)->result());
				}
				$this->data['sessions'] = json_encode($chart_sessions);
				$this->data['sess_students'] = json_encode($sess_students);
			}
			/*--Class Wise student Charts--*/
			if (!empty($classes)) {
				foreach ($classes as $class){
					$class_label[] = $class->name;
					$ts = $this->dashboards->get_student_count_class_wise($class->id)->stu_count;
					$total_students[] = !empty ($ts) ? $ts : 0; 
					$ms = $this->dashboards->get_student_count_class_wise($class->id,'M')->stu_count;
					$male_students[]  = !empty ($ms) ? $ms : 0; 
					$fs = $this->dashboards->get_student_count_class_wise($class->id,'F')->stu_count;
					$female_students[] = !empty ($fs) ? $fs : 0;
				}
				$this->data['class_label'] = json_encode($class_label);
				$this->data['total_students'] = json_encode($total_students);
				$this->data['male_students'] = json_encode($male_students);
				$this->data['female_students'] = json_encode($female_students);
				//echo '<pre>';print_r($);die;
			}
			$this->template->admin_render('admin/dashboard/index',$this->data);
		}
	}	
