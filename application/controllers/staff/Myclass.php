<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Myclass extends Staff_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->data['page_title'] = lang('myclass');		
			$this->breadcrumbs->unshift(1, lang('myclass'), 'staff/myclass');
			$this->load->model(array('admin/Staffs','admin/session_student_section','admin/Marks_zone','admin/attendance','admin/Other'));
			$this->staff_section = $this->Staffs->get_staff_class($this->session->userdata('user_id'),$this->session->userdata('academic_session'));
			//print_r($this->staff_section);die;
			if ($this->router->fetch_method() != 'no_class_assign') {
				if (empty($this->staff_section)){
					redirect ('staff/myclass/no_class_assign');
				}
			}
		}
		public function no_class_assign(){
			if (!empty($this->staff_section)){
				redirect ('staff/myclass');
			}
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->template->staff_render('staff/myclass/no_class_assign',$this->data);
		}
		public function index(){
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['result'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$this->staff_section->section_id);
			//echo '<pre>';print_r($this->data['result']);die;
			$this->template->staff_render('staff/myclass/index',$this->data);
		}
		public function section_subject(){
			$this->breadcrumbs->unshift(2, lang('subjects'), 'staff/myclass/section_subject');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$this->staff_section->section_id)->row(); 
			$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row();
			$exam_scheme = $this->custom_lib->field_like('exam_schemes','classes','"'.$this->data['section_detail']->class_id.'"')->row();
			$this->data['exams'] = $this->custom_lib->get_where('exams','scheme_id',@$exam_scheme->id)->result(); 
			$class_co_subjects = $this->custom_lib->get_where('rel_class_co_scolastic_subjects','class_id',$this->data['section_detail']->class_id)->row();
			$this->data['co_scolastic_subjects'] = json_decode(@$class_co_subjects->subjects);
			$this->data['marksheets'] = $this->custom_lib->get_where('marksheets','	exam_scheme_id',@$exam_scheme->id)->result();
			//print_r($this->data['marksheets']);die;
			$this->template->staff_render('staff/myclass/section_subject',$this->data);
		}
		public function enter_marks($subject_id,$exam_id){
			$this->breadcrumbs->unshift(2, lang('subjects'), 'staff/myclass/section_subject');
			$this->breadcrumbs->unshift(3, lang('enter_marks'), 'staff/myclass/enter_marks');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$this->staff_section->section_id)->row(); 
			$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row();
			$this->data['subject_detail'] = $this->custom_lib->get_where('subjects','id',$subject_id)->row(); 
			$this->data['result'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$this->staff_section->section_id);
			$this->data['marks_crieia'] = $this->Marks_zone->get_subject_marks_criteria($this->session->userdata('academic_session'),$this->data['section_detail']->class_id,$subject_id,$exam_id);
			if (empty($this->data['marks_crieia'])){
				redirect ('staff/marks_manager/section_subject/'.$this->staff_section->section_id);
			}
			if (!empty($this->input->post('submit'))){
				if (!empty($this->input->post('student_id'))) {
					$i = 0;
					foreach ($this->input->post('student_id') as $student_id){
						$save['exam_id'] = $exam_id;
						$save['subject_id'] = $subject_id;
						$save['section_id'] = $this->staff_section->section_id;
						$save['student_id'] = $student_id;
						if ($this->input->post('attendance')[$i] != 0){
							$save['attendence'] = $this->input->post('attendance')[$i];
							$save['marks'] = '';
							$this->Marks_zone->marks_entery_form($save);
						}
						if ($this->input->post('marks')[$i] != '' && $this->input->post('attendance')[$i] == 0){
							$save['attendence'] = $this->input->post('attendance')[$i];
							$save['marks'] = $this->input->post('marks')[$i];
							$this->Marks_zone->marks_entery_form($save);
						}
						$i++;
					}
				}
				redirect ('staff/myclass/section_subject');
			}
			$this->template->staff_render('staff/myclass/enter_marks',$this->data);
		}
		public function co_scolastic_marks($subject_id){
			$this->breadcrumbs->unshift(2, lang('subjects'), 'staff/myclass/section_subject');
			$this->breadcrumbs->unshift(3, lang('co_scolastic').' '.lang('subjects'), 'staff/myclass/co_scolastic_marks/');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$this->staff_section->section_id)->row(); 
			$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row();
			$this->data['result'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$this->staff_section->section_id);
			$this->data['gardes'] = $this->custom_lib->get_all('co_scolastic_grades')->result();	
	   		$this->data['subject_detail'] = $this->custom_lib->get_where('co_scolastic_subjects','id',$subject_id)->row();
	   		//echo '<pre>';print_r($this->data['gardes']);die;
			if (!empty($this->input->post('submit'))){
				if (!empty($this->input->post('student_id'))) {
					$i = 0;
					foreach ($this->input->post('student_id') as $student_id){
						$save['subject_id'] = $subject_id;
						$save['section_id'] = $this->staff_section->section_id;
						$save['student_id'] = $student_id;
						if ($this->input->post('attendance')[$i] != 0){
							$save['attendence'] = $this->input->post('attendance')[$i];
							$save['marks'] = '';
							$save['grade'] = '';
							$this->Marks_zone->col_scolastic_marks_entery_form($save);
						}
						if ($this->input->post('marks')[$i] != '' && $this->input->post('attendance')[$i] == 0){
							$save['attendence'] = $this->input->post('attendance')[$i];
							$save['marks'] = $this->input->post('marks')[$i];
							$save['grade'] =  $this->input->post('marks')[$i];
							$this->Marks_zone->col_scolastic_marks_entery_form($save);
						}
						$i++;
					}
				}
				redirect ('staff/myclass/section_subject');
			}
			$this->template->staff_render('staff/myclass/co_scolastic_marks',$this->data);
		}
		public function student_profile($id){
			$this->breadcrumbs->unshift(2, lang('profile'), 'staff/myclass/student_profile');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['row'] = $this->session_student_section->get_student_section_session($this->session->userdata('academic_session'),$id,$this->staff_section->section_id)->row();
			//echo '<pre>';print_r($this->data['row']);die;
			$this->data['current_class'] = $this->custom_lib->get_where('classes','id',$this->data['row']->class_id)->row();
			$this->data['admit_class'] = $this->custom_lib->get_where('classes','id',$this->data['row']->admit_class)->row();
			$this->data['admit_section'] = $this->custom_lib->get_where('sections','id',$this->data['row']->admit_section)->row();
			$this->data['nationality'] = $this->custom_lib->get_where('nationalities','id',$this->data['row']->nationality)->row();
			$this->data['religion'] = $this->custom_lib->get_where('religions','id',$this->data['row']->religion)->row();
			$this->data['cast'] = $this->custom_lib->get_where('castes','id',$this->data['row']->cast)->row();
			$this->data['category'] = $this->custom_lib->get_where('categories','id',$this->data['row']->category)->row();
			$this->data['country'] = $this->custom_lib->get_where('countries','id',$this->data['row']->country)->row();
			$this->data['state'] = $this->custom_lib->get_where('states','id',$this->data['row']->state)->row();
			$this->data['city'] = $this->custom_lib->get_where('cities','id',$this->data['row']->city)->row();
			$this->template->staff_render('staff/myclass/student_profile',$this->data);
		}
		public function print_marksheet($marksheet_id){
			$this->data['sessions'] = $this->custom_lib->get_all('academic_session')->result();
			if ($this->input->post('submit')){
				$this->data['promoted_class'] = $this->input->post('promoted_class');
				$this->data['students'] = $this->session_student_section->search_student($this->input->post('enrol_no'),$this->input->post('fname'),$this->staff_section->section_id);
				if (!empty ($this->data['students'])){
					foreach ($this->data['students'] as $student){
						$this->Marks_zone->student_marksheet($student->id,$this->staff_section->section_id);
					}
				}
				$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$this->staff_section->section_id)->row(); 
				$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row();
				$this->data['marksheet'] = $this->custom_lib->get_where('marksheets','id',$marksheet_id)->row();
				$this->data['grades'] = $this->custom_lib->get_where('non_co_scolastic_grades','scheme_id',$this->data['marksheet']->grade_scheme_id)->result();
				/*--Marks Criteria--*/
				$subject_ids = json_decode($this->data['section_detail']->subjects);
				$max_marks = 0;
				$min_marks = 0;
				if (!empty ($subject_ids)) { 
					foreach ($subject_ids as $subject_id){
						$subjects = $this->Marks_zone->subject_criteria_anuual($this->session->userdata('academic_session'),$this->data['class']->id, $subject_id);	
						$this->data['subjects'][]  = $subjects;
					}
				}	
			}
			$this->load->view('staff/myclass/print_marksheet',$this->data);
		}	  
		
		public function print_marksheet_one_to_fifth($marksheet_id){
			$this->data['sessions'] = $this->custom_lib->get_all('academic_session')->result();
			if ($this->input->post('submit')){
				$this->data['promoted_class'] = $this->input->post('promoted_class');
				$this->data['students'] = $this->session_student_section->search_student($this->input->post('enrol_no'),$this->input->post('fname'),$this->staff_section->section_id);
				if (!empty ($this->data['students'])){
					foreach ($this->data['students'] as $student){
						$this->Marks_zone->student_marksheet($student->id,$this->staff_section->section_id);
					}
				}
				$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$this->staff_section->section_id)->row(); 
				$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row();
				$this->data['marksheet'] = $this->custom_lib->get_where('marksheets','id',$marksheet_id)->row();
				$this->data['grades'] = $this->custom_lib->get_where('non_co_scolastic_grades','scheme_id',$this->data['marksheet']->grade_scheme_id)->result();
				//echo '<pre>';print_r($this->data['grades']);die;
				/*--Marks Criteria--*/
				$subject_ids = json_decode($this->data['section_detail']->subjects);
				$max_marks = 0;
				$min_marks = 0;
				if (!empty ($subject_ids)) { 
					foreach ($subject_ids as $subject_id){
						$subjects = $this->Marks_zone->subject_criteria_anuual($this->session->userdata('academic_session'),$this->data['class']->id, $subject_id);	
						$this->data['subjects'][]  = $subjects;
					}
				}	
			}
			$this->load->view('staff/myclass/print_marksheet_one_to_fifth',$this->data);
		} 
		public function tabsheet_1(){
			$this->data['students'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$this->staff_section->section_id);
			$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$this->staff_section->section_id)->row(); 
			$exam_scheme = $this->custom_lib->field_like('exam_schemes','classes','"'.$this->data['section_detail']->class_id.'"')->row();
			$this->data['exams'] = $this->custom_lib->get_where('exams','scheme_id',@$exam_scheme->id)->result(); 
			$this->data['subject_ids'] = json_decode($this->data['section_detail']->subjects);
			//echo '<pre>';print_r($this->data['students']);die;
			$this->load->view('staff/tabsheets/tabsheet_1',$this->data);
		}
		public function add_attendacne(){
			$this->breadcrumbs->unshift(2, lang('add_attendance'), 'staff/myclass/add_attendacne');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$this->staff_section->section_id)->row(); 
			$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row(); 
			$this->data['result'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$this->staff_section->section_id);
			if (!empty($this->input->post('submit'))){
				$this->form_validation->set_rules('working_days', 'lang:total_working_days', 'required');
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
				redirect('staff/myclass');
			}
			$this->template->staff_render('staff/myclass/add_attendance',$this->data);
		}
		public function add_remark(){
			$this->breadcrumbs->unshift(2, lang('add_remarks'), 'staff/myclass/add_remarks');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();	
			$this->data['section_detail'] = $this->custom_lib->get_where('sections','id',$this->staff_section->section_id)->row(); 
			$this->data['class'] = $this->custom_lib->get_where('classes','id',$this->data['section_detail']->class_id)->row(); 
			$this->data['result'] = $this->session_student_section->get_student_section_session_index($this->session->userdata('academic_session'),$this->staff_section->section_id);
			if (!empty($this->input->post('submit'))){
				if (!empty ($this->data['result'])) {
						foreach ($this->data['result'] as $student){
							$save['student_id'] = $student->id;
							$save['remark'] = $this->input->post('remark')[$student->id];
							$save['session_id'] = $this->session->userdata('academic_session');
							$this->Other->remark_form($save);
						}
				}
				redirect('staff/myclass');		
			}
			$this->template->staff_render('staff/myclass/add_remark',$this->data);
		}
		public function ajax_session_class(){
			$classes = $this->custom_lib->get_where('classes','session_id',$_POST['session_id'])->result();
			if (!empty ($classes)) { 
				foreach ($classes as $class) {
					echo '<option value="'.$class->name.'">'.$class->name.'</option>';
				}
			}
			else{
				echo '<option value="">'.lang('no_class_found').'</option>';
			}
			die;
		}
	}	
