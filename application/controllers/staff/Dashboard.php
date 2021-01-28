<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Dashboard extends Staff_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('dashboard');	
			$this->load->model(array('admin/Staffs','admin/session_student_section','admin/Marks_zone'));	
			$this->staff_section = $this->Staffs->get_staff_class($this->session->userdata('user_id'),$this->session->userdata('academic_session'));
			if (empty($this->staff_section)){
				redirect ('staff/myclass/no_class_assign');
			}
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['stu_count'] = count($this->custom_lib->get_where('sess_student_section','section_id',$this->staff_section->section_id)->result());
			$this->data['section'] = $this->custom_lib->get_where('sections','id',$this->staff_section->section_id)->row(); 
			$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section']->class_id)->row(); 
			$students = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$this->data['section']->id);
			if (!empty($students)){
				foreach ($students as $student){
					$chart_student[] = ucwords($student->fname.' '.$student->lname);
					$stu_marksheet = $this->Marks_zone->get_student_markseet($this->session->userdata('academic_session'),$this->data['section']->id, $student->id);
					if (!empty($stu_marksheet)){
						$chart_student_percent[] = $stu_marksheet->percentage;
					}
					else{
						$chart_student_percent[] = 0;
					}
				}
			}
			$this->data['chart_student'] = json_encode($chart_student);
			$this->data['chart_student_percent'] = json_encode($chart_student_percent);
			$this->template->staff_render('staff/dashboard/index',$this->data);
		}
	}	
